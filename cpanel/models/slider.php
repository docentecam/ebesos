<?php 
require("../inc/functions.php");
	
if (isset($_GET["acc"])&& ($_GET["acc"] == "imgSlider"))
	{
		$mySql = "SELECT image, link, description FROM slider";
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
			$dataImgSlider .= '{"image":"'.$row['image'].'","link":"'.$row['link'].'","description":"'.$row['description'].'"}';
			$i++;
		}
		$dataImgSlider .="]";
		echo $dataImgSlider;
	 }

	// function editImgSlider($idUsuari="",$nom,$cog1,$cog2,$telf1,$telf2,$email,$direc,$direcPlta,$direcPrta,$direcEsc,$cp)
	// {
	// 	$connexio = connect();
	// 	$mySql = "UPDATE usuaris SET nom='$nom',cog1='$cog1',cog2='$cog2',telf1='$telf1',telf2='$telf2',email='$email',direc='$direc',direcPlta='$direcPlta',direcPrta='$direcPrta',direcEsc='$direcEsc',cp='$cp',assessor='$assessor' WHERE idUsuari='$idUsuari'"; 

	// 	$modifyUsuarios = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);

	// 	return ($modifyUsuarios);
?>