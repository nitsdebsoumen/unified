<?php
App::uses('FavoriteList', 'Model');

/**
 * FavoriteList Test Case
 *
 */
class FavoriteListTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.favorite_list',
		'app.user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FavoriteList = ClassRegistry::init('FavoriteList');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FavoriteList);

		parent::tearDown();
	}

}
