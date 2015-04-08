<?php
App::uses('Billdetail', 'Inventory.Model');

/**
 * Billdetail Test Case
 *
 */
class BilldetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.billdetail',
		'plugin.inventory.client'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Billdetail = ClassRegistry::init('Inventory.Billdetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Billdetail);

		parent::tearDown();
	}

}
