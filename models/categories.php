<?php
	require("../inc/functions.php");

		if(isset($_GET['acc'])&&$_GET['acc']=='cat'){
			$mySql = "SELECT name, idCategory FROM categories";

			$connexio = connect();
			$resultCategories = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			$i=0;
			$dataCategories ="[";
			while ($row=mySqli_fetch_array($resultCategories))
			{
				if($i != 0) $dataCategories .= ",";

				$dataCategories .= '{"name":"'.$row['name'].'", "subCategories":';

				$j = 0;

				$dataCategories .= '[';
				$mySql = "SELECT cs.name FROM catergoriessub cs WHERE cs.idCategory = ".$row['idCategory'];

				$connexio = connect();
				$resultSubCategories = mysqli_query($connexio, $mySql);
				disconnect($connexio);

				$numSubCat = mysqli_num_rows($resultSubCategories);
				$count = 1;

				while($row=mysqli_fetch_array($resultSubCategories))
				{

					if($j != 0) $dataCategories .= ",";

					$dataCategories .= '{"name":"'.$row['name'];
					if($count<$numSubCat) $dataCategories .= ',';
					$dataCategories .='"}';
					$count++;
					
					$j++;
				}
				$dataCategories .= ']}';

				$i++;
			}
			$dataCategories .="]";
			echo $dataCategories;
		}
?>