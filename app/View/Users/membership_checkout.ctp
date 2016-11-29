<?php //pr($user); ?>
<style>
th,td {
    text-align: center;
}
</style>
<section class="cart-body">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h3>Shopping Details</h3>
					<div class="table-responsive">
            			<table class="table table-striped cart-table">
                			<thead>
        						<tr>
			                    	<!-- <th class="action" >Action</th> -->
			                    	<th>Product</th>
			                        <th>Product Description</th>
			                        <th>Duration</th>
			                        <th>Price</th>
			                        <!-- <th>Total</th> -->
			                    </tr>
        					</thead>
	                    	<tbody>
		                    	<tr>
			                    	<!-- <td class="text-center">
			                        	<a href="" class="cancel"><i class="fa fa-close"></i></a>
										<a href="" class="edit"><i class="fa fa-edit"></i></a>
			                        </td> -->
			                        <td>
			                        	<div class="itemimg">
			                                <?php echo $plan['MembershipPlan']['title'].' Membership';?>
			                                <input type="hidden" id="plan_id" value="<?php echo $plan['MembershipPlan']['id'];?>">
			                            </div>
			                        </td>
			                        <td>
			                        	<div class="itemdes">
			                        		<?php echo $plan['MembershipPlan']['content']; ?>
			                        	</div>
			                        </td>
			                        <td><p class="text-center"><?php echo $plan['MembershipPlan']['duration'].' Month'; ?></p></td>
			                        <td><p class="text-center">	₦<?php echo $plan['MembershipPlan']['price']; ?></p></td>
			                        
			                        <!-- <td><p class="text-center">$200</p></td> -->
		                    	</tr>
								<!-- <tr>
			                    	 <td class="text-center">
			                        	<a href="" class="cancel"><i class="fa fa-close"></i></a>
										<a href="" class="edit"><i class="fa fa-edit"></i></a>
			                        </td> 
			                        <td>
			                        	<div class="itemimg">
			                                <img src="images/p-4.jpg" alt="">
			                            </div>
			                        </td>
			                        <td>
			                        	<div class="itemdes">
			                        		<h4>Aliquam quaerat voluptatem</h4>
	                                    	<p>Labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam </p>
			                        	</div>
			                        </td>
			                        <td><p class="text-center">$100</p></td>
			                        <td><p class="text-center">2</p></td>
			                        <td><p class="text-center">$200</p></td>
		                    	</tr> -->
		                    	<?php if($user_order==0){ ?>
		                    	<tr>
	                        		<td colspan="2"></td>
			                        <td>
			                            <!-- <p>Order Subtotal </p>
			                            <p>Delivery Fee</p> -->
			                            <p><b> <?php echo $setting['Setting']['featured_provider_vat'];?> % VAT  </b></p>
			                            <!-- <button type="button" class="btn btn-success">Keep Shopping</button> -->
			                        </td>
			                        <td>
			                           <!--  <p>$12856.00</p>
			                            <p>$1300</p> -->
			                            <p><b><?php $total_plan_price = $plan['MembershipPlan']['price']+($plan['MembershipPlan']['price']*$setting['Setting']['featured_provider_vat']/100); echo '₦'.$plan['MembershipPlan']['price'].' + ₦'.$plan['MembershipPlan']['price']*$setting['Setting']['featured_provider_vat']/100;?></b></p>
			                            <!-- <button type="button" class="btn btn-primary">Proceed to Checkout</button> -->
			                        </td>
			                    </tr>
			                    <tr>
	                        		<td colspan="2"></td>
			                        <td>
			                            <!-- <p>Order Subtotal </p>
			                            <p>Delivery Fee</p> -->
			                            <p><b> <?php echo $setting['Setting']['set_commission'];?> % Admin Commission </b></p>
			                            <!-- <button type="button" class="btn btn-success">Keep Shopping</button> -->
			                        </td>
			                        <td>
			                           <!--  <p>$12856.00</p>
			                            <p>$1300</p> -->
			                            <p><b><?php $total_plan_price = $total_plan_price+($total_plan_price*$setting['Setting']['set_commission']/100); echo '₦'.$plan['MembershipPlan']['price'].' + ₦'.$plan['MembershipPlan']['price']*$setting['Setting']['set_commission']/100;?></b></p>
			                            <!-- <button type="button" class="btn btn-primary">Proceed to Checkout</button> -->
			                        </td>
			                    </tr>
			                    <tr>
	                        		<td colspan="2"></td>
			                        <td>
			                            <!-- <p>Order Subtotal </p>
			                            <p>Delivery Fee</p> -->
			                            <p><b> Total Price </b></p>
			                            <!-- <button type="button" class="btn btn-success">Keep Shopping</button> -->
			                        </td>
			                        <td>
			                           <!--  <p>$12856.00</p>
			                            <p>$1300</p> -->
			                            <p><b> ₦<?php echo $plan['MembershipPlan']['price'] + $plan['MembershipPlan']['price']*$setting['Setting']['set_commission']/100 + $plan['MembershipPlan']['price']*$setting['Setting']['featured_provider_vat']/100;?></b></p>
			                            <!-- <button type="button" class="btn btn-primary">Proceed to Checkout</button> -->
			                        </td>
			                    </tr>
			                    <?php } else { ?>

			                    <tr>
	                        		<td colspan="2"></td>
			                        <td>
			                            
			                            <p><b> First Time Subscription Offer Price </b></p>
			                            
			                        </td>
			                        <td>
			                           <!--  <p>$12856.00</p>
			                            <p>$1300</p> -->
			                            <p><b> ₦ 100</b></p>
			                            <!-- <button type="button" class="btn btn-primary">Proceed to Checkout</button> -->
			                        </td>
			                    </tr>

			                    <?php } ?>
			                    
		                	</tbody>
		               	 </table>
					</div>
				</div>
			</div>
		</div>
	</section>
	
	<section class="checkout-body">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<div class="row">
						<form >
							<div class="col-md-12">
								<h4>Your Cart / Payment Confirmation</h4>
								<hr>
								<h4>Your Information</h4>
								<div class="form-inline">
									<div class="form-group">
										<input type="text" placeholder="First Name" id="exampleInputEmail3" class="form-control" value="<?php if($user['User']['first_name']!=''){ echo $user['User']['first_name'];}?>">
									</div>
									<div class="form-group">
										<input type="text" placeholder="Last Name" id="exampleInputPassword3" class="form-control" value="<?php if($user['User']['last_name']!=''){ echo $user['User']['last_name'];}?>" >
									</div>
								</div>
								<hr>
							</div>
							<div class="col-sm-6 address">
								<h4>Billing Address</h4>
								<div class="form-group">
									<input type="text" placeholder="Address 1" class="form-control" id="address_1_1" value="<?php if($user['User']['address']!=''){ echo $user['User']['address'];}?>">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Address 2" class="form-control" id="address_2_1">
								</div>
								<div class="form-group">
									<input type="text" placeholder="City" value="<?php if($user['City']['name']!=''){ echo $user['City']['name'];}?>" class="form-control" id="city_1">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Zip Code" class="form-control" id="zip_1" value="<?php if($user['User']['zip']!=''){ echo $user['User']['zip'];}?>">
								</div>
							</div>
							<div class="col-sm-6 address">
								<h4>Shipping Address</h4>
								<div class="form-group">
									<input type="text" placeholder="Address 1" class="form-control" id="address_1_2"  >
								</div>
								<div class="form-group">
									<input type="text" placeholder="Address 2" class="form-control" id="address_2_2">
								</div>
								<div class="form-group">
									<input type="text" placeholder="City" class="form-control" id="city_2" value="">
								</div>
								<div class="form-group">
									<input type="text" placeholder="Zip Code" class="form-control" id="zip_2"  >
								</div>
							</div>
							<div class="col-md-12">
								<p class="same"><input type="checkbox" onchange="copy(this);" id="sameadd" > My shipping address is same as billing address</p>
								<hr>
							</div>
							<!-- <div class="col-md-12">
								<h4>Credit Card Info</h4>
								<div class="form-inline">
									<div class="form-group">
										<input type="text" placeholder="Credit card number" id="exampleInputEmail3" class="form-control">
									</div>
									<div class="form-group">
										<input type="text" placeholder="ID" id="exampleInputPassword3" class="form-control">
									</div>
									<div class="form-group">
										<input type="text" placeholder="CVV" id="exampleInputPassword3" class="form-control">
									</div>
								</div>
							<hr>
							<p class="text-right"><input type="submit" value="Submit Payment" class="btn btn-primary btn-lg"></p>
							</div> -->
						</form>
					</div>
				</div>
				<div class="col-md-3">
					<h4>Policies</h4>
					<p class="same"><input type="checkbox" id="shopping_id"> Shopping Policy</p>
					<spam id="shopping_spam" style="display:none; color:red;">Check Shopping Policy</spam>
					<p class="same"><input type="checkbox" id="legal_id">Legal Policy</p>
					<spam id="legal_spam" style="display:none; color:red;">Check Legal Policy</spam>
					<hr>
					<h4>Secure Payment</h4>
					<p><a class="btn" href="#" id="" onclick="payWithPaystack()" title="Make payments with Paystack!" style="background: #ee7c15 none repeat scroll 0 0 !important;">
                    <span><img src="<?php echo $this->webroot;?>payment/paymentLogo.png" border="0"></span></a></p>
				</div>
			</div>
		</div>
	</section>
<input type='hidden' value='<?php echo $plan['MembershipPlan']['plan_code'];?>'>
<?php
// //pr($cart);
// //if(!empty($cart)){
// // $user_id =$cart['User']['id'];
// // $post_id =$cart['Post']['id'];
// // $qty     =$cart['TempCart']['quantity'];
// // $cart_id =$cart['TempCart']['id'];

// // this file shows how you can call the CashEnvoy payment interface from your online store

// // your CashEnvoy merchant id
// $cemertid = 4024;

// // your merchant key (login to your cashenvoy account, your merchant key is displayed on the dashboard page)
// $key = '450997cff555def4d72c11e7ba5cee02';

// // transaction reference which must not contain any special characters. Numbers and alphabets only.
 $cetxref = $plan['MembershipPlan']['id'].$user['User']['id'].rand();

// // transaction amount
if($user_order==0){ 
	$ceamt =round($plan['MembershipPlan']['price'] + $plan['MembershipPlan']['price']*$setting['Setting']['set_commission']/100 + $plan['MembershipPlan']['price']*$setting['Setting']['featured_provider_vat']/100);
}else{
	$ceamt = 100;
}

// // customer id does not have to be an email address but must be unique to the customer
// $cecustomerid ='adaddad'; 

// // a description of the transaction
// $cememo = 'aasdad';

// // notify url - absolute url of the page to which the user should be directed after payment
// // an example of the code needed in this type of page can be found in example_requery_usage.php
// //$link=$this->Html->link(array('controller' => 'temp_carts', 'action' => 'getStatus', '?' => array('transref' =>'abc965445695ab', 'mertid' =>'4024'))); 

// $cenurl ='http://107.170.152.166/team4/ladder/users/membership_payment';

// // generate request signature
// $data = $key.$cetxref.$ceamt;
// $signature = hash_hmac('sha256', $data, $key, false);

// //echo $cenurl ;
?>
<input type="hidden" id="amount" value="<?php echo $ceamt;  ?>" >
<input type="hidden" id="transref" value="<?php echo $cetxref;  ?>" >
<input type="hidden" id="user_email" value="<?php echo $user['User']['email_address'];  ?>" >
<input type='hidden' id="plan_code" value='<?php echo $plan['MembershipPlan']['plan_code'];?>'>

<!-- <form  method="post" id="ce" name="ce" action="https://www.cashenvoy.com/sandbox/?cmd=cepay" target="_self">  
    <input type="hidden" name="ce_merchantid"   value="<?= $cemertid ?>"/>
    <input type="hidden" name="ce_transref"     value="<?= $cetxref ?>"/>
    <input type="hidden" name="ce_amount"       value="<?= $ceamt ?>"/>
    <input type="hidden" name="ce_customerid"   value="<?= $cecustomerid ?>"/>
    <input type="hidden" name="ce_memo"         value="<?= $cememo ?>"/>
    <input type="hidden" name="ce_notifyurl"    value="<?= $cenurl ?>"/>
    <input type="hidden" name="ce_window"       value="parent"/>
    <input type="hidden" name="ce_signature"    value="<?= $signature ?>"/>
    <!-- <a class="btn" href="#" onclick="this.blur(); document.ce.submit();" title="Make payments with CashEnvoy!">
    <span><img src="https://www.cashenvoy.com/images/paybt.jpeg" border="0"></span></a> 
</form> -->
<?php //} ?>

<script src="https://js.paystack.co/v1/inline.js"></script>
<script type="text/javascript">
function copy(cd)
{
	
					 var cb = document.getElementById('sameadd');
		    var address_1_1 = document.getElementById("address_1_1");
		    var address_2_1 = document.getElementById("address_2_1");
		    var city_1      = document.getElementById("city_1");
		    var zip_1       = document.getElementById("zip_1");
		    var address_1_2 = document.getElementById("address_1_2");
		    var address_2_2 = document.getElementById("address_2_2");
		    var city_2      = document.getElementById("city_2");
		    var zip_2       = document.getElementById("zip_2");
	if(cd.checked){	    
		  address_1_2.value = address_1_1.value;
		  address_2_2.value = address_2_1.value;
		       city_2.value = city_1.value;
		        zip_2.value = zip_1.value;
		 document.getElementById("address_1_2").disabled = true ; 
		 document.getElementById("address_2_2").disabled = true ; 
		      document.getElementById("city_2").disabled = true ; 
		       document.getElementById("zip_2").disabled = true ;        
	}
	else{
		  address_1_2.value = '';
		  address_2_2.value = '';
		       city_2.value = '';
		        zip_2.value = '';
		 document.getElementById("address_1_2").disabled = false ; 
		 document.getElementById("address_2_2").disabled = false ; 
		      document.getElementById("city_2").disabled = false ; 
		       document.getElementById("zip_2").disabled = false ;         

	}		        
}


$('#ladder_pay').click(function(e){
	e.preventDefault();
	var ret_url = $('#ce input[name="ce_notifyurl"]').val();
	
	var _address_1_1 = $("#address_1_1").val();
    var _address_2_1 = $("#address_2_1").val();
    var _city_1      = $("#city_1").val();
    var _zip_1       = $("#zip_1").val();
    var _address_1_2 = $("#address_1_2").val();
    var _address_2_2 = $("#address_2_2").val();
    var _city_2      = $("#city_2").val();
    var _zip_2       = $("#zip_2").val();
    var _plan_id     = $("#plan_id").val();
    var _transref    = $("#transref").val();
    var _plan_code   = $("#plan_code").val();

    ret_url = ret_url + '?billing_add1=' + _address_1_1 + '&billing_add2=' + _address_2_1 + '&billing_city=' + _city_1 + '&billing_zip=' + _zip_1 + '&shipping_add1=' + _address_1_2 + '&shipping_add2=' + _address_2_2 + '&shipping_city=' + _city_2 + '&shipping_zip=' + _zip_2 + '&plan_id=' + _plan_id + '&meritid='+ _meritid + '&transref=' + _transref;

    $('#ce input[name="ce_notifyurl"]').val(ret_url);

    document.ce.submit();
});

function payWithPaystack(){
	if($("#shopping_id").is(':checked') && $("#legal_id").is(':checked')) {
		var _address_1_1 = $("#address_1_1").val();
	    var _address_2_1 = $("#address_2_1").val();
	    var _city_1      = $("#city_1").val();
	    var _zip_1       = $("#zip_1").val();
	    var _address_1_2 = $("#address_1_2").val();
	    var _address_2_2 = $("#address_2_2").val();
	    var _city_2      = $("#city_2").val();
	    var _zip_2       = $("#zip_2").val();
	    var _amount      = $("#amount").val(); 
	    var _plan_id     = $("#plan_id").val();
		var user_email   = $("#user_email").val();
		var transref     = $("#transref").val();
		var _plan_code   = $("#plan_code").val();
	    var handler = PaystackPop.setup({
	      key: 'pk_test_659a3e8cbc2cd54331193585bf41cbf5bd19c389',
	      email: user_email,
	      amount: _amount,
	      ref: transref,
	      metadata: {
	         custom_fields: [
	            {
	                billing_address: _address_1_1+','+_address_2_1+','+_city_1+','+_zip_1,
	               shipping_address: _address_1_2+','+_address_2_2+','+_city_2+','+_zip_2
	            }
	         ]
	      },
	      callback: function(response){
	      			jQuery.ajax({
	                      url: "<?php echo $this->webroot;?>payment/testcallcurl.php",
	                      type: 'post',
	                      dataType: 'json',
	                      data: {
	                         reference:response.reference,
	                          trxref:response.trxref
	                      },
	                    success: function(result){
	                        if(result.status == true){
	                          jQuery.ajax({
				                url: "<?php echo $this->webroot;?>payment/subscription.php",
				                type: 'post',
				                dataType: 'json',
				                data: {
				                         uEmail : result.data.customer.customer_code,
				                      plan_code : _plan_code
				                },
				                success: function(result){
				                  if(result.status==true){
				                  	jQuery.ajax({
					                	url: "<?php echo $this->webroot;?>users/membership_payment_success",
						                type: 'post',
						                dataType: 'json',
						                data: {
					                        plan_id: 			_plan_id,
					                        amount: 			_amount,
					                    	reference_id: 		response.reference,
					                 		billing_address: 	_address_1_1+','+_address_2_1+','+_city_1+','+_zip_1,
					                		shipping_address: 	_address_1_2+','+_address_2_2+','+_city_2+','+_zip_2 
						                },
						                success: function(result){
						                  if(result.Ack==1){
						                  	alert(result.res);
						                  	window.location.href='<?php echo $this->webroot;?>users/home';
						                  }
						                  else{
						                  	alert(result.res);
						                  	window.location.href='<?php echo $this->webroot;?>users/home';
						                  }
						                }
	            			  		});
				                  }
				                  else{
				                  	alert(result.status);
						            window.location.href='<?php echo $this->webroot;?>users/home';
				                  }
				                }
	            			  });
	                    	}
	                    	else{
	                        	alert(result.message);
	                        	window.location.href='<?php echo $this->webroot;?>temp_carts/cart';
	                        }
	                    }
	                });
	      },
	      onClose: function(){
	          alert('window closed');
	      }
	    });
	    handler.openIframe();
	}
	else{
		if($('#shopping_id').is(':not(:checked)')){
			$('#shopping_spam').show();
			setTimeout(function(){ $('#shopping_spam').hide(); }, 3000);
		}
		if($('#legal_id').is(':not(:checked)')){	
			$('#legal_spam').show();
			setTimeout(function(){ $('#legal_spam').hide(); }, 3000);
		}	
	}    
}

</script>

			