<!--<?php //echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
        <div class="row">
                <div class="col-md-3">
                    <?php //echo $this->element('user_sidebar'); ?>
                </div>
                <div class="col-md-9">
                    <div class="whit_bg">
                    <div class="right_dash_board">
                        <h1>Change Password</h1>
                        <div id="cp_validation_err_msg"></div>
                        <form class="edit_profile" method="post" action=''>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="curr_pass">Current Password</label>
                                    <input class="form-control" id="curr_pass" type="password" name="data[User][curr_pass]" required="required">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-6">
                                    <label for="new_pass">New Password</label>
                                    <input class="form-control" id="new_pass" type="password" name="data[User][new_pass]" required="required">
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group col-md-6">
                                    <label for="con_pass">Repeat Password</label>
                                    <input class="form-control" id="con_pass" type="password" name="data[User][con_pass]" required="required">
                                </div>								
                                <div class="form-group col-md-12">
                                   <button type="submit" onclick="return validate_changepassword();">Save password</button>
                                </div>
                            </div>
                        </form>
                    </div> 
                </div>
                </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    function validate_changepassword(){
        var curr_pass=$('#curr_pass').val();
        var new_pass=$('#new_pass').val();
        var con_pass=$('#con_pass').val();
        if(curr_pass==''){
          $('#curr_pass').css('border','1px solid #e50516');
        }else{
          $('#curr_pass').css('border','1px solid #ccc');
        }
        if(new_pass==''){
          $('#new_pass').css('border','1px solid #e50516');
        }else{
          $('#new_pass').css('border','1px solid #ccc');
        }
        if(con_pass==''){
          $('#con_pass').css('border','1px solid #e50516');
        }else{
          $('#con_pass').css('border','1px solid #ccc');
        }
        
        if(new_pass != con_pass){
            $('#new_pass').css('border','1px solid #e50516');
            $('#con_pass').css('border','1px solid #e50516');
            $('#cp_validation_err_msg').html('<font style="color:#e50516">Password mismatch</font>');
            return false;
        }else{
            $('#cp_validation_err_msg').html('');
            return true;
        }
    }
</script>-->

<section class="listing_result">
    <div class="container">
        <div class="row">
             <?php echo($this->element('leftpanel'))?>
             <div class="col-md-8">
                <div class="right_bar">
                    <form class="form-horizontal" action="<?php echo $this->webroot.'users/change_password/';?>" method="post" id="change_password">
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo CURRENT_PASSWORD.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control border" id="password" name="data[User][password]"  placeholder="" >
                            </div>
                           
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text"><?php echo ENTER_NEW_PASSWORD.':';?></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control border" id="newpassword" name="data[User][newpassword]"  placeholder="" >
                            </div>
                         
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text"><?php echo CONFIRM_PASSWORD.':'; ?></label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control border" id="confirmpassword" name="data[User][confpassword]"  placeholder="" >
                            </div>
                           
                        </div>
                         <div class="form-group profile-field">
                            <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-default"><?php echo SUBMIT; ?></button>
                         </div>
                            </div>
                    </form>
                </div>
             </div>               
     
  </div>
</div>
  </section>
<script>

// Validation 
$(document).ready(function() {
    $('#change_password').formValidation({
        framework: 'bootstrap',
        excluded: ':disabled',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
                   
            'data[User][password]': {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    }
                }
            },
            'data[User][newpassword]': {
                validators: {
                    notEmpty: {
                        message: 'The password is required and cannot be empty'
                    }
                }
            },
            'data[User][confpassword]': {
            validators: {
              notEmpty: {
                        message: 'The Confirm Password is required and cannot be empty'
                    },
                identical: {
                    field: 'data[User][newpassword]',
                    message: 'The password and its confirm are not the same'
                }
            }
        }
        
     
        }
    });
});
</script>
<script>
    $(function(){
        $('.edit-pro-icon > .fa.fa-pencil-square-o').click(function(){
            window.location.href = '<?php echo $this->webroot . 'users/editprofile'; ?>';
        });
    });
</script>

<!--<div class="col-md-8">
     <div class="right_bar"> 
    <div class="login-holder">
      <h1>Change Password</h1>
      <form class="form-horizontal" action="<?php echo $this->webroot.'users/change_password/';?>" method="post" id="change_password">
        <div class="form-group">
          <input type="password" class="form-control " id="password" name="data[User][password]"  placeholder="Enter Old Password"/>
          <input type="hidden" class="form-control" id="userid" name="data[User][id]" value="<?php //echo base64_decode($id); ?>"/>
          </div>
            <div class="form-group">
          <input type="password" class="form-control " id="newpassword" name="data[User][newpassword]"  placeholder="<?php echo ENTER_NEW_PASSWORD;?>"/>
          </div>
          <div class="form-group">
          <input type="password" class="form-control " id="confirmpassword" name="data[User][confpassword]"  placeholder="<?php echo CONFIRM_PASSWORD;?>"/>
          </div>
        <div class="form-group">
         <button type="submit" class="btn btn-default pull-right"><?php echo SUBMIT; ?></button>
        </div>
      </form>
      </div> -->