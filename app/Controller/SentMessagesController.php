<?php
App::uses('AppController', 'Controller');
/**
 * SentMessages Controller
 *
 * @property SentMessage $SentMessage
 * @property PaginatorComponent $Paginator
 */
class SentMessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session','RequestHandler','Paginator');
	public $paginate = array(
        'limit' => 25,
        'order' => array(
            'SentMessage.date_time' => 'desc'
        )
    );
		public $paginate1 = array(
        'limit' => 25,
        'order' => array(
            'SentMessage.id' => 'desc'
        ),
		'group' => array(
            'SentMessage.task_id'
        )
    );
	var $uses = array('SentMessage','InboxMessage','Listing','Shop','Country','User','Category','Attribute','AttributeItem','UserPaymentDetail','UserBillingAddress','UserCreditCard','ListAttribute','ListAttributeItem','ListTag','ListMaterial','ListDispatch','ListImage','ListFile','ShopSetting','ShopFollowing','FavoriteList','FavoriteShop','ShopReview','ShopRating');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Sent By '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		
		/*$options = array('conditions' => array('SentMessage.user_id' => $userid),'group' => array('SentMessage.task_id,SentMessage.receiver_id'),'fields' => array('MAX(SentMessage.id) '));
			$allmsg = $this->SentMessage->find('all',$options);
			//echo '<pre>';
			//print_r($allmsg);

			$id =array();
			foreach($allmsg as $msg)
			{
				foreach($msg as $msgs)
				{

					$id[]= $msgs['MAX(`SentMessage`.`id`)'];
				}

			}		

			//echo '<pre>';
			//print_r($id);

			#exit;
			$this->SentMessage->recursive = 1;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('SentMessage', array('SentMessage.id' => $id));*/
		
                if ($this->request->is('post')){
			     
                    if(isset($this->request->data['messageType']) && !empty($this->request->data['messageType'])){
                        if(isset($this->request->data['msgid']) && !empty($this->request->data['msgid']))
                        {
                                
                                if($this->request->data['messageType']=='Delete')
                                {
                                    //pr($this->request->data['msgid']);
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('SentMessage.id'=>$v));
                                                $inbxGet = $this->SentMessage->find('first',$options);
                                                //$pJobId = $inbxGet['InboxMessage']['task_id'];
                                                //$senderId = $inbxGet['InboxMessage']['sender_id'];
                                                //$options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->SentMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                //pr($seeChangeMsg);
                                                //exit;
                                                if(!empty($seeChangeMsg))
                                                {
                                                    foreach($seeChangeMsg as $chngMsg)
                                                    {
                                                        $msg['SentMessage']['trash']=1;
                                                        $msg['SentMessage']['id']=$chngMsg['SentMessage']['id'];
                                                        $this->SentMessage->save($msg);
                                                    }
                                                        
                                                }
                                        }
                                        $this->Session->setFlash(__('The message has been deleted.'));
                                        return $this->redirect(array('controller' => 'sent_messages', 'action' => 'index'));
                                }
                                
                                if($this->request->data['messageType']=='Read')
                                {
                                    foreach($this->request->data['msgid'] as $k=>$v){
                                        $options = array('conditions' => array('SentMessage.id'=>$v));
                                        $inbxGet = $this->SentMessage->find('first',$options);
                                        $seeChangeMsg = $this->SentMessage->find('all',$options);

                                        if(!empty($seeChangeMsg)){
                                            foreach($seeChangeMsg as $chngMsg)
                                            {
                                                $msg['SentMessage']['read']=1;
                                                $msg['SentMessage']['id']=$chngMsg['SentMessage']['id'];
                                                $this->SentMessage->save($msg);
                                            }
                                        }
                                    }
                                    $this->Session->setFlash(__('The message has been marked as Read.'));
                                    return $this->redirect(array('controller' => 'sent_messages', 'action' => 'index'));
                                }
                        }elseif($this->request->is('post') && $this->request->data['messageType']!='SearchTask'){
                            $this->Session->setFlash(__('No Message Selected. Please select message and then perform.'));
                            return $this->redirect(array('controller' => 'sent_messages', 'action' => 'index'));
                        }
                    }
		} 
                
                
		$this->SentMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate1;
		$sentMessages = $this->Paginator->paginate('SentMessage', array('SentMessage.user_id' => $userid, 'SentMessage.trash' => 0));		
		#pr($sentMessages);
		$this->set(compact('title_for_layout','countries','countryname','user','sentMessages'));
	}

		public function conversations($parent=null) {
			$parent=base64_decode($parent);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Sent By '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		$this->SentMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$sentMessages = $this->Paginator->paginate('SentMessage', array('SentMessage.task_id' => $parent,'SentMessage.user_id'=>$userid));		
		#pr($sentMessages);
		$this->set(compact('title_for_layout','countries','countryname','user','sentMessages','parent'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$id = base64_decode($id);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'View Message';
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		if (!$this->SentMessage->exists($id)) {
			throw new NotFoundException(__('Invalid sent message'));
		}
		$options = array('conditions' => array('SentMessage.' . $this->SentMessage->primaryKey => $id));
		$sentMessage = $this->SentMessage->find('first', $options);
		#pr($sentMessage);
		$this->set(compact('title_for_layout','countries','countryname','user','sentMessage'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SentMessage->create();
			if ($this->SentMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The sent message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
			}
		}
		$users = $this->SentMessage->User->find('list');
		$receivers = $this->SentMessage->Receiver->find('list');
		$this->set(compact('users', 'receivers'));
	}

public function contact($reciever_id = null,$job_id = null) {
	  $countryname = '';
	  $reciever_id = base64_decode($reciever_id);
	  $job_id = base64_decode($job_id);
	  
	  $username = $this->Session->read('username');
	  $userid = $this->Session->read('userid');
	  if(!isset($userid)){
	   	$this->redirect('/');
	  }
	  $title_for_layout = 'Send Message';
	  $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
	  $user = $this->User->find('first', $options);
	  
  
  if ($this->request->is('post')) 
  {
	   #pr($this->request->data);
	   #exit;

	   	if(isset($this->request->data['SentMessage']['location']) && $this->request->data['SentMessage']['location']['name']!='')
	   {
		    $ext = explode('.',$this->request->data['SentMessage']['location']['name']);
		    if($ext)
		    {
			 $uploadFolder = "location";
			 $uploadPath = WWW_ROOT . $uploadFolder;
			 $extensionValid = array('jpg','jpeg','png','gif','doc','docx','pdf','txt');

			 if(in_array($ext[1],$extensionValid))
			 {
			   $imageName = rand().'_'.(strtolower(trim($this->request->data['SentMessage']['location']['name'])));
			   $full_image_path = $uploadPath . '/' . $imageName;
			   move_uploaded_file($this->request->data['SentMessage']['location']['tmp_name'],$full_image_path);
			   $this->request->data['SentMessage']['location'] = $imageName;
			   $this->request->data['InboxMessage']['location']=$imageName;
			  } 
			  else
			  {
			    $this->Session->setFlash(__('Please uploade image of .jpg, .jpeg, .png , .gif , .doc , docx , .txt or .pdf format.'));
			    //return $this->redirect(array('action' => 'index'));
			  }
		    }
		    else
			 {
			   $this->Session->setFlash(__('File Does not support'));
			   //return $this->redirect(array('action' => 'compose'));
			 }
	   } 
	   else 
	   {
		    $this->request->data['SentMessage']['location'] ='';
		    $this->request->data['InboxMessage']['location'] ='';
	   }

	   $this->request->data['SentMessage']['user_id'] = $userid;
	   $this->request->data['SentMessage']['date_time'] = date('Y-m-d H:i:s');
	   $this->request->data['SentMessage']['task_id']=$job_id;
	   $this->SentMessage->create();
	   if ($this->SentMessage->save($this->request->data)) {

		    $sentmsg_id = $this->SentMessage->getLastInsertID();

		    $this->request->data['InboxMessage']['user_id'] = $this->request->data['SentMessage']['receiver_id'];
		    $this->request->data['InboxMessage']['sender_id'] = $userid;
		    $this->request->data['InboxMessage']['subject'] = $this->request->data['SentMessage']['subject'];
		    $this->request->data['InboxMessage']['message'] = $this->request->data['SentMessage']['message'];
		    $this->request->data['InboxMessage']['date_time'] = date('Y-m-d H:i:s');
		    $this->request->data['InboxMessage']['sentmsg_id']=$sentmsg_id;
		    $this->request->data['InboxMessage']['task_id']=$job_id;
		    $this->InboxMessage->create();
		    $this->InboxMessage->save($this->request->data);
		    $inbox_id = $this->InboxMessage->getLastInsertID();

		    // saving the data as parent also.

		    $this->SentMessage->ID=$sentmsg_id;
		    $Sdata['SentMessage']['parent_id']=$inbox_id;
		    $this->SentMessage->save($Sdata);

		    $this->InboxMessage->ID=$inbox_id;
		    $Idata['InboxMessage']['parent_id']=$inbox_id;
		    $this->InboxMessage->save($Idata);

		    $this->Session->setFlash(__('The message has been sent successfully.'));
		    return $this->redirect(array('action' => 'index'));
	   } else {
		    $this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
		   //return $this->redirect(array('action' => 'compose'));
	   }		
  }
  $this->set(compact('title_for_layout','countries','countryname','user','reciever_id'));
}

	/*
	public function compose($reciever_id = null) {
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'New Message';
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		if ($this->request->is('post')) {
			#pr($this->request->data);
			#exit;

			if(isset($this->request->data['SentMessage']['location']) && $this->request->data['SentMessage']['location']['name']!='')
				{
					$ext = explode('.',$this->request->data['SentMessage']['location']['name']);
					if($ext)
					{
						$uploadFolder = "location";
						$uploadPath = WWW_ROOT . $uploadFolder;
						$extensionValid = array('jpg','jpeg','png','gif','doc','docx','pdf','txt');
	
						if(in_array($ext[1],$extensionValid))
						{
							$imageName = rand().'_'.(strtolower(trim($this->request->data['SentMessage']['location']['name'])));
							$full_image_path = $uploadPath . '/' . $imageName;
							move_uploaded_file($this->request->data['SentMessage']['location']['tmp_name'],$full_image_path);
							$this->request->data['SentMessage']['location'] = $imageName;
							$this->request->data['InboxMessage']['location']=$imageName;
						 } 
						 else
						 {
						  $this->Session->setFlash(__('Please uploade image of .jpg, .jpeg, .png , .gif , .doc , docx , .txt or .pdf format.'));
						  return $this->redirect(array('action' => 'compose'));
						 }
					}
					else
						 {
						  $this->Session->setFlash(__('File Does not support'));
						  return $this->redirect(array('action' => 'compose'));
						 }
				} 
				else 
				{
					$this->request->data['SentMessage']['location'] ='';
					$this->request->data['InboxMessage']['location'] ='';
				}

			$this->request->data['SentMessage']['user_id'] = $userid;
			$this->request->data['SentMessage']['date_time'] = date('Y-m-d H:i:s');
			$this->SentMessage->create();
			if ($this->SentMessage->save($this->request->data)) {
				
				$sentmsg_id = $this->SentMessage->getLastInsertID();

				$this->request->data['InboxMessage']['user_id'] = $this->request->data['SentMessage']['receiver_id'];
				$this->request->data['InboxMessage']['sender_id'] = $userid;
				$this->request->data['InboxMessage']['subject'] = $this->request->data['SentMessage']['subject'];
				$this->request->data['InboxMessage']['message'] = $this->request->data['SentMessage']['message'];
				$this->request->data['InboxMessage']['date_time'] = date('Y-m-d H:i:s');
				$this->request->data['InboxMessage']['sentmsg_id']=$sentmsg_id;
				$this->InboxMessage->create();
				$this->InboxMessage->save($this->request->data);
				$inbox_id = $this->InboxMessage->getLastInsertID();
	
				// saving the data as parent also.
				
				$this->SentMessage->ID=$sentmsg_id;
				$Sdata['SentMessage']['parent_id']=$inbox_id;
				$this->SentMessage->save($Sdata);
				
				$this->InboxMessage->ID=$inbox_id;
				$Idata['InboxMessage']['parent_id']=$inbox_id;
				$this->InboxMessage->save($Idata);
				
				$this->Session->setFlash(__('The message has been sent successfully.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
				return $this->redirect(array('action' => 'compose'));
			}
		}
		$this->set(compact('title_for_layout','countries','countryname','user','reciever_id'));
	} */

	public function count_message($id = null) {
		$id=base64_decode($id);
		$userid = $this->Session->read('userid');
		$options = array('conditions' => array('SentMessage.task_id'=> $id,'SentMessage.user_id'=>$userid));
		$count = $this->SentMessage->find('count', $options);
		if ($count>1) {
			$countmsg=$count;
		}
		else {
			$countmsg='';
		}
		return $countmsg;
	}

	public function autosuggestuser($username = null){
		$userid = $this->Session->read('userid');		
		$data1='';
		if(isset($username) && ($username!='')){
			$paid_subscriber=array('4','5','6','7','9','10');
			$data = $this->User->find('all',array('conditions' => array('User.is_active' => 1,'User.subscription_id' =>$paid_subscriber, 'User.id !=' => $userid,'OR'=>array('User.first_name LIKE' => '%'.$username.'%','User.last_name LIKE' => '%'.$username.'%'))));
			if($data)
			{
				$i=1;
				foreach($data as $dataUser)
				{
					$uploadFolder = "user_images";
					$uploadPath = WWW_ROOT . $uploadFolder;
					//$imageName = $dataUser['User']['profile_img'];

					/*if(file_exists($uploadPath . '/' . $imageName) && $imageName!=''){
						$image = '<img src="http://192.232.197.138/shopfit/user_images/'.$imageName.'" alt="'.$dataUser['User']['user_name'].'" height="32" width="32">';
					} else {
						$image = '<img src="http://192.232.197.138/shopfit/user_images/default.png" alt="'.$dataUser['User']['first_name'].'" height="32" width="32">';
					}*/

					//$data1.='<div style="height:40px;width:290px;text-align:left;margin:5px 0px 0px 5px;border-bottom:1px solid #bcbcbc;" title="'.$dataUser['User']['user_name'].'"><a style="padding-left:5px;color:#0098d5;font-weight:bold;" href="javascript:void(0)" id="autoFill_'.$dataUser['User']['id'].'" onclick="autofill('.$dataUser['User']['id'].')"><div style="float:left;">'.$image.'</div><div style="float:left;margin-left:15px;padding-top:8px;">'.$dataUser['User']['user_name'].'</div></a></div>';
					
					$data1.='<div style="height:40px;width:374px;text-align:left;margin:5px 0px 0px 5px;border-bottom:1px solid #bcbcbc;" title="'.$dataUser['User']['first_name'].' '.$dataUser['User']['first_name'].' ('.$dataUser['User']['email'].')"><a style="padding-left:5px;color:#0098d5;font-weight:bold;" href="javascript:void(0)" id="autoFill_'.$dataUser['User']['id'].'" onclick="autofill('.$dataUser['User']['id'].')"><div style="float:left;margin-left:15px;padding-top:8px;">'.$dataUser['User']['first_name'].' '.$dataUser['User']['last_name'].'('.$dataUser['User']['email'].')</div></a></div>';
					
					$i++;
				}
			}
			else
			{
				$data1='<div style="height:25px;width:290px;color:red;margin:5px 0px 0px 5px;"><span style="padding-left:5px;color:#0098d5;font-weight:bold;">No Matches Found</span></div>';
			}
		}
		else
		{
			$data1='<div style="height:25px;width:290px;color:red;margin:5px 0px 0px 5px;"><span style="padding-left:5px;color:#0098d5;font-weight:bold;">No Matches Found</span></div>';
		}
		echo $data1;
		exit;
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SentMessage->exists($id)) {
			throw new NotFoundException(__('Invalid sent message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SentMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The sent message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('SentMessage.' . $this->SentMessage->primaryKey => $id));
			$this->request->data = $this->SentMessage->find('first', $options);
		}
		$users = $this->SentMessage->User->find('list');
		$receivers = $this->SentMessage->Receiver->find('list');
		$this->set(compact('users', 'receivers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SentMessage->id = $id;
		if (!$this->SentMessage->exists()) {
			throw new NotFoundException(__('Invalid sent message'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SentMessage->delete()) {
			$this->Session->setFlash(__('The sent message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The sent message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}


	public function getUsername($id = null){
  $username = '';
  if($id!=''){
   $userName = $this->User->find('first', array('conditions' => array('User.id' => $id)));
   if(!empty($userName)){
    $username = $userName['User']['first_name'].' '.$userName['User']['last_name'];
   }
  }
  return $username;
 }
 
 public function getUserDetails($id = null){
  $username = '';
  if($id!=''){
   $userName = $this->User->find('first', array('conditions' => array('User.id' => $id)));
   if(!empty($userName)){
    $username=$userName;
   }
  }
  return $username;
 }
 
    /////////////////////////Start App Function suman /////////////////////////////////////// 
 
     // http://errandchampion.com/sent_messages/appSendMessage?userID=25&reciever_id=28&errand_id=61&to_username=Anup Das&subject=Test Mail&message=some content&photo=photo
    public function appSendMessage() {
        $this->autoRender = false;
        $data = array();
        $userid=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
        $reciever_id=isset($_REQUEST['reciever_id'])?$_REQUEST['reciever_id']:'';
        $job_id=isset($_REQUEST['errand_id'])?$_REQUEST['errand_id']:'';
        $to_username = isset($_REQUEST['to_username']) ? $_REQUEST['to_username'] : '';
        $subject = isset($_REQUEST['subject']) ? $_REQUEST['subject'] : '';	
        
        $message = isset($_REQUEST['message']) ? $_REQUEST['message'] :'';
        $photo=isset($_FILES['photo']['name'])?$_FILES['photo']['name']:'';
        
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $user = $this->User->find('first', $options);
        if($reciever_id!='' && $job_id!=''){
            if(isset($photo) && $photo!=''){
                $ext = explode('/',$_FILES['photo']['type']);
                if($ext){
                    $uploadFolder = "location";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $extensionValid = array('jpg','jpeg','png','gif','doc','docx','pdf','txt');
                    if(in_array($ext[1],$extensionValid)){
                        $imageName = rand().'_'.(strtolower(trim($_FILES['photo']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($_FILES['photo']['tmp_name'],$full_image_path);
                        $SentMessage_data['SentMessage']['location'] = $imageName;
                        $InboxMessage_data['InboxMessage']['location'] = $imageName;
                    } else{
                        $data['msg'] = 'Please upload image of .jpg, .jpeg, .png or .gif format.';	
                    }
                }
            }else{
                $SentMessage_data['SentMessage']['location'] = '';
                $InboxMessage_data['InboxMessage']['location'] = '';
            }
            $SentMessage_data['SentMessage']['user_id'] = $userid;
            $SentMessage_data['SentMessage']['receiver_id'] = $reciever_id;
            $SentMessage_data['SentMessage']['username'] = $to_username;
            $SentMessage_data['SentMessage']['subject'] = $subject;
            $SentMessage_data['SentMessage']['message'] = $message;
            $SentMessage_data['SentMessage']['date_time'] = date('Y-m-d H:i:s');
            $SentMessage_data['SentMessage']['task_id']=$job_id;
            $this->SentMessage->create();
            if ($this->SentMessage->save($SentMessage_data)) {
		    $sentmsg_id = $this->SentMessage->getLastInsertID();
		    $InboxMessage_data['InboxMessage']['user_id'] = $reciever_id;
		    $InboxMessage_data['InboxMessage']['sender_id'] = $userid;
		    $InboxMessage_data['InboxMessage']['subject'] = $subject;
		    $InboxMessage_data['InboxMessage']['message'] = $message;
		    $InboxMessage_data['InboxMessage']['date_time'] = date('Y-m-d H:i:s');
		    $InboxMessage_data['InboxMessage']['sentmsg_id']=$sentmsg_id;
		    $InboxMessage_data['InboxMessage']['task_id']=$job_id;
		    $this->InboxMessage->create();
		    $this->InboxMessage->save($InboxMessage_data);
		    $inbox_id = $this->InboxMessage->getLastInsertID();

		    // saving the data as parent also.

		    $this->SentMessage->ID=$sentmsg_id;
		    $Sdata['SentMessage']['parent_id']=$inbox_id;
		    $this->SentMessage->save($Sdata);

		    $this->InboxMessage->ID=$inbox_id;
		    $Idata['InboxMessage']['parent_id']=$inbox_id;
		    $this->InboxMessage->save($Idata);
                    
                    $data['Ack']=1;
                    $data['msg']='The message has been sent successfully.';
	    } else {
                $data['Ack']=0;
                $data['msg']='The sent message could not be saved. Please, try again.';
           }
        }else{
            $data['Ack']=0;
            $data['msg']='Sorry! message could not made. Please try again';
        }  
        $result = json_encode($data);
        return $result;
    }
      
        // http://errandchampion.com/sent_messages/appSendMsgList/page:1?userID=28
        public function appSendMsgList() {
            $this->autoRender = false;
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            
            $options = array('conditions' => array('SentMessage.user_id' => $userID, 'SentMessage.trash' => 0));
            $SentMessagesCnt=$this->SentMessage->find('count', $options);
            
            if ($SentMessagesCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Data found';
            }elseif($SentMessagesCnt>=$page*10 || $SentMessagesCnt>($page-1)*10){
                $this->SentMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate1;
		$sentMessages = $this->Paginator->paginate('SentMessage', array('SentMessage.user_id' => $userID, 'SentMessage.trash' => 0));	
                foreach($sentMessages as $val){
                    $sender_name=$this->getUsername($val['SentMessage']['receiver_id']);
                    $inboxMsg['id']=$val['SentMessage']['id'];
                    //$inboxMsg['Profile_img']=$UserProfile_imgLink;
                    $inboxMsg['task_id']=$val['SentMessage']['task_id'];
                    $inboxMsg['receiver_id']=$val['SentMessage']['receiver_id'];
                    $inboxMsg['sender_name']=$sender_name;
                    //$inboxMsg['task_title']=$val['Task']['title'];
                    $inboxMsg['subject']=$val['SentMessage']['subject'];
                    $inboxMsg['message']=$val['SentMessage']['message'];
                    $inboxMsg['date_time']=$val['SentMessage']['date_time'];
                    $data['SentMsg'][]=$inboxMsg;
                }
                $data['Ack'] = 1;
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            
            $result = json_encode($data);
            return $result;
        }
    /////////////////////////End App Function suman ///////////////////////////////////////
}


