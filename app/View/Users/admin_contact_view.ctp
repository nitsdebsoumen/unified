<div class="users view">
<h2><?php echo __('User Contact Us'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($Contactuser['Contact']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Name'); ?></dt>
		<dd>
			<?php echo h($Contactuser['Contact']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Email'); ?></dt>
		<dd>
			<?php echo h($Contactuser['Contact']['email_address']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subject'); ?></dt>
		<dd>
			<?php echo h($Contactuser['Contact']['subject']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($Contactuser['Contact']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Contact Date'); ?></dt>
		<dd>
			<?php echo h($Contactuser['Contact']['post_date']); ?>
			&nbsp;
		</dd>
		
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
