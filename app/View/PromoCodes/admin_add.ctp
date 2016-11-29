<div class="venue form">
<?php echo $this->Form->create('PromoCode',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Promo Code'); ?></legend>
	<?php
        echo $this->Form->input('promo_title',array('required'=>'required'));
        echo $this->Form->input('code',array('required'=>'required'));
        echo $this->Form->input('no_of_use',array('type'=>'number','min'=>1,'required'=>'required'));
        echo $this->Form->input('discount',array('required'=>'required'));
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
