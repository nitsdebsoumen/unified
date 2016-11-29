<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class CitiesController extends AppController {

	public function ajaxCities(){
		$ret = array();
		$html = '';
		if ($this->request->is('post')) {
						
			$s_id = $this->request->data['s_id'];
			$c_id = $this->request->data['c_id'];
			$cities = $this->City->find('all',array('conditions'=>array('City.state_id' => $s_id)));
			
			if(!empty($cities)) {
				foreach ($cities as $key) {
					//echo $key['State']['name'];
					$html .= '<option value="'.$key['City']['id'].'">'.$key['City']['name'].'</option>';
				}
				$ret['html'] = $html;
				$ret['ack'] = 1;
			} else {
				$ret['html'] = '<option value="">Select City</option>';
				$ret['ack'] = 0;
			}
			

		}
		echo json_encode($ret);
		exit;		
	}

}