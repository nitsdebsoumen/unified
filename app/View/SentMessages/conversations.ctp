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

<style type="text/css">

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

</style>



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
										<input type="button" class="btn_log off" name="" value="Sent" onclick=""/>&nbsp;
										<input type="button" class="btn_log " name="" value="Flagged" onclick="gotoFlag()"/>&nbsp;
										<input type="button" class="btn_log " name="" value="Archive" onclick="gotoArchive()"/>&nbsp;
										<input type="button" class="btn_log " name="" value="Spam" onclick="gotoSpam()"/>&nbsp;
										</div>
								</div>
								
								<h3>Sent Messages Contersation </h3>
								<div class="listings">	
									<table cellpadding="0" cellspacing="0" class="data-table-bordered">
									<!--<tr>
										<th class="name"><?php echo $this->Paginator->sort('receiver_id','To'); ?></th>
										<th class="name"><?php echo $this->Paginator->sort('subject'); ?></th>
										<th class="name"><?php echo $this->Paginator->sort('message'); ?></th>
										<th class="name"><?php echo $this->Paginator->sort('date_time','Sent On'); ?></th>
										<th class="actions"><?php echo __('Actions'); ?></th>
									</tr>-->
									<?php foreach ($sentMessages as $sentMessage): ?>
									<tr>
										<td>
										<div class="msg_des"><?php echo $sentMessage['SentMessage']['message']; ?></div>
										<div class="right_action">
											<a href=""><?php echo $this->Html->link(__('View'), array('controller' => 'sent_messages','action' => 'view', base64_encode($sentMessage['SentMessage']['id']))); ?></a>
											<a href=""><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $sentMessage['SentMessage']['id']), null, __('Are you sure you want to delete message by %s?', $this->requestAction('sent_messages/getUsername/'.$sentMessage['SentMessage']['receiver_id']))); ?></a>
										</div>
										<div class="bottom_text">
											<p><span>Form: </span><?php echo h($this->requestAction('sent_messages/getUsername/'.$sentMessage['SentMessage']['receiver_id'])); ?></p>
										 <strong><span>Sub:</span><?php echo h(substr($sentMessage['SentMessage']['subject'],0,30)); ?></strong>
										
										<b><?php echo h(date('d M, Y',strtotime($sentMessage['SentMessage']['date_time']))); ?></b>
										</div>
									
										</td>
									</tr>
								<?php endforeach; ?>
									</table>
									<p>
									<?php
									echo $this->Paginator->counter(array(
									'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
									));
									?>	</p>
									<div class="paging">
									<?php
										echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
										echo $this->Paginator->numbers(array('separator' => ''));
										echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
									?>
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
