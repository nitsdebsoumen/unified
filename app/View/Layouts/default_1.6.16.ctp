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
$userid = $this->Session->read('user_id');
$cakeDescription = __d('cake_dev', 'Niwi');
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
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('bootstrap-theme');
		
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('bootstrap.min');
	?>
    <link href="<?php echo $this->webroot; ?>/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Fonts -->
    
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script>
    	$(document).ready(function(){
    		$('#list').on('click', function(){
			    $('.product-list').removeClass('grid').addClass('list');
			});
			$('#grid').on('click', function(){
			    $('.product-list').removeClass('list').addClass('grid');
			});
    	});
    </script>
    
<meta name="og:type" content="website" /> 
<meta name="og:image" content=""/>
<meta name="og:title" content="" />
<meta name="og:description" content="" />
<meta name="og:url" content=""/>
<meta name="og:like" content=""/>

<meta name="description" content=""/>
<meta name="title" content=""/>
<meta name="keywords" content=""/>
<!--<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-75089528-1', 'auto');
  ga('send', 'pageview');
</script>-->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-75780072-1', 'auto');
  ga('send', 'pageview');
</script>
</head>
<body>
    	

    	<div class="modal fade" id="Login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog log-holder">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Log In</h4>
					<h4 class="modal-title-info">Login or Create a new account to keep exploring</h4>
				</div>
				<div class="modal-body">
					<form name="loginuser" method="post" action="<?php echo $this->webroot;?>users/userlogin">
						<div class="form-group">
							<button type="button" class="paypal-btn">
								<img src="<?php echo $this->webroot; ?>/images/paypal.png" alt="">
							</button>
						</div>
						<div class="form-group">
							<button type="button" class="Facebook-btn">
								<img src="<?php echo $this->webroot; ?>/images/facebook.png" alt="">
							</button>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<button type="button" class="google-btn">
										<img src="<?php echo $this->webroot; ?>/images/google-plus.png" alt="">
									</button>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<button type="button" class="twitter-btn">
										<img src="<?php echo $this->webroot; ?>/images/twitter.png" alt="">
									</button>
								</div>
							</div>
						</div>
						<div class="or"><h4>Or</h4></div>
						<div class="clearfix"></div>
						<div class="form-group">
						    <input type="email" name="data[User][email]" id="email" class="form-control" placeholder="Email Adress" required="required"/>
						</div>
						<div class="form-group">
							<input type="password" name="data[User][password]" id="password" class="form-control" placeholder="Password" required="required"/>
						</div>
						<div class="form-group">
							<input type="submit" value="Log In" class="btn btn-primary btn-block"/>
						</div>
						<p class="sign-now">Never to NIWI? <a href="javascript:void(0)" id="signupclose">Sign up now</a> </p>
					</form>
				</div>
				<div class="modal-footer">
					<p class="intrst">Interested in Selling? <a href="javascript:void(0)">Get started now!</a></p>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.Login modal -->




	<div class="modal fade" id="Register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog log-holder">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Join Niwi</h4>
					<h4 class="modal-title-info">Niwi is the place to discover and buy amazing things</h4>
				</div>
				<div class="modal-body">
					<form name="userregister" method="post" action="<?php echo $this->webroot;?>users/userregister">
						<div class="form-group">
							<button type="button" class="paypal-btn">
								<img src="<?php echo $this->webroot; ?>/images/paypal.png" alt="">
							</button>
						</div>
						<div class="form-group">
							<button type="button" class="Facebook-btn">
								<img src="<?php echo $this->webroot; ?>/images/facebook.png" alt="">
							</button>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									<button type="button" class="google-btn">
										<img src="<?php echo $this->webroot; ?>/images/google-plus.png" alt="">
									</button>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<button type="button" class="twitter-btn">
										<img src="<?php echo $this->webroot; ?>/images/twitter.png" alt="">
									</button>
								</div>
							</div>
						</div>
						<div class="or"><h4>Or</h4></div>
						<div class="clearfix"></div>
						<div class="form-group">
							<input type="email" name="data[User][email_address]" id="email" class="form-control" placeholder="Email Adress" required="required"/>
						</div>
						<div class="form-group">
							<input type="password" id="password" name="data[User][user_pass]" class="form-control" placeholder="Password" required="required"/>
						</div>
						<div class="form-group">
							<input type="text" name="data[User][fullname]" id="fullname" class="form-control" placeholder="Full Name" required="required"/>
						</div>
						<div class="form-group">
<!--							<p class="text-center"><img src="<?php echo $this->webroot; ?>/images/robot.png" class="img-responsive" style="display: inline-block"></p>-->
						    <div class="g-recaptcha" data-sitekey="6LeZYSETAAAAAM_sOQCjc8ghDWmBtuhLBu490WeB"></div>
						</div>
						<div class="form-group">
							<input type="submit" value="Join Now!" class="btn btn-primary btn-block"/>
						</div>
						<p class="sign-now">By signing up, you agree to our <a href="">terms of use</a>, <a href="">privacy policy</a>,and <a href="">cookie policy</a></p>
					</form>
				</div>
				<div class="modal-footer">
					<p class="intrst">Interested in Selling? <a href="">Get started now!</a></p>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.Register modal -->



		<div class="modal fade" id="AddPost" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog log-holder ad-post-step-holder">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Step 1</h4>
					<h4 class="modal-title-info">3 easy steps to post on Niwi</h4>
				</div>
				<ul class="nav nav-tabs step-tab" role="tablist">
				    <li role="presentation" class="active"><a href="#PostDtail" aria-controls="PostDtail" role="tab" data-toggle="tab">Post Details</a></li>
				    <li role="presentation"><a href="#AdPhto" aria-controls="AdPhto" role="tab" data-toggle="tab">Add a Photo</a></li>
				    <li role="presentation"><a href="#ConFrm" aria-controls="ConFrm" role="tab" data-toggle="tab">Confirm</a></li>
				</ul>
				<div class="modal-body">
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="PostDtail">
							<form>
								<div class="row">
									<div class="col-sm-8 middle-div">
										<div class="form-group">
											<select class="form-control">
												<option>Select a Category (Required)</option>
											</select>
										</div>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Title Description (Required)">
										</div>
										<div class="form-group">
											<input type="text" class="form-control" placeholder="Location">
										</div>
										<div class="form-group">
											<textarea rows="4" class="form-control" style="height: auto" placeholder="Product Description"></textarea>
											<small class="grey-text">150 characters max</small>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div role="tabpanel" class="tab-pane" id="AdPhto">
							<div class="photo-adding-area">
								<ul class="phto-add">
									<li><img src="images/add-photo.jpg" alt=""></li>
									<li><img src="images/add-photo2.jpg" alt=""></li>
									<li><img src="images/add-photo2.jpg" alt=""></li>
									<li><img src="images/add-photo2.jpg" alt=""></li>
									<li><img src="images/add-photo2.jpg" alt=""></li>
								</ul>
								<div class="clearfix"></div>
								<h4>Suggested Images</h4>
								<p><img src="images/round-tick.png" alt=""></p>
							</div>
							<div class="clearfix"></div>
						</div>
						<div role="tabpanel" class="tab-pane" id="ConFrm">
							<form>
								<div class="row">
									<div class="col-sm-8 middle-div">
										<div class="form-group">
											<label>BUDGET</label>
											<input type="text" class="form-control" placeholder="$2500">
										</div>
										<div class="form-group" style="margin-bottom: 50px">
											<div class="form-control">
												<div class="radio margin-top0">
													<label>
														<input type="radio" name=" " value="option1" checked> Fixed
													</label>
													<label>
														<input type="radio" name=" " value="option1" checked> Negotiable
													</label>
													<label>
														<input type="radio" name="" value="option1" checked> Trade
													</label>
												</div>
											</div>
										</div>
										<div class="form-group">
											<label>PRODUCT CONDITION</label>
											<div class="form-control">
												<div class="radio margin-top0">
													<label>
														<input type="radio" name=" " value="option1" checked> New
													</label>
													<label>
														<input type="radio" name=" " value="option1" checked> Used
													</label>
												</div>
											</div>
										</div>
										
									</div>
								</div>
								<small class="grey-text" style="display: block; border-top:1px solid #e1e1e1; padding-top: 5px">By clicking 'Submit', you agree to abide by our listing rules and terms of use. You also agree to follow through on your listing regardless of the final bid amount. Users who are in violation of these terms may be suspended.</small>
							</form>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default btn-bordered" data-dismiss="modal" style="padding-right: 20px; padding-left:20px">Skip</button>
        			<button type="button" class="btn btn-primary">Continue</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.Post modal -->




	
	<nav class="navbar navbar-default">

		<?php if($userid=='')
{
?>

  		<div class="container">
    		
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="<?php echo $this->webroot; ?>/images/logo.png" alt="" /></a>
			</div>

			
			<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><button class="btn btn-bordered app-btn">Get the App! <i><img src="<?php echo $this->webroot; ?>/images/mobile.png" alt=""></i></button></li>
					<li><button class="btn btn-primary log-btn" data-toggle="modal" data-target="#Login">Login</button></li>
					<li><button class="btn btn-primary log-btn" data-toggle="modal" data-target="#AddPost">Add a post <i><img src="<?php echo $this->webroot; ?>/images/camera.png" alt=""></i></button></li>
				</ul>
    		</div>
		</div><!-- /.container-->
		<?php
	}
		?>

<?php if(isset($userid) && $userid!='')
{
?>
		<div class="container">
    		
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><img src="images/logo.png" alt="" /></a>
			</div>

			
			<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left after-login-navbar">
					<li><button class="btn btn-primary log-btn" data-toggle="modal" data-target="#AddPost">Add a post <i><img src="images/camera.png" alt=""></i></button></li>
					<li><a href="" class="comment-icon"><i><img src="images/comment-icon.png" alt=""></i></a></li>
					<li>
						<a href="" class="notifi-icon">
							<i><img src="images/notifi-icon.png" alt=""></i>
							<span>1</span>
						</a>
					</li>
				</ul>
				<div class="user-sec" >
					<a href="" class="main-user" >
						<div class="round-image"><img src="images/user-image.jpg" alt=""></div>
						<span>Santiago</span>
					</a>
					<div class="content-tab" style="display:none;">
        				<div class="content-tab-tip"></div>
        				<ul class="sub-account-menu">
        					<li><h4>Santiago Rojas</h4></li>
        					<li>
        						<div class="user-detill">
        							<div class="left-side"><img src="images/user-image.jpg" alt=""></div>
        							<div class="right-side">
        								<b>Santiago Rojas</b>
        								<p class="grey-user"><i class=""><img src="images/grey-location.png" alt=""></i> Verified User</p>
        								<a href="" class="btn btn-primary">View My Profile</a>
        							</div>
        						</div>
        					</li>
        					<li><a href="">Invite Friends</a></li>
        					<li><a href="">Verify Your Account</a></li>
        					<li><a href="">MarketPlace</a></li>
                            <li><a href="">History</a></li>
                            <li><a href="">Settings</a></li>
        					<li><a href="<?php echo $this->webroot;?>users/userlogout">Log Out</a></li>
        				</ul>
        			</div>
				</div>
    		</div>
		</div><!-- /.container-->
		<?php
	}
		?>



</nav>
		<section class="banner">
		<div class="container">
			<h1>You need it?  Find it here!</h1>
			<div class="search-holder">
				<div class="left-holder">
					<div class="part1">
						<input type="text" placeholder="Search"/>
					</div>
					<div class="part2">
						<input type="text" placeholder="Atlanta, GA"/>
					</div>
				</div>
				<button class="btn btn-primary">Go</button>
			</div>
			<div class="clearfix"></div>
			<div class="mouse-icon"><img src="<?php echo $this->webroot; ?>/images/mouse.png" alt=""></div>
		</div>
	</section>
 <section class="home-wrapper">
		<div class="container">
			<div class="row">
    <?php echo $this->fetch('content'); ?>
			</div>
		</div>
 </section>
<footer>
		<div class="footer_top">
			<div class="container">
				<div class="row">
					<div class="col-md-3">
						<div class="footer_logo">
							<img src="<?php echo $this->webroot; ?>/images/logo-bw.png" alt="" class="img-responsive">
						</div>
					</div>
					<div class="col-md-6">
						<ul class="footer-links">
							<li><a href="">About Niwi</a></li>
							<li><a href="">Blog</a></li>
							<li><a href="">Mobile App</a></li>
							<li><a href="">Help & Contact</a></li>
						</ul>
					</div>
					<div class="col-md-3">
						<ul class="social">
							<li><a href="" class="fa fa-facebook-official"></a></li>
							<li><a href="" class="fa fa-twitter"></a></li>
							<li><a href="" class="fa fa-google-plus-square"></a></li>
							<li><a href="" class="fa fa-instagram"></a></li>
						</ul>
					</div>
				</div>
<!--				<img src="<?php echo $this->webroot; ?>/images/logo_footer.png" alt="" />-->
			</div>
		</div>
		<div class="footer_middle">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<p>
							<span style="padding-right:12px"><img src="<?php echo $this->webroot; ?>/images/app-store.png" alt=""></span>
							<span style="padding-left:12px"><img src="<?php echo $this->webroot; ?>/images/google-play.png" alt=""></span>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="footer_bootom">
			<div class="container">
				<div class="row">
					<p class="copyright">© <?php echo date('Y'); ?> Niwi, LLC All Rights reserved. Niwi <a href="">Terms & Conditions,</a>  <a href="">Coockies Policy,</a> and <a href="">Privacy Policy</a></p>
				</div>
			</div>
		</div>
	</footer>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script>
 $('#signupclose').click(function(e){
        e.preventDefault();

        $('#Login')
            .modal('hide')
            .on('hidden.bs.modal', function (e) {
                $('#Register').modal('show');

                $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
            });

    });
	</script>

	 <script type="text/javascript">
	    $(document).ready(function () {
	        $('.main-user').click(function () {
	            $('.content-tab').slideToggle('fast');
	            return false;
	        });
	    });
	</script>

<?php echo $this->element('sql_dump'); ?>
</body>
</html>
