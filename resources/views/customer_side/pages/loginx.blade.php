@extends('customer_side_main')
@section('title', 'Login')
@section('css')
    <link href="_CSS/login2.css" rel="stylesheet">
@endsection

@section('content')

        <!--LOGIN-->

        <div class="container" style="margin-top: 50px;">
            <div class="row" style="margin-top:20px">
                <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">

                    <form role="form" method="post" action="{{ route('customer_side.pages.signin')}}" data-parsley-validate="">
                        <fieldset>
                          <div hidden>
                            <select id = 'existing_UserNames' name = 'existing_UserNames'>
                              @foreach($usernames as $users)
                                <option value = {{$users->Cust_ID}} data-tag = "{{$users->userName}}">{{$users->userName}}
                                </option>
                                <option value={{$users->Cust_ID}} data-tag ="{{$users->email}}">{{ $users->email }}
                                </option>
                              @endforeach
                            </select>
                          </div>
                            <h2 class="text-center fontx">Sign In</h2>
                            <hr class="colorgraph">
                            <div class="form-group">
                                <input type="text" name="email" id="email" class="form-control input-lg fontxx" placeholder="Username / Email">
                                <h5 hidden id="error" style="color: Red;">Invalid Username</h5>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password" id="password" class="form-control input-lg fontxx" placeholder="Password">
                            </div>
                            <span class="">
                                <button class="btn btn-info"><a href="" class=" pull-right fontxx">Forgot Password?</a></button>
                            </span>
                            <hr class="colorgraph">
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <button type="submit" class="btn btn-lg btn-success btn-block fontxx" value="Sign In">
                                      Login My Account
                                    </button>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <a href="/register" class="btn btn-lg btn-primary btn-block fontxx">Make an Account</a>
                                </div>
                            </div>
                              {{ csrf_field() }}
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>

        @endsection
@section('script')
        <script>
            $(function(){
            $('.button-checkbox').each(function(){
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

                $button.on('click', function () {
                    $checkbox.prop('checked', !$checkbox.is(':checked'));
                    $checkbox.triggerHandler('change');
                    updateDisplay();
                });

                $checkbox.on('change', function () {
                    updateDisplay();
                });

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
                    else
                    {
                        $button
                            .removeClass('btn-' + color + ' active')
                            .addClass('btn-default');
                    }
                }
                function init() {
                    updateDisplay();
                    // Inject the icon if applicable
                    if ($button.find('.state-icon').length == 0) {
                        $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
                    }
                }
                init();

                $(document).ready(function(){

                  $('#email').change(function(){
                    $('#existing_UserNames option').each(function(item){
                      var element =  $(this) ;
                      var datatag = element.data("tag");
                        if (element.data("tag") == $('#email').val()){
                          $('#email').css('background','white') ;
                          $('#error').slideUp();
                          return false;
                        }
                        else{
                          $('#email').css('background','red') ;
                          $('#error').slideDown();
                        }
                });

                });




              });// Document Function

              });
        });

        </script>

@endsection
