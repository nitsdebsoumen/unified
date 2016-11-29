<link href="<?php echo $this->webroot; ?>css/bootstrap-slider.css" rel="stylesheet" type="text/css">
  <script src="<?php echo $this->webroot;?>js/jquery.raty-fa.js"></script>
<section class="signin_sec">
    	<div class="container">
	    <div class="row">
            	<div class="profile_rapper">
                  <?php
		    $usertype = $this->Session->read('Auth.User.type');
		    echo($this->element('user_leftbar'));?>      
		    <div class="col-md-9" style="background: #eee none repeat scroll 0 0;">                                                    
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
                                                    if(isset($all_reviews) && count($all_reviews)>0 && !empty($all_reviews)){
                                                        foreach($all_reviews as $Review_data) {
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
                                    
                                                
                                                <div class="col-sm-2">
                                                    <div class="avgrating">
                                                        <div class="avgrateticket">
                                                            <h3><?php echo $totalAvg;?></h3>
                                                            <p>avg. rating</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="recep_table col-sm-10">
                                                     <table class="table">                                                
                                                        <tbody>
                                                          <tr>
                                                            <td>Service </td>
                                                            <td><?php echo $TotAvgReceptionFormat;?></td>
                                                            <td>
								<span id='ratestar_avg1'></span> 
    <!--<div class="progress"><span id='ratestar_avg1'></span>  
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $TotAvgReceptionFormat*10;?>%">
    </div>
  </div>-->
                                                            </td>
                                                            <td>Profession </td>
                                                            <td><?php echo $TotAvgTreatementFormat;?></td>
                                                            <td><span id='ratestar_avg2'></span>  
								<!--<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $TotAvgTreatementFormat*10;?>%">
    </div>
  </div>-->
							    </td>
                                                          </tr>
                                                          <tr>
                                                            <td>Expertise </td>
                                                            <td><?php echo $TotAvgExpertiseFormat;?></td>
                                                            <td><span id='ratestar_avg3'></span>  
    <!--<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $TotAvgExpertiseFormat*10;?>%">
    </div>
  </div>-->
                                                            </td>
                                                            <td>Comfort </td>
                                                            <td><?php echo $TotAvgComfortFormat;?></td>
                                                            <td><span id='ratestar_avg4'></span>  
								<!--<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $TotAvgComfortFormat*10;?>%">
    </div>
  </div>-->
							    </td>
                                                          </tr>
                                                          <tr>
                                                            <td>Overall Satisfaction </td>
                                                            <td><?php echo $TotAvgOverall_satFormat;?></td>
                                                            <td><span id='ratestar_avg5'></span>  
    <!--<div class="progress">
    <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $TotAvgOverall_satFormat*10;?>%">
    </div>
  </div>-->
                                                            </td>
                                                            <td colspan="3">&nbsp;</td>
                                                          </tr>
                                                        </tbody>
                                                      </table>
                                                </div>
                                            </div>
                                            <!--<div class="col-sm-2">
                                                <div class="hundredassu">
                                                    <?php
                                                    if($TotGuestsReturnPerFormat!=0){
                                                        echo '<h1 style="color: #CEB376; font-size: 26px;">'.$TotGuestsReturnPerFormat.'%</h1><p style="color: #CEB376; font-size: 12px;">of guests would return.</p>';
                                                    }else{
                                                        //echo '<h1 style="color: #CEB376; font-size: 26px;"> N/A </h1><p style="color: #CEB376; font-size: 12px;">no reviews yet.</p>';
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            </div>-->
                                        </div>                               
                                    </div>
                                </div>                        
                                <div class="clearfix"></div>                        
                                <div class="writereviewbtn">
                                    <div class="col_riviewbtn">
                                       <!-- <a href="Javascript: void(0);" class="btn WriteAReview"><i class="fa fa-cloud-upload"></i> Write a review</a> -->
                                    </div>
                                </div> 
                                <div class="reviewbx">
                                    <?php
                                        if(isset($all_reviews) && count($all_reviews)>0 && !empty($all_reviews)){
                                            foreach($all_reviews as $Review) {
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
                                <!--<form action="<?php echo($this->webroot)?>ratings/write_review/<?php echo $id?>" method="post" id="ReviewDivPosition">
                                    <input type="hidden" name="therapistID" value="<?php echo $id; ?>">
                                <div class="windsors_arms">
                                    <h3>Review to the <?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></h3>
                                    <p>Sharing your experience provides other customers valuable insight about the company.</p>
				    <input type="hidden" name="reception" value="0" id="reception">     
				    <input type="hidden" name="treatement" value="0" id="treatement">   
				    <input type="hidden" name="expertise" value="0" id="expertise">    
				    <input type="hidden" name="comfort" value="0" id="comfort">    
				    <input type="hidden" name="overall_satisfaction" value="0" id="overall"> 
                                    <table class="table">                                    
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
                                  </table>
				   
				   
				   <div class="form-group col-md-12">
					<div class="col-md-2"><label for="email">Service </label></div>
					<div class="col-md-10"><span id='ratestar1'></span>  </div>
				       

				   </div>
				   <div class="form-group col-md-12">
				      <div class="col-md-2"><label for="email">Atmosphere</label></div>
				      <div class="col-md-10"><span id='ratestar2'></span>  </div>
				       

				   </div> 
				   <div class="form-group col-md-12">
				       <div class="col-md-2"><label for="email">Expertise </label></div>
				       <div class="col-md-10"><span id='ratestar3'></span>  </div>
				       

				   </div>  

				   <div class="form-group col-md-12" id=''>
				       <div class="col-md-2"><label for="email">Comfort </label></div>
				       <div class="col-md-10"><span id='ratestar4'></span>  </div>
				       

				   </div>
				    
				    <div class="form-group col-md-12" id=''>
					<div class="col-md-2"><label for="email">Overall Satisfaction</label></div>
				       <div class="col-md-10"><span id='ratestar5'></span> </div> 
				       
				   </div>
				    
				    
                                </div>
                                    <div class="experience-form">
                                    <h3>Describe your experience</h3>
                                    
                                      <div class="form-group">
                                      	<div class="col-md-6" style="padding-left: 0px;">
	                                        <label for="RFname">First Name*</label>
	                                        <input type="text" class="form-control" name="user_name" id="RFname" value="<?php echo isset($Login_user_fname)?$Login_user_fname:'';?>" required="required">
                                        </div>
                                        <div class="col-md-6" style="padding-right: 0px;">
                                        	<label for="city">City*</label>
                                        	<input type="text" class="form-control" name="city" id="city" value="" required="required">
                                        </div>
                                      </div>
                                      
                                      <div class="form-group">
                                        <label for="comment" style="padding-top:10px;">Include a brief comment about your visit*</label>
                                        <textarea class="form-control" name="comment" id="comment" rows="3" required="required"></textarea>
                                      </div>
                                      <div class="form-group">
                                        <label for="see_cmp">I would see this company again?*</label>
                                        <input type="radio" name="see_cmp" id="see_cmp" value="1" required="required"> <label for="see_cmp">Yes </label> &nbsp; <input type="radio" name="see_cmp" id="see_cmp1" value="0" required="required"> <label for="see_cmp1">No</label>
                                      </div>
                                      <button type="submit" class="btn btn-default signin">Submit</button>
                                      <p style="padding-top: 10px;">By clicking on “submit”, you consent to this action in accordance with our <a href="<?php echo $SITE_URL; ?>">review guidelines</a>. </p>
                                </div>
                                </form>         -->            
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
    .form-group span {
	font-size: 17px;
	
    }
   .fa-fw {
	    text-align: center;
	    width: 1em;
	    color:#ffb400;
	}
    .fa-star{ color:  #ffb400;}

    
</style>
