<?php ?>
<style type="text/css">
.listings{
	width:100%;
	border:0px solid red;
	padding:12px;
	text-align:left;
	margin:0px 0px 20px 0px;
}
/** Tables **/
table {
	border-right:0;
	clear: both;
	color: #333;
	margin: 10px 0px 10px 0px;
	width: 100%;
}
th {
	border:0;
	border-bottom:1px solid #dadbd6;
	text-align: left;
	padding:10px;
}
th a {
	display: block;
	padding: 2px 4px;
	text-decoration: none;
}
th a.asc:after {
	content: ' ⇣';
}
th a.desc:after {
	content: ' ⇡';
}
table tr td {
	padding: 10px;
	text-align: left;
	vertical-align: top;
	border-bottom:1px solid #ddd;
}
.headimg {
	background: #eeeeee;
}
table tr:nth-child(even) {
	background: #f9f9f9;
}
td.actions {
	text-align: left;
	white-space: nowrap;
}
table td.actions a {
	margin: 0px 6px;
	padding:5px 5px;
}
.data-table-bordered {
	border: 1px solid #dadbd6;
	border-collapse: separate;
	-moz-border-radius: 5px;
	-webkit-border-radius: 5px;
	border-radius: 5px;
}
/** Paging **/
.paging {
	background:#fff;
	color: #ccc;
	margin-top: 1em;
	clear:both;
}
.paging .current,
.paging .disabled,
.paging a {
	text-decoration: none;
	padding: 5px 8px;
	display: inline-block
}
.paging > span {
	display: inline-block;
	border: 1px solid #ccc;
	border-left: 0;
}
.paging > span:hover {
	background: #efefef;
}
.paging .prev {
	border-left: 1px solid #ccc;
	-moz-border-radius: 4px 0 0 4px;
	-webkit-border-radius: 4px 0 0 4px;
	border-radius: 4px 0 0 4px;
}
.paging .next {
	-moz-border-radius: 0 4px 4px 0;
	-webkit-border-radius: 0 4px 4px 0;
	border-radius: 0 4px 4px 0;
}
.paging .disabled {
	color: #ddd;
}
.paging .disabled:hover {
	background: transparent;
}
.paging .current {
	background: #efefef;
	color: #c73e14;
}
.name {
	color:#009cdb;
}
.name a {
	color:#009cdb;
}
.pro_about{height:auto;width:95%;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.pro_right_btn{float:right !important;margin-right:10px;border:0px !important;margin-top:13px;}

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
@media only screen and (max-width: 568px) 
		{
		/* Force table to not be like tables anymore */
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		/* Hide table headers (but not display: none;, for accessibility) */
		table.data-table-bordered thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		table.data-table-bordered tr {border: 1px solid #ccc; }
		
		table.data-table-bordered td { 
			/* Behave  like a "row" */
			border: none;
			position: relative;
			padding-left: 50%; 
		}
		
		table.data-table-bordered td:before { 
			/* Now like a table header */
			position: absolute;
			/* Top/left values mimic padding */
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
	
		/*
		Label the data
		*/
		 	 	 	 	
		table.data-table-bordered td:nth-of-type(2):before { content: "From"; }
		table.data-table-bordered td:nth-of-type(3):before { content: "Subject"; }
		table.data-table-bordered td:nth-of-type(4):before { content: "Message"; }
		table.data-table-bordered td:nth-of-type(5):before { content: "Sent On"; }
		table.data-table-bordered td:nth-of-type(6):before { content: "Total"; }
		table.data-table-bordered td:nth-of-type(7):before { content: "Actions"; }
		table.data-table-bordered tr:first-child{display:none;} 
		.pro_about,.profile_holder,.listings{height:auto;width:100%;margin-left:0px;padding:0;}
		table td.actions a{padding:0 !important;}
	}


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
function gotoInbox()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/index";
}

$(document).ready(function() {
    $('#selecctall').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
    
});
</script>


<div class="top_container">

    	<div class="container">
        	<div id="content">

				<div class="membership_container">
					<?php echo $this->element('account_sidebar'); ?>
					<div class="membership_container_right">
						<div class="membership_container_right_content_holder">
								<div class="pro_about">
								<h3>Convertation With loremipsum</h3>
									<div class="top_link">
										<!--<input type="button" class="btn_log" name="" value="Compose" onclick="gotoCompose()"/>-->
										<a class="active"><img src="<?php echo($this->webroot);?>images/read_msg.png" title="Inbox"></a>
										
										<a onclick="gotoSent()"><img src="<?php echo($this->webroot);?>images/send_msg.png" title="Send Message"></a>
										<a onclick="gotoFlag()"><img src="<?php echo($this->webroot);?>images/flag_msg.png" title="Flag Message" ></a>
										<a onclick="gotoArchive()"><img src="<?php echo($this->webroot);?>images/arcive_msg.png" title="Arcive"></a>
										<a onclick="gotoSpam()"><img src="<?php echo($this->webroot);?>images/spam_msg.png" title="Spam Message"></a>
									</div>
									<div class="clearfix"></div>
								<table class="conversation">
									<tr>
										<td>
										<div class="inbox_tab">
											<div class="inner_tab">
												<a><img title="Read" src="<?php echo ($this->webroot); ?>images/spam_msg.png"></a>
												<a><img title="Flag" src="<?php echo ($this->webroot); ?>images/flag_msg.png"></a>
												<a><img title="Archive" src="<?php echo ($this->webroot); ?>images/arcive_msg.png"></a>
												<a><img title="Spam" src="<?php echo ($this->webroot); ?>images/editing-delete-icon.png"></a>
											</div>
										</div>
										<div class="tag_sec">
											<a><img title="Read" src="<?php echo ($this->webroot); ?>images/tag.png"></a>
											<ul id="tg">
												<li><a href="">My Settings</a></li>
												<li><a href="">My Security Setting</a></li>
												<li><a href="">Membership</a></li>
												<li><a href="">My Team</a></li>
											</ul>
											<script>
												$(document).ready(function(){
													$(".tag_sec").click(function(){
														$("#tg").slideToggle();
													});
												});
											</script>
										</div>
										<!--<div class="follow_up">
											<a href="">Follow-up</a>
										</div>-->
										</td>
									</tr>
									<tr>
										<td>
											<div class="left_image_conv">
												<img title="Spam" src="<?php echo ($this->webroot); ?>img/frontend/images/choose2.png">
											</div>
											<div class="right_conv">
											<b>Subrata Sen</b>
											<span>LegalWE offer access</span>
											<p>Hi<br/>
											LegalWE offer access to the best <br/>
											legal minds any time, any day, anywhere. 
											</p>
											</div>
											<div class="attach_ment">
												<a href=""><img title="Spam" src="<?php echo ($this->webroot); ?>css/frontend/images/attach.png"></a>
											</div>
											<div class="clearfix"></div>
											<div class="bottom_conv">
												Report 03
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left_image_conv">
												<img title="Spam" src="<?php echo ($this->webroot); ?>img/frontend/images/choose2.png">
											</div>
											<div class="right_conv">
											<b>Subrata Sen</b>
											<span>LegalWE offer access</span>
											<p>Hi<br/>
											LegalWE offer access to the best <br/>
											legal minds any time, any day, anywhere. 
											</p>
											</div>
											<div class="attach_ment">
												<a href=""><img title="Spam" src="<?php echo ($this->webroot); ?>css/frontend/images/attach.png"></a>
											</div>
											<div class="clearfix"></div>
											<div class="bottom_conv">
												Report 03
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left_image_conv">
												<img title="Spam" src="<?php echo ($this->webroot); ?>img/frontend/images/choose2.png">
											</div>
											<div class="right_conv">
											<b>Subrata Sen</b>
											<span>LegalWE offer access</span>
											<p>Hi<br/>
											LegalWE offer access to the best <br/>
											legal minds any time, any day, anywhere. 
											</p>
											</div>
											<div class="attach_ment">
												<a href=""><img title="Spam" src="<?php echo ($this->webroot); ?>css/frontend/images/attach.png"></a>
											</div>
											<div class="clearfix"></div>
											<div class="bottom_conv">
												Report 03
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left_image_conv">
												<img title="Spam" src="<?php echo ($this->webroot); ?>img/frontend/images/choose2.png">
											</div>
											<div class="right_conv">
											<b>Subrata Sen</b>
											<span>LegalWE offer access</span>
											<p>Hi<br/>
											LegalWE offer access to the best <br/>
											legal minds any time, any day, anywhere. 
											</p>
											</div>
											<div class="attach_ment">
												<a href=""><img title="Spam" src="<?php echo ($this->webroot); ?>css/frontend/images/attach.png"></a>
											</div>
											<div class="clearfix"></div>
											<div class="bottom_conv">
												Report 03
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="left_image_conv">
												<img title="Spam" src="<?php echo ($this->webroot); ?>img/frontend/images/choose2.png">
											</div>
											<div class="right_conv">
											<b>Subrata Sen</b>
											<span>LegalWE offer access</span>
											<p>Hi<br/>
											LegalWE offer access to the best <br/>
											legal minds any time, any day, anywhere. 
											</p>
											</div>
											<div class="attach_ment">
												<a href=""><img title="Spam" src="<?php echo ($this->webroot); ?>css/frontend/images/attach.png"></a>
											</div>
											<div class="clearfix"></div>
											<div class="bottom_conv">
												Report 03
											</div>
										</td>
									</tr>
								</table>
								<div class="reply_covertation">
									<div class="inner_covertation">
										<span>send a message</span>
										<textarea></textarea>
										<div class="send_sec">
											<input type="button" class="atch_btn" value="Attach Files"/>
											<input type="submit" class="send_btn" value="Send"/>
										</div>
									</div>
								</div>
								</div>
								<br/><br/><br/><br/>
								<div class="pro_about">
								
									<div class="top_link">
										<!--<input type="button" class="btn_log" name="" value="Compose" onclick="gotoCompose()"/>-->
										<a class="active"><img src="<?php echo($this->webroot);?>images/read_msg.png" title="Inbox"></a>
										
										<a onclick="gotoSent()"><img src="<?php echo($this->webroot);?>images/send_msg.png" title="Send Message"></a>
										<a onclick="gotoFlag()"><img src="<?php echo($this->webroot);?>images/flag_msg.png" title="Flag Message" ></a>
										<a onclick="gotoArchive()"><img src="<?php echo($this->webroot);?>images/arcive_msg.png" title="Arcive"></a>
										<a onclick="gotoSpam()"><img src="<?php echo($this->webroot);?>images/spam_msg.png" title="Spam Message"></a>
									</div>
									<div class="clearfix"></div>
								<table class="conversation">
									<tr>
										<td>
											<h3>Send Message</h3>
										</td>
									</tr>
									
								</table>
								<div class="reply_covertation" style="border-radius:0">
									<div class="inner_covertation">
										<div class="half_conv left_con">
											<span>Username:</span>
											<input type="text" />
										</div>
										<div class="half_conv right_con">
											<span>Subject:</span>
											<input type="text" />
										</div>
										
									</div>
								</div>
								<div class="reply_covertation">
									<div class="inner_covertation">
										<span>send a message</span>
										<textarea></textarea>
										<div class="send_sec">
											<input type="button" class="atch_btn" value="Attach Files"/>
											<input type="submit" class="send_btn" value="Send"/>
										</div>
									</div>
								</div>
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


