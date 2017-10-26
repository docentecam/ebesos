<?php
require("../inc/functions.php");

	if (isset($_GET["acc"])&& ($_GET["acc"] == "home"))
	{
		$mySqlAssoc = "SELECT idUser, name, logo, privileges, footer FROM users ORDER BY idUser";
		$mySqlLinks = "SELECT description, url FROM links";
		$mySqlSlider = "SELECT image, link, description,title, subtitle FROM slider";
		$mySqlForm= "SELECT value FROM settings WHERE literal='urlFormacio'";

		$connexio = connect();
			$resultAsso = mysqli_query($connexio, $mySqlAssoc);
			$resultLinks = mysqli_query($connexio, $mySqlLinks);
			$resultImgSlider = mysqli_query($connexio, $mySqlSlider);
			$resultForm = mysqli_query($connexio, $mySqlForm);
		disconnect($connexio);
		
		$data ="[{";


		$data.='"associations":[';
		$i=0;
		while ($row=mySqli_fetch_array($resultAsso))
		{
			if($i != 0)
			{
				$data .= ",";				
			}			
			$data .= '{"idUser":"'.$row['idUser'].'","name":"'.$row['name'].'","logo":"'.$row['logo'].'","privileges":"'.$row['privileges'].'","footer":"'.$row['footer'].'"}';
			$i++;
		}
		$data .="],";


		$data.='"links":[';
		$i=0;
		while ($row=mySqli_fetch_array($resultLinks))
		{
			if($i != 0)
			{
				$data .= ",";				
			}			
			$data .= '{"url":"'.$row['url'].'","description":"'.$row['description'].'"}';
			$i++;
		}
		$data .="],";


		$data.='"slider":[';

		$i=0;
		while ($row=mySqli_fetch_array($resultImgSlider))
		{
			if($i != 0)
			{
				$data .= ",";				
			}			
			$data .= '{"image":"'.$row['image'].'","link":"'.$row['link'].'","description":"'.$row['description'].'","title":"'.$row['title'].'","subtitle":"'.$row['subtitle'].'"}';
			$i++;
		}
		$data .="],";

	

		$data.='"formation":[';

		$i=0;
		$row=mySqli_fetch_row($resultForm);
				
			$data .= '{"url":"'.$row[0].'"}';
			
		$data .="]";

		$data .="}]";

		echo $data;
	 }

	 

?>