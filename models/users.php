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
		echo $historyAboutUs;
	}

 	else if (isset($_GET["acc"]) && $_GET["acc"] == "mail") {

 		$mySql = "SELECT email, name, address, telephone, emailPass, logo FROM users WHERE idUser=".$_GET["idUser"];
 		$connexio = connect();
 		$resultContact = mysqli_query($connexio, $mySql);
		disconnect($connexio);
			while ($row=mySqli_fetch_array($resultContact))
			{
				$emailAssociation = $row["email"];
				$nameAssociation = $row["name"];
				$emailPass = $row["emailPass"];
			}	
 		$envioStatus= sendMails( $_GET['email'], "Contacte formulari de ".$nameAssociation, $_GET['client'],$emailAssociation, $emailPass, $_GET['message']);
 		$envioStatusCopia= sendMails($emailAssociation, "COPIA - Contacte formulari de ".$nameAssociation, 'contacte pel web',$emailAssociation, $emailPass, $_GET['message']."<br><img src='cid:logo_1'> ");

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
