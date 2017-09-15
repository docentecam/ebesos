<?php

require("../inc/functions.php");
	
	$idUser=1;

	// function showHistory($idUser){

		
		$mySql = "SELECT history FROM users  WHERE idUser=$idUser";
		$connexio = connect();
		$resultAboutUs = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		while ($row=mySqli_fetch_array($resultAboutUs))
		{
			
			$historyAboutUs=$row['history'];
		}
		

	 	echo $historyAboutUs;
	// }
?>