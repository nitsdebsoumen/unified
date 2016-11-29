<?php ?>
<script src="<?php echo $this->webroot?>js/enscroll-0.6.0.min.js"></script>


<script>
function initialize_map_details(){
var locations = [
<?php

$lat=$task['Task']['lat']; 
$lang=$task['Task']['lang']; 
$title=$task['Task']['task_location'];   
?>
['<?php echo $title;?>', '<?php echo $lat;?>', '<?php echo $lang;?>', 4]
];

var map = new google.maps.Map(document.getElementById('TaskDetailsMap'), {
zoom: 10,
center: new google.maps.LatLng('<?php echo $lat?>', '<?php echo $lang;?>'),
mapTypeId: google.maps.MapTypeId.ROADMAP
});

    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
 }

 window.onload = function() {
    initialize_map_details();
    //initialize2();
};
</script>
<section class="main_body">
 		<div class="container">
 			<div class="row">
 				<?php echo $this->element('task_search'); ?>
 				<?php //pr($task);?>
 				<div class="col-md-8 whit_bg">
 					<div class="right_dash_board user_task">
 					<div class="task_details_head">
 						<h2><?php echo $task['Task']['title']?></h2>
 						
 						<?php if(isset($userid) && !empty($userid) && $userid==$task['Task']['user_id'] && $task['Task']['task_status']=='O'){?>
 						<div class="media" style="background:none;text-align:right;">
 						<button  class="btn btn-info" onclick="editStep1('<?php echo base64_encode($task['Task']['id']);?>')">Edit</button>
                              <button class="btn btn-danger" onclick="if(confirm('Are you sure you want to delete?')){window.location.assign('<?php echo $this->webroot?>tasks/delete/<?php echo base64_encode($task['Task']['id'])?>');return true;}else{return false;}">Delete</button>
                              </div>
                              <?php }?>
 						
 						<div class="media"> 
 							<div class="media-left media-middle"> 
 							<a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($task['User']['id']);?>"> 
 							<?php 
                                      $UserProfile_img=isset($task['User']['profile_img'])?$task['User']['profile_img']:'';
							   $uploadImgPath = WWW_ROOT.'user_images';
							   if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
								  echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" style="width: 40px; height: auto;max-height:40px" data-holder-rendered="true"/>';
							   }else{
								  echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="media-object" style="width: 40px; height: auto;max-height:40px" data-holder-rendered="true" />';
							   }
                                    ?>
 							 </a> 
 							</div> 
 							<div class="media-body"> 
 								<p>Posted by <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($task['User']['id']);?>"><?php echo $task['User']['first_name'].' '.$task['User']['last_name']?></a>.</p>
 							</div> 
 							<div class="media-right">
 								<div class="prgress_holder">
 								<ul id="progressbar">
 									<?php if($task['Task']['task_status']=="C")
 										{
 											$open = "active";$accept = "active";$complete = "active";
 										}else if($task['Task']['task_status']=="A")
 										{
 											$open = "active";$accept = "active";$complete = "";
 										}else if($task['Task']['task_status']=="O")
 										{
 											$open = "active";$accept = "";$complete = "";
 										}
 									?>
 									
									<li class="<?php echo $open; ?>">Open</li>
									<li class="<?php echo $accept; ?>">Assigned</li>
									<li class="<?php echo $complete; ?>">Complete</li>
								</ul>
								</div>
 							</div>
 						</div>
 					</div>
				    <ul class="detais_task_price_box">
					 	<li><a class="btn_orange">$ <?php echo $task['Task']['total_rate'];?></a></li>
					 	<li><a class="btn_dark">Paid with</a></li>
					 	<?php 
					 	if($task['Task']['task_status']=='O')   /////////////////////Condition for task when Open
					 	{
					 		if(isset($userid) && !empty($userid))
					 		{
					 			if($userid!=$task['Task']['user_id']) /////////////////////Other User Making Offer
					 			{
                                                ?>
                                                                        <li><a href="<?php if(isset($UserProposal) && !empty($UserProposal) && count($UserProposal)>0){ echo  'Javascript: void(0);';}else{ echo  $this->webroot.'tasks/offer/'.base64_encode($task['Task']['id']);}?>" class="btn_gray">Make an Offer</a></li>
					 				<?php
					 			}else{   /////////////////////Owner User of Task View offers 
					 				?>
					 				<li><a href="Javascript: void(0);" class="btn_gray">View Offers</a></li>
					 				<?php
					 			}
					 		}else{
					 			?>
					 			<li><a href="<?php echo $this->webroot?>users/login/" class="btn_gray">Please Login to make Offer</a></li>
					 			<?php
					 		}
					 	}
					 	
					 	if($task['Task']['task_status']=='A' && isset($job) && !empty($job))    /////////////////////Condition for task when Accepetd/Assigned
					 	{
					 		if(isset($userid) && !empty($userid))
					 		{
					 			if($job['User']['id']==$userid) /////////////////////Other User Made Offer
					 			{
					 				?>
					 				<li><a href="#" class="btn_gray">Request Payment</a></li>
					 				<?php
					 			}else if($task['Task']['user_id']==$userid){   /////////////////////Owner User of Task Release Fund
					 				?>
					 				<li><a href="<?php echo $this->webroot?>tasks/release_fund/<?php echo base64_encode($task['Task']['id']).'/'.base64_encode($job['Job']['id']);?>" class="btn_gray">Release Payment</a></li>
					 				<?php
					 			}else{    //////////Other User
					 			?>
					 			<li><a class="btn_gray">Assigned</a></li>
					 			<?php
					 			}
					 		}else{
					 			?>
					 			<li><a class="btn_gray">Assigned</a></li>
					 			<?php
					 		}
					 	}
					 	
					 	if($task['Task']['task_status']=='C')    /////////////////////Condition for task when Completed
					 	{
					 		if(isset($userid) && !empty($userid))
					 		{
					 			if($job['User']['id']==$userid) /////////////////////Other User Made Offer
					 			{
					 				?>
					 				<li><a href="#" class="btn_gray">Completed</a></li>
					 				<?php
					 			}else if($task['Task']['user_id']==$userid){   /////////////////////Owner User of Task Release Fund
					 				?>
					 				<li><a href="#" class="btn_gray">Completed</a></li>
					 				<?php
					 			}else{    //////////Other User
					 			?>
					 			<li><a class="btn_gray">Completed</a></li>
					 			<?php
					 			}
					 		}else{
					 			?>
					 			<li><a class="btn_gray">Completed</a></li>
					 			<?php
					 		}
					 	}
					 	
					 	?>
					 	
					 	<li>
					 	<a href="" class="btn_white dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">More Option</a>
					 	  <ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-file-text"></i>Post a Similar Task</a></li>
							<li><a href="#"><i class="fa fa-facebook-square"></i>Share on Facebook</a></li>
							<li><a href="#"><i class="fa fa-twitter-square"></i>Share on Twitter</a></li>
							<li><a href="#"><i class="fa fa-tasks"></i>Follow Task</a></li>
							<li><a href="#"><i class="fa fa-exclamation-circle"></i>Report</a></li>
							<li><a href="#"><i class="fa fa-bell"></i>Set up Alerts</a></li>
				          </ul>
					 	</li>
					</ul>
					<div class="detail_des">
						<h3>Description </h3>
						<?php echo $task['Task']['description'];?>
					</div>
                                        <?php
                                        if($task['Task']['lat']!='' && $task['Task']['lang']!=''){
                                        ?>
                                        <div class="detail_des">
                                            <div id="TaskDetailsMap" style="height: 220px;"></div>
					</div>    
                                        <?php 
                                        } 
                                        if($task['Task']['task_status']=='C' && $task['Task']['user_id']==$userid && count($RatingTask)<1){ ?>    
					<div class="detail_des">
                                            <h3>Ratings and Reviews</h3>
                                            <form name="RatingsReviews" method="post" action="">
                                                <input type="hidden" name="Giverating" id="Giverating" value="">
                                                <input type="hidden" name="rateto_user_id" value="<?php echo $job['Job']['user_id'];?>">    
                                                <div class="media-body">
                                                    <div id="getRateing"></div>
                                                  <textarea name="data[Rating][review]" style="margin: 0px; height: 75px; width: 565px;line-height: 18px;" required></textarea>
                                                </div>
                                                <div class="media-right"><button type="submit" name="data[post_comment]" value="postRating" class="btn btn-success" onclick="return Validate_form();">Submit</button></div>
                                            </form>
						
					</div>
					<?php 
                                        }
					if(isset($job) && !empty($job))
					{
						if(($task['Task']['user_id']==$userid || $job['User']['id']==$userid) && $task['Task']['task_status']!='O')
						{
						?>
						<div class="detail_des">
							<h3>Assigned To</h3>
							<div class="media">
								  <div class="media-left">
								    <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($job['User']['id']);?>">
									 <?php 
								        $UserProfile_img=isset($job['User']['profile_img'])?$job['User']['profile_img']:'';
									   $uploadImgPath = WWW_ROOT.'user_images';
									   if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
										  echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" style="width: 90px;"/>';
									   }else{
										  echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="media-object" style="width: 90px;" />';
									   }
								      ?>
									 
								    </a>
								  </div>
								  <div class="media-body">
								    <h5><a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($job['User']['id']);?>"><?php echo ($job['User']['first_name'].' '.$job['User']['last_name']);?></a> <span>, Accepted On : <?php echo date('M d, Y H:i a',strtotime($job['Job']['accepted_date']));?></span></h5>
								    
								    <p><?php echo ($job['Proposal']['comments']);?></p>
								    <?php if($task['Task']['task_status']=='A' && $task['Task']['user_id']==$userid)
								    {?>
								    <!--<a href="<?php echo $this->webroot?>tasks/complete/<?php echo base64_encode($task['Task']['id']);?>/<?php echo base64_encode($job['Job']['id']);?>" class="btn btn-success" style="float:right;">Complete</a>-->
								    <?php }?>
								    <?php if($task['Task']['user_id']==$userid){?>
								    <a href="<?php echo $this->webroot?>sent-messages/contact/<?php echo base64_encode($job['User']['id']).'/'.base64_encode($task['Task']['id']);?>" class="btn btn-success" style="float:right;">Send Message</a>
								    <?php }else if($job['User']['id']==$userid){?>
								    <a href="<?php echo $this->webroot?>sent-messages/contact/<?php echo base64_encode($task['Task']['user_id']).'/'.base64_encode($task['Task']['id']);?>" class="btn btn-success" style="float:right;">Send Message</a>
								    <?php }?>
							  	  </div>
							</div>
						</div>	
						<?php
						}
					}
					?>
                                        <?php 
                                        //pr($ReviewTask);
                                        if($task['Task']['task_status']=='C' && ($task['Task']['user_id']==$userid || $job['User']['id']==$userid) && count($ReviewTask)>0){ ?>        
                                        <div class="detail_des">
						<h3>Review to </h3>
						<div class="media">
                                                    <div class="media-left">
                                                      <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($ReviewTask['User']['id']);?>">
                                                           <?php 
                                                          $UserProfile_img=isset($ReviewTask['User']['profile_img'])?$ReviewTask['User']['profile_img']:'';
                                                             $uploadImgPath = WWW_ROOT.'user_images';
                                                             if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                                                    echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" style="width: 90px;"/>';
                                                             }else{
                                                                    echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="media-object" style="width: 90px;" />';
                                                             }
                                                        ?>

                                                      </a>
                                                    </div>
                                                    <div class="media-body">
                                                      <h5><a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($ReviewTask['User']['id']);?>"><?php echo ($ReviewTask['User']['first_name'].' '.$ReviewTask['User']['last_name']);?></a> <span>, Review On : <?php echo date('M d, Y H:i a',strtotime($ReviewTask['Rating']['date_time']));?></span></h5>
                                                    <div id="Rating_show_user"></div> 
                                                <?php 
                                                $UserGiveTot_rating=$ReviewTask['Rating']['rating'];
                                                echo '<script>
$(document).ready(function(){
$("#Rating_show_user").raty({score:'.$UserGiveTot_rating.',readOnly:true, halfShow : true});
});</script>';
                                                ?>  
                                                      <p><?php echo ($ReviewTask['Rating']['review']);?></p>
                                                    </div>
                                            </div>
					</div>  
                                        <?php }?>
					<div class="detail_des">
						<h3>Offers</h3>
						<h4><?php echo (isset($proposals)?count($proposals):'0');?> offers about this Task</h4>
						<div class="chat_box_sec">
							View offers below then assign your task to get started. Once assigned, you can access private messages and exchange personal details.
							<?php 
                                                            $offCnt=0;
								if(isset($proposals) && !empty($proposals))
								{
									foreach($proposals as $proposal){
                                                                            $offCnt++;
										?>							
							<div class="offer-new">
								<div class="col">
									<a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($proposal['User']['id']);?>">
									 <?php 
									   $UserProfile_img=isset($proposal['User']['profile_img'])?$proposal['User']['profile_img']:'';
									   $uploadImgPath = WWW_ROOT.'user_images';
									   if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
										  echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="avatar-img interactive" />';
										  $userImg = $UserProfile_img;
									   }else{
										  echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="avatar-img interactive"  />';
										  $userImg = 'default.png';
									   }
									 ?>
									</a>	
								</div>
								<div class="col name"><a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($proposal['User']['id']);?>"><?php echo ($proposal['User']['first_name'].' '.$proposal['User']['last_name']);?></a></div>
								<div class="col rating-holder">
									<div class="rating">
                                                                            <div id="rateStar_<?php echo $offCnt;?>"></div>
                                                                            <?php 
                                                                            $tot_rating=isset($proposal['User']['tot_rating'])?$proposal['User']['tot_rating']:'0';
                                                                            $tot_review=isset($proposal['User']['tot_review'])?$proposal['User']['tot_review']:'0';
                                                                            echo '<script>
$(document).ready(function(){
$("#rateStar_'.$offCnt.'").raty({score:'.$tot_rating.',readOnly:true, halfShow : true});
});</script>';
                                                                            ?>
                                                                            
<!--<span class="star"><i class="fa fa-star"></i> </span>
										<span class="star"><i class="fa fa-star"></i> </span>
										<span class="star"><i class="fa fa-star"></i> </span>
										<span class="star"><i class="fa fa-star"></i> </span>
										<span class="star"><i class="fa fa-star"></i> </span>-->
										<div class="rating-summary">(<?php echo (isset($tot_review) && $tot_review >1)?$tot_review.' reviews':$tot_review.' review';?>  )</div>
									</div>
								</div>
								<div class="col bid">$<?php echo $proposal['Proposal']['amount']?></div>
								<div class="col offer">
								<?php if($task['Task']['task_status']=='O' && $task['Task']['user_id']==$userid){?>
                                                                    <a href="Javascript: void(0);" class="btn btn-success" onclick="viewOffer('<?php echo base64_encode($task['Task']['id'])?>','<?php echo base64_encode($proposal['Proposal']['id'])?>','<?php echo base64_encode($proposal['Proposal']['user_id'])?>','<?php echo $userImg?>','<?php echo $proposal['User']['first_name']?> <?php echo $proposal['User']['last_name']?>','<?php echo $proposal['Proposal']['amount']?>','<?php echo $proposal['Proposal']['comments']?>','<?php echo $proposal['User']['about']?>','<?php echo $proposal['User']['tot_rating']?>','<?php echo $proposal['User']['tot_review']?>')" style="float:right;" >View offer</a>
								<?php 
                                                                
                                                                }elseif(isset($userid) && !empty($userid) && $userid==$proposal['User']['id'] && $task['Task']['task_status']=='O'){
                                                                ?>
                                                                    <a href="<?php echo $this->webroot?>tasks/offer/<?php echo base64_encode($task['Task']['id']);?>/<?php echo base64_encode($proposal['Proposal']['id']);?>" class="btn btn-success">Edit offer</a>
                                                                <?php
                                                                }
                                                                ?>
									
								</div>
							</div>
							<?php
									}
								}else{
									echo 'No Offers yet posted.';
								}
							?>
																
						</div>
					</div>
					
					
					<?php if(isset($userid) && !empty($userid))
					{
					?>
					<div class="detail_des">
						<h3>Task Activity</h3>
						<h4><?php echo (isset($comments_count)?count($comments_count):'0');?> comments about this Task</h4>
						<div class="chat_box_sec">
							<!--
							<div class="media">
							  <div class="media-left">
							    <a href="#">
							      <img class="media-object" src="http://zblogged.com/wp-content/uploads/2015/11/17.jpg" alt="...">
							    </a>
							  </div>
							  <div class="media-body">
							    <h5>Sandeep <span>January 20 at 5:04pm</span></h5>
							    
							    <p>Today is the correct day for Dhoni to resign as this match was almost in our hand with easy win when dhawan was out but Dhoni purposely made the team to loose.</p>
							    <div class="media">
									  <div class="media-left">
									    <a href="#">
									      <img class="media-object" src="http://zblogged.com/wp-content/uploads/2015/11/17.jpg" alt="...">
									    </a>
									  </div>
									  <div class="media-body">
									    <h5>Sandeep <span>January 20 at 5:04pm</span></h5>
									    
									    <p>Today is the correct day for Dhoni to resign as this match was almost in our hand with easy win when dhawan was out but Dhoni purposely made the team to loose.</p>
								  	  </div>
								</div>
								<div class="media">
									  <div class="media-left">
									    <a href="#">
									      <img class="media-object" src="http://zblogged.com/wp-content/uploads/2015/11/17.jpg" alt="...">
									    </a>
									  </div>
									  <div class="media-body">
									    <h5>Sandeep <span>January 20 at 5:04pm</span></h5>
									    
									    <p>Today is the correct day for Dhoni to resign as this match was almost in our hand with easy win when dhawan was out but Dhoni purposely made the team to loose.</p>
								  	  </div>
								</div>
								<div class="media">
									  <div class="media-left">
									    <a href="#">
									      <img class="media-object" src="http://zblogged.com/wp-content/uploads/2015/11/17.jpg" alt="...">
									    </a>
									  </div>
									  <div class="media-body">
									    <h5>Sandeep <span>January 20 at 5:04pm</span></h5>
									    
									    <p>Today is the correct day for Dhoni to resign as this match was almost in our hand with easy win when dhawan was out but Dhoni purposely made the team to loose.</p>
								  	  </div>
								</div>
							  </div>
							</div>
							<div class="media">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="http://zblogged.com/wp-content/uploads/2015/11/17.jpg" alt="...">
								    </a>
								  </div>
								  <div class="media-body">
								    <h5>Sandeep <span>January 20 at 5:04pm</span></h5>
								    
								    <p>Today is the correct day for Dhoni to resign as this match was almost in our hand with easy win when dhawan was out but Dhoni purposely made the team to loose.</p>
							  	  </div>
							</div>-->
							
							<?php 
							if(isset($comments) && !empty($comments)){
                                                            //pr($comments);
                                                            foreach($comments as $comment){
                                                                $CommentUserShow='';
                                                                $CommentPID=$comment['TaskComment']['id'];
                                                                $child_comment_msg = $this->requestAction(array('controller' => 'tasks', 'action' => 'child_comment', $CommentPID));
                                                                if($comment['TaskComment']['user_id']==$userid){
                                                                    $CommentUserShow = 'Yes';
                                                                }
                                                        ?>
                                                            <div class="media">
                                                                  <div class="media-left">
                                                                    <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($comment['User']['id']);?>">
                                                                         <?php 
                                                                  $UserProfile_img=isset($comment['User']['profile_img'])?$comment['User']['profile_img']:'';
                                                                           $uploadImgPath = WWW_ROOT.'user_images';
                                                                           if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                                                                  echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" />';
                                                                           }else{
                                                                                  echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="media-object"  />';
                                                                           }
                                                                ?>

                                                                    </a>
                                                                  </div>
                                                                  <div class="media-body">
                                                                    <h5><a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($comment['User']['id']);?>"><?php echo ($comment['User']['first_name'].' '.$comment['User']['last_name']);?></a> <span><?php echo date('M d, Y H:i a',strtotime($comment['TaskComment']['date']));?></span></h5>

                                                                    <p><?php echo ($comment['TaskComment']['comments']);?></p>
                                                                  </div>
                                                                <div class="clearfix"></div>
                                                        
                                                        <?php
                                                                if(count($child_comment_msg)>0){
                                                                    foreach($child_comment_msg as $CHVal){
                                                        ?>
                                                                 <div class="media-left">
                                                                    <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($CHVal['User']['id']);?>">
                                                                         <?php 
                                                                  $UserProfile_img=isset($CHVal['User']['profile_img'])?$CHVal['User']['profile_img']:'';
                                                                           $uploadImgPath = WWW_ROOT.'user_images';
                                                                           if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                                                                                  echo '<img src="'.$this->webroot.'user_images/'.$UserProfile_img.'" alt="" class="media-object" />';
                                                                           }else{
                                                                                  echo '<img src="'.$this->webroot.'user_images/default.png" alt="" class="media-object"  />';
                                                                           }
                                                                ?>

                                                                    </a>
                                                                  </div>
                                                                  <div class="media-body">
                                                                    <h5><a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($CHVal['User']['id']);?>"><?php echo ($CHVal['User']['first_name'].' '.$CHVal['User']['last_name']);?></a> <span><?php echo date('M d, Y H:i a',strtotime($CHVal['TaskComment']['date']));?></span></h5>

                                                                    <p><?php echo ($CHVal['TaskComment']['comments']);?></p>
                                                                  </div>
                                                                <div class="clearfix"></div>
                                                        <?php
                                                                    $CommentRecId=$CHVal['TaskComment']['id'];
                                                                    $CommentRecUser_id=$CHVal['TaskComment']['user_id'];
                                                                    if($CommentRecUser_id==$userid){
                                                                        $CommentUserShow = 'Yes';
                                                                    }
                                                                    
                                                                    }
                                                                    //$child_comment_msg=$this->requestAction(array('controller' => 'tasks', 'action' => 'child_comment', $CommentRecId));
                                                        ?>
                                                                <?php if($task['Task']['task_status']=='O' && ($CommentUserShow == 'Yes' || $task['Task']['user_id']== $userid)){?>
                                                                <div class="media-body">
                                                                    <p> <a href="Javascript: void(0);" class="reply_individual" id="<?php echo $CommentRecId;?>"><i class="fa fa-reply"></i>  Reply</a></p>
                                                                </div>
                                                                <?php }?>
                                                                <div class="media reply" id="reply_id_<?php echo $CommentRecId;?>" style="display:none;">
                                                                    <form name="comment_reply" method="post" action="">
                                                                        <input type="hidden" name="data[TaskComment][parent_id]" value="<?php echo $CommentPID;?>">
                                                                          <div class="media-left">
                                                                            <a href="Javascript: void(0);">
                                                                                 <img class="media-object" src="http://blog.ramboll.com/fehmarnbelt/wp-content/themes/ramboll2/images/profile-img.jpg" alt="...">
                                                                            </a>
                                                                          </div>
                                                                          <div class="media-body">
                                                                            <textarea name="data[TaskComment][comments]" style="margin: 0px; height: 75px; width: 500px;line-height: 18px;" required></textarea>
                                                                          </div>
                                                                          <div class="media-right"><button type="submit" name="data[post_comment]" value="postCommentReply" class="btn fa fa-paper-plane btn_plane"></button></div>
                                                                    </form>
                                                                </div>
                                                        <?php
                                                                }else{
                                                        ?>
                                                                <?php if($task['Task']['task_status']=='O' && $task['Task']['user_id']== $userid){?>
                                                                <div class="media-body">
                                                                    <p> <a href="Javascript: void(0);" class="reply_individual" id="<?php echo $comment['TaskComment']['id'];?>"><i class="fa fa-reply"></i>  Reply</a></p>
                                                                </div>
                                                                <?php }?>
                                                                <div class="media reply" id="reply_id_<?php echo $comment['TaskComment']['id'];?>" style="display:none;">
                                                                    <form name="comment_reply" method="post" action="">
                                                                        <input type="hidden" name="data[TaskComment][parent_id]" value="<?php echo $CommentPID;?>">
                                                                          <div class="media-left">
                                                                            <a href="Javascript: void(0);">
                                                                                 <img class="media-object" src="http://blog.ramboll.com/fehmarnbelt/wp-content/themes/ramboll2/images/profile-img.jpg" alt="...">
                                                                            </a>
                                                                          </div>
                                                                          <div class="media-body">
                                                                            <textarea name="data[TaskComment][comments]" style="margin: 0px; height: 75px; width: 565px;line-height: 18px;" required></textarea>
                                                                          </div>
                                                                          <div class="media-right"><button type="submit" name="data[post_comment]" value="postCommentReply" class="btn fa fa-paper-plane btn_plane"></button></div>
                                                                    </form>
                                                                </div>
                                                        <?php
                                                                }
                                                        ?>
                                                        </div>
                                                        <?php
                                                            }
							}else{
								echo 'No commnents yet posted.';
							}
							?>
							<?php if($task['Task']['task_status']=='O')
							{?>
							<div class="media reply">
								  <form name="comment" id="comment" method="post" action="">
									  <div class="media-left">
									    <a href="#">
										 <img class="media-object" src="http://blog.ramboll.com/fehmarnbelt/wp-content/themes/ramboll2/images/profile-img.jpg" alt="...">
									    </a>
									  </div>
									  <div class="media-body">
									    <textarea name="data[TaskComment][comments]" id="comments" style="margin: 0px; height: 75px; width: 565px;line-height: 18px;" required></textarea>
								  	  </div>
								  	  <div class="media-right"><button type="submit" name="data[post_comment]" value="postComment" class="btn fa fa-paper-plane btn_plane"></button></div>
							  	  </form>
							</div>
							<?php }?>
						</div>
					</div>
					</div>
					<?php
					}else{
					?>
					<div class="detail_des">
						<h3>Task Activity</h3>
						<h4><?php echo (isset($comments_count)?count($comments_count):'0');?> comments about this Task</h4>
						<ul class="button_holder">
							<li>
								<a href="<?php echo $this->webroot?>users/signup" class="btn orng" style="color:#fff">JOIN</a>
							</li>
							<li><span>Or</span></li>
							<li>
							<a href="<?php echo $this->webroot?>users/login" class="btn deep" style="color:#fff">LOGIN</a>
							</li>
						</ul>
					</div>
					<?php
					}?>
					
					
 				</div>
 			</div>
 		</div>
 	</section>
 	


<div id="funds" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>Funds Required</h3>
    
  </header>
  <?php $siteurl= Configure::read('SITE_URL');?>
  <form id="fPaypal" name="fPaypal" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
		               <input type="hidden" name="cmd" value="_xclick">
		               <input type="hidden" name="quantity" value="1">
		               <input type="hidden" name="business" value="<?php echo $sitesetting['SiteSetting']['paypal_email'];?>">
		               <input type="hidden" name="currency_code" value="USD">
		               <input type="hidden" name="notify_url" value="<?php echo $siteurl;?>ipn.php">
		               <input type="hidden" name="return" value="<?php echo $siteurl;?>tasks/pay_success/<?php echo base64_encode($task['Task']['id'])?>">
		               <input type="hidden" name="cancel_return" value="<?php echo $siteurl;?>tasks/detail/<?php echo base64_encode($task['Task']['id'])?>">
		               <input type="hidden" name="item_name" value="Pay for the Task">
		               <input type="hidden" name="amount" id="paypal_amount" value="">
		               <input type="hidden" name="custom" id="paypal_custom" value="">
  </form>
  <form name="fundtype" id="fundtype" method="post" action="">
  <div class="modal-body">
  <div class="scroll-modal">
    
    <div class="offer-details">
    		<h1 id="payTxt"> </h1>
    		
    </div>
    
      <input type="hidden" name="tid" id="tid" value="">
      <input type="hidden" name="bid" id="bid" value="">
      <div class="modal-body">
        	
        	<div class="alert alert-danger" id="paymentMsg" style="display:none">
		  <p id="paymentmsg"> </p>
		</div>
        	<div class="col-md-12 form-group">
		  	
		  	<div class="col-sm-12">
	    		   <div class="radio">
	    		   	<input type="radio" checked name="payby" id="paypal" onclick="check_paytype('pp')"/>
	    		   	<label for="radio1"><?php echo 'PAYPAL';?></label>
	    		   </div>
	    		</div>
	    		<div class="col-sm-12">
	    			<div class="form-group">
				  <img src="<?php echo $this->webroot;?>images/paypal.png" alt="" class="img-responsive">
				</div>
	    		</div>
	    		<div class="col-sm-12">
	    			<div class="radio">
	    				<input type="radio" name="payby" id="paypalpro" onclick="check_paytype('cc')"/>
	    				<label for="radio2"><?php echo 'CREDIT CARD';?></label>
	    			</div>
	    		</div>
	    		<div class="col-sm-12">
	    			<div class="col-sm-3">
		    			<div class="form-group">
						  <img  style="width: 80px;height: 40px;" src="<?php echo $this->webroot; ?>images/maestro.png" alt="" class="img-responsive">
					</div>
			     </div>
			     <div class="col-sm-8">
		    			<div class="form-group">
						  <img style="width: 80px;height: 40px; " src="<?php echo $this->webroot; ?>images/visa.png" alt="" class="img-responsive">
					</div>
				</div>	
	    		</div>
		  	<div class="col-sm-12" style="margin-bottom:20px;">
		    		<select name="creditCardType" class="form-control" style="width:30.8%;" onChange="javascript:generateCC(); return false;" id="creditCardType" disabled="disabled">
		    		 <option value="">--Select Card type--</option>
				 <option value="Visa"><?php echo 'VISA';?></option>
				 <option value="MasterCard"><?php echo 'MASTER';?></option>
				 <option value="Discover"><?php echo 'DISOVER';?></option>
				 <option value="Amex"><?php echo 'AMERICANEXP';?></option>
				   </select>
			</div>
		    	<div class="col-sm-8">
		    			<div class="form-group">
                                            <input type="number" required="required" class="form-control" id="cardnumber" name="cardnumber" placeholder="Card Number" disabled="disabled">
					</div>
		    	</div>
		    	<div class="col-sm-8 col-xs-6">
		    			<div class="form-group">
			    			 <?php
			    			 $months = array(1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May', 6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec');

			    			 ?>
			    			  <select name="expmonth" id="expmonth" class="form-control" style="width:25%;float:left;" disabled="disabled">
			    			   <option value=""><?php echo 'EXP MONTH'; ?></option>
			    			   <?php 
			    			    foreach ($months as $num => $name) {
			    			    ?>
			    			    <option value=<?php echo $num;?>><?php echo $name;?></option>
			    			   <?php } ?>
			    			  </select>
			    			  <?php $curr_tear=date('Y');?>
			    			  <select name="expyear" id="expyear" class="form-control" style="width:25%;float:left;margin-left:5%;" disabled="disabled">
			    			   <option value=""><?php echo 'EXP YEAR';?></option>
			    			    <?php for($y=$curr_tear;$y<=$curr_tear+30;$y++){?>
							      <option value=<?php echo $y;?>><?php echo $y;?></option>
						          <?php } ?>	
			    			  </select>
			    			  <input type="password" class="form-control" id="cvv" name="cvv" placeholder="<?php echo 'CVV'; ?>" style="width:25%;float:left;margin-left:5%;" disabled="disabled">
					</div>
		    	</div>
		    	<div class="clearfix"></div>
		    	
		  	
		  </div>
        
      </div>
      
      
    
   
    
    <div class="recent-reviews">
    	 <P style="text-align:center;" ><input type="button" class="btn btn-primary" value="<?php echo 'ACCEPT & ADD FUNDS';?>" onclick="validate_pay()" id="paybtn"/></P>
    </div>
    </div>
  </div>
  <footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
  </html>
</div>


<div id="success" class="modal-box">
  <header> <a href="#" class="js-modal-close close">×</a>
    <h3>Task Assigned Successfully</h3>
    <h4><?php echo $task['Task']['title'];?></h4>
  </header>
  <div class="modal-body">
	  <div class="scroll-modal">
	    
	    <div class="offer-details">
		    <h1>You have accepted the Offer</h1>
		    <h2>“Your amount is safe in the Out Source My Life. Once your task is done then you can release the fund.”</h2>
		    
	    </div>
	    
	  </div>
  </div>
  <footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>
</div>

<div id="popup1" class="modal-box">
  <header> <a href="Javascript: void(0);" class="js-modal-close close">×</a>
    <h3>Review Offers</h3>
    
  </header>
  <div class="modal-body">
  <div class="scroll-modal">
    <div class="personals">
    	<div class="header-image"></div>
        <div class="header-image-overlay"></div>
        <div id="userImg"> </div>
        <span class="user-name-holder" id="userHref"></span>
        <div class="rating-summary-holder">
            <div class="rating">
                <div id="rateStarOffer"></div>    
            <!--<span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span> -->
            </div>
        </div>
    </div>
    <div class="offer-details">
    <h1 id="userOffer"> </h1>
    <h2 id="userAmount"> </h2>
    <p id="userComment"> </p>
    </div>
    <!--<div class="recent-reviews">
    	<h1>Recent Reviews</h1>
        <div class="star"><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span></div>
        <p>Genuine Instagram followers
Syama B. said “Good communication did what was required.”
7 hours ago</p>
<div class="star"><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span></div>
        <p>Genuine Instagram followers
Syama B. said “Good communication did what was required.”
7 hours ago</p>
<div class="star"><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span><span class="star"><i class="fa fa-star"></i> </span></div>
        <p>Genuine Instagram followers
Syama B. said “Good communication did what was required.”
7 hours ago</p>
    </div>-->
    
    <div class="recent-reviews">
    	<h1 id="userAbout"> </h1>
        <p id="userDesc"></p>
        <P style="text-align:center;" id="acceptOffer"></P>
    </div>
    </div>
  </div>
  <footer> <a href="Javascript: void(0);" class="btn btn-small js-modal-close">Close</a> </footer>
</div>

<div id="loading_modal" class="modal-box">
  <!--<header> <a href="#" class="js-modal-close close">×</a>
    <h3>Task Assigned Successfully</h3>
    
  </header>-->
  <div class="modal-body">
	  <div class="scroll-modal">
	    
	    <div class="offer-details">
                <center><p>please wait...</p>
                    <img src="<?php echo $this->webroot?>img/ajax-loader.gif" alt="Loading">    
                </center>
	    </div>
	    
	  </div>
  </div>
  <!--<footer> <a href="#" class="btn btn-small js-modal-close">Close</a> </footer>-->
</div>

<div id="EditOfferModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Comment details</h4>
        </div>
        <div class="modal-body">
            
        </div>
      
    </div>

  </div>
</div>

<script>
$(document).ready(function(){
    //$("#rateStar").raty({score:<?php //echo $avg_score;?>,readOnly:true}); 
    //$("#getRateing").raty({score:<?php //echo $avg_score;?>}); 
    $("#getRateing").raty({
        score:0,
        halfShow : true,
        click: function(score, evt) {
            $("#Giverating").attr("value",score);    
        }
    });
    $('.reply_individual').click(function(){
        var DivID=$(this).attr('id');
        //$('#reply_id_'+DivID).show();
        $('#reply_id_'+DivID).toggle();
    });
});    

function Validate_form(){
    var Giverating=$('#Giverating').val();
    if(Giverating==''){
        alert('Please give rating.');
        return false;
    }else{
        return true;
    }
}

function viewOffer(tid,bid,uid,userImg,userName,userAmount,userComment,userDesc,rating,review){
      //alert('hi');
	console.log(userImg);
	$('#tid').val(tid);$('#bid').val(bid);
	$('#userImg').html('<a href="<?php echo $this->webroot?>users/profile/'+uid+'"><img src="<?php echo $this->webroot?>user_images/'+userImg+'" class="avatar-img" ></a>');
	$('#userHref').html('<a href="<?php echo $this->webroot?>users/profile/'+uid+'" class="user-name">'+userName+'</a>');
        //$("#rateStarOffer").raty({score:rating,readOnly:true, halfShow : true});
	$('#userOffer').html(userName+'\'s Offer');
	$('#userAmount').html('$'+userAmount);
	$('#userComment').html('“'+userComment+'”');
	$('#userAbout').html('About '+userName);
	$('#userDesc').html(''+userDesc);
	$('#acceptOffer').html('<a   class="btn btn-success" style="text-align: center;" onclick="provideValue(\''+tid+'\',\''+bid+'\',\''+userName+'\',\''+userAmount+'\')">Accept Offer</a>');
	$('.modal').modal('hide');
	$('#popup1').modal('show');
	$('.modal-backdrop').add();
}
function provideValue(tid,bid,userName,userAmount){
	console.log(tid);
	$('#tid').val(tid);$('#bid').val(bid);
	$('.modal').modal('hide');
	$(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").remove();
        
     });
     $('#payTxt').html('To accept '+userName+'\'s offer of $'+userAmount+', we will need to hold the amount for the task. ');
     $('#paypal_amount').val(userAmount);
     $('#paypal_custom').val(tid+'|'+bid);
	$('#funds').modal('show');
}
function checktype(){
	var type = $('input[name=payment_by]:checked', '#fundtype').val();
	if(type=='paypal_pro')
	{
		window.location.assign('https://www.google.co.in/');
	}else{
		window.location.assign('https://www.gmail.co.in/');
	}
}
 function generateCC(){
		var cc_number = new Array(16);
		var cc_len = 16;
		var start = 0;
		var rand_number = Math.random();
                var creditCardType=$('#creditCardType').val();
		switch(creditCardType)
                {
			case "Visa":
				cc_number[start++] = 4;
				break;
			case "Discover":
				cc_number[start++] = 6;
				cc_number[start++] = 0;
				cc_number[start++] = 1;
				cc_number[start++] = 1;
				break;
			case "MasterCard":
				cc_number[start++] = 5;
				cc_number[start++] = Math.floor(Math.random() * 5) + 1;
				break;
			case "Amex":
				cc_number[start++] = 3;
				cc_number[start++] = Math.round(Math.random()) ? 7 : 4 ;
				cc_len = 15;
				break;
                }

                for (var i = start; i < (cc_len - 1); i++) {
			cc_number[i] = Math.floor(Math.random() * 10);
                }

		var sum = 0;
		for (var j = 0; j < (cc_len - 1); j++) {
			var digit = cc_number[j];
			if ((j & 1) == (cc_len & 1)) digit *= 2;
			if (digit > 9) digit -= 9;
			sum += digit;
		}

		var check_digit = new Array(0, 9, 8, 7, 6, 5, 4, 3, 2, 1);
		cc_number[cc_len - 1] = check_digit[sum % 10];

		$('#cardnumber').attr('placeholder','');
		var cnum='';
		for (var k = 0; k < cc_len; k++) {
		   cnum += cc_number[k];
		}
		$('#cardnumber').attr('placeholder','eg. '+cnum);
 }
 function check_paytype(type)
 {
   if(type=="pp" || type=="invoice" || type=="bitcoin")
   {
     $("#creditCardType").val('');
     $("#cardnumber").val('');
     $("#expmonth").val('');
     $("#expyear").val('');
     $("#cvv").val('');
     $("#creditCardType").attr('disabled','disabled');
     $("#cardnumber").attr('disabled','disabled');
     $("#expmonth").attr('disabled','disabled');
     $("#expyear").attr('disabled','disabled');
     $("#cvv").attr('disabled','disabled');
   }
   else if(type=="cc")
   {
     $("#creditCardType").removeAttr('disabled');
     $("#cardnumber").removeAttr('disabled');
     $("#expmonth").removeAttr('disabled');
     $("#expyear").removeAttr('disabled');
     $("#cvv").removeAttr('disabled');
   }
 }
 function validate_pay()
 {
    
      if($('#paypalpro').is(':checked'))
      {
          var creditCardType=$('#creditCardType').val();
          var cardnumber=$('#cardnumber').val();
          var expmonth=$('#expmonth').val();
          var expyear=$('#expyear').val();
          var cvv=$('#cvv').val();
          if(creditCardType=='')
          {
            $('#creditCardType').css('border','1px solid red');
          }
          else
          {
            $('#creditCardType').css('border','0px');
          }
          if(cardnumber=='')
          {
            $('#cardnumber').css('border','1px solid red');
          }
          else
          {
            $('#cardnumber').css('border','0px');
          }
          if(expmonth=='')
          {
            $('#expmonth').css('border','1px solid red');
          }
          else
          {
            $('#expmonth').css('border','0px');
          }
          if(expyear=='')
          {
            $('#expyear').css('border','1px solid red');
          }
          else
          {
            $('#expyear').css('border','0px');
          }
          if(cvv=='')
          {
            $('#cvv').css('border','1px solid red');
          }
          else
          {
            $('#cvv').css('border','0px');
          }
          if(first_name=='' || last_name=='' || creditCardType=='' || cardnumber=='' || expmonth=='' || expyear=='' || cvv=='')
          {
            
          }
          else
          {
            $('#loading_modal').modal({backdrop: 'static', keyboard: false});  
            $('#paybtn').prop("disabled",true);
            var usrid='<?php echo base64_encode($this->Session->read("userid"));?>';
            var tid=$('#tid').val();
            var bid=$('#bid').val();
            var first_name = "<?php echo $user['User']['first_name'];?>";
            var last_name = "<?php echo $user['User']['last_name'];?>";
            $.ajax({
                  url: "<?php echo $this->webroot;?>paypalpro/perform.php",
                  type: "POST",
                  data: {'first_name':first_name,'last_name':last_name,'creditCardType':creditCardType,'cardnumber':cardnumber,'expmonth':expmonth,'expyear':expyear,'cvv':cvv,'usrid':usrid,'tid':tid,'bid':bid},
                  success: function(respro)
                  {
                    if(respro=='SUCCESS')
                    {
                       /*$('.modal').modal('hide');
                       $('#success').modal('show');*/
                       window.location.href="<?php echo $this->webroot;?>tasks/pay_success/"+tid;
                    }
                    else
                    {
                        $('#loading_modal').modal('hide');
                        $('#paybtn').prop("disabled",false);
                        $('#paymentmsg').html(respro);
                        $('#paymentMsg').show();
                       /* setTimeout(function(){
                          $('#paymentmsg').html('');
                        },3000);*/
                    }
                  }
             });
          }
      }
      else if($('#paypal').is(':checked'))
      {
         $('#fPaypal').submit();
         //window.location.href="<?php echo $this->webroot;?>products/pay-by-paypal";
      }
}
$('.scroll-modal').enscroll({
		    showOnHover: false,
		    verticalTrackClass: 'track4',
		    verticalHandleClass: 'handle4'
		});
$(function(){

var appendthis =  ("<div class='modal-overlay js-modal-close'></div>");

	$('a[data-modal-id]').click(function(e) {
		e.preventDefault();
    $("body").append(appendthis);
    $(".modal-overlay").fadeTo(500, 0.7);
    //$(".js-modalbox").fadeIn(500);
		var modalBox = $(this).attr('data-modal-id');
		$('#'+modalBox).fadeIn($(this).data());
	});  
  
  
$(".js-modal-close, .modal-overlay").click(function() {
    $(".modal-box, .modal-overlay").fadeOut(500, function() {
        $(".modal-overlay").fadeOut();
        $(".modal-backdrop").fadeOut();
    });
 
});
 
$(window).resize(function() {
    $(".modal-box").css({
        top: ($(window).height() - $(".modal-box").outerHeight()) / 6,
        left: ($(window).width() - $(".modal-box").outerWidth()) / 2
    });
});
 
$(window).resize();
 
});
</script>	
