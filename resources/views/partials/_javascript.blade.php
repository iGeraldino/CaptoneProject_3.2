<script src="{{ asset('admin/plugins/jQuery/jquery-2.2.3.min.js') }}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- SlimScroll -->
<script src="{{ asset('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('admin/plugins/fastclick/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js') }}"></script>

<script src="{{asset('js/parsley.js') }} "></script>

<script src="{{asset('js/country.js') }} "></script>

<script src="{{asset('js/jquery.validate.js') }} "></script>


<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>

<script src="{{asset('admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>


<script src="{{asset('admin/plugins/datepicker/bootstrap-datepicker.js')}}"></script>

<script src="{{asset('admin/plugins/daterangepicker/moment.min.js')}}"></script>

<script src="{{asset('admin/plugins/daterangepicker/daterangepicker.js')}}"></script>

<script src="{{asset('material-kit/assets/js/material.min.js')}}"></script>

<script src="{{asset('material-kit/assets/js/material-kit.js')}}"></script>

<script src="{{asset('material-kit/assets/js/nouislider.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('admin/plugins/morris/morris.js') }}"></script>
<!-- Sparkline -->
<script src="{{asset('admin/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('admin/plugins/knob/jquery.knob.js')}}"></script>

<script src="{{asset('sweetalert-master/dist/sweetalert.min.js') }} "></script>
<script src="http://js.pusher.com/3.0/pusher.min.js"></script><!--for the development of notifications-->

<script>
$(document).ready(function(){
//for the pusher of the notification
 var pusher = new Pusher('{{env("PUSHER_APP_KEY")}}', {
   cluster: 'ap1',
   encrypted: true
 });

 var testChannel = pusher.subscribe('test-channel');
 testChannel.bind('private-test-event', function(data){
   alert(data);
 });

  var notification_OrderChannel = pusher.subscribe('OrderChannel');
  notification_OrderChannel.bind('private-NewOrders', function(order){
    alert(order);
  });
});
</script>

<script>

  $(document).ready(function(){
/*
$('#notification').html("");
    var Notification_URL = "{{ url('Admin.Check_Notification') }}";
    var notification = new Array();
    var num_ofNotification = 0;
    var notif_UL = "";
  $.ajax({
    type:'get',
      url: Notification_URL,
      dataType: 'json',
      success: function(response){
        notif_UL = "";
        for(ctr = 0; ctr < response.data.length; ctr++)
        {
          notif_UL += '<li><a href = "#"><i class = "glyphicon glyphicon-plus-sign"></i>'+response.data[ctr].Customer_Fname +' ' +response.data[ctr].Customer_MName + ', '+response.data[ctr].Customer_MName +' made an order</a><h7 class = "pull-right" style = "color:red;">'+response.data[ctr].created_at +'</h7></li>';
        }

        $('#notifications').html("");
        $("#countOfNotification").text(response.data.length);
        $('#notifications').append(notif_UL);
      }
    });
*/
  });
</script>
