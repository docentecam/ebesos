<?php
require('../../inc/functions.php');
session_start();

if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

	$mySql = "SELECT idPromotion , creation , image ,conditionsVals FROM promotions";


	$connexio = connect();

	$resultPromotions = mysqli_query($connexio, $mySql);
	disconnect($connexio);
	$dataPromotions = "[";

	$i = 0;
	while($row = mysqli_fetch_array($resultPromotions))
	{
		if($i != 0) $dataPromotions .= ",";

		$dataPromotions .= '{"idPromotion":"'.$row['idPromotion'].'","creation":"'.$row['creation'].'","image":"'.$row['image'].'","conditionsVals":"'.$row['conditionsVals'].'"}';

		$i++;
	}
	$dataPromotions .= "]";

	echo $dataPromotions;

}


?>

