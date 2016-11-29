<div class="users form">
    <?php echo $this->Form->create('User', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit User'); ?></legend>
        <?php
        echo $this->Form->input('hidpw', array('type' => 'hidden', 'value' => $this->request->data['User']['user_pass']));
        echo $this->Form->input('id');
        echo $this->Form->input('first_name');
        echo $this->Form->input('last_name');
        echo $this->Form->input('user_pass', array('value' => ''));
        echo $this->Form->input('email_address');
        echo $this->Form->input('country_id');
        echo $this->Form->input('state');
        echo $this->Form->input('city');
        echo $this->Form->input('zip');
        echo $this->Form->input('Address1');
        echo $this->Form->input('Phone_number');
        echo $this->Form->input('status', array('label' => 'Activity Status'));
        if (!isset($this->request->data['UserImage']['0']['id'])) {
            echo $this->Form->input('userimage_id', array('type' => 'hidden', 'default' => ''));
        } else {
            echo $this->Form->input('userimage_id', array('type' => 'hidden', 'default' => $this->request->data['UserImage']['0']['id']));
        }
        
        echo $this->Form->input('admin_type', array('label' => 'Role', 'options' => $roles));
        
        echo $this->Form->input('image', array('type' => 'file'));
        ?>
        <div>
            <?php
            if (isset($this->request->data['UserImage']['0']['originalpath']) and ! empty($this->request->data['UserImage']['0']['originalpath'])) {
                ?>
                <img alt="" src="<?php echo $this->webroot; ?>user_images/<?php echo $this->request->data['UserImage']['0']['originalpath']; ?>" style=" height:80px; width:80px;">
                <?php
            } else {
                ?>
                <img alt="" src="<?php echo $this->webroot; ?>user_images/default.png" style=" height:80px; width:80px;">

            <?php } ?>
        </div> 
    </fieldset>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
