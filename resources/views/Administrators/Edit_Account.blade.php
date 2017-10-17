@extends('main')

@section('content')

    <div class="container col-xs-12" style="margin-top: 50px;">
        <div>
            <div class="panel panel-primary">
                <div class="panel-heading" style="background-color: #26a69a">
                    <h3 class="panel-title">Account Information</h3>
                </div>
                <div class="panel-body">

                    @foreach($AdminAcct as $AdminAcct)
                        {!! Form::model($AdminAcct,['route'=>['Admins.update', $AdminAcct->Admin_ID],'method'=>'PUT'])!!}
                        <div class = "row">
                            <div class = "col-md-5">
                                <div class="form-group label-floating">
                                    <label class="control-label">First Name</label>
                                    <input name = 'Fname' id = 'Fname' type="text" class="form-control" value = "{{$AdminAcct->Fname}}">
                                    <div hidden>
                                        <select id = 'existUsername' name = 'existUsername'>
                                            @foreach($Exist as $users)
                                                <option value = {{$users->Cust_ID}} data-tag = "{{$users->username}}">{{$users->username}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div hidden>
                                        <select id = 'existEmail' name = 'existEmail'>
                                            @foreach($Exist as $users)
                                                <option value={{$users->Cust_ID}} data-tag ="{{$users->email}}">{{ $users->email }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class = "col-md-5">
                                <div class="form-group label-floating">
                                    <label class="control-label">Last Name</label>
                                    <input name = 'Lname' id = 'Lname' type="text" class="form-control" value = "{{$AdminAcct->LName}}">
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class = "col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">email Address</label>
                                    <input name = 'email' id = 'email' type="text" class="form-control" value = "{{$AdminAcct->email}}">
                                    <h5 hidden id="errorEmail" style="color: Red;">Invalid Email</h5>
                                </div>
                            </div>
                            <div class = "col-md-4">
                                <div class="form-group label-floating">
                                    <label class="control-label">Contact Number</label>
                                    <input name = 'contact_Num' id = 'contact_Num' type="text" class="form-control" value = "{{$AdminAcct->contact}}">
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class = "col-md-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Username</label>
                                    <input name = 'username' id = 'username' type="text" class="form-control" value = "{{$AdminAcct->username}}">
                                    <h5 hidden id="errorUsername" style="color: Red;">Invalid Username</h5>
                                </div>
                            </div>
                        </div>

                        <div class = "row">
                            <div class = "col-md-2">
                                <div class="form-group label-floating">
                                    <label class="control-label">Username</label>
                                    <select class="form-control" name="admintype" tabindex="5">
                                        <option value="1"> Admin </option>
                                        <option value="2"> Cashier </option>
                                        <option value="2"> Warehouse Man </option>

                                    </select>

                                </div>
                            </div>
                        </div>


                        <div class = "row">
                            <div class = "col-md-6">
                                <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">group</i>
                              </span>
                                    <input id = "passField" name = "passField" type="password" class="form-control" placeholder="password" value ="" >
                                </div>
                            </div>
                            <div class = "col-md-6">
                                <div class="input-group">
                              <span class="input-group-addon">
                                <i class="material-icons">group</i>
                              </span>
                                    <input id = "confirmPassField" name = "confirmPassField" type="password" class="form-control" placeholder="Confirm Password" value="">
                                    <h7 id="error" style="color: red"> Password is not the same</h7>

                                </div>
                            </div>
                        </div>
                        <div class="btn-group btn-group-justified" role="group" aria-label="group button">
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-default" href = "{{route('Admins.index')}}" data-dismiss="modal"  role="button">Cancel</button>
                            </div>
                            <div class="btn-group" role="group">
                                <button type = "submit" name = "AddBtn" id="AddBtn" class = "btn btn-primary btn-success"><span class = "glyphicon glyphicon-floppy-save"></span> Save changes</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    @endforeach
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script language="javascript">
        populateCountries("country", "state");
        populateCountries("country2");
    </script>

    <script>
        $(document).ready(function(){

            $('#email').change(function(){
                $('#existEmail option').each(function(item){
                    var element =  $(this) ;
                    var datatag = element.data("tag");
                    console.log(datatag);

                    if (element.data("tag") == $('#email').val()){
                        $('#email').css('background','white') ;
                        $('#errorEmail').slideUp();
                        return true;
                    }
                    else{
                        $('#email').css('background','red') ;
                        $('#errorEmail').slideDown();
                        return false;
                    }
                });


            });

            $('#error').hide();
            $('#AddBtn').attr('disabled', true);


            $('#passField').change(function(){

                var password = $('#passField').val();

                $('#confirmPassField').change(function(){

                    var password2 = $('#confirmPassField').val();

                    if(password == password2){

                        $('#error').slideUp();
                        $('#AddBtn').attr('disabled', false);


                    }
                    else{

                        $('#error').slideDown();

                    }


                });




            });

        });
    </script>

@endsection
