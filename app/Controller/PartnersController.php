<?php
App::uses('AppController', 'Controller');

/**
 * Partners Controller
 */
class PartnersController extends AppController {
    
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Partner.id' => 'desc'
        )
    );
    
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Partner->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('partners', $this->Paginator->paginate());
    }
    
    public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is('post')) {
            if (isset($this->request->data['Partner']['image']) && $this->request->data['Partner']['image']['name'] != '') {
                $path = $this->request->data['Partner']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_PARTNER_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Partner']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Partner']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Partner']['image'] = $imageName;
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'add', $id));
                    }
                }
            }
            
            $this->Partner->create();
            if ($this->Partner->save($this->request->data)) {
                $this->Session->setFlash(__('The Partner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                return $this->redirect(array('action' => 'add'));
                $this->Session->setFlash(__('The Banner could not be saved. Please, try again.'));
            }
        }
    } 
    
    public function admin_edit($id = NULL) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if (!$this->Partner->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['Partner']['image']) && $this->request->data['Partner']['image']['name'] != '') {
                $path = $this->request->data['Partner']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_PARTNER_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['Partner']['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Partner']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Partner']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Partner']['image'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            }
            
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash(__('The Partner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Partner could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('Partner.' . $this->Partner->primaryKey => $id));
            $this->request->data = $this->Partner->find('first', $options);
        }
    }
    
    public function admin_delete($id = NULL) { 
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Partner->id = $id;
        if (!$this->Partner->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        $banner_row = $this->Partner->find('first', array('conditions' => array('Partner.id' => $id)));
        $uploadPath = Configure::read('UPLOAD_PARTNER_PATH');
        $OldImg = $banner_row['Partner']['image'];
        unlink($uploadPath . '/' . $OldImg);
        if ($this->Partner->delete()) {
            
            $this->Session->setFlash(__('The Partner has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Partner could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
    
    public function ajax_signup() {
        $data = array();
        
        if($this->request->is('ajax')) {
            $this->loadModel('User');
                        
            $fullName   = $this->request->data['fullName'];
            $password   = $this->request->data['password'];
            $email      = $this->request->data['email'];
            $admin_type = $this->request->data['admin_type'];
            
            $fullName = explode(' ', $fullName);
            $lastname = end($fullName);
            array_pop($fullName);
            $firstname = implode( ' ', $fullName);
            
            
            $emailexists = $this->User->find('first', array('conditions' => array('User.email_address' => $email)));
            
            if (!empty($emailexists)) {
                $data['ack'] = '0';
                $data['msg'] = 'Email already exists';
            } else {
                $this->request->data['User']['first_name']      = $firstname;
                $this->request->data['User']['last_name']       = $lastname;
                $this->request->data['User']['email_address']   = $email;
                $this->request->data['User']['user_pass']       = md5($password);
                $this->request->data['User']['admin_type']      = $admin_type;

                $this->User->create();
                if($this->User->save($this->request->data)) {
                    $data['ack'] = '1';
                    $data['msg'] = 'You have successfully register to our website.';
                } else {
                    $data['ack'] = '0';
                    $data['msg'] = 'Insert error.';
                }
            }
        }
        
        echo json_encode($data);        
        die();
    }
}