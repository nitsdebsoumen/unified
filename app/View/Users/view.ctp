<div class="users view">
<h2><?php echo __('User'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('First Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['first_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Last Name'); ?></dt>
		<dd>
			<?php echo h($user['User']['last_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Gender'); ?></dt>
		<dd>
			<?php echo h($user['User']['gender']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City'); ?></dt>
		<dd>
			<?php echo h($user['User']['city']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Country'); ?></dt>
		<dd>
			<?php echo h($user['User']['country']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Birthday'); ?></dt>
		<dd>
			<?php echo h($user['User']['birthday']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('About'); ?></dt>
		<dd>
			<?php echo h($user['User']['about']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Favorite Materials'); ?></dt>
		<dd>
			<?php echo h($user['User']['favorite_materials']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Include Shop'); ?></dt>
		<dd>
			<?php echo h($user['User']['include_shop']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Include Favorite Items'); ?></dt>
		<dd>
			<?php echo h($user['User']['include_favorite_items']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Include Favorite Shops'); ?></dt>
		<dd>
			<?php echo h($user['User']['include_favorite_shops']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Include Treasury Lists'); ?></dt>
		<dd>
			<?php echo h($user['User']['include_treasury_lists']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Include Teams'); ?></dt>
		<dd>
			<?php echo h($user['User']['include_teams']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($user['User']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($user['User']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Join Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['join_active']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Is Active'); ?></dt>
		<dd>
			<?php echo h($user['User']['is_active']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), null, __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Email Notifications'), array('controller' => 'email_notifications', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Email Notification'), array('controller' => 'email_notifications', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Lists'), array('controller' => 'favorite_lists', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite List'), array('controller' => 'favorite_lists', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Shops'), array('controller' => 'favorite_shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite Shop'), array('controller' => 'favorite_shops', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Favorite Treasuries'), array('controller' => 'favorite_treasuries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Favorite Treasury'), array('controller' => 'favorite_treasuries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Inbox Messages'), array('controller' => 'inbox_messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Inbox Message'), array('controller' => 'inbox_messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Preferences'), array('controller' => 'preferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Preference'), array('controller' => 'preferences', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Privacies'), array('controller' => 'privacies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Privacy'), array('controller' => 'privacies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Securities'), array('controller' => 'securities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Security'), array('controller' => 'securities', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sent Messages'), array('controller' => 'sent_messages', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sent Message'), array('controller' => 'sent_messages', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shipping Addresses'), array('controller' => 'shipping_addresses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shipping Address'), array('controller' => 'shipping_addresses', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Shops'), array('controller' => 'shops', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Email Notifications'); ?></h3>
	<?php if (!empty($user['EmailNotification'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Someone Sends Me A Convo'); ?></th>
		<th><?php echo __('Send Convo'); ?></th>
		<th><?php echo __('Someone Follows Me'); ?></th>
		<th><?php echo __('Listings About To Expire'); ?></th>
		<th><?php echo __('My Seller Activity'); ?></th>
		<th><?php echo __('Whats New'); ?></th>
		<th><?php echo __('Recommended Features'); ?></th>
		<th><?php echo __('Tips Of Improving Shop'); ?></th>
		<th><?php echo __('Provide Feedback'); ?></th>
		<th><?php echo __('Receive Feedback'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['EmailNotification'] as $emailNotification): ?>
		<tr>
			<td><?php echo $emailNotification['id']; ?></td>
			<td><?php echo $emailNotification['user_id']; ?></td>
			<td><?php echo $emailNotification['someone_sends_me_a_convo']; ?></td>
			<td><?php echo $emailNotification['send_convo']; ?></td>
			<td><?php echo $emailNotification['someone_follows_me']; ?></td>
			<td><?php echo $emailNotification['listings_about_to_expire']; ?></td>
			<td><?php echo $emailNotification['my_seller_activity']; ?></td>
			<td><?php echo $emailNotification['whats_new']; ?></td>
			<td><?php echo $emailNotification['recommended_features']; ?></td>
			<td><?php echo $emailNotification['tips_of_improving_shop']; ?></td>
			<td><?php echo $emailNotification['provide_feedback']; ?></td>
			<td><?php echo $emailNotification['receive_feedback']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'email_notifications', 'action' => 'view', $emailNotification['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'email_notifications', 'action' => 'edit', $emailNotification['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'email_notifications', 'action' => 'delete', $emailNotification['id']), null, __('Are you sure you want to delete # %s?', $emailNotification['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Email Notification'), array('controller' => 'email_notifications', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Favorite Lists'); ?></h3>
	<?php if (!empty($user['FavoriteList'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('List Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['FavoriteList'] as $favoriteList): ?>
		<tr>
			<td><?php echo $favoriteList['id']; ?></td>
			<td><?php echo $favoriteList['user_id']; ?></td>
			<td><?php echo $favoriteList['list_name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'favorite_lists', 'action' => 'view', $favoriteList['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'favorite_lists', 'action' => 'edit', $favoriteList['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'favorite_lists', 'action' => 'delete', $favoriteList['id']), null, __('Are you sure you want to delete # %s?', $favoriteList['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Favorite List'), array('controller' => 'favorite_lists', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Favorite Shops'); ?></h3>
	<?php if (!empty($user['FavoriteShop'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Shop Id'); ?></th>
		<th><?php echo __('Who Can View'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['FavoriteShop'] as $favoriteShop): ?>
		<tr>
			<td><?php echo $favoriteShop['id']; ?></td>
			<td><?php echo $favoriteShop['user_id']; ?></td>
			<td><?php echo $favoriteShop['shop_id']; ?></td>
			<td><?php echo $favoriteShop['who_can_view']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'favorite_shops', 'action' => 'view', $favoriteShop['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'favorite_shops', 'action' => 'edit', $favoriteShop['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'favorite_shops', 'action' => 'delete', $favoriteShop['id']), null, __('Are you sure you want to delete # %s?', $favoriteShop['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Favorite Shop'), array('controller' => 'favorite_shops', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Favorite Treasuries'); ?></h3>
	<?php if (!empty($user['FavoriteTreasury'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Treasury Id'); ?></th>
		<th><?php echo __('Who Can View'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['FavoriteTreasury'] as $favoriteTreasury): ?>
		<tr>
			<td><?php echo $favoriteTreasury['id']; ?></td>
			<td><?php echo $favoriteTreasury['user_id']; ?></td>
			<td><?php echo $favoriteTreasury['treasury_id']; ?></td>
			<td><?php echo $favoriteTreasury['who_can_view']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'favorite_treasuries', 'action' => 'view', $favoriteTreasury['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'favorite_treasuries', 'action' => 'edit', $favoriteTreasury['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'favorite_treasuries', 'action' => 'delete', $favoriteTreasury['id']), null, __('Are you sure you want to delete # %s?', $favoriteTreasury['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Favorite Treasury'), array('controller' => 'favorite_treasuries', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Inbox Messages'); ?></h3>
	<?php if (!empty($user['InboxMessage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Sender Id'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th><?php echo __('Read'); ?></th>
		<th><?php echo __('Trash'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['InboxMessage'] as $inboxMessage): ?>
		<tr>
			<td><?php echo $inboxMessage['id']; ?></td>
			<td><?php echo $inboxMessage['user_id']; ?></td>
			<td><?php echo $inboxMessage['sender_id']; ?></td>
			<td><?php echo $inboxMessage['subject']; ?></td>
			<td><?php echo $inboxMessage['message']; ?></td>
			<td><?php echo $inboxMessage['date_time']; ?></td>
			<td><?php echo $inboxMessage['read']; ?></td>
			<td><?php echo $inboxMessage['trash']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'inbox_messages', 'action' => 'view', $inboxMessage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'inbox_messages', 'action' => 'edit', $inboxMessage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'inbox_messages', 'action' => 'delete', $inboxMessage['id']), null, __('Are you sure you want to delete # %s?', $inboxMessage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Inbox Message'), array('controller' => 'inbox_messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Preferences'); ?></h3>
	<?php if (!empty($user['Preference'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Filter Mature Content'); ?></th>
		<th><?php echo __('Language Id'); ?></th>
		<th><?php echo __('Currency Id'); ?></th>
		<th><?php echo __('Region'); ?></th>
		<th><?php echo __('Receive Email From Admin'); ?></th>
		<th><?php echo __('Receive Phonecalls From Admin'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Preference'] as $preference): ?>
		<tr>
			<td><?php echo $preference['id']; ?></td>
			<td><?php echo $preference['user_id']; ?></td>
			<td><?php echo $preference['filter_mature_content']; ?></td>
			<td><?php echo $preference['language_id']; ?></td>
			<td><?php echo $preference['currency_id']; ?></td>
			<td><?php echo $preference['region']; ?></td>
			<td><?php echo $preference['receive_email_from_admin']; ?></td>
			<td><?php echo $preference['receive_phonecalls_from_admin']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'preferences', 'action' => 'view', $preference['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'preferences', 'action' => 'edit', $preference['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'preferences', 'action' => 'delete', $preference['id']), null, __('Are you sure you want to delete # %s?', $preference['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Preference'), array('controller' => 'preferences', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Privacies'); ?></h3>
	<?php if (!empty($user['Privacy'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Findability'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Privacy'] as $privacy): ?>
		<tr>
			<td><?php echo $privacy['id']; ?></td>
			<td><?php echo $privacy['user_id']; ?></td>
			<td><?php echo $privacy['findability']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'privacies', 'action' => 'view', $privacy['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'privacies', 'action' => 'edit', $privacy['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'privacies', 'action' => 'delete', $privacy['id']), null, __('Are you sure you want to delete # %s?', $privacy['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Privacy'), array('controller' => 'privacies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Securities'); ?></h3>
	<?php if (!empty($user['Security'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Full Site Ssl'); ?></th>
		<th><?php echo __('Two Factor Authentication'); ?></th>
		<th><?php echo __('Sign In Notifications'); ?></th>
		<th><?php echo __('Sign In History'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Security'] as $security): ?>
		<tr>
			<td><?php echo $security['id']; ?></td>
			<td><?php echo $security['user_id']; ?></td>
			<td><?php echo $security['full_site_ssl']; ?></td>
			<td><?php echo $security['two_factor_authentication']; ?></td>
			<td><?php echo $security['sign_in_notifications']; ?></td>
			<td><?php echo $security['sign_in_history']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'securities', 'action' => 'view', $security['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'securities', 'action' => 'edit', $security['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'securities', 'action' => 'delete', $security['id']), null, __('Are you sure you want to delete # %s?', $security['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Security'), array('controller' => 'securities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Sent Messages'); ?></h3>
	<?php if (!empty($user['SentMessage'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Receiver Id'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Message'); ?></th>
		<th><?php echo __('Date Time'); ?></th>
		<th><?php echo __('Trash'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['SentMessage'] as $sentMessage): ?>
		<tr>
			<td><?php echo $sentMessage['id']; ?></td>
			<td><?php echo $sentMessage['user_id']; ?></td>
			<td><?php echo $sentMessage['receiver_id']; ?></td>
			<td><?php echo $sentMessage['subject']; ?></td>
			<td><?php echo $sentMessage['message']; ?></td>
			<td><?php echo $sentMessage['date_time']; ?></td>
			<td><?php echo $sentMessage['trash']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'sent_messages', 'action' => 'view', $sentMessage['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'sent_messages', 'action' => 'edit', $sentMessage['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'sent_messages', 'action' => 'delete', $sentMessage['id']), null, __('Are you sure you want to delete # %s?', $sentMessage['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sent Message'), array('controller' => 'sent_messages', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Shipping Addresses'); ?></h3>
	<?php if (!empty($user['ShippingAddress'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Full Name'); ?></th>
		<th><?php echo __('Street'); ?></th>
		<th><?php echo __('Apartment'); ?></th>
		<th><?php echo __('City'); ?></th>
		<th><?php echo __('State'); ?></th>
		<th><?php echo __('Zip Code'); ?></th>
		<th><?php echo __('Country'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['ShippingAddress'] as $shippingAddress): ?>
		<tr>
			<td><?php echo $shippingAddress['id']; ?></td>
			<td><?php echo $shippingAddress['user_id']; ?></td>
			<td><?php echo $shippingAddress['full_name']; ?></td>
			<td><?php echo $shippingAddress['street']; ?></td>
			<td><?php echo $shippingAddress['apartment']; ?></td>
			<td><?php echo $shippingAddress['city']; ?></td>
			<td><?php echo $shippingAddress['state']; ?></td>
			<td><?php echo $shippingAddress['zip_code']; ?></td>
			<td><?php echo $shippingAddress['country']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shipping_addresses', 'action' => 'view', $shippingAddress['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shipping_addresses', 'action' => 'edit', $shippingAddress['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shipping_addresses', 'action' => 'delete', $shippingAddress['id']), null, __('Are you sure you want to delete # %s?', $shippingAddress['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shipping Address'), array('controller' => 'shipping_addresses', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php echo __('Related Shops'); ?></h3>
	<?php if (!empty($user['Shop'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Shop Name'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($user['Shop'] as $shop): ?>
		<tr>
			<td><?php echo $shop['id']; ?></td>
			<td><?php echo $shop['user_id']; ?></td>
			<td><?php echo $shop['shop_name']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'shops', 'action' => 'view', $shop['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'shops', 'action' => 'edit', $shop['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'shops', 'action' => 'delete', $shop['id']), null, __('Are you sure you want to delete # %s?', $shop['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Shop'), array('controller' => 'shops', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
