<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrderItemsController extends AppController {

	public function ajaxOrderConfurm() {
		 $user_id = $this->request->data['user_id'];
		$order_id = $this->request->data['reference_id'];
		$this->loadModel('TempCart');
		$this->loadModel('OrderSet');
		$this->loadModel('OrderItem');
		$this->loadModel('Post');
		$cart_items = $this->TempCart->find('all',array('conditions'=>array('TempCart.user_id'=>$user_id)));
		$orderSet_id = $this->request->data['orderSet_is'];
		$this->OrderSet->id = $orderSet_id;
		$this->OrderSet->saveField('order_id', $order_id);
		
		$orderSet = $this->OrderSet->find('first',array('conditions'=>array('OrderSet.id'=>$orderSet_id)));
		$discount_parcentage = $this->request->data['discount_parcentage'];

			$status = 0;
			foreach ($cart_items as $key => $cart_item) {
				//pr($cart_item);
				$no_of_course = $cart_item['TempCart']['quantity'];
				$total_course_price = $cart_item['Post']['price']*$no_of_course;

				if($discount_parcentage!=''){
					$total_course_price = $total_course_price-($total_course_price*($discount_parcentage/100));
				}
				$this->request->data['post_id']  	 = $cart_item['Post']['id'];
				$this->request->data['user_id']  	 = $user_id;
				$this->request->data['order_id'] 	 = $order_id;
				$this->request->data['quantity'] 	 = $cart_item['TempCart']['quantity'];
				$this->request->data['amount']	 	 = $total_course_price;
				$this->request->data['payment_date'] = gmdate('Y-m-d H:i:s');
				$this->OrderItem->create();
				if($this->OrderItem->save($this->request->data)){
					$status++;
					$post_id = $cart_item['Post']['id'];
					//echo $post_id;
					$postDetails=$this->Post->find('first',array('conditions'=>array('Post.id'=>$post_id) ));
					//pr($postDetails); exit;
					$quantity = $postDetails['Post']['quantity']-$cart_item['TempCart']['quantity'];
							$this->Post->id = $postDetails['Post']['id'];
                          	$this->Post->saveField('quantity', $quantity);
							$this->loadModel('FundDetail');
                            $provider_id = $postDetails['Post']['user_id'];
                            
                            $recentFund = $this->FundDetail->find('first',array('conditions'=>array('FundDetail.user_id'=>$provider_id)));
									
						if(!empty($recentFund)){
	                        $userFund = $recentFund['FundDetail']['amount'];
	                        $this->loadModel('Setting');
	                        $setting = $this->Setting->find('first',array('conditions'=>array('Setting.id'=>1)));
	                        $adminCommission = $setting['Setting']['set_commission'];  
	                        $providerPortion = $total_course_price - (($total_course_price/100)*$adminCommission);
	                        $newFund = $providerPortion + $userFund;
	                        $this->FundDetail->id = $recentFund['FundDetail']['id'];
	                        $data = array('user_id'=>$provider_id,'amount'=>$newFund);
	                        $this->FundDetail->save($data);
                        }
                        else{
                            $this->loadModel('Setting');
                            $setting = $this->Setting->find('first',array('conditions'=>array('Setting.id'=>1)));
                            $adminCommission = $setting['Setting']['set_commission'];  
                            $providerPortion = $total_course_price - (($total_course_price/100)*$adminCommission);
                            $data = array('user_id' => $provider_id, 'amount' => $providerPortion);
                            $this->FundDetail->create();
                            $this->FundDetail->save($data);
                        }
                    $this->TempCart->id = $cart_item['TempCart']['id'];
					$this->TempCart->delete();  

				}
			}
		$data = array();
		if($status>0){
			$this->OrderSet->id = $orderSet_id;
			$this->OrderSet->saveField('status', '1');
			$data['Ack'] = 1;
		}
		else{
			$data['Ack'] = 0;
		}
		echo json_encode($data);	
		exit;
	}

}	