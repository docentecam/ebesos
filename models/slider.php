<?php 
require("../inc/functions.php");
	
if (isset($_GET["acc"])&& ($_GET["acc"] == "imgSlider"))
	{
		$mySql = "SELECT image, link, description,title, subtitle FROM slider";
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
			$dataImgSlider .= '{"image":"'.$row['image'].'","link":"'.$row['link'].'","description":"'.$row['description'].'","title":"'.$row['title'].'","subtitle":"'.$row['subtitle'].'"}';
			$i++;
		}
		$dataImgSlider .="]";
		echo $dataImgSlider;
	 }
?>