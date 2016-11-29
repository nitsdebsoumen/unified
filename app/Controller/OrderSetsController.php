<?php
App::uses('AppController', 'Controller');
/**
 * Orders Controller
 *
 * @property Order $Order
 * @property PaginatorComponent $Paginator
 */
class OrderSetsController extends AppController {
	
	public function ajaxOrderSet() {
			$data = array();
		if(!empty($this->request->data)){
			$this->request->data['OrderSet']['user_id'] = $this->request->data['user_id'];
			$this->request->data['OrderSet']['total_amount'] = $this->request->data['total_amount'];
			$this->request->data['OrderSet']['discount_amount'] = $this->request->data['discount_amount'];
			$this->request->data['OrderSet']['status'] = 0;
			$this->loadModel('OrderSet');
			if($this->OrderSet->save($this->request->data)){
				$orderSet_id = $this->OrderSet->id;
				$data['orderSet_id'] = $orderSet_id;
				$data['ack'] = 1;
			}
			else{
				$data['ack'] = 0;
			}
		}
		echo json_encode($data);
		exit;
	}

}	