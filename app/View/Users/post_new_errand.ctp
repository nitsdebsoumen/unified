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
                <div class="right_dash_board" style="width:100%!important;">
                    
                    <h1 style="text-transform:none;">Tell us what you need done</h1>
                     
<div class="forms">
                    <form>
                      
                                      
                      <div class="form-group">
                        <label for="">Errand Title*<i data-toggle="tooltip" data-placement="top" title="Errand Title" class="fa fa-question-circle"></i></label>
                        <input type="text" class="form-control" name="" id="title" required="required" onkeyup=")"  placeholder="Title"><i id="check_title" class="fa fa-check"></i>
                        <span id="msgTitle" class="ajaxmsg"></span>
                      </div>
                      
                      <div class="form-group">
                        <label for="">Select Category*<i data-toggle="tooltip" data-placement="top" title="Task Category" class="fa fa-question-circle"></i></label>
                        <select name="category_id" id="category_id" class="form-control" onchange="" >
                                
                        </select>
                        <i id="check_category_id" class="fa fa-check"></i>
                        <span id="msgCategory" class="ajaxmsg"></span>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputPassword1">Describe your Errand*<i data-toggle="tooltip" data-placement="top" title="Task Description" class="fa fa-question-circle"></i></label>
                        <textarea class="form-control" name="" maxlength="200"  id="description" onkeyup="" required="required" ></textarea><i id="check_description" class="fa fa-check"></i>
                        <span id="msgDescription" class="ajaxmsg"></span>
                        <p class="help-block" id="count_description">200 Charecter </p>
                        
                      </div>
                      <hr></hr>
                    </form>
                </div>
                                
             </div>
                         



            <div class="forms">
                <form>
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
                    <label for="">Errand Location <i data-toggle="tooltip" data-placement="top" title="Task Location" class="fa fa-question-circle"></i></label>
                    <input type="text" class="form-control" name="data[Task][task_location]" id="task_location" required="required" onclick="initialize()" onfocus="initialize()" onkeyup="checking('task_location')" placeholder="Enter suburb" style="width:60%"><i class="fa fa-check" id="check_task_location"></i>
                    <span id="msg_task_location" class="ajaxmsg"></span>
                  </div>
                  <hr></hr>
                  <div class="row">
                   <div class="col-md-12 form-group">
                   <label for="">Due date<i data-toggle="tooltip" data-placement="top" title="Hooray!" class="fa fa-question-circle"></i></label></div>
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
                    <input type="text" class="form-control calender" name="data[Task][due_date]" required="required" onfocus="callDate()" id="due_date" value="<?php echo date('Y-m-d');?>" readonly placeholder="Due date" onkeyup="checking('due_date')" style="width:60%"><i class="fa fa-check" id="check_due_date"></i>
                    <span id="msg_due_date" class="ajaxmsg"></span>
                    </div>
                  </div>
                  </div>
                </form>
            </div>



            <div class="forms">
                <form>
                   <div class="form-group">
                    <label for="">How many Errand Champs are required?

<i data-toggle="tooltip" data-placement="top" title="Need more than one person for your task? You can assign up to 30 people!" class="fa fa-question-circle"></i></label>
                    <input type="number" min="0" max="30" class="form-control" name="data[Task][workers]" id="workers" onkeyup="checking('workers')" placeholder="Enter number of people" style="width:30%"><i class="fa fa-check" id="check_workers"></i>
                    <span id="msg_workers" class="ajaxmsg"></span>
                  </div>
                  <hr></hr>
                             
                  <div class="row">
                   <div class="col-md-12 form-group">
                   <label for="">What's your budget?<i data-toggle="tooltip" data-placement="top" title="Hooray!" class="fa fa-question-circle"></i></label></div>
                  <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="budget_type" id="budget_type" value="1" checked="checked" onclick="setdiv()">
                            Total
                          </label>
                      </div>
                  </div>
                  <div class="col-md-4">
                      <div class="radio">
                          <label>
                            <input type="radio" name="budget_type" id="budget_type" value="2" onclick="setdiv()">
                            Hourly Rate
                          </label>
                      </div>
                  </div>
                  
                  <div class="col-md-12 form-group">
                    <div class="input-group" id="totaldiv">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" name="data[Task][total_rate]" onkeyup="checking('total_rate')" id="total_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_total_rate"></i>
                        <span id="msg_total_rate" class="ajaxmsg"></span>
                    </div>
                    <div class="input-group" id="hourlydate" style="display:none">
                        <div class="input-group-addon">$</div>
                        <input type="number" class="form-control" min="0" name="data[Task][per_hour_rate]" onkeyup="checking('per_hour_rate')" id="per_hour_rate" placeholder="Eg 25" style="width:20%"><i class="fa fa-check" id="check_per_hour_rate"></i>
                        <span id="msg_per_hour_rate" class="ajaxmsg"></span>
                        <p>per hour for</p><input type="number" class="form-control" min="0" name="data[Task][hour]" onkeyup="checking('hour')" id="hour" placeholder="5" style="width:20%"><p>hours</p><i class="fa fa-check" id="check_hour"></i>
                        <span id="msg_hour" class="ajaxmsg"></span>
                    </div>
                  </div>
                  </div>
                </form>
            </div>


            <!-- <div class="congrats">
            <i class="fa fa-thumbs-o-up"></i>
            Your Errand has now been posted. You can go back and edit the errand at any time.</div> -->
<a href="Javascript: void(0);" class="btn btn-default complete_task_btn" role="button">Post</a>




                </div>
            </div>
        </div>
        </div>
    </div>
</section>

<STYLE TYPE="text/css">
.forms {background: #fff;}
</STYLE>