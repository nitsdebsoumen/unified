<?php //print_r($lgas); exit;?>
<style>
  #alertDayMessage2 small, #alertDayMessage1 small, #alertDayMessage small { color : #a94442;}
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

<section class="login_body">

    <div class="login-holder">
   
        <h1><?php echo REGISTER_AS; ?></h1>
        <p id="social_login_msg" class="text-center" style="border-style:dotted;border-width: 2px;padding:5px;display:none;"></p>
        <ul class="nav nav-tabs new_tabs" role="tablist">
            <li role="presentation" class="<?php if($signup_type=='' || $signup_type==2){ echo 'active'; } ?>"><a href="#Provider" aria-controls="Provider" role="tab" data-toggle="tab"><?php echo INDIVISUAL_USER; ?></a></li>
            <li role="presentation" class="" ><a href="#User" aria-controls="User" role="tab" data-toggle="tab"><?php echo PROVIDER; ?></a></li>
            <li role="presentation"><a href="#Individual" aria-controls="Individual" role="tab" data-toggle="tab"><?php echo CORPORATE_USER; ?></a></li>
        </ul>
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="Provider">

                <form action="<?php echo $this->webroot . 'users/signup'; ?>" method="post" id="signup1">
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][first_name]" placeholder="<?php echo FIRST_NAME; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][last_name]" placeholder="<?php echo LAST_NAME; ?>">
                    </div>
                 
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][email]" placeholder="<?php echo EMAIL; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][phone]" placeholder="<?php echo PHONE; ?> ">
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="indCountry" name="data[User][country]">
                            <?php foreach ($countries as $key => $country) { ?>
                                                        
                            <option value="<?php echo $country['Country']['id']; ?>" <?php if($country['Country']['name']=='Nigeria'){ echo "selected";} ?> ><?php echo $country['Country']['name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="indState" name="data[User][state]" >
                            <?php foreach ($states as $key => $state) { ?>
                                                        
                            <option value="<?php echo $state['State']['id']; ?>"><?php echo $state['State']['name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="indLga" name="data[User][lga]" <?php if($country['Country']['name']=='Nigeria'){ echo "disabled";} ?> placeholder="Select LGA" >
                            
                            <?php foreach ($lgas as $key => $lga) { ?>
                            <option value="<?php echo $lga['Lga']['id']; ?>"><?php echo $lga['Lga']['local_name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password" name="data[User][password]" placeholder="<?php echo PASSWORD; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"  name="data[User][conpassword]" placeholder="<?php echo CONFIRM_PASSWORD; ?>">
                    </div>
                    <div class="checkbox" style="border:none;">
                        <label>
                            <input  name="user_terms2" type="checkbox" value="1"> <?php echo I_AGREE_TO; ?> <a href=""><?php echo USER_TERMS; ?></a>
                        </label>
                        <div id="alertDayMessage"></div>
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="data[User][admin_type]" value="4">
                        <button type="submit" class="btn btn-default pull-right"><?php echo REGISTER; ?></button>
                    </div>
                    <div class="form-group">
                        <label><?php echo ALREADY_HAVE_ACCOUNT; ?> <a href="<?php echo $this->webroot; ?>users/login"><?php echo SIGN_IN; ?></a></label>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="User">
                <form action="<?php echo $this->webroot . 'users/signup'; ?>" id="signup2" method="post">
                     <div class="form-group">
                        <center><select class="form-control" id="select_user" name="data[User][admin_type]">
                            <option value=""><?php echo SELECT_AN_OPTION; ?></option>
                            <option value="2"><?php echo TRAINING_PROVIDER; ?></option>
                            <option value="1"><?php echo VENUE_PROVIDER;?></option>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][first_name]" placeholder="<?php echo FIRST_NAME; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][last_name]" placeholder="<?php echo LAST_NAME; ?>">
                    </div>
                       <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][business_name]" placeholder="<?php echo BUSINESS_NAME; ?>">
                    </div> 

                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][email]" placeholder="<?php echo EMAIL; ?>">
                    </div>
                    <div class="form-group">
                        <input type="tel" class="form-control country-list"  name="data[User][phone]" placeholder="<?php echo PHONE; ?>">
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="proCountry" name="data[User][country]">
                            <?php foreach ($countries as $key => $country) { ?>
                                                        
                            <option value="<?php echo $country['Country']['id']; ?>" <?php if($country['Country']['name']=='Nigeria'){ echo "selected";} ?> ><?php echo $country['Country']['name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="proState" name="data[User][state]">
                            <?php foreach ($states as $key => $state) { ?>
                                                        
                            <option value="<?php echo $state['State']['id']; ?>"><?php echo $state['State']['name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="proLga" name="data[User][lga]" <?php if($country['Country']['name']=='Nigeria'){ echo "disabled";} ?> placeholder="Select LGA" >
                           
                            <?php foreach ($lgas as $key => $lga) { ?>
                            <option value="<?php echo $lga['Lga']['id']; ?>"><?php echo $lga['Lga']['local_name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password1" name="data[User][password]" placeholder="<?php echo PASSWORD; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"  name="data[User][conpassword]" placeholder="<?php echo CONFIRM_PASSWORD; ?>">
                    </div>
                    <div class="checkbox" style="border:none;">
                        <label>
                            <input  name="user_terms1" type="checkbox" value="1"> <?php echo I_AGREE_TO; ?> <a href=""><?php echo USER_TERMS; ?></a>
                        </label>
                    </div>
                    <div id="alertDayMessage1"></div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-default pull-right"><?php echo REGISTER; ?></button>
                    </div>
                    <div class="form-group">
                        <label><?php echo ALREADY_HAVE_ACCOUNT; ?> <a href="<?php echo $this->webroot; ?>users/login"><?php echo SIGN_IN; ?></a></label>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="Individual">
                <form action="<?php echo $this->webroot . 'users/signup'; ?>" method="post" id="signup3">
                   
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][first_name]" placeholder="<?php echo FIRST_NAME; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][last_name]" placeholder="<?php echo LAST_NAME; ?>">
                    </div>
                    <!--<div class="form-group">
                        <input type="text" class="form-control " id="" name="data[User][business_name]" placeholder="<?php echo EVENT_PROVIDER_NAME; ?>">
                    </div>--> 
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][email]" placeholder="<?php echo EMAIL; ?>">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control"  name="data[User][phone]" placeholder="<?php echo PHONE; ?>">
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="corCountry" name="data[User][country]">
                            <?php foreach ($countries as $key => $country) { ?>
                                                        
                            <option value="<?php echo $country['Country']['id']; ?>" <?php if($country['Country']['name']=='Nigeria'){ echo "selected";} ?> ><?php echo $country['Country']['name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="corState" name="data[User][state]">
                            <?php foreach ($states as $key => $state) { ?>
                                                        
                            <option value="<?php echo $state['State']['id']; ?>"><?php echo $state['State']['name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <center><select class="form-control" id="corLga" name="data[User][lga]" <?php if($country['Country']['name']=='Nigeria'){ echo "disabled";} ?> placeholder="Select LGA" >
                            
                            <?php foreach ($lgas as $key => $lga) { ?>
                            <option value="<?php echo $lga['Lga']['id']; ?>"><?php echo $lga['Lga']['local_name']; ?></option>
                            <?php }?>
                        </select></center>    
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="password2" name="data[User][password]" placeholder="<?php echo PASSWORD; ?>">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control"  name="data[User][conpassword]" placeholder="<?php echo CONFIRM_PASSWORD; ?>">
                    </div>
                    <div class="checkbox" style="border:none;">
                        <label>
                            <input   name="user_terms" type="checkbox" value="1"> <?php echo I_AGREE_TO; ?> <a href=""><?php echo USER_TERMS; ?></a>
                        </label>
                    </div>
                    <div id="alertDayMessage2"></div>
                    <div class="form-group">
                    <input type="hidden" name="data[User][admin_type]" value="3">
                    <button type="submit" class="btn btn-default pull-right"><?php echo REGISTER; ?></button>
                    </div>
                    <div class="form-group">
                        <label><?php echo ALREADY_HAVE_ACCOUNT; ?> <a href="<?php echo $this->webroot; ?>users/login"><?php echo SIGN_IN; ?></a></label>
                    </div>
                </form>
            </div>
        </div>
        <div class="or"><span><?php echo USER_OR; ?></span></div>
        <div class="social_buttons">
            <button class="fb_btn" id="fblogin"><i class="fa fa-facebook"></i><?php echo REGISTER_FACEBOOK; ?> </button>
            <button class="twit_btn"><i class="fa fa-twitter"></i><?php echo REGISTER_TWITTER; ?></button>
            <a  href="Javascript: void(0);" style="display: inline-block; width: 100%;"><script type="in/Login" ></script></a>

        </div>

    </div>
</section>

<div id="set_email" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo SET_EMAIL; ?></h4>
            </div>
            <div class="modal-body">
                <form id="set_email_form">
                    <p class="text-center" id="set_email_msg" style="border-width: 2px; border-style: dotted; padding: 5px; border-color: #000; display: none;"></p>
                    <div class="form-group">
                        <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Enter email" required="" />
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" id="user_pass" name="user_pass" placeholder="Enter password" required="" />
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="user_id" name="user_id" />
                        <button type="submit" class="btn btn-primary" id="set_email_submit" name="set_email_submit" placeholder="<?php echo ENTER_EMAIL; ?>"> <?php echo SUBMIT; ?></button> 
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        
        <?php if($signup_type==1){ ?>
            $('a[href="#User"]').tab('show');
        <?php } ?>

        $('#signup1,#signup2,#signup3')
        .find('[name="data[User][phone]"]')
            .intlTelInput({
                utilsScript: '<?php echo $this->webroot; ?>js/utils.js',
                autoPlaceholder: true,
                preferredCountries: ['ng']
            });
        
        $("#signup1,#signup3").formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'data[User][first_name]': {
                    validators: {
                        notEmpty: {
                            message: 'The First Name is required and cannot be empty'
                        }
                    }
                },
                'data[User][last_name]': {
                    validators: {
                        notEmpty: {
                            message: 'The Last Name is required and cannot be empty'
                        }
                    }
                },
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
                            message: 'The password is required and cannot be empty'
                        }
                    }
                },
                'data[User][conpassword]': {
                    validators: {
                        notEmpty: {
                            message: 'The Confirm Password is required and cannot be empty'
                        },
                        identical: {
                            field: 'data[User][password]',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                
                'data[User][phone]': {
                    validators: {
                        notEmpty: {
                            message: 'The phone number is not valid'
                        },
                        callback: {
                            message: 'The phone number is not valid',
                            callback: function(value, validator, $field) {
                                return value === '' || $field.intlTelInput('isValidNumber');
                            }
                        }
                    }
                },
                
                user_terms2: {
                    err: '#alertDayMessage',
                    validators: {
                        notEmpty: {
                            message: 'Please choose this checkbox'
                        }
                    }
                },
                user_terms: {
                    err: '#alertDayMessage2',
                    validators: {
                        notEmpty: {
                            message: 'Please choose this checkbox'
                        }
                    }
                }


            }
        })
        .on('click', '.country-list', function() {
            $('#signup1,#signup3').formValidation('revalidateField', 'data[User][phone]');
        });
    });
    
    $(document).ready(function () {
        $("#signup2").formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                'data[User][first_name]': {
                    validators: {
                        notEmpty: {
                            message: 'The First Name is required and cannot be empty'
                        }
                    }
                },
                'data[User][last_name]': {
                    validators: {
                        notEmpty: {
                            message: 'The Last Name is required and cannot be empty'
                        }
                    }
                },
                'data[User][business_name]': {
                    validators: {
                        notEmpty: {
                            message: 'The  is required and cannot be empty'
                        }
                    }
                },
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
                            message: 'The password is required and cannot be empty'
                        }
                    }
                },
                'data[User][conpassword]': {
                    validators: {
                        notEmpty: {
                            message: 'The Confirm Password is required and cannot be empty'
                        },
                        identical: {
                            field: 'data[User][password]',
                            message: 'The password and its confirm are not the same'
                        }
                    }
                },
                
                'data[User][phone]': {
                    validators: {
                        notEmpty: {
                            message: 'The phone number is not valid'
                        },
                        callback: {
                            message: 'The phone number is not valid',
                            callback: function(value, validator, $field) {
                                return value === '' || $field.intlTelInput('isValidNumber');
                            }
                        }
                    }
                },
                
                'data[User][admin_type]': {
                    validators: {
                        notEmpty: {
                            message: 'Please select an option.'
                        }
                    }
                },
                
                user_terms1: {
                    err: '#alertDayMessage1',
                    validators: {
                        notEmpty: {
                            message: 'Please choose this checkbox'
                        }
                    }
                }
            }
        })
        .on('click', '.country-list', function() {
            $('#signup2').formValidation('revalidateField', 'data[User][phone]');
        });
    });



    /*(function ($) {
     //$("#signup1,#signup2,#signup3").validationEngine();
     
     $(document).on('submit', '#set_email_form', function(){
     $.ajax({
     url: '<?php echo $this->webroot . 'users/setsocialemail'; ?>',
     type: 'post',
     dataType: 'json',
     data: {
     userid: $('#user_id').val(),
     useremail: $('#user_email').val(),
     userpass: $('#user_pass').val()
     },
     beforeSend: function() {
     $('#set_email_msg').css({
     'border-color': '#000'
     }).text('Sending..').show();
     },
     success: function(data) {
     //console.log(data);
     if(data.ack == '1') {
     $('#set_email_msg').css({
     'border-color': '#0f0'
     }).text(data.msg).show();
     
     setTimeout(function(){
     window.location.href = '<?php echo $this->webroot; ?>';
     }, 3000);
     } else {
     $('#set_email_msg').css({
     'border-color': '#f00'
     }).text(data.msg).show();
     }
     }
     });
     
     return false;
     });
     })(jQuery);*/
    
    // Setup an event listener to make an API call once auth is complete
    function onLinkedInLoad() {
        $('a[id*=li_ui_li_gen_]').html('<button class="ln_btn"><i class="fa fa-linkedin"></i> <?php echo 'Register With Linkedin'; ?></button>');
        IN.Event.on(IN, "auth", getProfileData);
    }
     // Handle the successful return from the API call
    function onSuccess(data) {
        console.log(data);
        var ln_id           = data.values[0].id;
        var ln_email        = data.values[0].emailAddress;
        var ln_firstName    = data.values[0].firstName
        var ln_lastName     = data.values[0].lastName;
        
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
                         onLinkedInLoad();
                    }
                } else {
                    
                    onLinkedInLoad();
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

    //Facebook login
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
                            url: '<?php echo $this->webroot . 'users/socialSignup'; ?>',
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
                                if (data.Ack == '1') {
                                    $('#social_login_msg').css({
                                        'border-color': '#0f0'
                                    }).text(data.msg).show();

                                    window.location.href = '<?php echo $this->webroot . 'users/editprofile'; ?>';
                                    //$('#user_id').val(data.UserDetails.userid);
                                    //$('#set_email').modal('show');

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

$(document).ready(function(){
    $("#indCountry").change(function(){
        var country_id = $(this).val();
        if(country_id==160)
        {
            $("#indLga").prop('disabled', false);
            $("#indLga").val(1);
        }
        else
        {
           $("#indLga").prop('disabled', true);
           $("#indLga").val(''); 
        }
        $.ajax({
            url: "<?php echo $this->webroot; ?>states/ajaxStates",
            type: 'post',
            dataType: 'json',
            data: {
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#indState').html(result.html);
                } else {
                    $('#indState').html(result.html);
                }
            }
        });
    });
    $("#proCountry").change(function(){
        var country_id = $(this).val();
        if(country_id==160)
        {
            $("#proLga").prop('disabled', false);
            $("#proLga").val(1);
        }
        else
        {
           $("#proLga").prop('disabled', true);
           $("#proLga").val(''); 
        }
        $.ajax({
            url: "<?php echo $this->webroot; ?>states/ajaxStates",
            type: 'post',
            dataType: 'json',
            data: {
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#proState').html(result.html);
                } else {
                    $('#proState').html(result.html);
                }
            }
        });
    });
    $("#corCountry").change(function(){
        var country_id = $(this).val();
        if(country_id==160)
        {
            $("#corLga").prop('disabled', false);
            $("#corLga").val(1);
        }
        else
        {
           $("#corLga").prop('disabled', true);
           $("#corLga").val(''); 
        }
        $.ajax({
            url: "<?php echo $this->webroot; ?>states/ajaxStates",
            type: 'post',
            dataType: 'json',
            data: {
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#corState').html(result.html);
                } else {
                    $('#corState').html(result.html);
                }
            }
        });
    });
 });

</script>
<style>
.intl-tel-input
{
display:block !important;
}
</style>

