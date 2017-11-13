<?php
require('../inc/functions.php');

if(isset($_GET['acc']) && ($_GET['acc']=='l')){

	$mySqlPromotions = "SELECT DISTINCT(promotions.idPromotion), promotions.image, date_format(promotions.dateExpireVals,'%d/%m/%y') as dateExpireVals, promotions.oferVals, shops.name, categories.idCategory
	FROM categories
	LEFT JOIN categoriessub ON categoriessub.idCategory = categories.idCategory
	LEFT JOIN shopcategoriessub ON shopcategoriessub.idSubCategory = categoriessub.idSubCategory
	LEFT JOIN shops ON shopcategoriessub.idShop = shops.idShop
	LEFT JOIN promotions ON promotions.idShop = shops.idShop
	WHERE promotions.oferVals IS NOT NULL
	AND promotions.dateExpireVals IS NOT NULL 
	AND promotions.active='Y'
	ORDER BY dateExpireVals";

	$mySqlFilters= "SELECT idCategory, name, urlPicto1 FROM categories";

	$mySqlWeb = "SELECT value FROM settings WHERE literal = 'urlEix'";

	$connexio = connect();
	$resultPromotions = mysqli_query($connexio, $mySqlPromotions);
	$resultFilters = mysqli_query($connexio, $mySqlFilters);
	$resultWeb = mysqli_query($connexio, $mySqlWeb);
	disconnect($connexio);
	$dades = "[{";
	$dades.='"promotions":[';
	$i = 0;
	while ($row=mySqli_fetch_array($resultPromotions))
	{
		if($i!=0) 
		{
			$dades .= ",";
		}	
		$dades .= '{"image":"'.$row['image'].'", "idPromo":"'.$row['idPromotion'].'", "offer":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['oferVals']).'", "dateExpire":"'.$row['dateExpireVals'].'", "nameShop":"'.$row['name'].'", "idCategory":"'.$row['idCategory'].'"}';
		$i++;
	}
	$dades .= "],";

	$dades .= '"filters":[';
	$i = 0;
	while ($row=mySqli_fetch_array($resultFilters))
	{
		if($i!=0) 
		{
			$dades .= ",";
		}	
		$dades .= '{"idCategory":"'.$row['idCategory'].'", "name":"'.$row['name'].'", "urlPicto1":"'.$row['urlPicto1'].'"}';
		$i++;
	}
	$dades .= "],";

	$dades .= '"web":[';
	$i = 0;
	while ($row=mySqli_fetch_array($resultWeb))
	{
		if($i!=0) 
		{
			$dades .= ",";
		}	
		$dades .= '{"urlWeb":"'.$row['value'].'"}';
		$i++;
	}
	$dades .= "]";

	$dades .= "}]";
	echo $dades;
}

if(isset($_GET['acc']) && ($_GET['acc']=='s')){
	$mySql = "SELECT p.idPromotion, p.image, date_format(p.dateExpireVals,'%d/%m/%y') as dateExpireVals, p.oferVals, p.conditionsVals, s.name, s.telephone, s.email, s.url, s.address, s.descriptionLong, s.logo FROM promotions p, shops s WHERE s.idShop = p.idShop AND p.idPromotion=".$_GET['idPromo']." ORDER BY p.dateExpireVals";
	$mySqlWeb = "SELECT value FROM settings WHERE literal = 'urlEix'";

	$connexio = connect();
	$resultPromotion = mysqli_query($connexio, $mySql);
	$resultWeb = mysqli_query($connexio, $mySqlWeb);
	disconnect($connexio);

	$dades='[{';
	$dades.='"promotion":[';

	while ($row=mySqli_fetch_array($resultPromotion))
	{
	$dades.='{"idPromo":"'.$row['idPromotion'].'", "image":"'.$row['image'].'", "dateExpire":"'.$row['dateExpireVals'].'", "offer":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['oferVals']).'", "conditions":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['conditionsVals']).'", "nameShop":"'.$row['name'].'", "phone":"'.$row['telephone'].'", "mail":"'.$row['email'].'", "url":"'.$row['url'].'", "address":"'.$row['address'].'", "descriptionLong":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['descriptionLong']).'", "logo":"'.$row['logo'].'"}';
	}
	$dades.=']';
	$dades .= ',"web":[';

	$i = 0;
	while ($row=mySqli_fetch_array($resultWeb))
	{
		if($i!=0) 
		{
			$dades .= ",";
		}	
		$dades .= '{"urlWeb":"'.$row['value'].'"}';
		$i++;
	}
	$dades .= "]";
	$dades.="}]";
	echo $dades;
}

if(isset($_GET['acc']) && ($_GET['acc']=='f')){
	$idCategory=$_GET['idCategory'];
	$mySql = "SELECT promotions.idPromotion, promotions.image, date_format(promotions.dateExpireVals,'%d/%m/%y') as dateExpireVals, promotions.oferVals, shops.name
	FROM categories
	LEFT JOIN categoriessub ON categoriessub.idCategory = categories.idCategory
	LEFT JOIN shopcategoriessub ON shopcategoriessub.idSubCategory = categoriessub.idSubCategory
	LEFT JOIN shops ON shopcategoriessub.idShop = shops.idShop
	LEFT JOIN promotions ON promotions.idShop = shops.idShop
	WHERE categories.idCategory =".$idCategory;

	$connexio = connect();
	$resultFilterCat = mysqli_query($connexio, $mySql);
	disconnect($connexio);

	//$dadesFilter = mySqli_fetch_row($resultFilterCat);
	$dades = "[";
	$i = 0;
	while ($row=mySqli_fetch_array($resultFilterCat))
	{
		if($i!=0) 
		{
			$dades .= ",";
		}	
		$dades .= '{"image":"'.$row['image'].'", "idPromo":"'.$row['idPromotion'].'", "offer":"'.$row['oferVals'].'", "dateExpire":"'.$row['dateExpireVals'].'", "nameShop":"'.$row['name'].'"}';
		$i++;
	}
	$dades .= "]";
	echo $dades;
}
?>