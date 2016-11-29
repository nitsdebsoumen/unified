<?php 



?>                                                        
<section class="main_body">
    <div class="container">
            <div class="row">
                    <div class="col-md-3">
                            <?php echo $this->element('user_sidebar'); ?>
                    </div>
                    <div class="col-md-9 whit_bg">
                        <div class="right_dash_board">
                                <div class="search_box">
                                        <h2>SEND MESSAGE</h2>
                                        <div class="membership_container_right">
									<div class="membership_container_right_content_holder">
										<div class="pro_about">
												<?php echo $this->element('inbox_header'); ?>
									
											<div class="clearfix"></div>
											
											<form class="contact_form" action="" method="post" enctype="multipart/form-data" name="sent_message" id="isent_message">
											<input type="hidden" name="data[SentMessage][receiver_id]" id="SentMessageReceiverId" value="<?php echo(isset($reciever_id)?($reciever_id):'')?>">
												<div class="reply_covertation" style="border-radius: 5px 5px 0px 0px;">
													<div class="inner_covertation">
														<div class="half_conv left_con">
															<span>Username:</span>
															<input type="text" name="data[SentMessage][username]" id="SentMessageUsername" class="form-control" placeholder="To" readonly autocomplete="off" value="<?php echo($this->requestAction('sent_messages/getUsername/'.$reciever_id));?>"/>
														</div>
														<div class="half_conv right_con">
															<span>Subject:</span>
															<input type="text" name="data[SentMessage][subject]" maxlength="100" id="SentMessageSubject" required="required" class="form-control" placeholder="Subject" value=""/>
														</div>
										
													</div>
												</div>
												<div class="reply_covertation">
													<div class="inner_covertation">
														<span>send a message</span>
														<textarea name="data[SentMessage][message]" id="SentMessageMessage" class="form-control" style="margin: 0px -0.96875px 0px 0px; width: 677px; height: 182px;" required="required"></textarea>
														<div class="send_sec">
															<input type="button" class="atch_btn" value="Attach Files" onclick="$('#theFile' ).click();"/>
															<input type="file" name="data[SentMessage][location]" id="theFile" class="contact_text_box" value="" style="display:none;"/>
															<input type="submit" class="send_btn" value="Send"/>
														</div>
													</div>
												</div>
											</form>
										</div>
						
								
								
									</div>
								</div>
                                </div>
                                
                                
                        </div>
                    </div>
            </div>
    </div>
</section>

<script type="text/javascript">
    
    function initialize2() {
        var defaultBounds = new google.maps.LatLngBounds(
        new google.maps.LatLng(7.623887, 68.994141),
        new google.maps.LatLng(37.020098, 97.470703));

        var input1 = document.getElementById('task_location');
        var options = {
            bounds: defaultBounds,
            types: ['geocode'],
        };
        autocomplete1 = new google.maps.places.Autocomplete(input1, options);
    }
    
</script>

<script type="text/javascript">
    $(document).ready(function(){       
        $('#EndDate').datepicker({dateFormat: 'yy-mm-dd'});
        initialize2();
        
        
    });
</script>

<style type="text/css">
.pro_about{height:auto;width:773px;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.contact_form{margin:0 auto;width:730px;border:0px solid red;padding-top:00px;padding-bottom:00px;height:auto;overflow:hidden;}
.contact_form tr{color:#6d6d6d;font-size:12px;line-height:10px;font-weight: normal;}
.contact_form tr td{float:left;margin:15px;text-align:left;color:#6d6d6d;}
.form_text{text-align:left !important;width:120px;color:#6d6d6d;font-size:15px;line-height:20px;margin-top:5px;bottom: 10px;font-weight: normal;margin-right:5px;padding-top:5px;}
.contact_text_box{height:43px;width:300px;border:1px solid #e1e1e1;background:#ffffff;border-radius:4px;-moz-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);-webkit-box-shadow: 0px 2px 3px rgba(182, 182, 182, 0.75);box-shadow: 0px 1px 1px rgba(182, 182, 182, 0.75);font-size:14px;line-height:20px;padding-left:10px;color:#6d6d6d;}
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
function getUser(tmpData)
{
	//alert(tmpData);
	//alert('<?php echo($this->webroot);?>sent_messages/autosuggestuser/'+tmpData);
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
	var data=$("#autoFill_"+id).text();
	var name=data.split('(')
	$('#SentMessageUsername').val(name[0]);
	$('#SentMessageReceiverId').val(id);
	$('#AutoSuggest').hide();
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

function checkn_submit()
{
	var uid=$('#SentMessageReceiverId').val();
	var Subject=$('#SentMessageSubject').val();
	var Message=$('#SentMessageMessage').val();

	if (uid==0 || uid=='')
	{
		alert('Please Choose an Valid User');
	}
	else if (Subject==0 || Subject=='')
	{
		alert('Please Enter a Subject');
	}
	else if (Message==0 || Message=='')
	{
		alert('Please Enter a Message');
	}
   else {
	   document.getElementById("isent_message").submit();
   }
}
</script>

<style>
#content {
width: 100% !important;
border: 0px;
float:left;
height:auto;
}
</style>
