<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Product\ProductOrder;
use App\Model\Measurement\Measurement;
use App\Model\Measurement\SalwarMeasurement;
use App\Model\Measurement\SareeMeasurement;
use App\Model\Product\ProductOrderDetail;
use Zend\Diactoros\Response;
use App\Model\User\User;
use Mail;

class OrderDetailsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * View Order Details Index / Transed Pages
     * @author Bhagirath
     * @create_at 06 March 2020
     */

    public function index($type)
    {
        if ($type == 'view-trashed') {
            return view('admin-panel.order-details.trashed');
        } else {
            return view('admin-panel.order-details.index');
        }
    }
    /**
     * Get NewsLetter list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 06 March 2020
     */
    public function getOrderDetails(Request $request, $type)
    {
        if ($type == 'all-orders') {
            $orderDetails = ProductOrder::with('user')->orderBy('product_order_id', 'DESC')->get();
        } else {
            if ($type == 'payment-pending') {
                $status  = 0;
            } else if ($type == 'new-orders') {
                $status  = 1;
            } elseif ($type == 'under-process') {
                $status  = 2;
            } elseif ($type == 'processed') {
                $status  = 3;
            } elseif ($type == 'shipped') {
                $status  = 4;
            } elseif ($type == 'out-for-delivery') {
                $status  = 5;
            } elseif ($type == 'completed') {
                $status  = 6;
            } elseif ($type == 'canceled') {
                $status  = 7;
            } elseif ($type == 'return') {
                $status  = 8;
            }
            $orderDetails = ProductOrder::with('user')->where('order_status', $status)->orderBy('product_order_id', 'DESC')->get();
        }
        return DataTables::of($orderDetails)
            ->addColumn('user_details', function ($orderDetails) {
                $data .= ' <b>Name: </b>' . $orderDetails->user->f_name . ' ' . $orderDetails->user->l_name;
                $data .= ' </br><b>Email: </b>' . $orderDetails->user->email . '</br>';
                $data .= '<b>Mobile: </b>' . $orderDetails->user->mobile_number;
                return $data;
            })
            ->addColumn('price_details', function ($orderDetails) {
                $price_details .= "<b> Total Amount: </b>" . $orderDetails->total_amount . "</br>";
                $price_details .= "<b> Discounted Amount: </b>" . $orderDetails->discount_amount . "</br>";
                $price_details .= "<b> Shipping Charges: </b>" . $orderDetails->shipping_charge . "</br>";
                $price_details .= "<b> Net Amount: </b>" . $orderDetails->net_amount;
                return $price_details;
            })
            ->addColumn('status', function ($orderDetails) {
                $status .= '<select class="form-control" onchange="changeOrderStatus(this)" data-id="' . ev($orderDetails->product_order_id) . '" style="font-size: 15px;">';


                if ($orderDetails->order_status == 0) {
                    $status .=  '<option value="0" selected>Payment Pending</option>';
                } else {
                    $status .=  '<option value="0">Payment Pending</option>';
                }

                if ($orderDetails->order_status == 1) {
                    $status .=  '<option value="1" selected>New Order</option>';
                } else {
                    $status .=  '<option value="1">New Order</option>';
                }
                // if ($orderDetails->order_status==2) {
                //     $status .=   '<option value="2" selected>Under Process</option>';
                // }
                // else{
                //     $status .=  '<option value="2">Under Process</option>';
                // }
                if ($orderDetails->order_status == 3) {
                    $status .=  '<option value="3" selected>Processed</option>';
                } else {
                    $status .=   '<option value="3">Processed</option>';
                }
                if ($orderDetails->order_status == 4) {
                    $status .=  '<option value="4" selected>Shipped</option>';
                } else {
                    $status .=   '<option value="4">Shipped</option>';
                }
                // if ($orderDetails->order_status==5) {
                //     $status .=  '<option value="5" selected>Out for delivery</option>';
                // }
                // else{
                //     $status .=   '<option value="5">Out for delivery</option>';
                // }
                if ($orderDetails->order_status == 6) {
                    $status .=  '<option value="6" selected>Completed</option>';
                } else {
                    $status .=   '<option value="6">Completed</option>';
                }
                // if ($orderDetails->order_status==7) {
                //     $status .=  '<option value="7" selected>Canceled</option>';
                // }
                // else{
                //     $status .=   '<option value="7">Canceled</option>';
                // }
                // if ($orderDetails->order_status==8) {
                //     $status .=  '<option value="8" selected>Return</option>';
                // }
                // else{
                //     $status .=   '<option value="8">Return</option>';
                // }
                $status .= '</select>';
                return $status;
            })
            ->addColumn('created_at', function ($orderDetails) {
                return date('D, d F Y, h:i A', strtotime($orderDetails->created_at));
            })
            ->addColumn('action', function ($orderDetails) {
                $action = '<a href="' . route("adminPanel.orderDetails.productOrderDetails", [id => ev($orderDetails->product_order_id)]) . '"><button class="btn btn-primary"> View Details </button></a>';
                return $action;
            })
            ->rawColumns([
                'user_details'    => 'user_details',
                'price_details'   => 'price_details',
                'created_at'    => 'created_at',
                'action'          => 'action',
                'status'          => 'status',
            ])->addIndexColumn()->make(true);
    }
    /**

    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 06 March 2020
     */
    public function changeStatus(Request $request)
    {
        $orderDetails = ProductOrder::with('user')->with('productOrderDetail')->find(dv($request['id']));

        $orderDetails->order_status = $request['status'];
        $orderDetails->save();
        if (!is_null($orderDetails)) {
            if ($orderDetails->user->email != "" && $request['status'] == 6) {
                $emailData                          = [];
                $emailData['subject']               = "Order Delivered Successfully";
                $emailData['email']                 = $orderDetails->user->email;
                $emailData['name']                  = $orderDetails->user->f_name . ' ' . $orderDetails->user->l_name;
                $emailData['order_message']         = "Congratulations! Your order has been delivered successfully.";
                $emailData['order_number']          = $orderDetails->order_number;
                $emailData['net_amount']            = $orderDetails->net_amount;
                $emailData['order_detail']          = $orderDetails->productOrderDetail;
                $emailData['total_amount']          = $orderDetails->total_amount;
                $emailData['discount_amount']       = $orderDetails->discount_amount;
                $emailData['shipping_charge']       = $orderDetails->shipping_charge;
                Mail::send('emails.order-delivered-mail', $emailData, function ($message) use ($emailData) {
                    $message->to($emailData['email'], $emailData['name'])->subject($emailData['subject']);
                });
            }

            $response = [
                '_status'  => true,
                '_message' => __('messages.status_changed'),
                '_type'    => 'success'

            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.status_change_failed'),
                '_type'    => 'error'
            ];
        }
        //-------------

        return response()->json($response, 200);
    }
    /**
     * Move To Trash.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function moveToTrash(Request $request)
    {
        $ids = $request['ids'];
        $orderDetails         = ProductOrder::whereIn('product_order_id', $ids)->delete();
        // Set response
        if ($orderDetails == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_moved_to_trash', ['record' => 'Order Detail']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_move_to_trash_failed', ['record' => 'Order Detail']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }
    /**
     * Destroy.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    public function destroy(Request $request)
    {
        $orderDetails = false;
        $ids = $request['ids'];
        $orderDetails         = ProductOrder::whereIn('product_order_id', $ids)->forceDelete();
        // Set response
        if ($orderDetails == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_removed_to_trash', ['record' => 'Order Detail']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Order Detail']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }
    /**
     * Get Trashed Data
     *
     * @return mixed
     *
     * @author Bhagirath
     * @create_at 23 March 2020
     *
     */
    public function getTashedOrderDetails()
    {
        $orderDetails = ProductOrder::orderBy('product_order_id', 'DESC')->onlyTrashed()->get();
        return DataTables::of($orderDetails)
            ->addColumn('user_details', function ($orderDetails) {
                $data .= ' <b>Name: </b>' . $orderDetails->user->f_name . ' ' . $orderDetails->user->l_name;
                $data .= ' </br><b>Email: </b>' . $orderDetails->user->email . '</br>';
                $data .= '<b>Mobile: </b>' . $orderDetails->user->mobile_number;
                return $data;
            })
            ->addColumn('price_details', function ($orderDetails) {
                $price_details .= "<b> Total Amount: </b>" . $orderDetails->total_amount . "</br>";
                $price_details .= "<b> Discounted Amount: </b>" . $orderDetails->discount_amount . "</br>";
                $price_details .= "<b> Shipping Charges: </b>" . $orderDetails->shipping_charge . "</br>";
                $price_details .= "<b> Net Amount: </b>" . $orderDetails->net_amount;
                return $price_details;
            })
            ->addColumn('status', function ($orderDetails) {
                $status .= '<input class="form-control" value="Trashed" style="width:100px; font-size:15px" disabled/>';
                return $status;
            })
            ->addColumn('action', function ($orderDetails) {
                $action = '<button class="btn btn-primary"> View Details </button>';
                return $action;
            })
            ->rawColumns([
                'user_details'    => 'user_details',
                'price_details'   => 'price_details',
                'action'          => 'action',
                'status'          => 'status',
            ])->addIndexColumn()->make(true);
    }
    /**
     * Undo Delete.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 March 2020
     */
    // public function undoDelete(Request $request)
    // {

    //     foreach ($request['ids'] as $id) {
    //         $orderDetails         = ProductOrder::withTrashed()->find($id);
    //         $orderDetails->restore();
    //     }
    //     // Set response
    //     if ($orderDetails == true) {
    //         $response = [
    //             '_status'  => true,
    //             '_message' => __('messages.record_removed_to_trash', ['record' => 'Order Detail']),
    //             '_type'    => 'success'
    //         ];
    //     } else {
    //         $response = [
    //             '_status'  => false,
    //             '_message' => __('messages.record_remove_to_trash_failed', ['record' => 'Order Detail']),
    //             '_type'    => 'error'
    //         ];
    //     }
    //     //-------------
    //     return response()->json($response, 200);
    // }
    /**
     * View detail page
     *
     * @return mixed
     *
     * @author Bhagirath
     * @create_at 23 March 2020
     *
     */
    public function productOrderDetails($id)
    {
        $statusOptions = array(
            '0' => 'Payment Pending',
            '1' => 'New Order',
            // '2' => 'Under Process',
            '3' => 'Processed',
            '4' => 'Shipped',
            // '5' => 'Out for delivery',
            '6' => 'Completed',
            // '7' => 'Canceled',
            // '8' => 'Return',
        );
        $orderDetail = ProductOrder::with('billingCountry')->with('user')
            ->with('productOrderDetail')
            ->find(dv($id));
        $data = array(
            'orderDetail'    =>  $orderDetail,
            'statusOptions'  =>  $statusOptions,
        );
        return view('admin-panel.order-details.details')->with($data);
    }
    /**
     * Get custom measurement details
     *
     * @return mixed
     *
     * @author Bhagirath
     * @create_at 23 March 2020
     *
     */
    public function getMeasurmenets($id)
    {

        $id = dv($id);
        $data =  ProductOrderDetail::find($id)->toArray();

        if ($data['custom_measurement'] != "") {
            $array = json_decode($data['custom_measurement'], true);
            $details = json_decode($array['customMeasurement'], true);
            $measurementID = $details[0]['measurement_id'];
            $measurement = json_decode($data['measurment_details'], true);
            $responseData .= "<h3>" . $measurement['measurement_title'] . "</h3>";
            $responseData .= "<table class='table table-bordered table-hover table-striped'>
            <thead class='table-header'>
            <tr>
            <th> Title  </th>
            <th> Measurement (" . $array['measurement_in'] . ")</th>
            </tr>
            </thead>
            <tbody>";

            foreach ($details as $key => $detail) {
                $responseData .= "<tr>
                <td>" . $detail['measurement_title'] . "</td>
                <td>" . $detail['measurement'] . '</td>
                </tr>';
            }
            $responseData .= "<tr>
            <td>Other</td>
            <td>" . $array['other'] . '</td>
            </tr>';
            $responseData .= "</tbody>
            </table>";
            echo $responseData;
        } elseif ($data['salwar_measurment'] != "") {
            $array = json_decode($data['salwar_measurment'], true);
            // p($array[0]['bottom_pattern']);
            $detailSalwarTopMeasurement = json_decode($array[0]['salwarTopMeasurement'], true);
            $measurementID = $detailSalwarTopMeasurement[0]['salwar_measurement_id '];
            $measurement = SalwarMeasurement::select("salwar_measurement_titles")->find($measurementID)->toArray();
            $responseData .= "<h3>" . $measurement['salwar_measurement_titles'] . " (Top) </h3>";
            $responseData .= "<table class='table table-bordered table-hover table-striped'>
            <thead class='table-header'>
            <tr>
            <th> Title  </th>
            <th> Measurement (" . $array[0]['measurement_in'] . ")</th>
            </tr>
            </thead>
            <tbody>";

            foreach ($detailSalwarTopMeasurement as $key => $detail) {
                $responseData .= "<tr>
                <td>" . $detail['top_title'] . "</td>
                <td>" . $detail['measurement'] . '</td>
                </tr>';
            }
            $responseData .= "</tbody>
            </table>";
            $detailSalwarBottomMeasurement = json_decode($array[0]['salwarBottomMeasurement'], true);
            $responseData .= "<h3>" . $measurement['salwar_measurement_titles'] . " (Buttom) | Pattern: " . $array[0]['bottom_pattern'] . "</h3>";
            $responseData .= "<table class='table table-bordered table-hover table-striped'>
            <thead class='table-header'>
            <tr>
            <th> Title  </th>
            <th> Measurement (" . $array[0]['measurement_in'] . ")</th>
            </tr>
            </thead>
            <tbody>";

            foreach ($detailSalwarBottomMeasurement as $key => $detail) {
                $responseData .= "<tr>
                <td>" . $detail['bottom_title'] . "</td>
                <td>" . $detail['measurement'] . '</td>
                </tr>';
            }
            $responseData .= "<tr>
            <td>Other</td>
            <td>" . $array[0]['other'] . '</td>
            </tr>';
            $responseData .= "</tbody>
            </table>";
            echo $responseData;
        } elseif ($data['saree_measurement'] != "") {
            $array = json_decode($data['saree_measurement'], true);
            if (count($array) == 1) {
                $detailFirst = json_decode($array[0]['sareeMeasurement'], true);
                $measurementID = $detailFirst[0]['saree_measurement_id'];
                $measurements   = json_decode($data['saree_measurment_details'], true);
                foreach ($measurements as $key => $measurement) {
                    if ($array[0]['saree_measurement_id'] == $measurement['saree_measurement_id']) {
                        $title = $measurement['saree_measurement_title'];
                        break;
                    }
                }
                $responseData .= "<h3>" . $title . " </h3>";
                $responseData .= "<table class='table table-bordered table-hover table-striped'>
                <thead class='table-header'>
                <tr>
                <th> Title  </th>
                <th> Measurement (" . $array[0]['measurement_in'] . ")</th>
                </tr>
                </thead>
                <tbody>";

                foreach ($detailFirst as $key => $detail) {
                    $responseData .= "<tr>
                    <td>" . $detail['measurement_title'] . "</td>
                    <td>" . $detail['measurement'] . '</td>
                    </tr>';
                }
                $responseData .= "<tr>
                <td>Other</td>
                <td>" . $array[0]['other'] . '</td>
                </tr>';
                $responseData .= "</tbody>
                </table>";
                echo $responseData;
                return;
            } else {
                $measurements  = json_decode($data['saree_measurment_details'], true);
                foreach ($measurements as $key => $measurement) {
                    if ($array[0]['saree_measurement_id'] == $measurement['saree_measurement_id']) {
                        $titleFirst = $measurement['saree_measurement_title'];
                        break;
                    }
                }
                $detailFirst = json_decode($array[0]['sareeMeasurement'], true);
                $responseData .= "<h3>" . $titleFirst . " </h3>";
                $responseData .= "<table class='table table-bordered table-hover table-striped'>
                <thead class='table-header'>
                <tr>
                <th> Title  </th>
                <th> Measurement (" . $array[0]['measurement_in'] . ")</th>
                </tr>
                </thead>
                <tbody>";

                foreach ($detailFirst as $key => $detail) {
                    $responseData .= "<tr>
                    <td>" . $detail['measurement_title'] . "</td>
                    <td>" . $detail['measurement'] . '</td>
                    </tr>';
                }
                $responseData .= "<tr>
                <td>Other</td>
                <td>" . $array[0]['other'] . '</td>
                </tr>';
                $responseData .= "</tbody>
                </table>";
                foreach ($measurements as $key => $measurement) {
                    if ($array[1]['saree_measurement_id'] == $measurement['saree_measurement_id']) {
                        $titleSecond = $measurement['saree_measurement_title'];
                        break;
                    }
                }
                $detailSecond = json_decode($array[1]['sareeMeasurement'], true);
                $responseData .= "<h3>" . $titleSecond . " </h3>";
                $responseData .= "<table class='table table-bordered table-hover table-striped'>
                <thead class='table-header'>
                <tr>
                <th> Title  </th>
                <th> Measurement (" . $array[1]['measurement_in'] . ")</th>
                </tr>
                </thead>
                <tbody>";

                foreach ($detailSecond as $key => $detail) {
                    $responseData .= "<tr>
                    <td>" . $detail['measurement_title'] . "</td>
                    <td>" . $detail['measurement'] . '</td>
                    </tr>';
                }
                $responseData .= "<tr>
                <td>Other</td>
                <td>" . $array[1]['other'] . '</td>
                </tr>';
                $responseData .= "</tbody>
                </table>";
                echo $responseData;
                return;
            }
        }
    }
}
