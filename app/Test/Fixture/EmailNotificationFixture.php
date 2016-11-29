<?php
/**
 * EmailNotificationFixture
 *
 */
class EmailNotificationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'someone_sends_me_a_convo' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'send_convo' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'someone_follows_me' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'listings_about_to_expire' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'my_seller_activity' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'whats_new' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'recommended_features' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'tips_of_improving_shop' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'provide_feedback' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'receive_feedback' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
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
			'someone_sends_me_a_convo' => 1,
			'send_convo' => 1,
			'someone_follows_me' => 1,
			'listings_about_to_expire' => 1,
			'my_seller_activity' => 1,
			'whats_new' => 1,
			'recommended_features' => 1,
			'tips_of_improving_shop' => 1,
			'provide_feedback' => 1,
			'receive_feedback' => 1
		),
	);

}
