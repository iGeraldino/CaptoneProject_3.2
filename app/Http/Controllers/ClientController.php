<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Db;
use App\Http\Controllers\Controller;
use App\bouquet_details;
use Validator;
use App\User;
use Alert;
use Auth;
use Cart;
use App\customer_details;
use Session;

use App\Http\Requests;

class ClientController extends Controller
{

        public function flowerlist(){

              $flowerlist = DB::select("CALL Viewing_Flowers_With_UpdatedPrice()");
              return view('customer_side.pages.flower')
              ->with('flowerlist', $flowerlist);
        }



        public function getSignup(){
              $cities = DB::table('cities')
              ->select('*')
              ->get();

              $province = DB::table('provinces')
              ->select('*')
                  ->get();
              
              return view('customer_side.pages.register')
              ->with('city',$cities)
              ->with('province',$province);
        }

        public function postSignup(Request $request){

            /*  $this->validate($request, [
                  'email' => 'email|required|unique:users',
                  'password' => 'required|min:4',
                  'fname' => 'required',
                  'lname' => 'required',
                  'username' => 'required',
                  'contact' => 'required'
              ]); */

              $cities = DB::table('cities')
              ->select('*')
              ->get();

              $province = DB::table('provinces')
              ->select('*')
              ->get();

              $validator = validator::make($request -> all(), [

                'email' => 'email|required|unique:users',
                'password' => 'required|min:4',
                'fname' => 'required',
                'lname' => 'required',
                'username' => 'required',
                'contact' => 'required'


              ]);

              if($validator -> fails()){

                return redirect('/register')
                        ->withErrors($validator)
                        ->withInput();
              }

              $id = DB::table('customer_details')->insertGetId([

                  'Cust_FName' => $request->input('fname'),
                  'Cust_MName' => $request->input('mname'),
                  'Cust_LName' => $request->input('lname'),
                  'Contact_Num' => $request->input('contact'),
                  'Email_Address' => $request-> input('email'),
                  'Address_Line' => $request->input('addr_line'),
                  'Baranggay' => $request->input('brgy'),
                  'Town' => $request->input('TownField'),
                  'Province' => $request->input('ProvinceField')

              ]);


              $user = new User([
                  'email' => $request -> input('email'),
                  'password' => bcrypt($request -> input('password')),
                  'Cust_ID' => $id,
                  'username' => $request -> input('username'),
                  'type' => "0",

              ]);

              $user -> save();

              Auth::login($user);

              return redirect() -> route('homepages');



        }

        public function getSignin(){

            $usernames = db::table('users')->get();


            return view('customer_side.pages.loginx') -> with('usernames', $usernames);
          }

        public function postSignin(Request $request){

          /*$validator = validator::make($request -> all(), [

            'email' => 'email|required',
            'password' => 'required|min:4',
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'contact' => 'required'


          ]);

          if($validator -> fails()){

            return redirect('/login')
                    ->withErrors($validator)
                    ->withInput();



          }*/

        


          
          if(Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 
            'type' => 0])){

              return redirect() -> route('homepages');

          }
          else if(Auth::attempt(['username' => $request->input('email'), 'password' => $request->input('password'),'type' => 0 ])){

              return redirect() -> route('homepages');
          }
          else{
            return redirect() -> back();
          }
          

        }

        public function getLogout(){
          Auth::logout();
          Cart::instance('finalboqcart')->destroy();
          Cart::instance('finalflowerbqt')->destroy();
          Cart::instance('finalacccart')->destroy();
          Cart::instance('flowerwish')->destroy();
          return redirect() -> route('homepages');
        }

        public function bouquetlist(){
          //Cart::instance('tempacccart')->destroy();
          $bouquetlist = db::table('bouquet_details')->where('Type', '=' , 'default')->get();

          return view('customer_side.pages.bouquet') ->with('bouquetlist', $bouquetlist);


        }


        public function getEditAccount(){

          $cities = DB::table('cities')
              ->select('*')
              ->get();

          $province = DB::table('provinces')
              ->select('*')
                  ->get();
              


          $id = Auth::user() -> Cust_ID ;

           

          $details = db::table('customer_details')->where('Cust_ID', '=' , $id)->get();
          $account = db::table('users')->where('Cust_ID', '=' , $id)->get();

          //dd($details);
          return view('customer_side.pages.editaccount')
          ->with('details', $details)
          ->with('cities', $cities)
          ->with('province', $province)
          ->with('account', $account);    

        }

        public function postEditAccount(Request $request, $id){

            //account details

            $firstname = trim($request->fname);
            $middlename = trim($request->mname);
            $lastname = trim($request->lname);
            $contact = trim($request->contact);
            $addrline = trim($request->addr_line);
            $brgy = trim($request->brgy);
            $prov = trim($request->Prov);
            $town = trim($request->Town);


            //user account

            $email = trim($request->email);
            $username = trim($request->email);

            $cust = customer_details::find($id);



            $existingEmail = db::table('customer_details')->where('Email_Address', '!=' , $email)->select('Email_Address as email')->get();

            foreach($existingEmail as $exist){
                if($cust -> Email_Address = $email and $exist != $email){

                    $cust -> Cust_FName = $firstname;
                    $cust -> Cust_MName = $middlename;
                    $cust -> Cust_LName = $lastname;
                    $cust -> Contact_Num = $contact;
                    $cust -> Email_Address = $email;
                    $cust -> Address_Line = $addrline;
                    $cust -> Baranggay = $brgy;
                    $cust -> Town = $town;
                    $cust -> Province = $prov;



                    //$cust ->save();



                    $user -> email = $email;
                    $user -> username = $username;

                    $user->save();


                    dd('Nasave na po. Pakicheck nalang.');

                }
                else{

                    dd('Hindi Nasave');

                }


            }




        }


        

}
