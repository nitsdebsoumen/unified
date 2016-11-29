<?php
//pr($posts);
//echo count($posts);
?>
	<section class="dashboard-top">
		<div class="container">
			<div class="row">
				<div class="col-md-7 middle-div dash_top">
					<div class="row">
						<div class="col-sm-5 border-right_white">
							<div class="edit-profile-round-img-hold">
								<?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt=""><?php } ?>
								<!--<a href="">Change</a>-->
								<span class="tag_verifyd"></span>
							</div>
						</div>
						<div class="col-sm-7 padding_left_20">
							<h1><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h1>
							<!--<div class="like">
								<span><img src="<?php echo $this->webroot;?>images/like-symbol.png" alt=""></span>
							</div>-->
							<div class="seller_ratings">
								<span>
									<img alt="" src="<?php echo $this->webroot; ?>images/dash_likes.svg">
									<i id="rateing"><?php echo number_format($users['User']['rating']);?></i>
								</span>
							</div>
							<div class="clearfix"></div>
							<!--<p class="verified"><span><?php if($users['User']['status']==1) { ?><img src="<?php echo $this->webroot;?>images/verified-symbol.png" alt=""></span>Verified User<?php } ?></p>-->
							<p class="location"><?php if($users['Country']['name']!='') {echo $users['Country']['name'].' , '.$users['Country']['code_2'];}?></p>
							<p class="followers"><?php echo $followers; ?> Followers </p>
							<div class="clearfix"></div>
                                                         <?php 
                                                         if($user_id!=$userid2)
                                                         {
                                                         if(!empty($user_id))
                                                                            { ?>
                                                        <button class="follow start_follow" style="<?php echo ($is_following?'display:none;':''); ?>" onclick="follow_user()">Follow</button>
                                                        
                                                        <button class="follow already_followed" style="<?php echo (!$is_following?'display:none;':''); ?>" onclick="unfollow_user()">Following</button>
                                                                            <?php } 
                                                                            else
                                                                            { ?>
                                                                                <button class="follow start_follow" data-toggle="modal" data-target="#modal_success_fav">Follow</button>
                                                                            <?php }
                                                                            if(!empty($user_id))
                                                                            { ?>
							<a href="javascript:void(0)" data-toggle="modal" data-target="#report_modal_test" class="flow_click" ><img alt="" src="<?php echo $this->webroot; ?>images/dots.svg" style="width:27px;height:auto;"></a>
                                                        <?php
                                                                            }
                                                                            else
                                                                            { ?>
                                                        <a href="javascript:void(0)" onclick="open_favmodal()" class="flow_click" ><img alt="" src="<?php echo $this->webroot; ?>images/dots.svg" style="width:27px;height:auto;"></a>
                                                         <?php } } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="dashboard-links">
		<div class="container">
			<div class="row">
				<div class="col-md-10 col-md-offset-2 col-sm-11 col-sm-offset-1">
					<ul role="tablist" class="nav nav-tabs home-wrap-tab">
					    <li class="active" role="presentation"><a href="#" data-toggle="tab">Posts <span>(<?php echo count($posts);?>)</span></a></li>
					    <li role="presentation"><a href="#" data-toggle="tab">Following <span>(10)</span></a></li>
					    <li role="presentation"><a href="<?php echo $this->webroot;?>users/favorites/<?php echo base64_encode($userid2)?>" >Favorites<span>(<?php echo $fav;?>)</span></a></li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	
	<section class="inner-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="dashboard-wrapper">
						<!--<h3>In Search Of</h3>-->
						<!--<div class="dashboard-slider">
							<ul class="bxslider">
								<li>
									<div class="product-title-area yellow-title">
										<h4>Apple Wireless K...</h4>
										<p>Fashion & Accesories  |  Fixed Price</p>
									</div>
									<div class="product-price">$40</div>
									<div class="main-image">
										<img src="<?php echo $this->webroot;?>images/product-1.jpg" alt="">
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i> 17 miles - Fulton, GA</p>
											<p><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i> Just now</p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
								</li>
								<li>
									<div class="product-title-area pink-title">
										<h4>Apple Wireless K...</h4>
										<p>Fashion & Accesories  |  Fixed Price</p>
									</div>
									<div class="product-price">$40</div>
									<div class="main-image">
										<img src="<?php echo $this->webroot;?>images/product-1.jpg" alt="">
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i> 17 miles-Fulton, GA</p>
											<p><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i> Just now</p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
								</li>
								<li>
									<div class="product-title-area green-title">
										<h4>Apple Wireless K...</h4>
										<p>Fashion & Accesories  |  Fixed Price</p>
									</div>
									<div class="product-price">$40</div>
									<div class="main-image">
										<img src="<?php echo $this->webroot;?>images/product-1.jpg" alt="">
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i> 17 miles-Fulton, GA</p>
											<p><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i> Just now</p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
								</li>
								<li>
									<div class="product-title-area blue-title">
										<h4>Apple Wireless K...</h4>
										<p>Fashion & Accesories  |  Fixed Price</p>
									</div>
									<div class="product-price">$40</div>
									<div class="main-image">
										<img src="<?php echo $this->webroot;?>images/product-1.jpg" alt="">
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i> 17 miles-Fulton, GA</p>
											<p><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i> Just now</p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
									<div class="found"><img src="<?php echo $this->webroot;?>images/found.png" alt="" class="img-responsive"></div>
								</li>
								<li>
									<div class="product-title-area yellow-title">
										<h4>Apple Wireless K...</h4>
										<p>Fashion & Accesories  |  Fixed Price</p>
									</div>
									<div class="product-price">$40</div>
									<div class="main-image">
										<img src="<?php echo $this->webroot;?>images/product-1.jpg" alt="">
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i> 17 miles-Fulton, GA</p>
											<p><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i> Just now</p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
								</li>
								<li>
									<div class="product-title-area yellow-title">
										<h4>Apple Wireless K...</h4>
										<p>Fashion & Accesories  |  Fixed Price</p>
									</div>
									<div class="product-price">$40</div>
									<div class="main-image">
										<img src="<?php echo $this->webroot;?>images/product-1.jpg" alt="">
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i> 17 miles-Fulton, GA</p>
											<p><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i> Just now</p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
								</li>
							</ul>
						</div>-->
						<h3>In Search Of</h3>
						<div class="dashboard-slider">
							
							<?php if(count($posts)>0)
							{
							?>
							<ul class="bxslider">


							<?php
							foreach($posts as $post)
							{
									$date1=date_create($post['Post']['post_date']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
							?>
								
								<a href="<?php echo $this->webroot;?>posts/post_details/<?php echo $post['Post']['id'];?>" onclick="post_view(<?php echo $post['Post']['id']?>)">
								<li>
									
									<div class="product-title-area yellow-title">
										<h4><?php echo (isset($post['Post']['post_title']) && strlen($post['Post']['post_title'])<=15 )?ucfirst($post['Post']['post_title']):ucfirst(substr($post['Post']['post_title'],0,13)).'...';?></h4>
										<p><?php echo $post['Category']['category_name'];?> | Fixed Price</p>
									</div>
									<div class="product-price">$<?php echo number_format($post['Post']['price']);?></div>
									<div class="main-image">
										<?php if($post['PostImage']['0']['originalpath']!='')
										{
										?>
										<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $post['PostImage']['0']['originalpath']; ?>" alt="">
										<?php
										}
										else
										{
											?>
											<img src="<?php echo $this->webroot; ?>images/noimage.png" alt="">
											<?php
										}
											?>
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i><?php echo $post['Post']['location'];?></p>
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i><?php if($diff->days==0){ ?> Just now<?php }else if($diff->days==1){ echo ' '.$diff->days.' '.'Day ago';}else{ echo ' '.$diff->days.' '.'Days ago'; } ?></p>
										</div>
										<div class="right-side">
											<!--<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>-->
										</div>
									</div>
									
								</li>
								</a>

							
							<?php
							}
							?>

							
								
							
							</ul>
							<?php } else {?>
							<center><div style="margin-bottom:10%; font-size:20px;">
								There are no post found
							</div></center>
						<?php } ?>

						</div>


                       <!--My Offer-->
                       <h3>My Offers</h3>
						<div class="dashboard-slider">
							
							<?php if(count($offers)>0)
							{
							?>
							<ul class="bxslider">


							<?php
							foreach($offers as $offer)
							{
									$date1=date_create($offer['Post']['post_date']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
							?>
								
								
								<li>

									<a href="<?php echo $this->webroot;?>posts/offer_details/<?php echo $offer['Post']['id'];?>" onclick="offer_view(<?php echo $offer['Post']['id']?>)">
									
									<div class="product-title-area yellow-title">
										<h4><?php echo (isset($offer['Post']['post_title']) && strlen($offer['Post']['post_title'])<=15 )?ucfirst($offer['Post']['post_title']):ucfirst(substr($offer['Post']['post_title'],0,13)).'...';?></h4>
										<p><?php echo $offer['Category']['category_name'];?> | Fixed Price</p>
									</div>
									<div class="product-price">$<?php echo number_format($offer['Post']['price']);?></div>
									<div class="main-image">
										<?php if($offer['PostImage']['0']['originalpath']!='')
										{
										?>
										<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $offer['PostImage']['0']['originalpath']; ?>" alt="">
										<?php
										}
										else
										{
											?>
											<img src="<?php echo $this->webroot; ?>images/noimage.png" alt="">
											<?php
										}
											?>
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i><?php echo $offer['Post']['location'];?></p>
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot;?>images/clock.png" alt=""></i><?php if($diff->days==0){ ?> Just now<?php }else if($diff->days==1){ echo ' '.$diff->days.' '.'Day ago';}else{ echo ' '.$diff->days.' '.'Days ago'; } ?></p>
										</div>
										<div class="right-side">
											<!--<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>-->
										</div>
									</div>

									</a>
									
								</li>
								

							
							<?php
							}
							?>

							
								
							
							</ul>
							<?php } else {?>
							<center><div style="margin-bottom:10%; font-size:20px;">
								There are no offer found
							</div></center>
						<?php } ?>

						</div>

						<!--My Offer-->




					</div>
				</div>
			</div>
		</div>
	</section>

	<!--##################Report Modal########################-->
        <div class="modal fade modal_small_width" id="report_modal_test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_second">
                        <div class="media-left">
                          <a href="#">
                              <?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" class="img-responsive" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt="" class="img-responsive"><?php } ?>
<!--                            <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/girl2.png">-->
                            <span></span>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h4>
                          <div class="seller_ratings">
                                      <span>
                                              <img alt="" src="<?php echo $this->webroot; ?>images/thumb.svg">
                                              <i id="rateing"><?php echo number_format($users['User']['rating']);?></i>
                                      </span>
                              </div>
                          <p><?php echo $followers; ?> Followers</p>
                        </div>
                    </div>
                </div>
                <div class="modal-body report_this">
                        <span style="text-align:left">More Options</span>
                        <button class="gray text-left" data-target="#report_user_modal" data-toggle="modal" data-dismiss="modal" >Report User</button>
                        <button class="gray text-left block-btn <?php echo ($is_blocked?'no-display':''); ?>" data-dismiss="modal" onclick="block_user()">Block This User</button>
                        <button class="gray text-left unblock-btn <?php echo (!$is_blocked?'no-display':''); ?>" data-dismiss="modal" onclick="unblock_user()">Unblock This User</button>
                        <button class="gray text-left" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
        </div>
        <!--##################Report Modal########################-->
        
        <!--##################Report Modal########################-->
        <div class="modal fade modal_small_width" id="report_user_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_second">
                        <div class="media-left">
                          <a href="#">
                              <?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" class="img-responsive" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt="" class="img-responsive"><?php } ?>
<!--                            <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/girl2.png">-->
                            <span></span>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h4>
                          <div class="seller_ratings">
                                      <span>
                                              <img alt="" src="<?php echo $this->webroot; ?>images/thumb.svg">
                                              <i id="rateing"><?php echo number_format($users['User']['rating']);?></i>
                                      </span>
                              </div>
                          <p><?php echo $followers; ?> Followers</p>
                        </div>
                    </div>
                </div>
                <div class="modal-body report_this">
                        <span style="text-align:left">Why do you want to report this user?</span>
                        <button class="gray text-left" data-dismiss="modal" onclick="show_report_optional(1)">Inappropriate Photo</button>
                        <button class="gray text-left" data-dismiss="modal" onclick="show_report_optional(2)">Inappropriate Message</button>
                        <button class="gray text-left" data-dismiss="modal" onclick="show_report_optional(3)">Feels Like Spam</button>
                        <button class="gray text-left" data-dismiss="modal" onclick="show_report_optional(4)">Uses offensive language</button>
                        <button class="gray text-left" data-dismiss="modal" onclick="show_report_optional(5)">Other</button>
                </div>
              </div>
            </div>
        </div>
        <!--##################Report Modal########################-->
        
        <!--##################Report Final Modal########################-->
        <div class="modal fade modal_small_width" id="report_final_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_second">
                        <div class="media-left">
                          <a href="#">
                              <?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" class="img-responsive" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt="" class="img-responsive"><?php } ?>
<!--                            <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/girl2.png">-->
                            <span></span>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h4>
                          <div class="seller_ratings">
                                      <span>
                                              <img alt="" src="<?php echo $this->webroot; ?>images/thumb.svg">
                                              <i id="rateing"><?php echo number_format($users['User']['rating']);?></i>
                                      </span>
                              </div>
                          <p><?php echo $followers; ?> Followers</p>
                        </div>
                    </div>
                </div>
                <div class="modal-body media_modal_body">
                    <form method="post" id="post_report_form">
                        <span>Additional notes (Optional)</span>
                        <input type="hidden" id="final_report_type" name="data[UserReport][type]">
                        <input type="hidden" name="data[UserReport][user_to]" value="<?php echo $users['User']['id'];?>">
                        <textarea name="data[UserReport][notes]" id='report_form_note'></textarea>
                        <button class="btn_gens" type="button" onclick="save_report()">Report</button>
                    </form>
                </div>
              </div>
            </div>
        </div>
        <!--##################Report Final Modal########################-->
        
        <!--################## Reported Success Modal ##################-->
        <div class="modal fade modal_small_width" id="report_success_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_second">
                        <div class="media-left">
                          <a href="#">
                              <?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" class="img-responsive" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt="" class="img-responsive"><?php } ?>
<!--                            <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/girl2.png">-->
                            <span></span>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h4>
                          <div class="seller_ratings">
                                      <span>
                                              <img alt="" src="<?php echo $this->webroot; ?>images/thumb.svg">
                                              <i id="rateing"><?php echo number_format($users['User']['rating']);?></i>
                                      </span>
                              </div>
                          <p><?php echo $followers; ?> Followers</p>
                        </div>
                    </div>
                          
                </div>
                <div class="modal-body reported">
                          <h4>Reported</h4>
                          <img alt="" src="<?php echo $this->webroot; ?>images/report_big.svg">
                          <span>Thank you for taking the time to let us know</span>
                </div>
              </div>
            </div>
        </div>
        <!--################## Reported Success Modal ##################-->
        
        
         <!--################## Block Success Modal ##################-->
        <div class="modal fade modal_small_width" id="block_success_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_second">
                        <div class="media-left">
                          <a href="#">
                              <?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" class="img-responsive" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt="" class="img-responsive"><?php } ?>
<!--                            <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/girl2.png">-->
                            <span></span>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h4>
                          <div class="seller_ratings">
                                      <span>
                                              <img alt="" src="<?php echo $this->webroot; ?>images/thumb.svg">
                                              <i id="rateing"><?php echo number_format($users['User']['rating']);?></i>
                                      </span>
                              </div>
                          <p><?php echo $followers; ?> Followers</p>
                        </div>
                    </div>
                          
                </div>
                <div class="modal-body reported">
                    <h4>Blocked</h4>
                    <img alt="" src="<?php echo $this->webroot; ?>images/block.svg">
                    <span>This user will not be able to see your profiles,posts or offers</span>
                </div>
              </div>
            </div>
        </div>
        <!--################## Block Success Modal ##################-->

        <div class="modal fade" id="modal_success_fav" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  aria-label="Close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                        <!--data-dismiss="modal"-->
                        
                    </div>
                    <div class="modal-body sucess_sec" style="padding-top:0">
                        <!--<div class="sucs_img">
                        	<img src="<?php echo $this->webroot; ?>/images/sucses.svg" alt="">
                        </div>-->
                        <p>To see more option please Login.</p>
                        <!--<ul class="social_links">
							<li class="fb">
								<a class="fa fa-facebook" href=""></a>
							</li>
							<li class="gpls">
								<a class="fa fa-google-plus" href=""></a>
							</li>
							<li class="twit">
								<a class="fa fa-twitter" href=""></a>
							</li>
						</ul>-->
						<span><a href="javascript:void(0)" data-dismiss="modal" id="loginfavclose">Login here</a></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Login modal -->
        
       
	
    <script src="<?php echo $this->webroot;?>/js/jquery.min.js"></script>
    <script src="<?php echo $this->webroot;?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->webroot;?>/js/jquery.bxslider.js"></script>
    <script>
    	$(document).ready(function(){
    		$('.bxslider').bxSlider({
			  minSlides: 1,
			  maxSlides: 5,
			  slideWidth: 194,
			  slideMargin: 15
			});
                        
                        $('#loginfavclose').click(function (e) {
                e.preventDefault();

                $('#modal_success_fav')
                        .modal('hide')
                        .on('hidden.bs.modal', function (e) {
                            $('#Login').modal('show');

                            $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                        });

                });
               
    	});
    </script>
    
    <script>
    	$(document).ready(function(){
    		$('#list').on('click', function(){
			    $('.product-list').removeClass('grid').addClass('list');
			});
			$('#grid').on('click', function(){
			    $('.product-list').removeClass('list').addClass('grid');
			});
    	});
        function save_report(){
         
          $.ajax({
              type:'POST',
              url:'<?php echo $this->webroot.'user_reports/ajax_save'; ?>',
              dataType:'json',
              data:{data:{UserReport:{type:$('#final_report_type').val(),user_to:<?php echo $users['User']['id'];?>,notes:$('#report_form_note').val()}}},
              success:function(data){
                  $('#report_form_note').val('');
                  $('#report_final_modal').modal('hide');
                  $('#report_success_modal').modal('show');
              }
          })
      }
      
      function block_user(){
         
          $.ajax({
              type:'POST',
              url:'<?php echo $this->webroot.'user_blocks/ajax_save'; ?>',
              dataType:'json',
              data:{data:{UserBlock:{user_to:<?php echo $users['User']['id'];?>}}},
              success:function(data){
                  $('#report_modal_test').modal('hide');
                  $('#block_success_modal').modal('show');
                  
                  $('.block-btn').hide();
                  $('.unblock-btn').show();
                  //$('.modal-backdrop').remove();
              }
          })
      }
      
      function unblock_user(){
            $.ajax({
              type:'POST',
              url:'<?php echo $this->webroot.'user_blocks/ajax_unblock'; ?>',
              dataType:'json',
              data:{data:{UserBlock:{user_to:<?php echo $users['User']['id'];?>}}},
              success:function(data){
                  $('#report_modal_test').modal('hide');
                  //$('#block_success_modal').modal('show');
                  
                  $('.block-btn').show();
                  $('.unblock-btn').hide();
                  //$('.modal-backdrop').remove();
              }
          })
      }
      
      function follow_user()
      {
          $.ajax({
              type:'POST',
              url:'<?php echo $this->webroot.'follows/ajax_follow'; ?>',
              dataType:'json',
              data:{data:{Follow:{user_to:<?php echo $users['User']['id'];?>}}},
              success:function(data){
                  $('.start_follow').hide();
                  $('.already_followed').show();
                  //alert('success');
                  //$('.modal-backdrop').remove();
              }
          })
      }
      
      function unfollow_user()
      {
          $.ajax({
              type:'POST',
              url:'<?php echo $this->webroot.'follows/ajax_unfollow'; ?>',
              dataType:'json',
              data:{data:{Follow:{user_to:<?php echo $users['User']['id'];?>}}},
              success:function(data){
                  $('.start_follow').show();
                  $('.already_followed').hide();
                  //alert('success');
                  //$('.modal-backdrop').remove();
              }
          })
      }
    </script>

    <script>
        function show_report_optional(t)
        {
            $('#final_report_type').val(t);
            $('#report_final_modal').modal('show');
        }
				function post_view(aa)
				{
					
					 location.href="<?php echo $this->webroot?>posts/post_view/"+aa;
				}

				function offer_view(aa)
				{
					
					 location.href="<?php echo $this->webroot?>posts/offer_view/"+aa;
				}
                                function open_favmodal()
                                {

                                    $("#modal_success_fav").modal('show');

                                }
				</script>

    <style>
    .bx-prev.disabled {
    display: none !important;
}
    .already_followed
    {
        background-color: rgb(133,195,54) !important; 
    }
    .no-display
    {
        display: none;
    }
    </style>
</body>

</html>
