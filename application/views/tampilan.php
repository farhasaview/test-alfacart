<!DOCTYPE html>
<html>
<head>
	<title>Guest Book 2</title>
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" type="text/css" href="<?=base_url('assets/css/bootstrap-theme.min.css')?>">
	<script type="text/javascript" src="<?=base_url('assets/js/jquery-3.1.1.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
</head>
<body>

<div class="navbar navbar-default">
	<div class="container"><?php if ($content == 'permainan/index') { ?>
		<marquee direction=right><h2><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Test Front End Developer Alfacart</h2></marquee><?php } else { ?>
		<h2><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp;Test Front End Developer Alfacart</h2><?php } ?>
		<ul class="nav nav-tabs">
			<li class="<?= $aktif=='guest' ? 'active' : ''  ?>"><a href="<?=base_url('/')?>">Soal 1</a></li>
			<li class="<?= $aktif=='dum' ? 'active' : ''  ?>"><a href="<?=base_url('dum')?>">So'al 2</a></li>
		</ul>
	</div>
</div>
<div class="container">
	<?php $this->load->view($content);?>
</div>
</body>
</html>