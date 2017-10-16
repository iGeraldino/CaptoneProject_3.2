@extends('cashier_design')

@section('content')
  

    
        <div class="col-xs-12" style="margin-top: 3%;">
          <div class="box">
            <div class="box-header">
              <h3> LIST OF CUSTOMERS WITH TRADE AGREEMENT</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                    <th class="text-center"> CUSTOMER ID</th>  
                    <th class="text-center"> FULL NAME </th>
                    <th class="text-center"> TYPE </th>
                    <th class="text-center"> CONTACT NO </th>
                    <th class="text-center"> EMAIL</th>
                    <th class="text-center"> ADDRESS </th>  
                    <th class="text-center"> ACTION </th>
                </thead>

                <tbody>
                  @foreach($agreed as $Agreementsrow)
                    <tr>  
                        <td class="text-center">  {{$Agreementsrow->Cust_ID}}   </td>
                        <td>  {{$Agreementsrow->Cust_FName}} {{$Agreementsrow->Cust_MName}}, {{$Agreementsrow->Cust_LName}} </td>
                        <td class="text-center">  {{$Agreementsrow->Customer_Type}}    </td>
                        <td>  {{$Agreementsrow->Contact_Num}}      </td>
                        <td>  {{$Agreementsrow->Email_Address}}    </td>
                        <td>  {{$Agreementsrow->Address_Line}}    </td>
                        <td align="center" > 
                           <a type = "button" href="{{ route('customersTradeAgreement.show',$Agreementsrow->Cust_ID) }}" class = "btn btn-just-icon btn-sm Inbox" rel="tooltip" title="MORE DETAILS"><i class="material-icons">add_circle</i> 
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