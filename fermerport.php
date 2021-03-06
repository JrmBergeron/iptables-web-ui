<?php
require('config.php');

session_start();

if(!isset($_SESSION['connected'])) {
	header('Location: login.php');
	exit();
}

if(isset($_POST['block'])) {
	ssh2_exec($connection, 'iptables -A INPUT -p tcp --destination-port '.$_POST['block'].' -j DROP');
	header('Location: fermerport.php?action=success');
	exit();
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<link rel="stylesheet" type="text/css" href="css/bootstrap.css" />
<title>Iptables Web UI | Accueil</title>
</head>
<body style="margin-top: 100px; margin-left: 270px; margin-right: 270px;">
	<div class="well" align="center">
	<h4>Bloquer un port</h4>
	<br>
	<?php if($_GET['action'] == 'success') {
	echo '<div class="alert alert-success">Le port a bien été bloqué ! <a class="close" data-dismiss="alert" href="#">&times;</a></div>';
	}
	else {
	echo '<div class="alert alert-danger">Le port sera bloqué. <a class="close" data-dismiss="alert" href="#">&times;</a></div>';
	}
	?>
	<br>
	<form action="" method="POST">
		<input type="text" name="block" placeholder="Port à bloquer" />
		<button class="btn btn-primary btn-large" type="submit">Bloquer le port</button>
	</form>
	</div>
<?php include('includes/footer.php'); ?>