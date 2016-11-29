<?php
App::uses('EmailNotification', 'Model');

/**
 * EmailNotification Test Case
 *
 */
class EmailNotificationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.email_notification',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EmailNotification = ClassRegistry::init('EmailNotification');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EmailNotification);

		parent::tearDown();
	}

}
