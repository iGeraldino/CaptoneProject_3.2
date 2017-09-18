<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\AdminTable;
use App\Http\Requests;
use Response;
class Validator_Controller extends Controller
{
    //
    
	public function CheckEmail_Existence(Request $request)
    {
        $emailExistence = User::where('email', '=', "{$request->input('email')}")
	    ->where('email', '<>', "{$request->input('orig_email')}")
        ->get();


        $exists = count($emailExistence) > 0 ? true : false;


        return Response::json(!$exists);
    }//end of function


	public function CheckUsername_Existence(Request $request)
    {
        $UsernameExistence = User::where('username', '=', "{$request->input('username')}")
	    ->where('username', '<>', "{$request->input('orig_username')}")
        ->get();


        $exists = count($UsernameExistence) > 0 ? true : false;

        return Response::json(!$exists);
    }//end of function

    public function Contact_Existence(Request $request)
    {
        $ContactExistence = AdminTable::where('contact_Num', '=', "{$request->input('Num')}")
	    //->where('contact_Num', '<>', "{$request->input('orig_contact')}")
        ->get();


        $exists = count($ContactExistence) > 0 ? true : false;

        return Response::json(!$exists);
    }//end of function


}
