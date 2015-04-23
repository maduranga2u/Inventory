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
<script type="text/javascript">
$(document).ready(function() {

	$("#accordion").accordion({
		collapsible: true,
		active: false
	});

	/* Calculate date range in javascript */
	startDate = new Date(<?php echo strtotime(Configure::read('Account.startdate')) * 1000; ?>  + (new Date().getTimezoneOffset() * 60 * 1000));
	endDate = new Date(<?php echo strtotime(Configure::read('Account.enddate')) * 1000; ?>  + (new Date().getTimezoneOffset() * 60 * 1000));

	/* Setup jQuery datepicker ui */
	$('#ReportStartdate').datepicker({
		minDate: startDate,
		maxDate: endDate,
		dateFormat: '<?php echo Configure::read('Account.dateformatJS'); ?>',
		numberOfMonths: 1,
		onClose: function(selectedDate) {
			if (selectedDate) {
				$("#ReportEnddate").datepicker("option", "minDate", selectedDate);
			} else {
				$("#ReportEnddate").datepicker("option", "minDate", startDate);
			}
		}
	});
	$('#ReportEnddate').datepicker({
		minDate: startDate,
		maxDate: endDate,
		dateFormat: '<?php echo Configure::read('Account.dateformatJS'); ?>',
		numberOfMonths: 1,
		onClose: function(selectedDate) {
			if (selectedDate) {
				$("#ReportStartdate").datepicker("option", "maxDate", selectedDate);
			} else {
				$("#ReportStartdate").datepicker("option", "maxDate", endDate);
			}
		}
	});

	$('.recdate').datepicker({
		minDate: startDate,
		maxDate: endDate,
		dateFormat: '<?php echo Configure::read('Account.dateformatJS'); ?>',
		numberOfMonths: 1,
	});
});
</script>
<div class="reconciliation form">
	<?php
		echo $this->Form->create('Report', array(
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		//echo $this->Form->input('ledger_id', array('type' => 'select', 'options' => $ledgers, 'label' => __d('webzash', 'Ledger account')));

		echo '<div id="accordion">';
		echo '<h3>Options</h3>';
		echo '<div>';

		//echo $this->Form->input('showall', array('type' => 'checkbox', 'label' => __d('webzash', 'Show all entries'), 'class' => 'checkbox'));
		echo $this->Form->input('catogery_id', array('label' => __d('webzash', 'Catogery'),'options' => $categories));
		echo $this->Form->input('client_id', array('label' => __d('webzash', 'Client'),'options' => $clients));
		echo $this->Form->input('enddate', array('label' => __d('webzash', 'End date')));
		echo '</div>';
		echo '</div>';
		echo '<br />';

		echo $this->Form->hidden('submitledger', array('value' => '1'));
		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Clear'), array('plugin' => 'webzash', 'controller' => 'reports', 'action' => 'pstock'), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
<?php
//print_r($sales_results);exit(); 
echo '<table class="stripped">';
echo '<th>' . __d('webzash', 'Product Name') . '</th>';
echo '<th>' . __d('webzash', 'Purchase Quantity') . '</th>';
echo '<th>' . __d('webzash', 'Sales Quantity') . '</th>';
echo '<th>' . __d('webzash', 'Balance') . '</th>';
echo '<th>' . __d('webzash', 'Purchase Amount') . '</th>';
echo '<th>' . __d('webzash', 'Sales Amount') . '</th>';
echo '<th>' . __d('webzash', 'Margin') . '</th>';

foreach ($purchase_results as $p):
	$set=0;
	foreach ($sales_results as $s):
		if($p['Stockcode']["name"]==$s['Stockcode']["name"]){
			echo '<tr>';
			echo '<td>'.$s['Stockcode']['name'].'</td>';
			echo '<td>'.$p[0]['sum(stockentryitems.amount)'].'</td>';
			echo '<td>'.$s[0]['sum(stockentryitems.amount)'].'</td>';
			echo '<td>'.($p[0]['sum(stockentryitems.amount)'] - $s[0]['sum(stockentryitems.amount)']).'</td>';
			echo '<td>'.$p[0]['val'].'</td>';
			echo '<td>'.$s[0]['val'].'</td>';
			echo '<td>'.($p[0]['val'] - $s[0]['val']).'</td>';
			echo '</tr>';
			$set=1;
			break;
		}
	endforeach;
	if($set==0){
		echo '<tr>';
		echo '<td>'.$p['Stockcode']['name'].'</td>';
		echo '<td>'.$p[0]['sum(stockentryitems.amount)'].'</td>';
		echo '<td>0</td>';
		echo '<td>'.$p[0]['sum(stockentryitems.amount)'].'</td>';
		echo '<td>'.$p[0]['val'].'</td>';
		echo '<td>0</td>';
		echo '<td>'.($p[0]['val'] - 0).'</td>';
		echo '</tr>';
	}
endforeach;
if(count($purchase_results)< count($sales_results)){
	foreach ($sales_results as $s):
		
			echo '<tr>';
			echo '<td>'.$s['Stockcode']['NAME'].'</td>';
			echo '<td>0</td>';
			echo '<td>'.$s[0]['sum(stockentryitems .amount)'].'</td>';
			echo '<td>'.(- $s[0]['sum(stockentryitems .amount)']).'</td>';
			echo '<td>0</td>';
			echo '<td>'.$s[0]['val'].'</td>';
			echo '<td>'.(0 - $s[0]['val']).'</td>';
			echo '</tr>';
	endforeach;
}
echo '</table>';