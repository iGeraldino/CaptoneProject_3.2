<!DOCTYPE html>
<html>

@include('partials._head')

<body class="hold-transition skin-blue fixed sidebar-mini">

@include('partials._nav')

<div class="content-wrapper">


	@yield('content')


</div> <!-- end of the container -->

@include('partials._javascript')

	@yield('scripts')

</body>

<script>
  $('document').ready(function(){
		//alert('hello gerald');

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
					notif_UL += '<ul class = "dropdown-menu"><a href = "#">'+response.data[ctr].Customer_Fname +'</a></ul>';
				}
				$('#notifications').html("");
				$('#notifications').append(notif_UL);
			}
		});

  });
</script>
</html>
