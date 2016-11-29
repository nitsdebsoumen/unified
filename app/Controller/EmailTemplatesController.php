<?php
App::uses('AppController', 'Controller');
/**
 * EmailTemplates Controller
 *
 * @property EmailTemplate $EmailTemplate
 * @property PaginatorComponent $Paginator
 */
class EmailTemplatesController extends AppController {

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
		$this->EmailTemplate->recursive = 0;
		$this->set('emailTemplates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
		$this->set('emailTemplate', $this->EmailTemplate->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EmailTemplate->create();
			if ($this->EmailTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The email template has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
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
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid email template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailTemplate->save($this->request->data)) {
				$this->Session->setFlash(__('The email template has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
			$this->request->data = $this->EmailTemplate->find('first', $options);
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
		$this->EmailTemplate->id = $id;
		if (!$this->EmailTemplate->exists()) {
			throw new NotFoundException(__('Invalid email template'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmailTemplate->delete()) {
			$this->Session->setFlash(__('The email template has been deleted.'));
		} else {
			$this->Session->setFlash(__('The email template could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

	public function admin_index() {	
            
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
		$title_for_layout = 'EmailTemplate List';
		 $this->paginate = array(
			'order' => array(
				'EmailTemplate.id' => 'asc'
			)
		);
		$this->EmailTemplate->recursive = 0;
		$this->Paginator->settings = $this->paginate;
		$this->set('emailtemplate', $this->Paginator->paginate());
		$this->set(compact('title_for_layout'));
	}

	public function admin_edit($id = null) {
		$userid = $this->Session->read('adminuserid');
		$is_admin = $this->Session->read('is_admin');
                if(!isset($is_admin) && $is_admin==''){
                   $this->redirect('/admin');
                }
		if (!$this->EmailTemplate->exists($id)) {
			throw new NotFoundException(__('Invalid Email Template'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailTemplate->save($this->request->data)) {
				
                $this->Session->setFlash('The email template has been saved.', 'default');

			} else {
				$this->Session->setFlash(__('The email template could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailTemplate.' . $this->EmailTemplate->primaryKey => $id));
			$this->request->data = $this->EmailTemplate->find('first', $options);
		}
	}

	public function ajaxEmailTemplate(){
		 $id = $this->request->data['email_id'];
		 $options = array('conditions' => array('EmailTemplate.id' => $id));
		 $data = $this->EmailTemplate->find('first', $options);
		 if(!empty($data)){
		 	$res['html'] = $data['EmailTemplate']['content'];
		 	$res['Ack'] = 1;
		 }
		 else
		 {
		 	$res['Ack'] = 0;
		 }
		 echo json_encode($res); exit;

	}

}
