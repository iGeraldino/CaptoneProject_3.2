<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\AdminTable;
use Validator;
use App\userAcctTable;
use App\Http\Requests;
use Session;
use Auth;
use App\User;

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
        if(auth::check() == false){
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

        if(auth::check() == false){
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
        if(auth::check() == false){
            Session::put('loginSession','fail');
            return redirect() -> route('adminsignin');
        }
        else{
                    $validator = validator::make($request -> all(), [
                'email' => 'email|required|unique:users',
                'passField' => 'required|min:4',
                'Fname' => 'required',
                'Lname' => 'required',
                'username' => 'required|unique:users',
                'contact_Num' => 'required|unique:administrator_table'
              ]);



              if($validator -> fails()){
                        Session::put('Adding_newAdminSession','Fail');
                        return redirect() -> route('Admins.index')
                        ->withErrors($validator);
                        //->withInput();
              }
              else{
                    $AdminRec =  new AdminTable;
                    $AdminRec->FName = trim($request->Fname);
                    $AdminRec->LName = trim($request->Lname);
                    $AdminRec->email_address = trim($request->email);
                    $AdminRec->contact_Num = trim($request->contact_Num);
                    $AdminRec->type = 'admin';

                    $AdminRec->save();

                    $acct = new userAcctTable;
                    $acct->email = trim($AdminRec->email_address);
                    $acct->password = trim(bcrypt($request->passField));
                    $acct->username = trim($request->username);
                    $acct->type = '0';//this means that this is an admin account
                    $acct->Admin_ID = $AdminRec->Admin_Id;
                    
                    $acct->save();
                    Session::put('Adding_newAdminSession','Successful');     
                    return redirect() -> route('Admins.index');
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
        if(auth::check() == false){
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
        if(auth::check() == false){
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

          if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'type' => 0])){

            return redirect() -> route('dashboard');

          }
          else if(Auth::attempt(['username' => $request->input('email'), 'password' => $request->input('password'), 'type' => 0])){

            return redirect() -> route('dashboard');

          }
          else{
            Session::put('loginSession','invalid');
            return redirect() -> route('AdminLogin');
          }

    }

    public function AdminLogout(){

        Auth::logout();
        Session::put('loginSession','OUT');
        return redirect() -> route('AdminLogin');


    }
}
