<?php
App::uses('AppController', 'Controller');

/**
 * Trainingproviders Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class CorporateusersController extends AppController {
    
    public $components = array('Paginator');
    
    public function admin_index() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Training Provider List';
        
        $this->loadModel('User');
        
        $options = array('conditions' => array('User.is_admin !=' => 1, 'User.admin_type' => 3), 'order' => array('User.id' => 'desc'));
        
        $this->Paginator->settings = $options;
        $this->set('users', $this->Paginator->paginate('User'));
    }
    
    public function admin_add() {
        $this->loadModel('UserImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('User');
        $countries = $this->User->Country->find('list');
        $this->request->data1 = array();
        $title_for_layout = 'User Add';
        $this->set(compact('title_for_layout', 'countries'));
        if ($this->request->is('post')) {
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email_address']));
            $emailexists = $this->User->find('first', $options);
            if (!$emailexists) {
                if (!empty($this->request->data['User']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['User']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "user_images/";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['User']['image']['tmp_name'], $full_flg_path);
                        $this->request->data1['UserImage']['originalpath'] = $filename;
                        $this->request->data1['UserImage']['resizepath'] = $filename;
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                    }
                } else {
                    $filename = '';
                }
                $this->request->data['User']['user_pass'] = md5($this->request->data['User']['user_pass']);
                $this->request->data['User']['member_since'] = date('Y-m-d h:m:s');
                $this->User->create();
                #pr($this->data);
                #exit;
                if ($this->User->save($this->request->data)) {
                    $this->request->data1['UserImage']['user_id'] = $this->User->id;
                    $this->UserImage->save($this->request->data1);
                    $this->Session->setFlash(__('The user has been saved.', 'default', array('class' => 'success')));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.', 'default', array('class' => 'error')));
                }
            } else {
                $this->Session->setFlash(__('Email already exists. Please, try another.', 'default', array('class' => 'error')));
            }
        }
    }
    
    public function admin_edit($id = NULL) {
        
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('UserImage');
        $this->loadModel('User');
        $this->request->data1 = array();
        $title_for_layout = 'User Edit';
        $this->set(compact('title_for_layout'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data['User']['image']['name'])) {
                $pathpart = pathinfo($this->request->data['User']['image']['name']);
                $ext = $pathpart['extension'];
                $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array(strtolower($ext), $extensionValid)) {
                    $uploadFolder = "user_images/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid() . '.' . $ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['User']['image']['tmp_name'], $full_flg_path);
                    $this->request->data1['UserImage']['originalpath'] = $filename;
                    $this->request->data1['UserImage']['resizepath'] = $filename;
                    if (isset($this->request->data['User']['userimage_id']) && $this->request->data['User']['userimage_id'] != '') {
                        $this->request->data1['UserImage']['id'] = $this->request->data['User']['userimage_id'];
                    }
                    $this->request->data1['UserImage']['user_id'] = $id;
                    //pr($this->request->data1);
                    //exit;
                    $this->UserImage->save($this->request->data1);
                } else {
                    $this->Session->setFlash(__('Invalid image type.'));
                }
            } else {
                $filename = '';
            }

            if (isset($this->request->data['User']['user_pass']) && $this->request->data['User']['user_pass'] != '') {
                //$this->request->data['User']['txt_password'] = $this->request->data['User']['user_pass'];
                $this->request->data['User']['user_pass'] = md5($this->request->data['User']['user_pass']);
            } else {
                $this->request->data['User']['user_pass'] = $this->request->data['User']['hidpw'];
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'list'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
        
        $roles = $this->User->Role->find('list', array('Adminrole.id', 'Adminrole.name'));
        $countries = $this->User->Country->find('list');
        $this->set(compact('roles', 'countries'));
    }
    
    public function admin_view($id = NULL) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->loadModel('User');
        
        $title_for_layout = 'User View';
        $this->set(compact('title_for_layout'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }
    
    public function admin_delete($id = null) {
        
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('User');
        $this->loadModel('UserImage');
        
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            //$this->UserImage->delete()
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}