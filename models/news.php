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

			$dataNews .= '{"url":"'.$row['url'].'","title":"'.$row['title'].'","date":"'.$row['date'].'","idNew":"'.$row['idNew'].'"}';
			$i++;
		}
		$dataNews .=']';

		echo $dataNews;
}

else if(isset($_GET['acc'] )&& $_GET['acc']=='showNew') {

$mySql = "SELECT n.idNew, n.date, n.title, n.titleSub, n.idNew, w.idNew, w.type, w.url FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y' AND w.type='I' AND n.idNew=".$_GET["idNew"] ;

	$connexio = connect();
	$resultNewImgPrefered = mysqli_query($connexio, $mySql);
	disconnect($connexio);

	$mySql = "SELECT n.idNew, w.idNew, w.type, w.url FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred = 'N' AND n.idNew=".$_GET["idNew"]." ORDER BY w.type ASC ";

	$connexio = connect();
	$resultNewImgNotPrefered = mysqli_query($connexio, $mySql);
	disconnect($connexio);

	$i=0;
	$dataNewImagePrefered ='[';
	while ($row=mySqli_fetch_array($resultNewImgPrefered))
	{	
	if($i != 0)
		{
			$dataNewImagePrefered .= ",";
		} 

		$dataNewImagePrefered .= '{"titleSub":"'.$row['titleSub'].'", "photo":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date'].'", "media":';

		$j=0;
		$dataNewImagePrefered .='[';
		while ($row=mySqli_fetch_array($resultNewImgNotPrefered))
		{	
		if($j != 0)
			{
				$dataNewImagePrefered .= ",";
			} 

			$dataNewImagePrefered .= '{"type":"'.$row['type'].'", "url":"'.$row['url'].'"}';
			$j++;
		}	
	$dataNewImagePrefered .=']';



		$dataNewImagePrefered .= '}';
		$i++;
	}	
	$dataNewImagePrefered .=']';
	echo $dataNewImagePrefered;










	// $mySql = "SELECT n.idNew, n.date, n.title, n.titleSub, n.idNew, w.idNew, w.type, w.url FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y' AND w.type='I' AND n.idNew=".$_GET["idNew"] ;

	// $connexio = connect();
	// $resultNewImgPrefered = mysqli_query($connexio, $mySql);
	// disconnect($connexio);

	// $i=0;
	// $dataNewImagePrefered ='[';
	// while ($row=mySqli_fetch_array($resultNewImgPrefered))
	// {	
	// if($i != 0)
	// 	{
	// 		$dataNewImagePrefered .= ",";
	// 	} 

	// 	$dataNewImagePrefered .= '{"titleSub":"'.$row['titleSub'].'", "url":"'.$row['url'].'", "title":"'.$row['title'].'","date":"'.$row['date'].'"}';
	// 	$i++;
	// }	
	// $dataNewImagePrefered .=']';
	// echo $dataNewImagePrefered;
	// echo "<br>";

	// $mySql = "SELECT n.idNew, w.idNew, w.type, w.url FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred = 'N' AND n.idNew=".$_GET["idNew"]." ORDER BY w.type ASC ";

	// $connexio = connect();
	// $resultNewImgNotPrefered = mysqli_query($connexio, $mySql);
	// disconnect($connexio);

	// $i=0;
	// $dataNewImgNotPrefered ='[';
	// while ($row=mySqli_fetch_array($resultNewImgNotPrefered))
	// {	
	// if($i != 0)
	// 	{
	// 		$dataNewImgNotPrefered .= ",";
	// 	} 

	// 	$dataNewImgNotPrefered .= '{"type":"'.$row['type'].'", "url":"'.$row['url'].'"}';
	// 	$i++;
	// }	
	// $dataNewImgNotPrefered .=']';
	// echo $dataNewImgNotPrefered;




// $scope.names = response.data;
// $scope.subName=$scope.names[0]['nomCampMultiple'];

// ng-repeat="name in names" //primer array
// ng-repeat="name in subName" //sub array.



	
	


}
?>