<?php

App::uses('AppController', 'Controller');

/**
 * Languages Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class LanguagesController extends AppController {

    public $components = array('Paginator', 'Session');

    public function admin_listing() {
        $languages = $this->Language->find('all');
        #$this->set(compact('sitemaps'));        
        $this->Language->recursive = 0;
        $this->set('languages', $this->Paginator->paginate());
    }

    public function admin_add() {
        if ($this->request->is('post')) {

            if ($this->Language->save($this->request->data)) {
                $this->Session->setFlash(__('New post saved successfully to the database'));
                return $this->redirect(array('action' => 'listing'));
            } else {

                $this->Session->setFlash('Unable to add user. Please, try again.');
            }
        }
    }

    public function admin_edit($id = null) {

        if ($this->request->is(array('post', 'put'))) {

            if ($this->Language->save($this->request->data)) {
                $this->Session->setFlash(__('New post saved successfully to the database'));
                return $this->redirect(array('action' => 'listing'));
            } else {

                $this->Session->setFlash('Unable to add user. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('Language.id' => $id));
            $this->request->data = $this->Language->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        $this->Language->id = $id;
        $this->request->onlyAllow('post', 'delete');
        if ($this->Language->delete()) {
            $this->Session->setFlash(__('The product has been deleted.'));
        } else {
            $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'listing'));
    }

}
