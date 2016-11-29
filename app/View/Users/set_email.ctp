<?php
?>
<section class="login">
    <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="err_msg"></div>
                </div>
                    <div class="col-md-6">
                            <h2 style="margin-left:123px;">Please enter your email.</h2>
                            <form class="form-horizontal" name="UserLoginForm" action="" method="post" >
                              <div class="form-group">
                                <label for="inputEmail4" class="col-sm-4 control-label">Email :</label>
                                <div class="col-sm-8">
                                    <input type="email" class="form-control" value="<?php echo (!empty($this->request->data['User']['email'])?$this->request->data['User']['email']:''); ?>" name="data[User][email]" id="inputEmail3" placeholder="Enter your email" required="required">
                                </div>
                              </div>
                              
                              <div class="form-group">
                                <div class="col-sm-offset-4 col-sm-8">
                                  <button type="submit" class="btn btn-default">Sign Up</button>
                                </div>
                              </div>
                              <!--<p>Haven't joined yet? <a href="<?php echo $this->webroot;?>users/signup">Sign up</a></p>-->
                            </form>
                    </div>
                    
            </div>
    </div>
</section>
