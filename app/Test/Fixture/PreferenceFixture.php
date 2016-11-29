<?php
/**
 * PreferenceFixture
 *
 */
class PreferenceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'filter_mature_content' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'language_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'currency_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'region' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'receive_email_from_admin' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'receive_phonecalls_from_admin' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
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
			'filter_mature_content' => 1,
			'language_id' => 1,
			'currency_id' => 1,
			'region' => 'Lorem ipsum dolor sit amet',
			'receive_email_from_admin' => 1,
			'receive_phonecalls_from_admin' => 1
		),
	);

}
