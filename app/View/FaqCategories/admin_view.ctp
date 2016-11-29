<div class="categories view">
<h2><?php echo __('Faq Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['FaqCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Faq Category Name'); ?></dt>
		<dd>
			<?php echo h($category['FaqCategory']['name']); ?>
			&nbsp;
		</dd>
		<?php
		if($category['FaqCategory']['parent_id']!=0)
		{
		?>
		<dt><?php echo __('Parent Category'); ?></dt>
		<dd>
			<?php echo h($categoryname); ?>
			&nbsp;
		</dd>
		<?php
		}
		?>
                
                
		<dt><?php echo __('Active'); ?></dt>
		<dd>
			<?php echo h($category['FaqCategory']['active']==1?'Active':'Inactive'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
