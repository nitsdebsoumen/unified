<div class="contents view">
<h2><?php echo __('Content'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($content['MembershipPlan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($content['MembershipPlan']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No of Post'); ?></dt>
		<dd>
			<?php echo h($content['MembershipPlan']['no_of_post']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No of Marketplace'); ?></dt>
		<dd>
			<?php echo h($content['MembershipPlan']['no_of_marketplace']); ?>
			&nbsp;
		</dd>		
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo (nl2br($content['MembershipPlan']['price'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Month'); ?></dt>
		<dd>
			<?php echo (nl2br($content['MembershipPlan']['duration'])); ?>Month
			&nbsp;
		</dd>
	</dl>
</div>

<?php //echo $this->element('admin_sidebar'); ?>