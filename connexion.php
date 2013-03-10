<?php 	
	session_start(); 

	include('config.php');

	if($_GET['deco'] == 1)
	{
		unset($_SESSION['user']);
		unset($_SESSION['mdp']);
	}

	if($_SESSION['user'] == $user AND $_SESSION['mdp'] == $mdp)
	{
		$_SESSION['user'] = $user;
		$_SESSION['mdp'] = $mdp;
		echo '<script type="text/javascript">document.location.href="index.php"</script>';
		exit;
	}

	if($_POST['user'] == $user AND $_POST['mdp'] == $mdp)
	{
		$_SESSION['user'] = $user;
		$_SESSION['mdp'] = $mdp;
		echo '<script type="text/javascript">document.location.href="index.php"</script>';
		exit;
	}

?>
<html>
<head>
	<title>PHP2Shell</title>

	<!-- feuille de style du site -->
	<link rel="stylesheet" type="text/css" href='style.css'/>
	<link rel="shortcut icon" href="terminal.png" />

</head>
<body>
<div id="connexion">
	<form method='post'>
		<h1>Connexion</h1>
		<input type='text' name='user' placeholder='User' />
		<input type='password' name='mdp' placeholder='Password' />
		<input type='submit' class='btn btn-primary' value='Connexion' />
	</form>
</div>
</body>
</html>