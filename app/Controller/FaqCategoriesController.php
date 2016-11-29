<?php
App::uses('AppController', 'Controller');
/**
 * FaqCategories Controller
 *
 * @property FaqCategory $FaqCategory
 * @property PaginatorComponent $Paginator
 */
class FaqCategoriesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
public $paginate = array(
        'limit' => 25,
        'order' => array(
            'FaqCategory.id' => 'desc'
        )
    );
/**
 * index method
 *
 * @return void
 */
	

	public function admin_index() {	
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Faq Category List';
            $this->FaqCategory->recursive = 0;
           $faqcategories= $this->Paginator->paginate('FaqCategory', array('FaqCategory.parent_id' => 0));
            //echo '<pre>';print_r($categories);exit;
            //$this->set('categories', $this->Paginator->paginate('FaqCategory', array('FaqCategory.parent_id' => 0)));
            $this->set(compact('title_for_layout','faqcategories'));
	}

	/*public function admin_subcategories($id = null) {
            $userid = $this->Session->read('userid');
            if(!isset($userid) && $userid==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Sub Category List';
            $options = array('conditions' => array('Category.id' => $id));
            $categoryname = $this->Category->find('list', $options);
            if($categoryname){
                    $categoryname = $categoryname[$id];
            } else {
                    $categoryname = '';
            }
            //$this->Category->recursive = 0;
            $this->set('categories', $this->Paginator->paginate('Category', array('Category.parent_id' => $id)));
            $this->set(compact('title_for_layout','categoryname','id'));
	}*/
	
	/*public function admin_exportsub($id = null)
	{
		$userid = $this->Session->read('userid');
		if(!isset($userid) && $userid==''){
		   $this->redirect('/admin');
		}
		$categories = $this->Category->find('all');
		
		$output = '';
		$output .='Name, Status';
		$output .="\n";

		if(!empty($categories))
		{
			foreach($categories as $category)
			{	
				$isactive = ($category['Category']['active']==1?'Active':'Inactive');
			   
				$output .='"'.$category['Category']['name'].'","'.$isactive.'"';
				$output .="\n";
			}
		}
		$filename = "categories".time().".csv";
		header('Content-type: application/csv');
		header('Content-Disposition: attachment; filename='.$filename);
		echo $output;
		exit;
	}*/

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
            $title_for_layout = 'Faq Category View';
            if (!$this->FaqCategory->exists($id)) {
                    throw new NotFoundException(__('Invalid FaqCategory'));
            }
            $options = array('conditions' => array('FaqCategory.' . $this->FaqCategory->primaryKey => $id));
            $category = $this->FaqCategory->find('first', $options);
            #pr($category);
            if($category){
                    $options = array('conditions' => array('FaqCategory.id' => $category['FaqCategory']['parent_id']));
                    $categoryname = $this->FaqCategory->find('list', $options);
                    #pr($categoryname);
                    if($categoryname){
                            $categoryname = $categoryname[$category['FaqCategory']['parent_id']];
                    } else {
                            $categoryname = '';
                    }
            }
            $this->set(compact('title_for_layout','category','categoryname'));
	}

/**
 * add method
 *
 * @return void
 */
	
	public function admin_add() {	
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Faq Category Add';
            if ($this->request->is('post')) {
                    $options = array('conditions' => array('FaqCategory.name'  => $this->request->data['FaqCategory']['name']));
                    $name = $this->FaqCategory->find('first', $options);
                    if(!$name){
                            $this->FaqCategory->create();
                            if ($this->FaqCategory->save($this->request->data)) {
                                    $this->Session->setFlash(__('The Faq Category has been saved.'));
                                    return $this->redirect(array('action' => 'index'));
                            } else {
                                    $this->Session->setFlash(__('The Faq Category could not be saved. Please, try again.'));
                            }
                    } else {
                            $this->Session->setFlash(__('The Faq Category name already exists. Please, try again.'));
                    }
            }
            $this->set(compact('parents','title_for_layout'));
	}


	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	

	public function admin_edit($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
		//echo $id;exit;
            if (!$this->FaqCategory->exists($id)) {
                    throw new NotFoundException(__('Invalid Faq Category'));
            }
            if ($this->request->is(array('post', 'put'))) {
                    //echo "hello";exit;
                    $options = array('conditions' => array('FaqCategory.name'  => $this->request->data['FaqCategory']['name'], 'FaqCategory.id <>'=>$id));
                    $name = $this->FaqCategory->find('first', $options);
                    
                    if(!$name){
                            if ($this->FaqCategory->save($this->request->data)) {
                                    $this->Session->setFlash(__('The Faq Category has been saved.'));
                            } else {
                                    $this->Session->setFlash(__('The Faq Category could not be saved. Please, try again.'));
                            }
                    } else {
                            $this->Session->setFlash(__('The Faq Category already exists. Please, try again.'));
                    }
            } else {
                    //echo "hello";exit;
                    $is_parent=$this->FaqCategory->find('count',array('conditions'=>array('FaqCategory.parent_id'=>0,'FaqCategory.id'=>$id)));
                    $options = array('conditions' => array('FaqCategory.' . $this->FaqCategory->primaryKey => $id));
                    $this->request->data = $this->FaqCategory->find('first', $options);

                    //print_r($this->request->data);
            }
            $this->set(compact('is_parent'));
	}

/**
 * delete method
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
            $this->FaqCategory->id = $id;
            if (!$this->FaqCategory->exists()) {
                    throw new NotFoundException(__('Invalid FaqCategory'));
            }
            $this->request->onlyAllow('post', 'delete');
            $options = array('conditions' => array('FaqCategory.parent_id' => $id));
            $cat = $this->FaqCategory->find('list', $options);
            #pr($cat);
            #exit;
            if($cat){
                    foreach($cat as $k=>$v){
                            $options1 = array('conditions' => array('FaqCategory.parent_id' => $k));
                            $subcat = $this->FaqCategory->find('list', $options1);
                            if($subcat){
                                    foreach($subcat as $k1=>$v1){
                                            $this->FaqCategory->delete($k1);
                                    }
                            }
                            $this->FaqCategory->delete($k);
                    }
            }
            if ($this->FaqCategory->delete($id)) {
                    $this->Session->setFlash(__('The FaqCategory has been deleted.'));
            } else {
                    $this->Session->setFlash(__('The FaqCategory could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
	
	///////////////////////////////AK///////////
	
	//////////////////////////AK///////////////////////
	
}
