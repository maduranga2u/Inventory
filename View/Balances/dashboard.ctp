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
 ?>
<div class="row">
	<div class="col-md-4">
		<div class="panel panel-info">
			<div class="panel-heading"><?php echo __d('webzash', 'Account details'); ?></div>
			<div class="panel-body">
				<table>
					<tr>
						<td><?php echo __d('webzash', 'Name'); ?></td>
						<td><?php echo h(Configure::read('Account.name')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Email'); ?></td>
						<td><?php echo h(Configure::read('Account.email')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Role'); ?></td>
						<td><?php echo h($this->Session->read('ActiveAccount.account_role')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Currency'); ?></td>
						<td><?php echo h(Configure::read('Account.currency_symbol')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Financial Year'); ?></td>
						<td><?php echo dateFromSql(Configure::read('Account.startdate')) . ' to ' . dateFromSql(Configure::read('Account.enddate')); ?></td>
					</tr>
					<tr>
						<td><?php echo __d('webzash', 'Status'); ?></td>
						<?php
							if (Configure::read('Account.locked') == 0) {
								echo '<td>' . __d('webzash', 'Unlocked') . '</td>';
							} else {
								echo '<td class="error-text">' . __d('webzash', 'Locked') . '</td>';
							}
						?>
					</tr>
				</table>
			</div>
		</div>
		<div class="panel panel-info">
			<div class="panel-heading"><?php echo __d('webzash', 'Inventory details'); ?></div>
			<div class="panel-body">
				<table>
					<tr>
						<td><?php echo __d('webzash', 'Total Items'); ?></td>
						<td><?php echo $total_items; ?></td>
					</tr>
					
				</table>
			</div>
		</div>
		
	</div>
</div>