<?php
require('../../inc/functions.php');
session_start();

if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

	$mySql = "SELECT idPromotion , creation , image ,conditionsVals , active , dateExpireVals , dateExpireEix FROM promotions";


	$connexio = connect();

	$resultPromotions = mysqli_query($connexio, $mySql);
	disconnect($connexio);
	$dataPromotions = "[";

	$i = 0;
	while($row = mysqli_fetch_array($resultPromotions))
	{
		if($i != 0) $dataPromotions .= ",";

		$dataPromotions .= '{"dateExpireVals":"'.$row['dateExpireVals'].'","dateExpireEix":"'.$row['dateExpireEix'].'","idPromotion":"'.$row['idPromotion'].'","active":"'.$row['active'].'","creation":"'.$row['creation'].'","image":"'.$row['image'].'","conditionsVals":"'.$row['conditionsVals'].'"}';

		$i++;
	}
	$dataPromotions .= "]";

	echo $dataPromotions;

}


?>

