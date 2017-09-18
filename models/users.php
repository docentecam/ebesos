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
 		$mySql = "SELECT email FROM users WHERE idUser=".$_GET["idUser"];
		$connexio = connect();
		$resultContact = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		while ($row=mySqli_fetch_array($resultContact))
		{
			
			$dataContact=$row['email'];
		}
	 	echo $dataContact;
 	}

?>
