<?php 
	error_reporting(0);
require('../../inc/functions.php');
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
else if(!isset($_GET['acc'])) { header("Location: ../index.html");}

if (isset($_GET["acc"]) && ($_GET["acc"] == "imgSlider"))
{
	$mySql = "SELECT idSlider, image, title, subtitle, link, description FROM slider";
	if(isset($_GET['idSlider'])) $mySql.= " WHERE idSlider =".$_GET['idSlider'];
	$connexio = connect();
	$resultImgSlider = mysqli_query($connexio, $mySql);
	disconnect($connexio);
	$i=0;
	$dataImgSlider ="[";
	while ($row=mySqli_fetch_array($resultImgSlider))
	{
		if($i != 0)
		{
			$dataImgSlider .= ",";				
		}			
		$dataImgSlider .= '{"idSlider":"'.$row['idSlider'].'","title":"'.$row['title'].'","subtitle":"'.$row['subtitle'].'","linkSlider":"'.$row['link'].'","description":"'.$row['description'].'","image":"'.$row['image'].'"}';
		$i++;
	}
	$dataImgSlider .="]";
	
	echo $dataImgSlider;
	if($connexio == "Error al conectar")
 	{
 		echo '[{"status":"'.$message.'"}]';
 	}
}
else if (isset($_GET['acc']) && $_GET['acc'] == 'updateSlider') {
	$message="";
	if ($_POST['idSlider'] == "0") {
		$mySql = 'INSERT INTO slider (title, subTitle, link, description) 
		 		VALUES ("'.$_POST['title'].'","'.$_POST['subTitle'].'","'.$_POST['linkSlider'].'","'.$_POST['description'].'")';
		$connexio = connect();
				$updateSliderData = mysqli_query($connexio, $mySql);
				$idSliderInsert=mysqli_insert_id($connexio);
				disconnect($connexio);
		$file = $idSliderInsert."-".$_FILES["imageChange"]["name"];
				move_uploaded_file($_FILES["imageChange"]["tmp_name"], '../../img/slider/'.$file);
		$mySql = 'UPDATE slider SET image="'.$file.'" WHERE idSlider='.$idSliderInsert;
		$connexio = connect();
		mysqli_query($connexio, $mySql);
				disconnect($connexio);
		$message = "S'ha creat la nova imatge del slider";
	}
	else {
		$mySql = 'UPDATE slider SET title="'.$_POST['title'].'", subtitle="'.$_POST['subTitle'].'", link="'.$_POST['linkSlider'].'", description="'.$_POST['description'].'"' ;
			if (isset($_FILES['imageChange'])) {
				$file = $_POST['idSlider']."-".$_FILES["imageChange"]["name"];
				move_uploaded_file($_FILES["imageChange"]["tmp_name"], '../../img/slider/'.$file);
				$mySql .= ', image = "'.$file.'"';
			}
			$mySql .= ' WHERE idSlider='.$_POST['idSlider'];
			$connexio = connect();
			$updateSliderData = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			if (isset($_FILES['imageChange']))
				unlink('../../img/slider/'.$_POST['image']);
			$message = "S'ha modificat la imatge del slider";
	}
	echo $message;
}
else if (isset($_GET['acc']) && $_GET['acc'] == 'deleteSlider') {
	$message='';	
	$mySql = "DELETE FROM slider
				WHERE idSlider=".$_GET['idSlider'];
	unlink('../../img/slider/'.$_GET['image']);
	$connexio = connect();
	$resultSlider = mysqli_query($connexio, $mySql);
	disconnect($connexio);
	
	$message = "S'ha eliminat la imatge del slider";
	if($connexio == "Error al conectar")
 	{
 		$message = "Error al connectar";
 	}
	echo '[{"status":"'.$message.'"}]';
}


	// else if (isset($_GET['acc']) && $_GET['acc'] == 'showOnlySlider') {
	// 	$mySql = "SELECT idSlider, description, title, subtitle, link, image FROM slider WHERE idSlider =".$_GET['idSlider'];
	// 	$connexio = connect();
	// 	$onlyResultSlider = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);
	// 	$dataSlider = "[";
	// 		$i = 0;
	// 		while($row = mysqli_fetch_array($onlyResultSlider))
	// 		{
	// 			if($i != 0)
	// 			{
	// 				$dataSlider .= ",";
	// 			}
	// 			$dataSlider .= '{"idSlider":"'.$row['idSlider'].'", "link":"'.$row['link'].'", "description":"'.$row['description'].'", "title":"'.$row['title'].'", "subTitle":"'.$row['subtitle'].'", "image":"'.$row['image'].'"}'; 
	// 			$i++;
	// 		}
	// 		$dataSlider .= "]";

	// 		echo $dataSlider;
	// }




		// $connexio = connect();
		// $updateSliderData = mysqli_query($connexio, $mySql);
		// disconnect($connexio);


		// $mySql = 'UPDATE slider
		// 		SET image="'.$fila.'", title="'.$_POST['title'].'", subtitle="'.$_POST['subTitle'].'", link="'.$_POST['link'].'", description="'.$_POST['description'].'" WHERE idSlider='.$_POST['idSlider'];
		// $connexio = connect();
		// $updateSliderData = mysqli_query($connexio, $mySql);
		// disconnect($connexio);

		// unlink('../../img/slider/'.$_POST['image']);

		// $message = "S'ha modificat la imatge del slider";
		// if($connexio == "Error al conectar")
	 // 	{
	 // 		$message = "Error al connectar";
	 // 	}
		// echo '[{"status":"'.$message.'"}]';
	
	// else if (isset($_GET['acc']) && $_GET['acc'] == 'updateSliderNI') {

		
	// 	$mySql = 'UPDATE slider
	// 			SET title="'.$_GET['title'].'", subtitle="'.$_GET['subTitle'].'", link="'.$_GET['linkSlider'].'", description="'.$_GET['description'].'" WHERE idSlider='.$_GET['idSlider'];
	// 	$connexio = connect();
	// 	$updateSliderData = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);

	// 	$message = "S'ha modificat la imatge del slider";
	// 	if($connexio == "Error al conectar")
	//  	{
	//  		$message = "Error al connectar";
	//  	}
	// 	echo '[{"status":"'.$message.'"}]';
	// }
	// else if (isset($_GET['acc']) && $_GET['acc'] == 'createSlider') {
	// 	$message='';

	// 	move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], '../../img/slider/'.$_FILES["uploadedFile"]["name"]);

		
	// 	$mySql = 'INSERT INTO slider (image, title, subTitle, link, description) 
	// 			VALUES ("'.$_FILES["uploadedFile"]["name"].'","'.$_POST['title'].'","'.$_POST['subTitle'].'","'.$_POST['linkSlider'].'","'.$_POST['description'].'")';
		
	// 	$connexio = connect();
	// 	$resultSlider = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);
		
	// 	$message = "S'ha creat la imatge del slider";
	// 	if($connexio == "Error al conectar")
	//  	{
	//  		$message = "Error al connectar";
	//  	}
	// 	echo '[{"status":"'.$message.'"}]';
	// }
?>