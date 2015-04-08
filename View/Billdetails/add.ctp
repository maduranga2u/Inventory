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
/* Add ledger row */
	$(document).on('click', '.addRow', function() {
		var x = document.getElementById("tr4").innerHTML;
		x=x.replace(/[[0]]/g,''+$('#count').val()+']');
		x=x.replace('_0',$('#count').val());
		$('#count').val(parseInt($('#count').val())+1);
		$('#entry-table').append('<tr>'+x+'</tr>');
	});
/* Add ledger row */
	$(document).on('click', '.addPay', function() {
		var x = document.getElementById("payment-tr").innerHTML;
		x=x.replace(/[[0]]/g,''+$('#pcount').val()+']');
		x=x.replace('_0',$('#pcount').val());
		n=parseInt($('#pcount').val())+1;
		x=x.replace(/[[1]]/g,''+n+']');
		x=x.replace('_1',n);
		$('#pcount').val(parseInt($('#pcount').val())+2);
		$('#payment-table').append('<tr>'+x+'</tr>');
	});
		

/* Setup jQuery datepicker ui */
	$('#EntryDate').datepicker({
		dateFormat: 'yy-mm-dd',
		numberOfMonths: 1,
		  onSelect: function(dateText) {
    		$("[id^=date]").val(dateText);
  		}
	});
});
function avCheck(obj){

		a=obj.id.replace('sel[','');
		a=a.replace(']','');
		$.ajax({
			url: '<?php echo $this->Html->url(array("controller" => "balances", "action" => "checkbalance")); ?>/'+obj.value,
			success: function(data) {
				//alert('#av'+a);
				arr=data.split('||');
				$('#av'+a).val(arr[0]);
				if(arr[1]!=0){
					$('#balid'+a).val(arr[1]);	
				}
			}
		});
		

}
</script>
<table>
  <tr id="tr4" style="display:none;">
<?php echo '<td>' . $this->Form->input('Stockentryitem.0.item_id', array('type' => 'select', 'options' => $Items, 'escape' => false,  'id'=>'sel[0]','onChange'=>'avCheck(this)','class' => 'ledger-dropdown form-control', 'label' => false, 'div' => array('class' => 'form-group-entryitem'))) . '</td>';
	echo '<td><div class="form-group-entryitem"><input type="text" id="av_0" class="dr-item form-control" name="data[Balance][0][value]"><input type="hidden" id="balid_0"  name="data[Balance][0][id]"></div> </td>';		
		echo '<td>' . $this->Form->input('Stockentryitem.0.amount', array('label' => false, 'class' => 'dr-item form-control', 'div' => array('class' => 'form-group-entryitem'))) .$this->Form->input('Stockentryitem.0.entrytype_id', array('type' => 'hidden','value'=>$entrytype['Entrytype']['id'])).$this->Form->input('Stockentryitem.0.created', array('type' => 'hidden','value'=>date('Y-m-d'),'id'=>'date0')).$this->Form->input('Stockentryitem.0.billNo', array('type' => 'hidden','value'=>$billNo+1)). '</td>';		
		echo '<td>' . $this->Form->input('Stockentryitem.0.rate', array('label' => false, 'class' => 'cr-item form-control', 'div' => array('class' => 'form-group-entryitem'))) . '</td>';
		echo '<td>';
		echo $this->Html->tag('span', $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-plus')) . __d('webzash', ' Add'), array('class' => 'addrow addRow', 'escape' => false));
		echo '</td>';          	
 ?>           
	</tr>
</table>

<table style="display:none;">
<?php
echo '<tr id="payment-tr">';		
		echo '<td>' . $this->Form->input('Bill.0.payment_type', array('type' => 'select', 'options' => array('Cash'=>'Cash','Bank'=>'Bank','Credit','Credit Card','Debit Card','Foreign Currency'), 'class' => 'dc-dropdown form-control', 'label' => false, 'div' => array('class' => 'form-group-entryitem'))) . '</td>';
		
		echo '<td>'.$this->Form->input('Entryitem.0.ledger_id', array('type' => 'select', 'options' => $ledger_options, 'escape' => false, 'disabled' => $ledgers_disabled, 'class' => 'ledger-dropdown form-control', 'label' =>false, 'div' => array('class' => 'form-group-entryitem'))).'</td>';		
		echo '<td>' . $this->Form->input('Entryitem.1.ledger_id', array('type' => 'select', 'options' => $ledger_options, 'escape' => false, 'disabled' => $ledgers_disabled, 'class' => 'ledger-dropdown form-control', 'label' => false, 'div' => array('class' => 'form-group-entryitem'))). '</td>';	
		echo '<td>' . $this->Form->input('Entryitem.0.total', array('label' => false, 'class' => 'cr-item form-control', 'div' => array('class' => 'form-group-entryitem'))) . '</td>';	
		echo '<td>';
		echo $this->Html->tag('span', $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-plus')) . __d('webzash', ' Add'), array('class' => 'addrow addPay', 'escape' => false));
		echo '</td>';
		echo '</tr>';
?>
</table>

<div class="entry add form">
<?php 
	echo $this->Form->create('Entry', array(
		'inputDefaults' => array(
			'div' => 'form-group',
			'wrapInput' => false,
			'class' => 'form-control',
		),
	));
		$lblBill='Bill NO';
		if($entrytype['Entrytype']['id']==2){
			$lblBill='Invoice NO';
		}
		$lblCust='Customer';
		if($entrytype['Entrytype']['id']==2){
			$lblCust='Vendor';
		}
		echo $this->Form->input('Billdetail.billNo',array('value'=>$billNo+1, 'label' =>$lblBill));
		echo $this->Form->input('number', array('type' => 'text', 'label' => __d('webzash', 'Entry Number'),'required'=>'required'));
		echo $this->Form->input('date', array('type' => 'text', 'label' => __d('webzash', 'Date'),'required'=>'required'));
		echo $this->Form->input('narration', array('type' => 'textarea', 'label' => __d('webzash', 'Narration'), 'rows' => '3'));
		echo $this->Form->input('Billdetail.client_id', array('type' => 'select', 'options' => $clients, 'escape' => false, 'class' => 'ledger-dropdown form-control', 'label' =>  __d('webzash', $lblCust), 'div' => array('class' => 'form-group-entryitem')));
		?>
	 <input type="hidden" id="pcount" value="2"/>
    <?php	
		
echo '<table class="stripped extra" id="payment-table">';

	/* Header */
	echo '<tr>';	
	echo '<th>' . __d('webzash', 'Payment Type') . '</th>';
	echo '<th>' . __d('webzash', 'Debit Ledger') . '</th>';
	echo '<th>' . __d('webzash', 'Credit Ledger') . '</th>';
	echo '<th>' . __d('webzash', 'Amount') . '</th>';
	echo '<th>' . __d('webzash', 'Action') . '</th>';
	echo '</tr>';

	/* Intial rows */
		echo '<tr>';		
		echo '<td>' . $this->Form->input('Bill.0.payment_type', array('type' => 'select', 'options' => array('Cash'=>'Cash','Bank'=>'Bank','Credit','Credit Card','Debit Card','Foreign Currency'), 'class' => 'dc-dropdown form-control', 'label' => false, 'div' => array('class' => 'form-group-entryitem'))) . '</td>';
		
		echo '<td>'.$this->Form->input('Entryitem.0.ledger_id', array('type' => 'select', 'options' => $ledger_options, 'escape' => false, 'disabled' => $ledgers_disabled, 'class' => 'ledger-dropdown form-control', 'label' =>false, 'div' => array('class' => 'form-group-entryitem'))).'</td>';		
		echo '<td>' . $this->Form->input('Entryitem.1.ledger_id', array('type' => 'select', 'options' => $ledger_options, 'escape' => false, 'disabled' => $ledgers_disabled, 'class' => 'ledger-dropdown form-control', 'label' => false, 'div' => array('class' => 'form-group-entryitem'))). '</td>';	
		echo '<td>' . $this->Form->input('Entryitem.0.total', array('label' => false,'required'=>'required', 'class' => 'cr-item form-control', 'div' => array('class' => 'form-group-entryitem'))) . '</td>';	
		echo '<td>';
		echo $this->Html->tag('span', $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-plus')) . __d('webzash', ' Add'), array('class' => 'addrow addPay', 'escape' => false));
		echo '</td>';
		echo '</tr>';

	echo '</table>';
	
	echo '<br/>';	
		
		
		
echo '<table class="stripped extra" id="entry-table">';

	/* Header */
	echo '<tr>';
	
	echo '<th>' . __d('webzash', 'Item') . '</th>';
	echo '<th>' . __d('webzash', 'Available') . '</th>';
	echo '<th>' . __d('webzash', 'Quantity') . '</th>';
	echo '<th>' . __d('webzash', 'Rate') . '</th>';
	echo '<th>' . __d('webzash', 'Actions') . '</th>';
	echo '</tr>';

	/* Intial rows */
	//$row=0;
	for($row=0;$row<5;$row++){
		echo '<tr>';		
		echo '<td>' . $this->Form->input('Stockentryitem.' . $row . '.item_id', array('type' => 'select', 'options' => $Items, 'escape' => false, 'id'=>'sel[' . $row . ']','onChange'=>'avCheck(this)', 'class' => 'ledger-dropdown form-control', 'label' => false, 'div' => array('class' => 'form-group-entryitem'))) . '</td>';
		echo '<td><div class="form-group-entryitem"><input type="text" id="av' . $row . '" class="dr-item form-control" name="data[Balance][' . $row . '][value]"><input type="hidden" id="balid' . $row . '"  name="data[Balance][' . $row . '][id]"></div> </td>';		
		echo '<td>' . $this->Form->input('Stockentryitem.' . $row . '.amount', array('label' => false, 'class' => 'dr-item form-control', 'div' => array('class' => 'form-group-entryitem'))) .$this->Form->input('Stockentryitem.' . $row . '.entrytype_id', array('type' => 'hidden','value'=>$entrytype['Entrytype']['id'])) .$this->Form->input('Stockentryitem.' . $row . '.created', array('type' => 'hidden','value'=>date('Y-m-d'),'id'=>'date'.$row)).$this->Form->input('Stockentryitem.' . $row . '.billNo', array('type' => 'hidden','value'=>$billNo+1)). '</td>';		
		echo '<td>' . $this->Form->input('Stockentryitem.' . $row . '.rate', array('label' => false, 'class' => 'cr-item form-control', 'div' => array('class' => 'form-group-entryitem'))) . '</td>';
		echo '<td>';
		echo $this->Html->tag('span', $this->Html->tag('i', '', array('class' => 'glyphicon glyphicon-plus')) . __d('webzash', ' Add'), array('class' => 'addrow addRow', 'escape' => false));
		echo '</td>';
		echo '</tr>';
	}
	echo '</table>';

	echo '<br /><input type="hidden" id="count" value="5"/>';	
   
   echo '<div class="form-group">';
	echo $this->Form->submit(__d('webzash', 'Submit'), array(
		'div' => false,
		'class' => 'btn btn-primary'
	));
	echo $this->Html->tag('span', '', array('class' => 'link-pad'));
	echo $this->Html->link(__d('webzash', 'Cancel'), array('plugin' => 'invoices', 'controller' => 'categories', 'action' => 'index'), array('class' => 'btn btn-default'));
	echo '</div>';

	echo $this->Form->end();
	
	?>
</div>