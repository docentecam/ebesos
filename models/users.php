<?php

require("../inc/functions.php");
	
	$idUser=1;

	// function showHistory($idUser){

		//if ($_GET["acc"] == "") {
			$mySql = "SELECT history FROM users WHERE idUser=$idUser";
			$connexio = connect();
			$resultAboutUs = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			while ($row=mySqli_fetch_array($resultAboutUs))
			{
				
				$historyAboutUs=$row['history'];
			}
			

		 	echo $historyAboutUs;
		//	}
	 	 if ($_GET["acc"] == "mail") {
	 		$mySql = "SELECT email FROM users WHERE idUser=".$_GET["userId"];
			$connexio = connect();
			$resultContact = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			while ($row=mySqli_fetch_array($resultContact))
			{
				
				$dataContact=$row['email'];
			}
		 	echo $dataContact;
	 	}
	// }
?>
