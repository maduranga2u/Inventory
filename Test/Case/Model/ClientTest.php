<?php
App::uses('Client', 'Inventory.Model');

/**
 * Client Test Case
 *
 */
class ClientTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.client',
		'plugin.inventory.billdetail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Client = ClassRegistry::init('Inventory.Client');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Client);

		parent::tearDown();
	}

}
