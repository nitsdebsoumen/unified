<div class="categories form">
<?php echo $this->Form->create('Sitemap',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Sitemap'); ?></legend>
	<?php
	
		echo $this->Form->input('id');
	
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('status',['type' => 'checkbox']);
	

	?>          
            
      <?php  ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
