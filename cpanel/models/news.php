<?php 
require("../inc/functions.php");

	if(isset($_GET['acc']) && $_GET['acc'] == 'news'){

		$mySql = "SELECT n.idNew , n.idUser,.n.titleSub , n.date, n.title , w.url";

	$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND n.idUser=1 AND w.preferred='Y'";//.$_GET["idUser"];

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

			$row['title']=str_replace("'", "·", $row['title']);

			$row['titleSub']=str_replace("'", "·", $row['titleSub']);


			$dataNews .= '{"url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'"}';
		
			$i++;
		}
		$dataNews .=']';

		 echo $dataNews;	 
	}	


	if(isset($_GET['acc']) && $_GET['acc'] == 'newSel'){

		$mySql = "SELECT n.idNew , n.idUser, n.titleSub , n.date, n.title ,w.idNew, w.url,w.preferred";

	$mySql .= " FROM news n, newsmedia w WHERE n.idNew=".$_GET["idNew"]." AND n.idNew=w.idNew";

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

			$row['title']=str_replace("'", "·", $row['title']);

			$row['titleSub']=str_replace("'", "·", $row['titleSub']);


			$dataNews .= '{"url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'"}';
		
			$i++;
		}
		$dataNews .=']';

		 echo $dataNews;	 
	}	

?>