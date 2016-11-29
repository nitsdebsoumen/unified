<?php ?>
<style type="text/css">
.pro_about{height:auto;width:773px;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.contact_form{margin:0 auto;width:730px;border:0px solid red;padding-top:00px;padding-bottom:00px;}
.contact_form tr{color:#6d6d6d;font-size:12px;line-height:10px;font-weight: normal;}
.contact_form tr td{float:left;margin:15px;text-align:left;color:#6d6d6d;}
.form_text{text-align:right !important;width:120px;color:#6d6d6d;font-size:12px;line-height:20px;margin-top:5px;bottom: 10px;font-weight: normal;margin-right:5px;padding-top:5px;}
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
									<div class="top_link">
											<!--<input type="button" class="btn_log" name="" value="Compose" onclick="gotoCompose()"/>-->
											<a class="tooltip" onclick="gotoInbox()"><img src="<?php echo($this->webroot);?>images/read_msg.png" title="Inbox"><span>Inbox</span></a>
											<a class="tooltip" onclick="gotoSent()"><img src="<?php echo($this->webroot);?>images/send_msg.png" title="Send Message"><span>Send Message</span></a>
											<a class="tooltip" onclick="gotoSpam()"><img src="<?php echo($this->webroot);?>images/tag.png" title="Label Messages"> <span>Label Message</span></a>
											<a class="tooltip" onclick="gotoFlag()"><img src="<?php echo($this->webroot);?>images/flag_msg.png" title="Flag Messages" > <span>Flag Message</span></a>
											<a class="tooltip" onclick="gotoArchive()"><img src="<?php echo($this->webroot);?>images/arcive_msg.png" title="Archive"> <span>Archive</span></a>
											
									</div>
									
									
									<div class="clearfix"></div>
								<table class="conversation">
									<tr>
										<td>
											<h3>Send Message</h3>
										</td>
									</tr>
									
								</table>
								<form class="contact_form" action="<?php echo $this->webroot; ?>inbox_messages/reply/<?php echo(base64_encode($inboxMessage['InboxMessage']['id']));?>" method="post" enctype="multipart/form-data">
								<input type="hidden" name="data[SentMessage][receiver_id]" id="SentMessageReceiverId" value="<?php echo($inboxMessage['InboxMessage']['sender_id']);?>">
								<div class="reply_covertation" style="border-radius:0">
									<div class="inner_covertation">
										<div class="half_conv left_con">
											<span>Username:</span>
											<input type="text" name="data[SentMessage][username]" id="SentMessageUsername" class="" placeholder="To" required="required" readonly autocomplete="off" value="<?php echo($this->requestAction('sent_messages/getUsername/'.$inboxMessage['InboxMessage']['sender_id']));?>"/>
										</div>
										<div class="half_conv right_con">
											<span>Subject:</span>
											<input type="text" name="data[SentMessage][subject]" maxlength="100" id="SentMessageSubject" required="required" readonly class="contact_text_box" placeholder="Subject" value="Re: <?php echo($inboxMessage['InboxMessage']['subject']);?>"/>
										</div>
										
									</div>
								</div>
								<div class="reply_covertation">
									<div class="inner_covertation">
										<span>send a message</span>
										<textarea name="data[SentMessage][message]" id="SentMessageMessage" required="required"></textarea>
										<div class="send_sec">
											<input type="button" class="atch_btn" value="Attach Files" onclick="$('#theFile' ).click();"/>
											<input type="file" name="data[SentMessage][location]" id="theFile" class="contact_text_box" value="" style="display:none;"/>
											<input type="submit" class="send_btn" value="Send"/>
										</div>
									</div>
								</div>
								</form>
							</div>
							
							
								<!--<div class="pro_about">
									<div style="width:100%;float:right;text-align:right;border:0px solid red;">
										<div style="width:75%;float:right;margin:5px;">
										
										<input type="button" class="btn_log " name="" value="Inbox" onclick="gotoInbox()"/>&nbsp;
										<input type="button" class="btn_log" name="" value="Sent" onclick="gotoSent()"/>&nbsp;
										<input type="button" class="btn_log off" name="" value="Flag" onclick="gotoFlag()"/>&nbsp;
										<input type="button" class="btn_log " name="" value="Archive" onclick="gotoArchive()"/>&nbsp;
										<input type="button" class="btn_log " name="" value="Spam" onclick="gotoSpam()"/>&nbsp;
										</div>
									</div>
									<h3>Reply</h3>
									<form class="contact_form" action="<?php echo $this->webroot; ?>inbox_messages/reply/<?php echo(base64_encode($inboxMessage['InboxMessage']['id']));?>" method="post" enctype="multipart/form-data">
										<input type="hidden" name="data[SentMessage][receiver_id]" id="SentMessageReceiverId" value="<?php echo($inboxMessage['InboxMessage']['sender_id']);?>">
										<table>
										<tr>
											<td class="form_text">Username:</td>
											<td><input type="text" name="data[SentMessage][username]" id="SentMessageUsername" class="contact_text_box" placeholder="To" required="required" readonly autocomplete="off" value="<?php echo($this->requestAction('sent_messages/getUsername/'.$inboxMessage['InboxMessage']['sender_id']));?>"/></td>
										</tr>
										<tr>
											<td class="form_text">Subject:</td>
											<td><input type="text" name="data[SentMessage][subject]" maxlength="100" id="SentMessageSubject" required="required" readonly class="contact_text_box" placeholder="Subject" value="Re: <?php echo($inboxMessage['InboxMessage']['subject']);?>"/></td>
										</tr>
										<tr>
											<td class="form_text">Message:</td>
											<td><textarea name="data[SentMessage][message]" id="SentMessageMessage" rows="10" cols="62" required="required" class="txtarea"></textarea></td>
										</tr>

										<tr>
											<td class="form_text">Attached a Document:</td>
											<td><input type="file" name="data[SentMessage][location]"    class="contact_text_box" value=""/></td>
										</tr>

										<tr>
											<td class="form_text">&nbsp;</td>
											<td><input type="submit" value="Send" class="btn_log"/></td>
										</tr>
										</table>
									</form>
								</div>-->
								
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