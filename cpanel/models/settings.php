<?php
require('../inc/functions.php');

		if(isset($_GET['acc']) && ($_GET['acc'] == "list"))
		{
			

			echo listSettings();
		}
		

		else if(isset($_GET['acc']) && $_GET['acc'] == 'addUpdate'){
			
			if (isset($_GET['act']) && $_GET['act']=='Add') {

			$mySql = "INSERT INTO settings (idSetting, literal, value)
			VALUES ('', '".$_GET['literal']."', '".$_GET['value']."')";

			$connexio = connect();
			$resultNewSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			}


			else if (isset($_GET['act']) && $_GET['act']=='Update') {

			$mySql = "UPDATE settings
			SET literal='".$_GET['literal']."', value='".$_GET['value']."'
			WHERE idSetting=".$_GET['idSetting'];

			$connexio = connect();
			$resultNewSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			
				
			}

		echo listSettings();

		}


function listSettings(){
	$mySql = "SELECT idSetting, literal, value FROM settings";

			$connexio = connect();
			$resultSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			$dataSettings = "[";
			$i = 0;
			while($row = mysqli_fetch_array($resultSettings))
			{
				if($i != 0)
				{
					$dataSettings .= ",";
				}
				$dataSettings .= '{"literal":"'.$row['literal'].'", "idSetting":"'.$row['idSetting'].'", "value":"'.$row['value'].'"}'; 
				$i++;
			}
			$dataSettings .= "]";
			return $dataSettings;
}












//todo 
		//else if(isset($_GET['acc']) && $_GET['acc'] == 'edit')
		// {
		// 	$idShop=$_GET['idShop'];
		// 	$mySql = "SELECT s.name, s.lng, s.lat, s.logo, s.telephone, s.email, s.address, s.schedule, s.description, s.descriptionLong, s.url AS web, s.cp, s.ciutat, si.url
		// 			FROM shops s, shopsimages si
		// 			WHERE si.preferred = 'Y'
		// 			AND s.idShop =".$idShop."
		// 			AND si.idShop =".$idShop;

		// 	$connexio = connect();

		// 	$resultShop = mysqli_query($connexio, $mySql);

		// 	disconnect($connexio);

		// 	$i = 0;
		// 	$dataShop = "[";
		// 	while($row = mysqli_fetch_array($resultShop))
		// 	{
		// 		if($i != 0) $dataShop .= ",";

		// 		$dataShop .= '{"name":"'.$row['name'].'", "lng":"'.$row['lng'].'", "lat":"'.$row['lat'].'", "logo":"'.$row['logo'].'", "telephone":"'.$row['telephone'].'", "email":"'.$row['email'].'", "address":"'.$row['address'].'", "schedule":"'.$row['schedule'].'", "description":"'.$row['description'].'", "descriptionLong":"'.$row['descriptionLong'].'", "web":"'.$row['web'].'", "cp":"'.$row['cp'].'", "ciutat":"'.$row['ciutat'].'", "imagePreferred":"'.$row['url'].'", "images":';
		// 		$j = 0;

		// 		$dataShop .= '[';
		// 		$mySql = "SELECT si.url
		// 		FROM shopsimages si
		// 		WHERE si.preferred = 'N'
		// 		AND si.idShop =".$idShop;

		// 		$connexio = connect();
		// 		$resultImgShop = mysqli_query($connexio, $mySql);
		// 		disconnect($connexio);

		// 		while($row = mysqli_fetch_array($resultImgShop))
		// 		{
		// 			if($j != 0) $dataShop .= ",";

		// 			$dataShop .= '{"image":"'.$row['url'].'"}';

		// 			$j++;
		// 		}
		// 		$dataShop .= ']}';
		// 		$i++;
		// 	}
		// 	$dataShop .= "]";

		// 	echo $dataShop;
		// }
		// todo
		//else if(isset($_GET['acc']) && $_GET['acc'] == 'delete')
		// {
		// 	//TODO: Hay que borrar tambien los archivos fisicos
			
		// 	$idShop=$_GET['idShop'];
		// 	$mySql = "DELETE FROM shopsimages WHERE idShop = $idShop";

		// 	$connexio = connect();

		// 	$deleteShop = mysqli_query($connexio, $mySql);

		// 	$mySql = "	DELETE FROM shops WHERE idShop = $idShop";

		// 	$connexio = connect();

		// 	$deleteShop = mysqli_query($connexio, $mySql);

		// 	disconnect($connexio);

		// 	// if($deleteShop)
		// 	// {
		// 	// 	echo "eliminado";
		// 	// }
		// 	// else echo "no eliminado";

		// 	echo $mySql;
		// }

?>