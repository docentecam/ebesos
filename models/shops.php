<?php
require('../inc/functions.php');

		if(isset($_GET['idUser']))
		{
			$idUser=$_GET['idUser'];
			$mySql= "SELECT idShop, name
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
				$dataShops .= '{"idShop":"'.$row['idShop'].'", "name":"'.$row['name'].'"}'; 
				$i++;
			}
			$dataShops .= "]";

			echo $dataShops;
		}
	
		else if(isset($_GET['idShop']))
		{
			$idShop=$_GET['idShop'];
			$mySql= "SELECT name, telephone, email, horary, address
					FROM shops
					WHERE idShop=".$idShop;
					

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
				$dataShops .= '{"name":"'.$row['name'].'", "telephone":"'.$row['telephone'].'", "email":"'.$row['email'].'", "horary":"'.$row['horary'].'", "address":"'.$row['address'].'"}'; 
				$i++;
			}
			$dataShops .= "]";

			echo $dataShops;
		}

?>