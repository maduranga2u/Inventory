<?php
App::uses('InventoryAppModel', 'Inventory.Model');
/**
 * Entryitem Model
 *
 * @property Entry $Entry
 * @property Ledger $Ledger
 */
class Entryitem extends InventoryAppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'dc' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Entry' => array(
			'className' => 'Entry',
			'foreignKey' => 'entry_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Ledger' => array(
			'className' => 'Ledger',
			'foreignKey' => 'ledger_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
