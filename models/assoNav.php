<?php 
require("../inc/functions.php");
	
if (isset($_GET["acc"])&& ($_GET["acc"] == "assoNav"))
	{
		$mySql = "SELECT idUser, name, logo, privileges FROM users WHERE idUser>1 ORDER BY name";
		$connexio = connect();
		$resultAssoNav = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataAssoNav ="[";
		while ($row=mySqli_fetch_array($resultAssoNav))
		{
			if($i != 0)
			{
				$dataAssoNav .= ",";				
			}			
			$dataAssoNav .= '{"idUser":"'.$row['idUser'].'","name":"'.$row['name'].'","logo":"'.$row['logo'].'","privileges":"'.$row['privileges'].'"}';
			$i++;
		}
		$dataAssoNav .="]";
		echo $dataAssoNav;
	 }
?>