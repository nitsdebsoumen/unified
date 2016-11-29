<?php

App::uses('AppController', 'Controller');

/**
 * Privacies Controller
 *
 * @property Privacy $Privacy
 * @property PaginatorComponent $Paginator
 */
class StatesController extends AppController {

	public function ajaxStates(){
		$ret = array();
		$html = '';
		if ($this->request->is('post')) {
			
			$c_id = $this->request->data['c_id'];
			$states = $this->State->find('all',array('conditions'=>array('State.country_id' => $c_id)));
			
			if(!empty($states)) {
				foreach ($states as $key) {
					//echo $key['State']['name'];
					$html .= '<option value="'.$key['State']['id'].'">'.$key['State']['name'].'</option>';
				}
				$ret['html'] = $html;
				$ret['ack'] = 1;
			} else {
				$ret['html'] = '<option value="">Select state</option>';
				$ret['ack'] = 0;
			}
			

		}
		echo json_encode($ret);
		exit;		
	}

}