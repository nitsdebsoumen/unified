<?php
App::uses('AppController', 'Controller');
/**
 * EmailNotifications Controller
 *
 * @property EmailNotification $EmailNotification
 * @property PaginatorComponent $Paginator
 */
class EmailNotificationsController extends AppController {

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
		$this->EmailNotification->recursive = 0;
		$this->set('emailNotifications', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmailNotification->exists($id)) {
			throw new NotFoundException(__('Invalid email notification'));
		}
		$options = array('conditions' => array('EmailNotification.' . $this->EmailNotification->primaryKey => $id));
		$this->set('emailNotification', $this->EmailNotification->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->EmailNotification->create();
			if ($this->EmailNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The email notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email notification could not be saved. Please, try again.'));
			}
		}
		$users = $this->EmailNotification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EmailNotification->exists($id)) {
			throw new NotFoundException(__('Invalid email notification'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmailNotification->save($this->request->data)) {
				$this->Session->setFlash(__('The email notification has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The email notification could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('EmailNotification.' . $this->EmailNotification->primaryKey => $id));
			$this->request->data = $this->EmailNotification->find('first', $options);
		}
		$users = $this->EmailNotification->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EmailNotification->id = $id;
		if (!$this->EmailNotification->exists()) {
			throw new NotFoundException(__('Invalid email notification'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmailNotification->delete()) {
			$this->Session->setFlash(__('The email notification has been deleted.'));
		} else {
			$this->Session->setFlash(__('The email notification could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
