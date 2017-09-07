@extends('main')

@section('content')
       <section class="content-header">
       <?php
          $AddingAdminSessionValue = Session::get('Adding_newAdminSession'); 
          Session::remove('Adding_newAdminSession');//determines the addition of new flower
          $DeletionAdminSessionValue = Session::get('DeletionSession'); 
          Session::remove('DeletionSession');//determines the addition of new flower
       ?>
          <h3><b>Accounts that can Access the Administrator Side</b></h3>
          <input type = "text" class = "hidden" id = "addingSessionField" value = "{{$AddingAdminSessionValue}}">
          <input type = "text" class = "hidden" id = "deletingSessionField" value = "{{$DeletionAdminSessionValue}}">
              <button class="btn btn-primary" data-toggle="modal" data-target="#addingModal">
                Create a new Admin Account
              </button>
              <!-- Sart Modal -->
                <div class="modal fade" id="addingModal" tabxindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                    <!--Form open here-->
      {!! Form::open(array('route' => 'Admins.store', 'data-parsley-validate'=>'', 'id' => 'Acctform','method'=>'POST')) !!}
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                          <i class="material-icons">clear</i>
                        </button>
                        <h4 class="modal-title">Create new Admin Account</h4>
                      </div>
                      <div class="modal-body">
                      <!--put the input tags here-->
                        <div class = "row">
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">First Name</label>
                              <input name = 'Fname' id = 'Fname' type="text" class="form-control">
                            </div>    
                          </div>
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">Last Name</label>
                              <input name = 'Lname' id = 'Lname' type="text" class="form-control">
                            </div>    
                          </div>
                        </div>

                        <div class = "row">
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">email Address</label>
                              <input name = 'email' id = 'email' type="text" class="form-control">
                              <span id = 'Emailavailability'></span>
                            </div>    
                          </div>
                          <div class = "col-md-6">
                            <div class="form-group label-floating">
                              <label class="control-label">Contact Number</label>
                              <input name = 'contact_Num' id = 'contact_Num' type="text" class="form-control">
                            </div>    
                          </div>
                        </div>

                        <div class = "row">
                          <div class = "col-md-8">
                            <div class="form-group label-floating">
                              <label class="control-label">Username</label>
                              <input name = 'username' id = 'username' type="text" class="form-control">
                            </div>    
                          </div>
                        </div>

                        <div class = "row">
                          <div class = "col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">group</i>
                              </span>
                              <input id = "passField" name = "passField" type="password" class="form-control" placeholder="password">
                            </div>
                          </div>
                          <div class = "col-md-6">
                            <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">group</i>
                              </span>
                              <input id = "confirmPassField" name = "confirmPassField" type="password" class="form-control" placeholder="Confirm Password">
                            </div>
                          </div>
                        </div>


                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-simple" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success btn-simple">Save</button>
                      </div>
<!--form close here-->
        {!! Form::close() !!}

                    </div>
                  </div>
                </div>
                <!--  End Modal -->
            <div class="card card-nav-tabs card-plain">
              <div class="header header-danger">
                <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="active"><a href="#activePrice" data-toggle="tab">Administrarors Accounts</a></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="content">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="activePrice">
                    <table id="example2" class="table table-bordered table-striped">
                      <thead>
                          <th> Acct_ID </th>
                          <th> Account Name </th>
                          <th> emailAddress </th>
                          <th> Contact Number </th>
                          <th> Date Created </th>
                          <th> Action </th>
                      </thead>

                      <tbody>
                      @foreach($Accts as $Accts)
                        <tr>  
                          <td> ACCT_{{$Accts->Acct_ID}} </td>
                          <td> {{$Accts->Fname}} {{$Accts->LName}}</td>
                          <td> {{$Accts->email}} </td>
                          <td> {{$Accts->contact}} </td>
                          <td> {{$Accts->dateCreated}} </td>
                          <td align="center"> 
                                 
                                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewPrice{{$Accts->Acct_ID}}">View</button>
                                      <!-- line modal -->
                                     <div class="modal fade" id="viewPrice{{$Accts->Acct_ID}}" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
                                         <div class="modal-dialog">
                                            <div class="modal-content">
                                               <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                                                <h3 class="modal-title" id="lineModalLabel">Account's Details</h3>
                                              </div>
                          <!--form open here-->
                                                <div class="modal-body"> 
                                            <!-- content goes here -->
                                                  <div class = "row">
                                                    <div class = "col-md-6">
                                                      <span class="label" style="font-size: 100%; background-color: #F62459">Account ID:</span>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        ACCT_{{$Accts->Acct_ID}} 
                                                    </div>                                                    
                                                  </div>
                                                  <br>
                                                  <div class = "row">
                                                    <div class = "col-md-6">
                                                      <span class="label" style="font-size: 100%; background-color: #F62459">Account Name:</span>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        {{$Accts->Fname}} {{$Accts->LName}}
                                                    </div>                                                    
                                                  </div>
                                                  <br>
                                                  <div class = "row">
                                                    <div class = "col-md-6">
                                                      <span class="label" style="font-size: 100%; background-color: #F62459">Email Address:</span>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        {{$Accts->email}}
                                                    </div>                                                    
                                                  </div>
                                                  <br>
                                                  <div class = "row">
                                                    <div class = "col-md-6">
                                                      <span class="label" style="font-size: 100%; background-color: #F62459">Contact Number:</span>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        {{$Accts->contact}}
                                                    </div>                                                    
                                                  </div>
                                                  <br>
                                                  <div class = "row">
                                                    <div class = "col-md-6">
                                                      <span class="label" style="font-size: 100%; background-color: #F62459">Username:</span>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        {{$Accts->username}}
                                                    </div>                                                    
                                                  </div>
                                                  <br>
                                                  <div class = "row">
                                                    <div class = "col-md-6">
                                                      <span class="label" style="font-size: 100%; background-color: #F62459">Date Created:</span>
                                                    </div>
                                                    <div class = "col-md-6">
                                                        {{$Accts->dateCreated}}
                                                    </div>                                                    
                                                  </div>

                                                </div>
                                                <div class="modal-footer">
                                                  <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                                                    <div class="btn-group" role="group">
                                                      <button type="button" class="btn btn-default" data-dismiss="modal"  role="button">Close</button>
                                                    </div>
                                                    <div class="btn-group" role="group">
                                                       <a  type = "button" href = "{{route('editAdminAcct',['id' => $Accts->Acct_ID])}}" name = "AddBtn" class = "btn btn-primary btn-info"><span class = "glyphicon glyphicon-pencil"></span> Edit This Price</a>
                                          
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                   <!--Form close here--> 
                                        </div>

                                  <a type = "button" href="{{route('deleteAdminAcct',['id' => $Accts->Admin_ID])}}" class = "btn btn-danger btn-sm" > 
                                    delete
                                  </a>

                                </td>

                              </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  
                </div>
              </div>
            </div>
</section>
@endsection



@section('scripts')
<script>
    $('#example2').DataTable({
    });//
    $('#example3').DataTable({
    });//

$(document).ready(function(){

  var emailURL = "{{ url('Validate_Email') }}";
  var usernameURL = "{{ url('Validate_UserName') }}";
  var contactURL = "{{ url('Validate_Contact') }}";


  //var orig_email = $('#email').val();
  $(function(){   
    $('#Acctform').validate({
      rules:{//-------------------------------------------------------------------------rules
        Fname: {
          required:true,
          namevalidation:true
        },//end of rules for fname
        Lname: {
          required:true,
          namevalidation:true
        },//end of rules for lname
        email: {
          remote: {
            type: "GET",
            url : typeof(emailURL) != 'undefined' ? emailURL : '',
            data: { 'orig_email':  typeof(orig_email) != 'undefined' ? orig_email : '', email: function(){ 
                return $('#email').val();

              } 
            },
            dataType : "json"
          },//end of remote
          required:true,
          email: true
        },//end of rules for email
        contact_Num: {
          remote: {
            type: "GET",
            url : typeof(contactURL) != 'undefined' ? contactURL : '',
            data: { 
                Num: function(){ 
                return $('#contact_Num').val();
              } 
            },
            dataType : "json"
          },//end of remote
          required:true,
          //contactvalidation: true
        },//end of rules for number
        username: {
          remote: {
            type: "GET",
            url : typeof(usernameURL) != 'undefined' ? usernameURL : '',
            data: { 'orig_username':  typeof(orig_username) != 'undefined' ? orig_username : '', username: function(){ 
                return $('#username').val();
              } 
            },
            dataType : "json"
          },//end of remote rule
          required:true,
          namevalidation:true
        },//end of rules for username
        confirmPassField: {
          required: true,
          equalTo: "#passField",
        },//end of confirmpassfield rule
        passfield: {
          required: true
        }//end of password field rule
      },//end of rules
//----------------------------------------------------------------------------------------------
      messages: {//---------------------------------------------------------------------messages
        Fname: {
          required: '<span style = "color:red;">*required</span>'
        },//end of rules for fname
        Lname: {
          required: '<span style = "color:red;">*required</span>',
          namevalidation: '<span style = "color:red;">invalid Last Name</span>'
        },//end of rules for lname
        email:{
          required: '<span style = "color:red;">*required</span>',
          email: '<span style = "color:red;">Please enter a <em>valid</em> email address</span>',
          remote: "<span style = 'color:red;'>Email address is already in use. Please use a different one.</span>"
        },//end of message for email validation
        contact_Num: {
          required:'<span style = "color:red;">*required</span>',
          remote: "<span style = 'color:red;'>Contact number is already in use. Please use a different one.</span>"
        },//end of rules for number
        username: {
          required:'<span style = "color:red;">*required</span>',
          namevalidation: '<span style = "color:red;">invalid username</span>',
          remote: "<span style = 'color:red;'>Username is already in use. Please use a different one.</span>"
        },//end of rules for username
        confirmPassField: {
          required: '<span style = "color:red;">*required</span>',
          equalTo: '<span style = "color:red;">password does not match</span>'
        },//end of confirm passfield rule
        passfield: {
          required: '<span style = "color:red;">*required</span>'
        }//end of passfield rule
      }//
    })
  });//end of function

  jQuery.validator.addMethod("namevalidation", function(value, element) {
        var isValidName = /^[A-Za-z\u00C0-\u02AB'´`]?\.?\-?([A-Za-z\u00C0-\u02AB'´`]+\.?\s?\-?)+$/.test(value);
        return this.optional(element) || isValidName;
    },
    "<span style = 'color:red;'>Invalid name</span>"
  );//vai\lidator for names

  jQuery.validator.addMethod("contactvalidation", function(value, element) { 
      if (/^[9]\d{9}$/.test(value)) {
          return /^[9]\d{9}$/.test(value);
      }
  }, "<span style = 'color:red;'>Invalid contact Number</span>");//validation for contact number

  if($('#deletingSessionField').val()=='Successful'){
   //Show popup
   swal("Good Job!:","You have successfully deleted the Admin Account!","success");
    }

  if($('#addingSessionField').val()=='Successful'){
   //Show popup
    swal("Good Job!:","You have successfully made a new Admin Account!","success");
    }

  if($('#addingSessionField').val()=='Fail'){
   //Show popup
   swal("Sorry!:","There was an error while creating the account please try again possible errors might be the username, email or contact number are already existing in the system","warning");
    }

  $('#datepicker').datepicker({
    autoclose: true
  });

 /*$('#email').change(function() {
    var emailAdd = $(this).val();
    $.ajax({
      url: "{{ url('Validate_Email') }}",
      method:"POST",
      data:{email_Add:email},
      dataType: "text",
      success: function(success){
        $('#Emailavailability').html(html);
      }
    });//END OF AJAX
  });//end of function*/

});//
</script>
@endsection
