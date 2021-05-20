<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use DataTables;
use App\Model\User\User;

class UserController extends Controller
{
    use UploadImage;

    /**
     * @var array
     */
    public $viewData = [];

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
     * View user list.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Sumit
     * @created_at 25 July 2019
     */
    public function index()
    {
        return view('admin-panel.users.index');
    }

    /**
     * Get user list.
     * 
     * @return response
     *  
     * @author Sumit
     * @created_at 25 July 2019
     */
    public function getUsers()
    {
        $auth_user = auth()->user();

        // Get user list
        $users = User::where('id', '!=', $auth_user->id)->whereHas('roles', function ($query) {
            $query->where('type', '!=', config('constants.users.types.STUDENT.value'));
        })->with('roles')->orderBy('id', 'DESC')->with('categories')->get();
        //--------------

        return DataTables::of($users)
        ->addColumn('image', function ($user) {
            return '<div class="text-center"><span class="avatar">'.show_user_image($user->image,$user->name).'</span></div>'; 
        })
        ->addColumn('name', function ($user){
           return ucwords($user->name);
        })
        ->addColumn('mobile', function ($user){
           return ($user->mobile_number ?? 'N/A' );
        })
        ->addColumn('role', function ($user){
           $roles = $user->getRoleNames();
           return ($roles[0] ?? 'N/A' );
        })
        ->addColumn('verified', function ($user) {
            $status = '';
            if ( is_null($user->email_verified_at) ){
                $status .= '<label class="badge badge-warning">Email not verified</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Email verified</label> &nbsp;';
            }

            if(is_null($user->mobile_number_verified_at)){
                $status .= '<label class="badge badge-warning">Mobile number not verified</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Mobile number verified</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('status', function ($user) {
            $status = '';
            if ( $user->status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($user) {
            $action = '';
            $action .= '<a href="'.route('adminPanel.users.edit', ['id' => ev($user->id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            return $action;
        })
        ->rawColumns([
            'action'    => 'action',
            'image'     => 'image',
            'verified'  => 'verified',
            'status'    => 'status',
        ])->addIndexColumn()->make(true);
    }

    /**
     * View student list.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Sumit
     * @created_at 27 July 2019
     */
    public function students()
    {
        return view('admin-panel.users.students');
    }

    /**
     * Get students list.
     * 
     * @return response
     *  
     * @author Sumit
     * @created_at 27 July 2019
     */
    public function getStudents()
    {
        $auth_user = auth()->user();

        // Get only student list
        $users = User::where('id', '!=', $auth_user->id)->whereHas('roles', function ($query) {
            $query->where('type', config('constants.users.types.STUDENT.value'));
        })->with([
            'roles',
            'categories',
            'education',
            'franchise'
        ])->orderBy('id', 'DESC')->get();
        //----------------------

        return DataTables::of($users)
        ->addColumn('image', function ($user) {
            return '<div class="text-center"><span class="avatar">'.show_user_image($user->image,$user->name).'</span></div>'; 
        })
        ->addColumn('name', function ($user){
           return ucwords($user->name);
        })
        ->addColumn('mobile', function ($user){
           return ($user->mobile_number ?? 'N/A' );
        })
        ->addColumn('franchise', function ($user){
            return ($user->franchise->name ?? 'N/A' );
        })
        ->addColumn('role', function ($user){
           $roles = $user->getRoleNames();
           return ($roles[0] ?? 'N/A' );
        })
        ->addColumn('category', function ($user) {
            if ( count($user->categories) ){
                return ($user->categories->implode('name', ', ') ?? 'N/A');
            } else {
                return 'N/A';
            }
        })
        ->addColumn('education', function ($user) {
            if ( count($user->education) ){
                return ($user->education->implode('name', ', ') ?? 'N/A');
            } else {
                return 'N/A';
            }
        })
        ->addColumn('verified', function ($user) {
            $status = '';
            if ( is_null($user->email_verified_at) ){
                $status .= '<label class="badge badge-warning">Email not verified</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Email verified</label> &nbsp;';
            }

            if(is_null($user->mobile_number_verified_at)){
                $status .= '<label class="badge badge-warning">Mobile number not verified</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Mobile number verified</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('status', function ($user) {
            $status = '';
            if ( $user->status == 0 ){
                $status .= '<label class="badge badge-warning">Inactive</label> &nbsp;';
            } else {
                $status .= '<label class="badge badge-success">Active</label> &nbsp;';
            }
            return $status;
        })
        ->addColumn('action', function ($user) {
            $action = '';
            $action .= '<a href="'.route('adminPanel.users.edit', ['id' => ev($user->id)]).'" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row" title="Edit"><i class="icon wb-edit" aria-hidden="true"></i></a>';
            return $action;
        })
        ->rawColumns([
            'action'    => 'action',
            'image'     => 'image',
            'verified'  => 'verified',
            'status'    => 'status',
        ])->addIndexColumn()->make(true);
    }

    /**
     * View create user.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Sumit
     * @created_at 22 July 2019
     */
    public function create()
    {
        // Get roles
        $roles = Role::where([ ['status', true], ['deleted_at', '=', NULL] ])->get();
        //----------

        // Get franchises
        $franchises = Franchise::active()->get();
        //----------

        // Get educations
        $educations = Education::get();
        //----------

        // Get categories with their sub categories
        $categories = Category::select('id', 'name')
            ->has('sub_categories')
            ->with(['sub_categories' => function ($query) {
                $query->select('id', 'name', 'parent_id')->active();
            }])
            ->isParent()
            ->active()
            ->get();
        //-----------------------------------------

        $this->viewData['user']               = auth()->user();
        $this->viewData['roles']              = $roles;
        $this->viewData['franchises']         = $franchises;
        $this->viewData['categories']         = $categories;
        $this->viewData['educations']         = $educations;

        return view('admin-panel.users.create')->with($this->viewData);
    }

    /**
     * Store user.
     * 
     * @return mixed
     *  
     * @author Sumit
     * @created_at 23 July 2019
     */
    public function store(ValidateUser $request)
    {
        $user          = auth()->user();
        $new_user      = false;
        $file_name     = null;
        $error_message = null;
        $new_password  = str_random(8);

        // Upload user image
        if ($request->hasFile('image')) {

            $file = $this->uploadImage($request->file('image'), config('constants.users.image_path'), 75);

            if ($file['_status']) {
                $file_name = $file['_data'];
            }
        }
        //------------------

        DB::beginTransaction();

        // Create user
        try {

            // Set data
            $data = [
                'name'          => $request['name'],
                'email'         => $request['email'],
                'password'      => bcrypt($new_password),
                'platform'      => config('constants.platforms.WEB.value'),
                'mobile_number' => $request['mobile_number'],
                'date_of_birth' => $request['date_of_birth'],
                'image'         => $file_name,
                'franchise_id'  => $request['franchise'],
                'created_by'    => $user->id,
                'updated_by'    => $user->id,
            ];
            //---------

            $new_user = User::create($data);

            if (! is_null($new_user) && $request['role_type'] == config('constants.users.types.STUDENT.value') ){

                // Create user category
                $categories_data = [];
                if (count($request['category'])){
                    foreach($request['category'] as $category){
                        $categories_data[$category] = [
                            'created_by'  => $user->id,
                            'updated_by'  => $user->id
                        ];
                    }
                    $new_user->categories()->attach($categories_data);
                }
                //----------------------

                // Create user education
                $education_data = [];
                if (count($request['education'])){
                    foreach($request['education'] as $education){
                        $education_data[$education] = [
                            'created_by'  => $user->id,
                            'updated_by'  => $user->id
                        ];
                    }
                    $new_user->education()->attach($education_data);
                }
                //----------------------
            }

            // Assign role
            $new_user->assignRole($request['role']);
            //-----------

            // Send user email with password
            $email_data = [
                'template'  => config('constants.emails_path.admin_email_path').'new-user-email',
                'data'  => [
                    'name'      => ucwords($request['name']),
                    'email'     => $request['email'],
                    'subject'   => __('subjects.user_welcome', ['app_name' => config('app.name') ]),
                    'password'  => $new_password,
                ],
            ];

            SendEmailJob::dispatch($email_data)->delay(now()->addSeconds(5));
            //-------------------------------

            // Create User log
            activity('User')
                ->withProperties($data)
                ->log($request['role_type'].' Created');
            //-----------

            DB::commit();
        } catch (\Exception $e) {
            $new_user      = null;
            $error_message = $e->getMessage();
            DB::rollback();
        }
        //------------

        if (! is_null($new_user)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.record_created', ['record' => 'User']),
                '_type'    => 'success'
            ];
            //-----------------

            if ( $request['role_type'] == config('constants.users.types.STUDENT.value') ){
                return redirect()->route('adminPanel.users.students')->with(['notification' => $notification]);
            } else {
                return redirect()->route('adminPanel.users.index')->with(['notification' => $notification]);
            }

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.record_creation_failed', ['record' => 'User']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.users.create')->withInput()->with(['notification' => $notification]);
        }
    }

    /**
     * View edit user.
     * 
     * @return \Illuminate\View\View|\Illuminate\Contracts\View\Factory
     *  
     * @author Sumit
     * @created_at 27 July 2019
     */
    public function edit(Request $request, $id = null)
    {   
        $user = User::where('id', dv($id))
                ->with('categories')
                ->with('education')
                ->with('franchise')->first();

        // Get roles
        $roles = Role::where([ ['status', true], ['deleted_at', '=', NULL] ])->get();
        //----------

        // Get franchises
        $franchises = Franchise::active()->get();
        //----------

        // Get educations
        $educations = Education::get();
        //---------------

        // Get categories with their sub categories
        $categories = Category::select('id', 'name')
            ->has('sub_categories')
            ->with(['sub_categories' => function ($query) {
                $query->select('id', 'name', 'parent_id')->active();
            }])
            ->isParent()
            ->active()
            ->get();
        //-----------------------------------------

        // Get user role
        $user->getRoleNames();
        //--------------

        $this->viewData['user']               = $user;
        $this->viewData['roles']              = $roles;
        $this->viewData['franchises']         = $franchises;
        $this->viewData['categories']         = $categories;
        $this->viewData['educations']         = $educations;

        return view('admin-panel.users.edit')->with($this->viewData);
        
    }

    /**
     * Update user.
     * 
     * @return mixed
     *  
     * @author Sumit
     * @created_at 30 July 2019
     */
    public function update(ValidateUser $request, $id)
    {
        $user          = User::where('id', dv($id))->first();
        $auth_user     = auth()->user();
        $user_updated  = false;
        $file_name     = null;
        $error_message = null;

        // Upload user image
        if ($request->hasFile('image')) {

            // Remove old image
            if (!is_null($user->image)) {
                delete_image(config('constants.users.image_path'),$user->image);
            }
            //-----------------

            $file = $this->uploadImage($request->file('image'), config('constants.users.image_path'), 75);

            if ($file['_status']) {
                $file_name = $file['_data'];
            }
        }
        //------------------

        DB::beginTransaction();

        // Create user
        try {

            // Set data
            $data = [
                'name'          => $request['name'],
                'mobile_number' => $request['mobile_number'],
                'date_of_birth' => $request['date_of_birth'],
                'franchise_id'  => $request['franchise'],
                'updated_by'    => $auth_user->id,
            ];
            //---------

            $user->name          = $request['name'];
            $user->mobile_number = $request['mobile_number'];
            $user->date_of_birth = $request['date_of_birth'];
            $user->franchise_id  = $request['franchise'];
            $user->updated_by    = $auth_user->id;

            // Set image
            if (! is_null($file_name)) {
                $data['image'] = $file_name;
                $user->image   = $file_name;
            }
            //----------

            $user_updated = $user->save();

            if (! is_null($user_updated) && $request['role_type'] == config('constants.users.types.STUDENT.value') ){

                // Create user category
                $categories_data = [];
                if (count($request['category'])){
                    foreach($request['category'] as $category){
                        $categories_data[$category] = [
                            'updated_by'  => $auth_user->id
                        ];
                    }
                    $user->categories()->sync($categories_data);
                }
                //----------------------

                // Create user education
                $education_data = [];
                if (count($request['education'])){
                    foreach($request['education'] as $education){
                        $education_data[$education] = [
                            'updated_by'  => $auth_user->id
                        ];
                    }
                    $user->education()->sync($education_data);
                }
                //----------------------

            }

            // Assign role
            $user->syncRoles([$request['role']]);
            //-----------

            // Create User log
            activity('User')
                ->withProperties($data)
                ->log('Update');
            //-----------

            DB::commit();
        } catch (\Exception $e) {
            $user_updated  = null;
            $error_message = $e->getMessage();
            DB::rollback();
        }
        //------------

        if (! is_null($user_updated)) {
            // Set notification
            $notification = [
                '_status'  => true,
                '_message' => __('messages.records_updated', ['record' => 'User']),
                '_type'    => 'success'
            ];
            //-----------------

            if ( $request['role_type'] == config('constants.users.types.STUDENT.value') ){
                return redirect()->route('adminPanel.users.students')->with(['notification' => $notification]);
            } else {
                return redirect()->route('adminPanel.users.index')->with(['notification' => $notification]);
            }

        } else {
            // Set notification
            $notification = [
                '_status'  => false,
                '_message' => $error_message ?? __('messages.records_updation_failed', ['record' => 'User']),
                '_type'    => 'error'
            ];
            //-----------------

            return redirect()->route('adminPanel.users.edit', ['id' => ev($user->id)])->withInput()->with(['notification' => $notification]);
        }
    }
    

    /**
     * Check user email.
     * 
     * @return boolean
     *  
     * @author Sumit
     * @created_at 24 July 2019
     */
    public function checkUserEmail(Request $request)
    {
        $status = false;

        if (! is_null($request->email)) {
            $user = User::where('email', $request['email'])->first();

            if (! is_null($user)) {
                if ($request->filled('id') && $user->id == $request['id']) {
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
     * Check user mobile.
     * 
     * @return boolean
     *  
     * @author Sumit
     * @created_at 24 July 2019
     */
    public function checkUserMobile(Request $request)
    {
        $status = false;
        if (!is_null($request->mobile_number)) {
            $user = User::where('mobile_number', $request['mobile_number'])->first();

            if(!is_null($user)){
                if ($request->filled('id') && $user->id == $request['id']) {
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
     * Change status.
     * 
     * @return boolean
     *  
     * @author Sumit
     * @created_at 26 July 2019
     */
    public function changeStatus(Request $request)
    {
        $user = User::toggleStatus($request['ids']);

        // Create User log
        activity('User')
            ->withProperties($request['ids'])
            ->log('Status Changed');
        //-----------

        // Set response
        if (!is_null($user)) {
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
}

