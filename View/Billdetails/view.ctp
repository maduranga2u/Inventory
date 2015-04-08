<?php 
/**
 * The MIT License (MIT)
 *
 * Webzash - Easy to use web based double entry accounting software
 *
 * Copyright (c) 2014 Prashant Shah <pshah.mumbai@gmail.com>
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
<div class="billdetails view">
<h2><?php echo __('Billdetail'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BillNo'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['billNo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('BillType'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['billType']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Date'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cheque'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['cheque']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Payment Type'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['payment_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Card Type'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['card_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Card No'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['card_no']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Card Name'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['card_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Currency Name'); ?></dt>
		<dd>
			<?php echo h($billdetail['Billdetail']['currency_name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Billdetail'), array('action' => 'edit', $billdetail['Billdetail']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Billdetail'), array('action' => 'delete', $billdetail['Billdetail']['id']), array(), __('Are you sure you want to delete # %s?', $billdetail['Billdetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Billdetails'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Billdetail'), array('action' => 'add')); ?> </li>
	</ul>
</div>
