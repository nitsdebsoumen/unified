<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class SuggestCategoriesController extends AppController {

    public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');


    public function add()
    {
        
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '')
        {
            $this->Session->setFlash(__('Please login to access profile.', 'default', array('class' => 'error')));
            return $this->redirect(array('action' => 'login'));
        }

        $this->loadModel('Country');
        $countries = $this->Country->find('all');
        //pr($countries); exit;
        $title_for_layout = 'Add Suggested Category';

        if ($this->request->is('post'))
        {       
                //pr($this->request->data); exit;
                $this->SuggestCategory->create();
                if ($this->SuggestCategory->save($this->request->data))
                {
                    $this->Session->setFlash(__('The suggested category has been saved.', 'default', array('class' => 'success')));
                }
                else
                {
                    $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
                }
        }

        $this->set(compact('countries'));
    }

    public function admin_index() {

        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'SuggestCategory List';
        
        $this->loadModel('SuggestCategory');
        $options = array(
            'order' => array(
                'SuggestCategory.id' => 'ASC'
            )
        );

        $this->Paginator->settings = $options;
        
        $this->SuggestCategory->recursive = 0;
        $this->set('contents', $this->Paginator->paginate());
        $this->set(compact('title_for_layout'));
    }

}


?>