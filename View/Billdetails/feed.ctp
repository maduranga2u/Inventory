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

	

	$('#FeedDate').datepicker({
		dateFormat: 'yy-mm-dd',
		numberOfMonths: 1,
	});
});
</script>
<div class="reconciliation form">
	<?php
		echo $this->Form->create('Billdetails', array(
			'inputDefaults' => array(
				'div' => 'form-group',
				'wrapInput' => false,
				'class' => 'form-control',
			),
		));

		

		echo '<div id="accordion">';
		echo '<h3>Options</h3>';
		echo '<div>';

		
		echo $this->Form->input('date', array('id'=>'FeedDate','label' => __d('webzash', 'End date')));
		echo '</div>';
		echo '</div>';
		echo '<br />';

		
		echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Submit'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Clear'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'feed',$entrytypeLabel), array('class' => 'btn btn-default'));
		echo '</div>';

		echo $this->Form->end();
	?>
</div>
<?php 
if(!empty($entrydata)){
echo $this->Form->create('Billdetails',  array('action' => 'acc/'.$entrytypeLabel));
//print_r($entryitemdata);exit();
?>
<input type="hidden" value="<?php echo $entrydata[0][0]['narration'];?>" name="data[Entry][narration]"/>
<input type="hidden" value="<?php echo $entrydata[0][0]['tag_id'];?>" name="data[Entry][tag_id]"/>
<!--<input type="hidden" value="<?php echo $entrydata[0][0]['number'];?>" name="data[Entry][number]"/>-->
<input type="hidden" value="<?php echo $entrydata[0]['Entry']['date'];?>" name="data[Entry][date]"/>

<?php 
$i=0;
foreach($entryitemdata as $ei){?>
<input type="hidden" name="data[Entryitem][<?php echo $i;?>][dc]" value="<?php echo $ei['entryitems']['dc'];?>"/>
<input type="hidden" name="data[Entryitem][<?php echo $i;?>][ledger_id]" value="<?php echo $ei['entryitems']['ledger_id'];?>"/>
<input type="hidden" name="data[Entryitem][<?php echo $i;?>][<?php echo ($ei['entryitems']['dc']=='D'?'dr_amount':'cr_amount');?>]" value="<?php echo $ei[0]['amount'];?>"/>
<?php 
$i++;
}
	echo '<div class="form-group">';
		echo $this->Form->submit(__d('webzash', 'Feed'), array(
			'div' => false,
			'class' => 'btn btn-primary'
		));
		echo $this->Html->tag('span', '', array('class' => 'link-pad'));
		echo $this->Html->link(__d('webzash', 'Clear'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'feed',$entrytypeLabel), array('class' => 'btn btn-default'));
		echo '</div>';
	echo $this->Form->end();
}
?>