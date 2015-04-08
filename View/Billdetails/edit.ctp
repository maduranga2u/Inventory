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
<div class="billdetails form">
<?php echo $this->Form->create('Billdetail'); ?>
	<fieldset>
		<legend><?php echo __('Edit Billdetail'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('billNo');
		echo $this->Form->input('billType');
		echo $this->Form->input('date');
		echo $this->Form->input('description');
		echo $this->Form->input('cheque');
		echo $this->Form->input('payment_type');
		echo $this->Form->input('card_type');
		echo $this->Form->input('card_no');
		echo $this->Form->input('card_name');
		echo $this->Form->input('currency_name');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Billdetail.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Billdetail.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Billdetails'), array('action' => 'index')); ?></li>
	</ul>
</div>
