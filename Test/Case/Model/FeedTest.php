<?php
App::uses('Feed', 'Inventory.Model');

/**
 * Feed Test Case
 *
 */
class FeedTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.inventory.feed'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Feed = ClassRegistry::init('Inventory.Feed');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Feed);

		parent::tearDown();
	}

}
