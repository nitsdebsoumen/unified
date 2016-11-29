<?php
App::uses('AppController', 'Controller');
/**
 * PreviousMakings Controller
 *
 * @property PreviousMaking $PreviousMaking
 * @property PaginatorComponent $Paginator
 */
class RatingsController extends AppController {

/**
 * Components
 *
 * @var array
 */
public $components = array('Paginator');

public function admin_list() {		
    $userid = $this->Session->read('Auth.User.id');
    if(!isset($userid) && $userid=='')
    {
      $this->redirect('/admin');
    }

    $title_for_layout = 'Reviews List';
    $this->paginate = array(
          'order' => array(
                  'Rating.id' => 'desc'
          )
    );
    
    $this->Paginator->settings = $this->paginate;
    $this->Rating->recursive = -1;
    $this->set('review_all', $this->Paginator->paginate());
    $this->set(compact('title_for_layout'));
}
    public function admin_edit($id = null){
        
        $title_for_layout = 'Review Edit';
        $userid = $this->Session->read('Auth.User.id');
        if(!isset($userid) && $userid=='')
        {
            $this->redirect('/admin');
        }	
        if (!$this->Rating->exists($id)) {
            throw new NotFoundException(__('Invalid review ID.'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Rating->save($this->request->data)) {
                $this->Session->setFlash('The review has been saved.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'));
                //$this->Session->setFlash(__('Spa type already exists. Please, try another.', 'default', array('class' => 'error')));
            }
            
        }else {
            $options = array('conditions' => array('Rating.' . $this->Rating->primaryKey => $id));
            $this->request->data = $this->Rating->find('first', $options);
        }
        $this->set(compact('title_for_layout'));
    }
    
    public function admin_delete($id = null) {
    	$this->loadModel('ReviewReply');
        $userid = $this->Session->read('Auth.User.id');
        if(!isset($userid) && $userid=='')
        {
           $this->redirect('/admin');
        }
        $this->Rating->id = $id;
        if (!$this->Rating->exists()) {
          throw new NotFoundException(__('Invalid review.'));
        }
        if ($this->Rating->delete($id)) {
            $this->ReviewReply->deleteAll(array('ReviewReply.rating_id' => $id));
            $this->Session->setFlash('The review has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('The review type could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'list'));
    }
    
    public function admin_reply_list() {
        $this->loadModel('ReviewReply');
        $userid = $this->Session->read('Auth.User.id');
        if(!isset($userid) && $userid=='')
        {
          $this->redirect('/admin');
        }

        $title_for_layout = 'Replies List';
        $this->paginate = array(
              'order' => array(
                      'ReviewReply.id' => 'desc'
              )
        );

        $this->Paginator->settings = $this->paginate;
        //$this->ReviewReply->recursive = -1;
         $this->set('review_all', $this->Paginator->paginate('ReviewReply'));
        $this->set(compact('title_for_layout'));
    }
    public function admin_reply_edit($id = null){
        $this->loadModel('ReviewReply');
        $title_for_layout = 'Replies Edit';
        $userid = $this->Session->read('Auth.User.id');
        if(!isset($userid) && $userid=='')
        {
            $this->redirect('/admin');
        }	
        if (!$this->ReviewReply->exists($id)) {
            throw new NotFoundException(__('Invalid replies ID.'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->ReviewReply->save($this->request->data)) {
                $this->Session->setFlash('The replies has been saved.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash(__('The replies could not be saved. Please, try again.'));
                //$this->Session->setFlash(__('Spa type already exists. Please, try another.', 'default', array('class' => 'error')));
            }
            
        }else {
            $options = array('conditions' => array('ReviewReply.' . $this->Rating->primaryKey => $id));
            $this->request->data = $this->ReviewReply->find('first', $options);
        }
        $this->set(compact('title_for_layout'));
    }
    
    public function admin_reply_delete($id = null) {
    	$this->loadModel('ReviewReply');
        $userid = $this->Session->read('Auth.User.id');
        if(!isset($userid) && $userid=='')
        {
           $this->redirect('/admin');
        }
        $this->ReviewReply->id = $id;
        if (!$this->ReviewReply->exists()) {
          throw new NotFoundException(__('Invalid Replies.'));
        }
        if ($this->ReviewReply->delete($id)) {
            $this->Session->setFlash('The replies has been deleted.', 'default', array('class' => 'success'));
        } else {
            $this->Session->setFlash(__('The replies could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'reply_list'));
    }
    
    
    public function write_review($id = null) {
    	$this->loadModel('Rating');
    	$this->loadModel('User');
        $userid = $this->Session->read('userid');
        if(!isset($userid) && $userid=='')
        {
           $this->redirect('/login');
        }
        $id = $this->Session->read('userid');
        $GetReview_data = $this->Rating->find('all',array('conditions'=>array('Rating.uid'=>$userid)));
        $user = $this->User->find('first',array('conditions'=>array('User.id'=>$id)));
        $this->set(compact('GetReview_data','id','user'));
        
        if ($this->request->is(array('post'))) {
        //pr($this->request->data);exit;
        $this->request->data['uid'] = $userid;
        $this->request->data['ratting_date'] = date('Y-m-d');
            if ($this->Rating->save($this->request->data)) {
                $this->Session->setFlash('The review has been saved.', 'default', array('class' => 'success'));
            } else {
                $this->Session->setFlash(__('The review could not be saved. Please, try again.'));
            }
            
           return $this->redirect($this->request->referer());
        }
    }
    
    
   /* public function getAverage($id = null){
        $this->loadModel('Rating');
        $total = 0;
	
	$rates = $this->Rating->find('all',array('conditions'=>array('Rating.therapistID'=>$id)));
	$countRatings = count($rates);
	foreach($rates as $rate){
	        $total = $total + (($rate['Rating']['reception'] + $rate['Rating']['treatement'] + $rate['Rating']['expertise'] + $rate['Rating']['comfort'] + $rate['Rating']['overall_satisfaction'])/5);
	
	}
        $avg_rateing='';
        if($total==0){
                $avg_rateing=0;
            }else{
                $avg_rateing=ceil($total/$countRatings);
            }
	$avg_rateing=($rates[0]['total']/4);
            $rateing=$this->Rating->find('first',array('conditions'=>array('Rating.toid'=>$id),'fields'=>array('SUM(Rating.avg_rate)  as total_score')));
            $total_rateing=$this->Rating->find('count',array('conditions'=>array('Rating.toid'=>$id)));
            if($total_rateing==0){
                $avg_rateing=0;
            }else{
                $avg_rateing=ceil($rateing[0]['total_score']/$total_rateing);
            }
	    $both = array('count'=>$total_rateing, 'score'=>$avg_rateing);
            return $avg_rateing;
    
    }*/
    
    
    public function getAverage($id = null){
        $this->loadModel('Rating');
        $total = 0;
	
	$rates = $this->Rating->find('all',array('conditions'=>array('Rating.therapistID'=>$id)));
	if(!empty($rates)){
	$countRatings = count($rates);
	
    $totalRTCal=0;
    $ratingCnt=0;  
    $TotReception=0;
    $TotTreatement=0;
    $TotExpertise=0;
    $TotComfort=0;
    $TotOverall_sat=0;
    $TotGuestsReturn=0;
        foreach($rates as $Review_data) {
             $ratingCnt++;
             $give_reception=isset($Review_data['Rating']['reception'])?$Review_data['Rating']['reception']:'';
             $give_treatement=isset($Review_data['Rating']['treatement'])?$Review_data['Rating']['treatement']:'';
             $give_expertise=isset($Review_data['Rating']['expertise'])?$Review_data['Rating']['expertise']:'';
             $give_comfort=isset($Review_data['Rating']['comfort'])?$Review_data['Rating']['comfort']:'';
             $give_overall_satisfaction=isset($Review_data['Rating']['overall_satisfaction'])?$Review_data['Rating']['overall_satisfaction']:'';
             $give_GuestsReturn=isset($Review_data['Rating']['see_company'])?$Review_data['Rating']['see_company']:'';
             $PerUserAvgRating=($give_reception+$give_treatement+$give_expertise+$give_comfort+$give_overall_satisfaction)/5;
             $totalRTCal=$totalRTCal+$PerUserAvgRating;
             $TotReception=$TotReception+$give_reception;
             $TotTreatement=$TotTreatement+$give_treatement;
             $TotExpertise=$TotExpertise+$give_expertise;
             $TotComfort=$TotComfort+$give_comfort;
             $TotOverall_sat=$TotOverall_sat+$give_overall_satisfaction;
                                                         
        }
        $totalActAvg=$totalRTCal/$ratingCnt;
	$totalAvg=number_format((float)$totalActAvg, 2, '.', '');
    }
    else{
	$totalAvg=0;
    }
    return $totalAvg;
    }
    
    public function my_reviews(){
        $userid = $this->Session->read('userid');
       // $spaid=base64_decode($spaid);
        if(!isset($userid) && $userid==''){
            $this->redirect('/');
        }
        $title_for_layout = 'My Reviews';
        $this->loadModel('Rating');
        //$this->Booking->recursive = 2;
        $this->set('all_reviews', $this->Paginator->paginate('Rating',array('Rating.uid' => $userid)));
        //$this->set(compact('title_for_layout','all_reviews'));
    }

    public function user_reviews($id = NULL){
        $user_id = base64_decode($id);
        $this->loadModel('Post');
        $this->loadModel('Rating');
        $post_ids = $this->Post->find('list',array('conditions'=>array('Post.user_id'=>$user_id),'fields'=>array('Post.id')));
        

        $user_reviews = $this->Rating->find('all',array('conditions'=>array('Rating.post_id'=>$post_ids)));
        $this->set(compact('user_reviews'));
    }

}

?>