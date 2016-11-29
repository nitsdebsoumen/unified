<?php

App::uses('AppController', 'Controller');

/**
 * Settings Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class SettingsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        $this->Setting->recursive = 0;
        $this->set('sitesettings', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid Site Setting'));
        }
        $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
        $this->set('sitesetting', $this->Setting->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Setting->create();
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The site setting has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The site setting could not be saved. Please, try again.'));
            }
        }
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid site setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The site setting has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The site setting could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
    }

    public function admin_edit($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }

        if ($this->request->is(array('post', 'put'))) {
            //pr($this->request->data);
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('The site setting has been saved.'));
                #return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The site setting could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        $this->Setting->id = $id;
        if (!$this->Setting->exists()) {
            throw new NotFoundException(__('Invalid Site Setting'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Setting->delete()) {
            $this->Session->setFlash(__('The site setting has been deleted.'));
        } else {
            $this->Session->setFlash(__('The site setting could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_sitelogo($id = null) {
        $title_for_layout = 'Manage Logo';
        $this->set(compact('title_for_layout'));
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['Setting']['logo']) && $this->request->data['Setting']['logo']['name'] != '') {
                $path = $this->request->data['Setting']['logo']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_USER_LOGO_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['Setting']['hidsite_logo'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Setting']['logo']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Setting']['logo']['tmp_name'], $full_image_path);
                        $this->request->data['Setting']['logo'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            } else {
                $this->request->data['Setting']['logo'] = $this->request->data['Setting']['hidsite_logo'];
            }
            $this->request->data['Setting']['id'] = 1;
            //pr( $this->request->data);
            //exit;
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash('The site logo has been saved.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash(__('The site logo could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
    }

    public function admin_paymentgateway($id = null) {
        $title_for_layout = 'Manage Payment Gateway';
        $this->set(compact('title_for_layout'));
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        if (!$this->Setting->exists($id)) {
            throw new NotFoundException(__('Invalid setting'));
        }
        if ($this->request->is(array('post', 'put'))) {
            //pr($this->request->data);
            if ($this->Setting->save($this->request->data)) {
                $this->Session->setFlash(__('Payment gateway updated successfully.'));
                #return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The payment gateway could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => $id));
            $this->request->data = $this->Setting->find('first', $options);
        }
    }

}
