<section class="listing_result">
  <div class="container">
    <div class="row">
        <?php echo($this->element('leftpanel'))?>
        <div class="col-md-8">
            <div class="right_bar">
          <div class="blogs form">
          <?php echo $this->Form->create('RequestQuote',array('enctype' => 'multipart/form-data')); ?>
              <fieldset>
                  <legend><?php echo __('Edit Quote Delails'); ?></legend>
                  <?php

                  if($this->request->data['RequestQuote']['quotes'] != '') {
                  ?>
                  <div style="width: 100%;">

                      <?php 
                        $arr=explode('.',$this->request->data['RequestQuote']['quotes']);
                        $extention = end($arr);
                        if ($extention=='jpeg' || $extention=='jpg' || $extention=='png' ) { ?>
                            <img src="<?php echo $this->webroot.'quote/'.$this->request->data['RequestQuote']['quotes'] ?>" style="width: 30%;" />
                       <?php }

                       elseif($extention=='pdf' || $extention=='doc' || $extention== 'docx') { ?>
                        <a href='<?php echo $this->webroot.'quote/'.$this->request->data['RequestQuote']['quotes'] ?>' download="" class="btn btn-primary">
                          Download
                        </a>                
                      <?php  }
                      ?>
                      
                  </div>
                  <?php
                  }
                  ?>
          	   <?php
                  echo $this->Form->input('id');
                  echo $this->Form->input('quotes', array('type' => 'hidden', 'name' => 'saved_image'));
                  //echo $this->Form->input('user_id', array('options' => $users));
                  //echo $this->Form->input('post_id', array('options' => $posts));
                  echo $this->Form->input('quotes', array('type' => 'file'));
                  echo $this->Form->input('status',array('class'=>''));
              ?>

              </fieldset>
          <?php echo $this->Form->end(__('Submit',array('class'=>'btn btn-default'))); ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>