<?php
App::uses('Category', 'Inventory.Model');

/**
 * Category Test Case
 *
 */
class CategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.category',
		'plugin.inventory.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Category = ClassRegistry::init('Inventory.Category');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Category);

		parent::tearDown();
	}

}
