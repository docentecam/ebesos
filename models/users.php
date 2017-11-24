<?php

require("../inc/functions.php");

	if(isset($_GET['acc'])&&$_GET['acc']=='history'){
		$mySql = "SELECT history FROM users  WHERE idUser=".$_GET["idUser"];
		$connexio = connect();
		$resultAboutUs = mysqli_query($connexio, $mySql);
		disconnect($connexio);
			while ($row=mySqli_fetch_array($resultAboutUs))
			{
				
				$historyAboutUs=$row['history'];
			}
		echo nl2br($historyAboutUs);
	}
	else if(isset($_GET['acc'])&&$_GET['acc']=='logo'){
		$mySql = "SELECT logo FROM users  WHERE idUser=".$_GET["idUser"];
		$connexio = connect();
		$resultLogo = mysqli_query($connexio, $mySql);
		disconnect($connexio);
			while ($row=mySqli_fetch_array($resultLogo))
			{
				
				$associationLogo=$row['logo'];
			}
		echo $associationLogo;
	}

 	else if (isset($_GET["acc"]) && $_GET["acc"] == "mail") {

 		$mySql = "SELECT email, name, address, telephone, emailPass, logo FROM users WHERE idUser=".$_GET["idUser"];
 		$connexio = connect();
 		$resultContact = mysqli_query($connexio, $mySql);
 		disconnect($connexio);
 		$row=mySqli_fetch_row($resultContact);
		
		$emailAssociation = $row[0];
		$nameAssociation = $row[1];
		$emailPass = $row[4];
		$logoAssociation = $row[5];
		if($_GET["idUser"] == '1'){
			$logoAssociation = "4e.png";
		}

		$body = 
				"<html>
		 			<head>
		 			</head>
		 			<body>
						<i>Nom de l'interessat: </i>".$_GET['client']."
						<br><br>
						<i>Email de l'interessat: </i>".$_GET['email']."
			        	<p style='margin-bottom: 2%;margin-top: 2%;'>'". $_GET['message'].".'</p>
			        	<b style='margin-left:1.5%;margin-right:1.5%;'>".$nameAssociation."</b>
				        <img alt='Logo' src='cid:my-attach1'>
		 			</body>
	 			</html>";

 		$envioStatus= sendMails( $_GET['email'], "Contacte formulari de ".$nameAssociation, $_GET['client'],$emailAssociation, $emailPass, $body, $logoAssociation);
 		$envioStatusCopia= sendMails($emailAssociation, "COPIA - Contacte formulari de ".$nameAssociation, 'contacte pel web',$emailAssociation, $emailPass, $body, $logoAssociation);

 		if ($envioStatus != '1' || $envioStatusCopia != '1') {
 			$envioStatus='0';
 		}

		echo '[{"envioStatus":"'.$envioStatus.'"}]';
 	}

 	if (isset($_GET["acc"]) && ($_GET["acc"] == "infoMail"))
	{
		$mySql = "SELECT email, name, address, telephone, logo FROM users WHERE idUser =".$_GET["idUser"];
		$connexio = connect();
		$resultContact = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataMail ="[";
		while ($row=mySqli_fetch_array($resultContact))
		{
			if($i != 0)
			{
				$dataMail .= ",";				
			}			
			$dataMail .= '{"email":"'.$row['email'].'","name":"'.$row['name'].'","logo":"'.$row['logo'].'","address":"'.$row['address'].'","telephone":"'.$row['telephone'].'"}';
			$i++;
		}
		$dataMail .="]";
		echo $dataMail;
	}
?>
