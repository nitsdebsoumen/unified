<?php

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    public $components = array('Session', 'Cookie');

    //public $helpers = array( 'CksourceHelper');

    public function beforeFilter() {
        $adminRoute = Configure::read('Routing.prefixes');
        #pr($adminRoute);
        if (isset($this->params['prefix']) && in_array($this->params['prefix'], $adminRoute)) {
            $this->layout = 'admin_default';
        } else {
            $this->layout = 'default';
        }
    }

    public function send_mail($from = null, $to = null, $subject = null, $body = null) {
        $Email = new CakeEmail();
        /* pass user input to function */
        $Email->emailFormat('both');
        $Email->from(array($from => 'Ladder'));
        $Email->to($to);
        //$Email->cc('nits.bikash@gmail.com');
        $Email->subject($subject);
        if ($Email->send($body)) {
            $Email->reset();
            return true;
        } else {
            $Email->reset();
            return false;
        }
    }

    public function php_mail($to, $from, $subject, $message) {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        //$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        //$headers .= 'To: '.$to_name.' <'.$to.'>' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n";
        mail($to, $subject, $message, $headers);
    }

    function create_slug($string, $ext = '') {
        $replace = '-';
        $string = strtolower($string);

        //replace / and . with white space
        $string = preg_replace("/[\/\.]/", " ", $string);
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);

        //remove multiple dashes or whitespaces
        $string = preg_replace("/[\s-]+/", " ", $string);

        //convert whitespaces and underscore to $replace
        $string = preg_replace("/[\s_]/", $replace, $string);

        //limit the slug size
        $string = substr($string, 0, 200);

        //slug is generated
        return ($ext) ? $string . $ext : $string;
    }

    public function beforeRender() {

        $this->set('cookieHelper', $this->Cookie);

        $this->loadModel('User');
        //$this->loadModel('Content');
        $this->loadModel('Setting');
        $this->loadModel('Category');
        $this->loadModel('OfferNotification');
        $this->loadModel('Chat');
        $this->loadModel('Post');
        $SITE_URL = Configure::read('SITE_URL');

        $userid = $this->Session->read('userid');
        $adminuserid = $this->Session->read('adminuserid');
        $is_superadmin = $this->Session->read('is_admin');
        $user_id = $this->Session->read('user_id');
        //$usertype = $this->Session->read('Auth.User.type');


        $comment_chats = array();
        $unread_comment = 0;

        if (!empty($user_id)) {
            $comment_chats = $this->Chat->Query("SELECT * FROM (SELECT DISTINCT * FROM chats where receiver_id = $user_id order by id DESC) as Chat group by Chat.offer_id");
            $comment_chats = array_map(function($c) {
                $c['sender'] = $this->User->find('first', array('conditions' => array('User.id' => $c['Chat']['sender_id'])));
                $c['post'] = $this->Post->find('first', array('conditions' => array('Post.id' => $c['Chat']['offer_id'])));
                return $c;
            }, $comment_chats);
            //$userimage= $this->User->find('first',array('conditions'=>array('User.id'=>$user_id)));


            $unread_comment = $this->Chat->find('count', array('conditions' => array('Chat.receiver_id' => $user_id, 'Chat.is_read' => 0), 'order' => array('Chat.time' => 'DESC'), 'group' => array('Chat.offer_id'))); //
//                exit;
        }

        $title = 'Ladder';
        $this->set(compact('title', 'comment_chats', 'unread_comment'));



        // Category listing for add edit post
        $this->Category->recursive = -1;
        $options = array('conditions' => array('Category.status' => 1, 'Category.parent_id' => 0, 'Category.id =' => 26), 'fields' => array('Category.id', 'Category.category_name'), 'order' => 'Category.category_name ASC');
        $catgfirst = $this->Category->find('first', $options);

        $options = array('conditions' => array('Category.status' => 1, 'Category.parent_id' => 0, 'Category.id !=' => 26), 'fields' => array('Category.id', 'Category.category_name'), 'order' => 'Category.category_name ASC');
        $catg = $this->Category->find('list', $options);

        $app_option_noti = array('conditions' => array('OfferNotification.to_id' => $user_id), 'order' => array('OfferNotification.id' => 'desc'));
        $notification = $this->OfferNotification->find('all', $app_option_noti);
        $notification_count = $this->OfferNotification->find('count', $app_option_noti);

        $this->set(compact('catg', 'notification', 'notification_count', 'catgfirst'));


        if (isset($userid) && $userid != '') {
            //echo $userid;
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $userid));
            $userdetails = $this->User->find('first', $options);
            //pr($userdetails);
            $this->set(compact('userdetails'));
        } else if (isset($adminuserid) && $adminuserid != '') {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $adminuserid));
            $userdetails = $this->User->find('first', $options);
            $this->set(compact('userdetails'));
        } else {
            $userdetails = '';
            $this->set(compact('userdetails'));
        }

        $options = array('conditions' => array('Setting.' . $this->Setting->primaryKey => 1));
        $sitesetting = $this->Setting->find('first', $options);

        $options_userpopapp = array('conditions' => array('User.id' => $user_id));
        $userpopdetailsapp = $this->User->find('first', $options_userpopapp);
        $this->set(compact('sitesetting', 'SITE_URL', 'userid', 'userpopdetailsapp'));





        if ($this->Session->read('is_admin')) {
            $this->loadModel('Adminrolemeta');

            $options = array('conditions' => array('User.' . $this->User->primaryKey => $adminuserid));
            $userdata = $this->User->find('first', $options);

            //pr($userdata);
            if ($userdata['User']['admin_type'] == 0) {
                $role_restrictions = array();
            } else {
                $role_restrictions = $this->Adminrolemeta->find('all', array('conditions' => array('Adminrolemeta.roleid' => $userdata['User']['admin_type'])));
            }
            $this->set(compact('role_restrictions'));
        }


        //set sitelogo for the site
        $setting_array = array('conditions' => array('Setting.id' => '1'));
        $Content = $this->Setting->find('first', $setting_array);
        if ($Content['Setting']['logo'] != '') {
            $logo_name = $Content['Setting']['logo'];
        } else {
            $logo_name = 'logo.png';
        }
        $this->set('ladder_logo', $this->webroot . 'site_logo/' . $logo_name);

        $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : '';
        if ($lang == 'sp') {
            require_once WWW_ROOT . 'lang/' . $lang . '.php';
            $this->set('lang', $lang);
        } else {
            require_once WWW_ROOT . 'lang/en.php';
            $this->set('lang', 'en');
        }


        /*
         * Menu management
         * Header menu and footer menu
         */
        $this->loadModel('CmsPage');
        $headerMenuOption = array(
            'fields' => array('CmsPage.page_title', 'CmsPage.slug'),
            'conditions' => array(
                'CmsPage.show_in_header' => 1
            )
        );
        $headerMenus = $this->CmsPage->find('all', $headerMenuOption);

        $footerMenuOption = array(
            'fields' => array('CmsPage.page_title', 'CmsPage.slug'),
            'conditions' => array(
                'CmsPage.show_in_footer' => 1
            )
        );
        $footerMenus = $this->CmsPage->find('all', $footerMenuOption);



        $abouts = $this->CmsPage->find('all', array('conditions' => array('CmsPage.contentcategory_id' => 1)));
        $our_services = $this->CmsPage->find('all', array('conditions' => array('CmsPage.contentcategory_id' => 2)));
        $our_terms = $this->CmsPage->find('all', array('conditions' => array('CmsPage.contentcategory_id' => 3)));

        $this->set(compact('headerMenus', 'footerMenus', 'abouts', 'our_services', 'our_terms'));

        $this->loadModel('Seo');
        $metaConditions = array();
        if ($this->params['controller'] == 'users' && $this->params['action'] == 'home') {
            $metaConditions = array('conditions' => array('Seo.page_name' => 'home'));
        } else if ($this->params['controller'] == 'users' && $this->params['action'] == 'login') {
            $metaConditions = array('conditions' => array('Seo.page_name' => 'login'));
        } else if ($this->params['controller'] == 'users' && $this->params['action'] == 'signup') {
            $metaConditions = array('conditions' => array('Seo.page_name' => 'signup'));
        } else if ($this->params['controller'] == 'users' && $this->params['action'] == 'search') {
            $metaConditions = array('conditions' => array('Seo.page_name' => 'search'));
        } else if ($this->params['controller'] == 'users' && $this->params['action'] == 'courselisting') {
            $metaConditions = array('conditions' => array('Seo.page_name' => 'courselisting'));
        }

        $metaDetails = $this->Seo->find('first', $metaConditions);
        $MetaTagskeywords = $metaDetails['Seo']['meta_keyword'];
        $MetaTagsdescripton = strip_tags($metaDetails['Seo']['meta_description']);

        $this->set(compact('MetaTagskeywords', 'MetaTagsdescripton'));

        if ($this->Session->read('userid') != '') {
            $this->loadModel('TempCart');
            $cart_details = $this->TempCart->find('all', array('conditions' => array('TempCart.user_id' => $this->Session->read('userid'))));
            $qnt = 0;
            foreach ($cart_details as $key => $value) {
                $qnt = $qnt + 1;
            }
            $this->set('product_quantity', $qnt);
        }

        if ($this->Session->read('userid') != '') {
            $this->loadModel('TempCart');
            $this->TempCart->recursive = 2;
            $mini_cart_details = $this->TempCart->find('all', array('conditions' => array('TempCart.user_id' => $this->Session->read('userid'))));
            $this->set('mini_cart_details', $mini_cart_details);
        }
    }

}
