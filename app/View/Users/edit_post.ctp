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
                        <label for="">Errand Title*<i data-toggle="tooltip" data-placement="top" title="Errand Title" class="fa fa-question-circle"></i></label>
                        <input type="text" class="form-control" name="title" id="title" required="required" onkeyup="checking('title')"  placeholder="Title" value="<?php echo isset($task_details['Task']['title'])?$task_details['Task']['title']:'';?>"><i id="check_title" class="fa fa-check"></i>
			<span id="msgTitle" class="ajaxmsg"></span>
                        
                      </div>
                      
                      <div class="form-group">
                        <label for="">Select Category*<i data-toggle="tooltip" data-placement="top" title="Errand Category" class="fa fa-question-circle"></i></label>
                        <select name="category_id" id="category_id" class="form-control" onchange="checking('category_id')" required="required">
                                    <option value="">Select Category--</option>
                                    <?php if(isset($categories) && !empty($categories))
                                        foreach($categories as $category)
                                        { ?>
                                                <optgroup label="<?php echo $category['Category']['name']?>">
                                                        <?php $subcats = $this->requestAction(array('controller' => 'tasks', 'action' => 'getsubcat/'.$category['Category']['id']));
                                                                if(!empty($subcats))
                                                                {
                                                                        foreach($subcats as $subcat)
                                                                        {
                                                                ?>
                                                    <option value="<?php echo $subcat['Category']['id'];?>" <?php if($subcat['Category']['id']==$task_details['Task']['category_id']){ echo 'selected="selected"';}?>><?php echo $subcat['Category']['name'];?></value>
                                                        <?php	}
                                                                }
                                                        ?>
                                                </optgroup>	
                                    <?php	}
                                    ?>
                        </select>
                        <i id="check_category_id" class="fa fa-check"></i>
			<span id="msgCategory" class="ajaxmsg"></span>
                      </div>
                      
                      <div class="form-group">
                        <label for="">Describe your Errand*<i data-toggle="tooltip" data-placement="top" title="Errand Description" class="fa fa-question-circle"></i></label>
                        <textarea class="form-control" name="description" maxlength="200"  id="description" onkeyup="checking('description');" required="required" ><?php echo isset($task_details['Task']['description'])?$task_details['Task']['description']:'';?></textarea><i id="check_description" class="fa fa-check"></i>
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
                            <input type="radio" name="completed" id="completed_offline" value="2" <?php if(isset($task_details['Task']['completed']) && $task_details['Task']['completed']==2){ echo 'checked="checked"';}?> >
                            To be completed in-person
                          </label>
                      </div>
                  </div>
                  <div class="col-md-6">
                      <div class="radio">
                          <label>
                            <input type="radio" name="completed" id="completed_online" value="1" <?php if(isset($task_details['Task']['completed']) && $task_details['Task']['completed']==1){ echo 'checked="checked"';}?>>
                            Can be completed online
                          </label>
                      </div>
                  </div>
                  </div>
                  <!-- <hr></hr> -->
                  <div class="form-group" style="margin-top:15px;">
                    <label for="">Errand Location* <i data-toggle="tooltip" data-placement="top" title="Errand Location" class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control" name="task_location" id="add_task_location" value="<?php echo isset($task_details['Task']['task_location'])?$task_details['Task']['task_location']:'';?>" required="required" onclick="initialize_location()" onfocus="initialize_location()" onkeyup="checking('task_location')" placeholder="Enter loctaion" style="width:60%"><i class="fa fa-check" id="check_task_location"></i>
                    <span id="msg_task_location" class="ajaxmsg"></span>
                  </div>
                  <hr></hr>
                  <div class="row">
                   <div class="col-md-12 form-group">
                   <label for="">Due date* <i data-toggle="tooltip" data-placement="top" title="Due date" class="fa fa-question-circle"></i></label></div>
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
                    <input type="text" class="form-control calender" name="due_date" required="required" onfocus="callDate()" id="due_date" value="<?php echo isset($task_details['Task']['due_date'])?$task_details['Task']['due_date']:'';?>" readonly placeholder="Due date" onkeyup="checking('due_date')" style="width:60%"><i class="fa fa-check" id="check_due_date"></i>
                    <span id="msg_due_date" class="ajaxmsg"></span>
                    </div>
                  </div>
                  </div>
                
            </div>



            <div class="forms">
                
                   <div class="form-group">
                    <label for="">How many Errand Champs are required?

<i data-toggle="tooltip" data-placement="top" title="Need more than one person for your task? You can assign up to 30 people!" class="fa fa-question-circle"></i></label>
                       <input type="number" min="0" max="30" class="form-control" name="workers" id="workers" value="<?php echo isset($task_details['Task']['workers'])?$task_details['Task']['workers']:'';?>" onkeyup="checking('workers')" placeholder="Enter number of people" style="width:30%"><i class="fa fa-check" id="check_workers"></i>
                    <span id="msg_workers" class="ajaxmsg"></span>
                  </div>
                  <hr></hr>
                             
                  <div class="row">
                   <div class="col-md-12 form-group">
                   <label for="">What's your budget?<i data-toggle="tooltip" data-placement="top" title="Hooray!" class="fa fa-question-circle"></i></label></div>
                  <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="budget_type" id="budget_type" value="1" <?php if(isset($task_details['Task']['budget_type']) && $task_details['Task']['budget_type']==1){ echo 'checked="checked"';}?> onclick="setdiv_add()">
                            Total
                          </label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="budget_type" id="budget_type" value="2" onclick="setdiv_add()" <?php if(isset($task_details['Task']['budget_type']) && $task_details['Task']['budget_type']==2){ echo 'checked="checked"';}?>>
                            Hourly Rate
                          </label>
                      </div>
                  </div>
                  
                  <div class="col-md-12 form-group">
                    <div class="input-group" id="totaldiv" <?php if(isset($task_details['Task']['budget_type']) && $task_details['Task']['budget_type']==2){ echo 'style="display:none"';}?>>
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" name="total_rate" value="<?php echo isset($task_details['Task']['total_rate'])?$task_details['Task']['total_rate']:'';?>" onkeyup="checking('total_rate')" id="total_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_total_rate"></i>
                        <span id="msg_total_rate" class="ajaxmsg"></span>
                    </div>
                    <div class="input-group" id="hourlydate" <?php if(isset($task_details['Task']['budget_type']) && $task_details['Task']['budget_type']==1){ echo 'style="display:none"';}?>>
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" min="0" name="per_hour_rate" value="<?php echo isset($task_details['Task']['per_hour_rate'])?$task_details['Task']['per_hour_rate']:'';?>" onkeyup="checking('per_hour_rate')" id="per_hour_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_per_hour_rate"></i>
                        <span id="msg_per_hour_rate" class="ajaxmsg"></span>
                        <p>per hour for</p><input type="number" class="form-control" min="0" name="hour" value="<?php echo isset($task_details['Task']['hour'])?$task_details['Task']['hour']:'';?>" onkeyup="checking('hour')" id="hour" placeholder="5" style="width:20%"><p>hours</p><i class="fa fa-check" id="check_hour"></i>
                        <span id="msg_hour" class="ajaxmsg"></span>
                    </div>
                  </div>
                  </div>
                
            </div>

            <button type="submit">Save Errand</button>        
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
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script type="text/javascript">
    function setdiv_add(){
            var selectbudget = $('input[name=budget_type]:checked').val();
            if(selectbudget == 1)
            {
                    $('#totaldiv').show();$('#hourlydate').hide();
            }else{
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