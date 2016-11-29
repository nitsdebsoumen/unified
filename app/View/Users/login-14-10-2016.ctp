<style>
  
  .social_buttons button {
    border: 0 none;
    border-radius: 2px;
    color: #fff;
    font-size: 14px;
    height: 35px;
    letter-spacing: 1px;
    margin: 5px 0;
    text-transform: uppercase;
    width: 100%;
}
.social_buttons .ln_btn
{
    background: #0077B5;
}
.IN-widget, .IN-widget span , span[id^='li_ui_li_gen_'], a[id^='li_ui_li_gen_']{
    width:100%; 
}
</style>

<script type="text/javascript">
//    $.ajaxSetup({cache: true});
//    $.getScript('//connect.facebook.net/en_US/all.js', function () {
//        FB.init({appId: '1509350872727862'});
//        $(".flogin").on("click", function (e) {
//            e.preventDefault();
//            FB.login(function (response) {
//                // FB Login Failed //
//                if (!response || response.status !== 'connected') {
//                    alert("Given account information are not authorised", "Facebook says");
//                } else {
//                    // FB Login Successfull //
//                    FB.api('/me', function (fbdata) {
//                        console.log(fbdata); //
//                        var fb_user_id = fbdata.id;
//                        var fb_first_name = fbdata.first_name;
//                        var fb_last_name = fbdata.last_name;
//                        var fb_email = fbdata.email;
//                        var fb_username = fbdata.username;
//                        $.post('<?php //echo($this->webroot); ?>users/autoLogin/' + fb_user_id, function (data) {
//                            var newData = '';
//                            newData = data.split('@@@@');
//                            if (newData[0] == 'Register') {
//                                /*$("#UserFbUserId").val(fb_user_id);
//                                 $("#UserFirstName").val(fb_first_name);
//                                 $("#UserLastName").val(fb_last_name);                                                                                   $("#UserEmail").val(fb_email);
//                                 $("#UserPassword").val(fb_user_id);
//                                 $("#UserConPassword").val(fb_user_id);
//                                 $('#SignUpFrm').submit();*/
//                                //$("#UserUsername").val(fb_username);
//                                $('#err_msg').html('');
//                                $('#err_msg').html('<div class="alert alert-danger"><strong>Error!</strong> At first you <a href="<?php //echo($this->webroot); ?>users/signup">signup</a> as a Facebook.</div>');
//                            } else if (newData[0] == 'Login') {
//                                window.location.href = "<?php //echo($this->webroot) ?>users/dashboard";
//                            }
//                        });
//                    })
//                }
//            }, {scope: "email"});
//        });
//    });
</script>
<section class="login_body">

    <div class="login-holder">
     
        <h1><?php echo LOGIN; ?></h1>
        <p id="social_login_msg" class="text-center" style="border-style:dotted;border-width: 2px;padding:5px;display:none;"></p>
        <form action="<?php echo $this->webroot . 'users/login'; ?>" method="post" id="signin">
            <div class="form-group">
                <input type="text" class="form-control " id="exampleInputEmail1" name="data[User][email]" placeholder="<?php echo EMAIL_USER; ?>" value="<?php echo $cookieHelper->read('email'); ?>" >
            </div>
            <div class="form-group">
            <input type="password" class="form-control " id="exampleInputPassword1" name="data[User][password]" placeholder="<?php echo PASSWORD; ?>" value="<?php echo $cookieHelper->read('password'); ?>" >
            </div>
            <div class="checkbox" style="border:none;">
                <label>
                    <input type="checkbox" name="data[User][rembme]" value="1" <?php
                    if ($cookieHelper->read('remember_me') == 1) {
                        echo "checked";
                    }
                    ?>> <?php echo REMEMBER_ME;?>
                </label>
                <a href="<?php echo $this->webroot . 'users/forgotpassword'; ?>" class="pull-right"><?php echo FORGOT_PASSWORD; ?></a>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-default pull-right"><?php echo LOGIN; ?></button>
            </div>
            <div class="form-group">
                <label><?php echo NOT_JOINED;?> <a href="<?php echo $this->webroot . 'users/signup'; ?>"><?php echo SIGN_UP; ?></a></label>
            </div>
        </form>
        <div class="or"><span>Or</span></div>
        <div class="social_buttons">
        	<!--<ul>
				<li><button class="fb_btn" id="fblogin"> <i class="fa fa-facebook"></i></button>
					<span><?php echo LOGIN_FACEBOOK; ?></span>
				</li>
				<li>
					<button class="twit_btn"> <i class="fa fa-twitter"></i></button>
					<span><?php echo LOGIN_TWITTER; ?></span>
				</li>
				<li>
					
                                        <a class="" href="Javascript: void(0);"><script type="in/Login"></script></a>
					<span><?php echo LOGIN_TWITTER; ?></span>
				</li>
			</ul>-->
            <button class="fb_btn" id="fblogin"><i class="fa fa-facebook"></i> <?php echo REGISTER_FACEBOOK; ?> </button>
            <button class="twit_btn"><i class="fa fa-twitter"></i> <?php echo REGISTER_TWITTER; ?></button>
            <a class="" href="Javascript: void(0);" style="display: inline-block; width: 100%;"><script type="in/Login"></script></a>
        </div>
    </div>
</section>

<!--<section class="login">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="err_msg"></div>
                </div>
                    <div class="col-md-6">
                            <h2>Have an account already? Sign in</h2>
                            <form class="form-horizontal" name="UserLoginForm" action="<?php //echo $this->webroot;     ?>users/login" method="post" >
                              <div class="form-group">
                                <label for="inputEmail4" class="col-sm-4 control-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="data[User][email]" id="inputEmail3" placeholder="Enter your email" required="required">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                                <div class="col-sm-8">
                                  <input type="password" class="form-control" name="data[User][passwordl]" id="inputPassword3" placeholder="Enter your password" required="required">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                  <div class="checkbox">
                                    <label>
                                      <input type="checkbox"> Remember me
                                    </label>
                                    <a href="<?php //echo $this->webroot;     ?>users/forgotpassword" class="pull-right">Forgot your password?</a>              </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                  <button type="submit" class="btn btn-default">Sign in</button>-->

<!--<button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModalsign">Modal</button>-->
<!-- </div>

 
</div>
<p>Haven't joined yet? <a href="<?php //echo $this->webroot;    ?>users/signup">Sign up</a></p>
</form>
</div>
<div class="col-md-1 or">
<h2>OR</h2>
</div>
<div class="col-md-5 socials">
<ul>
 <li><a href="Javascript: void(0);" class="flogin"><img src="<?php //echo $this->webroot;    ?>images/fb.png" alt="" /></a></li>
 <li><a href="<?php //echo $this->webroot.'users/twitter_login';     ?>"><img src="<?php echo $this->webroot; ?>images/tweet.png" alt="Twitter Login" /></a></li>
</ul>
</div>
</div>
</div>
</section>-->


<!-- Modal -->
<!--<div class="modal fade" id="myModalsign" role="dialog">
  <div class="modal-dialog modal-sm" style="width:300px;">-->

<!-- Modal content-->
<!--<div class="modal-content">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 style="font-size:21px;" class="modal-title">Successfully Registered</h4>
  </div>
  <div class="modal-body">
    <p style="padding:10px; text-align:center;">Welcome to Errand Champion, you have successfully registered to this site.</p>
     <p><img src="<?php echo $this->webroot; ?>images/errandddddddd.png" class="img-responsive" style="margin:0 auto;"></p>
     <p style="padding:10px; text-align:center;">Please check the mail that you shall receive in your errand champion inbox.</p>
  </div>
  <div class="modal-footer" style="border-top:none;">-->
<!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
<!--</div>
</div>

</div>
</div>-->
<!--<script>
$(document).ready(function(){ 
var RefferLink ='<?php echo isset($RefferLink) ? $RefferLink : ''; ?>';
if(RefferLink!='' && RefferLink=='1'){
$('#myModalsign').modal('show');
}   
});	
</script>-->



<script>

  /*  (function ($) {

        $("#signin").validationEngine();
    })(jQuery);*/

$(document).ready(function() {
    $('#signin').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'data[User][email]': {
                /* Initially, the validators of this field are disabled */
               
                validators: {
                    notEmpty: {
                        message: 'The email address is required and cannot be empty'
                    },
                    emailAddress: {
                        message: 'The email address is not valid'
                    }
                }

            },
            'data[User][password]': {
                validators: {
                    notEmpty: {
                        message: 'The username is required and cannot be empty'
                    }
                }
            }
  
        }
    });
});


    $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
        FB.init({
            appId: '147920998965529',
            status: true,
            xfbml: true,
            version: 'v2.6'
        });
        $('#fblogin').click(function (e) {
            e.preventDefault();
            FB.login(function (response) {
                console.log(response);
                if (!response || response.status !== 'connected') {
                    alert('Failed');
                } else {

                    FB.api('/me', {fields: 'id,first_name,last_name,email'}, function (response) {
                        //console.log(response);
                        var fb_user_id = response.id;
                        var fb_first_name = response.first_name;
                        var fb_last_name = response.last_name;
                        var fb_email = response.email;
                        //console.log(JSON.stringify(response));

                        $.ajax({
                            url: '<?php echo $this->webroot . 'users/sociallogin'; ?>',
                            type: 'post',
                            dataType: 'json',
                            data: {
                                fbId: fb_user_id,
                                email: fb_email,
                                fname: fb_first_name,
                                lname: fb_last_name,
                                signupby: 'facebook'
                            },
                            beforeSend: function () {
                                $('#social_login_msg').css({
                                    'border-color': '#0f0'
                                }).text('Sending please wait...').show();
                            },
                            success: function (data) {
                                //console.log(data);
                                if (data.ack == '1') {
                                    $('#social_login_msg').css({
                                        'border-color': '#0f0'
                                    }).text(data.msg).show();
                                    setTimeout(function () {
                                        window.location.href = '<?php echo $this->webroot; ?>';
                                    }, 3000);
                                    

                                } else {
                                    $('#social_login_msg').css({
                                        'border-color': '#0f0'
                                    }).text(data.msg).show();
                                    setTimeout(function () {
                                        $('#social_login_msg').hide();
                                    }, 3000);
                                }
                            }
                        });
                    });
                }
            }, {scope: 'public_profile,email'});
        });

    });
    
    
    
    // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
        $('a[id*=li_ui_li_gen_]').html('<button class="ln_btn"><i class="fa fa-linkedin"></i> <?php echo 'Register With Linkedin'; ?></button>');
        IN.Event.on(IN, "auth", getProfileData);
    }

    // Handle the successful return from the API call
    function onSuccess(data) {
        console.log(data);
        var ln_id = data.values[0].id;
        var ln_email = data.values[0].emailAddress;
        var ln_firstName = data.values[0].firstName
        var ln_lastName = data.values[0].lastName;
        
        $.ajax({
            url: '<?php echo $this->webroot . 'users/linkedinLoginRegister' ?>',
            type: 'post',
            dataType: 'json',
            data: {
                ln_id: ln_id,
                ln_email: ln_email,
                ln_firstName: ln_firstName,
                ln_lastName: ln_lastName
            },
            success: function(data) {
                if(data.ack == 1) {
                    if(data.url != '') {
                        window.location.href = data.url;
                    } else {
                        location.reload();
                    }
                } else {
                    
                    location.reload();
                }
            }
        });

    }

    // Handle an error response from the API call
    function onError(error) {
        //console.log(error);
        $('#errMsg').html('');
        $('#errMsg').html('<div class="col-md-12"><div class="alert alert-danger"><strong>Error!</strong>'+error+'</div></div>');
    }

    // Use the API call wrapper to request the member's basic profile data
    function getProfileData() {
        //IN.API.Raw("/people/~").result(onSuccess).error(onError);
        IN.API.Profile("me").fields("id","first-name", "last-name", "email-address").result(onSuccess).error(onError);

    }
</script>
<?php 
if ( isset($_SERVER['HTTP_CLIENT_IP']) && ! empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif ( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && ! empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
}

$ip = filter_var($ip, FILTER_VALIDATE_IP);
$ip = ($ip === false) ? '0.0.0.0' : $ip;
?>


