<?php ?>
<script src="<?php echo $this->webroot?>js/enscroll-0.6.0.min.js"></script>
<script>
$('.right_dash_board').enscroll({
		    showOnHover: false,
		    verticalTrackClass: 'track3',
		    verticalHandleClass: 'handle3'
		});
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
					 				<li><a href="<?php echo $this->webroot?>tasks/offer/<?php echo base64_encode($task['Task']['id']);?>" class="btn_gray">Make an Offer</a></li>
					 				<?php
					 			}else{   /////////////////////Owner User of Task View offers 
					 				?>
					 				<li><a href="#" class="btn_gray">View Offers</a></li>
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
					 				<li><a href="#" class="btn_gray">Release Offer</a></li>
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
								    <a href="<?php echo $this->webroot?>tasks/complete/<?php echo base64_encode($task['Task']['id']);?>/<?php echo base64_encode($job['Job']['id']);?>" class="btn btn-success" style="float:right;">Complete</a>
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
					
					
					<div class="detail_des">
						<h3>Offers</h3>
						<h4><?php echo (isset($proposals)?count($proposals):'0');?> offers about this Task</h4>
						<div class="chat_box_sec">
							View offers below then assign your task to get started. Once assigned, you can access private messages and exchange personal details.
							<?php 
							if(isset($proposals) && !empty($proposals))
							{
								foreach($proposals as $proposal){
									?>
									<div class="media">
										  <div class="media-left">
										    <a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($proposal['User']['id']);?>">
											 <?php 
								                  $UserProfile_img=isset($proposal['User']['profile_img'])?$proposal['User']['profile_img']:'';
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
										    <h5><a href="<?php echo $this->webroot?>users/profile/<?php echo base64_encode($proposal['User']['id']);?>"><?php echo ($proposal['User']['first_name'].' '.$proposal['User']['last_name']);?></a> <span><?php echo date('M d, Y H:i a',strtotime($proposal['Proposal']['date']));?></span></h5>
										    
										    <p><?php echo ($proposal['Proposal']['comments']);?></p>
										    <?php if($task['Task']['task_status']=='O' && $task['Task']['user_id']==$userid)
										    {?>
										    <a href="<?php echo $this->webroot?>tasks/assign/<?php echo base64_encode($task['Task']['id']);?>/<?php echo base64_encode($proposal['Proposal']['id']);?>" style="float:right;">Assign</a>
										    <?php }?>
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
						<h4><?php echo (isset($comments)?count($comments):'0');?> comments about this Task</h4>
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
							if(isset($comments) && !empty($comments))
							{
								foreach($comments as $comment){
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
						<h4><?php echo (isset($comments)?count($comments):'0');?> comments about this Task</h4>
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
