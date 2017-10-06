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

	function sendMails($mailClient = "", $subject = "", $fromName = "", $mailAssociation = "", $pswd = "", $body = ""){

		$mySql = "SELECT literal, value FROM settings WHERE literal = 'smtpServer' OR literal = 'smtpPort'";
		$connexio = connect();
 		$resultPort = mysqli_query($connexio, $mySql);
		disconnect($connexio);
			while ($row=mySqli_fetch_array($resultPort))
			{
				$smtpServer = $row["value"];
				$smtpPort = $row["value"];
			}	
		require "phpmailer/phpmailer.class.php";
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure ="ssl";
		$mail->Host = $smtpServer;//$smtpServer;
		$mail->Port = $smtpPort;//$smtpPort;
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
		$mail->Body = $body;
		$mail->AltBody = $body;
		$exito = $mail->Send();
		$mail->ClearAddresses();
		$mail->AddAddress($mailAssociation);
		$exito = $mail->Send();
		if(!$exito)
		{
			return $mail->ErrorInfo;
		}
		else
		{
			echo 'email_enviado_ok ';
		}
	}
?>