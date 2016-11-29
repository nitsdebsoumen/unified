<div class="categories view">
<h2><?php echo __('Accreditation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($accreditation['Accreditation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($accreditation['Accreditation']['title']); ?>
			&nbsp;
		</dd>
	
		<dt><?php echo __('Accreditation Description'); ?></dt>
		<dd>
			<?php echo h($accreditation['Accreditation']['description']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Accreditation'); ?></dt>
		<dd>
			<?php echo h($accreditation['AccreditationList']['title']); ?>
			&nbsp;
		</dd>
		
		<dt><?php echo __('Image'); ?></dt>
		<dd>
                    <?php
                    if(isset($accreditation['Accreditation']['image']) and !empty($accreditation['Accreditation']['image']))
                    {
                    ?>
                    <img alt="" src="<?php echo $this->webroot;?>accreditation/<?php echo $accreditation['Accreditation']['image'];?>" style=" height:80px; width:80px;">
                    <?php
                    }
                    else{
                    ?>
                   <img alt="" src="<?php echo $this->webroot;?>noimage.png" style=" height:80px; width:80px;">

                   <?php } ?>
		</dd>
                <dt><?php echo __('As A Provider'); ?></dt>
		<dd>
			<?php echo h($accreditation['Accreditation']['as_a_provider']==1?'Active':'Inactive'); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Training Courses'); ?></dt>
		<dd>
			<?php echo h($accreditation['Accreditation']['training_courses']==1?'Active':'Inactive'); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php //echo $this->element('admin_sidebar'); ?>
