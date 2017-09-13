@extends('cashier_design')

@section('content')
   
    <div class="container">
    	<h3 style="margin-top: 50px;"> LIST OF CUSTOMERS WITH TRADE AGREEMENT</h3>
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
                </tbody>
       
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
          

       </div>
@endsection