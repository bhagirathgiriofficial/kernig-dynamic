<?php

namespace App\Http\Controllers\AdminPanel;

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\Faq\Faq;
use Zend\Diactoros\Response;
use App\Http\Requests\AdminPanel\ValidateFaq;

class FaqController extends Controller
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
     * View Faqs
     * @author Bhagirath
     * @create_at 10-Feb-2020
     */

    public function index()
    {
        return view('admin-panel.faq.index');
    }

    /**
     * View Create Faq.
     *
     * @author Bhagirath
     * @create_at 10 -Feb- 2020
     */
    public function create()
    {
        return view('admin-panel.faq.create');
    }

    /**
     * Check Faq Name.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 09 Feb 2020
     */
    public function checkQuestion(Request $request)
    {
        $status = false;
        if (!is_null($request->faq_question)) {
            $faq = Faq::where('faq_question', $request['faq_question'])->first();

            if (!is_null($faq)) {
                if ($request->filled('id') && $faq->faq_id == dv($request['id'])) {
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
     * Store Faq.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 10 Feb 2020
     */
    public function store(ValidateFaq $request)
    {
        $user                = auth()->user();
        $faq                 = false;
        $error_message       = null;

        DB::beginTransaction();
        // Create Measurment
        try {
            // Set data
            $data = [
                'faq_question' => ucfirst($request['faq_question']),
                'faq_answer'   => ucfirst($request['faq_answer']),
            ];
            //---------
            $faq = Faq::create($data);
            DB::commit();
        } catch (\Exception $e) {
            $faq          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------

        if (!is_null($faq)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'Faq']),
                '_type'    => 'success'
            ];
            //-----------------

            return redirect()->route('adminPanel.faq.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'Faq']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.faq.create')->withInput()->with(['notification' => $notification]);
        }
    }
    /**
     * Get Faq list.
     *
     * @return response
     *
     * @author Bhagirath
     * @created_at 10 Feb 2020
     */
    public function getFaqs(Request $request)
    {
        $auth_user = auth()->user();
        $faq = Faq::where(function ($query) use ($request, $auth_user) {
            if (!empty($request) && !empty($request->input('faq_question'))) {
                $query->whereRaw('lower(faq_question) LIKE ? ', [trim(strtolower('%' . $request->input('faq_question'))) . '%']);
            }
        })->orderBy('faq_id', 'DESC')->get();
        return DataTables::of($faq)
            ->addColumn('status', function ($faq) {
                $status = '';
                if ($faq->faq_status == 0) {
                    $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
                } else {
                    $status .= '<label class="badge badge-success">Active</label> &nbsp;';
                }
                return $status;
            })
            ->addColumn('action', function ($faq) {

                $action = '<a href="' . route('adminPanel.faq.edit', ['id' => ev($faq->faq_id)]) . '" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
                return $action;
            })
            ->addColumn('faq_answer', function ($faq) {
                return $faq->faq_answer;
            })
            ->rawColumns([
                'action'                 => 'action',
                'status'                 => 'status',
                'faq_answer'             => 'faq_answer',
            ])->addIndexColumn()->make(true);
    }

    /**
     * Destroy.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 10 Feb 2020
     */
    public function destroy(Request $request)
    {
        $faq         = Faq::whereIn('faq_id', $request['ids'])->delete();
        // Set response
        if ($faq == true) {
            $response = [
                '_status'  => true,
                '_message' => __('messages.record_deleted', ['record' => 'Faq']),
                '_type'    => 'success'
            ];
        } else {
            $response = [
                '_status'  => false,
                '_message' => __('messages.record_failed', ['record' => 'Faq']),
                '_type'    => 'error'
            ];
        }
        //-------------
        return response()->json($response, 200);
    }
    /**
     * Change status.
     *
     * @return boolean
     *
     * @author Bhagirath
     * @created_at 12 Feb 2020
     */
    public function changeStatus(Request $request)
    {
        foreach ($request['ids'] as $value) {
            $faq = Faq::find($value);
            if ($faq->faq_status == 1) {
                $faq->faq_status = 0;
                $faq->save();
            } else {
                $faq->faq_status = 1;
                $faq->save();
            }
        }


        // Set response
        if (!is_null($faq)) {
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
     * View edit Faq.
     *
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *
     * @author Bhagirath
     * @created_at 28 Feb 2020
     */
    public function edit(Request $request, $id)
    {
        $faq = Faq::where('faq_id', dv($id))->first();
        $this->viewData['faq'] = $faq;
        return view('admin-panel.faq.edit')->with($this->viewData);
    }
    /**
     * Update Faq.
     *
     * @return mixed
     *
     * @author Bhagirath
     * @created_at 20 Feb 2020
     */
    public function update(ValidateFaq $request, $id)
    {

        $user             = auth()->user();
        $faq              = false;
        $error_message    = null;

        DB::beginTransaction();

        // Update Faq
        try {
            // Set data
            $data = [
                'faq_question' => ucfirst($request['faq_question']),
                'faq_answer'   => ucfirst($request['faq_answer']),
            ];
            //---------
            $faq = Faq::find(dv($id))->update($data);
            DB::commit();
            //---------
        } catch (\Exception $e) {
            $faq          = null;
            $error_message   = $e->getMessage();
            DB::rollback();
        }
        //----------------------
        if ($faq == true) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'Faq']),
                '_type'    => 'success'
            ];
            //-----------------=
            return redirect()->route('adminPanel.faq.index')->with(['notification' => $notification]);
        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'Faq']),
                '_type'    => 'error'
            ];
            //-----------------
            return redirect()->route('adminPanel.faq.edit', ['id' => $id])->withInput()->with(['notification' => $notification]);
        }
    }
}
