<?php

App::uses('AppController', 'Controller');

/**
 * Newsletters Controller
 *
 * @property Newsletter $Newsletter
 * @property PaginatorComponent $Paginator
 */
class NewslettersController extends AppController {

    public $components = array('Paginator', 'Session');
    
    

    public function admin_index() {
        
        if ($this->request->is('post')) {
            $mails = explode(',', $this->request->data['to']);
            $subject = $this->request->data['subject'];
            $body = $this->request->data['message'];
            foreach($mails as $mail_id) {
                $this->send_mail('ladder@ladder.com', $mail_id, $subject, $body);
            }
        }
        
        $newsletters = $this->Newsletter->find('all');
        #$this->set(compact('sitemaps'));        
        $this->Newsletter->recursive = 0;
        $this->set('newsletters', $this->Paginator->paginate());
    }

    public function admin_add() {
        if ($this->request->is('post')) {
            $email = array();
            $check = $this->Newsletter->find('all', array('fields' => array('Newsletter.email')));
            foreach ($check as $key => $value) {
                $email[] = $value['Newsletter']['email'];
            }


            if (!in_array($this->request->data['Newsletter']['email'], $email)) {

                if ($this->Newsletter->save($this->request->data)) {
                    $this->Session->setFlash(__('New post saved successfully to the database'));
                    return $this->redirect(array('action' => 'index'));
                } else {

                    $this->Session->setFlash('Unable to add user. Please, try again.');
                }
            } else {
                $this->Session->setFlash('This Email ID is already exists. Please, give new Email ID.');
            }
        }
    }

    public function admin_edit($id = null) {

        if ($this->request->is(array('post', 'put'))) {
            $email = array();
            $check = $this->Newsletter->find('all', array('fields' => array('Newsletter.email')));
            foreach ($check as $key => $value) {
                $email[] = $value['Newsletter']['email'];
            }


            if (!in_array($this->request->data['Newsletter']['email'], $email)) {

                if ($this->Newsletter->save($this->request->data)) {
                    $this->Session->setFlash(__('New post saved successfully to the database'));
                    return $this->redirect(array('action' => 'index'));
                } else {

                    $this->Session->setFlash('Unable to add user. Please, try again.');
                }
            } else {
                $this->Session->setFlash('This Email ID is already exists. Please, give new Email ID.');
            }
        } else {
            $options = array('conditions' => array('Newsletter.id' => $id));
            $this->request->data = $this->Newsletter->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        $this->Newsletter->id = $id;
        $this->request->onlyAllow('post', 'delete');
        if ($this->Newsletter->delete()) {
            $this->Session->setFlash(__('The product has been deleted.'));
        } else {
            $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
