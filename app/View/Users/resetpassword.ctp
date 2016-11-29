<section class="login_body">
     
    <div class="login-holder">
      <h1><?php echo RESET_PASSWORD; ?></h1>
      <form action="<?php echo $this->webroot.'users/resetpassword/'.$id;?>" method="post" id="resetpassword">
        <div class="form-group">
          <input type="password" class="form-control " id="password" name="data[User][password]"  placeholder="<?php echo ENTER_NEW_PASSWORD; ?>"/>
          <input type="hidden" class="form-control" id="userid" name="data[User][id]" value="<?php echo base64_decode($id); ?>"/>
          </div>
          <div class="form-group">
          <input type="password" class="form-control " id="confirmpassword" name="data[User][confpassword]"  placeholder="<?php echo CONFIRM_PASSWORD;?>"/>
          </div>
        <div class="form-group">
         <button type="submit" class="btn btn-default pull-right"><?php echo SUBMIT; ?></button>
        </div>
      </form>
      </div>
  </section>
<script>
$(document).ready(function() {
    $('#resetpassword').formValidation({
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
            'data[User][confpassword]': {
            validators: {
              notEmpty: {
                        message: 'The Confirm Password is required and cannot be empty'
                    },
                identical: {
                    field: 'data[User][password]',
                    message: 'The password and its confirm are not the same'
                }
            }
        }
        
     
        }
    });
});
</script>