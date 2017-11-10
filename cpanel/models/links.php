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
	else if (isset($_GET["acc"]) && ($_GET["acc"] == "createLink"))
	{
		$mySql = 'INSERT INTO links (url, description)
				VALUES ("'.$_GET['url'].'","'.$_GET['name'].'")';
		if($_GET['idLink'])
		{
			$mySql = 'UPDATE links
				SET url="'.$_GET['url'].'", description="'.$_GET['name'].'" 
				WHERE idLink='.$_GET['idLink'];
		}
		$connexio = connect();
		$resultLinksC = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$message = "S'ha creat el link";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
	 	else if($_GET['idLink'])
		{
			$message = "S'ha modificat el link";
		}
		echo '[{"status":"'.$message.'"}]';		
	}
	else if (isset($_GET['acc']) && $_GET['acc'] == 'deleteLink') {
		$message='';

		$mySql = "DELETE FROM links
					WHERE idLink=".$_GET['idLink'];
		
		$connexio = connect();
		$resultLinksD = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		
		$message = "S'ha eliminat el link";
		if($connexio == "Error al conectar")
	 	{
	 		$message = "Error al connectar";
	 	}
		echo '[{"status":"'.$message.'"}]';
	}

?>