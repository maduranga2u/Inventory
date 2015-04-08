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
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 */
class ClientsController extends InventoryAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->set('title_for_layout', __d('webzash', 'List Of Vendors/Customers'));
		$this->Client->recursive = 0;
		$this->set('clients', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'),'danger');
		}
		$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
		$this->set('client', $this->Client->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Client->create();
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__d('webzash','The client has been created.'), 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'),'danger');
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Client->exists($id)) {
			throw new NotFoundException(__('Invalid client'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Client->save($this->request->data)) {
				$this->Session->setFlash(__d('webzash','The client has been created.'), 'success');
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client could not be saved. Please, try again.'),'danger');
			}
		} else {
			$options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
			$this->request->data = $this->Client->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Client->id = $id;
		if (!$this->Client->exists()) {
			throw new NotFoundException(__('Invalid client'),'danger');
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Client->delete()) {
			$this->Session->setFlash(__d('webzash','The client has been deleted.'), 'success');
		} else {
			$this->Session->setFlash(__('The client could not be deleted. Please, try again.'),'danger');
		}
		return $this->redirect(array('action' => 'index'));
	}
}
