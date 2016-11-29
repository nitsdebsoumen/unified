<?php
App::uses('AppController', 'Controller');
/**
 * ShopReviews Controller
 *
 * @property ShopReview $ShopReview
 * @property PaginatorComponent $Paginator
 */
class ShopReviewsController extends AppController {

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
		$this->ShopReview->recursive = 0;
		$this->set('shopReviews', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ShopReview->exists($id)) {
			throw new NotFoundException(__('Invalid shop review'));
		}
		$options = array('conditions' => array('ShopReview.' . $this->ShopReview->primaryKey => $id));
		$this->set('shopReview', $this->ShopReview->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($shop_id = null, $list_id = null) {
		$username = $this->Session->read('username');
		$userid = $this->Session->read('userid');
		if(!isset($userid)){
			$this->redirect('/');
		}
		if ($this->request->is('post')) {
			$this->request->data['ShopReview']['shop_id'] = $shop_id;
			$this->request->data['ShopReview']['list_id'] = $list_id;
			$this->request->data['ShopReview']['user_id'] = $userid;
			$this->request->data['ShopReview']['comment_date'] = date('Y-m-d');
			$this->request->data['ShopReview']['active'] = 1;
			#pr($this->request->data);
			#exit;
			$this->ShopReview->create();
			if ($this->ShopReview->save($this->request->data)) {
				$this->Session->setFlash(__('The shop review has been saved.'));
				return $this->redirect(array('controller' => 'listings', 'action' => 'details', base64_encode($list_id)));
			} else {
				$this->Session->setFlash(__('The shop review could not be saved. Please, try again.'));
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
		if (!$this->ShopReview->exists($id)) {
			throw new NotFoundException(__('Invalid shop review'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ShopReview->save($this->request->data)) {
				$this->Session->setFlash(__('The shop review has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The shop review could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ShopReview.' . $this->ShopReview->primaryKey => $id));
			$this->request->data = $this->ShopReview->find('first', $options);
		}
		$users = $this->ShopReview->User->find('list');
		$shops = $this->ShopReview->Shop->find('list');
		$this->set(compact('users', 'shops'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ShopReview->id = $id;
		if (!$this->ShopReview->exists()) {
			throw new NotFoundException(__('Invalid shop review'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ShopReview->delete()) {
			$this->Session->setFlash(__('The shop review has been deleted.'));
		} else {
			$this->Session->setFlash(__('The shop review could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
