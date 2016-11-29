<?php

App::uses('AppController', 'Controller');

/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 */
class FaqsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    public $uses = array('Faq','Faqcategory');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Faq.id' => 'desc'
        )
    );

    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Faq->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('faqs', $this->Paginator->paginate());
    }

    
    public function admin_view($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if (!$this->Faq->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
        $this->set('faq', $this->Faq->find('first', $options));
    }
    
    public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $categories = $this->Faq->Faqcategory->find('list');
        $this->set(compact('categories'));
        if ($this->request->is('post')) {
            $this->Faq->create();
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash(__('The Faq has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                return $this->redirect(array('action' => 'add'));
                $this->Session->setFlash(__('The Faq could not be saved. Please, try again.'));
            }
        }
    }

    public function admin_edit($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        //$this->loadModel('FaqCategory');
        if (!$this->Faq->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        
        $categories = $this->Faq->Faqcategory->find('list');
        $this->set(compact('categories'));
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Faq->save($this->request->data)) {
                $this->Session->setFlash(__('The Faq has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Faq could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('Faq.' . $this->Faq->primaryKey => $id));
            $this->request->data = $this->Faq->find('first', $options);
            //$faqcategories = $this->FaqCategory->find('all');
        }
        $this->set(compact('users', 'faqcategories'));
    }

    public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Faq->id = $id;
        if (!$this->Faq->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->Faq->delete()) {
            $this->Session->setFlash(__('The Faq has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Faq could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function admin_categories() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        //$this->loadModel('Faqcategory');
        $faqcategories = $this->Faqcategory->find('all');
        $this->set('faqcategories', $faqcategories);
    }
    
    public function admin_addcategory() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        //$this->loadModel('Faqcategory');
       
        if ($this->request->is('post')) {
            $this->Faqcategory->create();
            if ($this->Faqcategory->save($this->request->data)) {
                $this->Session->setFlash(__('The Faq has been saved.'));
                return $this->redirect(array('action' => 'categories'));
            } else {
                return $this->redirect(array('action' => 'addcategory'));
                $this->Session->setFlash(__('The Faq could not be saved. Please, try again.'));
            }
        }
    }
    
    public function admin_editcategory($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        //$this->loadModel('Faqcategory');
        if (!$this->Faqcategory->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Faqcategory->save($this->request->data)) {
                $this->Session->setFlash(__('The Faq has been saved.'));
                return $this->redirect(array('action' => 'categories'));
            } else {
                $this->Session->setFlash(__('The Faq could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('Faqcategory.' . $this->Faqcategory->primaryKey => $id));
            $this->request->data = $this->Faqcategory->find('first', $options);
            //$faqcategories = $this->FaqCategory->find('all');
        }
        $this->set(compact('faqcategory'));
    }
    
    public function admin_deletecategory($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Faqcategory->id = $id;
        if (!$this->Faqcategory->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->Faqcategory->delete()) {
            $this->Session->setFlash(__('The Faq has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Faq could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'categories'));
    }
}
