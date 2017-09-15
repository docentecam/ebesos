<?php
	function connect()
	{
		$connexio=@mysqli_connect("localhost","root","","ddb99266");
		if (!$connexio)
		{	die("Error...".mysqli_connect_error());	}
		mysqli_set_charset($connexio, "utf8");
		return($connexio);
	}
	function disconnect($connexio)
	{ mysqli_close($connexio);}
	function close()
	{	session_destroy();}


?>