<?php
App::uses('ListItem', 'Model');

/**
 * ListItem Test Case
 *
 */
class ListItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.list_item',
		'app.list',
		'app.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ListItem = ClassRegistry::init('ListItem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ListItem);

		parent::tearDown();
	}

}
