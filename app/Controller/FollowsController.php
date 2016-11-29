<?php
App::uses('AppController', 'Controller');
/**
 * Contents Controller
 *
 * @property Content $Content
 * @property PaginatorComponent $Paginator
 */

class FollowsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('Follow','UserBlock','Post','Setting');

/**
 * index method
 *
 * @return void
 */
        public function ajax_follow()
        {
            $userid = $this->Session->read('user_id');
            if(empty($userid))
            {
                $this->redirect('/');
            }
            if($this->request->is('post'))
            {
                $this->request->data['Follow']['user_by'] = $userid;
                $if_exist = $this->Follow->find('first', array('conditions' => array('Follow.user_by' => $userid,'Follow.user_to' => $this->request->data['Follow']['user_to'])));
                if(!empty($if_exist))
                {
                    echo json_encode(true);
                    exit;
                }
                if($this->Follow->save($this->request->data))
                {
                    echo json_encode(true);
                }
                else
                {
                    echo json_encode(false);
                }
            }
            exit;
        }
        
        public function ajax_unfollow()
        {
            $userid = $this->Session->read('user_id');
            if(empty($userid))
            {
                $this->redirect('/');
            }
            if($this->request->is('post'))
            {
                $this->request->data['Follow']['user_by'] = $userid;                
                $this->Follow->query("delete from follows where user_by=$userid and user_to=".$this->request->data['Follow']['user_to']);
                echo json_encode(true);
            }
            exit;
        }
	////////////////////////////////////////AK Start//////////////////////////////////////
	
        /////////////////////////End App Function suman ///////////////////////////////////////
}
