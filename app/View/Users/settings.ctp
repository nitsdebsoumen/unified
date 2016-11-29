<style type="text/css">
.pro_about{height:auto;width:773px;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.contact_form{margin:0 auto;width:730px;border:0px solid red;padding-top:00px;padding-bottom:00px;}
.contact_form tr{color:#6d6d6d;font-size:12px;line-height:10px;font-weight: normal;}
.contact_form tr td{float:left;margin:15px;text-align:left;color:#6d6d6d;}
.form_text{text-align:right !important;width:120px;color:#6d6d6d;font-size:12px;line-height:20px;margin-top:5px;bottom: 10px;font-weight: normal;margin-right:5px;padding-top:5px;}
.contact_text_box{height:30px;width:300px;border:1px solid #e1e1e1;background:#ffffff;border-radius:4px;-moz-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);-webkit-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);box-shadow: 0px 1px 1px rgba(182, 182, 182, 0.75);font-size:14px;line-height:20px;padding-left:10px;color:#6d6d6d;}
.btn_log{background: #0098d5;border-color: #DEDEDD #DEDEDD #DEDEDD -moz-use-text-color;border-image: none;border-style: solid solid solid none;border-width: 1px 1px 1px medium;color: #FFFFFF;cursor: pointer;float: left;font-weight: bold;height: 31px;line-height: 31px;padding: 0 21px;border-radius:4px;}
input:focus,textarea:focus,select:focus{
	border-color: #2A9BC7;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.333) inset, 0 0 6px rgba(42, 155, 199, 0.5);
    outline: 0 none;
	color:#6d6d6d;
}
.selectbox{border:1px solid #e1e1e1;width:310px;height:30px;border-radius:4px;-moz-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);-webkit-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);box-shadow: 0px 1px 1px rgba(182, 182, 182, 0.75);font-size:14px;color:#6d6d6d;padding-left:10px;}
.txtarea{border:1px solid #e1e1e1;border-radius:4px;-moz-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);-webkit-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);box-shadow: 0px 1px 1px rgba(182, 182, 182, 0.75);font-size:14px;color:#6d6d6d;padding-left:10px;}
.pro_right_btn{float:right !important;margin-right:10px;border:0px !important;margin-top:13px;}
</style>
<script type="text/javascript">
window.onload = function () {
    document.getElementById("UserPassword").onchange = validatePassword;
    document.getElementById("UserConPassword").onchange = validatePassword;
}
function validatePassword(){
var pass2=document.getElementById("UserConPassword").value;
var pass1=document.getElementById("UserPassword").value;
if(pass1!=pass2)
    document.getElementById("UserConPassword").setCustomValidity("Passwords Don't Match");
else
    document.getElementById("UserConPassword").setCustomValidity('');  
//empty string means no validation error
}	
</script>
<div class="profile_bak">
    <div class="profile_holder">
        <ul class="nav">
            <li><?php echo $this->Html->link($this->Html->image('settings_hover.png', array('alt' => 'Settings')), array('controller' => 'users', 'action' => 'settings', 'full_base' => true ),array('escapeTitle' => false, 'title' => ''));?></li>
            <li><?php echo $this->Html->link($this->Html->image('profile_massage.png', array('alt' => 'Inbox')), array('controller' => 'inbox_messages', 'action' => 'index', 'full_base' => true ),array('escapeTitle' => false, 'title' => ''));?></li>
            <li><?php echo $this->Html->link($this->Html->image('love.png', array('alt' => 'Favorites')), array('controller' => 'favorite_shops', 'action' => 'index/'.$this->request->data['User']['username'], 'full_base' => true ),array('escapeTitle' => false, 'title' => ''));?></li>
            <li class="pro_right_btn"><a href="<?php echo $this->webroot; ?>users/profile/<?php echo($this->request->data['User']['username'])?>" class="profile_btn">Profile</a></li>
        </ul>
        <div class="pro_left_cat">
        <?php
        $uploadFolder = "user_images";
        $uploadPath = WWW_ROOT . $uploadFolder;
        $imageName = $this->request->data['User']['profile_img'];
        if(file_exists($uploadPath . '/' . $imageName) && $imageName!=''){
                echo($this->Html->image('/user_images/'.$imageName, array('alt' => $this->request->data['User']['first_name'].'&nbsp;'.$this->request->data['User']['last_name'])));
        } else {
                echo($this->Html->image('/user_images/default.png', array('alt' => $this->request->data['User']['first_name'].'&nbsp;'.$this->request->data['User']['last_name'])));
        }
        ?>
        <p><span><?php echo($this->request->data['User']['first_name']);?>&nbsp;<?php echo($this->request->data['User']['last_name']);?></span><br/>
        <?php echo($this->request->data['User']['city']);?>,&nbsp;<?php echo($countryname);?>
        </p>
            <ul>
                <li class="pro_left_cat_active"><?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'profile/'.$this->request->data['User']['username'], 'full_base' => true ));?></li>
                <li><?php echo $this->Html->link('Favorites', array('controller' => 'favorite_shops', 'action' => 'index/'.$this->request->data['User']['username'], 'full_base' => true ));?></li>
                <li><?php echo $this->Html->link('Followers', array('controller' => 'shop_followings', 'action' => 'index/'.$this->request->data['User']['username'], 'full_base' => true ));?></li>						
                <li><?php echo $this->Html->link('Refer a Friend', array('controller' => 'users', 'action' => 'referrals', 'full_base' => true ));?></li>
                <li><?php echo $this->Html->link('Sell', array('controller' => 'shops', 'action' => 'create', 'full_base' => true ));?></li>
                <li><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'action' => 'index', 'full_base' => true ));?></li>
                <li><?php echo $this->Html->link('Purchases', array('controller' => 'orders', 'action' => 'purchased', 'full_base' => true ));?></li>
            </ul>
        </div>
        <div class="pro_about">
            <h2>Account Settings</h2>
            <form class="contact_form" action="<?php echo $this->webroot; ?>users/settings" method="post" enctype="multipart/form-data">
                <input type="hidden" name="data[User][id]" id="UserId" value="<?php echo($this->request->data['User']['id']);?>"/>
                <input type="hidden" name="data[User][hidpassword]" id="UserHidPassword" value="<?php echo($this->request->data['User']['password']);?>"/>
                <table>
                <tr>
                        <td class="form_text">Email:</td>
                        <td><input type="email" name="data[User][email]" maxlength="50" id="UserEmail" class="contact_text_box" placeholder="Enter your email" required="required" value="<?php echo($this->request->data['User']['email']);?>"/></td>
                </tr>
                <tr>
                        <td class="form_text">Password:</td>
                        <td><input type="password" name="data[User][password]" id="UserPassword" class="contact_text_box" placeholder="Enter your password"/></td>
                </tr>
                <tr>
                        <td class="form_text">Confirm Password:</td>
                        <td><input type="password" class="contact_text_box" name="data[User][conpassword]" id="UserConPassword" placeholder="Re-enter your password"/></td>
                </tr>
                <tr>
                        <td class="form_text">&nbsp;</td>
                        <td><input type="submit" value="Save Changes" class="btn_log"/></td>
                </tr>
                </table>
            </form>
        </div>
				
        <div class="clear"></div>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>
