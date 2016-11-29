<?php
App::uses('AppModel', 'Model');
/**
 * EmailTemplate Model
 *
 */
class Rating extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		
	);
        
        public $belongsTo = array(
		'User' => array(
                    'className' => 'User',
                    'foreignKey' => 'uid',
                    'conditions' => '',
                    'fields' => '',
                    'order' => 'ratting_date DESC'
		),
		'Therapist' => array(
                    'className' => 'User',
                    'foreignKey' => 'therapistID',
                    'conditions' => '',
                    'fields' => '',
                    'order' => 'ratting_date DESC'
		),
          'Post' => array(
                    'className' => 'Post',
                    'foreignKey' => 'post_id'
                   
          )
	);
	
	
}
