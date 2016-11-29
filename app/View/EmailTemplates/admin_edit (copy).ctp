<div class="span9" id="content">
	<div class="row-fluid">
		<!-- block -->
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><?php echo __('Edit Email Template'); ?></div>
			</div>
			<div class="users form">
			<?php echo $this->Form->create('EmailTemplate',array('enctype'=>'multipart/form-data')); ?>
				<fieldset>
				<?php
					echo $this->Form->input('id');
					echo $this->Form->input('subject');
					echo $this->Form->input('content',array('id'=>'editor1'));
				?>
				</fieldset>
				
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>
	</div>
</div>
<script src="<?php echo $this->webroot?>admin_styles/vendors/jquery-1.9.1.min.js"></script>

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script>
CKEDITOR.replace( 'editor1',

 {

 	//filebrowserBrowseUrl : './ckfinder/ckfinder.html',

 	//filebrowserImageBrowseUrl : './ckfinder/ckfinder.html?type=Images',

 	filebrowserFlashBrowseUrl : '<?php echo $this->webroot;?>/ckfinder/ckfinder.html?type=Flash',
 	filebrowserUploadUrl : '<?php echo $this->webroot;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
  	filebrowserImageUploadUrl: '<?php echo $this->webroot;?>/ckeditor/plugins/imgupload.php',
 	filebrowserFlashUploadUrl : '<?php echo $this->webroot;?>/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'

 } 

 );
 </script>