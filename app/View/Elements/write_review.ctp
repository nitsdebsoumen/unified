<link href="<?php echo $this->webroot; ?>css/bootstrap-slider.css" rel="stylesheet" type="text/css">
  <script src="<?php echo $this->webroot;?>js/jquery.raty-fa.js"></script>
<section class="signin_sec">
    	<div class="container">
	    <div class="row">
            	<div class="profile_rapper">
                  <?php
		    $id = $this->Session->read('userid');
        
         //$user = 93;
		    //echo($this->element('user_leftbar'));?>      
		    <div class="col-md-9" style="background: #fff none repeat scroll 0 0;">                                                    
                            <div class="over_right" style="background: #fff none repeat scroll 0 0; padding: 15px;">
                                <div class="col-sm-12 ">
                                    <div class="cust_review">
                                        <div class="reviewratingbx">
                                            <div class="col-sm-12 avgrating_left">
                                                <?php
                                                    $totalRTCal=0;
                                                    $ratingCnt=0;  
                                                    $TotReception=0;
                                                    $TotTreatement=0;
                                                    $TotExpertise=0;
                                                    $TotComfort=0;
                                                    $TotOverall_sat=0;
                                                    $TotGuestsReturn=0;
                                                    if(isset($GetReview_data) && count($GetReview_data)>0 && !empty($GetReview_data)){
                                                        foreach($GetReview_data as $Review_data) {
                                                           $ratingCnt++;
                                                           $give_reception=isset($Review_data['Rating']['reception'])?$Review_data['Rating']['reception']:'';
                                                           $give_treatement=isset($Review_data['Rating']['treatement'])?$Review_data['Rating']['treatement']:'';
                                                           $give_expertise=isset($Review_data['Rating']['expertise'])?$Review_data['Rating']['expertise']:'';
                                                           $give_comfort=isset($Review_data['Rating']['comfort'])?$Review_data['Rating']['comfort']:'';
                                                           $give_overall_satisfaction=isset($Review_data['Rating']['overall_satisfaction'])?$Review_data['Rating']['overall_satisfaction']:'';
                                                           $give_GuestsReturn=isset($Review_data['Rating']['see_company'])?$Review_data['Rating']['see_company']:'';
                                                          
                                                           $PerUserAvgRating=($give_reception+$give_treatement+$give_expertise+$give_comfort+$give_overall_satisfaction)/5;
                                                           $totalRTCal=$totalRTCal+$PerUserAvgRating;
                                                           $TotReception=$TotReception+$give_reception;
                                                           $TotTreatement=$TotTreatement+$give_treatement;
                                                           
                                                           $TotExpertise=$TotExpertise+$give_expertise;
                                                           $TotComfort=$TotComfort+$give_comfort;
                                                           $TotOverall_sat=$TotOverall_sat+$give_overall_satisfaction;
                                                           
                                                           if($give_GuestsReturn==1){
                                                               $TotGuestsReturn=$TotGuestsReturn+1;
                                                           }
                                                           
                                                        }
                                                    
							
							$totalActAvg=$totalRTCal/$ratingCnt;
							$totalAvg=number_format((float)$totalActAvg, 2, '.', '');

							$TotAvgReception=$TotReception/$ratingCnt;
							$TotAvgReceptionFormat=number_format((float)$TotAvgReception, 2, '.', '');

							$TotAvgTreatement=$TotTreatement/$ratingCnt;
							$TotAvgTreatementFormat=number_format((float)$TotAvgTreatement, 2, '.', '');
							$TotAvgExpertise=$TotExpertise/$ratingCnt;
							$TotAvgExpertiseFormat=number_format((float)$TotAvgExpertise, 2, '.', '');
							$TotAvgComfort=$TotComfort/$ratingCnt;
							$TotAvgComfortFormat=number_format((float)$TotAvgComfort, 2, '.', '');
							$TotAvgOverall_sat=$TotOverall_sat/$ratingCnt;
							$TotAvgOverall_satFormat=number_format((float)$TotAvgOverall_sat, 2, '.', '');

							$TotGuestsReturnPerFormat=round(100*($TotGuestsReturn/$ratingCnt));	
						    }
						    else{
							$totalActAvg = 0;
							$totalAvg =0;
							$TotAvgReception=0;
							$TotAvgReceptionFormat=0;
							
							$TotAvgTreatement=0;
							$TotAvgTreatementFormat=0;
							
							$TotAvgExpertise=0;
							$TotAvgExpertiseFormat=0;
							$TotAvgComfort=0;
							$TotAvgComfortFormat=0;
							$TotAvgOverall_sat=0;
							$TotAvgOverall_satFormat=0;
							$TotGuestsReturnPerFormat=0;
						    }
                                                  /*  $totalActAvg=$totalRTCal/$ratingCnt;
                                                    $totalAvg=number_format((float)$totalActAvg, 2, '.', '');
                                                    
                                                    $TotAvgReception=$TotReception/$ratingCnt;
                                                    $TotAvgReceptionFormat=number_format((float)$TotAvgReception, 2, '.', '');
                                                    
                                                    $TotAvgTreatement=$TotTreatement/$ratingCnt;
                                                    $TotAvgTreatementFormat=number_format((float)$TotAvgTreatement, 2, '.', '');
                                                    $TotAvgExpertise=$TotExpertise/$ratingCnt;
                                                    $TotAvgExpertiseFormat=number_format((float)$TotAvgExpertise, 2, '.', '');
                                                    $TotAvgComfort=$TotComfort/$ratingCnt;
                                                    $TotAvgComfortFormat=number_format((float)$TotAvgComfort, 2, '.', '');
                                                    $TotAvgOverall_sat=$TotOverall_sat/$ratingCnt;
                                                    $TotAvgOverall_satFormat=number_format((float)$TotAvgOverall_sat, 2, '.', '');
                                                    
                                                    $TotGuestsReturnPerFormat=round(100*($TotGuestsReturn/$ratingCnt)); */
                                                    //$TotGuestsReturnPerFormat=number_format((float)$TotGuestsReturnPer, 2, '.', '');
                                                ?>
                                    
                                                
                                                                
                                <div class="clearfix"></div>                        
                                <div class="writereviewbtn">
                                    <div class="col_riviewbtn">
                                       <!-- <a href="Javascript: void(0);" class="btn WriteAReview"><i class="fa fa-cloud-upload"></i> Write a review</a> -->
                                    </div>
                                </div> 
                                <div class="reviewbx">
                                    <?php
                                        if(isset($GetReview_data) && count($GetReview_data)>0 && !empty($GetReview_data)){
                                            foreach($GetReview_data as $Review) {
						$rating_id=$Review['Rating']['id']; 
						//$rep_data=$this->requestAction('spas/get_review_reply/'.$rating_id);
                                          //print_r($rep_data);
                                          
                                               $user_fname=isset($Review['User']['first_name'])?$Review['User']['first_name']:'';
                                               $user_lname=isset($Review['User']['last_name'])?$Review['User']['last_name']:'';
                                               $rating_reception=isset($Review['Rating']['reception'])?$Review['Rating']['reception']:'';
                                               $rating_treatement=isset($Review['Rating']['treatement'])?$Review['Rating']['treatement']:'';
                                               $rating_expertise=isset($Review['Rating']['expertise'])?$Review['Rating']['expertise']:'';
                                               $rating_comfort=isset($Review['Rating']['comfort'])?$Review['Rating']['comfort']:'';
                                               $rating_overall_satisfaction=isset($Review['Rating']['overall_satisfaction'])?$Review['Rating']['overall_satisfaction']:'';
                                               $rating_user_name=isset($Review['Rating']['user_name'])?$Review['Rating']['user_name']:'';
                                               $rating_city=isset($Review['Rating']['city'])?$Review['Rating']['city']:'';
                                               $rating_comment=isset($Review['Rating']['comment'])?$Review['Rating']['comment']:'';
                                               $rating_date=isset($Review['Rating']['ratting_date'])?date('M dS, Y', strtotime($Review['Rating']['ratting_date'])):'';
                                               
                                               //$user_name=$user_fname.' '.$user_lname;
                                               $user_name=$rating_user_name;
                                               $userAvgRating=($rating_reception+$rating_treatement+$rating_expertise+$rating_comfort+$rating_overall_satisfaction)/5;
                                                
                                    ?>
                                    <div class="col-sm-9">
                                        <div class="review_desc">
                                            <div class="reviewtitle">
                                                <div class="title_left">
                                                    <h3><?php echo $user_name;?> from <?php echo $rating_city;?></h3>
                                                    <h6>Posted on <?php echo $rating_date;?></h6>
                                                </div>
                                                <!--<div class="title_right">
                                                    <p><i class="fa fa-thumbs-up"></i> <i>recommended this spa</i></p>
                                                </div>-->
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="reviewtxt">
                                            <p>
                                                <?php //echo $rating_comment;
                                                if(isset($rating_comment) && $rating_comment!=''){
                                                    echo (strlen($rating_comment)<248 )?$rating_comment.'...':substr($rating_comment, 0, 248).'...';
                                                ?>
                                                <br>
                                                <?php if(isset($rating_comment) && $rating_comment!='' && strlen($rating_comment)>248){?><a href="Javascript: void(0);" class="ratting_cmt" divID="comment_div_<?php echo $Review['Rating']['id'];?>">read more</a><?php }?>
                                                <input type="hidden" id="comment_div_<?php echo $Review['Rating']['id'];?>" value="<?php echo $rating_comment;?>">
                                                <input type="hidden" id="comment_div_<?php echo $Review['Rating']['id'];?>_name" value="<?php echo $user_name;?>">
                                                <?php
                                                }
                                                ?></p> 
                                            </div>
                                        </div>                                
                                    </div>
									
									
                                    <div class="col-sm-3">
                                   		<div class="avgrating reviewrating">
                                            <div class="avgrateticket">
                                                <h3><?php echo $userAvgRating;?></h3>
                                                <p>out of 5</p>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </div>
				<?php
				/*foreach($rep_data as $reply)
				{
				?>
				<div class="col-sm-9">
                                        <div class="review_desc">
                                            <div class="reviewtitle">
                                                <div class="title_left">
                                                    <h3><?php echo $spa_data['Spa']['title'];?></h3>
                                                    <h6>Replied on <?php $reply_on=isset($reply['ReviewReply']['reply_on'])?date('M dS, Y', strtotime($reply['ReviewReply']['reply_on'])):'';
													echo $reply_on;?></h6>
                                                </div>
                                               
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="reviewtxt">
                                            <p>
                                                <?php 
												$replies=$reply['ReviewReply']['replies'];
                                                if(isset($replies) && $replies!=''){
                                                    echo (strlen($replies)<248 )?$replies:substr($replies, 0, 248).'...';
                                                ?>
                                                <br>
                                                <?php if(isset($replies) && $replies!='' && strlen($replies)>248){?><a href="Javascript: void(0);" class="ratting_cmt" divID="comment_div_<?php echo $reply['ReviewReply']['id'];?>">read more</a><?php }?>
                                                <input type="hidden" id="comment_div_<?php echo $reply['ReviewReply']['id'];?>" value="<?php echo $replies;?>">
                                                <input type="hidden" id="comment_div_<?php echo $reply['ReviewReply']['id'];?>_name" value="<?php echo $spadetails['Spa']['title']; ?>">
                                                <?php
                                                }
                                                ?></p> 
                                            </div>
                                        </div>                                
                                    </div>
									<?php
									}*/
									?>
                                    <div class="col-sm-12 separator">&nbsp;</div>
                                    
                                    <div class="clearfix"></div>
									
									
                                    <?php
                                            }
                                        }
                                    ?>
                                </div> 
                                <form action="<?php echo($this->webroot)?>ratings/write_review/<?php echo $id?>" method="post" id="ReviewDivPosition">
                                    <input type="hidden" name="therapistID" value="<?php echo $id; ?>">
                                <div class="windsors_arms">
                              <h3>Give Your Review Here <?php //echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></h3>
                                   <!--  <p>Sharing your experience provides other customers valuable insight about the company.</p> -->
				    <input type="hidden" name="reception"   value="0" id="reception">     
				    <input type="hidden" name="treatement"  value="0" id="treatement">   
				    <input type="hidden" name="expertise"   value="0" id="expertise">    
				    <input type="hidden" name="comfort"     value="0" id="comfort">    
				    <input type="hidden" name="overall_satisfaction" value="0" id="overall"> 
                                    <!--<table class="table">                                    
                                    <tbody>
                                      <tr>
                                        <td>
                                          <h4>Service*</h4>
                                            
                                        </td>
                                        <td style="position:relative;width: 50%;">
                                          
                                                
                                                  <label for="reception">Points:</label>
                                                  <input id="reception" data-slider-id='receptionSlider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="10" name="reception" class="slider_range"/>
						
                                        </td>
                                        
                                      </tr>
                                      <tr>
                                        <td>
                                          <h4>Atmosphere*</h4>
                                         
                                        </td>
                                        <td style="position:relative;width: 50%;">
                                            
                                            <label for="treatment">Points:</label>
                                            <input id="treatment" name="treatement" data-slider-id='treatmentSlider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="10" class="slider_range" />
                                            
                                        </td>
                                       
                                      </tr>
                                      <tr>
                                        <td>
                                          <h4>Expertise*</h4>
                                        
                                        </td>
                                        <td style="position:relative;width: 50%;">
                                            
                                            <label for="expertise">Points:</label>
                                            <input id="expertise" name="expertise" data-slider-id='expertiseSlider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="10" class="slider_range"/>
                                            
                                        </td>
                                       
                                      </tr>
                                      <tr>
                                        <td>
                                          <h4>Comfort*</h4>
                                          
                                        </td>
                                        <td style="position:relative;width: 50%;">
                                            
                                            <label for="comfort">Points:</label>
                                            <input id="comfort" name="comfort" data-slider-id='comfortSlider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="10" class="slider_range"/>
                                            
                                        </td>
                                       
                                      </tr>
                                      <tr>
                                        <td>
                                          <h4>Overall Satisfaction*</h4>
                                      
                                        </td>
                                        <td style="position:relative;width: 50%;">
                                            
                                            <label for="overall_satisfaction">Points:</label>
                                            <input id="overall_satisfaction" name="overall_satisfaction" data-slider-id='overall_satisfactionSlider' type="text" data-slider-min="0" data-slider-max="10" data-slider-step="1" data-slider-value="10" class="slider_range" />
                                            
                                        </td>
                                       
                                      </tr>
                                    </tbody>
                                  </table>-->
				    <!--<div class="form-group">
					<label for="email">Service </label>
					<span id='ratestar1' style="padding: 13.5%;"></span>  
				       

				   </div>
				   <div class="form-group">
				       <label for="email">Atmosphere</label>
					 <span id='ratestar2' style="padding: 10%;"></span>  
				       

				   </div> 
				   <div class="form-group">
				       <label for="email">Expertise </label>
				       <span id='ratestar3' style="padding: 12.5%;"></span>  
				       

				   </div>  

				   <div class="form-group" id=''>
				       <label for="email">Comfort </label>
				       <span id='ratestar4' style="padding: 13.5%;"></span>  
				       

				   </div>
				    
				    <div class="form-group" id=''>
					<label for="email">Overall Satisfaction</label>
				       <span id='ratestar5' style="padding: 4.5%;"></span>  
				       
				   </div>
				   
				   <div class="form-group col-md-12">
					<div class="col-md-2"><label for="email">Service </label></div>
					<div class="col-md-10"><span id='ratestar1'></span>  </div>
				       

				   </div>-->
				<!--    <div class="form-group col-md-12">
				      <div class="col-md-2"><label for="email">Profession</label></div>
				      <div class="col-md-10"><span id='ratestar2'></span>  </div>
				       

				   </div>  -->
				    <!--<div class="form-group col-md-12">
				       <div class="col-md-2"><label for="email">Expertise </label></div>
				       <div class="col-md-10"><span id='ratestar3'></span>  </div>
				       

				   </div> --> 

				   <div class="form-group col-md-12" id=''>
				       <div class="col-md-2"><label for="email">Your Rating. </label></div>
				       <div class="col-md-10"><span id='ratestar4'></span>  </div>
				       

				   </div>
				    
				   <!--<div class="form-group col-md-12" id=''>
					<div class="col-md-2"><label for="email">Overall Satisfaction</label></div>
				       <div class="col-md-10"><span id='ratestar5'></span> </div> 
				       
				   </div>
				    
				    
                                </div>
                                    <div class="experience-form">
                                    <h3>Describe your experience</h3>
                                     <div class="form-group">
                                        <label for="DateVisit">Date of visit</label>
                                        <input type="text" class="form-control" name="DateVisit" id="DateVisit" value="" placeholder="" required="required">
                                      </div>-->
                                      <div class="form-group">
                                      	<div class="col-md-12" style="padding-left: 0px;">
	                                        <label for="RFname">First Name*</label>
	                                        <input type="text" class="form-control" name="user_name" id="RFname" value="<?php echo isset($Login_user_fname)?$Login_user_fname:'';?>" required="required">
                                          <input type="hidden"  name="post_id" value="<?php echo $postId; ?>">
                                        </div>
                                        <!-- <div class="col-md-6" style="padding-right: 0px;">
                                        	<label for="city">City*</label>
                                        	<input type="text" class="form-control" name="city" id="city" value="" required="required">
                                        </div> 
                                      </div>-->
                                      <!--<div class="form-group">
                                        
                                      </div>-->
                                      <div class="form-group">
                                        <label for="comment" style="padding-top:10px;">Include a brief comment about your visit*</label>
                                        <textarea class="form-control" name="comment" id="comment" rows="3" required="required"></textarea>
                                      </div>
                                   <!--    <div class="form-group">
                                        <label for="see_cmp">I would see this company again?*</label>
                                        <input type="radio" name="see_cmp" id="see_cmp" value="1" required="required"> <label for="see_cmp">Yes </label> &nbsp; <input type="radio" name="see_cmp" id="see_cmp1" value="0" required="required"> <label for="see_cmp1">No</label>
                                      </div> -->
                                      <button type="submit" class="btn btn-default signin">Submit</button>
                                      <p style="padding-top: 10px;">By clicking on “submit”, you consent to this action in accordance with our review guidelines . </p>
                                </div>
                                </form>                     
                            </div>                           
                    </div>
		</div>
	    </div>
	</div>
</section>

<script src="<?php echo $this->webroot; ?>js/bootstrap-slider.js"></script>

<script>
    $(document).ready(function(){
	$('.slider_range').slider({
	    formatter: function(value) {
		var Text='';
		if(value <=3){
		    Text='Poor: ';
		}else if(value <=7 && value >= 4){
		    Text='Average: ';
		}else if(value <=10 && value >= 8){
		    Text='Excellent: ';
		}else{
		    Text='Current value: ';
		}
		return Text + value;
	    }
	});
	
	
	
	$("#ratestar1").raty({
              score:'0',    
              click: function(score, evt) {
              	 $("#reception").attr("value",score);    
               }        
         });   

        $("#ratestar2").raty({
           score:'0',    
          click: function(score, evt) {
          	$("#treatement").attr("value",score);    
          }        
       });

        $("#ratestar3").raty({
        	score:'0',    
                click: function(score, evt) {
                    $("#expertise").attr("value",score);    
                }        
       });

        $("#ratestar4").raty({
           score:'0',    
           click: function(score, evt) {
                $("#comfort").attr("value",score);    
           }        
         });
	 
	$("#ratestar5").raty({
           score:'0',    
           click: function(score, evt) {
                $("#overall").attr("value",score);    
           }        
         });
	 
	 $("#ratestar_avg1") .raty({score: <?php echo $TotAvgReceptionFormat;?> ,readOnly:true,  starOn  : 'fa fa-star'});
	 $("#ratestar_avg2") .raty({score: <?php echo $TotAvgTreatementFormat;?> ,readOnly:true,  starOn  : 'fa fa-star'});
	 $("#ratestar_avg3") .raty({score: <?php echo $TotAvgExpertiseFormat;?> ,readOnly:true,  starOn  : 'fa fa-star'});
	 $("#ratestar_avg4") .raty({score: <?php echo $TotAvgComfortFormat;?> ,readOnly:true,  starOn  : 'fa fa-star'});
	 $("#ratestar_avg5") .raty({score: <?php echo $TotAvgOverall_satFormat;?> ,readOnly:true,  starOn  : 'fa fa-star'});
        /*$("#ratestar5").raty({ score:sum });*/
     });
</script>
<style>

  

element.style {
    background: #fff none repeat scroll 0 0;
}

    .form-group span {
	font-size: 17px;
	}
   .fa-fw {
	    text-align: center;
	    width: 1em;
	    color:#ffb400;
	}
    .fa-star{ color:  #ffb400;}

    #treatmentSlider .slider-selection {
    background: #e50516;
}
#receptionSlider .slider-selection {
    background: #e50516;
}
#expertiseSlider .slider-selection {
    background: #e50516;
}
#comfortSlider .slider-selection {
    background: #e50516;
}
#overall_satisfactionSlider .slider-selection {
    background: #e50516;
}
.listheadleft .fade_star {
    color: #ABABAB !important;
}

.avgrating_left {
    background: #fff none repeat scroll 0 0;
    padding: 10px;
}

.avgrating {
    background: #e5ce8c none repeat scroll 0 0;
   /* margin: 14px 0 0 9px;*/
    width: 100px;
}

.avgrateticket {
    text-align: center;
}
.avgrateticket {
    padding: 8px;
}

    @-webkit-keyframes progress-bar-stripes {
  from {
    background-position: 40px 0;
  }
  to {
    background-position: 0 0;
  }
}
@-o-keyframes progress-bar-stripes {
  from {
    background-position: 40px 0;
  }
  to {
    background-position: 0 0;
  }
}
@keyframes progress-bar-stripes {
  from {
    background-position: 40px 0;
  }
  to {
    background-position: 0 0;
  }
}
.progress {
  height: 20px;
  width: 110px;
  margin-bottom: 20px;
  overflow: hidden;
  background-color: #9b6856;
  border-radius: 4px;
  -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
          box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
}
.progress-bar {
  float: left;
  width: 100%;
  height: 100%;
  font-size: 12px;
  line-height: 20px;
  color: #fff;
  text-align: center;
  background-color: #9b6856;
  -webkit-box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
          box-shadow: inset 0 -1px 0 rgba(0, 0, 0, .15);
  -webkit-transition: width .6s ease;
       -o-transition: width .6s ease;
          transition: width .6s ease;
}
.progress-striped .progress-bar,
.progress-bar-striped {
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  -webkit-background-size: 40px 40px;
          background-size: 40px 40px;
}
.progress.active .progress-bar,
.progress-bar.active {
  -webkit-animation: progress-bar-stripes 2s linear infinite;
       -o-animation: progress-bar-stripes 2s linear infinite;
          animation: progress-bar-stripes 2s linear infinite;
}
.progress-bar-success {
  background-color: #9b6856;
}
.progress-striped .progress-bar-success {
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
}
.progress-bar-info {
  background-color: #5bc0de;
}
.progress-striped .progress-bar-info {
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
}
.progress-bar-warning {
  background-color: #f0ad4e;
}
.progress-striped .progress-bar-warning {
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
}
.progress-bar-danger {
  background-color: #d9534f;
}
.progress-striped .progress-bar-danger {
  background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:      -o-linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
  background-image:         linear-gradient(45deg, rgba(255, 255, 255, .15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, .15) 50%, rgba(255, 255, 255, .15) 75%, transparent 75%, transparent);
}
.tooltip {
  position: absolute;
  z-index: 1070;
  display: block;
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 12px;
  font-weight: normal;
  line-height: 1.4;
  filter: alpha(opacity=0);
  opacity: 0;
}
.tooltip.in {
  filter: alpha(opacity=90);
  opacity: .9;
}
.tooltip.top {
  padding: 5px 0;
  margin-top: -3px;
}
.tooltip.right {
  padding: 0 5px;
  margin-left: 3px;
}
.tooltip.bottom {
  padding: 5px 0;
  margin-top: 3px;
}
.tooltip.left {
  padding: 0 5px;
  margin-left: -3px;
}
.tooltip-inner {
  max-width: 200px;
  padding: 3px 8px;
  color: #fff;
  text-align: center;
  text-decoration: none;
  background-color: #000;
  border-radius: 4px;
}
.tooltip-arrow {
  position: absolute;
  width: 0;
  height: 0;
  border-color: transparent;
  border-style: solid;
}
.tooltip.top .tooltip-arrow {
  bottom: 0;
  left: 50%;
  margin-left: -5px;
  border-width: 5px 5px 0;
  border-top-color: #000;
}
.tooltip.top-left .tooltip-arrow {
  right: 5px;
  bottom: 0;
  margin-bottom: -5px;
  border-width: 5px 5px 0;
  border-top-color: #000;
}
.tooltip.top-right .tooltip-arrow {
  bottom: 0;
  left: 5px;
  margin-bottom: -5px;
  border-width: 5px 5px 0;
  border-top-color: #000;
}
.tooltip.right .tooltip-arrow {
  top: 50%;
  left: 0;
  margin-top: -5px;
  border-width: 5px 5px 5px 0;
  border-right-color: #000;
}
.tooltip.left .tooltip-arrow {
  top: 50%;
  right: 0;
  margin-top: -5px;
  border-width: 5px 0 5px 5px;
  border-left-color: #000;
}
.tooltip.bottom .tooltip-arrow {
  top: 0;
  left: 50%;
  margin-left: -5px;
  border-width: 0 5px 5px;
  border-bottom-color: #000;
}
.tooltip.bottom-left .tooltip-arrow {
  top: 0;
  right: 5px;
  margin-top: -5px;
  border-width: 0 5px 5px;
  border-bottom-color: #000;
}
.tooltip.bottom-right .tooltip-arrow {
  top: 0;
  left: 5px;
  margin-top: -5px;
  border-width: 0 5px 5px;
  border-bottom-color: #000;
}
</style>
