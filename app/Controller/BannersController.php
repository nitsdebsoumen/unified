<?php

App::uses('AppController', 'Controller');

/**
 * Faqs Controller
 *
 * @property Faq $Faq
 * @property PaginatorComponent $Paginator
 */
class BannersController extends AppController {
    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Banner.id' => 'desc'
        )
    );
    
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Banner->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('banners', $this->Paginator->paginate());
    }
    
    public function admin_add() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is('post')) {
            if (isset($this->request->data['Banner']['image']) && $this->request->data['Banner']['image']['name'] != '') {
                $path = $this->request->data['Banner']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_BANNER_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Banner']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Banner']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Banner']['image'] = $imageName;
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            } else {
                $this->request->data['Banner']['image'] = $this->request->data['Banner']['image'];
            }
            $this->Banner->create();
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash(__('The Banner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                return $this->redirect(array('action' => 'add'));
                $this->Session->setFlash(__('The Banner could not be saved. Please, try again.'));
            }
        }
    }
    
    public function admin_edit($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        //$this->loadModel('FaqCategory');
        if (!$this->Banner->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['Banner']['image']) && $this->request->data['Banner']['image']['name'] != '') {
                $path = $this->request->data['Banner']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_BANNER_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['Banner']['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Banner']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Banner']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Banner']['image'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            } else {
                unset($this->request->data['Banner']['image']);
            }
            
            if ($this->Banner->save($this->request->data)) {
                $this->Session->setFlash(__('The Banner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Banner could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('Banner.' . $this->Banner->primaryKey => $id));
            $this->request->data = $this->Banner->find('first', $options);
        }
        //$this->set(compact('banners'));
        
    }
    
    public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Banner->id = $id;
        if (!$this->Banner->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        $banner_row = $this->Banner->find('first', array('conditions' => array('Banner.id' => $id)));
        $uploadPath = Configure::read('UPLOAD_BANNER_PATH');
        $OldImg = $banner_row['Banner']['image'];
        unlink($uploadPath . '/' . $OldImg);
        if ($this->Banner->delete()) {
            
            $this->Session->setFlash(__('The Banner has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Banner could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}