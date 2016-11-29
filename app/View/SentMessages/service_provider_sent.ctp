
<?php
//pr($sentMessages);
?>
<div class="container">
	<?php echo $this->element('sidebar-serviceProviders'); ?>
	<div id="content">
		<div class="single_operation">
		<ul>
			<li>
				<a href="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'service_provider_compose'));?>" style="">
					<input class="login gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Compose'));?>" style="float:right;cursor: pointer;margin-left:5px;">
				</a>
				<a href="<?php echo Router::url(array('controller'=>'inbox_messages', 'action'=>'service_provider_inbox'));?>" style="">
					<input class="login gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Inbox'));?>" style="float:right;cursor: pointer;">
				</a>
				<a href="<?php echo Router::url(array('controller'=>'sent_messages', 'action'=>'service_provider_sent'));?>" style="">
					<input class="login incative gray_btn" type="button" value="<?php echo($this->requestAction('/languages/changeLang/Sent'));?>" style="float:right;cursor: pointer;margin-right:5px;">
				</a>
				<div class="clearfix"></div>
			</li>
			<li><label><b><?php echo($this->requestAction('/languages/changeLang/Sent Messages'));?> </b></label>
			</li>
		</ul>
		
		<div class="clearfix"></div><br/>
			<div class="listings">
				<table cellpadding="0" cellspacing="0" class="data-table-bordered">
				<tr>
					<th class="name"><?php echo $this->Paginator->sort('receiver_id',$this->requestAction('/languages/changeLang/To')); ?></th>
					<th class="name"><?php echo $this->Paginator->sort('subject',$this->requestAction('/languages/changeLang/Subject')); ?></th>
					<th class="name"><?php echo $this->Paginator->sort('message',$this->requestAction('/languages/changeLang/Message')); ?></th>
					<th class="name">&nbsp;</th>
					<th class="name"><?php echo $this->Paginator->sort('date_time',$this->requestAction('/languages/changeLang/Sent On')); ?></th>
					<th class="name"><?php echo __($this->requestAction('/languages/changeLang/Actions')); ?></th>
				</tr>
				<?php foreach ($sentMessages as $sentMessage): ?>
				<tr>
					<td><?php echo $sentMessage['Receiver']['user_name']; ?>&nbsp;</td>
					<td><?php echo h(substr($sentMessage['SentMessage']['subject'],0,30)); ?></td>
					<td><?php echo h(strip_tags(substr($sentMessage['SentMessage']['message'],0,30))); ?>&nbsp;</td>
					<td><?php if(isset($sentMessage['SentMessage']['location']) && $sentMessage['SentMessage']['location']!='')
							{
								?><img src="<?php echo $this->webroot.'img/frontend/img/attach.png';?>" class="attach"><?php
							}?>&nbsp;</td>
					<td><?php echo h(date('d M, Y',strtotime($sentMessage['SentMessage']['date_time']))); ?>&nbsp;</td>
					<td class="name actions">
						<?php echo $this->Html->link(__($this->requestAction('/languages/changeLang/View')), array('controller' => 'sent_messages','action' => 'service_provider_view', base64_encode($sentMessage['SentMessage']['id']))); ?><br/>
						<?php echo $this->Form->postLink(__($this->requestAction('/languages/changeLang/Delete')), array('controller' => 'sent_messages','action' => 'service_provider_delete', $sentMessage['SentMessage']['id']), null, __($this->requestAction('/languages/changeLang/Are you sure you want to delete message to').' %s?',$sentMessage['Receiver']['user_name'])); ?>
					</td>
				</tr>
			<?php endforeach; ?>
				</table>
				<div class="paging_content">
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __($this->requestAction('/languages/changeLang/Page').' {:page} '.$this->requestAction('/languages/changeLang/of').' {:pages}, '.$this->requestAction('/languages/changeLang/showing').' {:current} '.$this->requestAction('/languages/changeLang/records').' '.$this->requestAction('/languages/changeLang/out of').' {:count} '.$this->requestAction('/languages/changeLang/total').', '.$this->requestAction('/languages/changeLang/starting on record').' {:start}, '.$this->requestAction('/languages/changeLang/ending on').' {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __($this->requestAction('/languages/changeLang/previous')), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__($this->requestAction('/languages/changeLang/next')) . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
	</div>
			</div>
		</div>
		
		<div class="clear"></div>
	</div>
<div class="clear"></div>
</div>
<div class="clear"></div>
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
	font-size: 13px;
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

.name {
	color:#19598a;
	font-size: 13px;
}
.name a {
	color:#19598a;
}
.pro_about{height:auto;width:773px;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.pro_right_btn{float:right !important;margin-right:10px;border:0px !important;margin-top:13px;}
.single_operation
{
	font-size:13px;
}

.data-table-bordered
{
	box-shadow: 0px 0px 6px 0px #19598a;
	padding: 15px;
	margin-top: 20px;
	border-radius: 9px;
}

</style>
