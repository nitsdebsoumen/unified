<?php
App::uses('AppController', 'Controller');
/**
 * Contents Controller
 *
 * @property Content $Content
 * @property PaginatorComponent $Paginator
 */

class UserBlocksController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('UserBlock','Post','Setting');

/**
 * index method
 *
 * @return void
 */
        public function ajax_save()
        {
            $userid = $this->Session->read('user_id');
            if(empty($userid))
            {
                $this->redirect('/');
            }
            if($this->request->is('post'))
            {
                $this->request->data['UserBlock']['user_by'] = $userid;
                $is_blocked = $this->UserBlock->find('first',array('conditions' =>  array('UserBlock.user_by' => $userid,'UserBlock.user_to' => $this->request->data['UserBlock']['user_to'])));
                if(!empty($is_blocked))
                {
                    echo json_encode(true);
                    exit;
                }
                if($this->UserBlock->save($this->request->data))
                {
//                    $post_details = $this->Post->find('first',array('conditions' => array('Post.id' => $this->request->data['PostReport']['post_id'])));
//                    //$post_owner = $post_details['User'];
//                    
//                    
//                    $contact_email = $this->Setting->find('first', array('conditions' => array('Setting.id' => 1), 'fields' => array('Setting.site_email', 'Setting.site_name')));
//                    if($contact_email){
//                            $adminEmail = $contact_email['Setting']['site_email'];
//                    } else {
//                            $adminEmail = 'superadmin@abc.com';
//                    }
//
//                                            
//                    $this->loadModel('EmailTemplate');
//                    $EmailTemplate=$this->EmailTemplate->find('first',array('conditions'=>array('EmailTemplate.id'=>2)));
//                    
//                    $siteurl= Configure::read('SITE_URL');
//                    $LOGINLINK=$siteurl.'posts/post_details/'.$post_details['Post']['id'];
//                    
//                    /*********** To Post Owner **************/
//                    $msg_body =str_replace(array('[POST_OWNER]','[POST_TITLE]','[LINK]'),array($post_details['User']['first_name'],$post_details['Post']['post_title'],$LOGINLINK),$EmailTemplate['EmailTemplate']['content']);
//                    
//                    $from=$contact_email['Setting']['site_name'].' <'.$adminEmail.'>';
//                    //$Subject_mail='Welcome to '.$contact_email['Setting']['site_name'];
//                    $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
//                    $this->php_mail($post_details['User']['email_address'],$from,$Subject_mail,$msg_body);
//                    
//                    /************ To Admin ****************/
//                    $msg_body =str_replace(array('[POST_OWNER]','[POST_TITLE]','[LINK]'),array('Admin',$post_details['Post']['post_title'],$LOGINLINK),$EmailTemplate['EmailTemplate']['content']);
//                    
//                    $from=$contact_email['Setting']['site_name'].' <'.$adminEmail.'>';
//                    //$Subject_mail='Welcome to '.$contact_email['Setting']['site_name'];
//                    $Subject_mail=$EmailTemplate['EmailTemplate']['subject'];
//                    $this->php_mail($adminEmail,$from,$Subject_mail,$msg_body);
                    echo json_encode(true);
                    
                }
                else
                {
                    echo json_encode(false);
                }
            }
            exit;
        }
        
        public function ajax_unblock()
        {
            $userid = $this->Session->read('user_id');
            if(empty($userid))
            {
                $this->redirect('/');
            }
            if($this->request->is('post'))
            {
                $this->request->data['UserBlock']['user_by'] = $userid;                
                $this->UserBlock->query("delete from user_blocks where user_by=$userid and user_to=".$this->request->data['UserBlock']['user_to']);
                echo json_encode(true);
            }
            exit;
        }
	////////////////////////////////////////AK Start//////////////////////////////////////
	
        /////////////////////////End App Function suman ///////////////////////////////////////
}
