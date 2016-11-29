<?php

App::uses('AppController', 'Controller');

/**
 * PromoCodes Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class PromoCodesController extends AppController {

    var $uses = array('PromoCode');
    public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'PromoCode.id' => 'desc'
        )
    );

    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }

        $this->PromoCode->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('promocodes', $this->Paginator->paginate('PromoCode'));
    }

    public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if($this->request->is('post')) {
            $this->PromoCode->create();
            if($this->PromoCode->save($this->request->data)) {
                $this->Session->setFlash('Promo Code successfully added.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Promo Code add failed.', 'default', array('class' => 'error'));
            }
        }
    }

    public function admin_edit($id = null) {
        if (!$this->PromoCode->exists($id)) {
            throw new NotFoundException(__('Invalid Promo Code'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PromoCode->save($this->request->data)) {
                $this->Session->setFlash('The Promo Code has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The Promo Code could not be saved. Please, try again.', 'default', array('class' => 'error'));
            }
        } else {
            $options = array('conditions' => array('PromoCode.' . $this->PromoCode->primaryKey => $id));
            $this->request->data = $this->PromoCode->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        $this->PromoCode->id = $id;
        if (!$this->PromoCode->exists()) {
            throw new NotFoundException(__('Invalid Promo Code'));
        }
        $this->request->onlyAllow('post','delete');
        if ($this->PromoCode->delete()) {
            $this->Session->setFlash('The Promo Code has been deleted.','default', array('class' => 'success'));
        } else {
            $this->Session->setFlash('The Promo Code could not be deleted. Please, try again.','default', array('class' => 'error'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_view($id = null) {
        if (!$this->PromoCode->exists($id)) {
            throw new NotFoundException(__('Invalid Promo Code'));
        }
        $options = array('conditions' => array('PromoCode.' . $this->PromoCode->primaryKey => $id));
        $this->set('promocode', $this->PromoCode->find('first', $options));
    }
}    