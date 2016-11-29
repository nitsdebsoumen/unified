<div class="contents form">
<?php 
echo $this->Form->create('Contact'); ?>
	<fieldset>
		<legend><?php echo __('Add Content'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('subject');
		echo $this->Form->input('message',array('type'=>'textarea','id'=>'message' ));
		echo $this->Form->input('email_address',array('type'=>'email'));
		echo $this->Form->input('phone_number');
		//echo $this->Form->input('content');
		//echo $this->Form->textarea('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('message',
            {
                width: "95%"
            });
</script>