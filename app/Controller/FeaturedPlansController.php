<?php
App::uses('AppController', 'Controller');
/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class FeaturedPlansController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->FeaturedPlan->recursive = 0;
		$this->set('content', $this->Paginator->paginate());
	}
	
	
	public function admin_index() {	
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'FeaturedPlan List';
            $this->FeaturedPlan->recursive = 0;
            $this->set('contents', $this->Paginator->paginate());
            $this->set(compact('title_for_layout'));
	}
	
	public function admin_export()
	{
		$userid = $this->Session->read('adminuserid');
		$is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
		
		$contents = $this->MembershipPlan->find('all');
		
		$output = '';
		$output .='Page Heading, MembershipPlan';
		$output .="\n";

		if(!empty($contents))
		{
			foreach($contents as $content)
			{				   
				$output .='"'.html_entity_decode($content['MembershipPlan']['page_heading']).'","'.strip_tags($content['MembershipPlan']['content']).'"';
				$output .="\n";
			}
		}
		$filename = "contents".time().".csv";
		header('MembershipPlan-type: application/csv');
		header('MembershipPlan-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}


/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($page_name = null) {
            $this->loadModel('Contact');
            $this->loadModel('User');
            if(isset($page_name) && $page_name!=''){
                $options = array('conditions' => array('MembershipPlan.page_name' => $page_name));
                $content = $this->MembershipPlan->find('first', $options);
                if ($this->request->is(array('post', 'put'))) {
		    $this->request->data['Contact']['contact_date']=date('Y-m-d');
                    $UserEmail=$this->request->data['Contact']['email'];
                    $UserID=$this->request->data['Contact']['user_id'];
                    if($UserID==''){
                        $options = array('conditions' => array('User.email' => $UserEmail));
                        $userEmailDetails=$this->User->find('first', $options);
                        //pr($userEmailDetails);
                        if(count($userEmailDetails)>0){
                            $this->request->data['Contact']['user_id']=$userEmailDetails['User']['id'];
                        }else{
                            $this->request->data['Contact']['user_id']=0;
                        }
                    }
                    if($this->request->data['Contact']['type']==2){
                        $link_data=$this->request->data['Contact']['link'];
                        $ExpLink_data=end(explode('/',$link_data));
                        if($ExpLink_data!=''){
                            $task_id=  base64_decode($ExpLink_data);
                        }else{
                            $task_id=0;
                        }
                        $this->request->data['Contact']['task_id']=$task_id;
                    }else{
                        $this->request->data['Contact']['task_id']=0;
                    }
                    
                    if ($this->Contact->save($this->request->data)) {
                        $this->Session->setFlash(__('Thank you, we\'ll get back to you shortly.'));
                        return $this->redirect(array('action' => 'view/'.$page_name));
                    } else {
                        $this->Session->setFlash(__('Your details could not be saved. Please, try again.'));
                    }
		} 
                if($content){
                    $title_for_layout = $content['MembershipPlan']['page_heading'];
                    $page_name = $content['MembershipPlan']['page_name'];
                    $this->set(compact('title_for_layout','content','page_name'));
                }
            } else {
                    throw new NotFoundException(__('Invalid MembershipPlan'));
            }
	}

	public function admin_view($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'FeaturedPlan View';
            if (!$this->FeaturedPlan->exists($id)) {
                    throw new NotFoundException(__('Invalid FeaturedPlan'));
            }
            $options = array('conditions' => array('FeaturedPlan.' . $this->FeaturedPlan->primaryKey => $id));
            $content = $this->FeaturedPlan->find('first', $options);		
            $this->set(compact('title_for_layout','content'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Category->create();
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		}
		$users = $this->Category->User->find('list');
		$this->set(compact('users'));
	}

	public function admin_add() {
		if ($this->request->is('post')) {
			$this->FeaturedPlan->create();
			if ($this->FeaturedPlan->save($this->request->data)) {
				$this->Session->setFlash(__('The content has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The content could not be saved. Please, try again.'));
			}
		}
	}
/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Category->exists($id)) {
			throw new NotFoundException(__('Invalid category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Category->save($this->request->data)) {
				$this->Session->setFlash(__('The category has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The category could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
			$this->request->data = $this->Category->find('first', $options);
		}
		$users = $this->Category->User->find('list');
		$this->set(compact('users'));
	}

	public function admin_edit($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            if (!$this->FeaturedPlan->exists($id)) {
                    throw new NotFoundException(__('Invalid content'));
            }
            if ($this->request->is(array('post', 'put'))) {
                    if ($this->FeaturedPlan->save($this->request->data)) {
                            $this->Session->setFlash(__('The content has been saved.', array('class' => 'success')));
						return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The content could not be saved. Please, try again.'));
                    }
            } else {
                    $options = array('conditions' => array('FeaturedPlan.' . $this->FeaturedPlan->primaryKey => $id));
                    $this->request->data = $this->FeaturedPlan->find('first', $options);
            }
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_delete($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $this->FeaturedPlan->id = $id;
            if (!$this->FeaturedPlan->exists()) {
                    throw new NotFoundException(__('Invalid category'));
            }
            if ($this->FeaturedPlan->delete($id)) {
                    $this->Session->setFlash(__('The content has been deleted.'));
            } else {
                    $this->Session->setFlash(__('The content could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
        
        public function how_it_works() {
            
        }
        
        public function faq() {
            $this->loadModel('Faq');
            $this->loadModel('FaqCategory');
            $title_for_layout = 'Faq';
            $CatOptions = array('conditions' => array('FaqCategory.active' => 1,'FaqCategory.parent_id' => 0));
            $FaqCat = $this->FaqCategory->find('all', $CatOptions);
            //$FaqOptions = array('conditions' => array('Faq.is_active' => 1));
            //$FaqData = $this->Faq->find('all', $FaqOptions);
            $this->set(compact('title_for_layout','FaqCat'));
        }
        
        public function faq_category_wise($id=null) {
            $this->loadModel('Faq');
            $FaqOptions = array('conditions' => array('Faq.is_active' => 1, 'Faq.faq_category_id' => $id));
            $FaqData = $this->Faq->find('all', $FaqOptions);
            return $FaqData;
            exit;
        }

        public function blog() {
        
    }

    public function single_blog() {
       
    }

    public function plans() {
            $userid = $this->Session->read('userid');
            if($userid!='')
            {
                $this->loadModel('FeaturedPlan');
                $this->loadModel('Setting');
                $this->loadModel('User');
                $plans=$this->FeaturedPlan->find('all');
                //$this->MembershipOrder->recursive=2;
                //$order=$this->MembershipOrder->find('first',array('conditions'=>array('User.id'=>$userid)));
                $setting = $this->Setting->find('first',array('conditions'=>array('Setting.id'=>1)));
                $this->User->recursive=2;
                $user=$this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
                $this->set('plans',$plans);
                //$this->set('order',$order);
                $this->set('user',$user);
                $this->set('setting',$setting);
            }
            else
            {
                return $this->redirect(array('controller'=>'users','action' => 'login'));
            }
    }

    public function featured_paln_order($id = NULL){
        $id = base64_decode($id);
        $userid=$this->Session->read('userid');
        if(isset($userid)){
            $this->loadModel('FeaturedPlan');
            $this->loadModel('User');
            $this->loadModel('Setting');
            $plan = $this->FeaturedPlan->find('first',array('conditions'=>array('FeaturedPlan.id'=>$id)));
            $user = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
            $setting = $this->Setting->find('first',array('conditions'=>array('Setting.id'=>1)));
            $this->set(compact('plan','user','setting'));        
        }
        else{
            return $this->redirect(array('controller'=>'users','action' => 'login'));
        }
    }
	
}
