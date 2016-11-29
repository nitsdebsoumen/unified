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
}/*
table tr:nth-child(even) {
	background: #f9f9f9;
}*/
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
/*@media only screen and (max-width: 568px) 
		{
		
		table, thead, tbody, th, td, tr { 
			display: block; 
		}
		
		
		table.data-table-bordered thead tr { 
			position: absolute;
			top: -9999px;
			left: -9999px;
		}
		
		table.data-table-bordered tr {border: 1px solid #ccc; }
		
		table.data-table-bordered td { 
			
			border: none;
			position: relative;
			padding-left: 50%; 
		}
		
		table.data-table-bordered td:before { 
			
			position: absolute;
			
			top: 6px;
			left: 6px;
			width: 45%; 
			padding-right: 10px; 
			white-space: nowrap;
		}
	
	
		 	 	 	 	
		table.data-table-bordered td:nth-of-type(2):before { content: "From"; }
		table.data-table-bordered td:nth-of-type(3):before { content: "Subject"; }
		table.data-table-bordered td:nth-of-type(4):before { content: "Message"; }
		table.data-table-bordered td:nth-of-type(5):before { content: "Sent On"; }
		table.data-table-bordered td:nth-of-type(6):before { content: "Total"; }
		table.data-table-bordered td:nth-of-type(7):before { content: "Actions"; }
		table.data-table-bordered tr:first-child{display:none;} 
		.pro_about,.profile_holder,.listings{height:auto;width:100%;margin-left:0px;padding:0;}
		table td.actions a{padding:0 !important;}
	}*/


</style>
<script type="text/javascript">
function gotoSent()
{
	window.location.href="<?php echo($this->webroot);?>sent_messages/";
}
function gotoInbox()
{
	window.location.href="<?php echo($this->webroot);?>inbox_messages/";
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


function set_mark(dsp){
	//alert(dsp);
	$('#marking').val(dsp);
	$('#filter').val();
	$('#form1').submit();
}
</script>


<div class="top_container">

    	<div class="container">
        	<div id="content">

				<div class="membership_container">
					<?php echo $this->element('account_sidebar'); ?>
					<div class="membership_container_right">
						<div class="membership_container_right_content_holder">
								<div class="pro_about" style="width:95%">
									
									<form name="form1" class="messagetype" id="form1" action="" method="post">
									<h3>Flaged Messages</h3>
									<div class="top_link">
											<!--<input type="button" class="btn_log" name="" value="Compose" onclick="gotoCompose()"/>-->
											<a class="tooltip" onclick="gotoInbox()"><img src="<?php echo($this->webroot);?>images/read_msg.png" title="Inbox"><span>Inbox</span></a>
											<a class="tooltip" onclick="gotoSent()"><img src="<?php echo($this->webroot);?>images/send_msg.png" title="Send Message"><span>Send Message</span></a>
											<a class="tooltip" onclick="gotoSpam()"><img src="<?php echo($this->webroot);?>images/tag.png" title="Label Messages"> <span>Label Message</span></a>
											<a class="active tooltip" onclick="gotoFlag()"><img src="<?php echo($this->webroot);?>images/flag_msg.png" title="Flag Messages" > <span>Flag Message</span></a>
											<a class="tooltip" onclick="gotoArchive()"><img src="<?php echo($this->webroot);?>images/arcive_msg.png" title="Archive"> <span>Archive</span></a>
											
									</div>
									
									<div class="clearfix"></div>
									
									<!--<div class="ckeckall">
										<input type="checkbox" id="selecctall">
										<p class="fills">Check all</p>
									</div>
									<div class="inbox_tab">
										<div class="inner_tab">
											<a href="javascript:void(0);" onclick="set_mark('Read');"><img src="<?php echo($this->webroot);?>images/read_msg.png" title="Read"></a>
											<a href="javascript:void(0);" onclick="set_mark('Flag');"><img src="<?php echo($this->webroot);?>images/flag_msg.png" title="Flag"></a>
											<a href="javascript:void(0);" onclick="set_mark('Archive'); onclick="gotoArchive()"><img src="<?php echo($this->webroot);?>images/arcive_msg.png" title="Archive"></a>
											<a href="javascript:void(0);" onclick="set_mark('Spam'); onclick="gotoArchive()"><img src="<?php echo($this->webroot);?>images/spam_msg.png" title="Spam"></a>
										</div>
									</div>-->
									<!--<div class="second_search">
										<span class="filter" id="filter">
										<select class="fil" id="filter" name="data[type]"
										 onchange="$('#marking').val();$('#form1').submit();">
											<option value="">Filter Message</option>
											<option value="markread">Mark as Read</option>
											<option value="jobstarted">Job started</option>
											<option value="dispue_refund">Dispute/Refund Payment</option>
											<option value="finalpaid">Payment</option>
										</select>
										</span>
									</div>-->
									<!--<div class="first_search">
									<select name="data[messageType]" id="marking" onchange="$('#filter').val();$('#form1').submit();">
										<option value="">Mark as</option>
										<option value="Read">Read</option>
										<option value="Spam">Spam</option>
										<option value="Flag">Flag</option>
										<option value="Archive">Archive</option>
									</select>
									</div>-->
									
<style>
.filter{float: right;
    margin-right: 31px;
    margin-top: 21px;
    width: 45%;}
.fills{float: left;}
.fil{ margin-left: 10px;}
</style>							<div class="clearfix"></div>
									<div class="listings">	
										<table cellpadding="0" cellspacing="0" class="data-table-bordered">
										<!--<tr>
											<th class="name"><input type="checkbox" id="selecctall"></th>
											<th class="name"><?php echo $this->Paginator->sort('sender_id','From'); ?></th>
											<th class="name"><?php echo $this->Paginator->sort('subject'); ?></th>
											<th class="name"><?php echo $this->Paginator->sort('message'); ?></th>
											<th class="name"><?php echo $this->Paginator->sort('date_time','Sent On'); ?></th>
											<th class="actions"><?php echo __('Actions'); ?></th>
										</tr>-->
										<tr>
											<td class="tab_head">
												<div class="chebox"></div>
												<div class="sender">Sender</div>
												<div class="last_message">Last Message</div>
												<div class="updated">Updated</div>
												
											</td>
										</tr>
						<?php 

						foreach ($inboxMessages as $inboxMessage): ?>
										<tr <?php echo($inboxMessage['InboxMessage']['read']==0?'style="background:#f4f4f4;"':'')?>>
											<td>
											<div class="msg_check">&nbsp; <!--<input type="checkbox" class="checkbox1" name="data[msgid][]" value="<?php echo $inboxMessage['InboxMessage']['id'];?>">--></div>
											<div class="msg_des">
											
											<p><?php echo h($this->requestAction('sent_messages/getUsername/'.$inboxMessage['InboxMessage']['sender_id'])); ?></p>
											
											
											
												
											</div>
											<div class="right_action">
											
												<a href="<?php echo ($this->webroot).'inbox_messages/conversations/'.base64_encode($inboxMessage['InboxMessage']['post_job_id']).'/'.base64_encode($inboxMessage['InboxMessage']['sender_id']).'/'.base64_encode($inboxMessage['InboxMessage']['id']); ?>" ><?php echo (strip_tags(substr($inboxMessage['InboxMessage']['message'],0,100))); ?></a>
	
											</div>
											
											<?php
												$conut_msg=$this->requestAction('inbox_messages/count_message/'.base64_encode($inboxMessage['InboxMessage']['post_job_id']));
											?>
											<div class="bottom_text">
												<b><?php echo h(date('d M, Y',strtotime($inboxMessage['InboxMessage']['date_time']))); ?>	</b>								
												<!--<?php echo $this->Html->link(__('Reply'), array('controller' => 'inbox_messages','action' => 'reply', base64_encode($inboxMessage['InboxMessage']['id']))); ?>-->
												
												<!--<a href="<?php echo ($this->webroot)."inbox_messages/conversations/".base64_encode($inboxMessage['InboxMessage']['post_job_id']); ?>"><strong><span>Sub:</span> <?php echo substr($inboxMessage['InboxMessage']['subject'],0,30); ?> <?php if ($id==''){   if ($conut_msg!='') { echo "(".$conut_msg.")"; } } ?></strong>
												</a>-->
												
											</div>
											
										</td>
											
												
												

<?php // echo $this->Html->link(__('Delete'), array('controller' => 'inbox_messages','action' => 'delete', ($inboxMessage['InboxMessage']['id']))); ?>
											
										</tr>
									<?php endforeach; ?>
										</table>
										<p>
										<?php
										
										?>	</p>
										<div class="paging">
										<?php
											echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
											echo $this->Paginator->numbers(array('separator' => ''));
											echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
										?>
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
<style>
#content {
width: 100% !important;
border: 0px;
float:left;
height:auto;
}
</style>


