<?php

require("../inc/functions.php");
	
	$idUser=1;

	// function showHistory($idUser){

		
		$mySql = "SELECT history, email FROM users  WHERE idUser=$idUser";
		$connexio = connect();
		$resultUsers = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$dataUsers = "[";
		$i = 0;
		while ($row=mySqli_fetch_array($resultAboutUs))
		{
			if($i != 0)
			{
				$dataUsers .= ",";
			} 
			$dataUsers .= '{"email":"'.$row['email'].'", "history":"' .$row['history'].'"}';
		}
		

	 	echo $dataUsers;
	// }
?>