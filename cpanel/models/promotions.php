<?php
require('../../inc/functions.php');
session_start();

if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

	echo listPromotions();

}

if(isset($_GET['acc']) && $_GET['acc'] == 'updatePromotion'){

 	

	if (isset($_POST['idPromotion']) && $_POST['idPromotion']!=0) {

			$mySql = 'UPDATE promotions
			SET conditionsVals="'.$_POST['conditionsVals'].'", dateExpireVals="'.$_POST['dateExpireVals'].'",dateExpireEix="'.$_POST['dateExpireEix'].'",oferVals="'.$_POST['oferVals'].'",conditionsEix="'.$_POST['conditionsEix'].'",oferEix="'.$_POST['oferEix'].'",idShop="'.$_POST['shopSelected'].'"';
			

					if(!isset($_POST['imageChange']) ){
							$file = $_POST['idPromotion']."-".$_FILES['imageChange']["name"];
							move_uploaded_file($_FILES['imageChange']["tmp_name"], "../../img/promotions/".$file);
			 				if ($_POST['imageActual']!='nofoto.png') {
								unlink("../../img/promotions/".$_POST['imageActual']);
								
			 				}
						$mySql.= ',image="'.$file.'"';
					}                                               




			$mySql.= " WHERE idPromotion=".$_POST['idPromotion'];
			$fp=fopen("_pruebaPromotion.txt",'w');
					fputs($fp,'consulta:'.$mySql);
			$connexio = connect();
			$resultNewSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			
				
	}

	else if (isset($_POST['idPromotion']) && $_POST['idPromotion']==0) {
		$mySql = "INSERT INTO promotions (idPromotion , idShop, image,oferVals,conditionsVals,dateExpireVals)
		VALUES ('', '".$_POST['oferVals']."', '".$_POST['conditionsVals']."')";
	}


}


if(isset($_GET['acc']) && $_GET['acc'] == 'a'){
	$mySql = "UPDATE promotions
			SET active='Y'
			WHERE idPromotion=".$_GET['idPromotionSelected'];

			$connexio = connect();
			$resultActivePromotion = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			echo listPromotions();
}


if(isset($_GET['acc']) && $_GET['acc'] == 'd'){
	$mySql = "DELETE FROM promotions
			WHERE idPromotion=".$_GET['idPromotionSelected'];

			$connexio = connect();
			$resultActivePromotion = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			echo listPromotions();

}
		


function listPromotions(){

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

	return $dataPromotions;
}



?>

