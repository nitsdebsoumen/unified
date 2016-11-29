<script>
    $(document).ready(function () {
        $("#BlogAdminAddForm").validationEngine();
    });
</script>
<div class="blogs form">
<?php echo $this->Form->create('Adminrole', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Adminrole'); ?></legend>
        <?php
        echo $this->Form->input('name',array('required'=>'required'));
	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo($this->element('admin_sidebar'));?>
