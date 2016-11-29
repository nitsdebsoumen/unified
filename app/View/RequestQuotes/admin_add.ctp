<?php echo $this->Form->create('RequestQuote', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Add Quote'); ?></legend>
        <?php
        echo $this->Form->input('quotes',array( 'type' => 'file'));
        echo $this->Form->input('user_id', array('options' => $users));
        echo $this->Form->input('post_id', array('options' => $posts));
        //echo $this->Form->input('type', array('options' => array('Proof of identity' => 'Proof of identity')));
     	?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>