<div class="categories form">
<?php echo $this->Form->create('FaqCategory',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Faq Category'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('active');
		echo $this->Form->input('parent_id',array('type' => 'hidden'));
               // echo $this->Form->input('hide_img',array('type' => 'hidden','value'=>isset($this->request->data['Category']['image'])?$this->request->data['Category']['image']:''));

	?>
                

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
