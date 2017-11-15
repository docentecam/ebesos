<?php 
require("../../inc/functions.php");
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");


	if (isset($_GET["acc"]) && ($_GET["acc"] == "l"))
	{
		$mySql = "SELECT idCategory, name, urlPicto1 FROM categories";
		if(isset($_GET["name"]))
		{
			$mySql = "SELECT idCategory, name, urlPicto1 FROM categories WHERE name='".$_GET["name"]."'";
		}
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
	else if (isset($_GET["acc"]) && ($_GET["acc"] == "ls"))
	{
		$mySql = "SELECT idSubCategory, name FROM categoriessub WHERE idCategory=1";
		if(isset($_GET["idCategory"]))
		{
			$mySql = "SELECT idSubCategory, name FROM categoriessub WHERE idCategory=".$_GET["idCategory"];
		}
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
			$dataSubCat .= '{"idSubCategory":"'.$row['idSubCategory'].'","name":"'.$row['name'].'"}';
			$i++;
		}
		$dataSubCat .="]";
		echo $dataSubCat;
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'c') {
		$message='';

		$mySql = 'INSERT INTO categoriessub (name, idCategory) 
				VALUES ("'.$_GET['name'].'","'.$_GET['idCategory'].'")';
		
		$connexio = connect();
		$resultSubCat = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		
		$message = "S'ha creat la subcategoria";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'd') {
		$message='';

		$mySql = "DELETE FROM categoriessub
					WHERE idSubCategory=".$_GET['idSubCategory'];
		
		$connexio = connect();
		$resultSlider = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		
		$message = "S'ha eliminat la subcategoria";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'e') {

		$mySql = 'UPDATE categoriessub
				SET name="'.$_GET['name'].'", idCategory="'.$_GET['idCategory'].'" WHERE idSubCategory='.$_GET['idSubCategory'];
		$connexio = connect();
		$updateSliderData = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$message = "S'ha modificat la subcategoria";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
?>