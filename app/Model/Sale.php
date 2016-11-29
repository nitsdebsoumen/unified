<?php
App::uses('AppModel', 'Model');
/**
 * Job Model
 *
 * @property User $User
 * @property Bid $Bid
 * @property PostJob $PostJob
 */
class Sale extends AppModel {

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
		'MembershipPlan' => array(
			'className' => 'MembershipPlan',
			'foreignKey' => 'membership_plan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}