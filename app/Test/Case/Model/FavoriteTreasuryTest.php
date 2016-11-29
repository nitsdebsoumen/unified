<?php
App::uses('FavoriteTreasury', 'Model');

/**
 * FavoriteTreasury Test Case
 *
 */
class FavoriteTreasuryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.favorite_treasury',
		'app.user',
		'app.treasury'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FavoriteTreasury = ClassRegistry::init('FavoriteTreasury');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FavoriteTreasury);

		parent::tearDown();
	}

}
