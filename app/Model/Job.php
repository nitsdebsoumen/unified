<?php
App::uses('AppModel', 'Model');
/**
 * Job Model
 *
 * @property User $User
 * @property Bid $Bid
 * @property PostJob $PostJob
 */
class Job extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array();

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
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
		),
		'Proposal' => array(
			'className' => 'Proposal',
			'foreignKey' => 'proposal_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
