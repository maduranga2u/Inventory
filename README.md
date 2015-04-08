Step 1. Download Webzash v2.3
https://github.com/prashants/webzash/releases/download/v2.3/webzash-v2.3.zip
Step 2. Configure it.
https://github.com/prashants/webzash
Step 3. Download Inventory plugin and place on app/Plugin
https://github.com/maduranga2u/Inventory

Step 4. Edit the app/Config/bootstrap.php file and add the following lines
 CakePlugin::load('Inventory', array('routes' => false, 'bootstrap' => false));

Step 5. Edit the app/Config/database.php file and configure to correct databse.

Step 6. Import webzash_inventory.sql to database.

Step 7. Edit the app/Config/routes.php file and uncomment out the default route
 Router::connect('/', array('plugin'=>'webzash','controller' => 'wzusers', 'action' => 'login'));

Step 8. Add below code to line 66 on app\Plugin\Webzash\View\Elements\defaultnavbar.ctp file.

<li><span><?php echo $this->Html->link(__d('webzash', 'Inventory '), array('plugin' => 'inventory', 'controller' => 'categories', 'action' => 'index'), array('class' => 'btn btn-success navbar-btn')); ?></span></li>
				
