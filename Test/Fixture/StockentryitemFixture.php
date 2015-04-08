<?php
/**
 * StockentryitemFixture
 *
 */
class StockentryitemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'item_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'amount' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'rate' => array('type' => 'float', 'null' => false, 'default' => null, 'unsigned' => false),
		'entrytype_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'billNo' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'item_id' => 1,
			'amount' => 1,
			'rate' => 1,
			'entrytype_id' => 1,
			'billNo' => 1,
			'created' => '2015-04-06 15:15:57',
			'modified' => '2015-04-06 15:15:57'
		),
	);

}
