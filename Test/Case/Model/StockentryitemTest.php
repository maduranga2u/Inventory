<?php
App::uses('Stockentryitem', 'Inventory.Model');

/**
 * Stockentryitem Test Case
 *
 */
class StockentryitemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.stockentryitem',
		'plugin.inventory.item',
		'plugin.inventory.category',
		'plugin.inventory.balance',
		'plugin.inventory.entrytype'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Stockentryitem = ClassRegistry::init('Inventory.Stockentryitem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Stockentryitem);

		parent::tearDown();
	}

}
