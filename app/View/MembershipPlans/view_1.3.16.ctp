<?php ?>
<section class="populer_service">
        <div class="container">
		<div class="row">
		        <div class="col-md-12" >
		    			<h2><u><?php echo(nl2br($content['Content']['page_heading']));?></u></h2>
			</div>
		</div>
		<div class="row" style="width: 75%;margin: 0 auto;">
		        <div class="col-md-12" >
				<p><?php echo(nl2br($content['Content']['content']));?></p>
			</div>
		</div>
            
            <?php if(isset($page_name) && $page_name=='contact-us'){?>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <form class="form-horizontal" id="SignUpFrm" method="post" action="">
                    <input type="hidden" name="data[Contact][user_id]" value="<?php echo isset($userdetails['User']['id'])?$userdetails['User']['id']:'';?>"/>    
                    <input type="hidden" name="PostFormType" value="contact_us"/>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="UserFirstName" class="col-sm-4 control-label">Name:</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="data[Contact][name]" maxlength="200" id="UserFirstName" required="required" placeholder="Enter your name" value="<?php echo isset($userdetails['User']['first_name'])?$userdetails['User']['first_name'].' '.$userdetails['User']['last_name']:'';?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="UserEmail" class="col-sm-4 control-label">Email:</label>
                      <div class="col-sm-8">
                          <input type="email" class="form-control" name="data[Contact][email]" maxlength="80" id="UserEmail" required="required" placeholder="Enter your email" value="<?php echo isset($userdetails['User']['email'])?$userdetails['User']['email']:'';?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="TaskType" class="col-sm-4 control-label">Type:</label>
                      <div class="col-sm-8">
                          <select name="data[Contact][type]" id="TaskType" class="form-control" required="required">
                              <option value="">Select a options</option>
                              <option value="1">Contact Request</option>
                              <option value="2">Dispute Task</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group" id="UserTaskLink" style="display: none;">
                      <label for="UserLink" class="col-sm-4 control-label">Task Link:</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="data[Contact][link]" id="UserLink" placeholder="Enter the task link">
                      </div>
                    </div> 
                    <div class="form-group">
                      <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" class="btn btn-info">Submit</button>
                      </div>
                    </div>    
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                      <label for="MobileNo" class="col-sm-4 control-label">Mobile No:</label>
                      <div class="col-sm-8">
                          <input type="number" required="required" class="form-control" name="data[Contact][mobile_no]" id="MobileNo" placeholder="Enter your mobile no" value="<?php echo isset($userdetails['User']['phone_no'])?$userdetails['User']['phone_no']:'';?>">
                      </div>
                    </div>    
                    <div class="form-group">
                      <label for="Subject" class="col-sm-4 control-label">Subject:</label>
                      <div class="col-sm-8">
                          <input type="text" class="form-control" name="data[Contact][subject]" id="Subject" required="required" placeholder="Enter your Subject">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="UserMessage" class="col-sm-4 control-label">Message:</label>
                      <div class="col-sm-8">
                          <textarea name="data[Contact][message]" id="UserMessage" required="required" class="form-control" rows="5"></textarea>
                      </div>
                    </div>    
                    
                    </div>
                  </form>
                </div>
            </div>
            <?php }?>
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function(){       
        $('#TaskType').change(function(){ 
            var TaskType=$(this).val();
            if(TaskType==1){
                $('#UserTaskLink').hide();
                $('#UserLink').removeAttr('required');
            }else if(TaskType==2){
                $('#UserTaskLink').show();
                $('#UserLink').attr('required', 'required');
            }else{
                $('#UserTaskLink').hide();
                $('#UserLink').removeAttr('required');
            }
        });
    });
</script>
<style>
ul {list-style-type:circle;}
 ol.main > li {
   
    counter-increment: root;
}

ol.main > li > ol {
  
    counter-reset: subsection;
    list-style-type: none;
}




ol.main > li > ol > li {
  
    counter-increment: subsection;
}

ol.main > li > ol > li:before {
    content: counter(root) "." counter(subsection) ".   ";
}

ol.main > li > ol li > ol{

    counter-reset: subsubsection;
    list-style-type: none;
}


ol.main > li > ol > li > ol > li {

    counter-increment: subsubsection;
}

ol.main > li > ol > li > ol > li:before {
    content: counter(root) "." counter(subsection)"." counter(subsubsection) ".   ";
}


/*ul.numeric-decimals { counter-reset:section; list-style-type:none; }
ul.numeric-decimals li { list-style-type:none; }
ul.numeric-decimals li ul { counter-reset:subsection; }
ul.numeric-decimals li:before{
    counter-increment:section;
    content:counter(section) ". ";/*content:"Section " counter(section) ". ";*/
/*}
ul.numeric-decimals li ul li:before {
    counter-increment:subsection;
    content:counter(section) "." counter(subsection) " ";*/
}
</style>
