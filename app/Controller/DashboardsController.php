<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class DashboardsController extends AppController {

  public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
  var $uses = array('Post','TempCart','User','Order','Category','Rating');

  public function admin_index() {
    
    $no_of_user = count($this->User->find('all'));
    $no_of_course = count($this->Post->find('all'));
    $click_counts = $this->Category->find('all',array('fields'=>array('click_count','category_name')));
    $category_details = $this->Category->find('all',array('order'=>array('Category.click_count DESC'),'limit'=>5));
    $ratings = $this->Rating->find('all',array(array('order'=>'Rating.id DESC'),'limit'=>5));
    $total_click = 0;
    foreach ($click_counts as $click_count) {
      $total_click = $total_click + $click_count['Category']['click_count'];
    }
    $orders = $this->Order->find('all');
    $total_order = 0;
    $total_revenue = 0;
    foreach ($orders as $order) {
      $total_order   = $total_order + $order['Order']['quantity'];
      $total_revenue = $total_revenue + $order['Order']['amount'];
    }
    $this->set(compact('no_of_user','total_order','total_revenue','no_of_course','total_click','category_details','ratings'));
  }

	 

}