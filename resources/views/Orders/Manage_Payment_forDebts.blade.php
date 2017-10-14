
@extends('main')

@section('content')
<?php
//Cart::instance('ordersTopay')->destroy();

  $CashMultiPayment_session = Session::get('CashMulti_Payment_CompletionSession');
  Session::remove('CashMulti_Payment_CompletionSession');//determines the deletion of Acessory

  $ManagingFlwr_session = Session::get('ManagingFlowerSession');
  Session::remove('ManagingFlowerSession');//determines the deletion of Acessory

  $EdittingFlwr_session = Session::get('editSession');
  Session::remove('editSession');//determines the deletion of Acessory

  $SettingSession = session::get('settingSession');
  session::remove('settingSession');

  use Carbon\Carbon;
  $current = Carbon::now('Asia/Manila');
 ?>
    <!-- Content Header (Page header) -->
  <section class="content-header">
      <div hidden>
        <input id = "countToReach" value = ""/>
        <input id = "countDone" value = ""/>

        <input id = "EditingFlowerSessionfield" value = "">
        <input id = "ManageFlowerSessionfield" value = "">
        <input id = "SettingSessionfield" value = "{{$SettingSession}}">
        <input id = "Cash_MultiPaymentSessionfield" value = "{{$CashMultiPayment_session}}">


      </div>
       <div class="col-xs-12" style="margin-top: 2%;">
        <div class="panel">
          <div class="panel-heading Subu">
            <h3 class="panel-title" style="color: white;"><b>LIST OF ORDERS THAT WITH DEBTS</b></h3>
          </div>
          <div class="panel-body">
						<div class = "row">
              <div class = "col-md-6">
								<p><b>Customer: </b>(CUST-{{$cust->Cust_ID}}) {{$cust->Cust_FName}} {{$cust->Cust_MName}}, {{$cust->Cust_LName}}</p>
								<p><b>Contact No: </b>{{$cust->Contact_Num}}</p>
								<p><b>Email: </b>{{$cust->Email_Address}}</p>

								@if($cust->Customer_Type == 'C')
									<p><b>Type: </b>Single Customer</p>
								@elseif($cust->Customer_Type == 'H')
									<p><b>Type: </b>Hotel</p>
									<p><b>Hotel Name: </b>{{$cust->Hotel_Name}}</p>
								@elseif($cust->Customer_Type == 'S')
									<p><b>Type: </b>S</p>
									<p><b>Shop Name: </b>{{$cust->Shop_Name}}</p>
								@endif
									<p><b>Address: </b>{{$cust->Address_Line}}, {{$cust->Baranggay}}, {{$city}}, {{$prov}}</p>
              </div>
              <div class = "Col-md-6 " style = "color:darkviolet;">
                <h5><b>Total Amount of Debt:</b> Php {{number_format($debt,2)}}</h>
              </div>
            </div>
            <div class="col-md-8">
              @if(Cart::instance('ordersTopay')->count() > 0)
                <a id = "ProcessBtn" type="button"
                class="pull-right btn btn-round twitch btn-md" data-toggle="modal" data-target = "#PROCESS_MODAL">
                  Process Request
                </a>
              @else
                <a id = "ProcessBtn" type="button"
                class="pull-right btn btn-round twitch btn-md" data-toggle="modal" data-target = "#PROCESS_MODAL" disabled>
                  Process Request
                </a>
              @endif
              <a href = "{{route('SalesOrder.UnderCustomer',['id'=>$cust->Cust_ID])}}"
                type="button" href = "" class="pull-right btn btn-round twitch btn-md"
                data-toggle="tooltip" data-placement="bottom"
                title="This Button redirect you to the list of flower requests from the supplier and will remove your progress"
                data-container="body">
                Return to Customer Account
              </a>
            </div>
						<br>
          <div class="row" >
            <div class="col-xs-6">
              <div class="box">
                <!-- /.box-header -->
                <div class="box-body">
                  <h4><b>Orders with Debt: </b></h4>
                  <table id="flowersTable" class="table table-bordered table-striped">
                      <thead>
                          <th class="text-center"> Order ID </th>
                          <th class="text-center"> Status </th>
                          <th class="text-center"> Amount </th>
                          <th class="text-center"> Balance</th>
                          <th class="text-center"> Action </th>
                      </thead>
                      <tbody>
                      <!--foreach here-->
                        @foreach($b_Orders as $order)
                          <tr>
                            <td>ORDR-{{$order->Order_ID}}</td>
                            <td>{{$order->Status}}</td>
                            <td>Php {{number_format($order->Total_Amt,2)}}</td>
                            <td>Php {{number_format($order->BALANCE,2)}}</td>
                            <td><a href = "{{route('SalesOrder.payDebts',['id'=>$order->Order_ID])}}"
                              class = "btn btn-md btn-primary"> Add to list</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
                </div>

                <div class="col-xs-6">
                  <div class="box">
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class = "row">
                        <div class = "col-md-6">
                          <h4><b>Orders Desired to pay: </b></h4>
                        </div>
                        <div class = "col-md-6">
                          <h4 style = 'color:red;'><b>Total to be paid: </b> {{Cart::instance('ordersTopay')->subtotal()}}</h4>
                        </div>
                      </div>
                      <table id="flowersToSaveTable" class="table table-bordered table-striped">
                        <thead>
                            <th class="text-center"> Order ID </th>
                            <th class="text-center"> Status </th>
                            <th class="text-center"> Amount </th>
                            <th class="text-center"> Balance</th>
                            <th class="text-center"> Action </th>
                        </thead>
                        <tbody>
                        <!--foreach here-->
                          @foreach(Cart::instance('ordersTopay')->content() as $S_Orders)
                            <tr>
                              <td>ORDR-{{$S_Orders->id}}</td>
                              <td>{{$S_Orders->options->status}}</td>
                              <td>Php {{number_format($S_Orders->options->t_amt,2)}}</td>
                              <td>Php {{number_format($S_Orders->price,2)}}</td>
                              <td><a href = "{{route('SalesOrder.removeDebts',['id'=>$S_Orders->id])}}"
                                class = "btn btn-md btn-danger"> Remove to list</a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>


                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                    </div>

              </div>
              <!-- /.col -->
          </div>
        </div>
        <!-- Sart Modal -->
        <div class="modal fade" id="PROCESS_MODAL" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        	<div class="modal-dialog">
        		<div class="modal-content">
        			<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
        					<i class="material-icons">clear</i>
        				</button>
        				<h4 class="modal-title">Set Payment for the Orders</h4>
        			</div>
        			<div class="modal-body">
                <div class="panel-body">
                    <p><b>Total Debt:</b> Php  {{number_format($debt,2)}}</p>
                    <p><b>Amount to Pay:</b> Php  {{number_format($debt,2)}}</p>
                    <hr>
                    <div class="radio">
                      <p class = "text-left"><b>Choose From the following:</b></p>
                      <label>
                        <input type="radio" name="optionsPayment" id = "cashRdo">
                        Pay via Cash
                      </label>
                      <label>
                        <input type="radio" name="optionsPayment" id = "bankRdo">
                        Pay via Bank
                      </label>
                      <label>
                        <input type="radio" name="optionsPayment" id = "checkRdo">
                        Pay via Check
                      </label>
                    </div>

                    <hr>
                  <div id = "cashPaymentDiv" hidden>
                  {!! Form::open(array('route' => 'ManageMultipleOrder_Cash.store', 'data-parsley-validate'=>'', 'method'=>'POST', 'files' => 'true')) !!}
                      <h6><b>Pay through Cash:</b></h6>
                        <b>Details of Person who gave the payment:</b>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox" name="samePersonCheckBox" id = "samePersonCheckBox">
                            Same Person who placed the order
                          </label>
                        </div>
                        <?php
                          $subtotal = str_replace(',','',Cart::instance('ordersTopay')->subtotal());
                        ?>
                        <div hidden>
                          <input type = "text" id = "Currentcust_ID" name = "Currentcust_ID" value = "{{$cust->Cust_ID}}"/>
                          <input type = "text" id = "Decision_text" name = "Decision_text" value = "N"/>
                          <input type = "text" id = "Current_FName" name = "Current_FName" value = "{{$cust->Cust_FName}}"/>
                          <input type = "text" id = "Current_LName" name = "Current_LName" value = "{{$cust->Cust_LName}}"/>
                          <input type = "text" id = "SubtotalDown" name = "SubtotalDown" value = "{{$subtotal}}"/>
                        </div>
                        <div class = "row">

                          <div class = "col-md-6">
                            <div id = "fnameDiv" class="form-group label-floating">
                              <label class="control-label">First Name</label>
                              <input  name = "nf_namefield" id = "nf_namefield" type="text" class="form-control text-right" required/>
                              <input name = "f_namefield" id = "f_namefield" type="text" class="hidden form-control text-right" value = "{{$cust->Cust_FName}}"/>
                              <span class="form-control-feedback">
                              </span>
                            </div>
                          </div>
                          <div class = "col-md-6">
                            <div id = "lnameDiv" class="form-group label-floating">
                              <label class="control-label">Last Name</label>
                              <input name = "nl_namefield" id = "nl_namefield" type="text" class="form-control text-right" required/>
                              <input name = "l_namefield" id = "l_namefield" type="text" class="hidden form-control text-right" value = "{{$cust->Cust_LName}}"/>
                              <span class="form-control-feedback">
                              </span>
                            </div>
                          </div>
                        </div>
                        <hr>
                      <div class = "row">
                        <div class = "col-md-6">
                          <div class="form-group label-control">
                            <label class="control-label">Total Amount of Debt</label>
                            <input type="text" id = "display_balanceField" class="form-control text-right" value = "Php {{number_format($debt,2)}}" disabled/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>
                        <div class = "col-md-6">
                          <div class="form-group label-control">
                            <label class="control-label">Balance to pay</label>
                            <input type="text" id = "display_balanceField" class="form-control text-right" value = "Php {{number_format($subtotal,2)}}" disabled/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                          <input type="number" id = "balanceField" name = "balanceField" type="number" step = "1.0" class="hidden form-control text-right" value = "{{$subtotal}}"/>
                        </div>
                      </div>
                      <div class = "row">
                        <div class = "col-md-6">
                        </div>
                        <div class = "col-md-6">
                          <div class="form-group label-floating">
                            <label class="control-label">Enter Amount Paid</label>
                              <input id = "payment_field" name = "payment_field" type="number" step = "0.01" class="form-control" min = "{{$subtotal}}" required/>
                               <input id = "payment" name = "payment" type="number" step = "0.01" class="hidden form-control">
                            <span class="form-control-feedback">
                            </span>
                          </div>
                          <div class="form-group label-control">
                            <label class="control-label">Change</label>
                              <input id = "DisplaychangeField" type="text" class="form-control" disabled value = "Php 0.00"/>
                              <input id = "changeField" name = "changeField" type="text" class="hidden form-control" />
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="checkbox">
                        <label  style = "color:red;">
                          <input type="checkbox" name="cash_ShowSubmitButton" id = "cash_ShowSubmitButton">
                          *important: by checking this, you are sure about the amount that you entered.
                        </label>
                      </div>
                      <div id = "cashSbmt_BtnDIV" hidden>
                        <button id = "cashSBMT" type = "submit" class = "btn btn-md btn-success" disabled>submit payment</button>
                      </div>
                {!! Form::close() !!}
                    </div>


                    <div id = "bankPaymentDiv" hidden>
                  {!! Form::open(array('route' => 'ManageMultipleOrder_Bank.store', 'data-parsley-validate'=>'', 'files' => 'true' , 'method'=>'POST')) !!}
                      <b>Details of Person who gave the payment:</b>
                      <div class="checkbox">
                        <label>
                          <input type="checkbox" name="samePersonCheckBox2" id = "samePersonCheckBox2">
                          Same Person who placed the order
                        </label>
                      </div>

                      <div hidden>
                        <input type = "text" id = "Order_ID2"  name = "Order_ID2" value = ""/>
                        <input type = "text" id = "Currentcust_ID2" name = "Currentcust_ID2"  value = "{{$cust->Cust_ID}}"/>
                        <input type = "text" id = "Decision_text2"  name = "Decision_text2" value = "N"/>
                        <input type = "text" id = "Current_FName2"  name = "Current_FName2" value = "{{$cust->Cust_FName}}"/>
                        <input type = "text" id = "Current_LName2"  name = "Current_LName2" value = "{{$cust->Cust_LName}}"/>
                        <input type = "text" id = "SubtotalDown2"  name = "SubtotalDown2" value = "{{$subtotal}}"/>
                      </div>

                      <div class = "row">
                        <div class = "col-md-6">
                          <div id = "fnameDiv2" class="form-group label-floating">
                            <label class="control-label">First Name</label>
                            <input  name = "nf_namefield2" id = "nf_namefield2" type="text" class="form-control text-right" required/>
                            <input name = "f_namefield2" id = "f_namefield2" type="text" class="hidden form-control text-right" value = ""/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div id = "lnameDiv2" class="form-group label-floating">
                            <label class="control-label">Last Name</label>
                            <input name = "nl_namefield2" id = "nl_namefield2" type="text" class="form-control text-right" required/>
                            <input name = "l_namefield2" id = "l_namefield2" type="text" class="hidden form-control text-right" value = ''/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>

                      </div>
                      <hr>

                      <p><b>Pay through Bank Deposite<b></p>

                      <div class="form-group" Style = "margin-left: 20%;">
                        <img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox" name="imageBox" style="max-width: 200px; max-height: 200px;" />
                      </div>

                      <label for = 'flowerimg'>Slip Image: </label>
                      <div class="input-group">
                        <input class ="uploader" type="file" accept="image/*" name = "DSlipimg" id = "DSlipimg" onchange="preview_image(event)"  style = "margin-top: 2%;" required>
                      </div>
                      <div class="input-group" hidden>
                        <img class ="uploader" type="file" accept="image/*" name = "DSlipimg2" id = "DSlipimg2" value = "{{ asset('img/'.'addfile.ico')}}" src = "{{ asset('img/'.'addfile.ico')}}" hidden/>
                      </div>

                      <div class = "row">
                        <div class = "col-md-6">
                          <div id = "partialDiv" class="form-group label-floating">
                            <label class="control-label">Bank Name</label>
                            <input name = "Bank_Name" id = "Bank_Name" type="text" class="form-control" required maxlength= "40" required/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div id = "partialDiv" class="form-group label-floating">
                            <label class="control-label">Deposit Slip Number</label>
                            <input name = "slip_Number" id = "slip_Number" type="text" class="form-control" maxlength= "20" required/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>
                      </div>

                      <div class = "row">
                        <div class = "col-md-6">
                          <div id = "partialDiv" class="form-group label-control">
                            <label class="control-label">Date Deposited</label>
                            <input name = "D_date" id = "D_date"  type="date" class="form-control" reqired/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>

                        <div class = "col-md-6">
                          <div id = "partialDiv" class="form-group label-control">
                            <label class="control-label">Amount Deposited</label>
                              <input name = "D_Amount" id = "D_Amount" type="number" step = "0.01" min = "{{$subtotal}}" value = "{{$subtotal}}" class="form-control" required/>
                            <span class="form-control-feedback">
                            </span>
                          </div>
                        </div>
                      </div>
                      <div class="checkbox">
                        <label  style = "color:red;">
                          <input type="checkbox" name="bank_ShowSubmitButton" id = "bank_ShowSubmitButton">
                          *important: by checking this, you are sure about the amount that you entered.
                        </label>
                      </div>
                      <div id = "bankSbmt_BtnDIV" hidden>
                        <button id = "bankSBMT" type = "submit" class = "btn btn-md btn-success" disabled>Submit payment</button>
                      </div>
                  {!! Form::close() !!}
                    </div>

                    <div id = "check_Div" hidden>

        									<b>Details of Person who gave the payment:</b>
        									<div class="checkbox">
        										<label>
        											<input type="checkbox" name="samePersonCheckBox3" id = "samePersonCheckBox3">
        											Same Person who placed the order
        										</label>
        									</div>

        									<div hidden>
        										<input type = "text" id = "Currentcust_ID3" name = "Currentcust_ID3"  value = "{{$cust->Cust_ID}}"/>
        										<input type = "text" id = "Decision_text3"  name = "Decision_text3" value = "N"/>
        										<input type = "text" id = "Current_FName3"  name = "Current_FName3" value = "{{$cust->Cust_FName}}"/>
        										<input type = "text" id = "Current_LName3"  name = "Current_LName3" value = "{{$cust->Cust_LName}}"/>
        										<input type = "text" id = "SubtotalDown3"  name = "SubtotalDown3" value = "{{$subtotal}}"/>
        									</div>

        									<div class = "row">
        										<div class = "col-md-6">
        											<div id = "fnameDiv3" class="form-group label-floating">
        												<label class="control-label">First Name</label>
        												<input  name = "nf_namefield3" id = "nf_namefield3" type="text" class="form-control text-right" required/>
        												<input name = "f_namefield3" id = "f_namefield3" type="text" class="hidden form-control text-right" value = "{{$cust->Cust_FName}}"/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>

        										<div class = "col-md-6">
        											<div id = "lnameDiv3" class="form-group label-floating">
        												<label class="control-label">Last Name</label>
        												<input name = "nl_namefield3" id = "nl_namefield3" type="text" class="form-control text-right" required/>
        												<input name = "l_namefield3" id = "l_namefield3" type="text" class="hidden form-control text-right" value = '{{$cust->Cust_LName}}'/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>

        									</div>
        									<hr>

        									<p><b>Pay through Bank Check<b></p>

        									<div class="form-group" Style = "margin-left: 20%;">
        										<img src= "{{ asset('img/'.'addfile.ico')}}" id="imageBox2" name="imageBox2" style="max-width: 200px; max-height: 200px;" />
        									</div>

        									<label for = 'flowerimg'>Check Image: </label>
        									<div class="input-group">
        										<input class ="uploader" type="file" accept="image/*" name = "Checkimg" id = "Checkimg" onchange="preview_image2(event)"  style = "margin-top: 2%;" required>
        									</div>
        									<div class="input-group" hidden>
        										<img class ="uploader" type="file" accept="image/*" name = "Checkimg2" id = "Checkimg2" value = "{{ asset('img/'.'addfile.ico')}}" src = "{{ asset('img/'.'addfile.ico')}}" hidden/>
        									</div>

        									<div class = "row">
        										<div class = "col-md-6">
        											<div id = "partialDiv" class="form-group label-floating">
        												<label class="control-label">Bank Name</label>
        												<input name = "Bank_Name3" id = "Bank_Name3" type="text" class="form-control" required maxlength= "40" required/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>

        										<div class = "col-md-6">
        											<div id = "partialDiv" class="form-group label-floating">
        												<label class="control-label">Check Number</label>
        												<input name = "check_Number" id = "check_Number" type="text" class="form-control" maxlength= "20" required/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>
        									</div>

        									<div class = "row">
        										<div class = "col-md-6">
        											<div id = "partialDiv" class="form-group label-control">
        												<label class="control-label">Date of Check</label>
        												<input name = "check_date" id = "check_date" max = "{{date('Y-m-d', strtotime($current))}}" value = "{{date('Y-m-d', strtotime($current))}}" type="date" class="form-control" reqired/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>
        										<div class = "col-md-6">
        											<div id = "partialDiv" class="form-group label-control">
        												<label class="control-label">Date Recieved</label>
        												<input name = "recieved_date" id = "recieved_date" max = "{{date('Y-m-d', strtotime($current))}}" value = "{{date('Y-m-d', strtotime($current))}}" type="date" class="form-control" reqired/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>
        									</div>
        									<div class = "row">
        										<div class = "col-md-6">

        										</div>
        										<div class = "col-md-6">
        											<div id = "partialDiv" class="form-group label-control">
        												<label class="control-label">Time Recieved</label>
        												<input name = "recieved_time" id = "recieved_time"  value = "{{date('H:i', strtotime($current))}}" type="time" class="form-control" reqired/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>
        									</div>
        									<?php
        										$val2 = 0;

        										$min2=0;
        									?>
        									<div class = "row">
        										<div class = "col-md-5">
        											<div id = "partialDiv" class="form-group label-control">
        												<label class="control-label">Amount of Check</label>
        												<input name = "Check_Amount" id = "Check_Amount" type="number" step = "0.01"
        												min = "{{$subtotal}}"
        												value = "{{$subtotal}}" class="form-control" required/>
        												<span class="form-control-feedback">
        												</span>
        											</div>
        										</div>
        										<div class = "col-md-7">
        											<div class="form-group label-floating">
        												<label class="control-label">Who Signed the Check?</label>
        												<input name = "asignatory" id = "asignatory" type="text" class="form-control" maxlength= "70" required/>
        											</div>
        										</div>
        									</div>
        									<hr>
        									<div class="checkbox">
        										<label  style = "color:red;">
        											<input type="checkbox" name="check_ShowSubmitButton" id = "check_ShowSubmitButton">
        											*important: by checking this, you are sure about the amount that you entered.
        										</label>
        									</div>
        									<div id = "checkSbmt_BtnDIV" hidden>
        										<button id = "checkSBMT" type = "submit" class = "btn btn-md btn-success" disabled>Submit payment</button>
        									</div>

        						</div>

                  </div>
        			</div>
        		</div>
        	</div>
        </div>
        <!--  End Modal -->
  </div>
  </section>

@endsection


@section('scripts')
  <script type="text/javascript">
    $(function () {
        $("#finalSummary_Tbl").DataTable();
        $("#flowersTable").DataTable();

        $("#flowersToSaveTable").DataTable();

        $('#pendingtable').DataTable({
          "paging": true,
          "info": true,
          "autoWidth": false
        });
      });

      function preview_image(event){
       var reader = new FileReader();
       reader.onload = function()
       {
        var output = document.getElementById('imageBox');
        output.src = reader.result;
       }
       reader.readAsDataURL(event.target.files[0]);
      }

      function preview_image2(event){
         var reader = new FileReader();
         reader.onload = function()
         {
          var output = document.getElementById('imageBox2');
          output.src = reader.result;
         }
         reader.readAsDataURL(event.target.files[0]);
      }
  </script>
    <script>
      $(document).ready(function(){

        $('#ProcessBtn').click(function(){
          $('#cashPaymentDiv').hide("fold");
          $('#check_Div').hide("fold");
          $('#bankPaymentDiv').hide("fold");
          $('#cashSBMT').attr("disabled",true);
          $('#cashSbmt_BtnDIV').hide("fold");
          $('#checkSBMT').attr("disabled",true);
          $('#checkSbmt_BtnDIV').hide("fold");
          $('#bankSBMT').attr("disabled",true);
          $('#bankSbmt_BtnDIV').hide("fold");
          $('#bankRdo').attr('checked',false);
          $('#checkRdo').attr('checked',false);
          $('#cashRdo').attr('checked',false);
          $('#cash_ShowSubmitButton').attr('checked',false);
          $('#check_ShowSubmitButton').attr('checked',false);
          $('#bank_ShowSubmitButton').attr('checked',false);
        });

        $('#bankRdo').click(function(){
    			$('#cashPaymentDiv').hide("fold");
    			$('#check_Div').hide("fold");
    			$('#bankPaymentDiv').show("fold");
    		});

    		$('#cashRdo').click(function(){
    			$('#check_Div').hide("fold");
    			$('#bankPaymentDiv').hide("fold");
    			$('#cashPaymentDiv').show("fold");
    		});

    		$('#checkRdo').click(function(){
    			$('#bankPaymentDiv').hide("fold");
    			$('#cashPaymentDiv').hide("fold");
    			$('#check_Div').show("fold");
    		});

        $('#samePersonCheckBox3').click(function(){
    			if($('#samePersonCheckBox3').is(":checked")){
    				$('#Decision_text3').val("O");
    				$('#fnameDiv3').removeClass("form-group label-floating");
    				$('#fnameDiv3').addClass("form-group label-control");
    				$('#lnameDiv3').removeClass("form-group label-floating");
    				$('#lnameDiv3').addClass("form-group label-control");
    				$("#nf_namefield3").val($('#Current_FName').val());
    				$("#nl_namefield3").val($('#Current_LName').val());
    				$("#nf_namefield3").attr('disabled',true);
    				$("#nl_namefield3").attr('disabled',true);
    			}else{
    				$('#Decision_text3').val("N");
    				$('#fnameDiv3').removeClass("form-group label-control");
    				$('#fnameDiv3').addClass("form-group label-floating");
    				$('#lnameDiv3').removeClass("form-group label-control");
    				$('#lnameDiv3').addClass("form-group label-floating");
    				$("#nf_namefield3").val(null);
    				$("#nl_namefield3").val(null);
    				$("#nf_namefield3").attr('disabled',false);
    				$("#nl_namefield3").attr('disabled',false);
    			}
    		});


        $('#samePersonCheckBox2').click(function(){
          if($('#samePersonCheckBox2').is(":checked")){
            $('#Decision_text2').val("O");
            $('#fnameDiv2').removeClass("form-group label-floating");
            $('#fnameDiv2').addClass("form-group label-control");
            $('#lnameDiv2').removeClass("form-group label-floating");
            $('#lnameDiv2').addClass("form-group label-control");
          	$("#nf_namefield2").val($('#Current_FName').val());
            $("#nl_namefield2").val($('#Current_LName').val());
            $("#nf_namefield2").attr('disabled',true);
            $("#nl_namefield2").attr('disabled',true);
          }else{
            $('#Decision_text2').val("N");
            $('#fnameDiv2').removeClass("form-group label-control");
            $('#fnameDiv2').addClass("form-group label-floating");
            $('#lnameDiv2').removeClass("form-group label-control");
            $('#lnameDiv2').addClass("form-group label-floating");
            $("#nf_namefield2").val(null);
            $("#nl_namefield2").val(null);
            $("#nf_namefield2").attr('disabled',false);
            $("#nl_namefield2").attr('disabled',false);
          }
        });

    	$('#samePersonCheckBox').click(function(){
    		if($('#samePersonCheckBox').is(":checked")){
    				$('#Decision_text').val("O");
    				$('#fnameDiv').removeClass("form-group label-floating");
    				$('#fnameDiv').addClass("form-group label-control");
    				$('#lnameDiv').removeClass("form-group label-floating");
    				$('#lnameDiv').addClass("form-group label-control");
    				$("#nf_namefield").val($('#Current_FName').val());
    				$("#nl_namefield").val($('#Current_LName').val());
    				$("#nf_namefield").attr('disabled',true);
    				$("#nl_namefield").attr('disabled',true);
    			}else{
    				$('#Decision_text').val("N");
    				$('#fnameDiv').removeClass("form-group label-control");
    				$('#fnameDiv').addClass("form-group label-floating");
    				$('#lnameDiv').removeClass("form-group label-control");
    				$('#lnameDiv').addClass("form-group label-floating");
    				$("#nf_namefield").val(null);
    				$("#nl_namefield").val(null);
    				$("#nf_namefield").attr('disabled',false);
    				$("#nl_namefield").attr('disabled',false);
    			}
    		});

        $('#payment_field').change(function(){
    			$('#payment').val($(this).val());
          var change = 0;
            change = $(this).val() - $('#balanceField').val();
          $('#changeField').val(change.toFixed(2));
          $('#DisplaychangeField').val('Php '+change.toFixed(2));
        });


        $('#cash_ShowSubmitButton').click(function(){
          if($('#cash_ShowSubmitButton').is(":checked")){
            //$('#bank_ShowSubmitButton').attr('checked',false);
            $('#cashSbmt_BtnDIV').show("fold");
            $('#cashSBMT').attr("disabled",false);
          }else{
            $('#cashSBMT').attr("disabled",true);
            $('#cashSbmt_BtnDIV').hide("fold");
          }
        });

        $('#check_ShowSubmitButton').click(function(){
          if($('#check_ShowSubmitButton').is(":checked")){
            //$('#bank_ShowSubmitButton').attr('checked',false);
            $('#checkSbmt_BtnDIV').show("fold");
            $('#checkSBMT').attr("disabled",false);
          }else{
            $('#checkSBMT').attr("disabled",true);
            $('#checkSbmt_BtnDIV').hide("fold");
          }
        });

        $('#bank_ShowSubmitButton').click(function(){
          if($('#bank_ShowSubmitButton').is(":checked")){
            $('#bankSbmt_BtnDIV').show("fold");
            $('#bankSBMT').attr("disabled",false);
          }else{
            $('#bankSBMT').attr("disabled",true);
            $('#bankSbmt_BtnDIV').hide("fold");
          }
        });

        if($('#Cash_MultiPaymentSessionfield').val()=='Successful'){
          //Show popup
          swal("Success!","The payment was successfully recorded as a payment to the different debts!","success");
         }

         if($('#SettingSessionfield').val()=='Successful'){
           //Show popup
           swal("Good!","The sales order addedd to the list of orders to be paid!","success");
         }else if($('#SettingSessionfield').val()=='Fail'){
           //Show popup
           swal("Sorry!","The sales order that you choose was already at the list of orders to be paid!","error");
          }else if($('#SettingSessionfield').val()=='Deleted'){
            //Show popup
            swal("Take Note!","The sales order was successfully removed from the list!","info");
           }



      });
    </script>
@endsection
