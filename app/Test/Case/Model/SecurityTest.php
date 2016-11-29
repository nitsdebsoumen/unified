<?php
App::uses('Security', 'Model');

/**
 * Security Test Case
 *
 */
class SecurityTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.security',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Security = ClassRegistry::init('Security');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Security);

		parent::tearDown();
	}

}
