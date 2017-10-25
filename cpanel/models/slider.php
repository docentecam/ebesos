<?php 
require("../inc/functions.php");
	

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
		$mySql = "SELECT idSlider, description, title, subtitle, link FROM slider WHERE idSlider =".$_GET['idSlider'];
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
				$dataSlider .= '{"idSlider":"'.$row['idSlider'].'", "link":"'.$row['link'].'", "description":"'.$row['description'].'", "title":"'.$row['title'].'", "subTitle":"'.$row['subtitle'].'"}'; 
				$i++;
			}
			$dataSlider .= "]";

			echo $dataSlider;
	}

	else if (isset($_GET['acc']) && $_GET['acc'] == 'updateSlider') {
		$mySql = "UPDATE slider
				SET title='".$_GET['title']."', subtitle='".$_GET['subTitle']."', link='".$_GET['linkSlider']."', description='".$_GET['description']."' 
				WHERE idSlider=".$_GET['idSlider'];
		$connexio = connect();
		$updateSliderData = mysqli_query($connexio, $mySql);
		disconnect($connexio);
	}

	// function editImgSlider($idUsuari="",$nom,$cog1,$cog2,$telf1,$telf2,$email,$direc,$direcPlta,$direcPrta,$direcEsc,$cp)
	// {
	// 	$connexio = connect();
	// 	$mySql = "UPDATE usuaris SET nom='$nom',cog1='$cog1',cog2='$cog2',telf1='$telf1',telf2='$telf2',email='$email',direc='$direc',direcPlta='$direcPlta',direcPrta='$direcPrta',direcEsc='$direcEsc',cp='$cp',assessor='$assessor' WHERE idUsuari='$idUsuari'"; 

	// 	$modifyUsuarios = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);

	// 	return ($modifyUsuarios);
?>