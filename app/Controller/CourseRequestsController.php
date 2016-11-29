<?php

App::uses('AppController', 'Controller');

class CourseRequestsController extends AppController {
    
    public $components = array('Paginator');
    public $uses = array('CourseRequest', 'User', 'Post');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'CourseRequest.id' => 'desc'
        )
    );
    
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->CourseRequest->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('courseRequests', $this->Paginator->paginate());
    }
    
    public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->CourseRequest->id = $id;
        if (!$this->CourseRequest->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->CourseRequest->delete()) {
            $this->Session->setFlash(__('The Course Request has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Course Request could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function admin_approve($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid Course Request'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            if($this->Post->saveField('is_show_home_page', '1')) {
                $this->Session->setFlash(__('The Course will show on homepage.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Course could not be saved. Please, try again.'));
            }
        }
        $this->set(compact('CourseRequest'));
    }    
    
    
}