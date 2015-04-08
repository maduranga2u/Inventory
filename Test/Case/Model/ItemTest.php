<?php
App::uses('Item', 'Inventory.Model');

/**
 * Item Test Case
 *
 */
class ItemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.item',
		'plugin.inventory.category',
		'plugin.inventory.balance',
		'plugin.inventory.stockentryitem'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Item = ClassRegistry::init('Inventory.Item');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Item);

		parent::tearDown();
	}

}
