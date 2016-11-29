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
    <div style="clear:both;"></div>
    <div class="login">
        <h1>Forgot Password</h1>
        <form id="UserAdminLoginForm" name="UserAdminLoginForm" action="<?php echo $this->webroot; ?>admin/users/fotgot_password" class="contact_form" method="post">
            <p><input type="text" name="data[User][email_address]" maxlength="100" id="UserEmailL" class="contact_text_box" placeholder="Enter your email" required="required" value=""/></p>
            <p>&nbsp;&nbsp;Your new password will be mailed to your email</p>
            <p class="submit"><input type="submit" name="commit" value="Submit" style="float:none;width:87%;border-radius:0px;margin-bottom:20px;background:#FF0085;color:#ffffff;border-color:#FF0085;box-shadow:none !important;"></p>
        </form>
        <div style="margin:0px;auto;width:100%;display:block;height:50px;border-top:1px solid #DEDEDE;">
            <div style="width: 41%;float:left;border-right:1px solid #DEDEDE;padding-top:10px;padding-bottom:10px; padding-left: 32px;"><a href="<?php echo $this->webroot; ?>admin/" style="color:#FF0085;text-decoration:none;">Go Back</a></div>
            <div style="float:left;padding-top:10px;padding-bottom:10px; padding-left: 25px;"><a href="<?php echo $this->webroot; ?>admin/users/fotgot_password" style="color:#FF0085;text-decoration:none;">Need Help?</a></div>
        </div>
    </div>
</section>
