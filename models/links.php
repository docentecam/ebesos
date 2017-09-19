<?php 
require("../inc/functions.php");
	if (isset($_GET["acc"])&& ($_GET["acc"] == "links"))
	{
		$mySql = "SELECT url, description FROM links";
		$connexio = connect();
		$resultLinks = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataLinks ='[';
		while ($row=mySqli_fetch_array($resultLinks))
		{	
			if($i != 0)
			{
				$dataLinks .= ",";
				
			} 
			$dataLinks .= '{"url":"'.$row['url'].'", "description":"'.$row['description'].'"}';
			$i++;
		}
		$dataLinks .=']';
		echo $dataLinks;
	 }
?>