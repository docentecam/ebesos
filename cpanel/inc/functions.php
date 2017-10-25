<?php
	function connect()
	{
		$connexio=@mysqli_connect("localhost","root","","ddb99266");
		if (!$connexio)
		{	die("Error al conectar");	}
		mysqli_set_charset($connexio, "utf8");
		return($connexio);
	}
	function disconnect($connexio)
	{ mysqli_close($connexio);}
	function close()
	{	session_destroy();}
	function whoId()
	{
		session_start();
		return '[{"sessionIdUser":"'.$_SESSION['user']['idUser'].'","sessionName":"'.$_SESSION['user']['name'].'","sessionPrivileges":"'.$_SESSION['user']['privileges'].'","sessionLogo":"'.$_SESSION['user']['logo'].'"}]';
	}


?>