<?php
error_reporting(0);
require "phpmailer/phpmailer.class.php";
	function connect()
	{
		$connexio=@mysqli_connect("localhost","root","","ddb99266");
		// $connexio=@mysqli_connect("mysql.hostinger.es","u287405309_ebeso","email12345","u287405309_ebeso");
		// $connexio=@mysqli_connect("mysql.hostinger.es","u535170345_besos","ebesos","u535170345_besos");
		if (!$connexio)
		{	die("Error al conectar");	}
		mysqli_set_charset($connexio, "utf8");
		mysqli_query($connexio,"SET lc_time_names = 'ca_ES'");
		return($connexio);
	}
	function disconnect($connexio)
	{ mysqli_close($connexio);}
	function close()
	{	session_destroy();}

function sendMails($mailClient = "", $subject = "", $fromName = "", $mailAssociation = "", $pswd = "", $body = "", $logo = ""){
		


		$mySqlServer = "SELECT value FROM settings WHERE literal = 'smtpServer'";
		$mySqlPort = "SELECT value FROM settings WHERE literal = 'smtpPort'";
		$connexio = connect();
 		$resultServer = mysqli_query($connexio, $mySqlServer);
 		$resultPort = mysqli_query($connexio, $mySqlPort);
		disconnect($connexio);
		$fila = mysqli_fetch_row($resultServer);
		$smtpServer=$fila[0];
		$fila = mysqli_fetch_row($resultPort);
		$smtpPort=$fila[0];

		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure ="tls";
		$mail->Host = $smtpServer;
		$mail->Port = $smtpPort;
		$mail->Username = $mailAssociation;
		$mail->Password = $pswd;
		$mail->FromName	= $fromName;
		$mail->From	= $mailClient;
		$mail->AddReplyTo($mailAssociation);
		$mail->AddAddress($mailClient);
		$mail->Timeout = 100;
		$mail->IsHTML(true);
		$mail->CharSet = 'UTF-8';
		$mail->Subject = $subject;
		$mail->AddEmbeddedImage("../img/logos-assoc/".$logo , "my-attach1");
		$mail->Body = $body;
		
		$mail->AltBody = $body;
		$exito = $mail->Send();
		if(!$exito)
		{
		$message= 0;
		}
		else
		{
		$message= 1;
		}
		return $message;
	}
?>