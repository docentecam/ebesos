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

 		$mySql = "SELECT email, name, emailPass FROM users WHERE idUser=".$_GET["idUser"];
 		$connexio = connect();
 		$resultContact = mysqli_query($connexio, $mySql);
		disconnect($connexio);
			while ($row=mySqli_fetch_array($resultContact))
			{
				$emailAssociation = $row["email"];
				$nameAssociation = $row["name"];
				$emailPass = $row["emailPass"];
			}	

 		sendMails( $_GET['email'], "Contacte formulari de ".$nameAssociation, $_GET['client'],$emailAssociation, $emailPass, $_GET['message']);
 	}
?>
