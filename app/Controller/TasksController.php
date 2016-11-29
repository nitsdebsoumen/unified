<?php
App::uses('AppController', 'Controller');
/**
 * Contents Controller
 *
 * @property Content $Content
 * @property PaginatorComponent $Paginator
 */

use PayPal\Service\AdaptivePaymentsService;
use PayPal\Types\AP\FundingConstraint;
use PayPal\Types\AP\FundingTypeInfo;
use PayPal\Types\AP\FundingTypeList;
use PayPal\Types\AP\PayRequest;
use PayPal\Types\AP\Receiver;
use PayPal\Types\AP\ReceiverList;
use PayPal\Types\AP\SenderIdentifier;
use PayPal\Types\AP\ExecutePaymentRequest;
use PayPal\Types\Common\PhoneNumberType;
use PayPal\Types\Common\RequestEnvelope;
use PayPal\Types\AP\PaymentDetailsRequest;

class TasksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('Task','TaskImage');

/**
 * index method
 *
 * @return void
 */
	////////////////////////////////////////AK Start//////////////////////////////////////
	public function add() {
		$userid = $this->Session->read('userid');
                $this->loadModel('Category');
		if($userid!='' && !empty($userid))
		{
			//print_r($this->request->data);
			if(isset($this->request->data['title']) && isset($this->request->data['description']) && !empty($this->request->data['title']) && !empty($this->request->data['description']))
			{
				$this->request->data['user_id'] = $userid;
				if($this->request->data['id']!='' && !empty($this->request->data['id']))
				{
					$this->request->data['id'] = base64_decode($this->request->data['id']);
                                        $category_id=$this->request->data['category_id'];
                                        //exit;
                                        $optionsCat = array('conditions' => array('Category.id' => $category_id));
                                        $category_data = $this->Category->find('first', $optionsCat); 
                                        $this->request->data['pcat_id']=$category_data['Category']['parent_id'];
					if ($this->Task->save($this->request->data)) {
						$id = ($this->request->data['id']);
						$options = array('conditions' => array('Task.id' => $id));
                              $task = $this->Task->find('first', $options); 
                              $taskdetails = $task['Task'];
                              $id = base64_encode($this->request->data['id']);
						 $rarray = array('status' => 'success','id' => $id,'task'=>$taskdetails);
					}
				}else{
                                        $category_id=$this->request->data['category_id'];
                                        $optionsCat = array('conditions' => array('Category.id' => $category_id));
                                        $category_data = $this->Category->find('first', $optionsCat); 
                                        $this->request->data['pcat_id']=$category_data['Category']['parent_id'];
					$this->Task->create();
					if ($this->Task->save($this->request->data)) {
						$id = $this->Task->getLastInsertId();
						$options = array('conditions' => array('Task.id' => $id));
                                    $task = $this->Task->find('first', $options); 
                                    $taskdetails = $task['Task'];
                                    $id = base64_encode($id);
						$rarray = array('status' => 'success','id' => $id,'task'=>$taskdetails);
						
					}
				}
				
			}else{
				$rarray = array('status' => 'error','message' => 'Please enter all the mandatory fields.');
			}
		}else{
			$rarray = array('status' => 'error','message' => 'Please login to add Errand.');
			
		}
		echo json_encode($rarray);
          exit;
	}
	
	public function step2() {
		$userid = $this->Session->read('userid');
		if($userid!='' && !empty($userid))
		{
			//print_r($this->request->data);
			if(isset($this->request->data['task_location']) && isset($this->request->data['due_date']) && isset($this->request->data['completed']) && !empty($this->request->data['task_location']) && !empty($this->request->data['due_date']) && !empty($this->request->data['completed']))
			{
				
				$location = $this->request->data['task_location'];
		           $prepAddr = str_replace(' ','+',$location);
		           $url=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=true');
		           $output= json_decode($url);
		           $lat = $output->results[0]->geometry->location->lat;
		           $lang= $output->results[0]->geometry->location->lng;
		           $this->request->data['lat']=$lat;
		           $this->request->data['lang']=$lang;
				//$this->request->data['user_id'] = $userid;
				if($this->request->data['id']!='' && !empty($this->request->data['id']))
				{
					$this->request->data['id'] = base64_decode($this->request->data['id']);
					if ($this->Task->save($this->request->data)) {
						$id = ($this->request->data['id']);
						$options = array('conditions' => array('Task.id' => $id));
                              $task = $this->Task->find('first', $options); 
                              $taskdetails = $task['Task'];
						$id = base64_encode($this->request->data['id']);
						$rarray = array('status' => 'success','id' => $id,'task'=>$taskdetails);
					}
				}
				else{
					$rarray = array('status' => 'error','message' => 'Sorry. Please add task first.');
				}
				
			}else{
				$rarray = array('status' => 'error','message' => 'Please enter all the mandatory fields.');
			}
		}else{
			$rarray = array('status' => 'error','message' => 'Please login to add Task.');
			
		}
		echo json_encode($rarray);
          exit;
	}
	
	public function step3() {
            $userid = $this->Session->read('userid');
            $this->loadModel('EmailTemplate');
            $this->loadModel('SiteSetting');
            $this->loadModel('User');
            $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
            if($contact_email){
                $adminEmail = $contact_email['SiteSetting']['contact_email'];
                $adminSiteName = $contact_email['SiteSetting']['site_name'];
            } else {
                $adminEmail = 'superadmin@abc.com';
                $adminSiteName='';
            }
            if($userid!='' && !empty($userid)){
                    //print_r($this->request->data);
                if($this->request->data['id']!='' && !empty($this->request->data['id'])){
                    $this->request->data['id'] = base64_decode($this->request->data['id']);
                    $tsk=$this->Task->find('first',array('conditions'=>array('Task.id'=>$this->request->data['id'])));
                    $this->request->data['status'] = 2;
                    $this->request->data['post_date'] = date('Y-m-d');
                    if ($this->Task->save($this->request->data)) {
                        $id = base64_encode($this->request->data['id']);
                        $rarray = array('status' => 'success','id' => $id);
                        if($tsk['Task']['status']!=2){ 
                            $this->loadModel('Notification');
                            $noti['Notification']['for_user_id'] = 0;
                            $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                            $noti['Notification']['task_id'] = $tsk['Task']['id'];
                            $noti['Notification']['date'] = date('Y-m-d H:i:s');;
                            $noti['Notification']['type'] = 'has posted new task';
                            $this->Notification->create();
                            $this->Notification->save($noti);
                        }else{
                            $this->loadModel('Proposal');
                            $this->loadModel('Job');
                            $pro=$this->Proposal->find('all',array('conditions'=>array('Proposal.task_id'=>$tsk['Task']['id'])));
                            if(!empty($pro)){
                                foreach($pro as $pros){
                                    $this->loadModel('Notification');
                                    $noti['Notification']['for_user_id'] = $pros['Proposal']['user_id'];
                                    $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                                    $noti['Notification']['task_id'] = $tsk['Task']['id'];
                                    $noti['Notification']['date'] = date('Y-m-d H:i:s');;
                                    $noti['Notification']['type'] = 'has edited task';
                                    $this->Notification->create();
                                    $this->Notification->save($noti);
                                }
                            }
                        }
                        // customer mail send for new task
                        $task_Name=$tsk['Task']['title'];
                        $task_location=$tsk['Task']['task_location'];
                        $taskByUserName=$tsk['User']['first_name'].' '.$tsk['User']['last_name'];
                        if($task_location!=''){
                            $TaskLocUser=$this->User->find('all',array('conditions'=>array('User.location'=>$task_location, 'User.id !='=>$userid, 'OR'=>array('User.user_type'=>2,'User.user_type'=>3))));
                        }else{
                            $TaskLocUser=array();
                        }
                        App::uses('CakeEmail', 'Network/Email');
                        $Email = new CakeEmail();
                        if(count($TaskLocUser)>0){
                            foreach($TaskLocUser as $UserVal){
                                $SendUserEmail=$UserVal['User']['email'];
                                $SendUserName=$UserVal['User']['first_name'].' '.$UserVal['User']['last_name'];
                                if($SendUserEmail!=''){
                                    
                                    $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>11)));
                                    $mail_body =str_replace(array('[USER]','[POSTBY]','[TASKNAME]','[TASKLOCATION]'),array($SendUserName,$taskByUserName,$task_Name,$task_location),$EmailTemplate['EmailTemplate']['content']);

                                    
                                    /* pass user input to function
                                    $Email->emailFormat('both');
                                    $Email->from(array($adminEmail => $adminSiteName));
                                    $Email->to($SendUserEmail);
                                    $Email->subject($EmailTemplate['EmailTemplate']['subject']);
                                    $Email->send($mail_body); */
                                    
                                    $from=$adminSiteName.' <'.$adminEmail.'>';
                                    $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
                                    $this->php_mail($SendUserEmail,$from,$Subject_mail,$mail_body);
                                }
                            } 
                        }
                        //return $this->redirect(array('controller'=>'users','action' => 'my_task'));
                        
                    }
                }else{
                    $rarray = array('status' => 'error','message' => 'Sorry. Please add task first.');
                }
            }else{
                $rarray = array('status' => 'error','message' => 'Please login to add Task.');
            }
            echo json_encode($rarray);
            exit;
	}
	
	public function check_for_edit(){
		$userid = $this->Session->read('userid');
		$id = base64_decode($this->request->data['tid']);
		if($userid!='' && !empty($userid))
		{
			$options = array('conditions' => array('Task.id' => $id));
               $task = $this->Task->find('first', $options); 
               if(isset($task) && !empty($task))
               {
               	if($task['Task']['user_id'] == $userid)
               	{
               		$taskdetails = $task['Task'];
               		$id = base64_encode($task['Task']['id']);
               		$rarray = array('status' => 'success','task' => $taskdetails,'id'=>$id);
               	}
               	else{
               		$this->Session->setFlash('Sorry you do not have permission to edit the errand.','default',array('class'=>'error'));
				     return $this->redirect(array('controller'=>'users','action' => 'my_task'));
               		//$rarray = array('status' => 'error','message' => 'Sorry you do not have permission to edit the task.');
               	}
               }
               else{
               	$this->Session->setFlash('Sorry no errand found.','default',array('class'=>'error'));
				return $this->redirect(array('controller'=>'users','action' => 'my_task'));
               	//$rarray = array('status' => 'error','message' => 'Sorry no task found.');
               }
		}
		else{
			$this->Session->setFlash('Please login to add errand.','default',array('class'=>'error'));
			return $this->redirect(array('controller'=>'users','action' => 'my_task'));
			//$rarray = array('status' => 'error','message' => 'Please login to add Task.');
		}
		echo json_encode($rarray);
          exit;
	}
	
	public function getsubcat($id = null){
		$this->loadModel('Category');
		$options = array('conditions' => array('Category.parent_id'=>$id,'Category.active' => 1 ));
          $categories = $this->Category->find('all', $options);
          return $categories;
	}
	
	public function delete($id=null){
            $this->loadModel('Notification');
            $this->loadModel('TaskImage');
            $this->loadModel('TaskComment');
            $this->loadModel('SentMessage');
            $this->loadModel('InboxMessages');
            $this->loadModel('Proposal');
            $this->loadModel('PaymentHistory');
            $this->loadModel('Job');
            $this->loadModel('Contact');
            $task_id = base64_decode($id);
            
            $this->Task->id = $task_id;
            if (!$this->Task->exists()) {
                    $this->Session->setFlash(__('Invalid errand.'));
            }
            if ($this->Task->delete()) {
                $this->Notification->deleteAll(array('Notification.task_id' => $task_id), false);
                $this->TaskImage->deleteAll(array('TaskImage.task_id' => $task_id), false);
                $this->TaskComment->deleteAll(array('TaskComment.task_id' => $task_id), false);
                $this->SentMessage->deleteAll(array('SentMessage.task_id' => $task_id), false);
                $this->InboxMessages->deleteAll(array('InboxMessages.task_id' => $task_id), false);
                $this->Proposal->deleteAll(array('Proposal.task_id' => $task_id), false);
                $this->PaymentHistory->deleteAll(array('PaymentHistory.task_id' => $task_id), false);
                $this->Job->deleteAll(array('Job.task_id' => $task_id), false);
                $this->Contact->deleteAll(array('Contact.task_id' => $task_id), false);
                $this->Session->setFlash(__('The errand has been deleted.'));
            } else {
                $this->Session->setFlash(__('The errand could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('controller'=>'users','action' => 'my_task'));
       	}
	
	public function index(){
		$this->loadModel('Task');
            
            $title_for_layout = 'Errands List';
            //if ($this->request->is(array('post', 'put')) && $this->request->data['search']=='search' ) {
		
                /*$Keywords=$this->request->data['Keywords'];
                $TaskStatus=$this->request->data['TaskStatus'];
                $EndDate=$this->request->data['EndDate'];
                $MinPrice=$this->request->data['MinPrice'];
                $MaxPrice=$this->request->data['MaxPrice'];
                $task_location=$this->request->data['task_location'];
                $Category=$this->request->data['Category'];*/
            $TodayDate=date('Y-m-d');
            if (isset($_REQUEST['search']) && $_REQUEST['search']=='search' ) {
                $Keywords=isset($_REQUEST['Keywords'])?$_REQUEST['Keywords']:'';
                $TaskStatus=isset($_REQUEST['TaskStatus'])?$_REQUEST['TaskStatus']:'';
                $EndDate=isset($_REQUEST['EndDate'])?$_REQUEST['EndDate']:'';
                $MinPrice=isset($_REQUEST['MinPrice'])?$_REQUEST['MinPrice']:'';
                $MaxPrice=isset($_REQUEST['MaxPrice'])?$_REQUEST['MaxPrice']:'';
                $task_location=isset($_REQUEST['task_location'])?$_REQUEST['task_location']:'';
                $Category=isset($_REQUEST['Category'])?$_REQUEST['Category']:'';
                $ParentCatID=isset($_REQUEST['ParentCatID'])?base64_decode($_REQUEST['ParentCatID']):'';
                $WorkType=isset($_REQUEST['WorkType'])?$_REQUEST['WorkType']:'';
                
                $QueryStr="(Task.status='2')";
                if($ParentCatID!=''){
                    $QueryStr.=" AND (Task.pcat_id = '".$ParentCatID."')";
                }
                if($Keywords!=''){
                    $QueryStr.=" AND (Task.title LIKE '%".$Keywords."%')";
                }
                if($WorkType!=''){
                    $QueryStr.=" AND (Task.completed = '".$WorkType."')";
                }
                if($TaskStatus!=''){
                    $QueryStr.=" AND (Task.task_status = '".$TaskStatus."')";
                }else{
                    $QueryStr.=" AND (Task.task_status = 'O')";
                }
                if($EndDate!=''){
                    $QueryStr.=" AND (Task.due_date = '".$EndDate."')";
                }else{
                    $QueryStr.=" AND (Task.due_date >= '".$TodayDate."')";
                }
                if($MinPrice!='0' && $MaxPrice!='0' && $MinPrice!='' && $MaxPrice!=''){
                    $QueryStr.=" AND (Task.total_rate >= ".$MinPrice." AND Task.total_rate <= ".$MaxPrice.")";
                }
                  if($Category!=''){
                    $QueryStr.=" AND Task.category_id='".$Category."'";
                }
                if($task_location!=''){
                    $QueryStr.=" AND Task.task_location='".$task_location."'";
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('Task.id' => 'desc'), 'limit' => 10);
            }else{
                $options = array('conditions' => array('Task.status' => 2, 'Task.task_status' => 'O', 'Task.due_date >=' => $TodayDate), 'order' => array('Task.id' => 'desc'), 'limit' => 10);
                $Keywords='';
                $TaskStatus='';
                $EndDate='';
                $Price='';
                $WorkType='';
            }
            $this->Paginator->settings = $options;
            $TaskList=$this->Paginator->paginate('Task');
            //$TaskList=$this->Task->find('all', $options);
            //pr($TaskList);
            $this->loadModel('Category');
            
            $categories_lists=$this->Category->find("all",array("conditions"=>array("Category.parent_id"=>0)));
            $this->set(compact('title_for_layout','TaskList', 'EndDate', 'TaskStatus', 'Keywords', 'MinPrice','MaxPrice','categories_lists','Category','task_location','WorkType'));
	}
	
	/////////////////////01-02////////////////////////////
	public function detail($id = null){
            $id = base64_decode($id);
            $title_for_layout = 'Task Detail';
            $userid = $this->Session->read('userid');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Proposal');
            $this->loadModel('TaskComment');
            $this->loadModel('Notification');
            $this->loadModel('Rating');
            if(!empty($userid))
            {
                $runner_users = $this->User->find('all',array('conditions' => array('User.user_type' => array(2,3),'User.is_active' => 1, 'User.is_admin' => 0, 'User.id !=' => $userid)));
                $this->set(compact('runner_users'));
            }
            $options = array('conditions' => array('Task.id' => $id));
            $task = $this->Task->find('first', $options);

            if ($this->request->is(array('post', 'put')) && $this->request->data['post_comment']=='postComment' ) {
		      //pr($this->request->data);exit;
                $options = array('conditions' => array('TaskComment.task_id' => $id,'TaskComment.user_id'=>$userid));
                $com = $this->TaskComment->find('first', $options);


                $this->request->data['TaskComment']['user_id'] = $userid;
                $this->request->data['TaskComment']['task_id'] = $id;
                $this->request->data['TaskComment']['date'] = date('Y-m-d H:i:s');
                $this->TaskComment->create();
                if($this->TaskComment->save($this->request->data)){
                    $noti['Notification']['for_user_id'] = $task['User']['id'];
                    $noti['Notification']['by_user_id'] = $userid;
                    $noti['Notification']['task_id'] = $id;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'commented On';
                    $this->Notification->create();
                    $this->Notification->save($noti);
                    $this->Session->setFlash(__('You have successfully posted the comment.'));
                    return $this->redirect('/errands/detail/'.base64_encode($id));
                    //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));	
                }
            }elseif ($this->request->is(array('post', 'put')) && $this->request->data['post_comment']=='postCommentReply' ) {
                
                $this->request->data['TaskComment']['user_id'] = $userid;
                $this->request->data['TaskComment']['parent_id'] = $this->request->data['TaskComment']['parent_id'];
                $this->request->data['TaskComment']['task_id'] = $id;
                $this->request->data['TaskComment']['date'] = date('Y-m-d H:i:s');
                $this->TaskComment->create();
                if($this->TaskComment->save($this->request->data)){
                    $noti['Notification']['for_user_id'] = $task['User']['id'];
                    $noti['Notification']['by_user_id'] = $userid;
                    $noti['Notification']['task_id'] = $id;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'commented On';
                    $this->Notification->create();
                    $this->Notification->save($noti);
                    $this->Session->setFlash(__('You have successfully posted the comment.'));
                    return $this->redirect('/errands/detail/'.base64_encode($id));	          
                }
            }elseif ($this->request->is(array('post', 'put')) && $this->request->data['post_comment']=='postRating') {
                $Giverating=$this->request->data['Giverating'];  
                $rateto_user_id=$this->request->data['rateto_user_id'];
                $this->request->data['Rating']['task_id'] = $id;
                $this->request->data['Rating']['task_by'] = $userid;
                $this->request->data['Rating']['user_id'] = $rateto_user_id;
                $this->request->data['Rating']['rating'] = $Giverating;
                $this->request->data['Rating']['review'] =  $this->request->data['Rating']['review'];
                $this->request->data['Rating']['date_time'] = date('Y-m-d H:i:s');
                $this->Rating->create();
                if($this->Rating->save($this->request->data)){
                    $UrseRateoptions = array('conditions' => array('User.id' => $rateto_user_id));
                    $UrseRate = $this->User->find('first', $UrseRateoptions);
                    if(count($UrseRate)>0){
                        $UserPreviousRating=$UrseRate['User']['tot_rating'];
                        $UserPreviousReview=$UrseRate['User']['tot_review'];
                        $TotRat=($UserPreviousRating+$Giverating);
                        $TotRev=($UserPreviousReview+1);
                        $CalRating=$TotRat/$TotRev;
                        $UserUpdate['User']['id'] = $rateto_user_id;
                        $UserUpdate['User']['tot_rating'] = $CalRating;
                        $UserUpdate['User']['tot_review'] = $TotRev;
                        $this->User->save($UserUpdate);
                    }
                    $this->Session->setFlash(__('You have successfully posted the ratings and reviews.'));
                    return $this->redirect('/errands/detail/'.base64_encode($id));	          }
            }else{
            	$options = array('conditions' => array('TaskComment.task_id' => $id,'TaskComment.parent_id' => 0),'order'=>array('TaskComment.date'=>'DESC'));
                $comments = $this->TaskComment->find('all', $options);
                $options_cmt = array('conditions' => array('TaskComment.task_id' => $id),'order'=>array('TaskComment.date'=>'DESC'));
                $comments_count = $this->TaskComment->find('all', $options_cmt);
                $options = array('conditions' => array('Proposal.task_id' => $id),'order'=>array('Proposal.date'=>'DESC'));
                $proposals = $this->Proposal->find('all', $options);
                $options = array('conditions' => array('Job.task_id' => $id));
                $job = $this->Job->find('all', $options);
                $options = array('conditions' => array('User.id' => $userid));
                $user = $this->User->find('first', $options);
            }
            $options_proposal = array('conditions' => array('Proposal.task_id' => $id,'Proposal.user_id'=>$userid));
            $UserProposal = $this->Proposal->find('first', $options_proposal);
            
            $Ratingoptions = array('conditions' => array('Rating.task_id' => $id, 'Rating.task_by' => $userid));
            $RatingTask = $this->Rating->find('first', $Ratingoptions);
            $Reviewoptions = array('conditions' => array('Rating.task_id' => $id));
            $ReviewTaskList = $this->Rating->find('all', $Reviewoptions);
            $this->set(compact('title_for_layout','task','proposals','userid','job','comments','user', 'RatingTask', 'ReviewTaskList','UserProposal','comments_count'));
	}
        
        public function invite()
        {
            $this->loadModel('User');
            $this->loadModel('Task');
            $this->loadModel('SiteSetting');
            //pr($this->request->data);
            if($this->request->is('post'))
            {
                $task_details = $this->Task->find('first',array('conditions' => array('Task.id' => base64_decode($this->request->data['report_task_id']))));
                
                $type = $this->request->data['user_types'];
                $email = array();
                if($type=='runner' && (!empty($this->request->data['runner_users'])))
                {
                    $runner_users = $this->request->data['runner_users'];
                    foreach($runner_users as $user)
                    {
                        $user_details = $this->User->find('first',array('conditions' => array('User.id' => $user)));
                        if(!empty($user_details))
                        {
                            $email[] = $user_details['User']['email'];
                        }
                    }
                    
                }
                else
                {
                    $email = explode(",",$this->request->data['friends_email']);
                }
                if(!empty($email))
                {
                    foreach ($email as $temp)
                    {
                        //echo $temp;
                        if(!empty($temp))
                        {
                            $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
                           if($contact_email){
                                   $adminEmail = $contact_email['SiteSetting']['contact_email'];
                           } else {
                                   $adminEmail = 'superadmin@abc.com';
                           }

                           $this->loadModel('EmailTemplate');
                           $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>5)));
                           $siteurl= Configure::read('SITE_URL');
                           $TaskLINK=$siteurl.'tasks/detail/'.$this->request->data['report_task_id'];
                           $msg_body =str_replace(array('[TASKNAME]','[TASKLOCATION]','[LINK]'),array($task_details['Task']['title'],$task_details['Task']['task_location'],$TaskLINK),$EmailTemplate['EmailTemplate']['content']);

                           $from=$contact_email['SiteSetting']['site_name'].' <'.$adminEmail.'>';
                           $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
                           $this->php_mail($temp,$from,$Subject_mail,$msg_body);

                        }
                    }
                }
                $this->Session->setFlash(__('Invite sent successfully.', 'default', array('class' => 'success')));
                return $this->redirect('/errands/detail/'.$this->request->data['report_task_id']);
                //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.$this->request->data['report_task_id']));
            }
        }

        public function child_comment($id=null){
            //$this->loadModel('User');
            $this->loadModel('TaskComment');
            $options = array('conditions' => array('TaskComment.parent_id' => $id),'order'=>array('TaskComment.date'=>'ASC'));
            $ChildCmtArr=$this->TaskComment->find('all', $options);
            return $ChildCmtArr;
        }
        
	/////////////////////01-02////////////////////////////
	/////////////////////01-02////////////////////////////
	public function assign($id=null,$bid=null){
		$id=base64_decode($id);
		$bid=base64_decode($bid);
		$userid = $this->Session->read('userid');
		$this->loadModel('User');
		$this->loadModel('Job');
		$this->loadModel('Proposal');
		$this->loadModel('Notification');
		
		$options = array('conditions' => array('Task.id' => $id));
            $task = $this->Task->find('first', $options);

            $options = array('conditions' => array('Proposal.id' => $bid));
            $proposal = $this->Proposal->find('first', $options);

            if(isset($task) && isset($proposal) && !empty($task) && !empty($proposal))
            {
          	if($task['Task']['task_status']=='O' && $proposal['Proposal']['is_accepted']!=1 )
          	{
          		
          	}
          	else{
          		$this->Session->setFlash(__('Sorry could not assign the errand. Errand Already Assigned.'));
                        return $this->redirect('/errands/detail/'.base64_encode($id));
				//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          	}
          	if($task['Task']['user_id']==$userid)
          	{
          		$job['Job']['user_id'] = $proposal['Proposal']['user_id'];
          		$job['Job']['task_id'] = $task['Task']['id'];
          		$job['Job']['proposal_id'] = $proposal['Proposal']['id'];
          		$job['Job']['amount'] = $task['Task']['total_rate'];
          		$job['Job']['accepted_date'] = date('Y-m-d H:i:s');
          		$this->Job->create();
          		if($this->Job->save($job))
          		{
          			$tsk['Task']['id'] = $task['Task']['id'];
          			$tsk['Task']['task_status'] = 'A';
          			$this->Task->save($tsk);
          			
          			$pro['Proposal']['id'] = $proposal['Proposal']['id'];
          			$pro['Proposal']['is_accepted'] = '1';
          			$this->Proposal->save($pro);
          			
          			$noti['Notification']['for_user_id'] = $proposal['Proposal']['user_id'];
          			$noti['Notification']['by_user_id'] = $userid;
          			$noti['Notification']['task_id'] = $task['Task']['id'];
          			$noti['Notification']['date'] = date('Y-m-d H:i:s');;
          			$noti['Notification']['type'] = 'has assigned the task';
          			$this->Notification->create();
          			$this->Notification->save($noti);
          			
          			$this->Session->setFlash(__('You have successfully assigned the errand.'));
                                return $this->redirect('/errands/detail/'.base64_encode($id));
					//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          		}else{
          			$this->Session->setFlash(__('Sorry could not assign the errand. Please try again.'));
                                return $this->redirect('/errands/detail/'.base64_encode($id));
					//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          		}
          	}
          	else{
          		$this->Session->setFlash(__('Sorry you donot have permission to assign the errand.'));
                        return $this->redirect('/errands/detail/'.base64_encode($id));
				//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          	}
          }else{
          	$this->Session->setFlash(__('Sorry something is wrong. Please try again.'));
                return $this->redirect('/errands/detail/'.base64_encode($id));
			//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          }
          
	}
        
        //public function paybypaypal($paypal_email_field=null,$amount=null,$processing_fee=null,$service_fee=null,$request_id=null){
        public function paybypaypal(){    
   // echo $paypal_email_field.'|'.$amount.'|'.$processing_fee.'|'.$service_fee.'|'.$request_id;
            //$paypal_email_field=$this->request->data['PaypalEmail'];
            $ProposalID=base64_decode($this->request->data['ProposalID']);
            $paypal_custom=$this->request->data['paypal_custom'];
            //$paypal_amount=$this->request->data['paypal_amount'];
            //$usrid=$this->request->data['usrid'];
            $tid=  base64_decode($this->request->data['tid']);
            
            $this->loadModel('SiteSetting');
            $this->loadModel('User');
            $this->loadModel('Proposal');
            
            $options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => 1));
            $sitesetting = $this->SiteSetting->find('first', $options);
           
            $optionPro = array('conditions' => array('Proposal.id' => $ProposalID));
            $ProData = $this->Proposal->find('first', $optionPro);
            $request_id=$ProData['Proposal']['user_id'];
            $TotalAmt=$ProData['Proposal']['amount'];
            $UserAmt=$ProData['Proposal']['your_amount'];
            $site_amount=$ProData['Proposal']['site_amount'];
            
            $optionsr = array('conditions' => array('User.id' => $request_id));
            $user = $this->User->find('first', $optionsr);
            
            $siteurl= Configure::read('SITE_URL');
            //echo $bidID[0];
            /*App::import('Vendor', array('file' => 'paypal'.DS.'config.php'));
            App::import('Vendor', 'PayPal', array('file' => 'paypal'.DS.'paypal.class.php'));
            App::import('Vendor', 'PayPal_Adaptive', array('file' => 'paypal'.DS.'paypal.adaptive.class.php'));*/
            
            /**/
            require_once(ROOT . '/app/Vendor' . DS  . 'Paypal_adaptive'.DS.'PPBootStrap.php');
            require_once(ROOT . '/app/Vendor' . DS  . 'Paypal_adaptive'.DS.'Common'.DS.'Constants.php');
            
            //App::import('Vendor', 'PayPal', array('file' => 'paypal'.DS.'paypal.class.php'));
            //App::import('Vendor', 'PayPal_Adaptive', array('file' => 'paypal'.DS.'paypal.adaptive.class.php'));
            $usr_paypl_email=$user['User']['paypal_email'];
            $paypal_mode=$sitesetting['SiteSetting']['paypal_mode'];
            $amount_total=$TotalAmt;
            $return_url=$siteurl.'tasks/paypal_return_url/'.base64_encode($ProposalID);
            
            $receiver = array();
            
            $receiver[0] = new Receiver();
            $receiver[0]->email = $sitesetting['SiteSetting']['paypal_email'];
            //$receiver[0]->email = 'payments@errandchampion.com';
            //$receiver[0]->email = 'nits.arpita@gmail.com';
            $receiver[0]->amount = $amount_total;
            $receiver[0]->primary = "true";
            $receiver[0]->paymentType = "SERVICE";

            $receiver[1] = new Receiver();
            $receiver[1]->email = $usr_paypl_email;
            $receiver[1]->amount = $UserAmt;
            $receiver[1]->primary = "false";
            $receiver[1]->paymentType = "SERVICE";
            
            $receiverList = new ReceiverList($receiver);
            //$payRequest = new PayRequest(new RequestEnvelope("en_US"), $_POST['actionType'], $_POST['cancelUrl'], $_POST['currencyCode'], $receiverList, $_POST['returnUrl']);
            $payRequest = new PayRequest();
            $payRequest->receiverList = $receiverList;

            $requestEnvelope = new RequestEnvelope("en_US");
            $payRequest->requestEnvelope = $requestEnvelope; 
            $payRequest->actionType = "PAY_PRIMARY";
            $payRequest->feesPayer  = "PRIMARYRECEIVER";
            $payRequest->cancelUrl = $siteurl.'tasks/detail/'.base64_encode($tid);
            $payRequest->returnUrl = $return_url;
            $payRequest->currencyCode = "USD";
            
            /*$payRequest->fundingConstraint = new FundingConstraint();
            $payRequest->fundingConstraint->allowedFundingType = new FundingTypeList();
            $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo = array();
            $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[]  = new FundingTypeInfo('ECHECK');
            $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[]  = new FundingTypeInfo('BALANCE');
            $payRequest->fundingConstraint->allowedFundingType->fundingTypeInfo[]  = new FundingTypeInfo('CREDITCARD');*/
            
            $adaptivePaymentsService = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
            //$service = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
            $payResponse = $adaptivePaymentsService->Pay($payRequest); 
            
            //echo '<pre>';print_r($payResponse);
            //exit;
            $PayPalResult=$payResponse->responseEnvelope->ack;
            //$PayPalResultError=$payResponse->responseEnvelope->ack;
            /*$PayPal = new PayPal_Adaptive($PayPalConfig);
            $PayRequestFields = array(
                'ActionType'     => 'PAY_PRIMARY',
                'CancelURL'      => $siteurl.'tasks/detail/'.base64_encode($tid),
                'CurrencyCode'   => 'USD', 
                //'FeesPayer'      => 'SECONDARYONLY',
                'FeesPayer'      => 'PRIMARYRECEIVER',
                'ReturnURL'      => $siteurl.'tasks/paypal_return_url/'.base64_encode($ProposalID)
                //'SenderEmail'    => $paypal_email_field
            );

            
            
            $FundingTypes = array('ECHECK', 'BALANCE', 'CREDITCARD');
            $Receivers = array();
            $Receiver = array(
                'Amount'         => $amount_total, 							
                'Email'          => $sitesetting['SiteSetting']['paypal_email'],
                'PaymentType'    => 'SERVICE', 			
                'Primary'        => 'true',
                'Custom'         => $paypal_custom,
                'InvoiceID'      => '',
                'PaymentSubType' => '',
                'Phone'          => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => '')
            );
            array_push($Receivers,$Receiver);
            $Receiver = array(
                'Amount'         => $UserAmt, 							
                'Email'          => $usr_paypl_email, 								
                'PaymentType'    => 'SERVICE', 
                'Primary'        => 'false',
                'InvoiceID'      => '',
                'PaymentSubType' => '',
                'Phone'          => array('CountryCode' => '', 'PhoneNumber' => '', 'Extension' => '')
            );
            array_push($Receivers,$Receiver);
            $SenderIdentifierFields = array('UseCredentials' => '');
	    $AccountIdentifierFields = array('Email' => '');
            $PayPalRequestData = array(
                'PayRequestFields'        => $PayRequestFields, 
                'Receivers'               => $Receivers, 
                'SenderIdentifierFields'  => $SenderIdentifierFields, 
                'AccountIdentifierFields' => $AccountIdentifierFields
            );
		//echo '<pre>';print_r($PayPalRequestData);			
            $PayPalResult = $PayPal->Pay($PayPalRequestData);*/
	//echo '<pre>';print_r($PayPalResult);exit;
            if($PayPalResult=='Success'){
            
                $bidSave['Proposal']['id'] = $ProposalID;
                //$bidSave['Proposal']['paykey'] = $PayPalResult['PayKey'];
                $bidSave['Proposal']['paykey'] =$payResponse->payKey;
                if($this->Proposal->save($bidSave)) {
                    $pay_url=PAYPAL_REDIRECT_URL . '_ap-payment&paykey=' . $payResponse->payKey;
                    echo 'SUCCESS|'.$pay_url;
                }
            }else{
                $PayPalResultError=$payResponse->error[0]->message;
                echo 'Failure| '.$PayPalResultError;
                //echo 'Failure| '.$payResponse['error'][0]['message'];
            }
            exit;
        }
        
        public function paypal_return_url($ProposalID=null){
	    $ProID=base64_decode($ProposalID);
            //$ProID=33;
	    $this->loadModel('SiteSetting');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Proposal');
            $this->loadModel('Notification');
            $this->loadModel('PaymentHistory');
            $userid = $this->Session->read('userid');
            $optionPro = array('conditions' => array('Proposal.id' => $ProID));
            $ProData = $this->Proposal->find('first', $optionPro);
            //pr($ProData);
            //exit;
            $TotWorkers=$ProData['Task']['workers'];
            $request_id=$ProData['Proposal']['user_id'];
            $paykey=$ProData['Proposal']['paykey'];
            $task_id=$ProData['Proposal']['task_id'];
            $optionTotJob = array('conditions' => array('Job.task_id' => $task_id));
            $TotAssignWorker = $this->Job->find('count', $optionTotJob);
            
            /*App::import('Vendor', array('file' => 'paypal'.DS.'config.php'));
            App::import('Vendor', 'PayPal', array('file' => 'paypal'.DS.'paypal.class.php'));
            App::import('Vendor', 'PayPal_Adaptive', array('file' => 'paypal'.DS.'paypal.adaptive.class.php'));*/

            $options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => 1));
            $sitesetting = $this->SiteSetting->find('first', $options);
            $paypal_mode=$sitesetting['SiteSetting']['paypal_mode'];
            /*if($paypal_mode==1){
                $paypal_mode_text='FALSE';
            }else{
                $paypal_mode_text='TRUE';
            }
            $PayPalConfig = array(
		'Sandbox'               => $paypal_mode_text,
                'DeveloperAccountEmail' => $sitesetting['SiteSetting']['paypal_developer_email'],
                'ApplicationID'         => $sitesetting['SiteSetting']['paypal_app_id'],
                'DeviceID'              => '',
                'IPAddress'             => $_SERVER['REMOTE_ADDR'],
                'APIUsername'           => $sitesetting['SiteSetting']['api_username'],
                'APIPassword'           => $sitesetting['SiteSetting']['api_password'],
                'APISignature'          => $sitesetting['SiteSetting']['api_signature']
		//'APISubject'            => ''
            );*/
        if($TotWorkers >= ($TotAssignWorker+1)){
            require_once(ROOT . '/app/Vendor' . DS  . 'Paypal_adaptive'.DS.'PPBootStrap.php');
            //require_once(ROOT . '/app/Vendor' . DS  . 'Paypal_adaptive'.DS.'Common'.DS.'Constants.php');
            $requestEnvelope = new RequestEnvelope("en_US");
            $paymentDetailsReq = new PaymentDetailsRequest($requestEnvelope);
            $paymentDetailsReq->payKey = $paykey;
            $service_payment = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
            $response = $service_payment->PaymentDetails($paymentDetailsReq);
            $ack = $response->responseEnvelope->ack;
        
	if($ack=='Success'){
            /*$optionsJob = array('conditions'=>array('Job.task_id'=>$task_id));
            $jobCheck = $this->Job->find('first',$optionsJob);
            if(empty($jobCheck)){  */   
		$TransactionID=$response->paymentInfoList->paymentInfo[0]->transactionId;
                $bid = $ProID;
                $tid = $task_id;
                $options = array('conditions' => array('Proposal.id' => $bid));
          	$proposal = $this->Proposal->find('first', $options);
          	
		$job['Job']['user_id'] = $proposal['Proposal']['user_id'];
     		$job['Job']['task_id'] = $tid;
     		$job['Job']['proposal_id'] = $proposal['Proposal']['id'];
     		$job['Job']['amount'] = $proposal['Proposal']['amount'];
     		$job['Job']['admin_amount'] = $proposal['Proposal']['site_amount'];
     		$job['Job']['user_amount'] = $proposal['Proposal']['your_amount'];
                $job['Job']['paypal_fee'] = $proposal['Proposal']['paypal_fee'];
     		$job['Job']['transaction_id'] = $TransactionID;
     		$job['Job']['accepted_date'] = date('Y-m-d H:i:s');
     		$job['Job']['payment_status'] = 1;
     		$this->Job->create();
     		if($this->Job->save($job))
     		{
                    $job_id=$this->Job->getLastInsertId();
                    if($TotWorkers == ($TotAssignWorker+1)){ 
                        $tsk['Task']['id'] = $tid;
                        $tsk['Task']['task_status'] = 'A';
                        $this->Task->save($tsk);
                    }
                    $pro['Proposal']['id'] = $proposal['Proposal']['id'];
                    $pro['Proposal']['is_accepted'] = '1';
                    $this->Proposal->save($pro);

                    $noti['Notification']['for_user_id'] = $proposal['Proposal']['user_id'];
                    $noti['Notification']['by_user_id'] = $userid;
                    $noti['Notification']['task_id'] = $tid;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'has assigned the task';
                    $this->Notification->create();
                    $this->Notification->save($noti);

                    $payment['PaymentHistory']['for_user_id'] = $userid;
                    $payment['PaymentHistory']['by_user_id'] = $proposal['Proposal']['user_id'];
                    $payment['PaymentHistory']['task_id'] = $tid;
                    $payment['PaymentHistory']['job_id'] = $job_id;
                    $payment['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment['PaymentHistory']['transaction_id'] = $TransactionID;
                    $payment['PaymentHistory']['pay_amount'] = $proposal['Proposal']['amount'];
                    $payment['PaymentHistory']['user_amount'] = $proposal['Proposal']['your_amount'];
                    $payment['PaymentHistory']['admin_amount'] = $proposal['Proposal']['site_amount'];
                    $payment['PaymentHistory']['paypal_fee'] = $proposal['Proposal']['paypal_fee'];
                    $payment['PaymentHistory']['type'] = 'pay amount';
                    $payment['PaymentHistory']['payment_status'] = 1;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment);
                    
                    $payment_user['PaymentHistory']['for_user_id'] = $proposal['Proposal']['user_id'];
                    $payment_user['PaymentHistory']['by_user_id'] = $userid;
                    $payment_user['PaymentHistory']['task_id'] = $tid;
                    $payment_user['PaymentHistory']['job_id'] = $job_id;
                    $payment_user['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment_user['PaymentHistory']['transaction_id'] = $TransactionID;
                    $payment_user['PaymentHistory']['pay_amount'] = $proposal['Proposal']['amount'];
                    $payment_user['PaymentHistory']['user_amount'] = $proposal['Proposal']['your_amount'];
                    $payment_user['PaymentHistory']['admin_amount'] = $proposal['Proposal']['site_amount'];
                    $payment_user['PaymentHistory']['paypal_fee'] = $proposal['Proposal']['paypal_fee'];
                    $payment_user['PaymentHistory']['type'] = 'release fund';
                    $payment_user['PaymentHistory']['payment_status'] = 1;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment_user);
     		}
               
                $this->Session->setFlash('You have made payment successfully and assigned the errand.', 'default', array('class' => 'success'));
                return $this->redirect('/errands/pay_success/'.base64_encode($task_id));
                //return $this->redirect(array('controller'=>'tasks','action' => 'pay_success/'.base64_encode($task_id)));
            /*}else{
                $this->Session->setFlash('You have made payment successfully', 'default', array('class' => 'success'));
                return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($task_id)));
            }*/
	}else{
           
		$this->Session->setFlash('Sorry! payment could not made. Please try again');
                return $this->redirect('/errands/detail/'.base64_encode($task_id));
		//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($task_id)));
            }
        }else{
           
		$this->Session->setFlash('Sorry! payment could not made. Please try again');
                return $this->redirect('/errands/detail/'.base64_encode($task_id));
            }    
        }

	public function pay_success($id=null){
		$id=base64_decode($id);
		$title_for_layout = 'Payment Done Successfully';
		$options = array('conditions' => array('Task.id' => $id));
          $task = $this->Task->find('first', $options);
          $userid = $this->Session->read('userid');
          //pr($_POST);exit;
          /*if(isset($_POST['txn_id']))
          {
                $this->loadModel('User');
                $this->loadModel('Job');
                $this->loadModel('Proposal');
                $this->loadModel('Notification');
                $this->loadModel('PaymentHistory');
                $custom = explode('|',$_POST['custom']);
                $bid = base64_decode($custom[1]);
                $tid = base64_decode($custom[0]);
                $options = array('conditions' => array('Proposal.id' => $bid));
          	$proposal = $this->Proposal->find('first', $options);
          	
		$job['Job']['user_id'] = $proposal['Proposal']['user_id'];
     		$job['Job']['task_id'] = $tid;
     		$job['Job']['proposal_id'] = $proposal['Proposal']['id'];
     		$job['Job']['amount'] = $proposal['Proposal']['amount'];
     		$job['Job']['admin_amount'] = $proposal['Proposal']['site_amount'];
     		$job['Job']['user_amount'] = $proposal['Proposal']['your_amount'];
     		$job['Job']['transaction_id'] = $_POST['txn_id'];
     		$job['Job']['accepted_date'] = date('Y-m-d H:i:s');
     		$job['Job']['payment_status'] = 1;
     		$this->Job->create();
     		if($this->Job->save($job))
     		{
                    $job_id=$this->Job->getLastInsertId();
                    $tsk['Task']['id'] = $tid;
                    $tsk['Task']['task_status'] = 'A';
                    $this->Task->save($tsk);

                    $pro['Proposal']['id'] = $proposal['Proposal']['id'];
                    $pro['Proposal']['is_accepted'] = '1';
                    $this->Proposal->save($pro);

                    $noti['Notification']['for_user_id'] = $proposal['Proposal']['user_id'];
                    $noti['Notification']['by_user_id'] = $userid;
                    $noti['Notification']['task_id'] = $tid;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'has assigned the task';
                    $this->Notification->create();

                    $this->Notification->save($noti);

                    $payment['PaymentHistory']['for_user_id'] = $userid;
                    $payment['PaymentHistory']['by_user_id'] = $proposal['Proposal']['user_id'];
                    $payment['PaymentHistory']['task_id'] = $tid;
                    $payment['PaymentHistory']['job_id'] = $job_id;
                    $payment['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment['PaymentHistory']['transaction_id'] = $_POST['txn_id'];
                    $payment['PaymentHistory']['pay_amount'] = $proposal['Proposal']['amount'];
                    $payment['PaymentHistory']['user_amount'] = $proposal['Proposal']['your_amount'];
                    $payment['PaymentHistory']['admin_amount'] = $proposal['Proposal']['site_amount'];
                    $payment['PaymentHistory']['type'] = 'pay amount';
                    $payment['PaymentHistory']['payment_status'] = 1;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment);
                    
                    $payment_user['PaymentHistory']['for_user_id'] = $proposal['Proposal']['user_id'];
                    $payment_user['PaymentHistory']['by_user_id'] = $userid;
                    $payment_user['PaymentHistory']['task_id'] = $tid;
                    $payment_user['PaymentHistory']['job_id'] = $job_id;
                    $payment_user['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment_user['PaymentHistory']['transaction_id'] = $_POST['txn_id'];
                    $payment_user['PaymentHistory']['pay_amount'] = $proposal['Proposal']['amount'];
                    $payment_user['PaymentHistory']['user_amount'] = $proposal['Proposal']['your_amount'];
                    $payment_user['PaymentHistory']['admin_amount'] = $proposal['Proposal']['site_amount'];
                    $payment_user['PaymentHistory']['type'] = 'release fund';
                    $payment_user['PaymentHistory']['payment_status'] = 1;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment_user);

                    $this->Session->setFlash(__('You have successfully assigned the Task.'));
                    return $this->redirect(array('controller'=>'tasks','action' => 'pay_success/'.base64_encode($id)));
     		}
          }*/
          $this->set(compact('title_for_layout','task'));
	} 
	
	public function release_fund($id=null){
            $id = base64_decode($id);
            //$jid = base64_decode($jid);
            $userid = $this->Session->read('userid');

            $this->loadModel('SiteSetting');
            $this->loadModel('User');
            $this->loadModel('Task');
            $this->loadModel('Proposal');
            $this->loadModel('Job');
            $this->loadModel('Notification');
            $this->loadModel('PaymentHistory');

            $options = array('conditions' => array('Task.id' => $id));
            $task = $this->Task->find('first', $options);
            
            $options_job = array('conditions' => array('Job.task_id' => $id, 'Job.payment_status' =>1));
            $job_list = $this->Job->find('all', $options_job);
            
            require_once(ROOT . '/app/Vendor' . DS  . 'Paypal_adaptive'.DS.'PPBootStrap.php');
            foreach($job_list as $job){
            
                $ProposalID=$job['Job']['proposal_id'];
                $JobProID=$job['Job']['id'];
                $optionsProposal = array('conditions' => array('Proposal.id' => $ProposalID));
                $ProposalData = $this->Proposal->find('first', $optionsProposal);

                $PaymentHistoryoptions = array('conditions' => array('PaymentHistory.job_id' => $JobProID));
                $PaymentHistory = $this->PaymentHistory->find('all', $PaymentHistoryoptions);
                /*if($task['Task']['user_id']!=$userid) {
                    $this->Session->setFlash(__('Sorry you donot have permission to perform the errand.'));
                    return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                }else if($task['Task']['task_status']=='C'){
                    $this->Session->setFlash(__('Sorry errand already completed.'));
                    return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                }else if($job['Job']['is_finished']=='1'){
                    $this->Session->setFlash(__('Sorry errand have Released fund but not marked as complete.'));
                    return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                }else{*/

                    $options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => 1));
                    $sitesetting = $this->SiteSetting->find('first', $options);
                    $siteUrl = Configure::read('SITE_URL');
                    $amount_total=$job['Job']['user_amount'];
                    $PayKey=$ProposalData['Proposal']['paykey'];	
                    /////////////////////////////////////////////////////
                    
                    $executePaymentRequest = new ExecutePaymentRequest(new RequestEnvelope("en_US"),$PayKey);
                    $executePaymentRequest->actionType = 'PAY';
                    $PayPal = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
                    $PayPalResponse = $PayPal->ExecutePayment($executePaymentRequest);

                    $PayPalAck=$PayPalResponse->responseEnvelope->ack;

                    if($PayPalAck=='Success'){
                        $jb['Job']['id'] = $job['Job']['id'];
                        $jb['Job']['is_finished'] = 1;
                        $jb['Job']['finish_date'] = date('Y-m-d H:i:s');
                        if($this->Job->save($jb)){
                            $tsk['Task']['id'] = $task['Task']['id'];
                            $tsk['Task']['task_status'] = 'C';
                            $this->Task->save($tsk);

                            $noti['Notification']['for_user_id'] = $job['User']['id'];
                            $noti['Notification']['by_user_id'] = $userid;
                            $noti['Notification']['task_id'] = $task['Task']['id'];
                            $noti['Notification']['date'] = date('Y-m-d H:i:s');;
                            $noti['Notification']['type'] = 'has completed the task';
                            $this->Notification->create();
                            $this->Notification->save($noti);

                            foreach($PaymentHistory as $PayVal){
                                $PaymentHistoryData['PaymentHistory']['id'] = $PayVal['PaymentHistory']['id'];
                                $PaymentHistoryData['PaymentHistory']['release_date'] = date('Y-m-d H:i:s');
                                $PaymentHistoryData['PaymentHistory']['payment_status'] = 2;
                                $this->PaymentHistory->save($PaymentHistoryData);
                            }
                            $this->Session->setFlash(__('Payment has been released successfully.'));
                            //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                        }else{
                            $this->Session->setFlash(__('Sorry could not complete the errand. Please try again.'));
                            //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                        }
                    }else{
                        $this->Session->setFlash(__($PayPalResponse->error[0]->message));
                        //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                    }

                            /////////////////////End Release Payment/////////////////////////////////////

                       

                //}
            }
            return $this->redirect('/errands/detail/'.base64_encode($id));
            //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
	}
        
        public function request_payment($id=null){
            $id=base64_decode($id);
            $title_for_layout = 'Request Payment';
            $this->loadModel('SiteSetting');
            $this->loadModel('Notification');
            $this->loadModel('User');
            $options = array('conditions' => array('Task.id' => $id));
            $task = $this->Task->find('first', $options);
            $userid = $this->Session->read('userid');
          
            //$options = array('conditions' => array('Proposal.task_id' => $id, 'Proposal.is_accepted' =>1));
            //$proposal = $this->Proposal->find('first', $options);
            if(count($task)>0){
                $noti['Notification']['for_user_id'] = $task['Task']['user_id'];
                $noti['Notification']['by_user_id'] = $userid;
                $noti['Notification']['task_id'] = $id;
                $noti['Notification']['date'] = date('Y-m-d H:i:s');
                $noti['Notification']['type'] = ' has request for release payment';
                $this->Notification->create();
                $this->Notification->save($noti);
                
                $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
                if($contact_email){
                        $adminEmail = $contact_email['SiteSetting']['contact_email'];
                } else {
                        $adminEmail = 'superadmin@abc.com';
                }
                $UserName=$task['User']['first_name'];
                $Useremail=$task['User']['email'];
                if($Useremail!=''){
                    //$msg_body = 'Hi '.$UserName.'<br/><br/>Please release the fund for this ('.$task['Task']['title'].') task. <br/>Thanks,<br/>'.$contact_email['SiteSetting']['site_name'];

                    $this->loadModel('EmailTemplate');
                    $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>12)));
                    $msg_body =str_replace(array('[USER]','[ERRANDNAME]'),array($UserName,$task['Task']['title']),$EmailTemplate['EmailTemplate']['content']);
                    
                   /* App::uses('CakeEmail', 'Network/Email');
                    $Email = new CakeEmail();

                     pass user input to function 
                    $Email->emailFormat('both');
                    $Email->from(array($adminEmail => $contact_email['SiteSetting']['site_name']));
                    $Email->to($Useremail);
                    $Email->subject('Request for release payment.');
                    $Email->send($msg_body);*/
                    
                    $from=$contact_email['SiteSetting']['site_name'].' <'.$adminEmail.'>';
                    //$Subject_mail='Request for release payment.';
                    $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
                    $this->php_mail($Useremail,$from,$Subject_mail,$msg_body);
                }
                $this->Session->setFlash(__('You have successfully send request for errand payment.'));
                return $this->redirect('/errands/detail/'.base64_encode($id));
                //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
            }else{
                return $this->redirect('/errands/detail/'.base64_encode($id));
                //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
            }
          
	} 
	/////////////////////01-02////////////////////////////
	/////////////////////01-02////////////////////////////
	public function complete($id=null,$jobid=null){
		$id=base64_decode($id);
		$jobid=base64_decode($jobid);
		$userid = $this->Session->read('userid');
		$this->loadModel('User');
		$this->loadModel('Job');
		$this->loadModel('Proposal');
		$this->loadModel('Notification');
		
		$options = array('conditions' => array('Task.id' => $id));
          $task = $this->Task->find('first', $options);
          
          $options = array('conditions' => array('Job.id' => $jobid));
          $job = $this->Job->find('first', $options);
  //pr($job);        
          if(isset($task) && !empty($task) && isset($job) && !empty($job))
          {
          	if($task['Task']['user_id']==$userid)
          	{
          		$jb['Job']['id'] = $jobid;
          		$jb['Job']['is_finished'] = 1;
          		$jb['Job']['finish_date'] = date('Y-m-d H:i:s');
          		if($this->Job->save($jb))
          		{
          			$tsk['Task']['id'] = $task['Task']['id'];
          			$tsk['Task']['task_status'] = 'C';
          			$this->Task->save($tsk);
          			
          			$noti['Notification']['for_user_id'] = $job['User']['id'];
          			$noti['Notification']['by_user_id'] = $userid;
          			$noti['Notification']['task_id'] = $task['Task']['id'];
          			$noti['Notification']['date'] = date('Y-m-d H:i:s');;
          			$noti['Notification']['type'] = 'has completed the task';
          			$this->Notification->create();
          			$this->Notification->save($noti);
          			
          			$this->Session->setFlash(__('You have successfully completed the errand.'));
                                return $this->redirect('/errands/detail/'.base64_encode($id));
					//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          		}else{
          			$this->Session->setFlash(__('Sorry could not complete the errand. Please try again.'));
                                return $this->redirect('/errands/detail/'.base64_encode($id));
					//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          		}
          	}
          	else{
          		$this->Session->setFlash(__('Sorry you donot have permission to complete the errand.'));
                        return $this->redirect('/errands/detail/'.base64_encode($id));
				//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          	}
          }else{
          	$this->Session->setFlash(__('Sorry something is wrong. Please try again.'));
                return $this->redirect('/errands/detail/'.base64_encode($id));
			//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
          }
          
          
	}
	/////////////////////01-02////////////////////////////
	////////////////////03-02/////////////////////////////
	public function offer($id = null, $ProposalId=null){
            $id=base64_decode($id);
            $taskId=($id);
            //$taskId=base64_decode($ProposalId);
            $userid = $this->Session->read('userid');
            if(!isset($userid) && $userid==''){
               $this->redirect('/users/login');
            }

            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Proposal');
            $this->loadModel('BillingAddress');
            $this->loadModel('Notification');
            $options = array('conditions' => array('User.id'=>$userid));
            $user = $this->User->find('first', $options);
            $UserType=$user['User']['user_type'];
            if($UserType==1){
                $this->Session->setFlash(__('You cannot post an offer to this errand. Please check on "Run" to your account setting page.'));
                return $this->redirect('/errands/detail/'.base64_encode($id));
		//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
            }
            $options = array('conditions' => array('Task.id' => $id));
            $task = $this->Task->find('first', $options);

            $options_proposal = array('conditions' => array('Proposal.task_id' => $id,'Proposal.user_id'=>$userid));
            $UserProposal = $this->Proposal->find('first', $options_proposal);
            if($ProposalId!=''){
                $userProposalId=base64_decode($ProposalId);
                $options = array('conditions' => array('Proposal.id' => $userProposalId));
                $proposalEdit = $this->Proposal->find('first', $options); 
            }else{
                $proposalEdit=array();
            }
            
          
          $options = array('conditions' => array('BillingAddress.user_id'=>$userid));
          $baddress = $this->BillingAddress->find('first', $options);
          /*if(!empty($proposal)){
          	$this->Session->setFlash(__('You have already posted offer on this task.'));
		return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));	
          }*/
            if($userid == $task['Task']['user_id']){
     		$this->Session->setFlash(__('Sorry you have posted the errand, so cannot post offer on the errand.'));
		//return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));  
                return $this->redirect('/errands/detail/'.base64_encode($id)); 
            }
          
          if ($this->request->is(array('post', 'put')) && isset($this->request->data['post_offer']) && $this->request->data['post_offer']=='postOffer' ) {
                if($ProposalId!=''){
                    $this->request->data['Proposal']['id'] = $userProposalId;
                }else{
                    $this->request->data['Proposal']['date'] = date('Y-m-d H:i:s');
                }
          	$this->request->data['Proposal']['user_id'] = $userid;
     		$this->request->data['Proposal']['task_id'] = $id;
     		
     		$this->Proposal->create();
     		if($this->Proposal->save($this->request->data)){
                    if($ProposalId==''){
                        $noti['Notification']['for_user_id'] = $task['User']['id'];
     			$noti['Notification']['by_user_id'] = $userid;
     			$noti['Notification']['task_id'] = $id;
     			$noti['Notification']['date'] = date('Y-m-d H:i:s');;
     			$noti['Notification']['type'] = 'posted offer on';
     			$this->Notification->create();
     			$this->Notification->save($noti);
     			$this->Session->setFlash(__('You have successfully posted the offer.'));
                        //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id))); 
                        return $this->redirect('/errands/detail/'.base64_encode($id));
                    }else{
                        $this->Session->setFlash(__('You have successfully edit the offer.'));
                        //return $this->redirect(array('controller'=>'tasks','action' => 'detail/'.base64_encode($id)));
                        return $this->redirect('/errands/detail/'.base64_encode($id));
                    }
     		}
          
          }
          if ($this->request->is(array('post', 'put')) && isset($this->request->data['post_image']) && $this->request->data['post_image']=='postImage' ) {
          		if(isset($this->request->data['User']['profile_img']) && $this->request->data['User']['profile_img']['name']!=''){
                            $ext = explode('/',$this->request->data['User']['profile_img']['type']);
                            if($ext){
                                    $uploadFolder = "user_images";
                                    $uploadPath = WWW_ROOT . $uploadFolder;
                                    $extensionValid = array('jpg','jpeg','png','gif');
                                    if(in_array($ext[1],$extensionValid)){
                                            $imageName = $userid.'_'.(strtolower(trim($this->request->data['User']['profile_img']['name'])));
                                            $full_image_path = $uploadPath . '/' . $imageName;
                                            move_uploaded_file($this->request->data['User']['profile_img']['tmp_name'],$full_image_path);
                                            $usr['User']['profile_img'] = $imageName;
                                            $usr['User']['id'] = $userid;
                                            $this->User->save($usr);
                                            $this->Session->setFlash(__('Profile image Uploaded successfully.'));
                  			//return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
                                            #exit;
                                            //unlink($uploadPath. '/' .$this->request->data['User']['hidprofile_img']);
                                    } else{
                                            $this->Session->setFlash(__('Please upload your profile image.'));
                                            //return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                                            return $this->redirect('/errands/offer/'.base64_encode($taskId));
                                    }
                            }
                    } else {
                         $this->Session->setFlash(__('Please upload your profile image.'));
                  		//return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                                return $this->redirect('/errands/offer/'.base64_encode($taskId));
                    }
          }   
          
          if ($this->request->is(array('post', 'put')) && isset($this->request->data['post_birthday']) && $this->request->data['post_birthday']=='postBirthday' ) {
          		if(isset($this->request->data['User']['birthday']) && $this->request->data['User']['birthday']!=''){
                        $usr['User']['birthday'] = $this->request->data['User']['birthday'];
                        $usr['User']['id'] = $userid;
                        $this->User->save($usr);
                        $this->Session->setFlash(__('Date of Birth updated successfully.'));
				return $this->redirect('/errands/offer/'.base64_encode($taskId));  
                    } else {
                         $this->Session->setFlash(__('Please provide date of birth.'));
                         return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  		//return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }
          }   
          
          if ($this->request->is(array('post', 'put')) && isset($this->request->data['post_phone']) && $this->request->data['post_phone']=='postPhone' ) {
          		if(isset($this->request->data['User']['phone_no']) && $this->request->data['User']['phone_no']!=''){
                        $usr['User']['phone_no'] = $this->request->data['User']['phone_no'];
                        $usr['User']['id'] = $userid;
                        $this->User->save($usr);
                        $this->Session->setFlash(__('Mobile Number updated successfully.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
				   // return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));    
                    } else {
                         $this->Session->setFlash(__('Please provide Mobile Number.'));
                         return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  		//return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }
          } 
          
          if ($this->request->is(array('post', 'put')) && isset($this->request->data['post_paypal']) && $this->request->data['post_paypal']=='postPaypal' ) {
          		if(isset($this->request->data['User']['paypal_email']) && $this->request->data['User']['paypal_email']!=''){
                        $usr['User']['paypal_email'] = $this->request->data['User']['paypal_email'];
                        $usr['User']['id'] = $userid;
                        $this->User->save($usr);
                        $this->Session->setFlash(__('Paypal Email updated successfully.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
				    //return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));    
                    } else {
                         $this->Session->setFlash(__('Please provide Paypal Email.'));
                         return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  		//return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }
          }   
          
          if ($this->request->is(array('post', 'put')) && isset($this->request->data['post_billing']) && $this->request->data['post_billing']=='postBilling' ) {
          		if(!isset($this->request->data['BillingAddress']['street_address']) || empty($this->request->data['BillingAddress']['street_address'])){
                        $this->Session->setFlash(__('Please provide street address.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  	    //return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    } 
                    elseif(!isset($this->request->data['BillingAddress']['city']) || empty($this->request->data['BillingAddress']['city'])){
                        $this->Session->setFlash(__('Please provide city.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  	    //return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }
                    elseif(!isset($this->request->data['BillingAddress']['state']) || empty($this->request->data['BillingAddress']['state'])){
                        $this->Session->setFlash(__('Please provide state.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  	   // return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }
                    elseif(!isset($this->request->data['BillingAddress']['country']) || empty($this->request->data['BillingAddress']['country'])){
                        $this->Session->setFlash(__('Please provide country.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  	   // return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }
                    elseif(!isset($this->request->data['BillingAddress']['zip_code']) || empty($this->request->data['BillingAddress']['zip_code'])){
                        $this->Session->setFlash(__('Please provide post code.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
                  	    //return $this->redirect(array('action' => 'offer/'.base64_encode($taskId)));
                    }else {
                        $this->request->data['BillingAddress']['user_id'] = $userid;
                        $this->request->data['BillingAddress']['date'] = date('Y-m-d H:i:s');
                        $this->BillingAddress->create();
                        $this->BillingAddress->save($this->request->data);
                        $this->Session->setFlash(__('Billing Address updated successfully.'));
                        return $this->redirect('/errands/offer/'.base64_encode($taskId));
				    //return $this->redirect(array('action' => 'offer/'.base64_encode($taskId))); 
                    }
          }       
          $this->set(compact('userid','taskId','user','baddress', 'proposalEdit'));
	}
	////////////////////03-02/////////////////////////////
	public function admin_export()
	{
		$userid = $this->Session->read('adminuserid');
		$is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
		$options = array('Task.status !=' => 0);
		$tasks = $this->Task->find('all',array('conditions' => $options));
		$output = '';
		$output .='Title, Category Name, Posted By, Total Rate, Posted On, Ending Date, Task Status';
		$output .="\n";
//pr($cats);exit;
		if(!empty($tasks))
		{
			foreach($tasks as $task)
			{	
				$status = ($task['Task']['task_status']=='O')?'Open':($task['Task']['task_status']=='A'?'Accepted':'Complete');
				$pdate = date('M-d-Y',strtotime($task['Task']['post_date']));
				$edate = date('M-d-Y',strtotime($task['Task']['post_date']));
				$output .='"'.$task['Task']['title'].'","'.$task['Category']['name'].'","'.$task['User']['first_name'].' '.$task['User']['last_name'].'","$'.$task['Task']['total_rate'].'","'.$pdate.'","'.$edate.'","'.$status.'"';
				$output .="\n";
			}
		}
		$filename = "tasks".time().".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}
	////////////////////////////////////////AK End//////////////////////////////////////

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($page_name = null) {
            
            if(isset($page_name) && $page_name!=''){
                    $options = array('conditions' => array('Content.page_name' => $page_name));
                    $content = $this->Content->find('first', $options);
                    if($content){
                            $title_for_layout = $content['Content']['page_heading'];
                            $this->set(compact('title_for_layout','content'));
                    }
            } else {
                    throw new NotFoundException(__('Invalid Content'));
            }
	}

/**
 * START BY KARUNADRI GHOSH
 
 */
/**
 * add/edit method
 *
 * @return void
 */
	
public function admin_add($id=null) {
		
                $userid = $this->Session->read('adminuserid');
                $is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
                $referrer   = $_SERVER['HTTP_REFERER'];
                $referrer_session = $this->Session->read('referrer');
                if($referrer_session==''){
                    $this->Session->write('referrer', $referrer);
                }
            
		$title_for_layout = 'Task Add';
                
                $this->loadModel('Category');
                $categories=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>0)));
                
		if ($this->request->is(array('post', 'put'))) {
                if($this->request->data['Task']['due_date_type']==2)
                {
                    $this->request->data['Task']['due_date']=date('Y-m-d',strtotime('+7 day'));
                }
                elseif ($this->request->data['Task']['due_date_type']==1) 
                {
                    $this->request->data['Task']['due_date']=date('Y-m-d');
                }
                //pr($this->request->data);exit;
                
                $location = $this->request->data['Task']['task_location'];
                $prepAddr = str_replace(' ','+',$location);
                $url=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=true');
                $output= json_decode($url);
                $lat = $output->results[0]->geometry->location->lat;
                $lang= $output->results[0]->geometry->location->lng;
                $this->request->data['Task']['lat']=$lat;
                $this->request->data['Task']['lang']=$lang;
                if(empty($this->request->data['Task']['total_rate']))
                {
                    $this->request->data['Task']['total_rate']=$this->request->data['Task']['per_hour_rate']*$this->request->data['Task']['hour'];
                }
                if(empty($this->request->data['Task']['id']))
                {
                  $this->request->data['Task']['post_date']=date("Y-m-d");  
                  $this->request->data['Task']['user_id']=$userid;
                }

			     
			      $this->Task->create();
                            if ($this->Task->save($this->request->data)) {
                            
                                
		     			 
                                if(isset($id))
                                {
                                    $task_id=$id;
                                }
                                else{
                                    $task_id=$this->Task->getLastInsertId();;
                                }
                                   
                                if(isset($_REQUEST['task_image']) and !empty($_REQUEST['task_image']))
                                {
                                
                                for($i=0;$i<count($_REQUEST['task_image']);$i++)
                                {
                                  
                                   $data['TaskImage']['id']= $_REQUEST['task_image_id'][$i];
                                   $data['TaskImage']['task_id']= $task_id;
                                   $data['TaskImage']['image_name']= $_REQUEST['task_image'][$i];
                                   
                                   $this->TaskImage->create();                                
                                   $this->TaskImage->save($data);                                
                                           
                                }
                                }
                                    
                                
				$this->Session->setFlash('The errand has been saved.','default',array('class'=>'success'));
                                //return $this->redirect(array('action' => 'list'));
				//return $this->redirect(array('action' => 'add/'.$id));
                                $referrer_link= $this->Session->read('referrer');
                                if($referrer_link!=''){
                                    $this->Session->delete('referrer');
                                    return $this->redirect($referrer_link);
                                }else{
                                    return $this->redirect(array('action' => 'add/'.$id));
                                }
				} else {
					$this->Session->setFlash(__('The errand could not be saved. Please, try again.'));
				}
			
		}
                else 
                {
                    
                    if(isset($id) and !empty($id))
                    {
                       $this->request->data=$this->Task->find("first",array('conditions'=>array('Task.id'=>$id)));
                       
                       //pr($this->request->data);exit;
                       

                    } 
                    
                }
		
               
              
	       $this->set(compact('title','categories'));
	}
        /**
 * Listing method
 *
 * @return void
 */
  
	    public function admin_approve($id=null){
	    		$task=$this->Task->find("first",array('conditions'=>array('Task.id'=>$id)));
	    		$tsk['Task']['id']=$task['Task']['id'];
	    		$tsk['Task']['status']=3;
	    		if($this->Task->save($tsk))
               {
		          $this->loadModel('Notification');
		          $noti['Notification']['for_user_id'] = 0;
				$noti['Notification']['by_user_id'] = $task['Task']['user_id'];
				$noti['Notification']['task_id'] = $task['Task']['id'];
				$noti['Notification']['date'] = date('Y-m-d H:i:s');;
				$noti['Notification']['type'] = 'has posted new task';
				$this->Notification->create();
				$this->Notification->save($noti); 
				$this->Session->setFlash('The errand has been approved.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'list'));
			}
			else{
				$this->Session->setFlash('The errand could not be approved. Please try again.','default',array('class'=>'success'));
				return $this->redirect(array('action' => 'list'));
			}
			
	    }
    public function admin_list() {	
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
        $this->loadModel('Category');
        $title_for_layout = 'Tasks List';
        $categories=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>0)));
        $this->Task->recursive = 0;
        $conditions['Task.status = ']=2;
        $conditions['AND']['Task.task_status = ']='O';
        if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;
            foreach($this->data['Filter'] as $name => $value){
                if($value){
                    $filter_url[$name] = urlencode($value);
                }
            }	
            return $this->redirect($filter_url);
        } else {
            $limit = 20;
            foreach($this->params['named'] as $param_name => $value){
                if(!in_array($param_name, array('page','sort','direction','limit'))){
                    if($param_name=='title')
                    {
                        $conditions['OR']['Task.title LIKE'] = urldecode('%'.$value).'%';
                        $conditions['OR']['Task.description LIKE'] = urldecode('%'.$value).'%';
                    }elseif (!empty ($this->params['named']['end_date_start']) and !empty ($this->params['named']['end_date_end'])) {
                        $start_date=  $this->params['named']['end_date_start'];
                        $end_date=  $this->params['named']['end_date_end'];
                        $conditions['AND']['Task.due_date >= ']=$start_date;
                        $conditions['AND']['Task.due_date <= ']=$end_date;
                    }elseif($param_name=='task_status'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='completed'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='category_id'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='rows'){
                        $limit = urldecode($value);
                    }else{
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }
                    $this->request->data['Filter'][$param_name] = urldecode($value);
                }
            }
        }

        $this->Paginator->settings=array(
        'conditions'=> $conditions,
        'limit'=>$limit,
        'order'=>'Task.id desc'   
        );
        $tasks=$this->Paginator->paginate('Task');
        $total_task=$this->Task->find("count",array('conditions'=>$conditions));
        $this->set(compact('title_for_layout','tasks','categories','total_task'));
    }
    
    public function admin_list_assign() {	
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
        $this->loadModel('Category');
        $title_for_layout = 'Tasks List';
        $categories=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>0)));
        $this->Task->recursive = 0;
        $conditions['Task.status = ']=2;
        $conditions['AND']['Task.task_status = ']='A';
        if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;
            foreach($this->data['Filter'] as $name => $value){
                if($value){
                    $filter_url[$name] = urlencode($value);
                }
            }	
            return $this->redirect($filter_url);
        } else {
            $limit = 20;
            foreach($this->params['named'] as $param_name => $value){
                if(!in_array($param_name, array('page','sort','direction','limit'))){
                    if($param_name=='title')
                    {
                        $conditions['OR']['Task.title LIKE'] = urldecode('%'.$value).'%';
                        $conditions['OR']['Task.description LIKE'] = urldecode('%'.$value).'%';
                    }elseif (!empty ($this->params['named']['end_date_start']) and !empty ($this->params['named']['end_date_end'])) {
                        $start_date=  $this->params['named']['end_date_start'];
                        $end_date=  $this->params['named']['end_date_end'];
                        $conditions['AND']['Task.due_date >= ']=$start_date;
                        $conditions['AND']['Task.due_date <= ']=$end_date;
                    }elseif($param_name=='task_status'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='completed'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='category_id'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='rows'){
                        $limit = urldecode($value);
                    }else{
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }
                    $this->request->data['Filter'][$param_name] = urldecode($value);
                }
            }
        }

        $this->Paginator->settings=array(
        'conditions'=> $conditions,
        'limit'=>$limit,
        'order'=>'Task.id desc'   
        );
        $tasks=$this->Paginator->paginate('Task');
        $total_task=$this->Task->find("count",array('conditions'=>$conditions));
        $this->set(compact('title_for_layout','tasks','categories','total_task'));
    }
    
    public function admin_list_complete() {	
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
        $this->loadModel('Category');
        $title_for_layout = 'Tasks List';
        $categories=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>0)));
        $this->Task->recursive = 0;
        $conditions['Task.task_status = ']='C';
        //$conditions['Task.status = ']=2;
        //$conditions['AND']['Task.task_status = ']='C';
        if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;
            foreach($this->data['Filter'] as $name => $value){
                if($value){
                    $filter_url[$name] = urlencode($value);
                }
            }	
            return $this->redirect($filter_url);
        } else {
            $limit = 20;
            foreach($this->params['named'] as $param_name => $value){
                if(!in_array($param_name, array('page','sort','direction','limit'))){
                    if($param_name=='title')
                    {
                        $conditions['OR']['Task.title LIKE'] = urldecode('%'.$value).'%';
                        $conditions['OR']['Task.description LIKE'] = urldecode('%'.$value).'%';
                    }elseif (!empty ($this->params['named']['end_date_start']) and !empty ($this->params['named']['end_date_end'])) {
                        $start_date=  $this->params['named']['end_date_start'];
                        $end_date=  $this->params['named']['end_date_end'];
                        $conditions['AND']['Task.due_date >= ']=$start_date;
                        $conditions['AND']['Task.due_date <= ']=$end_date;
                    }elseif($param_name=='task_status'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='completed'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='category_id'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='rows'){
                        $limit = urldecode($value);
                    }else{
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }
                    $this->request->data['Filter'][$param_name] = urldecode($value);
                }
            }
        }

        $this->Paginator->settings=array(
        'conditions'=> $conditions,
        'limit'=>$limit,
        'order'=>'Task.id desc'   
        );
        $tasks=$this->Paginator->paginate('Task');
        $total_task=$this->Task->find("count",array('conditions'=>$conditions));
        $this->set(compact('title_for_layout','tasks','categories','total_task'));
    }
    
    
    public function admin_list_draft() {	
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
        $this->loadModel('Category');
        $title_for_layout = 'Tasks List';
        $categories=$this->Category->find('all',array('conditions'=>array('Category.parent_id'=>0)));
        $this->Task->recursive = 0;
        $conditions['Task.status = ']=0;
        $conditions['AND']['Task.task_status = ']='O';
        if(($this->request->is('post') || $this->request->is('put')) && isset($this->data['Filter'])){
            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;
            foreach($this->data['Filter'] as $name => $value){
                if($value){
                    $filter_url[$name] = urlencode($value);
                }
            }	
            return $this->redirect($filter_url);
        } else {
            $limit = 20;
            foreach($this->params['named'] as $param_name => $value){
                if(!in_array($param_name, array('page','sort','direction','limit'))){
                    if($param_name=='title')
                    {
                        $conditions['OR']['Task.title LIKE'] = urldecode('%'.$value).'%';
                        $conditions['OR']['Task.description LIKE'] = urldecode('%'.$value).'%';
                    }elseif (!empty ($this->params['named']['end_date_start']) and !empty ($this->params['named']['end_date_end'])) {
                        $start_date=  $this->params['named']['end_date_start'];
                        $end_date=  $this->params['named']['end_date_end'];
                        $conditions['AND']['Task.due_date >= ']=$start_date;
                        $conditions['AND']['Task.due_date <= ']=$end_date;
                    }elseif($param_name=='task_status'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='completed'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='category_id'){
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }elseif($param_name=='rows'){
                        $limit = urldecode($value);
                    }else{
                        $conditions['AND']['Task.'.$param_name] = urldecode($value);
                    }
                    $this->request->data['Filter'][$param_name] = urldecode($value);
                }
            }
        }

        $this->Paginator->settings=array(
        'conditions'=> $conditions,
        'limit'=>$limit,
        'order'=>'Task.id desc'   
        );
        $tasks=$this->Paginator->paginate('Task');
        $total_task=$this->Task->find("count",array('conditions'=>$conditions));
        $this->set(compact('title_for_layout','tasks','categories','total_task'));
    }
    
    public function admin_draft_mail_send() {
            
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if(!isset($is_admin) && $is_admin==''){
           $this->redirect('/admin');
        }
        App::uses('CakeEmail', 'Network/Email');
        $Email = new CakeEmail();
        $this->loadModel('EmailTemplate');
        $this->loadModel('SiteSetting');
        $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
        if($contact_email){
                $adminEmail = $contact_email['SiteSetting']['contact_email'];
                $adminSiteName = $contact_email['SiteSetting']['site_name'];
        } else {
                $adminEmail = 'superadmin@abc.com';
                $adminSiteName='';
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $TaskIdArr=$this->request->data['TaskIdArr'];
            
            if(count($TaskIdArr)>0){
                foreach($TaskIdArr as $val){
                    if($val!=''){
                        $options = array('conditions' => array('Task.' . $this->Task->primaryKey => $val));
                        $task = $this->Task->find('first', $options);
                        
                        $username=$task['User']['first_name'].' '.$task['User']['last_name'];
                        $useremail=$task['User']['email'];
                        $TaskTitle=$task['Task']['title'];
                        $TaskLocation=$task['Task']['task_location'];
                        
                        $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>10)));
                        $mail_body =str_replace(array('[USER]','[TASKNAME]','[TASKLOCATION]'),array($username,$TaskTitle,$TaskLocation),$EmailTemplate['EmailTemplate']['content']);
                       
                        /* pass user input to function 
                        $Email->emailFormat('both');
                        $Email->from(array($adminEmail => $adminSiteName));
                        $Email->to($useremail);
                        $Email->subject($EmailTemplate['EmailTemplate']['subject']);
                        $Email->send($mail_body);*/
                        
                        $from=$adminSiteName.' <'.$adminEmail.'>';
                        $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
                        $this->php_mail($useremail,$from,$Subject_mail,$mail_body);
                    }
                } 
                //exit;
                $this->Session->setFlash('The mail has been send.','default',array('class'=>'success'));
                return $this->redirect(array('action' => 'list_draft'));
            }else{
                return $this->redirect(array('action' => 'list_draft'));
            }
        }else{
            return $this->redirect(array('action' => 'list_draft'));
        }
        
    }    
    
    public function report_task() {
        $this->loadModel('User');
        $this->loadModel('SiteSetting');
        $userid = $this->Session->read('userid');
        if(!isset($userid)){
            $this->redirect('/users/login');
            $this->Session->setFlash('Please login first.','default',array('class'=>'error'));
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $User_Data = $this->User->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
            $report_task_name=$this->request->data['report_task_name'];
            $report_subject = $this->request->data['report_subject'];
            $report_message= $this->request->data['report_message'];
            $report_task_id= $this->request->data['report_task_id'];
            
            $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
            if($contact_email){
                    $adminEmail = $contact_email['SiteSetting']['contact_email'];
                    $SiteName = $contact_email['SiteSetting']['site_name'];
                    
            } else {
                    $adminEmail = 'superadmin@abc.com';
                    $SiteName = 'Errand Champion';
            }
            
            $UserName=$User_Data['User']['first_name'].' '.$User_Data['User']['last_name'];
            $UserEmail=$User_Data['User']['email'];
            //$msg_body = "Hi Admin, <br/><br/>Task Name: <b>".$report_task_name."</b>.<br/><br/>".$report_message." <br/><br/>Thanks,<br/>".$UserName."<br/>".$SiteName;
            
            $this->loadModel('EmailTemplate');
            $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>13)));
            $msg_body =str_replace(array('[ERRANDNAME]','[MESSAGE]'),array($report_task_name,$report_message),$EmailTemplate['EmailTemplate']['content']);

             /*App::uses('CakeEmail', 'Network/Email');

            $Email = new CakeEmail();

            pass user input to function 
            $Email->emailFormat('both');
            $Email->from(array($UserEmail => $UserName));
            $Email->to($adminEmail);
            $Email->subject($report_subject);
            $Email->send($msg_body);*/
            
            $from=$UserName.' <'.$UserEmail.'>';
            //$Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
            $this->php_mail($adminEmail,$from,$report_subject,$msg_body);
            
            $this->Session->setFlash(__('Your message send successfully.'));
            return $this->redirect('/errands/detail/'.$report_task_id);
            //return $this->redirect(array('action' => 'detail/'.$report_task_id));
        }
    } 
        
  /**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */      
        public function admin_view($id = null) {
            
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
			
            $title_for_layout = 'Task View';
            if (!$this->Task->exists($id)) {
                    throw new NotFoundException(__('Invalid Task'));
            }
            $options = array('conditions' => array('Task.' . $this->Task->primaryKey => $id));
            $task = $this->Task->find('first', $options);

            //pr($task);exit;

            $this->set(compact('title_for_layout','task'));
	}
        
        public function offer_details_list($id = null) {
            $this->loadModel('Proposal');
            $options = array('conditions' => array('Proposal.task_id' => $id),'order'=>array('Proposal.date'=>'DESC'));
            $proposals = $this->Proposal->find('all', $options);
            if(count($proposals)>0){
                return $proposals;
            }else{
                return null;
            }
	}
        /**
 * Delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     
        
        public function admin_delete($id = null) {
                $userid = $this->Session->read('adminuserid');
                $is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
                $this->loadModel('Notification');
                $this->loadModel('TaskImage');
                $this->loadModel('TaskComment');
                $this->loadModel('SentMessage');
                $this->loadModel('InboxMessages');
                $this->loadModel('Proposal');
                $this->loadModel('PaymentHistory');
                $this->loadModel('Job');
                $this->loadModel('Contact');
		$this->Task->id = $id;
		if (!$this->Task->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Task->delete()) {
                    $this->Notification->deleteAll(array('Notification.task_id' => $id), false);
                    $this->TaskImage->deleteAll(array('TaskImage.task_id' => $id), false);
                    $this->TaskComment->deleteAll(array('TaskComment.task_id' => $id), false);
                    $this->SentMessage->deleteAll(array('SentMessage.task_id' => $id), false);
                    $this->InboxMessages->deleteAll(array('InboxMessages.task_id' => $id), false);
                    $this->Proposal->deleteAll(array('Proposal.task_id' => $id), false);
                    $this->PaymentHistory->deleteAll(array('PaymentHistory.task_id' => $id), false);
                    $this->Job->deleteAll(array('Job.task_id' => $id), false);
                    $this->Contact->deleteAll(array('Contact.task_id' => $id), false);
                    $this->Session->setFlash(__('The errand has been deleted.'));
		} else {
			$this->Session->setFlash(__('The errand could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'list'));
                
	}
          /**
 * Review method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     
  public function admin_checkreview($task_id=null) 
        {
         $this->loadModel("Comment");
         $reviews=$this->Comment->find("all",array('conditions'=>array("Comment.task_id"=>$task_id)));
         $total_review=$this->Comment->find("count",array('conditions'=>array('Comment.task_id'=>$task_id)));
         $total_score_arr=$this->Comment->find("first",array("fields"=>array("SUM(Comment.score) as `net_score` "),"conditions"=>array("Comment.task_id"=>$task_id)));
         $total_score=$total_score_arr[0]["net_score"];
         
         if($total_review>0)
         {
          $avg_score=ceil($total_score/$total_review);  
         }
         else{
         $avg_score=0;         
                
         }
         
         
         $this->set(compact('reviews','avg_score','task_id'));
         
         
        }
	public function admin_exportreview($task_id=null){
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
			$this->loadModel('Comment');
			$reviews=$this->Comment->find("all",array('conditions'=>array("Comment.task_id"=>$task_id)));
			
			$output = '';
			$output .='Name, Comment, Date';
			$output .="\n";

			if(!empty($reviews))
			{
				foreach($reviews as $review)
				{	
				   
					$output .='"'.$review['User']['first_name'].' '.$review['User']['last_name'].'","'.$review['Comment']['review'].'","'.$review['Comment']['create_time'].'"';
					$output .="\n";
				}
			}
			$filename = "reviews".time().".csv";
			header('Content-type: application/csv');
			header('Content-Disposition: attachment; filename='.$filename);
			echo $output;
			exit;
		}
         /**
 * Delete Photo From Database
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     
        
        function admin_delimg($id=null)
        {
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
         $this->TaskImage->delete($id);
         exit;   
        }
/**
 * MAP VIEW
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */     
        public function admin_mapview() {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
                
                $tasks=$this->Task->find("all");
                //pr($tasks);exit;
                $this->set(compact('tasks'));
                
        }
	/**
 * END BY KARUNADRI GHOSH
 
 */
 
    public function countall($id = null){
 	$this->loadModel('Proposal');
 	$this->loadModel('TaskComment');
 	$count=array();
 	$count['offers']=$this->Proposal->find("count",array('conditions'=>array("Proposal.task_id"=>$id)));	
 	$count['comment']=$this->TaskComment->find("count",array('conditions'=>array("TaskComment.task_id"=>$id)));
 	return $count;
    }
    
        ///////////////////////// App Function suman ///////////////////////////////////////
    
        // http://errandchampion.com/tasks/app_all_post/page:1?search=errand_search&Keywords=test task name&TaskStatus=C&EndDate=2016-03-31&MinPrice=3&MaxPrice=100&task_location=Kolkata, West Bengal, India&Category=25&WorkType=2&sort_by=title&direction=asc
        
        public function app_all_post(){
            $this->autoRender = false;
            //$this->User->recursive = 0;
            $data = array();
            $sort_by=isset($_REQUEST['sort_by'])?$_REQUEST['sort_by']:'id';
            $direction=isset($_REQUEST['direction'])?$_REQUEST['direction']:'desc';
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            $TodayDate=date('Y-m-d');
            if (isset($_REQUEST['search']) && $_REQUEST['search']=='errand_search' ) {
                $Keywords=isset($_REQUEST['Keywords'])?$_REQUEST['Keywords']:'';
                $TaskStatus=isset($_REQUEST['TaskStatus'])?$_REQUEST['TaskStatus']:'';
                $EndDate=isset($_REQUEST['EndDate'])?$_REQUEST['EndDate']:'';
                $MinPrice=isset($_REQUEST['MinPrice'])?$_REQUEST['MinPrice']:'';
                $MaxPrice=isset($_REQUEST['MaxPrice'])?$_REQUEST['MaxPrice']:'';
                $task_location=isset($_REQUEST['task_location'])?$_REQUEST['task_location']:'';
                $Category=isset($_REQUEST['Category'])?$_REQUEST['Category']:'';
                $ParentCatID=isset($_REQUEST['ParentCatID'])?base64_decode($_REQUEST['ParentCatID']):'';
                $WorkType=isset($_REQUEST['WorkType'])?$_REQUEST['WorkType']:'';
                
                $QueryStr="(Task.status='2')";
                if($ParentCatID!=''){
                    $QueryStr.=" AND (Task.pcat_id = '".$ParentCatID."')";
                }
                if($Keywords!=''){
                    $QueryStr.=" AND (Task.title LIKE '%".$Keywords."%')";
                }
                if($WorkType!=''){
                    $QueryStr.=" AND (Task.completed = '".$WorkType."')";
                }
                if($TaskStatus!=''){
                    $QueryStr.=" AND (Task.task_status = '".$TaskStatus."')";
                }else{
                    $QueryStr.=" AND (Task.task_status = 'O')";
                }
                if($EndDate!=''){
                    $QueryStr.=" AND (Task.due_date = '".$EndDate."')";
                }else{
                    $QueryStr.=" AND (Task.due_date >= '".$TodayDate."')";
                }
                if($MinPrice!='0' && $MaxPrice!='0' && $MinPrice!='' && $MaxPrice!=''){
                    $QueryStr.=" AND (Task.total_rate >= ".$MinPrice." AND Task.total_rate <= ".$MaxPrice.")";
                }
                  if($Category!=''){
                    $QueryStr.=" AND Task.category_id='".$Category."'";
                }
                if($task_location!=''){
                    $QueryStr.=" AND Task.task_location='".$task_location."'";
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('Task.'.$sort_by => $direction), 'limit' => 10);
            }else{
                $options = array('conditions' => array('Task.status' => 2, 'Task.task_status' => 'O', 'Task.due_date >=' => $TodayDate), 'order' => array('Task.'.$sort_by => $direction), 'limit' => 10);
            }
            $TaskListCnt=$this->Task->find('count', $options);
            
            //return $TotalErrCnt=$this->Paginator->counter(array('format' => __('{:count}')));
            
            //return $page;
            //$TaskList=$this->Task->find('count', $options);
            
            if ($TaskListCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Errands found';
            }elseif($TaskListCnt>=$page*10 || $TaskListCnt>($page-1)*10){
                $this->Paginator->settings = $options;
                $TaskList=$this->Paginator->paginate('Task');
                foreach($TaskList as $val){
                    $UserProfile_img=isset($val['User']['profile_img'])?$val['User']['profile_img']:'';
                    $uploadImgPath = WWW_ROOT.'user_images';
                    if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                        $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                    }else{
                        $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                    }
                    if($val['Task']['task_status']=='A'){
                        $TaskStatus='Assigned';
                    }elseif($val['Task']['task_status']=='C'){
                        $TaskStatus='Complete';
                    }elseif($val['Task']['task_status']=='D'){
                        $TaskStatus='Draft';
                    }else{
                        $TaskStatus='Open';
                    }
                    
                    $countAll = $this->countall($val['Task']['id']);  
                    
                    $post_detail['id']=$val['Task']['id'];
                    $post_detail['Profile_img']=$UserProfile_imgLink;
                    $post_detail['task_name']=$val['Task']['title'];
                    $post_detail['task_location']=$val['Task']['task_location'];
                    $post_detail['comment_cnt']=$countAll['comment'];
                    $post_detail['offers_cnt']=$countAll['offers'];
                    $post_detail['is_login']=($val['User']['is_login']==1)?'Online':'Offline';
                    $post_detail['workers']=$val['Task']['workers'];
                    $post_detail['total_rate']=$val['Task']['total_rate'];
                    $post_detail['task_status']=$val['Task']['task_status'];
                    $post_detail['task_lat']=$val['Task']['lat'];
                    $post_detail['task_lang']=$val['Task']['lang'];
                    $post_detail['task_status_name']=$TaskStatus;
                    $data['TaskList'][]=$post_detail;
                }
                $data['Ack'] = 1;
                //$data['TaskList']=$user_detail;
                //$data['msg'] = 'Profile Updated Successfully';	
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/app_add_post?userID=25&title=test task name&category_id=3&description=some text&completed=1&task_location=Kolkata, West Bengal, India&due_date=2016-03-31&workers=20&budget_type=1&total_rate=100&per_hour_rate=10&hour=5
        
        public function app_add_post(){
            $this->autoRender = false;
            //$this->User->recursive = 0;
            $data1 = array();
            $this->loadModel('User');
            $this->loadModel('Category');
            $this->loadModel('SiteSetting');
            $this->loadModel('EmailTemplate');
            $TodayDate=date('Y-m-d');
            
            $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
            $title=isset($_REQUEST['title'])?$_REQUEST['title']:'';
            $category_id=isset($_REQUEST['category_id'])?$_REQUEST['category_id']:'';
            $description=isset($_REQUEST['description'])?$_REQUEST['description']:'';
            $completed=isset($_REQUEST['completed'])?$_REQUEST['completed']:'';
            $task_location=isset($_REQUEST['task_location'])?$_REQUEST['task_location']:'';
            $due_date=isset($_REQUEST['due_date'])?$_REQUEST['due_date']:'';
            $workers=isset($_REQUEST['workers'])?$_REQUEST['workers']:'';
            $budget_type=isset($_REQUEST['budget_type'])?$_REQUEST['budget_type']:'';
            $total_rate=isset($_REQUEST['total_rate'])?$_REQUEST['total_rate']:'';
            $per_hour_rate=isset($_REQUEST['per_hour_rate'])?$_REQUEST['per_hour_rate']:'';
            $hour=isset($_REQUEST['hour'])?$_REQUEST['hour']:'';
            
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userID));
            $userdetails=$this->User->find('first', $options);
            
            $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
            if($contact_email){
                $adminEmail = $contact_email['SiteSetting']['contact_email'];
                $adminSiteName = $contact_email['SiteSetting']['site_name'];
            } else {
                $adminEmail = 'superadmin@abc.com';
                $adminSiteName='';
            }
            
            if($userdetails['User']['user_type']==1 || $userdetails['User']['user_type']==3){
                
                $optionsCat = array('conditions' => array('Category.id' => $category_id));
                $category_data = $this->Category->find('first', $optionsCat); 

                $prepAddr = str_replace(' ','+',$task_location);
                $url=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=true');
                $output= json_decode($url);
                $lat = $output->results[0]->geometry->location->lat;
                $lang= $output->results[0]->geometry->location->lng;

                $data['Task']['user_id']=$userID;
                $data['Task']['title']=$title;
                $data['Task']['description']=$description;
                $data['Task']['category_id']=$category_id;
                $data['Task']['pcat_id']=$category_data['Category']['parent_id'];
                $data['Task']['task_location']=$task_location;
                $data['Task']['lat']=$lat;
                $data['Task']['lang']=$lang;
                $data['Task']['completed']=$completed;
                $data['Task']['due_date']=$due_date;
                $data['Task']['workers']=$workers;
                $data['Task']['budget_type']=$budget_type;
                $data['Task']['status']=2;
                $data['Task']['post_date']=date('Y-m-d');
                if($budget_type==2){
                    $data['Task']['per_hour_rate']=$per_hour_rate;
                    $data['Task']['hour']=$hour;
                    $data['Task']['total_rate']=$per_hour_rate*$hour;
                }else{
                    $data['Task']['total_rate']=$total_rate;
                }

                $this->Task->create();
                if ($this->Task->save($data)) {
                    $task_id = $this->Task->getLastInsertId();
                    $tsk=$this->Task->find('first',array('conditions'=>array('Task.id'=>$task_id)));
                    $this->loadModel('Notification');
                    $noti['Notification']['for_user_id'] = 0;
                    $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                    $noti['Notification']['task_id'] = $tsk['Task']['id'];
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');;
                    $noti['Notification']['type'] = 'has posted new task';
                    $this->Notification->create();
                    $this->Notification->save($noti);

                    // customer mail send for new task
                    $task_Name=$tsk['Task']['title'];
                    $task_location=$tsk['Task']['task_location'];
                    $taskByUserName=$tsk['User']['first_name'].' '.$tsk['User']['last_name'];
                    if($task_location!=''){
                        $TaskLocUser=$this->User->find('all',array('conditions'=>array('User.location'=>$task_location, 'User.id !='=>$userID, 'OR'=>array('User.user_type'=>2,'User.user_type'=>3))));
                    }else{
                        $TaskLocUser=array();
                    }
                    if(count($TaskLocUser)>0){
                        foreach($TaskLocUser as $UserVal){
                            $SendUserEmail=$UserVal['User']['email'];
                            $SendUserName=$UserVal['User']['first_name'].' '.$UserVal['User']['last_name'];
                            if($SendUserEmail!=''){
                                $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>11)));
                                $mail_body =str_replace(array('[USER]','[POSTBY]','[TASKNAME]','[TASKLOCATION]'),array($SendUserName,$taskByUserName,$task_Name,$task_location),$EmailTemplate['EmailTemplate']['content']);


                                $from=$adminSiteName.' <'.$adminEmail.'>';
                                $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
                                $this->php_mail($SendUserEmail,$from,$Subject_mail,$mail_body);
                            }
                        } 
                    }
                    $data1['Ack'] = 1;
                    $data1['msg']='You have successfully post your errand';
                }
            }else{
                $data1['Ack']=0;
                $data1['msg']='You can not post an errand. Please change your account setting to "Post"';
            }
            
            $result = json_encode($data1);
            return $result;
        }
        
        // http://errandchampion.com/tasks/app_edit_post?userID=25&id=1&title=test task name&category_id=3&description=some text&completed=1&task_location=Kolkata, West Bengal, India&due_date=2016-03-31&workers=20&budget_type=1&total_rate=100&per_hour_rate=10&hour=5
        public function app_edit_post(){
            $this->autoRender = false;
            //$this->User->recursive = 0;
            $data1 = array();
            $this->loadModel('User');
            $this->loadModel('Category');
            $this->loadModel('SiteSetting');
            $this->loadModel('EmailTemplate');
            $TodayDate=date('Y-m-d');
            
            $task_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
            $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
            $title=isset($_REQUEST['title'])?$_REQUEST['title']:'';
            $category_id=isset($_REQUEST['category_id'])?$_REQUEST['category_id']:'';
            $description=isset($_REQUEST['description'])?$_REQUEST['description']:'';
            $completed=isset($_REQUEST['completed'])?$_REQUEST['completed']:'';
            $task_location=isset($_REQUEST['task_location'])?$_REQUEST['task_location']:'';
            $due_date=isset($_REQUEST['due_date'])?$_REQUEST['due_date']:'';
            $workers=isset($_REQUEST['workers'])?$_REQUEST['workers']:'';
            $budget_type=isset($_REQUEST['budget_type'])?$_REQUEST['budget_type']:'';
            $total_rate=isset($_REQUEST['total_rate'])?$_REQUEST['total_rate']:'';
            $per_hour_rate=isset($_REQUEST['per_hour_rate'])?$_REQUEST['per_hour_rate']:'';
            $hour=isset($_REQUEST['hour'])?$_REQUEST['hour']:'';
            
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userID));
            $userdetails=$this->User->find('first', $options);
            
            $contact_email = $this->SiteSetting->find('first', array('conditions' => array('SiteSetting.id' => 1), 'fields' => array('SiteSetting.contact_email', 'SiteSetting.site_name')));
            if($contact_email){
                $adminEmail = $contact_email['SiteSetting']['contact_email'];
                $adminSiteName = $contact_email['SiteSetting']['site_name'];
            } else {
                $adminEmail = 'superadmin@abc.com';
                $adminSiteName='';
            }
            
            if($userdetails['User']['user_type']==1 || $userdetails['User']['user_type']==3){
                
                $optionsCat = array('conditions' => array('Category.id' => $category_id));
                $category_data = $this->Category->find('first', $optionsCat); 

                $prepAddr = str_replace(' ','+',$task_location);
                $url=file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.$prepAddr.'&sensor=true');
                $output= json_decode($url);
                $lat = $output->results[0]->geometry->location->lat;
                $lang= $output->results[0]->geometry->location->lng;
                
                $data['Task']['id']=$task_id;
                $data['Task']['user_id']=$userID;
                $data['Task']['title']=$title;
                $data['Task']['description']=$description;
                $data['Task']['category_id']=$category_id;
                $data['Task']['pcat_id']=$category_data['Category']['parent_id'];
                $data['Task']['task_location']=$task_location;
                $data['Task']['lat']=$lat;
                $data['Task']['lang']=$lang;
                $data['Task']['completed']=$completed;
                $data['Task']['due_date']=$due_date;
                $data['Task']['workers']=$workers;
                $data['Task']['budget_type']=$budget_type;
                //$data['Task']['status']=2;
                //$data['Task']['post_date']=date('Y-m-d');
                if($budget_type==2){
                    $data['Task']['per_hour_rate']=$per_hour_rate;
                    $data['Task']['hour']=$hour;
                    $data['Task']['total_rate']=$per_hour_rate*$hour;
                }else{
                    $data['Task']['total_rate']=$total_rate;
                }

                if ($this->Task->save($data)) {
                    $tsk=$this->Task->find('first',array('conditions'=>array('Task.id'=>$task_id)));
                    
                    $this->loadModel('Proposal');
                    $this->loadModel('Job');
                    $this->loadModel('Notification');
                    $pro=$this->Proposal->find('all',array('conditions'=>array('Proposal.task_id'=>$task_id)));
                    if(!empty($pro)){
                        foreach($pro as $pros){
                            
                            $noti['Notification']['for_user_id'] = $pros['Proposal']['user_id'];
                            $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                            $noti['Notification']['task_id'] = $tsk['Task']['id'];
                            $noti['Notification']['date'] = date('Y-m-d H:i:s');;
                            $noti['Notification']['type'] = 'has edited task';
                            $this->Notification->create();
                            $this->Notification->save($noti);
                        }
                    }
                    
                    // customer mail send for new task
                    $task_Name=$tsk['Task']['title'];
                    $task_location=$tsk['Task']['task_location'];
                    $taskByUserName=$tsk['User']['first_name'].' '.$tsk['User']['last_name'];
                    if($task_location!=''){
                        $TaskLocUser=$this->User->find('all',array('conditions'=>array('User.location'=>$task_location, 'User.id !='=>$userID, 'OR'=>array('User.user_type'=>2,'User.user_type'=>3))));
                    }else{
                        $TaskLocUser=array();
                    }
                    if(count($TaskLocUser)>0){
                        foreach($TaskLocUser as $UserVal){
                            $SendUserEmail=$UserVal['User']['email'];
                            $SendUserName=$UserVal['User']['first_name'].' '.$UserVal['User']['last_name'];
                            if($SendUserEmail!=''){
                                $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>11)));
                                $mail_body =str_replace(array('[USER]','[POSTBY]','[TASKNAME]','[TASKLOCATION]'),array($SendUserName,$taskByUserName,$task_Name,$task_location),$EmailTemplate['EmailTemplate']['content']);


                                $from=$adminSiteName.' <'.$adminEmail.'>';
                                $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
                                $this->php_mail($SendUserEmail,$from,$Subject_mail,$mail_body);
                            }
                        } 
                    }
                    $data1['Ack'] = 1;
                    $data1['msg']='You have successfully edit your errand';
                }
            }else{
                $data1['Ack']=0;
                $data1['msg']='You can not post an errand. Please change your account setting to "Post"';
            }
            
            $result = json_encode($data1);
            return $result;
        }
        
        // http://errandchampion.com/tasks/app_delete_post?userID=25&id=10
        public function app_delete_post(){
            $this->autoRender = false;
            $data = array();
            $this->loadModel('Notification');
            $this->loadModel('TaskImage');
            $this->loadModel('TaskComment');
            $this->loadModel('SentMessage');
            $this->loadModel('InboxMessages');
            $this->loadModel('Proposal');
            $this->loadModel('PaymentHistory');
            $this->loadModel('Job');
            $this->loadModel('Contact');
            
            $task_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
            $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
            
            $this->Task->id = $task_id;
            if (!$this->Task->exists()) {
                $data['Ack']=0;
                $data['msg']='Invalid errand';
            }
            if ($this->Task->delete()) {
                $this->Notification->deleteAll(array('Notification.task_id' => $task_id), false);
                $this->TaskImage->deleteAll(array('TaskImage.task_id' => $task_id), false);
                $this->TaskComment->deleteAll(array('TaskComment.task_id' => $task_id), false);
                $this->SentMessage->deleteAll(array('SentMessage.task_id' => $task_id), false);
                $this->InboxMessages->deleteAll(array('InboxMessages.task_id' => $task_id), false);
                $this->Proposal->deleteAll(array('Proposal.task_id' => $task_id), false);
                $this->PaymentHistory->deleteAll(array('PaymentHistory.task_id' => $task_id), false);
                $this->Job->deleteAll(array('Job.task_id' => $task_id), false);
                $this->Contact->deleteAll(array('Contact.task_id' => $task_id), false);
                $data['Ack']=1;
                $data['msg']='The errand has been deleted';
            }else{
                $data['Ack']=0;
                $data['msg']='The errand could not be deleted. Please, try again.';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/app_my_task/page:1?userID=25&type=A
        public function app_my_task($type=null) {
            
            $this->autoRender = false;
            //$this->User->recursive = 0;
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $type=isset($_REQUEST['type'])?$_REQUEST['type']:'';
            $sort_by=isset($_REQUEST['sort_by'])?$_REQUEST['sort_by']:'id';
            $direction=isset($_REQUEST['direction'])?$_REQUEST['direction']:'desc';
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            if($type=='C'){
                $TaskStatusType='C';
                $TaskActiveStatus='2';
                $TaskStatus=" AND (Task.task_status = 'C') AND (Task.status = '2')";
            }elseif($type=='A'){
                $TaskStatusType='A';
                $TaskActiveStatus='2';
                $TaskStatus=" AND (Task.task_status = 'A') AND (Task.status = '2')";
            }elseif($type=='D'){
                $TaskStatusType='O';
                $TaskActiveStatus='0';
                $TaskStatus=" AND (Task.task_status = 'O') AND (Task.status = '0')";
            }else{
                $TaskStatusType='O';
                $TaskActiveStatus='2';
                $TaskStatus=" AND (Task.task_status = 'O') AND (Task.status = '2')";
            }
            
            $TodayDate=date('Y-m-d');
            if (isset($_REQUEST['search']) && $_REQUEST['search']=='errand_search' ) {
                //$TaskStatus='';
                $Keywords=isset($_REQUEST['Keywords'])?$_REQUEST['Keywords']:'';
                //$TaskStatus=isset($_REQUEST['TaskStatus'])?$_REQUEST['TaskStatus']:'';
                $EndDate=isset($_REQUEST['EndDate'])?$_REQUEST['EndDate']:'';
                $Price_Max=isset($_REQUEST['Price_Max'])?$_REQUEST['Price_Max']:'';
                $Price_Min=isset($_REQUEST['Price_Min'])?$_REQUEST['Price_Min']:'';
                $task_location=isset($_REQUEST['task_location'])?$_REQUEST['task_location']:'';
                $Category=isset($_REQUEST['Category'])?$_REQUEST['Category']:'';
                $WorkType=isset($_REQUEST['WorkType'])?$_REQUEST['WorkType']:'';
                
                $QueryStr="(Task.user_id=".$userID.")".$TaskStatus;
                if($Keywords!=''){
                    $QueryStr.=" AND (Task.title LIKE '%".$Keywords."%')";
                }
                /*if($TaskStatus!=''){
                    $QueryStr.=" AND (Task.task_status = '".$TaskStatus."')";
                }*/
                if($EndDate!=''){
                    $QueryStr.=" AND (Task.due_date = '".$EndDate."')";
                }
                if($Price_Max!='' and $Price_Min!='' ){
                    $QueryStr.=" AND (Task.total_rate >= '".$Price_Min."' and Task.total_rate<='".$Price_Max."')";
                }
                if($Category!=''){
                    $QueryStr.=" AND Task.category_id='".$Category."'";
                }
                if($task_location!=''){
                    $QueryStr.=" AND Task.task_location='".$task_location."'";
                }
                if($WorkType!=''){
                    $QueryStr.=" AND (Task.completed = '".$WorkType."')";
                }
                
                $options = array('conditions' => array($QueryStr), 'order' => array('Task.'.$sort_by => $direction), 'limit' => 10);
            }else{
                $options = array('conditions' => array('Task.user_id' => $userID, 'Task.task_status' => $TaskStatusType, 'Task.status' => $TaskActiveStatus), 'order' => array('Task.'.$sort_by => $direction), 'limit' => 10);
            }
            
            $TaskListCnt=$this->Task->find('count', $options);
            //$TaskList=$this->Task->find('all', $options);
            
            if ($TaskListCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Errands found';
            }elseif($TaskListCnt>=$page*10 || $TaskListCnt>($page-1)*10){    
            //}elseif($TaskListCnt>=$page*10){
                $this->Paginator->settings = $options;
                $TaskList=$this->Paginator->paginate('Task');
                foreach($TaskList as $val){
                    $UserProfile_img=isset($val['User']['profile_img'])?$val['User']['profile_img']:'';
                    $uploadImgPath = WWW_ROOT.'user_images';
                    if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                        $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                    }else{
                        $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                    }
                    
                    $countAll = $this->countall($val['Task']['id']);  
                    if($val['Task']['task_status']=='A'){
                        $TaskStatus='Assigned';
                    }elseif($val['Task']['task_status']=='C'){
                        $TaskStatus='Complete';
                    }elseif($val['Task']['task_status']=='D'){
                        $TaskStatus='Draft';
                    }else{
                        $TaskStatus='Open';
                    }
                    
                    $post_detail['id']=$val['Task']['id'];
                    $post_detail['Profile_img']=$UserProfile_imgLink;
                    $post_detail['task_name']=$val['Task']['title'];
                    $post_detail['task_location']=$val['Task']['task_location'];
                    $post_detail['comment_cnt']=$countAll['comment'];
                    $post_detail['offers_cnt']=$countAll['offers'];
                    $post_detail['is_login']=($val['User']['is_login']==1)?'Online':'Offline';
                    $post_detail['workers']=$val['Task']['workers'];
                    $post_detail['total_rate']=$val['Task']['total_rate'];
                    $post_detail['task_status']=$val['Task']['task_status'];
                    $post_detail['task_lat']=$val['Task']['lat'];
                    $post_detail['task_lang']=$val['Task']['lang'];
                    $post_detail['task_status_name']=$TaskStatus;
                    $data['TaskList'][]=$post_detail;
                }
                
                $data['Ack'] = 1;
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/errandRunning/page:1?userID=28&type=C
        public function errandRunning() {
            $this->autoRender = false;
            $this->loadModel('Job');
            $this->loadModel('Proposal');
            
            //$this->User->recursive = 0;
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $type=isset($_REQUEST['type'])?$_REQUEST['type']:'';
            $sort_by=isset($_REQUEST['sort_by'])?$_REQUEST['sort_by']:'id';
            $direction=isset($_REQUEST['direction'])?$_REQUEST['direction']:'desc';
            // C for complete
            // B for bidon
            
            $params_named=$this->params['named'];
            if(count($params_named)>0){
                $page=isset($params_named['page'])?$params_named['page']:'0';
            }else{
                $page=0;
            }
            
            if($type=='C'){
                $TaskFStatus='1';
            }else{
                $TaskFStatus='0';
            }
            
            $TodayDate=date('Y-m-d');
            if (isset($_REQUEST['search']) && $_REQUEST['search']=='errand_search' ) {
                //$TaskStatus='';
                
                $Keywords=isset($_REQUEST['Keywords'])?$_REQUEST['Keywords']:'';
                $EndDate=isset($_REQUEST['EndDate'])?$_REQUEST['EndDate']:'';
                $Price_Max=isset($_REQUEST['Price_Max'])?$_REQUEST['Price_Max']:'';
                $Price_Min=isset($_REQUEST['Price_Min'])?$_REQUEST['Price_Min']:'';
                $task_location=isset($_REQUEST['task_location'])?$_REQUEST['task_location']:'';
                $Category=isset($_REQUEST['Category'])?$_REQUEST['Category']:'';
                $WorkType=isset($_REQUEST['WorkType'])?$_REQUEST['WorkType']:'';
                $TaskStatus=isset($_REQUEST['TaskStatus'])?$_REQUEST['TaskStatus']:'';
                
                if($type=='B'){
                    $QueryStr="(TaskUser.id=Proposal.task_id)";
                    $ConditionArr=array('Proposal.user_id' => $userID, 'Proposal.is_accepted' => 0);
                    $OrderArr=array('Proposal.'.$sort_by.' '.$direction);
                }else{
                    $QueryStr="(TaskUser.id=Job.task_id)";
                    $ConditionArr=array('Job.user_id' => $userID, 'Job.is_finished' => $TaskFStatus);
                    $OrderArr=array('Job.'.$sort_by.' '.$direction);
                }
                
                if($Keywords!=''){
                    $QueryStr.=" AND (TaskUser.title LIKE '%".$Keywords."%')";
                }
                if($TaskStatus!=''){
                    $QueryStr.=" AND (TaskUser.task_status = '".$TaskStatus."')";
                }
                if($EndDate!=''){
                    $QueryStr.=" AND (TaskUser.due_date = '".$EndDate."')";
                }
                if($Price_Max!='' and $Price_Min!='' ){
                    $QueryStr.=" AND (TaskUser.total_rate >= '".$Price_Min."' and TaskUser.total_rate<='".$Price_Max."')";
                }
                if($WorkType!=''){
                    $QueryStr.=" AND (TaskUser.completed = '".$WorkType."')";
                }
                if($Category!=''){
                    $QueryStr.=" AND TaskUser.category_id='".$Category."'";
                }
                if($task_location!=''){
                    $QueryStr.=" AND TaskUser.task_location='".$task_location."'";
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
                    //'conditions' => array('Job.user_id' => $userid, 'Job.is_finished' => $TaskFStatus),
                    'conditions' => $ConditionArr,
                    'order'=>$OrderArr, 
                    'limit' => 10			
                );
            }else{
                if($type=='B'){
                    $options = array('conditions' => array('Proposal.user_id' => $userID, 'Proposal.is_accepted' => 0), 'order' => array('Proposal.'.$sort_by => $direction), 'limit' => 10);
                }else{
                    $options = array('conditions' => array('Job.user_id' => $userID, 'Job.is_finished' => $TaskFStatus), 'order' => array('Job.'.$sort_by => $direction), 'limit' => 10);
                }
            }
            
            if($type=='B'){
                $TaskListCnt=$this->Proposal->find('count', $options);
            }else{
                $TaskListCnt=$this->Job->find('count', $options);
            }
            
            if ($TaskListCnt<1) {
                $data['Ack']=0;
                $data['msg']='No Errands found';
            }elseif($TaskListCnt>=$page*10 || $TaskListCnt>($page-1)*10){    
            //}elseif($TaskListCnt>=$page*10){
                $this->Paginator->settings = $options;
                if($type=='B'){
                    $TaskList=$this->Paginator->paginate('Proposal');
                }else{
                    $TaskList=$this->Paginator->paginate('Job');
                }
                foreach($TaskList as $val){
                    $UserProfile_img=isset($val['User']['profile_img'])?$val['User']['profile_img']:'';
                    $uploadImgPath = WWW_ROOT.'user_images';
                    if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                        $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                    }else{
                        $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                    }
                    
                    $countAll = $this->countall($val['Task']['id']);  
                    if($val['Task']['task_status']=='A'){
                        $TaskStatus='Assigned';
                    }elseif($val['Task']['task_status']=='C'){
                        $TaskStatus='Complete';
                    }elseif($val['Task']['task_status']=='D'){
                        $TaskStatus='Draft';
                    }else{
                        $TaskStatus='Open';
                    }
                    
                    $post_detail['id']=$val['Task']['id'];
                    $post_detail['Profile_img']=$UserProfile_imgLink;
                    $post_detail['task_name']=$val['Task']['title'];
                    $post_detail['task_location']=$val['Task']['task_location'];
                    $post_detail['comment_cnt']=$countAll['comment'];
                    $post_detail['offers_cnt']=$countAll['offers'];
                    $post_detail['is_login']=($val['User']['is_login']==1)?'Online':'Offline';
                    $post_detail['workers']=$val['Task']['workers'];
                    $post_detail['total_rate']=$val['Task']['total_rate'];
                    $post_detail['task_status']=$val['Task']['task_status'];
                    $post_detail['task_lat']=$val['Task']['lat'];
                    $post_detail['task_lang']=$val['Task']['lang'];
                    $post_detail['task_status_name']=$TaskStatus;
                    $data['TaskList'][]=$post_detail;
                }
                
                $data['Ack'] = 1;
            }else{
                $data['Ack'] = 0;
                $data['msg']='Error';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        
        // http://errandchampion.com/tasks/appErrandDetails?userID=25&ErrandID=243
        public function appErrandDetails() {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Proposal');
            $this->loadModel('TaskComment');
            $this->loadModel('Rating');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ErrandID=isset($_REQUEST['ErrandID'])?$_REQUEST['ErrandID']:'';
            
            $options = array('conditions' => array('Task.id' => $ErrandID));
            $task = $this->Task->find('first', $options);
            
            $cmt_options = array('conditions' => array('TaskComment.task_id' => $ErrandID,'TaskComment.parent_id' => 0),'order'=>array('TaskComment.date'=>'DESC'));
            $comments = $this->TaskComment->find('all', $cmt_options);
            
            //$options_cmt = array('conditions' => array('TaskComment.task_id' => $ErrandID),'order'=>array('TaskComment.date'=>'DESC'));
            //$comments_count = $this->TaskComment->find('all', $options_cmt);
            
            $prop_options = array('conditions' => array('Proposal.task_id' => $ErrandID),'order'=>array('Proposal.date'=>'DESC'));
            $proposals = $this->Proposal->find('all', $prop_options);
            
            $job_options = array('conditions' => array('Job.task_id' => $ErrandID));
            $job = $this->Job->find('all', $job_options);
            
            
            /*$user_options = array('conditions' => array('User.id' => $userID));
            $user = $this->User->find('first', $user_options);
            
            
            $options_proposal = array('conditions' => array('Proposal.task_id' => $id,'Proposal.user_id'=>$userID));
            $UserProposal = $this->Proposal->find('first', $options_proposal);
            
            $Ratingoptions = array('conditions' => array('Rating.task_id' => $ErrandID, 'Rating.task_by' => $userID));
            $RatingTask = $this->Rating->find('first', $Ratingoptions);*/
            $Reviewoptions = array('conditions' => array('Rating.task_id' => $ErrandID));
            $ReviewTaskList = $this->Rating->find('all', $Reviewoptions);
            
            if (empty($task)) {
                $data['Ack']=0;
                $data['msg']='No Errands found';
            }else{
                $errand_details=array();
                
                $AssignUserListArr=array();
                if(!empty($job) && count($job)>0){
                    foreach($job as $UserJobList){
                        $AsUserId=$UserJobList['Job']['user_id'];
                        array_push($AssignUserListArr,$AsUserId);
                    }
                }
                
                $data['ErrandDetails'][]=$task;
                
                if(count($comments)>0){
                    foreach($comments as $Cval){
                        $UserProfile_img=isset($Cval['User']['profile_img'])?$Cval['User']['profile_img']:'';
                        $uploadImgPath = WWW_ROOT.'user_images';
                        if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                            $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                        }else{
                            $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                        }

                        $com_detail['comment_id']=$Cval['TaskComment']['id'];
                        $com_detail['Profile_img']=$UserProfile_imgLink;
                        $com_detail['user_id']=$Cval['User']['id'];
                        $com_detail['User_name']=$Cval['User']['first_name'].' '.$Cval['User']['last_name'];
                        $com_detail['comments']=$Cval['TaskComment']['comments'];
                        $com_detail['date']=$Cval['TaskComment']['date'];
                        
                        $child_comment_msg = $this->child_comment($Cval['TaskComment']['id']);
                        if(count($child_comment_msg)>0){
                            $com_detail['SubCommentList']=array();
                            foreach($child_comment_msg as $CHVal){
                                $ChUserProfile_img=isset($CHVal['User']['profile_img'])?$CHVal['User']['profile_img']:'';
                                if($ChUserProfile_img!='' && file_exists($uploadImgPath . '/' . $ChUserProfile_img)){
                                    $ChUserProfile_imgLink=$this->webroot.'user_images/'.$ChUserProfile_img;
                                }else{
                                    $ChUserProfile_imgLink=$this->webroot.'user_images/default.png';
                                }
                                $com_ch_detail['comment_id']=$CHVal['TaskComment']['id'];
                                $com_ch_detail['Profile_img']=$ChUserProfile_imgLink;
                                $com_ch_detail['user_id']=$CHVal['User']['id'];
                                $com_ch_detail['User_name']=$CHVal['User']['first_name'].' '.$CHVal['User']['last_name'];
                                $com_ch_detail['comments']=$CHVal['TaskComment']['comments'];
                                $com_ch_detail['date']=$CHVal['TaskComment']['date'];
                                $com_detail['SubCommentList'][]=$com_ch_detail;
                            }
                        }else{
                            $com_detail['SubCommentList']=array();
                        }
                        $data['commentList'][]=$com_detail;
                    }
                }else{
                    $data['commentList']=array();
                }
                
                if(count($proposals)>0){
                    foreach($proposals as $OffVal){
                        $UserProfile_img=isset($OffVal['User']['profile_img'])?$OffVal['User']['profile_img']:'';
                        $uploadImgPath = WWW_ROOT.'user_images';
                        if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                            $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                        }else{
                            $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                        }

                        if(in_array($OffVal['Proposal']['user_id'], $AssignUserListArr)){
                            $user_offer_type='Accept';
                        }elseif(isset($userID) && $userID==$OffVal['User']['id'] && $task['Task']['task_status']=='O'){
                            $user_offer_type='Edit offer';
                        }else{
                            $user_offer_type='';
                        }

                        if(isset($userID) && $userID==$task['Task']['user_id'] && $task['Task']['task_status']=='O'){
                            $view_offer='Yes';
                        }else{
                            $view_offer='No';
                        }

                        $Ofr_detail['proposal_id']=$OffVal['Proposal']['id'];
                        $Ofr_detail['profile_img']=$UserProfile_imgLink;
                        $Ofr_detail['user_id']=$OffVal['User']['id'];
                        $Ofr_detail['user_name']=$OffVal['User']['first_name'].' '.$OffVal['User']['last_name'];
                        $Ofr_detail['user_tot_rating']=$OffVal['User']['tot_rating'];
                        $Ofr_detail['user_tot_review']=$OffVal['User']['tot_review'];
                        $Ofr_detail['amount']=$OffVal['Proposal']['amount'];
                        $Ofr_detail['comments']=$OffVal['Proposal']['comments'];
                        $Ofr_detail['task_id']=$OffVal['Proposal']['task_id'];
                        $Ofr_detail['user_offer_type']=$user_offer_type;
                        $Ofr_detail['view_offer']=$view_offer;

                        $data['OfferList'][]=$Ofr_detail;
                    }
                }else{
                    $data['OfferList']=array();
                }
                
                if(count($job)>0){
                    foreach($job as $JobVal){
                        $UserProfile_img=isset($JobVal['User']['profile_img'])?$JobVal['User']['profile_img']:'';
                        $uploadImgPath = WWW_ROOT.'user_images';
                        if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                            $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                        }else{
                            $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                        }


                        if(isset($userID) && $userID==$task['Task']['user_id']){
                            $view_offer='Yes';
                        }else if($JobVal['User']['id']==$userID){
                            $view_offer='Yes';
                        }else{
                            $view_offer='No';
                        }

                        $AssTo['job_id']=$JobVal['Job']['id'];
                        $AssTo['profile_img']=$UserProfile_imgLink;
                        $AssTo['user_id']=$JobVal['User']['id'];
                        $AssTo['user_name']=$JobVal['User']['first_name'].' '.$JobVal['User']['last_name'];
                        $AssTo['user_tot_rating']=$JobVal['User']['tot_rating'];
                        $AssTo['user_tot_review']=$JobVal['User']['tot_review'];
                        $AssTo['accepted_date']=$JobVal['Job']['accepted_date'];
                        $AssTo['comments']=$JobVal['Proposal']['comments'];
                        $AssTo['task_id']=$JobVal['Proposal']['task_id'];
                        $AssTo['send_message']=$view_offer;

                        $data['AssignedTo'][]=$AssTo;
                    }
                }else{
                    $data['AssignedTo']=array();
                }
                
                if(count($ReviewTaskList)>0){
                    foreach($ReviewTaskList as $RVal){
                        $UserProfile_img=isset($RVal['User']['profile_img'])?$RVal['User']['profile_img']:'';
                        $uploadImgPath = WWW_ROOT.'user_images';
                        if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                            $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                        }else{
                            $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                        }

                        $ReviewTo['review_id']=$RVal['Rating']['id'];
                        $ReviewTo['profile_img']=$UserProfile_imgLink;
                        $ReviewTo['user_id']=$RVal['User']['id'];
                        $ReviewTo['user_name']=$RVal['User']['first_name'].' '.$RVal['User']['last_name'];
                        $ReviewTo['rating']=$RVal['Rating']['rating'];
                        $ReviewTo['review']=$RVal['Rating']['review'];
                        $ReviewTo['date_time']=$RVal['Rating']['date_time'];

                        $data['ReviewTo'][]=$ReviewTo;
                    }
                }else{
                    $data['ReviewTo']=array();
                }
                //$data['ErrandComment']=$task;
                $data['Ack'] = 1;
            }
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appPostComment?userID=25&ErrandID=243&comments=some text
        public function appPostComment() {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('TaskComment');
            $this->loadModel('Notification');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ErrandID=isset($_REQUEST['ErrandID'])?$_REQUEST['ErrandID']:'';
            $comments=isset($_REQUEST['comments'])?$_REQUEST['comments']:'';
            
            $options = array('conditions' => array('Task.id' => $ErrandID));
            $task = $this->Task->find('first', $options);
            if (empty($task)) {
                $data['Ack']=0;
                $data['msg']='No Errand found';
            }else{
                $comm_data['TaskComment']['user_id'] = $userID;
                $comm_data['TaskComment']['task_id'] = $ErrandID;
                $comm_data['TaskComment']['comments'] = $comments;
                $comm_data['TaskComment']['date'] = date('Y-m-d H:i:s');
                $this->TaskComment->create();
                if($this->TaskComment->save($comm_data)){
                    $noti['Notification']['for_user_id'] = $task['User']['id'];
                    $noti['Notification']['by_user_id'] = $userID;
                    $noti['Notification']['task_id'] = $ErrandID;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'commented On';
                    $this->Notification->create();
                    $this->Notification->save($noti);
                }
                $data['Ack'] = 1;
                $data['msg']='You have successfully posted the comment.';
            }
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appPostCommentReply?userID=25&ErrandID=243&parent_id=28&comments=some text
        public function appPostCommentReply() {
            $this->autoRender = false;
            $this->loadModel('User');
            $this->loadModel('TaskComment');
            $this->loadModel('Notification');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ErrandID=isset($_REQUEST['ErrandID'])?$_REQUEST['ErrandID']:'';
            $comments=isset($_REQUEST['comments'])?$_REQUEST['comments']:'';
            $parent_id=isset($_REQUEST['parent_id'])?$_REQUEST['parent_id']:'';
            
            $options = array('conditions' => array('Task.id' => $ErrandID));
            $task = $this->Task->find('first', $options);
            if (empty($task)) {
                $data['Ack']=0;
                $data['msg']='No Errand found';
            }else{
                $comm_data['TaskComment']['user_id'] = $userID;
                $comm_data['TaskComment']['task_id'] = $ErrandID;
                $comm_data['TaskComment']['parent_id'] = $parent_id;
                $comm_data['TaskComment']['comments'] = $comments;
                $comm_data['TaskComment']['date'] = date('Y-m-d H:i:s');
                $this->TaskComment->create();
                if($this->TaskComment->save($comm_data)){
                    $noti['Notification']['for_user_id'] = $task['User']['id'];
                    $noti['Notification']['by_user_id'] = $userID;
                    $noti['Notification']['task_id'] = $ErrandID;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'commented On';
                    $this->Notification->create();
                    $this->Notification->save($noti);
                }
                $data['Ack'] = 1;
                $data['msg']='You have successfully posted the comment.';
            }
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appPostOffer?userID=25&ErrandID=243&proposalId=28&user_amt=25&site_amount=5&paypal_fee=3&amount=33&comments=some text
        public function appPostOffer() {
            $this->autoRender = false;
            $this->loadModel('User');
            //$this->loadModel('Job');
            $this->loadModel('Proposal');
            $this->loadModel('Notification');
            $this->loadModel('BillingAddress');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ErrandID=isset($_REQUEST['ErrandID'])?$_REQUEST['ErrandID']:'';
            $ProposalId=isset($_REQUEST['proposalId'])?$_REQUEST['proposalId']:'';
            $user_amt=isset($_REQUEST['user_amt'])?$_REQUEST['user_amt']:'';
            $site_amount=isset($_REQUEST['site_amount'])?$_REQUEST['site_amount']:'';
            $paypal_fee=isset($_REQUEST['paypal_fee'])?$_REQUEST['paypal_fee']:'';
            $amount=isset($_REQUEST['amount'])?$_REQUEST['amount']:'';
            $comments=isset($_REQUEST['comments'])?$_REQUEST['comments']:'';
            
            $user_options = array('conditions' => array('User.id'=>$userID));
            $user = $this->User->find('first', $user_options);
            $UserType=$user['User']['user_type'];
            $UserPaypalEmail=$user['User']['paypal_email'];
            if($UserType==1){
                $data['Ack']=0;
                $data['msg']='You cannot post an offer to this errand. Please check on "Run" to your account setting page.';
            }else{
                $err_options = array('conditions' => array('Task.id' => $ErrandID));
                $task = $this->Task->find('first', $err_options);

                $options_proposal = array('conditions' => array('Proposal.task_id' => $ErrandID,'Proposal.user_id'=>$userID));
                $UserProposal = $this->Proposal->find('first', $options_proposal);
                $options_add = array('conditions' => array('BillingAddress.user_id'=>$userID));
                $baddress = $this->BillingAddress->find('first', $options_add);
                
                if($ProposalId!=''){
                    $options = array('conditions' => array('Proposal.id' => $ProposalId));
                    $proposalEdit = $this->Proposal->find('first', $options); 
                }else{
                    $proposalEdit=array();
                }
                
                if($userID == $task['Task']['user_id']){
                    $data['Ack']=0;
                    $data['msg']='Sorry you have posted the errand, so cannot post offer on the errand.';
                }elseif($UserPaypalEmail == ''){
                    $data['Ack']=0;
                    $data['msg']='Please provide Paypal Email.';
                }else{
                    if($ProposalId!=''){
                        $Proposal_data['Proposal']['id'] = $ProposalId;
                    }else{
                        $Proposal_data['Proposal']['date'] = date('Y-m-d H:i:s');
                    }
                    $Proposal_data['Proposal']['user_id'] = $userID;
                    $Proposal_data['Proposal']['task_id'] = $ErrandID;
                    $Proposal_data['Proposal']['amount'] = $amount;
                    $Proposal_data['Proposal']['your_amount'] = $user_amt;
                    $Proposal_data['Proposal']['paypal_fee'] = $paypal_fee;
                    $Proposal_data['Proposal']['site_amount'] = $site_amount;
                    $Proposal_data['Proposal']['comments'] = $comments;
                    $this->Proposal->create();
                    if($this->Proposal->save($Proposal_data)){
                        if($ProposalId==''){
                            $ProId=$this->Proposal->getLastInsertId();
                            $noti['Notification']['for_user_id'] = $task['User']['id'];
                            $noti['Notification']['by_user_id'] = $userID;
                            $noti['Notification']['task_id'] = $ErrandID;
                            $noti['Notification']['date'] = date('Y-m-d H:i:s');;
                            $noti['Notification']['type'] = 'posted offer on';
                            $this->Notification->create();
                            $this->Notification->save($noti);
                            $data['Ack'] = 1;
                            $data['ProposalId']=$ProId;
                            $data['msg']='You have successfully posted the offer.';
                        }else{
                            $data['Ack'] = 1;
                            $data['ProposalId']=$ProposalId;
                            $data['msg']='You have successfully edit the offer.';
                        }
                    }
                }
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appGetOffer?userID=28&proposalId=4
        public function appGetOffer() {
            $this->autoRender = false;
            
            //$this->loadModel('User');
            //$this->loadModel('Job');
            $this->loadModel('Proposal');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ProposalId=isset($_REQUEST['proposalId'])?$_REQUEST['proposalId']:'';
            $options_proposal = array('conditions' => array('Proposal.id' => $ProposalId));
            $UserProposal = $this->Proposal->find('first', $options_proposal);
            
            if(empty($UserProposal)){
                $data['Ack']=0;
                $data['msg']='No Offer found.';
            }else{
                $OffDet['id'] = $UserProposal['Proposal']['id'];
                $OffDet['user_id'] = $UserProposal['Proposal']['user_id'];
                $OffDet['task_id'] = $UserProposal['Proposal']['task_id'];
                $OffDet['date'] = $UserProposal['Proposal']['date'];
                $OffDet['comments'] = $UserProposal['Proposal']['comments'];
                $OffDet['is_accepted'] = $UserProposal['Proposal']['is_accepted'];
                $OffDet['paykey'] = $UserProposal['Proposal']['paykey'];
                $OffDet['amount'] = $UserProposal['Proposal']['amount'];
                $OffDet['your_amount'] = $UserProposal['Proposal']['your_amount'];
                $OffDet['paypal_fee'] = $UserProposal['Proposal']['paypal_fee'];
                $OffDet['site_amount'] = $UserProposal['Proposal']['site_amount'];
                
                $data['Ack'] = 1;
                $data['Offer_details'][]=$OffDet;
                //$data['msg']='You have successfully edit the offer.';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appViewOffer?userID=28&proposalId=4&accept=1
        public function appViewOffer() {
            $this->autoRender = false;
            $this->loadModel('Proposal');
            $data = array();
            $userID=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ProposalId=isset($_REQUEST['proposalId'])?$_REQUEST['proposalId']:'';
            $accept=isset($_REQUEST['accept'])?$_REQUEST['accept']:'';
            $options_proposal = array('conditions' => array('Proposal.id' => $ProposalId));
            $UserProposal = $this->Proposal->find('first', $options_proposal);
            
            if(empty($UserProposal)){
                $data['Ack']=0;
                $data['msg']='No Offer found.';
            }else{
                $UserProfile_img=isset($UserProposal['User']['profile_img'])?$UserProposal['User']['profile_img']:'';
                $uploadImgPath = WWW_ROOT.'user_images';
                if($UserProfile_img!='' && file_exists($uploadImgPath . '/' . $UserProfile_img)){
                    $UserProfile_imgLink=$this->webroot.'user_images/'.$UserProfile_img;
                }else{
                    $UserProfile_imgLink=$this->webroot.'user_images/default.png';
                }
                
                $OffDet['id'] = $UserProposal['Proposal']['id'];
                $OffDet['user_id'] = $UserProposal['Proposal']['user_id'];
                $OffDet['task_id'] = $UserProposal['Proposal']['task_id'];
                $OffDet['date'] = $UserProposal['Proposal']['date'];
                $OffDet['comments'] = $UserProposal['Proposal']['comments'];
                $OffDet['is_accepted'] = $UserProposal['Proposal']['is_accepted'];
                $OffDet['paykey'] = $UserProposal['Proposal']['paykey'];
                $OffDet['amount'] = $UserProposal['Proposal']['amount'];
                $OffDet['your_amount'] = $UserProposal['Proposal']['your_amount'];
                $OffDet['paypal_fee'] = $UserProposal['Proposal']['paypal_fee'];
                $OffDet['site_amount'] = $UserProposal['Proposal']['site_amount'];
                
                $UserDet['profile_img'] = $UserProfile_imgLink;
                $UserDet['user_name'] = $UserProposal['User']['first_name'].' '.$UserProposal['User']['last_name'];
                $UserDet['paypal_email'] = $UserProposal['User']['paypal_email'];
                $UserDet['about'] = $UserProposal['User']['about'];
                $UserDet['tot_rating'] = $UserProposal['User']['tot_rating'];
                $UserDet['tot_review'] = $UserProposal['User']['tot_review'];
                $UserDet['accept_offer'] = ($accept==1)?'Yes':'No';
                
                $data['Ack'] = 1;
                $data['Offer_details'][]=$OffDet;
                $data['User_details'][]=$UserDet;
                //$data['msg']='You have successfully edit the offer.';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appAcceptOffer?userID=28&proposalId=4&paykey=AP-8TX738306G363744B&transactionId=7DJ65974R8648680K
        public function appAcceptOffer() {
            $this->autoRender = false;
            $this->loadModel('SiteSetting');
            $this->loadModel('User');
            $this->loadModel('Job');
            $this->loadModel('Proposal');
            $this->loadModel('Notification');
            $this->loadModel('PaymentHistory');
            
            $data = array();
            $userid=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $ProID=isset($_REQUEST['proposalId'])?$_REQUEST['proposalId']:'';
            $paykey=isset($_REQUEST['paykey'])?$_REQUEST['paykey']:'';
            $transactionId=isset($_REQUEST['transactionId'])?$_REQUEST['transactionId']:'';
            
            $optionPro = array('conditions' => array('Proposal.id' => $ProID));
            $ProData = $this->Proposal->find('first', $optionPro);
            $TotWorkers=$ProData['Task']['workers'];
            $request_id=$ProData['Proposal']['user_id'];
            //$paykey=$ProData['Proposal']['paykey'];
            $task_id=$ProData['Proposal']['task_id'];
            $optionTotJob = array('conditions' => array('Job.task_id' => $task_id));
            $TotAssignWorker = $this->Job->find('count', $optionTotJob);
            
            $options = array('conditions' => array('SiteSetting.' . $this->SiteSetting->primaryKey => 1));
            $sitesetting = $this->SiteSetting->find('first', $options);
            
            if($TotWorkers >= ($TotAssignWorker+1)){
                
                /*$bidSave['Proposal']['id'] = $ProID;
                $bidSave['Proposal']['paykey'] =$paykey;
                $this->Proposal->save($bidSave);*/
                
                $TransactionID=$transactionId;
                $bid = $ProID;
                $tid = $task_id;
                $options = array('conditions' => array('Proposal.id' => $bid));
                $proposal = $this->Proposal->find('first', $options);

                $job['Job']['user_id'] = $proposal['Proposal']['user_id'];
                $job['Job']['task_id'] = $tid;
                $job['Job']['proposal_id'] = $proposal['Proposal']['id'];
                $job['Job']['amount'] = $proposal['Proposal']['amount'];
                $job['Job']['admin_amount'] = $proposal['Proposal']['site_amount'];
                $job['Job']['user_amount'] = $proposal['Proposal']['your_amount'];
                $job['Job']['paypal_fee'] = $proposal['Proposal']['paypal_fee'];
                $job['Job']['transaction_id'] = $TransactionID;
                $job['Job']['accepted_date'] = date('Y-m-d H:i:s');
                $job['Job']['payment_status'] = 1;
                $this->Job->create();
                if($this->Job->save($job))
                {
                    $job_id=$this->Job->getLastInsertId();
                    if($TotWorkers == ($TotAssignWorker+1)){ 
                        $tsk['Task']['id'] = $tid;
                        $tsk['Task']['task_status'] = 'A';
                        $this->Task->save($tsk);
                    }
                    $pro['Proposal']['id'] = $proposal['Proposal']['id'];
                    $pro['Proposal']['is_accepted'] = '1';
                    $pro['Proposal']['paykey'] =$paykey;
                    $this->Proposal->save($pro);

                    $noti['Notification']['for_user_id'] = $proposal['Proposal']['user_id'];
                    $noti['Notification']['by_user_id'] = $userid;
                    $noti['Notification']['task_id'] = $tid;
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    $noti['Notification']['type'] = 'has assigned the task';
                    $this->Notification->create();
                    $this->Notification->save($noti);

                    $payment['PaymentHistory']['for_user_id'] = $userid;
                    $payment['PaymentHistory']['by_user_id'] = $proposal['Proposal']['user_id'];
                    $payment['PaymentHistory']['task_id'] = $tid;
                    $payment['PaymentHistory']['job_id'] = $job_id;
                    $payment['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment['PaymentHistory']['transaction_id'] = $TransactionID;
                    $payment['PaymentHistory']['pay_amount'] = $proposal['Proposal']['amount'];
                    $payment['PaymentHistory']['user_amount'] = $proposal['Proposal']['your_amount'];
                    $payment['PaymentHistory']['admin_amount'] = $proposal['Proposal']['site_amount'];
                    $payment['PaymentHistory']['paypal_fee'] = $proposal['Proposal']['paypal_fee'];
                    $payment['PaymentHistory']['type'] = 'pay amount';
                    $payment['PaymentHistory']['payment_status'] = 1;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment);

                    $payment_user['PaymentHistory']['for_user_id'] = $proposal['Proposal']['user_id'];
                    $payment_user['PaymentHistory']['by_user_id'] = $userid;
                    $payment_user['PaymentHistory']['task_id'] = $tid;
                    $payment_user['PaymentHistory']['job_id'] = $job_id;
                    $payment_user['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment_user['PaymentHistory']['transaction_id'] = $TransactionID;
                    $payment_user['PaymentHistory']['pay_amount'] = $proposal['Proposal']['amount'];
                    $payment_user['PaymentHistory']['user_amount'] = $proposal['Proposal']['your_amount'];
                    $payment_user['PaymentHistory']['admin_amount'] = $proposal['Proposal']['site_amount'];
                    $payment_user['PaymentHistory']['paypal_fee'] = $proposal['Proposal']['paypal_fee'];
                    $payment_user['PaymentHistory']['type'] = 'release fund';
                    $payment_user['PaymentHistory']['payment_status'] = 1;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment_user);
                }
                $data['Ack']=1;
                $data['msg']='You have made payment successfully and assigned the errand.';
            }else{
                $data['Ack']=0;
                $data['msg']='Sorry! payment could not made. Please try again';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appRatingsReviews?userID=28&giverating=4&rateto_user_id=25&errandId=61&review=Good work
        public function appRatingsReviews() {
            $this->autoRender = false;
            $this->loadModel('Rating');
            $this->loadModel('User');
            
            $data = array();
            $userid=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $rateto_user_id=isset($_REQUEST['rateto_user_id'])?$_REQUEST['rateto_user_id']:'';
            $Giverating=isset($_REQUEST['giverating'])?$_REQUEST['giverating']:'';
            $errandId=isset($_REQUEST['errandId'])?$_REQUEST['errandId']:'';
            $review=isset($_REQUEST['review'])?$_REQUEST['review']:'';
            
            if($errandId!='' && $Giverating>0){
                $Rating_data['Rating']['task_id'] = $errandId;
                $Rating_data['Rating']['task_by'] = $userid;
                $Rating_data['Rating']['user_id'] = $rateto_user_id;
                $Rating_data['Rating']['rating'] = $Giverating;
                $Rating_data['Rating']['review'] =  $review;
                $Rating_data['Rating']['date_time'] = date('Y-m-d H:i:s');
                $this->Rating->create();
                if($this->Rating->save($Rating_data)){
                    $UrseRateoptions = array('conditions' => array('User.id' => $rateto_user_id));
                    $UrseRate = $this->User->find('first', $UrseRateoptions);
                    if(count($UrseRate)>0){
                        $UserPreviousRating=$UrseRate['User']['tot_rating'];
                        $UserPreviousReview=$UrseRate['User']['tot_review'];
                        $TotRat=($UserPreviousRating+$Giverating);
                        $TotRev=($UserPreviousReview+1);
                        $CalRating=$TotRat/$TotRev;
                        $UserUpdate['User']['id'] = $rateto_user_id;
                        $UserUpdate['User']['tot_rating'] = $CalRating;
                        $UserUpdate['User']['tot_review'] = $TotRev;
                        $this->User->save($UserUpdate);
                    }
                    $data['Ack']=1;
                    $data['msg']='You have successfully posted the ratings and reviews.';	          
                }
            }else{
                $data['Ack']=0;
                $data['msg']='Sorry! review could not made. Please try again';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        // http://errandchampion.com/tasks/appRatingsUserList?userID=28&errandId=232
        public function appRatingsUserList() {
            $this->autoRender = false;
            $this->loadModel('Job');
            
            $data = array();
            $userid=isset($_REQUEST['userID'])?$_REQUEST['userID']:'';
            $errandId=isset($_REQUEST['errandId'])?$_REQUEST['errandId']:'';
            
            $options = array('conditions' => array('Job.task_id' => $errandId));
            $job = $this->Job->find('all', $options);
            
            if(count($job)>0){
                foreach($job as $val){
                    $post_detail['user_id']=$val['User']['id'];
                    $post_detail['name']=$val['User']['first_name'].' '.$val['User']['last_name'];
                    $data['UserList'][]=$post_detail;
                }
                 $data['Ack']=1;
            }else{
                $data['Ack']=0;
                $data['msg']='Sorry! no user found. Please try again';
            }
            
            $result = json_encode($data);
            return $result;
        }
        
        /////////////////////////End App Function suman ///////////////////////////////////////
}
