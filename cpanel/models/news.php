<?php 
require("../inc/functions.php");

	if(isset($_GET['acc']) && $_GET['acc'] == 'l'){
		$mySql = "SELECT n.idNew , n.idUser, n.titleSub, w.description , DATE_FORMAT( n.date,'%d-%M-%Y') AS fecha, n.title , w.url";

	$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y'";
	if(isset($_GET['idUser'])) $mySql.=" AND n.idUser=".$_GET["idUser"];
	if(isset($_GET['idNew'])) $mySql.=" AND n.idNew=".$_GET['idNew'];
	$mySql .= " ORDER BY fecha DESC";

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
			$dataNews .= '{"urlPreferred":"'.$row['url'].'", "descPreferred":"'.$row['description'].'", "title":"'.$row['title'].'","date":"'.$row['fecha'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'"';

			if(isset($_GET['idNew'])){
				$dataNews .= ',"images":';
				$dataNews .= listNewsMedia($_GET["idNew"]);
			}

			$dataNews .= '}';
			$i++;
		}
		$dataNews .=']';
		echo $dataNews;	 
	}	






if(isset($_GET['acc']) && $_GET['acc'] == 'delete'){  
		$mySql = "DELETE";
		$mySql .= " FROM `newsmedia` where idNewMedia=".$_GET["idNewMedia"];
		$connexio = connect();
		$deleteImg = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		//unlink("../../img/newsmedia/".$_GET["url"]); 

		echo  listNewsMedia($_GET["idNew"]);
		

	}	


	if(isset($_GET['acc']) && $_GET['acc'] == 'addImages'){  

		//TODO cambiar el paso de todo el array de file, no file a file
		 $fp=fopen("_pruebaForm.txt",'w');
		 fputs($fp,'idNew:'.$_POST['idNew']);
		 fputs($fp,'arriba escriure');
	    fputs($fp,'. descripció de la imatge:'.$_POST['descripcio']);
	    $cantImagen=$_POST['cantImagen']+1;
	    fputs($fp,'. cantImagen:'.$cantImagen);
	    $j=0;
	    while($j<$cantImagen)
	    {
	    	$numUp='uploadedFile'.$j;
	    	$file = $_FILES[$numUp]["name"];
	 
			fputs($fp,'. recibo: '.$file);
			move_uploaded_file($_FILES[$numUp]["tmp_name"], $file);
			$j++;
	    }
	     fclose($fp);	

	}		

	if(isset($_GET['acc']) && $_GET['acc'] == 'changeImgPeferred'){


		$mySql = "UPDATE  n.idNew , n.idUser,.n.titleSub , n.date, n.title , w.url";
		$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y'AND n.idUser=1";//.$_GET["idUser"];

		$connexio = connect();
		$modifyImgPref = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		return $modifyImgPref;


	}	







	function listNewsMedia($idNew)
	{	
		$mySql = "SELECT idNewMedia, url , type, preferred
					FROM  news n, newsmedia w
					WHERE n.idNew=w.idNew AND w.idNew=".$idNew;
		$connexio = connect();
		$resultImgs = mysqli_query($connexio, $mySql);
		disconnect($connexio);

		$dataNews = '[';
		$j = 0;
			while($row = mysqli_fetch_array($resultImgs))
			{
				if($j != 0) $dataNews .= ",";
				$dataNews .= '{"idNew":"'.$idNew.'","idNewMedia":"'.$row['idNewMedia'].'","url":"'.$row['url'].'", "type":"'.$row['type'].'", "preferred":"'.$row['preferred'].'"}';
				$j++;
			}

			$dataNews .=']';
			return $dataNews;
	}


	//if(isset($_GET['acc']) && $_GET['acc'] == 'newSel'){


	// $mySql = "SELECT n.idNew , n.idUser, n.titleSub ,DATE_FORMAT( n.date,'%Y-%m-%d') AS fecha, n.title";

	// $mySql .= " FROM news n WHERE n.idNew=".$_GET["idNew"];

	// $connexio = connect();
	// $resultNews = mysqli_query($connexio, $mySql);
	// disconnect($connexio);
	// $i=0;
	// $dataNews ='[';
	// 	while ($row=mySqli_fetch_array($resultNews))
	// 	{	
	// 		if($i != 0)
	// 		{
	// 			$dataNews .= ",";
	// 		} 

	// 		$row['title']=str_replace("'", "·", $row['title']);

	// 		$row['titleSub']=str_replace("'", "·", $row['titleSub']);


	// 		$dataNews .= '{"title":"'.$row['title'].'","date":"'.$row['fecha'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'","url":';

			
	// 		$dataNews .= listNewsMedia($_GET["idNew"]);

	// 	$i++;

	// 	}
	// 	$dataNews .='}]';
	// 	echo $dataNews;	 
	// }


	// if(isset($_GET['acc']) && $_GET['acc'] == 'img'){


	// 	$mySql = "UPDATE  n.idNew , n.idUser,.n.titleSub , n.date, n.title , w.url";
	// 	$mySql .= " FROM news n, newsmedia w WHERE n.idNew=w.idNew AND w.preferred='Y'AND n.idUser=1";//.$_GET["idUser"];

	// 	$connexio = connect();
	// 	$modifyImgPref = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);

	// 	return $modifyImgPref;


	// }	



	


		// $fp=fopen("../files/infoShop.txt",'w');
		// fputs($fp,'idNew:'.$_POST["idNew"]);
		// fputs($fp,'numImages:'.$numImages);
		// $connexio = connect();
		// for ($i = 0; $i < $numImages; $i++)
		// {
		// 	// fputs($fp,'fichero:'.$_POST["file".$i]);
		// 	$mySql = "INSERT INTO `newsmedia` (`idNewMedia`, `idNew`, `type`, `url`, `preferred`, `description`) VALUES (NULL, ".$_POST["idNew"].", 'I', '".$_POST["idNew"].'-'.$i.'-'.$_POST["file".$i]."', 'N', 'blabla');";
		// $instImg = mysqli_query($connexio, $mySql);



		// move_uploaded_file($_POST["file".$i],$_POST["idNew"].'-'.$i.'-'.$_POST["file".$i]);
		//move_uploaded_file($_POST["file".$i],$_POST["idNew"].'-'.$i.'-'.$_POST["file".$i]);

		// }
		// disconnect($connexio);
		
	// fclose($fp);
		
		


		//echo  listNewsMedia($_GET["idNew"]);
	





	
?>