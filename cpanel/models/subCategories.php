<?php 
require("../../inc/functions.php");
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");


	if (isset($_GET["acc"]) && ($_GET["acc"] == "l"))
	{
		$mySql = "SELECT idCategory, name, urlPicto1 FROM categories";
		$connexio = connect();
		$resultSubCat = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataSubCat ="[";
		while ($row=mySqli_fetch_array($resultSubCat))
		{
			if($i != 0)
			{
				$dataSubCat .= ",";				
			}			
			$dataSubCat .= '{"idCategory":"'.$row['idCategory'].'","name":"'.$row['name'].'","urlPicto1":"'.$row['urlPicto1'].'"}';
			$i++;
		}
		$dataSubCat .="]";
		echo $dataSubCat;
	}


?>