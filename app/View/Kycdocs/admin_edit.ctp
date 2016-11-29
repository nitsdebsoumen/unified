<?php 
//pr($this->request->data);
?>
<div class="blogs form">
<?php echo $this->Form->create('Kycdoc',array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit KYC Delails'); ?></legend>
        <?php

        if($this->request->data['Kycdoc']['doc'] != '') {
        ?>
        <div style="width: 100%;">
            <img src="<?php echo $this->webroot.'kycdoc/'.$this->request->data['Kycdoc']['doc'] ?>" style="width: 30%;" />
        </div>
        <?php
        }
        ?>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('doc', array('type' => 'hidden', 'name' => 'saved_image'));
        echo $this->Form->input('user_id',array('type'=>'hidden'));
        echo $this->Form->input('doc', array('type' => 'file'));
        //echo $this->Form->input('title',array('required'=>'required'));
        //echo $this->Form->input('desc',array('required'=>'required', 'label' => 'Description', 'id' => 'banner_desc'));
        echo $this->Form->input('refused_reason');
        echo $this->Form->input('varification_status');
        //echo $this->Form->input('order', array('default' => 0));
	?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>