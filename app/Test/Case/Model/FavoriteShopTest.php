<?php
App::uses('FavoriteShop', 'Model');

/**
 * FavoriteShop Test Case
 *
 */
class FavoriteShopTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.favorite_shop',
		'app.user',
		'app.shop'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FavoriteShop = ClassRegistry::init('FavoriteShop');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FavoriteShop);

		parent::tearDown();
	}

}
