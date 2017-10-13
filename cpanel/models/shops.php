<?php
require('../inc/functions.php');

if(isset($_GET['acc']) && $_GET['acc'] == 'list')
{
	$mySql = "SELECT si.url, s.idShop, s.name, s.description
			FROM shopsimages si, shops s
			WHERE si.preferred='Y'
			AND s.idShop = si.idShop";
			

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
		$dataShops .= '{"image":"'.$row['url'].'", "idShop":"'.$row['idShop'].'", "name":"'.$row['name'].'", "description":"'.$row['description'].'"}'; 
		$i++;
	}
	$dataShops .= "]";

	echo $dataShops;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'edit')
{
	$idShop=$_GET['idShop'];
	$mySql = "SELECT s.idShop, s.name, s.lng, s.lat, s.logo, s.telephone, s.email, s.address, s.schedule, s.description, s.descriptionLong, s.url AS web, s.cp, s.ciutat, s.idUser
			FROM shops s
			WHERE s.idShop =".$idShop;

	$connexio = connect();

	$resultDataShop = mysqli_query($connexio, $mySql);

	$i = 0;
	$dataShop = "[";
	while($row = mysqli_fetch_array($resultDataShop))
	{
		if($i != 0) $dataShop .= ",";

		$dataShop .= '{"idShop":"'.$row['idShop'].'", "name":"'.$row['name'].'", "lng":"'.$row['lng'].'", "lat":"'.$row['lat'].'", "logo":"'.$row['logo'].'", "telephone":"'.$row['telephone'].'", "email":"'.$row['email'].'", "address":"'.$row['address'].'", "schedule":"'.$row['schedule'].'", "description":"'.$row['description'].'", "descriptionLong":"'.$row['descriptionLong'].'", "web":"'.$row['web'].'", "cp":"'.$row['cp'].'", "ciutat":"'.$row['ciutat'].'", "idUser":"'.$row['idUser'].'"';

		$dataShop .= ', "images":';

		$dataShop .= listImages($idShop);
		
		$dataShop .= ', "subCategoriesShop":';

		$dataShop .= listShopCategoriesSub($idShop);

		$dataShop .= ', "users":';

		$dataShop .= listUsers($idShop);

		$dataShop .= ', "subCategories":';

		$dataShop .= listCategoriesSub($idShop);

		$dataShop .= '}';
		$i++;
	}
	$dataShop .= "]";

	echo $dataShop;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'delete')
{
	//TODO: Hay que borrar tambien los archivos fisicos
	
	$idShop=$_GET['idShop'];
	$mySql = "DELETE FROM shopsimages WHERE idShop = $idShop";

	$connexio = connect();

	$deleteShop = mysqli_query($connexio, $mySql);

	$mySql = "	DELETE FROM shops WHERE idShop = $idShop";

	$connexio = connect();

	$deleteShop = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	echo $mySql;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'delsc')
{	
	$idShop = $_GET['idShop'];
	$idShopCategorySub = $_GET['idShopCategorySub'];
	$mySql = "DELETE FROM shopcategoriessub WHERE idShopCategorySub = $idShopCategorySub AND idShop = $idShop;";

	$connexio = connect();

	$deleteShopCategorySub = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	//echo $mySql;
	echo '[{"shopCategories":'.listShopCategoriesSub($idShop).', "categoriesSub":'.listCategoriesSub($idShop).'}]';
}
function listCategoriesSub($idShop)
{
	
	$mySql = "SELECT cs.idSubCategory, cs.name
			FROM categoriessub cs
			WHERE cs.idSubcategory NOT IN (SELECT scs.idSubCategory 
			FROM shopcategoriessub scs
			WHERE scs.idShop = $idShop)";

	$connexio = connect();

	$resultSubCategories = mysqli_query($connexio, $mySql);

	disconnect($connexio);
	$i = 0;

	$datasc = '[';
	while($row = mysqli_fetch_array($resultSubCategories))
	{
		if($i != 0) $datasc .= ",";

		$datasc .= '{"idSubCategory":"'.$row['idSubCategory'].'", "nameSubCategory":"'.$row['name'].'"}';

		$i++;
	}
	$datasc .= ']';

	return $datasc;
}

function listShopCategoriesSub($idShop)
{
	$m = 0;
	$mySql = "SELECT scs.idShopCategorySub, cs.name AS NameSubCategory, scs.preferred, scs.idSubCategory
			FROM categories c, categoriessub cs, shopcategoriessub scs
			WHERE scs.idShop = $idShop
			AND cs.idSubCategory = scs.idSubCategory
			AND c.idCategory = cs.idCategory
			ORDER BY scs.preferred = 'Y' DESC";

	$connexio = connect();

	$resultSubCategoriesShop = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	$datascs = '[';
	while($row = mysqli_fetch_array($resultSubCategoriesShop))
	{
		if($m != 0) $datascs .= ",";

		$datascs .= '{"idShopCategorySub":"'.$row['idShopCategorySub'].'", "nameSubCategoryShop":"'.$row['NameSubCategory'].'", "preferred":"'.$row['preferred'].'", "idSubcategory":"'.$row['idSubCategory'].'"}';

		$m++;
	}
	$datascs .= ']';

	return $datascs;
}
function listImages($idShop)
{
	$j = 0;

	$mySql = "SELECT si.idShopImage, si.preferred, si.url
			FROM shopsimages si
			WHERE si.idShop = $idShop";

	$connexio = connect();

	$resultImgShop = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	$datai = '[';
	while($row = mysqli_fetch_array($resultImgShop))
	{
		if($j != 0) $datai .= ",";

		$datai .= '{"idShopImage":"'.$row['idShopImage'].'", "preferred":"'.$row['preferred'].'", "url":"'.$row['url'].'"}';

		$j++;
	}
	$datai .= "]";

	return $datai;
}
function listUsers()
{
	$n = 0;

	$datau = '[';
	$mySql = "SELECT u.idUser, u.name
			FROM users u
			WHERE u.privileges != 'S'";

	$connexio = connect();

	$resultAsso = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	while($row = mysqli_fetch_array($resultAsso))
	{
		if($n != 0) $datau .= ",";

		$datau .= '{"idUser":"'.$row['idUser'].'", "name":"'.$row['name'].'"}';

		$n++;
	}
	$datau .= "]";

	return $datau;
}
?>