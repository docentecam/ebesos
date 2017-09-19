<?php

require("../inc/functions.php");
	
	


<<<<<<< HEAD
		
		// $mySql = "SELECT history, email FROM users  WHERE idUser=$idUser";
		// $connexio = connect();
		// $resultUsers = mysqli_query($connexio, $mySql);
		// disconnect($connexio);

		// $dataUsers = "[";
		// $i = 0;
		// while ($row=mySqli_fetch_array($resultAboutUs))
		// {
		// 	if($i != 0)
		// 	{
		// 		$dataUsers .= ",";
		// 	} 
		// 	$dataUsers .= '{"email":"'.$row['email'].'", "history":"' .$row['history'].'"}';
		// }
		

	 // 	echo $dataUsers;
	// }


	 	

=======
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

>>>>>>> 162d981ab0a2d42ae0b5ef9e53db3a22bf608f09
?>
