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
App::uses('LedgerTree', 'Webzash.Lib');
/**
 * Billdetails Controller
 *
 */
class BilldetailsController extends InventoryAppController {
public $uses = array( 'Webzash.Group', 'Webzash.Ledger','Webzash.Entrytype', 'Webzash.Tag', 'Webzash.Log');
/**
 * bill method
 *
 * @param string $entrytypeLabel
 * @return void
 */
	public function add($entrytypeLabel = null) {

		$this->set('title_for_layout', __d('webzash', 'Add Entry'));
		$this->layout = 'Inventory.default';

		/* Check for valid entry type */
		if (!$entrytypeLabel) {
			$this->Session->setFlash(__d('webzash', 'Entry type not specified.'), 'danger');
			return $this->redirect(array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'index'));
		}
		$entrytype = $this->Entrytype->find('first', array('conditions' => array('Entrytype.label' => $entrytypeLabel)));
		if (!$entrytype) {
			$this->Session->setFlash(__d('webzash', 'Entry type not found.'), 'danger');
			return $this->redirect(array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'index'));
		}
		$this->set('entrytype', $entrytype);
		
		/* Ledger selection */
		$ledgers = new LedgerTree();
		$ledgers->Group = &$this->Group;
		$ledgers->Ledger = &$this->Ledger;
		$ledgers->current_id = 1;
		$ledgers->restriction_bankcash = $entrytype['Entrytype']['restriction_bankcash'];
		$ledgers->build(0);
		$ledgers->toList($ledgers, 1);
		$ledgers_disabled = array();
		
		foreach ($ledgers->ledgerList as $row => $data) {
			if ($row < 0) {
				$ledgers_disabled[] = $row;
			}
		}
		$this->set('ledger_options', $ledgers->ledgerList);
		$this->set('ledgers_disabled', $ledgers_disabled);
		
		/* Stock Code list */
				
		$this->loadModel('Inventory.Item');
		$this->Item->recursive = -1;
		$Items = $this->Item->find('all');
		
		$sc = array(0 => '(None)');
		foreach ($Items as $id => $rawtag) {
			$sc[$rawtag['Item']['id']] = h($rawtag['Item']['name']);
		}
		
		$this->set('Items', $sc);
		//print_r($entrytype['Entrytype']['id']);exit();

		/* Client list */
				
		$this->loadModel('Inventory.Client');
		$clients = $this->Client->find('all');
		
		$arrcli = array(0 => '(None)');
		foreach ($clients as $id => $rawtag) {
			$arrcli[$rawtag['Client']['id']] = h($rawtag['Client']['name']);
		}
		
		$this->set('clients', $arrcli);
		
		
		/* Bill list */		
		$this->loadModel('Inventory.Billdetail');
		$billNo = $this->Billdetail->find('all', array('fields' => array('max( `billNo` )')));
		//print_r($billNo);exit();
		$this->set('billNo', $billNo[0][0]['max( `billNo` )']);

		/* On POST */
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {

				/***************************************************************************/
				/*********************************** ENTRY *********************************/
				/***************************************************************************/

				$entrydata = null;

				/* Entry id */
				unset($this->request->data['Entry']['id']);
				
				/* Entry set up */
				$py='';
				foreach($this->request->data['Bill'] as $val){
					$py.=$val['payment_type'].';';
				}
				$this->request->data['Billdetail']['payment_type']=$py;
				
				$balancedata = array();
				$item_count=false;
				foreach($this->request->data['Balance'] as $key => $entryitem){
					if(!$item_count && !empty($this->request->data['Stockentryitem'][$key]['item_id'])){
						$item_count=true;		
					}
					
					if($entrytype['Entrytype']['id']==1 && !empty($this->request->data['Stockentryitem'][$key]['item_id']) && empty($entryitem['value'])){
						$this->request->data['Balance'][$key]['value']=$this->request->data['Balance'][$key]['value'];
						$this->Session->setFlash(__d('webzash', 'Enough items not in the stores.'), 'danger');
						return ;		
					}else{
						if($entrytype['Entrytype']['id']==1 && $this->request->data['Stockentryitem'][$key]['item_id']>0){
							$balancedata[] = array(
								'Balance' => array(
									'value' => $entryitem['value']-$this->request->data['Stockentryitem'][$key]['amount'],
									'item_id' => $this->request->data['Stockentryitem'][$key]['item_id'],
									'id' => $entryitem['id'],
								)
							);
						}elseif($this->request->data['Stockentryitem'][$key]['item_id']>0){
							$balancedata[] = array(
								'Balance' => array(
									'value' => $entryitem['value']+$this->request->data['Stockentryitem'][$key]['amount'],
									'item_id' => $this->request->data['Stockentryitem'][$key]['item_id'],
									'id' => $entryitem['id'],
								)
							);	
					}
					}
				}
				//print_r($balancedata);exit();
				
				if(!$item_count){
					$this->Session->setFlash(__d('webzash', 'You must fill out at least one split line.'), 'danger');
					return ;		
				}
				//print_r($this->request->data);exit();
				$this->request->data['Entry']['tag_id']=0;
				if($entrytype['Entrytype']['id']==1){
					for($j=0;$j<count($this->request->data['Entryitem']);$j=$j+2){					
						$this->request->data['Entryitem'][$j+1]['dc']='C';
						$this->request->data['Entryitem'][$j+1]['cr_amount']=$this->request->data['Entryitem'][$j]['total'];
	
						
						$this->request->data['Entryitem'][$j]['dc']='D';
						$this->request->data['Entryitem'][$j]['dr_amount']=$this->request->data['Entryitem'][$j]['total'];
					}
					
				}elseif($entrytype['Entrytype']['id']==2){
					for($j=0;$j<count($this->request->data['Entryitem']);$j=$j+2){
						$this->request->data['Entryitem'][$j]['dc']='D';
						$this->request->data['Entryitem'][$j]['dr_amount']=$this->request->data['Entryitem'][$j]['total'];
						
						$this->request->data['Entryitem'][$j+1]['dc']='C';
						$this->request->data['Entryitem'][$j+1]['cr_amount']=$this->request->data['Entryitem'][$j]['total'];
						
						
					}
				}
				
				$this->request->data['Billdetail']['description']=$this->request->data['Entry']['narration'];
				$this->request->data['Billdetail']['date']=dateToSql($this->request->data['Entry']['date']);
				$this->request->data['Billdetail']['billType']=$entrytype['Entrytype']['id'];
				//$this->request->data['Stockentryitem']['entrytype_id']=$entrytype['Entrytype']['id'];
				
				//print_r($this->request->data);exit();
				

				/****** Check entry type *****/
				$entrydata['Entry']['entrytype_id'] = $entrytype['Entrytype']['id'];
				
				
				/***** Check and update entry number ******/
				if ($entrytype['Entrytype']['numbering'] == 1) {
					/* Auto */
					if (empty($this->request->data['Entry']['number'])) {
						$entrydata['Entry']['number'] = $this->Entry->nextNumber($entrytype['Entrytype']['id']);
					} else {
						$entrydata['Entry']['number'] = $this->request->data['Entry']['number'];
					}
				} else if ($entrytype['Entrytype']['numbering'] == 2) {
					/* Manual + Required */
					if (empty($this->request->data['Entry']['number'])) {
						$this->Session->setFlash(__d('webzash', 'Entry number cannot be empty.'), 'danger');
						return;
					} else {
						$entrydata['Entry']['number'] = $this->request->data['Entry']['number'];
					}
				} else {
					/* Manual + Optional */
					$entrydata['Entry']['number'] = $this->request->data['Entry']['number'];
				}
				
				/****** Check tag ******/
				if (empty($this->request->data['Entry']['tag_id'])) {
					$entrydata['Entry']['tag_id'] = null;
				} else {
					$entrydata['Entry']['tag_id'] = $this->request->data['Entry']['tag_id'];
				}

				/***** Narration *****/
				$entrydata['Entry']['narration'] = $this->request->data['Entry']['narration'];

				/***** Date *****/
				$entrydata['Entry']['date'] = dateToSql($this->request->data['Entry']['date']);
				
				

				/***************************************************************************/
				/***************************** ENTRY ITEMS *********************************/
				/***************************************************************************/

				/* Check ledger restriction */
				$dc_valid = false;
				foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
					if ($entryitem['ledger_id'] <= 0) {
						continue;
					}
					$ledger = $this->Ledger->findById($entryitem['ledger_id']);
					if (!$ledger) {
						$this->Session->setFlash(__d('webzash', 'Invalid ledger selected.'), 'danger');
						return;
					}

				}

				$dr_total = 0;
				$cr_total = 0;

				/* Check equality of debit and credit total */
				foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
					if ($entryitem['ledger_id'] <= 0) {
						continue;
					}

					if ($entryitem['dc'] == 'D') {
						if ($entryitem['dr_amount'] <= 0) {
							$this->Session->setFlash(__d('webzash', 'Invalid amount specified.'), 'danger');
							return;
						}
						$dr_total = calculate($dr_total, $entryitem['dr_amount'], '+');
						
					} else if ($entryitem['dc'] == 'C') {
						if ($entryitem['cr_amount'] <= 0) {
							$this->Session->setFlash(__d('webzash', 'Invalid amount specified.'), 'danger');
							return;
						}
						$cr_total = calculate($cr_total, $entryitem['cr_amount'], '+');
					} else {
						$this->Session->setFlash(__d('webzash', 'Invalid Dr/Cr option selected.'), 'danger');
						return;
					}
				}
				if (calculate($dr_total, $cr_total, '!=')) {
					$this->Session->setFlash(__d('webzash', 'Debit and Credit total do not match.'), 'danger');
					return;
				}
				//print_r($dr_total);exit();
				$entrydata['Entry']['dr_total'] = $dr_total;
				$entrydata['Entry']['cr_total'] = $cr_total;

				/* Add item to entryitemdata array if everything is ok */
				$entryitemdata = array();
				foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
					if ($entryitem['ledger_id'] <= 0) {
						continue;
					}
					if ($entryitem['dc'] == 'D') {
						$entryitemdata[] = array(
							'Entryitem' => array(
								'dc' => $entryitem['dc'],
								'ledger_id' => $entryitem['ledger_id'],
								'amount' => $entryitem['dr_amount'],
							)
						);
					} else {
						$entryitemdata[] = array(
							'Entryitem' => array(
								'dc' => $entryitem['dc'],
								'ledger_id' => $entryitem['ledger_id'],
								'amount' => $entryitem['cr_amount'],
							)
						);
					}
				}
				$stockitemdata = array();
				foreach($this->request->data['Stockentryitem'] as $entryitem){
					if(!empty($entryitem['item_id'])){
						$stockitemdata[] = array(
							'Stockentryitem' => array(
								'item_id' => $entryitem['item_id'],
								'amount' => $entryitem['amount'],
								'entrytype_id' => $entryitem['entrytype_id'],
								'created' => $entryitem['created'],
								'billNo' => $entryitem['billNo'],
								'rate' => $entryitem['rate'],
							)
						);
					}
				}
				//print_r($this->request->data);exit();
				$this->loadModel('Inventory.Entry');
				$this->loadModel('Inventory.Entryitem');
				/* Save entry */
				$ds = $this->Entry->getDataSource();
				$ds->begin();
				
				$this->Entry->create();
				if ($this->Entry->save($entrydata)) {
					/* Save entry items */
					foreach ($entryitemdata as $row => $itemdata) {
						$itemdata['Entryitem']['entry_id'] = $this->Entry->id;
						$this->Entryitem->create();
						if (!$this->Entryitem->save($itemdata)) {
							$ds->rollback();
							$this->Session->setFlash(__d('webzash', 'Failed to save entry ledgers.'), 'danger');
							return;
						}
					}
					//print_r($entrydata);exit();
					$this->loadModel('Inventory.Billdetail');
					$this->loadModel('Inventory.Stockentryitem');
					$this->loadModel('Inventory.Balance');
					if (!$this->Billdetail->save($this->request->data)){
						$ds->rollback();
						$this->Session->setFlash(__d('webzash', 'Failed to save details.'), 'danger');
						return;
					}
					/* Save Stock entry items */
					foreach ($stockitemdata as $row => $itemdata) {
						$this->Stockentryitem->create();
						if (!$this->Stockentryitem->save($itemdata)) {
							$ds->rollback();
							$this->Session->setFlash(__d('webzash', 'Failed to save Stock items.'), 'danger');
							return;
						}
					}
					
					/* Save item balance */
					foreach ($balancedata as $row => $itemdata) {						
						if (!$this->Balance->save($itemdata)) {
							$ds->rollback();
							$this->Session->setFlash(__d('webzash', 'Failed to save item balance.'), 'danger');
							return;
						}
					}
					$tempentry = $this->Entry->read(null, $this->Entry->id);
					if (!$tempentry) {
						$this->Session->setFlash(__d('webzash', 'Oh snap ! Failed to create entry. Please, try again.'), 'danger');
						$ds->rollback();
						return;
					}
					$entryNumber = h(toEntryNumber(
						$tempentry['Entry']['number'],
						$entrytype['Entrytype']['id']
					));

					//$this->Log->add('Added ' . $entrytype['Entrytype']['name'] . ' entry numbered ' . $entryNumber, 1);
					$ds->commit();

					$this->Session->setFlash(__d('webzash',
						'%s entry numbered "%s" created.',
						$entrytype['Entrytype']['name'],
						$entryNumber), 'success');

					return $this->redirect(array('plugin' => 'inventory', 'controller' => 'categories', 'action' => 'index'));
				} else {
					$ds->rollback();
					$this->Session->setFlash(__d('webzash', 'Failed to create entry. Please, try again.'), 'danger');
					return;
				}
			} else {
				$this->Session->setFlash(__d('webzash', 'No data. Please, try again.'), 'danger');
				return;
			}
		}
	}
		public function pstock() {
			//$this->loadModel('Salesregister');
			$this->set('title_for_layout', __d('webzash', 'Stock Balance'));
			$date=date('Y-m-d H:i:s');
			$whereappend="";
			if ($this->request->is('post')) {
				if(!empty($this->request->data['Report']['enddate'])){
					$date=date('Y-m-d',strtotime($this->request->data['Report']['enddate']));
				}
				if(!empty($this->request->data['Report']['client_id'])){
					$whereappend.='AND stockentryitems.billNo in( select billNo From billdetails where client_id LIKE "%'. $this->request->data['Report']['client_id'].'%")';
				}
				if(!empty($this->request->data['Report']['catogery_id'])){
					$whereappend.=' AND Stockcode.category_id ='. $this->request->data['Report']['catogery_id'].'';
				}
			}
			
			
			$this->loadModel('Inventory.Stockentryitem');

			$this->set('sales_results',$this->Stockentryitem->query('SELECT Stockcode.name,sum(stockentryitems.amount),sum(stockentryitems .amount*stockentryitems .rate) as val,stockentryitems.`entrytype_id`
			 FROM stockentryitems as stockentryitems Left Join items as Stockcode on (Stockcode .id=`stockentryitems`.item_id) 
			 Left Join billdetails as Billdetail on (Billdetail.billNo=`stockentryitems`.billNo)
			WHERE `stockentryitems`.`created` < "'.$date.'" AND stockentryitems.`entrytype_id`=1 '.$whereappend.'
			 group by stockentryitems.item_id'));
			
			$this->set('purchase_results',$this->Stockentryitem->query('SELECT Stockcode.name,sum(stockentryitems.amount),sum(stockentryitems.amount*stockentryitems.rate) as val,stockentryitems.`entrytype_id` FROM stockentryitems as stockentryitems Left Join items as Stockcode on (Stockcode .id=`stockentryitems`.item_id) WHERE `stockentryitems`.`created` < "'.$date.'" AND stockentryitems.`entrytype_id`=2 '.$whereappend.' group by stockentryitems.item_id'));
			$this->loadModel('Inventory.Category');
			$categories = $this->Category->find('list');
			$this->set(compact('categories'));
			
			$this->loadModel('Inventory.Client');
			$clients = $this->Client->find('list');
			$this->set(compact('clients'));
	}
	public function bill($id = null) {
		$billNo=$id;
		if ($this->request->is('post')) {
				$billNo=$this->request->data['Report']['billNo'];
		}
		$this->set('billNo',$billNo);
				$this->loadModel('Inventory.Stockentryitem');
	
				$this->set('results',$this->Stockentryitem->query('SELECT * FROM stockentryitems Left Join items as Stockcode on (Stockcode.id=`stockentryitems`.item_id) Left Join billdetails as Billdetail on (Billdetail .billNo=`stockentryitems`.billNo) WHERE `stockentryitems`.`billNo` = "'.$billNo.'"'));

		
		//$this->loadModel('Stockcode');
		//$this->set('stockcodes',$this->Stockcode->find('list'));
		/* Print report */
		if (isset($this->passedArgs['print'])) {
			$this->layout = 'Webzash.print';
			$view = new View($this, false);
			$response =  $view->render('Billdetails/print/bill');
			$this->response->body($response);
			return $this->response;
		}
	}
	public function feed($entrytypeLabel = null){
		$entrytype = $this->Entrytype->find('first', array('conditions' => array('Entrytype.label' => $entrytypeLabel)));
		if (!$entrytype) {
			$this->Session->setFlash(__d('webzash', 'Entry type not found.'), 'danger');
			return ;
		}
		
		$date='';
		if ($this->request->is('post')) {
				$date=$this->request->data['Billdetails']['date'];
				$this->loadModel('Inventory.Feed');
				$feeddata = $this->Feed->find('first', array('conditions' => array('Feed.date' => $date)));
				if ($feeddata) {
					$this->Session->setFlash(__d('webzash', 'Selected Date already Feed.'), 'danger');
					return ;
				}
		}
		if(!empty($date)){
		$this->loadModel('Inventory.Entry');
		$this->set('entrydata',$this->Entry->query('SELECT max(`id`) as id, max(`tag_id`) as tag_id, `entrytype_id`, max(`number`) as number, `date`, sum(`dr_total`) as dr_total, sum(`cr_total`) as cr_total, max(`narration`) as narration FROM `entries` as Entry where Entry.date="'.$date.'" and Entry.`entrytype_id`='.$entrytype['Entrytype']['id'].' group by Entry.date'));
		$this->set('entryitemdata',$this->Entry->query('select `ledger_id`,dc,sum(amount) as amount from entryitems where entry_id in (SELECT id FROM `entries` as Entry where Entry.date="'.$date.'" and Entry.`entrytype_id`='.$entrytype['Entrytype']['id'].') group by `ledger_id`,dc'));
		}
		
		$this->set('entrytypeLabel',$entrytypeLabel);
		
	}

	/**
 * add method
 *
 * @param string $entrytypeLabel
 * @return void
 */
	public function acc($entrytypeLabel = null) {
		$this->loadModel('Webzash.Entry');
		$this->loadModel('Webzash.Entryitem');
		/* Check for valid entry type */
		if (!$entrytypeLabel) {
			$this->Session->setFlash(__d('webzash', 'Entry type not specified.'), 'danger');
			return $this->redirect(array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'index'));
		}
		$entrytype = $this->Entrytype->find('first', array('conditions' => array('Entrytype.label' => $entrytypeLabel)));
		if (!$entrytype) {
			$this->Session->setFlash(__d('webzash', 'Entry type not found.'), 'danger');
			return $this->redirect(array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'index'));
		}
		$this->set('entrytype', $entrytype);

		$this->set('title_for_layout', __d('webzash', 'Add %s Entry', $entrytype['Entrytype']['name']));

		$this->set('tag_options', $this->Tag->listAll());

		/* Ledger selection */
		$ledgers = new LedgerTree();
		$ledgers->Group = &$this->Group;
		$ledgers->Ledger = &$this->Ledger;
		$ledgers->current_id = -1;
		$ledgers->restriction_bankcash = $entrytype['Entrytype']['restriction_bankcash'];
		$ledgers->build(0);
		$ledgers->toList($ledgers, -1);
		$ledgers_disabled = array();
		foreach ($ledgers->ledgerList as $row => $data) {
			if ($row < 0) {
				$ledgers_disabled[] = $row;
			}
		}
		$this->set('ledger_options', $ledgers->ledgerList);
		$this->set('ledgers_disabled', $ledgers_disabled);

		/* Initial data */
		if ($this->request->is('post')) {
			$curEntryitems = array();
			foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
				$curEntryitems[$row] = array(
					'dc' => $entryitem['dc'],
					'ledger_id' => $entryitem['ledger_id'],
					'dr_amount' => isset($entryitem['dr_amount']) ? $entryitem['dr_amount'] : '',
					'cr_amount' => isset($entryitem['cr_amount']) ? $entryitem['cr_amount'] : '',
				);
			}
			$this->set('curEntryitems', $curEntryitems);
		} else {
			$curEntryitems = array();
			if ($entrytype['Entrytype']['restriction_bankcash'] == 3) {
				/* Special case if atleast one Bank or Cash on credit side (3) then 1st item is Cr */
				$curEntryitems[0] = array('dc' => 'C');
				$curEntryitems[1] = array('dc' => 'D');
			} else {
				/* Otherwise 1st item is Dr */
				$curEntryitems[0] = array('dc' => 'D');
				$curEntryitems[1] = array('dc' => 'C');
			}
			$curEntryitems[2] = array('dc' => 'D');
			$curEntryitems[3] = array('dc' => 'D');
			$curEntryitems[4] = array('dc' => 'D');
			$this->set('curEntryitems', $curEntryitems);
		}

		/* On POST */
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {

				/***************************************************************************/
				/*********************************** ENTRY *********************************/
				/***************************************************************************/

				$entrydata = null;

				/* Entry id */
				unset($this->request->data['Entry']['id']);

				/***** Check and update entry number ******/
				if ($entrytype['Entrytype']['numbering'] == 1) {
					/* Auto */
					if (empty($this->request->data['Entry']['number'])) {
						$entrydata['Entry']['number'] = $this->Entry->nextNumber($entrytype['Entrytype']['id']);
					} else {
						$entrydata['Entry']['number'] = $this->request->data['Entry']['number'];
					}
				} else if ($entrytype['Entrytype']['numbering'] == 2) {
					/* Manual + Required */
					if (empty($this->request->data['Entry']['number'])) {
						$this->Session->setFlash(__d('webzash', 'Entry number cannot be empty.'), 'danger');
						return;
					} else {
						$entrydata['Entry']['number'] = $this->request->data['Entry']['number'];
					}
				} else {
					/* Manual + Optional */
					$entrydata['Entry']['number'] = $this->request->data['Entry']['number'];
				}

				/****** Check entry type *****/
				$entrydata['Entry']['entrytype_id'] = $entrytype['Entrytype']['id'];
				
				
				/****** Feed Data *****/
				$feed['Feed']['entrytype']=$entrytype['Entrytype']['id'];
				$feed['Feed']['date']=dateToSql($this->request->data['Entry']['date']);

				/****** Check tag ******/
				if (empty($this->request->data['Entry']['tag_id'])) {
					$entrydata['Entry']['tag_id'] = null;
				} else {
					$entrydata['Entry']['tag_id'] = $this->request->data['Entry']['tag_id'];
				}

				/***** Narration *****/
				$entrydata['Entry']['narration'] = $this->request->data['Entry']['narration'];

				/***** Date *****/
				$entrydata['Entry']['date'] = dateToSql($this->request->data['Entry']['date']);

				/***************************************************************************/
				/***************************** ENTRY ITEMS *********************************/
				/***************************************************************************/

				/* Check ledger restriction */
				$dc_valid = false;
				foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
					if ($entryitem['ledger_id'] <= 0) {
						continue;
					}
					$ledger = $this->Ledger->findById($entryitem['ledger_id']);
					if (!$ledger) {
						$this->Session->setFlash(__d('webzash', 'Invalid ledger selected.'), 'danger');
						return;
					}

					if ($entrytype['Entrytype']['restriction_bankcash'] == 4) {
						if ($ledger['Ledger']['type'] != 1) {
							$this->Session->setFlash(__d('webzash', 'Only bank or cash ledgers are allowed for this entry type.'), 'danger');
							return;
						}
					}
					if ($entrytype['Entrytype']['restriction_bankcash'] == 5) {
						if ($ledger['Ledger']['type'] == 1) {
							$this->Session->setFlash(__d('webzash', 'Bank or cash ledgers are not allowed for this entry type.'), 'danger');
							return;
						}
					}

					if ($entryitem['dc'] == 'D') {
						if ($entrytype['Entrytype']['restriction_bankcash'] == 2) {
							if ($ledger['Ledger']['type'] == 1) {
								$dc_valid = true;
							}
						}
					} else if ($entryitem['dc'] == 'C') {
						if ($entrytype['Entrytype']['restriction_bankcash'] == 3) {
							if ($ledger['Ledger']['type'] == 1) {
								$dc_valid = true;
							}
						}
					}
				}
				if ($entrytype['Entrytype']['restriction_bankcash'] == 2) {
					if (!$dc_valid) {
						$this->Session->setFlash(__d('webzash', 'Atleast one bank or cash ledger has to be on debit side for this entry type.'), 'danger');
						return;
					}
				}
				if ($entrytype['Entrytype']['restriction_bankcash'] == 3) {
					if (!$dc_valid) {
						$this->Session->setFlash(__d('webzash', 'Atleast one bank or cash ledger has to be on credit side for this entry type.'), 'danger');
						return;
					}
				}

				$dr_total = 0;
				$cr_total = 0;

				/* Check equality of debit and credit total */
				foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
					if ($entryitem['ledger_id'] <= 0) {
						continue;
					}

					if ($entryitem['dc'] == 'D') {
						if ($entryitem['dr_amount'] <= 0) {
							$this->Session->setFlash(__d('webzash', 'Invalid amount specified.'), 'danger');
							return;
						}
						$dr_total = calculate($dr_total, $entryitem['dr_amount'], '+');
					} else if ($entryitem['dc'] == 'C') {
						if ($entryitem['cr_amount'] <= 0) {
							$this->Session->setFlash(__d('webzash', 'Invalid amount specified.'), 'danger');
							return;
						}
						$cr_total = calculate($cr_total, $entryitem['cr_amount'], '+');
					} else {
						$this->Session->setFlash(__d('webzash', 'Invalid Dr/Cr option selected.'), 'danger');
						return;
					}
				}
				if (calculate($dr_total, $cr_total, '!=')) {
					$this->Session->setFlash(__d('webzash', 'Debit and Credit total do not match.'), 'danger');
					return;
				}

				$entrydata['Entry']['dr_total'] = $dr_total;
				$entrydata['Entry']['cr_total'] = $cr_total;

				/* Add item to entryitemdata array if everything is ok */
				$entryitemdata = array();
				foreach ($this->request->data['Entryitem'] as $row => $entryitem) {
					if ($entryitem['ledger_id'] <= 0) {
						continue;
					}
					if ($entryitem['dc'] == 'D') {
						$entryitemdata[] = array(
							'Entryitem' => array(
								'dc' => $entryitem['dc'],
								'ledger_id' => $entryitem['ledger_id'],
								'amount' => $entryitem['dr_amount'],
							)
						);
					} else {
						$entryitemdata[] = array(
							'Entryitem' => array(
								'dc' => $entryitem['dc'],
								'ledger_id' => $entryitem['ledger_id'],
								'amount' => $entryitem['cr_amount'],
							)
						);
					}
				}
//print_r($entrydata);exit();
				/* Save entry */
				$ds = $this->Entry->getDataSource();
				$ds->begin();
//print_r($ds);exit();
				$this->Entry->create();
				if ($this->Entry->save($entrydata)) {
					/* Save entry items */
					foreach ($entryitemdata as $row => $itemdata) {
						$itemdata['Entryitem']['entry_id'] = $this->Entry->id;
						$this->Entryitem->create();
						if (!$this->Entryitem->save($itemdata)) {
							$ds->rollback();
							$this->Session->setFlash(__d('webzash', 'Failed to save entry ledgers.'), 'danger');
							return;
						}
					}

					$tempentry = $this->Entry->read(null, $this->Entry->id);
					if (!$tempentry) {
						$this->Session->setFlash(__d('webzash', 'Oh snap ! Failed to create entry. Please, try again.'), 'danger');
						$ds->rollback();
						return;
					}
					$entryNumber = h(toEntryNumber(
						$tempentry['Entry']['number'],
						$entrytype['Entrytype']['id']
					));

					$this->Log->add('Added ' . $entrytype['Entrytype']['name'] . ' entry numbered ' . $entryNumber, 1);
					
					/***** Feed update ******/
					$this->loadModel('Inventory.Feed');
					
					if(!$this->Feed->save($feed)){
						$ds->rollback();
						$this->Session->setFlash(__d('webzash', 'Failed to save feed.'), 'danger');
						return;	
					}
					
					
					$ds->commit();

					$this->Session->setFlash(__d('webzash',
						'%s entry numbered "%s" created.',
						$entrytype['Entrytype']['name'],
						$entryNumber), 'success');

					return $this->redirect(array('plugin' => 'webzash', 'controller' => 'entries', 'action' => 'index'));
				} else {
					$ds->rollback();
					$this->Session->setFlash(__d('webzash', 'Failed to create entry. Please, try again.'), 'danger');
					return;
				}
			} else {
				$this->Session->setFlash(__d('webzash', 'No data. Please, try again.'), 'danger');
				return;
			}
		}
	}
	public function beforeFilter() {
		parent::beforeFilter();

		/* Skip the ajax/javascript fields from Security component to prevent request being blackholed */

		$this->Security->unlockedActions = array('acc','add');
	}

}
