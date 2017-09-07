@extends('main')

@section('content')
   
    <div class="container">
    	<h3 style="margin-top: 50px;"> List of Customers with Trade Agreement</h3>
    </div>

    
        <div class="col-xs-12">
          <div class="box">
            
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th> Customer ID </th>  
                    <th> Full Name </th>
                    <th> Type </th>
                    <th> Contact No </th>
                    <th> Email Address </th>
                    <th> Address </th>  
                    <th> Action </th>
                </thead>

                <tbody>
                  @foreach($agreed as $Agreementsrow)
                    <tr>  
                        <td>  {{$Agreementsrow->Cust_ID}}   </td>
                        <td>  {{$Agreementsrow->Cust_FName}} {{$Agreementsrow->Cust_MName}}, {{$Agreementsrow->Cust_LName}} </td>
                        <td>  {{$Agreementsrow->Customer_Type}}    </td>
                        <td>  {{$Agreementsrow->Contact_Num}}      </td>
                        <td>  {{$Agreementsrow->Email_Address}}    </td>
                        <td>  {{$Agreementsrow->Address_Line}}    </td>
                        <td align="center" > 
                           <a type = "button" href="{{ route('customersTradeAgreement.show',$Agreementsrow->Cust_ID) }}" class = "btn btn-info btn-sm" > 
                            More Details
                          </a>
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
@endsection