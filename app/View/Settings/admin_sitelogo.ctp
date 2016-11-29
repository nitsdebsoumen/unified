<div class="sitesettings form">
<?php echo $this->Form->create('Setting',array('enctype'=>'multipart/form-data')); ?>
    <fieldset>
        <legend><?php echo __('Edit Site Logo'); ?></legend>
        <input type="hidden" name="data[Setting][hidsite_logo]" id="SiteSettingHidSiteLogo" value="<?php echo($this->request->data['Setting']['logo']);?>"/>
	<?php
            
                $uploadFolder = "site_logo";
                $uploadPath = WWW_ROOT . $uploadFolder;
                $imageName = $this->request->data['Setting']['logo'];
                if(file_exists($uploadPath . '/' . $imageName) && $imageName!=''){
                        echo($this->Html->image('/site_logo/'.$imageName, array('alt' => 'Site Logo', 'height'=> '100px', 'width'=> '200px')));
                }else{

                }
		echo $this->Form->input('id');
                echo $this->Form->input('logo',array('type'=>'file'));
	?>
        <font color="red">Please upload image of .jpg, .jpeg, .png or .gif format.</font>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
