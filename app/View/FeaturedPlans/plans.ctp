
<section class="listing_result">
    <div class="container">
        <div class="row">
  				<div class="col-md-9 center-div">
    				<h2 class="text-center">Featured Course Plans </h2>
    				<ul class="price-plan">
						<li class="plan first-plan">
							<h4><?php echo $plans[0]['FeaturedPlan']['title'];?> Membership</h4>
							<div class="plan-body">
								<h2 class="main-price">₦<?php echo $plans[0]['FeaturedPlan']['price']; ?></h2>
								<hr>
								<?php echo $plans[0]['FeaturedPlan']['content']; ?>
                                <p class="plan-desc">
                                    VAT % For To Feature You Course :  <?php echo $setting['Setting']['featured_course_vat'];?>
                                </p>
                                <!--   <?php 
                                if($plans[0]['FeaturedPlan']['price']>$user['FeaturedPlan']['price']){
                                ?> -->
								<p class="text-center"><a href="<?php echo $this->webroot; ?>featured_plans/featured_paln_order/<?php echo base64_encode($plans[0]['FeaturedPlan']['id']);?>" class="btn btn-default">Book Now</a></p>
                                <!--<?php } else{ ?>
                                <p class="text-center"><a href="#" class="btn btn-default" disabled>Book Now</a></p>
                                <?php } ?>-->
							</div>
						</li>
						<li class="plan second-plan">
							<h4><?php echo $plans[1]['FeaturedPlan']['title']; ?> Membership</h4>
							<div class="plan-body">
								<h2 class="main-price">₦<?php echo $plans[1]['FeaturedPlan']['price']; ?></h2>
								<hr>
								<?php echo $plans[1]['FeaturedPlan']['content']; ?>
                                <p class="plan-desc">
                                    VAT % For To Feature You Course :  <?php echo $setting['Setting']['featured_course_vat'];?>
                                </p>
                                <!--<?php 
                                if($plans[1]['FeaturedPlan']['price']>$user['FeaturedPlan']['price']){
                                ?>-->
                                <p class="text-center"><a href="<?php echo $this->webroot; ?>featured_plans/featured_paln_order/<?php echo base64_encode($plans[1]['FeaturedPlan']['id']);?>" class="btn btn-default">Book Now</a></p>
                                <!--<?php } else{ ?>
                                <p class="text-center"><a href="#" class="btn btn-default" disabled>Book Now</a></p>
                                <?php } ?>-->
							</div>
						</li>
						<li class="plan third-plan">
							<h4><?php echo $plans[2]['FeaturedPlan']['title']; ?> Membership</h4>
							<div class="plan-body">
								<h2 class="main-price">₦<?php echo $plans[2]['FeaturedPlan']['price']; ?></h2>
								<hr>
								<?php echo $plans[2]['FeaturedPlan']['content']; ?>
                                <p class="plan-desc">
                                    VAT % For To Feature You Course :  <?php echo $setting['Setting']['featured_course_vat'];?>
                                </p>
                                <!--<?php 
                                if($plans[2]['FeaturedPlan']['price']>$user['FeaturedPlan']['price']){
                                ?>-->
                                <p class="text-center"><a href="<?php echo $this->webroot; ?>featured_plans/featured_paln_order/<?php echo base64_encode($plans[2]['FeaturedPlan']['id']);?>" class="btn btn-default">Book Now</a></p>
                                <!--<?php } else{ ?>
                                <p class="text-center"><a href="#" class="btn btn-default" disabled>Book Now</a></p>
                                <?php } ?>-->
							</div>
						</li>
					</ul>
    			</div>
  			</div>
    </div>
</section>

<script>
    function facebook_share() {

        $.getScript('//connect.facebook.net/en_US/sdk.js', function () {
            FB.init({
                appId: '147920998965529',
                cookie: true,
                status: true,
                xfbml: true,
                version: 'v2.6'
            });

            FB.ui({
                method: 'feed',
                name: 'Ladder',
                link: '<?php echo Router::fullbaseUrl() . $this->here; ?>',
                picture: '<?php echo Router::fullbaseUrl() . $this->webroot . 'img/post_img/' . $coursedetail[0]['PostImage'][0]['originalpath']; ?>',
                caption: 'Ladder.ng',
                description: '<?php echo $coursedetail[0]['Post']['post_description']; ?>'
            },
            function (response) {
                if (response && response.post_id) {
                    alert('Post was published.');
                } else {
                    alert('Post was not published.');
                }
            }
            );

        });

    }

    function twShare(url, title, descr, image, winWidth, winHeight) {
        var url = '<?php echo Router::fullbaseUrl() . $this->here; ?>';
        var title = '<?php echo $coursedetail[0]['Post']['post_title']; ?>';
        var winWidth = '350px';
        var winHeight = '350px';
        
        var winTop = (screen.height / 2) - (winHeight / 2);
        var winLeft = (screen.width / 2) - (winWidth / 2);
        window.open('http://twitter.com/share?url=' + encodeURI(url) + '&text=' + encodeURI(title) + '', 'sharer', 'top=' + winTop + ',left=' + winLeft + ',toolbar=0,status=0,width=' + winWidth + ',height=' + winHeight);
    }
    
    function lnShare() {
        var url = '<?php echo Router::fullbaseUrl() . $this->here; ?>';
        var title = '<?php echo $coursedetail[0]['Post']['post_title']; ?>';
        var descr = '<?php echo $coursedetail[0]['Post']['post_description']; ?>';
        
        var articleUrl = encodeURIComponent(url);
        var articleTitle = encodeURIComponent(title);
        var articleSummary = encodeURIComponent(descr);
        var articleSource = encodeURIComponent('Laddr');
        var goto = 'http://www.linkedin.com/shareArticle?mini=true'+
             '&url='+articleUrl+
             '&title='+articleTitle+
             '&summary='+articleSummary+
             '&source='+articleSource;
         window.open(goto, "LinkedIn", "width=800,height=400,scrollbars=no;resizable=no");        
    }


</script>