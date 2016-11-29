<?php

App::uses('AppController', 'Controller');

/**
 * Venues Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class VenuesController extends AppController {

    var $uses = array('Post', 'User', 'Event', 'Venue');
    public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Venue.id' => 'desc'
        )
    );

    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }

        $this->Venue->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('venues', $this->Paginator->paginate('Venue'));
    }

    public function admin_add($id = NULL) {
        $user_id = base64_decode($id);
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if($this->request->is('post')) {
            $this->Venue->create();
            if($this->Venue->save($this->request->data)) {

                foreach ($this->request->data['Venue']['image'] as $key => $img) {
                                    
                            if($img['error'] == 0)
                            {
                                $uploadFolder = Configure::read('UPLOAD_VENUE_IMAGE');
                                $ext = explode('.', $img['name']);
                                $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf', 'txt');

                                if (in_array(end($ext), $extensionValid)) {
                                    $filename = uniqid() . $img['name'];
                                    $uploadPath = $uploadFolder . $filename;
                                    move_uploaded_file($img['tmp_name'], $uploadPath);
                                    $data['image'] = $filename;
                                    $data['venue_id'] = $last_id;
                                    $this->loadModel('VenueImage');
                                    $this->VenueImage->create();
                                    $this->VenueImage->save($data);
                                } else {
                                    unset($this->request->data['Venue']['image']);
                                    $this->Flash->error(__('Invalid image extension. Please, try again.'));
                                }
                                
                            }
                            else 
                            {
                                unset($this->request->data['Venue']['image']);
                            }
                        }

                $this->Session->setFlash('Vanue successfully added.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Venue add failed.', 'default', array('class' => 'error'));
            }
        }
        if($user_id!=''){

        $this->loadModel('User');
        $user_company = $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));
        $this->set('user_company',$user_company);
        }
        else{
            $user_company='';
            $this->set('user_company',$user_company);  
        }
        $this->loadModel('CompanyDetail');
        $this->CompanyDetail->recursive = 2;
        $company_list = $this->CompanyDetail->find('all', array('fields' => array('CompanyDetail.user_id', 'CompanyDetail.company_name'),'conditions'=>array('User.admin_type'=>1)));
        
        $users = $this->User->find('all',array('conditions'=>array('User.admin_type'=>'1')));
        $posts = $this->Venue->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        $events = $this->Venue->Event->find('list',array('fields'=>array('id','event_name')));
        $facilities = $this->Venue->Facility->find('list',array('fields'=>array('id','facility_name')));
        $this->set(compact('users', 'posts', 'events','company_list','facilities'));
    }

    public function index() {
        $details = $this->Session->read('userid');
        if (empty($details)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        } else {
            $all_venue = $this->Venue->find('all',array('conditions'=>array('User.id'=> $details)));

            $this->set(compact('all_venue'));
        }
    }

    public function venue_add() {
        $details = $this->Session->read('userid');
        if (empty($details)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        } else {
            $user_id = $this->Session->read('userid');
            $course = $this->Post->find('list', array('conditions' => array('Post.user_id' => $user_id),
                'recursive' => -1,
                'contain' => false,
                'fields' => array('Post.id', 'Post.post_title')));
            //$event = $this->Event->find('list', array('fields' => array('Event.id', 'Event.event_name')));
            $option = array('conditions' => array('User.id' => $user_id));
            $userdetails = $this->User->find('first', $option);

            $this->Venue->recursive = 2;
            $venue = $this->Venue->find('all');
            //pr($venue); exit;
            $events = $this->Venue->Event->find('list',array('fields'=>array('id','event_name')));
            $facilities = $this->Venue->Facility->find('list',array('fields'=>array('id','facility_name')));
            $this->set(compact('user_id', 'course', 'userdetails','events','facilities'));

            if ($this->request->is('post')) {

                $this->Venue->create();
                if ($this->Venue->save($this->request->data)) {

                    $last_id = $this->Venue->getLastInsertId();
                    $data=array();
                    if(!empty($this->request->data['Venue']['image'] ))
                    {
                        foreach ($this->request->data['Venue']['image'] as $key => $img) {
                                    
                            if($img['error'] == 0)
                            {
                                $uploadFolder = Configure::read('UPLOAD_VENUE_IMAGE');
                                $ext = explode('.', $img['name']);
                                $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf', 'txt');

                                if (in_array(end($ext), $extensionValid)) {
                                    $filename = uniqid() . $img['name'];
                                    $uploadPath = $uploadFolder . $filename;
                                    move_uploaded_file($img['tmp_name'], $uploadPath);
                                    $data['image'] = $filename;
                                    $data['venue_id'] = $last_id;
                                    $this->loadModel('VenueImage');
                                    $this->VenueImage->create();
                                    $this->VenueImage->save($data);
                                } else {
                                    unset($this->request->data['Venue']['image']);
                                    $this->Flash->error(__('Invalid image extension. Please, try again.'));
                                }
                                
                            }
                            else 
                            {
                                unset($this->request->data['Venue']['image']);
                            }
                        }
                    }   

                    $this->Session->setFlash(__('New venue is added', 'default', array('class' => 'success')));
                    return $this->redirect(array('action' => 'venue_add'));
                } else {

                    $this->Session->setFlash('Unable to add venue. Please, try again.');
                }
            }
        }
    }

    public function venue_csv_upload() {
        $userid = $this->Session->read('userid');
        if(!isset($userid) || $userid == '') {
            $this->redirect('/users/login');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $ret = $this->Venue->csvImport($this->request->data['csv']['tmp_name'], $userid);
            if (empty($ret['errors'])) {
                $this->Session->setFlash($ret['messages'], 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlash($ret['errors'], 'default', array('class' => 'error')); 
                return $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function admin_delete($id = NULL){
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
            $this->Venue->id = $id;
        if (!$this->Venue->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Venue->delete($id)) {
            $this->Session->setFlash(__('The Venue has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Venue could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

}
