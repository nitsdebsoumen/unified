<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class AccreditationsController extends AppController {

	public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
	public $uses = array('Accreditation');
	public $paginate = array(
        'limit' => 25,
        'order' => array(
          'Accreditation.id' => 'desc'
        )
    );

	public function index(){
		$userid = $this->Session->read('userid');
		if (!isset($userid)) {
            $this->redirect(array('controller'=>'users','action'=>'login'));
        }

        $accreditations = $this->Accreditation->find('all',array('conditions'=>array('Accreditation.user_id'=>$userid)));
        $this->set(compact('accreditations'));
	}

	public function ajaxAddAccreditation(){
		
		$userid = $this->Session->read('userid');

		if(isset($this->request->data)){
			$this->request->data['Accreditation']['user_id'] = $userid;
			
			if (isset($this->request->data['Accreditation']['image']['name']) && $this->request->data['Accreditation']['image']['name'] != '') {
                $path = $this->request->data['Accreditation']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
		            if ($ext) 
		            {
		                $uploadPath = WWW_ROOT ."accreditation";
		                $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
		                if (in_array($ext, $extensionValid)) {
		                    
		                    $imageName = rand() . '_' . (strtolower(trim($this->request->data['Accreditation']['image']['name'])));
		                    $full_image_path = $uploadPath . '/' . $imageName;
		                    move_uploaded_file($this->request->data['Accreditation']['image']['tmp_name'], $full_image_path);
		                    
		                  
		                    $this->request->data['Accreditation']['image'] = $imageName;
		                } 
		                else 
		                {
		                    $data['ack'] = 0;
		                    $data['res'] = 'Image Type Not Support';
		                }
		            }
        	}
       

			if($this->Accreditation->save($this->request->data)){
				$data['ack'] = 1;
			}	
		}
		echo json_encode($data);
		 exit;
	}

	public function admin_index(){
		$is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $this->Accreditation->recursive = 2;
        $this->Paginator->settings = $this->paginate;
        $this->set('accreditations', $this->Paginator->paginate());
	}

	public function admin_delete($id = null) {
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Accreditation->id = $id;
        if (!$this->Accreditation->exists()) {
            throw new NotFoundException(__('Invalid Faq'));
        }

        $this->request->onlyAllow('post', 'delete');
        if ($this->Accreditation->delete()) {
            $this->Session->setFlash(__('The Accreditation has been deleted.'));
        } else {
            $this->Session->setFlash(__('The Accreditation could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_edit($id = NULL){

    	$userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        //$this->request->data1 = array();
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $accreditations = $this->Accreditation->AccreditationList->find('list',array('fields'=>array('AccreditationList.id','AccreditationList.title')));
        
        //echo $id;exit;
        if (!$this->Accreditation->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
           

                if (!empty($this->request->data['Accreditation']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['Accreditation']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'svg');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "accreditation";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['Accreditation']['image']['tmp_name'], $full_flg_path);
                        $this->request->data['Accreditation']['image'] = $filename;
                        if(!empty($this->request->data['Accreditation']['hide_img'])){
                        unlink($uploadPath.'/'.$this->request->data['Accreditation']['hide_img']);
                    	}
                    	
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $this->request->data['Accreditation']['image'] = $this->request->data['Accreditation']['hide_img'];
                }

                if ($this->Accreditation->save($this->request->data)) {
                    $this->Session->setFlash(__('The Accreditation has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Accreditation could not be saved. Please, try again.'));
                }
            
        } else {
           
            //$is_parent = $this->Category->find('count', array('conditions' => array('Category.parent_id' => 0, 'Category.id' => $id)));
            $options = array('conditions' => array('Accreditation.id'=> $id));
            $this->request->data = $this->Accreditation->find('first', $options);

            
        }
        $this->set(compact('accreditations'));
    }

    public function admin_view($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
      
        if (!$this->Accreditation->exists($id)) {
            throw new NotFoundException(__('Invalid Accreditation'));
        }
        $options = array('conditions' => array('Accreditation.' . $this->Accreditation->primaryKey => $id));
        $accreditation = $this->Accreditation->find('first', $options);
        #pr($category);
        
        $this->set(compact('accreditation'));
    }

    public function delete_accreditations($id = NULL){

        
        $eid = base64_decode($id);
        $user_id = $this->Session->read('userid');
        
        $this->Accreditation->id = $eid;
        if (!$this->Accreditation->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Accreditation->delete($eid)) {
            
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
        }
        
        return $this->redirect(array('Controller'=>'accreditations','action'=>'index'));

    }



    public function edit($id = NULL){

        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        //$this->request->data1 = array();
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $accreditations = $this->Accreditation->AccreditationList->find('list',array('fields'=>array('AccreditationList.id','AccreditationList.title')));
        
        //echo $id;exit;
        if (!$this->Accreditation->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
           

                if (!empty($this->request->data['Accreditation']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['Accreditation']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'svg');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "accreditation";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['Accreditation']['image']['tmp_name'], $full_flg_path);
                        $this->request->data['Accreditation']['image'] = $filename;
                        if(!empty($this->request->data['Accreditation']['hide_img'])){
                        unlink($uploadPath.'/'.$this->request->data['Accreditation']['hide_img']);
                        }
                        
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $this->request->data['Accreditation']['image'] = $this->request->data['Accreditation']['hide_img'];
                }

                if ($this->Accreditation->save($this->request->data)) {
                    $this->Session->setFlash(__('The Accreditation has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Accreditation could not be saved. Please, try again.'));
                }
            
        } else {
           
            //$is_parent = $this->Category->find('count', array('conditions' => array('Category.parent_id' => 0, 'Category.id' => $id)));
            $options = array('conditions' => array('Accreditation.id'=> $id));
            $this->request->data = $this->Accreditation->find('first', $options);

            
        }
        $this->set(compact('accreditations'));
    }

    public function ajaxAccreditationDetails(){

        $data = array();

        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect(array('controller'=>'users','action'=>'login'));
        }

        $accreditations = $this->Accreditation->find('first',array('conditions'=>array('Accreditation.id'=>$this->request->data['a_id'])));
        if(isset($accreditations)){
            $data['ack'] = 1;
            $data['accreditation'] = $accreditations['Accreditation']['accreditation_id'];
            $data['title'] = $accreditations['Accreditation']['title'];
            $data['description'] = $accreditations['Accreditation']['description'];
            $data['image'] = $accreditations['Accreditation']['image'];
            $data['as_a_provider'] = $accreditations['Accreditation']['as_a_provider'];
            $data['training_courses'] = $accreditations['Accreditation']['training_courses'];
            $data['user_id'] = $accreditations['Accreditation']['user_id'];
            $data['id'] = $accreditations['Accreditation']['id'];
        }
        else{
            $data['ack'] = 0;
        }
      echo json_encode($data);
      exit;  
    }

    public function ajaxEditAccreditation(){


        if(isset($this->request->data)){
                       
            if (isset($this->request->data['Accreditation']['image']['name']) && $this->request->data['Accreditation']['image']['name'] != '') {
                $path = $this->request->data['Accreditation']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if ($ext) 
                    {
                        $uploadPath = WWW_ROOT ."accreditation";
                        $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                        if (in_array($ext, $extensionValid)) {
                            
                            $imageName = rand() . '_' . (strtolower(trim($this->request->data['Accreditation']['image']['name'])));
                            $full_image_path = $uploadPath . '/' . $imageName;
                            move_uploaded_file($this->request->data['Accreditation']['image']['tmp_name'], $full_image_path);
                            if($this->request->data['Accreditation']['old_image']!=''){
                                unlink($uploadPath.'/'.$this->request->data['Accreditation']['old_image']);
                                unset($this->request->data['Accreditation']['old_image']);
                            }
                          
                            $this->request->data['Accreditation']['image'] = $imageName;
                        } 
                        else 
                        {
                            $data['ack'] = 0;
                            $data['res'] = 'Image Type Not Support';
                        }
                    }
            }
            else{
             $this->request->data['Accreditation']['image'] = $this->request->data['Accreditation']['old_image'];   
            }
            
            if(!array_key_exists("as_a_provider",$this->request->data['Accreditation'])){
                $this->request->data['Accreditation']['as_a_provider'] = 0;
            }

            if(!array_key_exists("training_courses",$this->request->data['Accreditation'])){
                $this->request->data['Accreditation']['training_courses'] = 0;
            }

            if($this->Accreditation->save($this->request->data)){
                $data['ack'] = 1;
            }   
        }
        echo json_encode($data);
         exit;
    }
	

}