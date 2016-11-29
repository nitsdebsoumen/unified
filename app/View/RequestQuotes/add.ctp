<section class="listing_result">
<div class="container">
  <div class="row">
      <?php echo($this->element('leftpanel'))?>
      <div class="col-md-8">
          <div class="right_bar">

<h3><?php echo 'Add Quote'; ?></h3>
<?php echo $this->Form->create('RequestQuote', array('enctype' => 'multipart/form-data')); ?>

<fieldset>
     <div class="form-group profile-field"> 
  <?php
  echo $this->Form->input('quotes',array( 'type' => 'file','class'=>'form-control'));
  ?>
   </div>
                  <div class="form-group profile-field">
    <?php echo $this->Form->input('post_id', array('options' => $posts,'class'=>'form-control border'));?>
<input type="hidden" id="lat" value="<?php echo $userid; ?>" name="data[RequestQuote][user_id]" >
</div>
</fieldset>
<div class="form-group profile-field">
                      <div >
                        <button type="submit" class="btn btn-default">Submit</button>
<?php echo $this->Form->end(); ?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</section>
