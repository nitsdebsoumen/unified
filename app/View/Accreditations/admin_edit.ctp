<div class="categories form">
<?php echo $this->Form->create('Accreditation',array('enctype'=>'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Accreditation'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('title');
		echo $this->Form->input('description');
		echo $this->Form->input('as_a_provider');
		echo $this->Form->input('training_courses');
		echo $this->Form->input('parent_id',array('type' => 'hidden'));
		echo $this->Form->input('accreditation_id');
		
                
                echo $this->Form->input('hide_img',array('type' => 'hidden','value'=>isset( $this->request->data['Accreditation']['image'])? $this->request->data['Accreditation']['image']:''));
		echo $this->Form->input('image',array('type'=>'file'));

	?>
                
                <div>
                    <?php
                        if(isset( $this->request->data['Accreditation']['image']) and !empty( $this->request->data['Accreditation']['image']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>accreditation/<?php echo $this->request->data['Accreditation']['image'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                    <?php } ?>
                </div> 
                <?php //} ?>

	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('cat_desc',
            {
                width: "95%"
            });
</script>