<?php
require('../inc/functions.php');


if(isset($_GET['acc'])&&$_GET['acc']=='news'){

	$mySql = "SELECT n.idNew , n.date, n.title ,w.idNew, w.url,w.preferred";

	$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y'";

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

			$dataNews .= '{"url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date']'"}';
			$i++;
		}
		$dataNews .=']';
		echo $dataNews;

}

?>