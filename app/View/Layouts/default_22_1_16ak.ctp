<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'OUTSOURCE');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?> - <?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		#echo $this->Html->css('cake.generic');
		echo $this->Html->css('style');
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-theme');
                echo $this->Html->css('jquery.bxslider');
                echo $this->Html->css('jquery-ui');
		
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
                echo $this->Html->script('enscroll-0.6.0.min');
                echo $this->Html->script('jquery.bxslider');
                echo $this->Html->script('jquery-ui');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
   
    <link href='https://fonts.googleapis.com/css?family=Roboto:400,300,700,100' rel='stylesheet' type='text/css'>
    <link href="<?php echo $this->webroot;?>font-awesome/css/font-awesome.css" rel="stylesheet" type="text/css">
</head>
<body>
    <?php
    $ActiveController=$this->params['controller'];
    $ActiveAction=$this->params['action'];
    if($ActiveController=='users' && $ActiveAction=='index'){
        $NavClass='navbar-fixed-top';
    }else{
        $NavClass='bg-black';
    }
    
    if($ActiveController=='users' && ($ActiveAction=='dashboard' || $ActiveAction=='my_task' || $ActiveAction=='editprofile' || $ActiveAction=='change_password')){
        $NavClass='bg-black after_login';
    }
    ?>
    <nav class="navbar navbar-default <?php echo $NavClass;?>">
        <div class="container">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->webroot;?>"><img src="<?php echo $this->webroot;?>images/logo.png" alt="" /><!--<img src="site_logo/<?php //echo $this->requestAction('users/site_logo');?>" alt="" />--></a>
          </div>

          <div class="col-md-8 pull-right">
                <?php
                if($ActiveController=='users' && ($ActiveAction=='dashboard' || $ActiveAction=='my_task' || $ActiveAction=='editprofile' || $ActiveAction=='change_password')){
                ?>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav navbar-left">
				<li><a href="#taskStep1" data-toggle="modal" data-target="#taskStep1" class="label label-warning">Post a Task</a></li>
				<li><a href="#">Browse Tasks</a></li>
				<li><a href="<?php echo $this->webroot;?>users/my_task">My Tasks</a></li>
		      </ul>
		      <div class="pull-right">
		      	<ul class="right_notification">
				  	<li><a href="" class="fa fa-bell-o"></a></li>
				  	<li><a href="" class="fa fa-envelope-o"></a></li>
				  	<li><a href=""><img src="<?php echo $this->webroot;?>images/clint.png" alt="" /></a></li>
				</ul>
		      </div>
		</div><!-- /.navbar-collapse -->
                <?php
                }else{
                ?>
                <div class="call pull-right"><span>Call us <b>1800-000-000</b></span> 
                    <ul>
                        <li><a href="<?php echo $sitesetting['SiteSetting']['facebook_url'];?>" class="fa fa-facebook"></a></li>
                        <li><a href="<?php echo $sitesetting['SiteSetting']['twitter_url'];?>" class="fa fa-twitter"></a></li>
                        <li><a href="<?php echo $sitesetting['SiteSetting']['facebook_url'];?>" class="fa fa-linkedin"></a></li>
                     </ul>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="<?php echo $this->webroot;?>">Home</a></li>
                      <li><a href="#">Browse Category</a></li>
                      <li><a href="#">How it works</a></li>
                      <li><a href="#">Contact us</a></li>
                      <li><a href="#">How it works</a></li>
                        <?php
                        $userid = $this->Session->read('userid');
                        $username = $this->Session->read('username');
                        if(isset($userid) && $userid!=''){
                            echo '<li><a href="'.$this->webroot.'users/dashboard">My Account</a></li>';
                            echo '<li><a href="'.$this->webroot.'users/logout">Logout</a></li>';
                        }else{
                        ?>
                      <li><a href="<?php echo $this->webroot;?>users/login">Login</a></li>
                      <li><a href="<?php echo $this->webroot;?>users/signup">Signup</a></li>
                        <?php }?>

                      <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                          <li><a href="#">Action</a></li>
                          <li><a href="#">Another action</a></li>
                          <li><a href="#">Something else here</a></li>
                          <li role="separator" class="divider"></li>
                          <li><a href="#">Separated link</a></li>
                        </ul>
                      </li>-->
                    </ul>
                  </div><!-- /.navbar-collapse -->
                  <?php
                    }
                  ?>
          </div>

        </div>
    </nav>
    <?php echo '<center>'.$this->Session->flash().'</center>'; ?> 
    <?php //echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
    <footer>
        <div class="container">
                <div class="row">
                        <div class="col-md-3">
                                <ul>
                                        <li><a href="">Airconditioning & Heating</a></li>
                                        <li><a href="">Alarm Systems</a></li>
                                        <li><a href="">Appliance Repair</a></li>
                                        <li><a href="">Bathroom Renovations</a></li>
                                        <li><a href="">Bookkeeping</a></li>
                                        <li><a href="">Bricklaying</a></li>
                                        <li><a href="">Builders</a></li>
                                        <li><a href="">Building & Pest Inspections</a></li>
                                        <li><a href="">Carpenter</a></li>
                                        <li><a href="">Carpet Cleaning</a></li>
                                        <li><a href="">Carports & Patios</a></li>
                                        <li><a href="">Catering</a></li>
                                        <li><a href="">Cleaners</a></li>
                                        <li><a href="">Concreting</a></li>
                                        <li><a href="">Conveyancing</a></li>
                                </ul>
                        </div>
                        <div class="col-md-3">
                                <ul>
                                        <li><a href="">Electricians</a></li>
                                        <li><a href="">Fencing Gates</a></li>
                                        <li><a href="">Flooring</a></li>
                                        <li><a href="">Garage Doors</a></li>
                                        <li><a href="">Gardening & Landscaping</a></li>
                                        <li><a href="">HandyMan</a></li>
                                        <li><a href="">High Pressure Cleaning</a></li>
                                        <li><a href="">Home Renovations</a></li>
                                        <li><a href="">Kitchen Renovations</a></li>
                                        <li><a href="">Lawn Mowing</a></li>
                                        <li><a href="">Locksmith</a></li>
                                        <li><a href="">Painters</a></li>
                                        <li><a href="">Paving</a></li>
                                        <li><a href="">Pest Control</a></li>
                                        <li><a href="">Photographers</a></li>
                                </ul>
                        </div>
                        <div class="col-md-3">
                                <ul>
                                        <li><a href="">Electricians</a></li>
                                        <li><a href="">Fencing Gates</a></li>
                                        <li><a href="">Flooring</a></li>
                                        <li><a href="">Garage Doors</a></li>
                                        <li><a href="">Gardening & Landscaping</a></li>
                                        <li><a href="">HandyMan</a></li>
                                        <li><a href="">High Pressure Cleaning</a></li>
                                        <li><a href="">Home Renovations</a></li>
                                        <li><a href="">Kitchen Renovations</a></li>
                                        <li><a href="">Lawn Mowing</a></li>
                                        <li><a href="">Locksmith</a></li>
                                        <li><a href="">Painters</a></li>
                                        <li><a href="">Paving</a></li>
                                        <li><a href="">Pest Control</a></li>
                                        <li><a href="">Photographers</a></li>
                                </ul>
                        </div>
                        <div class="col-md-3">
                                <img src="<?php echo $this->webroot;?>images/logo_footer.png" alt="" />
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud...</p>
                                <button>READ MORE</button>
                                <div class="follow">
                                        <h5>Follow us on</h5>
                                        <a href="<?php echo $sitesetting['SiteSetting']['facebook_url'];?>" class="fa fa-facebook" style="background:#153892"></a>
                                        <a href="<?php echo $sitesetting['SiteSetting']['twitter_url'];?>" class="fa fa-twitter" style="background:#1eacfb"></a>
                                        <a href="<?php echo $sitesetting['SiteSetting']['linkedIn_url'];?>" class="fa fa-linkedin" style="background:#0274b3"></a>
                                </div>
                        </div>
                </div>
        </div>
    </footer>
    <section class="footer_bottom">
        <div class="container">
                <ul>
                        <li><a href="<?php echo $this->webroot;?>">Home</a></li>
                        <li><a href="">Post a Job</a></li>
                        <li><a href="">Search for Job</a></li>
                        <li><a href="<?php echo $this->webroot;?>users/signup">Sign Up</a></li>
                        <li><a href="">Blog</a></li>
                        <li><a href="">How it Works</a></li>
                        <li><a href="">Directory</a></li>
                        <li><a href="">SiteMap</a></li>
                        <li><a href="">Terms & Conditions</a></li>
                        <li><a href="">Privacy Policy</a></li>
                </ul>
                <p>© Copyright <?php echo date('Y');?>. All right reserved</p>
        </div>
    </section>
    
<!----------------------------Start AK-------------------------------->
    <!---------------------Modal for task Step 1------------------------>
    <div class="modal fade" id="taskStep1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <form action="" method="post" name="form-task1" id="form-task1">
	  	<input type="hidden" name="data[task][id]" id="task_id_step1" value="">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
			 <div class="modal-header">
			   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			   <h4 class="modal-title" id="myModalLabel">Get FREE Quotes</h4>
			 </div>
			 <div class="modal-body">
			     <div class="alert alert-success" id="msgStep1" style="display:none">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong id="msg1"></strong> 
				</div>
			   <div class="progress_bar_top">
				   <ul id="progressbar">
						<li class="active">Details</li>
						<li>Location</li>
						<li>Budget</li>
					</ul>
				</div>
				<div class="forms">
					<form>
					  <div class="form-group">
					    <label for="">Task Title*<i data-toggle="tooltip" data-placement="top" title="Task Title" class="fa fa-question-circle"></i></label>
					    <input type="text" class="form-control" name="data[task][title]" id="title" required="required" onkeyup="checking('title')"  placeholder="Title"><i id="check_title" class="fa fa-check"></i>
					    <span id="msgTitle" class="ajaxmsg"></span>
					  </div>
					  <div class="form-group">
					    <label for="exampleInputPassword1">Describe what you need done*<i data-toggle="tooltip" data-placement="top" title="Task Description" class="fa fa-question-circle"></i></label>
					    <textarea class="form-control" name="data[task][description]" maxlength="200"  id="description" onkeyup="checking('description');" required="required" ></textarea><i id="check_description" class="fa fa-check"></i>
					    <span id="msgDescription" class="ajaxmsg"></span>
					    <p class="help-block" id="count_description">200 Charecter </p>
					    
					  </div>
					</form>
				</div>
			 </div>
			 <div class="modal-footer">
			   <button type="button" onclick="saveStep1()" name="taskStep1" class="btn btn-default">Continue..</button>
			 </div>
		    </div>
		  </div>
	  </form>
	</div>
	<script>
		function checking(ele) {
		    var data = $.trim( $('#'+ele).val() );
		    if (data == "") {
			   $("#check_"+ele).removeClass('active');
		    }else{
		    	   $("#check_"+ele).addClass('active');
		    }
		}
		$(document).ready(function() {
		    var text_max = 200;
		    $('#count_description').html(text_max + ' characters remaining');

		    $('#description').keyup(function() {
			   var text_length = $('#description').val().length;
			   var text_remaining = text_max - text_length;

			   $('#count_description').html(text_remaining + ' characters remaining');
		    });
		});
		function saveStep1(){
			var id = $('#task_id_step1').val();
			var title = $('#title').val();
			var description = $('#description').val();
			var chk=0;
			$("#msgTitle").html('');
			$("#msgDescription").html('');
			if(title=='')
			{
				$("#msgTitle").html('<font color="red">Please enter the Tilte</font>');
				chk=1;
			}
			if(description=='')
			{
				$("#msgDescription").html('<font color="red">Please enter the Descripion</font>');
				chk=1;
			}
			if(!chk){
				$.post('<?php echo($this->webroot);?>tasks/add/', {id : id , title : title , description : description },function(data){
					console.log(data);
					console.log(data.status);
					if(data.status == 'success')
					{
						$('#task_id_step1').val(data.id);$('#task_id_step2').val(data.id);$('#task_id_step3').val(data.id);
						$('.modal').modal('hide');$('#taskStep2').modal('show');
					}else {
						$('#msg1').text(data.message);
						$('#msgStep1').addClass('alert-danger');
						$('#msgStep1').show();
						initialize();
					}
				}, "json");
			}
		}
	</script>
	<style>
	.ajaxmsg{
		float:left;
	}
	.ui-datepicker{
		z-index:9999 !important;
	}
	</style>
    <!---------------------Modal for task step1 End------------------------>
    
    <!---------------------Modal for task2--------------------------->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
    <div class="modal fade" id="taskStep2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <form action="" method="post" name="form-task2" id="form-task2">
    <input type="hidden" name="data[task][id]" id="task_id_step2" value="">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Get FREE Quotes</h4>
	      </div>
	      <div class="modal-body">
	               <div class="alert alert-success" id="msgStep2" style="display:none">
				  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				  <strong id="msg2"></strong> 
				</div>
	        <div class="progress_bar_top">
		        <ul id="progressbar">
					<li class="active">Details</li>
					<li class="active">Location</li>
					<li>Budget</li>
				</ul>
			</div>
			<div class="forms">
				<form>
				  <div class="row">
				  <div class="col-md-6">
					  <div class="radio">
						  <label>
						    <input type="radio" name="completed" id="completed_offline" value="2" checked="true" >
						    To be completed in-person
						  </label>
					  </div>
				  </div>
				  <div class="col-md-6">
					  <div class="radio">
						  <label>
						    <input type="radio" name="completed" id="completed_online" value="1">
						    Can be completed online
						  </label>
					  </div>
				  </div>
				  </div>
				  <hr></hr>
				  <div class="form-group">
				    <label for="">Task Location <i data-toggle="tooltip" data-placement="top" title="Task Location" class="fa fa-question-circle"></i></label>
				    <input type="text" class="form-control" name="data[Task][task_location]" id="task_location" required="required" onclick="initialize()" onfocus="initialize()" onkeyup="checking('task_location')" placeholder="Enter suburb" style="width:60%"><i class="fa fa-check" id="check_task_location"></i>
				    <span id="msg_task_location" class="ajaxmsg"></span>
				  </div>
				  <hr></hr>
				  <div class="row">
				   <div class="col-md-12 form-group">
				   <label for="">Due date<i data-toggle="tooltip" data-placement="top" title="Hooray!" class="fa fa-question-circle"></i></label></div>
				  <div class="col-md-4">
					  <div class="radio">
						  <label>
						    <input type="radio" name="duecalender" id="calender_today" value="1" checked="checked" onclick="setDueDate()">
						    Today
						  </label>
					  </div>
				  </div>
				  <div class="col-md-4">
					  <div class="radio">
						  <label>
						    <input type="radio" name="duecalender" id="calender_week" value="2" onclick="setDueDate()">
						    within 1 week
						  </label>
					  </div>
				  </div>
				  <div class="col-md-4">
					  <div class="radio">
						  <label>
						    <input type="radio" name="duecalender" id="calender_date" value="3" onclick="setDueDate()">
						    by a certain day
						  </label>
					  </div>
				  </div>
				  <div class="col-md-12 form-group">
				  	<div class="input-group">
				  	<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
				  	<input type="text" class="form-control calender" name="data[Task][due_date]" required="required" onfocus="callDate()" id="due_date" value="<?php echo date('Y-m-d');?>" readonly placeholder="Due date" onkeyup="checking('due_date')" style="width:60%"><i class="fa fa-check" id="check_due_date"></i>
				  	<span id="msg_due_date" class="ajaxmsg"></span>
				  	</div>
				  </div>
				  </div>
				</form>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" onclick="saveStep2()" class="btn btn-default">Continue..</button>
	      </div>
	    </div>
	  </div>
	</form>  
	</div>
	<script>
	function setDueDate(){
		var select = $('input[name=duecalender]:checked', '#form-task2').val();
		if(select=="1")
		{
			var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();

			var output = d.getFullYear() + '-' +
			    ((''+month).length<2 ? '0' : '') + month + '-' +
			    ((''+day).length<2 ? '0' : '') + day;
			    
			$('#due_date').val(output);
			$("#due_date").prop("readonly", true);
		}else if(select=="2"){
			
			var d = new Date();

			d.setDate(d.getDate() + 7);
			var month = d.getMonth()+1;
			var day = d.getDate();

			var output = d.getFullYear() + '-' +
			    ((''+month).length<2 ? '0' : '') + month + '-' +
			    ((''+day).length<2 ? '0' : '') + day;
			    
			$('#due_date').val(output);
			$("#due_date").prop("readonly", true);
		}else if(select=="3"){
			$("#due_date").prop("readonly", false);
			$("#due_date").val('');
		}
	}
	
	function saveStep2(){
			var id = $('#task_id_step2').val();
			var completed = $('input[name=completed]:checked', '#form-task2').val();
			var task_location = $('#task_location').val();
			var due_date = $('#due_date').val();
			var due_date_type = $('input[name=duecalender]:checked', '#form-task2').val();
			var chk=0;
			$("#msg_due_date").html('');
			$("#msg_task_location").html('');
			if(task_location=='')
			{
				$("#msg_task_location").html('<font color="red">Please enter the Location</font>');
				chk=1;
			}
			if(due_date=='')
			{
				$("#msg_due_date").html('<font color="red">Please enter the Due date</font>');
				chk=1;
			}
			if(!chk){
				$.post('<?php echo($this->webroot);?>tasks/step2/', {id : id , completed : completed , task_location : task_location , due_date : due_date , due_date_type : due_date_type },function(data){
					console.log(data);
					console.log(data.status);
					if(data.status == 'success')
					{
						$('.modal').modal('hide');$('#taskStep3').modal('show');
					}else {
						$('#msg2').text(data.message);
						$('#msgStep2').addClass('alert-danger');
						$('#msgStep2').show();
						
					}
				}, "json");
			}
		}
		
	function callDate(){
		//$('#due_date').datetimepicker();
		var dateToday = new Date();
		 console.log(dateToday);
		 $( "#due_date" ).datepicker({ 
		  dateFormat: 'yy-mm-dd',
		  changeMonth: true,
		  changeYear: true,
		  minDate: dateToday,
		  //maxDate: +80,
		  yearRange: "-0:+20"
		 });
		 $( "#due_date" ).datepicker('show');
	}
	
	</script>
	<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
	<script type="text/javascript">
	    
	    function initialize() {
		   var defaultBounds = new google.maps.LatLngBounds(
		   new google.maps.LatLng(7.623887, 68.994141),
		   new google.maps.LatLng(37.020098, 97.470703));

		   var input1 = document.getElementById('task_location');
		   var options = {
		       bounds: defaultBounds,
		       types: ['geocode'],
		   };
		   autocomplete1 = new google.maps.places.Autocomplete(input1, options);
	    }
	</script>
	<!--------------------Modal task step2 End--------------------------->
	
	<!--------------------Modal task step3--------------------------->
	
	<div class="modal fade" id="taskStep3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	 <form action="" method="post" name="form-task3" id="form-task3">
	 <input type="hidden" name="data[task][id]" id="task_id_step3" value="">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Get FREE Quotes</h4>
	      </div>
	      <div class="modal-body">
	          <div class="alert alert-success" id="msgStep3" style="display:none">
			  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			  <strong id="msg3"></strong> 
			</div>
	        <div class="progress_bar_top">
		        <ul id="progressbar">
					<li class="active">Details</li>
					<li class="active">Location</li>
					<li class="active">Budget</li>
				</ul>
			</div>
			<div class="forms">
				<form>
				   <div class="form-group">
				    <label for="">How many people need to be assigned to this task?

<i data-toggle="tooltip" data-placement="top" title="Need more than one person for your task? You can assign up to 30 people!" class="fa fa-question-circle"></i></label>
				    <input type="number" min="0" max="30" class="form-control" name="data[Task][workers]" id="workers" onkeyup="checking('workers')" placeholder="Enter number of people" style="width:30%"><i class="fa fa-check" id="check_workers"></i>
				    <span id="msg_workers" class="ajaxmsg"></span>
				  </div>
				  <hr></hr>
				 			 
				  <div class="row">
				   <div class="col-md-12 form-group">
				   <label for="">What's your budget?<i data-toggle="tooltip" data-placement="top" title="Hooray!" class="fa fa-question-circle"></i></label></div>
				  <div class="col-md-4">
					  <div class="radio">
						  <label>
						    <input type="radio" name="budget_type" id="budget_type" value="1" checked="checked" onclick="setdiv()">
						    Total
						  </label>
					  </div>
				  </div>
				  <div class="col-md-4">
					  <div class="radio">
						  <label>
						    <input type="radio" name="budget_type" id="budget_type" value="2" onclick="setdiv()">
						    Hourly Rate
						  </label>
					  </div>
				  </div>
				  
				  <div class="col-md-12 form-group">
				  	<div class="input-group" id="totaldiv">
					  	<div class="input-group-addon">$</div>
					  	<input type="number" class="form-control" name="data[Task][total_rate]" onkeyup="checking('total_rate')" id="total_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_total_rate"></i>
					  	<span id="msg_total_rate" class="ajaxmsg"></span>
				  	</div>
				  	<div class="input-group" id="hourlydate" style="display:none">
					  	<div class="input-group-addon">$</div>
					  	<input type="number" class="form-control" min="0" name="data[Task][per_hour_rate]" onkeyup="checking('per_hour_rate')" id="per_hour_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_per_hour_rate"></i>
					  	<span id="msg_per_hour_rate" class="ajaxmsg"></span>
					  	<p>per hour for</p><input type="number" class="form-control" min="0" name="data[Task][hour]" onkeyup="checking('hour')" id="hour" placeholder="5" style="width:20%"><p>hours</p><i class="fa fa-check" id="check_hour"></i>
					  	<span id="msg_hour" class="ajaxmsg"></span>
				  	</div>
				  </div>
				  </div>
				</form>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" onclick="saveStep3()" class="btn btn-default">Continue..</button>
	      </div>
	    </div>
	  </div>
	  </form>
	</div>
	<script>
	function setdiv(){
		var selectbudget = $('input[name=budget_type]:checked', '#form-task3').val();
		if(selectbudget == 1)
		{
			$('#totaldiv').show();$('#hourlydate').hide();
		}else{
			$('#totaldiv').hide();$('#hourlydate').show();
		}
	}
	
	function saveStep3(){
			var id = $('#task_id_step3').val();
			var workers = $('#workers').val();
			var budget_type = $('input[name=budget_type]:checked', '#form-task3').val();
			var total_rate = $('#total_rate').val();
			var per_hour_rate = $('#per_hour_rate').val();
			var hour = $('#hour').val();
			
			var chk=0;
			$("#msg_workers").html('');$("#msg_total_rate").html('');
			$("#msg_per_hour_rate").html('');$("#msg_hour").html('');
			if(workers=='' || workers<1)
			{
				$("#msg_workers").html('<font color="red">Please enter the number of people needed</font>');
				chk=1;
			}
			if(budget_type=='1')
			{
				if(total_rate=="" || total_rate<1)
				{
					$("#msg_total_rate").html('<font color="red">Please enter total rate.</font>');
					chk=1;
				}
			}
			if(budget_type=='2')
			{
				if(per_hour_rate=="" || per_hour_rate<1)
				{
					$("#msg_per_hour_rate").html('<font color="red">Please enter per hour rate.</font>');
					chk=1;
				}
				if(hour=="" || hour<1)
				{
					$("#msg_hour").html('<font color="red">Please enter for how many hour .</font>');
					chk=1;
				}
				total_rate = (hour * per_hour_rate);
			}
			if(!chk){
				$.post('<?php echo($this->webroot);?>tasks/step3/', {id : id , workers : workers , budget_type : budget_type , total_rate : total_rate , per_hour_rate : per_hour_rate , hour : hour },function(data){
					console.log(data);
					console.log(data.status);
					if(data.status == 'success')
					{
						$('.modal').modal('hide');$('#taskStep4').modal('show');
					}else {
						$('#msg3').text(data.message);
						$('#msgStep3').addClass('alert-danger');
						$('#msgStep3').show();
						
					}
				}, "json");
			}
		}
	</script>
	<style>
		.modal{z-index: 11;}
		.modal-backdrop{z-index: 10;}
	</style>
	<!--------------------Modal task step3 End--------------------------->
	
	<!-----------------------Last step message--------------------------->
	<div class="modal fade" id="taskStep4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <form action="" method="post" name="form-task4" id="form-task4">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Get FREE Quotes</h4>
	      </div>
	      <div class="modal-body">
	        <div class="congrats">
	        <i class="fa fa-thumbs-o-up"></i>
	        If you need to post this task later we have saved it for you in your My Tasks area as a Draft.
You can go back and edit the task at any time.</div>
	      </div>
	      <div class="modal-footer">
	        <button type="submit" class="btn btn-default">Ok</button>
	      </div>
	    </div>
	  </div>
	  </form>
	</div>
	<!-----------------------Last step message--------------------------->
<!----------------------------End AK-------------------------------->     
    
    <script>
        $(document).ready(function(){       
           setTimeout(function() {
                $('.message').fadeOut('slow');
                $('.success').fadeOut('slow');
           }, 3000);
        // Tooltip script   
            $('[data-toggle="tooltip"]').tooltip();   
        });
    	$(window).scroll(function(){
            if ($(window).scrollTop() >= 100) {
               $('.navbar-fixed-top').css('background','#343434');
            }else {
               $('.navbar-fixed-top').css('background','none');
            }
        });
    </script>
    <?php echo $this->element('sql_dump'); ?>
</body>
</html>
