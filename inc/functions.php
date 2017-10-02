<?php
	function connect()
	{
		$connexio=@mysqli_connect("localhost","root","","ddb99266");
		//$connection=@mysqli_connect("mysql.hostinger.es","u535170345_besos","ebesos","u535170345_besos");
		if (!$connexio)
		{	die("Error...".mysqli_connect_error());	}
		mysqli_set_charset($connexio, "utf8");
		return($connexio);
	}
	function disconnect($connexio)
	{ mysqli_close($connexio);}
	function close()
	{	session_destroy();}

	function sendMails($mailAddress = "", $subject = "", $fromName = "", $mailto = "", $pswd = "", $body = ""){

	}

?>