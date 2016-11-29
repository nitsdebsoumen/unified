<div class="users form">
<?php echo $this->Form->create('User',array('onsubmit'=>'return check()')); ?>
	<fieldset>
		<legend><?php echo __('Change Password'); ?></legend>
	<?php
		echo $this->Form->input('is_admin', array('type' => 'hidden','value'=>1));
		echo $this->Form->input('is_active', array('type' => 'hidden','value'=>1));
                echo $this->Form->input('id',array('value'=>$this->Session->read('userid')));
		echo $this->Form->input('password',array('type'=>'password','required'=>'required','id'=>'pass'));
		echo $this->Form->input('confirm_pass',array('type'=>'password','id'=>'confirm_pass'));
		
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
<script>
    function check() { 
    pass=$("#pass").val();
    confirm_pass=$("#confirm_pass").val();
    if(pass!=confirm_pass){
        $('#confirm_pass').get(0).setCustomValidity("Confirm  password doe's not match.");        
        return false;
    }  
    else {  
        $('#confirm_pass').get(0).setCustomValidity("");        
        
        }                 
}  
 </script>