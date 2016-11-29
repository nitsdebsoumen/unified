<?php
App::uses('AppController', 'Controller');
/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class SalesController extends AppController {

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
            	$this->Sale->recursive = 0;
		$this->set('posts', $this->Paginator->paginate());
	}

	public function admin_index() {	
	       $this->loadModel('Country');
	       $countries=$this->Country->find('list',array('fields'=>array('Country.id','Country.name')));
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
//	    if(isset($this->request->data['keyword']))
//	    {
//	  $keywords=$this->request->data['keyword'];
//	    }
//	    else
//	    {
//		$keywords='';
//	    }
//	     if(isset($this->request->data['search_is_active']))
//	    {
//                $Newsearch_is_active=$this->request->data['search_is_active'];
//	    }
//	    else
//	    {
//		$Newsearch_is_active='';
//	    }
//	        if(isset($this->request->data['Country']))
//	    {
//                $Country=$this->request->data['Country'];
//	    }
//	    else
//	    {
//		$Country='';
//	    }
//		$QueryStr='1';
//		  if($keywords!=''){
//                    $QueryStr.=" AND (Sale.post_title LIKE '%".$keywords."%')";
//                }
//                if($Newsearch_is_active!=''){
//                    $QueryStr.=" AND (Sale.is_approve = '".$Newsearch_is_active."')";
//                }
//		 if($Country!=''){
//                    $QueryStr.=" AND (Sale.country_id = '".$Country."')";
//                }
//                $options = array('conditions' => array($QueryStr), 'order' => array('Sale.id' => 'desc'));
		//$this->Paginator->settings = '';
            $title_for_layout = 'Sale List';
            $this->Sale->recursive =1;
            $this->set('posts', $this->Paginator->paginate('Sale'));
            $this->set(compact('title_for_layout','keywords','Newsearch_is_active','countries','Country'));
	}
	public function admin_subposts($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Sub Sale List';
            //$this->Sale->recursive = 0;
            $this->set('posts', $this->Paginator->paginate('Sale', array('Sale.id' => $id)));
            $this->set(compact('title_for_layout','id'));
	}
	
	public function admin_exportsub($id = null)
	{
		$userid = $this->Session->read('adminuserid');
		$is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
		$posts = $this->Sale->find('all');
		
		$output = '';
		$output .='Name, Status';
		$output .="\n";

		if(!empty($posts))
		{
			foreach($posts as $category)
			{	
				$isactive = ($category['Sale']['active']==1?'Active':'Inactive');
			   
				$output .='"'.$category['Sale']['name'].'","'.$isactive.'"';
				$output .="\n";
			}
		}
		$filename = "posts".time().".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
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
	public function view($id = null) {
            $userid = $this->Session->read('userid');
            if(!isset($userid) && $userid==''){
               $this->redirect('/admin');
            }
            if (!$this->Sale->exists($id)) {
                    throw new NotFoundException(__('Invalid Sale'));
            }
            $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
            $this->set('category', $this->Sale->find('first', $options));
	}

	public function admin_view($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Sale View';
            if (!$this->Sale->exists($id)) {
                    throw new NotFoundException(__('Invalid Sale'));
            }
            $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
            $post = $this->Sale->find('first', $options);
            $this->set(compact('title_for_layout','post'));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
            $userid = $this->Session->read('userid');
            if(!isset($userid) && $userid==''){
               $this->redirect('/admin');
            }
            if ($this->request->is('post')) {
                    $this->Sale->create();
                    if ($this->Sale->save($this->request->data)) {
                            $this->Session->setFlash(__('The category has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                    }
            }
            $users = $this->Sale->User->find('list');
            $this->set(compact('users'));
	}

	public function admin_add() {	
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
	    $this->request->data1=array();
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
	    $users=$this->Sale->User->find('list',array('fields'=>array('User.id','User.first_name'),'conditions'=>array('User.is_admin'=>'0')));
	    $membershipplans=$this->Sale->MembershipPlan->find('list',array('fields'=>array('MembershipPlan.id','MembershipPlan.title')));
            $title_for_layout = 'Sale Add';
            if ($this->request->is('post')) {
		
					$this->request->data['Sale']['time']=date('Y-m-d h:m:s');
					$this->request->data['Sale']['fromdate']=date('Y-m-d h:m:s');
					$this->request->data['Sale']['todate']=date('Y-m-d h:m:s',strtotime("+1 month"));
					$this->request->data['Sale']['membership_plan_id']=$this->request->data['Sale']['membershipplans'];
                            $this->Sale->create();
                            if ($this->Sale->save($this->request->data)) {
                                    $this->Session->setFlash(__('The Sale has been saved.'));
                                    return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The Sale could not be saved. Please, try again.'));
                            }
                    } 
            $this->set(compact('title_for_layout','membershipplans','users'));
	}


	public function admin_addsubcategory($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Sub Sale Add';
            if ($this->request->is('post')) {
                    $options = array('conditions' => array('Sale.name'  => $this->request->data['Sale']['name'], 'Sale.parent_id'=>$this->request->data['Sale']['parent_id']));
                    $name = $this->Sale->find('first', $options);
                    if(!$name){
                            $this->Sale->create();
                            if ($this->Sale->save($this->request->data)) {
                                    $this->Session->setFlash(__('The sub category has been saved.'));
                                    return $this->redirect(array('action' => 'subposts',$id));
                            } else {
                                    $this->Session->setFlash(__('The sub category could not be saved. Please, try again.'));
                            }
                    } else {
                            $this->Session->setFlash(__('The sub category name already exists. Please, try again.'));
                    }
            }
            $options = array('conditions' => array('Sale.id' => $id));
            $categoryname = $this->Sale->find('list', $options);
            if($categoryname){
                    $categoryname = $categoryname[$id];
            } else {
                    $categoryname = '';
            }		
            $this->set(compact('title_for_layout','categoryname','id'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
            $userid = $this->Session->read('userid');
            if(!isset($userid) && $userid==''){
               $this->redirect('/admin');
            }
            if (!$this->Sale->exists($id)) {
                    throw new NotFoundException(__('Invalid category'));
            }
            if ($this->request->is(array('post', 'put'))) {
                    if ($this->Sale->save($this->request->data)) {
                            $this->Session->setFlash(__('The category has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                    }
            } else {
                    $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
                    $this->request->data = $this->Sale->find('first', $options);
            }
            $users = $this->Sale->User->find('list');
            $this->set(compact('users'));
	}

	public function admin_edit($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
	     $this->request->data1=array();
	    $users=$this->Sale->User->find('list',array('fields'=>array('User.id','User.first_name'),'conditions'=>array('User.is_admin'=>'0')));
	    $membershipplans=$this->Sale->MembershipPlan->find('list',array('fields'=>array('MembershipPlan.id','MembershipPlan.title')));
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
		//echo $id;exit;
            if (!$this->Sale->exists($id)) {
                    throw new NotFoundException(__('Invalid category'));
            }
            if ($this->request->is(array('post', 'put'))) {
						$this->request->data['Sale']['membership_plan_id']=$this->request->data['Sale']['membershipplans'];
                            if ($this->Sale->save($this->request->data)) {
                                    $this->Session->setFlash(__('The Sale has been saved.'));
				    return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The Sale could not be saved. Please, try again.'));
                            }
            } else {
                    //echo "hello";exit;
                    $options = array('conditions' => array('Sale.' . $this->Sale->primaryKey => $id));
                    $this->request->data = $this->Sale->find('first', $options);

                    //print_r($this->request->data);
            }
            $this->set(compact('users','membershipplans'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Sale->id = $id;
		if (!$this->Sale->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Sale->delete()) {
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
            $this->Sale->id = $id;
            if (!$this->Sale->exists()) {
                    throw new NotFoundException(__('Invalid category'));
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->Sale->delete($id)) {
                    $this->Session->setFlash(__('The sale has been deleted.'));
            } else {
                    $this->Session->setFlash(__('The sale could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
	
	///////////////////////////////AK///////////
	public function admin_export()
	{
		$userid = $this->Session->read('adminuserid');
		$is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
		$options = array('Sale.id !=' => 0);
		$cats = $this->Sale->find('all',array('conditions' => $options));
		$output = '';
		$output .='Sale Name, Parent Name, Is Active';
		$output .="\n";
//pr($cats);exit;
		if(!empty($cats))
		{
			foreach($cats as $cat)
			{	
				$isactive = ($cat['Sale']['active']==1)?'Yes':'No';
				
				$output .='"'.$cat['Sale']['name'].'","'.$cat['Parent']['name'].'","'.$isactive.'"';
				$output .="\n";
			}
		}
		$filename = "posts".time().".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}
	//////////////////////////AK///////////////////////
	
}
