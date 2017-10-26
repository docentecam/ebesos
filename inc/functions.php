<?php
require "phpmailer/phpmailer.class.php";
	function connect()
	{
		$connexio=@mysqli_connect("localhost","root","","ddb99266");
		// $connexio=@mysqli_connect("mysql.hostinger.es","u287405309_ebeso","email12345","u287405309_ebeso");
		if (!$connexio)
		{	die("Error al conectar");	}
		mysqli_set_charset($connexio, "utf8");
		return($connexio);
	}
	function disconnect($connexio)
	{ mysqli_close($connexio);}
	function close()
	{	session_destroy();}

function sendMails($mailClient = "", $subject = "", $fromName = "", $mailAssociation = "", $pswd = "", $body = ""){
		


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
		$mail->AddEmbeddedImage('img/logos-assoc/1f.png', 'logo_1');
		$mail->AddEmbeddedImage('img/logos-assoc/2f.png', 'logo_2');
		$mail->AddEmbeddedImage('img/logos-assoc/3f.png', 'logo_3');
		$mail->AddEmbeddedImage('img/logos-assoc/4f.png', 'logo_4');
		$mail->Body = '<img alt="PHPMailer" src="cid:logo_1">';
		
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