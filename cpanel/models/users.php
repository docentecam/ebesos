<?php 
require("../inc/functions.php");

	if(isset($_GET['acc'])&&$_GET['acc']=='login'){
		$mySql = "SELECT idUser, FROM users 
					WHERE email='".$_GET['email']."' AND password='".$_GET['password'].
					" AND active='Y'";
		$connexio = connect();
		$resultLogin = mysqli_query($connexio, $mySql);
		disconnect($connexio);

			while ($row=mySqli_fetch_array($resultLogin))
			{
				
				$checkLogin=$row['idUser'];
			}
		echo $checkLogin;

	}
/* 	else if (isset($_GET["acc"]) && $_GET["acc"] == "mail") {
 		$mySql = "SELECT email FROM users WHERE idUser=".$_GET["idUser"];
		$connexio = connect();
		$resultContact = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		while ($row=mySqli_fetch_array($resultContact))
		{
			
			$dataContact=$row['email'];
		}
	 	echo $dataContact;
 	}*/
 ?>