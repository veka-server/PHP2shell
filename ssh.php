<?php 
	session_start();

	include('config.php');

	// si l'utilisateur est deconnecté
	if($_SESSION['user'] != $user AND $_SESSION['mdp'] != $mdp)
	{
		echo '<script type="text/javascript">document.location.href="connexion.php"</script>';
		exit;
	}


	$commande = $_POST['command'];
	exec('cd ~/ ;'.$commande.' 2>&1', $variable);
	foreach ($variable as $key => $value) 
	{
		echo htmlspecialchars($value).'<br>';
	}
?>