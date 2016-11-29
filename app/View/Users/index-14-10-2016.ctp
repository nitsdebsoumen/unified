<?php
$userid = $this->Session->read('user_id');
?>

<div class="col-md-2 col-sm-4">
					<ul class="category-menu">
						<li><h4>Categories</h4></li>
						<?php
						foreach($category as $key=>$val)
						{
						?>
						<li>
						    <a href="<?php echo $this->webroot;?>posts/list_post/<?php echo $val['Category']['id'];?>">
							<?php
							if(!empty($val['CategoryImage']))
							{
							    if(isset($val['CategoryImage']['0']['originalpath']) && $val['CategoryImage']['0']['originalpath']!='')
							    {
							?>
							<span>
							    <img src="<?php echo $this->webroot.'img/cat_img/'.$val['CategoryImage']['0']['originalpath']; ?>" alt="">
							</span> 
							<?php 
							    }
							}
							echo (isset($val['Category']['category_name']) && strlen($val['Category']['category_name'])<=15 )?ucfirst($val['Category']['category_name']):ucfirst(substr($val['Category']['category_name'],0,13)).'...';
							?>
						    </a>
						</li>
						<?php
						}
						?>
					</ul>
					<div class="spotlight">
						<h4>Spotlight</h4>
						<div class="spotlight-holder">
							<div class="spotlight-holder-top">
								<span class="round"><img src="<?php echo $this->webroot; ?>/images/round-image.png" alt=""></span>
								<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
							</div>
							<ul>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-1.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-2.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-3.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-4.png" alt="" class="img-responsive"></li>
							</ul>
							<div class="clearfix"></div>
							<p class="text-right follow-link"><a href="" class="btn btn-default btn-sm">Follow</a></p>
						</div>
						<div class="spotlight-holder">
							<div class="spotlight-holder-top">
								<span class="round"><img src="<?php echo $this->webroot; ?>/images/round-image.png" alt=""></span>
								<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
							</div>
							<ul>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-1.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-2.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-3.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-4.png" alt="" class="img-responsive"></li>
							</ul>
							<div class="clearfix"></div>
							<p class="text-right follow-link"><a href="" class="btn btn-default btn-sm">Follow</a></p>
						</div>
						<div class="spotlight-holder">
							<div class="spotlight-holder-top">
								<span class="round"><img src="<?php echo $this->webroot; ?>/images/round-image.png" alt=""></span>
								<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
							</div>
							<ul>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-1.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-2.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-3.png" alt="" class="img-responsive"></li>
								<li><img src="<?php echo $this->webroot; ?>/images/spot-4.png" alt="" class="img-responsive"></li>
							</ul>
							<div class="clearfix"></div>
							<p class="text-right follow-link"><a href="" class="btn btn-default btn-sm">Follow</a></p>
						</div>
						<p class="text-center">
							<a href="">See More</a>
						</p>
					</div>
				</div>
				<div class="col-md-10 col-sm-8">
					<div class="home-wrapper-top">
						<div class="row">
							<div class="col-md-9">
								<ul class="nav nav-tabs home-wrap-tab" role="tablist">
								    <li role="presentation" class="active"><a href="#in-search" aria-controls="in-search" role="tab" data-toggle="tab">In Search of <span>(3.5K)</span></a></li>
								    <li role="presentation"><a href="#marketplace" aria-controls="marketplace" role="tab" data-toggle="tab">MarketPlace <span>(1.2K)</span></a></li>
								</ul>
							</div>
							<div class="col-md-3">
								<!--<p class="text-right">
									<button class="btn btn-default" id="grid"><i class="fa fa-th-large"></i> Gallery</button>
									<button class="btn btn-default" id="list"><i class="fa fa-list-ul"></i> Thumb</button>
								</p>-->
							</div>
						</div>
					</div>
					<div class="popular-near">
						<div class="row">
							<div class="col-md-9 col-sm-7 col-xs-5">
								<h4>Popular Near Me</h4>
							</div>
							<div class="col-md-3 col-sm-5 col-xs-7">
								<div class="form-group">
									<select class="form-control"><option>Recently Published</option></select>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-content">
					    <div role="tabpanel" class="tab-pane fade in active" id="in-search">
					    	<?php
                                                $color_array = array('yellow-title','pink-title','green-title','blue-title');
                                                if(count($product)>0)
					    	{
                                                    $t=0;
                                                    $plus = true;
                                                    $first = true
					    	?>
                                                
					    	<ul class="product-list list grid">
						    <?php
						    foreach($product as $key=>$val)
						    {
							$date1=date_create($val['Post']['post_date']);
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);
						    ?>
						    
								<li>
									<a href="<?php echo $this->webroot;?>posts/post_details/<?php echo $val['Post']['id']?>" onclick="post_view(<?php echo $val['Post']['id']?>)">
									<div class="product-title-area <?php
                                                                        echo $color_array[$t];
                                                                        if($t==0)
                                                                        {
                                                                            $plus = true;
                                                                        }
                                                                        else if($t==3)
                                                                        {
                                                                            $plus = false;
                                                                        }
                                                                        
                                                                            if($plus)
                                                                            {
                                                                                if(($key+1)%4 != 0)
                                                                                    $t++;
                                                                            }
                                                                            else
                                                                            {
                                                                                if(($key+1)%4 != 0)
                                                                                    $t--;
                                                                            }
                                                                        
                                                                        
                                                                        ?>">
										<h4><?php echo (isset($val['Post']['post_title']) && strlen($val['Post']['post_title'])<=15 )?ucfirst($val['Post']['post_title']):ucfirst(substr($val['Post']['post_title'],0,13)).'...'; ?></h4>
										<p><?php echo (isset($val['Category']['category_name']) && strlen($val['Category']['category_name'])<=15 )?ucfirst($val['Category']['category_name']):ucfirst(substr($val['Category']['category_name'],0,13)).'...'; ?>  |  Fixed Price</p>
									</div>
									</a>
									<div class="product-price">$<?php echo (isset($val['Post']['price']) && $val['Post']['price']!='' )? number_format($val['Post']['price']):''; ?></div>
									<div class="main-image">
									<a href="<?php echo $this->webroot;?>posts/post_details/<?php echo $val['Post']['id']?>" onclick="post_view(<?php echo $val['Post']['id']?>)">
										<?php if($val['PostImage']['0']['originalpath']!='')
										{
										?>
										<img src="<?php echo $this->webroot; ?>/img/post_img/<?php echo $val['PostImage']['0']['originalpath']; ?>" alt="">
										<?php
									}
									else
									{
										?>
										<img src="<?php echo $this->webroot; ?>images/noimage.png" alt="">
										<?php
									}
										?>
									  </a>
									</div>
									<div class="product-bottom-area">
										<div class="left-side">
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot; ?>/images/location.png" alt=""></i><?php echo $val['Post']['location'];?></p>
											<p style="color:#fff;"><i class=""><img src="<?php echo $this->webroot; ?>/images/clock.png" alt=""></i><?php if($diff->days==0){?>Just now<?php }else if($diff->days==1){ echo $diff->days.' '.'Day ago';}else{ echo $diff->days.' '.'Days ago'; } ?></p>
										</div>
										<div class="right-side">
											<?php
											$postfav_count = $this->requestAction('/users/postfav_index/'.base64_encode($val['Post']['id']));
											if($userid!='')
											{
													if($postfav_count==0)
										   	{
											?>

											<a href="javascript:void(0);" onclick="post_fav(<?php echo $val['Post']['id'];?>)"><b class="" id="post_color<?php echo $val['Post']['id'];?>"></b></a>

											<?php 
										    } else {?>

										    <b class="active"></b>


										    <?php
										    }
										    }
										    else
										    {
											?>
											<b class="" onclick="open_favmodal()"></b>
											<?php
										    }
											?>
										</div>
									</div>
								</li>
							
								<?php
						    }
						    ?>
							</ul>
							<?php } else {?>
							<center><div style="padding-top: 10%; font-size: 20px;">There are no post found</div></center>
							<?php } ?>
							<div class="clearfix"></div>
							<!--<div class="show-more"><a href=""><img src="<?php echo $this->webroot; ?>/images/more.png" alt=""><br> Show More</a></div>-->
					    </div>
					    <div role="tabpanel" class="tab-pane" id="marketplace">...</div>
					    
					 </div>
					
				</div>



				<div class="modal fade" id="modal_success_fav_index" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                        <p>To favorite this post please Login.</p>
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

				<script>
				function post_view(aa)
				{
					//alert(aa);
					 location.href="<?php echo $this->webroot?>posts/post_view/"+aa;
				}

				function open_favmodal()

            {

            	$("#modal_success_fav_index").modal('show');

            }
				</script>

				<script>
            $('#loginfavclose').click(function (e) {
                e.preventDefault();

                $('#modal_success_fav_index')
                        .modal('hide')
                        .on('hidden.bs.modal', function (e) {
                            $('#Login').modal('show');

                            $(this).off('hidden.bs.modal'); // Remove the 'on' event binding
                        });

            });
            </script>

            <script>

function post_fav(post_id)
{
	//alert(post_id);
	
	$.ajax({
              url     : "<?php echo $this->webroot;?>/users/post_fav",
              type    : "POST",
              cache   : false,
              data    : {post_id : post_id},
              success : function(data){
              	//alert(data);

              	if(data==1)
              	{

              	 $('#post_color'+post_id).addClass('active');
                }
                     
             
              }
          });
}


            </script>