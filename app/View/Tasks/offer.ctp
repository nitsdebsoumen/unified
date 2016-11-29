<?php ?>     
<section class="main_body">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php echo $this->element('user_sidebar'); ?>
            </div>
            <div class="col-md-9 whit_bg">
            <?php
            $error = 0;$image_type='';$birthday_type='';$phone_type='';$paypal_type='';$billing_type='';
            if(empty($baddress))
            {
            	$error = 1;$billing_type="billing";
            }
            if($user['User']['paypal_email']=='' || empty($user['User']['paypal_email']))
            {
            	$error = 1;$paypal_type="paypal";
            }
            /*if($user['User']['birthday']=='' || empty($user['User']['birthday']))
            {
            	$error = 1;$birthday_type="birthday";
            }
            if($user['User']['phone_no']=='' || empty($user['User']['phone_no']))
            {
            	$error = 1;$phone_type="phone";
            }
            if($user['User']['profile_img']=='' || empty($user['User']['profile_img']))
            {
            	$error = 1;$image_type="image";
            }*/
            if($error)
            {	$errordisp = 'block';$offerdisp = 'none';$hitag="To confirm your offer";}
            else	
            {	$errordisp = 'none';$offerdisp = 'block';$hitag="Make your offer.";}
            ?>
            <div class="right_dash_board" >
                <h1 style="text-transform: none;"><?php echo $hitag?></h1>
            	<div class="row" id="errordisp" style="display:<?php echo $errordisp?>">
            	
				<div class="form-group col-md-12">
					
					<!--<div class="col-md-10 mainDiv">
						<label  onclick="$('#imageDiv').show()">Upload a Profile Picture</label>
						<div class="input-group col-md-10"  onclick="$('#imageDiv').show()">
							<div style="float:left;">Set Profile Image</div>
							<i id="check_title" class="fa fa-check float_right <?php echo($image_type==''?'active':'')?>" style="margin-top:0px;"></i>
						</div>
						<div id="imageDiv" style="display:none;">
							<form name="image" id="profile_iamge" method="post" action="" enctype="multipart/form-data" >
							<div class="form-group col-md-6">
		                           <label for="UserProfileImg">Upload Image *</label>
		                           <div class="input-group">
		                               <span class="input-group-addon">Upload photo</span>
		                               <input type="file" name="data[User][profile_img]" id="UserProfileImg" class="form-control" required="required"/>
		                           </div>
		                       	</div>
		                       	<div class="form-group col-md-12">
				                     <button class="btn btn-success" type="submit" name="post_image" value="postImage">Save Changes</button>
				                     <button class="btn btn-danger" type="button" onclick="$('#imageDiv').hide()">Cancel</button>
				               </div>
				               </form>
						</div>
					</div>
					
					<div class="col-md-10 mainDiv" >
						<label onclick="$('#birthdayDiv').show()">Provide a Date of Birth</label>
						<div class="input-group col-md-10" onclick="$('#birthdayDiv').show()">
							<div style="float:left;"> <?php echo($user['User']['birthday']=='0000-00-00'?'Set Your date of Birth':$user['User']['birthday'])?></div>
							<i id="check_title" class="fa fa-check float_right <?php echo($birthday_type==''?'active':'')?>" style="margin-top:0px;"></i>
						</div>
						<div id="birthdayDiv" style="display:none;">
							<form name="birthdy" id="profile_birthdy" method="post" action="" enctype="multipart/form-data" >
							<div class="form-group col-md-6">
		                           	<label for="UserBirthday">Birthday *</label>
                                		<input type="text" name="data[User][birthday]" maxlength="100" id="UserBirthday" required="required" class="form-control" placeholder="YYYY-mm-dd" value="<?php echo($user['User']['birthday']!='0000-00-00'?$user['User']['birthday']:'');?>"/>
		                       	</div>
		                       	<div class="form-group col-md-12">
				                     <button class="btn btn-success" type="submit" name="post_birthday" value="postBirthday">Save Changes</button>
				                     <button class="btn btn-danger" type="button" onclick="$('#birthdayDiv').hide()">Cancel</button>
				               </div>
				               </form>
						</div>
					</div>
					
					<div class="col-md-10 mainDiv" >
						<label onclick="$('#phoneDiv').show()">Provide a Mobile Number</label>
						<div class="input-group col-md-10" onclick="$('#phoneDiv').show()">
							<div style="float:left;"> <?php echo(($user['User']['phone_no']=='' || empty($user['User']['phone_no']))?'Set Your Mobile number':$user['User']['phone_no'])?></div>
							<i id="check_title" class="fa fa-check float_right <?php echo($phone_type==''?'active':'')?>" style="margin-top:0px;"></i>
						</div>
						<div id="phoneDiv" style="display:none;">
							<form name="phonePro" id="profile_phone" method="post" action="" enctype="multipart/form-data" >
							<div class="form-group col-md-6">
		                           	<label for="UserBirthday">Mobile Number *</label>
                                		<input type="text" name="data[User][phone_no]" maxlength="100" id="Userphone_no" required="required" class="form-control" placeholder="Enter your mobile number" value="<?php echo($user['User']['phone_no']);?>"/>
		                       	</div>
		                       	<div class="form-group col-md-12">
				                     <button class="btn btn-success" type="submit" name="post_phone" value="postPhone">Save Changes</button>
				                     <button class="btn btn-danger" type="button" onclick="$('#phoneDiv').hide()">Cancel</button>
				               </div>
				               </form>
						</div>
					</div>-->
					
					<div class="col-md-10 mainDiv" >
						<label onclick="$('#paypalDiv').show()">Provide your Paypal Email to recieve payment</label>
						<div class="input-group col-md-10" onclick="$('#paypalDiv').show()">
							<div style="float:left;"> <?php echo(($user['User']['paypal_email']=='' || empty($user['User']['paypal_email']))?'Set Your Paypal Email':$user['User']['paypal_email'])?></div>
							<i id="check_title" class="fa fa-check float_right <?php echo($paypal_type==''?'active':'')?>" style="margin-top:0px;"></i>
						</div>
						<div id="paypalDiv" style="display:none;">
							<form name="paypalPro" id="profile_paypal" method="post" action="" enctype="multipart/form-data" >
							<div class="form-group col-md-6">
		                           	<label for="UserBirthday">Paypal Email *</label>
                                		<input type="text" name="data[User][paypal_email]" maxlength="100" id="Userphone_no" required="required" class="form-control" placeholder="Enter your paypal email" value="<?php echo($user['User']['paypal_email']);?>"/>
		                       	</div>
		                       	<div class="form-group col-md-12">
				                     <button class="btn btn-success" type="submit" name="post_paypal" value="postPaypal">Save Changes</button>
				                     <button class="btn btn-danger" type="button" onclick="$('#paypalDiv').hide()">Cancel</button>
				               </div>
				               </form>
						</div>
					</div>
					
					<div class="col-md-10 mainDiv" >
						<label onclick="$('#billingDiv').show()">Provide a Billing Address</label>
						<div class="input-group col-md-10" onclick="$('#billingDiv').show()">
							<div style="float:left;"> <?php echo(( empty($baddress))?'Set Your billing Address':'Already have set your Billing Address')?></div>
							<i id="check_title" class="fa fa-check float_right <?php echo($billing_type==''?'active':'')?>" style="margin-top:0px;"></i>
						</div>
						<div id="billingDiv" style="display:none;">
							<form name="phonePro" id="profile_phone" method="post" action="" enctype="multipart/form-data" >
							<div class="form-group col-md-6">
		                           	<label for="UserBirthday">Street Address *</label>
                                		<input type="text" name="data[BillingAddress][street_address]" maxlength="100" id="street_address" required="required" class="form-control" placeholder="Enter your street address" value="<?php echo(!empty($baddress)?$baddress['BillingAddress']['street_address']:'');?>"/>
		                       	</div>
		                       	<div class="form-group col-md-6">
		                           	<label for="UserBirthday">Post Code *</label>
                                		<input type="text" name="data[BillingAddress][zip_code]" maxlength="100" id="zip_code" required="required" class="form-control" placeholder="Enter your post code" value="<?php echo(!empty($baddress)?$baddress['BillingAddress']['zip_code']:'');?>"/>
		                       	</div>
		                       	<div class="form-group col-md-6">
		                           	<label for="UserBirthday">City *</label>
                                		<input type="text" name="data[BillingAddress][city]" maxlength="100" id="city" required="required" class="form-control" placeholder="Enter your city" value="<?php echo(!empty($baddress)?$baddress['BillingAddress']['city']:'');?>"/>
		                       	</div>
		                       	<div class="form-group col-md-6">
		                           	<label for="UserBirthday">State *</label>
                                		<input type="text" name="data[BillingAddress][state]" maxlength="100" id="state" required="required" class="form-control" placeholder="Enter your state" value="<?php echo(!empty($baddress)?$baddress['BillingAddress']['state']:'');?>"/>
		                       	</div>
		                       	<div class="form-group col-md-6">
		                           	<label for="UserBirthday">Country *</label>
                                		<input type="text" name="data[BillingAddress][country]" maxlength="100" id="country" required="required" class="form-control" placeholder="Enter your country" value="<?php echo(!empty($baddress)?$baddress['BillingAddress']['country']:'');?>"/>
		                       	</div>
		                       	<div class="form-group col-md-12">
				                     <button class="btn btn-success" type="submit" name="post_billing" value="postBilling">Save Changes</button>
				                     <button class="btn btn-danger" type="button" onclick="$('#billingDiv').hide()">Cancel</button>
				               </div>
				               </form>
						</div>
					</div>
					
				</div>
            	</div>
            	
            	
            	<div class="row" id="offerdisp" style="display:<?php echo $offerdisp?>">
		       	
		       	<form class="edit_profile" action="" method="post" enctype="multipart/form-data">
		       	<input type="hidden" name="data[Proposal][your_amount]" id="your_amount" value="<?php echo isset($proposalEdit['Proposal']['your_amount'])?$proposalEdit['Proposal']['your_amount']:'';?>">
		       	<input type="hidden" name="data[Proposal][site_amount]" id="site_amount" value="<?php echo isset($proposalEdit['Proposal']['site_amount'])?$proposalEdit['Proposal']['site_amount']:'';?>">
                        <input type="hidden" name="data[Proposal][paypal_fee]" id="paypal_fee" value="<?php echo isset($proposalEdit['Proposal']['paypal_fee'])?$proposalEdit['Proposal']['paypal_fee']:'';?>">
		       	<input type="hidden" name="site_percentage" id="site_percentage" value="<?php echo $sitesetting['SiteSetting']['site_percentage'];?>">
                        <input type="hidden" name="PayPalFeesPercentage" id="PayPalFeesPercentage" value="<?php echo Configure::read('PayPalFeesPercentage');?>">
                        <input type="hidden" name="PayPalFeesStatic" id="PayPalFeesStatic" value="<?php echo Configure::read('PayPalFeesStatic');?>">
		       		<div class="col-md-10 mainDiv" >
				  		<div class="form-group col-md-5" >
					  		<div class="input-group" id="totaldiv">
							  	<div class="input-group-addon">$</div>
							  	<input type="number" class="form-control" name="data[Proposal][amount]" min="0" value="<?php echo isset($proposalEdit['Proposal']['amount'])?$proposalEdit['Proposal']['amount']:'';?>"  id="amount" placeholder="Eg 25" style="width:100%">
							  	
						  	</div>
					  	</div>
                                                <?php
                                //$currency_arr=array('USD' => 'USD United States Dollars', 'AUD' => 'AUD Australia Dollars', 'SGD' => 'SGD Singapore Dollars', 'INR' => 'INR Indian Rupee', 'IDR' => 'IDR Indonesia Rupiah', 'MYR' => 'MYR Malaysia Ringgit', 'EUR' => 'EUR Euro', 'GBP' => 'GBP United Kingdom Pounds', 'JPY' => 'JPY Japan Yen', 'HKD' => 'HKD Hong Kong Dollars', 'THB' => 'THB Thailand Baht', 'KRW' => 'KRW Korea (South) Won',  'TWD' => 'TWD Taiwan Dollars', 'CNY' => 'CNY China Yuan Renmimbi');
                                $currency_arr=array('AUD' => 'AUD Australia Dollars', 'SGD' => 'SGD Singapore Dollars', 'INR' => 'INR Indian Rupee', 'IDR' => 'IDR Indonesia Rupiah', 'MYR' => 'MYR Malaysia Ringgit', 'EUR' => 'EUR Euro', 'GBP' => 'GBP United Kingdom Pounds', 'JPY' => 'JPY Japan Yen', 'HKD' => 'HKD Hong Kong Dollars', 'THB' => 'THB Thailand Baht', 'KRW' => 'KRW Korea (South) Won',  'TWD' => 'TWD Taiwan Dollars', 'CNY' => 'CNY China Yuan Renmimbi');
                                ?>
                                    <div class="form-group col-md-3" style="padding-top:10px; padding-right: 0px;"> <strong>Convert amount</strong></div>
                                                <div class="form-group col-md-4" >
                                                    <select name="currency" id="currency" class="form-control">
                                                        <option value="">Select your currency</option>
                                                        <?php
                                                        //$UserSelectCur=$this->session->userdata('UserSelectCur');
                                                        $UserSelectCur='';
                                                        foreach($currency_arr as $curCode => $curName){
                                                        ?>
                                                            <option value="<?php echo $curCode;?>" <?php if(isset($UserSelectCur) && $UserSelectCur==$curCode){ echo 'selected="selected"';}?>><?php echo $curName;?></option>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </select> 
					  		
					  	</div>
					  	<div class="form-group col-md-5">
					  		<div id="yourAmountDiv">You will get $<span id="yourAmount">0.00</span></div>
					  		<div id="siteAmountDiv"> Service Fee $<span id="siteAmount">0.00</span></div>
                                                        <div id="PaypalAmountDiv">Paypal Fee $<span id="PaypalFee">0.00</span></div>
					  	</div>
                                    <div class="form-group col-md-6" id="convert_price_msg"></div>
		                  	<div class="form-group col-md-10">
		                      	<label for="UserBirthday">Why are you good at this task? *</label>
		                 		<textarea name="data[Proposal][comments]" id="comments" class="form-control"><?php echo isset($proposalEdit['Proposal']['comments'])?$proposalEdit['Proposal']['comments']:'';?></textarea>
		                  	</div>
		                  	<div class="form-group col-md-12">
				                     <button class="btn btn-success" type="submit" name="post_offer" value="postOffer">Confirm Offer</button>
				                     <button class="btn btn-danger" type="button" onclick="$('#billingDiv').hide()">Cancel</button>
				          </div>
                       	</div>
		       	</form>
            	</div>
            </div>
            
                
            </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function () {
    $("#amount").on('focus blur keyup', function () {
        var $this = $(this);
        if ($this.val() == '0') { //$this.val('0');
            $("#your_amount").val('0');
            $("#yourAmount").html('0.00');
            $("#site_amount").val('0');
            $("#siteAmount").html('0.00');
            $("#paypal_fee").val('0');
            $("#PaypalFee").html('0.00');
        }else{
            calAmount();
        }
    });
    // currency convert
    $("#currency").change(function(){
       var currency_type=$(this).val();
       //alert(currency_type);
       var your_amount=$('#your_amount').val();
       var site_amount=$('#site_amount').val();
       var paypal_fee=$('#paypal_fee').val();
       
       //var VenueDftCurrencySymbol=$('#VenueDftCurrencySymbol').val();
        if(currency_type==''){
            alert('Please select a currency.');
            $('#currency').focus();
            return false;
        }else if(your_amount > 0 && site_amount > 0 && paypal_fee > 0){
            //$("#loading-div-background").modal('show');
            $.post('<?php echo($this->webroot);?>users/convert_my_currency/'+your_amount+'/'+site_amount+'/'+paypal_fee+'/'+currency_type,function(data){
                if(data!=''){
                    //alert(data);
                    //window.location = currenturl;
                    var PriceArray = data.split(':');
                    $('#convert_price_msg').html('');
                    $('#convert_price_msg').html('<div>You will get '+PriceArray[0]+'</div><div>Service Fee '+PriceArray[1]+'</div><div>Paypal Fee '+PriceArray[2]+'</div>');
                    //$("#loading-div-background").modal('hide');
                } 
            });
            /*$.ajax({
                 type : "POST", 
                 url : "<?php echo $this->webroot; ?>users/convert_my_currency/"+your_amount+"/"+site_amount+"/"+paypal_fee+"/"+currency_type,
                 cache:false,
                 success : function(data){ 
                     alert(data);
                     if(data!=''){
                        var PriceArray = data.split(':');
                        $('.SpacetimatePrice').html(PriceArray[0]);
                        $('.PerPersonPrice').html(PriceArray[1]+' / person');
                        $("#loading-div-background").modal('hide');
                     }
                 }

            });*/
        }else{
            alert('Please enter amount.');
            $('#amount').focus();
            return false;
        }
    });
});


function calAmount(){
    var chosenPercent =  $('#site_percentage').val();
    var amount = $('#amount').val();
    var PayPalFeesPercentage = $('#PayPalFeesPercentage').val();
    var PayPalFeesStatic = $('#PayPalFeesStatic').val();
    
    if(amount!=''){
        var siteAmount = (chosenPercent*amount)/100;
        siteAmount = siteAmount.toFixed(2);
        //alert(prcnt);
        var PayPalFeesPer = (PayPalFeesPercentage*amount)/100;
        PayPalFeesPer = PayPalFeesPer.toFixed(2);
        
        var PayPalAmt = (parseFloat(PayPalFeesPer)+parseFloat(PayPalFeesStatic));
        PayPalAmt = PayPalAmt.toFixed(2);
        
        var yourAmount = (parseFloat(amount)-parseFloat(siteAmount)-parseFloat(PayPalAmt));
        yourAmount = yourAmount.toFixed(2);
        //alert(total);
        $("#your_amount").val(yourAmount);
        $("#yourAmount").html(yourAmount);
        $("#site_amount").val(siteAmount);
        $("#siteAmount").html(siteAmount);
        $("#paypal_fee").val(PayPalAmt);
        $("#PaypalFee").html(PayPalAmt);

    }else{
        $("#your_amount").val('0');
        $("#yourAmount").html('0.00');
        $("#site_amount").val('0');
        $("#siteAmount").html('0.00');
        $("#paypal_fee").val('0');
        $("#PaypalFee").html('0.00');
    }
				
}
</script>
<script>  
/*$('.right_dash_board').enscroll({
    showOnHover: false,
    verticalTrackClass: 'track3',
    verticalHandleClass: 'handle3'
});*/

$(function(){
    $( "#UserBirthday" ).datepicker({ 
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        yearRange: "-100:+0"
    });
});
</script>
<style>
.mainDiv{
padding: 10px 20px;
border: 1px solid #ddd;
border-radius: 5px;
margin: 20px;
}
.float_right{
float:right
}
</style>

                
                
