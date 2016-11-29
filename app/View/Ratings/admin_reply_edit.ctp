<div class="span9" id="content">
	<div class="row-fluid">
		<!-- block -->
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><?php echo __('Edit Reply'); ?></div>
			</div>
			<div class="users form">
			<?php echo $this->Form->create('ReviewReply'); ?>
				<fieldset>
				<?php
                                    echo $this->Form->input('id');
                                    echo $this->Form->input('replies',array('required'=>'required', 'label'=>'Brief comment'));
				?>
                                </fieldset>
				
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>
	</div>
</div>
