<?php
App::uses('AppController', 'Controller');
/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class MarketplacesController extends AppController {

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
            	$this->Marketplace->recursive = 0;
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
	    if(isset($this->request->data['keyword']))
	    {
	  $keywords=$this->request->data['keyword'];
	    }
	    else
	    {
		$keywords='';
	    }
	     if(isset($this->request->data['search_is_active']))
	    {
                $Newsearch_is_active=$this->request->data['search_is_active'];
	    }
	    else
	    {
		$Newsearch_is_active='';
	    }
	        if(isset($this->request->data['Country']))
	    {
                $Country=$this->request->data['Country'];
	    }
	    else
	    {
		$Country='';
	    }
		$QueryStr='1';
		  if($keywords!=''){
                    $QueryStr.=" AND (Marketplace.post_title LIKE '%".$keywords."%')";
                }
                if($Newsearch_is_active!=''){
                    $QueryStr.=" AND (Marketplace.is_approve = '".$Newsearch_is_active."')";
                }
		 if($Country!=''){
                    $QueryStr.=" AND (Marketplace.country_id = '".$Country."')";
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('Marketplace.id' => 'desc'));
		$this->Paginator->settings = $options;
            $title_for_layout = 'Marketplace List';
            $this->Marketplace->recursive =1;
            $this->set('posts', $this->Paginator->paginate('Marketplace'));
            $this->set(compact('title_for_layout','keywords','Newsearch_is_active','countries','Country'));
	}
	public function admin_subposts($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Sub Marketplace List';
            //$this->Marketplace->recursive = 0;
            $this->set('posts', $this->Paginator->paginate('Marketplace', array('Marketplace.id' => $id)));
            $this->set(compact('title_for_layout','id'));
	}
	
	public function admin_exportsub($id = null)
	{
		$userid = $this->Session->read('adminuserid');
		$is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
		$posts = $this->Marketplace->find('all');
		
		$output = '';
		$output .='Name, Status';
		$output .="\n";

		if(!empty($posts))
		{
			foreach($posts as $category)
			{	
				$isactive = ($category['Marketplace']['active']==1?'Active':'Inactive');
			   
				$output .='"'.$category['Marketplace']['name'].'","'.$isactive.'"';
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
            if (!$this->Marketplace->exists($id)) {
                    throw new NotFoundException(__('Invalid Marketplace'));
            }
            $options = array('conditions' => array('Marketplace.' . $this->Marketplace->primaryKey => $id));
            $this->set('category', $this->Marketplace->find('first', $options));
	}

	public function admin_view($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Marketplace View';
            if (!$this->Marketplace->exists($id)) {
                    throw new NotFoundException(__('Invalid Marketplace'));
            }
            $options = array('conditions' => array('Marketplace.' . $this->Marketplace->primaryKey => $id));
            $post = $this->Marketplace->find('first', $options);
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
                    $this->Marketplace->create();
                    if ($this->Marketplace->save($this->request->data)) {
                            $this->Session->setFlash(__('The category has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                    }
            }
            $users = $this->Marketplace->User->find('list');
            $this->set(compact('users'));
	}

	public function admin_add() {	
	    $this->loadModel('MarketplaceImage');
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
	    $this->request->data1=array();
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
	    $users=$this->Marketplace->User->find('list',array('fields'=>array('User.id','User.first_name'),'conditions'=>array('User.is_admin'=>'0')));
	    $categories=$this->Marketplace->Category->find('list',array('fields'=>array('Category.id','Category.category_name')));
	    $countries=$this->Marketplace->Country->find('list',array('fields'=>array('Country.id','Country.name')));
	    $posts=$this->Marketplace->find('list',array('fields'=>array('Marketplace.id','Marketplace.title')));
	    //print_r($country);
            $title_for_layout = 'Marketplace Add';
            if ($this->request->is('post')) {
                    $options = array('conditions' => array('Marketplace.title'  => $this->request->data['Marketplace']['title']));
                    $name = $this->Marketplace->find('first', $options);
                    if(!$name){
                        
                        if(!empty($this->request->data['Marketplace']['image']['name'])){
					$pathpart=pathinfo($this->request->data['Marketplace']['image']['name']);
					$ext=$pathpart['extension'];
					$extensionValid = array('jpg','jpeg','png','gif');
					if(in_array(strtolower($ext),$extensionValid)){
					$uploadFolder = "img/marketplace_img";
					$uploadPath = WWW_ROOT . $uploadFolder;	
					$filename =uniqid().'.'.$ext;
					$full_flg_path = $uploadPath . '/' . $filename;
					move_uploaded_file($this->request->data['Marketplace']['image']['tmp_name'],$full_flg_path);
					$this->request->data1['MarketplaceImage']['originalpath'] = $filename;
						$this->request->data1['MarketplaceImage']['resizepath'] = $filename;
					}
					else{
					$this->Session->setFlash(__('Invalid image type.'));
					return $this->redirect(array('action' => 'index'));	
					}
					}
                                        else{
                                        $filename='';    
                                        }
					$this->request->data['Marketplace']['post_date']=date('Y-m-d h:m:s');
                            $this->Marketplace->create();
                            if ($this->Marketplace->save($this->request->data)) {
				$this->request->data1['MarketplaceImage']['marketplace_id']=$this->Marketplace->id;
				//pr($this->request->data1);
				//exit;
				$this->MarketplaceImage->save($this->request->data1);
                                    $this->Session->setFlash(__('The Marketplace has been saved.'));
                                    return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The Marketplace could not be saved. Please, try again.'));
                            }
                    } else {
                            $this->Session->setFlash(__('The Marketplace name already exists. Please, try again.'));
                    }
            }
            $this->set(compact('title_for_layout','countries','posts','categories','users'));
	}


	public function admin_addsubcategory($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Sub Marketplace Add';
            if ($this->request->is('post')) {
                    $options = array('conditions' => array('Marketplace.name'  => $this->request->data['Marketplace']['name'], 'Marketplace.parent_id'=>$this->request->data['Marketplace']['parent_id']));
                    $name = $this->Marketplace->find('first', $options);
                    if(!$name){
                            $this->Marketplace->create();
                            if ($this->Marketplace->save($this->request->data)) {
                                    $this->Session->setFlash(__('The sub category has been saved.'));
                                    return $this->redirect(array('action' => 'subposts',$id));
                            } else {
                                    $this->Session->setFlash(__('The sub category could not be saved. Please, try again.'));
                            }
                    } else {
                            $this->Session->setFlash(__('The sub category name already exists. Please, try again.'));
                    }
            }
            $options = array('conditions' => array('Marketplace.id' => $id));
            $categoryname = $this->Marketplace->find('list', $options);
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
            if (!$this->Marketplace->exists($id)) {
                    throw new NotFoundException(__('Invalid category'));
            }
            if ($this->request->is(array('post', 'put'))) {
                    if ($this->Marketplace->save($this->request->data)) {
                            $this->Session->setFlash(__('The category has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                    }
            } else {
                    $options = array('conditions' => array('Marketplace.' . $this->Marketplace->primaryKey => $id));
                    $this->request->data = $this->Marketplace->find('first', $options);
            }
            $users = $this->Marketplace->User->find('list');
            $this->set(compact('users'));
	}

	public function admin_edit($id = null) {
	    $this->loadModel('MarketplaceImage');
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
	     $this->request->data1=array();
	      $countries=$this->Marketplace->Country->find('list',array('fields'=>array('Country.id','Country.name')));
	     	    $users=$this->Marketplace->User->find('list',array('fields'=>array('User.id','User.first_name'),'conditions'=>array('User.is_admin'=>'0')));
	    $categories=$this->Marketplace->Category->find('list',array('fields'=>array('Category.id','Category.category_name')));
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
	    $posts=$this->Marketplace->find('list',array('fields'=>array('Marketplace.id','Marketplace.title'),'conditions' =>array('Marketplace.id <>'=>$id)));
		//echo $id;exit;
            if (!$this->Marketplace->exists($id)) {
                    throw new NotFoundException(__('Invalid category'));
            }
            if ($this->request->is(array('post', 'put'))) {
                    //echo "hello";exit;
                    $options = array('conditions' => array('Marketplace.title'  => $this->request->data['Marketplace']['title'], 'Marketplace.id <>'=>$id));
                    $name = $this->Marketplace->find('first', $options);
                    
                    if(!$name){
                            //echo "hello";exit;
                        
                         if(!empty($this->request->data['Marketplace']['image']['name'])){
					$pathpart=pathinfo($this->request->data['Marketplace']['image']['name']);
					$ext=$pathpart['extension'];
					$extensionValid = array('jpg','jpeg','png','gif');
					if(in_array(strtolower($ext),$extensionValid)){
					$uploadFolder = "img/marketplace_img";
					$uploadPath = WWW_ROOT . $uploadFolder;	
					$filename =uniqid().'.'.$ext;
					$full_flg_path = $uploadPath . '/' . $filename;
					move_uploaded_file($this->request->data['Marketplace']['image']['tmp_name'],$full_flg_path);
					$this->request->data1['MarketplaceImage']['originalpath'] = $filename;
					$this->request->data1['MarketplaceImage']['resizepath'] = $filename;
					$this->request->data1['MarketplaceImage']['id'] =$this->request->data['Marketplace']['marketplaceimage_id'];
					$this->request->data1['MarketplaceImage']['marketplace_id'] =$id;
					$this->MarketplaceImage->save($this->request->data1);
					}
					else{
					$this->Session->setFlash(__('Invalid image type.'));
					return $this->redirect(array('action' => 'index'));	
					}
					}
                                        else
                                        {
                                         //$this->request->data['Marketplace']['image']=$this->request->data['Marketplace']['hide_img'];                                       
                                        }
                        
                        					$this->request->data['Marketplace']['post_date']=date('Y-m-d h:m:s');
                            if ($this->Marketplace->save($this->request->data)) {
                                    $this->Session->setFlash(__('The post has been saved.'));
				    return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The marketplace could not be saved. Please, try again.'));
                            }
                    } else {
                            $this->Session->setFlash(__('The marketplace already exists. Please, try again.'));
                    }
            } else {
                    //echo "hello";exit;
                    $options = array('conditions' => array('Marketplace.' . $this->Marketplace->primaryKey => $id));
                    $this->request->data = $this->Marketplace->find('first', $options);

                    //print_r($this->request->data);
            }
            $this->set(compact('posts','users','categories','countries'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Marketplace->id = $id;
		if (!$this->Marketplace->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Marketplace->delete()) {
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
            $this->Marketplace->id = $id;
            if (!$this->Marketplace->exists()) {
                    throw new NotFoundException(__('Invalid category'));
            }
            $this->request->onlyAllow('post', 'delete');
            if ($this->Marketplace->delete($id)) {
                    $this->Session->setFlash(__('The category has been deleted.'));
            } else {
                    $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
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
		$options = array('Marketplace.id !=' => 0);
		$cats = $this->Marketplace->find('all',array('conditions' => $options));
		$output = '';
		$output .='Marketplace Name, Parent Name, Is Active';
		$output .="\n";
//pr($cats);exit;
		if(!empty($cats))
		{
			foreach($cats as $cat)
			{	
				$isactive = ($cat['Marketplace']['active']==1)?'Yes':'No';
				
				$output .='"'.$cat['Marketplace']['name'].'","'.$cat['Parent']['name'].'","'.$isactive.'"';
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
