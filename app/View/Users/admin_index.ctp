
<section class="container">
    
    <div style="width: 366px; position: relative; height: auto; margin: 0px auto 20px;">
        <div style="float: left; width: 38%; margin-right: 5px;">
            <img style="margin: 0px; display: block; width: 100%;" src="<?php echo $this->webroot . 'site_logo/'. $logo; ?>">
        </div>
        <div style="float: left;">
            <b style="color: black; font-size: 31px; font-weight: bold; line-height: 140px;">Admin Panel</b>
        </div>
        <div style="clear:both;"></div>
    </div>
    
    <div class="login">
        <h1> Admin Login </h1>
        <form id="UserAdminLoginForm" name="UserAdminLoginForm" action="<?php echo $this->webroot; ?>admin/users/login" class="contact_form" method="post">
            <p><input type="email" name="data[User][usernamel]" maxlength="50" id="UserUsernameL" class="contact_text_box" placeholder="Enter your email address" required="required" value=""/></p>
            <p><input type="password" name="data[User][passwordl]" maxlength="50" id="UserPasswordL" class="contact_text_box" placeholder="Enter your password" required="required" value=""/></p>
            <p class="remember_me">
                <label>
                    <input type="checkbox" name="remember_me" id="remember_me">Keep me logged in
                </label>
            </p> 
            <div style="clear:both;"></div>
            <p class="submit"><input type="submit" name="commit" value="Login" style="float:none;width:87%;border-radius:0px;margin-bottom:20px;background:#FF0085;color:#ffffff;border-color:#FF0085;box-shadow:none !important;"></p>
            <div style="margin:0px;auto;width:100%;display:block;height:50px;border-top:1px solid #DEDEDE;">
                <div style="width: 41%;float:left;border-right:1px solid #DEDEDE;padding-top:10px;padding-bottom:10px; padding-left: 32px;"><a href="<?php echo $this->webroot; ?>admin/users/fotgot_password" style="color:#FF0085;text-decoration:none;">Forget Password</a></div>
                <div style="float:left;padding-top:10px;padding-bottom:10px; padding-left: 25px;"><a href="<?php echo $this->webroot; ?>admin/users/fotgot_password" style="color:#FF0085;text-decoration:none;">Need Help?</a></div>
            </div>
        </form>
    </div>

    <!--<div class="login-help" style="color:#000;text-shadow:none;">
      <p>Forgot your password? <a href="<?php echo $this->webroot; ?>admin/users/fotgot_password" style="color:blue">Click here to reset it</a>.</p>
    </div>-->
</section>
<style>
    body
    {
        background:#ddd !important;
    }
</style>