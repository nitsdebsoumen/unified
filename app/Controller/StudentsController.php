<?php
App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class StudentsController extends AppController {
    public $name = 'Students';
    public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
    var $uses = array('User', 'Post');
    
    public function index() {
        $userid = $this->Session->read('userid');
        
        if (!isset($userid) || $userid == '') {
            $this->redirect('/');
        }
        $allstudents_option = array(
            'conditions' => array(
                'OR' => array(
                    array('User.admin_type' => 3),
                    array('User.admin_type' => 4)
                )
            )
        );
        
        $allstudents = $this->User->find('all', $allstudents_option);
        $this->set(compact('allstudents'));
    }
}