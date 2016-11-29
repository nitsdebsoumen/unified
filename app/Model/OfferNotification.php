<?php
App::uses('AppModel', 'Model');
/**
 * Proposal Model
 *
 * @property User $User
 * @property Task $Task
 */
class OfferNotification extends AppModel {

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
		'Post' => array(
			'className' => 'Post',
			'foreignKey' => 'offer_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),

		'User' => array(
			'className' => 'User',
			'foreignKey' => 'from_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)

		

	);
}
