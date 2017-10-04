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

 		$mySql = "SELECT literal, value FROM ddb99266.settings";
 		$mySql = "SELECT email, name, emailPass FROM ddb99266.users";

	 		echo $_GET['idUser'];
	 		echo $_GET['client'];
	 		echo $_GET['email'];
	 		echo $_GET['message'];

		// $connexio = connect();
		// $resultContact = mysqli_query($connexio, $mySql);
		// disconnect($connexio);
		// $i=0;
		// $dataContact ='[';
		// while ($row=mySqli_fetch_array($resultContact))
		// {
		// 	if($i != 0)
		// 	{
		// 		$dataContact .= ",";
		// 	} 
		// 	$dataContact .= '{"email":"'.$row['email'].'"}';
		// 	$i++;
		// }
		// $dataContact .=']';
		// 	echo $dataContact;
 	}
?>
