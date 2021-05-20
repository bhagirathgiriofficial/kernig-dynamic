<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Fabric\Fabric;
use App\Model\Product\ProductFabric;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateFabric;

class FabricController extends Controller
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
     * View Categorys
     * @author Bhagirath
     * @create_at 05-Feb-2020
     */

    public function index()
    {
        return view('admin-panel.fabric.index');
    }

    /**
     * Check Category Name.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkFabricName(Request $request)
    {
        $status = false;
        if (!is_null($request->fabric_name)) {
            $fabric = Fabric::where('fabric_name', $request['fabric_name'])->first();
            if (!is_null($fabric)) {
                if ($request->filled('id') && $fabric->fabric_id == dv($request['id'])) {
                    $status = true;
                } else {
                    $status = false;
                }
            } else {
                $status = true;
            }
        }

        return response()->json($status, 200);
    }
    /**
     * Store category.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 07 Feb 2020
     */
    public function store(ValidateFabric $request)
    {

        $user            = auth()->user();
        $fabric          = false;
        $error_message   = null;


        DB::beginTransaction();
        // Create Category
        try {

            // Set data
            $data = [
                'fabric_name'              => ucwords($request['fabric_name']),
            ];
            //---------

            $fabric = Fabric::create($data);

            DB::commit();
        } catch (\Exception $e) {
            $fabric          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (!is_null($fabric)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Fabric']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.fabric.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Fabric']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.fabric.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     * Get categoreis list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 07 Feb 2020
     */
    public function getFabrics(Request $request)
    {
        $auth_user = auth()->user();

        $fabrics = Fabric::where(function ($query) use ($request) {
            if (!empty($request) && !empty($request->input('fabric_name'))) {
                $query->whereRaw('lower(fabric_name) LIKE ? ', [trim(strtolower('%' . $request->input('fabric_name'))) . '%']);
            }
        })->orderBy('fabric_id', 'DESC')->get();
        return DataTables::of($fabrics)
            ->addColumn('fabric_status', function ($fabrics) {
                $fabric_status = '';
                if ($fabrics->fabric_status == 0) {
                    $fabric_status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
                } else {
                    $fabric_status .= '<label class="badge badge-success">Active</label> &nbsp;';
                }
                return $fabric_status;
            })
            ->addColumn('action', function ($fabrics) {

                $action = '<a href="' . route('adminPanel.fabric.edit', ['id' => ev($fabrics->fabric_id)]) . '" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';

                return $action;
            })
            // ->addColumn('fabric_order', function ($fabrics) {

            //     $order .= "<input type='number' name=id[] value='" . $fabrics->fabric_id . "' hidden/>";
            //     $order .= "<input type='number' name=order[] title = 'Enter only positive number'  class='form-control text-left' value='" . $fabrics->fabric_order . "' min='0'/>";

            //     return $order;
            // })
            ->rawColumns([
                'action'      => 'action',
                'fabric_status'      => 'fabric_status',
                // 'fabric_order'       => 'fabric_order',
            ])->addIndexColumn()->make(true);
    }

    /**
     * Destroy.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 07 Feb 2020
     */
    public function destroy(Request $request)
    {
        $ids            = $request['ids'];
        $productFabric  = ProductFabric::withTrashed()->whereIn('fabric_id', $ids)->get();
        if (count($productFabric) == 0) {
            $fabric = Fabric::whereIn('fabric_id', $ids)->delete();
            // Set response
            if ($fabric == true) {
                $response = [
                    '_status'  => true,
                    '_message' => __('messages.record_deleted', ['record' => 'Fabric']),
                    '_type'    => 'success'
                ];
            } else {
                $response = [
                    '_status'  => false,
                    '_message' => __('messages.record_failed', ['record' => 'Fabric']),
                    '_type'    => 'error'
                ];
            }
            //-------------
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.cannot_delete_foreign_key', ['record' => 'Fabric']),
                '_type'    => 'error'
            ];
        }
        return response()->json($response, 200);
    }
    /**
     * View create Category.
     *
     * @author Bhagirath
     * @create_at 07-Feb-2020
     */
    public function create()
    {
        return view('admin-panel.fabric.create');
    }

    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 10 Feb 2020
     */
    public function changeStatus(Request $request)
    {

        foreach ($request['ids'] as $value) {
            $fabric = Fabric::find($value);
            if ($fabric->fabric_status == 1) {
                $fabric->fabric_status = 0;
                $fabric->save();
            } else {
                $fabric->fabric_status = 1;
                $fabric->save();
            }
        }
        // Set response
        if (!is_null($fabric)) {
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
     * View edit Fabric.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Bhagirath
     * @created_at 26 Feb 2020
     */
    public function edit(Request $request, $id)
    {
        $fabric = Fabric::where('fabric_id', dv($id))->first();
        $this->viewData['fabric'] = $fabric;
        return view('admin-panel.fabric.edit')->with($this->viewData);
    }
    /**
     * Update Fabric.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function update(ValidateFabric $request, $id)
    {

        $user             = auth()->user();
        $Fabric         = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Fabric
        try {

            // Update data
            $data = [
                'fabric_name'              => ucwords($request['fabric_name']),
            ];
            //---------

            $Fabric = Fabric::find(dv($id))->update($data);
            DB::commit();
        } catch (\Exception $e) {
            $Fabric          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if ($Fabric == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Fabric']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.fabric.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Fabric']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.fabric.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     * Change order.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 16 April 2020
     */
    public function changeOrder(Request $request)
    {

        foreach ($request['id'] as $key => $value) {
            DB::beginTransaction();
            try {
                $fabric = Fabric::find($value);
                if ($request['order'][$key] < 0) {
                    $fabric->fabric_order = 0;
                } else {
                    $fabric->fabric_order = $request['order'][$key] ?? 0;
                }
                $fabric->save();
                DB::commit();
            } catch (\Exception $e) {
                $fabric          = null;
                $error_message   = $e->getMessage();
                DB::rollback();
            }
        }
        if ($fabric == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.order_updated', ['record' => 'Fabric']),
                '_type'    => 'success'
            ];
            //-----------------=
            return redirect()->back()->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.order_updation_failed', ['record' => 'Fabric']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->back()->withInput()->with(['notification' => $notification]);
        }
    }
}
