<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class UsersController extends AppController {
    /* function beforeFilter() {
      parent::beforeFilter();
      } */

    /**
     * Components
     *
     * @var array
     */

    public $name = 'Users';
    public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
    var $uses = array('User', 'Country', 'State', 'City', 'Newsletter', 'Setting', 'Content', 'Activity', 'Contact', 'Category', 'Post', 'Homeslider', 'Skill', 'Comment', 'Partner','Venue','Wishlist','TempCart','Rating');
    public $helpers = array('GoogleMap');

    public function userlogin() {

        $userid = $this->Session->read('user_id');
        if ($this->request->is('post')) {

            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email'], 'User.user_pass' => md5($this->request->data['User']['password']), 'User.status' => 1));
            $loginuser = $this->User->find('first', $options);
            $refer_url = $this->referer('/', true);
            $parse_url_params = Router::parse($refer_url);
            if ($loginuser) {

                $logindatetime = date('Y-m-d H:i:s');
                $this->Session->write('user_id', $loginuser['User']['id']);
                $userid = $this->Session->read('user_id');
                $dec_userid = base64_encode($loginuser['User']['id']);
                $name_def = ucwords($loginuser['User']['first_name']) . ' ' . ucwords($loginuser['User']['last_name']);
                $expname_def = explode(" ", $name_def);
                $usersnames = ucwords($loginuser['User']['first_name']) . ' ' . $expname_def[1][0];

                $this->User->updateAll(array('User.last_login' => "'$logindatetime'"), array('User.id' => $userid));

                $this->Session->setFlash(__('You are successfully logged in', 'default', array('class' => 'success')));
                if (empty($parse_url_params)) {
                    return $this->redirect('/users/dashboard/' . $usersnames . '/' . $dec_userid);
                } else {
                    return $this->redirect($refer_url);
                }
            } else {
                $this->Session->setFlash(__('Invalid email or password or inactive account.', 'default', array('class' => 'error')));
                if (empty($parse_url_params)) {
                    return $this->redirect(array('action' => 'index'));
                } else {
                    return $this->redirect($refer_url);
                }
            }
        } else {
            return $this->redirect(array('action' => 'index'));
        }
    }

    public function dashboard($uname = null, $id = null) {

        $userid = base64_decode($id);
        $userid2 = $userid;
        //$userid = $this->Session->read('user_id');
        $this->loadModel('Category');
        $this->loadModel('Post');
        $this->loadModel('Country');
        $this->loadModel('User');
        $this->loadModel('PostFavorite');
        $this->loadModel('Follow');
        $this->loadModel('UserBlock');
        $user_id = $this->Session->read('user_id');
        if ($userid == '') {

            return $this->redirect(array('action' => 'index'));
        }

        $is_following = false;
        $is_blocked = false;
        if (!empty($user_id)) {
            $is_following = $this->Follow->find('first', array('conditions' => array('Follow.user_by' => $user_id, 'Follow.user_to' => $userid)));
            $is_blocked = $this->UserBlock->find('first', array('conditions' => array('UserBlock.user_by' => $user_id, 'UserBlock.user_to' => $userid)));
        }

        $followers = $this->Follow->find('count', array('conditions' => array('Follow.user_to' => $userid)));

        $options_post = array('conditions' => array('Post.user_id' => $userid, 'Post.type' => null));
        $posts = $this->Post->find('all', $options_post);
        //echo count($posts);

        $options_offer = array('conditions' => array('Post.user_id' => $userid, 'Post.type' => 'offer'));
        $offers = $this->Post->find('all', $options_offer);
        //pr($offers);
        //print_r($posts);

        $options_cont = array('conditions' => array('Country.id' => $posts[0]['Category']['country_id']));
        $countries = $this->Country->find('all', $options_cont);

        $options_user = array('conditions' => array('User.id' => $userid));
        $users = $this->User->find('first', $options_user);

        $options_fav = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.type' => 'post'));
        $fav = $this->PostFavorite->find('count', $options_fav);


        //$options= array('conditions' => array('Category.id !='  => '','Category.status'  => 1));
        //$categories = $this->Category->find('all', $options);




        $this->set(compact('categories', 'posts', 'countries', 'users', 'fav', 'offers', 'userid2', 'user_id', 'is_following', 'followers', 'is_blocked'));
    }

    public function favorites($id = null) {

        $userid = base64_decode($id);
        $userid2 = $userid;
        //$userid = $this->Session->read('user_id');
        $this->loadModel('Category');
        $this->loadModel('Post');
        $this->loadModel('Country');
        $this->loadModel('User');
        $this->loadModel('PostFavorite');

        $this->PostFavorite->recursive = 2;
        if ($userid == '') {

            return $this->redirect(array('action' => 'index'));
        }




        $options_post = array('conditions' => array('Post.id !=' => '', 'Post.user_id' => $userid, 'Post.type' => null));
        $posts = $this->Post->find('all', $options_post);

        $options_cont = array('conditions' => array('Country.id' => $posts[0]['Category']['country_id']));
        $countries = $this->Country->find('all', $options_cont);

        $options_user = array('conditions' => array('User.id' => $userid));
        $users = $this->User->find('first', $options_user);

        $options_fav = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.type' => 'post'));
        $fav_all = $this->PostFavorite->find('all', $options_fav);
        $fav = $this->PostFavorite->find('count', $options_fav);


        //$options= array('conditions' => array('Category.id !='  => '','Category.status'  => 1));
        //$categories = $this->Category->find('all', $options);




        $this->set(compact('categories', 'posts', 'countries', 'users', 'fav', 'fav_all', 'userid2'));
    }

    /* public function post_image($postid)
      {
      //$post_id=base64_decode($postid);
      $this->loadModel('PostImage');

      $options_img= array('conditions' => array('PostImage.id' => $post_id));
      $img_post = $this->PostImage->find('first', $options_img);
      return $img_post['PostImage']['originalpath'];

      } */

    public function userregister() {

        //$userid = $this->Session->read('user_id');
        if ($this->request->is('post')) {
            //echo "hello";exit;
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email_address']));
            $existuser = $this->User->find('count', $options);

            if ($existuser > 0) {
                $this->Session->setFlash(__('This Email address already exist.Please use another one ', 'default', array('class' => 'error')));
            } else {

                $this->request->data['User']['email_address'] = $this->request->data['User']['email_address'];
                $this->request->data['User']['user_pass'] = md5($this->request->data['User']['user_pass']);
                $fullname = $this->request->data['User']['fullname'];
                $exp_fullname = explode(" ", $fullname);
                $this->request->data['User']['first_name'] = $exp_fullname[0];
                $this->request->data['User']['last_name'] = $exp_fullname[1];

                $this->User->create();
                if ($this->User->save($this->request->data)) {
                    $this->Session->setFlash(__('You will be successfully registered.', 'default', array('class' => 'success')));
                    return $this->redirect(array('controller' => 'users', 'action' => 'index'));
                }
            }


            //$this->User->save($InboxMessageData);
        }
    }

    public function login() {
        $userid = $this->Session->read('userid');
        $username = $this->Session->read('username');
        $title_for_layout = 'Sign In';
        $RefferLink = $this->Session->read('is_signup');
        /* if($RefferUrl!=''){
          $RefferLink=  end(explode('/', $RefferUrl));
          } */
        $this->set(compact('title_for_layout', 'RefferLink'));
        if (isset($userid) && $userid != '') {
            return $this->redirect(array('action' => 'home'));
        }
        if ($this->request->is('post')) {
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email'], 'User.user_pass' => md5($this->request->data['User']['password']), 'User.status' => 1));
            $loginuser = $this->User->find('first', $options);

            if (!$loginuser) {
                $this->Session->setFlash('Invalid username or password or inactive account.', 'default', array('class' => 'error'));
                return $this->redirect(array('action' => 'login'));
            } else {
                if ($loginuser['User']['activated'] == '0') {
                    $this->Session->setFlash('Your account is not activated. Go to your mail and activate your account.', 'default', array('class' => 'error'));
                    return $this->redirect(array('action' => 'login'));
                } else {
                    if (isset($this->request->data['User']['rembme']) && $this->request->data['User']['rembme'] != '') {
                        $cookie = $this->request->data['User']['rembme'];
                    } else {
                        $cookie = '';
                    }
                    //$eamil=$this->request->data['User']['email'];
                    //$password=$this->request->data['User']['password'];
                    $this->Session->write('userid', $loginuser['User']['id']);
                    $this->Session->write('username', $loginuser['User']['first_name']);
                    $this->Session->write('activated', $loginuser['User']['activated']);

                    /* $activity_data['Activity']['user_id'] = $loginuser['User']['id'];
                      $activity_data['Activity']['date'] = date('Y-m-d H:i:s');
                      $activity_data['Activity']['status'] = 'Login';
                      $activity_data['Activity']['ip'] = $_SERVER['REMOTE_ADDR'];
                      $this->Activity->save($activity_data); */
                    if ($cookie == '1') {
                        $this->Cookie->write('email', $this->request->data['User']['email'], $encrypt = false, $expires = null);
                        $this->Cookie->write('password', $this->request->data['User']['password'], $encrypt = false, $expires = null);
                        $this->Cookie->write('remember_me', $cookie, $encrypt = false, $expires = null);
                    } else {
                        $this->Cookie->delete('email');
                        $this->Cookie->delete('password');
                        $this->Cookie->delete('remember_me');
                    }
                    $this->set('cookieHelper', $this->Cookie);

                    $user_data_auth['User']['id'] = $loginuser['User']['id'];
                    $user_data_auth['User']['txt_password'] = $this->request->data['User']['password'];
                    $user_data_auth['User']['is_login'] = 1;
                    $this->User->save($user_data_auth);

                    $post_errand = $this->Session->read('post_errand');
                    if (!empty($post_errand) && count($post_errand) > 0) {
                        $this->without_login_save_post($post_errand);
                        $this->Session->delete('post_errand');
                    }

                    $this->Session->setFlash('Login Successful.', 'default', array('class' => 'success'));
                    return $this->redirect(array('action' => 'home'));
                }
            }
        }
    }

    public function twitter_login() {
        $CONSUMER_KEY = Configure::read('TWITTER_CONSUMER_KEY');
        $CONSUMER_SECRET = Configure::read('TWITTER_CONSUMER_SECRET');
        ;
        $OAUTH_CALLBACK = Configure::read('SITE_URL') . 'users/twitter_login/';
        require_once(ROOT . '/app/Vendor' . DS . 'twitteroauth/twitteroauth.php');
        //App::import('Vendor', 'twitteroauth/twitteroauth.php');
        //App::import('Vendor', 'twitteroauth', array('file' => 'twitteroauth.php'));
        if (isset($_GET['oauth_token'])) {
            $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $this->Session->read('request_token'), $this->Session->read('request_token_secret'));
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($access_token) {
                $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $params = array();
                $params['include_entities'] = 'false';
                $content = $connection->get('account/verify_credentials', $params);

                if ($content && isset($content->screen_name) && isset($content->name)) {
                    //$_SESSION['name']=$content->name;
                    //$_SESSION['image']=$content->profile_image_url;
                    //$_SESSION['twitter_id']=$content->screen_name;
                    $check_exits = $this->User->find('first', array('conditions' => array('User.tw_user_id' => $content->id)));
                    if (!empty($check_exits)) {
                        $this->Session->write('userid', $check_exits['User']['id']);
                        $this->Session->write('username', $check_exits['User']['first_name']);

                        $user_data_auth['User']['id'] = $check_exits['User']['id'];
                        $user_data_auth['User']['is_login'] = 1;
                        $this->User->save($user_data_auth);
                        $this->Session->setFlash(__('Login Successful.', 'default', array('class' => 'success')));

                        $post_errand = $this->Session->read('post_errand');
                        if (!empty($post_errand) && count($post_errand) > 0) {
                            $this->without_login_save_post($post_errand);
                            $this->Session->delete('post_errand');
                        }
                        $this->redirect(array('action' => 'dashboard'));
                    } else {
                        $details = array();
                        if (!empty($content->name)) {
                            $name = explode(" ", $content->name);
                            $details['first_name'] = (!empty($name['0']) ? $name['0'] : '');
                            $details['last_name'] = (!empty($name['1']) ? $name['1'] : '');
                        }
                        $details['tw_user_id'] = $content->id;
                        $details['username'] = $content->screen_name;
                        $details['tw_verification'] = $content->id;
                        //$details['password'] = md5($content->id);
                        $details['join_date'] = date('Y-m-d');
                        $details['is_active'] = 1;
                        $this->Session->write('twitter_details', $details);
                        $this->redirect(array('action' => 'set_email'));
                    }
                    //redirect to main page.
                    //header('Location: login.php');
                } else {
                    echo "<h4> Login Error </h4>";
                    exit;
                }
            }
        } else {
            $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
            $request_token = $connection->getRequestToken($OAUTH_CALLBACK);

            if ($request_token) {
                $token = $request_token['oauth_token'];
                //echo $token;
                $this->Session->write('request_token', $token);
                $this->Session->write('request_token_secret', $request_token['oauth_token_secret']);
                $url = $connection->getAuthorizeURL($token);
                $this->redirect($url);
            } else { //error receiving request token
                echo "Error Receiving Request Token";
                exit;
            }
        }
    }

    public function set_email() {
        $details = $this->Session->read('twitter_details');
        if (empty($details)) {
            $this->redirect(array('action' => 'login'));
        } else {
            if ($this->request->is('post')) {
                $email = $this->request->data['User']['email'];
                if (!empty($email)) {
                    $if_exist = $this->User->find('first', array('conditions' => array('User.email' => $email)));
                    if (empty($if_exist)) {
                        $user_data = array();
                        $user_data['User'] = $details;
                        $user_data['User']['email'] = $email;
                        if ($this->User->save($user_data)) {
                            $this->Session->delete('twitter_details');
                            $this->Session->write('userid', $this->User->getInsertID());
                            $this->Session->write('username', $details['first_name']);

                            $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
                            if ($contact_email) {
                                $adminEmail = $contact_email['Setting']['contact_email'];
                            } else {
                                $adminEmail = 'superadmin@abc.com';
                            }
                            $options = array('conditions' => array('User.id' => $this->User->getInsertID()));
                            $lastInsetred = $this->User->find('first', $options);

                            $this->loadModel('EmailTemplate');
                            $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 4)));
                            $siteurl = Configure::read('SITE_URL');
                            $LOGINLINK = $siteurl . 'users/login';
                            $msg_body = str_replace(array('[USER]', '[LOGINLINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK), $EmailTemplate['EmailTemplate']['content']);

                            /* App::uses('CakeEmail', 'Network/Email');

                              $Email = new CakeEmail();
                              $Email->emailFormat('both');
                              $Email->from(array($adminEmail => $contact_email['Setting']['site_name']));
                              $Email->to($lastInsetred['User']['email']);
                              $Email->subject('Welcome to '.$contact_email['Setting']['site_name']);
                              $Email->send($msg_body); */

                            $this->loadModel('InboxMessage');
                            $InboxMessageData['InboxMessage']['location'] = 'Broshure.pdf';
                            $InboxMessageData['InboxMessage']['user_id'] = $this->User->getInsertID();
                            $InboxMessageData['InboxMessage']['sender_id'] = 2;
                            $InboxMessageData['InboxMessage']['contact_id'] = 1;
                            $InboxMessageData['InboxMessage']['subject'] = 'Welcome to Errand Champion.';
                            $InboxMessageData['InboxMessage']['message'] = 'Welcome to Errand Champion. Please refer to your email for a convenient overview of our client and contractor polices for your reference.';
                            $InboxMessageData['InboxMessage']['date_time'] = date('Y-m-d H:i:s');
                            //$this->request->data['InboxMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
                            //$this->request->data['InboxMessage']['sentmsg_id']=$inboxMessage['InboxMessage']['sentmsg_id'];
                            //$this->request->data['InboxMessage']['contact_id']=$id;


                            $this->InboxMessage->create();
                            $this->InboxMessage->save($InboxMessageData);

                            $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                            $Subject_mail = 'Welcome to ' . $contact_email['Setting']['site_name'];
                            $this->php_mail($lastInsetred['User']['email'], $from, $Subject_mail, $msg_body);

                            $this->Session->setFlash(__('Login Successful.', 'default', array('class' => 'success')));
                            $this->redirect(array('action' => 'dashboard'));
                        } else {
                            $this->Session->setFlash(__('Internal error. Please try again.'));
                        }
                    } else {
                        $this->Session->setFlash(__('Email already exists. Pleas try another.'));
                    }
                } else {
                    $this->Session->setFlash(__('Please enter valid email.'));
                }
                //pr($details);
                //exit;
            } else {

            }
        }
    }

    public function autoLogin($fb_user_id = null) {
        $data = '';
        if ($fb_user_id != '') {
            $options = array('conditions' => array('User.fb_user_id' => $fb_user_id, 'User.is_active' => 1));
            $loginuser = $this->User->find('first', $options);
            if (!$loginuser) {
                $data = 'Register@@@@null';
            } else {
                $this->Session->write('userid', $loginuser['User']['id']);
                $this->Session->write('username', $loginuser['User']['first_name']);

                $user_data_auth['User']['id'] = $loginuser['User']['id'];
                $user_data_auth['User']['is_login'] = 1;
                $this->User->save($user_data_auth);

                $post_errand = $this->Session->read('post_errand');
                if (!empty($post_errand) && count($post_errand) > 0) {
                    $this->without_login_save_post($post_errand);
                    $this->Session->delete('post_errand');
                }

                $this->Session->setFlash(__('Login Successful.', 'default', array('class' => 'success')));
                $data = 'Login@@@@' . $loginuser['User']['first_name'];
            }
        }
        echo $data;
        exit;
    }

    public function without_login_save_post($Pdata = null) {
        $this->autoRender = false;
        $Post_data = $Pdata;
        $userid = $this->Session->read('userid');
        $this->loadModel('EmailTemplate');
        $this->loadModel('Setting');
        $this->loadModel('Category');
        $this->loadModel('Task');

        if (count($Post_data) > 0 && $userid != '') {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
            $userdetails_data = $this->User->find('first', $options);

            $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
            if ($contact_email) {
                $adminEmail = $contact_email['Setting']['contact_email'];
                $adminSiteName = $contact_email['Setting']['site_name'];
            } else {
                $adminEmail = 'superadmin@abc.com';
                $adminSiteName = '';
            }
            if ($userdetails_data['User']['user_type'] == 1 || $userdetails_data['User']['user_type'] == 3) {
                $title = $Post_data['title'];
                $category_id = $Post_data['category_id'];
                $description = $Post_data['description'];
                $completed = $Post_data['completed'];
                $task_location = $Post_data['task_location'];
                $due_date = $Post_data['due_date'];
                $workers = $Post_data['workers'];
                $budget_type = $Post_data['budget_type'];
                $total_rate = $Post_data['total_rate'];
                $per_hour_rate = $Post_data['per_hour_rate'];
                $hour = $Post_data['hour'];

                $optionsCat = array('conditions' => array('Category.id' => $category_id));
                $category_data = $this->Category->find('first', $optionsCat);

                $prepAddr = str_replace(' ', '+', $task_location);
                $url = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=true');
                $output = json_decode($url);
                $lat = $output->results[0]->geometry->location->lat;
                $lang = $output->results[0]->geometry->location->lng;

                $data['Task']['user_id'] = $userid;
                $data['Task']['title'] = $title;
                $data['Task']['description'] = $description;
                $data['Task']['category_id'] = $category_id;
                $data['Task']['pcat_id'] = $category_data['Category']['parent_id'];
                $data['Task']['task_location'] = $task_location;
                $data['Task']['lat'] = $lat;
                $data['Task']['lang'] = $lang;
                $data['Task']['completed'] = $completed;
                $data['Task']['due_date'] = $due_date;
                $data['Task']['workers'] = $workers;
                $data['Task']['budget_type'] = $budget_type;
                $data['Task']['status'] = 2;
                $data['Task']['post_date'] = date('Y-m-d');
                if ($budget_type == 2) {
                    $data['Task']['per_hour_rate'] = $per_hour_rate;
                    $data['Task']['hour'] = $hour;
                    $data['Task']['total_rate'] = $per_hour_rate * $hour;
                } else {
                    $data['Task']['total_rate'] = $total_rate;
                }

                $this->Task->create();
                if ($this->Task->save($data)) {
                    $task_id = $this->Task->getLastInsertId();
                    $tsk = $this->Task->find('first', array('conditions' => array('Task.id' => $task_id)));
                    $this->loadModel('Notification');
                    $noti['Notification']['for_user_id'] = 0;
                    $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                    $noti['Notification']['task_id'] = $tsk['Task']['id'];
                    $noti['Notification']['date'] = date('Y-m-d H:i:s');
                    ;
                    $noti['Notification']['type'] = 'has posted new task';
                    $this->Notification->create();
                    $this->Notification->save($noti);

                    // customer mail send for new task
                    $task_Name = $tsk['Task']['title'];
                    $task_location = $tsk['Task']['task_location'];
                    $taskByUserName = $tsk['User']['first_name'] . ' ' . $tsk['User']['last_name'];
                    if ($task_location != '') {
                        $TaskLocUser = $this->User->find('all', array('conditions' => array('User.location' => $task_location, 'User.id !=' => $userid, 'OR' => array('User.user_type' => 2, 'User.user_type' => 3))));
                    } else {
                        $TaskLocUser = array();
                    }
                    if (count($TaskLocUser) > 0) {
                        foreach ($TaskLocUser as $UserVal) {
                            $SendUserEmail = $UserVal['User']['email'];
                            $SendUserName = $UserVal['User']['first_name'] . ' ' . $UserVal['User']['last_name'];
                            if ($SendUserEmail != '') {

                                $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 11)));
                                $mail_body = str_replace(array('[USER]', '[POSTBY]', '[TASKNAME]', '[TASKLOCATION]'), array($SendUserName, $taskByUserName, $task_Name, $task_location), $EmailTemplate['EmailTemplate']['content']);

                                $from = $adminSiteName . ' <' . $adminEmail . '>';
                                $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                                $this->php_mail($SendUserEmail, $from, $Subject_mail, $mail_body);
                            }
                        }
                    }
                    $this->Session->setFlash('You have successfully post your errand', 'default', array('class' => 'success'));
                }
            }
        }
    }

    public function logout() {
        #return $this->redirect($this->Auth->logout());
        $userid = $this->Session->read('userid');

        if ($userid != '') {
            $user_data['User']['id'] = $userid;
            $user_data['User']['last_login'] = date('Y-m-d H:i:s');
            $user_data['User']['is_login'] = 0;
            $this->User->save($user_data);
        }
        $this->Session->delete('userid');
        $this->Session->delete('username');
        $this->Session->delete('is_signup');
        $this->Session->setFlash('Logged out.', 'default', array('class' => 'success'));
        $this->redirect('/');
    }

    public function userlogout() {

        $userid = $this->Session->read('user_id');
        if ($userid != '') {
            $this->Session->delete('user_id');
            return $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }
    }

    public function billing() {
        $this->loadModel('BillingAddress');
        $title_for_layout = 'Edit Paypal Email';
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Your details have been saved.'));
                return $this->redirect(array('action' => 'billing'));
            } else {
                $this->Session->setFlash(__('Your details could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
            $this->request->data = $this->User->find('first', $options);
        }
        $options = array('conditions' => array('BillingAddress.user_id' => $userid));
        $UserBillingAddress = $this->BillingAddress->find('first', $options);
        $this->set(compact('title_for_layout', 'UserBillingAddress'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function site_logo() {
        $this->loadModel('Setting');
        $setting_array = array('conditions' => array('Setting.id' => '1'));
        $Content = $this->Setting->find('first', $setting_array);

        $logo_name = 'logo.png';

        if ($Content['Setting']['logo'] != '') {
            $logo_name = $Content['Setting']['logo'];
        }

        return $logo_name;
    }

    public function index() {

        $this->loadModel('Country');
        $this->loadModel('Post');
        $this->loadModel('UserBlock');
        $title_for_layout = 'Home';
        $category = $this->Category->find('all');

        $conditions['Post.id !='] = '';
        $conditions['Post.is_approve'] = 1;

        if ($this->request->is('post')) {
            $title = $this->request->data['title'];
            $location = $this->request->data['location'];

            $filter_url['controller'] = $this->request->params['controller'];
            $filter_url['action'] = $this->request->params['action'];
            $filter_url['page'] = 1;
            if (!empty($title)) {

            }
            foreach ($this->data['Filter'] as $name => $value) {
                if ($value) {
                    // You might want to sanitize the $value here
                    // or even do a urlencode to be sure
                    $filter_url[$name] = urlencode($value);
                }
            }
            // now that we have generated an url with GET parameters,
            // we'll redirect to that page
            return $this->redirect($filter_url);

//                $title=$this->request->data['title'];
//                $location=$this->request->data['location'];
//                if(isset($title) && $title!='')
//                {
//                     $conditions['Post.post_title LIKE']= urldecode('%'.$title).'%';
//                     //$conditions['Post.category_name LIKE'] = urldecode('%'.$title).'%';
//                }
//                if(isset($location) && $location!='')
//                {
//                     $conditions['Post.location LIKE'] = urldecode('%'.$location).'%';
//                }
        }
        $userid = $this->Session->read('user_id');
        $blocked_by_users = array();
        if (!empty($userid)) {
            $blocked_by_users = $this->UserBlock->find('list', array('conditions' => array('UserBlock.user_to' => $userid), 'fields' => array('UserBlock.user_by')));
            if (!empty($blocked_by_users)) {
                $conditions['NOT'] = array('Post.user_id' => $blocked_by_users);
            }
        }

        $options_prod = array('conditions' => $conditions);
        $product = $this->Post->find('all', $options_prod);
        //pr($product);
        $options_cont = array('conditions' => array('Country.id' => $product[0]['Category']['country_id']));
        $countries = $this->Country->find('all', $options_cont);
        $this->set(compact('title_for_layout', 'category', 'product', 'countries'));
    }

    public function change_password() {
        $title_for_layout = 'Edit Profile';
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->Session->setFlash(__('Please login to access profile.', 'default', array('class' => 'error')));
            return $this->redirect(array('action' => 'login'));
        }



        $options = array('conditions' => array('User.id'=> $userid));
        $user = $this->User->find('first', $options);

        if ($this->request->is(array('post', 'put'))) {
            $prev_pass = $user['User']['user_pass'];
            $curr_pass = $this->request->data['User']['password'];
            $new_pass = $this->request->data['User']['confpassword'];
            //$PasswordHasher = new SimplePasswordHasher();
            //$curr_pass_hash=$PasswordHasher->hash($curr_pass);
            if ($prev_pass != md5($curr_pass)) {
                $this->Session->setFlash('Invalid current password.', 'default');
                return $this->redirect(array('action' => 'change_password'));
            } else {
                if ($this->request->data['User']['newpassword'] == $this->request->data['User']['confpassword']) {

                    $user_data_auth['User']['id'] = $userid;
                    $user_data_auth['User']['user_pass'] = md5($new_pass);

                    if ($this->User->save($user_data_auth)) {
                        $this->Session->setFlash('Password updated successfully.', 'default', array('class' => 'success'));
                        return $this->redirect(array('action' => 'change_password'));
                    }
                } else {
                    $this->Session->setFlash('Password Does not matched.', 'default');
                    return $this->redirect(array('action' => 'change_password'));
                }
            }
        }
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    public function my_task($type = null) {
        $this->loadModel('Task');
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            return $this->redirect(array('action' => 'login'));
        }

        if ($type == 'complete') {
            $TaskStatusType = 'C';
            $TaskActiveStatus = '2';
            $TaskStatus = " AND (Task.task_status = 'C') AND (Task.status = '2')";
        } elseif ($type == 'assigned') {
            $TaskStatusType = 'A';
            $TaskActiveStatus = '2';
            $TaskStatus = " AND (Task.task_status = 'A') AND (Task.status = '2')";
        } elseif ($type == 'draft') {
            $TaskStatusType = 'O';
            $TaskActiveStatus = '0';
            $TaskStatus = " AND (Task.task_status = 'O') AND (Task.status = '0')";
        } else {
            $TaskStatusType = 'O';
            $TaskActiveStatus = '2';
            $TaskStatus = " AND (Task.task_status = 'O') AND (Task.status = '2')";
        }

        if ($this->request->is(array('post', 'put'))) {
            $Keywords = $this->request->data['Keywords'];
            //$TaskStatus=$this->request->data['TaskStatus'];
            $EndDate = $this->request->data['EndDate'];
            $Price_Max = $this->request->data['Price_Max'];
            $Price_Min = $this->request->data['Price_Min'];
            $Category = $this->request->data['Category'];
            $task_location = $this->request->data['task_location'];
            $WorkType = isset($_REQUEST['WorkType']) ? $_REQUEST['WorkType'] : '';

            $QueryStr = "(Task.user_id=" . $userid . ")" . $TaskStatus;
            if ($Keywords != '') {
                $QueryStr.=" AND (Task.title LIKE '%" . $Keywords . "%')";
            }
            /* if($TaskStatus!=''){
              $QueryStr.=" AND (Task.task_status = '".$TaskStatus."')";
              } */
            if ($EndDate != '') {
                $QueryStr.=" AND (Task.due_date = '" . $EndDate . "')";
            }
            if ($Price_Max != '' and $Price_Min != '') {

                $QueryStr.=" AND (Task.total_rate >= '" . $Price_Min . "' and Task.total_rate<='" . $Price_Max . "')";
            }
            if ($Category != '') {
                $QueryStr.=" AND Task.category_id='" . $Category . "'";
            }
            if ($task_location != '') {
                $QueryStr.=" AND Task.task_location='" . $task_location . "'";
            }
            if ($WorkType != '') {
                $QueryStr.=" AND (Task.completed = '" . $WorkType . "')";
            }
            $options = array('conditions' => array($QueryStr), 'order' => array('Task.id' => 'desc'), 'limit' => 10);
        } else {
            $options = array('conditions' => array('Task.user_id' => $userid, 'Task.task_status' => $TaskStatusType, 'Task.status' => $TaskActiveStatus), 'order' => array('Task.id' => 'desc'), 'limit' => 10);
            $Keywords = '';
            $TaskStatus = '';
            $EndDate = '';
            $Price_Min = '';
            $Price_Max = '';
            $WorkType = '';
        }
        $this->loadModel('Category');

        $categories_lists = $this->Category->find("all", array("conditions" => array("Category.parent_id" => 0)));
        $this->Paginator->settings = $options;
        $TaskList = $this->Paginator->paginate('Task');
        $this->set(compact('title_for_layout', 'TaskList', 'EndDate', 'TaskStatus', 'Keywords', 'Price', 'categories_lists', 'Category', 'task_location', 'Price_Min', 'Price_Max', 'WorkType'));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        }
    }

    /* public function dashboard() {
      $userid = $this->Session->read('userid');
      if(!isset($userid) && $userid==''){
      return $this->redirect(array('action' => 'login'));
      }
      $this->loadModel('Task');
      $this->loadModel('Proposal');
      $this->loadModel('Job');
      $this->loadModel('Notification');
      $this->loadModel('Category');
      $this->loadModel('Skill');

      $this->Category->recursive = 0;
      $options = array('conditions' => array('Category.active'  => 1,'Category.parent_id'=>0), 'order' => 'rand()', 'limit' =>8);
      $categoryList = $this->Category->find('all', $options);

      $options = array('conditions' => array('Task.user_id'  => $userid,'Task.status'=>0));
      $tasksDraft = $this->Task->find('count', $options);
      $options = array('conditions' => array('Task.user_id'  => $userid,'Task.task_status'=>'O','Task.status'=>2));
      $tasksOpen = $this->Task->find('count', $options);
      $options = array('conditions' => array('Task.user_id'  => $userid,'Task.task_status'=>'A','Task.status'=>2));
      $tasksAccept = $this->Task->find('count', $options);
      $options = array('conditions' => array('Task.user_id'  => $userid,'Task.task_status'=>'C'));
      $tasksComplete = $this->Task->find('count', $options);

      $options = array('conditions' => array('Job.user_id'  => $userid,'Job.is_finished'=>0));
      $jobAssign = $this->Job->find('count', $options);
      $options = array('conditions' => array('Job.user_id'  => $userid,'Job.is_finished'=>1));
      $jobCompleted = $this->Job->find('count', $options);
      //$bid_options = array('conditions' => array('Proposal.user_id'  => $userid, 'OR'=>array('Proposal.is_accepted'=>0, 'Proposal.is_accepted'=>1)));
      $this->Proposal->recursive = -1;
      $bid_options = array('conditions' => array('Proposal.user_id'  => $userid, 'Proposal.is_accepted'=>0));
      $jobBidOn = $this->Proposal->find('count', $bid_options);

      $this->Notification->recursive = 0;
      $options = array('conditions' => array('Notification.for_user_id'=>$userid),'order'=>array('Notification.id Desc'),'limit'=>10);
      $mynotifications = $this->Notification->find('all',$options);
      $options = array('conditions' => array('Notification.id !='=>0),'order'=>array('Notification.id Desc'),'limit'=>10);
      $notifications = $this->Notification->find('all',$options);

      $options = array('conditions' => array('User.is_active'  => 1,'User.id'=>$userid));
      $userDetails = $this->User->find('first', $options);

      $Skilloptions = array('conditions' => array('Skill.user_id'=>$userid));
      $userSkills = $this->Skill->find('first', $Skilloptions);

      $wip_options = array('conditions' => array('Job.user_id'  => $userid,'Job.is_finished'=>0));
      $jobAssign_wip = $this->Job->find('all', $wip_options);

      $options_task = array('conditions' => array('Task.user_id'  => $userid));
      $MytasksList = $this->Task->find('all', $options_task);

      $this->set(compact('notifications','mynotifications','jobBidOn','jobCompleted','jobAssign','tasksComplete','tasksAccept','tasksOpen','tasksDraft','categoryList','userDetails', 'userSkills', 'jobAssign_wip', 'MytasksList'));
      } */

    public function signup($type = NULL) {
        ini_set('memory_limit', '-1');
        set_time_limit(0); 
        $userid = $this->Session->read('userid');
        $username = $this->Session->read('username');
        if (isset($userid) && $userid != '') {
            return $this->redirect(array('action' => 'home'));
        }
        $title_for_layout = 'Sign up';
        if ($this->request->is('post')) {
            //if(!$username){
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email']));
            $emailexists = $this->User->find('first', $options);

            // $Post_type = $this->request->data['Post_type'];
            // $Run_type = $this->request->data['Run_type'];
            /*   if ($Post_type == 'Post') {
              $UserType = 1;
              }

              if ($Run_type == 'Run') {
              $UserType = 2;
              }
              if ($Run_type == 'Run' && $Post_type == 'Post') {
              $UserType = 3;
              }

              if ($Run_type == '' && $Post_type == '') {
              $UserType = 3;
              } */
            if (!$emailexists) {

                if ($this->request->data['User']['password'] == $this->request->data['User']['conpassword']) {
                    $chk = $this->request->data['User']['admin_type'];
                    $this->request->data['User']['txt_password'] = $this->request->data['User']['password'];
                    $this->request->data['User']['user_pass'] = md5($this->request->data['User']['password']);
                    $this->request->data['User']['business_name'] = isset($this->request->data['User']['business_name']) ? $this->request->data['User']['business_name'] : '';
                    $this->request->data['User']['email_address'] = $this->request->data['User']['email'];
                    $this->request->data['User']['Phone_number'] = $this->request->data['User']['phone'];

                    // $this->request->data['User']['admin_type'] = $this->request->data['User']['admin_type'];
                    // $this->request->data['User']['city'] = '';
                    // $this->request->data['User']['country'] = 0;
                    // $this->request->data['User']['birthday'] = '0000-00-00';
                    //  $this->request->data['User']['about'] = '';
                    //  $this->request->data['User']['location'] = $this->request->data['User']['location'];
                    // $this->request->data['User']['zipcode'] = isset($this->request->data['User']['zipcode']) ? $this->request->data['User']['zipcode'] : '0';
                    // $this->request->data['User']['join_date'] = date('Y-m-d');
                    //  $this->request->data['User']['is_active'] = 1;
                    //  $this->request->data['User']['fb_user_id'] = $this->request->data['User']['fb_user_id'];
                    //  $this->request->data['User']['fb_verification'] = $this->request->data['User']['fb_user_id'];
                    //  $this->request->data['User']['user_type'] = $UserType;
                    // $this->User->create();

                    if ($this->User->save($this->request->data)) {
                        $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
                        if ($contact_email) {
                            $adminEmail = $contact_email['Setting']['site_email'];
                        } else {
                            $adminEmail = 'superadmin@abc.com';
                        }
                        $options = array('conditions' => array('User.id' => $this->User->getLastInsertId()));
                        $lastInsetred = $this->User->find('first', $options);

                        $this->loadModel('EmailTemplate');
                        $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 5)));
                        $siteurl = Configure::read('SITE_URL');
                        $LOGINLINK = $siteurl . 'users/login';
                        $ACTIVATELINK = $siteurl . 'users/activate_account/' . base64_encode($this->User->getLastInsertId());
                        $msg_body = str_replace(array('[USER]', '[LOGINLINK]', '[ACTIVATELINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK, $ACTIVATELINK), $EmailTemplate['EmailTemplate']['content']);

                        /* App::uses('CakeEmail', 'Network/Email');

                          $Email = new CakeEmail();
                          $Email->emailFormat('both');
                          $Email->from(array($adminEmail => $contact_email['Setting']['site_name']));
                          $Email->to($lastInsetred['User']['email']);
                          $Email->subject('Welcome to '.$contact_email['Setting']['site_name']);
                          $Email->send($msg_body); */

                        $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                        //$Subject_mail='Welcome to '.$contact_email['Setting']['site_name'];
                        $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                        $this->php_mail($lastInsetred['User']['email_address'], $from, $Subject_mail, $msg_body);
                        /* $Email->from(array($this->request->data['Page']['from_email'] => $this->request->data['Page']['from_name']));
                          $Email->to($this->request->data['Page']['to_email']);
                          $Email->subject($this->request->data['Page']['subject']);
                          $Email->send($this->request->data['Page']['message']); */
                        /*  $this->loadModel('InboxMessage');
                          $InboxMessageData['InboxMessage']['location'] = 'Broshure.pdf';
                          $InboxMessageData['InboxMessage']['user_id'] = $this->User->getLastInsertId();
                          $InboxMessageData['InboxMessage']['sender_id'] = 2;
                          $InboxMessageData['InboxMessage']['contact_id'] = 1;
                          $InboxMessageData['InboxMessage']['subject'] = 'Welcome to Errand Champion.';
                          $InboxMessageData['InboxMessage']['message'] = 'Welcome to Errand Champion. Please refer to your email for a convenient overview of our client and contractor polices for your reference.';
                          $InboxMessageData['InboxMessage']['date_time'] = date('Y-m-d H:i:s'); */
                        //$this->request->data['InboxMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
                        //$this->request->data['InboxMessage']['sentmsg_id']=$inboxMessage['InboxMessage']['sentmsg_id'];
                        //$this->request->data['InboxMessage']['contact_id']=$id;
                        // $this->InboxMessage->create();
                        // $this->InboxMessage->save($InboxMessageData);

                        $this->Session->setFlash(__('Thanks for registering.Welcome message has been sent to your email', 'default', array('class' => 'success')));
                        $this->Session->write('is_signup', '1');
                        //$this->Session->write('userid', $lastInsetred['User']['id']);
                        //$this->Session->write('username', $lastInsetred['User']['first_name']);
                        return $this->redirect(array('action' => 'home'));
                        //return $this->redirect(array('action' => 'login'));
                    } else {
                        $this->Session->setFlash(__('Sorry your details could not be saved. Please, try again.', 'default', array('class' => 'error')));
                    }
                } else {
                    $this->Session->setFlash(__('Password and Confirm Password Mismatch. Please, try again.', 'default', array('class' => 'error')));
                }
            } else {
                $this->Session->setFlash(__('Email already exists. Please, try another.', 'default', array('class' => 'error')));
            }
            //}
        }

        $signup_type = '' ;
        if($type=='provider'){ $signup_type = 1; }
        if($type=='student'){ $signup_type = 2; }

        $this->loadModel('Lga');
        $countries = $this->Country->find('all');
        $states = $this->State->find('all',array('conditions'=>array('State.country_id'=>160)));
        $lgas = $this->Lga->find('all');
        $this->set(compact('title_for_layout','countries','states','signup_type','lgas'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    public function editprofile() {
        $title_for_layout = 'Edit Profile';
        $countryname = '';
        $this->Session->delete('profile_setting_change');
        $username = $this->Session->read('username');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
//        pr($this->request->data);
//            exit();
        if ($this->request->is(array('post', 'put'))) {

            $emailExists = $this->User->find('first', array('conditions' => array('User.email_address' => $this->request->data['User']['email_address'])));
            if (!empty($emailExists)) {
                if ($emailExists['User']['id'] != $this->request->data['User']['id']) {
                    $this->Session->setFlash('Email already exists.', 'default', array('class' => 'error'));
                    $this->redirect(array('action' => 'editprofile'));
                } else {
                    if ($this->User->save($this->request->data)) {
                        $this->Session->write('email', $this->request->data['User']['email_address']);
                        $this->Session->setFlash('Profile saved.', 'default', array('class' => 'success'));
                        $this->redirect(array('action' => 'editprofile'));
                    } else {
                        $this->Session->setFlash('Update failed.', 'default', array('class' => 'error'));
                        $this->redirect(array('action' => 'editprofile'));
                    }
                }
            } else {
                if ($this->User->save($this->request->data)) {
                    $this->Session->write('email', $this->request->data['User']['email_address']);
                    $this->Session->setFlash('Profile saved.', 'default', array('class' => 'success'));
                    $this->redirect(array('action' => 'editprofile'));
                } else {
                    $this->Session->setFlash('Update failed.', 'default', array('class' => 'error'));
                    $this->redirect(array('action' => 'editprofile'));
                }
            }
            //pr($this->request->data);
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
            $this->request->data = $this->User->find('first', $options);
        }

        $option = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $userDetails = $this->User->find('first', $option);

        $this->loadModel('Lga');
        $countries = $this->User->Country->find('list');
        $states = $this->User->State->find('list', array('fields' => array('State.id', 'State.name'), 'conditions' => array('State.country_id' => $userDetails['User']['country'])));
        $cities = $this->User->City->find('list', array('fields' => array('City.id', 'City.name'), 'conditions' => array('City.state_id' => $userDetails['User']['state'])));
        $lgas = $this->User->Lga->find('list', 
            array('fields' => array('Lga.id', 'Lga.local_name'))
            );
        //pr($states);

        $this->set(compact('countries', 'states', 'cities','lgas','userDetails'));


        /* if ($this->request->is(array('post', 'put'))) {
          #pr($this->data);
          #exit;
          $Post_type = $this->request->data['Post_type'];
          $Run_type = $this->request->data['Run_type'];
          if ($Post_type == 'Post') {
          $UserType = 1;
          }

          if ($Run_type == 'Run') {
          $UserType = 2;
          }

          if ($Run_type == 'Run' && $Post_type == 'Post') {
          $UserType = 3;
          }

          $this->request->data['User']['user_type'] = isset($UserType) ? $UserType : 3;

          if (empty($this->request->data['User']['first_name'])) {
          $this->Session->setFlash(__('Please enter your first name.'));
          return $this->redirect(array('action' => 'editprofile'));
          }
          if (empty($this->request->data['User']['last_name'])) {
          $this->Session->setFlash(__('Please enter your last name.'));
          return $this->redirect(array('action' => 'editprofile'));
          }
          if (empty($this->request->data['User']['birthday'])) {
          $this->Session->setFlash(__('Please enter your birthday.'));
          return $this->redirect(array('action' => 'editprofile'));
          }

          if (isset($this->request->data['User']['profile_img']) && $this->request->data['User']['profile_img']['name'] != '') {
          $ext = explode('/', $this->request->data['User']['profile_img']['type']);
          if ($ext) {
          $uploadFolder = "user_images";
          $uploadPath = WWW_ROOT . $uploadFolder;
          $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
          if (in_array($ext[1], $extensionValid)) {

          $max_width = "500";
          $size = getimagesize($this->request->data['User']['profile_img']['tmp_name']);

          $width = $size[0];
          $height = $size[1];
          $imageName = $this->request->data['User']['id'] . '_' . (strtolower(trim($this->request->data['User']['profile_img']['name'])));
          $full_image_path = $uploadPath . '/' . $imageName;
          move_uploaded_file($this->request->data['User']['profile_img']['tmp_name'], $full_image_path);
          $this->request->data['User']['profile_img'] = $imageName;

          if ($width > $max_width) {
          $scale = $max_width / $width;
          $uploaded = $this->resizeImage($full_image_path, $width, $height, $scale);
          } else {
          $scale = 1;
          $uploaded = $this->resizeImage($full_image_path, $width, $height, $scale);
          }
          unlink($uploadPath . '/' . $this->request->data['User']['hidprofile_img']);
          } else {
          $this->Session->setFlash(__('Please upload image of .jpg, .jpeg, .png or .gif format.'));
          return $this->redirect(array('action' => 'editprofile'));
          }
          /* $uploadFolder = "user_images";
          $uploadPath = WWW_ROOT . $uploadFolder;
          $extensionValid = array('jpg','jpeg','png','gif');
          if(in_array($ext[1],$extensionValid)){
          $imageName = $this->request->data['User']['id'].'_'.(strtolower(trim($this->request->data['User']['profile_img']['name'])));
          $full_image_path = $uploadPath . '/' . $imageName;
          move_uploaded_file($this->request->data['User']['profile_img']['tmp_name'],$full_image_path);
          $this->request->data['User']['profile_img'] = $imageName;
          #exit;
          //unlink($uploadPath. '/' .$this->request->data['User']['hidprofile_img']);
          } else{
          $this->Session->setFlash(__('Please upload image of .jpg, .jpeg, .png or .gif format.'));
          return $this->redirect(array('action' => 'editprofile'));
          } */
        /* }
          } else {
          $this->request->data['User']['profile_img'] = $this->request->data['User']['hidprofile_img'];
          /* if(empty($this->request->data['User']['profile_img']))
          {
          $this->Session->setFlash(__('Please upload your profile image.'));
          return $this->redirect(array('action' => 'editprofile'));
          } */
        /* }

          if ($this->User->save($this->request->data)) {
          $this->Session->setFlash(__('Your details have been saved.'));
          return $this->redirect(array('action' => 'editprofile'));
          } else {
          $this->Session->setFlash(__('Your details could not be saved. Please, try again.'));
          }
          } else {
          $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
          $this->request->data = $this->User->find('first', $options);
          if (isset($this->request->data['User']['country']) && $this->request->data['User']['country'] != 0) {
          $countryname = $this->Country->find('first', array('conditions' => array('Country.id' => $this->request->data['User']['country']), 'fields' => array('Country.printable_name')));
          #pr($countryname);
          $countryname = $countryname['Country']['printable_name'];
          }
          #pr($this->request->data);
          }
          $countries = $this->Country->find('list', array('fields' => array('Country.printable_name')));
          $this->set(compact('title_for_layout', 'countries', 'countryname')); */
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function admin_index() {


        $title_for_layout = 'Admin Login';
        $this->set(compact('title_for_layout'));
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (isset($is_admin) && $is_admin != '') {
            //$this->redirect('/admin/users/edit/' . $userid);
            $this->redirect('/admin/dashboards/index');
        }

        $site_logo = $this->site_logo();
        $this->set('logo', $site_logo);
        #$this->User->recursive = 0;
        #$this->set('users', $this->Paginator->paginate());
    }

    public function admin_list() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $countries = $this->User->Country->find('list');
        $title_for_layout = 'User List';
        $active_user = $this->User->find("count", array('conditions' => array('User.status' => 1, 'User.id !=' => 2, 'User.is_admin' => 0)));
        $inactive_user = $this->User->find("count", array('conditions' => array('User.status' => 0, 'User.id !=' => 2, 'User.is_admin' => 0)));
        if ($this->request->is(array('post', 'put'))) {
            //pr($this->request->data);exit;
            $phonenumber = $this->request->data['phonenumber'];
            $email = $this->request->data['email'];
            $name = $this->request->data['name'];
            $QueryStr = "(User.id !='2'  AND User.is_admin ='0')";
            if ($name != '') {
                $QueryStr.=" AND ((User.first_name LIKE '%" . $name . "%') OR (User.last_name LIKE '%" . $name . "%'))";
            }
            if ($email != '') {
                $QueryStr.=" AND (User.email_address = '" . $email . "')";
            }
            if ($phonenumber != '') {
                $QueryStr.=" AND (User.Phone_number LIKE '%" . $phonenumber . "%')";
            }
            $options = array('conditions' => array($QueryStr), 'order' => array('User.id' => 'desc'));
            // pr($options);
            //exit;
            //$Newsearch_is_active=$search_is_active;
        } else {
            $options = array('conditions' => array('User.id !=' => 2, 'User.is_admin' => 0), 'order' => array('User.id' => 'desc'));
            $phonenumber = '';
            $email = '';
            $name = '';
        }



        //$options = array('User.id !=' => 2);
        //$this->set('user', $this->User->find('first', $options));
        $this->Paginator->settings = $options;
        $this->set('users', $this->Paginator->paginate('User'));
        $this->set(compact('title_for_layout', 'phonenumber', 'email', 'name', 'active_user', 'inactive_user', 'my_variable'));
    }

    public function admin_alllist() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Admin User List';
        //$active_user=$this->User->find("count",array('conditions'=>array('User.is_active'=>1,'User.id !='=>2)));
        //$inactive_user=$this->User->find("count",array('conditions'=>array('User.is_active'=>0,'User.id !='=>2)));
        if ($this->request->is(array('post', 'put'))) {
            //pr($this->request->data);exit;
            $Keywords = $this->request->data['keyword'];
            $search_is_active = $this->request->data['search_is_active'];
            $user_type = $this->request->data['user_type'];
            $QueryStr = "(User.id !='2' AND User.is_admin ='1')";
            if ($Keywords != '') {
                $QueryStr.=" AND ((User.first_name LIKE '%" . $Keywords . "%') OR (User.username LIKE '%" . $Keywords . "%') OR (User.email LIKE '%" . $Keywords . "%'))";
            }
            if ($search_is_active != '') {
                $QueryStr.=" AND (User.is_active = '" . $search_is_active . "')";
            }
            if ($user_type != '') {
                $QueryStr.=" AND (User.user_type = '" . $user_type . "')";
            }
            $options = array('conditions' => array($QueryStr), 'order' => array('User.id' => 'desc'));
            // pr($options);
            //exit;
            $Newsearch_is_active = $search_is_active;
        } else {
            $options = array('conditions' => array('User.id !=' => 2, 'User.is_admin' => 1), 'order' => array('User.id' => 'desc'));
            $Keywords = '';
            $Newsearch_is_active = '';
            $user_type = '';
        }

        //$options = array('User.id !=' => 2);
        //$this->set('user', $this->User->find('first', $options));
        $this->Paginator->settings = $options;
        $this->set('users', $this->Paginator->paginate('User'));
        $this->set(compact('title_for_layout', 'Keywords', 'Newsearch_is_active', 'user_type', 'active_user', 'inactive_user'));
    }

    public function admin_export() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $options = array('User.id !=' => 2);
        $users = $this->User->find('all', array('conditions' => $options));
        $output = '';
        $output .='ID, First Name, Last Name, Username, Email, Location, IP, Is Active, Is Admin';
        $output .="\n";

        if (!empty($users)) {
            foreach ($users as $user) {
                $isactive = ($user['User']['is_active'] == 1) ? 'Yes' : 'No';
                $isadmin = ($user['User']['is_admin'] == 1) ? 'Yes' : 'No';
                $UserIP = isset($user['Activity'][0]['ip']) ? $user['Activity'][0]['ip'] : '';
                //$output .='"'.$user['User']['first_name'].'","'.$user['User']['last_name'].'","'.$user['User']['username'].'","'.$user['User']['email'].'","'.$isactive.'","'.$isadmin.'"';
                $output .='"' . $user['User']['id'] . '","' . $user['User']['first_name'] . '","' . $user['User']['last_name'] . '","' . $user['User']['username'] . '","' . $user['User']['email'] . '","' . $user['User']['location'] . '","' . $UserIP . '","' . $isactive . '","' . $isadmin . '"';
                $output .="\n";
            }
        }
        $filename = "users" . time() . ".csv";
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
    public function admin_view($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'User View';
        $this->set(compact('title_for_layout'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function admin_add() {
        $this->loadModel('UserImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $countries = $this->User->Country->find('list');
        $this->request->data1 = array();
        $title_for_layout = 'User Add';
        $this->set(compact('title_for_layout', 'countries'));
        if ($this->request->is('post')) {
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email_address']));
            $emailexists = $this->User->find('first', $options);
            if (!$emailexists) {
                if (!empty($this->request->data['User']['image']['name'])) {
                    $pathpart = pathinfo($this->request->data['User']['image']['name']);
                    $ext = $pathpart['extension'];
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array(strtolower($ext), $extensionValid)) {
                        $uploadFolder = "user_images/";
                        $uploadPath = WWW_ROOT . $uploadFolder;
                        $filename = uniqid() . '.' . $ext;
                        $full_flg_path = $uploadPath . '/' . $filename;
                        move_uploaded_file($this->request->data['User']['image']['tmp_name'], $full_flg_path);
                        $this->request->data1['UserImage']['originalpath'] = $filename;
                        $this->request->data1['UserImage']['resizepath'] = $filename;
                    } else {
                        $this->Session->setFlash(__('Invalid image type.'));
                    }
                } else {
                    $filename = '';
                }
                $this->request->data['User']['user_pass'] = md5($this->request->data['User']['user_pass']);
                $this->request->data['User']['member_since'] = date('Y-m-d h:m:s');
                $this->User->create();
                #pr($this->data);
                #exit;
                if ($this->User->save($this->request->data)) {
                    $this->request->data1['UserImage']['user_id'] = $this->User->id;
                    //pr($this->request->data1);
                    //exit;
                    $this->UserImage->save($this->request->data1);
                    $this->Session->setFlash(__('The user has been saved.', 'default', array('class' => 'success')));
                    return $this->redirect(array('action' => 'admin_list'));
                } else {
                    $this->Session->setFlash(__('The user could not be saved. Please, try again.', 'default', array('class' => 'error')));
                }
            } else {
                $this->Session->setFlash(__('Email already exists. Please, try another.', 'default', array('class' => 'error')));
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
    public function admin_edit($id = null) {
        $this->loadModel('UserImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->request->data1 = array();
        $title_for_layout = 'User Edit';
        $this->set(compact('title_for_layout'));
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if (!empty($this->request->data['User']['image']['name'])) {
                $pathpart = pathinfo($this->request->data['User']['image']['name']);
                $ext = $pathpart['extension'];
                $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array(strtolower($ext), $extensionValid)) {
                    $uploadFolder = "user_images/";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid() . '.' . $ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['User']['image']['tmp_name'], $full_flg_path);
                    $this->request->data1['UserImage']['originalpath'] = $filename;
                    $this->request->data1['UserImage']['resizepath'] = $filename;
                    if (isset($this->request->data['User']['userimage_id']) && $this->request->data['User']['userimage_id'] != '') {
                        $this->request->data1['UserImage']['id'] = $this->request->data['User']['userimage_id'];
                    }
                    $this->request->data1['UserImage']['user_id'] = $id;
                    //pr($this->request->data1);
                    //exit;
                    $this->UserImage->save($this->request->data1);
                } else {
                    $this->Session->setFlash(__('Invalid image type.'));
                }
            } else {
                $filename = '';
            }

            if (isset($this->request->data['User']['user_pass']) && $this->request->data['User']['user_pass'] != '') {
                //$this->request->data['User']['txt_password'] = $this->request->data['User']['user_pass'];
                $this->request->data['User']['user_pass'] = md5($this->request->data['User']['user_pass']);
            } else {
                $this->request->data['User']['user_pass'] = $this->request->data['User']['hidpw'];
            }
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'));
                return $this->redirect(array('action' => 'list'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
            }
        } else {

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function admin_delete($id = null) {
        $this->loadModel('UserImage');
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            //$this->UserImage->delete()
            $this->Session->setFlash(__('The user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'admin_list'));
    }

    public function admin_login() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        echo $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (isset($is_admin) && $is_admin != '') {
            //$this->redirect('/admin/users/edit/' . $userid);
            $this->redirect('/admin/dashboards/index/');
        }
        if ($this->request->is('post')) {
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['usernamel'], 'User.user_pass' => md5($this->request->data['User']['passwordl']), 'User.is_admin' => 1));
            $loginuser = $this->User->find('first', $options);
            if (!$loginuser) {
                $this->Session->setFlash(__('Invalid username or password, try again', 'default', array('class' => 'error')));
                return $this->redirect(array('action' => 'admin_index'));
            } else {
                $this->Session->write('adminuserid', $loginuser['User']['id']);
                $this->Session->write('is_admin', 1);
                $this->Session->setFlash(__('You have been successfully logged in', 'default', array('class' => 'success')));
                return $this->redirect(array('action' => 'admin_index', $loginuser['User']['id']));
            }
        }
    }

    public function admin_logout() {
        #return $this->redirect($this->Auth->logout());
        $this->Session->delete('adminuserid');
        $this->Session->delete('is_admin');
        $this->redirect('/admin');
    }

    public function admin_fotgot_password() {
        $title_for_layout = 'Forgot Password';
        $this->set(compact('title_for_layout'));
        $site_logo = $this->site_logo();
        $this->set('logo', $site_logo);

        if ($this->request->is(array('post', 'put'))) {
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email_address'], 'User.is_admin' => 1));
            $user = $this->User->find('first', $options);
            if ($user) {
                //$password = $this->User->get_fpassword();
                $password = $user['User']['txt_password'];
                //$this->request->data['User']['id'] = $user['User']['id'];
                //$this->request->data['User']['password'] = $password;
                if ($password != '') {
                    $key = Configure::read('CONTACT_EMAIL');
                    $this->loadModel('EmailTemplate');
                    $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 1)));
                    $mail_body = str_replace(array('[EMAIL]', '[PASSWORD]'), array($this->request->data['User']['email'], $password), $EmailTemplate['EmailTemplate']['content']);
                    $this->send_mail($key, $this->request->data['User']['email'], $EmailTemplate['EmailTemplate']['subject'], $mail_body);
                    $this->Session->setFlash('A new password has been sent to your mail. Please check mail.', 'default', array('class' => 'success'));
                } else {
                    $this->Session->setFlash("Sorry! some internal error occured.Please try again later.");
                }
            } else {
                $this->Session->setFlash("Invalid email or You are not authorize to access.");
            }
        }
    }

    public function emailExists($email = null) {
        $data = '';
        if ($email) {
            $emailexists = $this->User->find('first', array('conditions' => array('User.email' => $email), 'fields' => array('User.id')));
            if ($emailexists) {
                $data = 'Email already exists. Please try another.';
            } else {
                $data = '';
            }
        }
        echo $data;
        exit;
    }

    public function admin_reset($id) {
        $id = base64_decode($id);
        if ($this->request->is(array('post', 'put'))) {

        }
    }


    public function activationlink()
    {
        $title_for_layout = 'Get Activation link';

        if ($this->request->is(array('post', 'put')))
        {
            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email']));
            $user = $this->User->find('first', $options);
            if ($user)
            {
                $check_activation=$user['User']['activated'];

                if($check_activation==1)
                {
                    $this->Session->setFlash(__('User already activated.'));
                }
                else
                {
                    $lastInsetred=$user;
                    $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
                    if ($contact_email) {
                        $adminEmail = $contact_email['Setting']['site_email'];
                    } else {
                        $adminEmail = 'superadmin@abc.com';
                    }

                    $user_id=$user['User']['id'];

                    $this->loadModel('EmailTemplate');
                    $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 5)));
                    $siteurl = Configure::read('SITE_URL');
                    $LOGINLINK = $siteurl . 'users/login';
                    $ACTIVATELINK = $siteurl . 'users/activate_account/' . base64_encode($user_id);
                    $msg_body = str_replace(array('[USER]', '[LOGINLINK]', '[ACTIVATELINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK, $ACTIVATELINK), $EmailTemplate['EmailTemplate']['content']);

                    $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                    $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];

                    $this->php_mail($lastInsetred['User']['email_address'], $from, $Subject_mail, $msg_body);

                    $this->Session->setFlash(__('Activation link has been sent to your email', 'default', array('class' => 'success')));


                }
            }
            else
            {

                $this->Session->setFlash(__('Invalid email provided. Please, try again.'));

            }

        }

        $this->set(compact('title_for_layout'));
    }

    public function forgotpassword() {
        $title_for_layout = 'Forgot Password';
        $this->set(compact('title_for_layout'));
        if ($this->request->is(array('post', 'put'))) {

            $options = array('conditions' => array('User.email_address' => $this->request->data['User']['email']));
            $user = $this->User->find('first', $options);
            if ($user) {
                $link = '<a href="http://107.170.152.166/team4/ladder/users/resetpassword/' . base64_encode($user['User']['id']) . '">Reset Password</a>';
                $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
                if ($contact_email) {
                    $adminEmail = $contact_email['Setting']['site_email'];
                } else {
                    $adminEmail = 'superadmin@abc.com';
                }
                $site_name = $contact_email['Setting']['site_name'];

                $this->loadModel('EmailTemplate');
                $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 4)));

                $from = $site_name . ' <' . $adminEmail . '>';
                $Subject_mail = $site_name . ' Forgot Password';

                $msg_body = str_replace(array('[USER]', '[EMAIL]', '[LINK]'), array($user['User']['first_name'], $user['User']['email_address'], $link), $EmailTemplate['EmailTemplate']['content']);

                $this->php_mail($user['User']['email_address'], $from, $Subject_mail, $msg_body);

                $this->Session->setFlash(__('A link has been sent to your email to reset your password.'));
                return $this->redirect(array('action' => 'forgotpassword'));
            } else {
                $this->Session->setFlash(__('Invalid email provided. Please, try again.'));
            }
        }
    }

    public function resetpassword($userid) {
        $id = base64_decode($userid);
        if ($this->request->is('post')) {
            $this->request->data['User']['user_pass'] = md5($this->request->data['User']['password']);
            $this->User->save($this->request->data);
            return $this->redirect(array('action' => 'login'));
            $this->Session->setFlash(__('You password have been successfully changed', 'default', array('class' => 'success')));
        }
        $this->set('id', $userid);
    }

    public function settings() {
        $title_for_layout = 'Account Settings';
        $countryname = '';
        $username = $this->Session->read('username');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            #pr($this->data);
            #exit;
            if (isset($this->request->data['User']['password']) && $this->request->data['User']['password'] != '') {
                $this->request->data['User']['txt_password'] = $this->request->data['User']['password'];
                $this->request->data['User']['password'] = md5($this->request->data['User']['password']);
            } else {
                $this->request->data['User']['password'] = $this->request->data['User']['hidpassword'];
            }

            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('Profile settings have been updated successfully.'));
                return $this->redirect(array('action' => 'settings'));
            } else {
                $this->Session->setFlash(__('Your details could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
            $this->request->data = $this->User->find('first', $options);
            if (isset($this->request->data['User']['country']) && $this->request->data['User']['country'] != 0) {
                $countryname = $this->Country->find('first', array('conditions' => array('Country.id' => $this->request->data['User']['country']), 'fields' => array('Country.printable_name')));
                $countryname = $countryname['Country']['printable_name'];
            }
        }
        $countries = $this->Country->find('list', array('fields' => array('Country.printable_name')));
        $this->set(compact('title_for_layout', 'countries', 'countryname'));
    }

    function admin_dashboard() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('Category');

        $this->loadModel('Activity');
        $activities = $this->Activity->find('all', array('limit' => 10, 'order' => 'Activity.id DESC'));

        $this->loadModel('Task');
        $total_user = $this->User->find("count", array('conditions' => array('User.id !=' => 2)));
        $active_user = $this->User->find("count", array('conditions' => array('User.is_active' => 1, 'User.is_admin' => 0, 'User.id !=' => 2)));
        $inactive_user = $this->User->find("count", array('conditions' => array('User.is_active' => 0, 'User.id !=' => 2)));
        $total_taskers = $this->User->find("count", array('conditions' => array('OR' => array('User.user_type' => array(2, 3)), 'User.is_active' => 1, 'User.is_admin' => 0)));
        $tot_admin_user = $this->User->find("count", array('conditions' => array('User.is_admin' => 1, 'User.id !=' => 2)));
        $conditions['OR']['Task.status'] = 0;
        $conditions['OR']['Task.status'] = 1;
        $conditions['OR']['Task.status'] = 2;
        //$total_task=$this->Task->find("count",array("conditions"=>$conditions));
        $total_task = $this->Task->find("count");
        $categories_list = $this->Category->find('all', array('fields' => array('Category.id', 'Category.name'), 'conditions' => array('Category.active' => 1, 'Category.parent_id != ' => 0)));

        $this->set(compact('total_task', 'total_user', 'total_taskers', 'activities', 'active_user', 'inactive_user', 'categories_list', 'tot_admin_user'));
    }

    function admin_changepwd() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        if ($this->request->is(array('post', 'put'))) {

            $this->User->create();
            $this->request->data['User']['user_pass'] = md5($this->request->data['User']['password']);
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('Your password changed successfully.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'changepwd'));
            } else {

            }
        }
    }

    ///////////////////////////////Ak/////////////////////////////////////
    public function profile($id = null) {
        $title_for_layout = 'Profile';
        $id = base64_decode($id);
        $options = array('conditions' => array('User.id' => $id));
        $user = $this->User->find('first', $options);
        $venue = $this->Venue->find('all', array('conditions' => array('Venue.user_id' => $id,'Venue.featured'=>'1')));
        $this->Post->recursive = -1;
        $course = $this->Post->find('all',array('conditions'=> array('Post.user_id'=>$id)));


//        $this->loadModel('Country');
//        $this->loadModel('Task');
//        $this->loadModel('Skill');
//        $this->loadModel('Rating');
//        $this->loadModel('Job');
//
//        $options = array('conditions' => array('Task.user_id' => $user['User']['id'], 'Task.status' => 2));
//        $tasks = $this->Task->find('count', $options);
//
//        /* $options = array('conditions' => array('Task.user_id' => $user['User']['id'],'Task.status'=>2,'Task.task_status'=>'C'));
//          $complete = $this->Task->find('count', $options); */
//        $options = array('conditions' => array('Job.user_id' => $user['User']['id'], 'Job.is_finished' => 1));
//        $complete = $this->Job->find('count', $options);
//
//        $options = array('conditions' => array('Skill.user_id' => $id));
//        $skill = $this->Skill->find('first', $options);
//
//        $options = array('conditions' => array('Country.id' => $user['User']['country']));
//        $country = $this->Country->find('first', $options);
//
//        $RatingOptions = array('conditions' => array('Rating.user_id' => $id), 'order' => array('Rating.id Desc'));
//        $Reviews = $this->Rating->find('all', $RatingOptions);


        $this->Comment->recursive = 2;
        $comments = $this->Comment->find('all');
        $this->set(compact('title_for_layout', 'user','comments','venue','course'));
    }

    public function review() {
        $title_for_layout = 'Review';
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            return $this->redirect(array('action' => 'login'));
        }

        $this->loadModel('Rating');
        if ($this->request->is(array('post', 'put'))) {
            $Keywords = $this->request->data['Keywords'];
            $EndDate = $this->request->data['EndDate'];
            $QueryStr = "(RUser.id=Rating.task_by)";
            if ($Keywords != '') {
                $QueryStr.=" AND ((RUser.first_name LIKE '%" . $Keywords . "%') OR (RUser.last_name LIKE '%" . $Keywords . "%'))";
            }

            if ($EndDate != '') {
                $QueryStr.=" AND (Rating.date_time LIKE '%" . $EndDate . "%')";
            }

            $RatingOptions = array(
                'joins' => array(
                    array(
                        'table' => 'users',
                        'alias' => 'RUser',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions' => array($QueryStr)
                    )
                ),
                'conditions' => array('Rating.user_id' => $userid),
                'order' => array('Rating.id DESC'),
                'limit' => 10
            );
        } else {
            $RatingOptions = array('conditions' => array('Rating.user_id' => $userid), 'order' => array('Rating.id Desc'), 'limit' => 10);
        }
        $this->Paginator->settings = $RatingOptions;
        $Reviews = $this->Paginator->paginate('Rating');
        //$Reviews = $this->Rating->find('all', $RatingOptions);
        $this->set(compact('title_for_layout', 'userid', 'Reviews', 'Keywords', 'EndDate'));
    }

    public function my_assign_task($type = null) {
        $this->loadModel('Task');
        $this->loadModel('Job');
        $this->loadModel('Proposal');
        $userid = $this->Session->read('userid');
        //$this-
        //$userid = 2;
        if (!isset($userid) && $userid == '') {
            return $this->redirect(array('action' => 'login'));
        }

        if ($type == 'completed') {
            $TaskFStatus = '1';
        } else {
            $TaskFStatus = '0';
        }

        if ($this->request->is(array('post', 'put'))) {
            $Keywords = $this->request->data['Keywords'];
            $TaskStatus = $this->request->data['TaskStatus'];
            $EndDate = $this->request->data['EndDate'];
            $Price_Max = $this->request->data['Price_Max'];
            $Price_Min = $this->request->data['Price_Min'];
            $Category = $this->request->data['Category'];
            $task_location = $this->request->data['task_location'];
            $WorkType = isset($_REQUEST['WorkType']) ? $_REQUEST['WorkType'] : '';
            if ($type == 'bid_on') {
                $QueryStr = "(TaskUser.id=Proposal.task_id)";
                $ConditionArr = array('Proposal.user_id' => $userid, 'Proposal.is_accepted' => 0);
                $OrderArr = array('Proposal.id DESC');
            } else {
                $QueryStr = "(TaskUser.id=Job.task_id)";
                $ConditionArr = array('Job.user_id' => $userid, 'Job.is_finished' => $TaskFStatus);
                $OrderArr = array('Job.id DESC');
            }
            if ($Keywords != '') {
                $QueryStr.=" AND (TaskUser.title LIKE '%" . $Keywords . "%')";
            }
            if ($TaskStatus != '') {
                $QueryStr.=" AND (TaskUser.task_status = '" . $TaskStatus . "')";
            }
            if ($EndDate != '') {
                $QueryStr.=" AND (TaskUser.due_date = '" . $EndDate . "')";
            }
            if ($Price_Max != '' and $Price_Min != '') {

                $QueryStr.=" AND (TaskUser.total_rate >= '" . $Price_Min . "' and TaskUser.total_rate<='" . $Price_Max . "')";
            }
            if ($WorkType != '') {
                $QueryStr.=" AND (TaskUser.completed = '" . $WorkType . "')";
            }
            if ($Category != '') {
                $QueryStr.=" AND TaskUser.category_id='" . $Category . "'";
            }
            if ($task_location != '') {
                $QueryStr.=" AND TaskUser.task_location='" . $task_location . "'";
            }

            //$options = array('conditions' => array($QueryStr), 'order' => array('Task.id' => 'desc'));
            $options = array(
                'joins' => array(
                    array(
                        'table' => 'tasks',
                        'alias' => 'TaskUser',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions' => array($QueryStr)
                    )
                ),
                //'conditions' => array('Job.user_id' => $userid, 'Job.is_finished' => $TaskFStatus),
                'conditions' => $ConditionArr,
                'order' => $OrderArr,
                'limit' => 10
            );
        } else {
            if ($type == 'bid_on') {
                $options = array('conditions' => array('Proposal.user_id' => $userid, 'Proposal.is_accepted' => 0), 'order' => array('Proposal.id' => 'desc'), 'limit' => 10);
            } else {
                $options = array('conditions' => array('Job.user_id' => $userid, 'Job.is_finished' => $TaskFStatus), 'order' => array('Job.id' => 'desc'), 'limit' => 10);
            }

            $Keywords = '';
            $TaskStatus = '';
            $EndDate = '';
            $Price_Min = '';
            $Price_Max = '';
            $WorkType = '';
        }
        $this->Paginator->settings = $options;
        if ($type == 'bid_on') {
            $TaskList = $this->Paginator->paginate('Proposal');
        } else {
            $TaskList = $this->Paginator->paginate('Job');
        }
        //$TaskList = $this->Job->find('all',$options);

        $this->loadModel('Category');
        $categories_lists = $this->Category->find("all", array("conditions" => array("Category.parent_id" => 0)));

        $this->set(compact('title_for_layout', 'TaskList', 'EndDate', 'TaskStatus', 'Keywords', 'categories_lists', 'Category', 'task_location', 'Price_Min', 'Price_Max', 'WorkType'));
    }

    ///////////////////////////////End AK/////////////////////////////////
    /////////////////////////suman ///////////////////////////////////////
    public function admin_activity_export() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('Activity');
        $activities = $this->Activity->find('all', array('order' => 'Activity.id DESC'));
        $output = '';
        $output .='User ID, User Name, Email, Phone, Zip, Last Login IP, Last Login On';
        $output .="\n";
//pr($cats);exit;
        if (!empty($activities)) {
            foreach ($activities as $activity) {
                $zipcode = ($activity['User']['zipcode'] == '') ? 'NULL' : $activity['User']['zipcode'];
                $UserIP = ($activity['Activity']['ip'] == '') ? 'NULL' : $activity['Activity']['ip'];
                $output .='"' . $activity['User']['id'] . '","' . $activity['User']['first_name'] . ' ' . $activity['User']['last_name'] . '","' . $activity['User']['email'] . '","' . $activity['User']['phone_no'] . '","' . $zipcode . '","' . $UserIP . '","' . $activity['Activity']['date'] . '"';
                $output .="\n";
            }
        }
        $filename = "activity" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

    public function admin_activity_view() {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Activity List';
        $this->loadModel('Activity');
        //$activities = $this->Activity->find('all',array('order' => 'Activity.id DESC'));
        $this->paginate = array(
            'order' => array(
                'Activity.id' => 'desc'
            )
        );
        $this->Paginator->settings = $this->paginate;
        $this->set('activity_list', $this->Paginator->paginate('Activity'));
        $this->set(compact('title_for_layout'));
    }

    public function mobile_no() {
        $title_for_layout = 'Edit Mobile no';
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->Session->setFlash(__('Please login to access profile.', 'default', array('class' => 'error')));
            return $this->redirect(array('action' => 'login'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $user = $this->User->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
            $user_data_auth['User']['id'] = $userid;
            $user_data_auth['User']['phone_no'] = $this->request->data['User']['phone_no'];
            if ($this->User->save($user_data_auth)) {
                $this->Session->setFlash('Mobile number updated successfully.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'mobile_no'));
            }
        }
        //$this->set(compact('user'));
        $this->set(compact('user', 'title_for_layout'));
    }

    public function skill() {
        $title_for_layout = 'My Skills';
        $this->loadModel('Skill');
        $this->loadModel('PortfolioImage');
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->Session->setFlash(__('Please login to access profile.', 'default', array('class' => 'error')));
            return $this->redirect(array('action' => 'login'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $user = $this->User->find('first', $options);
        if ($this->request->is(array('post', 'put'))) {
            $this->request->data['Skill']['transportation'] = implode(",", $this->request->data['Skill']['transportation']);
            $this->request->data['Skill']['user_id'] = $userid;
            $this->Skill->create();

            if ($this->Skill->save($this->request->data)) {
                $this->Session->setFlash('The skill has been saved.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'skill'));
            }
        }
        $options = array('conditions' => array('PortfolioImage.user_id' => $userid));
        $user_portfolio = $this->PortfolioImage->find('all', $options);

        $this->request->data = $this->Skill->find("first", array('conditions' => array('Skill.user_id' => $userid)));
        $this->set(compact('user', 'title_for_layout', 'user_portfolio'));
    }

    public function portfolio() {
        $title_for_layout = 'My Portfolio';
        $this->loadModel('PortfolioImage');
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->Session->setFlash(__('Please login to access profile.', 'default', array('class' => 'error')));
            return $this->redirect(array('action' => 'login'));
        }
        $options = array('conditions' => array('PortfolioImage.user_id' => $userid));
        $user_portfolio = $this->PortfolioImage->find('all', $options);
        if ($this->request->is(array('post', 'put'))) {
            if (isset($_REQUEST['task_image']) and ! empty($_REQUEST['task_image'])) {
                for ($i = 0; $i < count($_REQUEST['task_image']); $i++) {

                    $data['PortfolioImage']['id'] = $_REQUEST['task_image_id'][$i];
                    $data['PortfolioImage']['user_id'] = $userid;
                    $data['PortfolioImage']['image_name'] = $_REQUEST['task_image'][$i];

                    $this->PortfolioImage->create();
                    $this->PortfolioImage->save($data);
                }
            }
            $this->Session->setFlash('The portfolio has been saved.', 'default', array('class' => 'success'));
            //return $this->redirect(array('action' => 'portfolio'));
            return $this->redirect(array('action' => 'skill'));
        }
        //$this->request->data
        $this->set(compact('user_portfolio', 'title_for_layout'));
    }

    function delimg($id = null) {
        $this->loadModel('PortfolioImage');
        $this->PortfolioImage->delete($id);
        exit;
    }

    public function payment_history() {
        $userid = $this->Session->read('userid');
        $this->loadModel('PaymentHistory');
        if (isset($userid) && !empty($userid)) {

            //$this->PaymentHistory->recursive = -1;
            if (isset($_REQUEST['search']) && $_REQUEST['search'] == 'search') {
                $from_date = $_REQUEST['from_date'];
                $to_date = $_REQUEST['to_date'];
                $TransacionsType = $_REQUEST['TransacionsType'];
                $activity = $_REQUEST['activity'];
                //$end_date=date('Y-m-d', strtotime("-14 days"));

                $QueryStr = "(PaymentHistory.for_user_id='" . $userid . "')";
                if ($activity != '') {
                    if ($activity == 1) {
                        $activityToDate = date('Y-m-d', strtotime("-7 days"));
                        $activityFromDate = date('Y-m-d', strtotime("-14 days"));
                        $QueryStr.=" AND (PaymentHistory.pay_date >= '" . $activityFromDate . " 00:00:00' AND PaymentHistory.pay_date <= '" . $activityToDate . " 23:59:59')";
                    } elseif ($activity == 2) {
                        $activityToDate = date('Y-m-d', strtotime("-7 days"));
                        $activityFromDate = date('Y-m-d', strtotime("-21 days"));
                        $QueryStr.=" AND (PaymentHistory.pay_date >= '" . $activityFromDate . " 00:00:00' AND PaymentHistory.pay_date <= '" . $activityToDate . " 23:59:59')";
                    } elseif ($activity == 3) {
                        $ToDateCal = date('Y-m-d', strtotime("-30 days"));
                        $ToDateCalExp = explode('-', $ToDateCal);
                        $number = cal_days_in_month(CAL_GREGORIAN, $ToDateCalExp[1], $ToDateCalExp[0]);
                        $activityToDate = $ToDateCalExp[0] . '-' . $ToDateCalExp[1] . '-' . $number;
                        $activityFromDate = $ToDateCalExp[0] . '-' . $ToDateCalExp[1] . '-01';
                        $QueryStr.=" AND (PaymentHistory.pay_date >= '" . $activityFromDate . " 00:00:00' AND PaymentHistory.pay_date <= '" . $activityToDate . " 23:59:59')";
                    }
                } else {
                    //echo $TransacionsType;
                    //exit;
                    if ($TransacionsType != '') {
                        if ($TransacionsType == 'pay amount') {
                            $QueryStr.=" AND (PaymentHistory.type LIKE '%" . $TransacionsType . "%')";
                        } else {
                            $QueryStr.=" AND (PaymentHistory.type LIKE '%release fund%' OR PaymentHistory.type LIKE '%refund amount%')";
                        }
                    }
                    if ($from_date != '' && $to_date == '') {
                        $QueryStr.=" AND (PaymentHistory.pay_date >= '" . $from_date . " 00:00:00')";
                    }
                    if ($from_date == '' && $to_date != '') {
                        $QueryStr.=" AND (PaymentHistory.pay_date <= '" . $to_date . " 23:59:59')";
                    }
                    if ($from_date != '' && $to_date != '') {
                        $QueryStr.=" AND (PaymentHistory.pay_date >= '" . $from_date . " 00:00:00' AND PaymentHistory.pay_date <= '" . $to_date . " 23:59:59')";
                    }
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('PaymentHistory.id' => 'desc'), 'limit' => 10);
            } else {
                $options = array('conditions' => array('PaymentHistory.for_user_id' => $userid), 'order' => array('PaymentHistory.id' => 'desc'), 'limit' => 10);
                $from_date = '';
                $to_date = '';
                $TransacionsType = '';
                $activity = '';
            }

            $this->Paginator->settings = $options;
            $payment_notifications = $this->Paginator->paginate('PaymentHistory');
            //$notifications = $this->PaymentHistory->find('all',$options);
            $this->set(compact('payment_notifications', 'TransacionsType', 'to_date', 'from_date', 'activity'));
            if (!empty($payment_notifications)) {
                foreach ($payment_notifications as $notification) {
                    $noti['PaymentHistory']['id'] = $notification['PaymentHistory']['id'];
                    $noti['PaymentHistory']['is_read'] = 1;
                    $this->PaymentHistory->save($noti);
                }
            }
        } else {
            $this->Session->setFlash(__('Please login first.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'login/'));
        }
    }

    public function payment_history_list() {
        $userid = $this->Session->read('userid');
        $this->loadModel('PaymentHistory');
        if (isset($userid) && !empty($userid)) {
            //$this->Notification->recursive = 0;
            //$options = array('conditions' => array('OR'=>array('PaymentHistory.for_user_id' => $userid, 'PaymentHistory.by_user_id' => $userid)),'group'=>array('PaymentHistory.task_id'),'order'=>array('PaymentHistory.id Desc'));
            $options = array('conditions' => array('PaymentHistory.by_user_id' => $userid, 'PaymentHistory.type' => 'pay amount'), 'order' => array('PaymentHistory.id' => 'desc'), 'limit' => 10);
            $this->Paginator->settings = $options;
            $notifications = $this->Paginator->paginate('PaymentHistory');
            //$notifications = $this->PaymentHistory->find('all',$options);
            $this->set(compact('notifications'));
            if (!empty($notifications)) {
                foreach ($notifications as $notification) {
                    $noti['PaymentHistory']['id'] = $notification['PaymentHistory']['id'];
                    $noti['PaymentHistory']['is_read'] = 1;
                    $this->PaymentHistory->save($noti);
                }
            }
        } else {
            $this->Session->setFlash(__('Please login first.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'login/'));
        }
    }

    public function billing_address() {
        $this->loadModel('BillingAddress');
        $userid = $this->Session->read('userid');
        if (isset($userid) && !empty($userid)) {
            if ($this->request->is(array('post', 'put'))) {
                $this->request->data['BillingAddress']['date'] = date('Y-m-d H:i:s');
                $this->request->data['BillingAddress']['user_id'] = $userid;

                if ($this->BillingAddress->save($this->request->data)) {
                    $this->Session->setFlash(__('Your details have been saved.'));
                    return $this->redirect(array('action' => 'billing'));
                } else {
                    $this->Session->setFlash(__('Your details could not be saved. Please, try again.'));
                    return $this->redirect(array('action' => 'billing'));
                }
            } else {
                return $this->redirect(array('action' => 'billing'));
                //$options = array('conditions' => array('BillingAddress.user_id' => $userid));
                //$this->request->data = $this->BillingAddress->find('first', $options);
            }
            //$this->set(compact('title_for_layout'));
        } else {
            $this->Session->setFlash(__('Please login first.'));
            return $this->redirect(array('controller' => 'users', 'action' => 'login/'));
        }
    }

    /* public function admin_contact_us() {
      $this->loadModel('Contact');
      $userid = $this->Session->read('userid');
      $title_for_layout='Contact us';
      if(!isset($userid) && $userid==''){
      $this->Session->setFlash(__('Please login first.'));
      $this->redirect('/admin');
      }
      if(isset($userid) && !empty($userid)){
      if ($this->request->is(array('post', 'put')) && $this->request->data['search']=='Search' ) {
      //pr($this->request->data);exit;
      $Keywords=$this->request->data['keyword'];
      $ContactDate=$this->request->data['ContactDate'];
      if($Keywords!='' && $ContactDate==''){
      $QueryStr="(Contact.name LIKE '%".$Keywords."%')";
      }
      if($ContactDate!='' && $Keywords==''){
      $QueryStr="(Contact.contact_date LIKE '%".$ContactDate."%')";
      }
      if($ContactDate!='' && $Keywords!=''){
      $QueryStr="(Contact.name LIKE '%".$Keywords."%') AND (Contact.contact_date LIKE '%".$ContactDate."%')";
      }
      $options = array('conditions' => array($QueryStr), 'order' => array('Contact.id' => 'desc'), 'limit'=>10);
      }else{
      $options = array('order'=>array('Contact.id Desc'), 'limit'=>10);
      $Keywords='';
      $ContactDate='';
      }



      $this->Paginator->settings = $options;
      $ContactUser=$this->Paginator->paginate('Contact');
      $this->set(compact('title_for_layout','ContactUser','ContactDate','Keywords'));
      }
      } */

    public function admin_contact_us_add() {

        if ($this->request->is('post')) {
            $this->Contact->create();
            $this->request->data['Contact']['post_date'] = date('Y-m-d h:m:i');
            if ($this->Contact->save($this->request->data)) {
                $this->Session->setFlash(__('The Contact has been saved.'));
                return $this->redirect(array('action' => 'contact_us'));
            } else {
                $this->Session->setFlash(__('The Contact could not be saved. Please, try again.'));
            }
        }
    }

    public function admin_contact_us() {
        $this->loadModel('Contact');
        $userid = $this->Session->read('adminuserid');
        $title_for_layout = 'Contact us';
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }

        if ($this->request->is(array('post', 'put')) && isset($this->request->data['reply'])) {
            $from = "Ladder <'ladder@mail.com'>";
            $to = $this->request->data['to'];
            $Subject_mail = $this->request->data['subject'];
            $msg_body = $this->request->data['message'];
            $this->php_mail($UserEmail, $from, $Subject_mail, $msg_body);

            $this->Session->setFlash('Email sent.', 'default', array('class' => 'success'));
            return $this->redirect(array('action' => 'contact_us'));
        }

        if (isset($userid) && !empty($userid)) {
            if ($this->request->is(array('post', 'put')) && isset($this->request->data['search'])) {
                //pr($this->request->data);exit;
                $Keywords = $this->request->data['keyword'];
                $ContactDate = $this->request->data['ContactDate'];
                $QueryStr = '';
                if ($Keywords != '' && $ContactDate == '') {
                    $QueryStr = "(Contact.name LIKE '%" . $Keywords . "%')";
                }
                if ($ContactDate != '' && $Keywords == '') {
                    $QueryStr = "(Contact.post_date LIKE '%" . $ContactDate . "%')";
                }
                if ($ContactDate != '' && $Keywords != '') {
                    $QueryStr = "(Contact.name LIKE '%" . $Keywords . "%') AND (Contact.post_date LIKE '%" . $ContactDate . "%')";
                }
                $options = array('conditions' => array($QueryStr), 'order' => array('Contact.id' => 'desc'), 'limit' => 10);
            } else {
                $options = array('order' => array('Contact.id' => 'desc'), 'limit' => 10);
                $Keywords = '';
                $ContactDate = '';
                $search_type = '';
            }

            $this->Paginator->settings = $options;
            $ContactUser = $this->Paginator->paginate('Contact');
            $this->set(compact('title_for_layout', 'ContactUser', 'ContactDate', 'Keywords'));
        }
    }

    public function admin_contact_delete($id = null) {
        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $this->loadModel('Contact');
        $this->Contact->id = $id;
        if (!$this->Contact->exists()) {
            throw new NotFoundException(__('Invalid contact'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Contact->delete()) {
            $this->Session->setFlash(__('The contact us user has been deleted.'));
        } else {
            $this->Session->setFlash(__('The contact us user could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'contact_us'));
    }

    public function admin_contact_view($id = null) {

        $userid = $this->Session->read('adminuserid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Contact us View';
        $this->loadModel('Contact');
        $this->loadModel('InboxMessage');
        //$this->set(compact('title_for_layout'));
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException(__('Invalid contact us'));
        }
        $options = array('conditions' => array('Contact.' . $this->Contact->primaryKey => $id));
        $user_Contact = $this->Contact->find('all', $options);
        if (!empty($user_Contact)) {
            foreach ($user_Contact as $notification) {
                $noti['Contact']['id'] = $id;
                $noti['Contact']['is_read'] = 1;
                $this->Contact->save($noti);
            }
        }
        $this->set('Contactuser', $this->Contact->find('first', $options));
        $this->set(compact('title_for_layout'));
    }

    public function admin_reply($id = null) {
        $id = base64_decode($id);
        $userid = $this->Session->read('adminuserid');
        $this->loadModel('Contact');
        $this->loadModel('InboxMessage');
        $this->loadModel('Setting');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Reply';
        if (!$this->Contact->exists($id)) {
            throw new NotFoundException(__('Invalid contact message'));
        }

        /* if ($id!='') {
          $options = array('conditions' => array('InboxMessage.' . $this->InboxMessage->primaryKey => $id));
          $inboxMessage = $this->InboxMessage->find('first', $options);
          //pr($inboxMessage);
          } */

        if ($this->request->is('post')) {

            if (isset($this->request->data['SentMessage']['location']) && $this->request->data['SentMessage']['location']['name'] != '') {
                $ext = explode('.', $this->request->data['SentMessage']['location']['name']);
                if ($ext) {
                    $uploadFolder = "location";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif', 'doc', 'docx', 'pdf', 'txt');

                    if (in_array($ext[1], $extensionValid)) {
                        $imageName = rand() . '_' . (strtolower(trim($this->request->data['SentMessage']['location']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($this->request->data['SentMessage']['location']['tmp_name'], $full_image_path);
                        //$this->request->data['SentMessage']['location'] = $imageName;
                        $this->request->data['InboxMessage']['location'] = $imageName;
                    } else {
                        $this->Session->setFlash(__('Please uploade image of .jpg, .jpeg, .png , .gif , .doc , docx , .txt or .pdf format.'));
                    }
                }
            } else {
                //$this->request->data['SentMessage']['location'] ='';
                $this->request->data['InboxMessage']['location'] = '';
            }
            //echo $this->request->data['SentMessage']['location']['name'];
            //exit;
            /* $this->request->data['SentMessage']['user_id'] = $userid;
              $this->request->data['SentMessage']['date_time'] = date('Y-m-d H:i:s');
              $this->request->data['SentMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
              $this->request->data['SentMessage']['inbox_id']=$inboxMessage['InboxMessage']['id'];
              $this->request->data['SentMessage']['task_id']=$inboxMessage['InboxMessage']['task_id'];
              $this->SentMessage->create(); */
            $this->request->data['InboxMessage']['user_id'] = $this->request->data['SentMessage']['receiver_id'];
            $this->request->data['InboxMessage']['sender_id'] = $userid;
            $this->request->data['InboxMessage']['subject'] = $this->request->data['SentMessage']['subject'];
            $this->request->data['InboxMessage']['message'] = $this->request->data['SentMessage']['message'];
            $this->request->data['InboxMessage']['date_time'] = date('Y-m-d H:i:s');
            //$this->request->data['InboxMessage']['parent_id']=$inboxMessage['InboxMessage']['parent_id'];
            //$this->request->data['InboxMessage']['sentmsg_id']=$inboxMessage['InboxMessage']['sentmsg_id'];
            $this->request->data['InboxMessage']['contact_id'] = $id;
            //mail send
            $UserName = $this->request->data['UserName'];
            $UserEmail = $this->request->data['UserEmail'];
            $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
            if ($contact_email) {
                $adminEmail = $contact_email['Setting']['contact_email'];
            } else {
                $adminEmail = 'superadmin@abc.com';
            }

            $this->loadModel('EmailTemplate');
            $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 8)));
            $msg_body = str_replace(array('[USER]', '[MESSAGE]'), array($UserName, $this->request->data['InboxMessage']['message']), $EmailTemplate['EmailTemplate']['content']);


            $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
            $Subject_mail = $this->request->data['InboxMessage']['subject'];
            $this->php_mail($UserEmail, $from, $Subject_mail, $msg_body);

            $this->InboxMessage->create();
            if ($this->request->data['InboxMessage']['user_id'] > 0) {
                if ($this->InboxMessage->save($this->request->data)) {
                    $this->Session->setFlash(__('The message has been sent successfully.'));
                    return $this->redirect(array('action' => 'admin_contact_view/' . $id));
                } else {
                    $this->Session->setFlash(__('The sent message could not be saved. Please, try again.'));
                    return $this->redirect(array('action' => 'admin_contact_view/' . $id));
                }
            } else {
                $this->Session->setFlash(__('The message has been sent successfully.'));
                return $this->redirect(array('action' => 'admin_contact_view/' . $id));
            }
        } else {
            return $this->redirect(array('action' => 'admin_contact_view/' . $id));
        }
    }

    public function export_transaction_history() {
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->redirect(array('controller' => 'users', 'action' => 'login/'));
        }

        $this->loadModel('PaymentHistory');
        $options = array('conditions' => array('PaymentHistory.for_user_id' => $userid), 'order' => array('PaymentHistory.id' => 'desc'));
        $notifications = $this->PaymentHistory->find('all', $options);

        $output = '';
        $output .='ID, Date, Type, Description, Task Post by, Task Done by, Amount, Ref ID';
        $output .="\n";

        if (!empty($notifications)) {
            foreach ($notifications as $val) {
                $TID = $val['PaymentHistory']['id'];
                if ($val['PaymentHistory']['type'] == 'release fund' || $val['PaymentHistory']['type'] == 'refund amount') {
                    $Type = 'Credit Amount';
                } else {
                    $Type = 'Debit Amount';
                }
                $PayDate = date("M d,Y", strtotime($val['PaymentHistory']['pay_date']));
                $transaction_id = $val['PaymentHistory']['transaction_id'];
                $Description = '';
                if ($val['PaymentHistory']['type'] == 'refund amount') {
                    $Description.= 'Refunded amount for ';
                }
                $Description.=$val['Task']['title'] . ' Fee - Ref ID ' . $transaction_id;
                if ($val['PaymentHistory']['type'] == 'release fund') {
                    $Description.= '|| Service fee: $' . $val['PaymentHistory']['admin_amount'];
                    $Description.= '|| Paypal fee: $' . $val['PaymentHistory']['paypal_fee'];
                }

                $username = ($this->requestAction('sent_messages/getUsername/' . $val['Task']['user_id']));
                $payment_status = ($val['PaymentHistory']['payment_status'] == 1) ? 'Pending' : '';
                $user_amount = '($' . $val['PaymentHistory']['user_amount'] . ') ' . $payment_status;
                if ($val['PaymentHistory']['type'] != 'refund amount') {
                    if ($val['PaymentHistory']['type'] != 'pay amount') {
                        $Done_by = $val['ForUser']['first_name'] . ' ' . $val['ForUser']['last_name'];
                    } else {
                        $Done_by = $val['ByUser']['first_name'] . ' ' . $val['ByUser']['last_name'];
                    }
                } else {
                    $Done_by = 'Cancel';
                }

                $output .='"' . $TID . '","' . $PayDate . '","' . $Type . '","' . $Description . '","' . $username . '","' . $Done_by . '","' . $user_amount . '","' . $transaction_id . '"';
                $output .="\n";
            }
        }
        $filename = "transaction_history_" . time() . ".csv";
        header('Content-type: application/csv');
        header('Content-Disposition: attachment; filename=' . $filename);
        echo $output;
        exit;
    }

    public function task_details($tid = null) {
        $this->loadModel('Task');
        $options = array('conditions' => array('Task.id' => $tid));
        $task_details = $this->Task->find('first', $options);
        if (count($task_details) > 0) {
            return $task_details;
        } else {
            return null;
        }
    }

    public function task_job_offer($tid = null) {
        $this->loadModel('Job');
        //$this->Job->recursive = -1;
        $options = array('conditions' => array('Job.task_id' => $tid, 'Job.payment_status' => 1));
        $job_list = $this->Job->find('all', $options);
        if (count($job_list) > 0) {
            return $job_list;
        } else {
            return array();
        }
    }

    public function admin_dispute_task($jobid = null, $tid = null) {

        $userid = $this->Session->read('userid');
        $is_admin = $this->Session->read('is_admin');
        if (!isset($is_admin) && $is_admin == '') {
            $this->redirect('/admin');
        }
        $title_for_layout = 'Dispute Task';
        $this->loadModel('Task');
        $this->loadModel('Job');
        $this->loadModel('Proposal');
        $this->loadModel('Setting');
        $this->loadModel('PaymentHistory');
        $options = array('conditions' => array('Task.id' => $tid));
        $task_details = $this->Task->find('first', $options);
        $optionsJob = array('conditions' => array('Job.id' => $jobid));
        $JobDetails = $this->Job->find('first', $optionsJob);

        $optionsSetting = array('conditions' => array('Setting.' . $this->Setting->primaryKey => 1));
        $sitesetting = $this->Setting->find('first', $optionsSetting);

        if (count($task_details) > 0 && count($JobDetails) > 0) {
            $UserName = $task_details['User']['first_name'] . ' ' . $task_details['User']['last_name'];
            $UserEmail = $task_details['User']['email'];
            $UserPaypal_email = $task_details['User']['paypal_email'];
            $UserID = $task_details['Task']['user_id'];

            $job_id = $JobDetails['Job']['id'];
            $UserTransaction_id = $JobDetails['Job']['transaction_id'];
            $UserPaykey = $JobDetails['Proposal']['paykey'];
            $UserAmount = $JobDetails['Proposal']['amount'];

            if ($UserPaykey != '' && $UserTransaction_id != '' && $UserPaypal_email != '' && $UserAmount > 0) {
                require_once(ROOT . '/app/Vendor' . DS . 'Paypal_adaptive' . DS . 'PPBootStrap.php');

                $refundRequest = new RefundRequest(new RequestEnvelope("en_US"));
                $refundRequest->currencyCode = 'USD';
                $refundRequest->payKey = $UserPaykey;

                $receiver = array();
                $receiver[0] = new Receiver();
                //$receiver[0]->email = $UserPaypal_email;
                $receiver[0]->amount = floor($UserAmount);
                $receiver[0]->primary = 'false';
                $receiver[0]->paymentType = 'SERVICE';
                //$receiverList = new ReceiverList($receiver);

                $PayPalService = new AdaptivePaymentsService(Configuration::getAcctAndConfig());
                $PayPalResult = $PayPalService->Refund($refundRequest);
                $PayPalAck = $PayPalResult->responseEnvelope->ack;
                $EncryptedTransactionID = $PayPalResult->responseEnvelope->correlationId;
                if ($PayPalAck == 'Success') {

                    $noti['Job']['id'] = $jobid;
                    $noti['Job']['payment_status'] = '0';
                    $this->Job->save($noti);
                    /* $noti['Task']['id'] = $tid;
                      $noti['Task']['task_status'] = 'D';
                      $this->Task->save($noti); */

                    $payment['PaymentHistory']['for_user_id'] = $UserID;
                    $payment['PaymentHistory']['by_user_id'] = 2;
                    $payment['PaymentHistory']['task_id'] = $tid;
                    $payment['PaymentHistory']['job_id'] = $job_id;
                    $payment['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
                    $payment['PaymentHistory']['transaction_id'] = $EncryptedTransactionID;
                    $payment['PaymentHistory']['pay_amount'] = $JobDetails['Proposal']['amount'];
                    $payment['PaymentHistory']['user_amount'] = $JobDetails['Proposal']['your_amount'];
                    $payment['PaymentHistory']['admin_amount'] = $JobDetails['Proposal']['site_amount'];
                    $payment['PaymentHistory']['paypal_fee'] = $JobDetails['Proposal']['paypal_fee'];
                    $payment['PaymentHistory']['type'] = 'refund amount';
                    $payment['PaymentHistory']['payment_status'] = 2;
                    $this->PaymentHistory->create();
                    $this->PaymentHistory->save($payment);

                    $this->Session->setFlash(__('You have successfully cancel the errands and refund the amount to client.'));
                    return $this->redirect(array('action' => 'admin_contact_us'));
                } else {
                    $this->Session->setFlash('Sorry please try again. <br>' . $PayPalResult->error[0]->message);
                    return $this->redirect(array('action' => 'admin_contact_us'));
                }
            } else {
                $this->Session->setFlash(__('The cancel errands and refund the amount to client does not proceed. Because user does not put there paypal email to there account.'));
                return $this->redirect(array('action' => 'admin_contact_us'));
            }
        } else {
            $this->Session->setFlash(__('The cancel errands and refund the amount to client does not proceed. Please, try again.'));
            return $this->redirect(array('action' => 'admin_contact_us'));
        }
        $this->set(compact('title_for_layout'));
    }

    /* public function admin_dispute_task($tid = null) {

      $userid = $this->Session->read('adminuserid');
      $is_admin = $this->Session->read('is_admin');
      if(!isset($is_admin) && $is_admin==''){
      $this->redirect('/admin');
      }
      $title_for_layout = 'Dispute Task';
      $this->loadModel('Task');
      $this->loadModel('Job');
      $this->loadModel('Proposal');
      $this->loadModel('Setting');
      $this->loadModel('PaymentHistory');
      $options = array('conditions' => array('Task.id' => $tid));
      $task_details = $this->Task->find('first', $options);
      $optionsJob = array('conditions' => array('Job.task_id' => $tid));
      $JobDetails = $this->Job->find('first', $optionsJob);

      $optionsSetting = array('conditions' => array('Setting.' . $this->Setting->primaryKey => 1));
      $sitesetting = $this->Setting->find('first', $optionsSetting);

      if(count($task_details)>0 && count($JobDetails)>0){
      $UserName=$task_details['User']['first_name'].' '.$task_details['User']['last_name'];
      $UserEmail=$task_details['User']['email'];
      $UserPaypal_email=$task_details['User']['paypal_email'];
      $UserID=$task_details['Task']['user_id'];

      $job_id=$JobDetails['Job']['id'];
      $UserTransaction_id=$JobDetails['Job']['transaction_id'];
      $UserPaykey=$JobDetails['Proposal']['paykey'];
      $UserAmount=$JobDetails['Proposal']['amount'];

      if($UserPaykey!='' && $UserTransaction_id!='' && $UserPaypal_email!='' && $UserAmount > 0){
      App::import('Vendor', array('file' => 'paypal'.DS.'config.php'));
      App::import('Vendor', 'PayPal', array('file' => 'paypal'.DS.'paypal.class.php'));
      App::import('Vendor', 'PayPal_Adaptive', array('file' => 'paypal'.DS.'paypal.adaptive.class.php'));
      $paypal_mode=$sitesetting['Setting']['paypal_mode'];
      if($paypal_mode==1){
      $paypal_mode_text='FALSE';
      }else{
      $paypal_mode_text='TRUE';
      }
      $PayPalConfig = array(
      'Sandbox'               => $paypal_mode_text,
      'DeveloperAccountEmail' => $sitesetting['Setting']['paypal_developer_email'],
      'ApplicationID'         => $sitesetting['Setting']['paypal_app_id'],
      'DeviceID'              => '',
      'IPAddress'             => $_SERVER['REMOTE_ADDR'],
      'APIUsername'           => $sitesetting['Setting']['api_username'],
      'APIPassword'           => $sitesetting['Setting']['api_password'],
      'APISignature'          => $sitesetting['Setting']['api_signature'],
      'APISubject'            => ''
      );

      $PayPal = new PayPal_Adaptive($PayPalConfig);

      $RefundFields = array(
      'CurrencyCode' => 'USD',
      'PayKey' => $UserPaykey
      //'TransactionID' => $UserTransaction_id
      //'TrackingID' => $refund['Refund']['transaction_id']
      );
      $Receivers = array();
      $Receiver = array(
      //'Email' => 'lovelybrotherbum@gmail.com',			// A receiver's email address.
      //'Email' => $UserPaypal_email,
      //
      //'Email' => $sitesetting['Setting']['paypal_email'],
      //'Email' => 'nits.sumansamanta-buyer@gmail.com',
      'Amount' => floor($UserAmount), // Amount to be debited to the receiver's account.
      'Primary' => 'false', 				// Set to true to indicate a chained payment.
      'PaymentType' => 'SERVICE'
      );
      //array_push($Receivers,$Receiver);
      $PayPalRequestData = array(
      'RefundFields' => $RefundFields
      //'Receivers' => $Receivers
      );
      // Pass data into class for processing with PayPal and load the response array into $PayPalResult
      $PayPalResult = $PayPal->Refund($PayPalRequestData);
      //pr($PayPalRequestData);
      //pr($PayPalResult);
      //exit;
      if($PayPalResult['Ack']=='Success'){

      $noti['Task']['id'] = $tid;
      $noti['Task']['task_status'] = 'D';
      $this->Task->save($noti);

      $payment['PaymentHistory']['for_user_id'] = $UserID;
      $payment['PaymentHistory']['by_user_id'] = $userid;
      $payment['PaymentHistory']['task_id'] = $tid;
      $payment['PaymentHistory']['job_id'] = $job_id;
      $payment['PaymentHistory']['pay_date'] = date('Y-m-d H:i:s');
      $payment['PaymentHistory']['transaction_id'] = $PayPalResult['EncryptedTransactionID'];
      $payment['PaymentHistory']['pay_amount'] = $JobDetails['Proposal']['amount'];
      $payment['PaymentHistory']['user_amount'] = $JobDetails['Proposal']['your_amount'];
      $payment['PaymentHistory']['admin_amount'] = $JobDetails['Proposal']['site_amount'];
      $payment['PaymentHistory']['paypal_fee'] = $JobDetails['Proposal']['paypal_fee'];
      $payment['PaymentHistory']['type'] = 'refund amount';
      $payment['PaymentHistory']['payment_status'] = 2;
      $this->PaymentHistory->create();
      $this->PaymentHistory->save($payment);

      $this->Session->setFlash(__('You have successfully cancel the errands and refund the amount to client.'));
      return $this->redirect(array('action' => 'admin_contact_us'));
      }else{
      $this->Session->setFlash('Sorry please try again.');
      return $this->redirect(array('action' => 'admin_contact_us'));
      }

      }else{
      $this->Session->setFlash(__('The cancel errands and refund the amount to client does not proceed. Because user does not put there paypal email to there account.'));
      return $this->redirect(array('action' => 'admin_contact_us'));
      }
      }else{
      $this->Session->setFlash(__('The cancel errands and refund the amount to client does not proceed. Please, try again.'));
      return $this->redirect(array('action' => 'admin_contact_us'));
      }
      $this->set(compact('title_for_layout'));
      } */

    public function job_details($tid = null) {
        $this->loadModel('Job');
        $options = array('conditions' => array('Job.task_id' => $tid));
        $Job_details = $this->Job->find('first', $options);
        if (count($Job_details) > 0) {
            return $Job_details;
        } else {
            return null;
        }
    }

    public function repeat_task($tid = null) {
        $this->loadModel('Task');
        $TaskID = base64_decode($tid);
        $userid = $this->Session->read('userid');
        if (!isset($userid) && $userid == '') {
            $this->Session->setFlash(__('Please login first to Post a Similar errands.'));
            return $this->redirect(array('controller' => 'tasks', 'action' => 'detail/' . $tid));
        }
        $options = array('conditions' => array('Task.id' => $TaskID));
        $task_details = $this->Task->find('first', $options);
        if (count($task_details) > 0) {
            $repeat_tdata['Task']['user_id'] = $userid;
            $repeat_tdata['Task']['pcat_id'] = $task_details['Task']['pcat_id'];
            $repeat_tdata['Task']['category_id'] = $task_details['Task']['category_id'];
            $repeat_tdata['Task']['title'] = $task_details['Task']['title'];
            $repeat_tdata['Task']['seo_url'] = $task_details['Task']['seo_url'];
            $repeat_tdata['Task']['description'] = $task_details['Task']['description'];
            $repeat_tdata['Task']['task_location'] = $task_details['Task']['task_location'];
            $repeat_tdata['Task']['completed'] = $task_details['Task']['completed'];
            $repeat_tdata['Task']['due_date_type'] = $task_details['Task']['due_date_type'];
            $repeat_tdata['Task']['due_date'] = $task_details['Task']['due_date'];
            $repeat_tdata['Task']['workers'] = $task_details['Task']['workers'];
            $repeat_tdata['Task']['budget_type'] = $task_details['Task']['budget_type'];
            $repeat_tdata['Task']['hour'] = $task_details['Task']['hour'];
            $repeat_tdata['Task']['per_hour_rate'] = $task_details['Task']['per_hour_rate'];
            $repeat_tdata['Task']['total_rate'] = $task_details['Task']['total_rate'];
            $repeat_tdata['Task']['expenses'] = $task_details['Task']['expenses'];
            $repeat_tdata['Task']['task_status'] = 'O';
            $repeat_tdata['Task']['paid'] = $task_details['Task']['paid'];
            $repeat_tdata['Task']['post_date'] = date('Y-m-d');
            $repeat_tdata['Task']['status'] = 2;
            $repeat_tdata['Task']['lat'] = $task_details['Task']['lat'];
            $repeat_tdata['Task']['lang'] = $task_details['Task']['lang'];
            if ($userid != '') {
                $this->Task->create();
                $this->Task->save($repeat_tdata);
            }
            $this->Session->setFlash(__('You have successfully repeat the errands.'));
            return $this->redirect('/users/my_errand');
        } else {
            $this->Session->setFlash(__('The post a similar errands can not proceed. Please, try again.'));
            return $this->redirect('/users/my_errand');
        }
    }

    public function review_dashboard() {
        //$this->loadModel('Task');
        $title_for_layout = 'Review Dashboard';
        if ($this->request->is(array('post', 'put'))) {
            $Keywords = $this->request->data['Keywords'];
            $rating = $this->request->data['rating'];
            $user_location = $this->request->data['user_location'];
            $user_verified = $this->request->data['user_verified'];
            //$WorkType=isset($_REQUEST['WorkType'])?$_REQUEST['WorkType']:'';

            $QueryStr = "(User.is_active = 1) AND (User.is_admin = 0)";
            if ($Keywords != '') {
                $QueryStr.=" AND (User.first_name LIKE '%" . $Keywords . "%' OR User.last_name LIKE '%" . $Keywords . "%')";
            }
            if ($rating != '') {
                $QueryStr.=" AND (User.tot_rating >= '" . $rating . "')";
            }
            if ($user_verified != '') {
                $QueryStr.=" AND (User.user_verified = '" . $user_verified . "')";
            }
            if ($user_location != '') {
                $QueryStr.=" AND (User.location LIKE '%" . $user_location . "%')";
            }

            $options = array('conditions' => array($QueryStr), 'order' => array('User.tot_rating' => 'desc'), 'limit' => 20);
        } else {
            $options = array('conditions' => array('User.is_active' => 1, 'User.is_admin' => 0), 'order' => array('User.tot_rating' => 'desc'), 'limit' => 20);
            $Keywords = '';
            $rating = '';
            $user_location = '';
            $user_verified = '';
        }

        $this->Paginator->settings = $options;
        $user_list = $this->Paginator->paginate('User');
        $this->set(compact('title_for_layout', 'user_list', 'Keywords', 'rating', 'user_location', 'user_verified'));
    }

    public function get_tot_completed_task($id = null) {
        $this->loadModel('Job');
        $completed_task = $this->Job->find('count', array(
            'conditions' => array('Job.user_id' => $id, 'Job.is_finished' => 1), 'group' => array('Job.task_id')
        ));
        if ($completed_task > 0) {
            $new_completed_task = $completed_task;
        } else {
            $new_completed_task = 0;
        }
        return $new_completed_task;
    }

    public function get_tot_posted_task($id = null) {
        $this->loadModel('Task');
        $posted_task = $this->Task->find('count', array(
            'conditions' => array('Task.user_id' => $id)
        ));
        /* if($posted_task>0){
          foreach($city_res as $val){
          //$city_name=$val['City']['name'];
          pr($city_res);
          }
          } */
        return $posted_task;
    }

    /* public function verification() {
      //$this->loadModel('Task');
      $title_for_layout = 'Verifications';
      $userid = $this->Session->read('userid');
      if(!isset($userid)){
      $this->redirect('/');
      }
      if (!$this->User->exists($userid)) {
      throw new NotFoundException(__('Invalid user'));
      }
      $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
      $UserDetails = $this->User->find('first', $options);
      $this->set(compact('title_for_layout','UserDetails'));
      } */

    public function verification() {
        $this->loadModel('Setting');
        $title_for_layout = 'Verifications';
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }

        if ($this->request->is(array('post', 'put'))) {
            $email_verification = $this->request->data['email_verification'];
            $user_data_auth['User']['id'] = $userid;
            $user_data_auth['User']['email_verification'] = $email_verification;
            if ($this->User->save($user_data_auth)) {
                $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
                if ($contact_email) {
                    $adminEmail = $contact_email['Setting']['contact_email'];
                } else {
                    $adminEmail = 'superadmin@abc.com';
                }

                //$this->loadModel('EmailTemplate');
                //$EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>4)));
                $siteurl = Configure::read('SITE_URL');
                $VerificationLink = $siteurl . 'users/email_verification/' . base64_encode($userid);
                //$msg_body =str_replace(array('[USER]','[LOGINLINK]'),array($lastInsetred['User']['first_name'],$LOGINLINK),$EmailTemplate['EmailTemplate']['content']);
                //$msg_body ='<p>Click this <a href="'.$VerificationLink.'">link</a> to verify your email.</p>';

                $this->loadModel('EmailTemplate');
                $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 7)));
                $msg_body = str_replace(array('[USER]', '[LINK]'), array($user_data_auth['User']['first_name'], $VerificationLink), $EmailTemplate['EmailTemplate']['content']);


                $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                //$Subject_mail='Email Verification';
                $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                $this->php_mail($email_verification, $from, $Subject_mail, $msg_body);

                $this->Session->setFlash('Please check your email to verify your email.', 'default', array('class' => 'success'));
                return $this->redirect(array('action' => 'verification'));
            }
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $UserDetails = $this->User->find('first', $options);
        $this->set(compact('title_for_layout', 'UserDetails'));
    }

    public function email_verification($id) {
        $title_for_layout = 'Email Verifications';
        $userid = base64_decode($id);
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $user_data_auth['User']['id'] = $userid;
        $user_data_auth['User']['is_email'] = 1;
        $user_data_auth['User']['user_verified'] = 1;
        $this->User->save($user_data_auth);
        $this->set(compact('title_for_layout'));
    }

    public function twitter_verification() {
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $CONSUMER_KEY = Configure::read('TWITTER_CONSUMER_KEY');
        $CONSUMER_SECRET = Configure::read('TWITTER_CONSUMER_SECRET');
        ;
        $OAUTH_CALLBACK = Configure::read('SITE_URL') . 'users/twitter_verification/';
        require_once(ROOT . '/app/Vendor' . DS . 'twitteroauth/twitteroauth.php');
        //App::import('Vendor', 'twitteroauth/twitteroauth.php');
        //App::import('Vendor', 'twitteroauth', array('file' => 'twitteroauth.php'));
        if (isset($_GET['oauth_token'])) {
            $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $this->Session->read('request_token'), $this->Session->read('request_token_secret'));
            $access_token = $connection->getAccessToken($_REQUEST['oauth_verifier']);
            if ($access_token) {
                $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
                $params = array();
                $params['include_entities'] = 'false';
                $content = $connection->get('account/verify_credentials', $params);

                if ($content && isset($content->screen_name) && isset($content->name)) {
                    if ($content->id != '') {
                        $user_data['User']['id'] = $userid;
                        $user_data['User']['tw_verification'] = $content->id;
                        $this->User->save($user_data);
                        $this->redirect(array('action' => 'verification'));
                    } else {
                        $this->redirect(array('action' => 'verification'));
                    }
                } else {
                    echo "<h4> Login Error </h4>";
                    exit;
                }
            }
        } else {
            $connection = new TwitterOAuth($CONSUMER_KEY, $CONSUMER_SECRET);
            $request_token = $connection->getRequestToken($OAUTH_CALLBACK);

            if ($request_token) {
                $token = $request_token['oauth_token'];
                //echo $token;
                $this->Session->write('request_token', $token);
                $this->Session->write('request_token_secret', $request_token['oauth_token_secret']);
                $url = $connection->getAuthorizeURL($token);
                $this->redirect($url);
            } else {
                //error receiving request token
                echo "Error Receiving Request Token";
                exit;
            }
        }
    }

    /* public function linekdin_verification(){
      $userid = $this->Session->read('userid');
      if(!isset($userid)){
      $this->redirect('/');
      }
      if (!$this->User->exists($userid)) {
      throw new NotFoundException(__('Invalid user'));
      }

      $CONSUMER_KEY = Configure::read('LINKEDIN_CONSUMER_KEY');
      $CONSUMER_SECRET = Configure::read('LINKEDIN_SECRET');
      $OAUTH_CALLBACK=Configure::read('SITE_URL').'users/linekdin_verification/';
      require_once(ROOT.'/app/Vendor' . DS . 'linkedin/linkedin.php');

      $config_linkedin['base_url']             =   Configure::read('SITE_URL');
      $config_linkedin['callback_url']         =   $OAUTH_CALLBACK;
      $config_linkedin['linkedin_access']      =   $CONSUMER_KEY;
      $config_linkedin['linkedin_secret']      =   $CONSUMER_SECRET;


      # First step is to initialize with your consumer key and secret. We'll use an out-of-band oauth_callback
      $linkedin = new LinkedIn($config_linkedin['linkedin_access'], $config_linkedin['linkedin_secret'], $config_linkedin['callback_url'] );
      //$linkedin->debug = true;
      $linkedin->getRequestToken();
      //$_SESSION['requestToken'] = serialize($linkedin->request_token);
      $requestToken= serialize($linkedin->request_token);
      if($requestToken){
      $this->Session->write('requestToken',$requestToken);
      //$url = $linkedin->generateAuthorizeUrl();
      //echo $url;
      if (isset($_REQUEST['oauth_verifier'])){
      //$_SESSION['oauth_verifier']     = $_REQUEST['oauth_verifier'];
      $this->Session->write('oauth_verifier',$_REQUEST['oauth_verifier']);

      $linkedin->request_token    =   unserialize($this->Session->read('requestToken'));
      $linkedin->oauth_verifier   =   $this->Session->read('oauth_verifier');
      $linkedin->getAccessToken($_REQUEST['oauth_verifier']);
      $this->Session->write('oauth_access_token',serialize($linkedin->access_token));
      //$_SESSION['oauth_access_token'] = serialize($linkedin->access_token);
      pr($linkedin->access_token);
      //header("Location: " . $config['callback_url']);
      exit;
      }else{
      $linkedin->request_token    =   unserialize($this->Session->read('requestToken'));
      $linkedin->oauth_verifier   =   $this->Session->read('oauth_verifier');
      $linkedin->access_token     =   unserialize($this->Session->read('oauth_access_token'));
      }

      $xml_response = $linkedin->getProfile("~:(id,first-name,last-name,headline,picture-url)");
      pr($xml_response);
      //$this->redirect($url);
      }else {
      //error receiving request token
      echo "Error Receiving Request Token";
      exit;
      }

      } */

    public function social_verification($social_type, $sid) {
        //$this->loadModel('Task');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $UserDetails = $this->User->find('first', $options);
        $TotPer = 25;
        if ($UserDetails['User']['fb_verification'] != '') {
            $TotPer+=25;
        }
        if ($UserDetails['User']['tw_verification'] != '') {
            $TotPer+=25;
        }
        if ($UserDetails['User']['lin_verification'] != '') {
            $TotPer+=25;
        }
        if ($UserDetails['User']['is_email'] == 1) {
            $TotPer+=25;
        }

        $user_data['User']['id'] = $userid;
        if ($social_type == 'facebook') {
            $user_data['User']['fb_verification'] = $sid;
        } elseif ($social_type == 'twitter') {
            $user_data['User']['tw_verification'] = $sid;
        } elseif ($social_type == 'linkedin') {
            $user_data['User']['lin_verification'] = $sid;
        }
        if ($TotPer >= 25) {
            $user_data['User']['user_verified'] = 1;
        }
        $this->User->save($user_data);
        echo 'Success';
        exit;
    }

    public function social_verification_delete() {
        //$this->loadModel('Task');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $social_type = $this->request->data['VerificationType'];
            $user_data['User']['id'] = $userid;
            if ($social_type == 'FacebookDelete') {
                $user_data['User']['fb_verification'] = '';
            } elseif ($social_type == 'TwitterDelete') {
                $user_data['User']['tw_verification'] = '';
            } elseif ($social_type == 'LinkedinDelete') {
                $user_data['User']['lin_verification'] = '';
            } elseif ($social_type == 'EmailDelete') {
                $user_data['User']['is_email'] = 0;
            }
            $this->User->save($user_data);

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
            $UserDetails = $this->User->find('first', $options);
            $TotPer = 25;
            if ($UserDetails['User']['fb_verification'] != '') {
                $TotPer+=25;
            }
            if ($UserDetails['User']['tw_verification'] != '') {
                $TotPer+=25;
            }
            if ($UserDetails['User']['lin_verification'] != '') {
                $TotPer+=25;
            }
            if ($UserDetails['User']['is_email'] == 1) {
                $TotPer+=25;
            }
            $user_data_update['User']['id'] = $userid;
            if ($TotPer >= 50) {
                $user_data_update['User']['user_verified'] = 1;
            } else {
                $user_data_update['User']['user_verified'] = 0;
            }
            $this->User->save($user_data_update);
        }
        if ($social_type == 'EmailDelete') {
            $this->Session->setFlash(__('You have successfully remove the email verification.'));
        } else {
            $this->Session->setFlash(__('You have successfully remove the social verification.'));
        }
        return $this->redirect(array('action' => 'verification'));
    }

    public function convert_my_currency($your_amount, $site_amount, $paypal_fee, $to) {
        $From = 'USD';
        $currency_symbols = array('AED' => '&#1583;.&#1573;', 'AFN' => '&#65;&#102;', 'ALL' => '&#76;&#101;&#107;', 'ANG' => '&#402;', 'AOA' => '&#75;&#122;', 'ARS' => 'AR&#36;', 'AUD' => 'AU&#36;', 'AWG' => '&#402;', 'AZN' => '&#1084;&#1072;&#1085;', 'BAM' => '&#75;&#77;', 'BBD' => 'BB&#36;', 'BDT' => '&#2547;', 'BGN' => '&#1083;&#1074;', 'BHD' => '.&#1583;.&#1576;', 'BIF' => '&#70;&#66;&#117;', 'BMD' => 'BM&#36;', 'BND' => 'BN&#36;', 'BOB' => '&#36;&#98;', 'BRL' => '&#82;&#36;', 'BSD' => 'BS&#36;', 'BTN' => '&#78;&#117;&#46;', 'BWP' => '&#80;', 'BYR' => '&#112;&#46;', 'BZD' => '&#66;&#90;&#36;', 'CAD' => 'CA&#36;', 'CDF' => '&#70;&#67;', 'CHF' => '&#67;&#72;&#70;', 'CLP' => 'CL&#36;', 'CNY' => '&#165;', 'COP' => 'CO&#36;', 'CRC' => '&#8353;', 'CUP' => '&#8396;', 'CVE' => 'CV&#36;', 'CZK' => '&#75;&#269;', 'DJF' => '&#70;&#100;&#106;', 'DKK' => '&#107;&#114;', 'DOP' => '&#82;&#68;&#36;', 'DZD' => '&#1583;&#1580;', 'EGP' => '&#163;', 'ETB' => '&#66;&#114;', 'EUR' => '&#8364;', 'FJD' => 'FJ&#36;', 'FKP' => '&#163;', 'GBP' => '&#163;', 'GEL' => '&#4314;', 'GHS' => '&#162;', 'GIP' => '&#163;', 'GMD' => '&#68;', 'GNF' => '&#70;&#71;', 'GTQ' => '&#81;', 'GYD' => 'GY&#36;', 'HKD' => 'HK&#36;', 'HNL' => '&#76;', 'HRK' => '&#107;&#110;', 'HTG' => '&#71;', 'HUF' => '&#70;&#116;', 'IDR' => '&#82;&#112;', 'ILS' => '&#8362;', 'INR' => '&#8377;', 'IQD' => '&#1593;.&#1583;', 'IRR' => '&#65020;', 'ISK' => '&#107;&#114;', 'JEP' => '&#163;', 'JMD' => '&#74;&#36;', 'JOD' => '&#74;&#68;', 'JPY' => '&#165;', 'KES' => '&#75;&#83;&#104;', 'KGS' => '&#1083;&#1074;', 'KHR' => '&#6107;', 'KMF' => '&#67;&#70;', 'KPW' => '&#8361;', 'KRW' => '&#8361;', 'KWD' => '&#1583;.&#1603;', 'KYD' => 'KY&#36;', 'KZT' => '&#1083;&#1074;', 'LAK' => '&#8365;', 'LBP' => '&#163;', 'LKR' => '&#8360;', 'LRD' => 'LR&#36;', 'LSL' => '&#76;', 'LTL' => '&#76;&#116;', 'LVL' => '&#76;&#115;', 'LYD' => '&#1604;.&#1583;', 'MAD' => '&#1583;.&#1605;.', 'MDL' => '&#76;', 'MGA' => '&#65;&#114;', 'MKD' => '&#1076;&#1077;&#1085;', 'MMK' => '&#75;', 'MNT' => '&#8366;', 'MOP' => '&#77;&#79;&#80;&#36;', 'MRO' => '&#85;&#77;', 'MUR' => '&#8360;', 'MVR' => '.&#1923;', 'MWK' => '&#77;&#75;', 'MXN' => 'MX&#36;', 'MYR' => '&#82;&#77;', 'MZN' => '&#77;&#84;', 'NAD' => 'NA&#36;', 'NGN' => '&#8358;', 'NIO' => '&#67;&#36;', 'NOK' => '&#107;&#114;', 'NPR' => '&#8360;', 'NZD' => 'NZ&#36;', 'OMR' => '&#65020;', 'PAB' => '&#66;&#47;&#46;', 'PEN' => '&#83;&#47;&#46;', 'PGK' => '&#75;', 'PHP' => '&#8369;', 'PKR' => '&#8360;', 'PLN' => '&#122;&#322;', 'PYG' => '&#71;&#115;', 'QAR' => '&#65020;', 'RON' => '&#108;&#101;&#105;', 'RSD' => '&#1044;&#1080;&#1085;&#46;', 'RUB' => '&#1088;&#1091;&#1073;', 'RWF' => '&#1585;.&#1587;', 'SAR' => '&#65020;', 'SDD' => '&#163;', 'SEK' => '&#107;&#114;', 'SGD' => 'SG&#36;', 'THB' => '&#3647;', 'TRL' => '&#8356;', 'TTD' => 'TT&#36;', 'TWD' => '&#78;&#84;&#36;', 'USD' => 'US&#36;', 'VEB' => '&#66;&#115;', 'XCD' => 'XC&#36;', 'ZAR' => '&#82;', 'ZMK' => '&#90;&#75;');

        if ($to != '' && array_key_exists($to, $currency_symbols)) {
            $CurrencySymbol = $currency_symbols[$to];
        } else {
            $CurrencySymbol = 'US$';
        }

        $UserAmt = $this->convertCurrency($your_amount, $to, $From);
        $SiteAmt = $this->convertCurrency($site_amount, $to, $From);
        $PaypalAmt = $this->convertCurrency($paypal_fee, $to, $From);
        echo $CurrencySymbol . $UserAmt . ':' . $CurrencySymbol . $SiteAmt . ':' . $CurrencySymbol . $PaypalAmt;
        exit;
    }

    public function convertCurrency($amount, $to, $from) {

        /* if($to=='USD'){
          $from='USD';
          }else{
          $from='USD';
          } */

        $url = "https://www.google.com/finance/converter?a=$amount&from=$from&to=$to";
        $data = file_get_contents($url);
        preg_match("/<span class=bld>(.*)<\/span>/", $data, $converted);
        $converted = preg_replace("/[^0-9.]/", "", $converted[1]);
        return number_format((float) $converted, 2, '.', '');
        //return  number_format(round($converted));
    }

    public function post_an_errand() {
        $userid = $this->Session->read('userid');
        $this->loadModel('EmailTemplate');
        $this->loadModel('Setting');
        $this->loadModel('Category');
        $this->loadModel('Task');
        $title_for_layout = 'Post an errand';
        /* if(!isset($userid)){
          $this->redirect('/');
          }
          if (!$this->User->exists($userid)) {
          throw new NotFoundException(__('Invalid user'));
          } */
        //pr($this->Session->read('post_errand'));
        $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
        if ($contact_email) {
            $adminEmail = $contact_email['Setting']['contact_email'];
            $adminSiteName = $contact_email['Setting']['site_name'];
        } else {
            $adminEmail = 'superadmin@abc.com';
            $adminSiteName = '';
        }
        if ($this->request->is(array('post', 'put'))) {
            $title = $this->request->data['title'];
            $seo_url = $this->create_slug($title);
            $category_id = $this->request->data['category_id'];
            $description = $this->request->data['description'];
            $completed = $this->request->data['completed'];
            $task_location = $this->request->data['task_location'];
            $due_date = $this->request->data['due_date'];
            $workers = $this->request->data['workers'];
            $budget_type = $this->request->data['budget_type'];
            $total_rate = $this->request->data['total_rate'];
            $per_hour_rate = $this->request->data['per_hour_rate'];
            $hour = $this->request->data['hour'];
            if ($userid != '') {
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
                $userdetails_data = $this->User->find('first', $options);
                if ($userdetails_data['User']['user_type'] == 1 || $userdetails_data['User']['user_type'] == 3) {
                    $optionsCat = array('conditions' => array('Category.id' => $category_id));
                    $category_data = $this->Category->find('first', $optionsCat);

                    $prepAddr = str_replace(' ', '+', $task_location);
                    $url = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=true');
                    $output = json_decode($url);
                    $lat = $output->results[0]->geometry->location->lat;
                    $lang = $output->results[0]->geometry->location->lng;

                    $data['Task']['user_id'] = $userid;
                    $data['Task']['title'] = $title;
                    $data['Task']['seo_url'] = $seo_url;
                    $data['Task']['description'] = $description;
                    $data['Task']['category_id'] = $category_id;
                    $data['Task']['pcat_id'] = $category_data['Category']['parent_id'];
                    $data['Task']['task_location'] = $task_location;
                    $data['Task']['lat'] = $lat;
                    $data['Task']['lang'] = $lang;
                    $data['Task']['completed'] = $completed;
                    $data['Task']['due_date'] = $due_date;
                    $data['Task']['workers'] = $workers;
                    $data['Task']['budget_type'] = $budget_type;
                    $data['Task']['status'] = 2;
                    $data['Task']['post_date'] = date('Y-m-d');
                    if ($budget_type == 2) {
                        $data['Task']['per_hour_rate'] = $per_hour_rate;
                        $data['Task']['hour'] = $hour;
                        $data['Task']['total_rate'] = $per_hour_rate * $hour;
                    } else {
                        $data['Task']['total_rate'] = $total_rate;
                    }

                    $this->Task->create();
                    /* echo '<pre>';
                      print_r($data);
                      exit; */
                    if ($this->Task->save($data)) {
                        $task_id = $this->Task->getLastInsertId();
                        $tsk = $this->Task->find('first', array('conditions' => array('Task.id' => $task_id)));
                        $this->loadModel('Notification');
                        $noti['Notification']['for_user_id'] = 0;
                        $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                        $noti['Notification']['task_id'] = $tsk['Task']['id'];
                        $noti['Notification']['date'] = date('Y-m-d H:i:s');
                        ;
                        $noti['Notification']['type'] = 'has posted new task';
                        $this->Notification->create();
                        $this->Notification->save($noti);

                        // customer mail send for new task
                        $task_Name = $tsk['Task']['title'];
                        $task_location = $tsk['Task']['task_location'];
                        $taskByUserName = $tsk['User']['first_name'] . ' ' . $tsk['User']['last_name'];
                        if ($task_location != '') {
                            $TaskLocUser = $this->User->find('all', array('conditions' => array('User.location' => $task_location, 'User.id !=' => $userid, 'OR' => array('User.user_type' => 2, 'User.user_type' => 3))));
                        } else {
                            $TaskLocUser = array();
                        }
                        if (count($TaskLocUser) > 0) {
                            foreach ($TaskLocUser as $UserVal) {
                                $SendUserEmail = $UserVal['User']['email'];
                                $SendUserName = $UserVal['User']['first_name'] . ' ' . $UserVal['User']['last_name'];
                                if ($SendUserEmail != '') {

                                    $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 11)));
                                    $mail_body = str_replace(array('[USER]', '[POSTBY]', '[TASKNAME]', '[TASKLOCATION]'), array($SendUserName, $taskByUserName, $task_Name, $task_location), $EmailTemplate['EmailTemplate']['content']);


                                    /* pass user input to function
                                      $Email->emailFormat('both');
                                      $Email->from(array($adminEmail => $adminSiteName));
                                      $Email->to($SendUserEmail);
                                      $Email->subject($EmailTemplate['EmailTemplate']['subject']);
                                      $Email->send($mail_body); */

                                    $from = $adminSiteName . ' <' . $adminEmail . '>';
                                    $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                                    $this->php_mail($SendUserEmail, $from, $Subject_mail, $mail_body);
                                }
                            }
                        }
                        $this->Session->setFlash('You have successfully post your errand', 'default', array('class' => 'success'));
                        return $this->redirect('/users/my_errand');
                    }
                } else {
                    $this->Session->write('profile_setting_change', 1);
                    $this->Session->setFlash('You need  to select the "post" option in my account setting', 'default', array('class' => 'success'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'post_an_errand'));
                }
            } else {
                $post_data = array('title' => $title, 'category_id' => $category_id, 'description' => $description, 'completed' => $completed, 'task_location' => $task_location, 'due_date' => $due_date, 'workers' => $workers, 'budget_type' => $budget_type, 'total_rate' => $total_rate, 'per_hour_rate' => $per_hour_rate, 'hour' => $hour);
                $this->Session->write('post_errand', $post_data);
                $this->Session->setFlash('Please sign in to continue to post your job.Your errand has been saved in your open section.');
                return $this->redirect(array('controller' => 'users', 'action' => 'login'));
            }
        }

        $this->set(compact('title_for_layout'));
    }

    public function edit_post($id = null) {
        $userid = $this->Session->read('userid');
        $this->loadModel('EmailTemplate');
        $this->loadModel('Setting');
        $this->loadModel('Category');
        $this->loadModel('Task');
        $title_for_layout = 'Edit an errand';
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $task_id = base64_decode($id);
        if (!isset($id)) {
            $this->redirect('/users/my_errand');
        }

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $userdetails_data = $this->User->find('first', $options);

        if ($this->request->is(array('post', 'put'))) {
            if ($userdetails_data['User']['user_type'] == 1 || $userdetails_data['User']['user_type'] == 3) {
                $title = $this->request->data['title'];
                $category_id = $this->request->data['category_id'];
                $description = $this->request->data['description'];
                $completed = $this->request->data['completed'];
                $task_location = $this->request->data['task_location'];
                $due_date = $this->request->data['due_date'];
                $workers = $this->request->data['workers'];
                $budget_type = $this->request->data['budget_type'];
                $total_rate = $this->request->data['total_rate'];
                $per_hour_rate = $this->request->data['per_hour_rate'];
                $hour = $this->request->data['hour'];

                $optionsCat = array('conditions' => array('Category.id' => $category_id));
                $category_data = $this->Category->find('first', $optionsCat);

                $prepAddr = str_replace(' ', '+', $task_location);
                $url = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $prepAddr . '&sensor=true');
                $output = json_decode($url);
                $lat = $output->results[0]->geometry->location->lat;
                $lang = $output->results[0]->geometry->location->lng;

                $data['Task']['id'] = $task_id;
                $data['Task']['user_id'] = $userid;
                $data['Task']['title'] = $title;
                $data['Task']['description'] = $description;
                $data['Task']['category_id'] = $category_id;
                $data['Task']['pcat_id'] = $category_data['Category']['parent_id'];
                $data['Task']['task_location'] = $task_location;
                $data['Task']['lat'] = $lat;
                $data['Task']['lang'] = $lang;
                $data['Task']['completed'] = $completed;
                $data['Task']['due_date'] = $due_date;
                $data['Task']['workers'] = $workers;
                $data['Task']['budget_type'] = $budget_type;
                if ($budget_type == 2) {
                    $data['Task']['per_hour_rate'] = $per_hour_rate;
                    $data['Task']['hour'] = $hour;
                    $data['Task']['total_rate'] = $per_hour_rate * $hour;
                } else {
                    $data['Task']['total_rate'] = $total_rate;
                }

                if ($this->Task->save($data)) {
                    $tsk = $this->Task->find('first', array('conditions' => array('Task.id' => $task_id)));
                    $this->loadModel('Proposal');
                    $this->loadModel('Job');
                    $pro = $this->Proposal->find('all', array('conditions' => array('Proposal.task_id' => $task_id)));
                    if (!empty($pro)) {
                        foreach ($pro as $pros) {
                            $this->loadModel('Notification');
                            $noti['Notification']['for_user_id'] = $pros['Proposal']['user_id'];
                            $noti['Notification']['by_user_id'] = $tsk['Task']['user_id'];
                            $noti['Notification']['task_id'] = $tsk['Task']['id'];
                            $noti['Notification']['date'] = date('Y-m-d H:i:s');
                            ;
                            $noti['Notification']['type'] = 'has edited task';
                            $this->Notification->create();
                            $this->Notification->save($noti);
                        }
                    }

                    // customer mail send for new task
                    $task_Name = $tsk['Task']['title'];
                    $task_location = $tsk['Task']['task_location'];
                    $taskByUserName = $tsk['User']['first_name'] . ' ' . $tsk['User']['last_name'];
                    if ($task_location != '') {
                        $TaskLocUser = $this->User->find('all', array('conditions' => array('User.location' => $task_location, 'User.id !=' => $userid, 'OR' => array('User.user_type' => 2, 'User.user_type' => 3))));
                    } else {
                        $TaskLocUser = array();
                    }
                    if (count($TaskLocUser) > 0) {
                        $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
                        if ($contact_email) {
                            $adminEmail = $contact_email['Setting']['contact_email'];
                            $adminSiteName = $contact_email['Setting']['site_name'];
                        } else {
                            $adminEmail = 'superadmin@abc.com';
                            $adminSiteName = '';
                        }
                        foreach ($TaskLocUser as $UserVal) {
                            $SendUserEmail = $UserVal['User']['email'];
                            $SendUserName = $UserVal['User']['first_name'] . ' ' . $UserVal['User']['last_name'];
                            if ($SendUserEmail != '') {

                                $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 11)));
                                $mail_body = str_replace(array('[USER]', '[POSTBY]', '[TASKNAME]', '[TASKLOCATION]'), array($SendUserName, $taskByUserName, $task_Name, $task_location), $EmailTemplate['EmailTemplate']['content']);


                                /* pass user input to function
                                  $Email->emailFormat('both');
                                  $Email->from(array($adminEmail => $adminSiteName));
                                  $Email->to($SendUserEmail);
                                  $Email->subject($EmailTemplate['EmailTemplate']['subject']);
                                  $Email->send($mail_body); */

                                $from = $adminSiteName . ' <' . $adminEmail . '>';
                                $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                                $this->php_mail($SendUserEmail, $from, $Subject_mail, $mail_body);
                            }
                        }
                    }
                    $this->Session->setFlash('You have successfully edit your errand', 'default', array('class' => 'success'));
                    return $this->redirect(array('controller' => 'users', 'action' => 'edit_post/' . $id));
                }
            } else {
                $this->Session->setFlash('You can not post an errand. Please change your account setting to "Post"', 'default', array('class' => 'success'));
                return $this->redirect('/users/my_errand');
            }
        }

        $options_task = array('conditions' => array('Task.id' => $task_id));
        $task_details = $this->Task->find('first', $options_task);
        $this->set(compact('title_for_layout', 'task_details'));
    }

    public function createthumb() {
        $title_for_layout = 'Edit Profile';
        $username = $this->Session->read('username');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            $x1 = $this->request->data["x1"];
            $y1 = $this->request->data["y1"];
            $x2 = $this->request->data["x2"];
            $y2 = $this->request->data["y2"];
            $w = $this->request->data["w"];
            $h = $this->request->data["h"];
            $hid_pre_profile_img = $this->request->data["hid_pre_profile_img"];
            $thumb_width = 300;
            //Scale the image to the thumb_width set above
            $scale = $thumb_width / $w;
            $uploadFolder = "user_images";
            $uploadPath = WWW_ROOT . $uploadFolder;
            $large_image_location = $uploadPath . '/' . $hid_pre_profile_img;
            $thumb_img = rand(10, 999) . '_' . $hid_pre_profile_img;
            $thumb_image_name = $uploadPath . '/' . $thumb_img;
            $cropped = $this->resizeThumbnailImage($thumb_image_name, $large_image_location, $w, $h, $x1, $y1, $scale);
            if (isset($cropped) && $cropped != '') {
                $User_data['User']['id'] = $userid;
                $User_data['User']['profile_img'] = $thumb_img;
                $this->User->save($User_data);
                unlink($large_image_location);
                $this->Session->setFlash(__('Your details have been saved.'));
                return $this->redirect(array('action' => 'editprofile'));
            } else {
                $this->Session->setFlash(__('Your details could not be saved. Please, try again.'));
                return $this->redirect(array('action' => 'editprofile'));
            }
        } else {
            return $this->redirect(array('action' => 'editprofile'));
        }
    }

    public function resizeThumbnailImage($thumb_image_name, $image, $width, $height, $start_width, $start_height, $scale) {
        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);


        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, $start_width, $start_height, $newImageWidth, $newImageHeight, $width, $height);
        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $thumb_image_name);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $thumb_image_name, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $thumb_image_name);
                break;
        }
        chmod($thumb_image_name, 0777);
        return $thumb_image_name;
    }

    public function resizeImage($image, $width, $height, $scale) {

        list($imagewidth, $imageheight, $imageType) = getimagesize($image);
        $imageType = image_type_to_mime_type($imageType);
        $newImageWidth = ceil($width * $scale);
        $newImageHeight = ceil($height * $scale);
        $newImage = imagecreatetruecolor($newImageWidth, $newImageHeight);
        switch ($imageType) {
            case "image/gif":
                $source = imagecreatefromgif($image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                $source = imagecreatefromjpeg($image);
                break;
            case "image/png":
            case "image/x-png":
                $source = imagecreatefrompng($image);
                break;
        }
        imagecopyresampled($newImage, $source, 0, 0, 0, 0, $newImageWidth, $newImageHeight, $width, $height);

        switch ($imageType) {
            case "image/gif":
                imagegif($newImage, $image);
                break;
            case "image/pjpeg":
            case "image/jpeg":
            case "image/jpg":
                imagejpeg($newImage, $image, 90);
                break;
            case "image/png":
            case "image/x-png":
                imagepng($newImage, $image);
                break;
        }

        chmod($image, 0777);
        return $image;
    }

    /////////////////////////End suman ///////////////////////////////////////
    /////////////////////////App Function suman ///////////////////////////////////////
    //http://errandchampion.com/users/appsignup?email=nits.ananya15@gmail.com&password=123456&firstname=Ananya&lastname=Bera&location=NITS&zipcode=700124&phone_no=123654789&user_type=3

    public function appsignup() {
        $this->autoRender = false;
        $data = array();
        if (!empty($_REQUEST)) {
            //pr($_REQUEST);exit;
            $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
            $password = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
            $firstname = isset($_REQUEST['firstname']) ? $_REQUEST['firstname'] : '';
            $lastname = isset($_REQUEST['lastname']) ? $_REQUEST['lastname'] : '';
            $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : '';
            $zipcode = isset($_REQUEST['zipcode']) ? $_REQUEST['zipcode'] : '';
            $phone_no = isset($_REQUEST['phone_no']) ? $_REQUEST['phone_no'] : '';
            $user_type = isset($_REQUEST['user_type']) ? $_REQUEST['user_type'] : 3;

            if ($email != '' && $password != '') {

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['Ack'] = 0;
                    $data['msg'] = 'Please enter valid email.';
                } else {
                    $options = array('conditions' => array('User.email' => $email));
                    $emailexists = $this->User->find('first', $options);
                    if (!$emailexists) {
                        $arr = array();
                        $arr['User']['email'] = $email;
                        $arr['User']['txt_password'] = $password;
                        $arr['User']['password'] = md5($password);
                        $arr['User']['city'] = '';
                        $arr['User']['first_name'] = $firstname;
                        $arr['User']['last_name'] = $lastname;
                        $arr['User']['birthday'] = '0000-00-00';
                        $arr['User']['country'] = 0;
                        $arr['User']['about'] = '';
                        $arr['User']['phone_no'] = $phone_no;
                        $arr['User']['user_type'] = $user_type;
                        $arr['User']['location'] = $location;
                        $arr['User']['zipcode'] = $zipcode;
                        $arr['User']['join_date'] = date('Y-m-d');
                        $arr['User']['is_active'] = 1;
                        //pr($data);exit;
                        $this->User->create();
                        if ($this->User->save($arr)) {
                            $id = $this->User->getLastInsertId();


                            $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
                            if ($contact_email) {
                                $adminEmail = $contact_email['Setting']['contact_email'];
                            } else {
                                $adminEmail = 'superadmin@abc.com';
                            }
                            $options = array('conditions' => array('User.id' => $id));
                            $lastInsetred = $this->User->find('first', $options);
                            //print_r($lastInsetred);
                            $this->loadModel('EmailTemplate');
                            $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 4)));
                            $siteurl = Configure::read('SITE_URL');
                            $LOGINLINK = $siteurl . 'users/login';
                            $msg_body = str_replace(array('[USER]', '[LOGINLINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK), $EmailTemplate['EmailTemplate']['content']);

                            $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                            //$Subject_mail='Welcome to '.$contact_email['Setting']['site_name'];
                            $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                            $this->php_mail($lastInsetred['User']['email'], $from, $Subject_mail, $msg_body);

                            $this->loadModel('InboxMessage');
                            $InboxMessageData['InboxMessage']['location'] = 'Broshure.pdf';
                            $InboxMessageData['InboxMessage']['user_id'] = $id;
                            $InboxMessageData['InboxMessage']['sender_id'] = 2;
                            $InboxMessageData['InboxMessage']['contact_id'] = 1;
                            $InboxMessageData['InboxMessage']['subject'] = 'Welcome to Errand Champion.';
                            $InboxMessageData['InboxMessage']['message'] = 'Welcome to Errand Champion. Please refer to your email for a convenient overview of our client and contractor polices for your reference.';
                            $InboxMessageData['InboxMessage']['date_time'] = date('Y-m-d H:i:s');

                            $this->InboxMessage->create();
                            $this->InboxMessage->save($InboxMessageData);

                            /* $UserDetails=array();
                              foreach($lastInsetred as $UserVal){
                              $UserDetails=$UserVal;
                              } */

                            //$data['LastID'] = $id;
                            $data['Ack'] = 1;
                            $data['msg'] = 'You have successfully registered. Please check your mail.';
                            /* $data['UserDetails'] = array(
                              "userid" => $id,
                              "first_name" => isset($firstname) ? $firstname : '',
                              "last_name" => isset($lastname) ? $lastname : '',
                              "email" => isset($email) ? $email : '',
                              "location" => isset($location) ? $location : '',
                              "phone_no" => isset($phone_no) ? $phone_no : '',
                              "profile_img" => ''
                              ); */

                            $data_one['UserProfDetails'] = $lastInsetred;
                            $data_one['UserSkillDetails'] = array('' => '');
                            $data_one['UserBillingDetails'] = array('' => '');
                            $data['UserDetails'] = $data_one;
                            //print_r($data);
                            //$data['UserDetails'] = $UserDetails;
                        }
                    } else {
                        $data['Ack'] = 0;
                        $data['msg'] = 'Email already exists';
                    }
                }
            } else {
                $data['Ack'] = 0;
                $data['msg'] = 'Signup error, Provide All Details';
            }
        } else {
            $data['Ack'] = 0;
            $data['msg'] = 'Signup error, Provide All Details';
        }
        $result = json_encode($data);
        return $result;
    }

    //http://errandchampion.com/users/socialSignup?fname=Abhijit&lname=Kundu&email=nits.abhijit@gmail.com&signupby=facebook&fbId=173289273036088

    public function socialSignup() {

        $this->autoRender = false;
        $data = array();
        $arr = array();
        if (!empty($_REQUEST)) {
            //pr($_REQUEST);exit;
            //$email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
            $SocialID = isset($_REQUEST['fbId']) ? $_REQUEST['fbId'] : '';
            $firstname = isset($_REQUEST['fname']) ? $_REQUEST['fname'] : '';
            $lastname = isset($_REQUEST['lname']) ? $_REQUEST['lname'] : '';

            if ($_REQUEST['signupby'] == 'facebook') {
                $fb_user_id = isset($_REQUEST['fbId']) ? $_REQUEST['fbId'] : '';
                $arr['User']['facebook_id'] = $fb_user_id;
                //$arr['User']['fb_verification'] = $fb_user_id;
                //Facebook image capture

                /* $img_path = file_get_contents('https://graph.facebook.com/'.$fb_user_id.'/picture?type=large');
                  $des = "../uploads/users/".$fb_user_id.'.jpg';
                  $updated_file_name = SITE_URL.'uploads/users/'.$fb_user_id.'.jpg';
                  $db_photo_name = $fb_user_id.'.jpg';
                  file_put_contents($des, $img_path); */

                //End of facebook image capture
            } elseif ($_REQUEST['signupby'] == 'twitter') {
                $twitter_user_id = isset($_REQUEST['fbId']) ? $_REQUEST['fbId'] : '';
                $arr['User']['tw_user_id'] = $twitter_user_id;
                $arr['User']['tw_verification'] = $twitter_user_id;
            } elseif ($_REQUEST['signupby'] == 'gplus') {
                $gplus_user_id = isset($_REQUEST['fbId']) ? $_REQUEST['fbId'] : '';
            }



            $options = array('conditions' => array('OR' => array('User.facebook_id' => $SocialID)));
            $userIDexists = $this->User->find('first', $options);

            if (!$userIDexists) {
                //$arr['User']['email_address'] = $email;
                $arr['User']['user_pass'] = md5($SocialID);
                $arr['User']['first_name'] = $firstname;
                $arr['User']['last_name'] = $lastname;
                $arr['User']['member_since'] = date('Y-m-d');
                $arr['User']['status'] = 1;
                $arr['User']['is_sociallogin'] = 1;
                $arr['User']['admin_type'] = 3;


                //$arr['User']['txt_password'] = $SocialID;
                //$arr['User']['city'] = '';
                //$arr['User']['birthday'] = '0000-00-00';
                //$arr['User']['country'] = 0;
                //$arr['User']['about'] = '';
                //$arr['User']['zipcode'] = $zipcode;


                $this->User->create();
                if ($this->User->save($arr)) {
                    $id = $this->User->getLastInsertId();


                    $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
                    if ($contact_email) {
                        $adminEmail = $contact_email['Setting']['site_email'];
                    } else {
                        $adminEmail = 'superadmin@abc.com';
                    }
                    $options = array('conditions' => array('User.id' => $id));
                    $lastInsetred = $this->User->find('first', $options);

                    $this->loadModel('EmailTemplate');
                    $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 3)));
                    $siteurl = Configure::read('SITE_URL');
                    $LOGINLINK = $siteurl . 'users/login';
                    $msg_body = str_replace(array('[USER]', '[LOGINLINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK), $EmailTemplate['EmailTemplate']['content']);

                    $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                    $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                    $this->php_mail($lastInsetred['User']['email_address'], $from, $Subject_mail, $msg_body);

                    // $this->loadModel('InboxMessage');
                    // $InboxMessageData['InboxMessage']['location'] = 'Broshure.pdf';
                    // $InboxMessageData['InboxMessage']['user_id'] = $id;
                    // $InboxMessageData['InboxMessage']['sender_id'] = 2;
                    // $InboxMessageData['InboxMessage']['contact_id'] = 1;
                    // $InboxMessageData['InboxMessage']['subject'] = 'Welcome to Errand Champion.';
                    // $InboxMessageData['InboxMessage']['message'] = 'Welcome to Errand Champion. Please refer to your email for a convenient overview of our client and contractor polices for your reference.';
                    // $InboxMessageData['InboxMessage']['date_time'] = date('Y-m-d H:i:s');
                    // $this->InboxMessage->create();
                    // $this->InboxMessage->save($InboxMessageData);

                    $this->Session->write('is_signup', '1');
                    $this->Session->write('userid', $lastInsetred['User']['id']);
                    $this->Session->write('username', $lastInsetred['User']['first_name']);
                    $this->Session->write('activated', $lastInsetred['User']['activated']);

                    $data['Ack'] = 1;
                    $data['msg'] = 'You have successfully registered.';
                    $data['UserDetails'] = array(
                        "userid" => $id,
                        "first_name" => isset($firstname) ? $firstname : '',
                        "last_name" => isset($lastname) ? $lastname : '',
                        "email" => isset($email) ? $email : '',
                        "location" => isset($location) ? $location : '',
                        "phone_no" => '',
                        "profile_img" => ''
                    );
                    /* $UserDetails=array();
                      foreach($lastInsetred as $UserVal){
                      $UserDetails=$UserVal;
                      }
                      $data['UserDetails'] = $UserDetails; */
                }
            } else {
                $data['Ack'] = 0;
                $data['msg'] = 'Signup error, You already signup';
            }
        } else {
            $data['Ack'] = 0;
            $data['msg'] = 'Signup error, Provide All Details';
        }
        $result = json_encode($data);
        return $result;
        die();
    }

    //http://errandchampion.com/users/appsignin?email=nits.kallol@gmail.com&password=123456

    public function appsignin() {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $data = array();
        if (!empty($_REQUEST)) {
            $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';
            $pass = isset($_REQUEST['password']) ? $_REQUEST['password'] : '';
            if ($email == '' || $pass == '') {
                $data['Ack'] = 0;
                $data['msg'] = 'Login error, Please Enter Your login details';
            } else {
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $data['Ack'] = 0;
                    $data['msg'] = 'Please enter valid email.';
                } else {

                    $options = array('conditions' => array('User.email' => $email, 'User.password' => md5($pass), 'User.is_active' => 1));
                    $loginuser = $this->User->find('first', $options);

                    if (!$loginuser) {
                        $data['Ack'] = 0;
                        $data['msg'] = 'Invalid Email or Password, Please try again.';
                    } else {
                        $activity_data['Activity']['user_id'] = $loginuser['User']['id'];
                        $activity_data['Activity']['date'] = date('Y-m-d H:i:s');
                        $activity_data['Activity']['status'] = 'Login';
                        $activity_data['Activity']['ip'] = $_SERVER['REMOTE_ADDR'];
                        $this->Activity->save($activity_data);

                        $user_data_auth['User']['id'] = $loginuser['User']['id'];
                        $user_data_auth['User']['txt_password'] = $pass;
                        $user_data_auth['User']['is_login'] = 1;
                        $this->User->save($user_data_auth);
                        $UserDetails = array();
                        foreach ($loginuser as $UserVal) {
                            $UserDetails = $UserVal;
                        }

                        $data['Ack'] = 1;
                        //$data['UserDetails']=$UserDetails;
                        $data['UserDetails'] = $this->getSingleUserProfDet($loginuser['User']['id']);
                        $data['msg'] = 'You have successfully logged In';
                    }
                }
            }
        } else {
            $data['Ack'] = 0;
            $data['msg'] = 'Login error, Email or Password is Missing';
        }
        $result = json_encode($data);
        return $result;
    }

    //http://errandchampion.com/users/updateProfile?userID=25&first_name=Kallol&last_name=Test&tagline=Test contect&location=Kolkata, West Bengal, India&photo=photo&zipcode=123456&birthday=2016-03-26&abn=123456&phone_no=1234567890&about=Some text&gender=M&check_type=3

    public function updateProfile() {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $data = array();

        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $first_name = isset($_REQUEST['first_name']) ? $_REQUEST['first_name'] : '';
        $last_name = isset($_REQUEST['last_name']) ? $_REQUEST['last_name'] : '';
        $tagline = isset($_REQUEST['tagline']) ? $_REQUEST['tagline'] : '';
        $location = isset($_REQUEST['location']) ? $_REQUEST['location'] : '';
        $zipcode = isset($_REQUEST['zipcode']) ? $_REQUEST['zipcode'] : '';
        $birthday = isset($_REQUEST['birthday']) ? $_REQUEST['birthday'] : '';
        $abn = isset($_REQUEST['abn']) ? $_REQUEST['abn'] : '';
        $phone_no = isset($_REQUEST['phone_no']) ? $_REQUEST['phone_no'] : '';
        $about = isset($_REQUEST['about']) ? $_REQUEST['about'] : '';
        $gender = isset($_REQUEST['gender']) ? $_REQUEST['gender'] : 'M';
        $user_type = isset($_REQUEST['check_type']) ? $_REQUEST['check_type'] : 1;
        $photo = isset($_FILES['photo']['name']) ? $_FILES['photo']['name'] : '';

        if (!$this->User->exists($userID)) {
            $data['Ack'] = 0;
            $data['msg'] = 'Invalid user';
        } else {

            if (isset($photo) && $photo != '') {
                $ext = explode('/', $_FILES['photo']['type']);
                if ($ext) {
                    $uploadFolder = "user_images";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array($ext[1], $extensionValid)) {

                        $max_width = "500";
                        $size = getimagesize($_FILES['photo']['tmp_name']);

                        $width = $size[0];
                        $height = $size[1];
                        $imageName = $userID . '_' . (strtolower(trim($_FILES['photo']['name'])));
                        $full_image_path = $uploadPath . '/' . $imageName;
                        move_uploaded_file($_FILES['photo']['tmp_name'], $full_image_path);
                        $User_data['User']['profile_img'] = $imageName;

                        if ($width > $max_width) {
                            $scale = $max_width / $width;
                            $uploaded = $this->resizeImage($full_image_path, $width, $height, $scale);
                        } else {
                            $scale = 1;
                            $uploaded = $this->resizeImage($full_image_path, $width, $height, $scale);
                        }/**/
                        //unlink($uploadPath. '/' .$this->request->data['User']['hidprofile_img']);
                    } else {
                        $data['msg'] = 'Please upload image of .jpg, .jpeg, .png or .gif format.';
                    }
                }
            }

            $User_data['User']['id'] = $userID;
            $User_data['User']['first_name'] = $first_name;
            $User_data['User']['last_name'] = $last_name;
            $User_data['User']['tagline'] = $tagline;
            $User_data['User']['location'] = $location;
            $User_data['User']['zipcode'] = $zipcode;
            $User_data['User']['birthday'] = $birthday;
            $User_data['User']['abn'] = $abn;
            $User_data['User']['phone_no'] = $phone_no;
            $User_data['User']['about'] = $about;
            $User_data['User']['gender'] = $gender;
            $User_data['User']['user_type'] = $user_type;
            $this->User->save($User_data);

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userID));
            $UserDetails_data = $this->User->find('first', $options);
            $user_detail = array();
            foreach ($UserDetails_data as $userDet) {
                $user_detail = $userDet;
            }
            $data['Ack'] = 1;
            $data['UserDetails'] = $user_detail;
            $data['msg'] = 'Profile Updated Successfully';
        }

        $result = json_encode($data);
        return $result;
    }

    //http://errandchampion.com/users/app_changepwd?userID=25&newpassword=123456&oldpass=123
    public function app_changepwd() {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $data = array();

        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $newpassword = isset($_REQUEST['newpassword']) ? $_REQUEST['newpassword'] : '';
        $oldpass = isset($_REQUEST['oldpass']) ? $_REQUEST['oldpass'] : '';

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userID));
        $user = $this->User->find('first', $options);
        $prev_pass = $user['User']['txt_password'];

        if (!$this->User->exists($userID)) {
            $data['Ack'] = 0;
            $data['msg'] = 'Invalid user';
        } else {
            if ($prev_pass != $oldpass) {
                $data['Ack'] = 0;
                $data['msg'] = "Invalid old password";
            } else {
                $user_data_auth['User']['id'] = $userID;
                $user_data_auth['User']['password'] = md5($newpassword);
                $user_data_auth['User']['txt_password'] = $newpassword;
                $this->User->save($user_data_auth);
                $data['Ack'] = 1;
                $data['msg'] = "Password changed successfully";
            }
        }

        $result = json_encode($data);
        return $result;
    }

    //http://errandchampion.com/users/appForgotPws?email=nits.harinarayan@gmail.com
    public function appForgotPws() {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $data = array();
        //$userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

        $options = array('conditions' => array('User.email' => $email));
        $user = $this->User->find('first', $options);

        if (empty($user)) {
            $data['Ack'] = 0;
            $data['msg'] = 'Invalid email provided. Please, try again.';
        } else {
            $length = 6;
            $chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . '0123456789';
            $str = '';
            $max = strlen($chars) - 1;
            for ($i = 0; $i < $length; $i++)
                $str .= $chars[rand(0, $max)];

            $password = $str;
            $table = '<table style="width:400px;border:0px;">
                                        <tr>
                                                <td style="width:100px;">User email&nbsp;:</td>
                                                <td>' . $user['User']['email'] . '</td>
                                        </tr>
                                        <tr>
                                                <td style="width:100px;">Password&nbsp;:</td>
                                                <td>' . $password . '</td>
                                        </tr>
                                        </table>';
            $msg_body = 'Hi ' . $user['User']['first_name'] . '<br/><br/>Your new password has been successfully regenarated. The new login details are as follows:<br/>' . $table . ' <br/><br/>Thanks,<br/>Admin';

            $User_data['User']['id'] = $user['User']['id'];
            $User_data['User']['password'] = md5($password);
            $User_data['User']['txt_password'] = $password;
            if ($this->User->save($User_data)) {
                $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.contact_email', 'Setting.site_name')));
                if ($contact_email) {
                    $adminEmail = $contact_email['Setting']['contact_email'];
                } else {
                    $adminEmail = 'superadmin@abc.com';
                }
                $site_name = $contact_email['Setting']['site_name'];

                $from = $site_name . ' <' . $adminEmail . '>';
                $Subject_mail = $site_name . ' Forgot Password';
                $this->php_mail($user['User']['email'], $from, $Subject_mail, $msg_body);
                $data['Ack'] = 1;
                $data['msg'] = "Your new password has been sent to your email.";
            } else {
                $data['Ack'] = 0;
                $data['msg'] = "Your details could not be saved. Please, try again.";
            }
        }

        $result = json_encode($data);
        return $result;
    }

    // http://errandchampion.com/users/getProfileDetails?userID=25

    public function getProfileDetails() {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $data = array();
        $this->loadModel('Skill');
        $this->loadModel('BillingAddress');
        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';

        if (!$this->User->exists($userID)) {
            $data['Ack'] = 0;
            $data['msg'] = 'Invalid user';
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userID));
            $UserDetails_data = $this->User->find('first', $options);
            $user_detail = array();
            $user_skilldetail = array();
            $user_billingdetail = array();
            foreach ($UserDetails_data as $userDet) {
                $user_detail = $userDet;
            }

            $UserSkill_data = $this->Skill->find("first", array('conditions' => array('Skill.user_id' => $userID)));
            foreach ($UserSkill_data as $userSkill) {
                $user_skilldetail = $userSkill;
            }

            $UserBilling_data = $this->BillingAddress->find("first", array('conditions' => array('BillingAddress.user_id' => $userID)));
            foreach ($UserBilling_data as $userBill) {
                $user_billingdetail = $userBill;
            }
            $data['Ack'] = 1;
            $data['UserDetails'] = $user_detail;
            $data['UserSkillDetails'] = $user_skilldetail;
            $data['UserBillingDetails'] = $user_billingdetail;
            //$data['msg'] = 'Profile Updated Successfully';
        }

        $result = json_encode($data);
        return $result;
    }

    // http://errandchampion.com/users/getSingleUserProfDet?userID=25

    public function getSingleUserProfDet($id = null) {
        $this->autoRender = false;
        $data = array();
        $this->loadModel('Skill');
        $this->loadModel('BillingAddress');
        $userID = $id;

        if (!$this->User->exists($userID)) {
            //$data['msg']='Invalid user';
        } else {
            $options = array('conditions' => array('User.id' => $userID));
            $UserDetails_data = $this->User->find('first', $options);
            $user_detail = array();
            $user_skilldetail = array();
            $user_billingdetail = array();
            foreach ($UserDetails_data as $userDet) {
                $user_detail = $userDet;
            }

            $UserSkill_data = $this->Skill->find("first", array('conditions' => array('Skill.user_id' => $userID)));
            if (count($UserSkill_data) > 0) {
                foreach ($UserSkill_data as $userSkill) {
                    $user_skilldetail = $userSkill;
                }
            } else {
                //$user_skilldetail[]='';
            }
            $UserBilling_data = $this->BillingAddress->find("first", array('conditions' => array('BillingAddress.user_id' => $userID)));
            if (count($UserBilling_data) > 0) {
                foreach ($UserBilling_data as $userBill) {
                    $user_billingdetail = $userBill;
                }
            } else {
                //$user_billingdetail[]='';
            }
            $data['UserProfDetails'] = $user_detail;
            $data['UserSkillDetails'] = (count($user_skilldetail) > 0) ? $user_skilldetail : array('' => '');
            $data['UserBillingDetails'] = (count($user_billingdetail) > 0) ? $user_billingdetail : array('' => '');
        }

        //$result = json_encode($data);
        return $data;
    }

    public function getSingleProfileDetails($userID = null) {
        $this->autoRender = false;
        $this->User->recursive = 0;
        $data = array();
        $this->loadModel('Skill');

        $options = array('conditions' => array('User.' . $this->User->primaryKey => $userID));
        $UserDetails_data = $this->User->find('first', $options);
        $user_detail = array();
        $user_skilldetail = array();
        foreach ($UserDetails_data as $userDet) {
            $user_detail = $userDet;
        }

        $UserSkill_data = $this->Skill->find("first", array('conditions' => array('Skill.user_id' => $userID)));
        foreach ($UserSkill_data as $userSkill) {
            $user_skilldetail = $userSkill;
        }

        $data['UserDetails'] = $user_detail;
        $data['UserSkillDetails'] = $user_skilldetail;

        $result = $data;
        return $result;
    }

    //http://errandchampion.com/users/appskill_update?userID=25&id=12&skill_overview=some text&transportation=Bicycle,Online,Walk&language=Bengali,Hindi,English&education=MP,HS,BCA&work=IT,Facalty,web&speciality=Driving,painting

    public function appskill_update() {
        $this->autoRender = false;
        //$this->User->recursive = 0;
        $this->loadModel('Skill');
        $data = array();
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';
        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $skill_overview = isset($_REQUEST['skill_overview']) ? $_REQUEST['skill_overview'] : '';
        $transportation = isset($_REQUEST['transportation']) ? $_REQUEST['transportation'] : '';
        $language = isset($_REQUEST['language']) ? $_REQUEST['language'] : '';
        $education = isset($_REQUEST['education']) ? $_REQUEST['education'] : '';
        $work = isset($_REQUEST['work']) ? $_REQUEST['work'] : '';
        $speciality = isset($_REQUEST['speciality']) ? $_REQUEST['speciality'] : '';
        if (!$this->User->exists($userID)) {
            $data['Ack'] = 0;
            $data['msg'] = 'Invalid user';
        } else {
            if ($id != '') {
                $skill_data['Skill']['id'] = $id;
            }
            $skill_data['Skill']['user_id'] = $userID;
            $skill_data['Skill']['skill_overview'] = $skill_overview;
            $skill_data['Skill']['transportation'] = $transportation;
            $skill_data['Skill']['language'] = $language;
            $skill_data['Skill']['education'] = $education;
            $skill_data['Skill']['work'] = $work;
            $skill_data['Skill']['speciality'] = $speciality;
            $this->Skill->save($skill_data);

            $data['Ack'] = 1;
            $data['msg'] = 'The skill has been saved';
        }

        $result = json_encode($data);
        return $result;
    }

    //http://errandchampion.com/users/app_allcategory_list
    public function app_allcategory_list() {
        $this->autoRender = false;
        $this->Category->recursive = 0;
        $data = array();
        $this->loadModel('Category');
        $options = array('conditions' => array('Category.parent_id' => 0, 'Category.active' => 1), 'order' => array('Category.name' => 'asc'));
        $categories = $this->Category->find('all', $options);

        if (empty($categories) && count($categories) < 1) {
            $data['Ack'] = 0;
            $data['msg'] = 'No Category found';
        } else {
            foreach ($categories as $category) {
                $PcatList = array();
                $PcatName = $category['Category']['name'];
                $PcatID = $category['Category']['id'];
                if ($PcatName != '') {
                    $SubCatList = $this->getsubcat($PcatID);
                    if (count($SubCatList) > 0) {
                        $SubCatArr = array();
                        foreach ($SubCatList as $subCat) {
                            $SubcatName = $subCat['Category']['name'];
                            $SubcatID = $subCat['Category']['id'];
                            $SubCatArr[] = array('id' => $SubcatID, 'name' => $SubcatName);
                        }
                    } else {
                        $SubCatArr = array();
                    }
                }
                $PcatList['ParentCatName'] = $PcatName;
                $PcatList['ChildCatList'] = isset($SubCatArr) ? $SubCatArr : '';
                $data['CatList'][] = $PcatList;
            }

            $data['Ack'] = 1;
            //$data=array('CatList' => $PcatList);
            //$data['CatList'] = $PcatList;
            $data['msg'] = '';
        }

        $result = json_encode($data);
        return $result;
    }

    public function getsubcat($id = null) {
        $this->Category->recursive = 0;
        $this->loadModel('Category');
        $options = array('conditions' => array('Category.parent_id' => $id, 'Category.active' => 1), 'order' => array('Category.name' => 'asc'));
        $categories = $this->Category->find('all', $options);
        return $categories;
    }

    // http://errandchampion.com/users/appReview/page:1?userID=28
    public function appReview() {
        $this->autoRender = false;
        $this->loadModel('Rating');

        $data = array();
        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : '';
        $params_named = $this->params['named'];
        if (count($params_named) > 0) {
            $page = isset($params_named['page']) ? $params_named['page'] : '0';
        } else {
            $page = 0;
        }

        if ($type == 'C') {
            $TaskFStatus = '1';
        } else {
            $TaskFStatus = '0';
        }

        $TodayDate = date('Y-m-d');
        if (isset($_REQUEST['search']) && $_REQUEST['search'] == 'review_search') {
            //$TaskStatus='';

            $Keywords = isset($_REQUEST['Keywords']) ? $_REQUEST['Keywords'] : '';
            $EndDate = isset($_REQUEST['EndDate']) ? $_REQUEST['EndDate'] : '';

            $QueryStr = "(RUser.id=Rating.task_by)";
            if ($Keywords != '') {
                $QueryStr.=" AND ((RUser.first_name LIKE '%" . $Keywords . "%') OR (RUser.last_name LIKE '%" . $Keywords . "%'))";
            }

            if ($EndDate != '') {
                $QueryStr.=" AND (Rating.date_time LIKE '%" . $EndDate . "%')";
            }

            $RatingOptions = array(
                'joins' => array(
                    array(
                        'table' => 'users',
                        'alias' => 'RUser',
                        'type' => 'inner',
                        'foreignKey' => false,
                        'conditions' => array($QueryStr)
                    )
                ),
                'conditions' => array('Rating.user_id' => $userID),
                'order' => array('Rating.id DESC'),
                'limit' => 10
            );
        } else {
            $RatingOptions = array('conditions' => array('Rating.user_id' => $userID), 'order' => array('Rating.id Desc'), 'limit' => 10);
        }

        $RatingCnt = $this->Rating->find('count', $RatingOptions);



        if ($RatingCnt < 1) {
            $data['Ack'] = 0;
            $data['msg'] = 'No Review found';
            //}elseif($RatingCnt>=$page*10){
        } elseif ($RatingCnt >= $page * 10 || $RatingCnt > ($page - 1) * 10) {
            $this->Paginator->settings = $RatingOptions;
            $Reviews = $this->Paginator->paginate('Rating');
            foreach ($Reviews as $val) {
                $UserProfile_img = isset($val['TaskBy']['profile_img']) ? $val['TaskBy']['profile_img'] : '';
                $uploadImgPath = WWW_ROOT . 'user_images';
                if ($UserProfile_img != '' && file_exists($uploadImgPath . '/' . $UserProfile_img)) {
                    $UserProfile_imgLink = $this->webroot . 'user_images/' . $UserProfile_img;
                } else {
                    $UserProfile_imgLink = $this->webroot . 'user_images/default.png';
                }


                $review_detail['id'] = $val['Rating']['id'];
                $review_detail['Profile_img'] = $UserProfile_imgLink;
                $review_detail['user_name'] = $val['TaskBy']['first_name'];
                $review_detail['time'] = $val['Rating']['date_time'];
                $review_detail['total_rating'] = $val['Rating']['rating'];
                $review_detail['review'] = $val['Rating']['review'];
                $data['ReviewsList'][] = $review_detail;
            }
            $data['Ack'] = 1;
        } else {
            $data['Ack'] = 0;
            $data['msg'] = 'Error';
        }

        $result = json_encode($data);
        return $result;
    }

    // http://errandchampion.com/users/appNotifications/page:1?userID=28
    public function appNotifications() {
        $this->autoRender = false;
        $this->loadModel('Notification');
        $this->Notification->recursive = 0;
        $data = array();
        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';

        $params_named = $this->params['named'];
        if (count($params_named) > 0) {
            $page = isset($params_named['page']) ? $params_named['page'] : '0';
        } else {
            $page = 0;
        }
        $options = array('conditions' => array('Notification.for_user_id' => $userID), 'order' => array('Notification.id Desc'), 'limit' => 10);
        $NotificationCnt = $this->Notification->find('count', $options);

        if ($NotificationCnt < 1) {
            $data['Ack'] = 0;
            $data['msg'] = 'No Notification found';
            //}elseif($NotificationCnt>=$page*10){
        } elseif ($NotificationCnt >= $page * 10 || $NotificationCnt > ($page - 1) * 10) {
            $this->Paginator->settings = $options;
            $my_notifications = $this->Paginator->paginate('Notification');
            if (!empty($my_notifications)) {
                foreach ($my_notifications as $notification) {
                    $noti_data['Notification']['id'] = $notification['Notification']['id'];
                    $noti_data['Notification']['is_read'] = 1;
                    $this->Notification->save($noti_data);
                }
            }
            foreach ($my_notifications as $val) {
                $UserProfile_img = isset($val['ByUser']['profile_img']) ? $val['ByUser']['profile_img'] : '';
                $uploadImgPath = WWW_ROOT . 'user_images';
                if ($UserProfile_img != '' && file_exists($uploadImgPath . '/' . $UserProfile_img)) {
                    $UserProfile_imgLink = $this->webroot . 'user_images/' . $UserProfile_img;
                } else {
                    $UserProfile_imgLink = $this->webroot . 'user_images/default.png';
                }

                $noti['id'] = $val['Notification']['id'];
                $noti['Profile_img'] = $UserProfile_imgLink;
                $noti['user_id'] = $val['ByUser']['id'];
                $noti['user_name'] = $val['ByUser']['first_name'] . ' ' . $val['ByUser']['last_name'];
                $noti['type'] = $val['Notification']['type'];
                $noti['date'] = $val['Notification']['date'];
                $noti['post_title'] = $val['Task']['title'];
                $noti['post_id'] = $val['Task']['id'];
                $data['NotificationList'][] = $noti;
            }
            $data['Ack'] = 1;
        } else {
            $data['Ack'] = 0;
            $data['msg'] = 'Error';
        }

        $result = json_encode($data);
        return $result;
    }

    // http://errandchampion.com/users/appBillingAddress?userID=28&billId=2&address=GC-126&city=kolkata&state=WB&country=india&zipcode=700124
    public function appBillingAddress() {
        $this->autoRender = false;
        $this->loadModel('BillingAddress');
        $data = array();
        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $address = isset($_REQUEST['address']) ? $_REQUEST['address'] : '';
        $city = isset($_REQUEST['city']) ? $_REQUEST['city'] : '';
        $state = isset($_REQUEST['state']) ? $_REQUEST['state'] : '';
        $country = isset($_REQUEST['country']) ? $_REQUEST['country'] : '';
        $zipcode = isset($_REQUEST['zipcode']) ? $_REQUEST['zipcode'] : '';
        $billId = isset($_REQUEST['billId']) ? $_REQUEST['billId'] : '';


        if ($userID == '') {
            $data['Ack'] = 0;
            $data['msg'] = 'No Address found';
        } else {
            if ($billId != '') {
                $skill_data['BillingAddress']['id'] = $billId;
            }
            $skill_data['BillingAddress']['user_id'] = $userID;
            $skill_data['BillingAddress']['date'] = date('Y-m-d H:i:s');
            $skill_data['BillingAddress']['street_address'] = $address;
            $skill_data['BillingAddress']['city'] = $city;
            $skill_data['BillingAddress']['state'] = $state;
            $skill_data['BillingAddress']['country'] = $country;
            $skill_data['BillingAddress']['zip_code'] = $zipcode;
            $this->BillingAddress->save($skill_data);
            if ($billId != '') {
                $newBillId = $billId;
            } else {
                $newBillId = $this->BillingAddress->getLastInsertId();
                ;
            }
            $data['Ack'] = 1;
            $data['id'] = $newBillId;
        }

        $result = json_encode($data);
        return $result;
    }

    //http://errandchampion.com/users/appPaypalAddress?userID=28&email=nit.abhishekb@gmail.com
    public function appPaypalAddress() {
        $this->autoRender = false;
        $data = array();
        $userID = isset($_REQUEST['userID']) ? $_REQUEST['userID'] : '';
        $email = isset($_REQUEST['email']) ? $_REQUEST['email'] : '';

        if ($email == '') {
            $data['Ack'] = 0;
            $data['msg'] = 'No email found';
        } else {
            $skill_data['User']['id'] = $userID;
            $skill_data['User']['paypal_email'] = $email;
            $this->User->save($skill_data);
            $data['Ack'] = 1;
        }

        $result = json_encode($data);
        return $result;
    }

    /////////////////////////End App Function suman ///////////////////////////////////////

    public function edit_profile($id = null) {

        //echo "hello";exit;
        //echo $id;exit;

        $this->loadModel('Country');
        $this->loadModel('UserImage');

        if ($this->request->is('post')) {
            //echo $id;

            if (!empty($this->request->data['UserImage']['originalpath']['name'])) {
                $pathpart = pathinfo($this->request->data['UserImage']['originalpath']['name']);
                $ext = $pathpart['extension'];
                $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array(strtolower($ext), $extensionValid)) {
                    $uploadFolder = "user_images";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid() . '.' . $ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($this->request->data['UserImage']['originalpath']['tmp_name'], $full_flg_path);
                    $this->request->data['UserImage']['originalpath'] = $filename;
                } else {
                    $this->Session->setFlash(__('Invalid image type.'));
                }
            } else {
                $this->request->data['UserImage']['originalpath'] = $this->request->data['UserImage']['hid_img'];
            }


            $fname = $this->request->data['User']['first_name'];
            $lname = $this->request->data['User']['last_name'];
            $email = $this->request->data['User']['email_address'];
            $location = $this->request->data['User']['location'];
            $state = $this->request->data['User']['state'];
            $city = $this->request->data['User']['city'];
            $address = $this->request->data['User']['address'];
            $country = $this->request->data['User']['country'];
            $zip = $this->request->data['User']['zip_code'];
            $image = $this->request->data['UserImage']['originalpath'];
            if ($this->request->data['User']['user_pass'] != '') {
                $password = md5($this->request->data['User']['user_pass']);
            } else {
                $password = $this->request->data['User']['hid_pass'];
            }
            if ($this->request->data['User']['is_newsletter'] != '') {
                $newsletter = $this->request->data['User']['is_newsletter'];
            } else {
                $newsletter = 0;
            }

            $this->User->updateAll(array('User.first_name' => "'$fname'", 'User.last_name' => "'$lname'", 'User.email_address' => "'$email'", 'User.country' => "'$country'", 'User.state' => "'$state'", 'User.city' => "'$city'", 'User.zip_code' => "'$zip'", 'User.address' => "'$address'", 'User.location' => "'$location'", 'User.user_pass' => "'$password'", 'User.is_newsletter' => "'$newsletter'"), array('User.id' => $id));

            $options_image = array('conditions' => array('UserImage.user_id' => $id));
            $imagess = $this->UserImage->find('count', $options_image);
            if ($imagess > 0) {
                $this->UserImage->updateAll(array('UserImage.originalpath' => "'$image'", 'UserImage.resizepath' => "'$image'"), array('UserImage.user_id' => $id));
            } else {

                $img['UserImage']['originalpath'] = $this->request->data['UserImage']['originalpath'];
                $img['UserImage']['resizepath'] = $this->request->data['UserImage']['originalpath'];
                $img['UserImage']['user_id'] = $id;


                $this->UserImage->create();
                $this->UserImage->save($img);
            }

            $this->Session->setFlash(__('Your profile has been changed successfully.', 'default', array('class' => 'success')));

            //return $this->redirect(array('controller' => 'users','action' => 'edit_profile'));
            //return $this->redirect('edit_profile/'.$id);
        }
        $options_cont = array('conditions' => array('Country.id !=' => ''));
        $countries = $this->Country->find('all', $options_cont);

        $options_userpop = array('conditions' => array('User.id' => $id));
        $userpopdetails = $this->User->find('first', $options_userpop);
        $this->set(compact('countries', 'userpopdetails'));
    }

    public function post_listing($id = null) {

        $userid = $this->Session->read('user_id');

        if ($userid == '') {

            return $this->redirect(array('controller' => 'users', 'action' => 'index'));
        }


        $this->loadModel('Category');
        $this->loadModel('Post');
        $this->loadModel('Country');

        if ($id == '') {

            $options_post = array('conditions' => array('Post.id !=' => '', 'Post.is_approve' => 1, 'Post.user_id' => $userid));
            $posts = $this->Post->find('all', $options_post);

            $options_cont = array('conditions' => array('Country.id' => $posts[0]['Category']['country_id']));
            $countries = $this->Country->find('all', $options_cont);
        } else {

            $options_post = array('conditions' => array('Post.category_id' => $id, 'Post.is_approve' => 1, 'Post.user_id' => $userid));
            $posts = $this->Post->find('all', $options_post);

            $options_cont = array('conditions' => array('Country.id' => $posts[0]['Category']['country_id']));
            $countries = $this->Country->find('all', $options_cont);
        }

        $options = array('conditions' => array('Category.id !=' => '', 'Category.status' => 1));
        $categories = $this->Category->find('all', $options);




        $this->set(compact('categories', 'posts', 'countries'));
    }

    public function search_index() {

        $this->loadModel('Post');
    }

    public function message_chat() {

        //$this->loadModel('Post');
    }

    public function postfav_index($postid = null) {
        $userid = $this->Session->read('user_id');
        $post_id = base64_decode($postid);
        $this->loadModel('PostFavorite');
        $options_favuser = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.post_id' => $post_id, 'PostFavorite.type' => 'post'));
        $postfavuser_count = $this->PostFavorite->find('count', $options_favuser);
        return $postfavuser_count;
    }

    public function post_fav() {
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

        $options_fav = array('conditions' => array('PostFavorite.user_id' => $userid, 'PostFavorite.post_id' => $post_id, 'PostFavorite.type' => 'post'));
        echo $postfav_count = $this->PostFavorite->find('count', $options_fav);

        exit;
    }

    public function home() {
        ini_set('memory_limit', '256M');
        if ($this->Cookie->read('landing') == '' || $this->Cookie->read('landing') == '0') {
            $this->redirect(array('action' => 'landing'));
        }
        $useremail = $this->Session->read('email');
        if (isset($useremail)) {
            if ($this->Session->read('email') == '') {
                $this->redirect(array('action' => 'editprofile'));
            }
        }

//        $acc_activated = $this->Session->read('activated');
//        if ($acc_activated == 0) {
//            $this->Session->setFlash('Your account is not activated. Go to your mail and activate your account.', 'default', array('class' => 'success'));
//        }

        $home_option = array('conditions' => array('status' => 1), 'order' => array('Homeslider.order' => 'ASC'));
        $homesliders = $this->Homeslider->find('all', $home_option);



        $courses = $this->Post->find('all');
        $courses_count = count($courses);



        $provider_option = array('conditions' => array('User.admin_type' => 1));
        $providers = $this->User->find('all', $provider_option);
        $count_providers = count($providers);

//        pr($providers);
//        exit();

        $courses_booked_option = array('conditions' => array('Post.featured' => 1), 'group' => array('Post.id'));
        $courses_booked_count = count($this->Post->find('all', $courses_booked_option));
        $this->loadModel('CmsPage');
        $how_it_works_option = array('conditions' => array('CmsPage.slug' => 'how-it-works'));
        $how_it_works = $this->CmsPage->find('first', $how_it_works_option);

        $featured_course_option = array('conditions' => array('Post.featured' => 1), 'group' => array('Post.id'));
        $featured_courses = $this->Post->find('all', $featured_course_option);

        $categories = $this->Category->find('all', array(
            'conditions' => array(
                'status' => 1
            ),
            'order' => array('Category.click_count' => 'DESC'),
            'limit' => '8'
            ));

        $user_provider = $this->User->find('all', array('conditions' => array('User.admin_type' => '1','User.admin_type' => '2','User.featured' => '1'),'group' => array('User.id')));

        $why_ladder_option = array('conditions' => array('CmsPage.slug' => 'why-ladder.ng'));
        $why_ladder = $this->CmsPage->find('first', $why_ladder_option);

        $latest_courses_option = array('order' => array('Post.id' => 'DESC'));
        $latest_courses = $this->Post->find('all', $latest_courses_option);

        $this->loadModel('Venue');
        $featuredVenuesOption = array('order' => array('Venue.id' => 'DESC'),'conditions' => array('User.featured' => '1'));
        $featuredVenues = $this->Venue->find('all', $featuredVenuesOption);

        $skills = $this->Skill->find('all');

        $this->Comment->recursive = 2;
        $comments = $this->Comment->find('all');
        $partners = $this->Partner->find('all');
        $time_zone = $this->Session->read('time_zone');
        $this->set(compact('homesliders', 'courses_count', 'count_providers', 'courses_booked_count', 'how_it_works', 'featured_courses', 'categories', 'why_ladder', 'latest_courses', 'featuredVenues', 'skills', 'comments', 'partners','user_provider','time_zone'));
    }

    public function newsletterAjax() {
        $this->layout = false;
        $data = array();
        $email = $_POST['email'];
        $conditions = array('Newsletter.email' => $email);
        $data = $this->Newsletter->find('all', array('conditions' => $conditions));

        if (isset($data) && !empty($data)) {
            $data['ack'] = 1;
            $data['msg'] = 'You are already subscribed.';
        } else {
            $this->request->data['Newsletter']['email'] = $email;
            $this->Newsletter->create();
            if ($this->Newsletter->save($this->request->data)) {

                $subject = "Ladder subscription";
                $body = "Thank you for subscribing to Ladder.NG newsletter.";
                $this->send_mail('ladder@ladder.com', $email, $subject, $body);

                $admin_settings = $this->Setting->find('first', array(
                    'conditions' => array(
                        'Setting.id' => 1
                    )
                ));
                $admin_email = $admin_settings['Setting']['site_email'];

                $subject1 = "Ladder subscription";
                $body1 = "A new email subscribr to Ladder.ng.";
                $this->send_mail('ladder@ladder.com', $admin_email, $subject1, $body1);



                $data['ack'] = 1;
                $data['msg'] = 'Thank you for subscribe.';
            } else {
                $data['ack'] = 0;
                $data['msg'] = 'Insert error.';
            }
        }
        echo json_encode($data);
        die();
    }

    public function contact_us() {
        $settings = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1)));

        if ($this->request->is('post')) {
            $this->Contact->create();
            $this->request->data['Contact']['post_date'] = date('Y-m-d h:m:i');
            if ($this->Contact->save($this->request->data)) {

                $body = "<h2>" . $this->request->data['Contact']['name'] . " Contacted Ladder</h2>";
                $body .= '<p>Name: ' . $this->request->data['Contact']['name'] . '</p>';
                $body .= '<p>Subject: ' . $this->request->data['Contact']['subject'] . '</p>';
                $body .= '<p>Message:</p>';
                $body .= '<p>' . $this->request->data['Contact']['message'] . '</p>';
                $body .= '<p>Thanks, Team Ladder.ng</p>';

                if ($this->send_mail($this->request->data['Contact']['email_address'], $settings['Setting']['site_email'], $this->request->data['Contact']['subject'], $body)) {
                    $this->Session->write('Contact.ack', '1');
                    $this->Session->write('Contact.msg', 'Message sent.');
                }

                return $this->redirect(array('action' => 'contact_us'));
            } else {
                $this->Session->write('Contact.ack', '0');
                $this->Session->write('Contact.msg', 'Message send failed.');
            }
        }

        $this->set(compact('settings'));
    }

    public function landing() {
        if ($this->Cookie->read('landing') == '1') {
            $this->redirect(array('action' => 'home'));
        } else {
            $this->Cookie->write('landing', '1', $encrypt = false, $expires = null);
        }

        $this->layout = false;
        $this->loadModel('CmsPage');
        $landing_aboutus_option = array('conditions' => array('CmsPage.slug' => 'landing-about-us'));
        $landing_aboutus = $this->CmsPage->find('first', $landing_aboutus_option);
        $landing_hiw_option = array('conditions' => array('CmsPage.slug' => 'landing-how-it-works'));
        $landing_hiw = $this->CmsPage->find('first', $landing_hiw_option);
        $this->set(compact('landing_aboutus', 'landing_hiw'));
    }

    public function setsocialemail() {
        $data = $arr = array();
        $arr['User']['id'] = $this->request->data['userid'];
        $arr['User']['email_address'] = $this->request->data['useremail'];
        $arr['User']['user_pass'] = md5($this->request->data['userpass']);

        $emailExistsOption = array('conditions' => array('User.email_address' => $this->request->data['useremail']));
        $emailExists = $this->User->find('first', $emailExistsOption);

        if (!empty($emailExists)) {
            $data['ack'] = 0;
            $data['msg'] = 'Email already exists';
        } else {
            if ($this->User->save($arr)) {
                $userDetails = $this->User->find('first', array('conditions' => array('User.id' => $arr['User']['id'])));
                //$this->Session->write('userid', $userDetails['User']['id']);
                //$this->Session->write('username', $userDetails['User']['first_name']);

                $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
                if ($contact_email) {
                    $adminEmail = $contact_email['Setting']['site_email'];
                } else {
                    $adminEmail = 'superadmin@abc.com';
                }
                $this->loadModel('EmailTemplate');
                $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 5)));
                $siteurl = Configure::read('SITE_URL');
                $LOGINLINK = $siteurl . 'users/login';
                $ACTIVATELINK = $siteurl . 'users/activate_account/' . base64_encode($userDetails['User']['id']);
                $msg_body = str_replace(array('[USER]', '[LOGINLINK]', '[ACTIVATELINK]'), array($userDetails['User']['first_name'], $LOGINLINK, $ACTIVATELINK), $EmailTemplate['EmailTemplate']['content']);



                $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                $this->php_mail($userDetails['User']['email_address'], $from, $Subject_mail, $msg_body);

                $data['ack'] = 1;
                $data['msg'] = 'Registration success. Activate your account from your mail.';
            } else {
                $data['ack'] = 0;
                $data['msg'] = 'DB error.';
            }
        }
        echo json_encode($data);
        die();
    }

    public function activate_account($userid) {
        $id = base64_decode($userid);
        $userDetails = $this->User->find('first', array('conditions' => array('User.id' => $id)));

        if (empty($userDetails)) {
            $msg = 'Invalid account.';
        } else {
            $data['User']['id'] = $id;
            $data['User']['activated'] = 1;
            if ($this->User->save($data)) {
                $msg = 'Account activated.';
                $this->Session->write('userid', $id);
                return $this->redirect(array('action' => 'home'));
            }
        }
        $this->set('msg', $msg);
    }

    public function ajaxlang() {
        $lang = $this->request->data['language'];
        //$this->Cookie->write('lang', $lang);
        //$this->Cookie->read('lang');
        //$this->Session->write('lang', $lang);
        setcookie('lang', $lang, time() + 60 * 60 * 24 * 30, "/");
        die();
    }

    public function sociallogin() {
        $data = array();
        $userid = $this->Session->read('userid');
        $username = $this->Session->read('username');
        $title_for_layout = 'Sign In';
        $RefferLink = $this->Session->read('is_signup');

        $this->set(compact('title_for_layout', 'RefferLink'));
        if (isset($userid) && $userid != '') {
            return $this->redirect(array('action' => 'home'));
        }

        if ($this->request->is('post')) {
            $options = array('conditions' => array('User.facebook_id' => $this->request->data['fbId']));
            $loginuser = $this->User->find('first', $options);

            if (!$loginuser) {
                $data['ack'] = 0;
                $data['msg'] = 'Invalid username or password or inactive account.';
            } else {
                if ($loginuser['User']['activated'] == '0') {
                    $data['ack'] = 0;
                    $data['msg'] = 'Your account is not activated. Go to your mail and activate your account.';
                } else {
                    if (isset($this->request->data['User']['rembme']) && $this->request->data['User']['rembme'] != '') {
                        $cookie = $this->request->data['User']['rembme'];
                    } else {
                        $cookie = '';
                    }

                    $this->Session->write('userid', $loginuser['User']['id']);
                    $this->Session->write('username', $loginuser['User']['first_name']);
                    $this->Session->write('email', $loginuser['User']['email_address']);


                    if ($cookie == '1') {
                        $this->Cookie->write('email', $this->request->data['User']['email'], $encrypt = false, $expires = null);
                        $this->Cookie->write('password', $this->request->data['User']['password'], $encrypt = false, $expires = null);
                        $this->Cookie->write('remember_me', $cookie, $encrypt = false, $expires = null);
                    } else {
                        $this->Cookie->delete('email');
                        $this->Cookie->delete('password');
                        $this->Cookie->delete('remember_me');
                    }
                    $this->set('cookieHelper', $this->Cookie);

                    $user_data_auth['User']['id'] = $loginuser['User']['id'];
                    // $user_data_auth['User']['txt_password'] = $this->request->data['User']['password'];
                    $user_data_auth['User']['is_login'] = 1;
                    $this->User->save($user_data_auth);

                    $post_errand = $this->Session->read('post_errand');
                    if (!empty($post_errand) && count($post_errand) > 0) {
                        $this->without_login_save_post($post_errand);
                        $this->Session->delete('post_errand');
                    }
                    $data['ack'] = 1;
                    $data['msg'] = 'Login Successful.';
                    $this->Session->setFlash('Login Successful.', 'default', array('class' => 'success'));
                }
            }
        }
        echo json_encode($data);
        die();
    }

    public function search() {
        $conditions = array();

        $cat = $this->request->query['cat'];
        $keyword = $this->request->query['keyword'];

        if (isset($cat) && $cat != '') {
            $conditions['Post.category_id'] = $cat;
        }

        if (isset($keyword) && $keyword != '') {
            $conditions['Post.post_title LIKE'] = '%' . $keyword . '%';
        }

        $maxMin = $this->Post->find('first', array('fields' => array('MAX(Post.price) as max', 'MIN(Post.price) as min',)));

        $categories = $this->Category->find('all', array('fields' => array('id', 'category_name')));

        $skills = $this->Skill->find('all', array('fields' => array("id","skill_name"),'recursive'=>2));

        $courses_option = array('conditions' => $conditions, 'group'=>array('Post.id'));
        $courses = $this->Post->find('all', $courses_option);

        $this->set(compact('cat', 'keyword', 'maxMin', 'categories', 'skills', 'courses'));
    }

    public function ajaxsearch() {
        //$this->layout = false;
        $data = $options = $joins = array();
        $html = '';

        if ($this->request->is('ajax')) {

            $startPrice = $this->request->data['startPrice'];
            $endPrice = $this->request->data['endPrice'];

            $startDate = $this->request->data['startDate'];
            $endDate = $this->request->data['endDate'];

            $location = $this->request->data['location'];

            if (!empty($this->request->data['skills'])) {
                $skills = $this->request->data['skills'];
                $this->loadModel('PostSkill');
                $this->loadModel('PostImage');

                $cntSkills = count($skills);
                $this->Post->recursive = 2;

                $db = $this->Post->getDataSource();
                $subQuery = $db->buildStatement(
                    array(
                        'fields'     => array('PS.post_id'),
                        'table'      => 'post_skills',
                        'alias'      => 'PS',
                        'joins'      => array(
                            array(
                                'table' => 'posts',
                                'alias' => 'P',
                                'type' => 'inner',
                                'conditions' => array(
                                    'P.id = PS.post_id'
                                )
                            ),
                            array(
                                'table' => 'skills',
                                'alias' => 'S',
                                'type' => 'inner',
                                'conditions' => array(
                                    'S.id = PS.skill_id'
                                )
                            )
                        ),
                        'conditions' => array(
                            'S.id' => $skills
                        ),
                        'group'      => array("PS.post_id HAVING Count(PS.post_id) = $cntSkills")
                    ),
                    $this->Post
                );
                $subQueryExpression = $db->expression($subQuery);


                $sql = "Select Post.*  FROM  `posts` as Post INNER JOIN ( ".$subQueryExpression->value." ) AA on Post.id = AA.post_id WHERE 1=1 ";

                if (isset($this->request->data['cat'])) {
                    $sql .= 'AND Post.category_id = ' . $this->request->data['cat'] . ' ';
                }

                if (isset($this->request->data['keyword']) && $this->request->data['keyword'] != '') {
                    $sql .= 'AND Post.post_title LIKE %'. $this->request->data['keyword'] .'% ';
                }


                if (isset($startPrice) && $startPrice != '') {
                    $sql .= 'AND Post.price BETWEEN ' . $startPrice . ' AND ' . $endPrice . ' ';
                }

                if ($startDate != '' || $endDate != '') {
                    $sql .= 'AND date(`Post`.`post_date`) BETWEEN "'. $startDate. '" AND "'. $endDate .'" ';
                }

                if (isset($location) && $location != '') {
                    $sql .= 'AND (Post.country = (SELECT id FROM countries WHERE name LIKE "%'.$location.'%") OR Post.state = (SELECT id FROM states WHERE name LIKE "%'.$location.'%"))';
                }

                $sql .= ' GROUP BY `Post`.`id`';

                $courses = $this->Post->query($sql);

                $courses = array_map(function($t){
                    $t['PostImage'] = $this->PostImage->find('all',array('conditions' => array('PostImage.post_id' => $t['Post']['id'])));
                    $t['PostImage'][0]['originalpath'] = $t['PostImage'][0]['PostImage']['originalpath'];
                    return $t;
                },$courses);

            } else {

                if (isset($this->request->data['cat'])) {
                    $options['conditions']['Post.category_id'] = $this->request->data['cat'];
                }

                if (isset($this->request->data['keyword'])) {
                    $options['conditions']['Post.post_title LIKE'] = '%' . $this->request->data['keyword'] . '%';
                }


                if (isset($startPrice) && $startPrice != '') {
                    $options['conditions']['Post.price BETWEEN ? AND ?'] = array($startPrice, $endPrice);
                }

                if ($startDate != '' || $endDate != '') {
                    $options['conditions']['date(Post.post_date) BETWEEN ? AND ?'] = array($startDate, $endDate);
                }

                if (isset($location) && $location != '') {
                    $options['conditions'][] = '(Post.country = (SELECT id FROM countries WHERE name LIKE "%'.$location.'%") OR Post.state = (SELECT id FROM states WHERE name LIKE "%'.$location.'%"))';
                }

                $options['group'] = array('Post.id');
                $this->Post->recursive = 1;
                $courses = $this->Post->find('all', $options);

            }


            if (!empty($courses)) {
                foreach ($courses as $course) {
                    /*$html .= '<div class="media listing-area">' .
                            '<div class="media-left">' .
                            '<img src="' . $this->webroot . 'img/post_img/' . $course['PostImage'][0]['originalpath'] . '" width="80" height="80"  alt=""/>' .
                            '</div>' .
                            '<div class="media-body listing-mid-area">' .
                            '<h4 class="media-heading">' . $course['Post']['post_title'] . '</h4>' .
                            '<p>' . substr(strip_tags($course['Post']['post_description']), 0, 100) . '</p>' .
                            '<div class="star">' .
                            '<i class="fa fa-star" aria-hidden="true"></i>' .
                            '<i class="fa fa-star" aria-hidden="true"></i>' .
                            '<i class="fa fa-star" aria-hidden="true"></i>' .
                            '<i class="fa fa-star" aria-hidden="true"></i>' .
                            '<i class="fa fa-star" aria-hidden="true"></i>' .
                            '</div>' .
                            '<a class="btn btn-default pull-left" href="'.$this->webroot . 'users/coursedetail/' . base64_encode($course['Post']['id']) .'">View Details</a>' .
                            '</div>' .
                            '<div class="media-right">' .
                            '<div class="listing-rt-area">' .
                            '<img src="' . $this->webroot . 'images/skin-health.jpg" width="60" height="60"  alt=""/>' .
                            '<p>$' . $course['Post']['price'] . '</p>' .
                            '</div>' .
                            '</div>' .
                            '</div>';*/
                    $html .= '<div class="media">';

                if ($course['Post']['featured'] == 1) {
                    $html .= '<span class="boxRibbon">FEATURED</span>';
                }

                if (isset($course['PostImage'][0]['originalpath'])) {
                    $img = $this->webroot . 'img/post_img/' . $course['PostImage'][0]['originalpath'];
                } else {
                    $img = $this->webroot . 'images/skin-health.jpg';
                }

                $html .= '<div class="media-left media-middle">'.
                            '<div class="img_hold">'.
                                '<img class="media-object" src="'.$img.'" alt="...">'.
                            '</div>'.
                        '</div>'.
                        '<div class="media-body">'.
                            '<b>'.$course['Post']['post_title'].'</b>'.
                            '<span>The Institute of Chartered Accountants in England and Wales</span>'.
                            '<p>'.substr(strip_tags($course['Post']['post_description']), 0, 100).'</p>'.
                            '<ul>'.
                                '<li><i class="fa fa-user"></i> <p> 1 Course available</p></li>'.
                                '<li>'.
                                    '<p>Share:</p> <a href="" class="fa fa-linkedin"></a> <a href="" class="fa fa-facebook"></a> <a href="" class="fa fa-twitter"></a>'.
                                '</li>'.
                            '</ul>'.
                        '</div>'.
                        '<div class="media-right media-middle">'.
                            '<button class="normal"><i class="fa fa-graduation-cap"></i> Classroom</button>'.
                            '<button class="more_info" onclick="location.href=\''. $this->webroot . 'users/coursedetail/'.base64_encode($course['Post']['id']).'\'">More Info</button>'.
                        '</div>'.
                    '</div>';
                }

                $data['ack'] = 1;
                $data['html'] = $html;
            } else {
                $html = '<div class="media"><div class="media-body"><b>Sorry, nothing matched your search criteria.</b></div></div>';
                $data['ack'] = 0;
                $data['html'] = $html;
            }
        }

        echo json_encode($data);
        die();
    }

    public function courselisting() {
        $countcat = count($this->Category->find('all'));
        $limit = 4;
        $this->Category->recursive = 2;
        $this->Paginator->settings = array(
            'limit' => $limit,
            'order' => array(
                'Category.category_name' => 'asc'
            )
        );


        $this->set('courses', $this->Paginator->paginate('Category'));
        $this->set(compact('limit', 'countcat'));
    }

    public function coursefilter($slug = NULL) {
        $category_dtls=$this->Category->find('first',array('conditions'=>array('Category.slug'=>$slug),'fields'=>array('Category.id','Category.category_name')));
        $id=$category_dtls['Category']['id'];

        $countcat = count($this->Post->find('all', array('conditions' => array('Post.category_id' => $id))));
        $limit = 2;
        $this->Category->recursive = 2;
        $this->Paginator->settings = array(
            'limit' => $limit,
            'order' => array('Post.id' => 'desc'),
            'conditions' => array('Post.category_id' => $id),
            'group' => array('Post.id')
        );

        $coursecount=$this->Category->find('first', array('conditions' => array('Category.id' => $id)));
        $coursecount['Category']['click_count']=$coursecount['Category']['click_count']+1;
        $count_update['Category']['click_count'] = $coursecount['Category']['click_count'];
        $count_update['Category']['id'] = $id;
        $this->Category->save($count_update);

        $cat_name = $category_dtls['Category']['category_name'];

        $this->set('posts', $this->Paginator->paginate('Post'));
        $this->set(compact('limit', 'countcat','cat_name'));


    }

    public function coursedetail($slug = NULL) {

        $post_dtls=$this->Post->find('first',array('conditions'=>array('Post.slug'=>$slug),'fields'=>array('id')));
        $id=$post_dtls['Post']['id'];
        $this->set('userid',$this->Session->read('userid'));
        $this->set('coursedetail', $this->Post->find('all', array('conditions' => array('Post.id' => $id))));
        $this->set('all_reviews', $this->Rating->find('all',array('conditions' => array('Rating.post_id' => $id)))) ;

        $coursecount=$this->Post->find('first', array('conditions' => array('Post.id' => $id)));
        $coursecount['Post']['click_count']=$coursecount['Post']['click_count']+1;
        $count_update['Post']['click_count'] = $coursecount['Post']['click_count'];
        $count_update['Post']['id'] = $id;
        $this->Post->save($count_update);

        $whishlistexist=$this->Wishlist->find('first',array('conditions'=>array('Wishlist.post_id'=>$id,'Wishlist.user_id'=>$this->Session->read('userid'))));
        if(!empty($whishlistexist))
        {

            $whishlistexist=1;
        }
        else
        {
            $whishlistexist=0;
        }

        $this->set('whishlistexist',$whishlistexist);


    }

    public function ajaxaddWishlist(){
            $user_id = $this->request->data['user_id'];
            $course_id = $this->request->data['post_id'];

            if($this->Wishlist->save($this->request->data))
                {
                    echo '1';
                }
                else
                {
                    echo '0';
                }
        exit;
    }

  public function ajaxremoveWishlist(){
            $user_id = $this->request->data['user_id'];
            $course_id = $this->request->data['post_id'];
          $whishlistexist=$this->Wishlist->find('first',array('conditions'=>array('Wishlist.post_id'=> $course_id,'Wishlist.user_id'=>$user_id)));
    if(!empty($whishlistexist)){

              $this->Wishlist->id =$whishlistexist['Wishlist']['id'];
        if (!$this->Wishlist->exists()) {
            throw new NotFoundException(__('Invalid contact'));
        }

            $this->request->onlyAllow('post', 'delete');
                if ($this->Wishlist->delete()) {
                    echo 1;
                }
                else {
                    echo 0;
                }
    }
        else
        {
            echo 0;
        }
        exit;
}


    public function update_profile() {
        $title_for_layout = 'Edit Profile';
        $countryname = '';
        $this->Session->delete('profile_setting_change');
        $username = $this->Session->read('username');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/');
        }
        if (!$this->User->exists($userid)) {
            throw new NotFoundException(__('Invalid user'));
        }

        $option = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
        $userDetails = $this->User->find('first', $option);

        $this->set(compact('userDetails'));
    }

    public function upload_image() {
        if (isset($_FILES['file']['name']) && $_FILES['file']['name'] != '') {
            if (!empty($_FILES['file']['name'])) {
                $pathpart = pathinfo($_FILES['file']['name']);
                $ext = $pathpart['extension'];
                $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array(strtolower($ext), $extensionValid)) {
                    $uploadFolder = "user_images";
                    $uploadPath = WWW_ROOT . $uploadFolder;
                    $filename = uniqid() . '.' . $ext;
                    $full_flg_path = $uploadPath . '/' . $filename;
                    move_uploaded_file($_FILES['file']['tmp_name'], $full_flg_path);
                    $this->request->data['User']['user_image'] = $filename;
                } else {
                    $this->Session->setFlash(__('Invalid image type.'));
                }
            }
        }
        $userid = $this->Session->read('userid');
        $this->request->data['User']['id'] = $userid;
      $this->User->updateAll(array('User.user_image' => "'$filename'"), array('User.id' => $userid));
        echo $filename;
        exit();
    }

    public function user_provider_listing(){
        $countcat = count($this->User->find('all',array('conditions' => array('User.admin_type' => '1'))));
        $limit = 4;
        $this->User->recursive = 2;
        $this->Paginator->settings = array(
            'limit' => $limit,
            'order' => array(
            'User.fiest_name' => 'DESC'
            ),
            'conditions' => array('User.admin_type' => '1','User.featured' => '1')
        );

        $this->set('provider',$this->Paginator->paginate('User'));
        $this->set(compact('limit', 'countcat'));
    }

    public function cms_page($title = NULL)
    {
        $this->loadModel('CmsPage');
        $content = $this->CmsPage->find('first',array('conditions'=>array('CmsPage.page_title' => $title)));
        $this->set(compact('content'));
    }

    public function setTimezone(){

        Configure::write('Config.timezone',$this->request->data['tz']);
        $this->Session->write('time_zone',$this->request->data['tz']);
        exit;
    }

    public function membership()
    {

        $userid=$this->Session->read('userid');
        if (isset($userid)) {
            $this->loadModel('MembershipPlan');
            $this->loadModel('MembershipOrder');
            $plans=$this->MembershipPlan->find('all');
            $this->MembershipOrder->recursive=2;
            $order=$this->MembershipOrder->find('first',array('conditions'=>array('User.id'=>$userid)));
            $this->User->recursive=2;
            $user=$this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
            $this->set('plans',$plans);
            $this->set('order',$order);
            $this->set('user',$user);
        }
        else{
            return $this->redirect(array('action' => 'login'));
        }


    }

    public function membership_checkout($id = NULL){

        $id = base64_decode($id);
        $userid=$this->Session->read('userid');
        if(isset($userid)){
            $this->loadModel('MembershipPlan');
            $plan = $this->MembershipPlan->find('first',array('conditions'=>array('MembershipPlan.id'=>$id)));
            $user = $this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
            $this->set(compact('plan','user'));
        }
        else{
            return $this->redirect(array('action' => 'login'));
        }

    }

    public function membership_payment(){
        $plan_id          = $this->request->query['plan_id'];
        $billing_address  = $this->request->query['billing_add1'].', '.$this->request->query['billing_add2'].', '.$this->request->query['billing_city'].', '.$this->request->query['billing_city'].', '.$this->request->query['billing_zip'];
        $shipping_address = $this->request->query['shipping_add1'].', '.$this->request->query['shipping_add2'].', '.$this->request->query['shipping_city'].', '.$this->request->query['shipping_city'].', '.$this->request->query['shipping_zip'];
        $mertid           = $this->request->query['meritid'];
        $transref         = $this->request->query['transref'];
        $type='json';
        $sign='';
        $request = 'mertid='.$mertid.'&transref='.$transref.'&respformat='.$type.'&signature='.$sign; //initialize the request variables
        $url = 'https://www.cashenvoy.com/sandbox/?cmd=requery'; //this is the url of the gateway's test api
        //$url = 'https://www.cashenvoy.com/webservice/?cmd=requery'; //this is the url of the gateway's live api
        $ch = curl_init(); //initialize curl handle
        curl_setopt($ch, CURLOPT_URL, $url); //set the url
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); //return as a variable
        curl_setopt($ch, CURLOPT_POST, 1); //set POST method
        curl_setopt($ch, CURLOPT_POSTFIELDS, $request); //set the POST variables
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $response = curl_exec($ch); // grab URL and pass it to the browser. Run the whole process and return the response
        curl_close($ch); //close the curl handle
        $response;

        $data = json_decode($response);

         foreach ($data as $subdata) { @$cnt++; }
        if($cnt==3){
           $returned_transref = $data->  {'TransactionId'}   ;
           $returned_status   = $data->{'TransactionStatus'} ;
           $returned_amount   = $data->{'TransactionAmount'} ;

            if($returned_status=='C00'){

                     $this->request->data['user_id']            = $this->Session->read('userid');;
                     $this->request->data['membership_plan_id'] = $plan_id;
                     $this->request->data['transaction_id']     = $returned_transref;
                     $this->request->data['amount']             = $returned_amount;
                     $this->request->data['billing_address']    = $billing_address;
                     $this->request->data['shipping_address']   = $shipping_address;
                     $this->loadModel('MembershipOrder');
                     $this->loadModel('MembershipPlan');
                     $tid=$this->MembershipOrder->find('all',array('conditions'=>array('MembershipOrder.transaction_id'=>$returned_transref),'fields'=>array('MembershipOrder.transaction_id')));
                     $data=$this->MembershipPlan->find('first',array('coditions'=>array('MembershipPlan.id'=>$plan_id)));

                     if(empty($tid)){

                          $this->User->id = $this->request->data['user_id'];
                          $this->User->saveField('membership_plan_id',$plan_id);
                          $this->MembershipOrder->save($this->request->data);
                          $status='Order of membership is placed successfully';
                          echo $status; exit;

                     }else{
                        $status='transection ID is already exist';
                        echo $status; exit;
                     }

            }
            else{
                $status = 'Transection Failed'.$returned_status;
                echo $status; exit;
            }

        }
        else {
          $status = $data->{'TransactionStatus'};
          echo $status; exit;
        }


    }

    public function provider_dashboard($id = NULL){

        $id = base64_decode($id);
        $userid=$this->Session->read('userid');
        if(isset($userid)){
            $this->loadModel('Order');
            $this->Order->recursive = 2;
            $courses = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$id)));
            $venues = $this->Venue->find('all',array('conditions'=>array('Venue.user_id'=>$id)));
            $course_orders = $this->Order->find('all',array('conditions'=>array('Post.user_id'=>$id)));
            $click_count = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$id),'fields' => array('sum(Post.click_count)   AS click_count')));
            $top_courses = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$id),'order'=>array('Post.click_count DESC'),'limit'=>5));
            $total_no_of_course = count($courses);
            $total_no_of_venue = count($venues);
            $total_course_order = count($course_orders);
            $total_course_view = $click_count['0']['0']['click_count'];
            $this->loadModel('Order');
            $this->Rating->recursive = 2;
            $ratings = $this->Rating->find('all',array('conditions'=>array('Post.user_id'=>$id),'limit'=>5));
            // pr($ratings); exit;
             $this->set(compact('total_no_of_course','total_no_of_venue','total_course_order','total_course_view','top_courses','ratings'));
        }
        else{
            return $this->redirect(array('action' => 'login'));
        }

    }

    public function company_details(){

        $userid=$this->Session->read('userid');
        if(isset($userid)){
            $this->loadModel('CompanyDetail');
            $company_detail = $this->CompanyDetail->find('first',array('conditions'=>array('CompanyDetail.user_id'=>$userid)));
            //pr($company_detail); exit;
            $this->set(compact('company_detail'));
        }
        else{
            return $this->redirect(array('action' => 'login'));
        }

    }

    public function edit_company_details(){

        $this->loadModel('CompanyDetail');
        $userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect('/users/login');
        }
        else
        {
            if ($this->request->is(array('post', 'put'))) {

                //pr($this->request->data);

                if (isset($this->request->data['CompanyDetail']['logo']['name']) && $this->request->data['CompanyDetail']['logo']['name'] != '') {
                    $path = $this->request->data['CompanyDetail']['logo']['name'];
                    $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));
                    if ($ext) {
                        $uploadPath = Configure::read('UPLOAD_COMPANY_LOGO_PATH');
                        $extensionValid = array('jpg', 'jpeg', 'png', 'gif');
                        if (in_array($ext, $extensionValid)) {
                            $OldImg = $this->request->data['CompanyDetail']['image'];
                            $imageName = rand() . '_' . (strtolower(trim($this->request->data['CompanyDetail']['logo']['name'])));
                            $full_image_path = $uploadPath . '/' . $imageName;
                            move_uploaded_file($this->request->data['CompanyDetail']['logo']['tmp_name'], $full_image_path);
                            $this->request->data['CompanyDetail']['logo'] = $imageName;
                            if ($OldImg != '') {
                                unlink($uploadPath . '/' . $OldImg);
                            }
                        } else {
                            $this->Session->setFlash(__('Invalid Image Type.'));
                            return $this->redirect('/users/provider_dashboard/edit_company_details');
                        }
                    }
                } else {
                    unset($this->request->data['CompanyDetail']['logo']);
                }
                //pr($this->request->data); exit;
                if(!empty($this->request->data['CompanyDetail']['id'])){
                        if ($this->CompanyDetail->save($this->request->data)) {
                            $this->Session->setFlash(__('The Company Detail has been saved.'));
                            return $this->redirect('/users/provider_dashboard/<?php echo base64_encode($userid);?>');
                        } else {
                            $this->Session->setFlash(__('The Company Detail could not be saved. Please, try again.'));
                        }
                }
                else
                {
                    $this->CompanyDetail->create();
                        if ($this->CompanyDetail->save($this->request->data)) {
                            $this->Session->setFlash(__('The Company Detail has been saved.'));
                            return $this->redirect('/users/provider_dashboard/<?php echo base64_encode($userid);?>');
                        } else {
                            $this->Session->setFlash(__('The Company Detail could not be saved. Please, try again.'));
                        }
                }

            }
            else {
                $options = array('conditions' => array('CompanyDetail.user_id' => $userid));
                $this->request->data = $this->CompanyDetail->find('first', $options);
            }

        }

        $CompanyDetail = $this->CompanyDetail->find('first',array('conditions'=>array('CompanyDetail.user_id'=>$userid)));

        $countries = $this->CompanyDetail->Country->find('list');
        $lgas = $this->CompanyDetail->Lga->find('list');
        //$this->loadModel('Bank');
        //$banks_raw = $this->User->Bank->find('all',array('fields'=>array('Bank.id','Bank.bank_name')));



        $states = array();
        $cities = array();
        $lgas   = array();
        if(!empty($CompanyDetail)){
            $states = $this->CompanyDetail->State->find('list', array('fields' => array('State.id', 'State.name'), 'conditions' => array('State.country_id' => $CompanyDetail['CompanyDetail']['country'])));
            $cities = $this->CompanyDetail->City->find('list', array('fields' => array('City.id', 'City.name'), 'conditions' => array('City.state_id' => $CompanyDetail['CompanyDetail']['state'])));
        }
        // pr($states); exit;
        $this->set(compact('countries','states','cities','CompanyDetail','userid','lgas'));

    }

    public function Venue_page(){

    }

    public function linkedinLoginRegister() {
        $data = $arr = array();
        if($this->request->is('post')) {
            //pr($this->request->data);
            $ln_id = $this->request->data['ln_id'];
            $ln_email = $this->request->data['ln_email'];
            $ln_firstName = $this->request->data['ln_firstName'];
            $ln_lastName = $this->request->data['ln_lastName'];

            $linkedin_option = array(
                'conditions' => array(
                    'linkedin_id' => $ln_id
                )
            );
            $linkedin_check = $this->User->find('first', $linkedin_option);

            if (!empty($linkedin_check)) {
                if ($linkedin_check['User']['activated'] == 0) {
                    $this->Session->setFlash('Activate your account from your email!', 'default', array('class' => 'error'));
                    $data['ack'] = 0;

                } else {
                    $this->Session->write('is_signup', '1');
                    $this->Session->write('userid', $linkedin_check['User']['id']);
                    $this->Session->write('username', $linkedin_check['User']['first_name']);
                    $this->Session->write('activated', $linkedin_check['User']['activated']);
                    $this->Session->setFlash('Login Successful!', 'default', array('class' => 'success'));
                    $data['ack'] = 1;
                    $data['url'] = $this->webroot;
                }


            } else {
                $option = array(
                    'conditions' => array(
                        'email_address' => $ln_email
                    )
                );

                $check_email = $this->User->find('first', $option);

                if (empty($check_email)) {
                    $arr['User']['linkedin_id'] = $ln_id;
                    $arr['User']['first_name'] = $ln_firstName;
                    $arr['User']['last_name'] = $ln_lastName;
                    $arr['User']['email_address'] = $ln_email;
                    $arr['User']['member_since'] = date('Y-m-d');
                    $arr['User']['status'] = 1;
                    $arr['User']['is_sociallogin'] = 1;
                    $arr['User']['admin_type'] = 4;


                    $this->User->create();
                    if ($this->User->save($arr)) {
                        $id = $this->User->getLastInsertId();
                        $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
                        if ($contact_email) {
                            $adminEmail = $contact_email['Setting']['site_email'];
                        } else {
                            $adminEmail = 'superadmin@abc.com';
                        }
                        $options = array('conditions' => array('User.id' => $id));
                        $lastInsetred = $this->User->find('first', $options);

                        $this->loadModel('EmailTemplate');
                        $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 3)));
                        $siteurl = Configure::read('SITE_URL');
                        $LOGINLINK = $siteurl . 'users/login';
                        $msg_body = str_replace(array('[USER]', '[LOGINLINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK), $EmailTemplate['EmailTemplate']['content']);

                        $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                        $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                        $this->php_mail($lastInsetred['User']['email_address'], $from, $Subject_mail, $msg_body);


                        $EmailTemplate = $this->EmailTemplate->find('first', array('conditions' => array('EmailTemplate.id' => 5)));
                        $siteurl = Configure::read('SITE_URL');
                        $LOGINLINK = $siteurl . 'users/login';
                        $ACTIVATELINK = $siteurl . 'users/activate_account/' . base64_encode($id);
                        $msg_body = str_replace(array('[USER]', '[LOGINLINK]', '[ACTIVATELINK]'), array($lastInsetred['User']['first_name'], $LOGINLINK, $ACTIVATELINK), $EmailTemplate['EmailTemplate']['content']);

                        $from = $contact_email['Setting']['site_name'] . ' <' . $adminEmail . '>';
                        $Subject_mail = $EmailTemplate['EmailTemplate']['subject'];
                        $this->php_mail($lastInsetred['User']['email_address'], $from, $Subject_mail, $msg_body);

                        $this->Session->setFlash('You have successfully registered!', 'default', array('class' => 'success'));

//                        $this->Session->write('is_signup', '1');
//                        $this->Session->write('userid', $lastInsetred['User']['id']);
//                        $this->Session->write('username', $lastInsetred['User']['first_name']);
//                        $this->Session->write('activated', $lastInsetred['User']['activated']);

                        $data['ack'] = 1;
                    }
                } else {
                    $this->Session->setFlash('Email already exists!', 'default', array('class' => 'error'));
                    $data['ack'] = 0;
                }
            }

        }
        echo json_encode($data);
        die();
    }
}
