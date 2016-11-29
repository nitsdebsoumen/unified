<?php
//pr($chat);
//exit;
if(!empty($login_user['UserImage']))
{
    $user_profile_image = $this->webroot.'user_images/'.$login_user['UserImage']['0']['originalpath'];
    $login_image = $login_user['UserImage'][0]['originalpath'];
}
else
{
    $user_profile_image = $this->webroot.'user_images/default.png';
    $login_image = $this->webroot.'user_images/default.png';
}
?>
<script src="<?php echo $this->webroot; ?>bower_components/moment/moment.js"></script>
<script src="<?php echo $this->webroot; ?>bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $this->webroot; ?>bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" /> 
<style>
    .overflow-visible
    {
        overflow: visible !important;
    }
</style>
<section class="inner-wrapper" style="background:#EFEFF4;">
	<div class="container">
		<div class="row">
			<div class="col-md-11 middle-div">
				<div class="row">
					<div class="col-md-3 chat_left">
						<div class="chat_left_holder">
							<div class="chat_header_search">
								<form class="form-inline">
								  <div class="form-group">
								    <input type="text" class="form-control" id="exampleInputEmail2" placeholder="">
								  </div>
								  <button type="submit" class="btn btn-default">Go</button>
								</form>
							</div>
							<div class="chat_left_list">
								<?php 
									$login_id = $login_user['User']['id'];
									$login_name = $login_user['User']['first_name'].' '.$login_user['User']['last_name'];
									
                                                                        if($post_details['User']['id'] == $login_user['User']['id'])
                                                                        {
								foreach($offer_user as $user_key =>$user_val ) { 
										$user_id = $user_val['User']['id'];
										$user_name = $user_val['User']['first_name'].' '.$user_val['User']['last_name'];
										$user_image = "";
									?>
                                                            <div class="media <?php echo $user_val['User']['id']==$offer_details['User']['id']?'activs':''; ?>" style="cursor:pointer" onclick="window.location='<?php echo $this->webroot.'posts/message_chat/'.$post_details['Post']['id'].'/'.$user_val['Post']['id']; ?>'">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php 
                                                                      if(!empty($user_val['User']['UserImage']))
                                                                      {
                                                                          echo $this->webroot.'user_images/'.$user_val['User']['UserImage']['0']['originalpath'];
                                                                      }
                                                                      else
                                                                      {
                                                                          echo $this->webroot.'user_images/default.png';
                                                                      }
                                                                       ?>">
								    </a>
								    <span class="pink">MarketPlace</span>
								  </div>
								  <div class="media-body">
								    <h4 class="media-heading"><?php echo $user_name; ?></h4>
								    <p>Hithere,Are you still looking for this...</p>
								  </div>
								  <!--<div class="media-right">
								    <span>4:40 AM</span>
								    <b>3</b>
								  </div>-->
								</div>
								<?php }
                                                                        } 
                                                                        else
                                                                        { 
                                                                            $user_id = $post_details['User']['id'];
                                                                            $user_name = $post_details['User']['first_name'].' '.$post_details['User']['last_name'];
                                                                            $user_image = "";
                                                                            ?>
                                                                            <div class="media activs" 
                                                                     onclick="" id="user_<?php echo $user_id; ?>">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php 
                                                                      if(!empty($post_details['User']['UserImage']))
                                                                      {
                                                                          echo $this->webroot.'user_images/'.$post_details['User']['UserImage']['0']['originalpath'];
                                                                      }
                                                                      else
                                                                      {
                                                                          echo $this->webroot.'user_images/default.png';
                                                                      }
                                                                       ?>">
								    </a>
								    <span class="pink">MarketPlace</span>
								  </div>
								  <div class="media-body">
								    <h4 class="media-heading"><?php echo $user_name; ?></h4>
								    <p>Hithere,Are you still looking for this...</p>
								  </div>
								  <!--<div class="media-right">
								    <span>4:40 AM</span>
								    <b>3</b>
								  </div>-->
								</div>
                                                                        <?php
                                                                        } ?>
								<!--<div class="media">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg">
								    </a>
								    <span class="sky">MarketPlace</span>
								  </div>
								  <div class="media-body">
								    <h4 class="media-heading">We Love Shoes</h4>
								    <p>Hithere,Are you still looking for this...</p>
								  </div>
								  <div class="media-right">
								    <span>4:40 AM</span>
								    <b>3</b>
								  </div>
								</div>
								<div class="media">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg">
								    </a>
								    <span class="yellow">MarketPlace</span>
								  </div>
								  <div class="media-body">
								    <h4 class="media-heading">We Love Shoes</h4>
								    <p>Hithere,Are you still looking for this...</p>
								  </div>
								  <div class="media-right">
								    <span>4:40 AM</span>
								    <b>3</b>
								  </div>
								</div>-->
							</div>
						</div>
					</div>
					<div class="col-md-6 chat_middle">
						<div class="chat_middle_holder">
							<div class="chat_mid_header">
								<div class="media">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php 
                                                                      if(!empty($post_details['PostImage']))
                                                                      {
                                                                          echo $this->webroot.'img/post_img/'.$post_details['PostImage']['0']['originalpath'];
                                                                      }
                                                                      else {
                                                                          echo $this->webroot.'images/user-image.jpg';
                                                                      }
                                                                       ?>" style="width:100%;height:100%">
								    </a>
								  </div>
								  <div class="media-body">
								    <h4 class="media-heading"><?php echo $post_details['Post']['post_title']; ?></h4>
								    <p><i class="head_locatin"></i>5 miles - <?php echo $post_details['Post']['location'];?></p>
                                                                    <?php 
                                                                    $date1=date_create($post_details['Post']['post_date']);
                                                                    $date2=date_create(date('Y-m-d'));
                                                                    $diff=date_diff($date1,$date2);
                                                                    ?>
								    <p><i class="head_times"></i><?php if($diff->days==0){ ?> Just now<?php }else if($diff->days==1){ echo ' '.$diff->days.' '.'Day ago';}else{ echo ' '.$diff->days.' '.'Days ago'; } ?></p>
								  </div>
								  <div class="media-right">
								    <span>$<?php echo number_format($post_details['Post']['price']);?></span>
								    <p>Negotiable</p>
								  </div>
								</div>
							</div>
							<div class="chat_body" id="chat_section">
                                                            <?php foreach($chats as $chat){
                                                                if($chat['Chat']['receiver_id'] == $login_user['User']['id'])
                                                                {
                                                                    ?>
                                                                    <div class="media"><div class="media-left"><a href="javascript:void(0)"><img class="media-object" src="<?php echo $chat['Chat']['s_image']; ?>"></a></div><div class="media-body"><p><?php echo $chat['Chat']['message']; ?></p></div></div>
                                                                    <?php
                                                                }
                                                                else { ?>
                                                                    
                                                                    <div class="media media_me"><div class="media-body"><p><?php echo $chat['Chat']['message']; ?></p></div></div>
                                                                    <?php                                                                 
                                                                }
                                                            } ?>
								<!--<div class="media">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg">
								    </a>
								  </div>
								  <div class="media-body">
								    <p>Hithere,Are you still looking for this... <span>14:19 pm</span></p>
								   
								  </div>
								</div>
								<div class="media media_me">
								  <div class="media-body">
								    <p>Hithere,Are you still looking for this... <span>14:19 pm</span></p>
								   
								  </div>
								</div>
								<div class="sp_date">
									<span>THU, SEP 18, 2:43 PM</span>
								</div>
								<div class="media">
								  <div class="media-left">
								    <a href="#">
								      <img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg">
								    </a>
								  </div>
								  <div class="media-body">
								    <p>Hithere,Are you still looking for this... <span>14:19 pm</span></p>
								   
								  </div>
								</div>
								<div class="media media_me">
								  <div class="media-body">
								    <p>Hithere,Are you still looking for this... <span>14:19 pm</span></p>
								   
								  </div>
								</div>-->
							</div>
							<div class="chat_footer" id="footer_section">
								<!--<form class="form-inline">
								  <div class="form-group">
								    <input type="text" class="form-control" id="exampleInputName2" placeholder="Jane Doe">
								  </div>
								  <div class="form-group">
								    <button type="submit" class="btn btn-default"><img src="<?php echo $this->webroot; ?>/images/flight-white.svg" style="width:25px"></button>
								  </div>
								  <div class="form-group">
								    <button type="submit" class="btn btn-default acpt_ofr">Accept Offer</button>
								  </div>
								</form>-->
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="spotlight">
							<div class="sponsord_add">
								<h3>Sponsored Ads</h3>
								<span>Based on your interests</span>
							</div>
							<div class="spotlight-holder">
								<div class="spotlight-holder-top">
									<span class="round"><img alt="" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></span>
									<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
								</div>
								<ul>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-1.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-2.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-3.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-4.png"></li>
								</ul>
								<div class="clearfix"></div>
								<p class="text-right follow-link"><a class="btn btn-default btn-sm" href="">Follow</a></p>
							</div>
							<div class="spotlight-holder">
								<div class="spotlight-holder-top">
									<span class="round"><img alt="" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></span>
									<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
								</div>
								<ul>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-1.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-2.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-3.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-4.png"></li>
								</ul>
								<div class="clearfix"></div>
								<p class="text-right follow-link"><a class="btn btn-default btn-sm" href="">Follow</a></p>
							</div>
							<div class="spotlight-holder">
								<div class="spotlight-holder-top">
									<span class="round"><img alt="" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></span>
									<p>We Love Shoes <span class="small-desc">75 Products  |  19 followers</span></p>
								</div>
								<ul>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-1.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-2.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-3.png"></li>
									<li><img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>/images/spot-4.png"></li>
								</ul>
								<div class="clearfix"></div>
								<p class="text-right follow-link"><a class="btn btn-default btn-sm" href="">Follow</a></p>
							</div>
							<p class="text-center">
								<a href="">See More</a>
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<div class="modal fade" id="acpt_offer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Accept Offer</h4>
      </div>
      <form>
	      <div class="modal-body">
			  <div class="form-group">
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Meeting Tittle">
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Location">
			  </div>
			  <div class="form-group">
			    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Price (If any)">
			  </div>
			  <div class="form-group">
			    <textarea class="form-control" id="exampleInputEmail1" placeholder="Meeting Details"></textarea>
			  </div>
			  <div class="form-group">
			  	<div class="row">
			  		<div class="col-md-6"><input type="date" class="form-control" id="exampleInputEmail1" placeholder="Date"></div>
			  		<div class="col-md-6"><input type="time" class="form-control" id="exampleInputEmail1" placeholder="Time"></div>
			  	</div>
			  </div>
			  <div class="form-group">
			   	<p>Who’s Going</p>
			   	<ul>
				   	<li><img alt="" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></li>
				   	<li><img alt="" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></li>
				</ul>
			  </div>
			  <div class="form-group">
			   	<p>Emergency Contact</p>
			   	<ul>
				   	<li><img alt="" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></li>
				   	<li><img alt="" src="<?php echo $this->webroot; ?>/images/plus_circle.svg"></li>
				</ul>
			  </div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
	        <button type="button" class="btn btn-primary">Close Deal</button>
	      </div>
      </form>
    </div>
  </div>
</div>

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
        var original_reciever_id;

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

//          function fillInAddress() {
//            // Get the place details from the autocomplete object.
//            var place = autocomplete.getPlace();
//            console.log(place);
//          }

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
					var str = get_confirm_message();
					$('#chat_section').append('<div class="media media_me"><div class="media-body"><p>'+umsg+'</p></div></div>');
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
        
	var session_id=<?php echo $_SESSION['user_id'];?>
	
	//create a new WebSocket object.
	var wsUri = "ws://107.170.152.166:25768/server.php"; 	
	websocket = new WebSocket(wsUri); 
	
	websocket.onopen = function(ev) { // connection is open 
		//$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
		console.log('New connection ==== ',ev);
                var v={connection_status:true,user_id:session_id,is_connected:true,post_id:<?php echo $post_details['Post']['id']; ?>};
                websocket.send(JSON.stringify(v));
	}
        
//        websocket.onclose = function(ev) { // connection is open 
//		//$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
//		console.log('Disconnected  ==== ',ev);
//                var v={connection_status:true,user_id:session_id,is_connected:false,post_id:<?php echo $post_details['Post']['id']; ?>};
//                websocket.send(JSON.stringify(v));
//	}
        
        window.onbeforeunload = function() {
            websocket.onclose = function(ev) { // connection is open 
		//$('#message_box').append("<div class=\"system_msg\">Connected!</div>"); //notify user
		console.log('Disconnected  ==== ',ev);
                var v={connection_status:true,user_id:session_id,is_connected:false,post_id:<?php echo $post_details['Post']['id']; ?>};
                websocket.send(JSON.stringify(v));
	}; // disable onclose handler first
            websocket.close()
        };

	
	
	//#### Message received from server?
	websocket.onmessage = function(ev) {
                console.log(ev.data);
		var msg = JSON.parse(ev.data); //PHP sends Json data
		//alert(msg);
		var type = msg.type; //message type
		var umsg = msg.message; //message text
		var uname = msg.name; //user name
		var ucolor = msg.color; //color
		var ureceivename = msg.receive_name;
		var usenderid = msg.sender_id;
		var usreceiverid = msg.receiver_id;
		var r_name = msg.r_name;
		var r_image = msg.r_image;
		var s_name = msg.s_name;
		var s_image = msg.s_image;
                var offer_id = msg.offer_id;
		
		
		
                if(umsg!=null && uname!=null)
                {
                    if(type == 'usermsg') 
                    {
                        
                        if(ureceivename == session_id && offer_id== '<?php echo $offer_details['Post']['id']; ?>')
                        {	
                            $('#chat_section').find('.typing_div').remove();

                            if ($('#footer_section').length == 0){                                
                                    check_button(usenderid,s_name,s_image,ureceivename,r_name,r_image);                                
                                    $('#chat_section').append('<div class="media"><div class="media-left"><a href="javascript:void(0)"><img class="media-object" src="'+s_image+'"></a></div><div class="media-body"><p>'+umsg+'</p></div></div>');
                            } else{
                                    $('#chat_section').append('<div class="media"><div class="media-left"><a href="javascript:void(0)"><img class="media-object" src="'+s_image+'"></a></div><div class="media-body"><p>'+umsg+'</p></div></div>');
                            }                

                            //$('#chat_section').append('<div class="media"><div class="media-left"><a href="javascript:void(0)"><img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></a></div><div class="media-body"><p>'+umsg+'</p></div></div>');       

                            var msg = {read_msg:true,user_id:session_id,offer_id:offer_id,msg_id:msg.msg_id};
                            websocket.send(JSON.stringify(msg));  
                        }
                        if(usenderid == session_id && offer_id== '<?php echo $offer_details['Post']['id']; ?>')
                        {
                            $('#chat_section').append('<div class="media media_me"><div class="media-body"><p>'+umsg+'</p></div></div>');
                        }
                        
                        var height = 0;
                        $('.media').each(function(){
                            height += $(this).height() + 15;
                        });
                        $('#chat_section').scrollTop(height+20);

                    }
                    else if(type == 'typing')
                    {
                        if(usreceiverid == session_id && offer_id== '<?php echo $offer_details['Post']['id']; ?>')
                        {
                            if($('#chat_section').find('.typing_div').length==0)
                            {
                                $('#chat_section').append('<div class="media typing_div"><div class="media-left"><a href="javascript:void(0)"><img class="media-object" src="'+s_image+'"></a></div><div class="media-body"><p>Typing ....</p></div></div>');
                            }
                            
                           
                            
                        }
                        var height = 0;
                        $('.media').each(function(){
                            height += $(this).height() + 15;
                        });
                        $('#chat_section').scrollTop(height+20);
                    }
                    else if(type=='stop_typing')
                    {
                        if(usreceiverid == session_id && offer_id== '<?php echo $offer_details['Post']['id']; ?>')
                        {
                            $('#chat_section').find('.typing_div').remove();
                        }
                    }
                }   
		
            };
	
	
	websocket.onerror	= function(ev){console.log(ev)};
	websocket.onclose 	= function(ev){console.log(ev)};
	
        
});

function get_confirm_message()
{
	var str='<div class="request">';
         str+='<div class="media media_request left">';
         str+=' <div class="msg_sender">';
         str+='  <a href=""><img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></a>';
         str+=' </div>';
         str+=' <div class="media-left">';
         str+='     <a href="#">';
         str+='       <img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/add-photo.jpg">';
         str+='     </a>';
         str+=' </div>';
         str+=' <div class="media-body">';
         str+='     <h4 class="media-heading">Macbook Pro 17”</h4>';
         str+='     <b>$2,350</b>';
         str+='     <span>Request to buy from <a href="">me</a></span>';
         str+=' </div>';
         str+=' <div class="media-right">';
         str+='  <button class="acpt">Accept</button>';
         str+='  <button>Reject</button>';
         str+=' </div>';
         str+=' <div class="angle_right"></div>';
          str+='<span class="time">14:19 pm</span>';
         str+='</div>';
        str+='</div>';
        str+='<div class="media">';
          str+='<div class="media-left">';
            str+='<a href="#">';
              str+='<img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg">';
            str+='</a>';
          str+='</div>';
          str+='<div class="media-body">';
            str+='<p>Hithere,Are you still looking for this... <span>14:19 pm</span></p>';
           
          str+='</div>';
        str+='</div>';
        str+='<div class="request">';
         str+='<div class="media media_request">';
          str+='<div class="media-left">';
              str+='<a href="#">';
                str+='<img class="img-responsive" alt="" src="<?php echo $this->webroot; ?>images/add-photo.jpg">';
              str+='</a>';
          str+='</div>';
          str+='<div class="media-body">';
              str+='<h4 class="media-heading">Macbook Pro 17”</h4>';
              str+='<b>$2,350</b>';
              str+='<span>Request to buy from <a href="">me</a></span>';
          str+='</div>';
          str+='<div class="media-right">';
           str+='<button>Cancel Request</button>';
           str+='<button>Safety Send</button>';
          str+='</div>';
          str+='<div class="angle_right"></div>';
          str+='<span class="time">14:19 pm</span>';
         str+='</div>';
        str+='</div>';
		return str;
}

function check_button(id,name,image,sender_id,sender_name,sender_image)
	{

		//alert(id);
		
		
        
                        
                        //alert($('#main_chat_box_'+id).length);
                //var chat_str ='<div class="small_chat_box" id="main_chat_box_'+id+'"><div class="chat_head" id="chat_top_sec_'+id+'"><p>'+name+'</p><ul><li><a href="javascript:void(0)" class="fa fa-minus-square-o minz" id="min_'+id+'" onclick="minimize('+id+')"></a></li><li><a href="javascript:void(0)" class="fa fa-plus-square-o maxz" id="max_'+id+'" onclick="maximize('+id+')"></a></li></ul></div><div class="open_close" id="chat_main_sec_'+id+'"><div class="chat_body" id="chat_text_sec_'+id+'"><ul class="chat_convs" id="chat_text_body_'+id+'"></ul></div><div class="msg_text_box" id="chat_bottom_sec_'+id+'"><input type="text" name="message" id="message_'+id+'"><input type="hidden" name="receiver_name" id="receiver_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+id+'"><input type="hidden" name="sender_id" id="sender_id_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_id+'"><input type="hidden" name="receiver_id" id="receiver_id_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+id+'"><input type="hidden" name="r_name" id="r_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+name+'"><input type="hidden" name="r_image" id="r_image_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+image+'"><input type="hidden" name="s_image" id="s_image_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_image+'"><input type="hidden" name="s_name" id="s_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_name+'"><button id="send-btn" onclick="send_message('+id+')"><i class="fa fa-send"></i></button></div></div></div>';
                //console.log(chat_str);

                var chat_body  = '<div class="media"><div class="media-left"><a href="javascript:void(0)"><img class="media-object" src="<?php echo $this->webroot; ?>/images/user-image.jpg"></a></div><div class="media-body"><p>Hithere,Are you still looking for this...</p></div></div><div class="media media_me"><div class="media-body"><p>Hithere,Are you still looking for this...</p></div></div>';

                if(<?php echo $post_details['User']['id']; ?> == <?php echo $login_user['User']['id']; ?>)
                {
                    var chat_footer= '<form class="form-inline"><div class="form-group"><input type="hidden" id="original_receiver" value="'+id+'"><input type="text" class="form-control msg_text" name="message" id="message_'+id+'"></div><div class="form-group"><button type="button"  class="btn btn-default" id="send-btn" onclick="send_message('+id+')"><img src="<?php echo $this->webroot; ?>/images/flight-white.svg" style="width:25px"></button></div><div class="form-group"><button type="button" class="btn btn-default acpt_ofr" data-toggle="modal" data-target="#request_to_buy">Accept Offer</button></div><input type="hidden" name="receiver_name" id="receiver_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+id+'"><input type="hidden" class="sender_id" name="sender_id" id="sender_id_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_id+'"><input type="hidden" name="receiver_id" id="receiver_id_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+id+'"><input type="hidden" name="r_name" id="r_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+name+'"><input type="hidden" name="r_image" id="r_image_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+image+'"><input type="hidden" name="s_image" id="s_image_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_image+'"><input type="hidden" name="s_name" id="s_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_name+'"></form>'
                }
                else
                {
                    var chat_footer= '<form class="form-inline"><div class="form-group"><input type="hidden" id="original_receiver" value="'+id+'"><input type="text" class="form-control msg_text" name="message" id="message_'+id+'"></div><div class="form-group"><button type="button"  class="btn btn-default" id="send-btn" onclick="send_message('+id+')"><img src="<?php echo $this->webroot; ?>/images/flight-white.svg" style="width:25px"></button></div><div class="form-group"></div><input type="hidden" name="receiver_name" id="receiver_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+id+'"><input type="hidden" class="sender_id" name="sender_id" id="sender_id_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_id+'"><input type="hidden" name="receiver_id" id="receiver_id_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+id+'"><input type="hidden" name="r_name" id="r_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+name+'"><input type="hidden" name="r_image" id="r_image_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+image+'"><input type="hidden" name="s_image" id="s_image_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_image+'"><input type="hidden" name="s_name" id="s_name_'+id+'" placeholder="" maxlength="10" style="width:20%" value="'+sender_name+'"></form>';//<input type="file" id="attachment_file">
                }
                //$("#chat_section").html(chat_body);
                $("#footer_section").html(chat_footer);
                
                
                        //alert($('#main_chat_box_'+id).length);
        
       /* $.ajax({
            type: "post",
            url: "<?php echo SITEURL; ?>ajax_get_chat.php",                            
            data: {'from_id':id,'to_id':sender_id},
            success: function (data) {
                if(data){
                $("#chat_text_sec_"+id).show();   
		    $('#chat_text_body_'+id).append(data);
		    }
                
            }
        });  */ 

	}

	function send_message(id)
        {
        //alert(id);
        var mymessage = $('#message_'+id).val(); //get message text
        $('#message_'+id).val('');
        //alert(mymessage);
	        var myname = $('#sender_name').val(); //get user name
	
	        if(myname == ""){ //empty name?
		        alert("Enter your Name please!");
		        return;
	        }
	        if(mymessage == ""){ //emtpy message?
		        alert("Enter Some message Please!");
		        return;
	        }

	        var receive_name = $('#receiver_name_'+id).val();
	        var sender_id =  $('#sender_id_'+id).val();
	        var receiver_id =  $('#receiver_id_'+id).val();
	        
	        var r_name = $('#r_name_'+id).val();
	        var r_image =  $('#r_image_'+id).val();
	        var s_name =  $('#s_name_'+id).val();
	        var s_image =  $('#s_image_'+id).val();
	
	        //prepare json data
	        var msg = {
	        message: mymessage,
	        name: s_name,
	        color : '000',
	        receive_name: receive_name,
	        sender_id: sender_id,
	        receiver_id: receiver_id,
	        r_name: r_name,
	        r_image: r_image,
	        s_image: s_image,
	        s_name: s_name,
                offer_id: '<?php echo $offer_details['Post']['id']; ?>'
	
	        };
            console.log(msg);
	        //convert and send data to server
	        websocket.send(JSON.stringify(msg));    
        }
        
        $(function(){
            $(document).on('keypress','.msg_text',function(event){
                
                var keycode = (event.keyCode ? event.keyCode : event.which);
                //console.log(keycode);
                    if(keycode == '13'){
                        $(this).closest('.form-inline').find('#send-btn').trigger('click');
                        return false;
                    }
                    else
                    {
                       send_typing_stat();
                    }
                    //
            })
            $(document).on('blur','.msg_text',function(event){
                send_stop_typing();
            })
            var height = 0;
            $('.media').each(function(){
                height += $(this).height() + 15;
            });
            $('#chat_section').scrollTop(height+20);
            
            $(document).on('change','#attachment_file',function(e){
               var selectedFile = this.files[0];
                selectedFile.convertToBase64(function(base64){
                     //alert(base64);
                      var id= $('#original_receiver').val();
                    var myname = $('#sender_name').val();
                    var receive_name = $('#receiver_name_'+id).val();
                    var sender_id =  $('#sender_id_'+id).val();
                    var receiver_id =  $('#receiver_id_'+id).val();

                    var r_name = $('#r_name_'+id).val();
                    var r_image =  $('#r_image_'+id).val();
                    var s_name =  $('#s_name_'+id).val();
                    var s_image =  $('#s_image_'+id).val();
                    var msg = {
                        attach:true,
                        file:base64.replace(/^data:image\/(png|jpg);base64,/, ""),
                        name: s_name,
                        color : '000',
                        receive_name: receive_name,
                        sender_id: sender_id,
                        receiver_id: receiver_id,
                        r_name: r_name,
                        r_image: r_image,
                        s_image: s_image,
                        s_name: s_name,
                        offer_id: '<?php echo $offer_details['Post']['id']; ?>'
                    };
                    console.log(JSON.stringify(msg));
                    websocket.send(JSON.stringify(msg)); 
                }) 
                
                   
                     //alert(base64);
                     
                
            });
        })
        
        function send_stop_typing()
        {
            var id= $('#original_receiver').val();
            console.log('idddddddddd',id);
            var myname = $('#sender_name').val();
            var receive_name = $('#receiver_name_'+id).val();
            var sender_id =  $('#sender_id_'+id).val();
            var receiver_id =  $('#receiver_id_'+id).val();

            var r_name = $('#r_name_'+id).val();
            var r_image =  $('#r_image_'+id).val();
            var s_name =  $('#s_name_'+id).val();
            var s_image =  $('#s_image_'+id).val();
            var msg = {
                stop_typing:true,
                name: s_name,
                color : '000',
                receive_name: receive_name,
                sender_id: sender_id,
                receiver_id: receiver_id,
                r_name: r_name,
                r_image: r_image,
                s_image: s_image,
                s_name: s_name,
                offer_id: '<?php echo $offer_details['Post']['id']; ?>'
            };
            console.log(msg);
            websocket.send(JSON.stringify(msg)); 
        }
        
        function send_typing_stat()
        {
            var id= $('#original_receiver').val();
            console.log('idddddddddd',id);
            var myname = $('#sender_name').val();
            var receive_name = $('#receiver_name_'+id).val();
            var sender_id =  $('#sender_id_'+id).val();
            var receiver_id =  $('#receiver_id_'+id).val();

            var r_name = $('#r_name_'+id).val();
            var r_image =  $('#r_image_'+id).val();
            var s_name =  $('#s_name_'+id).val();
            var s_image =  $('#s_image_'+id).val();
            var msg = {
                typing:true,
                name: s_name,
                color : '000',
                receive_name: receive_name,
                sender_id: sender_id,
                receiver_id: receiver_id,
                r_name: r_name,
                r_image: r_image,
                s_image: s_image,
                s_name: s_name,
                offer_id: '<?php echo $offer_details['Post']['id']; ?>'
            };
            console.log(msg);
            websocket.send(JSON.stringify(msg)); 
        }
        File.prototype.convertToBase64 = function(callback){
            var reader = new FileReader();
            //console.log(reader);
            reader.onload = function(e) {
                //console.log(e.target.result);
                 callback(e.target.result)
            };
            reader.onerror = function(e) {
                 callback(null);
            };        
            reader.readAsDataURL(this);
        };

    
        
</script>

<script>
    
    <?php if($post_details['User']['id'] == $login_user['User']['id'])
          { ?>
		original_reciever_id = 	<?php echo $post_details['User']['id']; ?>;						
    check_button('<?php echo $offer_details['User']['id'];?>','<?php echo $offer_details['User']['first_name'].' '.$offer_details['User']['last_name'];?>','<?php #echo $user_image;?>','<?php echo $login_id;?>','<?php echo $login_name;?>','<?php echo $user_profile_image;?>');
            <?php
          } 
          else
          { ?>
              original_reciever_id = 	<?php echo $user_id; ?>;
              check_button('<?php echo $user_id;?>','<?php echo $user_name;?>','<?php echo $user_image;?>','<?php echo $login_id;?>','<?php echo $login_name;?>','<?php echo $user_profile_image;?>')
        <?php  } ?>
    
	//$('#acpt_offer').modal('show');
        
        
</script>
<style>
    .chat_body
    {
        height: 362px;
        max-height: 362px;
    }
</style>











