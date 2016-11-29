<?php echo $this->element('user_menu'); ?>
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9">
            <div class="clearfix"></div>
            <div class="col-md-12 whit_bg">
                <form method="post" action="" class="edit_profile"> 
                <div class="right_dash_board" style="width:100%!important;">
                    
                    <h1 style="text-transform:none;">Tell us what you need done</h1>
                    
                    <div class="forms">
                       <div class="form-group">
                        <label for=""><img src="<?php echo $this->webroot;?>images/title.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;Errand Title*<i data-toggle="tooltip" data-placement="top" title="Errand Title" class="fa fa-question-circle"></i></label>
                        <input type="text" class="form-control" name="title" id="title" required="required" onkeyup="checking('title')"  placeholder="Title"><i id="check_title" class="fa fa-check"></i>
			<span id="msgTitle" class="ajaxmsg"></span>
                        
                      </div>
                      
                      <div class="form-group">
                        <label for=""><img src="<?php echo $this->webroot;?>images/cat.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;Select Category*<i data-toggle="tooltip" data-placement="top" title="Errand Category" class="fa fa-question-circle"></i></label>
                        <select name="category_id" id="category_id" class="form-control" onchange="checking('category_id')" required="required">
                                    <option value="">Select Category--</option>
                                    <?php if(isset($categories) && !empty($categories))
                                        foreach($categories as $category)
                                        { ?>
                                                <!--<optgroup label="<?php echo $category['Category']['name']?>">-->
						<option class="optionGroup" value="<?php echo $category['Category']['id']?>"><?php echo $category['Category']['name'];?></option>
                                                        <?php $subcats = $this->requestAction(array('controller' => 'tasks', 'action' => 'getsubcat/'.$category['Category']['id']));
                                                                if(!empty($subcats))
                                                                {
                                                                        foreach($subcats as $subcat)
                                                                        {
                                                                ?>
                                                                                <option class="optionChild" value="<?php echo $subcat['Category']['id']?>"><?php echo $subcat['Category']['name'];?></option>
                                                        <?php	}
                                                                }
                                                        ?>
                                                <!--</optgroup>	-->
                                    <?php	}
                                    ?>
                        </select>
                        <i id="check_category_id" class="fa fa-check"></i>
			<span id="msgCategory" class="ajaxmsg"></span>
                      </div>
                      
                      <div class="form-group">
                        <label for=""><img src="<?php echo $this->webroot;?>images/text.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;Describe your Errand*<i data-toggle="tooltip" data-placement="top" title="Errand Description" class="fa fa-question-circle"></i></label>
                        <textarea class="form-control" name="description" maxlength="200"  id="description" onkeyup="checking('description');" required="required" ></textarea><i id="check_description" class="fa fa-check"></i>
                        <span id="msgDescription" class="ajaxmsg"></span>
                        <p class="help-block" id="count_description">200 Charecter </p>
                        
                      </div>
                      <hr></hr>
                    
                </div>
                                
             </div>
            <div class="forms">
                  <div class="row">
                  <div class="col-md-6">
                      <div class="radio">
                          <label>
                            <input type="radio" name="completed" id="completed_offline" value="2" checked="true" >
                            To be completed in-person
                          </label>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="radio">
                          <label>
                            <input type="radio" name="completed" id="completed_online" value="1">
                            Can be completed online
                          </label>
                      </div>
                  </div>
                  </div>
                  <!-- <hr></hr> -->
                  <div class="form-group" style="margin-top:15px;">
                    <label for=""><img src="<?php echo $this->webroot;?>images/gps.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;Errand Location* <i data-toggle="tooltip" data-placement="top" title="Errand Location" class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control" name="task_location" id="add_task_location" required="required" onclick="initialize_location()" onfocus="initialize_location()" onkeyup="checking('task_location')" placeholder="Enter loctaion" style="width:60%"><i class="fa fa-check" id="check_task_location"></i>
                    <span id="msg_task_location" class="ajaxmsg"></span>
                  </div>
                  <hr></hr>
                  <div class="row">
                   <div class="col-md-12 form-group">
                   <label for=""><img src="<?php echo $this->webroot;?>images/calendr.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;Due date* <i data-toggle="tooltip" data-placement="top" title="Due date" class="fa fa-question-circle"></i></label></div>
                  <!-- <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="duecalender" id="calender_today" value="1" checked="checked" onclick="setDueDate()">
                            Today
                          </label>
                      </div>
                  </div> -->
                <!--   <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="duecalender" id="calender_week" value="2" onclick="setDueDate()">
                            within 1 week
                          </label>
                      </div>
                  </div> -->
                <!--   <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="duecalender" id="calender_date" value="3" onclick="setDueDate()">
                            by a certain day
                          </label>
                      </div>
                  </div> -->
                  <div class="col-md-12 form-group">
                    <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    <input type="text" class="form-control calender" name="due_date" required="required" onfocus="callDate()" id="due_date" value="<?php echo date('Y-m-d');?>" readonly placeholder="Due date" onkeyup="checking('due_date')" style="width:60%"><i class="fa fa-check" id="check_due_date"></i>
                    <span id="msg_due_date" class="ajaxmsg"></span>
                    </div>
                  </div>
                  </div>
                
            </div>



            <div class="forms">
                
                   <div class="form-group">
                    <label for=""><img src="<?php echo $this->webroot;?>images/number.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;How many Errand Champs are required?*

<i data-toggle="tooltip" data-placement="top" title="Need more than one person for your task? You can assign up to 30 people!" class="fa fa-question-circle"></i></label>
                       <input type="number" min="0" max="30" class="form-control" name="workers" id="workers" onkeyup="checking('workers')" placeholder="Enter number of people" style="width:30%" required="required"><i class="fa fa-check" id="check_workers"></i>
                    <span id="msg_workers" class="ajaxmsg"></span>
                  </div>
                  <hr></hr>
                             
                  <div class="row">
                   <div class="col-md-12 form-group">
                   <label for=""><img src="<?php echo $this->webroot;?>images/money.png" style="margin:0 auto;padding-right:5px; height:25px;" class-"img-responsive">&nbsp;&nbsp;&nbsp;What's your budget?<i data-toggle="tooltip" data-placement="top" title="Hooray!" class="fa fa-question-circle"></i></label></div>
                  <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="budget_type" id="budget_type" value="1" checked="checked" onclick="setdiv_add()">
                            Total
                          </label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="budget_type" id="budget_type" value="2" onclick="setdiv_add()">
                            Hourly Rate
                          </label>
                      </div>
                  </div>
                  
                  <div class="col-md-12 form-group">
                    <div class="input-group" id="totaldiv">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" name="total_rate" onkeyup="checking('total_rate')" id="total_rate" placeholder="Eg 25" style="width:20%" required="required"><i class="fa fa-check" id="check_total_rate"></i>
                        <span id="msg_total_rate" class="ajaxmsg"></span>
                    </div>
                    <div class="input-group" id="hourlydate" style="display:none">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" min="0" name="per_hour_rate" onkeyup="checking('per_hour_rate')" id="per_hour_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_per_hour_rate"></i>
                        <span id="msg_per_hour_rate" class="ajaxmsg"></span>
                        <p>per hour for</p><input type="number" class="form-control" min="0" name="hour" onkeyup="checking('hour')" id="hour" placeholder="5" style="width:20%"><p>hours</p><i class="fa fa-check" id="check_hour"></i>
                        <span id="msg_hour" class="ajaxmsg"></span>
                    </div>
                  </div>
                  </div>
                
            </div>

            <button type="submit">Post</button>        
            <!-- <div class="congrats">
            <i class="fa fa-thumbs-o-up"></i>
            Your Errand has now been posted. You can go back and edit the errand at any time.</div> -->
            </form>



                </div>
            </div>
        </div>
        </div>
    </div>
</section>
<div class="modal fade" id="PostAccSetMsg" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document" style="width:80%; margin-top:150px; z-index: 9999;">
        <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
               <h4 class="modal-title" id="myModalLabel">Post your Errand</h4>
             </div>
             <div class="modal-body">
                  <div class="alert alert-success" id="msgStep1" style="display:none">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                  </div>
                  <?php 
                  echo '<div class="alert alert-danger"><strong>You cannot post an errand. Please check on "Post" to your <a href="'.$this->webroot.'users/editprofile">Account Setting</a> page.</strong></div>';
                  ?>
             </div>
        </div>
    </div>
</div>
<?php
$profile_setting_change = $this->Session->read('profile_setting_change');
if(isset($profile_setting_change) && $profile_setting_change!=''){
?>
<script>
$(document).ready(function(){
    $('#PostAccSetMsg').modal('show');      
});
</script>
<?php
//$this->Session->delete('profile_setting_change');
}
?>
<style>
.optionGroup
{
    font-weight:bold;
    font-style:italic;
}

.optionChild
{
    padding-left:15px;
}
</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
    function setdiv_add(){
            var selectbudget = $('input[name=budget_type]:checked').val();
            if(selectbudget == 1)
            {
                $('#total_rate').prop('required',true);
                $('#per_hour_rate').prop('required',false);
                $('#hour').prop('required',false);
                $('#totaldiv').show();$('#hourlydate').hide();
            }else{
                $('#total_rate').prop('required',false);
                $('#per_hour_rate').prop('required',true);
                $('#hour').prop('required',true);
                $('#totaldiv').hide();$('#hourlydate').show();
            }
    }
    function initialize_location() {
           var defaultBounds = new google.maps.LatLngBounds(
           new google.maps.LatLng(7.623887, 68.994141),
           new google.maps.LatLng(37.020098, 97.470703));

           var input1 = document.getElementById('add_task_location');
           var options = {
               bounds: defaultBounds,
               types: ['geocode'],
           };
           autocomplete1 = new google.maps.places.Autocomplete(input1, options);
    }
</script>
<STYLE TYPE="text/css">
.forms {background: #fff;}
</STYLE>
