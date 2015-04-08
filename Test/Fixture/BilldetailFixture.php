<?php
/**
 * BilldetailFixture
 *
 */
class BilldetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'billNo' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'billType' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'date' => array('type' => 'date', 'null' => false, 'default' => null),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'cheque' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'payment_type' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'card_type' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'card_no' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'card_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'currency_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 20, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'client_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
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
			'billNo' => 1,
			'billType' => 1,
			'date' => '2015-04-06',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'cheque' => 'Lorem ipsum dolor sit amet',
			'payment_type' => 'Lorem ipsum dolor sit amet',
			'created' => '2015-04-06 15:15:54',
			'modified' => '2015-04-06 15:15:54',
			'card_type' => 'Lorem ipsum dolor ',
			'card_no' => 1,
			'card_name' => 'Lorem ipsum dolor ',
			'currency_name' => 'Lorem ipsum dolor ',
			'client_id' => 1
		),
	);

}
