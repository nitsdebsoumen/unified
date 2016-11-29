<section class="listing_result">
    <div class="container">
        <div class="row">
            <?php echo($this->element('leftpanel'))?>
            <div class="col-md-8">
            <?php if(empty($kyc) || $kyc['Kycdoc']['varification_status']==0) { ?>
                
                    <div class="right_bar">
       
                        <h3><?php echo 'KYC Varification'; ?></h3>
                        <?php echo $this->Form->create('Kycdoc', array('enctype' => 'multipart/form-data')); ?>

                        <fieldset>
                          <div class="form-group profile-field"> 
                              <?php
                              echo $this->Form->input('image',array( 'type' => 'file','class'=>'form-control'));
                              ?>
                          </div>
                          <div class="form-group profile-field">
                                          <?php
                              //echo $this->Form->input('user_id', array('options' => $users));
                              echo $this->Form->input('type', array('options' => array('Proof of identity' => 'Proof of identity','CAC Registration Certificate'=>'CAC Registration Certificate','Memorandum  and Articles of Association (Memart)'=>'Memorandum  and Articles of Association (Memart)','Professional Accreditation'=>'Professional Accreditation'),'class'=>'form-control')); ?>
                            <input type="hidden" id="lat" value="<?php echo $userid; ?>" name="data[Kycdoc][user_id]" >
                          </div>
                      </fieldset>
                      <div class="form-group profile-field">
                          <div >
                            <button type="submit" class="btn btn-default">Submit</button>
                            <?php echo $this->Form->end(); ?>
                          </div>
                      </div>
                    </div>
            <?php } if(!empty($kyc)) { ?>    

                    <div class="right_bar"  style="margin-top:10px">
                      <center><h3><?php echo 'KYC Varification Status'; ?></h3></center>
                      <center><?php if($kyc['Kycdoc']['varification_status']==0) { ?> <img style="height:30px;" src="<?php echo $this->webroot;?>img/cross-512.png"><?php } else { ?> <img style="height:30px;" src="<?php echo $this->webroot;?>img/success-01-128.png"> <?php } ?> </center>

                    </div>
                
            <?php } ?>        
        </div> 
        </div>
    </div>
</section>
  