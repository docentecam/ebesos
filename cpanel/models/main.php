<?php
require("../inc/functions.php");
if (isset($_GET["acc"])&& ($_GET["acc"] == "main"))
	{
		$mySql = "SELECT idUser, logo FROM users WHERE idUser=1";
		$connexio = connect();
		$resultMain = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataMain ="[";
		while ($row=mySqli_fetch_array($resultMain))
		{
			if($i != 0)
			{
				$dataMain .= ",";				
			}			
			$dataMain .= '{"idUser":"'.$row['idUser'].'","logo":"'.$row['logo'].'"}';
			$i++;
		}
		$dataMain .="]";
		echo $dataMain;
	 }
?>