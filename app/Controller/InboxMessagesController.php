<?php
App::uses('AppController', 'Controller');
/**
 * InboxMessages Controller
 *
 * @property InboxMessage $InboxMessage
 * @property PaginatorComponent $Paginator
 */
class InboxMessagesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Session','RequestHandler','Paginator');
	/*public $paginate = array(
        'limit' => 25,
        'order' => array(
            'InboxMessage.id' => 'desc'
        )
    );*/
    
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'InboxMessage.date_time' => 'desc'
        )
    );

	public $paginate1 = array(
        'limit' => 25,
        'order' => array(
            'InboxMessage.date_time' => 'desc'
        ),
		'group' => array(
            'InboxMessage.task_id','InboxMessage.date_time'
        )
    );

		public $paginate2 = array(
        'limit' => 25,
        'order' => array(
            'InboxMessage.date_time' => 'asc'
        )
    );
	var $uses = array('InboxMessage','SentMessage','Country','User','Category','ListImage');

/**
 * index method
 *
 * @return void
 */
	public function index($id=null) {
		$this->loadModel('Task');
		$id=base64_decode($id);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		if (isset($id) && $id!='') {
			$this->InboxMessage->recursive = 0;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.contact_id' => 0,'OR'=>array('InboxMessage.parent_id' =>$id)));
		}else {
                    if($this->request->is('post') && $this->request->data['messageType']=='SearchTask'){
                        $Keywords=$this->request->data['Keywords'];
                        $EmailDate=$this->request->data['EndDate'];
                        $QueryStr="(TaskUser.id=InboxMessage.task_id)";
                        if($Keywords!=''){
                            $QueryStr.=" AND (TaskUser.title LIKE '%".$Keywords."%')";
                        }
                        if($EmailDate!=''){
                            $QueryStr.=" AND (InboxMessage.date_time LIKE '%".$EmailDate."%')";
                        }
                        $options=array(             
                            'joins' => array(
                                array(
                                    'table' => 'tasks',
                                    'alias' => 'TaskUser',
                                    'type' => 'inner',
                                    'foreignKey' => false,
                                    'conditions'=> array($QueryStr)
                                )    
                            ), 
                            'conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0,'InboxMessage.contact_id' => 0),
                            'group' => array('InboxMessage.task_id,InboxMessage.sender_id'), 
                            'fields' => array('MAX(InboxMessage.id) ')			
                        );
                    }else{
			
			$options = array('conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0,'InboxMessage.contact_id' => 0),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
                    }
			$allmsg = $this->InboxMessage->find('all',$options);
			//echo '<pre>';
			//print_r($allmsg);

			$id =array();
			foreach($allmsg as $msg)
			{
				foreach($msg as $msgs)
				{

					$id[]= $msgs['MAX(`InboxMessage`.`id`)'];
				}

			}		

			
			$this->InboxMessage->recursive = 1;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));		
		}
		if ($this->request->is('post')){
			     
                    if(isset($this->request->data['messageType']) && !empty($this->request->data['messageType'])){
                        if(isset($this->request->data['msgid']) && !empty($this->request->data['msgid']))
                        {
                                if($this->request->data['messageType']=='Spam')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['is_spam']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }


                                        }
                                        $this->Session->setFlash(__('The message has been marked as Label.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }

                                if($this->request->data['messageType']=='Read')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['read']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }

                                        }
                                        $this->Session->setFlash(__('The message has been marked as Read.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }

                                if($this->request->data['messageType']=='Flag')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {

                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['is_flag']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }

                                        }
                                        $this->Session->setFlash(__('The message has been moved to Flagged.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }

                                if($this->request->data['messageType']=='Archive')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['is_archive']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }
                                        }
                                        $this->Session->setFlash(__('The message has been moved to Archive.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }

                                if($this->request->data['messageType']=='Delete')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['trash']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }
                                        }
                                        $this->Session->setFlash(__('The message has been deleted.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }
                        }elseif($this->request->is('post') && $this->request->data['messageType']!='SearchTask'){
                            $this->Session->setFlash(__('No Message Selected. Please select message and then perform.'));
                            return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                        }
                    }
		}
                else{
		
                }
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessages','id','Keywords','EmailDate'));
		
	}


	public function conversations($id=null,$sender_id=null,$msg_id=null) {
		$id=base64_decode($id);
		$sender_id=base64_decode($sender_id);
		$msg_id=base64_decode($msg_id);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid) || $id==''){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		
		if ($this->request->is('post'))
		{
			     if(isset($this->request->data['messageType']) && !empty($this->request->data['messageType']))
                    {
					if($this->request->data['messageType']=='Spam')
					{
							$options = array('conditions'=>array('InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['is_spam']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been marked as Label.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
			
					if($this->request->data['messageType']=='Read')
					{
							$options = array('conditions'=>array('InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['read']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been marked as Read.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
			
					if($this->request->data['messageType']=='Flag')
					{
							$options = array('conditions'=>array('InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['is_flag']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been moved to Flagged.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
			
					if($this->request->data['messageType']=='Archive')
					{
							$options = array('conditions'=>array('InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['is_archive']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been moved to Archive.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
					
					if($this->request->data['messageType']=='Delete')
					{
							$options = array('conditions'=>array('InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['trash']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been deleted.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
                }
		}
		if (isset($id) && $id!='') {
		$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate2;
		//$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id,)));
		
		/*$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.task_id' =>$id,'AND'=>array('OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id),'OR'=>array('InboxMessage.user_id' => $userid,'InboxMessage.sender_id' => $userid))));*/

		$inboxMessages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.task_id' =>$id,'AND'=>array('OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id),'OR'=>array('InboxMessage.user_id' => $userid,'InboxMessage.sender_id' => $userid))),'order' => array('InboxMessage.date_time' => 'asc')));

		$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $msg_id));
		$lastText = $this->InboxMessage->find('first', $options);

		// Inbox read

		$inbx_messages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $userid,'OR'=>array('InboxMessage.task_id' =>$id))));
		//echo "<pre>";
		//print_r($inbx_messages);
			foreach ($inbx_messages as $inbx_message) {
					/*if($inbx_message['InboxMessage']['read']==0){*/
				$this->request->data['InboxMessage']['read'] = 1;
				$this->request->data['InboxMessage']['id']= $inbx_message['InboxMessage']['id'];
				//$this->InboxMessage->ID = $inbx_message['InboxMessage']['id'];
				$this->InboxMessage->save($this->request->data);
				/*}*/
			}

		}
		else {
		$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate2;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0));		
		}

		$this->set(compact('title_for_layout','userid','countryname','user','inboxMessages','id','sender_id','msg_id','lastText'));
	}

		public function all_conversations($id=null,$sender_id=null) {
		$id=base64_decode($id);
		$sender_id=base64_decode($sender_id);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid) || $id==''){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		if (isset($id) && $id!='') {
		$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate2;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.sender_id' => $sender_id,'OR'=>array('InboxMessage.task_id' =>$id)));

		

		// Inbox read

		$inbx_messages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $userid,'OR'=>array('InboxMessage.task_id' =>$id))));
		//echo "<pre>";
		//print_r($inbx_messages);
			foreach ($inbx_messages as $inbx_message) {
					if($inbx_message['InboxMessage']['read']==0){
				$this->request->data['InboxMessage']['read'] = 1;
				$this->InboxMessage->ID = $inbx_message['InboxMessage']['id'];
				$this->InboxMessage->save($this->request->data);
				}
			}

		}
		else {
		$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate2;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0));		
		}

		$this->set(compact('title_for_layout','userid','countryname','user','inboxMessages','id'));
	
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null){
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
		if (!$this->InboxMessage->exists($id)) {
			throw new NotFoundException(__('Invalid inbox message'));
		}
		$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $id));
		$inboxMessage = $this->InboxMessage->find('first', $options);
		if($inboxMessage){
			if($inboxMessage['InboxMessage']['read']==0){
				$this->request->data['InboxMessage']['read'] = 1;
				$this->request->data['InboxMessage']['id'] = $id;
				$this->InboxMessage->save($this->request->data);
			}
		}
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessage'));
	}

	public function view_this($id = null) {
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
		if (!$this->InboxMessage->exists($id)) {
			throw new NotFoundException(__('Invalid inbox message'));
		}
		$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $id));
		$inboxMessage = $this->InboxMessage->find('first', $options);
		
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessage'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InboxMessage->create();
			if ($this->InboxMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The inbox message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inbox message could not be saved. Please, try again.'));
			}
		}
		$users = $this->InboxMessage->User->find('list');
		$senders = $this->InboxMessage->Sender->find('list');
		$this->set(compact('users', 'senders'));
	}

	public function reply($id = null) {
		$id = base64_decode($id);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Reply';
		if (!$this->InboxMessage->exists($id)) {
			throw new NotFoundException(__('Invalid inbox message'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		if ($id!='') {
		$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $id));
		$inboxMessage = $this->InboxMessage->find('first', $options);
		//pr($inboxMessage);
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
                                                     $sndId = base64_encode($inboxMessage['InboxMessage']['sender_id']);
                                                    $jobId = base64_encode($inboxMessage['InboxMessage']['task_id']);
                                                    $id = base64_encode($inboxMessage['InboxMessage']['id']);
						  $this->Session->setFlash(__('Please uploade file of .jpg, .jpeg, .png , .gif , .doc , docx , .txt or .pdf format.'));
                                                  return $this->redirect(array('action' => 'conversations/'.$jobId.'/'.$sndId.'/'.$id));
						 }
					}
				} 
				else 
				{
					$this->request->data['SentMessage']['location'] ='';
					$this->request->data['InboxMessage']['location'] ='';
				}

			//echo "<pre>";
			//print_r($inboxMessage);
			//exit;

			$this->request->data['SentMessage']['user_id'] = $userid;
			$this->request->data['SentMessage']['date_time'] = date('Y-m-d H:i:s');
			$this->request->data['SentMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
			$this->request->data['SentMessage']['inbox_id']=$inboxMessage['InboxMessage']['id'];
			$this->request->data['SentMessage']['task_id']=$inboxMessage['InboxMessage']['task_id'];
                        $sndId = base64_encode($inboxMessage['InboxMessage']['sender_id']);
                        $jobId = base64_encode($inboxMessage['InboxMessage']['task_id']);
                        $id = base64_encode($inboxMessage['InboxMessage']['id']);
			$this->SentMessage->create();
			if ($this->SentMessage->save($this->request->data)) {

				$this->request->data['InboxMessage']['user_id'] = $this->request->data['SentMessage']['receiver_id'];
				$this->request->data['InboxMessage']['sender_id'] = $userid;
				$this->request->data['InboxMessage']['subject'] = $this->request->data['SentMessage']['subject'];
				$this->request->data['InboxMessage']['message'] = $this->request->data['SentMessage']['message'];
				$this->request->data['InboxMessage']['date_time'] = date('Y-m-d H:i:s');

				$this->request->data['InboxMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
				$this->request->data['InboxMessage']['sentmsg_id']=$inboxMessage['InboxMessage']['sentmsg_id'];

				$this->request->data['InboxMessage']['task_id']=$inboxMessage['InboxMessage']['task_id'];
                                $this->request->data['InboxMessage']['contact_id']=$inboxMessage['InboxMessage']['contact_id'];
				$this->InboxMessage->create();
				$this->InboxMessage->save($this->request->data);
				
				$this->Session->setFlash(__('The message has been sent successfully.'));
				return $this->redirect(array('action' => 'conversations/'.$jobId.'/'.$sndId.'/'.$id));
			} else {
				$this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
                                return $this->redirect(array('action' => 'conversations/'.$jobId.'/'.$sndId.'/'.$id));
			}
		} else {
			return $this->redirect(array('action' => 'inbox_messages'));
		}
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessage'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InboxMessage->exists($id)) {
			throw new NotFoundException(__('Invalid inbox message'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InboxMessage->save($this->request->data)) {
				$this->Session->setFlash(__('The inbox message has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inbox message could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $id));
			$this->request->data = $this->InboxMessage->find('first', $options);
		}
		$users = $this->InboxMessage->User->find('list');
		$senders = $this->InboxMessage->Sender->find('list');
		$this->set(compact('users', 'senders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$id=base64_decode($id);
		$this->InboxMessage->id = $id;
		if (!$this->InboxMessage->exists()) {
			throw new NotFoundException(__('Invalid inbox message'));
		}
		//$this->request->onlyAllow('post', 'delete');
		if ($this->InboxMessage->delete()) {
			$this->Session->setFlash(__('The inbox message has been deleted.'));
		} else {
			$this->Session->setFlash(__('The inbox message could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function count_message($id = null) {
		$id=base64_decode($id);
		$options = array('conditions' => array('InboxMessage.task_id'=> $id));
		$count = $this->InboxMessage->find('count', $options);
		if ($count>1) {
			$countmsg=$count;
		}
		else {
			$countmsg='';
		}
		return $countmsg;
	}
	
	public function spam() {
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		
		$options = array('conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 1,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
			$allmsg = $this->InboxMessage->find('all',$options);
			//echo '<pre>';
			//print_r($allmsg);

			$id =array();
			foreach($allmsg as $msg)
			{
				foreach($msg as $msgs)
				{

					$id[]= $msgs['MAX(`InboxMessage`.`id`)'];
				}

			}		

			//echo '<pre>';
			//print_r($id);

			#exit;
			$this->InboxMessage->recursive = 1;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));
		
		/*$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 1));*/		
		#pr($inboxMessages);
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessages'));
	}
	
	public function archive() {
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		$options = array('conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 1,'InboxMessage.is_flag' => 0, 'InboxMessage.trash' => 0),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
			$allmsg = $this->InboxMessage->find('all',$options);
			//echo '<pre>';
			//print_r($allmsg);

			$id =array();
			foreach($allmsg as $msg)
			{
				foreach($msg as $msgs)
				{

					$id[]= $msgs['MAX(`InboxMessage`.`id`)'];
				}

			}		

			//echo '<pre>';
			//print_r($id);

			#exit;
			$this->InboxMessage->recursive = 1;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));
			
		/*$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_archive' => 1));*/		
		#pr($inboxMessages);
                if ($this->request->is('post')){
			     
                    if(isset($this->request->data['messageType']) && !empty($this->request->data['messageType'])){
                        if(isset($this->request->data['msgid']) && !empty($this->request->data['msgid']))
                        {
                                
                                if($this->request->data['messageType']=='Delete')
                                {
                                    //pr($this->request->data['msgid']);
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                //pr($seeChangeMsg);
                                                //exit;
                                                if(!empty($seeChangeMsg))
                                                {
                                                    foreach($seeChangeMsg as $chngMsg)
                                                    {
                                                        $msg['InboxMessage']['trash']=1;
                                                        $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                        $this->InboxMessage->save($msg);
                                                    }
                                                        
                                                }
                                        }
                                        $this->Session->setFlash(__('The message has been deleted.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'archive'));
                                }
                                
                                if($this->request->data['messageType']=='Read')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['read']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }

                                        }
                                        $this->Session->setFlash(__('The message has been marked as Read.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'archive'));
                                }

                        }elseif($this->request->is('post') && $this->request->data['messageType']!='SearchTask'){
                            $this->Session->setFlash(__('No Message Selected. Please select message and then perform.'));
                            return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'archive'));
                        }
                    }
		}        
                        
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessages'));
	}
	
	public function flag() {
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		$options = array('conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 1),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
			$allmsg = $this->InboxMessage->find('all',$options);
			//echo '<pre>';
			//print_r($allmsg);

			$id =array();
			foreach($allmsg as $msg)
			{
				foreach($msg as $msgs)
				{

					$id[]= $msgs['MAX(`InboxMessage`.`id`)'];
				}

			}		

			//echo '<pre>';
			//print_r($id);

			#exit;
			$this->InboxMessage->recursive = 1;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));
			
		/*$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_flag' => 1));*/		
		#pr($inboxMessages);
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessages'));
	}
        
        public function inbox_index($id=null) {
		$this->loadModel('Task');
		$id=base64_decode($id);
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Admin inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		$this->loadModel('Contact');
                
		if (isset($id) && $id!='') {
			$this->InboxMessage->recursive = 0;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.contact_id !=' => 0));
		}else {
                    /*if($this->request->is('post') && $this->request->data['messageType']=='SearchTask'){
                        $Keywords=$this->request->data['Keywords'];
                        $EmailDate=$this->request->data['EndDate'];
                        $QueryStr="(TaskUser.id=InboxMessage.task_id)";
                        if($Keywords!=''){
                            $QueryStr.=" AND (TaskUser.title LIKE '%".$Keywords."%')";
                        }
                        if($EmailDate!=''){
                            $QueryStr.=" AND (InboxMessage.date_time LIKE '%".$EmailDate."%')";
                        }
                        $options=array(             
                            'joins' => array(
                                array(
                                    'table' => 'tasks',
                                    'alias' => 'TaskUser',
                                    'type' => 'inner',
                                    'foreignKey' => false,
                                    'conditions'=> array($QueryStr)
                                )    
                            ), 
                            'conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0),
                            'group' => array('InboxMessage.task_id,InboxMessage.sender_id'), 
                            'fields' => array('MAX(InboxMessage.id) ')			
                        );
                    }else{
			
			$options = array('conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
                    }*/
                        $options = array('conditions' => array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0,'InboxMessage.contact_id !=' => 0),'group' => array('InboxMessage.contact_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
			$allmsg = $this->InboxMessage->find('all',$options);
			//echo '<pre>';
			//print_r($allmsg);

			$id =array();
			foreach($allmsg as $msg)
			{
				foreach($msg as $msgs)
				{

					$id[]= $msgs['MAX(`InboxMessage`.`id`)'];
				}

			}		

			
			$this->InboxMessage->recursive = 1;
			$this->Paginator->settings = $this->paginate;
			$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));		
		}
		if ($this->request->is('post')){
			     
                    if(isset($this->request->data['messageType']) && !empty($this->request->data['messageType'])){
                        if(isset($this->request->data['msgid']) && !empty($this->request->data['msgid']))
                        {
                                /*if($this->request->data['messageType']=='Spam')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['is_spam']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }


                                        }
                                        $this->Session->setFlash(__('The message has been marked as Label.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }*/

                                if($this->request->data['messageType']=='Read')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['read']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }

                                        }
                                        $this->Session->setFlash(__('The message has been marked as Read.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'inbox_index'));
                                }

                                /*if($this->request->data['messageType']=='Flag')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {

                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['is_flag']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }

                                        }
                                        $this->Session->setFlash(__('The message has been moved to Flagged.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
                                }*/

                                if($this->request->data['messageType']=='Archive')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['is_archive']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }
                                        }
                                        $this->Session->setFlash(__('The message has been moved to Archive.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'inbox_index'));
                                }

                                if($this->request->data['messageType']=='Delete')
                                {
                                        foreach($this->request->data['msgid'] as $k=>$v)
                                        {
                                                $options = array('conditions' => array('InboxMessage.id'=>$v));
                                                $inbxGet = $this->InboxMessage->find('first',$options);
                                                $pJobId = $inbxGet['InboxMessage']['task_id'];
                                                $senderId = $inbxGet['InboxMessage']['sender_id'];
                                                $options = array('conditions'=>array('InboxMessage.task_id' =>$pJobId,'OR'=>array('InboxMessage.sender_id' => $senderId,'InboxMessage.user_id' => $senderId)));
                                                $seeChangeMsg = $this->InboxMessage->find('all',$options);
                                                //echo count($seeChangeMsg).'<br>';
                                                if(!empty($seeChangeMsg))
                                                {
                                                        foreach($seeChangeMsg as $chngMsg)
                                                        {
                                                                $msg['InboxMessage']['trash']=1;
                                                                $msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
                                                                $this->InboxMessage->save($msg);
                                                        }
                                                }
                                        }
                                        $this->Session->setFlash(__('The message has been deleted.'));
                                        return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'inbox_index'));
                                }
                        }elseif($this->request->is('post') && $this->request->data['messageType']!='SearchTask'){
                            $this->Session->setFlash(__('No Message Selected. Please select message and then perform.'));
                            return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'admin_index'));
                        }
                    }
		}
                else{
		
                }
		$this->set(compact('title_for_layout','user','inboxMessages','id','Keywords','EmailDate'));
		
	}
        
        public function user_conversations($id=null,$sender_id=null,$msg_id=null) {
		$id=base64_decode($id);
		$sender_id=base64_decode($sender_id);
		$msg_id=base64_decode($msg_id);
		$countryname = '';
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid) || $id==''){
			$this->redirect('/');
		}
		$title_for_layout = 'Inbox Of '.$username;
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		
		if ($this->request->is('post'))
		{
			     if(isset($this->request->data['messageType']) && !empty($this->request->data['messageType']))
                    {
					if($this->request->data['messageType']=='Spam')
					{
							$options = array('conditions'=>array('InboxMessage.contact_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['is_spam']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been marked as Label.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
			
					if($this->request->data['messageType']=='Read')
					{
							$options = array('conditions'=>array('InboxMessage.contact_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['read']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been marked as Read.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
			
					if($this->request->data['messageType']=='Flag')
					{
							$options = array('conditions'=>array('InboxMessage.contact_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['is_flag']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been moved to Flagged.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
			
					if($this->request->data['messageType']=='Archive')
					{
							$options = array('conditions'=>array('InboxMessage.contact_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['is_archive']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been moved to Archive.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'index'));
					}
					
					if($this->request->data['messageType']=='Delete')
					{
							$options = array('conditions'=>array('InboxMessage.contact_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id)));
							$seeChangeMsg = $this->InboxMessage->find('all',$options);
							//echo count($seeChangeMsg).'<br>';
							if(!empty($seeChangeMsg))
							{
								foreach($seeChangeMsg as $chngMsg)
								{
									$msg['InboxMessage']['trash']=1;
									$msg['InboxMessage']['id']=$chngMsg['InboxMessage']['id'];
									$this->InboxMessage->save($msg);
								}
							}
						$this->Session->setFlash(__('The message has been deleted.'));
						return $this->redirect(array('controller' => 'inbox_messages', 'action' => 'user_conversations'));
					}
                }
		}
		if (isset($id) && $id!='') {
		$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate2;
		//$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.task_id' =>$id,'OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id,)));
		
		/*$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.task_id' =>$id,'AND'=>array('OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id),'OR'=>array('InboxMessage.user_id' => $userid,'InboxMessage.sender_id' => $userid))));*/

		$inboxMessages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.contact_id' =>$id,'AND'=>array('OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id),'OR'=>array('InboxMessage.user_id' => $userid,'InboxMessage.sender_id' => $userid))),'order' => array('InboxMessage.date_time' => 'asc')));

		$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $msg_id));
		$lastText = $this->InboxMessage->find('first', $options);

		// Inbox read

		$inbx_messages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $userid,'OR'=>array('InboxMessage.contact_id' =>$id))));
		//echo "<pre>";
		//print_r($inbx_messages);
			foreach ($inbx_messages as $inbx_message) {
					/*if($inbx_message['InboxMessage']['read']==0){*/
				$this->request->data['InboxMessage']['read'] = 1;
				$this->request->data['InboxMessage']['id']= $inbx_message['InboxMessage']['id'];
				//$this->InboxMessage->ID = $inbx_message['InboxMessage']['id'];
				$this->InboxMessage->save($this->request->data);
				/*}*/
			}

		}else {
		$this->InboxMessage->recursive = 0;
		$this->Paginator->settings = $this->paginate2;
		$inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.user_id' => $userid,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.contact_id !=' => 0));		
		}

		$this->set(compact('title_for_layout','userid','countryname','user','inboxMessages','id','sender_id','msg_id','lastText'));
	}
        
        public function user_reply($id = null) {
		$id = base64_decode($id);
		$countryname = '';
                $this->loadModel('Contact');
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		$title_for_layout = 'Reply';
		if (!$this->InboxMessage->exists($id)) {
			throw new NotFoundException(__('Invalid inbox message'));
		}
		$options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
		$user = $this->User->find('first', $options);
		if($user){
			if(isset($user['User']['country']) && $user['User']['country']!=0){
				$countryname = $this->Country->find('first',array('conditions' => array('Country.id'=>$user['User']['country']),'fields' => array('Country.printable_name')));
				$countryname = $countryname['Country']['printable_name'];
			}
		}
		if ($id!='') {
		$options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $id));
		$inboxMessage = $this->InboxMessage->find('first', $options);
                $sndId = base64_encode($inboxMessage['InboxMessage']['sender_id']);
                $jobId = base64_encode($inboxMessage['InboxMessage']['contact_id']);
                $id = base64_encode($inboxMessage['InboxMessage']['id']);
		//pr($inboxMessage);
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
						  $this->Session->setFlash(__('Please uploade file of .jpg, .jpeg, .png , .gif , .doc , docx , .txt or .pdf format.'));
                                                  return $this->redirect(array('action' => 'user_conversations/'.$jobId.'/'.$sndId.'/'.$id));
						 }
					}
				} 
				else 
				{
					$this->request->data['SentMessage']['location'] ='';
					$this->request->data['InboxMessage']['location'] ='';
				}

			//echo "<pre>";
			//print_r($inboxMessage);
			//exit;

			$this->request->data['SentMessage']['user_id'] = $userid;
			$this->request->data['SentMessage']['date_time'] = date('Y-m-d H:i:s');
			$this->request->data['SentMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
			$this->request->data['SentMessage']['inbox_id']=$inboxMessage['InboxMessage']['id'];
			$this->request->data['SentMessage']['task_id']=$inboxMessage['InboxMessage']['task_id'];
			$this->SentMessage->create();
			if ($this->SentMessage->save($this->request->data)) {

				$this->request->data['InboxMessage']['user_id'] = $this->request->data['SentMessage']['receiver_id'];
				$this->request->data['InboxMessage']['sender_id'] = $userid;
				$this->request->data['InboxMessage']['subject'] = $this->request->data['SentMessage']['subject'];
				$this->request->data['InboxMessage']['message'] = $this->request->data['SentMessage']['message'];
				$this->request->data['InboxMessage']['date_time'] = date('Y-m-d H:i:s');

				$this->request->data['InboxMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
				$this->request->data['InboxMessage']['sentmsg_id']=$inboxMessage['InboxMessage']['sentmsg_id'];

				$this->request->data['InboxMessage']['task_id']=$inboxMessage['InboxMessage']['task_id'];
                                $this->request->data['InboxMessage']['contact_id']=$inboxMessage['InboxMessage']['contact_id'];
                                

				$this->InboxMessage->create();
				$this->InboxMessage->save($this->request->data);
                                $Contact_data['Contact']['id']=$inboxMessage['InboxMessage']['contact_id'];
				$Contact_data['Contact']['is_read']='0';
                                $this->Contact->save($Contact_data);
                                
				
				$this->Session->setFlash(__('The message has been sent successfully.'));
				return $this->redirect(array('action' => 'user_conversations/'.$jobId.'/'.$sndId.'/'.$id));
			} else {
				$this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
                                return $this->redirect(array('action' => 'user_conversations/'.$jobId.'/'.$sndId.'/'.$id));
			}
		} else {
			return $this->redirect(array('action' => 'inbox_index'));
		}
		$this->set(compact('title_for_layout','countries','countryname','user','inboxMessage'));
	}

        ///////////////////////// App Function suman ///////////////////////////////////////
        
        // http://errandchampion.com/inbox_messages/appInboxMsg/page:1?userID=28
        public function appInboxMsg() {
            $this->autoRender = false;
            $this->loadModel('Task');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            
            $options = array('conditions' => array('InboxMessage.user_id' => $userID,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0,'InboxMessage.contact_id' => 0),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
            $allmsg = $this->InboxMessage->find('all',$options);
            
            $id =array();
            foreach($allmsg as $msg){
                foreach($msg as $msgs){
                    $id[]= $msgs['MAX(`InboxMessage`.`id`)'];
                }
            }		
            
            $InboxMsgOpt=array('conditions' => array('InboxMessage.id' => $id));
            $inboxMessagesCnt=$this->InboxMessage->find('count', $InboxMsgOpt);
            
            if ($inboxMessagesCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Data found';
            }elseif($inboxMessagesCnt>=$page*10 || $inboxMessagesCnt>($page-1)*10){ 
                $this->InboxMessage->recursive = 1;
                $this->Paginator->settings = array('limit' => 10,'order' => array('InboxMessage.date_time' => 'desc'));
                $inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));
                App::import('Controller', 'SentMessages'); 
                $SentMessages = new SentMessagesController;
                foreach($inboxMessages as $val){
                    /*$UserProfile_img=isset($val['ByUser']['profile_img'])?$val['ByUser']['profile_img']:'';
                    $uploadImgPath = WWW_ROOT.'user_images';
                    if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                        $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                    }else{
                        $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                    }*/
                    
                    $sender_name=$SentMessages->getUsername($val['InboxMessage']['sender_id']);
                    
                    $inboxMsg['id']=$val['InboxMessage']['id'];
                    //$inboxMsg['Profile_img']=$UserProfile_imgLink;
                    $inboxMsg['task_id']=$val['InboxMessage']['task_id'];
                    $inboxMsg['sender_id']=$val['InboxMessage']['sender_id'];
                    $inboxMsg['sender_name']=$sender_name;
                    $inboxMsg['task_title']=$val['Task']['title'];
                    $inboxMsg['subject']=$val['InboxMessage']['subject'];
                    $inboxMsg['message']=$val['InboxMessage']['message'];
                    $inboxMsg['date_time']=$val['InboxMessage']['date_time'];
                    $data['InboxMsg'][]=$inboxMsg;
                }
                $data['Ack'] = 1;
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/inbox_messages/appArchiveMsg/page:1?userID=28
        public function appArchiveMsg() {
            $this->autoRender = false;
            //$this->loadModel('Task');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            
            $options = array('conditions' => array('InboxMessage.user_id' => $userID,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 1,'InboxMessage.is_flag' => 0, 'InboxMessage.trash' => 0),'group' => array('InboxMessage.task_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
            $allmsg = $this->InboxMessage->find('all',$options);
            
            $id =array();
            foreach($allmsg as $msg){
                foreach($msg as $msgs){
                    $id[]= $msgs['MAX(`InboxMessage`.`id`)'];
                }
            }	
            
            $InboxMsgOpt=array('conditions' => array('InboxMessage.id' => $id));
            $inboxMessagesCnt=$this->InboxMessage->find('count', $InboxMsgOpt);
            
            if ($inboxMessagesCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Data found';
            }elseif($inboxMessagesCnt>=$page*10 || $inboxMessagesCnt>($page-1)*10){
                $this->InboxMessage->recursive = 1;
                $this->Paginator->settings = array('limit' => 10,'order' => array('InboxMessage.date_time' => 'desc'));
                $inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));
                App::import('Controller', 'SentMessages'); 
                $SentMessages = new SentMessagesController;
                foreach($inboxMessages as $val){
                    $sender_name=$SentMessages->getUsername($val['InboxMessage']['sender_id']);
                    $inboxMsg['id']=$val['InboxMessage']['id'];
                    //$inboxMsg['Profile_img']=$UserProfile_imgLink;
                    $inboxMsg['task_id']=$val['InboxMessage']['task_id'];
                    $inboxMsg['sender_id']=$val['InboxMessage']['sender_id'];
                    $inboxMsg['sender_name']=$sender_name;
                    $inboxMsg['task_title']=$val['Task']['title'];
                    $inboxMsg['subject']=$val['InboxMessage']['subject'];
                    //$inboxMsg['subject']=$val['InboxMessage']['date_time'];
                    $inboxMsg['message']=$val['InboxMessage']['message'];
                    $inboxMsg['date_time']=$val['InboxMessage']['date_time'];
                    $data['ArchiveMsg'][]=$inboxMsg;
                }
                $data['Ack'] = 1;
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/inbox_messages/appAdminMsg/page:1?userID=28
        public function appAdminMsg() {
            $this->autoRender = false;
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            
            $options = array('conditions' => array('InboxMessage.user_id' => $userID,'InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.trash' => 0,'InboxMessage.contact_id !=' => 0),'group' => array('InboxMessage.contact_id,InboxMessage.sender_id'),'fields' => array('MAX(InboxMessage.id) '));
            $allmsg = $this->InboxMessage->find('all',$options);
            
            $id =array();
            foreach($allmsg as $msg){
                foreach($msg as $msgs){
                    $id[]= $msgs['MAX(`InboxMessage`.`id`)'];
                }
            }	
            
            $InboxMsgOpt=array('conditions' => array('InboxMessage.id' => $id));
            $inboxMessagesCnt=$this->InboxMessage->find('count', $InboxMsgOpt);
            
            if ($inboxMessagesCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Data found';
            }elseif($inboxMessagesCnt>=$page*10 || $inboxMessagesCnt>($page-1)*10){
                $this->InboxMessage->recursive = 1;
                $this->Paginator->settings = array('limit' => 10,'order' => array('InboxMessage.date_time' => 'desc'));
                $inboxMessages = $this->Paginator->paginate('InboxMessage', array('InboxMessage.id' => $id));
                App::import('Controller', 'SentMessages'); 
                $SentMessages = new SentMessagesController;
                foreach($inboxMessages as $val){
                    $sender_name=$SentMessages->getUsername($val['InboxMessage']['sender_id']);
                    $inboxMsg['id']=$val['InboxMessage']['id'];
                    //$inboxMsg['Profile_img']=$UserProfile_imgLink;
                    $inboxMsg['task_id']=$val['InboxMessage']['task_id'];
                    $inboxMsg['sender_id']=$val['InboxMessage']['sender_id'];
                    $inboxMsg['sender_name']=$sender_name;
                    //$inboxMsg['task_title']=$val['Task']['title'];
                    $inboxMsg['subject']=$val['InboxMessage']['subject'];
                    $inboxMsg['message']=$val['InboxMessage']['message'];
                    $inboxMsg['date_time']=$val['InboxMessage']['date_time'];
                    $data['AdminMsg'][]=$inboxMsg;
                }
                $data['Ack'] = 1;
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/inbox_messages/appInboxMsgConversations?userID=28&task_id=27&sender_id=25&msgId=15
        public function appInboxMsgConversations() {
            $this->autoRender = false;
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $task_id=isset($_REQUEST['task_id'])?$_REQUEST['task_id']:'';
            $sender_id=isset($_REQUEST['sender_id'])?$_REQUEST['sender_id']:'';
            $msg_id=isset($_REQUEST['msgId'])?$_REQUEST['msgId']:'';
            
            if (isset($task_id) && $task_id!='') {
		$this->InboxMessage->recursive = 0;
		//$this->Paginator->settings = array('limit' => 30,'order' => array('InboxMessage.date_time' => 'asc'));
		
		$inboxMessages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.task_id' =>$task_id,'AND'=>array('OR'=>array('InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $sender_id),'OR'=>array('InboxMessage.user_id' => $userID,'InboxMessage.sender_id' => $userID))),'order' => array('InboxMessage.date_time' => 'asc')));

		// Inbox read
		$inbx_messages= $this->InboxMessage->find('all',array('conditions' =>  array('InboxMessage.is_spam' => 0,'InboxMessage.is_archive' => 0,'InboxMessage.is_flag' => 0,'InboxMessage.sender_id' => $sender_id,'InboxMessage.user_id' => $userid,'OR'=>array('InboxMessage.task_id' =>$id))));
                foreach ($inbx_messages as $inbx_message) {
                    $InMsg['InboxMessage']['read'] = 1;
                    $InMsg['InboxMessage']['id']= $inbx_message['InboxMessage']['id'];
                    //$this->InboxMessage->ID = $inbx_message['InboxMessage']['id'];
                    $this->InboxMessage->save($InMsg);
                }
            }
            
            if (empty($inboxMessages) || !isset($inboxMessages)) {
                $data['Ack']=0;
                $data['msg']='No Data found';
            }else{
                App::import('Controller', 'SentMessages'); 
                $SentMessages = new SentMessagesController;
                foreach($inboxMessages as $val){
                    $senderUser=$SentMessages->getUserDetails($val['InboxMessage']['sender_id']);
                    
                    $UserProfile_img=isset($senderUser['User']['profile_img'])?$senderUser['User']['profile_img']:'';
                    $uploadImgPath = WWW_ROOT.'user_images';
                    if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                        $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                    }else{
                        $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                    }
                    
                    $attachment_file=isset($val['InboxMessage']['location'])?$val['InboxMessage']['location']:'';
                    $uploadFilePath = WWW_ROOT.'location';
                    if($attachment_file!='' && file_exists($uploadFilePath . '/' . $attachment_file)){
                        $attachment=$this->webroot.'location/'.$attachment_file;
                    }else{
                        $attachment='';
                    }
                    
                    if($userID==$val['InboxMessage']['sender_id']) {
                        $SenderName='Me';
                    }else{
                        $SenderName=$SentMessages->getUsername($val['InboxMessage']['sender_id']);
                    }
                    //$sender_name=$SentMessages->getUsername($val['InboxMessage']['sender_id']);
                    
                    $inboxMsg['id']=$val['InboxMessage']['id'];
                    $inboxMsg['SenderName']=$SenderName;
                    $inboxMsg['Profile_img']=$UserProfile_imgLink;
                    $inboxMsg['task_id']=$val['InboxMessage']['task_id'];
                    $inboxMsg['sender_id']=$val['InboxMessage']['sender_id'];
                    $inboxMsg['attachment']=$attachment;
                    $inboxMsg['subject']=$val['InboxMessage']['subject'];
                    $inboxMsg['message']=$val['InboxMessage']['message'];
                    $inboxMsg['date_time']=$val['InboxMessage']['date_time'];
                    $data['MsgConversations'][]=$inboxMsg;
                }
                $data['Ack'] = 1;
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        /////////////////////////End App Function suman ///////////////////////////////////////
}


