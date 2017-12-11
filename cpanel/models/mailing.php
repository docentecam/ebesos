<?php
require('../../inc/functions.php');
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
else if(!isset($_GET['acc'])) { header("Location: ../index.html");}


if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

	echo listMails();

}


function listMails(){

$mySql = "SELECT idMailingUserSends	, idMail , email ,nomContacte,asunto,contenido , DATE_FORMAT( data,'%d-%m-%Y') AS fecha FROM mailingusersends ";
$connexio = connect();
$resultMails = mysqli_query($connexio, $mySql);
disconnect($connexio);

	$i=0;
		$dataMails ='[';
		while ($row=mySqli_fetch_array($resultMails))
		{	
			if($i != 0)
			{
				$dataMails .= ",";
			} 

			$dataMails .= '{"idMailingUserSends	":"'.$row['idMailingUserSends'].'","idMail	":"'.$row['idMail'].'","asunto":"'.$row['asunto'].'","email":"'.$row['email'].'","contenido	":"'.$row['contenido'].'","nomContacte":"'.$row['nomContacte'].'","fecha":"'.$row['fecha'].'"}';
			$i++;
		}
		$dataMails .=']';

		return $dataMails;

}