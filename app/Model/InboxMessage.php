<?php
App::uses('AppModel', 'Model');
/**
 * InboxMessage Model
 *
 * @property User $User
 * @property Sender $Sender
 */
class InboxMessage extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Sender' => array(
			'className' => 'User',
			'foreignKey' => 'sender_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Receiver' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Task' => array(
			'className' => 'Task',
			'foreignKey' => 'task_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}

