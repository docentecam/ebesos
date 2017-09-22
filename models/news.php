<?php
require('../inc/functions.php');


if(isset($_GET['acc'])&&$_GET['acc']=='news'){

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

else if(isset($_GET['acc'] )&& $_GET['acc']=='showNew') {

	$mySql = "SELECT n.idNew, n.date, n.title, n.titleSub, n.idUser, n.idNew, w.idNew, w.type, w.url FROM news n, newsmedia w WHERE n.idNew=w.idNew AND idUser=".$_GET["idUser"];

	$connexio = connect();
	$resultNew = mysqli_query($connexio, $mySql);
	disconnect($connexio);

	$i=0;
	$dataNew ='[';
	while ($row=mySqli_fetch_array($resultNew))
	{	
	if($i != 0)
		{
			$dataNew .= ",";
		} 

		$dataNew .= '{"titleSub":"'.$row['titleSub'].'", "url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date'].'"}';
		$i++;
	}	
	$dataNew .=']';
	echo $dataNew;
}

?>