<div class="span9" id="content">
	<div class="row-fluid">
		<!-- block -->
		<div class="block">
			<div class="navbar navbar-inner block-header">
				<div class="muted pull-left"><?php echo __('Edit Review'); ?></div>
			</div>
			<div class="users form">
			<?php echo $this->Form->create('Rating'); ?>
				<fieldset>
				<?php
                                    echo $this->Form->input('id');
                                    echo $this->Form->input('user_name',array('required'=>'required','label'=>'User Name'));
                                    echo $this->Form->input('city',array('required'=>'required'));
                                    echo $this->Form->input('reception',array('required'=>'required', 'label'=>'Service'));
                                    echo $this->Form->input('treatement',array('required'=>'required', 'label'=>'Atmosphere'));
                                    echo $this->Form->input('expertise',array('required'=>'required', 'label'=>'Expertise'));
                                    echo $this->Form->input('comfort',array('required'=>'required', 'label'=>'Comfort'));
                                    echo $this->Form->input('overall_satisfaction',array('required'=>'required', 'label'=>'Overall Satisfaction'));
                                    echo $this->Form->input('comment',array('required'=>'required', 'label'=>'Brief comment'));
					
				?>
                                    <label for="">Would  you see this company again?</label>
                                    <span style="float:left"><input type='radio' name='data[Rating][see_company]' required value="1" <?php if(isset($this->request->data['Rating']['see_company'])&&$this->request->data['Rating']['see_company']=='1'){echo 'checked';}?>>&nbsp;Yes &nbsp;&nbsp;&nbsp;&nbsp;</span><span style=
				   "float:left"><input type='radio' name='data[Rating][see_company]' required value="0" <?php if(isset($this->request->data['Rating']['see_company'])&&$this->request->data['Rating']['see_company']=='0'){echo 'checked';}?>>&nbsp;No</span>
				
				</fieldset>
				
			<?php echo $this->Form->end(__('Submit')); ?>
			</div>
		</div>
	</div>
</div>
