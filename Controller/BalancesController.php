<?php
/**
 * The MIT License (MIT)
 *
 * Webzash - Easy to use web based double entry accounting software
 *
 * Copyright (c) 2014 Damindu Maduranga <maduranga2u@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

App::uses('InventoryAppController', 'Inventory.Controller');
/**
 * Balances Controller
 *
 */
class BalancesController extends InventoryAppController {

/**
 * Scaffold
 *
 * @var mixed
 */
	public $scaffold;
	/**
 * Add a row in the entry via ajax
 *
 * @param string $addType
 * @return void
 */
	function checkbalance($id) {

		$this->autoRender = false;
		$value=$this->Balance->find('first', array(
			'conditions' => array('Balance.item_id' => $id),
			'fields' => array('value','id'),
		));
		$str="0||0";
		if(!empty($value)){
			$str=$value['Balance']['value'].'||'.$value['Balance']['id'];
		}
		return $str;
	}

}
