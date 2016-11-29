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
.pro_about{height:auto;width:773px;padding:18px;background: white;border-radius:3px;box-shadow:0 0 2px #999;margin-top:20px;float:left;margin-left:20px;padding:20px;}
.profile_btn{border:1px solid #dadbda;padding:5px 10px 5px 10px;color:#747674;border-radius: 3px;margin:10px 0px 0px 0px;}
.pro_right_btn{float:right !important;margin-right:10px;border:0px !important;margin-top:13px;}
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
				<li><?php echo $this->Html->link('Refer a Friend', array('controller' => 'users', 'action' => 'referrals', 'full_base' => true ));?></li>
				<li><?php echo $this->Html->link('Sell', array('controller' => 'shops', 'action' => 'create', 'full_base' => true ));?></li>
				<li class="pro_left_cat_active"><?php echo $this->Html->link('Orders', array('controller' => 'orders', 'action' => 'index', 'full_base' => true ));?></li>
				<li><?php echo $this->Html->link('Purchases', array('controller' => 'orders', 'action' => 'purchased', 'full_base' => true ));?></li>
			</ul>
		</div>
		<div class="pro_about">
			<h2>Your Order History</h2>
			<div class="listings">	
				<table cellpadding="0" cellspacing="0" class="data-table-bordered">
				<tr>
					<th class="name"><?php echo $this->Paginator->sort('id'); ?></th>
					<th><?php echo __('Order By'); ?></th>
					<th class="name"><?php echo $this->Paginator->sort('list_id'); ?></th>
					<th class="name"><?php echo $this->Paginator->sort('order_date'); ?></th>
					<th class="name"><?php echo $this->Paginator->sort('order_status'); ?></th>
					<th class="actions"><?php echo __('Actions'); ?></th>
				</tr>
				<?php foreach ($orders as $order): ?>
				<tr>
					<td><?php echo h($order['OrderDetail']['id']); ?>&nbsp;</td>
					<td><?php echo h($this->requestAction('orders/getUsername/'.$order['Order']['user_id'])); ?></td>
					<td><?php echo (wordwrap($order['Listing']['item_tittle'],30,'<br/>',TRUE)); ?>&nbsp;</td>
					<td><?php echo h(date('d M, Y',strtotime($order['Order']['order_date']))); ?>&nbsp;</td>
					<td><?php echo h($order['OrderDetail']['order_status']=='U'?'Undelivered':($order['OrderDetail']['order_status']=='C'?'Cancelled':'Delivered')); ?>&nbsp;</td>
					<td class="name">
						<?php echo $this->Html->link(__('View Details'), array('controller' => 'order_details','action' => 'index', base64_encode($order['OrderDetail']['id']))); ?>
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
		
		<div class="clear"></div>
	</div>
<div class="clear"></div>
</div>
<div class="clear"></div>