<section class="listing_result">
<div class="container">
  <div class="row">
      <?php echo($this->element('leftpanel'))?>
      <div class="col-md-8">
          <div class="right_bar">

<h3><?php echo 'Add Course location'; ?></h3>
<?php echo $this->Form->create('CourseLocation', array('enctype' => 'multipart/form-data')); ?>

<fieldset>

  <div class="form-group profile-field">
 <?php
        echo $this->Form->input(
            'country',
            array(
                'empty' => '(Choose any country)',
                'label' => FALSE,
                'class' => 'form-control border',
                'div' => FALSE,
                'required' => 'required'
            )
        );
  ?>
  </div>


  <div class="form-group profile-field">
  <?php
        echo $this->Form->input(
            'state',
            array(
                'empty' => '(Choose any state)',
                'label' => FALSE,
                'class' => 'form-control border',
                'div' => FALSE,
                'required' => 'required'
            )
        );
   ?>
   </div>

  <div class="form-group profile-field">
  <?php
        echo $this->Form->input(
            'city',
            array(
                'empty' => '(Choose any city)',
                'label' => FALSE,
                'class' => 'form-control border',
                'div' => FALSE,
                'required' => 'required'
            )
        );
  ?>
   </div>


  <div class="form-group profile-field">
  <?php
        echo $this->Form->input(
            'lga_id',
            array(
                'empty' => '(Choose any lgas)',
                'label' => FALSE,
                'class' => 'form-control border',
                'div' => FALSE,
            )
        );
  ?>
   </div>


   <div class="form-group profile-field">
  <?php
     echo $this->Form->input('address',array( 'type' => 'textarea','class'=>'form-control'));
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


</div>
</div>
</div>
</section>

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


<script>
$(document).ready(function(){

     $('.multipleSelect').fastselect();

    $("#CourseLocationLgaId").prop("disabled", true);

    $("#CourseLocationCountry").change(function(){
        var country_id = $(this).val();
        if (country_id=='160')
        {
             $("#CourseLocationLgaId").prop("disabled", false);
        }
        else
        {
            $("#CourseLocationLgaId").prop("disabled", true);
        }

        $.ajax({
            url: "<?php echo $this->webroot; ?>states/ajaxStates",
            type: 'post',
            dataType: 'json',
            data: {
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#CourseLocationState').html(result.html);
                } else {
                    $('#CourseLocationState').html(result.html);
                }
            }
        });
    });

    $("#CourseLocationState").change(function(){
        var state_id = $(this).val();
        var country_id = $("#CourseLocationCountry").val();
        $.ajax({
            url: "<?php echo $this->webroot; ?>cities/ajaxCities",
            type: 'post',
            dataType: 'json',
            data: {
                s_id:state_id,
                c_id:country_id
            },
            success: function(result){
                if(result.ack == '1') {
                    $('#CourseLocationCity').html(result.html);
                } else {
                    $('#CourseLocationCity').html(result.html);
                }
            }
        });
    });

});
</script>