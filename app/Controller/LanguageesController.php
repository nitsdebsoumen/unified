<?php
App::uses('AppController', 'Controller');
/**
 * Languagees Controller
 *
 * @property Languagee $Languagee
 * @property PaginatorComponent $Paginator
 */
class LanguageesController extends AppController {

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
		$this->Languagee->recursive = 0;
		$this->set('languagees', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Languagee->exists($id)) {
			throw new NotFoundException(__('Invalid languagee'));
		}
		$options = array('conditions' => array('Languagee.' . $this->Languagee->primaryKey => $id));
		$this->set('languagee', $this->Languagee->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Languagee->create();
			if ($this->Languagee->save($this->request->data)) {
				$this->Session->setFlash(__('The languagee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The languagee could not be saved. Please, try again.'));
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
		if (!$this->Languagee->exists($id)) {
			throw new NotFoundException(__('Invalid languagee'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Languagee->save($this->request->data)) {
				$this->Session->setFlash(__('The languagee has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The languagee could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Languagee.' . $this->Languagee->primaryKey => $id));
			$this->request->data = $this->Languagee->find('first', $options);
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
		$this->Languagee->id = $id;
		if (!$this->Languagee->exists()) {
			throw new NotFoundException(__('Invalid languagee'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Languagee->delete()) {
			$this->Session->setFlash(__('The languagee has been deleted.'));
		} else {
			$this->Session->setFlash(__('The languagee could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
