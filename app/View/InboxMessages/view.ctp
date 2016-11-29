<?php ?>
<style type="text/css">
.pro_about{height:auto;width:95%;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.contact_form{margin:0 auto;width:730px;border:0px solid red;padding-top:00px;padding-bottom:00px;}
.contact_form tr{color:#6d6d6d;font-size:12px;line-height:10px;font-weight: normal;}
.contact_form tr td{float:left;margin:5px;text-align:left;color:#6d6d6d;padding:5px;}
.form_text{text-align:left !important;width:120px;color:#6d6d6d;font-size:12px;line-height:20px;margin-top:5px;bottom: 10px;margin-right:5px;padding-top:5px;font-weight:bold;}
.contact_text_box{height:30px;width:300px;border:1px solid #e1e1e1;background:#ffffff;border-radius:4px;-moz-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);-webkit-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);box-shadow: 0px 1px 1px rgba(182, 182, 182, 0.75);font-size:14px;line-height:20px;padding-left:10px;color:#6d6d6d;}

.btn_log{width: 78px;
height: 34px;
border-radius: 4px;
-moz-border-radius: 4px;
-webkit-border-radius: 4px;
background: #f98e1b;
text-align: center;
font-size: 14px;
color: #fff;
float: left;}
.off{background: #F98E3F;font-weight:bold;}

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


function gotoReply(id)
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/reply/"+id;
}

function gotoSent()
{
	window.location.href="<?php echo($this->webroot);?>sent_messages/";
}

function gotoCompose()
{
	window.location.href="<?php echo($this->webroot);?>sent_messages/compose";
}
function gotoInbox()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/index";
}
function gotoFlag()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/flag";
}

function gotoArchive()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/archive";
}

function gotoSpam()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/spam";
}
</script>
	



<div class="top_container">

    	<div class="container">
        	<div id="content">
				<div class="membership_container">
					<?php echo $this->element('account_sidebar'); ?>
					<div class="membership_container_right">
						<div class="membership_container_right_content_holder">
								<div class="pro_about">
									<div class="inbox_tab">
										<div class="inner_tab">
										<!-- <input type="button" class="btn_log" name="" value="Compose" onclick="gotoCompose()"/>&nbsp; -->
										<input type="button" class="btn_log " name="" value="Inbox" onclick="gotoInbox()"/>&nbsp;
										<input type="button" class="btn_log" name="" value="Sent" onclick="gotoSent()"/>&nbsp;
										<input type="button" class="btn_log off" name="" value="Flag" onclick="gotoFlag()"/>&nbsp;
										<input type="button" class="btn_log " name="" value="Archive" onclick="gotoArchive()"/>&nbsp;
										<input type="button" class="btn_log " name="" value="Spam" onclick="gotoSpam()"/>&nbsp;
										</div>
									</div>
									<h3>View Message</h3>
									<table class="contact_form" style="border:0px solid red;">
										<tr>
											<td class="form_text" style="width:16%;">Sender:</td>
											<td style="font-weight:bold;width:66%;line-height: 20px;" ><?php echo($this->requestAction('sent_messages/getUsername/'.$inboxMessage['InboxMessage']['sender_id']));?></td>
										</tr>
										<tr>
											<td class="form_text" style="width:16%;">Date:</td>
											<td style="font-weight:bold;width:66%;line-height: 20px;"><?php echo(date('d M, Y',strtotime($inboxMessage['InboxMessage']['date_time'])));?></td>
										</tr>
										<tr>
											<td class="form_text" style="width:16%;">Subject:</td>
											<td style="font-weight:bold;width:66%;line-height: 20px;"><?php echo($inboxMessage['InboxMessage']['subject']);?></td>
										</tr>
										<tr>
											<td valign="top" class="form_text" style="width:16%;">Message:</td>
											<td valign="top" style="width:66%;line-height: 20px;"><?php echo($inboxMessage['InboxMessage']['message']);?></td>
										</tr>
									<?php if($inboxMessage['InboxMessage']['location']!='') { ?>
										<tr>
											<td valign="top" class="form_text" style="width:16%;"> Document :</td>
											<td valign="top" style="width:66%;line-height: 20px;">
											<a href="<?php echo($this->webroot).'location/'.($inboxMessage['InboxMessage']['location']);?>" target="_blank">Click Here</a>
											</td>
										</tr>
									<?php } ?>
										<tr>
											<td valign="top" class="form_text"><input type="button" class="btn_log" name="" value="Reply" onclick="gotoReply('<?php echo(base64_encode($inboxMessage['InboxMessage']['id']));?>')"/>
											
											
											</td>
											<td valign="top"> <input type="button" class="btn_log" name="" value="Back" onclick="window.history.back()"/>
											</td>
										</tr>
									</table>
								</div>
								
						</div>
					</div>
				</div>
			</div>
        	
            
        </div>
   
</div>
<style>
#content {
width: 100% !important;
border: 0px;
float:left;
height:auto;
}
</style>
