<style>
.btn-primary {
            margin: 16px;
        }
</style>
 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<section class="login_body">

  <div class="container">
      <div class="row">
            <?php echo($this->element('leftpanel'))?>
          <div class="col-md-10 mid-div">
              <div class="cart-section">
                 <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal" id=" add_accreditation" name=" addAccreditation" type="submit"> Add accreditation </button>
                  <h1>Accreditations</h1>


<?php  //pr($user_reviews); 

                    if(!empty($accreditations))
                    {    ?>
                           
                      <table class="table table-bordered"> 
                        <thead > 
                        <tr> 
                        <th>Title</th> 
                     
                        <th>Action</th>
                        
                        </tr> 
                        </thead> 
                        <tbody id="table_data_user"> 
                        <tr> 
                          <?php foreach($accreditations as $value)
                                  {     ?>
                                        <td class="one"><?php echo $value['Accreditation']['title'];?>
                                        </td>
                                       
                                        <td class="one"> <button type="button" class="btn btn-default edit_accreditations" data-id="<?php echo $value['Accreditation']['id']; ?>" data-toggle="modal" data-target="">Edit</button>
                                          <a href="<?php echo $this->webroot;?>accreditations/delete_accreditations/<?php echo base64_encode($value['Accreditation']['id']); ?>" >
                                            <button type="button" class="btn btn-danger ">Delete</button></a>
                                        </td>

                                        </tr> 

                            <?php } ?>
                        </tbody> 
                        </table>
              <?php }
                    else
                    {
                      echo "There is no Accreditations"; 
                    }    
                    ?>
        

        </div>
            </div>
        </div>
      
    </div>

<div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>
 -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add Accreditation</h4>
        </div>
        <div class="modal-body">
         
          <div class="right_bar">
                    <form class="form-horizontal" id="accreditation_form" enctype="multipart/form-data" >
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Select Accreditation:</label>
                            <div class="col-sm-8"> 
                              <select id="base_accreditation_id" class="form-control border" name="data[Accreditation][accreditation_id]"> 
                                <option value=""> - Select -</option> 
                                <option value="4">Beacon Status</option>
                                <option value="18">Chartered Management Institute</option>
                                <option value="13">City &amp; Guilds</option>
                                <option value="16">CPD Standards</option>
                                <option value="6">CQC Accreditation</option>
                                <option value="5">Customer Service Excellence</option>
                                <option value="19">Edexcel</option>
                                <option value="22">Education Funding Agency</option>
                                <option value="24">Federation of Small Businesses (FSB)</option>
                                <option value="17">Highfields Awarding Body for Compliance</option>
                                <option value="1">Investors in People (IIP)</option>
                                <option value="2">ISO 9001</option>
                                <option value="25">ISO/IEC 27001:2013</option>
                                <option value="3">Matrix Standard</option>
                                <option value="20">OCR</option>
                                <option value="7">Ofsted</option>
                                <option value="8">Pharmaceutical Council (GPhC) Accreditation</option>
                                <option value="11">PQASSO Quality Mark</option>
                                <option value="14">Royal College of Nursing</option>
                                <option value="12">Skills for Health Quality Mark</option>
                                <option value="23">Skills Funding Agency (SFA)</option>
                                <option value="15">Social Enterprise Mark</option>
                                <option value="21">The Chartered Institute of Environmental Health (CIEH)</option>
                                <option value="10">The Training Quality Standard (TQS)</option>
                                <option value="9">Work Experience Quality Standard</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Title:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border"  name="data[Accreditation][title]" value=" " placeholder="" >
                            </div>
                         
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Description:</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control border"  name="data[Accreditation][description]" placeholder="" ></textarea>
                            </div>
                            
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Image:</label>
                            <div class="col-sm-8">
                                <input type="file" name="data[Accreditation][image]" class="form-control border" id="UserUserLogo">
                            </div>
                          
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Applied to:</label>
                            <div class="col-sm-8">
                                 <input type="checkbox" name="data[Accreditation][as_a_provider]" value="1" checked="">Us as a provider<br>
                                 <input type="checkbox" name="data[Accreditation][training_courses]" value="1" checked=""> Specific training courses<br>
                            </div>
                            
                        </div>
                         <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default" id="save_details">Save Details</button>
                    </div>
                    </form>
                   
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <div class="modal fade" id="editModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Edit Accreditation</h4>
        </div>
        <div class="modal-body">
         
          <div class="right_bar">
                    <form class="form-horizontal" id="edit_accreditation_form" enctype="multipart/form-data" >
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Select Accreditation:</label>
                            <div class="col-sm-8"> 
                              <select id="edit_accreditation_id" class="form-control border" name="data[Accreditation][accreditation_id]"> 
                                <option value=""> - Select -</option> 
                                <option value="4">Beacon Status</option>
                                <option value="18">Chartered Management Institute</option>
                                <option value="13">City &amp; Guilds</option>
                                <option value="16">CPD Standards</option>
                                <option value="6">CQC Accreditation</option>
                                <option value="5">Customer Service Excellence</option>
                                <option value="19">Edexcel</option>
                                <option value="22">Education Funding Agency</option>
                                <option value="24">Federation of Small Businesses (FSB)</option>
                                <option value="17">Highfields Awarding Body for Compliance</option>
                                <option value="1">Investors in People (IIP)</option>
                                <option value="2">ISO 9001</option>
                                <option value="25">ISO/IEC 27001:2013</option>
                                <option value="3">Matrix Standard</option>
                                <option value="20">OCR</option>
                                <option value="7">Ofsted</option>
                                <option value="8">Pharmaceutical Council (GPhC) Accreditation</option>
                                <option value="11">PQASSO Quality Mark</option>
                                <option value="14">Royal College of Nursing</option>
                                <option value="12">Skills for Health Quality Mark</option>
                                <option value="23">Skills Funding Agency (SFA)</option>
                                <option value="15">Social Enterprise Mark</option>
                                <option value="21">The Chartered Institute of Environmental Health (CIEH)</option>
                                <option value="10">The Training Quality Standard (TQS)</option>
                                <option value="9">Work Experience Quality Standard</option>
                              </select>
                            </div>
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Title:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border"  name="data[Accreditation][title]" value=" " placeholder="" id="edit_accreditation_title">
                            </div>
                         
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Description:</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control border" name="data[Accreditation][description]" placeholder="" id="edit_accreditation_description"></textarea>
                            </div>
                            
                        </div>
                         <div class="form-group profile-field" id="image_div" style="display:none;">
                            <label for="" class="col-sm-3 right-text">Image:</label>
                            <div class="col-sm-8">
                                <img src="" style="height: 259px;
                                    width: 209px;" id="edit_accreditation_edit_accreditation_old_image">
                            </div>
                          <input type="hidden" id="image" name="data[Accreditation][old_image]">
                          <input type="hidden" id="acc_id" name="data[Accreditation][id]">
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">New Image:</label>
                            <div class="col-sm-8">
                                <input type="file" name="data[Accreditation][image]" class="form-control border" id="edit_accreditation_new_image">
                            </div>
                          
                        </div>
                        <div class="form-group profile-field">
                            <label for="" class="col-sm-3 right-text">Applied to:</label>
                            <div class="col-sm-8">
                                 <input type="checkbox" name="data[Accreditation][as_a_provider]" value="1"  id="edit_accreditation_edit_accreditation_as_a_provider">Us as a provider<br>
                                 <input type="checkbox" name="data[Accreditation][training_courses]" value="1" id="edit_accreditation_edit_accreditation_training_courses"> Specific training courses<br>
                            </div>
                            <input type="hidden" id="user_id" name="data[Accreditation][user_id]">
                            
                        </div>
                         <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default" id="save_edit_details">Save Details</button>
                    </div>
                    </form>
                   
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  
</div>
</section>
<script>
  $('#accreditation_form').submit( function(e) {
    e.preventDefault();
    tinyMCE.triggerSave();
    var data = new FormData(this); // <-- 'this' is your form element

    $.ajax({
            url: "<?php echo $this->webroot;?>accreditations/ajaxAddAccreditation",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            type: 'POST',     
            success: function(result){
            if(result.ack == 1){
              $("#myModal").modal('hide');
              alert('Your Accreditation Has Been Saved');
              setTimeout(function(){ window.location.href = "<?php echo $this->webroot;?>accreditations/index"; }, 1000);
            }
          }
    });
  });

  $('.edit_accreditations').click(function(){
    
    var aid = $(this).data('id'); 

    $.ajax({
            url: "<?php echo $this->webroot;?>accreditations/ajaxAccreditationDetails",
            data:{a_id:aid},
            dataType:'json',
            type: 'POST',     
            success: function(result){
            if(result.ack == 1){
            $("#edit_accreditation_id").val(result.accreditation);
            $("#edit_accreditation_title").val(result.title);
            tinyMCE.get('edit_accreditation_description').setContent(result.description);
            $("#image").val(result.image);
            $("#acc_id").val(result.id);
            $("#user_id").val(result.user_id);
              if(result.as_a_provider == true){
                $("#edit_accreditation_edit_accreditation_as_a_provider").prop('checked', true);
              }
              else{
                $("#edit_accreditation_edit_accreditation_as_a_provider").prop('checked', false);
              }
              if(result.training_courses == true){
                $("#edit_accreditation_edit_accreditation_training_courses").prop('checked', true);
              }
              else{
                $("#edit_accreditation_edit_accreditation_training_courses").prop('checked', false);
              }

              if(result.image!=''){
                var src = "<?php echo $this->webroot;?>accreditation/"+result.image;
                $("#edit_accreditation_edit_accreditation_old_image").attr("src",src);
                $("#image_div").show();
              }
            $("#edit_accreditation_new_image").val('');
            $("#editModal").modal('show');  
                          
            }
          }
    });
  });
  
  $('#edit_accreditation_form').submit( function(e) {
    e.preventDefault();
    tinyMCE.triggerSave();
    var data = new FormData(this); // <-- 'this' is your form element

    $.ajax({
            url: "<?php echo $this->webroot;?>accreditations/ajaxEditAccreditation",
            data: data,
            cache: false,
            contentType: false,
            processData: false,
            dataType:'json',
            type: 'POST',     
            success: function(result){
            if(result.ack == 1){
              $("#editModal").modal('hide');

              alert('Your Accreditation Has Been Saved');
              setTimeout(function(){ window.location.href = "<?php echo $this->webroot;?>accreditations/index"; }, 1000);             
            }
          }
    });
  });

</script>