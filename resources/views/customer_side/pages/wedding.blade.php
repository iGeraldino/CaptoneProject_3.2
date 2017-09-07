@extends('customer_side_main')
@section('title', 'Wedding')
@section('css')
    <link href="_CSS/wedding1.css" rel="stylesheet">
@endsection

@section('content')
            <div class="container" style="margin-top: 70px">
				<div class="row">
				    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
				    	<form role="form">
							<h2 class="fonth2 text-center fontx">....Set your own date</h2>
							<hr class="colorgraph">
							<div class="form-group">
								<input type="text" name="display_name" id="display_name" class="form-control input-lg" placeholder="Name of Event" tabindex="3">
							</div>
							<div class="form-group">
								<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Location" tabindex="4">
							</div>
							<div class="form-group">
								<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Contact Number" tabindex="4">
							</div>
							<div class="form-group">
								<input type="email" name="email" id="email" class="form-control input-lg" placeholder="Time" tabindex="4">
							</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="row">
								        <div class="span12">
								    		<table class="table-condensed table-bordered table-striped">
								                <thead>
								                    <tr>
								                      <th colspan="7">
								                        <span class="btn-group">
								                            <a class="btn"><i class="glyphicon glyphicon-chevron-left"></i></a>
								                        	<a class="btn active">February 2012</a>
								                        	<a class="btn"><i class="glyphicon glyphicon-chevron-right"></i></a>
								                        </span>
								                      </th>
								                    </tr>
								                    <tr>
								                        <th>Su</th>
								                        <th>Mo</th>
								                        <th>Tu</th>
								                        <th>We</th>
								                        <th>Th</th>
								                        <th>Fr</th>
								                        <th>Sa</th>
								                    </tr>
								                </thead>
								                <tbody>
								                    <tr>
								                        <td class="muted">29</td>
								                        <td class="muted">30</td>
								                        <td class="muted">31</td>
								                        <td>1</td>
								                        <td>2</td>
								                        <td>3</td>
								                        <td>4</td>
								                    </tr>
								                    <tr>
								                        <td>5</td>
								                        <td>6</td>
								                        <td>7</td>
								                        <td>8</td>
								                        <td>9</td>
								                        <td>10</td>
								                        <td>11</td>
								                    </tr>
								                    <tr>
								                        <td>12</td>
								                        <td>13</td>
								                        <td>14</td>
								                        <td>15</td>
								                        <td>16</td>
								                        <td>17</td>
								                        <td>18</td>
								                    </tr>
								                    <tr>
								                        <td>19</td>
								                        <td class="btn-primary"><strong>20</strong></td>
								                        <td>21</td>
								                        <td>22</td>
								                        <td>23</td>
								                        <td>24</td>
								                        <td>25</td>
								                    </tr>
								                    <tr>
								                        <td>26</td>
								                        <td>27</td>
								                        <td>28</td>
								                        <td>29</td>
								                        <td class="muted">1</td>
								                        <td class="muted">2</td>
								                        <td class="muted">3</td>
								                    </tr>
								                </tbody>
								            </table>
								        </div>
									</div>
								</div>
															
							<hr class="colorgraph">
							<div class="row pad">
								<div class="col-xs-12 col-md-6"><input type="submit" value="Confirm" class="btn btn-primary btn-block btn-lg" tabindex="7"></div>
								<div class="col-xs-12 col-md-6"><a href="#" class="btn btn-danger btn-block btn-lg">Cancel</a></div>
							</div>
						</form>
					</div>
				</div>
			</div>
				
@endsection				
@section('script')
        <script>
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
		                $button.prepend('<i class="state-icon ' + settings[$button.data('state')].icon + '"></i> ');
		            }
		        }
		        init();
		    });
		});

        </script>
@endsection