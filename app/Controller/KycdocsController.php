<?php

App::uses('AppController', 'Controller');

/**
 * Seos Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class KycdocsController extends AppController {

	var $uses = array('User','Kycdoc');
	public $components = array('Paginator', 'Session');
    public $paginate = array(
        'limit' => 25,
        'order' => array(
            'Kycdoc.id' => 'desc'
        )
    );
    public function admin_index() {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }

        $this->Kycdoc->recursive = 0;
        $this->Paginator->settings = $this->paginate;
        $this->set('kycdocs', $this->Paginator->paginate('Kycdoc'));
    }

	public function admin_add($id = NULL) {
		$is_admin = $this->Session->read('is_admin');
		if (!isset($is_admin) && $is_admin == '') {
			$this->redirect('/admin');
		}
        $userid = $this->request->data['Kycdoc']['user_id'];
        $kyc = $this->Kycdoc->find('first',array('conditions'=>array('Kycdoc.user_id'=>$userid)));

		if($this->request->is('post')) {

			if(!empty($this->request->data['Kycdoc']['image']['tmp_name'])) {
				$path = $this->request->data['Kycdoc']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if(in_array($ext, array('gif', 'png', 'jpg', 'bmp', 'pdf', 'doc'))) {
                	$uploadPath = Configure::read('UPLOAD_KYC_PATH');
                	$imageName = rand() . '_' . (strtolower(trim($this->request->data['Kycdoc']['image']['name'])));
                    $full_image_path = $uploadPath . '/' . $imageName;
                    move_uploaded_file($this->request->data['Kycdoc']['image']['tmp_name'], $full_image_path);
                    $this->request->data['Kycdoc']['doc'] = $imageName;

                    if(empty($kyc))
                    {

                        $this->Kycdoc->create();
                        if($this->Kycdoc->save($this->request->data)) {
                        	$this->Session->setFlash('save.', 'default', array('class'=>'success'));
                        } else {
                        	$this->Session->setFlash('DB error.', 'default', array('class'=>'error'));
                        }
                    }
                    else
                    {
                        $this->request->data['Kycdoc']['id'] = $kyc['Kycdoc']['id'];
                        if($this->Kycdoc->save($this->request->data)) {
                            $this->Session->setFlash('save.', 'default', array('class' => 'success'));
                        } else {
                            $this->Session->setFlash('DB error.', 'default', array('class' => 'error'));
                        }      
                    }    

                }
			} else {
				$this->Session->setFlash('include doc before submit.');
			}
			// $this->Kycdoc->create();
			// if($this->Kycdoc->save($this->request->data)) {

			// }
		}
        if(isset($id) && $id!=''){
		$users  = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'),'conditions'=>array('User.id'=>$id)));
		$this->set(compact('users'));
        }
        else{
            $users  = $this->User->find('list', array('fields' => array('User.id', 'User.first_name')));
            $this->set(compact('users'));
        }
	}  

	public function admin_edit($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            if(!empty($this->request->data['Kycdoc']['doc']['tmp_name'])) {
                $path = $this->request->data['Kycdoc']['doc']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadPath = Configure::read('UPLOAD_KYC_PATH');
                    $extensionValid = array('gif', 'png', 'jpg', 'bmp', 'pdf', 'doc');
                    if (in_array($ext, $extensionValid)) {
                        $OldImg = $this->request->data['saved_image'];
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Kycdoc']['doc']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Kycdoc']['doc']['tmp_name'], $full_image_path);
                        $this->request->data['Kycdoc']['doc'] = $imageName;
                        if ($OldImg != '') {
                            unlink($uploadPath . '/' . $OldImg);
                        }
                    } else {
                        $this->Session->setFlash(__('Invalid Image Type.'));
                        return $this->redirect(array('action' => 'edit', $id));
                      }
                }
            } else {

            	$this->request->data['Kycdoc']['doc'] = $this->request->data['saved_image'];
                unset($this->request->data['Kycdoc']['saved_image']);
            }
			
			    $user_id = $this->request->data['Kycdoc']['user_id'];
				$kyc_status = $this->request->data['Kycdoc']['varification_status'];
				$data = array('id' => $user_id, 'kyc_status' => $kyc_status);
				$this->User->save($data);	
		

            if ($this->Kycdoc->save($this->request->data)) {

                $this->Session->setFlash(__('The KYC has been saved.','default', array('class'=>'success')));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The KYC could not be saved. Please, try again.','default', array('class'=>'error')));
            }
        } else {

            $options = array('conditions' => array('Kycdoc.id' => $id));
            $this->request->data = $this->Kycdoc->find('first', $options);
        }
        //$this->set(compact('banners'));
        
    }

	public function addkyc(){
		$userid = $this->Session->read('userid');
        $kyc = $this->Kycdoc->find('first',array('conditions'=>array('Kycdoc.user_id'=>$userid)));

		if($this->request->is('post')) {

			if(!empty($this->request->data['Kycdoc']['image']['tmp_name'])) {
				$path = $this->request->data['Kycdoc']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if(in_array($ext, array('gif', 'png', 'jpg', 'bmp', 'pdf', 'doc'))) {
                	$uploadPath = Configure::read('UPLOAD_KYC_PATH');
                	$imageName = rand() . '_' . (strtolower(trim($this->request->data['Kycdoc']['image']['name'])));
                    $full_image_path = $uploadPath . '/' . $imageName;
                    move_uploaded_file($this->request->data['Kycdoc']['image']['tmp_name'], $full_image_path);
                    $this->request->data['Kycdoc']['doc'] = $imageName;

                    if(empty($kyc))
                    {
                            $this->Kycdoc->create();
                            
                                if($this->Kycdoc->save($this->request->data)) {
                                	$this->Session->setFlash('save.', 'default', array('class' => 'success'));
                                } else {
                                	$this->Session->setFlash('DB error.', 'default', array('class' => 'error'));
                                }
                    }
                    else
                    {
                        $this->request->data['Kycdoc']['id'] = $kyc['Kycdoc']['id'];
                        if($this->Kycdoc->save($this->request->data)) {
                            $this->Session->setFlash('save.', 'default', array('class' => 'success'));
                        } else {
                            $this->Session->setFlash('DB error.', 'default', array('class' => 'error'));
                        }

                    }        
                        

                }
			} else {
				$this->Session->setFlash('include doc before submit.','default', array('class'=>'error'));
			}
			// $this->Kycdoc->create();
			// if($this->Kycdoc->save($this->request->data)) {

			// }
		}

		$this->set(compact('usersid','kyc'));

	}  

	public function kyclisting(){

		$userid = $this->Session->read('userid');
        $kyclist = $this->Kycdoc->find('all',array('conditions'=> array('Kycdoc.user_id'=>$userid)));

        $this->set(compact('kyclist'));
	}

    
}   