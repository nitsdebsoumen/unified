<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class EnquiriesController extends AppController {

	public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');

	public function ajaxEnquiry(){

		$data = array();

		$user_name = $this->request->data['user_name'];
		$email 	   = $this->request->data['email'];
		$subject   = $this->request->data['subject']; 
		$query 	   = $this->request->data['query'];
		$post_id   = $this->request->data['post_id'];   
	
		$this->request->data['Enquiry']['user_name'] = $user_name;
		$this->request->data['Enquiry']['email']     = $email;
		$this->request->data['Enquiry']['subject']   = $subject; 
		$this->request->data['Enquiry']['query']     = $query;
		$this->request->data['Enquiry']['post_id']   = $post_id;  

		$this->Enquiry->create();
		if($this->Enquiry->save($this->request->data)){
			$data['ack'] = 1;
		}
		else{
			$data['ack'] = 0;
		}
		echo json_encode($data);
		exit;
	}

	public function user_enquiries($id = NULL){
		$user_id = base64_decode($id);
		//echo $user_id; exit;
		$this->loadModel('Post');
        $this->loadModel('Enquiry');
        $post_ids = $this->Post->find('list',array('conditions'=>array('Post.user_id'=>$user_id),'fields'=>array('Post.id')));
        

        $user_enquiry = $this->Enquiry->find('all',array('conditions'=>array('Enquiry.post_id'=>$post_ids)));
        $this->set(compact('user_enquiry'));
	}

	public function delete_enquiries($id = NULL){

		
		$eid = base64_decode($id);
        $user_id = $this->Session->read('userid');
        
        $this->Enquiry->id = $eid;
        if (!$this->Enquiry->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Enquiry->delete($eid)) {
            
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
        }
        $redirect = 'enquiries/user_enquiries/'.base64_encode($user_id);
        return $this->redirect(array('Controller'=>'enquiries','action'=>'user_enquiries',base64_encode($user_id)));

	}

	public function ajaxMail(){

		$data = array();
		$userid = $this->Session->read('userid');
		$this->loadModel('User');
		$userDetail = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
		$enquiryDetail = $this->Enquiry->find('first',array('conditions'=>array('Enquiry.id'=>$this->request->data['quote_id'])));

		$to = $enquiryDetail['Enquiry']['email'];
		$subject = "Reply Mail for Your Enquiry To Our Website Ladder.NG";

		$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		
		<table>
		<tr>
		<th>".$this->request->data['reply']."</th>
		
		</tr>
		</table>
		</body>
		</html>
		";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From:'.$userDetail['User']['email_address'];
		

		if(mail($to,$subject,$message,$headers)){
			$data['ack'] = 1;
		}
		else{
			$data['ack'] = 0;
		}
		
		echo json_encode($data);

		exit;
	}

	public function admin_index(){

	    $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
		
		 $this->paginate = array(
			'order' => array(
				'Enquiry.id' => 'asc'
			)
		);
		$this->Enquiry->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('enquiries', $this->Paginator->paginate());
		$this->set(compact('title_for_layout'));
	} 

	public function ajaxAdminMail(){

		$data = array();
		$userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
		$this->loadModel('User');
		$userDetail = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
		$enquiryDetail = $this->Enquiry->find('first',array('conditions'=>array('Enquiry.id'=>$this->request->data['quote_id'])));

		$to = $enquiryDetail['Enquiry']['email'];
		$subject = "Reply Mail for Your Enquiry To Our Website Ladder.NG";

		$message = "
		<html>
		<head>
		<title>HTML email</title>
		</head>
		<body>
		
		<table>
		<tr>
		<th>".$this->request->data['reply']."</th>
		
		</tr>
		</table>
		</body>
		</html>
		";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From:'.$userDetail['User']['email_address'];
		

		if(mail($to,$subject,$message,$headers)){
			$data['ack'] = 1;
		}
		else{
			$data['ack'] = 0;
		}
		
		echo json_encode($data);

		exit;
	}

	public function admin_delete($id = NULL){
		$this->Enquiry->id = $id;
            if (!$this->Enquiry->exists()) {
                throw new NotFoundException(__('Invalid Enquiry'));
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->Enquiry->delete()) {
                $this->Session->setFlash('The Enquiry has been deleted.','default', array('class'=>'success'));
            } else {
                $this->Session->setFlash('The Enquiry could not be deleted. Please, try again.','default', array('class'=>'error'));
            }
        return $this->redirect(array('action' => 'index'));
    }
}