<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class WithdrawalRequestsController extends AppController {

	public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
	public $uses = array('WithdrawalRequest','User','FundDetail');
	public $paginate = array(
        'limit' => 25,
        'order' => array(
          'WithdrawalRequest.id' => 'desc'
        )
    );

    public function index(){
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/users/login');
        }

        $userDetails = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
        
        if($userDetails['User']['admin_type'] == 2 || $userDetails['User']['admin_type'] == 1) {
            $this->loadModel('FundDetail');
            $fundDetail = $this->FundDetail->find('first',array('conditions'=>array('FundDetail.user_id'=>$userid)));
            if(isset($fundDetail) && !empty($fundDetail)){
                $total_fund = $fundDetail['FundDetail']['amount'];
            }
            else{
                $total_fund = 0;
            }
            
            $withdrawalRequests = $this->WithdrawalRequest->find('all',array('conditions'=>array('WithdrawalRequest.user_id'=>$userid),'order' => array('WithdrawalRequest.id DESC'),'limit'=>10));

          $this->set(compact('total_fund','withdrawalRequests'));  
        }

    }

    public function admin_index(){
    	$is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->WithdrawalRequest->recursive = 3;
        $this->Paginator->settings = $this->paginate;
        $this->set('WithdrawalRequests', $this->Paginator->paginate());

    }

    public function ajaxWithdrawalRequest(){
		
		$data = array();

		if(isset($this->request->data)){
            $this->loadModel('User');
            $withdrawalAmount = $this->request->data['WithdrawalRequest']['requested_fund'];
            $user_details = $this->FundDetail->find('first',array('conditions'=>array('FundDetail.user_id'=>$this->request->data['WithdrawalRequest']['user_id'])));
            if(!empty($user_details)){
                $user_fund = $user_details['FundDetail']['amount'];
                if($user_fund >=$withdrawalAmount){
        			if($this->WithdrawalRequest->save($this->request->data)){
        				$data['ack'] = 1;
                        $data['res'] = 'Your Withdrawal Request Has Been Submited';
        			}
        			else{
        				$data['ack'] = 0;
                        $data['res'] = 'Withdrawal Request Could Not Submited, Try Again';
        			}
                }
                else{
                    $data['ack'] = 0;
                    $data['res'] = 'insufficint fund';
                }    
            }
            else{
                $data['ack'] = 0;
                $data['res'] = 'No Fund Exist';
            }    	
		}
		else{
			$data['ack'] = 0;
            $data['res'] = 'Error!!';
		}
		echo json_encode($data);
		 exit;
	}

    public function ajaxActivateWithdrawal(){
        $data = array();
        if(isset($this->request->data)){
            $user_id = $this->request->data['user_id'];
            $withdrawalAmount = $this->request->data['amount'];
            $requestId = $this->request->data['request_id'];

            $this->loadModel('User');
            $user_details = $this->FundDetail->find('first',array('conditions'=>array('FundDetail.user_id'=>$user_id)));
            if(!empty($user_details)){
                $user_fund = $user_details['FundDetail']['amount'];
                if($user_fund>=$withdrawalAmount){
                    $newFund = $user_fund - $withdrawalAmount;
                    $this->FundDetail->id = $user_details['FundDetail']['id'];
                    $data = array('user_id'=>$user_id,'amount'=>$newFund);
                    $this->FundDetail->save($data);
                    $this->loadModel('WithdrawalRequest');
                    $this->WithdrawalRequest->id = $requestId;
                    $data = array('status'=>1);
                    $this->WithdrawalRequest->save($data);
                    $data['ack'] = 1;
                    $data['res'] = 'Fund Withdrawal Request Activated';
                }
                else{
                    $data['ack'] = 0;
                    $data['res'] = 'insufficint fund';
                }
            }
            else{
                $data['ack'] = 0;
                $data['res'] = 'No Fund Exist';
            }
        }
        echo json_encode($data);
        exit;

    }

    public function admin_delete($id = null){
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->WithdrawalRequest->id = $id;
        if (!$this->WithdrawalRequest->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->WithdrawalRequest->delete()) {
            $this->Session->setFlash(__('The Withdrawal Request has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Withdrawal Request could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}