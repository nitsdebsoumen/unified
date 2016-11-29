<?php
//pr($catg['0']);
//echo ($posts['PostImage'][0]['originalpath']);
//echo timezone_name_from_abbr("CET") . "\n";?>


<?php
$userid = $this->Session->read('user_id');
$offset=$this->Session->read('timezone');
//echo $offerlike_count;
//pr($posts);
//echo $posts['User']['UserImage']['0']['originalpath'];
//pr($postcomment);
//echo $postcomment[0]['Post']['id'];
//echo $img['UserImage']['originalpath'];
//pr($postoffer1);
//$posts['Post']['user_id'];
//echo $_REQUEST['id'];
$link =Configure::read('SITE_URL').'posts/offer_details/'.$posts['Post']['id'];

?>
<script src="<?php echo $this->webroot;?>/js/jquery.min.js"></script>
<script src="<?php echo $this->webroot; ?>bower_components/moment/moment.js"></script>
<script src="<?php echo $this->webroot; ?>bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" /> 

<script src="<?php echo $this->webroot; ?>clipboard/dist/clipboard.min.js"></script>
<link href="<?php echo $this->webroot;?>css/lc_switch.css" rel="stylesheet" type="text/css">
<style>
    .overflow-visible
    {
        overflow: visible !important;
    }
</style>
<section class="inner-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-9 middle-div">
					<div class="row">
						<div class="col-md-8 col-sm-7">
							<div class="left-details">
								<div class="detailes-slider">
									<ul class="bxslider">
										<?php 
										
										?>
										<?php
										//foreach($postimgs as $img)
										//{
										?>
										<!--<li style="background: url('<?php echo $this->webroot;?>/img/post_img/<?php echo $img['PostImage']['originalpath'];?>');background-size: cover;background-position: center center;background-repeat: no-repeat;"></li>-->
										<?php
									    //}
										?>

										<?php
										if($posts['PostImage'])
										{
										foreach($posts['PostImage'] as $img)
										{
										?>
										<li style="background: url('<?php echo $this->webroot;?>/img/post_img/<?php echo $img['originalpath'];?>');background-size: cover;background-position: center center;background-repeat: no-repeat;"></li>
										<?php
									    }
									}
									else
									{
										?>
										<li><img src="<?php echo $this->webroot;?>images/slider-1.jpg" alt=""/></li>
										<?php
									}
										?>
										<!--<li><img src="<?php echo $this->webroot;?>images/slider-1.jpg" alt=""/></li>
										<li><img src="<?php echo $this->webroot;?>images/slider-1.jpg" alt=""/></li>
										<li><img src="<?php echo $this->webroot;?>images/slider-1.jpg" alt=""/></li>-->
									</ul>
									<!--<div class="found"><img src="<?php echo $this->webroot;?>images/found.png" alt="" class="img-responsive"></div>-->
									<div class="search-of" style="background-color: rgba(234, 209, 66, 0.8) !important;"> I Have It! </div>
								</div>
								<div class="full-prod-details">
									<div class="row">
										<div class="col-sm-7">
											<h1 class="prod-title pull-left"><?php echo $posts['Post']['post_title'];?></h1>
											
											<!--<i class="thumb yellow fa fa-thumbs-o-up"></i>-->
										</div>
										<div class="col-sm-5">	
											<h1 class="prod-title text-right" style="margin-bottom: 0">$<?php echo number_format($posts['Post']['price']);?></h1>
											<small class="negotiable">Negotiable</small>
										</div>
									</div>
									<div class="location-dtl">
										<p><span><img src="<?php echo $this->webroot;?>images/mile.png" alt=""></span> 5 miles - <?php echo $posts['Post']['location'];?></p>
										<?php



										$date1=date_create($posts['Post']['post_date']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
										?>
										<p><span><img src="<?php echo $this->webroot;?>images/time.png" alt=""></span> <?php if($diff->days==0){ ?> Just now<?php }else if($diff->days==1){ echo ' '.$diff->days.' '.'Day ago';}else{ echo ' '.$diff->days.' '.'Days ago'; } ?></p>
									</div>
									<div class="viewers-dlts">
										<b id="offerlike_count" style="margin-left: 5px;"><?php echo $offerlike_count;?></b>
										<?php if($userid!='')
											{
											if($offerlikeuser==1)
											{
												$likeclass="fa-thumbs-up";
											} 
											else
											{
												$likeclass="fa-thumbs-o-up";
											}
											?>
											<i class="thumb yellow fa <?php echo $likeclass;?>" onclick="offer_likes('<?php echo $posts['Post']['id']; ?>')"></i>
											<?php
										    }
										    else
										    {
											?>
											<i class="thumb yellow fa fa-thumbs-o-up" onclick="open_mssgmodal()"></i>
											<?php
										    }
											?>
											
										<b><span><img src="<?php echo $this->webroot;?>images/eye.png" alt=""><?php echo ' '.$postview_totcount;?></span></b>
										<b><span><?php 
										if($userid!='')
										{
										//if(($posts['Post']['user_id']!=$userid)) 
										   //{
										   	if($postfavuser_count==0)
										   	{
										 ?>
											<span id="fav_color"><a href="javascript:void(0);" onclick="offer_fav('<?php echo $posts['Post']['id'];?>')"><img src="<?php echo $this->webroot;?>images/favorite-grey.svg" alt="" style="width:19px"></a></span>
									  <?php  }
									        else
									         { ?>
									     <a href="javascript:void(0);"><img src="<?php echo $this->webroot;?>images/favorite-red.svg" alt="" style="width:19px"></a>
									         <?php } 
										      // else 
										       	  //{?>
											      <!--<a href="javascript:void(0);"><img src="<?php //echo $this->webroot;?>images/heart.png" alt=""></a>-->
											<?php //} 
										 } 
										   else 
											 {?>
											    <a href="javascript:void(0);" onclick="open_favmodal()"><img src="<?php echo $this->webroot;?>images/heart.png" alt=""></a>
									   <?php } ?>
											<span id="fav_count"><?php if(isset($postfav_count)) { echo ' '.$postfav_count; } ?></span></span></b>
										<!--<b><span><img src="<?php echo $this->webroot;?>images/comment.png" alt=""> 5</span></b>-->
									</div>
									<hr>
									<div class="prod-descr-full">
										<h4>Description</h4>	
										<div id="nontot_desc" >	
										<p><?php 
										
										echo (isset($posts['Post']['post_description']) && strlen($posts['Post']['post_description'])<=180 )?ucfirst($posts['Post']['post_description']):ucfirst(substr($posts['Post']['post_description'],0,178)).'<br>...<a href="javascript:void(0);" onclick="post_fulldescription()">More</a>';
										?></p>

									</div>

									<div id="tot_desc" style="display:none;">	
										<p><?php 
										echo $posts['Post']['post_description'];
										
										?><br><a href="javascript:void(0);" onclick="post_description()">Less</a></p>

									</div>
									</div>
									<hr>
									<div class="prod-descr-full">
										<h4>About the Seller</h4>	
										<?php //echo $posts['Post']['post_description'];?>
										<?php
										$name_search=ucwords($posts['User']['first_name']).' '.ucwords($posts['User']['last_name']);
													$expname_search = explode(" ", $name_search);
                                                    $expname_search[1][0];
                                                    $searcher=ucwords($posts['User']['first_name']).' '.$expname_search[1][0];
										?>
										
											<a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $searcher.'/'.base64_encode($posts['User']['id']);?>"><div class="round_image_orderdetails">
												<!--<img src="<?php echo $this->webroot;?>images/user-image.jpg" alt="">-->
												<?php
												 if(!empty($posts['User']['UserImage']['0']['originalpath']) and file_exists(WWW_ROOT.'user_images/'.$posts['User']['UserImage']['0']['originalpath']))
												 {

												?>
												<img src="<?php echo $this->webroot;?>user_images/<?php echo $posts['User']['UserImage']['0']['originalpath'];?>" alt="">
										     <?php } 
										           else
										           {
										     	?>
										     	<img src="<?php echo $this->webroot;?>user_images/default.png" alt="">
										     	<?php
										           }
										     	?>
											</div></a>
											<div class="seller_des">
												<a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $searcher.'/'.base64_encode($posts['User']['id']);?>" style="color:#333; text-decoration:none;"><b><?php echo $posts['User']['first_name'].' '.$posts['User']['last_name']?></b></a>
												<span><img src="<?php echo $this->webroot;?>images/tag.svg" alt=""><?php if($posts['User']['status']==1) {?>Verified User<?php } ?></span>
											</div>
											<div class="seller_ratings">
												<b>Rating</b>
												<span>
													<img src="<?php echo $this->webroot;?>images/thumb.svg" alt="">
													<i id="rateing"><?php echo ($posts['User']['rating']==''?0:$posts['User']['rating']);?></i>
												</span>
											</div>
											<!--<div class="location-dtl">
												fhjsdgfjhsdfgjdhsfg
												</div>-->
					
										<!--<a href="">More...</a>-->
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 col-sm-5">
							<div class="mange-my-post">
								<div class="green-title" style="background-color: rgba(234, 209, 66, 0.8);">Manage My Post</div>
								<div class="mange-my-post-holder">
									<ul class="social_links">
										<li class="fb">

											<a href="javascript:void()" onclick="popWindow('http://www.facebook.com/sharer.php?u=<?php echo $link;?>','Facebook','500','400')" class="fa fa-facebook"></a>

										</li>
										<li class="gpls">
											
											<a href="javascript:void()" onclick="popWindow('http://plus.google.com/share?url=<?php echo $link;?>','GooglePlus','500','400')" class="fa fa-google-plus"></a>


										</li>
										<li class="twit">
											
											<a href="javascript:void()" onclick="popWindow('http://twitter.com/share?url=<?php echo $link;?>','Twitter','500','258')" class="fa fa-twitter"></a>

										</li>
									</ul>									
								</div>
								<ul class="quick_report">
									<li>
										<?php if(!empty($userid))
                                                                            { ?>
                                                                                <a href="javascript:void(0);" data-toggle="modal" data-target="#report_modal_test"><img src="<?php echo $this->webroot;?>images/report.svg" alt=""><span>Report</span></a>
                                                                            <?php
                                                                            } else
                                                                            { ?>
                                                                                <a href="javascript:void(0);" onclick="open_favmodal()"><img src="<?php echo $this->webroot;?>images/report.svg" alt=""><span>Report</span></a>
                                                                            <?php } ?>
									</li>
									<li>
										<?php 
										if($userid!='')
										{
										
										   	if($postfavuser_count==0)
										   	{
										 ?>
											<span id="fav_big_color"><a href="javascript:void(0);" onclick="offer_fav('<?php echo $posts['Post']['id'];?>')"><img src="<?php echo $this->webroot;?>images/favorite-grey.svg" alt="" style="width:26px"></a></span>
									  <?php  }
									        else
									         { ?>
									     <a href="javascript:void(0);"><img src="<?php echo $this->webroot;?>images/favorite-red.svg" alt="" style="width:26px"></a>
									         <?php } 
										     ?>
											      
											<?php 
										 } 
										   else 
											 {?>
											    <a href="javascript:void(0);" onclick="open_favmodal()"><img src="<?php echo $this->webroot;?>images/favorite-grey.svg" alt="" style="width:26px"></a>
									   <?php } ?>
										<!--<a href=""><img src="<?php echo $this->webroot;?>images/favorite_gray.svg" alt="">-->
										<span>Favorite</span></a>
									</li>
									<li>
										<a href="javascript:void(0);" data-toggle="modal" data-target="#share_modal"><img src="<?php echo $this->webroot;?>images/share.svg" alt="">
										<span>Share</span></a>
									</li>
								</ul>
							</div>
							<!--<div class="mange-my-post">
								<div class="green-title">Manage My Post</div>
								<div class="mange-my-post-holder">
									<p>
									<span>Found it: </span>
									<input type="checkbox" name="check-3" value="6" class="lcs_check lcs_tt1" checked="checked" autocomplete="off" /></p>
									
					<a href="javascript:void(0);" class="btn pink-border-btn btn-block" onclick="editPostModalOpen(<?php echo $posts['Post']['id'];?>)">Edit Post</a>
									<a href="javascript:void(0);" class="btn pink-bg-btn btn-block" onclick="del(<?php echo $posts['Post']['id']?>)">Delete Post</a>
									
								</div>
							</div>-->
							
							

							

							<!--<a data-toggle="modal" data-target="#AddOffer" href="javascript:void(0)" style="text-decoration:none;"><div class="green-title" style="border-radius: 7px;">Accept Offer</div></a>-->
							


							



							<div class="comment-offers">
								<div class="green-title" style="background-color: rgba(234, 209, 66, 0.8);"><?php echo $postcomment_count;?><?php if($postcomment_count>1) {?> Comments<?php } else {?> Comment<?php } ?><!-- - <?php echo $postoffer_count;?>--><!--<?php if($postoffer_count>1) {?> Offers<?php } else {?> Offer<?php } ?>--></div>
								<ul class="comment-ul">
								<?php
								if($postcomment)
								{
								foreach($postcomment as $comment)
								{
								?>	
									<li>
										<div class="side-left">
											<div class="round-image">
												<!--<img src="<?php echo $this->webroot;?>user_images/<?php //echo $this->requestAction('/posts/user_image/'.base64_encode($comment['PostComment']['user_id']));?>" alt="">-->
												<?php
												if(isset($comment['User']['UserImage']['0']['originalpath']) && $comment['User']['UserImage']['0']['originalpath']!='')
												{
												?>
												<img src="<?php echo $this->webroot;?>user_images/<?php echo $comment['User']['UserImage']['0']['originalpath'];?>" alt="">
												<?php
											}
											else
											{
												?>
												<img src="<?php echo $this->webroot;?>user_images/default.png" alt="">
												<?php
											}
												?>
											</div>
										</div>
										<div class="side-right">
											<div class="part-1">
												<p class="auth-name"><?php 
												    $name1=ucwords($comment['User']['first_name']).' '.ucwords($comment['User']['last_name']);
													$expname1 = explode(" ", $name1);
                                                    $expname1[1][0];
                                                    echo ucwords($comment['User']['first_name']).' '.$expname1[1][0];
												//echo ucwords($comment['User']['first_name']).' '.ucwords($comment['User']['last_name']);?></p>
												<!--<p class="have-it">I have it</p>-->
											</div>
											<div class="part-2">
												<p class="mint"><i class="fa fa-clock-o"></i><?php echo ' '.date("jS \of F Y h:i A",strtotime($comment['PostComment']['date']));?></p>
												<!--<?php //echo $this->requestAction('/posts/how_log_ago/'.base64_encode($comment['PostComment']['date']));?>-->
												
											</div>
											<div class="clearfix"></div>
											<p class="comment"><?php echo $comment['PostComment']['message'];?></p>
										</div>
									</li>
									<?php
								  }
								}
								else
								{
									?>
									<li>
										No Comments..
									</li>
									<?php
								}
									?>
									<?php
									if($userid!='')
									{
									?>
									<form name="frmcomment" method="post" action="<?php echo $this->webroot;?>posts/offer_details/<?php echo $posts['Post']['id'];?>">
										
									<li>
										<div class="type-a-msg">
											<form class="form-inline">
											<div class="form-group"> 
												<input type="text" name="data[message]" placeholder="Type a Message"  class="form-control">
												<input type="hidden" name="data[post_id]" value="<?php echo $posts['Post']['id'];?>">

												
											</div>

											

											<button class="btn" type="submit" name="comment_submit" style="background-color: rgba(234, 209, 66, 0.8);"><i><img src="<?php echo $this->webroot;?>images/aeroplane.png" alt="" ></i></button> 
											
										</form>
										</div>
									</li>
									
								</form>

								<?php
							}
							else
							{
							?>	
									<li>
										<div class="type-a-msg">
											
											<div class="form-group"> 
												<input type="text" name="data[message]" placeholder="Type a Message"  class="form-control">
												<input type="hidden" name="data[post_id]" value="<?php echo $posts['Post']['id'];?>">

												
											</div>

											

											<button class="btn" onclick="comment_modalopen()" style="background-color: rgba(234, 209, 66, 0.8);"><i><img src="<?php echo $this->webroot;?>images/aeroplane.png" alt="" ></i></button> 
											
										
										</div>
									</li>
									
								
							<?php
						}
							?>
								

								
								</ul>
							</div>  


							<!--<div style="height:25px;"></div>-->


							<?php
							if($posts['Post']['user_id']==$userid)
							{
							?>

							<a data-toggle="modal" data-target="#AddOffer" href="javascript:void(0);" class="btn pink-bg-btn btn-block" style="background-color: rgba(234, 209, 66, 0.8);" onclick="subcat_sel(); get_offerid(<?php echo $posts['Post']['id']?>); editmodal_offer(<?php echo $posts['Post']['id']?>);">Edit Offer</a>


							<!--style="background-color:#31CCC5"-->
							<!--<a href="javascript:void(0);" class="btn pink-border-btn btn-block" >Decline</a>-->
							<?php
						}

						else if($postoffer1['Post']['user_id']==$userid)
							{

							?>
							<a href="javascript:void(0);" data-toggle="modal" data-target="#request_to_buy" class="btn pink-bg-btn btn-block" style="background-color: rgba(234, 209, 66, 0.8)">Request To Buy</a>
							<!--style="background-color:#31CCC5"-->
							<a href="<?php echo $this->webroot.'posts/message_chat/'.$posts['Post']['post_id'].'/'.$posts['Post']['id']; ?>" class="btn pink-border-btn btn-block" >Ask a Question</a>
							<?php
						}
							?>

							

							

							

							
						</div>

                         






					</div>
				</div>
			</div>
		</div>
	</section>


	        <!--########  ADD POST MODAL ######### -->
        <div class="modal fade" id="AddOffer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder ad-post-step-holder yellow-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Step <span id="stepNo_offer">1</span></h4>
                        <h4 class="modal-title-info">You have it? Offer it!</h4>
                    </div>
                    <ul class="nav nav-tabs step-tab" role="tablist">
                        
                        <li role="presentation" id="pli1_offer"  class="active" ><a aria-controls="AdPhto" role="tab" data-toggle="tab">Add a Photo</a></li>

                        <li role="presentation" id="pli2_offer" ><a aria-controls="PostDtail" role="tab" data-toggle="tab">Post Details</a></li>
                        <li role="presentation" id="pli3_offer"><a aria-controls="ConFrm" role="tab" data-toggle="tab">Confirm</a></li>
                    </ul>
                    <div class="modal-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                        	 <input type="hidden" name="post_id" id="post_id_offer" value="<?php echo $posts['Post']['id'];?>" >

                             <div role="tabpanel" id="pdiv1_offer" class="tab-pane fade in active">
                        	
                                <input type="hidden" name="postId" id="postId_offer" value="" >
                               
                                <div class="photo-adding-area">
                                <style>
                                    .preview{width:200px;border:solid 1px #dedede;padding:10px;}
                                    #preview{color:#cc0000;font-size:12px}
                                </style>
                                    <ul class="phto-add">

                                    	<!--<form id="existimg">
											
										</form>-->

                                        

                                        <form id="imageform_1" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage_offer/'>
                                        <li>
                                           

                                            <div id="preview_1">

                                            	<!--<img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt="">-->

                                            	<?php
												 if(!empty($posts['PostImage'][0]['originalpath']) and file_exists(WWW_ROOT.'/img/post_img/'.$posts['PostImage'][0]['originalpath']))
												 {

												?>

                                            	<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $posts['PostImage'][0]['originalpath'];?>" style="height:113px !important; width:113px !important;" alt="">
                                            	<?php
                                                 }
                                                 else
                                                 {
                                            	?>
                                            	<img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt="">
                                            	<?php
                                                 }
                                            	?>
                                            </div>
                                            <p><input type="file" name="photoimg_1" id="photoimg_1" /></p>
                                            <input type="hidden" name="postid" value="" >




                                        </li>
                                        </form>


                                        <form id="imageform_2" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage_offer/'>
                                        <li>
                                            
                                              <div id="preview_2">

                                              	<!--<img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt="">-->
                                              	<?php
												 if(!empty($posts['PostImage'][1]['originalpath']) and file_exists(WWW_ROOT.'/img/post_img/'.$posts['PostImage'][1]['originalpath']))
												 {

												?>

                                            	<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $posts['PostImage'][1]['originalpath'];?>" style="height:113px !important; width:113px !important;" alt="">
                                            	<?php
                                                 }
                                                 else
                                                 {
                                            	?>
                                            	<img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt="">
                                            	<?php
                                                 }
                                            	?>
                                              </div>
                                            <p><input type="file" name="photoimg_2" id="photoimg_2" /></p>
                                            
                                        </li>
                                        </form>


                                        <form id="imageform_3" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage_offer/'>
                                        <li>
                                          
                                              <div id="preview_3">

                                              	<!--<img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt="">-->
                                              	<?php
												 if(!empty($posts['PostImage'][2]['originalpath']) and file_exists(WWW_ROOT.'/img/post_img/'.$posts['PostImage'][2]['originalpath']))
												 {

												?>

                                            	<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $posts['PostImage'][2]['originalpath'];?>" style="height:113px !important; width:113px !important;" alt="">
                                            	<?php
                                                 }
                                                 else
                                                 {
                                            	?>
                                            	<img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt="">
                                            	<?php
                                                 }
                                            	?>
                                              </div>
                                            <p><input type="file" name="photoimg_3" id="photoimg_3" /></p>
                                        </li>
                                        </form>


                                        <form id="imageform_4" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage_offer/'>
                                        <li>
                                            

                                              <div id="preview_4">

                                              	<!--<img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt="">-->
                                              	<?php
												 if(!empty($posts['PostImage'][3]['originalpath']) and file_exists(WWW_ROOT.'/img/post_img/'.$posts['PostImage'][3]['originalpath']))
												 {

												?>

                                            	<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $posts['PostImage'][3]['originalpath'];?>" style="height:113px !important; width:113px !important;" alt="">
                                            	<?php
                                                 }
                                                 else
                                                 {
                                            	?>
                                            	<img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt="">
                                            	<?php
                                                 }
                                            	?>
                                              </div>
                                            <p><input type="file" name="photoimg_4" id="photoimg_4" /></p>
                                        </li>
                                        </form>


                                        <form id="imageform_5" method="post" enctype="multipart/form-data" action='<?=$this->Html->url('/')?>posts/ajaximage_offer/'>
                                        <li>
                                            
                                              <div id="preview_5">

                                              	<!--<img src="<?php echo $this->webroot; ?>images/add-photo2.jpg" height="100px" width="100px" alt="">-->
                                              	<?php
												 if(!empty($posts['PostImage'][4]['originalpath']) and file_exists(WWW_ROOT.'/img/post_img/'.$posts['PostImage'][4]['originalpath']))
												 {

												?>

                                            	<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $posts['PostImage'][4]['originalpath'];?>" style="height:113px !important; width:113px !important;" alt="">
                                            	<?php
                                                 }
                                                 else
                                                 {
                                            	?>
                                            	<img src="<?php echo $this->webroot; ?>images/add-photo2.svg" height="100px" width="100px" alt="">
                                            	<?php
                                                 }
                                            	?>
                                              </div>
                                            <p><input type="file" name="photoimg_5" id="photoimg_5" /></p>
                                        </li>
                                        </form>


                                    </ul>
                                    <div class="clearfix"></div>
                                    <!--<h4>Suggested Images</h4>
                                    <p><img src="<?php //echo $this->webroot; ?>images/round-tick.png" alt=""></p>-->
                                </div>
                                <div class="clearfix"></div>
                            </div>



                              <div role="tabpanel" id="pdiv2_offer" class="tab-pane" >
                                <form>
                                	<input type="hidden" value="" name="data[city]" id="postCityoffer">
                                <input type="hidden" value="" name="data[state]" id="postStateoffer">
                                <input type="hidden" value="" name="data[address]" id="postAddressoffer">
                                <input type="hidden" value="" name="data[country]" id="postCountryoffer">
                                <input type="hidden" value="" name="data[zip_code]" id="postZip_codeoffer">
                                    <div class="row">
                                        <div class="col-sm-8 middle-div">
                                            <!--<div class="form-group">
                                               
                                                <?php  //echo $this->Form->input('category_id',array('id'=> 'category_id_offer', 'label'=>false,'required'=>'required','class'=>'form-control','options'=>$catg,'empty'=>'--Select a Category (Required)--','onchange'=>'getsubcat()')); ?>
                                               
                                            </div>-->


                                             <div class="form-group">
                                                <select name="data[category_id]" id="category_id_offer" required="required" class="form-control" onchange="getsubcat()">
                                            <option value="">--Select a Category (Required)--</option>
                                            <option value="<?php echo $catgfirst['Category']['id']?>"><?php echo $catgfirst['Category']['category_name']?></option>
                                            <?php if(isset($catg))
                                            {
                                            foreach($catg as $k=>$v)
                                            {
                                                ?><option value="<?php echo $k;?>"><?php echo $v;?></option><?php
                                            }
                                        
                                            }
                                            ?>
                                       </select>        
                                                
                                                
                                            </div>

                                            

                                                <div class="form-group">
                                            	<select class="form-control" required="required" id="subcategory_id_offer" name="subcategory_id">
                                            		<option>--Select a SubCategory (Required)--</option>
                                            		
                          
                                            	
                                            	</select>
                                            </div>
                                         


                                            <div class="form-group">
                                               
                                                <?php echo $this->Form->input('post_title',array('id'=> 'post_title_offer', 'required'=>'required','placeholder'=>'Title Description (Required)','class'=>'form-control','label'=>false)); ?>
                                                <!--, 'value'=> $posts['Post']['post_title']-->
                                            </div>
                                            <!--<div class="form-group">
                                               
                                                <?php echo $this->Form->input('location',array('id'=> 'location_offer', 'required'=>'required','placeholder'=>'Location','class'=>'form-control','label'=>false)); ?>
                                                
                                            </div>-->
                                             <div class="form-group">
                                              
                                                <?php echo $this->Form->input('location',array('id'=> 'location_offer', 'required'=>'required','placeholder'=>'Location','class'=>'form-control','label'=>false,'onFocus'=>'geolocate_offer()')); ?>
                                            </div>
                                            <div class="form-group">
                                               
                                                <?php echo $this->Form->input('post_description', array('id'=> 'post_description_offer', 'type' => 'textarea', 'style' => 'height: auto' ,'label'=>false, 'class'=>'form-control', 'placeholder'=>'Product Description'));?>
                                                <!--, 'value'=> $posts['Post']['post_description']-->
                                                <small class="grey-text">150 characters max</small>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </form>
                            </div>
                           

                          
                            <div role="tabpanel" id="pdiv3_offer" class="tab-pane" id="ConFrm">
                                <form>
                                    <div class="row">
                                        <div class="col-sm-8 middle-div">
                                            <div class="form-group">
                                                <label>BUDGET</label>
                                                <input type="text" name="budget" id="budget_offer" class="form-control" placeholder="Enter $ Amount" value="<?php if(isset($posts['Post']['price']) && $posts['Post']['price']!='') { echo $posts['Post']['price'];}?>">
                                            </div>
                                            <div class="form-group" style="margin-bottom: 50px">
                                                <div class="form-control">
                                                    <div class="radio margin-top0">
                                                        <label>

                                                            <input type="radio" name="price_condition" id="price_condition_offer1" value="Fixed"> Fixed
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="price_condition" id="price_condition_offer2" value="Negotiable"> Negotiable
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="price_condition" id="price_condition_offer3" value="Trade"> Trade
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>PRODUCT CONDITION</label>
                                                <div class="form-control">
                                                    <div class="radio margin-top0">
                                                        <label>
                                                            <input type="radio" name="product_condition" id="product_condition_offer1" value="New"> New
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="product_condition" id="product_condition_offer2" value="Used"> Used
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <small class="grey-text" style="display: block; border-top:1px solid #e1e1e1; padding-top: 5px">By clicking 'Submit', you agree to abide by our listing rules and terms of use. You also agree to follow through on your listing regardless of the final bid amount. Users who are in violation of these terms may be suspended.</small>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <span id="postContinue_offer"><button type="button" class="btn btn-default btn-bordered" data-dismiss="modal" style="padding-right: 20px; padding-left:20px" >Skip</button>
                        <button type="button" onclick="savePost_offer('post1_offer')" class="btn btn-primary">Continue</button></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Post modal -->
        <!--########  ADD POST MODAL ######### -->


        <div class="modal fade" id="modal_success_offer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog log-holder">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  aria-label="Close" onclick="close_success_button()"><span aria-hidden="true">&times;</span></button>
                        <!--data-dismiss="modal"-->
                        
                    </div>
                    <div class="modal-body sucess_sec" style="padding-top:0">
                        <div class="sucs_img">
                        	<img src="<?php echo $this->webroot; ?>/images/sucses.svg" alt="">
                        </div>
                        <p>Your post will be reviewed andshould be live soon. Check back in.</p>
                        <ul class="social_links">
							<li class="fb">
								<a class="fa fa-facebook" href=""></a>
							</li>
							<li class="gpls">
								<a class="fa fa-google-plus" href=""></a>
							</li>
							<li class="twit">
								<a class="fa fa-twitter" href=""></a>
							</li>
						</ul>
						<span>Share this post on Social Media to show your offer!</span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Login modal -->


         <div class="modal fade" id="modal_success_postlike" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <p>To like this offer please Login.</p>
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
						<span><a href="javascript:void(0)" id="loginclose">Login here</a></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Login modal -->


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
                        <p>To report this offer please Login.</p>
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
						<span><a href="javascript:void(0)" id="loginfavclose">Login here</a></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Login modal -->



         <div class="modal fade" id="comment_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <p>Make a comment on this offer please Login</p>
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
						<span><a href="javascript:void(0)" id="logincommentclose">Login here</a></span>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.Login modal -->
        
        <!--##################Share Modal########################-->
        <div class="modal fade" id="share_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_img">
                        <div class="media-left">
                          <a href="javascript:void(0);">
                              <?php 
                                if($postimgs)
                                { ?>
                                    <img class="img-responsive" alt="" src="<?php echo $this->webroot;?>/img/post_img/<?php echo $postimgs['0']['PostImage']['originalpath'];?>"> <?php
                                } else 
                                { ?>
                                     <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/slider-1.jpg">
                                <?php } ?>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo $posts['Post']['post_title'];?></h4>
                          <p>$<?php echo number_format($posts['Post']['price']);?></p>
                          <span>by <a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $searcher.'/'.base64_encode($posts['User']['id']);?>"><?php echo $posts['User']['first_name'].' '.$posts['User']['last_name']; ?> </a></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body media_modal_body">
                  <span>To share this post with others, copy and paste this link:</span>
                  <input type="url" id="page_url" value="<?php echo Router::url(null, true ); ?>" readonly/>
                  <ul class="two_buttons_togather">
                                  <li><button class="btn_cancl" data-dismiss="modal">Cancel</button></li>
                                  <li><button class="btn_copy_clip" data-clipboard-target="#page_url">Copy to Clipboard</button></li>
                          </ul>
                </div>
              </div>
            </div>
        </div>
        <!--##################Share Modal########################-->
        <script>
            new Clipboard('.btn_copy_clip');
        </script>
        
        <!--##################Report Modal########################-->
        <div class="modal fade modal_small_width" id="report_modal_test" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <div class="media media_head_img">
                        <div class="media-left">
                          <a href="javascript:void(0);">
                              <?php 
                                if($postimgs)
                                { ?>
                                    <img class="img-responsive" alt="" src="<?php echo $this->webroot;?>/img/post_img/<?php echo $postimgs['0']['PostImage']['originalpath'];?>"> <?php
                                } else 
                                { ?>
                                     <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/slider-1.jpg">
                                <?php } ?>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo $posts['Post']['post_title'];?></h4>
                          <p>$<?php echo number_format($posts['Post']['price']);?></p>
                          <span>by <a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $searcher.'/'.base64_encode($posts['User']['id']);?>"><?php echo $posts['User']['first_name'].' '.$posts['User']['last_name']; ?> </a></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body report_this">
                          <span>Why do you want to report this Item?</span>
                          <button class="gray text-left" data-dismiss="modal" onclick="show_report_final(1)">Wrong Keyword</button>
                          <button class="gray text-left" data-dismiss="modal" onclick="show_report_final(2)">Offensive Item</button>
                          <button class="gray text-left" data-dismiss="modal" onclick="show_report_final(3)">Prohibited Item</button>
                          <button class="gray text-left" data-dismiss="modal" onclick="show_report_final(4)">Repetitive</button>
                          <button class="gray text-left" data-dismiss="modal" onclick="show_report_final(5)">Other</button>
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
                    <div class="media media_head_img">
                        <div class="media-left">
                          <a href="javascript:void(0);">
                              <?php 
                                if($postimgs)
                                { ?>
                                    <img class="img-responsive" alt="" src="<?php echo $this->webroot;?>/img/post_img/<?php echo $postimgs['0']['PostImage']['originalpath'];?>"> <?php
                                } else 
                                { ?>
                                     <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/slider-1.jpg">
                                <?php } ?>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo $posts['Post']['post_title'];?></h4>
                          <p>$<?php echo number_format($posts['Post']['price']);?></p>
                          <span>by <a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $searcher.'/'.base64_encode($posts['User']['id']);?>"><?php echo $posts['User']['first_name'].' '.$posts['User']['last_name']; ?> </a></span>
                        </div>
                    </div>
                </div>
                <div class="modal-body media_modal_body">
                    <form method="post" id="post_report_form">
                        <span>Additional notes (Optional)</span>
                        <input type="hidden" id="final_report_type" name="data[PostReport][type]">
                        <input type="hidden" name="data[PostReport][post_id]" value="<?php echo $posts['Post']['id'];?>">
                        <textarea name="data[PostReport][notes]" id='report_form_note'></textarea>
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
                    <div class="media media_head_img">
                        <div class="media-left">
                          <a href="javascript:void(0);">
                              <?php 
                                if($postimgs)
                                { ?>
                                    <img class="img-responsive" alt="" src="<?php echo $this->webroot;?>/img/post_img/<?php echo $postimgs['0']['PostImage']['originalpath'];?>"> <?php
                                } else 
                                { ?>
                                     <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/slider-1.jpg">
                                <?php } ?>
                          </a>
                        </div>
                        <div class="media-body">
                          <h4 class="media-heading"><?php echo $posts['Post']['post_title'];?></h4>
                          <p>$<?php echo number_format($posts['Post']['price']);?></p>
                          <span>by <a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $searcher.'/'.base64_encode($posts['User']['id']);?>"><?php echo $posts['User']['first_name'].' '.$posts['User']['last_name']; ?> </a></span>
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

		
		<!------############ Request To Buy ################--->
		

<div class="modal fade modal_small_width" id="request_to_buy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<div class="media media_head_img">
		  <div class="media-left">
		    <a href="#">
		      <img class="img-responsive" alt="" src="<?php 
                                                                      if(!empty($post_details['PostImage']))
                                                                      {
                                                                          echo $this->webroot.'img/post_img/'.$post_details['PostImage']['0']['originalpath'];
                                                                      }
                                                                      else {
                                                                          echo $this->webroot.'images/user-image.jpg';
                                                                      }
                                                                       ?>">
		    </a>
		  </div>
		  <div class="media-body">
		    <h4 class="media-heading"><?php echo $post_details['Post']['post_title']; ?></h4>
		    <p>$<?php echo number_format($post_details['Post']['price']);?></p>
		    <span>by <?php echo $post_details['User']['first_name'].' '.$post_details['User']['last_name']; ?></span>
		  </div>
		</div>
      </div>
      <div class="modal-body reported">
        	<div class="send_request_to_buy">
        		<p>Send a request to buy</p>
        		<button>Checkout with <img alt="" src="<?php echo $this->webroot; ?>images/pypal.png" style="width:100px;height:auto"></button>
        		<span>or</span>
        		<button data-dismiss="modal" data-toggle="modal" data-target="#now_accept">Pay with cash</button>
        	</div>
        	<div class="terms">
        		<input type="checkbox" /><p>Click here stating agree to the sellers description and details regarding the product you would like to purchase and product is as is condition free of any warranty unless otherwise stated</p>
        	</div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal_small_width" id="now_accept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <div class="now_accepting pay_cash">
                <h2>Pay With Cash</h2>
                <p>You are about to confirm that you will purchase this offer:</p>                    
            </div>
      </div>
      <div class="modal-body">
            <div class="media media_head_img">
                <div class="media-left">
                  <a href="#">
                    <img class="img-responsive" alt="" src="<?php 
                                                                    if(!empty($offer_details['PostImage']))
                                                                    {
                                                                        echo $this->webroot.'img/post_img/'.$offer_details['PostImage']['0']['originalpath'];
                                                                    }
                                                                    else {
                                                                        echo $this->webroot.'images/user-image.jpg';
                                                                    }
                                                                     ?>">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?php echo $offer_details['Post']['post_title']; ?></h4>
                  <p>$<?php echo number_format($offer_details['Post']['price']);?></p>
                  <span>by <?php echo $offer_details['User']['first_name'].' '.$offer_details['User']['last_name']; ?></span>
                </div>
            </div>
          <form method="post" id="cash_pay_form">
		<div class="item_shiped overflow-visible">
			<div class="cust_check">
                            <input type="radio" id="radio01" class="pay_type" name="data[CashPayment][type]" value="S" checked onclick="change_pay_type(this.value)"/>
                            <label for="radio01"><span></span>Item will be shipped</label>
			</div>
			<div class="cust_check">
                            <input type="radio" id="radio02" class="pay_type" name="data[CashPayment][type]" value="M" onclick="change_pay_type(this.value)"/>
                            <label for="radio02"><span></span>Meeting at an agreed location:</label>
			</div>
			<div class="loc_date_time overflow-visible">
				  <div class="row">
					  <div class="form-group">
					    <div class="col-sm-12">
					      <input type="text" class="form-control" id="meeting_location" required name="data[CashPayment][location]" placeholder="Enter Location">
					    </div>
					  </div>
					  <div class="form-group">
					    <div class="col-sm-6">
                                                <input type="text" class="form-control" required name="data[CashPayment][date]" id="meeting_date_text" placeholder="Date">
					    </div>
					    <div class="col-sm-6">
                                                <input type="text" class="form-control" required name="data[CashPayment][time]" id="meeting_time_text" placeholder="Time">
					    </div>
					  </div>
					  <div class="form-group">
					  	 <div class="sequirity">
						  	<p>
                                                            <input type="checkbox" id="safety_feature_check" name="data[CashPayment][SafetyFeature_id]" onclick="return show_safety_features();" />  
<!--                                                            checked="checked"-->
							    <label for="safety_feature_check">Add a Safety Feature</label>
							</p>
    					 </div>
					  </div>
				  </div>
			 </div>
			 <ul class="two_buttons_togather">
				<li><button type="button" data-dismiss="modal" class="btn_cancl">Cancel</button></li>
				<li><button class="btn_copy_clip cash_pay_confirm" >Confirm</button></li>
			  </ul>
		</div>
            </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade modal_small_width" id="safty_send_2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="border-bottom: 0">
         <button type="button" class="close" data-dismiss="modal" data-toggle="modal" data-target="#now_accept" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
    	<div class="safty_send new">
    		<h2>Safety Send</h2>
    		<span>Niwi says safety is First!</span>
    		<ul class="safty_send_list">
				<li>
					<p>You are meeting:</p>
					<p><?php echo $offer_details['User']['first_name'].' '.$offer_details['User']['last_name']; ?></p>
				</li>
				<li>
					<p>Item title:</p>
					<p><?php echo $offer_details['Post']['post_title']; ?></p>
				</li>
				<li>
					<p>Meeting Location:</p>
                                        <p class="meeting_location_p"></p>
				</li>
				<li>
					<p>Date & Time:</p>
                                        <p class="meeting_time_p"></p>
				</li>
			</ul>
    	</div>
        <form method="post" id="safety_feature_form">
            <div class="notify">

                      <div class="form-group">
                                <label for="exampleInputEmail1">Please notify:</label>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control" required name="data[SafetyFeature][name]" id="exampleInputEmail1" placeholder="Name">
                              </div>
                              <div class="form-group">
                                <input type="email" class="form-control" required name="data[SafetyFeature][email]" id="exampleInputPassword1"  placeholder="Email Adress">
                              </div>
                              <div class="form-group">
                                <input type="text" class="form-control" required name="data[SafetyFeature][phone]" id="exampleInputPassword1" placeholder="Phone Number">
                              </div>
                              <br/><br/>
                              <div class="form-group">
                                <label for="exampleInputEmail1">How far in advance should we notify?</label>
                              </div>
                               <div class="form-group">
                                  <select name="data[SafetyFeature][phone]" class="form-control">
                                    <option value="1">1 hr</option>
                                    <option value="2">2 hr</option>
                                    <option value="5">5 hr</option>
                                  </select>
                               </div>

            </div>
            <ul class="two_buttons_togather">
                <li><button type="button" data-dismiss="modal" data-toggle="modal" data-target="#now_accept" class="btn_cancl">Cancel</button></li>
                <li><button class="btn_copy_clip" style="width:200px">Save</button></li>
            </ul>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
function show_safety_features()
        {
            //alert('hi');
            if($('#meeting_location').val()!='' && $('#meeting_date_text').val()!='' && $('#meeting_time_text').val()!='')
            {
                $('.meeting_location_p').text($('#meeting_location').val());
                $('.meeting_time_p').text($('#meeting_date_text').val() + " at " + $('#meeting_time_text').val());
                $('#now_accept').modal('hide');
                $('#safty_send_2').modal('show');
            }
            else
            {
                alert('Please enter time and location first');
                return false;
            }
           
        }
        initAutocomplete();
        function initAutocomplete() {
            autocomplete = new google.maps.places.Autocomplete((document.getElementById('meeting_location')),
                {types: ['geocode']});
                
            //autocomplete.addListener('place_changed', fillInAddress);
          } 
		  
		  function change_pay_type(val){
            //alert(val);
            if(val=='S')
            {
                $('.loc_date_time input').val('');
                $('.loc_date_time input').attr('disabled',true);
            }
            else
            {
                $('.loc_date_time input').attr('disabled',false);
            }
        }
		
		$(document).ready(function(){
        $('.loc_date_time input').attr('disabled',true);
        $('#cash_pay_form').on('submit',function(){
            $.ajax({
                method:'POST',
                url:'<?php echo $this->webroot; ?>cash_payments/ajax_save',
                dataType:'json',
                data:$('#cash_pay_form').serialize()+"&data[CashPayment][post_id]=" + <?php echo $post_details['Post']['id']; ?> + "&data[CashPayment][post_offer]=" + <?php echo $offer_details['Post']['id']; ?>,
                success:function(){
                    $('#now_accept').modal('hide');
                }
            })
            return false;
        })
        
        $('#safety_feature_form').on('submit',function(){
            $.ajax({
                method:'POST',
                url:'<?php echo $this->webroot; ?>safety_features/ajax_save',
                dataType:'json',
                data:$('#safety_feature_form').serialize()+"&data[CashPayment][post_id]=" + <?php echo $post_details['Post']['id']; ?> + "&data[CashPayment][post_offer]=" + <?php echo $offer_details['Post']['id']; ?>,
                success:function(data){
                    if(data.id)
                    {
                        $('#safety_feature_check').val(data.id);
                        $('#safety_feature_check').prop('checked',true);
                        $('#now_accept').modal('show');
                        $('#safty_send_2').modal('hide');
                    }
                }
            })
            return false;
        })
        
        $('#meeting_date_text').datetimepicker({
            format:'M/D/YYYY'
        });
        
        $('#meeting_time_text').datetimepicker({
            format:'h:mm a'
        });
		});
</script>
		<!------############ Request To Buy ################--->
<style>
.type-a-msg{position: relative;}
.type-a-msg button{position: absolute;
    right: 0;
    top: 0;
    z-index: 9;}

</style>
	
    
    <script src="<?php echo $this->webroot;?>/js/bootstrap.min.js"></script>
    <script src="<?php echo $this->webroot;?>/js/jquery.bxslider.js"></script>
    <script src="<?php echo $this->webroot;?>/js/lc_switch.js"></script>
    <script>
    	$(document).ready(function(){
    		$('.bxslider').bxSlider({
			  auto: true,
			  autoControls: true
			});
    	});
    </script>
    
    
    <script type="text/javascript">
		$(document).ready(function(e) {
			
		//$('input').lc_switch();

		// triggered each time a field changes status
		$('body').delegate('.lcs_check', 'lcs-statuschange', function() {
			var status = ($(this).is(':checked')) ? 'checked' : 'unchecked';
			console.log('field changed status: '+ status );
		});
		
		
		// triggered each time a field is checked
		$('body').delegate('.lcs_check', 'lcs-on', function() {
			console.log('field is checked');
		});
		
		
		// triggered each time a is unchecked
		$('body').delegate('.lcs_check', 'lcs-off', function() {
			console.log('field is unchecked');
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
                        
                        $('.gray').click(function(e){
                        e.preventDefault();
                        //$('#report_modal_test').modal('hide');
                        //$('.modal-backdrop').hide();
                        $('#report_final_modal').modal('show');
                    })
    	});
    </script>

    <script>
        function show_report_final(d)
        {
            $('#final_report_type').val(d);
        }
    function del(aa){
	var a=confirm("Are you sure, you want to delete this post?")
      if (a)
      {
        location.href="<?php echo $this->webroot?>posts/delete_post/"+aa;
      } 
}

        function save_report(){
         
          $.ajax({
              type:'POST',
              url:'<?php echo $this->webroot.'post_reports/ajax_save'; ?>',
              dataType:'json',
              data:{data:{PostReport:{type:$('#final_report_type').val(),post_id:<?php echo $posts['Post']['id'];?>,notes:$('#report_form_note').val()}}},
              success:function(data){
                  $('#report_form_note').val('');
                  $('#report_final_modal').modal('hide');
                  $('#report_success_modal').modal('show');
              }
          })
        }

function offer_fav(post_id)
{
	//alert(userid);
	//alert(post_id);

	$.ajax({
              url     : "<?php echo $this->webroot;?>/posts/offer_fav",
              type    : "POST",
              cache   : false,
              data    : {post_id : post_id},
              success : function(data){
              	$('#fav_count').html(data);
              	$('#fav_color').html('<a href="javascript:void(0);"><img src="<?php echo $this->webroot;?>images/favorite-red.svg" alt="" style="width:19px"></a>');
              	$('#fav_big_color').html('<a href="javascript:void(0);"><img src="<?php echo $this->webroot;?>images/favorite-red.svg" alt="" style="width:26px"></a>');
              	
                     
             
              }
          });

	//location.href="<?php echo $this->webroot?>posts/offer_fav/"+post_id;

}
    </script>

    <script>

   
       function savePost_offer(post){

                    if(post == "post1_offer"){
                    	
                       //alert("hi");
                               
                                $('#pli1_offer').removeClass('active');
                                $('#pli2_offer').addClass('active');
                                $('#pdiv1_offer').removeClass('active');
                                $('#pdiv2_offer').addClass('active');
                                $("#stepNo_offer").html(2);

                                var post2 = "'post2_offer'";
                                var btn = '<button type="button" class="btn btn-default btn-bordered" data-dismiss="modal" style="padding-right: 20px; padding-left:20px">Go Back</button><button type="button" onclick="savePost_offer('+post2+')" class="btn btn-primary">Continue</button></span>';
                                $("#postContinue_offer").html(btn);
                           
                    } if(post == "post2_offer"){
                    	//$('#skip_id').hide();
                    	var type ="offer";
                    	 //alert('++ 1');
                        //alert($("#category_id").val());
			if($("#category_id_offer").val()==""){ alert("Please Choose Category!"); $("#category_id_offer").focus(); return false; }
			if($("#subcategory_id_offer").val()==""){ alert("Please Choose Sub Category!"); $("#subcategory_id_offer").focus(); return false; }
			if($("#post_title_offer").val()==""){ alert("Please Give Title Description!"); $("#post_title_offer").focus(); return false; }
			if($("#location_offer").val()==""){ alert("Please Give Location!"); $("#location_offer").focus(); return false; }
			if($("#post_description_offer").val()==""){ alert("Please Give Description!"); $("#post_description_offer").focus(); return false; }
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/addnewoffer/",
                            //dataType: "json",
                            data: {category_id      : $("#category_id_offer").val(),
                                   subcategory_id      : $("#subcategory_id_offer").val(),
                                   post_title       : $("#post_title_offer").val(),
                                   location         : $("#location_offer").val(),
                                   city             : $("#postCityoffer").val(),
                                   state            : $("#postStateoffer").val(),
                                   address          : $("#postAddressoffer").val(),
                                   country          : $("#postCountryoffer").val(),
                                   zip_code         : $("#postZip_codeoffer").val(),
                                   post_description : $("#post_description_offer").val(),
                                   post_id          : $("#post_id_offer").val(),
                                   type             : type
                                  }
                        }).done(function(msg) {
                            //alert(msg);
                            if(msg != 0){
                    	$('#postId_offer').val(msg);
                        $('#pli2_offer').removeClass('active');
                        $('#pli3_offer').addClass('active');
                        $('#pdiv2_offer').removeClass('active');
                        $('#pdiv3_offer').addClass('active');
                        $("#stepNo_offer").html(3);
                        var post3 = "'post3_offer'";
                        var btn = '<button type="button" class="btn btn-default btn-bordered" data-dismiss="modal" style="padding-right: 20px; padding-left:20px">Go Back</button><button type="button" onclick="savePost_offer('+post3+')" class="btn btn-primary">Continue</button></span>';
                        $("#postContinue_offer").html(btn);
                         }
                        });
                    } if(post == "post3_offer"){
                    	//alert("hello");
                    	var radio1=$("#price_condition_offer1").val();
                    	var radio2=$("#price_condition_offer2").val();
                    	var radio3=$("#price_condition_offer3").val();
                    	if($("#price_condition_offer1").is(":checked"))
                    	{
                    		var radio=radio1;
                    	}
                    	else if($("#price_condition_offer2").is(":checked"))
                    	{
                    		var radio=radio2;
                    	}
                    	else if($("#price_condition_offer3").is(":checked"))
                    	{
                    		var radio=radio3;
                    	}
                    	var radio_prod1=$("#product_condition_offer1").val();
                    	var radio_prod2=$("#product_condition_offer2").val();
                    	if($("#product_condition_offer1").is(":checked"))
                    	{
                    		var radio_prod=radio_prod1;
                    	}
                    	else if($("#product_condition_offer2").is(":checked"))
                    	{
                    		var radio_prod=radio_prod2;
                    	}
                    	//alert(radio);
;                    	//alert($("#price_condition_offer2").val());
                    	//alert($("#product_condition_offer").val());
                        $.ajax({
                            type: "POST",
                            url: "<?php echo $this->Html->url('/'); ?>posts/addnewpostbudget_offer/",
                            //dataType: "json",
                            data: {budget               : $("#budget_offer").val(),
                                   price_condition      : radio,
                                   product_condition    : radio_prod
                                  }

                        }).done(function(msg) {
                            //alert(msg);
                            $('#category_id_offer').val('');
                            $('#subcategory_id_offer').val('');
                            $('#post_title_offer').val('');
                            $('#location_offer').val('');
                            $('#post_description_offer').val('');
                            $('#postId_offer').val('');
                            $('#budget_offer').val('');
                            $('#price_condition_offer1').val('');
                            $('#price_condition_offer2').val('');
                            $('#price_condition_offer3').val('');
                            $('#product_condition_offer1').val('');
                            $('#product_condition_offer2').val('');
                            $("#AddOffer").modal('hide');
                            //$("#modal_success_offer").modal('show');
                            // Reload Window
                            window.location.reload();
                        });
                    }
                }


                   $(document).ready(function () {


                    $('#photoimg_1').on('change', function () {
                       $("#preview_1").html('');
                       $("#preview_1").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform_1").ajaxForm({
                           target: '#preview_1'
                       }).submit();
                   });

                    $('#photoimg_2').on('change', function () {
                       $("#preview_2").html('');
                       $("#preview_2").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform_2").ajaxForm({
                           target: '#preview_2'
                       }).submit();
                   });

                    $('#photoimg_3').on('change', function () {
                       $("#preview_3").html('');
                       $("#preview_3").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform_3").ajaxForm({
                           target: '#preview_3'
                       }).submit();
                   });

                    $('#photoimg_4').on('change', function () {
                       $("#preview_4").html('');
                       $("#preview_4").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform_4").ajaxForm({
                           target: '#preview_4'
                       }).submit();
                   });

                    $('#photoimg_5').on('change', function () {
                       $("#preview_5").html('');
                       $("#preview_5").html('<img src="<?=$this->Html->url('/')?>images/loader.gif" alt="Uploading...."/>');
                       $("#imageform_5").ajaxForm({
                           target: '#preview_5'
                       }).submit();
                   });
                });

            </script>
            <script>
            function getsubcat()
            {
            	var id=$('#category_id_offer').val();
            	//alert(id);

              $.ajax({
              url     : "<?php echo $this->webroot;?>/posts/getsubcat",
              type    : "POST",
              cache   : false,
              data    : {id : id},
              success : function(data){
				      //alert(data);
				      $('#subcategory_id_offer').html(data);
			  //return false;
					//$('#myModal'+id).modal('show');
					 //$('#myModal').html(data);
              }
          });
            	
            }
            </script>
            <script>
           function subcat_sel()
           {
            	
            	var subcat_id=$('#hid_subcat').val();

            $( "#category_id_offer" ).trigger( "change" );
                        setTimeout(function(){
                            $("#subcategory_id_offer").val(subcat_id);
                        },2000);

                    }

                    function get_offerid(id)
                    {
                    	
                    	//alert(id);
                    	$.ajax({
              url     : "<?php echo $this->webroot;?>/posts/getedit_offerid",
              type    : "POST",
              cache   : false,
              data    : {offer_id : id},
              success : function(data){
              	//alert(data);
              	
                     
             
              }
          });
                    	
                    }

                    
            </script>
            <script>
            function editmodal_offer(id)
            {
            	//alert(id);
            	$.ajax({
                        type: "POST",
                        url: "<?php echo $this->Html->url('/'); ?>posts/fetchofferdata/",
                        //dataType: "json",
                        data: {pid: id}
                    }).done(function (msg) {
                        //alert(respsText.Post.subcategory_id);
                        //alert(msg);
                        respsText = JSON.parse(msg);
                        //alert(msg['Post']['location']);
                        //alert(respsText.PostImage[0]);
                        //alert(Object.keys(respsText.PostImage).length);

                        $("#category_id_offer").val(respsText.Post.category_id);
                        //$("#subcategory_idval").val(respsText.Post.subcategory_id);
                        $("#post_title_offer").val(respsText.Post.post_title);
                        $("#location_offer").val(respsText.Post.location);
                        $("#postCityoffer").val(respsText.Post.city);
                        $("#postStateoffer").val(respsText.Post.state);
                        $("#postAddressoffer").val(respsText.Post.address);
                        $("#postCountryoffer").val(respsText.Post.country);
                        $("#postZip_codeoffer").val(respsText.Post.zip_code);
                        $("#post_description_offer").val(respsText.Post.post_description);

                        $( "#category_id_offer" ).trigger( "change" );
                        setTimeout(function(){
                            $("#subcategory_id_offer").val(respsText.Post.subcategory_id);
                        },2000);

                        $("#budget_offer").val(respsText.Post.price);
                        if(respsText.Post.price_condition == "Fixed"){
                            $('input:radio[name="price_condition"]').filter('[value="Fixed"]').attr('checked', true);
                        } else if(respsText.Post.price_condition == "Negotiable"){
                            $('input:radio[name="price_condition"]').filter('[value="Negotiable"]').attr('checked', true);
                        } else if(respsText.Post.price_condition == "Trade"){
                            $('input:radio[name="price_condition"]').filter('[value="Trade"]').attr('checked', true);
                        }

                        if(respsText.Post.product_condition == "New"){
                            $('input:radio[name="product_condition"]').filter('[value="New"]').attr('checked', true);
                        } else if(respsText.Post.product_condition == "Used"){
                            $('input:radio[name="product_condition"]').filter('[value="New"]').attr('checked', true);
                        }

                       
                        var forum = respsText.PostImage;
                       
                        for (var i = 0; i < forum.length; i++) {
                                // forum.length
                               var object = forum[i];
                               var value = object.resizepath;
                               var pimgid = object.id;
                               $("#existimg").append('<li id="hide_'+pimgid+'"> <i class="fa fa-times" onclick="deleteImg('+pimgid+');"></i><img src="<?php echo $this->webroot;?>img/post_img/'+value+'" alt=""></li>');
                        }
                        //$('#epostId').val(pid);
                    });

            }
            </script>
            <script>
            function close_success_button()
            {
            	window.location.reload();
            }
            </script>


            <script>
            function offer_likes(post_id)
            {
            	//alert(id);

               $.ajax({
               url     : "<?php echo $this->webroot;?>posts/offer_like",
               type    : "POST",
               cache   : false,
               data    : {post_id : post_id},
               dataType: 'json',
               success : function(data){
               console.log(data.rate,data.type,data.count);
              	$('#offerlike_count').html(data.count);
              	$('#rateing').html(data.rate);
              	if(data.type==1)
              	{

                $('.thumb').removeClass('fa-thumbs-o-up');
				$('.thumb').addClass('fa-thumbs-up');

              	}
              	else
              	{

              	$('.thumb').addClass('fa-thumbs-o-up');
				$('.thumb').removeClass('fa-thumbs-up');


				
              	}
              
              	
                     
             
              }
          });

            }

            function open_mssgmodal()
            {

            	$("#modal_success_postlike").modal('show');

            }

             function open_favmodal()
            {

            	$("#modal_success_fav").modal('show');

            }

               function comment_modalopen()

            {

            	$("#comment_modal").modal('show');

            }
            </script>

            <script>
            $('#loginclose').click(function (e) {
                e.preventDefault();

                $('#modal_success_postlike')
                        .modal('hide')
                        .on('hidden.bs.modal', function (e) {
                            $('#Login').modal('show');

                            $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                        });

            });
            </script>

            <script>
            $('#loginfavclose').click(function (e) {
                e.preventDefault();

                $('#modal_success_fav')
                        .modal('hide')
                        .on('hidden.bs.modal', function (e) {
                            $('#Login').modal('show');

                            $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                        });

            });
            </script>

             <script>
            $('#logincommentclose').click(function (e) {
                e.preventDefault();

                $('#comment_modal')
                        .modal('hide')
                        .on('hidden.bs.modal', function (e) {
                            $('#Login').modal('show');

                            $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                        });

            });
            </script>

            <script>
    function popWindow(url,winName,w,h) {
    if (window.open) {
        if (poppedWindow) { poppedWindow = ''; }
        windowW = w;
        windowH = h;
        var windowX = (screen.width/2)-(windowW/2);
        var windowY = (screen.height/2)-(windowH/2);
        var myExtra = "status=no,menubar=no,resizable=yes,toolbar=no,scrollbars=yes,addressbar=no";
        var poppedWindow = window.open(url,winName,'width='+w+',height='+h+',top='+windowY+',left=' + windowX + ',' + myExtra + '');
    }
    else {
        alert('Your security settings are not allowing our popup windows to function. Please make sure your security software allows popup windows to be opened by this web application.');
    }
    return false;
}
</script>


<script>
      var placeSearch, autocomplete;
      var CustomcomponentForm = {
        postAddressoffer: 'short_name',
        //route: 'long_name',
        postCityoffer: 'long_name',
        postStateoffer: 'short_name',
        postCountryoffer: 'long_name',
        postZip_codeoffer: 'short_name'
      };
      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        locality: 'long_name',
        administrative_area_level_1: 'short_name',
        country: 'long_name',
        postal_code: 'short_name'
      };

      function initAutocomplete_offer() {
      
        autocomplete = new google.maps.places.Autocomplete(
            (document.getElementById('location_offer')),
            {types: ['geocode']});
console.log('Hi');
       
        autocomplete.addListener('place_changed', fillInAddress_offer);
      }

      function fillInAddress_offer() {
      
        var place = autocomplete.getPlace();
console.log('Hi2');
        for (var component in CustomcomponentForm) {
          document.getElementById(component).value = '';
          document.getElementById(component).disabled = false;
        }

        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
          //alert(document.getElementById('postZip_codeval').value);
            var val = place.address_components[i][componentForm[addressType]];
            //alert(addressType);
            if(addressType=='street_number'){
                document.getElementById('postAddressoffer').value = val;
            }else if(addressType=='route'){
                document.getElementById('postAddressoffer').value = document.getElementById('postAddressoffer').value+val;
            }else if(addressType=='locality'){
                document.getElementById('postCityoffer').value = val;
            }else if(addressType=='administrative_area_level_1'){
                document.getElementById('postState').value = val;
            }else if(addressType=='country'){
                document.getElementById('postCountryoffer').value = val;
            }else if(addressType=='postal_code'){
                document.getElementById('postZip_codeoffer').value = val;
            }
            
          }
        }
      }

      function geolocate_offer() {
console.log('Hi0');         
          initAutocomplete_offer();
        
      }
</script>


<script>
function post_fulldescription()
{
	//alert("hello");
	$('#nontot_desc').hide();
	$('#tot_desc').show();

}

function post_description()
{
	//alert("hello");
	$('#nontot_desc').show();
	$('#tot_desc').hide();

}
</script>



            <!--<script type="text/javascript"> 
	$(document).ready(function(){
		$('.thumb').click(function(){
			if($(this).hasClass('fa-thumbs-o-up'))
			{
				$(this).removeClass('fa-thumbs-o-up');
				$(this).addClass('fa-thumbs-up');
			}
			else if($(this).hasClass('fa-thumbs-up')){
				$(this).removeClass('fa-thumbs-up');
				$(this).addClass('fa-thumbs-o-up');
			}
		})
	})
</script>--> 



            <!--<script>
    function make_offer(post_id)
    {
    	


    	$.ajax({
              url     : "<?php echo $this->webroot;?>/posts/makeoffer",
              type    : "POST",
              cache   : false,
              data    : {post_id : post_id},
              success : function(data){
              	
                     
             
              }
          });

    }
    </script>-->

   
    
<style>
/*.ad-post-step-holder .modal-title {

	color: rgba(234, 209, 66, 0.8);
	}*/

	/*.step-tab > li.active a {
    border-bottom: 3px solid rgba(234, 209, 66, 0.8);
}*/

/*.step-tab > li.active > a, .step-tab > li.active > a:hover, .step-tab > li.active > a:focus {
	color: rgba(234, 209, 66, 0.8);
	}

	.btn-bordered {
		border: 1px solid rgba(234, 209, 66, 0.8);
		color: rgba(234, 209, 66, 0.8);
	}
	.btn-primary {
		border: 1px solid #4FD5CF;
background: none repeat scroll 0% 0% #4FD5CF;
	}*/
</style>    
    

	
</body>

</html>
