<?php 
require("../inc/functions.php");
	
if (isset($_GET["acc"])&& ($_GET["acc"] == "assoFooter"))
	{
		$mySql = "SELECT idUser, footer FROM users ORDER BY idUser";
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
			$dataAssoFooter .= '{"idUser":"'.$row['idUser'].'","footer":"'.$row['footer'].'"}';
			$i++;
		}
		$dataAssoFooter .="]";
		echo $dataAssoFooter;
	 }
?>