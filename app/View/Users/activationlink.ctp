<!--<section class="login">
    <div class="container">
            <div class="row">
                <div class="col-md-3">&nbsp;</div>
                    <div class="col-md-6">
                            <h2>Forgot Password</h2>
                            <form class="form-horizontal" name="UserLoginForm" action="<?php echo $this->webroot; ?>users/forgotpassword" method="post" >
                              <div class="form-group">
                                <label for="inputEmail4" class="col-sm-4 control-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" name="data[User][email]" id="inputEmail3" placeholder="Enter your email" required="required">
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                  <button type="submit" class="btn btn-default">Submit</button>
                                </div>
                              </div>
                              <p>Your new password will be mailed to your email.</p>
                            </form>
                    </div>

            </div>
    </div>
</section>-->
<section class="login_body">
    <div class="login-holder">

      <h1><?php echo "Activation Link"; ?></h1>
      <form action="<?php echo $this->webroot.'users/activationlink';?>" method="post" id="forgotpassword">
        <div class="form-group">
          <input type="email" class="form-control " id="" name="data[User][email]"  placeholder="<?php echo ENTER_EMAIL;?>">

        </div>
        <div class="form-group">
         <button type="submit" class="btn btn-default pull-right"><?php echo SUBMIT; ?></button>
        </div>
      </form>

    </div>
  </section>
  <script>

$(document).ready(function() {
    $('#forgotpassword').formValidation({
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

              }
          }
    });
});
</script>