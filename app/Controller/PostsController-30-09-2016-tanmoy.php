<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class PostsController extends AppController {

    /**
     * Components
     *
     * @var array
     */ public $name = 'Posts';
    public $components = array('Paginator', 'Session');
    var $uses = array('User', 'Country', 'State', 'City', 'PostImage', 'Setting', 'Post', 'Chat', 'Skill');
    
    /**
     * index method
     *
     * @return void
     */
    public function addnewpost() {
        $this->layout = false;
        //pr($_POST); exit;
        $userid = $this->Session->read('user_id');
        $this->request->data['Post']['user_id'] = $userid;
        $this->request->data['Post']['category_id'] = $_POST['category_id'];
        $this->request->data['Post']['subcategory_id'] = $_POST['subcategory_id'];
        $this->request->data['Post']['post_title'] = $_POST['post_title'];
        $this->request->data['Post']['location'] = $_POST['location'];
        $this->request->data['Post']['city'] = $_POST['city'];
        $this->request->data['Post']['state'] = $_POST['state'];
        $this->request->data['Post']['address'] = $_POST['address'];
        $this->request->data['Post']['country'] = $_POST['country'];
        $this->request->data['Post']['zip_code'] = $_POST['zip_code'];
        $this->request->data['Post']['post_description'] = $_POST['post_description'];
        $this->request->data['Post']['post_date'] = date('Y-m-d h:m:s');
        $this->request->data['Post']['is_approve'] = 0;
        $this->Post->create();
        if ($this->Post->save($this->request->data)) {
            $this->Session->write('lastPostId', $this->Post->getInsertID());
            echo $this->Post->getInsertID();
        } else {
            echo 0;
        }
        exit;
        $this->autoRender = false;
    }

    public function addnewoffer() {
        $this->layout = false;
        //pr($_POST); exit;
        //$userid = $this->Session->read('user_id');

        if ($this->Session->check('LastPostId')) {

            $LastPostId = $this->Session->read('LastPostId');
        } else {
            $LastPostId = $this->Session->read('getoffer_editid');
        }
        //$this->request->data['Post']['user_id'] = $userid;
        $category_id = $this->request->data['Post']['category_id'] = $_POST['category_id'];
        $subcategory_id = $this->request->data['Post']['subcategory_id'] = $_POST['subcategory_id'];
        $title = $this->request->data['Post']['post_title'] = $_POST['post_title'];
        $location = $this->request->data['Post']['location'] = $_POST['location'];
        $city = $this->request->data['Post']['city'] = $_POST['city'];
        $state = $this->request->data['Post']['state'] = $_POST['state'];
        $address = $this->request->data['Post']['address'] = $_POST['address'];
        $country = $this->request->data['Post']['country'] = $_POST['country'];
        $zip_code = $this->request->data['Post']['zip_code'] = $_POST['zip_code'];
        $description = $this->request->data['Post']['post_description'] = $_POST['post_description'];
        $date = $this->request->data['Post']['post_date'] = gmdate('Y-m-d h:i:s');
        $type = $this->request->data['Post']['type'] = $_POST['type'];


        $update = $this->Post->updateAll(array('Post.category_id' => "'$category_id'", 'Post.subcategory_id' => "'$subcategory_id'", 'Post.post_title' => "'$title'", 'Post.location' => "'$location'", 'Post.city' => "'$city'", 'Post.state' => "'$state'", 'Post.address' => "'$address'", 'Post.country' => "'$country'", 'Post.zip_code' => "'$zip_code'", 'Post.post_description' => "'$description'", 'Post.post_date' => "'$date'", 'Post.type' => "'$type'"), array('Post.id' => $LastPostId));
        if ($update) {
            echo $LastPostId;
        } else {
            echo 0;
        }

        //$this->request->data['Post']['post_id'] = $_POST['post_id'];
        //$this->request->data['Post']['is_approve'] = 0;
        //$this->Post->create();
        //pr($this->request->data);exit;
        /* if ($this->Post->save($this->request->data)){
          $this->Session->write('lastPostId', $this->Post->getInsertID());
          echo $this->Post->getInsertID();
          } else {
          echo 0;
          } */

        exit;
        $this->autoRender = false;
    }

    public function getsubcat() {

        $id = $_REQUEST['id'];
        $this->loadModel('Category');
        $options_subcat = array('conditions' => array('Category.status' => 1, 'Category.parent_id' => $id), 'order' => array('Category.category_name' => 'asc'), 'fields' => array('Category.id', 'Category.category_name'));
        $subcatg = $this->Category->find('list', $options_subcat);
        //$this->set('selectbox',$subcatg); 
        //$subcategory="";

        echo '<option>--Select a SubCategory (Required)--</option>';

        foreach ($subcatg as $key => $subcat) {
            echo '<option value="' . $key . '" >' . $subcat . '</option>';
        }

        exit;
    }

    public function ajaximage() {
        $this->layout = false;
        $this->loadModel('PostImage');
        //$uploadFolder = "postimg/";
        $uploadFolder = "img/post_img/";
        $path = WWW_ROOT . $uploadFolder;

        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "Jpg", "Png", "Gif", "Bmp", "Jpeg");
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

            //pr($_POST); pr($_FILES); exit;
            if (isset($_FILES['photoimg1']) && !empty($_FILES['photoimg1'])) {
                $_FILES['photoimg'] = $_FILES['photoimg1'];
            } else if (isset($_FILES['photoimg2']) && !empty($_FILES['photoimg2'])) {
                $_FILES['photoimg'] = $_FILES['photoimg2'];
            } else if (isset($_FILES['photoimg3']) && !empty($_FILES['photoimg3'])) {
                $_FILES['photoimg'] = $_FILES['photoimg3'];
            } else if (isset($_FILES['photoimg4']) && !empty($_FILES['photoimg4'])) {
                $_FILES['photoimg'] = $_FILES['photoimg4'];
            } else if (isset($_FILES['photoimg5']) && !empty($_FILES['photoimg5'])) {
                $_FILES['photoimg'] = $_FILES['photoimg5'];
            }
            //pr($_FILES); exit;
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        //echo $path . $actual_image_name; exit;
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {

                            $postId = $this->Session->read('lastPostId');
                            //mysqli_query($db, "UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
                            $this->request->data['post_id'] = $postId;
                            $this->request->data['originalpath'] = $actual_image_name;
                            $this->request->data['resizepath'] = $actual_image_name;

                            $this->PostImage->create();
                            if ($this->PostImage->save($this->request->data)) {
                                echo "<img src=" . $this->webroot . "img/post_img/" . $actual_image_name . "  class='preview'>";
                            }
                        } else
                            echo "failed";
                    } else
                        echo "Image file size max 1 MB";
                } else
                    echo "Invalid file format..";
            } else
                echo "Please select image..!";

            exit;
        }
        $this->autoRender = false;
    }

    public function ajaximage_offer() {
        //echo "hello";exit;
        $this->layout = false;
        $this->loadModel('PostImage');
        //$uploadFolder = "postimg/";
        $uploadFolder = "img/post_img/";
        $path = WWW_ROOT . $uploadFolder;

        $valid_formats = array("jpg", "png", "gif", "bmp", "jpeg", "Jpg", "Png", "Gif", "Bmp", "Jpeg");
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

            //pr($_POST); pr($_FILES); exit;
            if (isset($_FILES['photoimg_1']) && !empty($_FILES['photoimg_1'])) {
                $_FILES['photoimg'] = $_FILES['photoimg_1'];
            } else if (isset($_FILES['photoimg_2']) && !empty($_FILES['photoimg_2'])) {
                $_FILES['photoimg'] = $_FILES['photoimg_2'];
            } else if (isset($_FILES['photoimg_3']) && !empty($_FILES['photoimg_3'])) {
                $_FILES['photoimg'] = $_FILES['photoimg_3'];
            } else if (isset($_FILES['photoimg_4']) && !empty($_FILES['photoimg_4'])) {
                $_FILES['photoimg'] = $_FILES['photoimg_4'];
            } else if (isset($_FILES['photoimg_5']) && !empty($_FILES['photoimg_5'])) {
                $_FILES['photoimg'] = $_FILES['photoimg_5'];
            }
            //pr($_FILES['photoimg']); 
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];

            //echo $name; exit;
            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        //echo $path . $actual_image_name; exit;
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {

                            if ($this->Session->check('LastPostId')) {

                                $postId = $this->Session->read('LastPostId');
                            } else {
                                $postId = $this->Session->read('getoffer_editid');
                            }

                            $postId = $this->Session->read('LastPostId');
                            //mysqli_query($db, "UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
                            $this->request->data['post_id'] = $postId;
                            $this->request->data['originalpath'] = $actual_image_name;
                            $this->request->data['resizepath'] = $actual_image_name;

                            //pr($this->request->data);

                            $this->PostImage->create();
                            if ($this->PostImage->save($this->request->data)) {
                                echo "<img src=" . $this->webroot . "img/post_img/" . $actual_image_name . "  class='preview'>";
                            }
                        } else
                            echo "failed";
                    } else
                        echo "Image file size max 1 MB";
                } else
                    echo "Invalid file format..";
            } else
                echo "Please select image..!";

            exit;
        }
        $this->autoRender = false;
    }

    public function addnewpostbudget_offer() {

        $this->layout = false;
        //pr($_POST);
        $userid = $this->Session->read('user_id');
        if ($this->Session->check('LastPostId')) {

            $LastPostId = $this->Session->read('LastPostId');
        } else {
            $LastPostId = $this->Session->read('getoffer_editid');
        }
        //echo $userid;
        $price = $_POST['budget'];
        $price_condition = $_POST['price_condition'];
        $product_condition = $_POST['product_condition'];
        $is_complete = 1;
        //pr($pid); exit;
        //$this->Post->id = $this->Session->read('lastPostId');
        //$pid['Post']['id'] = $this->Session->read('lastPostId');
        /* if ($this->Post->save($pid)){
          $this->Session->delete('lastPostId');
          $this->Session->setFlash(__('Post Added Successfully.'));
          echo 1;
          } else {
          echo 0;
          } */
        $update = $this->Post->updateAll(array('Post.price' => "'$price'", 'Post.price_condition' => "'$price_condition'", 'Post.product_condition' => "'$product_condition'", 'Post.is_complete' => "'$is_complete'"), array('Post.id' => $LastPostId));
        if ($update) {
            echo 1;

            if ($this->Session->check('post_owner') || $this->Session->check('notification_to_id') || $this->Session->check('post_title')) {



                $to_id = $this->Session->read('post_owner');
                $noti_post_id = $this->Session->read('notification_to_id');
                $LastPostId;
                $from_id = $userid;
                $post_title = $this->Session->read('post_title');
                $date = gmdate('Y-m-d h:i:s');
                $message = "Have posted a new offer on your post " . $post_title;
                $type = "offer";
                $is_read = 0;
                $link = Configure::read('SITE_URL') . 'posts/offer_details/' . $LastPostId;

                $this->request->data['from_id'] = $from_id;
                $this->request->data['to_id'] = $to_id;
                $this->request->data['post_id'] = $noti_post_id;
                $this->request->data['offer_id'] = $LastPostId;
                $this->request->data['date'] = $date;
                $this->request->data['message'] = $message;
                $this->request->data['link'] = $link;
                $this->request->data['is_read'] = $is_read;
                $this->request->data['type'] = $type;

                $this->loadModel('OfferNotification');
                $this->OfferNotification->recursive = 2;
                $this->OfferNotification->create();
                if ($this->OfferNotification->save($this->request->data)) {
                    $this->Session->delete('LastPostId');
                    $this->Session->delete('post_owner');
                    $this->Session->delete('notification_to_id');
                    $this->Session->delete('post_title');
                }
            }
        } else {
            echo 0;
        }
        exit;
        $this->autoRender = false;
    }

    public function addnewpostbudget() {
        $this->layout = false;
        //pr($_POST);
        $userid = $this->Session->read('lastPostId');
        //echo $userid;
        $pid['Post']['price'] = $_POST['budget'];
        $pid['Post']['price_condition'] = $_POST['price_condition'];
        $pid['Post']['product_condition'] = $_POST['product_condition'];
        //pr($pid); exit;
        //$this->Post->id = $this->Session->read('lastPostId');
        $pid['Post']['id'] = $this->Session->read('lastPostId');
        if ($this->Post->save($pid)) {
            echo $this->Session->read('lastPostId');
            $this->Session->delete('lastPostId');
            $this->Session->setFlash(__('Post Added Successfully.'));
            //echo 1;
        } else {
            echo 0;
        }
        exit;
        $this->autoRender = false;
    }

    public function editoldpost() {
        $this->layout = false;
        //pr($_POST); exit;
        $userid = $this->Session->read('user_id');

        $this->request->data['Post']['category_id'] = $_POST['category_id'];
        $this->request->data['Post']['subcategory_id'] = $_POST['subcategory_id'];
        $this->request->data['Post']['post_title'] = $_POST['post_title'];
        $this->request->data['Post']['location'] = $_POST['location'];
        $this->request->data['Post']['city'] = $_POST['city'];
        $this->request->data['Post']['state'] = $_POST['state'];
        $this->request->data['Post']['address'] = $_POST['address'];
        $this->request->data['Post']['country'] = $_POST['country'];
        $this->request->data['Post']['zip_code'] = $_POST['zip_code'];
        $this->request->data['Post']['post_description'] = $_POST['post_description'];
        $this->Post->id = $_POST['id'];
        if ($this->Post->save($this->request->data)) {
            $this->Session->write('lastPostId', $this->Post->getInsertID());
            echo 1;
        } else {
            echo 0;
        }
        exit;
        $this->autoRender = false;
    }

    public function ajaximageedit() {

        $this->layout = false;
        $this->loadModel('PostImage');
        //$uploadFolder = "postimg/";
        $uploadFolder = "img/post_img/";
        $path = WWW_ROOT . $uploadFolder;

        $valid_formats = array("jpg", "png", "gif", "bmp");
        if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

            //pr($_POST); pr($_FILES); exit;
            if (isset($_FILES['ephotoimg1']) && !empty($_FILES['ephotoimg1'])) {
                $_FILES['photoimg'] = $_FILES['ephotoimg1'];
            } else if (isset($_FILES['ephotoimg2']) && !empty($_FILES['ephotoimg2'])) {
                $_FILES['photoimg'] = $_FILES['ephotoimg2'];
            } else if (isset($_FILES['ephotoimg3']) && !empty($_FILES['ephotoimg3'])) {
                $_FILES['photoimg'] = $_FILES['ephotoimg3'];
            } else if (isset($_FILES['ephotoimg4']) && !empty($_FILES['ephotoimg4'])) {
                $_FILES['photoimg'] = $_FILES['ephotoimg4'];
            } else if (isset($_FILES['ephotoimg5']) && !empty($_FILES['ephotoimg5'])) {
                $_FILES['photoimg'] = $_FILES['ephotoimg5'];
            }
            //pr($_FILES); exit;
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            if (strlen($name)) {
                list($txt, $ext) = explode(".", $name);
                if (in_array($ext, $valid_formats)) {
                    if ($size < (1024 * 1024)) {
                        $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
                        $tmp = $_FILES['photoimg']['tmp_name'];
                        //echo $path . $actual_image_name; exit;
                        if (move_uploaded_file($tmp, $path . $actual_image_name)) {

                            $postId = $this->Session->read('lastPostId');
                            //mysqli_query($db, "UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
                            $this->request->data['post_id'] = $postId;
                            $this->request->data['originalpath'] = $actual_image_name;
                            $this->request->data['resizepath'] = $actual_image_name;

                            $this->PostImage->create();
                            if ($this->PostImage->save($this->request->data)) {
                                echo "<img src=" . $this->webroot . "img/post_img/" . $actual_image_name . "  class='preview'>";
                            }
                        } else
                            echo "failed";
                    } else
                        echo "Image file size max 1 MB";
                } else
                    echo "Invalid file format..";
            } else
                echo "Please select image..!";

            exit;
        }
        $this->autoRender = false;



        /*
          $this->layout = false;
          $this->loadModel('PostImage');
          $uploadFolder = "postimg/";
          $path = WWW_ROOT . $uploadFolder;

          $valid_formats = array("jpg", "png", "gif", "bmp");
          if (isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST") {

          //pr($this->request->data); pr($_FILES); exit;

          if(isset($_FILES['photoimg1']) && !empty($_FILES['photoimg1'])){
          $_FILES['photoimg'] = $_FILES['photoimg1'];
          $oldPostImgId = $_POST['epimgid1'];
          $oldpid = $_POST['epostids1'];
          } else if(isset($_FILES['photoimg2']) && !empty($_FILES['photoimg2'])){
          $_FILES['photoimg'] = $_FILES['photoimg2'];
          $oldPostImgId = $_POST['epimgid2'];
          $oldpid = $_POST['epostids2'];
          } else if(isset($_FILES['photoimg3']) && !empty($_FILES['photoimg3'])){
          $_FILES['photoimg'] = $_FILES['photoimg3'];
          $oldPostImgId = $_POST['epimgid3'];
          $oldpid = $_POST['epostids3'];
          } else if(isset($_FILES['photoimg4']) && !empty($_FILES['photoimg4'])){
          $_FILES['photoimg'] = $_FILES['photoimg4'];
          $oldPostImgId = $_POST['epimgid4'];
          $oldpid = $_POST['epostids4'];
          } else if(isset($_FILES['photoimg5']) && !empty($_FILES['photoimg5'])){
          $_FILES['photoimg'] = $_FILES['photoimg5'];
          $oldPostImgId = $_POST['epimgid5'];
          $oldpid = $_POST['epostids5'];
          }
          //pr($_FILES); exit;
          $name = $_FILES['photoimg']['name'];
          $size = $_FILES['photoimg']['size'];
          if (strlen($name)) {
          list($txt, $ext) = explode(".", $name);
          if (in_array($ext, $valid_formats)) {
          if ($size < (1024 * 1024)) {
          $actual_image_name = time() . substr(str_replace(" ", "_", $txt), 5) . "." . $ext;
          $tmp = $_FILES['photoimg']['tmp_name'];
          //echo $path . $actual_image_name; exit;
          if (move_uploaded_file($tmp, $path . $actual_image_name)) {
          if($oldPostImgId != ""){
          $this->PostImage->id = $oldPostImgId; $this->PostImage->delete();
          }

          //mysqli_query($db, "UPDATE users SET profile_image='$actual_image_name' WHERE uid='$session_id'");
          $this->request->data['post_id'] = $oldpid;
          $this->request->data['originalpath'] = $actual_image_name;
          $this->request->data['resizepath'] = $actual_image_name;

          $this->PostImage->create();
          if ($this->PostImage->save($this->request->data)){
          echo "<img src=". $this->webroot ."postimg/" . $actual_image_name . "  class='preview'>";
          }

          } else
          echo "failed";
          } else
          echo "Image file size max 1 MB";
          } else
          echo "Invalid file format..";
          } else
          echo "Please select image..!";

          exit;
          }
          $this->autoRender=false;

         */
    }

    public function deletePostImage() {
        $this->layout = false;

        //$options = array('conditions' => array('PostImage.id'  => $_POST['id']));
        //$img = $this->PostImage->find('first', $options);

        $this->PostImage->recursive = -1;
        $this->request->data = $this->PostImage->read(null, $_POST['id']);

        //pr($this->request->data); pr($_POST);exit;
        //pr($this->request->data); exit;
        if ($this->PostImage->delete($_POST['id'])) {
            //if($this->request->data['PostImage']['resizepath'] !=""){
            //        unlink(USER_IMAGES . $this->request->data['User']['photo']);
            //}
            echo 1;
        } else {
            echo 0;
        }

        $this->autoRender = false;
    }

    public function editoldpostbudget() {
        $this->layout = false;
        //pr($_POST);
        $userid = $this->Session->read('lastPostId');
        //echo $userid;
        $pid['Post']['id'] = $_POST['id'];
        $pid['Post']['price'] = $_POST['budget'];
        $pid['Post']['price_condition'] = $_POST['price_condition'];
        $pid['Post']['product_condition'] = $_POST['product_condition'];
        //pr($pid); exit;
        $this->Post->id = $_POST['id'];
        if ($this->Post->save($pid)) {
            $this->Session->delete('lastPostId');
            $this->Session->setFlash(__('Post Updated Successfully.'));
            echo 1;
        } else {
            echo 0;
        }
        exit;
        $this->autoRender = false;
    }

    public function fetchpostdata() {

        $this->layout = false;

        $options = array('conditions' => array('Post.id' => $_POST['pid']));
        $post = $this->Post->find('first', $options);
        //pr($post);exit;
        $this->Session->write('lastPostId', $_POST['pid']);



        echo json_encode($post);
        exit;
        $this->autoRender = false;
    }

    public function fetchaddofferdata() {

        $this->layout = false;

        $options = array('conditions' => array('Post.id' => $_POST['pid']));
        $post = $this->Post->find('first', $options);
        //pr($post);exit;
        //$this->Session->write('lastPostId', $_POST['pid']);



        echo json_encode($post);
        exit;
        $this->autoRender = false;
    }

    public function fetchofferdata() {

        $this->layout = false;
        //$this->Post->recursive=2;

        $options = array('conditions' => array('Post.id' => $_POST['pid']));
        $post = $this->Post->find('first', $options);
        //pr($post);exit;

        echo json_encode($post);
        exit;
        $this->autoRender = false;
    }

    /*
      public function admin_uploadUser($id = null)

      {

      $this->autoRender=false;

      $this->loadModel('Multimageupload');

      $imagename = $_FILES['file']['name'];

      $uploadPath= Configure::read('UPLOAD_USER_IMG_PATH');

      //echo $imagename = $_FILES['file']['profile_image']['name'];

      $options = array('conditions' => array('User.id' => $id));

      $user = $this->User->find('first', $options);

      if(!empty($user)){

      $this->Multimageupload->create();



      move_uploaded_file($_FILES['file']['tmp_name'], $uploadPath.'/'.(date('Ymd_his').'__'.$imagename));

      $imageName1 = date('Ymd_his').'__'.$imagename;

      $userupdate['Multimageupload']['user_id']=$id;

      $userupdate['Multimageupload']['image_upload']=$imageName1;

      $this->Multimageupload->save($userupdate);

      }

     */

    public function index() {
        $this->Post->recursive = 0;
        $this->set('posts', $this->Paginator->paginate());
    }

    public function admin_index() {
        $conditions = array();
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        $users = $this->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.is_admin' => '0')));
        
        if (isset($this->request->data['keyword'])) {
            $keywords = $this->request->data['keyword'];
        } else {
            $keywords = '';
        }
        if (isset($this->request->data['search_is_active'])) {
            $Newsearch_is_active = $this->request->data['search_is_active'];
        } else {
            $Newsearch_is_active = '';
        }
        if (isset($this->request->data['user'])) {
            $User = $this->request->data['user'];
        } else {
            $User = '';
        }
        //$QueryStr = '1';
        if ($keywords != '') {
            $conditions['Post.post_title LIKE'] = '%'.$keywords.'%';
        }
        if ($Newsearch_is_active != '') {
            $conditions['Post.is_approve'] = $Newsearch_is_active;
        }
        if ($User != '') {
            $conditions['Post.user_id'] = $User;
        }
        $options = array('conditions' => $conditions, 'order' => array('Post.id' => 'desc'), 'group' => 'Post.id');
        $this->Paginator->settings = $options;
        $title_for_layout = 'Post List';
        $this->Post->recursive = 1;
        $this->set('posts', $this->Paginator->paginate('Post'));
        $this->set(compact('title_for_layout', 'keywords', 'Newsearch_is_active', 'users', 'User'));
    }

    public function admin_subposts($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Sub Post List';
        //$this->Post->recursive = 0;
        $this->set('posts', $this->Paginator->paginate('Post', array('Post.id' => $id)));
        $this->set(compact('title_for_layout', 'id'));
    }

    public function admin_exportsub($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $posts = $this->Post->find('all');

        $output = '';
        $output .='Name, Status';
        $output .="\n";

        if (!empty($posts)) {
            foreach ($posts as $category) {
                $isactive = ($category['Post']['active'] == 1 ? 'Active' : 'Inactive');

                $output .='"' . $category['Post']['name'] . '","' . $isactive . '"';
                $output .="\n";
            }
        }
        $filename = "posts" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid Post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $this->set('category', $this->Post->find('first', $options));
    }

    public function admin_view($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Post View';
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid Post'));
        }
        $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
        $post = $this->Post->find('first', $options);
        $this->set(compact('title_for_layout', 'post'));
    }
    
    

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        if ($this->request->is('post')) {
            $this->Post->create();
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        }
        $users = $this->Post->User->find('list');
        $this->set(compact('users'));
    }

    public function admin_add() {
        $this->loadModel('PostImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        $this->request->data1 = array();
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $users = $this->Post->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.is_admin' => '0','User.admin_type'=>'2')));
        $categories = $this->Post->Category->find('list', array('fields' => array('Category.id', 'Category.category_name')));
        $posts = $this->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        //print_r($country);
        $title_for_layout = 'Post Add';
        if ($this->request->is('post')) {
            $options = array('conditions' => array('Post.post_title' => $this->request->data['Post']['post_title']));
            $name = $this->Post->find('first', $options);
            if (!$name) {

                if (!empty($this->request->data['Post']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['Post']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "img/post_img";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['Post']['image']['tmp_name'], $full_flg_path);
                        $this->request->data1['PostImage']['originalpath'] = $filename;
                        $this->request->data1['PostImage']['resizepath'] = $filename;
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                } else {
                    $filename = '';
                }
                $this->request->data['Post']['post_date'] = date('Y-m-d h:m:s');
                $this->Post->create();
                if ($this->Post->save($this->request->data)) {
                    $this->request->data1['PostImage']['post_id'] = $this->Post->id;
                    $this->PostImage->save($this->request->data1);
                    $this->Session->setFlash(__('The Post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The Post could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The Post name already exists. Please, try again.'));
            }
        }
        
        $skills = $this->Post->Skill->find('list',array('fields'=>array('id','skill_name')));
        $this->set(compact('title_for_layout', 'countries', 'posts', 'users', 'categories', 'skills'));
    }
    
    public function add_course() {
        $this->loadModel('PostImage');
        $userid = $this->Session->read('userid');
        
        if (!isset($userid) || $userid == '') {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->data1 = array();
        $users = $this->Post->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.is_admin' => '0')));
        $categories = $this->Post->Category->find('list', array('fields' => array('Category.id', 'Category.category_name')));
        $posts = $this->Post->find('list', array('fields' => array('Post.id', 'Post.post_title')));
        //print_r($country);
        $title_for_layout = 'Post Add';
        if ($this->request->is('post')) {
            if (isset($this->request->data['Post']['image']) && $this->request->data['Post']['image']['name'] != '') {
                $path = $this->request->data['Post']['image']['name'];
                $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                if ($ext) {
                    $uploadFolder = "img/post_img";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext, $extensionValid)) {
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['Post']['image']['name'])));
                        
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['Post']['image']['tmp_name'], $full_image_path);
                        $this->request->data1['PostImage']['originalpath'] = $imageName;
                        $this->request->data1['PostImage']['resizepath'] = $imageName;
                    } else {
                        $this->Session->setFlash('Invalid Image Type.', 'default', array('class' => 'error'));
                        return $this->redirect(array('action' => 'add_course'));
                    }
                }
                $this->request->data['Post']['user_id'] = $userid;
                $this->Post->create();
                if ($this->Post->save($this->request->data)) {
                    $this->request->data1['PostImage']['post_id'] = $this->Post->id;
                    $this->PostImage->save($this->request->data1);
                    $this->Session->setFlash('The Post has been saved.', 'default', array('class' => 'success'));
                    return $this->redirect(array('action' => 'list_course'));
                } else {
                    $this->Session->setFlash('The Post could not be saved. Please, try again.', 'default', array('class' => 'error'));
                }
            }
            
        }
        
        $skills = $this->Post->Skill->find('list',array('fields'=>array('id','skill_name')));
        $this->set(compact('title_for_layout', 'countries', 'posts', 'users', 'categories', 'skills'));
    }
    
    public function admin_addsubcategory($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Sub Post Add';
        if ($this->request->is('post')) {
            $options = array('conditions' => array('Post.name' => $this->request->data['Post']['name'], 'Post.parent_id' => $this->request->data['Post']['parent_id']));
            $name = $this->Post->find('first', $options);
            if (!$name) {
                $this->Post->create();
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('The sub category has been saved.'));
                    return $this->redirect(array('action' => 'subposts', $id));
                } else {
                    $this->Session->setFlash(__('The sub category could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The sub category name already exists. Please, try again.'));
            }
        }
        $options = array('conditions' => array('Post.id' => $id));
        $categoryname = $this->Post->find('list', $options);
        if ($categoryname) {
            $categoryname = $categoryname[$id];
        } else {
            $categoryname = '';
        }
        $this->set(compact('title_for_layout', 'categoryname', 'id'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect('/admin');
        }
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Post->save($this->request->data)) {
                $this->Session->setFlash(__('The category has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The category could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);
        }
        $users = $this->Post->User->find('list');
        $this->set(compact('users'));
    }

    public function admin_edit($id = null) {
        $this->loadModel('PostImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        $this->request->data1 = array();
        
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $posts = $this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        //echo $id;exit;
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->request->is(array('post', 'put'))) {
            
            //echo "hello";exit;
            $options = array('conditions' => array('Post.post_title' => $this->request->data['Post']['post_title'], 'Post.id <>' => $id));
            $name = $this->Post->find('first', $options);

            if (!$name) {

                if (!empty($this->request->data['Post']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['Post']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "img/post_img";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['Post']['image']['tmp_name'], $full_flg_path);
                        $this->request->data1['PostImage']['originalpath'] = $filename;
                        $this->request->data1['PostImage']['resizepath'] = $filename;
                        $this->request->data1['PostImage']['id'] = $this->request->data['Post']['postimage_id'];
                        $this->request->data1['PostImage']['post_id'] = $id;
                        $this->PostImage->save($this->request->data1);
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                        return $this->redirect(array('action' => 'index'));
                    }
                }

                $this->request->data['Post']['post_date'] = date('Y-m-d h:m:s');
                if ($this->Post->save($this->request->data)) {
                    $this->Session->setFlash(__('The post has been saved.'));
                    return $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash(__('The post could not be saved. Please, try again.'));
                }
            } else {
                $this->Session->setFlash(__('The post already exists. Please, try again.'));
            }
        } else {
            
            $options = array('conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);
        }
        $users = $this->Post->User->find('list', array('fields' => array('User.id', 'User.first_name'), 'conditions' => array('User.is_admin' => '0')));
        
        $categories = $this->Post->Category->find('list', array('fields' => array('Category.id', 'Category.category_name')));
        
        $skills = $this->Post->Skill->find('list',array('fields'=>array('id','skill_name')));
        
        $countries = $this->Post->Country->find('list', array('fields' => array('id','name')));
        
        $states = $this->Post->State->find('list', array('fields' => array('id','name'), 'conditions' => array('State.country_id' => $posts['Post']['country'])));
        
        $cities = $this->Post->City->find('list', array('fields' => array('id','name'), 'conditions' => array('City.country_id' => $posts['Post']['country'], 'City.state_id' => $posts['Post']['state'])));
        
        $this->set(compact('posts', 'users', 'categories', 'skills', 'countries', 'states', 'cities'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Post->delete()) {
            $this->Session->setFlash(__('The category has been deleted.'));
        } else {
            $this->Session->setFlash(__('The category could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function admin_delete($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid category'));
        }
        if ($this->Post->delete($id)) {
            $this->Session->setFlash(__('The post has been deleted.'));
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    ///////////////////////////////AK///////////
    public function admin_export() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $options = array('Post.id !=' => 0);
        $cats = $this->Post->find('all', array('conditions' => $options));
        $output = '';
        $output .='Post Name, Parent Name, Is Active';
        $output .="\n";
//pr($cats);exit;
        if (!empty($cats)) {
            foreach ($cats as $cat) {
                $isactive = ($cat['Post']['active'] == 1) ? 'Yes' : 'No';

                $output .='"' . $cat['Post']['name'] . '","' . $cat['Parent']['name'] . '","' . $isactive . '"';
                $output .="\n";
            }
        }
        $filename = "posts" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

    public function list_post($id = null) {
        $this->loadModel('Category');
        $this->loadModel('Post');
        $this->loadModel('Country');
        $this->loadModel('UserBlock');

        $userid = $this->Session->read('user_id');
        $blocked_by_users = array();
        if (!empty($userid)) {
            $blocked_by_users = $this->UserBlock->find('list', array('conditions' => array('UserBlock.user_to' => $userid), 'fields' => array('UserBlock.user_by')));
        }

        if ($id == '') {

            if (!empty($blocked_by_users)) {
                $options_post = array('conditions' => array('Post.id !=' => '', 'Post.is_approve' => 1, 'NOT' => array('Post.user_id' => $blocked_by_users)));
            } else {
                $options_post = array('conditions' => array('Post.id !=' => '', 'Post.is_approve' => 1));
            }

            $posts = $this->Post->find('all', $options_post);

            $options_cont = array('conditions' => array('Country.id' => $posts[0]['Category']['country_id']));
            $countries = $this->Country->find('all', $options_cont);
        } else {
            if (!empty($blocked_by_users)) {
                $options_post = array('conditions' => array('Post.category_id' => $id, 'Post.is_approve' => 1, 'NOT' => array('Post.user_id' => $blocked_by_users)));
            } else {
                $options_post = array('conditions' => array('Post.category_id' => $id, 'Post.is_approve' => 1));
            }

            $posts = $this->Post->find('all', $options_post);

            if (!empty($posts[0])) {
                $options_cont = array('conditions' => array('Country.id' => $posts[0]['Category']['country_id']));
            } else {
                $options_cont = array('conditions' => array());
            }
            $countries = $this->Country->find('all', $options_cont);
        }

        $options = array('conditions' => array('Category.id !=' => '', 'Category.status' => 1));
        $categories = $this->Category->find('all', $options);




        $this->set(compact('categories', 'posts', 'countries'));
    }
    
    
    public function list_course() {
        $userid = $this->Session->read('userid');
        if(!isset($userid) || $userid == '') {
            $this->redirect('/');
        }
        $option = array(
            'conditions' => array(
                'Post.user_id' => $userid
            ),
            'group' => array('Post.id')
        );
        $courses = $this->Post->find('all', $option);
        $this->set(compact('courses'));
    }
    
    public function post_details($id = null) {

        //echo $id;exit;
        //date_default_timezone_set("Asia/Kolkata");

        $this->loadModel('PostImage');
        $this->loadModel('PostComment');
        $this->loadModel('UserImage');
        $this->loadModel('PostFavorite');
        $this->loadModel('PostView');
        $this->loadModel('PostLike');

        $this->PostComment->recursive = 2;
        $this->Post->recursive = 2;

        $userid = $this->Session->read('user_id');
        if ($userid == '') {
            $userid = 0;
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $options_view = array('conditions' => array('PostView.ip_address' => $ip_address, 'PostView.post_id' => $id, 'PostView.type' => 'post'));
        } else {
            $options_view = array('conditions' => array('PostView.user_id' => $userid, 'PostView.post_id' => $id, 'PostView.type' => 'post'));
        }


        $postview_count = $this->PostView->find('count', $options_view);
        if ($postview_count == 0) {

            $this->request->data['PostView']['user_id'] = $userid;
            $this->request->data['PostView']['post_id'] = $id;
            $this->request->data['PostView']['ip_address'] = $ip_address;
            $this->request->data['PostView']['date'] = gmdate('Y-m-d h:i:s');
            $this->request->data['PostView']['type'] = 'post';

            $this->PostView->create();
            $this->PostView->save($this->request->data['PostView']);
        }






        if ($this->request->is('post')) {

            $post_id = $this->request->data['post_id'];

            $this->request->data['PostComment']['user_id'] = $userid;
            $this->request->data['PostComment']['post_id'] = $this->request->data['post_id'];
            $this->request->data['PostComment']['date'] = gmdate('Y-m-d h:i:s');
            $this->request->data['PostComment']['message'] = $this->request->data['message'];
            //pr($this->request->data);

            $this->PostComment->create();
            if ($this->PostComment->save($this->request->data)) {

                return $this->redirect('/posts/post_details/' . $post_id);
            }
        }




        $options_post = array('conditions' => array('Post.id' => $id));
        $posts = $this->Post->find('first', $options_post);

        $post_id = $posts['Post']['id'];

        $options_postimg = array('conditions' => array('PostImage.post_id' => $post_id));
        $postimgs = $this->PostImage->find('all', $options_postimg);


        $options_comment = array('conditions' => array('PostComment.post_id' => $id));
        $postcomment = $this->PostComment->find('all', $options_comment);

        $postcomment_count = $this->PostComment->find('count', $options_comment);

        $options_offer = array('conditions' => array('Post.post_id' => $id, 'Post.type' => 'offer'));
        $postoffer = $this->Post->find('all', $options_offer);

        $postoffer_count = $this->Post->find('count', $options_offer);

        $options_make_offer = array('conditions' => array('Post.post_id' => $id, 'Post.user_id' => $userid, 'Post.type' => 'offer'));
        $post_make_offer = $this->Post->find('count', $options_make_offer);




        $options_fav = array('conditions' => array('PostFavorite.post_id' => $id, 'PostFavorite.type' => 'post'));
        $postfav_count = $this->PostFavorite->find('count', $options_fav);


        $options_like = array('conditions' => array('PostLike.post_id' => $id, 'PostLike.type' => 'post', 'PostLike.status' => 1));
        $postlike_count = $this->PostLike->find('count', $options_like);

        $options_likeuser = array('conditions' => array('PostLike.user_id' => $userid, 'PostLike.post_id' => $id, 'PostLike.type' => 'post', 'PostLike.status' => 1));
        $postlikeuser = $this->PostLike->find('count', $options_likeuser);

        $options_favuser = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.post_id' => $id, 'PostFavorite.type' => 'post'));
        $postfavuser_count = $this->PostFavorite->find('count', $options_favuser);

        $options_view1 = array('conditions' => array('PostView.post_id' => $id, 'PostView.type' => 'post'));
        $postview_totcount = $this->PostView->find('count', $options_view1);




        //pr($posts['PostImage']);


        $this->set(compact('posts', 'postimgs', 'postcomment_count', 'postcomment', 'postfav_count', 'postfavuser_count', 'postview_totcount', 'postoffer', 'postoffer_count', 'post_make_offer', 'postlike_count', 'postlikeuser'));
    }

    public function getedit_offerid() {

        $offer_id = $_REQUEST['offer_id'];
        $this->Session->write('getoffer_editid', $offer_id);
        exit;

        //$this->Session->write('getoffer_id', $id);
        //return $this->redirect('/posts/offer_details/'.$id);
    }

    public function makeoffer() {

        $this->Session->delete('LastPostId');
        $this->Session->delete('post_owner');
        $this->Session->delete('notification_to_id');
        $this->Session->delete('post_title');

        $post_id = $_REQUEST['post_id'];
        $userid = $this->Session->read('user_id');
        $is_complete = 0;
        $is_approve = 0;
        $post_date = gmdate('Y-m-d h:i:s');

        $this->request->data['post_date'] = $post_date;
        $this->request->data['is_complete'] = $is_complete;
        $this->request->data['user_id'] = $userid;
        $this->request->data['post_id'] = $post_id;
        $this->request->data['is_approve'] = $is_approve;


        $options_offer = array('conditions' => array('Post.post_id' => $post_id, 'Post.user_id' => $userid));
        $offer_count = $this->Post->find('count', $options_offer);
        $offer = $this->Post->find('first', $options_offer);
        $offer_title = $offer['Post']['post_title'];
        //echo $offer_title


        $post_own = array('conditions' => array('Post.id' => $post_id));
        $post_owner = $this->Post->find('first', $post_own);
        $post_owner_user = $post_owner['Post']['user_id'];

        //echo 
        //pr($offer);exit;
        //$offer['Post']['id'];
        if ($offer_count == 0) {

            $this->Post->create();
            $this->Post->save($this->request->data);
            $this->Session->write('LastPostId', $this->Post->getInsertID());
            $this->Session->write('post_owner', $post_owner_user);
            $this->Session->write('notification_to_id', $post_id);
            $this->Session->write('post_title', $offer_title);
        } else {
            $this->Session->write('LastPostId', $offer['Post']['id']);

            $this->Post->updateAll(array('Post.post_date' => "'$post_date'"), array('Post.id' => $LastPostId));
            $this->Session->write('post_owner', $post_owner_user);
            $this->Session->write('notification_to_id', $post_id);
            $this->Session->write('post_title', $offer_title);
        }
        exit;
    }

    public function offer_details($id = null) {
        //date_default_timezone_set("Asia/Kolkata");

        $this->loadModel('PostImage');
        $this->loadModel('PostComment');
        $this->loadModel('UserImage');
        $this->loadModel('PostFavorite');
        $this->loadModel('PostView');
        $this->loadModel('Category');
        $this->loadModel('PostLike');

        $this->PostComment->recursive = 2;
        $this->Post->recursive = 2;



        $userid = $this->Session->read('user_id');


        if ($userid == '') {
            $userid = 0;
            $ip_address = $_SERVER['REMOTE_ADDR'];
            $options_view = array('conditions' => array('PostView.ip_address' => $ip_address, 'PostView.post_id' => $id, 'PostView.type' => 'offer'));
        } else {
            $options_view = array('conditions' => array('PostView.user_id' => $userid, 'PostView.post_id' => $id, 'PostView.type' => 'offer'));
        }


        $postview_count = $this->PostView->find('count', $options_view);
        if ($postview_count == 0) {

            $this->request->data['PostView']['user_id'] = $userid;
            $this->request->data['PostView']['post_id'] = $id;
            $this->request->data['PostView']['ip_address'] = $ip_address;
            $this->request->data['PostView']['date'] = gmdate('Y-m-d h:i:s');
            $this->request->data['PostView']['type'] = 'offer';

            $this->PostView->create();
            $this->PostView->save($this->request->data['PostView']);
        }




        if ($this->request->is('post')) {
            $post_id = $this->request->data['post_id'];

            $this->request->data['user_id'] = $userid;
            $this->request->data['post_id'] = $this->request->data['post_id'];
            $this->request->data['date'] = gmdate('Y-m-d h:i:s');
            $this->request->data['message'] = $this->request->data['message'];


            $this->PostComment->create();
            if ($this->PostComment->save($this->request->data)) {

                return $this->redirect('/posts/offer_details/' . $post_id);
            }
        }




        $options_post = array('conditions' => array('Post.id' => $id));
        $posts = $this->Post->find('first', $options_post);

        $post_id = $posts['Post']['id'];


        $post_details = $this->Post->find('first', array('conditions' => array('Post.id' => $posts['Post']['post_id'])));
        $offer_details = $this->Post->find('first', array('conditions' => array('Post.id' => $post_id)));
        $this->set(compact('post_details', 'offer_details'));
        //$options_cat_select= array('conditions' => array('Category.id' => $post_cat_id));
        //$cate_name = $this->Category->find('first', $options_cat_select);
        //$cate_name['Category']['category_name'];

        $options_offer1 = array('conditions' => array('Post.id' => $posts['Post']['post_id']));
        $postoffer1 = $this->Post->find('first', $options_offer1);

        $options_postimg = array('conditions' => array('PostImage.post_id' => $post_id));
        $postimgs = $this->PostImage->find('all', $options_postimg);


        $options_comment = array('conditions' => array('PostComment.post_id' => $id));
        $postcomment = $this->PostComment->find('all', $options_comment);

        $postcomment_count = $this->PostComment->find('count', $options_comment);

        $options_offer = array('conditions' => array('Post.post_id' => $id, 'Post.type' => 'offer'));
        $postoffer = $this->Post->find('all', $options_offer);

        $postoffer_count = $this->Post->find('count', $options_offer);



        $options_fav = array('conditions' => array('PostFavorite.post_id' => $id, 'PostFavorite.type' => 'offer'));
        $postfav_count = $this->PostFavorite->find('count', $options_fav);

        $options_favuser = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.post_id' => $id, 'PostFavorite.type' => 'offer'));
        $postfavuser_count = $this->PostFavorite->find('count', $options_favuser);


        $options_offerlike = array('conditions' => array('PostLike.post_id' => $id, 'PostLike.type' => 'offer', 'PostLike.status' => 1));
        $offerlike_count = $this->PostLike->find('count', $options_offerlike);

        $options_offerlikeuser = array('conditions' => array('PostLike.user_id' => $userid, 'PostLike.post_id' => $id, 'PostLike.type' => 'offer', 'PostLike.status' => 1));
        $offerlikeuser = $this->PostLike->find('count', $options_offerlikeuser);

        $options_view1 = array('conditions' => array('PostView.post_id' => $id, 'PostView.type' => 'offer'));
        $postview_totcount = $this->PostView->find('count', $options_view1);

        //$posts['User']['id'];
        $options_rating = array('conditions' => array('Post.user_id' => $posts['User']['id'], 'Post.type' => 'offer'));
        $postrat_count = $this->Post->find('all', $options_rating);
        /* foreach($postrat_count as $count)
          {


          $options_rating1= array('conditions' => array('PostLike.post_id' => $count['Post']['id'], 'PostLike.type' => 'offer', 'PostLike.status' => 1));
          $postrat_count1 = $this->PostLike->find('all', $options_rating1);

          } */



        $this->set(compact('posts', 'postimgs', 'postcomment_count', 'postcomment', 'postfav_count', 'postfavuser_count', 'postview_totcount', 'postoffer', 'postoffer_count', 'postoffer1', 'offerlike_count', 'offerlikeuser', 'postrat_count'));
    }

    public function post_view($id = null) {

        $this->loadModel('PostView');


        $userid = $this->Session->read('user_id');
        if ($userid == '') {
            $userid = 0;
        }

        $ip_address = $_SERVER['REMOTE_ADDR'];


        $options_view = array('conditions' => array('PostView.ip_address' => $ip_address, 'PostView.post_id' => $id, 'PostView.type' => 'post'));
        $postview_count = $this->PostView->find('count', $options_view);


        if ($postview_count == 0) {
            //echo $postview_count;exit;
            $this->request->data['user_id'] = $userid;
            $this->request->data['post_id'] = $id;
            $this->request->data['ip_address'] = $ip_address;
            $this->request->data['date'] = gmdate('Y-m-d h:i:s');

            //pr($this->request->data);exit;

            $this->PostView->create();
            $this->PostView->save($this->request->data);
        } else {
            
        }
        //$this->set(compact('postview_totcount'));
    }

    /* public function offer_view($id = null)
      {

      $this->loadModel('PostView');


      $userid = $this->Session->read('user_id');
      if($userid=='')
      {
      $userid=0;
      }

      $ip_address=$_SERVER['REMOTE_ADDR'];


      $options_view= array('conditions' => array('PostView.ip_address' => $ip_address,'PostView.post_id' => $id));
      $postview_count = $this->PostView->find('count', $options_view);


      if($postview_count==0)
      {
      //echo $postview_count;exit;
      $this->request->data['user_id']=$userid;
      $this->request->data['post_id']=$id;
      $this->request->data['ip_address']=$ip_address;
      $this->request->data['type']='offer';
      $this->request->data['date']=gmdate('Y-m-d h:i:s');

      //pr($this->request->data);exit;

      $this->PostView->create();
      $this->PostView->save($this->request->data);

      }
      else
      {

      }
      //$this->set(compact('postview_totcount'));


      } */

    public function user_image($userid) {
        $user_id = base64_decode($userid);
        $this->loadModel('UserImage');

        $options_img = array('conditions' => array('UserImage.user_id' => $user_id));
        $img_user = $this->UserImage->find('first', $options_img);
        return $img_user['UserImage']['originalpath'];
    }

    public function offer_image($postid) {
        $post_id = base64_decode($postid);
        $this->loadModel('PostImage');

        $options_img = array('conditions' => array('PostImage.post_id' => $post_id));
        $img_offer = $this->PostImage->find('first', $options_img);
        //foreach($img_offer as $offer)
        //{
        return $img_offer['PostImage']['originalpath'];
        //}
    }

    public function delete_post($id = null) {
        $this->loadModel('PostComment');
        $this->Post->id = $id;
        if (!$this->Post->exists()) {
            throw new NotFoundException(__('Invalid post'));
        }

        if ($this->Post->delete($id)) {
            $this->PostComment->deleteAll(['PostComment.post_id' => $id]);
            return $this->redirect(array('controller' => 'users', 'action' => 'dashboard'));

            $this->Session->setFlash(__('The post has been deleted.'));
        } else {
            $this->Session->setFlash(__('The post could not be deleted. Please, try again.'));
        }
    }

    public function post_fav($post_id = null) {
        //date_default_timezone_set("Asia/Kolkata");

        $post_id = $_REQUEST['post_id'];

        $this->loadModel('PostFavorite');
        $userid = $this->Session->read('user_id');

        $options_user = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.post_id' => $post_id, 'PostFavorite.type' => 'post'));
        $existuser = $this->PostFavorite->find('first', $options_user);


        $this->request->data['user_id'] = $userid;
        $this->request->data['post_id'] = $post_id;
        $this->request->data['type'] = 'post';
        $this->request->data['date'] = gmdate('Y-m-d h:i:s');

        if (empty($existuser)) {

            $this->PostFavorite->create();

            if ($this->PostFavorite->save($this->request->data)) {

                //return $this->redirect('/posts/post_details/'.$post_id);
            }
        } else {

            //return $this->redirect('/posts/post_details/'.$post_id);
        }

        $options_fav = array('conditions' => array('PostFavorite.post_id' => $post_id, 'PostFavorite.type' => 'post'));
        echo $postfav_count = $this->PostFavorite->find('count', $options_fav);

        exit;
    }

    public function offer_fav() {
        //date_default_timezone_set("Asia/Kolkata");
        $post_id = $_REQUEST['post_id'];

        $this->loadModel('PostFavorite');
        $userid = $this->Session->read('user_id');

        $options_user = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.post_id' => $post_id, 'PostFavorite.type' => 'offer'));
        $existuser = $this->PostFavorite->find('first', $options_user);


        $this->request->data['user_id'] = $userid;
        $this->request->data['post_id'] = $post_id;
        $this->request->data['type'] = 'offer';
        $this->request->data['date'] = gmdate('Y-m-d h:i:s');

        if (empty($existuser)) {

            $this->PostFavorite->create();

            if ($this->PostFavorite->save($this->request->data)) {



                //return $this->redirect('/posts/offer_details/'.$post_id);
            }
        } else {

            //return $this->redirect('/posts/offer_details/'.$post_id);
        }

        $options_fav = array('conditions' => array('PostFavorite.post_id' => $post_id, 'PostFavorite.type' => 'offer'));
        echo $postfav_count = $this->PostFavorite->find('count', $options_fav);

        exit;
    }

    public function post_like() {
        //date_default_timezone_set("Asia/Kolkata");

        $post_id = $_REQUEST['post_id'];
        $this->loadModel('User');

        $this->loadModel('PostLike');
        $userid = $this->Session->read('user_id');

        $options_user = array('conditions' => array('PostLike.user_id' => $userid, 'PostLike.post_id' => $post_id, 'PostLike.type' => 'post'));
        $existuser = $this->PostLike->find('first', $options_user);

        //$existuser['PostLike']['status'];

        $options_post = array('conditions' => array('Post.id' => $post_id));
        $existpost = $this->Post->find('first', $options_post);


        $this->request->data['PostLike']['user_id'] = $userid;
        $this->request->data['PostLike']['post_id'] = $post_id;
        $this->request->data['PostLike']['type'] = 'post';
        $this->request->data['PostLike']['status'] = 1;
        $this->request->data['PostLike']['date'] = gmdate('Y-m-d h:i:s');
        $rtng['type'] = '';
        $rtng['rate'] = '0';
        $rtng['count'] = '0';

        if (empty($existuser)) {

            $this->PostLike->create();

            if ($this->PostLike->save($this->request->data)) {

                $rate = $existpost['User']['rating'] + 1;
                $usr['User']['id'] = $existpost['User']['id'];
                $rating = $usr['User']['rating'] = $rate;
                //$this->User->save($usr);
                $this->User->updateAll(array('User.rating' => $rating), array('User.id' => $existpost['User']['id']));
                $rtng['type'] = 1;

                //return $this->redirect('/posts/post_details/'.$post_id);
            }
        } else {

            if ($existuser['PostLike']['status'] == 1) {

                $update = $this->PostLike->updateAll(array('PostLike.status' => 0), array('PostLike.id' => $existuser['PostLike']['id']));
                $rate = $existpost['User']['rating'] - 1;
                if ($rate < 0) {
                    $rate = 0;
                }
                $usr['User']['id'] = $existpost['User']['id'];
                $rating = $usr['User']['rating'] = $rate;
                //$this->User->save($usr);
                $this->User->updateAll(array('User.rating' => $rating), array('User.id' => $existpost['User']['id']));
                $rtng['type'] = 0;
            } else {
                $update = $this->PostLike->updateAll(array('PostLike.status' => 1), array('PostLike.id' => $existuser['PostLike']['id']));
                $rate = $existpost['User']['rating'] + 1;
                $usr['User']['id'] = $existpost['User']['id'];
                $rating = $usr['User']['rating'] = $rate;
                //$this->User->save($usr); 
                $this->User->updateAll(array('User.rating' => $rating), array('User.id' => $existpost['User']['id']));
                $rtng['type'] = 1;
            }
        }
        $rtng['rate'] = $rate;

        $options_like = array('conditions' => array('PostLike.post_id' => $post_id, 'PostLike.type' => 'post', 'PostLike.status' => 1));
        $postlike_count = $this->PostLike->find('count', $options_like);
        //echo $existuser['PostLike']['status'];
        $rtng['count'] = $postlike_count;
        echo json_encode($rtng);

        exit;
    }

    public function offer_like() {
        //date_default_timezone_set("Asia/Kolkata");
        //$this->autoRender=false;

        $post_id = $_REQUEST['post_id'];

        $this->loadModel('PostLike');
        $this->loadModel('User');
        $userid = $this->Session->read('user_id');

        $options_user = array('conditions' => array('PostLike.user_id' => $userid, 'PostLike.post_id' => $post_id, 'PostLike.type' => 'offer'));
        $existuser = $this->PostLike->find('first', $options_user);



        $options_post = array('conditions' => array('Post.id' => $post_id));
        $existpost = $this->Post->find('first', $options_post);
        //echo $existpost['User']['id'];exit;

        $this->request->data['PostLike']['user_id'] = $userid;
        $this->request->data['PostLike']['post_id'] = $post_id;
        $this->request->data['PostLike']['type'] = 'offer';
        $this->request->data['PostLike']['status'] = 1;
        $this->request->data['PostLike']['date'] = gmdate('Y-m-d h:i:s');
        $rtng['type'] = '';
        $rtng['rate'] = '0';
        $rtng['count'] = '0';
        if (empty($existuser)) {

            $this->PostLike->create();

            if ($this->PostLike->save($this->request->data)) {
                $rate = $existpost['User']['rating'] + 1;
                $usr['User']['id'] = $existpost['User']['id'];
                $rating = $usr['User']['rating'] = $rate;
                //$this->User->save($usr);
                $this->User->updateAll(array('User.rating' => $rating), array('User.id' => $existpost['User']['id']));
                $rtng['type'] = 1;
                //return $this->redirect('/posts/post_details/'.$post_id);
            }
        } else {



            if ($existuser['PostLike']['status'] == 1) {

                $update = $this->PostLike->updateAll(array('PostLike.status' => 0), array('PostLike.id' => $existuser['PostLike']['id']));
                $rate = $existpost['User']['rating'] - 1;
                if ($rate < 0) {
                    $rate = 0;
                }
                $usr['User']['id'] = $existpost['User']['id'];
                $rating = $usr['User']['rating'] = $rate;
                //$this->User->save($usr);
                $this->User->updateAll(array('User.rating' => $rating), array('User.id' => $existpost['User']['id']));
                $rtng['type'] = 0;
            } else {
                $update = $this->PostLike->updateAll(array('PostLike.status' => 1), array('PostLike.id' => $existuser['PostLike']['id']));
                $rate = $existpost['User']['rating'] + 1;
                $usr['User']['id'] = $existpost['User']['id'];
                $rating = $usr['User']['rating'] = $rate;
                $this->User->updateAll(array('User.rating' => $rating), array('User.id' => $existpost['User']['id']));
                $rtng['type'] = 1;
            }
        }
        $rtng['rate'] = $rate;
        $options_like = array('conditions' => array('PostLike.post_id' => $post_id, 'PostLike.type' => 'offer', 'PostLike.status' => 1));
        $postlike_count = $this->PostLike->find('count', $options_like);
        $rtng['count'] = $postlike_count;
        echo json_encode($rtng);


        exit;
    }

    public function getgmttime() {
        $offset = $_REQUEST['offset'];
        $this->Session->write('timezone', $offset);
        //$this->Session->read('timezone');
        exit;
    }

    public function message_chat($postId, $offer_id) {
        $userid = $this->Session->read('user_id');
        if (empty($userid)) {
            $this->redirect('/');
            exit;
        }
        $this->Post->recursive = 2;
        $options = array('conditions' => array('Post.post_id' => $postId));
        $offer_user = $this->Post->find('all', $options);
        //pr($offer_user);
        //exit;
        $this->set('offer_user', $offer_user);
        $this->loadModel('User');
        $login_user = $this->User->find('first', array('conditions' => array('User.id' => $userid)));

        $this->Post->recursive = 1;
        $post_details = $this->Post->find('first', array('conditions' => array('Post.id' => $postId)));
        $offer_details = $this->Post->find('first', array('conditions' => array('Post.id' => $offer_id)));

        $chats = $this->Chat->find('all', array('conditions' => array('Chat.offer_id' => $offer_id)));

        $s = $this->Chat->updateAll(array('Chat.is_read' => 1), array('Chat.offer_id' => $offer_id, 'Chat.receiver_id' => $userid));
        //var_dump($s);
        //exit;
        //pr($chats);
        //exit;

        $this->set('login_user', $login_user);
        $this->set(compact('post_details', 'offer_details', 'chats'));
    }

    //////////////////////////AK///////////////////////
    
    
    public function admin_import_csv() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $ret = $this->Post->csvImport($this->request->data['csv']['tmp_name'], $userid);
            if (empty($ret['errors'])) {
                $this->Session->setFlash($ret['messages']);
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->setFlash($ret['errors']);
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
    public function import_csv() {
        $userid = $this->Session->read('userid');
        if(!isset($userid) || $userid == '') {
            $this->redirect('/');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $ret = $this->Post->csvImport($this->request->data['csv']['tmp_name'], $userid);
            if (empty($ret['errors'])) {
                $this->Session->setFlash($ret['messages'], 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'list_course'));
            } else {
                $this->setFlash($ret['errors'], 'default', array('class' => 'error')); 
                return $this->redirect(array('action' => 'list_course'));
            }
        }
    }

    public function csv_upload() {
        $userid = $this->Session->read('userid');
        if(!isset($userid) || $userid == '') {
            $this->redirect('/');
        }
        
        if ($this->request->is(array('post', 'put'))) {
            $ret = $this->Post->csvImport($this->request->data['csv']['tmp_name'], $userid);
            if (empty($ret['errors'])) {
                $this->Session->setFlash($ret['messages'], 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'list_course'));
            } else {
                $this->setFlash($ret['errors'], 'default', array('class' => 'error')); 
                return $this->redirect(array('action' => 'list_course'));
            }
        }
    }
    
    public function admin_featured_course() {
        $conditions = array();
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $conditions['Post.featured'] = 1;
        $options = array('conditions' => $conditions, 'order' => array('Post.id' => 'desc'), 'group' => 'Post.id');
        $this->Paginator->settings = $options;
        $title_for_layout = 'Post List';
        $this->Post->recursive = 1;
        $this->set('posts', $this->Paginator->paginate('Post'));
        
    }
    
    public function course_schedule() {
        $userid = $this->Session->read('userid');
        
        if (!isset($userid) || $userid == '') {
            $this->redirect('/');
        }
        
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $params = array(
            'conditions' => array(
                'Post.user_id' => $userid
            ),
            'recursive' => -1,
            'order' => array('Post.id' => 'DESC')
        );
        $courses = $this->Post->find('all', $params);
        $startdates = array();
        foreach ($courses as $course) {
            $startdates[] = array(
                'id' => $course['Post']['id'],
                'title' => $course['Post']['post_title'],
                'start' => date('Y-m-d', strtotime($course['Post']['startdate'])),
                'end' => date('Y-m-d', strtotime($course['Post']['enddate']))
            );
        }
        $startdates = json_encode($startdates);
        
        $this->set(compact('courses', 'startdates'));
    }
}
