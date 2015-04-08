<?php
/**
 * EntryFixture
 *
 */
class EntryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 18, 'unsigned' => false, 'key' => 'primary'),
		'tag_id' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'length' => 18, 'unsigned' => false, 'key' => 'index'),
		'entrytype_id' => array('type' => 'biginteger', 'null' => false, 'default' => null, 'length' => 18, 'unsigned' => false, 'key' => 'index'),
		'number' => array('type' => 'biginteger', 'null' => true, 'default' => null, 'length' => 18, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'dr_total' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '25,2', 'unsigned' => false),
		'cr_total' => array('type' => 'decimal', 'null' => false, 'default' => '0.00', 'length' => '25,2', 'unsigned' => false),
		'narration' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 500, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'unique_id' => array('column' => 'id', 'unique' => 1),
			'id' => array('column' => 'id', 'unique' => 0),
			'tag_id' => array('column' => 'tag_id', 'unique' => 0),
			'entrytype_id' => array('column' => 'entrytype_id', 'unique' => 0)
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
			'tag_id' => '',
			'entrytype_id' => '',
			'number' => '',
			'date' => '2015-04-06',
			'dr_total' => '',
			'cr_total' => '',
			'narration' => 'Lorem ipsum dolor sit amet'
		),
	);

}
