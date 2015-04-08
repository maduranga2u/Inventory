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
<div class="categories view">
<h2><?php echo __('Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($category['Category']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($category['Category']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($category['Category']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($category['Category']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Category'), array('action' => 'edit', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Category'), array('action' => 'delete', $category['Category']['id']), array(), __('Are you sure you want to delete # %s?', $category['Category']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Stockcodes'), array('controller' => 'stockcodes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Stockcode'), array('controller' => 'stockcodes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Stockcodes'); ?></h3>
	<?php if (!empty($category['Stockcode'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Size'); ?></th>
		<th><?php echo __('Unit'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Category Id'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($category['Stockcode'] as $stockcode): ?>
		<tr>
			<td><?php echo $stockcode['id']; ?></td>
			<td><?php echo $stockcode['name']; ?></td>
			<td><?php echo $stockcode['description']; ?></td>
			<td><?php echo $stockcode['size']; ?></td>
			<td><?php echo $stockcode['unit']; ?></td>
			<td><?php echo $stockcode['created']; ?></td>
			<td><?php echo $stockcode['modified']; ?></td>
			<td><?php echo $stockcode['category_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'stockcodes', 'action' => 'view', $stockcode['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'stockcodes', 'action' => 'edit', $stockcode['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'stockcodes', 'action' => 'delete', $stockcode['id']), array(), __('Are you sure you want to delete # %s?', $stockcode['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Stockcode'), array('controller' => 'stockcodes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
