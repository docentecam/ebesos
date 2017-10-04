<?php
	function connect()
	{
		$connexio=@mysqli_connect("bbdd.codigitals.com.es","ddb100217","emailContacte09","ddb100217");
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


	require "inc/phpmailer/phpmailer.class.php";
	$mail = new PHPMailer();
//datos cuenta
$mail->IsSMTP();
 //envío vía SMTP
$mail->SMTPAuth = true;// turn on SMTP authentication
$mail->SMTPSecure="TLS";
$mail->Host = 'smtp.dondominio.com.es'; 
$mail->Port=587;
$mail->Username="jordi.vallejo@codigitals.com.es";// SMTP usuario
$mail->Password="JVallejo2017"; // SMTP password
$mail->FromName = "Nombre Quien Envía"; //Nombre a mostrar
$mail->From = "jordi.vallejo@codigitals.com.es";  //Cuenta de envío.
$mail->SMTPDebug = 1; //para que muestre los fallos de conexión SMTP
$mail->SMTPDebug = 2; //para que muestre lo que va haciendo conexión SMTP

$mail->AddReplyTo("suport@codigitals.com.es");//Dirección de respuesta
$mail->AddAddress("steezpwns@gmail.com");//Dirección de envío.
$mail->Timeout=5;
$mail->IsHTML(true);
$mail->CharSet = 'UTF-8';
$mail->Subject = 'Asunto';
//INSERTAR IMAGEN EN EL CUERPO DEL MAIL
//$mail->AddEmbeddedImage('imagen.png','myfoto');
$cuerpo="Contenido del correo";

$mail->Body = 'Cuerpo del correo';
$mail->AltBody = 'Cuerpo del correo';
//$mail->AddAttachment("ruta/".$nombre_archivo);

$exito = $mail->Send();
$mail->ClearAddresses(); //Eliminamos direcciones destino(por si reutilizamos)
echo "Enviamos<br>";
// Informamos tanto si ha ido bien como si ha ido mal
if(!$exito){
echo  $mail->ErrorInfo;
}
else{
echo 'email_enviado_ok ';
}
	//$mailAssociation = "associacio.xaviernogues@gmail.com"; $pswd = "exPasswordXN"; 
	// $mailAssociation = "jordi.vallejo@codigitals.com.es"; $pswd = "JVallejo2017"; 

		
	// 	$mySql = "SELECT literal, value FROM settings WHERE literal = 'smtpServer' OR literal = 'smtpPort' ORDER BY literal";
	// 	$connexio = connect();
 // 		$resultPort = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);
	// 	$i = 0;
	// 		while ($row=mySqli_fetch_array($resultPort))
	// 		{
	// 			if ($i!=0) {
	// 				$smtpServer = $row["value"];
	// 			}
	// 			else {
	// 				$smtpPort = $row["value"];
	// 			}
	// 			$i++;
				
	// 		}	
	// 	$smtpServer = "smtp.codigitals.com.es";
	// 	// $smtpServer = "smtp.gmail.com";
	// 	$smtpPort = 587;
	// 	$mailClient = "steezpwns@gmail.com";
	// 	$subject = "Asunto";
	// 	$fromName = "Pepito";
	// 	$body = "Mensaje";


	// 	echo $smtpServer, $smtpPort, $mailClient, $mailAssociation, $pswd, $subject, $body;
	// 	require "inc/phpmailer/phpmailer.class.php";
	// 	$mail = new PHPMailer();
	// 	$mail->IsSMTP();
	// 	$mail->SMTPAuth = true;
	// 	$mail->SMTPSecure ="TLS";
	// 	$mail->Host = $smtpServer;//$smtpServer;
	// 	$mail->Port = $smtpPort;//$smtpPort;
	// 	$mail->Username = $mailAssociation;
	// 	$mail->Password = $pswd;
	// 	$mail->FromName	= $fromName;
	// 	$mail->From	= $mailAssociation;
	// 	$mail->SMTPDebug = 1;
	// 	$mail->SMTPDebug = 2;
	// 	$mail->AddReplyTo($mailAssociation);
	// 	$mail->AddAddress($mailClient);
	// 	$mail->Timeout = 5;
	// 	$mail->IsHTML(true);
	// 	$mail->CharSet = 'UTF-8';
	// 	$mail->Subject = $subject;
	// 	$mail->Body = $body;
	// 	$mail->AltBody = $body;
	// 	echo "Enviamos<br>";
	// 	$exito = $mail->Send();
	// 	$mail->ClearAddresses();
	// 	echo "comprovamos<br>";
	// 	if(!$exito)
	// 	{
	// 		echo $mail->ErrorInfo;
	// 	}
	// 	else
	// 	{
	// 		echo 'email_enviado_ok ';
	// 	}
	// echo "fin";
?>