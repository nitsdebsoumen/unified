<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrdersController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session','RequestHandler','Paginator');
	var $uses = array('Order','OrderDetail','Shop','Country','User','Category','Attribute','AttributeItem','UserPaymentDetail','UserBillingAddress','UserCreditCard','Listing','ListAttribute','ListAttributeItem','ListTag','ListMaterial','ListDispatch','ListImage','ListFile','ShopSetting','ShopFollowing','SiteSetting','PartnershipDetail','OrderItem');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		$countryname = '';
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Order History';
		$this->OrderDetail->recursive = 0;
		$orders = $this->Paginator->paginate('OrderDetail', array('OrderDetail.owner_id' => $userid));
		#pr($orders);
		$options = array('conditions' => array('User.username' => $username));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		$this->set(compact('orders','title_for_layout','user','countryname'));
	}

	public function purchased() {
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		$countryname = '';
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Purchase History';
		$this->Order->recursive = 0;
		$orders = $this->Paginator->paginate('Order', array('Order.user_id' => $userid));
		#pr($orders);
		$options = array('conditions' => array('User.username' => $username));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		$this->set(compact('orders','title_for_layout','user','countryname'));
	}

	public function admin_index() {
		$this->loadModel('OrderItem');
		$this->OrderItem->recursive = 0;
		$orders = $this->Paginator->paginate('OrderItem');
		#pr($orders);
		#exit;
		$this->set(compact('orders'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OrderItem->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		$options = array('conditions' => array('OrderItem.' . $this->OrderItem->primaryKey => $id));
		$this->set('order', $this->OrderItem->find('first', $options));
	}
	
	public function admin_view($id = null) {
		if (!$this->OrderItem->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		$options = array('conditions' => array('OrderItem.' . $this->OrderItem->primaryKey => $id));
		$this->set('order', $this->OrderItem->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		}
		$users = $this->Order->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Order->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Order->save($this->request->data)) {
				$this->Session->setFlash(__('The order has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $id));
			$this->request->data = $this->Order->find('first', $options);
		}
		$users = $this->Order->User->find('list');
		$this->set(compact('users'));
	}

	public function admin_edit($id = null) {
		if (!$this->OrderItem->exists($id)) {
			throw new NotFoundException(__('Invalid order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OrderItem->save($this->request->data)) {
				$this->Session->setFlash('The order has been saved.', 'default', array('class' => 'success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash('The order could not be saved. Please, try again.', 'default', array('class' => 'error'));
			}
		} else {
			$options = array('conditions' => array('OrderItem.' . $this->OrderItem->primaryKey => $id));
			$this->request->data = $this->OrderItem->find('first', $options);
		}
		$users = $this->OrderItem->User->find('list', array('fields' => array('User.id', 'User.first_name')));
        $posts = $this->OrderItem->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
		$this->set(compact('users','posts'));
	}

	public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if($this->request->is('post')) {
            $this->Order->create();
            if($this->Order->save($this->request->data)) {
                $this->Session->setFlash('Order successfully placed.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Order add failed.', 'default', array('class' => 'error'));
            }
        }
        
        $users = $this->Order->User->find('list', array('fields' => array('User.id', 'User.first_name')));
        $posts = $this->Order->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        //$events = $this->Order->Event->find('list', array('fields' => array('Event.id', 'Event.event_name')));
        $this->set(compact('users', 'posts', 'events'));
    }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Order->id = $id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Order->delete()) {
			$this->Session->setFlash(__('The order has been deleted.'));
		} else {
			$this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_delete($id = null) {
		$this->OrderItem->id = $id;
		if (!$this->OrderItem->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$this->request->onlyAllow('post','delete');
		if ($this->OrderItem->delete()) {
			$this->Session->setFlash(__('The order has been deleted.'));
		} else {
			$this->Session->setFlash(__('The order could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function getUsername($id = null){
		$username = '';
		if($id!=''){
			$userName = $this->User->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('User.first_name','User.last_name')));
			if($userName){
				$username = $userName['User']['first_name'].' '.$userName['User']['last_name'];
			}
		}
		return $username;
	}

	public function confirm(){
		$userid = $this->Session->read('userid');
		$username = $this->Session->read('username');
		if(!isset($userid)){
			return $this->redirect('/');
		}
		#print_r($_POST);
		#exit;
		if(isset($_POST['txn_id']) && $_POST['txn_id']!=''){
			$this->request->data['Order']['user_id'] = $userid;
			$this->request->data['Order']['total_amount'] = $_POST['payment_gross'];
			$this->request->data['Order']['order_date'] = date('Y-m-d');
			$this->request->data['Order']['transaction_id'] = $_POST['txn_id'];
			$this->request->data['Order']['payment_date'] = date('Y-m-d');
			$this->Order->create();
			if ($this->Order->save($this->request->data)) {				
				if ($this->Session->check('Cart')) {
					$this->Session->delete('Cart');
				}
				$orderId = $this->Order->getLastInsertId();
				$custom = $_POST['custom'];
				if($custom!=''){
					$lists = explode('@@@@',$custom);
					#pr($lists);
					if($lists){
						foreach($lists as $list){
							if($list!='')
							{
								#echo 'hii';
								$listId = explode('_',$list);
								#pr($listId);
								if(!empty($listId)){
									$options = array('conditions' => array('Listing.id' => $listId[0]));
									$listing = $this->Listing->find('first', $options);
									if($listing){
										$data['OrderDetail']['order_id'] = $orderId;
										$data['OrderDetail']['list_id'] = $listing['Listing']['id'];
										$data['OrderDetail']['shop_id'] = $listing['Listing']['shop_id'];
										$data['OrderDetail']['owner_id'] = $listing['Listing']['user_id'];
										$data['OrderDetail']['price'] = $listing['Listing']['price'];
										$data['OrderDetail']['quantity'] = $listId[1];
										$data['OrderDetail']['shipping_cost'] = $listing['Listing']['shipping_cost'];
										$data['OrderDetail']['amount'] = ($listId[1]*$listing['Listing']['price'])+$listing['Listing']['shipping_cost'];
										$data['OrderDetail']['order_status'] = 'U';
										$data['OrderDetail']['delivery_date'] = '0000-00-00';
										$this->OrderDetail->create();
										$this->OrderDetail->save($data);

										/*******/
										$contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email')));
										if($contact_email){
											$adminEmail = $contact_email['SiteSetting']['contact_email'];
										} else {
											$adminEmail = 'superadmin@shopsfit.com';
										}

										$options = array('conditions' => array('User.id' => $listing['Listing']['user_id']));
										$shopOwner = $this->User->find('first', $options);
										#pr($lastInsetred);
										$link = 'http://shopsfit.com/order_details/index/'.base64_encode($orderId);
										$msg_body = 'Hi '.$shopOwner['User']['first_name'].'<br/><br/>You have received a new Order. The Order Id is '.$orderId.'. Please Login to your dashborad and click on the link below to view the Order details.<br/> <a href="'.$link.'">Click Here</a><br/><br/>Thanks,<br/>ShopsFit';

										App::uses('CakeEmail', 'Network/Email');

										$Email = new CakeEmail();
										
										/* pass user input to function */
										$Email->emailFormat('both');
										$Email->from(array($adminEmail => 'ShopsFit'));
										$Email->to($shopOwner['User']['email']);
										$Email->subject('ShopsFit New Order Received');
										$Email->send($msg_body);
										/*******/

										$data1['Listing']['id'] = $listing['Listing']['id'];
										$data1['Listing']['quantity'] = $listing['Listing']['quantity'] - $listId[1];
										$this->Listing->save($data1);
									}
								}
							}
						}
					}
					$options = array('conditions' => array('User.id' => $userid));
					$orderBy = $this->User->find('first', $options);
					/***Email TO Admin****/
					$link = 'http://shopsfit.com/admin/order_details/index/'.$orderId;
					$msg_body = 'Hi Admin,<br/><br/>ShopsFit has received a new Order. The Order Id is '.$orderId.'. Please Login to admin panel and click on the link below to view the Order details.<br/> <a href="'.$link.'">Click Here</a><br/><br/>Thanks,<br/>ShopsFit';
					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail();
					/* pass user input to function */
					$Email->emailFormat('both');
					$Email->from(array($orderBy['User']['email'] => 'ShopsFit'));
					$Email->to($adminEmail);
					$Email->subject('ShopsFit New Order Received');
					$Email->send($msg_body);
					/***Email TO Admin****/

					/***Email TO User****/
					$msg_body1 = 'Hi '.$orderBy['User']['first_name'].',<br/><br/>Your Order has been successfully placed. You will receive email once your Order is shipped.<br/><br/>Thanks,<br/>ShopsFit';
					App::uses('CakeEmail', 'Network/Email');
					$Email = new CakeEmail();
					/* pass user input to function */
					$Email->emailFormat('both');
					$Email->from(array($adminEmail => 'ShopsFit'));
					$Email->to($orderBy['User']['email']);
					$Email->subject('ShopsFit Order Placed');
					$Email->send($msg_body1);
					/***Email TO User****/
				}
				#exit;
				$this->Session->setFlash(__('The order has been placed successfully.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('The order could not be placed. Please, try again.'));
				return $this->redirect(array('controller' => 'users', 'action' => 'index'));
			}
		} else {
			$this->Session->setFlash(__('The order could not be placed. Please, try again.'));
			return $this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
	}

	public function cancel(){
		$this->Session->setFlash(__('The order could not be placed. Please, try again.'));
		return $this->redirect(array('controller' => 'users', 'action' => 'index'));
	}

	public function admin_paynow($order_id = null){
		$this->Order->id = $order_id;
		if (!$this->Order->exists()) {
			throw new NotFoundException(__('Invalid order'));
		}
		$settings = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1)));
		#pr($settings);
		$Item=array();
		$MPItems=array();
		$i=0;
		$has_partner=false;
		$this->Order->recursive = -1;
		$options = array('conditions' => array('Order.' . $this->Order->primaryKey => $order_id));
		$order = $this->Order->find('first', $options);
		if($order){
			$this->User->recursive = -1;
			$options = array('conditions' => array('User.id' => $order['Order']['user_id']), 'fields' => array('User.referrer_id'));
			$referrer = $this->User->find('first', $options);
			if($referrer){
				#pr($referrer);
				#$this->User->recursive = -1;
				$options = array('conditions' => array('User.id' => $referrer['User']['referrer_id'],'User.is_active' => 1,'User.is_partner' => 1), 'fields' => array('User.id','User.is_partner','User.is_active','User.partnership_start_date','User.partnership_end_date'));
				$partnersDetails = $this->User->find('first', $options);
				#pr($partnersDetails);
				if($partnersDetails){
					if($partnersDetails['User']['partnership_end_date']>=$order['Order']['payment_date']){
						$has_partner = true;						
					}
				}
			}

			$partner_commission = 0.00;
			$this->OrderDetail->recursive = -1;
			$options = array('conditions' => array('OrderDetail.order_id' => $order_id));
			$orderDetails = $this->OrderDetail->find('all', $options);
			#pr($orderDetails);
			if($orderDetails){
				foreach($orderDetails as $data)
				{
					$this->UserPaymentDetail->recursive = -1;
					$options = array('conditions' => array('UserPaymentDetail.user_id' => $data['OrderDetail']['owner_id']));
					$userPaymentdetail = $this->UserPaymentDetail->find('first', $options);
					if($userPaymentdetail){						
						if($has_partner==true){
							$admin_commission=((($data['OrderDetail']['amount'])*($settings['SiteSetting']['admin_percentage']))/100);
							$price_paid=($data['OrderDetail']['amount']-$admin_commission);
							
							$partner_commission=$partner_commission + ((($data['OrderDetail']['amount'])*($settings['SiteSetting']['partner_percentage']))/100);

						} else {							
							$admin_commission=((($data['OrderDetail']['amount'])*($settings['SiteSetting']['admin_percentage']))/100);
							$price_paid=($data['OrderDetail']['amount']-$admin_commission);
						}
						$Item[$i] = array(
									'l_email' => $userPaymentdetail['UserPaymentDetail']['paypal_email'], 							
									'l_receiverid' => '', 						
									'l_amt' => $price_paid, 			
									'l_uniqueid' => $userPaymentdetail['UserPaymentDetail']['user_id'], 						
									'l_note' => 'ShopOwner_'.$order_id 								
							);
						$i++;
					}
				}
			}
			if($has_partner==true){
				$this->UserPaymentDetail->recursive = -1;
				$options = array('conditions' => array('UserPaymentDetail.user_id' => $partnersDetails['User']['id']));
				$partnerPaymentdetail = $this->UserPaymentDetail->find('first', $options);
				if($partnerPaymentdetail){
					#pr($partnerPaymentdetail);
					$count = count($Item);
					$Item[$count] = array(
								'l_email' => $partnerPaymentdetail['UserPaymentDetail']['paypal_email'], 							
								'l_receiverid' => '', 						
								'l_amt' => $partner_commission, 			
								'l_uniqueid' => $partnerPaymentdetail['UserPaymentDetail']['user_id'], 						
								'l_note' => 'Partner_'.$order_id 								
						);
				}
			}
			#pr($Item);
			$MPItems = $Item;
		}
		#pr($order);
		$this->set(compact('settings','order','orderDetails','MPItems'));
	}

	public function admin_payments($payments = null){
		$PayPalResult = base64_decode($payments);
		$PayPalResult = unserialize($PayPalResult);
		#pr($PayPalResult);
		$contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email')));
		if($contact_email){
			$adminEmail = $contact_email['SiteSetting']['contact_email'];
		} else {
			$adminEmail = 'superadmin@shopsfit.com';
		}
		if($PayPalResult){
			if($PayPalResult['ACK']=='Success'){
				$i=0;
				for($i=0;$i<15;$i++){
					if(isset($PayPalResult['REQUESTDATA']['L_EMAIL'.$i])){
						$order = explode('_',$PayPalResult['REQUESTDATA']['L_NOTE'.$i]);
						if($order){
							$orderId = $order[1];
							$note = $order[0];
						} else{
							$orderId = 0;
							$note = '';
						}
						$options = array('conditions' => array('User.id' => $PayPalResult['REQUESTDATA']['L_UNIQUEID'.$i]));
						$userDetails = $this->User->find('first', $options);
						if($userDetails){
							$this->request->data['PartnershipDetail']['user_id'] = $PayPalResult['REQUESTDATA']['L_UNIQUEID'.$i];
							$this->request->data['PartnershipDetail']['order_id'] = $orderId;
							$this->request->data['PartnershipDetail']['amount_received'] = $PayPalResult['REQUESTDATA']['L_AMT'.$i];
							$this->request->data['PartnershipDetail']['payment_type'] = $note;
							$this->PartnershipDetail->create();
							$this->PartnershipDetail->save($this->request->data);
							if($note=='ShopOwner'){
								$msg_body = 'Hi '.$userDetails['User']['first_name'].'<br/><br/>You just received a payment from ShopsFit of amount $'.$PayPalResult['REQUESTDATA']['L_AMT'.$i].' for <strong>Order Id '.$orderId.'<strong> as the Shop Owner.<br/><br/>Thanks,<br/>ShopsFit';
							} else {
								$msg_body = 'Hi '.$userDetails['User']['first_name'].'<br/><br/>You just received a payment from ShopsFit of amount $'.$PayPalResult['REQUESTDATA']['L_AMT'.$i].' for <strong>Order Id '.$orderId.'<strong> as the Partner.<br/><br/>Thanks,<br/>ShopsFit';
							}
							App::uses('CakeEmail', 'Network/Email');
							$Email = new CakeEmail();
							$Email->emailFormat('both');
							$Email->from(array($adminEmail => 'ShopsFit'));
							$Email->to($PayPalResult['REQUESTDATA']['L_EMAIL'.$i]);
							$Email->subject('ShopsFit Payments Received');
							$Email->send($msg_body);
							
							$this->request->data['Order']['id'] = $orderId;
							$this->request->data['Order']['admin_paid'] = 1;
							$this->Order->save($this->request->data);
						}
					}
				}

				$this->Session->setFlash(__('Payment was done successfully.'));
				return $this->redirect(array('controller' => 'orders', 'action' => 'index'));
			} else {
				$this->Session->setFlash(__('Sorry the payment was not successfully. Please, try again.'));
				return $this->redirect(array('controller' => 'orders', 'action' => 'index'));
			}
		}
		exit;
	}
}