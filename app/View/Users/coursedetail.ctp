<?php
//$id = $coursedetail[0]['Post']['category_id'];
$slug = $coursedetail[0]['Category']['slug'];

//echo '<pre>',print_r($coursedetail);
//die();

?>
<div class="top-list-menu">
    <div class="menu">
        <ul>
            <li><a href="<?php echo $this->webroot; ?>"><?php echo HOME; ?></a></li>
            <li>></li>
            <li><a href="<?php echo $this->webroot . 'users/search/' .$slug; ?>"><?php echo COURSES; ?></a></li>
            <li>></li>
            <li><?php echo $coursedetail[0]['Post']['post_title']; ?></li>
        </ul>
    </div>
</div>

<section class="listing_result">

    <!-- <div class="container">
        <div class="row training-list-area">

            <div class="col-md-3">
                <div class="training-list">
               	    <img src="<?php //echo $this->webroot; ?>img/post_img/<?php //echo $coursedetail[0]['PostImage'][0]['originalpath']; ?>" width="236" height="244"  alt=""/>
                    <h4><?php //echo ABOUT; ?> <?php //echo $coursedetail[0]['Post']['post_title']; ?></h4>
                    <div class="star">
                        <i aria-hidden="true" class="fa fa-star"></i>
                        <i aria-hidden="true" class="fa fa-star"></i>
                        <i aria-hidden="true" class="fa fa-star"></i>
                        <i aria-hidden="true" class="fa fa-star"></i>
                        <i aria-hidden="true" class="fa fa-star"></i>
                        (12 reviews)
                    </div>
                    <p>Skills for Health is the leading provider of high quality and flexible e-learning solutions and Institute of Leadership & Management (ILM) Accredited programmes delivering to the UK health sector with over 500,000 completions per annum in the NHS.</p>
                    <p><a href="#"> <?php //echo READ_MORE; ?> >></a></p>
                </div>
            </div>


            <div class="col-md-6">
                <div class="detail-mid-area">
                    <h3><?php //echo $coursedetail[0]['Post']['post_title'] . ' By : ' . $coursedetail[0]['User']['first_name'] . ' ' . $coursedetail[0]['User']['last_name']; ?></h3>

                    <h4><?php //echo DESCRIPTION; ?></h4>
                    <?php //echo $coursedetail[0]['Post']['post_description']; ?>

                    <h4 style="padding:16px 0 6px;"><span class="training-cost"><?php //echo TRAINING_COST; ?></span></h4>
                    <p><span class="training-price"><?php //echo '$' . $coursedetail[0]['Post']['price']; ?></span></p>

                    <h4 style="padding:12px 0 10px;"><?php //echo LOCATION; ?></h4>
                    <p> <span class="training-price"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php //echo $coursedetail[0]['Post']['address']; ?></span> </p>

                    <h4 style="padding:30px 0 6px;"> <span class="training-cost"> <?php //echo DURATION; ?> </span> </h4>
                    <p> <?php //echo $coursedetail[0]['Post']['course_duration']; ?> </p>

                    <div class="btn-area">
                        <button class="btn btn-default" type="submit"><?php //echo BOOK_NOW; ?></button>
                        <button class="btn btn-default enquary" type="submit"><?php //echo MAKE_ENQUIRY; ?></button>
                    </div>
                    <div class="review-area">
                        <h4> <?php //echo REVIEWS;?> </h4>
                        <?php //echo $this->element('my_reviews',array('all_reviews'=>$all_reviews)); ?>
                        <?php
                            $id = $this->Session->read('userid');
                            if (isset($id)) {
                                //echo $this->element('write_review', array(
                                //'postId'=>$coursedetail[0]['Post']['id']));
                            }

                        ?>

                    </div>
                </div>
            </div>

            <div class="col-md-3">

            <?php if(isset($userid)) { ?>
            <div class="training-list">

                <button id="add_cart" class="btn btn-default book-now" style="width:235px;"><?php //echo BOOK_NOW?></button>
                <span id="cart_update" style="display:none;">Course Is Added to Your Cart</span>
                <button class="btn btn-default-gray"  style="width:235px;" ><?php //echo MAKE_ENQUIRY?></button>
                <span id="wishlistdeails">
                <?php if(isset($whishlistexist) && $whishlistexist==1)
                        {
                  ?>
                      <button class="btn btn-success btn-success-green" id="remove_wishlist" style="width:235px;"  ><?php //echo REMOVE_FROM_WISHLIST; ?></button>
                      <button class="btn btn-success btn-success-green" id="add_wishlist" style="width:235px;display:none;" ><?php //echo ADD_TO_WISHLIST;?></button>
                  <?php
                        }
                        else
                        {
                            ?>
                                <button class="btn btn-success btn-success-green" id="add_wishlist" style="width:235px;" ><?php //echo ADD_TO_WISHLIST;?></button>
                                  <button class="btn btn-success btn-success-green" id="remove_wishlist" style="width:235px;display:none;"  ><?php //REMOVE_FROM_WISHLIST; ?></button>
                            <?php
                        }
                ?>
            </span>

                <input type="hidden" id="user_id" value="<?php //echo $userid; ?>" />
                <input type="hidden" id="course_id" value="<?php //echo $coursedetail[0]['Post']['id']; ?>" >
            </div>
            <?php  } ?>

                <div class="training-list">
                    <h5><?php //echo SHARE_WITH; ?></h5>

                    <div class="social-media-area">
                        <ul class="clearfix">
                            <li><a href="javascript:void(0);" onclick="facebook_share()"><img src="<?php //echo $this->webroot; ?>images/face-book.jpg" width="36" height="36"  alt=""/></a></li>
                            <li><a href="javascript:void(0);" onclick="twShare()"><img src="<?php //echo $this->webroot; ?>images/twitter.jpg" width="36" height="36"  alt=""/></a></li>
                            <li><a href="javascript:void(0);" onclick="lnShare()"><img src="<?php //echo $this->webroot; ?>images/linked-in.jpg" width="36" height="36"  alt=""/></a></li>
                        </ul>
                    </div>

                </div>
            </div>



        </div>
    </div> -->




    <div class="container-fluid details_head">
		<div class="row details_head_row">
			<div class="col-md-3 detail_img">
                <?php if(!empty($coursedetail[0]['User']['user_logo']) && $coursedetail[0]['User']['user_logo']!=''){?>
				<img src="<?php echo $this->webroot; ?>user_logo/<?php echo $coursedetail[0]['User']['user_logo']; ?>" style="margin:0 auto; height:height:154px; " alt="" />
                <?php } else{ ?>
                <img src="<?php echo $this->webroot; ?>images/no_image.png" style="margin:0 auto; height:height:154px; " alt="" />
                <?php } ?>
			</div>
			<div class="col-md-9">
				<h3><?php echo $coursedetail[0]['Post']['post_title']; ?></h3>
				<p><?php echo $coursedetail[0]['Post']['post_description']; ?></p>
				<p><span class="location"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $coursedetail[0]['Post']['address']; ?></span></p>
				<?php
                $rating = 0;
                $count = 0;
                $avgRating = 0;
                foreach ($coursedetail[0]['Rating'] as $key => $value) {
                   $rating = $rating + $value['comfort'];
                   $count++; 
                }
                if($count!=0){
                $avgRating = round($rating/$count);
                $blankRating = 5-$avgRating;
                }
                else{
                   $blankRating = 5; 
                }
                ?>
                <p>Rating: <div class="star">
                    <?php 
                        for ($i=0;$i<$avgRating;$i++) { ?>
                            <i class="fa fa-star" aria-hidden="true"></i>
                    <?php    }
                    ?>
                    <?php 
                        for ($i=0;$i<$blankRating;$i++) { ?>
                            <i class="fa fa-star-o" aria-hidden="true"></i>
                    <?php    }
                    ?>
									<!-- <i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i>
									<i class="fa fa-star" aria-hidden="true"></i> -->
								</div></p>
				<p>Price: <span class="price">₦ <?php echo $coursedetail[0]['Post']['price']; ?></span></p>
			</div>
		</div>
    </div>

    <div class="container-fluid details_content" style="background:#f6f6f680;">
    	<div class="row content_rows">
    		<div class="col-md-12"><p> </p></div>
				<div class="col-md-8" style="padding: 15px 30px;">

				<div class="cover_content">
					<div class="headingss">
						<h3>About this course</h3>
					</div>
					<div class="details_content_p">
						<p><?php echo $coursedetail[0]['Post']['post_description']; ?><br /></p>
					<!-- 	<p><ul style="background: #fff;margin: 0;">
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						<li>  Basics of HTML and CSS</li>
						</ul>  </p> -->

					</div>
				</div>


				</div>

				<div class="col-md-4" style="padding: 15px 30px;">

				 <div class="cover_content">
					<div class="headingss">
						<h3>About this Provider</h3>
					</div>
						<div class="details_content_p">
					<h3><?php echo $coursedetail[0]['Post']['post_title'] . ' By : ' . $coursedetail[0]['User']['first_name'] . ' ' . $coursedetail[0]['User']['last_name']; ?></h3>
                    <h5><?php echo 'Email By : ' . $coursedetail[0]['User']['email_address']; ?></h5>
					</div>
				 </div>


				</div>



				<div class="col-md-12" style="padding: 15px 30px;">

				<div class="cover_content">
					<div class="headingss">
						<h3>See all locations and prices</h3>
					</div>
					<div class="details_content_p">
						<p>
						  <div class="table-responsive">
							<table class="table">
							  <thead>
								<tr>
								  <th>Training Cost</th>
								  <th>Location</th>
								  <th>Duration </th>
                                  <?php if(isset($userid)) { ?>
								  <th>Book</th>
                                  <?php } ?>
								</tr>
							  </thead>
							  <tbody>
								<tr>
								  <th scope="row">₦ <?php echo $coursedetail[0]['Post']['price']; ?></th>
								  <td><span class="training-price"> <i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $coursedetail[0]['Post']['location']; ?> </span></td>
								  <td><?php echo $coursedetail[0]['Post']['course_duration']; ?> </td>
								  <td>
                                  <?php if(isset($userid)) { ?>
                                  
                                    <button id="add_cart" class="btn btn-default book-now" style="padding: 5px;margin: 0;font-size: 14px;"><?php echo BOOK_NOW?></button>

                                    <input type="hidden" id="user_id" value="<?php echo $userid; ?>" />
                                    <input type="hidden" id="course_id" value="<?php echo $coursedetail[0]['Post']['id']; ?>" >
                                 
                                  
                                  <span id="wishlistdeails">
                                  <?php if(isset($whishlistexist) && $whishlistexist==1)
                                            {
                                      ?>
                                          <button class="btn btn-success btn-success-green" id="remove_wishlist" style="padding: 5px;margin: 0;font-size: 14px;"  ><?php echo REMOVE_FROM_WISHLIST; ?></button>
                                          <button class="btn btn-success btn-success-green" id="add_wishlist" style="padding: 5px;margin: 0;font-size: 14px;display:none;" ><?php echo ADD_TO_WISHLIST;?></button>
                                      <?php
                                            }
                                            else
                                            {
                                                ?>
                                                    <button class="btn btn-success btn-success-green" id="add_wishlist" style="padding: 5px;margin: 0;font-size: 14px;" ><?php echo ADD_TO_WISHLIST;?></button>
                                                      <button class="btn btn-success btn-success-green" id="remove_wishlist" style="padding: 5px;margin: 0;font-size: 14px;display:none;"  ><?php echo REMOVE_FROM_WISHLIST; ?></button>
                                                <?php
                                            }
                                    ?>
                                 <?php } ?>
                                 <button class="btn btn-default-gray" data-toggle="modal" data-target="#myModal" style="padding: 5px;margin: 0;font-size: 14px;" ><?php echo MAKE_ENQUIRY?></button>    
                                </span></br>
                                <span id="cart_update" style="display:none;">Course Is Added to Your Cart</span>
                                    </td>
								</tr>

							  </tbody>
							</table>
							</div>
						 </p>

					</div>
				</div>


				</div>


				<div class="col-md-12" style="padding: 15px 30px;">

    				<div class="cover_content">
    					<div class="headingss">
    						<h3><?php echo REVIEWS;?></h3>
    					</div>
    					<div class="details_content_p">
    						<?php echo $this->element('my_reviews',array('all_reviews'=>$all_reviews)); ?>
                        <?php
                            $id = $this->Session->read('userid');
                            if (isset($id)) {
                                if($review_status==1 && $review_status!=''){
                                    echo $this->element('write_review', array(
                                    'postId'=>$coursedetail[0]['Post']['id']));
                                }
                            }

                        ?>

    					</div>
    				</div>


				</div>


    	</div>
    </div>
<div class="container">
  <!-- <h2>Modal Example</h2> -->
  <!-- Trigger the modal with a button -->
  <!-- <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button> -->

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Make Enquiry</h4>
        </div>
        <div class="right_bar">
                    <form class="form-horizontal" id="enquiry_form">
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Your Name:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[user_name]" value="" required="required">
                            </div>
                            
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Your Email:</label>
                            <div class="col-sm-8">
                                <input type="email" class="form-control border" id="" name="data[email]" value="" required="required">
                            </div>
                            
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Subject:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control border" id="" name="data[subject]" value="" required="required">
                            </div>
                            
                        </div>
                        <div class="form-group profile-field">
                            <label for="inputEmail3" class="col-sm-3 right-text">Query:</label>
                            <div class="col-sm-8">
                                <textarea type="text" class="form-control border" id="" name="data[query]" value="" required="required" >Enter text here...</textarea>
                            </div>
                           <input type="hidden" name="data[post_id]" value="<?php echo $coursedetail[0]['Post']['id']; ?>" >
                        </div>
                        
                    </form>
                    <button type="button" class="btn btn-default" style="display: table;
                            margin: 0 auto;" id="submit">Submit</button>
                 
                </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>




   <style>
   .details_head {background:#f5f3f3;}
   .details_head_row {width:95%; margin:0 auto; padding:20px;}
   .detail_img img {height:210px;}
   .content_rows {width:95%; margin:0 auto;}
   .details_content_p p {text-align:justify;padding: 10px 15px; background:#fff; margin:0;}
   .details_content_p p ul {background:#fff;}
   .headingss h3 {background: #f5f3f3;padding: 10px 15px; margin-top:0px;}
   .cover_content {border: 2px solid #f5f3f3;}
   .table {margin-bottom:0; background:#fff;}
   </style>
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

    $(document).on('click',"#add_cart",function(){
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
    $("#submit").click(function(){
    $.ajax({
            url: "<?php echo $this->webroot; ?>enquiries/ajaxEnquiry",
            type: 'post',
            dataType: 'json',
            data: $("#enquiry_form").serialize(),
            success: function(result){
                console.log(result);
                if(result.ack==1){
                   $("#myModal").modal('hide');
                   alert("Your Enquiry Has Been Saved"); 
                }
                
            }
        });
    });

});

</script>
