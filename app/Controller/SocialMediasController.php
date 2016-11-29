<?php

App::uses('AppController', 'Controller');

/**
 * SocialMedias Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class SocialMediasController extends AppController {

    public $components = array('Paginator', 'Session');

    public function admin_listing() {
        $socialmedias = $this->SocialMedia->find('all');
        #$this->set(compact('sitemaps'));        
        $this->SocialMedia->recursive = 0;
        $this->set('socialmedias', $this->Paginator->paginate());
    }

    public function admin_add() {
        if ($this->request->is('post')) {

            if ($this->request->is('post')) {
                if (isset($this->request->data['SocialMedia']['icon']) && $this->request->data['SocialMedia']['icon']['name'] != '') {
                    $path = $this->request->data['SocialMedia']['icon']['name'];
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if ($ext) {
                        $uploadPath = Configure::read('UPLOAD_SOCIALMEDIA_PATH');
                        $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                        if (in_array($ext, $extensionValid)) {
                            $imageName = rand() . '_' . (strtolower(trim($this->request->data['SocialMedia']['icon']['name'])));
                            $full_image_path = $uploadPath . '/' . $imageName;
                            move_uploaded_file($this->request->data['SocialMedia']['icon']['tmp_name'], $full_image_path);
                            $this->request->data['SocialMedia']['icon'] = $imageName;
                        } else {
                            $this->Session->setFlash(__('Invalid Image Type.'));
                            return $this->redirect(array('action' => 'edit', $id));
                        }
                    }
                } else {
                    $this->request->data['SocialMedia']['icon'] = $this->request->data['SocialMedia']['icon'];
                }

                $this->SocialMedia->create();
                if ($this->SocialMedia->save($this->request->data)) {
                    $this->Session->setFlash(__('The SocialMedia has been saved.'));
                    return $this->redirect(array('action' => 'listing'));
                } else {
                    return $this->redirect(array('action' => 'add'));
                    $this->Session->setFlash(__('The Banner could not be saved. Please, try again.'));
                }
            }
        }
    }

    public function admin_edit($id = null) {

        if ($this->request->is(array('post', 'put'))) {
            
            if (isset($this->request->data['SocialMedia']['icon']) && $this->request->data['SocialMedia']['icon']['name'] != '') {
                    $path = $this->request->data['SocialMedia']['icon']['name'];
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if ($ext) {
                        $uploadPath = Configure::read('UPLOAD_SOCIALMEDIA_PATH');
                        $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                        if (in_array($ext, $extensionValid)) {
                            $imageName = rand() . '_' . (strtolower(trim($this->request->data['SocialMedia']['icon']['name'])));
                            $full_image_path = $uploadPath . '/' . $imageName;
                            move_uploaded_file($this->request->data['SocialMedia']['icon']['tmp_name'], $full_image_path);
                            $this->request->data['SocialMedia']['icon'] = $imageName;
                        } else {
                            $this->Session->setFlash(__('Invalid Image Type.'));
                            return $this->redirect(array('action' => 'edit', $id));
                        }
                    }
                } else {
                    unset($this->request->data['SocialMedia']['icon']);
                }
            
            if ($this->SocialMedia->save($this->request->data)) {
                $this->Session->setFlash(__('New post saved successfully to the database'));
                return $this->redirect(array('action' => 'listing'));
            } else {

                $this->Session->setFlash('Unable to add user. Please, try again.');
            }
        } else {
            $options = array('conditions' => array('SocialMedia.id' => $id));
            $this->request->data = $this->SocialMedia->find('first', $options);
        }
    }

    public function admin_delete($id = null) {
        $this->SocialMedia->id = $id;
        $this->request->onlyAllow('post', 'delete');
        if ($this->SocialMedia->delete()) {
            $this->Session->setFlash(__('The product has been deleted.'));
        } else {
            $this->Session->setFlash(__('The product could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'listing'));
    }

}
