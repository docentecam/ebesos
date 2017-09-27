<?php
require('../inc/functions.php');

		if(isset($_GET['acc']) && $_GET['acc'] == 'list')
		{
			$mySql= "SELECT si.url, s.name, s.description
					FROM shopsimages si, shops s
					WHERE si.preferred='Y'";
					

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
				$dataShops .= '{"image":"'.$row['url'].'", "name":"'.$row['name'].'", "description":"'.$row['description'].'"}'; 
				$i++;
			}
			$dataShops .= "]";

			echo $dataShops;
		}

?>