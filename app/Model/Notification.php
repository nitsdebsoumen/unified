<?php
App::uses('AppModel', 'Model');
/**
 * Notification Model
 *
 * @property User $User
 */
class Notification extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	public $belongsTo = array(
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'Task_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ForUser' => array(
			'className' => 'User',
			'foreignKey' => 'for_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ByUser' => array(
			'className' => 'User',
			'foreignKey' => 'by_user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
