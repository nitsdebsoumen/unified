<script src="https://js.paystack.co/v1/inline.js"></script>
<style>
.btn{margin:10px;-moz-box-shadow:inset 0 1px 0 0 #fff;-webkit-box-shadow:inset 0 1px 0 0 #fff;box-shadow:inset 0 1px 0 0 #fff;background:-webkit-gradient(linear,left top,left bottom,color-stop(0.05,#f9f9f9),color-stop(1,#e9e9e9));background:-moz-linear-gradient(center top,#f9f9f9 5%,#e9e9e9 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9',endColorstr='#e9e9e9');background-color:#f9f9f9;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;border:1px solid #dcdcdc;display:inline-block;color:#666;font-family:Arial;font-size:15px;font-weight:bold;padding:10px;text-decoration:none;text-shadow:1px 1px 0 #fff}
.btn:hover{background:-webkit-gradient(linear,left top,left bottom,color-stop(0.05,#e9e9e9),color-stop(1,#f9f9f9));background:-moz-linear-gradient(center top,#e9e9e9 5%,#f9f9f9 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9',endColorstr='#f9f9f9');background-color:#e9e9e9}
#promo_code{margin-left: 16px;}
</style>
<section class="login_body">

	<div class="container">
    	<div class="row">
        	<div class="col-md-10 mid-div">
            	<div class="cart-section">
                    
                	<h1>Cart</h1>
            <div id='ajax_content'>        
            <?php 
            $count=1;
                        if(!empty($cart)){
                                      ?>        
        	<table class="table table-bordered"> 
            <thead> 
            <tr> 
            <th>Item</th> 
            <th>Qty</th> 
            <th>Price</th> 
            <!-- <th>Delivery Details</th> -->
            <th>Subtotal</th>
            
            </tr> 
            </thead> 
            <tbody> 
            <?php
             $st=array();
             
             foreach ($cart as $cart) {
                  if($cart['Post']['User']['user_logo']!=''){
                    $img = $this->webroot.'user_logo/'.$cart['Post']['User']['user_logo'];
                  }
                  else{
                      $img = $this->webroot.'images/no_image.png';   
                  } 
             ?>    
            <tr> 
                <td>
                <div class="row">
                	<div class="col-md-2">
                    	<img src="<?php echo $img;?>" style="width:60px;">
                    </div>
                    <div class="col-md-10">
                    <p><?php echo $cart['Post']['post_title']; ?></p>
                <!-- <div class="multicolor">Multicolor</div> -->
                <div class="seller">Provider: <span class="retailnet"><?php echo $cart['Post']['User']['first_name'].' '.$cart['Post']['User']['last_name']; ?></span> <span class="remove"><span id="<?php echo $cart['TempCart']['id']; ?>" class="remove_cart" > <a href="javascript:void(0);">Remove</a></span></span></div>
                  <input type="hidden" id="<?php echo $count.'_post_id'?>" name="pid[]" value="<?php echo $cart['Post']['id']; ?>" >
                                <input type="hidden" id="<?php echo $count.'_cart_id'?>" name="cart_id[]" value="<?php echo $cart['TempCart']['id']; ?>" >
                    </div>
                </div>
                
                </td> 
                <td class="one"><input type="number" min="0" max="20" name="qty[]" class="course_qty" id="<?php echo $count;?>" value="<?php echo $cart['TempCart']['quantity']; ?>" />
                <div class="multicolor"> <span id="<?php echo $count.'_save_qty'?>" style="display:none;" class="save_span" > <a href="javascript:void(0);" class="form_submition" onclick="save_quantity(<?php echo $count; ?>,<?php echo $cart['TempCart']['id']; ?>,<?php echo $count; ?>)" >Save </a></span></div>
                </td> 
             <!--    <td>
                <p>Rs. 249</p>
                <div class="sale">Selling Price: Rs. 299</div>
                <div class="offer"><a href="#">Offer Savings: Rs. 50</a></div>
                </td>  -->
                <td>
                <b>₦. <?php echo $cart['Post']['price']; ?> </b>
                <!-- <div class="multicolor">Delivered in 4 business days.</div> -->
                </td> 
                <td><b>₦. <?php 

                echo $st[$count]=$cart['TempCart']['quantity']*$cart['Post']['price']; ?> </b></td>
                 
            </tr> 
            <?php 
                    $count=$count+1;
                  } ?>    
      
            <?php
             }
            else
            {
                echo "There Is No Course In The Cart";
            }

            ?>
           
          <tr class="tr-bg">
            <?php if($count>1){?> 
          	<!-- <td colspan="3" class="td-text">Total Savings: Rs. 50</td> -->
            <td colspan="4" class="td-text"><span id="error" style="display:none; color:red; float:left;"  >Invalid Promo Code         .</span> <span id="promo_count" > Estimated Total: ₦. <?php $total=0; foreach($st as $val){ $total=$total+$val;}
            echo $total;
             ?></span></td>

             <?php }  ?>
          </tr>

            </tbody> 
            </table>
        </div> 
          <div class="row">
            
        <div class="col-md-6">
          <div class="form-group">
          <input type="text" name="promo_code" id="promo_code" class="promo-code" >
          <button type="button" class="btn btn-secondary promo-code" id="promo">Promo Code</button>
        </div>
        </div>
          <div class="col-md-3"><button type="button" class="btn btn-default " onclick="window.location.href='<?php echo $tempcartcontinueshopping; ?>'">Continue Booking</button></div>
          <div class="col-md-3">
            <a class="btn" href="javascript:void(0);" onclick="payWithPaystack()" title="Make payments with Paystack!" style="background: #ee7c15 none repeat scroll 0 0 !important;">
              <span>
                <img src="<?php echo $this->webroot;?>payment/paymentLogo.png" border="0">
              </span>
            </a>
            <input type="hidden" id="total_amount" value="<?php echo $total;?>">
            <input type="hidden" id="discount_amount" value=''>
            <input type="hidden" id="discount_parcentage" value=''>
          </div>
        </div>
        </div>
            </div>
        </div>
    	
    </div>

   </section>
<script>
$(document).ready(function () {

    $(document).on('change',".course_qty",function(){
        var id=$(this).attr('id');
        var span_id  = id + "_save_qty";
        $("#"+span_id).show();
    
    });

    $(document).on('click',"#promo",function(){

      var promo=$("#promo_code").val();

      if(promo!='')
      {
        $.ajax({

          url:"<?php echo $this->webroot; ?>temp_carts/ajaxPromoCode",
          type:'post',
          dataType:'json',
          data:{
            promo_code:promo
          },
          success: function(result){
            console.log(result);
            if (result.ack==1) 
              {
                $('#promo_count').text(result.html);
                $('#total_amount').val(result.total_amount);
                $('#discount_amount').val(result.discount_total);
                $('#discount_parcentage').val(result.discount_parcentage); 
              }
              else {
                $('#error').show();
                setTimeout(function() { $("#error").hide(); }, 3000);
              }

          }

        });
      }

    });
        
    $(document).on('click',".remove_cart",function(){
        var id = $(this).attr('id');
        $.ajax({
            url: "<?php echo $this->webroot; ?>temp_carts/ajaxRemoveFromCart",
            type: 'post',
            dataType:'html',
            data: {
                cart_id:id
            },
            success: function(result){
                  console.log(result);
                  var result1=result.split('@');
                  
                  $('#ajax_content').html('');
                  $('#ajax_content').html(result1['0']);
                  $('#cart_quantity').html('');
                  $('#cart_quantity').html(result1['1']);

            }
        });
    });

});

    function save_quantity(quantity1,id1,count1){
        var  quantity2=count1;
        var itemnumber=$('#'+quantity2).val();
         $.ajax({
            url: "<?php echo $this->webroot; ?>temp_carts/ajaxUpdateCart",
            type: 'post',
            dataType: 'json',
            data: {
              qty:itemnumber,
              cart_id:id1
            },
            success: function(result){
                  console.log(result);
               if (result!=0) 
               {
                $('#cart_quantity').text(result.qnt);
                $('.save_span').hide();
                $('#ajax_content').html('');
                $('#ajax_content').html(result.html);
               }
            }
        });
    }
</script>


<style>
.btn{margin:10px;-moz-box-shadow:inset 0 1px 0 0 #fff;-webkit-box-shadow:inset 0 1px 0 0 #fff;box-shadow:inset 0 1px 0 0 #fff;background:-webkit-gradient(linear,left top,left bottom,color-stop(0.05,#f9f9f9),color-stop(1,#e9e9e9));background:-moz-linear-gradient(center top,#f9f9f9 5%,#e9e9e9 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#f9f9f9',endColorstr='#e9e9e9');background-color:#f9f9f9;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;border:1px solid #dcdcdc;display:inline-block;color:#666;font-family:Arial;font-size:15px;font-weight:bold;padding:10px;text-decoration:none;text-shadow:1px 1px 0 #fff}
.btn:hover{background:-webkit-gradient(linear,left top,left bottom,color-stop(0.05,#e9e9e9),color-stop(1,#f9f9f9));background:-moz-linear-gradient(center top,#e9e9e9 5%,#f9f9f9 100%);filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#e9e9e9',endColorstr='#f9f9f9');background-color:#e9e9e9}
</style>
<!-- 
Note: Replace the values below with your merchant id, the amount and the description of the item to be purchased. 
Note: Replace https://www.cashenvoy.com/sandbox/?cmd=cepay with https://www.cashenvoy.com/webservice/?cmd=cepay once you have been switched to the live environment.
Do not change anything else!
-->
<!--<form method="post" name="ce" action="https://www.cashenvoy.com/webservice/?cmd=cepay" target="_self">-->

<?php
// //pr($cart);
// if(!empty($cart)){
// $user_id =$cart['User']['id'];
// $post_id =$cart['Post']['id'];
// $qty     =$cart['TempCart']['quantity'];
// $cart_id =$cart['TempCart']['id'];

// // this file shows how you can call the CashEnvoy payment interface from your online store

// // your CashEnvoy merchant id
// $cemertid = 4024;

// // your merchant key (login to your cashenvoy account, your merchant key is displayed on the dashboard page)
// $key = '450997cff555def4d72c11e7ba5cee02';

// // transaction reference which must not contain any special characters. Numbers and alphabets only.
// $cetxref = $cart_id.$user_id.$post_id.rand(1,999);

// // transaction amount
// $ceamt = $cart['TempCart']['quantity']*$cart['Post']['price'];

// // customer id does not have to be an email address but must be unique to the customer
// $cecustomerid =$cart['User']['email_address']; 

// // a description of the transaction
// $cememo = $cart['Post']['post_title'];

// // notify url - absolute url of the page to which the user should be directed after payment
// // an example of the code needed in this type of page can be found in example_requery_usage.php
// //$link=$this->Html->link(array('controller' => 'temp_carts', 'action' => 'getStatus', '?' => array('transref' =>'abc965445695ab', 'mertid' =>'4024'))); 

// $cenurl ='http://107.170.152.166/team4/ladder/temp_carts/getStatus?transref='.$cetxref.'&mertid='.$cemertid.'&user_id='.$user_id.'&post_id='.$post_id.'&qty='.$qty.'&cart_id='.$cart_id;

// // generate request signature
// $data = $key.$cetxref.$ceamt;
// $signature = hash_hmac('sha256', $data, $key, false);

// //echo $cenurl ;
?>

<!-- <form  method="post" name="ce" action="https://www.cashenvoy.com/sandbox/?cmd=cepay" target="_self">  
    <input type="hidden" name="ce_merchantid"   value="<?= $cemertid ?>"/>
    <input type="hidden" name="ce_transref"     value="<?= $cetxref ?>"/>
    <input type="hidden" name="ce_amount"       value="<?= $ceamt ?>"/>
    <input type="hidden" name="ce_customerid"   value="<?= $cecustomerid ?>"/>
    <input type="hidden" name="ce_memo"         value="<?= $cememo ?>"/>
    <input type="hidden" name="ce_notifyurl"    value="<?= $cenurl ?>"/>
    <input type="hidden" name="ce_window"       value="parent"/>
    <input type="hidden" name="ce_signature"    value="<?= $signature ?>"/>
    
</form> -->
<?php //} ?>
<?php
$user_id = $cart['User']['id'];
$user_email = $cart['User']['email_address'];
$post_id = $cart['Post']['id'];
$cetxref = $user_id.$post_id.rand(1,999);
?>
<input type="hidden" name="transref"  id="transref" value="<?php echo $cetxref; ?>">
<input type="hidden" name="user_id"   id="user_id" value="<?php echo $user_id; ?>">
<input type="hidden" name="user_email"   id="user_email" value="<?php echo $user_email; ?>">
<form >
  
  <!-- <button type="button" onclick="payWithPaystack()"> Pay </button>  -->
</form>

 
<script>
  function payWithPaystack(){
    var ref_id       = $("#transref").val();
    var tal_amount   = $("#total_amount").val();
    var dst_amount   = $("#discount_amount").val();
    var uid          = $("#user_id").val();
    var uemail       = $("#user_email").val();
    var dst_parcentage = $("#discount_parcentage").val();
    var final_amount=0;
    var order_set_id=0;

      if(dst_amount!=''){
        final_amount = dst_amount;
      } else {
        final_amount = tal_amount;
      }

      jQuery.ajax({
            url: "<?php echo $this->webroot;?>order_sets/ajaxOrderSet",
            type: 'post',
            dataType: 'json',
            data: {
               reference_id   :ref_id,
               total_amount   :tal_amount,
               discount_amount:dst_amount,
               user_id        :uid
            },
            success: function(result){
              order_set_id = result.orderSet_id;

              var handler = PaystackPop.setup({
                key: 'pk_test_659a3e8cbc2cd54331193585bf41cbf5bd19c389',
                email: uemail,
                amount: final_amount,
                ref: ref_id,
                metadata: {
                   custom_fields: [
                      {
                          orderSet_id: order_set_id
                      }
                   ]
                },
                callback: function(response){
                  console.log(response);
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
                            url: "<?php echo $this->webroot;?>order_items/ajaxOrderConfurm",
                            type: 'post',
                            dataType: 'json',
                            data: {
                                     status : result.status,
                                    message : result.message,
                                     amount : result.data.amount,
                                orderSet_is : result.data.metadata.custom_fields[0].orderSet_id,
                               reference_id : result.data.reference,
                        discount_parcentage : dst_parcentage,
                                    user_id : uid
                            },
                            success: function(result){
                              if(result.Ack == 1){
                                alert('Order Plased Successfully,Continue Booking ');
                                window.location.href='<?php echo $this->webroot;?>users/home';
                              }
                              else{
                                alert('Order Plased Successfully,Continue Booking ');
                                window.location.href='<?php echo $this->webroot;?>temp_carts/cart';
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
        });            
        
      
  }
</script>