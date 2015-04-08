<?php
App::uses('Balance', 'Inventory.Model');

/**
 * Balance Test Case
 *
 */
class BalanceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.balance',
		'plugin.inventory.item'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Balance = ClassRegistry::init('Inventory.Balance');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Balance);

		parent::tearDown();
	}

}
