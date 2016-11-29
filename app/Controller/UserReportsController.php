<?php
App::uses('AppController', 'Controller');
/**
 * Contents Controller
 *
 * @property Content $Content
 * @property PaginatorComponent $Paginator
 */

class UserReportsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public $uses = array('UserReport','Post','Setting');

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
                $this->request->data['UserReport']['user_by'] = $userid;
                if($this->UserReport->save($this->request->data))
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
	////////////////////////////////////////AK Start//////////////////////////////////////
	
        /////////////////////////End App Function suman ///////////////////////////////////////
}
