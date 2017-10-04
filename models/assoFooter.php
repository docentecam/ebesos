<?php 
require("../inc/functions.php");
	
if (isset($_GET["acc"])&& ($_GET["acc"] == "assoFooter"))
	{
		$mySql = "SELECT idUser, logo FROM users ORDER BY idUser";
		$connexio = connect();
		$resultAssoFooter = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataAssoFooter ="[";
		while ($row=mySqli_fetch_array($resultAssoFooter))
		{
			if($i != 0)
			{
				$dataAssoFooter .= ",";				
			}			
			$dataAssoFooter .= '{"idUser":"'.$row['idUser'].'","logo":"'.$row['logo'].'"}';
			$i++;
		}
		$dataAssoFooter .="]";
		echo $dataAssoFooter;
	 }
?>