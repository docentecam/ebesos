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

if (isset($_GET["acc"])&& ($_GET["acc"] == "assoTopImage"))
	{
		$mySql = "SELECT idUser, logo FROM users WHERE idUser=1";
		$connexio = connect();
		$resultAssoTopImage = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataAssoTopImage ="[";
		while ($row=mySqli_fetch_array($resultAssoTopImage))
		{
			if($i != 0)
			{
				$dataAssoTopImage .= ",";				
			}			
			$dataAssoTopImage .= '{"idUser":"'.$row['idUser'].'","logo":"'.$row['logo'].'"}';
			$i++;
		}
		$dataAssoTopImage .="]";
		echo $dataAssoTopImage;
	 }
?>