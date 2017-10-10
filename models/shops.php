<?php
require('../inc/functions.php');

		if(isset($_GET['acc']) && $_GET['acc'] == 'l')
		{
			$idUser=$_GET['idUser'];
			$mySql= "SELECT idShop, name
					FROM shops
					WHERE idUser=".$_GET['idUser'];
					

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
	
		else if(isset($_GET['acc']) && $_GET['acc'] == 'shop') //modificar
		{
			$idShop=$_GET['idShop'];
			$mySql= "SELECT s.idShop, s.name AS NameShop, s.address, s.cp, s.ciutat, s.telephone, s.descriptionLong, s.schedule, s.logo, 
					u.name AS NameAssociacio, c.name AS NameCategory, cs.name AS NameSubCategory, si.url AS ImagePreferred
					FROM shops s, users u, categories c, categoriessub cs, shopcategoriessub scs, shopsimages si
					WHERE u.idUser = s.idUser
					AND scs.idShop = s.idShop
					AND cs.idSubCategory = scs.idSubCategory
					AND c.idCategory = cs.idCategory
					AND scs.preferred = 'Y'
					AND si.preferred = 'Y'
					AND si.idShop = $idShop
					AND s.idShop = $idShop";
					

			$connexio = connect();

			$resultShops = mysqli_query($connexio, $mySql);

			disconnect($connexio);

			$i = 0;
			$dataShops = "[";
			while($row = mysqli_fetch_array($resultShops))
			{
				if($i != 0) $dataShops .= ",";

				$dataShops .= '{"nameShop":"'.$row['NameShop'].'", "idShop":"'.$row['idShop'].'", "telephone":"'.$row['telephone'].'", "cp":"'.$row['cp'].'", "schedule":"'.$row['schedule'].'", "address":"'.$row['address'].'", "ciutat":"'.$row['ciutat'].'", "descriptionLong":"'.$row['descriptionLong'].'", "logo":"'.$row['logo'].'", "nameCategory":"'.$row['NameCategory'].'", "nameAssociacio":"'.$row['NameAssociacio'].'", "nameSubCategory":"'.$row['NameSubCategory'].'", "imagePref":"'.$row['ImagePreferred'].'", "imgUrl":';
				$j = 0;

				$dataShops .= '[';
				$mySql = "SELECT si.url 
				FROM shopsimages si
				WHERE si.preferred = 'N'
				AND si.idShop =".$idShop;

				$connexio = connect();
				$resultImgShops = mysqli_query($connexio, $mySql);
				disconnect($connexio);

				while($row=mysqli_fetch_array($resultImgShops))
				{
					if($j != 0) $dataShops .= ",";

					$dataShops .= '{"url":"'.$row['url'].'"}';

					$j++;
				}
				$dataShops .= ']}';
				$i++;
			}
			$dataShops .= "]";

			echo $dataShops;
		}

?>