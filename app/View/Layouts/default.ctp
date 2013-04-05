<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php		
		echo $this->Html->script('jquery-1.9.1.min.js');
		echo $this->Html->script('bootstrap.min.js');
        echo $this->Html->css('bootstrap.min.css');
		echo $this->Html->css('bootstrap-responsive.min.css');
	?>
</head>
<body style="padding-top: 60px;">
<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="brand" href="#" style="padding: 5px 20px 5px"><?php echo $this->Html->image("logo_29h.png")?></a>
			<ul class="nav" id="barraNavegacion">
				<li class="active">
                <?php echo $this->Html->link("Procesos", array(
                        'controller'=>"Procesos",
                        'action'=>"listado",
                    )
                ); ?>
                </li>				
			</ul>
		</div>
	</div>
</div>
<div class="container">
	<?php echo $this->Session->flash(); ?>
	<?php echo $this->fetch('content'); ?>	
</div>

<footer style="margin-top: 45px; padding-top: 5px; border-top: 1px solid #eaeaea; color: #999">
<?php //echo $this->element('sql_dump'); ?>
</footer>
</body>
</html>
