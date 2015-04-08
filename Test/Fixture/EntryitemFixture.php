<?php
/**
 * EntryitemFixture
 *
 */
class EntryitemFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 18, 'unsigned' => false, 'key' => 'primary'),
		'entry_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 18, 'unsigned' => false, 'key' => 'index'),
		'ledger_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 18, 'unsigned' => false, 'key' => 'index'),
		'amount' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '25,2', 'unsigned' => false),
		'dc' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'reconciliation_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'unique_id' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 0),
			'entry_id' => array('column' => 'entry_id', 'unique' => 0),
			'ledger_id' => array('column' => 'ledger_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '',
			'entry_id' => '',
			'ledger_id' => '',
			'amount' => '',
			'dc' => 'Lorem ipsum dolor sit ame',
			'reconciliation_date' => '2015-04-06'
		),
	);

}
