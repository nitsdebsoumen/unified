<div class="contents view">
<h2><?php echo __('Content'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($content['FeaturedPlan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($content['FeaturedPlan']['title']); ?>
			&nbsp;
		</dd>
		<!-- <dt><?php echo __('No of Post'); ?></dt>
		<dd>
			<?php echo h($content['FeaturedPlan']['no_of_post']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('No of Marketplace'); ?></dt>
		<dd>
			<?php echo h($content['FeaturedPlan']['no_of_marketplace']); ?>
			&nbsp;
		</dd>		 -->
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo (nl2br($content['FeaturedPlan']['price'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duration'); ?></dt>
		<dd>
			<?php echo (nl2br($content['FeaturedPlan']['duration'])); ?>Days
			&nbsp;
		</dd>
	</dl>
</div>

<?php //echo $this->element('admin_sidebar'); ?>