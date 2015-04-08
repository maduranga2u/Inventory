<?php
App::uses('Entryitem', 'Inventory.Model');

/**
 * Entryitem Test Case
 *
 */
class EntryitemTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.entryitem',
		'plugin.inventory.entry',
		'plugin.inventory.tag',
		'plugin.inventory.entrytype',
		'plugin.inventory.ledger'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Entryitem = ClassRegistry::init('Inventory.Entryitem');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entryitem);

		parent::tearDown();
	}

}
