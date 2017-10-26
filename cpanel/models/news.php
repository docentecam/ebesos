<?php 
require("../inc/functions.php");

	if(isset($_GET['acc']) && $_GET['acc'] == 'news'){

		$mySql = "SELECT n.idNew , n.idUser,.n.titleSub , DATE_FORMAT( n.date,'%d-%M-%Y') AS fecha, n.title , w.url";

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


			$dataNews .= '{"url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['fecha'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'"}';
		
			$i++;
		}
		$dataNews .=']';

		 echo $dataNews;	 
	}	


	if(isset($_GET['acc']) && $_GET['acc'] == 'newSel'){


	$mySql = "SELECT n.idNew , n.idUser, n.titleSub ,DATE_FORMAT( n.date,'%Y-%m-%d') AS fecha, n.title";

	$mySql .= " FROM news n WHERE n.idNew=".$_GET["idNew"];

	$connexio = connect();
	$resultNews = mysqli_query($connexio, $mySql);
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


			$dataNews .= '{"title":"'.$row['title'].'","date":"'.$row['fecha'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'","url":';

			$j = 0;

			$dataNews .= '[';
			$mySql = "SELECT idNewMedia, url , type, preferred
					FROM  news n, newsmedia w
					WHERE n.idNew=w.idNew AND w.idNew=".$_GET["idNew"];

			$resultImgs = mysqli_query($connexio, $mySql);

			while($row = mysqli_fetch_array($resultImgs))
			{
				if($j != 0) $dataNews .= ",";

				$dataNews .= '{"idNewMedia":"'.$row['idNewMedia'].'","url":"'.$row['url'].'", "type":"'.$row['type'].'", "preferred":"'.$row['preferred'].'"}';

				$j++;
			}

			$dataNews .=']';

		$i++;

		}
		$dataNews .='}]';
		echo $dataNews;	 
	}


	if(isset($_GET['acc']) && $_GET['acc'] == 'img'){


		$mySql = "UPDATE  n.idNew , n.idUser,.n.titleSub , n.date, n.title , w.url";
		$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y'AND n.idUser=1";//.$_GET["idUser"];

		$connexio = connect();
		$modifyImgPref = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		return $modifyImgPref;


	}	



	if(isset($_GET['acc']) && $_GET['acc'] == 'delete'){  
		$mySql = "DELETE";
		$mySql .= " FROM `newsmedia` where idNewMedia=".$_GET["idNewMedia"];

		$connexio = connect();
		$deleteImg = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		

	}		

	if(isset($_GET['acc']) && $_GET['acc'] == 'changeImgPeferred'){


		$mySql = "UPDATE  n.idNew , n.idUser,.n.titleSub , n.date, n.title , w.url";
		$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y'AND n.idUser=1";//.$_GET["idUser"];

		$connexio = connect();
		$modifyImgPref = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		return $modifyImgPref;


	}	

?>