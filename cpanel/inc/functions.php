<?php
	function connect()
	{
		$connexio=@mysqli_connect("localhost","root","","ddb99266");
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