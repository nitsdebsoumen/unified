<div class="categories form">
<?php echo $this->Form->create('SocialMedia',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Social Medias'); ?></legend>
	<?php
		
		echo $this->Form->input('title');
		echo $this->Form->input('url');
		echo $this->Form->input('icon',array('type'=>'file'));
		echo $this->Form->input('status',['type' => 'checkbox']);
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>

