<?php
require('../../inc/functions.php');
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
else if(!isset($_GET['acc'])) { header("Location: ../index.html");}


if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

	echo listMails();

}


if(isset($_GET['acc']) && $_GET['acc'] == 'listM'){

	echo listUsersMailing();

}

if(isset($_GET['acc']) && $_GET['acc'] == 'emailNew'){

	}



function listMails(){

$mySql = "SELECT idMailingUserSends ,asunto,contenido , DATE_FORMAT( data,'%d-%m-%Y') AS fecha FROM mailingusersends ";
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

			$dataMails .= '{"idMailingUserSends":"'.$row['idMailingUserSends'].'","asunto":"'.$row['asunto'].'","contenido":"'.$row['contenido'].'","fecha":"'.$row['fecha'].'"}';
			$i++;
		}
		$dataMails .=']';

		return $dataMails;

}

function listUsersMailing(){

		$mySql = "SELECT idMail ,email,nomContacte  FROM mailing";
		$connexio = connect();
		$resultUsers = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$i=0;
		$dataUsersMailing ='[';
		while ($row=mySqli_fetch_array($resultUsers))
		{	
			if($i != 0)
			{
				$dataUsersMailing .= ",";
			} 

			$dataUsersMailing .= '{"idMail":"'.$row['idMail'].'","email":"'.$row['email'].'","nomContacte":"'.$row['nomContacte'].'"}';
			$i++;
		}
		$dataUsersMailing .=']';

		return $dataUsersMailing;

}
