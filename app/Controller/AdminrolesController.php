<?php
App::uses('AppController', 'Controller');

class AdminrolesController extends AppController {
    
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Adminrole.id' => 'asc'
        )
    );
    
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Adminrole->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('adminroles', $this->Paginator->paginate());
    }
    
    public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is('post')) {
            $this->Adminrole->create();
            if ($this->Adminrole->save($this->request->data)) {
                $this->Session->setFlash(__('The Adminrole has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                return $this->redirect(array('action' => 'add'));
                $this->Session->setFlash(__('The Adminrole could not be saved. Please, try again.'));
            }
        }
    }
    
    public function admin_edit($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if (!$this->Adminrole->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Adminrole->save($this->request->data)) {
                $this->Session->setFlash(__('The Adminrole has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Adminrole could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('Adminrole.' . $this->Adminrole->primaryKey => $id));
            $this->request->data = $this->Adminrole->find('first', $options);
        }        
    }
    
    public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Adminrole->id = $id;
        if (!$this->Adminrole->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        
        if ($this->Adminrole->delete()) {
            
            $this->Session->setFlash(__('The Adminrole has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Adminrole could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function admin_privilege() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Adminrole->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('adminroles', $this->Paginator->paginate());
    }
    
    public function admin_setprivilege($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if (!$this->Adminrole->exists($id)) {
            throw new NotFoundException(__('Invalid Admin Role'));
        }
        
        $this->loadModel('Adminrolemeta');
        
        if ($this->request->is('post')) {
            $this->Adminrolemeta->deleteAll(array('Adminrolemeta.roleid' => $id), false);
            
            foreach ($this->request->data['Adminrolemeta']['meta_key'] as $k => $v) {
                if($v != '') {
                    
                    $role['Adminrolemeta']['roleid'] = $id;
                    $role['Adminrolemeta']['meta_key'] = $v;
                    $role['Adminrolemeta']['meta_value'] = 1;

                    $this->Adminrolemeta->create();
                    $this->Adminrolemeta->save($role);
                }
            }
            return $this->redirect(array('action' => 'privilege'));
        }
        $options = array('conditions' => array('Adminrole.' . $this->Adminrole->primaryKey => $id));
        $adminrole = $this->Adminrole->find('first', $options);

        $options_meta = array('conditions' => array('Adminrolemeta.roleid' => $id));
        $adminrolemeta = $this->Adminrolemeta->find('all', $options_meta);
        
        $this->Adminrolemeta->recursive = 0;

        $this->set(compact('adminrole','adminrolemeta'));        
    }
}