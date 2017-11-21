<?php
	function connect()
	{
		//$connexio=@mysqli_connect("localhost","root","","ddb99266");
		$connexio=@mysqli_connect("mysql.hostinger.es","u287405309_ebeso","email12345","u287405309_ebeso");
		if (!$connexio)
		{	die("Error al conectar");	}
		mysqli_set_charset($connexio, "utf8");
		mysqli_query($connexio,"SET lc_time_names = 'es_ES'");
		return($connexio);
	}
	function disconnect($connexio)
	{ mysqli_close($connexio);}
	function close()
	{	session_destroy();}
?>