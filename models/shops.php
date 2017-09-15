<?php
require('../inc/functions.php');
$idUser=$_GET['idUser'];

	/*function listShops($idUser)
	{*/
		$mySql= "SELECT idShop, name, telephone, email, horary, address
				FROM shops
				WHERE idUser=".$idUser;
				

		$connexio = connect();

		$resultShops = mysqli_query($connexio, $mySql);

		disconnect($connexio);

		$dataShops = "[";
		$i = 0;
		while($row = mysqli_fetch_array($resultShops))
		{
			if($i != 0)
			{
				$dataShops .= ",";
			}
			$dataShops .= '{"idShop":"'.$row['idShop'].'", "name":"'.$row['name'].'", "telephone":"'.$row['telephone'].'", "email":"'.$row['email'].'", "horary":"'.$row['horary'].'", "address":"'.$row['address'].'"}'; 
			$i++;
		}
		$dataShops .= "]";

		echo $dataShops;
	//}

?>