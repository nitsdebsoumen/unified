<div class="currencies view">
<h2><?php echo __('Currency'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency Name'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['currency_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Short Code'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['short_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Symbol'); ?></dt>
		<dd>
			<?php echo h($currency['Currency']['symbol']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Currency'), array('action' => 'edit', $currency['Currency']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Currency'), array('action' => 'delete', $currency['Currency']['id']), null, __('Are you sure you want to delete # %s?', $currency['Currency']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Currencies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Currency'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Preferences'), array('controller' => 'preferences', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Preference'), array('controller' => 'preferences', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Preferences'); ?></h3>
	<?php if (!empty($currency['Preference'])): ?>
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
	<?php foreach ($currency['Preference'] as $preference): ?>
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
