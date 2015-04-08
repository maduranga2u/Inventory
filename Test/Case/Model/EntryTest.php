<?php
App::uses('Entry', 'Inventory.Model');

/**
 * Entry Test Case
 *
 */
class EntryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.entry',
		'plugin.inventory.tag',
		'plugin.inventory.entrytype',
		'plugin.inventory.entryitem'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Entry = ClassRegistry::init('Inventory.Entry');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Entry);

		parent::tearDown();
	}

}
