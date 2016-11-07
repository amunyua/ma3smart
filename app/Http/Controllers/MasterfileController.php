<?php

namespace App\Http\Controllers;

use App\Contact;
use App\ContactTypes;
use App\County;
use App\Masterfile;
use App\Role;
use App\Form;
use App\Stream;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;

class MasterfileController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user_role = Role::where('role_code','SYS_ADMIN')->first();
        $role_id =$user_role->id;
        if($this->user()->user_role != $role_id) {
            $roles = Role::where([
                ['role_code', '<>', 'SYS_ADMIN'],
                ['role_code', '<>', 'SACCO']
            ])->get();
        }else{
            $roles = Role::where('role_code', '<>', 'SYS_ADMIN')->get();
        }
        $main_ctype = 1;
        $counties =1;
//        $streams = Stream::where('stream_status', 1)->get();

        return view('registration.index', array(
            'roles' => $roles,
            'main_ctype' => $main_ctype,
            'counties' => $counties,
//            'streams' => $streams
        ));
    }

    public function storeMasterfile(Request $request){
//        var_dump($_POST);die;
        $rules = array(
            'role' => 'required',
            'id_no' => 'required|max:8|unique:masterfiles,id_no',
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'phone_number'=>'required',
            'email'=>'required|unique:contacts,email'
//            'regdate' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
            $role = Role::where('role_code', Input::get('role_code'))->first();

            // create registration
                $reg = new Masterfile();
                $reg->surname = Input::get('surname');
                $reg->firstname = Input::get('firstname');
                $reg->middlename = Input::get('middlename');
                $reg->id_no = Input::get('id_no');
                $reg->user_role = Input::get('role');
                $reg->b_role = 'Owner';
                $reg->save();
                $reg_id = $reg->id;

                 // create contact
                $contact = new Contact();
                $contact->city = Input::get('city');
                $contact->postal_address =  Input::get('postal_address');
                $contact->physical_address =  Input::get('physical_address');
                $contact->masterfile_id =  $reg_id;
                $contact->phone_number =  Input::get('phone_number');
                $contact->email =  Input::get('email');
                $contact->mobile_no =  Input::get('mobile_no');
                $contact->save();
            if(Input::get('role')== 'owner') {
                // create user login account
                $password = bcrypt(123456);
                $login = new User();
                $login->masterfile_id = $reg_id;
                $login->email =Input::get('email');
                $login->phone_no = Input::get('phone_no');
                $login->password = $password;
                $login->user_role = 1;
                $login->save();
            }
            Session::flash('success','The masterFile has been created');
        });
//        return redirect('all-masterfiles');
    }

    public function client(Request $request){
        $rules = array(
            'role' => 'required',
            'id_no' => 'required',
            'firstname' => 'required',
            'surname' => 'required',
            'gender' => 'required',
            'regdate' => 'required'
        );
        $this->validate($request, $rules);

        DB::transaction(function(){
            $role = Role::where('role_code', Input::get('role_code'))->first();

            // create registration
            $reg = Masterfile::create(array(
                'surname' => Input::get('surname'),
                'first_name' => Input::get('firstname'),
                'middle_name' => Input::get('middlename'),
                'regdate' => Input::get('regdate'),
                'gender' => Input::get('gender'),
                'id_no' => Input::get('id_no'),
                'b_role' => 'Staff',
                'user_role' => 1
            ));
            $reg->save();
            $reg_id = $reg->id;

            // create contact
            $contact = Contact::create(array(
                'postal_address' => Input::get('postal_address'),
                'physical_address' => Input::get('physical_address'),
                'masterfile_id' => $reg_id,
                'telephone_no' => Input::get('tel_no'),
                'email' => Input::get('email'),
                'mobile_no' => Input::get('mobile_no')
            ));
            $contact->save();

            // create user login account
            $password = sha1(123456);
            $login = User::create(array (
                'masterfile_id' => $reg_id,
                'email' => Input::get('email'),
                'phone_no' => Input::get('phone_no'),
                'password' => $password
            ));
            var_dump($login);exit;
            $login->save();
        });
    }

    public function getAllMasterfiles(){
        return view('masterfile.all-masterfiles');
    }

    public function loadMasterFiles(){
        $masterfiles = DB::table('all_masterfiles')->get();
        return Datatables::of($masterfiles)->make(true);
    }
}
