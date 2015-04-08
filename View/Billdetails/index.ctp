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
<div class="billdetails index">
	<h2><?php echo __('Billdetails'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('billNo'); ?></th>
			<th><?php echo $this->Paginator->sort('billType'); ?></th>
			<th><?php echo $this->Paginator->sort('date'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('cheque'); ?></th>
			<th><?php echo $this->Paginator->sort('payment_type'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th><?php echo $this->Paginator->sort('card_type'); ?></th>
			<th><?php echo $this->Paginator->sort('card_no'); ?></th>
			<th><?php echo $this->Paginator->sort('card_name'); ?></th>
			<th><?php echo $this->Paginator->sort('currency_name'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($billdetails as $billdetail): ?>
	<tr>
		<td><?php echo h($billdetail['Billdetail']['id']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['billNo']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['billType']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['date']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['description']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['cheque']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['payment_type']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['created']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['modified']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['card_type']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['card_no']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['card_name']); ?>&nbsp;</td>
		<td><?php echo h($billdetail['Billdetail']['currency_name']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $billdetail['Billdetail']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $billdetail['Billdetail']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $billdetail['Billdetail']['id']), array(), __('Are you sure you want to delete # %s?', $billdetail['Billdetail']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Billdetail'), array('action' => 'add')); ?></li>
	</ul>
</div>
