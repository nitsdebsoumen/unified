<div class="listings form">
<?php echo $this->Form->create('Skill', array('enctype' => 'multipart/form-data')); ?>
    <fieldset>
        <legend>Add Skill</legend>
        <?php
        if($this->request->data['Skill']['image'] != '') {
        ?>
        <div style="width: 100%;">
            <img src="<?php echo $this->webroot.'skill_image/'.$this->request->data['Skill']['image'] ?>" style="max-width: 100%;" />
        </div>
        <?php
        }
        ?>
	<?php
        echo $this->Form->input('id');
        echo $this->Form->input('skill_name');
        echo $this->Form->input('skill_desc');
        echo $this->Form->input('image', array('type' => 'file'));
        echo $this->Form->input('status');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>

