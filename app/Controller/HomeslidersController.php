<?php

App::uses('AppController', 'Controller');

/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 */
class HomeslidersController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Homeslider.id' => 'desc'
        )
    );
    
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Homeslider->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('homesliders', $this->Paginator->paginate());
    }
    
    public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is('post')) {
            if (isset($this->request->data['Homeslider']['image']) && $this->request->data['Homeslider']['image']['name'] != '') {
                $path = $this->request->data['Homeslider']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_HOMESLIDER_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Homeslider']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Homeslider']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Homeslider']['image'] = $imageName;
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            } else {
                $this->request->data['Homeslider']['image'] = $this->request->data['Homeslider']['image'];
            }
            $this->Homeslider->create();
            if ($this->Homeslider->save($this->request->data)) {
                $this->Session->setFlash(__('The Homeslider has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                return $this->redirect(array('action' => 'add'));
                $this->Session->setFlash(__('The Homeslider could not be saved. Please, try again.'));
            }
        }
    }
    
    public function admin_edit($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        if (!$this->Homeslider->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['Homeslider']['image']) && $this->request->data['Homeslider']['image']['name'] != '') {
                $path = $this->request->data['Homeslider']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_HOMESLIDER_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['Homeslider']['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Homeslider']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Homeslider']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Homeslider']['image'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            } else {
                unset($this->request->data['Homeslider']['image']);
            }
            
            if ($this->Homeslider->save($this->request->data)) {
                $this->Session->setFlash(__('The Homeslider has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Homeslider could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('Homeslider.' . $this->Homeslider->primaryKey => $id));
            $this->request->data = $this->Homeslider->find('first', $options);
        }
        
    }
    
    public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Homeslider->id = $id;
        if (!$this->Homeslider->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        $homeslider_row = $this->Homeslider->find('first', array('conditions' => array('Homeslider.id' => $id)));
        $uploadPath = Configure::read('UPLOAD_HOMESLIDER_PATH');
        $OldImg = $homeslider_row['Homeslider']['image'];
        unlink($uploadPath . '/' . $OldImg);
        if ($this->Homeslider->delete()) {
            $this->Session->setFlash(__('The Homeslider has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Homeslider could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}