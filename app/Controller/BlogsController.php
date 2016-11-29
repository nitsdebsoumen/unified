<?php
App::uses('AppController', 'Controller');
/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class BlogsController extends AppController {

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
	public function index($catID=null) {
            	//$this->Category->recursive = 0;
            $title_for_layout = 'Blogs List';
            $cat_id=base64_decode($catID);
            if ($this->request->is(array('post', 'put'))) {
                
                $search_keyword = $this->request->data['search_keyword'];
                $QueryStr="(Blog.status=1)";
                
                if($search_keyword!=''){
                    $QueryStr.=" AND (Blog.title LIKE '%".$search_keyword."%')";
                }
                if($catID!=''){
                    $QueryStr.=" AND (Blog.cat_id = ".$cat_id.")";
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('Blog.id' => 'desc'));
                //exit;
            }else{
                $QueryStr="(Blog.status=1)";
                if($catID!=''){
                    $QueryStr.=" AND (Blog.cat_id = ".$cat_id.")";
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('Blog.id' => 'desc'));
                $search_keyword='';
            }
            $blog_list=$this->Blog->find('all',$options);
            $this->set(compact('title_for_layout','blog_list','search_keyword'));
	}
        
        public function details($id=null) {
            $title_for_layout = 'Blog Details';
            $this->loadModel('BlogComment');
            $blog_id=base64_decode($id);
            if ($this->request->is(array('post', 'put'))) {
                $UserID=$this->Session->read('userid');
                $comment = $this->request->data['comment'];
                $noti['BlogComment']['user_id'] = $UserID;
                $noti['BlogComment']['blog_id'] = $blog_id;
                $noti['BlogComment']['comment'] = $comment;
                $noti['BlogComment']['cdate'] = date('Y-m-d H:i:s');;
                $this->BlogComment->create();
                $this->BlogComment->save($noti);
                $this->Session->setFlash(__('The blog comment submited successfully.'));
                return $this->redirect(array('action' => 'details/'.$id));
            }else{
                $options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $blog_id));
                $blog_details = $this->Blog->find('first', $options);
                
                $CatID=$blog_details['Blog']['cat_id'];
                $related_options = array('conditions' => array('Blog.id !=' => $blog_id, 'Blog.cat_id' => $CatID, 'Blog.status'=>1), 'order' => array('Blog.id' => 'desc'), 'limit' => 3);
                $RelatedBlogs = $this->Blog->find('all', $related_options);
                
                $comment_options = array('conditions' => array('BlogComment.blog_id' => $blog_id), 'order' => array('BlogComment.id' => 'desc'));
                $BlogsComments = $this->BlogComment->find('all', $comment_options);
            }
            $this->set(compact('title_for_layout','blog_details','RelatedBlogs','BlogsComments'));
	}
        
	public function admin_index() {	
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Blogs List';
            //$this->Category->recursive = 0;
            $options = array('order' => array('Blog.id' => 'desc'));
            $this->Paginator->settings = $options;
            $this->set('blog_list', $this->Paginator->paginate('Blog'));
            $this->set(compact('title_for_layout'));
	}
	
	public function admin_view($id = null) {
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
                $this->redirect('/admin');
            }
            $title_for_layout = 'Blog View';
            if (!$this->Blog->exists($id)) {
                throw new NotFoundException(__('Invalid Blog'));
            }
            $options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
            $blog_view = $this->Blog->find('first', $options);
            
            $this->set(compact('title_for_layout','blog_view'));
	}

/**
 * add method
 *
 * @return void
 */

	public function admin_add() {	
            $userid = $this->Session->read('adminuserid');
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Blog Add';
            if ($this->request->is('post')) {
                $options = array('conditions' => array('Blog.title'  => $this->request->data['Blog']['title']));
                $name = $this->Blog->find('first', $options);
                if(!$name){
                    
                    if(isset($this->request->data['Blog']['image']) && $this->request->data['Blog']['image']['name']!=''){
                            $ext = explode('/',$this->request->data['Blog']['image']['type']);
                            if($ext){
                                $uploadFolder = "blogs_image";
                                $uploadPath = WWW_ROOT . $uploadFolder;
                                $extensionValid = array('jpg','jpeg','png','gif');
                                if(in_array($ext[1],$extensionValid)){

                                    $max_width = "600";
                                    $size = getimagesize($this->request->data['Blog']['image']['tmp_name']);

                                    $width = $size[0];
                                    $height = $size[1];
                                    $imageName = time().'_'.(strtolower(trim($this->request->data['Blog']['image']['name'])));
                                    $full_image_path = $uploadPath . '/' . $imageName;
                                    move_uploaded_file($this->request->data['Blog']['image']['tmp_name'],$full_image_path);
                                    $this->request->data['Blog']['image'] = $imageName;

                                    if ($width > $max_width){
                                        $scale = $max_width/$width;
                                        $uploaded = $this->resizeImage($full_image_path,$width,$height,$scale);
                                    }else{
                                        $scale = 1;
                                        $uploaded = $this->resizeImage($full_image_path,$width,$height,$scale);
                                    }/**/
                                    //unlink($uploadPath. '/' .$this->request->data['User']['hidprofile_img']);
                                } else{
                                    $this->Session->setFlash(__('Please upload image of .jpg, .jpeg, .png or .gif format.'));
                                    return $this->redirect(array('action' => 'admin_add'));
                                }
                            }
                    }else{
                        $this->request->data['Blog']['image'] = '';
                    }
                    $this->request->data['Blog']['create_date'] = date('Y-m-d H:i:s');
                    $this->Blog->create();
                    if ($this->Blog->save($this->request->data)) {
                            $this->Session->setFlash(__('The blog has been saved.'));
                            return $this->redirect(array('action' => 'index'));
                    } else {
                            $this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
                    }
                } else {
                        $this->Session->setFlash(__('The blog name already exists. Please, try again.'));
                }
            }
            $this->set(compact('title_for_layout'));
	}


/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	
	public function admin_edit($id = null) {
            $is_admin = $this->Session->read('is_admin');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $title_for_layout = 'Blog Edit';
	    if (!$this->Blog->exists($id)) {
                    throw new NotFoundException(__('Invalid Blog'));
            }
            if ($this->request->is(array('post', 'put'))) {
                //$options = array('conditions' => array('Blog.title'  => $this->request->data['Blog']['title'], 'Blog.cat_id'=>$this->request->data['Blog']['cat_id']));
                //$name = $this->Blog->find('first', $options);
                $name = array();
                if(!$name){
                    
                    if(isset($this->request->data['Blog']['image']) && $this->request->data['Blog']['image']['name']!=''){
                        $ext = explode('/',$this->request->data['Blog']['image']['type']);
                        if($ext){
                            $uploadFolder = "blogs_image";
                            $uploadPath = WWW_ROOT . $uploadFolder;
                            $extensionValid = array('jpg','jpeg','png','gif');
                            if(in_array($ext[1],$extensionValid)){

                                $max_width = "600";
                                $size = getimagesize($this->request->data['Blog']['image']['tmp_name']);

                                $width = $size[0];
                                $height = $size[1];
                                $imageName = time().'_'.(strtolower(trim($this->request->data['Blog']['image']['name'])));
                                $full_image_path = $uploadPath . '/' . $imageName;
                                move_uploaded_file($this->request->data['Blog']['image']['tmp_name'],$full_image_path);
                                $this->request->data['Blog']['image'] = $imageName;

                                if ($width > $max_width){
                                    $scale = $max_width/$width;
                                    $uploaded = $this->resizeImage($full_image_path,$width,$height,$scale);
                                }else{
                                    $scale = 1;
                                    $uploaded = $this->resizeImage($full_image_path,$width,$height,$scale);
                                }
                                if( $this->request->data['Blog']['hide_img']!='' && file_exists($uploadPath. '/' .$this->request->data['Blog']['hide_img'])){ 
                                    unlink($uploadPath. '/' .$this->request->data['Blog']['hide_img']);
                                }
                            } else{
                                $this->Session->setFlash(__('Please upload image of .jpg, .jpeg, .png or .gif format.'));
                                return $this->redirect(array('action' => 'admin_edit/'.$id));
                            }
                        }
                    }else{
                        $this->request->data['Blog']['image'] = $this->request->data['Blog']['hide_img'];
                    }
                    if ($this->Blog->save($this->request->data)) {
                        $this->Session->setFlash(__('The blog has been saved.'));
                        return $this->redirect(array('action' => 'index'));
                    } else {
                        $this->Session->setFlash(__('The blog could not be saved. Please, try again.'));
                        return $this->redirect(array('action' => 'admin_edit/'.$id));
                    }
                } else {
                    $this->Session->setFlash(__('The blog already exists. Please, try again.'));
                    return $this->redirect(array('action' => 'admin_edit/'.$id));
                }
            } else {
               
                $options = array('conditions' => array('Blog.' . $this->Blog->primaryKey => $id));
                $this->request->data = $this->Blog->find('first', $options);
            }
            $this->set(compact('title_for_layout'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	/*public function delete($id = null) {
		$this->Category->id = $id;
		if (!$this->Category->exists()) {
			throw new NotFoundException(__('Invalid category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Category->delete()) {
			$this->Session->setFlash(__('The category has been deleted.'));
		} else {
			$this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}*/

	public function admin_delete($id = null) {
            $is_admin = $this->Session->read('is_admin');
            $this->loadModel('BlogComment');
            if(!isset($is_admin) && $is_admin==''){
               $this->redirect('/admin');
            }
            $this->Blog->id = $id;
            if (!$this->Blog->exists()) {
                    throw new NotFoundException(__('Invalid Blog'));
            }
            $blog_img=$this->Blog->find('first',array('conditions'=>array('Blog.id'=>$id)));
            $blog_img_unlink = $blog_img['Blog']['image'];
            $uploadFolder = "blogs_image";
            $uploadPath = WWW_ROOT . $uploadFolder;
            if($blog_img_unlink!='' && file_exists($uploadPath . '/' . $blog_img_unlink)){
                unlink($uploadPath . '/' . $blog_img_unlink);
            }
            
            if ($this->Blog->delete($id)) {
                $this->BlogComment->deleteAll(array('BlogComment.blog_id' => $id), false);
                    $this->Session->setFlash(__('The blog has been deleted.'));
            } else {
                    $this->Session->setFlash(__('The blog could not be deleted. Please, try again.'));
            }
            return $this->redirect(array('action' => 'index'));
	}
	
	public function admin_getsubcat($id = null){
            $this->loadModel('Category');
            $options = array('conditions' => array('Category.parent_id'=>$id,'Category.active' => 1 ));
            $categories = $this->Category->find('all', $options);
            return $categories;
	}
        
        public function resizeImage($image,$width,$height,$scale) {
            
            list($imagewidth, $imageheight, $imageType) = getimagesize($image);
            $imageType = image_type_to_mime_type($imageType);
            $newImageWidth = ceil($width * $scale);
            $newImageHeight = ceil($height * $scale);
            $newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);
            switch($imageType) {
                    case "image/gif":
                            $source=imagecreatefromgif($image); 
                            break;
                case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                            $source=imagecreatefromjpeg($image); 
                            break;
                case "image/png":
                    case "image/x-png":
                            $source=imagecreatefrompng($image); 
                            break;
            }
            imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);

            switch($imageType) {
                    case "image/gif":
                            imagegif($newImage,$image); 
                            break;
            case "image/pjpeg":
                    case "image/jpeg":
                    case "image/jpg":
                            imagejpeg($newImage,$image,90); 
                            break;
                    case "image/png":
                    case "image/x-png":
                            imagepng($newImage,$image);  
                            break;
            }

            chmod($image, 0777);
            return $image;
        }
}
