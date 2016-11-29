<div class="contents view">
<h2><?php echo __('Content'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($content['CmsPage']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Name'); ?></dt>
		<dd>
			<?php echo h($content['CmsPage']['page_title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Page Heading'); ?></dt>
		<dd>
			<?php echo h($content['CmsPage']['page_heading']); ?>
			&nbsp;
		</dd>		
		<dt><?php echo __('Content'); ?></dt>
		<dd>
			<?php echo (nl2br($content['CmsPage']['page_description'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<?php //echo $this->element('admin_sidebar'); ?>