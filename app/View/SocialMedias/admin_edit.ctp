<div class="categories form">
<?php echo $this->Form->create('SocialMedia',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Social Media'); ?></legend>
        <?php
        if($this->request->data['SocialMedia']['icon'] != '') {
        ?>
        <div style="width: 100%;">
            <img src="<?php echo $this->webroot.'social_media_icon/'.$this->request->data['SocialMedia']['icon'] ?>" style="max-width: 100%;" />
        </div>
        <?php
        }
        ?>

	<?php
		
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('url');
		echo $this->Form->input('icon',array('type'=>'file'));
		echo $this->Form->input('status',['type'=>'checkbox']);
		
	?>               
    <?php  ?>

    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
