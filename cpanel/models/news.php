<?php 
require("../inc/functions.php");

	if(isset($_GET['acc']) && $_GET['acc'] == 'login'){

		$mySql = "SELECT n.idNew , n.idUser , n.date, n.title ,w.idNew, w.url,w.preferred";

	$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y' AND n.idUser=".$_GET["idUser"];

	$connexio = connect();
	$resultNews = mysqli_query($connexio, $mySql);
	disconnect($connexio);

	$i=0;
		$dataNews ='[';
		while ($row=mySqli_fetch_array($resultNews))
		{	
			if($i != 0)
			{
				$dataNews .= ",";
			} 

			$dataNews .= '{"url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date'].'","idNew":"'.$row['idNew'].'"}';
			$i++;
		}
		$dataNews .=']';

		echo $dataNews;
	}	


}