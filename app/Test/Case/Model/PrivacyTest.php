<?php
App::uses('Privacy', 'Model');

/**
 * Privacy Test Case
 *
 */
class PrivacyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.privacy',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Privacy = ClassRegistry::init('Privacy');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Privacy);

		parent::tearDown();
	}

}
