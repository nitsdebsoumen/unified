<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.user',
		'app.email_notification',
		'app.favorite_list',
		'app.favorite_shop',
		'app.shop',
		'app.favorite_treasury',
		'app.treasury',
		'app.inbox_message',
		'app.sender',
		'app.preference',
		'app.language',
		'app.currency',
		'app.privacy',
		'app.security',
		'app.sent_message',
		'app.receiver',
		'app.shipping_address'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
