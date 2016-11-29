<?php
$allowedextention=array('txt','doc','docx','pdf','xlsx','jpg','jpeg','png','mp3','mp4','dat','3gp');
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
.single_operation
{
	box-shadow: 0px 0px 6px 0px #19598a;
	padding: 15px;
	margin-top: 20px;
	border-radius: 9px;
}
</style>
<script type="text/javascript">
$(document).ready(function() {
	$(document).click(function(e){
		if(e.target.id!='SentMessageUsername')
		{
			$("#AutoSuggest").hide();
		}
	});
	
	$("#SentMessageLocation").change(function(){
		var Document=$("#SentMessageLocation").val();
		var pieces = Document.split("\\");
		var filename=pieces[pieces.length-1];
		
		var pieces = Document.split(".");
		var ext=pieces[pieces.length-1];
		
		var allowedextention = Array('txt','doc','docx','pdf','xlsx','jpg','jpeg','png','mp3','mp4','dat','3gp');
		
		var index = allowedextention.indexOf(ext);
		if(index==-1)
		{
			$(".fileExtError").css('color','#F00');
			$("#SentMessageLocation").val('');
		}
		else
		{
			$(".fileExtError").css('color','#000');
		}
	});
	
});
function getUser(tmpData)
{
	//alert(tmpData);
	//alert('<?php //echo($this->webroot);?>sent_messages/autosuggestuser/'+tmpData);
	$.post('<?php echo($this->webroot);?>sent_messages/autosuggestuser/'+tmpData, function(data) {
		if(data)
		{
			document.getElementById('AutoSuggest').style.display='block';
			$('#AutoSuggest').html(data);
		}
	});
}
function autofill(id)
{
	$('#SentMessageUsername').val($("#autoFill_"+id).text());
	$('#SentMessageReceiverId').val(id);
	$('#AutoSuggest').hide();
}
</script>
<div class="container">
	<?php echo $this->element('sidebar-serviceProviders'); ?>
	<div id="content">
		
		
		<ul>
			<li>
				<a href="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'service_provider_compose'));?>" style="">
					<input class="login incative gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Compose'));?>" style="float:right;cursor: pointer;margin-left:5px;">
				</a>
				<a href="<?php echo Router::url(array('controller'=>'inbox_messages', 'action'=>'service_provider_inbox'));?>" style="">
					<input class="login gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Inbox'));?>" style="float:right;cursor: pointer;">
				</a>
				<a href="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'service_provider_sent'));?>" style="">
					<input class="login gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Sent'));?>" style="float:right;cursor: pointer;margin-right:5px;">
				</a>
				<div class="clearfix"></div>
			</li>
			<li><label><b><?php echo($this->requestAction('/languages/changeLang/Compose Message'));?></b></label>
				<div class="clearfix"></div>
			</li>
			<li>
			<a href="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'bulk_compose'));?>" style="">
					<input class="login gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Send Bulk Messages'));?>" style="float:right;cursor: pointer;margin-right:5px;">
				</a>
			</li>
				<div class="clearfix"></div>
		</ul>
		<div class="single_operation">
		<div class="listings">	
					
		<form class="contact_form" action="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'service_provider_compose'));?>" method="post" enctype="multipart/form-data">
		<input type="hidden" name="data[SentMessage][receiver_id]" id="SentMessageReceiverId" value="<?php echo(isset($reciever_id)?base64_decode($reciever_id):'')?>">
				<ul>
					<div class="clearfix"></div><br/>
					<?php
					if(!isset($reciever_id))
					{
					?>
					<li>
						<label><?php echo($this->requestAction('/languages/changeLang/Username'));?> : </label>
					</li>
					<li>
						<input type="text" name="data[SentMessage][username]" id="SentMessageUsername" class="contact_text_box" placeholder="<?php echo($this->requestAction('/languages/changeLang/To'));?>" onkeyUp="getUser(this.value)" required="required" autocomplete="off"/>
					</li>
					<div id="AutoSuggest" style="display:none;z-index:100000;position:absolute;border:2px solid #bcbcbc;width:305px;margin-top:-1px;background:#fff; -moz-border-radius: 10px; -webkit-border-radius: 10px; -khtml-border-radius: 10px;border-radius: 10px;margin-left:288px;"></div>
					<?php
					}
					?>
					<div class="clearfix"></div><br/>
					<li>
						<label><?php echo($this->requestAction('/languages/changeLang/Subject'));?> :  </label>
					</li>
					<li>
						<input type="text" name="data[SentMessage][subject]" maxlength="100" id="SentMessageSubject" required="required" class="contact_text_box" placeholder="<?php echo($this->requestAction('/languages/changeLang/Subject'));?>" value=""/>
					</li>
					<div class="clearfix"></div><br/>
					<li>
						<label><?php echo($this->requestAction('/languages/changeLang/Message'));?> :  </label>
					</li>
					<li>
						<textarea name="data[SentMessage][message]" id="SentMessageMessage" rows="10" cols="45" required="required" class="txtarea"></textarea>
					</li>
					<div class="clearfix"></div><br/>
						<!--////-->
					<li>
						<label><?php echo($this->requestAction('/languages/changeLang/Attachment'));?> :  </label>
					</li>
					<li>
						<input type="file" name="data[SentMessage][location]" id="SentMessageLocation" class="text_box"/>
						</li>
						<div class="clearfix"></div><br/>
						<div class="fileExtError"><?php echo($this->requestAction('/languages/changeLang/Allowed file types are'));?> <?php echo implode(", ",$allowedextention);?></div>
					<div class="clearfix"></div><br/>
						<!--////-->
					<li>
						<label>&nbsp;</label>
					</li>
					<li>
						<input class="login gray_btn" type="submit" value="<?php echo($this->requestAction('/languages/changeLang/Send'));?>" style="float:left;cursor: pointer;margin-right:5px;"/>
						<a href="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'service_provider_sent'));?>">
							<input class="login gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Cancel'));?>" style="float:left;cursor: pointer;margin-right:5px;"/>
						</a>
					</li>
					
					<div class="clearfix"></div><br/>
				</ul>
					</form>
				</div>
				
				<div class="clear"></div>
			</div>
		<div class="clear"></div>
		</div>
		<div class="clear"></div>