<style>
#content {
    overflow: inherit;
}
</style>
<?php //pr($users); ?>
<div class="categories form">
<?php echo $this->Form->create('Post',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Course'); ?></legend>
	<?php
        if(!empty($user_company) && $user_company['Company']['id']=='')
        { ?>
            <label>Company Name</label>
            <select id="PostUserId" name="data[Post][user_id]">
                <option value="<?php echo $user_company['User']['id']?>"><?php echo $user_company['User']['first_name'].' '.$user_company['User']['last_name'].'[No Company Details]';?></option>
                
            </select>    
        <?php }
        elseif($user_company!='')
        { ?>
            <label>Company Name</label>
            <select id="PostUserId" name="data[Post][user_id]">
                <option value="<?php echo $user_company['Company']['user_id']?>"><?php echo $user_company['Company']['company_name']?></option>
                
            </select>    
        <?php }
        else
        { ?>
		    <label>Company Name</label>
            <select id="PostUserId" name="data[Post][user_id]">
                <?php foreach ($users as $key => $value) { ?>
                <option value="<?php echo $value['User']['id'];?>"><?php if($value['Company']['id']!=''){echo $value['Company']['company_name'];}else{ echo $value['User']['first_name'].' '.$value['User']['last_name'].'[No Company Details]'; } ?></option>
                <?php } ?>
            </select> 
        <?php }
		echo $this->Form->input('category_id',array('empty' => '(choose any category)', 'label' => 'Course Category'));
                //echo $this->Form->input('Skill.Skill');
		echo $this->Form->input('post_title', array('label' => 'Course Title'));
		echo $this->Form->input('post_description', array('label' => 'Course Description', 'type' => 'textarea','id'=>'post_desc'));
        echo $this->Form->input('short_summary', array('label' => 'Short Summary'));
        echo $this->Form->input('quantity', array('label' => 'Maximum Number'));
		echo $this->Form->input('who_should_attend',array('type' => 'textarea','id'=>'who_should_attend'));
        echo $this->Form->input('Keyword');
        echo $this->Form->input('price');
        echo $this->Form->input('type_of_course', array(
                                    'label'=>'Delivery',
                                    'options' => array('Classroom','Online'),
                                    'empty' => '(choose one)'
                                ));
        echo $this->Form->input('type_of_course', array(
            'options' => array('Classroom','Online'),
            'empty' => '(choose one)'
        ));
        $option = array(''=>'--select location--');
        echo $this->Form->input('CourseLocation', array('options'=>$option,'class'=>'form-control multipleSelect','multiple' => true,'id'=>'PostLocation','label'=>FALSE,'div' => FALSE)); ?>
        <a id="myAnchor" href="<?php echo $this->webroot;?>admin/course_locations/add/">Add Course Location</a>
        <?php 
        echo $this->Form->input('startdate');
        echo $this->Form->input('enddate');
        echo $this->Form->input('type_of_course', array(
                                    'label'=>'Status',
                                    'class'=>'form-control border',
                                    'options' => array('1'=>'Draft','2'=>'Active','3'=>'Inactive'),
                                    'empty' => '(choose one)'
                                ));
        echo $this->Form->input('course_duration');
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

<link rel="stylesheet" href="<?php echo $this->webroot;?>css/fastselect.min.css">
<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script src="<?php echo $this->webroot;?>js/fastselect.standalone.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('post_desc',
            {
                width: "95%"
            });
    CKEDITOR.replace('who_should_attend',
            {
                width: "95%"
            });
   
$(document).ready(function(){
     //$('.multipleSelect').fastselect();
   var uid = $("#PostUserId").val();
      document.getElementById("myAnchor").href = "<?php echo $this->webroot; ?>admin/course_locations/add/"+uid;
});
$("#PostUserId").change(function(){
   var uid = $(this).val();
      document.getElementById("myAnchor").href = "<?php echo $this->webroot;?>admin/course_locations/add/"+uid;
});
$(document).ready(function(){
   var uid = $("#PostUserId").val();
      $.ajax({
            url: "<?php echo $this->webroot; ?>course_locations/ajaxLocationOnLoad",
            type: 'post',
            dataType: 'json',
            data: {
                user_id:uid
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#PostLocation').html('');
                    $('#PostLocation').html(result.res);
                }
                else{
                    $('#PostLocation').html('');
                    $('#PostLocation').html(result.res);
                } 
            }
        });

$(document).on('change',"#PostUserId",function(){
   var uid = $("#PostUserId").val();
      $.ajax({
            url: "<?php echo $this->webroot; ?>course_locations/ajaxLocationOnChange",
            type: 'post',
            dataType: 'json',
            data: {
                user_id:uid
            },
            success: function(result){
                if(result.ack == '1') {
              
                    $('#PostLocation').html('');
                    $('#PostLocation').html(result.html1);
                           // $('.fstResults').html('');
                           // $('.fstResults').html(result.res);
                           // $('.multipleSelect').fastselect();
                }
                else{
                    // $('.fstToggleBtn').html('');
                    // $('.fstResults').html('');
                    // $('.fstResults').html(result.res);
                    $('#PostLocation').html('');
                    $('#PostLocation').html(result.html1);
                } 
                   
            }
        });
});      

});

</script>