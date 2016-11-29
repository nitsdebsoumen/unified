<?php
App::uses('AppModel', 'Model');
/**
 * Seo Model
 *
 */
class Kycdoc extends AppModel 
{

/**
 * Display field
 *
 * @var array
 */

	public $validate = array();

	public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => 'user_id'
        )
    );

}
