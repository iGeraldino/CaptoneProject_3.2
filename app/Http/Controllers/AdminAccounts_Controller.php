<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AdminTable;
use Validator;
use App\admin_accts;
use App\Http\Requests;
use Session;
use Auth;
use App\User;
use App\Admin;
use Carbon\Carbon;

class AdminAccounts_Controller extends Controller
{

    function encrypt($string,$key){

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = auth() ->guard('admins');

        if($admin -> check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Accounts = DB::select('call view_AdminAccounts()');


            return view('Administrators/Creating_AdminAcct')
                ->with('Accts',$Accounts);

        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $admin = auth() ->guard('admins');



        if($admin -> check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{

        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        /*
        echo $request->Fname.'__';
        echo $request->Lname.'__';
        echo $request->email.'__';
        echo $request->contactNumber.'__';
        echo $request->passField.'__';
        echo .$request->confirmPassField.'__';*/


        $admin = auth() ->guard('admins');

        $usertype = $request-> admintype;
        $typeuser = "";

        if ($usertype == 1){
            $typeuser = "admin";
        }
        elseif ($usertype == 2){
            $typeuser = "cashier";

        }
        elseif ($usertype == 3){
            $typeuser = "warehouseman";
        }


        if($admin -> check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
         else {


               $validator = validator::make($request -> all(), [
              'email' => 'email|required|unique:admins',
              'passField' => 'required|min:4',
              'Fname' => 'required',
              'Lname' => 'required',
              'username' => 'required|unique:admins',
              'contact_Num' => 'required|unique:administrator_table'
            ]);


             if($validator -> fails()){
                       Session::put('Adding_newAdminSession','Fail');
                       return redirect() -> route('Admins.index')
                       ->withErrors($validator);
                       //->withInput();
             }
             else {
                 $AdminRec = new AdminTable;
                 $AdminRec->FName = trim($request->Fname);
                 $AdminRec->LName = trim($request->Lname);
                 $AdminRec->email_address = trim($request->email);
                 $AdminRec->contact_Num = trim($request->contact_Num);
                 $AdminRec->type = $typeuser;

                 $AdminRec->save();
                 $current = Carbon::now('Asia/Manila');
                 $acct = db::table('admins')->insert([

                   'email' => trim($AdminRec->email_address),
                   'password' => trim(bcrypt($request->passField)),
                   'username' => trim($request->username),
                   'type' => $usertype,//this means that this is an admin account
                   'Admin_ID' => $AdminRec->Admin_Id,
                   'created_at' => $current,
                   'updated_at' => $current

                 ]);



                /*
                 $acct = new Admin;
                 $acct->email = trim($AdminRec->email_address);
                 $acct->password = trim(bcrypt($request->passField));
                 $acct->username = trim($request->username);
                 $acct->type = $usertype;//this means that this is an admin account
                 $acct->Admin_ID = $AdminRec->Admin_Id;

                 dd($acct->save());*/

                  Session::put('Adding_newAdminSession','Successful');
                 return redirect()->route('Admins.index');
             }
         }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        //echo $id;
        $admin = auth() ->guard('admins');

        if($admin -> check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
        $AcctDet = DB::select('CALL Specific_Admin(?)',array($id));

        $Exist =   Db::table('Users')->where('id' , '<>' , $id)->get();
        return view('Administrators.Edit_Account')
        ->with('AdminAcct',$AcctDet)
        ->with('Exist', $Exist);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $firstname = trim($request->Fname);
        $lastname = trim($request->Lname);
        $contact = trim($request->contact_Num);
        $type = trim($request->admintype);
        $username = trim($request->username);
        $email = trim($request->email);
        $password = trim($request->passField);
        $admintype = "";

        //user account

        $admin = auth()->guard('admins');

        if ($type == 1 ){

            $admintype = "Admin";

        }
        elseif( $type == 2){

            $admintype = "Cashier";

        }
        elseif(type == 3 ){

            $admintype = "Warehouse Man";

        }




        //Succession

        if( count (AdminTable::where('email_address', '=', $email)->where('Admin_Id','!=',$admin->user()->Admin_ID) ->get()) <= 0) {


            db::table('administrator_table')
                ->where('Admin_Id', $id)
                ->update([

                    'FName' => $firstname,
                    'LName' => $lastname,
                    'contact_Num' => $contact,
                    'email_address' => $email,
                    'type' => $admintype,

                ]);

            db::table('admins')
                ->where('Admin_ID', $id)
                ->update([

                    'email' => $email,
                    'username' => $username,
                    'password' => bcrypt($password),
                    'type' => $type
                ]);

            return redirect() -> route('Admins.index');



        }

        else{


            return redirect() -> route('editAdminAcct', ['id' => $admin->user()->Admin_ID]);


        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        //echo $id;

        if(auth::guard('admins')->check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
            $Deletion = DB::select('CALL Account_adminDeletion(?)',array($id));
           // $Deletion2 = DB::select('CALL delete_AdminAcct(?)',array($id));
            Session::put('DeletionSession','Successful');
            return redirect() -> route('Admins.index');
        }
    }

    public function postSignin(Request $request){

        /*if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password') , 'type' => "0" ])){

              return redirect() -> route('homepages');

          }
          else if(Auth::attempt(['username' => $request->input('email'), 'password' => $request->input('password')])){

              return redirect() -> route('homepages');
          }
          else{
            return redirect() -> back();
          }
    */


          if(Auth::guard('admins')-> attempt(['username' => $request->input('email'), 'password' =>$request->input('password'), 'type' => '1'])){
            return redirect() -> route('dashboard');
          }
          else if(Auth::guard('admins')-> attempt(['email' => $request->input('email'), 'password' =>$request->input('password'), 'type' => 1])){
              return redirect() -> route('dashboard');
          }
          else if(Auth::guard('admins')-> attempt(['email' => $request->input('email'), 'password' =>$request->input('password'), 'type' => 2])){
              return redirect() -> route('dashboard');
          }
          else if(Auth::guard('admins')-> attempt(['username' => $request->input('email'), 'password' =>$request->input('password'), 'type' => 2])){
              return redirect() -> route('dashboard');
          }
          else if(Auth::guard('admins')-> attempt(['email' => $request->input('email'), 'password' =>$request->input('password'), 'type' => 3])){
              return redirect() -> route('dashboard');
          }
          else if(Auth::guard('admins')-> attempt(['email' => $request->input('email'), 'password' =>$request->input('password'), 'type' => 3])){
              return redirect() -> route('dashboard');
          }



          else{
              Session::put('loginSession','invalid');
              return redirect() -> back();
          }



    }

    public function AdminPostSignup(Request $request)
    {


        $randomcode = rand(1, 9999);
        $code = 0;
        $rancode = intval($request->randomcode);

        $admin = auth()->guard('admins');

        $randexist = db::table('admins')->where('Random_Code', $randomcode)->select('Random_Code')->get();

        foreach ($randexist as $existcode) {
            $code = $existcode->Random_Code;
        }

        $admintableexist = db::table('admins')->get();

        if ($admintableexist == null and $request->randomcode == "1234") {

            if ($code == $randomcode) {


                $newcode = $randomcode + 1;



                $validator = validator::make($request->all(), [
                    'email' => 'email|required|unique:admins',
                    'username' => 'required|unique:admins',

                ]);


                if ($validator->fails()) {
                    Session::put('Adding_newAdminSession', 'Fail');
                    return redirect()->route('AdminSignup')
                        ->withErrors($validator);
                    //->withInput();
                } else {

                    $AdminRec = new AdminTable;
                    $AdminRec->FName = trim($request->fname);
                    $AdminRec->LName = trim($request->lname);
                    $AdminRec->email_address = trim($request->email);
                    $AdminRec->contact_Num = trim($request->contno);
                    $AdminRec->type = 'admin';

                    $AdminRec->save();


                    $acct = new Admin;
                    $acct->email = trim($request->email);
                    $acct->password = trim(bcrypt($request->password));
                    $acct->username = trim($request->username);
                    $acct->type = $request->admintype;//this means that this is an admin account
                    $acct->Random_Code = $newcode;
                    $acct->Admin_ID = $AdminRec->Admin_Id;
                    $acct->save();
                    $admin->login($acct);
                    Session::put('Adding_newAdminSession', 'Successful');
                    return redirect()->route('dashboard');
                }
            }

        else{



            $validator = validator::make($request->all(), [
                'email' => 'email|required|unique:admins',
                'username' => 'required|unique:admins',

            ]);


            if ($validator->fails()) {
                Session::put('Adding_newAdminSession', 'Fail');
                return redirect()->route('AdminSignup')
                    ->withErrors($validator);
                //->withInput();
            } else {


                $AdminRec = new AdminTable;
                $AdminRec->FName = trim($request->fname);
                $AdminRec->LName = trim($request->lname);
                $AdminRec->email_address = trim($request->email);
                $AdminRec->contact_Num = trim($request->contno);
                $AdminRec->type = 'admin';

                $AdminRec->save();


                $acct = new Admin;
                $acct->email = trim($request->email);
                $acct->password = trim(bcrypt($request->password));
                $acct->username = trim($request->username);
                $acct->type = $request->admintype;//this means that this is an admin account
                $acct->Random_Code = $randomcode;
                $acct->Admin_ID = $AdminRec->Admin_Id;
                $acct->save();
                $admin->login($acct);
                Session::put('Adding_newAdminSession', 'Successful');
                return redirect()->route('dashboard');


            }

        }


        } elseif ($admintableexist <> null and $request->randomcode == "1234") {

            dd("table is null and code is 1234", $rancode);

        } elseif ($admintableexist <> null and $request->randomcode <> "1234") {

            $randomcodeexist = db::table('admins')->where('Random_Code', '=', $rancode)->get();

            if ($randomcodeexist == null) {
                dd("di kita mahal"); // Swal pag kasi di makita yung value ng code sa loob
            } else {

                foreach ($randomcodeexist as $randcodeexist) {

                    $randcode = $randcodeexist->Random_Code;

                    if ($randcode == $rancode) {

                        if ($code == $randomcode) {

                            $newcode = $randomcode + 1;


                            $validator = validator::make($request->all(), [
                                'email' => 'email|required|unique:admins',
                                'username' => 'required|unique:admins',

                            ]);


                            if ($validator->fails()) {
                                Session::put('Adding_newAdminSession', 'Fail');
                                return redirect()->route('AdminSignup')
                                    ->withErrors($validator);
                                //->withInput();
                            } else {


                                $AdminRec = new AdminTable;
                                $AdminRec->FName = trim($request->fname);
                                $AdminRec->LName = trim($request->lname);
                                $AdminRec->email_address = trim($request->email);
                                $AdminRec->contact_Num = trim($request->contno);
                                $AdminRec->type = 'admin';

                                $AdminRec->save();


                                $acct = new Admin;
                                $acct->email = trim($request->email);
                                $acct->password = trim(bcrypt($request->password));
                                $acct->username = trim($request->username);
                                $acct->type = $request->admintype;//this means that this is an admin account
                                $acct->Random_Code = $newcode;
                                $acct->Admin_ID = $AdminRec->Admin_Id;
                                $acct->save();
                                $admin->login($acct);
                                Session::put('Adding_newAdminSession', 'Successful');
                                return redirect()->route('dashboard');
                            }
                        } else {

                            $validator = validator::make($request->all(), [
                                'email' => 'email|required|unique:admins',
                                'username' => 'required|unique:admins',

                            ]);


                            if ($validator->fails()) {
                                Session::put('Adding_newAdminSession', 'Fail');
                                return redirect()->route('AdminSignup')
                                    ->withErrors($validator);
                                //->withInput();
                            } else {


                                $AdminRec = new AdminTable;
                                $AdminRec->FName = trim($request->fname);
                                $AdminRec->LName = trim($request->lname);
                                $AdminRec->email_address = trim($request->email);
                                $AdminRec->contact_Num = trim($request->contno);
                                $AdminRec->type = 'admin';

                                $AdminRec->save();


                                $acct = new Admin;
                                $acct->email = trim($request->email);
                                $acct->password = trim(bcrypt($request->password));
                                $acct->username = trim($request->username);
                                $acct->type = $request->admintype;//this means that this is an admin account
                                $acct->Random_Code = $randomcode;
                                $acct->Admin_ID = $AdminRec->Admin_Id;
                                $acct->save();
                                $admin->login($acct);
                                Session::put('Adding_newAdminSession', 'Successful');
                                return redirect()->route('dashboard');

                            }

                        }
                    }

                    }


                }


            }


        }

        public function AdminPostSignin(Request $request){

            if(Auth::guard('admins')-> attempt(['username' => $request->input('email'), 'password' =>$request->input('password'), 'type' => '1'])){
                return redirect() -> route('dashboard');
            }
            else if(Auth::guard('admins')-> attempt(['email' => $request->input('email'), 'password' =>$request->input('password'), 'type' => 1])){
                return redirect() -> route('dashboard');
            }

            else{
                return redirect() -> route('AdminLogin');
            }

        }









    public function AdminLogout(){

        Auth::guard('admins')->logout();
        Session::put('loginSession','OUT');
        return redirect() -> route('AdminLogin');


    }
}
