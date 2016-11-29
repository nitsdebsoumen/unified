<?php
App::uses('AppController', 'Controller');
/**
 * Notifications Controller
 *
 * @property Notification $Notification
 * @property PaginatorComponent $Paginator
 */
class NotificationsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	var $uses = array('Notification','User');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$userid = $this->Session->read('userid');
		if(isset($userid) && !empty($userid))
		{
			$this->Notification->recursive = 0;
			$options = array('conditions' => array('Notification.for_user_id'=>$userid),'order'=>array('Notification.id Desc'), 'limit'=>30);
			 
                        $this->Paginator->settings = $options;
                        $my_notifications=$this->Paginator->paginate('Notification');
                        
			$this->set(compact('my_notifications'));
			if(!empty($my_notifications))
			{
				foreach($my_notifications as $notification)
				{
					$noti['Notification']['id'] = $notification['Notification']['id'];
					$noti['Notification']['is_read'] = 1;
					$this->Notification->save($noti);
				}
			}
		}
		else{
			$this->Session->setFlash(__('Please login first.'));
			return $this->redirect(array('controller'=>'users','action' => 'login/'));
		}
	}

	


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Newsletter->exists($id)) {
			throw new NotFoundException(__('Invalid Newsletter'));
		}
		$options = array('conditions' => array('Newsletter.' . $this->Newsletter->primaryKey => $id));
		
		$this->set('newsletter', $this->Newsletter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	


	
/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Newsletter->id = $id;
		if (!$this->Newsletter->exists()) {
			throw new NotFoundException(__('Invalid Newsletter subscriber'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Newsletter->delete()) {
			$this->Session->setFlash(__('The Newsletter subscriber has been deleted.'));
		} else {
			$this->Session->setFlash(__('The Newsletter subscriber could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	function how_long_ago($timestamp)
	{
		if(!isset($timestamp) ||  empty($timestamp)) return false;
			$difference = time() - $timestamp;
     	if($difference < 60)
	    		return $difference." seconds";
		else{
		    $difference = round($difference / 60);
		    if($difference < 60)
			return $difference." mins";
		    else{
			$difference = round($difference / 60);
			if($difference < 24)
			    return $difference." hours";
			else{
			    $difference = round($difference / 24);
			    if($difference < 7)
				return $difference. "days";
			    else{
				$difference = round($difference / 7);
				return $difference." weeks";
			    }
			}
		    }
		}	   
	}

	
}
