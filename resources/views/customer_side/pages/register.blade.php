@extends('customer_side_main')
@section('title', 'Register')
@section('css')
    <link href="_CSS/register1.css" rel="stylesheet">
@endsection

@section('content')

        <!-- CREATE -->

        <div class="container" style="margin-top: 70px;">
          <div class="row">
              <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
              @if(count($errors) > 0)
                  <div class="alert alert-danger">
                      @foreach ($errors->all() as $error)
                          <p> {{ $error}} </p>
                      @endforeach
                  </div>
              @endif
              <form role="form" method="post" action="{{ route('customer_side.pages.signup') }}">
                <h2 class="text-center fontx">Make an Account</h2>
                <hr class="colorgraph">
                <div class="row">
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <input type="text" name="fname" id="first_name" class="form-control input-lg" placeholder="First Name" tabindex="1">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <input type="text" name="mname" id="middle_name" class="form-control input-lg" placeholder="Middle Name" tabindex="2">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="form-group">
                      <input type="text" name="lname" id="last_name" class="form-control input-lg" placeholder="Last Name" tabindex="3">
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <input type="contact" name="contact" id="contact" class="form-control input-lg" placeholder="Contact Number" tabindex="4">
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="addr_line" id="addr_line" class="form-control input-lg" placeholder="House No./Street Name" tabindex="5">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="text" name="brgy" id="brgy" class="form-control input-lg" placeholder="Baranggay" tabindex="6">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <select name="ProvinceField" id="ProvinceField" class="form-control input-lg" tabindex="7" required>
                        <option value = "-1" data-tag = "-1" disabled selected> Choose Province</option>
                        @foreach($province as $prov)
                          <option value ="{{$prov->id}}" > {{$prov->name}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <select name="TownField" id="TownField" class="form-control input-lg" tabindex="8" required>
                          <option value = "-1" data-tag = "-1" disabled selected> Choose City</option>
                        @foreach($city as $city)
                          <option value ="{{$city->id}}" data-tag = "{{$city->province_id}}"> {{$city->name}} </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address" tabindex="9">
                </div>
                <div class="form-group">
                  <input type="text" name="username" id="display_name" class="form-control input-lg" placeholder="Username" tabindex="10">
                </div>
                <div class="row">
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password" tabindex="11">
                    </div>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-6">
                    <div class="form-group">
                      <input type="password" name="password_confirmation" id="password_confirmation" class="form-control input-lg" placeholder="Confirm Password" tabindex="12">
                       <div id="error1"><h5> Password is not match </h5></div>
                    </div>
                  </div>
                </div>


                <hr class="colorgraph">
                <div class="row">
                  <div class="col-xs-12 col-md-6"><button type="submit" id="rereg" class="btn btn-success btn-block btn-lg fontxx" disabled>Submit</button></div>
                  <div class="col-xs-12 col-md-6"><a href="/user/loginx" class="btn btn-success btn-block btn-lg fontxx">Already have an account? Sign In </a></div>
                </div>
                {{ csrf_field() }}




              </form>
            </div>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="t_and_c_m" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myModalLabel">Terms & Conditions</h4>
                </div>
                <div class="modal-body">
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Similique, itaque, modi, aliquam nostrum at sapiente consequuntur natus odio reiciendis perferendis rem nisi tempore possimus ipsa porro delectus quidem dolorem ad.</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">I Agree</button>
                </div>
              </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
          </div><!-- /.modal -->
        </div>

        <!-- CREATE END -->

     @endsection

@section('script')
    <script>

    $(document).ready(function () {

        $('#error1').hide();


        $('#password').change(function(){

            $('#password_confirmation').change(function(){


                var first = $('#password').val();
                var second = $('#password_confirmation').val();



                    if(first == second){

                        $('#password_confirmation').css('background', 'white');
                        $('#rereg').attr('disabled', false);
                        $('#error1').slideUp();
                    }
                    else{

                        $('#password_confirmation').css('background', 'red');
                        $('#error1').slideDown();

                    }





            });


        });






        $("#TownField").attr('disabled',true);

        $('#ProvinceField').change(function(){
          $("#TownField").removeAttr("disabled");
          $("#TownField").attr('required', true);
                  var selected = $(this).val();
                  $("#TownField option").each(function(item){
                   // console.log(selected) ;
                    var element =  $(this) ;
                    //console.log(element.data("tag")) ;
                    if (element.data("tag") != selected){
                      element.hide() ;
                    }
                    else{
                      element.show();
                    }
                  }) ;

                $("#TownField").val($("#TownField option:visible:first").val());

        });//end of function
    });//end of ready function

      $(function () {
        $('.button-checkbox').each(function () {
            // Settings
            var $widget = $(this),
                $button = $widget.find('button'),
                $checkbox = $widget.find('input:checkbox'),
                color = $button.data('color'),
                settings = {
                    on: {
                        icon: 'glyphicon glyphicon-check'
                    },
                    off: {
                        icon: 'glyphicon glyphicon-unchecked'
                    }
                };

            // Event Handlers
            $button.on('click', function () {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
                $checkbox.triggerHandler('change');
                updateDisplay();
            });
            $checkbox.on('change', function () {
                updateDisplay();
            });

            // Actions
            function updateDisplay() {
                var isChecked = $checkbox.is(':checked');

                // Set the button's state
                $button.data('state', (isChecked) ? "on" : "off");

                // Set the button's icon
                $button.find('.state-icon')
                    .removeClass()
                    .addClass('state-icon ' + settings[$button.data('state')].icon);

                // Update the button's color
                if (isChecked) {
                    $button
                        .removeClass('btn-default')
                        .addClass('btn-' + color + ' active');
                }
                else {
                    $button
                        .removeClass('btn-' + color + ' active')
                        .addClass('btn-default');
                }
            }

            // Initialization
            function init() {

                updateDisplay();

                // Inject the icon if applicable
                if ($button.find('.state-icon').length == 0) {
                    $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i>');
                }
            }
            init();
        });
    });
    </script>
@endsection
