<div class="contents form">
<?php 
echo $this->Html->script('ckeditor/ckeditor'); 
echo $this->Form->create('PromoCode'); ?>
	<fieldset>
		<legend><?php echo __('Edit Promo Code'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('promo_title',array('required'=>'required'));
        echo $this->Form->input('code',array('required'=>'required'));
        echo $this->Form->input('no_of_use',array('type'=>'number','min'=>1,'required'=>'required'));
        echo $this->Form->input('discount',array('required'=>'required'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

        