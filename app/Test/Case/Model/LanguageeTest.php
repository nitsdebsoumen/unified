<?php
App::uses('Languagee', 'Model');

/**
 * Languagee Test Case
 *
 */
class LanguageeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.languagee'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Languagee = ClassRegistry::init('Languagee');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Languagee);

		parent::tearDown();
	}

}
