<?php
require('../inc/functions.php');
session_start();

if(isset($_GET['acc']) && $_GET['acc'] == 'list')
{
	$mySql = "SELECT shopsimages.url, shops.idShop, shops.name, shops.lng, shops.lat, shops.logo, shops.telephone, shops.email, shops.address, shops.schedule, shops.description, shops.descriptionLong, shops.url AS web, shops.cp, shops.ciutat, shops.idUser
			FROM shops INNER JOIN shopsimages ON shops.idShop = shopsimages.idShop AND
			shopsimages.preferred = 'Y'";
	if($_SESSION['user']['privileges'] != 'E')
	{
		$mySql .= "AND shops.idUser =".$_SESSION['user']['idUser'];
	}

	$connexio = connect();

	$resultShops = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	$dataShops = "[";
	$i = 0;
	while($row = mysqli_fetch_array($resultShops))
	{
		if($i != 0) $dataShops .= ",";

		$dataShops .= '{"idShop":"'.$row['idShop'].'", "name":"'.$row['name'].'", "lng":"'.$row['lng'].'", "lat":"'.$row['lat'].'", "logo":"'.$row['logo'].'", "telephone":"'.$row['telephone'].'", "email":"'.$row['email'].'", "address":"'.$row['address'].'", "schedule":"'.$row['schedule'].'", "description":"'.$row['description'].'", "descriptionLong":"'.$row['descriptionLong'].'", "web":"'.$row['web'].'", "cp":"'.$row['cp'].'", "ciutat":"'.$row['ciutat'].'", "idUser":"'.$row['idUser'].'", "imgPref":"'.$row['url'].'"';
		
		$dataShops .= ', "subCategoriesShop":';

		$dataShops .= listShopCategoriesSub($row['idShop']);

		$dataShops .= '}';
		$i++;
	}
	$dataShops .= "]";

	echo $dataShops;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'e')
{
	$idShop=$_GET['idShop'];

	$dataShop = "[{";

	$dataShop .= '"images":';

	$dataShop .= listImages($idShop);
	
	$dataShop .= ', "subCategoriesShop":';

	$dataShop .= listShopCategoriesSub($idShop);

	$dataShop .= ', "subCategories":';

	$dataShop .= listCategoriesSub($idShop);

	$dataShop .= '}';
		
	$dataShop .= "]";

	echo $dataShop;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'upload')
{
	//getVariables();
	$idShop = $_POST["idShop"];
	$name = $_POST["name"];
	$idUser = $_POST["idUser"];
	$descriptionLong = $_POST["descriptionLong"];
	$description = $_POST["description"];
	$ciutat = $_POST["ciutat"];
	$logo = $_FILES["logo"]["name"];
	$web = $_POST["web"];
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$telephone = $_POST["telephone"];
	$cp = $_POST["cp"];
	$address = $_POST["address"];
	$schedule = $_POST["schedule"];
	$email = $_POST["email"];

	if(!is_dir("../files/"))
	mkdir("../files/", 0777);

	if($logo && move_uploaded_file($_FILES["logo"]["tmp_name"],	"../../img/logos-shops/".$logo))
	{
		
	}

	$fp=fopen("../files/infoShop.txt",'w');
		fputs($fp,'msg="'.$mensaje.'"');
		fputs($fp,'name="'.$name.'"');
		fputs($fp,'idUser="'.$idUser.'"');
		fputs($fp,'descriptionLong="'.$descriptionLong.'"');
		fputs($fp,'description="'.$description.'"');
		fputs($fp,'ciutat="'.$ciutat.'"');
		fputs($fp,'logo="'.$logo.'"');
		fputs($fp,'web="'.$web.'"');
		fputs($fp,'lat="'.$lat.'"');
		fputs($fp,'lng="'.$lng.'"');
		fputs($fp,'telephone="'.$telephone.'"');
		fputs($fp,'cp="'.$cp.'"');
		fputs($fp,'address="'.$address.'"');
		fputs($fp,'schedule="'.$schedule.'"');
		fputs($fp,'email="'.$email.'"');
	fclose($fp);

	if(isset($_GET['acc']) && $_GET['sentence'] == 'n')
	{
		$mySql = "INSERT INTO `ddb99266`.`shops` (`name`, `lat`, `lng`, `telephone`, `email`, `url`, `schedule`, `address`, `idUser`, `description`, `descriptionLong`, `logo`, `cp`, `ciutat`) VALUES ('".$name."', '".$lat."', '".$lng."', '".$telephone."', '".$email."', '".$url."', '".$schedule."', '".$address."', ".$idUser.", '".$description."', '".$descriptionLong."', '".$logo."', '".$cp."', '".$ciutat."');";

		$fp=fopen("../files/newShop.txt",'w');
			fputs($fp,'mySql="'.$mySql.'"');
		fclose($fp);

		// $connexio = connect();

		// $resultNewShop = mysqli_query($connexio, $mySql);

		// disconnect($connexio);
	}

	if(isset($_GET['sentence']) && $_GET['sentence'] == 'e')
	{
		$mySql = "UPDATE `ddb99266`.`shops` SET `name`='".$name."', `lat`='".$lat."', `lng`='".$lng."', `telephone`='".$telephone."', `email`='".$email."', `url`='".$url."', `schedule`='".$schedule."', `address`='".$address."', `idUser`='".$idUser."', `description`='".$description."', `descriptionLong`='".$descriptionLong."', `logo`='".$logo."', `cp`='".$cp."', `ciutat`='".$ciutat."' WHERE `idShop`='".$idShop."';";

		$fp=fopen("../files/editShop.txt",'w');
			fputs($fp,'mySql="'.$mySql.'"');
		fclose($fp);
		
		$connexio = connect();

		$resultEditShop = mysqli_query($connexio, $mySql);

		disconnect($connexio);
	}
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