<?php
App::uses('AppController', 'Controller');

/**
 * Trainingproviders Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class VenueprovidersController extends AppController {
    
    public $components = array('Paginator');
    
    public function admin_index() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Training Provider List';
        
        $this->loadModel('User');
        
        $options = array('conditions' => array('User.is_admin !=' => 1, 'User.admin_type' => 1), 'order' => array('User.id' => 'desc'),'group' => array('User.id'));
        
        $this->Paginator->settings = $options;
        $users = $this->Paginator->paginate('User');
        
        $this->set(compact('users'));
    }
    
    public function admin_add() {
        $this->loadModel('UserImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('User');
        $this->loadModel('Country');
        $this->loadModel('Lga');
        $this->loadModel('CompanyDetail');
        $countries = $this->User->Country->find('list');
        $listCountry = $this->Country->find('list');
        $lgas = $this->Lga->find('list', array('fields' => array('Lga.id', 'Lga.local_name'),'order' => array(
          'Lga.local_name' => 'asc'
        )));
        $this->request->data1 = array();
        $title_for_layout = 'User Add';
        $this->set(compact('title_for_layout', 'countries', 'listCountry', 'lgas'));
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

                        if (isset($this->request->data['CompanyDetail']['logo']['name']) && $this->request->data['CompanyDetail']['logo']['name'] != '') {
                            $path = $this->request->data['CompanyDetail']['logo']['name'];
                            $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                            if ($ext) {
                                $uploadPath = Configure::read('UPLOAD_COMPANY_LOGO_PATH');
                                $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                                if (in_array($ext, $extensionValid)) {
                                    $OldImg = $this->request->data['CompanyDetail']['image'];
                                    $imageName = rand() . '_' . (strtolower(trim($this->request->data['CompanyDetail']['logo']['name'])));
                                    $full_image_path = $uploadPath . '/' . $imageName;
                                    move_uploaded_file($this->request->data['CompanyDetail']['logo']['tmp_name'], $full_image_path);
                                    $this->request->data['CompanyDetail']['logo'] = $imageName;
                                    if ($OldImg != '') {
                                        unlink($uploadPath . '/' . $OldImg);
                                    }
                                } else {
                                    $this->Session->setFlash(__('Invalid Image Type.'));
                                    return $this->redirect('/users/provider_dashboard/edit_company_details');
                                }
                            }
                        } else {
                            unset($this->request->data['CompanyDetail']['logo']);
                        }

                        $this->request->data['CompanyDetail']['user_id'] = $this->User->id;    
                        $this->CompanyDetail->save($this->request->data['CompanyDetail']);

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
                return $this->redirect(array('action' => 'index'));
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
        $this->loadModel('Venue');
        
        $title_for_layout = 'User View';
        $this->set(compact('title_for_layout'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $user = $this->User->find('first', $options);
        $paginate = array(
        'limit' => 25,
        'order' => array(
            'Venue.id' => 'desc'
          ),
        'conditions'=>array('Venue.user_id' => $id)
        );
        $this->Paginator->settings = $paginate;
        $venues = $this->Paginator->paginate('Venue');
        $this->set(compact('user','venues'));
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