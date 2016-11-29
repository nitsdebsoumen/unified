<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class WishlistsController extends AppController {
    /* function beforeFilter() {
      parent::beforeFilter();
      } */

    /**
     * Components
     *
     * @var array
     */

    //public $name = 'Users';
    public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
    var $uses = array('User','Wishlist');

    public function index(){
        $userid=$this->Session->read('userid');
        $wishlist=$this->Wishlist->find('all',array('conditions'=>array('Wishlist.user_id'=>$userid),'recursive'=>2));
        $this->set(compact('wishlist'));
    }

    public function ajaxremoveWishlist(){

         $wishlist_id = $this->request->data['id'];
                
        $this->Wishlist->id =$wishlist_id;
        if (!$this->Wishlist->exists()) {
            throw new NotFoundException(__('Invalid contact'));
        }
        
            $this->request->onlyAllow('post', 'delete');
            if($this->Wishlist->delete())
            {
                echo '1';
            }
            else
            {
                echo '0';
            }
        exit;
         
    }

}        