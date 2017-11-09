<?php 
require("../../inc/functions.php");
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");


	if (isset($_GET["acc"]) && ($_GET["acc"] == "l"))
	{
		$mySql = "SELECT idLink, url, description FROM links";
		$connexio = connect();
		$resultLinks = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$i=0;
		$dataLinks ="[";
		while ($row=mySqli_fetch_array($resultLinks))
		{
			if($i != 0)
			{
				$dataLinks .= ",";				
			}			
			$dataLinks .= '{"idLink":"'.$row['idLink'].'","url":"'.$row['url'].'","description":"'.$row['description'].'"}';
			$i++;
		}
		$dataLinks .="]";
		echo $dataLinks;
	}

?>