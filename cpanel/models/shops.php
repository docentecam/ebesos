<?php
require('../../inc/functions.php');
session_start();

if(isset($_GET['acc']) && $_GET['acc'] == 'l')
{
	//TODO: pasar a una funcion
	$idShop = "";

	if(isset($_GET['idShop'])) $idShop = $_GET['idShop'];
	
	$dataShops = listShop($idShop);
	//echo $dataShops;

	echo $dataShops;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'e')
{
	$idShop = $_GET['idShop'];

	$dataShop = "[{";

	$dataShop .= '"images":'.listImages($idShop);
	
	$dataShop .= ', "subCategoriesShop":'.listShopCategoriesSub($idShop);

	$dataShop .= ', "subCategories":'.listCategoriesSub($idShop);

	$dataShop .= '}]';

	echo $dataShop;
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'upload')
{
	$idShop = $_POST["idShop"];
	$name = $_POST["name"];
	$idUser = $_POST["idUser"];
	$descriptionLong = $_POST["descriptionLong"];
	$description = $_POST["description"];
	$ciutat = $_POST["ciutat"];
	if(isset($_FILES["logo"])) $logo = $_FILES["logo"]["name"];
	$deleteLogo = $_POST["deleteLogo"];
	$web = $_POST["web"];
	$lat = $_POST["lat"];
	$lng = $_POST["lng"];
	$telephone = $_POST["telephone"];
	$cp = $_POST["cp"];
	$address = $_POST["address"];
	$schedule = $_POST["schedule"];
	$email = $_POST["email"];

	$fp=fopen("../files/infoShop.txt",'w');
		fputs($fp,'idShop="'.$idShop.'"');
		fputs($fp,'name="'.$name.'"');
		fputs($fp,'idUser="'.$idUser.'"');
		fputs($fp,'descriptionLong="'.$descriptionLong.'"');
		fputs($fp,'description="'.$description.'"');
		fputs($fp,'ciutat="'.$ciutat.'"');
		//fputs($fp,'logo="'.$logo.'"');
		fputs($fp,'web="'.$web.'"');
		fputs($fp,'lat="'.$lat.'"');
		fputs($fp,'lng="'.$lng.'"');
		fputs($fp,'telephone="'.$telephone.'"');
		fputs($fp,'cp="'.$cp.'"');
		fputs($fp,'address="'.$address.'"');
		fputs($fp,'schedule="'.$schedule.'"');
		fputs($fp,'email="'.$email.'"');
		fputs($fp,'deleteLogo="'.$deleteLogo.'"');
	fclose($fp);

	if(!is_dir("../files/"))
	mkdir("../files/", 0777);

	if(isset($_POST["idShop"]) && $_POST["idShop"] == "0")
	{
		$mySql = 'INSERT INTO shops (`name`, `lat`, `lng`, `telephone`, `email`, `url`, `schedule`, `address`, `idUser`, `description`, `descriptionLong`, `cp`, `ciutat`) VALUES ("'.$name.'", "'.$lat.'", "'.$lng.'", "'.$telephone.'", "'.$email.'", "'.$web.'", "'.$schedule.'", "'.$address.'", "'.$idUser.'", "'.$description.'", "'.str_replace(array("\r\n", "\r", "\n"), "\\n",$descriptionLong).'", "'.$cp.'", "'.$ciutat.'");';

		$connexio = connect();

		$resultNewShop = mysqli_query($connexio, $mySql);
		if($resultNewShop)
		{
			$fp=fopen("../files/newShop.txt",'w');
				fputs($fp,'mySql="'.$mySql.'"');
			fclose($fp);
		}
		
		$idShopIns=mysqli_insert_id($connexio);
		if(isset($_FILES["logo"]))
		{
			$logo = $idShopIns."-".$logo;
			$mySql = 'UPDATE shops SET logo = "'.$logo.'" WHERE idShop='.$idShopIns;
			mysqli_query($connexio, $mySql);
			move_uploaded_file($_FILES["logo"]["tmp_name"],	"../../img/logos-shops/".$logo);
		}
		$mySql = 'INSERT INTO shopsimages (`preferred`, `idShop`, `url`) VALUES ("Y", "'.$idShopIns.'", "nofoto.png");';

		$resultNewImgPref = mysqli_query($connexio, $mySql);
		if($resultNewImgPref)
		{
			$fp=fopen("../files/newImgShop.txt",'w');
				fputs($fp,'mySql="'.$mySql.'"');
			fclose($fp);
		}

		disconnect($connexio);

		echo listShop($idShopIns);
	}
	else
	{
		$mySql = 'UPDATE shops SET `name`="'.$name.'", `lat`="'.$lat.'", `lng`="'.$lng.'", `telephone`="'.$telephone.'", `email`="'.$email.'", `url`="'.$web.'", `schedule`="'.$schedule.'", `address`="'.$address.'", `idUser`="'.$idUser.'", `description`="'.$description.'", `descriptionLong`="'.$descriptionLong.'", `cp`="'.$cp.'", `ciutat`="'.$ciutat.'"';

		if(isset($_FILES["logo"]))
		{
			$logo = $idShop."-".$logo;
			$mySql .= ', `logo`="'.$logo.'"';
			move_uploaded_file($_FILES["logo"]["tmp_name"],	"../../img/logos-shops/".$logo);
			unlink('../../img/logos-shops/'.$deleteLogo);
		}

		$mySql .= 'WHERE `idShop`="'.$idShop.'";';

		$fp=fopen("../files/editShop.txt",'w');
			fputs($fp,'mySql="'.$mySql.'"');
		fclose($fp);
		
		$connexio = connect();

		$resultEditShop = mysqli_query($connexio, $mySql);

		disconnect($connexio);

		echo listShop($idShop);
	}
}
else if (isset($_GET['acc']) && $_GET['acc'] == 'uploadImage') 
{
	$img = $_FILES["uploadedFile"]["name"];
	$idShopImage = $_POST['idShopImage'];
	$idShop = $_POST['idShop'];
	$deleteImagePref = $_POST['deleteImagePref'];

	if(isset($_GET['acc']) && $_GET['sentence'] == 'e')
	{
		$img = $idShop."-".$img;
		move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], '../../img/shops/'.$img);

		if($img != "") $mySql = 'UPDATE shopsimages SET url ="'.$img.'" WHERE idShopImage='.$idShopImage;

		$connexio = connect();

		$updateImgPref = mysqli_query($connexio, $mySql);

		disconnect($connexio);

		if($deleteImagePref != "nofoto.png") unlink('../../img/shops/'.$deleteImagePref);
	}
	else if(isset($_GET['acc']) && $_GET['sentence'] == 'n')
	{
		$img = $idShop."-".$img;
		move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], '../../img/shops/'.$img);

		$mySql = 'INSERT INTO shopsimages (`preferred`, `idShop`, `url`) VALUES ("'.N.'", "'.$idShop.'", "'.$img.'");';

		$connexio = connect();

		$updateImg = mysqli_query($connexio, $mySql);

		disconnect($connexio);
	}
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'delis')
{
	$idShopImage = $_GET['idShopImage'];
	$idShop = $_GET['idShop'];
	$deleteImage = $_GET['url'];

	$mySql = 'DELETE FROM shopsimages WHERE idShopImage="'.$idShopImage.'";';

	$connexio = connect();

	$deleteImg = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	unlink('../../img/shops/'.$deleteImage);

	echo '[{"images":'.listImages($idShop).'}]';
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'delete')
{
	//TODO: Hay que borrar tambien los archivos fisicos
	
	$idShop=$_GET['idShop'];

	$mySql = "DELETE FROM shopsimages WHERE idShop = $idShop";

	$connexio = connect();

	$deleteShopImage = mysqli_query($connexio, $mySql);

	$mySql = "DELETE FROM shops WHERE idShop = $idShop";

	$deleteShop = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	echo listShop()."}]";
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'delsc')
{	
	$idShop = $_GET['idShop'];
	$idShopCategorySub = $_GET['idShopCategorySub'];

	$mySql = "DELETE FROM shopcategoriessub WHERE idShopCategorySub = $idShopCategorySub AND idShop = $idShop;";

	$connexio = connect();

	$deleteShopCategorySub = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	echo '[{"shopCategories":'.listShopCategoriesSub($idShop).', "subCategories":'.listCategoriesSub($idShop).'}]';
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'eSubCat')
{
	$idShop = $_GET['idShop'];
	$idSubCategory = $_GET['idSubCategory'];

	$mySql = "INSERT INTO shopcategoriessub (`idShop`, `idSubCategory`, `preferred`) VALUES ('$idShop', '$idSubCategory', 'N');";

	$connexio = connect();

	$insertNewSubCat = mysqli_query($connexio, $mySql);

	echo '[{"shopCategories":'.listShopCategoriesSub($idShop).', "subCategories":'.listCategoriesSub($idShop).'}]';
}
else if(isset($_GET['acc']) && $_GET['acc'] == 'ePrefSubCat')
{	
	$idShop = $_GET['idShop'];
	$idSubCategory = $_GET['idSubCategory'];
	$mySql = "UPDATE shopcategoriessub SET preferred='N' WHERE `idShop`='$idShop';";

	$connexio = connect();

	$updateOldPref = mysqli_query($connexio, $mySql);

	$mySql = "SELECT idShopCategorySub FROM shopcategoriessub WHERE idShop=$idShop AND idSubCategory=$idSubCategory;";

	$checkNewPref = mysqli_query($connexio, $mySql);

	if(mySqli_fetch_array($checkNewPref))
	{
		$mySql = "UPDATE shopcategoriessub SET preferred='Y' WHERE idShop=$idShop AND `idSubCategory`='$idSubCategory';";

		$updateNewPref = mysqli_query($connexio, $mySql);
	}
	else
	{
		$mySql = "INSERT INTO shopcategoriessub (`idShop`, `idSubCategory`, `preferred`) VALUES ('$idShop', '$idSubCategory', 'Y');";

		$insertNewPref = mysqli_query($connexio, $mySql);		
	};

	echo '[{"shopCategories":'.listShopCategoriesSub($idShop).', "subCategories":'.listCategoriesSub($idShop).'}]';
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

else if(isset($_GET['acc']) && $_GET['acc'] == 'listImages')
{
	$idShop = $_GET['idShop'];

	echo '[{"images":'.listImages($idShop);
}
function listShop($idShop="")
{
	$i = 0;
	$mySql = "SELECT shopsimages.url, shops.idShop, shops.name, shops.description, shops.idUser";
	if($idShop != "") $mySql .= ", shops.lng, shops.lat, shops.logo, shops.telephone, shops.email, shops.address, shops.schedule, shops.descriptionLong, shops.url AS web, shops.cp, shops.ciutat";

	$mySql .= "	FROM shops LEFT JOIN shopsimages ON shops.idShop = shopsimages.idShop WHERE
			shopsimages.preferred = 'Y'";

	if($idShop != "") $mySql .= " AND shops.idShop =".$idShop;

	if($_SESSION['user']['privileges'] != 'E')	$mySql .= " AND shops.idUser =".$_SESSION['user']['idUser'];

	$connexio = connect();

	$resultShops = mysqli_query($connexio, $mySql);

	disconnect($connexio);

	$listShops = "[{";
	$listShops .= '"list":';
	$listShops .= "[";

	while($row = mysqli_fetch_array($resultShops))
	{
		if($i != 0) $listShops .= ",";

		$listShops .= '{"idShop":"'.$row['idShop'].'", "name":"'.$row['name'].'", "idUser":"'.$row['idUser'].'", "description":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['description']).'", "imgPref":"'.$row['url'].'"';

		if($idShop != "")
		{
			$listShops .= ', "lng":"'.$row['lng'].'", "lat":"'.$row['lat'].'", "logo":"'.$row['logo'].'", "telephone":"'.$row['telephone'].'", "email":"'.$row['email'].'", "address":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['address']).'", "schedule":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['schedule']).'", "descriptionLong":"'.str_replace(array("\r\n", "\r", "\n", "'\'"), "\\n",$row['descriptionLong']).'", "web":"'.$row['web'].'", "cp":"'.$row['cp'].'", "ciutat":"'.$row['ciutat'].'"';
		}

		$listShops .= '}';
		$i++;
	}
	$listShops .= "]";

	if($idShop != "")
	{
		$listShops .= ', "allSubCat":'.listAllSubCat();

		$listShops .= ', "images":'.listImages($idShop);
	
		$listShops .= ', "subCategoriesShop":'.listShopCategoriesSub($idShop);

		$listShops .= ', "subCategories":'.listCategoriesSub($idShop);
	}
	
	$listShops .= '}]';
	return $listShops;
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
function listAllSubCat()
{
	$mySql = "SELECT cs.idSubCategory, cs.name
			FROM categoriessub cs";

	$connexio = connect();

	$resultAllSubCategories = mysqli_query($connexio, $mySql);

	disconnect($connexio);
	$i = 0;

	$datasc = '[';
	while($row = mysqli_fetch_array($resultAllSubCategories))
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
			WHERE si.idShop = $idShop
			ORDER BY si.preferred = 'Y' DESC";

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