<?php
//pr($user); exit;
?>
<!--<div class="top-list-menu">
    <div class="menu">
        <ul>
            <li><a href="<?php //echo $this->webroot; ?>"><?php //echo HOME; ?></a></li>
            <li>></li>
            <li><a href="<?php //echo $this->webroot . 'users/coursefilter/' .$slug; ?>"><?php //echo COURSES; ?></a></li>
            <li>></li>
            <li><a href="#"><?php //echo COURSE_DETAILS; ?></a></li>
        </ul>
    </div>
</div>-->

<section class="listing_result">
    <div class="container">
        <div class="row">
  				<div class="col-md-9 center-div">
    				<h2 class="text-center">Featured Provider Plans</h2>
    				<ul class="price-plan">
						<li class="plan first-plan">
							<h4><?php echo $plans[0]['MembershipPlan']['title'];?> Feature Plans</h4>
							<div class="plan-body">
								<h2 class="main-price">₦<?php echo $plans[0]['MembershipPlan']['price']; ?></h2>
								<hr>
								<?php echo $plans[0]['MembershipPlan']['content']; ?>
                                <p class="plan-desc">
                                VAT % For Being Featured Provider :  <?php echo $setting['Setting']['featured_provider_vat'];?>
                                </p>
                                <?php 
                                if($plans[0]['MembershipPlan']['price']>$user['MembershipPlan']['price']){
                                ?>
								<p class="text-center"><a href="<?php echo $this->webroot; ?>users/membership_checkout/<?php echo base64_encode($plans[0]['MembershipPlan']['id']);?>" class="btn btn-default">Book Now</a></p>
                                <?php } else{ ?>
                                <p class="text-center"><a href="#" class="btn btn-default" disabled>Book Now</a></p>
                                <?php } ?>
							</div>
						</li>
						<li class="plan second-plan">
							<h4><?php echo $plans[1]['MembershipPlan']['title']; ?> Feature Plans</h4>
							<div class="plan-body">
								<h2 class="main-price">₦<?php echo $plans[1]['MembershipPlan']['price']; ?></h2>
								<hr>
								<?php echo $plans[1]['MembershipPlan']['content']; ?>
                                <p class="plan-desc">
                                VAT % For Being Featured Provider :  <?php echo $setting['Setting']['featured_provider_vat'];?>
                                </p>
                                 <?php 
                                if($plans[1]['MembershipPlan']['price']>$user['MembershipPlan']['price']){
                                ?>
                                <p class="text-center"><a href="<?php echo $this->webroot; ?>users/membership_checkout/<?php echo base64_encode($plans[1]['MembershipPlan']['id']);?>" class="btn btn-default">Book Now</a></p>
                                <?php } else{ ?>
                                <p class="text-center"><a href="#" class="btn btn-default" disabled>Book Now</a></p>
                                <?php } ?>
							</div>
						</li>
						<li class="plan third-plan">
							<h4><?php echo $plans[2]['MembershipPlan']['title']; ?> Feature Plans</h4>
							<div class="plan-body">
								<h2 class="main-price">₦<?php echo $plans[2]['MembershipPlan']['price']; ?></h2>
								<hr>
								<?php echo $plans[2]['MembershipPlan']['content']; ?>
                                <p class="plan-desc">
                                VAT % For Being Featured Provider :  <?php echo $setting['Setting']['featured_provider_vat'];?>
                                </p>
                                 <?php 
                                if($plans[2]['MembershipPlan']['price']>$user['MembershipPlan']['price']){
                                ?>
                                <p class="text-center"><a href="<?php echo $this->webroot; ?>users/membership_checkout/<?php echo base64_encode($plans[2]['MembershipPlan']['id']);?>" class="btn btn-default">Book Now</a></p>
                                <?php } else{ ?>
                                <p class="text-center"><a href="#" class="btn btn-default" disabled>Book Now</a></p>
                                <?php } ?>
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
<script>
$(document).ready(function(){
    $("#add_wishlist").click(function(){
        var user_wish_id = $("#user_id").val();
        var course_wish_id = $("#course_id").val();
        
        $.ajax({
            url: "<?php echo $this->webroot; ?>users/ajaxaddWishlist",
            type: 'post',
            dataType: 'json',
            data: {
                user_id:user_wish_id,
                post_id:course_wish_id
            },
            success: function(result){
                console.log(result);
                if(result==1)
                {
                    $('#add_wishlist').hide();
                    $('#remove_wishlist').show();
                }
            }
        });
    });
    $("#remove_wishlist").click(function(){
        var user_wish_id = $("#user_id").val();
        var course_wish_id = $("#course_id").val();
        
        $.ajax({
            url: "<?php echo $this->webroot; ?>users/ajaxremoveWishlist",
            type: 'post',
            dataType: 'json',
            data: {
                user_id:user_wish_id,
                post_id:course_wish_id
            },
            success: function(result){
                  console.log(result);
                if(result==1)
                {
                  $('#remove_wishlist').hide();
                  $('#add_wishlist').show();
                }
            }
        });
    });

    $("#add_cart").click(function(){
        var course_wish_id = $("#course_id").val();
        
        $.ajax({
            url: "<?php echo $this->webroot; ?>temp_carts/ajax_add_to_cart",
            type: 'post',
            dataType: 'json',
            data: {
                post_id:course_wish_id
            },
            success: function(result){
                console.log(result);
                if(result.ack == '1') {
                $('#cart_holder').html(result.html);
                $('#cart_quantity').html(result.qty);
                $('#cart_update').show();
                setTimeout(function() { $("#cart_update").hide(); }, 5000);
                } else {
                }  
            }
        });
    });

});

</script>