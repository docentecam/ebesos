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
			$resultNewPromotionUpdate = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			
				
	}

	else if (isset($_POST['idPromotion']) && $_POST['idPromotion']==0) {
		$mySql = "INSERT INTO `promotions` (`idPromotion` , `idShop`,`oferVals`,`conditionsVals`,`dateExpireVals`,`oferEix`,`conditionsEix`,`dateExpireEix`,`image`,`active`)
		VALUES (NULL,  ".$_POST['shopSelected'].",'".$_POST['oferVals']."', '".$_POST['conditionsVals']."', '".$_POST['dateExpireVals']."','".$_POST['oferEix']."', '".$_POST['conditionsEix']."', '".$_POST['dateExpireEix']."','nofoto.png','";
		if ($_SESSION['user']['privileges']!="S")  $mySql.= "Y"; 

		$mySql .= "')";
		$fp=fopen("_pruebaPromotion.txt",'w');
					fputs($fp,'consulta:'.$mySql);
		$connexio = connect();
			$resultNewPromotion = mysqli_query($connexio, $mySql);
			$resultidPromotion=mysqli_insert_id($connexio);
			disconnect($connexio);


		if(!isset($_POST['imageChange']) ){
							$file = $resultidPromotion."-".$_FILES['imageChange']["name"];
							move_uploaded_file($_FILES['imageChange']["tmp_name"], "../../img/promotions/".$file);
			 				if ($_POST['imageActual']!='nofoto.png') {
								unlink("../../img/promotions/".$_POST['imageActual']);
								
			 				}
						$mySql= 'UPDATE promotions SET image="'.$file.'"';
						   
						$mySql.=' WHERE idPromotion='.$resultidPromotion;	

						$connexio = connect();
						$resultNewPromotion = mysqli_query($connexio, $mySql);
			
			disconnect($connexio);

					}
}			
				
}

if(isset($_GET['acc']) && $_GET['acc'] == 'a'){
	$mySql = "UPDATE promotions
			SET active='".$_GET['active']."'
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

	// $mySql = "SELECT idPromotion , oferVals, oferEix, image , conditionsVals, conditionsEix , active ,dateExpireVals, DATE_FORMAT( dateExpireVals,'%d-%m-%Y') AS  dateExpireValsE,dateExpireEix, DATE_FORMAT( dateExpireEix,'%d-%m-%Y') AS dateExpireEixE,idShop FROM promotions ";

	$mySql = "SELECT idPromotion , oferVals, oferEix, image , conditionsVals, conditionsEix , promotions.active ,dateExpireVals, DATE_FORMAT( dateExpireVals,'%d-%m-%Y') AS dateExpireValsE,dateExpireEix, DATE_FORMAT( dateExpireEix,'%d-%m-%Y') AS dateExpireEixE,shops.idShop FROM promotions, shops WHERE promotions.idShop=shops.idShop ";



	$mySqlShops = "SELECT * FROM shops";
	if($_SESSION['user']['idUser']!="1"){
		$mySqlShops.=" WHERE idUser='".$_SESSION['user']['idUser']."'";
		$mySql .= " AND shops.idUser=".$_SESSION['user']['idUser'];

	}

		 	
	if (isset($_GET['idPromotion']))
	{
		$mySql .= " AND idPromotion=".$_GET['idPromotion'];
	}
$fp=fopen("_pruebaPromotion.txt",'w');
					fputs($fp,'consulta:'.$mySql.'cons shops'.$mySqlShops);
	
	$connexio = connect();

	$resultPromotions = mysqli_query($connexio, $mySql);
	$resultShops = mysqli_query($connexio, $mySqlShops);
	disconnect($connexio);
	$dataPromotions = '[{"dataPromotions":[';

	$i = 0;
	while($row = mysqli_fetch_array($resultPromotions))
	{
		if($i != 0) $dataPromotions .= ",";

		$dataPromotions .= '{"conditionsEix":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['conditionsEix']).'","oferEix":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['oferEix']).'","oferVals":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['oferVals']).'","dateExpireVals":"'.$row['dateExpireVals'].'","dateExpireEix":"'.$row['dateExpireEix'].'","dateExpireValsE":"'.$row['dateExpireValsE'].'","dateExpireEixE":"'.$row['dateExpireEixE'].'","idPromotion":"'.$row['idPromotion'].'","idShop":"'.$row['idShop'].'","active":"'.$row['active'].'","image":"'.$row['image'].'","conditionsVals":"'.str_replace(array("\r\n", "\r", "\n"), "\\n",$row['conditionsVals']).'"}';

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

