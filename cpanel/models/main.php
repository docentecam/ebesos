<?php
require('../../inc/functions.php');
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
	
if (isset($_GET["acc"])&& ($_GET["acc"] == "showActivePromotion"))
	{
		$mySql = "SELECT COUNT(promotions.idPromotion) AS promos FROM promotions, shops WHERE promotions.idShop=shops.idShop AND promotions.active='N'";
		if ($_SESSION['user']['idUser']!=1) {
			$mySql.=" AND shops.idUser=".$_SESSION['user']['idUser'];
		}
		$connexio = connect();
		$resultMain = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$numberPromos ="[";
		while ($row=mySqli_fetch_array($resultMain))
		{
			if($i != 0)
			{
				$numberPromos .= ",";				
			}			
			$numberPromos .= '{"promos":"'.$row['promos'].'"}';
			$i++;
		}
		$numberPromos .="]";
		echo $numberPromos;
	 }

	

?>


