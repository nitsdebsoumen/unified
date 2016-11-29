<?php

App::uses('AppController', 'Controller');

class SkillsController extends AppController {

    public $components = array('Paginator');

    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        //$skills = $this->Skill->find('all');
        $this->Skill->recursive = 1;
        $this->set('skills', $this->Paginator->paginate('Skill'));
        //$this->set(compact('skills'));
    }
    
    public function admin_add($user_id = null) {

        $userid = $this->Session->read('adminuserid');
        if ($userid == '') {
            return $this->redirect(array('controller' => 'users', 'action' => '/', 'admin' => true));
        }
        
        $title_for_layout = 'Skills Add';
        
        if ($this->request->is(array('post', 'put'))) {
            
            if (isset($this->request->data['Skill']['image']) && $this->request->data['Skill']['image']['name'] != '') {
                $path = $this->request->data['Skill']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_SKILL_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Skill']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Skill']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Skill']['image'] = $imageName;
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                    }
                }
            }
                
            $this->Skill->create();
            if ($this->Skill->save($this->request->data)) {

                $this->Session->setFlash('The skill has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The skill could not be saved.'));
            }
        }

        $this->set(compact('title'));
    }
    
    public function admin_edit($id = NULL) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        //$this->loadModel('FaqCategory');
        if (!$this->Skill->exists($id)) {
            throw new NotFoundException(__('Invalid Faq'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->request->data['Skill']['image']) && $this->request->data['Skill']['image']['name'] != '') {
                $path = $this->request->data['Skill']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_SKILL_PATH');
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['Skill']['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Skill']['image']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Skill']['image']['tmp_name'], $full_image_path);
                        $this->request->data['Skill']['image'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            }
            
            if ($this->Skill->save($this->request->data)) {
                $this->Session->setFlash(__('The Banner has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Banner could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Skill.' . $this->Skill->primaryKey => $id));
            $this->request->data = $this->Skill->find('first', $options);
        }
        
    }
    
    public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Skill->id = $id;
        if (!$this->Skill->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        $banner_row = $this->Skill->find('first', array('conditions' => array('Skill.id' => $id)));
        $uploadPath = Configure::read('UPLOAD_SKILL_PATH');
        $OldImg = $banner_row['Skill']['image'];
        unlink($uploadPath . '/' . $OldImg);
        if ($this->Skill->delete()) {
            
            $this->Session->setFlash(__('The Banner has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Banner could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
