<?php 
require "inc/phpmailer/phpmailer.class.php";
$mail
 = new PHPMailer();
//datos
 cuenta
$mail->IsSMTP();
 //envío vía SMTP
$mail->SMTPAuth
 = true;// turn on SMTP authentication
$mail->SMTPSecure="TLS";
$mail->Host
 = 'smtp.dondominio.com'; 
$mail->Port=587;
$mail->Username="suport@codigitals.com.es";//
 SMTP usuario
$mail->Password="contraseña";
 // SMTP password
$mail->FromName
 = "Nombre Quien Envía"; //Nombre a mostrar
$mail->From
 = "suport@codigitals.com.es";  //Cuenta de envío.

$mail->SMTPDebug
 = 1; //para que muestre los fallos de conexión SMTP
$mail->SMTPDebug
 = 2; //para que muestre lo que va haciendo conexión SMTP


$mail->AddReplyTo("suport@codigitals.com.es");//Dirección
 de respuesta
$mail->AddAddress("suport@codigitals.com.es");//Dirección -> mailTo
 de envío.
$mail->Timeout=5;
$mail->IsHTML(true);
$mail->CharSet
 = 'UTF-8';

$mail->Subject
 = 'Asunto';
//INSERTAR
 IMAGEN EN EL CUERPO DEL MAIL
//$mail->AddEmbeddedImage('imagen.png','myfoto');
$cuerpo="Contenido
 del correo";

$mail->Body
 = 'Cuerpo del correo';
$mail->AltBody
 = 'Cuerpo del correo';
//$mail->AddAttachment("ruta/".$nombre_archivo);

$exito
 = $mail->Send();
$mail->ClearAddresses();
 //Eliminamos direcciones destino(por si reutilizamos)
echo
 "Enviamos<br>";
//
 Informamos tanto si ha ido bien como si ha ido mal
if(!$exito){
return
  $mail->ErrorInfo;
}
else{
echo
 'email_enviado_ok ';
}
?>
