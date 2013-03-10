<?php 
	session_start();

	include('config.php');

	// si l'utilisateur est connecté
	if($_SESSION['user'] != $user AND $_SESSION['mdp'] != $mdp)
	{
		echo '<script type="text/javascript">document.location.href="connexion.php"</script>';
		exit;
	}
 ?>
<html>
<head>
	<title>PHP2Shell</title>

	<link rel="shortcut icon" href="terminal.png" />

	<style type="text/css">

	*
	{
		margin: 0px;
		padding: 0px;
	}

	body, input {
		background:black;
	    font-family: FreeMono,monospace;
	    font-size: 12px;
	    color: grey;
	}

	body
	{
		padding:20px;
	}

	form
	{
		display:inline-block;
		width:100% !important;
	}

	input
	{
		background: transparent;
		color:white !important;
		border: none !important;
		box-shadow:none  !important;
		width:100% !important;
	}

	</style>

</head>
<body>

<pre id="pre"></pre><pre>$ <form id='formulaire' method='post' action='ssh.php' ><input type="text" name="command" id="command" /></form></pre>

<script type="text/javascript">

function post_to_url(path, params, method) 
{
    method = method || "post";
    var oMyForm = new FormData();
    for (var k in params)
    {
        if (typeof params[k] !== 'function') 
        {
          oMyForm.append(k, params[k]);
        }
    }

    var oReq = new XMLHttpRequest();
    oReq.open(method, path, false);
    oReq.send(oMyForm);

    return oReq.responseText;
}

var url_execute = 'ssh.php';
var chemin = '';
var command = document.getElementById("command");
var pre = document.getElementById("pre");
var formulaire = document.getElementById('formulaire');
formulaire.addEventListener('submit', function(event)
{
    event.preventDefault();

    switch(command.value)
    {
    	case '':
    		return false;
    	case 'clear':
		    pre.innerHTML = '';
			command.value='';
    		return false;
    	case 'exit':
			document.location.href="connexion.php?deco=1";
    		return false;
    	case 'top':
		    var retour = post_to_url(url_execute, {'command':'top -b -n 1'}, 'post');
		    break;
    	case 'df':
		    var retour = post_to_url(url_execute, {'command':'df -kTh'}, 'post');
		    break;
    	default:
		    var retour = post_to_url(url_execute, {'command':chemin+command.value}, 'post');
		    break;
    }

    if(command.value.search('cd') == 0)
    {
	    if(command.value.search('cd /') == 0 || command.value.search('cd ~') == 0)
	    {
	    	chemin += command.value+';';
	    }
	    else
	    {
	    	chemin += command.value+';';
	    }
    }

    pre.innerHTML = pre.innerHTML+'$ '+command.value+'<br>'+retour;
	command.value='';

    return false;
}, false);

command.focus();

</script>


</body>
</html>
