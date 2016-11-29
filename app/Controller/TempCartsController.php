<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class TempCartsController extends AppController {

	 public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
    var $uses = array('Post','TempCart');

    public function ajax_add_to_cart() {
      $data = array();
      $res=array();
      $html='';
        //echo $this->request->data['post_id'];
      $user_id = $this->Session->read('userid');
      $this->request->data['user_id']=$user_id;
      $this->request->data['quantity']='1';
      $course_id = $this->request->data['post_id'];
      $cart_item=$this->TempCart->find('first',array('conditions'=>array('TempCart.user_id'=>$user_id,'TempCart.post_id'=>$course_id)));



      if(!empty($cart_item))
      {
              $quantity=$cart_item['TempCart']['quantity'];
              $quantity=$quantity+1;

              $this->TempCart->id=$cart_item['TempCart']['id'];
              $this->TempCart->saveField('quantity', $quantity);

              //counting total no. of product in cart.
              $cart_details=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$this->Session->read('userid'))));
              $qnt=0;
              foreach ($cart_details  as $key => $value) {
                $qnt=$qnt+1;
              }
               $data['ack'] = 1; 
               $data['qty'] = $qnt; 
     
      }
    else
    {
        if($this->TempCart->save($this->request->data))
        {

            $cart_details=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$this->Session->read('userid'))));
            $qnt=0;
            foreach ($cart_details  as $key => $value) {
              $qnt=$qnt+1;
            }  

            $this->TempCart->recursive = 2;
            $mini_cart_details=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$this->Session->read('userid'))));
            //$this->set('mini_cart_details',$mini_cart_details);
            //pr($mini_cart_details); exit;



                          //$html.= '<ul class="dropdown-menu" aria-labelledby="dLabel">';
            foreach ($mini_cart_details as $value) {
              if($value['Post']['User']['user_logo']!=''){
                    $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                  }
                  else{
                      $img = $this->webroot.'images/no_image.png';   
                  }
              $html.='<li><div class="div-area"><div class="span-pic"><img src="'.$img.'" style="width:25px" /></div><div class="span-text"><a href="#">'.$value['Post']['post_title'].'</a></div><div class="clear"></div></div></li>';
            }

              $html.='<li><div class="div-area"><div class="div-text"><a href="'.$this->webroot.'temp_carts/cart">View Cart</a></div></div>
              </li>';


              //counting total no. of product in cart.
              $cart_details=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$this->Session->read('userid'))));
              $qnt=0;
              foreach ($cart_details  as $key => $value) {
                $qnt++;
              }

              $data['ack'] = 1;
              $data['html'] = $html;
              $data['qty'] = $qnt;
        }
        else{
          $data['ack'] = 0;
        }
    }
         
  echo json_encode($data);
  exit;

}


    public function cart(){	
                        
            $userid = $this->Session->read('userid');
            if(!isset($userid) && $userid==''){
		    return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
            $this->TempCart->recursive=2;
          
            if ($this->request->is(array('post', 'put'))) {
                $max=count($this->request->data['qty']);
                    //pr($this->request->data);
                for ($i=0; $i<$max ; $i++) { 
                    
                    $quantity = $this->request->data['qty'][$i];
                    if($quantity<=0){
                        
                        $this->TempCart->id = $this->request->data['cart_id'][$i];
                        $this->TempCart->delete();
                    }
                    else
                    {
                        $this->TempCart->id = $this->request->data['cart_id'][$i];
                        $this->TempCart->saveField('quantity', $quantity);
                    }
                }    
            }
			$tempcartcontinueshopping=Router::url( $this->referer(), true );
            $this->TempCart->recursive = 2;
            $options_cart = array('conditions' => array('TempCart.user_id' => $userid));
            $cart = $this->TempCart->find('all', $options_cart);
            $this->set(compact('cart','tempcartcontinueshopping'));
	}


public function ajaxUpdateCart() {

        $data = array();
        $html = '';
       if(!empty($this->request->data)){ 

           
            if($this->request->data['qty']<=0)
            {
                $this->TempCart->id = $this->request->data['cart_id'];
                $this->TempCart->delete();   
            }
            else 
            {
               $this->TempCart->id = $this->request->data['cart_id'];
               $this->TempCart->saveField('quantity', $this->request->data['qty']);

                    $userid = $this->Session->read('userid');               
                $this->TempCart->recursive = 2;
                $options_cart = array('conditions' => array('TempCart.user_id' => $userid));
                $cart = $this->TempCart->find('all', $options_cart);
                
                $count=1;

                        if(!empty($cart)){
                          
            $html.='<table class="table table-bordered"> 
            <thead> 
            <tr> 
            <th>Item</th> 
            <th>Qty</th> 
            <th>Price</th> 
            <th>Subtotal</th>
            </tr> 
            </thead> 
            <tbody>'; 
            $st=array();
            foreach ($cart as $cart) { 
                if($cart['Post']['User']['user_logo']!=''){
                  $img = $this->webroot.'user_logo/'.$cart['Post']['User']['user_logo'];
                }
                else{
                  $img = $this->webroot.'images/no_image.png';   
                }
                 
            $html.='<tr> 
                <td>
                <div class="row">
                    <div class="col-md-2">
                        <img src="'.$img.'" style="width:60px;">
                    </div>
                    <div class="col-md-10">
                    <p>'. $cart['Post']['post_title'].'</p>
                
                <div class="seller">Provider: <span class="retailnet">'.$cart['User']['first_name'].' '.$cart['User']['last_name'].'</span> <span class="remove"><span id="'.$cart['TempCart']['id'].'" class="remove_cart" > <a href="javascript:void(0);">Remove</a></span></span></div>
                  <input type="hidden" id="'.$count.'_post_id" name="pid[]" value="'.$cart['Post']['id'].'" >
                                <input type="hidden" id="'.$count.'_cart_id" name="cart_id[]" value="'.$cart['TempCart']['id'].'" >
                    </div>
                </div>
                
                </td> 
                <td class="one"><input type="number" min="0" max="20" name="qty[]" class="course_qty" id="'.$count.'" value="'.$cart['TempCart']['quantity'].'" />
                <div class="multicolor"> <span id="'.$count.'_save_qty" style="display:none;" class="save_span" > <a href="javascript:void(0);" class="form_submition" onclick="save_quantity('.$count.','.$cart['TempCart']['id'].','.$count.')" >Save </a></span></div>
                </td> 
           
                <td>
                <b>₦. '. $cart['Post']['price'].' </b>
              
                </td> 
                <td><b>₦.'.$st[$count]=$cart['TempCart']['quantity']*$cart['Post']['price'].' </b></td> 
            </tr>' ;
            
                    $count=$count+1;
                  }     
      
            
             }
            else
            {
                echo "There Is No Course In The Cart";
            }

            
        if($count>1){   
            $html.=' <td colspan="4" class="td-text"><span id="error" style="display:none; color:red; float:left;">Invalid Promo Code     .</span><span id="promo_count">Estimated Total: ₦.';
            $total=0; foreach($st as $val){ $total=$total+$val;}
            $html.=$total.'</span></td> ';
        }
          $html.='</tr>

            </tbody> 
            </table>'; 

            }
             $data['html'] = $html;
       } 
            $cart_details=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$this->Session->read('userid'))));
            $qnt=0;
            foreach ($cart_details  as $key => $value) {
                $qnt=$qnt+1;
            }

                $data['qnt'] = $qnt;
   echo json_encode($data);            

   exit; 
} 

public function ajaxRemoveFromCart(){
 $html='';
 $qnt=0;
        if(!empty($this->request->data))
        {
            $this->TempCart->id =$this->request->data['cart_id'];
            if($this->TempCart->delete()){
                
                $userid = $this->Session->read('userid');               
                $this->TempCart->recursive = 2;
                $options_cart = array('conditions' => array('TempCart.user_id' => $userid));
                $cart = $this->TempCart->find('all', $options_cart);
                
                $count=1;

                        if(!empty($cart)){
                          
            $html.='<table class="table table-bordered"> 
            <thead> 
            <tr> 
            <th>Item</th> 
            <th>Qty</th> 
            <th>Price</th> 
            <th>Subtotal</th>
            </tr> 
            </thead> 
            <tbody>'; 
            $st=array();
            foreach ($cart as $cart) { 
                if($cart['Post']['User']['user_logo']!=''){
                    $img = $this->webroot.'user_logo/'.$cart['Post']['User']['user_logo'];
                }
                else{
                      $img = $this->webroot.'images/no_image.png';   
                }
                 
            $html.='<tr> 
                <td>
                <div class="row">
                    <div class="col-md-2">
                        <img src="'.$img.'" style="width:60px;">
                    </div>
                    <div class="col-md-10">
                    <p>'. $cart['Post']['post_title'].'</p>
                
                <div class="seller">Provider: <span class="retailnet">'.$cart['User']['first_name'].' '.$cart['User']['last_name'].'</span> <span class="remove"><span id="'.$cart['TempCart']['id'].'" class="remove_cart" > <a href="javascript:void(0);">Remove</a></span></span></div>
                  <input type="hidden" id="'.$count.'_post_id" name="pid[]" value="'.$cart['Post']['id'].'" >
                                <input type="hidden" id="'.$count.'_cart_id" name="cart_id[]" value="'.$cart['TempCart']['id'].'" >
                    </div>
                </div>
                
                </td> 
                <td class="one"><input type="number" min="0" max="20" name="qty[]" class="course_qty" id="'.$count.'" value="'.$cart['TempCart']['quantity'].'" />
                <div class="multicolor"> <span id="'.$count.'_save_qty" style="display:none;" class="save_span" > <a href="javascript:void(0);" class="form_submition" onclick="save_quantity('.$count.','.$cart['TempCart']['id'].','.$count.')" >Save </a></span></div>
                </td> 
           
                <td>
                <b>₦. '. $cart['Post']['price'].' </b>
              
                </td> 
                <td><b>₦.'.$st[$count]=$cart['TempCart']['quantity']*$cart['Post']['price'].' </b></td> 
            </tr>' ;
            
                    $count=$count+1;
                  }     
      
            
             }
            else
            {
                echo "There Is No Course In The Cart";
            }

            
        if($count>1){   
            $html.=' <td colspan="4" class="td-text"><span id="error" style="display:none; color:red; float:left;">Invalid Promo Code     .</span><span id="promo_count">Estimated Total: ₦.';
            $total=0; foreach($st as $val){ $total=$total+$val;}
            $html.=$total.'</span></td> ';
        }
          $html.='</tr>

            </tbody> 
            </table>';


           //     if (!empty($cart))
           //     { 

           //       $html.='<form method="post" id="form" >
           //          <table cellpadding="0" cellspacing="0">
           //              <tr>
           //              <th style="width:16%;" >Sl.No.</th>
           //              <th style="width:35%;" >Course Name</th>
           //              <th style="width:40%;" >Image</th> 
           //              <th style="width:67%;" >Quantity</th>
           //              </tr>';
           //               $count=1; foreach ($cart as $cart) {  
                                          
           //              $html.='<tr>
           //                  <td>'.$count.'</td>
           //                  <td>'.$cart['Post']['post_title'].'</td>
           //                  <td><img src="'.$this->webroot. '/img/post_img/'.$cart['Post']['PostImage']['0']['originalpath'].'" style="width:80px;"> </td>
           //                  <td>
           //                      <input type="number" min="0" max="20" name="qty[]" class="course_qty" id="'.$count.'" value="'.$cart['TempCart']['quantity'].'" /><br>
           //                      <span id="'.$count.'_save_qty" style="display:none;" class="save_span" > <a href="javascript:void(0);" class="form_submition" onclick="save_quantity('.$count.','.$cart['TempCart']['id'].','. $count.')" >Save </a> | </span>
           //                      <span id="'.$cart['TempCart']['id'].'" class="remove_cart" > <a href="javascript:void(0);">Remove</a></span> 
           //                      <input type="hidden" id="'.$count.'_post_id" name="pid[]" value="'.$cart['Post']['id'].'" >
           //                      <input type="hidden" id="'. $count.'_cart_id" name="cart_id[]" value="'.$cart['TempCart']['id'].'" >
           //                  </td>
                           
                           
           //              </tr>';
           //                $count=$count+1;  
           //          $html.='</table></form>';

           //     }
           // }
           //    else
           //    {
           //      $html.='There Is No Course In The Cart';
           //    }


    $cart_details=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$userid)));
            
            foreach ($cart_details  as $key => $value) {
                $qnt++;
            }

            }
        }
    echo $html.'@'.$qnt;
        
  exit;
} 

  public function ajaxPromoCode(){
      if(!empty($this->request->data))
          {
            $html='';
            $res=array();
            $promo_code=$this->request->data['promo_code'];
            $this->loadModel('PromoCode');
            $userid = $this->Session->read('userid');
            $promo_detail=$this->PromoCode->find('first',array('conditions'=>array('PromoCode.code'=>$promo_code)));
              if(!empty($promo_detail)){
                  $cart=$this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$userid)));
                  $st=array();
                  $count=1;

                 foreach ($cart as $cart) { 
                  $st[$count]=$cart['TempCart']['quantity']*$cart['Post']['price'];
                  $count=$count+1;
                 }
                 //echo $userid;
                 $total=0; foreach($st as $val){ $total=$total+$val;}
                 $total_discount=$total-$total*($promo_detail['PromoCode']['discount']/100);
                 $html.='Estimated Total: ₦.'.$total.'  ,  '.'Total After Discount: ₦.'.round($total_discount);
                    $res['html']=$html;
                    $res['total_amount']=$total;
                    $res['discount_total']=round($total_discount);
                    $res['discount_parcentage'] = $promo_detail['PromoCode']['discount'];
                    $res['ack']=1;

              } else {
                    $html.='Invalid Promo Code';
                    $res['html']=$html;
                    $res['ack']=0;
                }
                echo json_encode($res);   
                 exit;             
                //$html.=
            }      
  }

  public function getStatus(){
           
        //pr($this->request->query); exit();

        $type='json';
        $sign='';
        $transref     = isset($this->request->query['transref'])   ? $this->request->query['transref']     : null;
        $mertid       = isset($this->request->query['mertid'])     ? $this->request->query['mertid']       : null;
        $user_id      = isset($this->request->query['user_id'])    ? $this->request->query['user_id']      : null;
        $post_id      = isset($this->request->query['post_id'])    ? $this->request->query['post_id']      : null;
        $qty          = isset($this->request->query['qty'])        ? $this->request->query['qty']          : null;
        $cart_id      = isset($this->request->query['cart_id'])    ? $this->request->query['cart_id']      : null;   

        $request = 'mertid='.$mertid.'&transref='.$transref.'&respformat='.$type.'&signature='.$sign; //initialize the request variables
        $url = 'https://www.cashenvoy.com/sandbox/?cmd=requery'; //this is the url of the gateway's test api
        //$url = 'https://www.cashenvoy.com/webservice/?cmd=requery'; //this is the url of the gateway's live api
        $ch = curl_init(); //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); //return as a variable
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch); // grab URL and pass it to the browser. Run the whole process and return the response
        curl_close($ch); //close the curl handle
        $response;

        $data = json_decode($response);
        foreach ($data as $subdata) { @$cnt++; }
        if($cnt==3){ 
           $returned_transref = $data->  {'TransactionId'}   ;
           $returned_status   = $data->{'TransactionStatus'} ;
           $returned_amount   = $data->{'TransactionAmount'} ;
           
                  if($returned_status=='C00'){
                     $this->request->data['user_id']       =$user_id;
                     $this->request->data['post_id']       =$post_id;
                     $this->request->data['quantity']      =$qty;
                     $this->request->data['transaction_id']=$returned_transref;
                     $this->request->data['amount']        =$returned_amount;
                     $this->loadModel('Order');
                     $this->loadModel('Post');
                     $tid=$this->Order->find('all',array('conditions'=>array('Order.transaction_id'=>$returned_transref),'fields'=>array('Order.transaction_id')));
                     $data=$this->Post->find('first',array('coditions'=>array('Post.id'=>$post_id)));
                     $provider_id = $data['Post']['user_id'];
                     if(!$tid){
                          $quantity=$data['Post']['quantity']-$qty;
                          $this->Post->id=$post_id;
                          $this->Post->saveField('quantity', $quantity);
                          $this->loadModel('FundDetail');
                          $recentFund = $this->FundDetail->find('first',array('conditions'=>array('FundDetail.user_id'=>$user_id)));
                          if(isset($recentFund)){
                            $userFund = $recentFund['FundDetail']['amount'];
                            $this->loadModel('Setting');
                            $setting = $this->Setting->find('first',array('conditions'=>array('Setting.id'=>1)));
                            $adminCommission = $setting['Setting']['set_commission'];  
                            $providerPortion = $returned_amount - (($returned_amount/100)*$adminCommission);
                            $newFund = $providerPortion + $userFund;
                            $this->FundDetail->id = $user_details['FundDetail']['id'];
                            $data = array('user_id'=>$provider_id,'amount'=>$newFund);
                            $this->FundDetail->save($data);
                          }
                          else{
                            $this->loadModel('Setting');
                            $setting = $this->Setting->find('first',array('conditions'=>array('Setting.id'=>1)));
                            $adminCommission = $setting['Setting']['set_commission'];  
                            $providerPortion = $returned_amount - (($returned_amount/100)*$adminCommission);
                            $data = array('user_id' => $provider_id, 'amount' => $providerPortion);
                            $this->FundDetail->save($data);
                          }
                          $this->Order->save($this->request->data);
                          $this->TempCart->id=$cart_id;
                          $this->TempCart->delete();
                          $status='Order is placed successfully';
                             
                     }else{
                        $status='Order is already exist';
                     } 
                  }
                  else{
                    $status = 'Transection Failed'.$returned_status;
                  }  
        } else {
          $status = $data->{'TransactionStatus'};
        }
      $this->set(compact('response','user_id','post_id','qty','status')); 
    
   
  }

}