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
<!-- Static navbar -->
<div class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<?php echo $this->Html->link('Webzash', '#', array('class' => 'navbar-brand')); ?>
		</div>
		<div class="navbar-collapse collapse">
			<?php if ($this->Session->read('Auth.User')): ?>
			<ul class="nav navbar-nav">	
            	<li><?php echo $this->Html->link(__d('webzash', 'Dashboard'), array('plugin' => 'inventory', 'controller' => 'balances', 'action' => 'dashboard')); ?></li>			
				<li><?php echo $this->Html->link(__d('webzash', 'Item'), array('plugin' => 'inventory', 'controller' => 'items', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__d('webzash', 'Customers'), array('plugin' => 'inventory', 'controller' => 'clients', 'action' => 'index')); ?></li>
                <li><?php echo $this->Html->link(__d('webzash', 'Suppliers'), array('plugin' => 'inventory', 'controller' => 'clients', 'action' => 'index')); ?></li>                                
				
                <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Entries <b class="caret"></b></a>
					<ul class="dropdown-menu">						
                        <li><?php echo $this->Html->link(__d('webzash', 'Sales'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'add','receipt')); ?></li>
                <li><?php echo $this->Html->link(__d('webzash', 'Purchase'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'add','payment')); ?></li>
					</ul>
				</li>
                <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Reports <b class="caret"></b></a>
					<ul class="dropdown-menu">						
                        <li><?php echo '<li>' . $this->Html->link(__d('webzash', 'Stock'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'pstock')); ?></li>
                        <li><?php echo '<li>' . $this->Html->link(__d('webzash', 'Bill'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'bill')); ?></li>
					</ul>
				</li>
                <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Feed <b class="caret"></b></a>
					<ul class="dropdown-menu">						
                        <li><?php echo '<li>' . $this->Html->link(__d('webzash', 'Sales'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'feed','receipt')); ?></li>
                        <li><?php echo '<li>' . $this->Html->link(__d('webzash', 'Purchase'), array('plugin' => 'inventory', 'controller' => 'billdetails', 'action' => 'feed','payment')); ?></li>
					</ul>
				</li>
				 
				
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php if ($this->Session->read('Auth.User.role') == 'admin') : ?>
					<li><span><?php echo $this->Html->link(__d('webzash', 'Administer'), array('plugin' => 'webzash', 'controller' => 'admin', 'action' => 'index'), array('class' => 'btn btn-danger navbar-btn')); ?></span></li>
				<?php endif; ?>
                <li><span><?php echo $this->Html->link(__d('webzash', 'Account'), array('plugin' => 'webzash', 'controller' => 'dashboard', 'action' => 'index'), array('class' => 'btn btn-success navbar-btn')); ?></span></li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Settings <b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><?php echo $this->Html->link(__d('webzash', 'Update Profile'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'profile')); ?></li>
						<li><?php echo $this->Html->link(__d('webzash', 'Change Password'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'changepass')); ?></li>
					</ul>
				</li>

				<li><?php echo $this->Html->link(__d('webzash', 'Logout'), array('plugin' => 'webzash', 'controller' => 'wzusers', 'action' => 'logout')); ?></li>
			</ul>
			<?php endif; ?>
		</div><!--/.nav-collapse -->
	</div><!--/.container-fluid -->
</div>
