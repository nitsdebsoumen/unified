<?php
//pr($fav_all);
//echo count($posts);
?>
	<section class="dashboard-top">
		<div class="container">
			<div class="row">
				<div class="col-md-7 middle-div">
					<div class="row">
						<div class="col-sm-4">
							<div class="edit-profile-round-img-hold">
								<?php if($users['UserImage'][0]['originalpath']!='') {?><img src="<?php echo $this->webroot;?>user_images/<?php echo $users['UserImage'][0]['originalpath'];?>" alt=""><?php } else {?><img src="<?php echo $this->webroot;?>user_images/default.png" alt=""><?php } ?>
								<!--<a href="">Change</a>-->
							</div>
						</div>
						<div class="col-sm-8">
							<h1><?php echo ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);?></h1>
							<div class="like">
								<span><img src="<?php echo $this->webroot;?>images/like-symbol.png" alt=""></span> 5,300
							</div>
							<div class="clearfix"></div>
							<p class="verified"><span><?php if($users['User']['status']==1) { ?><img src="<?php echo $this->webroot;?>images/verified-symbol.png" alt=""></span>Verified User<?php } ?></p>
							<p class="location"><?php if($users['Country']['name']!='') {echo $users['Country']['name'].' , '.$users['Country']['code_2'];}?></p>
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
						<?php
						        $name_def=ucwords($users['User']['first_name']).' '.ucwords($users['User']['last_name']);
                                $expname_def = explode(" ", $name_def);
                                $usersnames=ucwords($users['User']['first_name']).' '.$expname_def[1][0];
                         ?>
					    <li role="presentation"><a href="<?php echo $this->webroot;?>users/dashboard/<?php echo $usersnames.'/'.base64_encode($userid2)?>" >Posts <span>(<?php echo count($posts);?>)</span></a></li>
					    <li role="presentation"><a href="#" data-toggle="tab">Following <span>(10)</span></a></li>
					    <li class="active" role="presentation"><a href="<?php echo $this->webroot;?>users/favorites/<?php echo base64_encode($userid2)?>" data-toggle="tab">Favorites <span>(<?php echo $fav;?>)</span></a></li>
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
						<h3>My Offers</h3>
						<div class="dashboard-slider">
							
							<?php if(count($fav_all)>0)
							{
							?>
							<ul class="bxslider">


								<?php
								foreach($fav_all as $post)
								{
										$date1=date_create($post['Post']['post_date']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
								?>
								
								<li>
									<a href="<?php echo $this->webroot;?>posts/post_details/<?php echo $post['Post']['id'];?>" onclick="post_view(<?php echo $post['Post']['id']?>)">
									<div class="product-title-area yellow-title">
										<h4><?php echo (isset($post['Post']['post_title']) && strlen($post['Post']['post_title'])<=15 )?ucfirst($post['Post']['post_title']):ucfirst(substr($post['Post']['post_title'],0,13)).'...';?></h4>
										<p><?php //echo $post['Category']['category_name'];?> | Fixed Price</p>
									</div>
									<div class="product-price">$<?php echo number_format($post['Post']['price']);?></div>
									<div class="main-image">
	<img src="<?php echo $this->webroot;?>/img/post_img/<?php echo $post['Post']['PostImage']['0']['originalpath'];?>" alt="">
										
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
								</a>
									
								</li>
							

							
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
					</div>
				</div>
			</div>
		</div>
	</section>

	

	
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
    </script>

    <script>
				function post_view(aa)
				{
					
					 location.href="<?php echo $this->webroot?>posts/post_view/"+aa;
				}
				</script>

    <style>
    .bx-prev.disabled {
    display: none !important;
}
    </style>
</body>

</html>
