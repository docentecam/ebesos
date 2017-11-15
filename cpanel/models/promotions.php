<?php
require('../../inc/functions.php');
session_start();

if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

	$mySql = "SELECT idPromotion , oferVals, oferEix, image , conditionsVals, conditionsEix , active , dateExpireVals , dateExpireEix,idShop FROM promotions ";
	$mySqlShops = "SELECT * FROM shops";
	if($_SESSION['user']['idUser']!="1"){
		$mySqlShops.=" WHERE idUser='".$_SESSION['user']['idUser']."'";
	}

		
		 	
	if (isset($_GET['idPromotion']))
	{
		if($_SESSION['user']['idUser']!="1") $mySql .= " AND";
		else $mySql .= " WHERE ";
		$mySql .= " idPromotion=".$_GET['idPromotion'];
	}


	$connexio = connect();

	$resultPromotions = mysqli_query($connexio, $mySql);
	$resultShops = mysqli_query($connexio, $mySqlShops);
	disconnect($connexio);
	$dataPromotions = '[{"dataPromotions":[';

	$i = 0;
	while($row = mysqli_fetch_array($resultPromotions))
	{
		if($i != 0) $dataPromotions .= ",";

		$dataPromotions .= '{"conditionsEix":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['conditionsEix']).'","oferEix":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['oferEix']).'","oferVals":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['oferVals']).'","dateExpireVals":"'.$row['dateExpireVals'].'","dateExpireEix":"'.$row['dateExpireEix'].'","idPromotion":"'.$row['idPromotion'].'","idShop":"'.$row['idShop'].'","active":"'.$row['active'].'","image":"'.$row['image'].'","conditionsVals":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['conditionsVals']).'"}';

		$i++;
	}
	$dataPromotions .= '],"dataShops":[';
	 $j = 0;
	while($rowShops = mysqli_fetch_array($resultShops))
	{
		if($j != 0) $dataPromotions .= ",";

		$dataPromotions .= '{"idShop":"'.$rowShops['idShop'].'","name":"'.$rowShops['name'].'"}';

		$j++;
	}
	$dataPromotions .= ']}]';

	echo $dataPromotions;
}
if(isset($_GET['acc']) && $_GET['acc'] == 'updatePromotion'){
	echo '"dato":"'.$_GET['idPromotion'].'"';
}



?>

