<?php

App::uses('AppController', 'Controller');

/**
 * PromoCodes Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class BookingsController extends AppController {

	public $components = array('Session');

	public function index(){

		$this->loadModel('User');
		$this->loadModel('Order');
		$this->loadModel('OrderItem');
		$this->loadModel('OrderSet');
		$this->loadModel('Post');
		$userid = $this->Session->read('userid');
        if (!isset($userid)) {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }


        $user_detail=$this->User->find('first',array('conditions'=>array('User.id'=>$userid)));
        
        if($user_detail['User']['admin_type']=='3' || $user_detail['User']['admin_type']=='4'){
            $user_type = $user_detail['User']['admin_type'];
        	$this->OrderItem->recursive = 2;
            $order_list = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.user_id'=>$userid)));
            //list of user order different course...
            $course_lists = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.user_id'=>$userid),'fields'=>array('Post.id','Post.post_title'),'group' => array('Post.id')));
            
            $this->set(compact('order_list','userid','course_lists','user_type'));

        }

        if ($user_detail['User']['admin_type']=='1' || $user_detail['User']['admin_type']=='2') {
        	$user_type = $user_detail['User']['admin_type'];
        	$posts=$this->Post->find('all',array('conditions'=>array('Post.user_id'=>$userid),'fields'=>array('Post.id')));
        	$course_provider=array();
        	foreach ($posts as $key => $post) {
        		$course_provider[]=$post['Post']['id'];        		
        	}
        	$this->OrderItem->recursive = 2;
            //list of courses of this user with id.
            $user_posts = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$userid),'fields'=>array('Post.id','Post.post_title'),'group' => array('Post.id')));
        	$order_list = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.post_id'=>$course_provider)));
        	$this->set(compact('order_list','userid','user_posts','user_type'));
        }

        if ($this->request->is('post')) {
            $downloadcsv = $this->request->data['downloadcsv'];
            if(isset($downloadcsv)) {
                $filename = time() . "_export.csv";
                $fp = fopen('php://output', 'w');

                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename='.$filename);
                fputcsv($fp, ['COURSE', 'NO. OF BOOKING', 'PRICE','USER NAME','COURSE DELAILS']);

                foreach($order_list as $value){
                    $full_name = $value['User']['first_name'].' '.$value['User']['last_name'];
                      $data = array( $value['Post']['post_title'],
                           $value['Order']['quantity'],
                           $value['Post']['price'],
                           $full_name,
                           strip_tags($value['Post']['post_description']) );
                    fputcsv($fp,$data);
                }
                exit;
            }
        }


	}

    public function ajaxSearch(){

        if($this->request->is('post')){
            if($this->request->data['course']!=''){
                $this->loadModel('OrderItem');
                $userid = $this->Session->read('userid');
                $this->OrderItem->recursive = 2;
                $order_list = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.post_id'=>$this->request->data['course'],'OrderItem.user_id'=>$userid)));
                $res=array();
                $html='';
                if(!empty($order_list)){
                    $html .='<tr>'; 
                    foreach($order_list as $value)
                    {
                        if($value['Post']['User']['user_logo']!=''){
                          $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                        }
                        else{
                          $img = $this->webroot.'images/no_image.png';   
                        } 
                    $html .='<td><div class="row"><div class="col-md-2"><img src="'.$img.'" style="width:42px;" ></div>
                            <div class="col-md-10"><p>'.$value['Post']['post_title'].'</p><div class="seller">Provider:<span class="retailnet">'.$value['User']['first_name'].''.$value['User']['last_name'].'</span></div>
                            </div></div></td><td class="one">'.$value['OrderItem']['quantity'].'</td><td><div class="sale">Course Price: Rs. '. $value['Post']['price'].'</div></td><td>
                            <div class="multicolor">'.$value['User']['first_name'].''.$value['User']['last_name'].'</div></td><td><b>'.$value['Post']['post_description'].'</b></td></tr>';
                    }
                    $res['html']=$html;
                    $res['ack']=1;
                }else {
                    $html .= '<h3>There is no Course</h3>';
                    $res['html']=$html;
                    $res['ack']=1;
                }    
                echo json_encode($res);
                exit;
            }else {

                $this->loadModel('User');
                $this->loadModel('OrderItem');
                $this->loadModel('Post');
                $userid = $this->Session->read('userid');

                $posts=$this->Post->find('all',array('conditions'=>array('Post.user_id'=>$userid),'fields'=>array('Post.id')));
                $course_provider=array();
                foreach ($posts as $key => $post) {
                    $course_provider[]=$post['Post']['id'];             
                }
                $this->OrderItem->recursive = 2;
                //list of courses of this user with id.
                $user_posts = $this->Post->find('all',array('conditions'=>array('Post.user_id'=>$userid),'fields'=>array('Post.id','Post.post_title'),'group' => array('Post.post_title')));
                $order_list = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.post_id'=>$course_provider)));

                $res=array();
                $html='';

                $html .='<tr>'; 
                foreach($order_list as $value)
                {
                    if($value['Post']['User']['user_logo']!=''){
                      $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                    }
                    else{
                      $img = $this->webroot.'images/no_image.png';   
                    } 
                $html .='<td><div class="row"><div class="col-md-2"><img src="'.$img.'" style="width:42px;" ></div>
                        <div class="col-md-10"><p>'.$value['Post']['post_title'].'</p><div class="seller">Provider:<span class="retailnet">'.$value['User']['first_name'].''.$value['User']['last_name'].'</span></div>
                        </div></div></td><td class="one">'.$value['OrderItem']['quantity'].'</td><td><div class="sale">Course Price: Rs. '. $value['Post']['price'].'</div></td><td>
                        <div class="multicolor">'.$value['User']['first_name'].''.$value['User']['last_name'].'</div></td><td><b>'.$value['Post']['post_description'].'</b></td></tr>';
                }
                $res['html']=$html;
                $res['ack']=1;
                echo json_encode($res);
                exit;

            }
        }   

        
    }

    public function ajaxSearchUser(){
        if($this->request->is('post')){
             $userid = $this->Session->read('userid');
            if($this->request->data['course']!=''){
                $this->loadModel('OrderItem');
                $this->OrderItem->recursive = 2;
                $order_list = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.user_id'=>$userid,'OrderItem.post_id'=>$this->request->data['course'])));
                   
                    if(!empty($order_list)){
                        $res=array();
                        $html='';

                        $html .='<tr>'; 
                        foreach($order_list as $value)
                        {
                            if($value['Post']['User']['user_logo']!=''){
                              $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                            }
                            else{
                              $img = $this->webroot.'images/no_image.png';   
                            } 
                        $html .='<td><div class="row"><div class="col-md-2"><img src="'.$img.'" style="width:42px;" >
                                 </div><div class="col-md-10"><p>'. $value['Post']['post_title'].'</p><div class="seller">Provider:<span class="retailnet">'.$value['User']['first_name'].' '.$value['User']['last_name'].'</span></div>
                                 </div></div></td><td class="one">'.$value['OrderItem']['quantity'].'</td><td><div class="sale">Course Price: Rs. '.$value['Post']['price'].'</div>
                                 </td><td><div class="multicolor">'.$value['Post']['post_description'].'</div></td><td><b> '.'$'.$value['Post']['price']*$value['OrderItem']['quantity'].'</b></td></tr>';
                        }
                        $res['html']=$html;
                        $res['ack']=1;
                    }else {
                        $html .= '<h3>There is no Course</h3>';
                        $res['html']=$html;
                        $res['ack']=1;
                    }    
                    echo json_encode($res);
                    exit;
            
            } else {
                $this->loadModel('OrderItem');
                $this->OrderItem->recursive = 2;
                $order_list = $this->OrderItem->find('all',array('conditions'=>array('OrderItem.user_id'=>$userid)));

                if(!empty($order_list)){
                        $res=array();
                        $html='';

                        $html .='<tr>'; 
                        foreach($order_list as $value)
                        { 
                            if($value['Post']['User']['user_logo']!=''){
                              $img = $this->webroot.'user_logo/'.$value['Post']['User']['user_logo'];
                            }
                            else{
                              $img = $this->webroot.'images/no_image.png';   
                            }
                        $html .='<td><div class="row"><div class="col-md-2"><img src="'.$img.'" style="width:42px;" >
                                 </div><div class="col-md-10"><p>'. $value['Post']['post_title'].'</p><div class="seller">Provider:<span class="retailnet">'.$value['User']['first_name'].' '.$value['User']['last_name'].'</span></div>
                                 </div></div></td><td class="one">'.$value['OrderItem']['quantity'].'</td><td><div class="sale">Course Price: Rs. '.$value['Post']['price'].'</div>
                                 </td><td><div class="multicolor">'.$value['Post']['post_description'].'</div></td><td><b> '.'$'.$value['Post']['price']*$value['OrderItem']['quantity'].'</b></td></tr>';
                        }
                        $res['html']=$html;
                        $res['ack']=1;
                    }else {
                        $html .= '<h3>There is no Course</h3>';
                        $res['html']=$html;
                        $res['ack']=1;
                    }    
                    echo json_encode($res);
                    exit;

            }           
        }

    }



}