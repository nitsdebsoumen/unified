<?php
/**
 * SecurityFixture
 *
 */
class SecurityFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'full_site_ssl' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'two_factor_authentication' => array('type' => 'boolean', 'null' => false, 'default' => null),
		'sign_in_notifications' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'sign_in_history' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'user_id' => 1,
			'full_site_ssl' => 1,
			'two_factor_authentication' => 1,
			'sign_in_notifications' => 1,
			'sign_in_history' => 1
		),
	);

}
