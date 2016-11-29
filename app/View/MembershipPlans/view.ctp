<?php if(isset($page_name) && $page_name=='about-us'){?>

    <section style="background:#f36800; width:100%">
            <div class="container" >
                    <div class="row">
                            <!--<div class="col-lg-12">
                                    <h2 class="text-center" style="margin: 0; color: #fff!important; font-weight: bold; text-transform: none !important;"><?php echo(nl2br($content['Content']['page_heading']));?></h2>
                            </div>-->
                            <div class="col-lg-12">
                                    <img class="img-responsive" src="<?php echo $this->webroot;?>images/about.jpg" alt="">



                                    




                            </div>
                    </div>
            </div>

          <!--   <div class="container-fluid normal">
                    <div class="row">
<div class="col-lg-12" style="padding:0; margin:0;">

                      <video style="width:100%" autoplay autobuffer loop>
  <source src="<?php echo $this->webroot;?>images/errand_video.mp4" type="video/mp4">
  <source src="<?php echo $this->webroot;?>images/errand_video.ogv" type="video/ogv"> 
    <source src="<?php echo $this->webroot;?>images/errand_video.ogv" type="video/ogg">
  <source src="<?php echo $this->webroot;?>images/errand_video.webm" type="video/video.webm"> 
  
</video>
</div>
                    </div>
                  </div> -->

    </section>
<?php
}elseif(isset($page_name) && $page_name=='contact-us'){
?>
  <section class="how-baner-section">
            <div class="container">
                    <div class="row">
                            <!--<div class="col-lg-12">
                                    <h2 class="text-center" style="margin: 0; color: #fff!important; font-weight: bold; text-transform: none !important;"><?php echo(nl2br($content['Content']['page_heading']));?></h2>
                            </div>-->
                            <div class="col-lg-12 animated bounceInLeft">

                              <div class="intro "><div class="heading" style="margin-top:0px; padding:75px 0;"><h1 style=" font-weight: bold;text-shadow: 1px 2px 1px #000;font-size: 48px;"><?php echo(nl2br($content['Content']['page_heading']));?></h1></div>
                              
                                   
                            </div>
                    </div>
            </div>
    </section>
<?php
}
?>
<section class="populer_service" style="padding: 0px 0px !important;">
<?php
/*else if(isset($page_name) && $page_name=='about-us'){
?>
<div style="margin-bottom:21px;">
<img src="<?php echo $this->webroot;?>images/About-Us-Banner.jpg" style="width:100%;">
</div>
<?php
}
else if(isset($page_name) && $page_name=='privacy-policy'){
?>
<div style="margin-bottom:21px;">
<img src="<?php echo $this->webroot;?>images/Privacy-Policy.jpg" style="width:100%; height: 439px;">
</div>
<?php
}
else if(isset($page_name) && $page_name=='terms-conditions'){
?>
<div style="margin-bottom:21px;">
<img src="<?php echo $this->webroot;?>images/Terms-and-condition.jpg" style="width:100%; height: 335px;">
</div>
<?php
}*/
?>

        <div class="container">
            <div class="row">&nbsp;</div>
                <?php
                if(isset($page_name) && ($page_name!='about-us' && $page_name!='contact-us')){
                ?>
		<div class="row">
                    <div class="col-md-12">
		    			<h2 style="margin: 30px 0"><u style="font-weight: bold;text-shadow: 1px 1px 1px #000;font-size: 45px;"><?php echo(nl2br($content['Content']['page_heading']));?></u></h2>
			</div>
		</div>
		<?php
                }
                if(isset($page_name) && $page_name=='contact-us'){
		?>
		<div class="row" style="margin: 0 auto;">
		        <div class="col-md-12" >
				<p><?php echo(nl2br($content['Content']['content']));?></p>
			</div>
		</div>
		
		<?php
		}elseif(isset($page_name) && $page_name=='about-us'){
                    echo $content['Content']['content'];
		}else{
		?>
		<div class="row">
		        <div class="col-md-12" >
		        <div style="width:100%; margin-bottom:40px; padding:25px; margin-top:20px; border:1px solid #ccc; border-radius: 5px; overflow: hidden; background-color: #faf9f9;">
				<?php echo (nl2br($content['Content']['content']));?>
				</div>
			</div>
		</div>
		<?php
		}
		?>
            
            <?php if(isset($page_name) && $page_name=='contact-us'){?>
            <div class="row">
                <div class="col-md-12">&nbsp;</div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <form class="form-horizontal" id="SignUpFrm" method="post" action="">
                    <div class="bordr-box">
                    <input type="hidden" name="data[Contact][user_id]" value="<?php echo isset($userdetails['User']['id'])?$userdetails['User']['id']:'';?>"/>    
                    <input type="hidden" name="PostFormType" value="contact_us"/>
                    <div class="col-md-12">
                    <div class="form-group">
                      <label for="UserFirstName" class="col-sm-3 control-label">Name:</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="data[Contact][name]" maxlength="200" id="UserFirstName" required="required" placeholder="Enter your name" value="<?php echo isset($userdetails['User']['first_name'])?$userdetails['User']['first_name'].' '.$userdetails['User']['last_name']:'';?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="UserEmail" class="col-sm-3 control-label">Email:</label>
                      <div class="col-sm-9">
                          <input type="email" class="form-control" name="data[Contact][email]" maxlength="80" id="UserEmail" required="required" placeholder="Enter your email" value="<?php echo isset($userdetails['User']['email'])?$userdetails['User']['email']:'';?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="TaskType" class="col-sm-3 control-label">Query:</label>
                      <div class="col-sm-9">
                          <select name="data[Contact][type]" id="TaskType" class="form-control" required="required">
                              <option value="">Select a options</option>
                              <option value="1">Contact Request</option>
                              <option value="2">Dispute Errand</option>
                              <option value="4">Feedback</option>
                              <option value="3">Other</option>
                          </select>
                      </div>
                    </div>
                    <div class="form-group" id="UserTaskLink" style="display: none;">
                      <label for="UserLink" class="col-sm-3 control-label">Task Link:</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="data[Contact][link]" id="UserLink" placeholder="Enter the task link">
                      </div>
                    </div> 
                    
                    
                    <div class="form-group">
                      <label for="MobileNo" class="col-sm-3 control-label">Mobile No:</label>
                      <div class="col-sm-9">
                          <input type="number" required="required" class="form-control" name="data[Contact][mobile_no]" id="MobileNo" placeholder="Enter your mobile no" value="<?php echo isset($userdetails['User']['phone_no'])?$userdetails['User']['phone_no']:'';?>">
                      </div>
                    </div>    
                    <div class="form-group">
                      <label for="Subject" class="col-sm-3 control-label">Subject:</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" name="data[Contact][subject]" id="Subject" placeholder="Enter your Subject" required="required" >
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="UserMessage" class="col-sm-3 control-label">Message:</label>
                      <div class="col-sm-9">
                          <textarea name="data[Contact][message]" id="UserMessage" required="required" class="form-control" rows="5"></textarea>
                      </div>
                    </div>  
                    
                    <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                        <button type="submit" class="btn btn-info">Submit</button>
                      </div>
                    </div>                     
                    
                    
                    
                    
                       
                    </div>
                    </div>
                  </form>
                </div>
                <div class="col-md-4">
                		<!--Information

						Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum.

						    Address: 1234 Street Name, Bangladesh.
						    Email: info@yourcompany.com
						    Phone: +12 345 678 001

						Working Hours

						    Monday - Friday - 9am to 5pm
						    Saturday - 9am to 2pm
						    Sunday - Closed-->
						    <img src="<?php echo $this->webroot;?>images/girl2.png" alt="" class="img-responsive">

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



.center-div{margin:0 auto; float: none}
.bordr-box{width:100%; margin-bottom:20px; padding:25px 15px 15px 15px; border:1px solid #ccc; border-radius: 5px; overflow: hidden;}
.bordr-box label{text-align: left !important}

h2{color:#f36800 !important}

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



/*     @media only screen and (min-width: 320px) and (max-width: 769px) {

      .phone_view {display: block!important;}
      .normal {display: none;}


}*/


</style>

