<section class="listing_result">
<div class="container">
  <div class="row">
      <?php echo($this->element('leftpanel'))?>
      <div class="col-md-8">
          <div class="right_bar">

<h3><?php echo 'Add Suggested Category'; ?></h3>
<?php echo $this->Form->create('SuggestCategory', array('enctype' => 'multipart/form-data')); ?>

<fieldset>
  <div class="form-group profile-field">
  <?php
     echo $this->Form->input('category_name',array( 'type' => 'text','class'=>'form-control'));
  ?>
   </div>

  <!-- <div class="form-group profile-field">
  <?php
     echo $this->Form->input('country_id',array('options'=>$countries));
  ?>
   </div> -->

   <div class="form-group profile-field">
  <?php
     echo $this->Form->input('category_description',array('id'=>'cat_desc'));
  ?>
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

<script type="text/javascript" src="<?php echo $this->webroot;?>ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo $this->webroot;?>ckfinder/ckfinder_v1.js"></script>
<script type="text/javascript">
    CKEDITOR.replace('cat_desc',
            {
                width: "95%"
            });
</script>


</div>
</div>
</div>
</section>
