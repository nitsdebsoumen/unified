<?php
$title=urlencode('ShopsFit');
$url=urlencode('http://shopsfit.com/users/signup/'.base64_encode($user['User']['id']));
$image=urlencode('http://shopsfit.com/img/logo.png');
?>
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
.referalBox{float:left;border:1px dashed #bcbcbc;padding:0px 40px 0px 40px;margin:22px;cursor:pointer;}
</style>

	<div class="profile_bak">
			<div class="profile_holder">
				<ul class="nav">
					<li><?php echo $this->Html->link($this->Html->image('settings.png', array('alt' => 'Settings')), array('controller' => 'users', 'action' => 'settings', 'full_base' => true ),array('escapeTitle' => false, 'title' => ''));?></li>
					<li><?php echo $this->Html->link($this->Html->image('profile_massage.png', array('alt' => 'Inbox')), array('controller' => 'inbox_messages', 'action' => 'index', 'full_base' => true ),array('escapeTitle' => false, 'title' => ''));?></li>
					<li><?php echo $this->Html->link($this->Html->image('love.png', array('alt' => 'Favorites')), array('controller' => 'favorite_shops', 'action' => 'index/'.$user['User']['username'], 'full_base' => true ),array('escapeTitle' => false, 'title' => ''));?></li>
					<li class="pro_right_btn"><a href="<?php echo $this->webroot; ?>users/profile/<?php echo($user['User']['username'])?>" class="profile_btn">Profile</a></li>
				</ul>
				<div class="pro_left_cat">
					<?php
					$uploadFolder = "user_images";
					$uploadPath = WWW_ROOT . $uploadFolder;
					$imageName = $user['User']['profile_img'];
					if(file_exists($uploadPath . '/' . $imageName) && $imageName!=''){
						echo($this->Html->image('/user_images/'.$imageName, array('alt' => $user['User']['first_name'].'&nbsp;'.$user['User']['last_name'])));
					} else {
						echo($this->Html->image('/user_images/default.png', array('alt' => $user['User']['first_name'].'&nbsp;'.$user['User']['last_name'])));
					}
					?>
					<p><span><?php echo($user['User']['first_name']);?>&nbsp;<?php echo($user['User']['last_name']);?></span><br/>
					<?php echo($user['User']['city']);?>,&nbsp;<?php echo($countryname);?>
					</p>
					<ul>
						<li><?php echo $this->Html->link('Profile', array('controller' => 'users', 'action' => 'profile/'.$user['User']['username'], 'full_base' => true ));?></li>
						<li><?php echo $this->Html->link('Favorites', array('controller' => 'favorite_shops', 'action' => 'index/'.$user['User']['username'], 'full_base' => true ));?></li>
						<li><?php echo $this->Html->link('Followers', array('controller' => 'shop_followings', 'action' => 'index/'.$user['User']['username'], 'full_base' => true ));?></li>
						<li class="pro_left_cat_active"><?php echo $this->Html->link('Refer a Friend', array('controller' => 'users', 'action' => 'referrals', 'full_base' => true ));?></li>
						<li><?php echo $this->Html->link('Sell', array('controller' => 'shops', 'action' => 'create', 'full_base' => true ));?></li>
						<li><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'action' => 'index', 'full_base' => true ));?></li>
						<li><?php echo $this->Html->link('Purchases', array('controller' => 'orders', 'action' => 'purchased', 'full_base' => true ));?></li>
					</ul>
				</div>
				<div class="pro_about">
					<h2>Send Referrals</h2>
					<h4 style="color:#4c4c4c;">Invite your friends from Google+, Facebook or Twitter</h4>
					<div class="referalBox"><?php echo($this->Html->image('gm1.png',array("onclick"=>"gotoInviter()")));?></div>
                    <div id="fb-root"></div>
					<div class="referalBox"><?php echo($this->Html->image('fb2.png',array("onclick"=>"FacebookInviteFriends()")));?></div>
					<div class="referalBox"><?php echo($this->Html->image('tw2.png',array("onclick"=>"gototw()")));?></div>
					<div style="clear:both"></div>
					<!-- <a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fparse.com" target="_blank"> Share on Facebook</a> -->
					<h4 style="color:#4c4c4c;">Or send direct invitation by entering emails of your friends</h4>
					<form class="contact_form" action="<?php echo $this->webroot; ?>users/referrals" method="post" enctype="multipart/form-data">
						<input type="hidden" name="data[User][id]" id="UserId" value="<?php echo($user['User']['id']);?>"/>
						<table>
						<tr>
							<td class="form_text">Enter Emails:</td>
							<td><textarea name="data[User][emails]" id="UserEmails" rows="5" cols="40" class="txtarea"></textarea><br/><br/>Enter email of your friends by separating it with commas.</td>
						</tr>
						<tr>
							<td class="form_text">Enter Message:</td>
							<td><textarea name="data[User][message]" id="UserMessage" rows="10" cols="40" class="txtarea"></textarea><br/><br/>Tell people a little about yourself and your shop at ShopsFit.</td>
						</tr>
						<tr>
							<td class="form_text">&nbsp;</td>
							<td><input type="submit" value="Send Referrals" class="btn_log"/></td>
						</tr>
						</table>
					</form>
				</div>
				
				<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>
<script language="JavaScript">
function gotoInviter()
{
	window.location.href='<?php echo($this->webroot)?>OpenInviter/import.php?user=<?php echo(base64_encode($user["User"]["id"]))?>&first_name=<?php echo($user["User"]["first_name"])?>&last_name=<?php echo($user["User"]["last_name"])?>';
}

function gotofb()
{
	/*window.location.href='<?php echo($this->webroot)?>fb/index.php?user=<?php echo(base64_encode($user["User"]["id"]))?>&first_name=<?php echo($user["User"]["first_name"])?>&last_name=<?php echo($user["User"]["last_name"])?>';*/
	window.location.href='http://www.facebook.com/sharer.php?u=<?php echo($url)?>';
}

function gototw()
{
	window.location.href='http://twitter.com/share?text=<?php echo($title)?>&url=<?php echo($url)?>';
}
</script>

  <script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<script>
	FB.init({
	appId:'374477216026233',
	cookie:true,
	status:true,
	frictionlessRequests:false,
	xfbml:true
	});
	function FacebookInviteFriends()
	{
	FB.ui({
	method: 'apprequests',
	title:'Join our website',
	message:'join our shop fit website',
	},
            function(response) {
                if (response) {
					var data1=response.request;
						$.post('<?php echo($this->webroot);?>users/facebook_log/'+data1, function(data){
				if(data!=''){
						}
				});
            }
	}
	);
	}
	</script>