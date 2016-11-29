<?php
//pr($posts);
//pr($countries);
//echo count($posts);
//echo $link = Router::url(array('controller'=>'users', 'action'=>'post_listing'), false);

?>

  

		<div class="container">
			<div class="row">
				<div class="col-md-2 col-sm-4" >
					<ul class="category-menu">
						<li><h4>Categories</h4></li>
						<?php
						foreach($categories as $category)
						{
						?>
						<li onclick="sel_cat(<?php echo $category['Category']['id']?>)"><a href="<?php echo $this->webroot;?>posts/list_post/<?php echo $category['Category']['id']?>"><span><img src="<?php echo $this->webroot;?>img/cat_img/<?php echo $category['CategoryImage'][0]['originalpath']?>" alt=""></span><?php echo (isset($category['Category']['category_name']) && strlen($category['Category']['category_name'])<=15 )?ucfirst($category['Category']['category_name']):ucfirst(substr($category['Category']['category_name'],0,13)).'...';?></a></li>
						<?php
				     	}
						?>
						
						
					</ul>
					<!--<div class="spotlight">
						<h4>Spotlight</h4>
						<div class="spotlight-holder">
							<div class="spotlight-holder-top">
								<span class="round"><img src="images/round-image.png" alt=""></span>
								<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
							</div>
							<ul>
								<li><img src="images/spot-1.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-2.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-3.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-4.png" alt="" class="img-responsive"></li>
							</ul>
							<div class="clearfix"></div>
							<p class="text-right follow-link"><a href="" class="btn btn-default btn-sm">Follow</a></p>
						</div>
						<div class="spotlight-holder">
							<div class="spotlight-holder-top">
								<span class="round"><img src="images/round-image.png" alt=""></span>
								<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
							</div>
							<ul>
								<li><img src="images/spot-1.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-2.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-3.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-4.png" alt="" class="img-responsive"></li>
							</ul>
							<div class="clearfix"></div>
							<p class="text-right follow-link"><a href="" class="btn btn-default btn-sm">Follow</a></p>
						</div>
						<div class="spotlight-holder">
							<div class="spotlight-holder-top">
								<span class="round"><img src="images/round-image.png" alt=""></span>
								<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
							</div>
							<ul>
								<li><img src="images/spot-1.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-2.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-3.png" alt="" class="img-responsive"></li>
								<li><img src="images/spot-4.png" alt="" class="img-responsive"></li>
							</ul>
							<div class="clearfix"></div>
							<p class="text-right follow-link"><a href="" class="btn btn-default btn-sm">Follow</a></p>
						</div>
						<p class="text-center">
							<a href="">See More</a>
						</p>
					</div>-->
				</div>
				<div class="col-md-10 col-sm-8">
					
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active" id="in-search">
					    	
					    	<ul class="product-list list grid">
					    		<?php
					    		if(count($posts)>0)
					    		{

					    			

					    			foreach($posts as $post)
					    			{
					    				//echo $post['Post']['post_date'];

					    				$date1=date_create($post['Post']['post_date']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
					    		?>
								<a href="<?php echo $this->webroot;?>posts/post_details/<?php echo $post['Post']['id']?>" onclick="post_view(<?php echo $post['Post']['id']?>)"><li id="all_post">

									<div class="product-title-area yellow-title">
										<h4><?php echo $post['Post']['post_title'];?></h4>
										<p><?php echo $post['Category']['category_name'];?>  |  Fixed Price</p>
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
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot;?>images/location.png" alt=""></i>
												<?php echo $countries[0]['Country']['name'].' , '.$countries[0]['Country']['code_2'];?>
											</p>
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot; ?>/images/clock.png" alt=""></i><?php if($diff->days==0){ ?> Just now<?php }else if($diff->days==1){ echo ' '.$diff->days.' '.'Day ago';}else{ echo ' '.$diff->days.' '.'Days ago'; } ?></p>
										</div>
										<div class="right-side">
											<a href=""><img src="<?php echo $this->webroot;?>images/fabourite.png" alt="" class="img-responsive"></a>
										</div>
									</div>
									
							
							
							
									
								</li></a>

								<?php 
								} 

							 }
							 else
							 {
							 ?>
							
							 	<center><div style="padding-top: 20%; font-size: 20px;">There are no listing found in this Category..</div></center>
							

							 <?php
							 }
							 ?>



								
								
							</ul>
							<div class="clearfix"></div>
							<!--<div class="show-more"><a href=""><img src="images/more.png" alt=""><br> Show More</a></div>-->
					    </div>
					    <div role="tabpanel" class="tab-pane" id="marketplace">...</div>
					    
					 </div>
					
				</div>
			</div>
		</div>
	</section>


		<script>
				function post_view(aa)
				{
					
					 location.href="<?php echo $this->webroot?>posts/post_view/"+aa;
				}
				</script>



	<!--<script>
	function sel_post(id)
	{
		//alert(id);
		//alert("hello");
		$.ajax({
              url     : "<?php echo $this->webroot;?>/users/all_post",
              type    : "POST",
              cache   : false,
              data    : {id : id},
              success : function(data){

				      $('#all_post').html(data);

			
              }
          });
	}
	</script>-->