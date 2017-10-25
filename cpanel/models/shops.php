<?php
require('../inc/functions.php');

if(isset($_GET['acc']) && $_GET['acc'] == 'list')
{
session_start();
			FROM shops LEFT OUTER JOIN shopsimages ON shops.idShop = shopsimages.idShop AND
			shopsimages.preferred = 'Y';";
			

	$connexio = connect();

	$resultShops = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	$dataShops = "[";
	$i = 0;
	while($row = mysqli_fetch_array($resultShops))
	{
		$i++;
	}
	$dataShops .= "]";

	echo $dataShops;
}
{






		







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
else if(isset($_GET['acc']) && $_GET['acc'] == 'loginC'){
		$message='';
		$mySql = "SELECT idShop, privileges FROM shops 
					WHERE email='".$_GET['email']."' AND passAplication='".sha1(md5($_GET['password']))."'";
		$connexio = connect();
		$resultLogin = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$checkLogin="0";
		while ($row=mySqli_fetch_array($resultLogin))
		{
			
			$checkLogin = $row['idShop'];
			$getPrivileges = $row['privileges'];
		}
	 	

	 	if($checkLogin == "0")
	 	{
	 		$message = "L'usuari o la contrasenya no són correctes";
	 	}
	 	else if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al conectar";
	 	}
	 	else
	 	{
	 		$message = "Correct";
	 		session_start();
	 		$_SESSION['user']['idUser'] = $checkLogin;
	 		$_SESSION['user']['privileges'] = $getPrivileges;
	 	}

	 	echo '[{"status":"'.$message.'"}]';
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