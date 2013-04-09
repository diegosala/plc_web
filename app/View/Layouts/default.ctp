<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>		
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
