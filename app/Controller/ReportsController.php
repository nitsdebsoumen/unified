<?php

App::uses('AppController', 'Controller');

/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController {

  public $components = array('Session', 'RequestHandler', 'Paginator', 'Cookie');
  var $uses = array('Post','TempCart','User','Order','Category','Rating');

  public function admin_index() {
   $options = array(
                    'fields'=>array('sum(`Order`.`quantity`)  AS sum','`Order`.*'),
                    'group' => '`Order`.`post_id`'
                );
    $this->Order->recursive = 2;
    $all_orders = $this->Order->find('all',$options);
    $this->set('all_orders',$all_orders);

    if ($this->request->is('post')) {
            $downloadcsv = $this->request->data['downloadcsv'];
            if(isset($downloadcsv)) {
                $filename = time() . "_export.csv";
                $fp = fopen('php://output', 'w');

                header('Content-type: application/csv');
                header('Content-Disposition: attachment; filename='.$filename);
                fputcsv($fp, ['COURSE TITLE', 'COURSE PRICE', 'TOTAL ORDER','TOTAL REVENUE']);

                foreach($all_orders as $order){
                      $total_revenue = $order['Post']['price']*$order[0]['sum'];
                      $data = array( 
                           $order['Post']['post_title'],
                           $order['Post']['price'],
                           $order[0]['sum'],
                           $total_revenue
                            );
                    fputcsv($fp,$data);
                }
                exit;
            }
        }

  }
}