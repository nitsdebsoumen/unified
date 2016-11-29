<?php

App::uses('AppController', 'Controller');

/**
 * Seos Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class RequestQuotesController extends AppController {

	var $uses = array('User','RequestQuote','Post');
	public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'RequestQuote.id' => 'desc'
        )
    );
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }

        $this->RequestQuote->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('RequestQuotes', $this->Paginator->paginate('RequestQuote'));
    }

	public function admin_add() {
		$is_admin = $this->Session->read('is_admin');
		if (!isset($is_admin) && $is_admin == '') {
			$this->redirect('/admin');
		}

		if($this->request->is('post')) {

			if(!empty($this->request->data['RequestQuote']['quotes']['tmp_name'])) {
				$path = $this->request->data['RequestQuote']['quotes']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if(in_array($ext, array('png','pdf','quotes'))) {
                	$uploadPath = Configure::read('UPLOAD_QUOTE_PATH');
                	$imageName = rand() . '_' . (strtolower(trim($this->request->data['RequestQuote']['quotes']['name'])));
                    $full_image_path = $uploadPath . '/' . $imageName;
                    move_uploaded_file($this->request->data['RequestQuote']['quotes']['tmp_name'], $full_image_path);
                    $this->request->data['RequestQuote']['quotes'] = $imageName;

                    $this->RequestQuote->create();
                    if($this->RequestQuote->save($this->request->data)) {
                    	$this->Session->setFlash('save.', 'default', array('class'=>'success'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                    	$this->Session->setFlash('DB error.', 'default', array('class'=>'error'));
                    }

                }
			} else {
				$this->Session->setFlash('include quotes before submit.');
			}
			// $this->RequestQuote->create();
			// if($this->RequestQuote->save($this->request->data)) {

			// }
		}

		$users  = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
        $posts  = $this->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
		$this->set(compact('users','posts'));
	}

    public function admin_edit($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            if(!empty($this->request->data['RequestQuote']['quotes']['tmp_name'])) {
                $path = $this->request->data['RequestQuote']['quotes']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_QUOTE_PATH');
                    $extensionValid = array('png','pdf','quotes');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['RequestQuote']['quotes']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['RequestQuote']['quotes']['tmp_name'], $full_image_path);
                        $this->request->data['RequestQuote']['quotes'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    }  
                    else 
                    {
                    $this->Session->setFlash(__('Invalid Image Type.'));
                    return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            }   
            else 
            {
                $this->request->data['RequestQuote']['quotes'] = $this->request->data['saved_image'];
                unset($this->request->data['RequestQuote']['saved_image']);
            }
            
                $id = $this->request->data['RequestQuote']['id'];
                $status = $this->request->data['RequestQuote']['status'];
                $data = array('id' => $id,'status' => $status);
                $this->User->save($data);   
        

            if ($this->RequestQuote->save($this->request->data)) {

                $this->Session->setFlash('The Quote has been saved.','default', array('class'=>'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The Quote could not be saved. Please, try again.','default', array('class'=>'error'));
            }
        } else {

            $options = array('conditions' => array('RequestQuote.id' => $id));
            $this->request->data = $this->RequestQuote->find('first', $options);
        }
        $users  = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
        $posts  = $this->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        $this->set(compact('users','posts'));
        
    }

    public function admin_view($id = null) {
        if (!$this->RequestQuote->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $options = array('conditions' => array('RequestQuote.' . $this->RequestQuote->primaryKey => $id));
        $this->set('RequestQuote', $this->RequestQuote->find('first', $options));
    }

    public function admin_delete($id = null) {
        $this->RequestQuote->id = $id;
        if (!$this->RequestQuote->exists()) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->RequestQuote->delete()) {
            $this->Session->setFlash('The order has been deleted.','default', array('class'=>'success'));
        } else {
            $this->Session->setFlash('The order could not be deleted. Please, try again.','default', array('class'=>'error'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function add(){

        $userid = $this->Session->read('userid');
        if (!isset($userid) && $is_admin == '') {
            $this->redirect('/users/login');
        }

        if($this->request->is('post')) {

            if(!empty($this->request->data['RequestQuote']['quotes']['tmp_name'])) {
                $path = $this->request->data['RequestQuote']['quotes']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if(in_array($ext, array('png','pdf','quotes'))) {
                    $uploadPath = Configure::read('UPLOAD_QUOTE_PATH');
                    $imageName = rand() . '_' . (strtolower(trim($this->request->data['RequestQuote']['quotes']['name'])));
                    $full_image_path = $uploadPath . '/' . $imageName;
                    move_uploaded_file($this->request->data['RequestQuote']['quotes']['tmp_name'], $full_image_path);
                    $this->request->data['RequestQuote']['quotes'] = $imageName;

                    $this->RequestQuote->create();
                    if($this->RequestQuote->save($this->request->data)) {
                        $this->Session->setFlash('save.', 'default', array('class'=>'success'));
                        return $this->redirect(array('controller' => 'users','action' => 'update_profile'));
                    } else {
                        $this->Session->setFlash('DB error.', 'default', array('class'=>'error'));
                    }

                }
            } else {
                $this->Session->setFlash('include quotes before submit.');
            }
        }

        $users  = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
        $posts  = $this->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        $this->set(compact('users','posts'));

    }

    public function index() {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/users/login');
        }

        $this->RequestQuote->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('RequestQuotes', $this->Paginator->paginate('RequestQuote'));

        //pr($this->Paginator->paginate('RequestQuote')); exit;
    }

    public function view($id = null) {
        if (!$this->RequestQuote->exists($id)) {
            throw new NotFoundException(__('Invalid order'));
        }
        $options = array('conditions' => array('RequestQuote.' . $this->RequestQuote->primaryKey => $id));
        $this->set('RequestQuote', $this->RequestQuote->find('first', $options));
    }

    public function edit($id = null) {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/users/login');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            if(!empty($this->request->data['RequestQuote']['quotes']['tmp_name'])) {
                $path = $this->request->data['RequestQuote']['quotes']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_QUOTE_PATH');
                    $extensionValid = array('png','pdf','quotes');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['RequestQuote']['quotes']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['RequestQuote']['quotes']['tmp_name'], $full_image_path);
                        $this->request->data['RequestQuote']['quotes'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    }  
                    else 
                    {
                    $this->Session->setFlash(__('Invalid Image Type.'));
                    return $this->redirect(array('action' => 'edit', $id));
                    }
                }
            }   
            else 
            {
                $this->request->data['RequestQuote']['quotes'] = $this->request->data['saved_image'];
                unset($this->request->data['RequestQuote']['saved_image']);
            }
            
                $id = $this->request->data['RequestQuote']['id'];
                $status = $this->request->data['RequestQuote']['status'];
                $data = array('id' => $id,'status' => $status);
                $this->User->save($data);   
        

            if ($this->RequestQuote->save($this->request->data)) {

                $this->Session->setFlash('The Quote has been saved.','default', array('class'=>'success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The Quote could not be saved. Please, try again.','default', array('class'=>'error'));
            }
        } else {

            $options = array('conditions' => array('RequestQuote.id' => $id));
            $this->request->data = $this->RequestQuote->find('first', $options);
        }
        $users  = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
        $posts  = $this->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        $this->set(compact('users','posts'));
        
    }

    public function delete($id = null) {
        $this->RequestQuote->id = $id;
        if (!$this->RequestQuote->exists()) {
            throw new NotFoundException(__('Invalid order'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->RequestQuote->delete()) {
            $this->Session->setFlash('The order has been deleted.','default', array('class'=>'success'));
        } else {
            $this->Session->setFlash('The order could not be deleted. Please, try again.','default', array('class'=>'error'));
        }
        return $this->redirect(array('action' => 'index'));
    }


}    