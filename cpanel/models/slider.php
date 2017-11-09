<?php 
require('../../inc/functions.php');
	

//MAIN

if (isset($_GET["acc"]) && ($_GET["acc"] == "imgSlider"))
	{
		$mySql = "SELECT idSlider, image, title, subtitle, link, description FROM slider";
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
	}


//EDIT


	else if (isset($_GET['acc']) && $_GET['acc'] == 'showOnlySlider') {
		$mySql = "SELECT idSlider, description, title, subtitle, link, image FROM slider WHERE idSlider =".$_GET['idSlider'];
		$connexio = connect();
		$onlyResultSlider = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$dataSlider = "[";
			$i = 0;
			while($row = mysqli_fetch_array($onlyResultSlider))
			{
				if($i != 0)
				{
					$dataSlider .= ",";
				}
				$dataSlider .= '{"idSlider":"'.$row['idSlider'].'", "link":"'.$row['link'].'", "description":"'.$row['description'].'", "title":"'.$row['title'].'", "subTitle":"'.$row['subtitle'].'", "image":"'.$row['image'].'"}'; 
				$i++;
			}
			$dataSlider .= "]";

			echo $dataSlider;
	}

	else if (isset($_GET['acc']) && $_GET['acc'] == 'updateSlider') {

		$fila = $_POST['idSlider']."-".$_FILES["uploadedFile"]["name"];
		move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], '../../img/slider/'.$fila);

		//TODO dinamizar imagen
		$mySql = 'UPDATE slider
				SET image="'.$fila.'", title="'.$_POST['title'].'", subtitle="'.$_POST['subTitle'].'", link="'.$_POST['link'].'", description="'.$_POST['description'].'" WHERE idSlider='.$_POST['idSlider'];
		$connexio = connect();
		$updateSliderData = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		unlink('../../img/slider/'.$_POST['image']);

		$message = "S'ha modificat la imatge del slider";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'createSlider') {
		$message='';

		move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], '../../img/slider/'.$_FILES["uploadedFile"]["name"]);

		//TODO dinamizar imagen
		$mySql = 'INSERT INTO slider (image, title, subTitle, link, description) 
				VALUES ("'.$_FILES["uploadedFile"]["name"].'","'.$_POST['title'].'","'.$_POST['subTitle'].'","'.$_POST['linkSlider'].'","'.$_POST['description'].'")';
		
		$connexio = connect();
		$resultSlider = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		
		$message = "S'ha creat la imatge del slider";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'deleteSlider') {
		$message='';

		//TODO dinamizar imagen
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

	// function editImgSlider($idUsuari="",$nom,$cog1,$cog2,$telf1,$telf2,$email,$direc,$direcPlta,$direcPrta,$direcEsc,$cp)
	// {
	// 	$connexio = connect();
	// 	$mySql = "UPDATE usuaris SET nom='$nom',cog1='$cog1',cog2='$cog2',telf1='$telf1',telf2='$telf2',email='$email',direc='$direc',direcPlta='$direcPlta',direcPrta='$direcPrta',direcEsc='$direcEsc',cp='$cp',assessor='$assessor' WHERE idUsuari='$idUsuari'"; 

	// 	$modifyUsuarios = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);

	// 	return ($modifyUsuarios);
?>