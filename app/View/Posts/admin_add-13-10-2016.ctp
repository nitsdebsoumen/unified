<div class="categories form">
<?php echo $this->Form->create('Post',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Course'); ?></legend>
	<?php
		echo $this->Form->input('user_id',array('empty' => '(choose any user)', 'label' => 'Provider'));
		echo $this->Form->input('category_id',array('empty' => '(choose any category)', 'label' => 'Course Category'));
                //echo $this->Form->input('Skill.Skill');
		echo $this->Form->input('post_title', array('label' => 'Course Title'));
		echo $this->Form->input('post_description', array('label' => 'Course Description', 'type' => 'textarea','id'=>'post_desc'));
		echo $this->Form->input('price');
        echo $this->Form->input('who_should_attend',array('type' => 'textarea','id'=>'who_should_attend'));
        echo $this->Form->input('location');
        echo $this->Form->input('type_of_course', array(
            'options' => array('Classroom','Online'),
            'empty' => '(choose one)'
        ));  
		echo $this->Form->input('is_approve');
		echo $this->Form->input('is_show_home_page');
		//echo $this->Form->input('image',array('type'=>'file', 'label' => 'Course Image'));
	?>
    </fieldset>
   <!--  <fieldset>
        <?php
        echo $this->Form->input('Skill',array(
            'label' => __('Skills',true),
            'type' => 'select',
            'multiple' => 'checkbox',
            'options' => $skills
        )); 
        ?>
    </fieldset> -->
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?> 

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('post_desc',
            {
                width: "95%"
            });
    CKEDITOR.replace('who_should_attend',
            {
                width: "95%"
            });
</script>