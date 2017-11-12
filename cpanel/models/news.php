<?php 
// Desactivar notificació d'error
	error_reporting(0);
require('../../inc/functions.php');


	if(isset($_GET['acc']) && $_GET['acc'] == 'l'){

		$preferredImg=""; $idUser=""; $idNew="";
		if(isset($_GET['preferredImg'])) $preferredImg=$_GET['preferredImg'];
		if(isset($_GET['idUser'])) $idUser=$_GET['idUser'];
		if(isset($_GET['idNew'])) $idNew=$_GET['idNew'];

		echo listNews($preferredImg, $idUser, $idNew);
	}	

if(isset($_GET['acc']) && $_GET['acc'] == 'deleteNew'){  
	
	if(isset($_GET["idNew"]))	{
		$mySql ="SELECT url FROM newsMedia WHERE idNew=".$_GET["idNew"]." AND TYPE ='I'";
		$connexio = connect();
		$resultDeleteImg = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		$deleteImg[]="";
		$i=0;
		while ($row=mySqli_fetch_array($resultDeleteImg)){
			$deleteImg[$i]=$row['url'];
			$i++;
		}
		while($i>0){
			//TODO echo "../../img/newsmedia/".$deleteImg[$i-1]."<br/>";
			if($deleteImg[$i-1]!='nofoto.png') unlink("../../img/newsmedia/".$deleteImg[$i-1]); 
			$i--;
		}
		$mySql2 ="DELETE FROM newsmedia WHERE idNew=".$_GET["idNew"];
		$mySql3 ="DELETE FROM news WHERE idNew=".$_GET["idNew"];
		//TODO echo $mySql;
		//TODO echo "<br/>".$mySql2;

		$connexio = connect();
		$resultDelete = mysqli_query($connexio, $mySql2);
		$resultDelete2 = mysqli_query($connexio, $mySql3);
		disconnect($connexio);
		//TODO echo $mySql."-".$mySql2."-".$mySql2."<br/>";
		//TODO cambiar el segundo valor por el desplegable.
		echo listNews("Y", "", "");
	}
}	



	if(isset($_GET['acc']) && $_GET['acc'] == 'editNew'){  
		//TODO echo '{"datos":"'.$_GET['idNew'].$_GET['title'].$_GET['titleSub'].$_GET['date'].'"}';
	
		$mySql ="UPDATE `news` SET `date`='".$_GET['date']."', `title`='".$_GET['title']."', `titleSub`='".$_GET['titleSub']."', `idUser`='".$_GET['idUser']."' WHERE `idNew`='".$_GET['idNew']."'";
		$connexio = connect();
		$resultDelete = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		echo listNews("","", $_GET['idNew']);
	}
	if(isset($_GET['acc']) && $_GET['acc'] == 'addNew'){  

		$mySql="INSERT INTO `news` (`date`, `title`, `titleSub`, `idUser`) VALUES ('".$_GET['date']."', '".$_GET['title']."', '".$_GET['titleSub']."', '".$_GET['idUser']."')";
		$connexio = connect();
		$resultDelete = mysqli_query($connexio, $mySql);
		$idNewInsert=mysqli_insert_id($connexio);
		$mySql="INSERT INTO `newsmedia` (`idNew`, `type`, `url`, `preferred`) VALUES ('".$idNewInsert."', 'I', 'nofoto.png', 'Y')";
		$resultInsert = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		echo listNews("","", $idNewInsert);
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
		$newfile=$_POST['idNew'].'-'.$_FILES["uploadedFile"]["name"];
		$mySql = "UPDATE `newsmedia` SET `url`='".$newfile."' WHERE preferred='Y' AND idNew='".$_POST['idNew']."'";
		$connexio = connect();
		$resultNews = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		move_uploaded_file($_FILES["uploadedFile"]["tmp_name"], "../../img/newsmedia/".$newfile);
		unlink("../../img/newsmedia/".$_POST['urlPreferred']);
	}	

	if(isset($_GET['acc']) && $_GET['acc'] == 'imgDeleteNew'){	
		$mySql = "DELETE FROM `newsmedia` WHERE `idNewMedia`='".$_GET['idNewMedia']."';";
		$connexio = connect();
		$result = mysqli_query($connexio, $mySql);
		disconnect($connexio);
		if($_GET['urlDelete']!='0') unlink("../../img/newsmedia/".$_GET['urlDelete']);
		echo listNewsMedia($_GET['idNew']);

	}

	function listNews($preferredImg="", $idUser="", $idNew=""){
		//TODO echo $preferredImg."-".$idUser."-".$idNew.'<br>';
		$mySql = "SELECT `news`.`idNew`, `news`.`idUser`, `news`.`title`, `news`.`titleSub`, `news`.`date`, DATE_FORMAT( `news`.`date`,'%d-%M-%Y') AS dateList, `newsmedia`.`url` FROM `news` LEFT JOIN `newsmedia` ON `newsmedia`.`idNew` = `news`.`idNew`";
		if($preferredImg!="") $mySql.=" WHERE `newsmedia`.`preferred` ='Y'";
		if($idUser!=""){
			if($preferredImg!="") $mySql.=" AND ";	else $mySql.=" WHERE ";	
			$mySql.="`news`.`idUser`=".$idUser;	
		}
		if($idNew!=""){
			if($preferredImg!="" || $idUser!="") $mySql.=" AND ";	else $mySql.=" WHERE ";	
			$mySql.="`newsmedia`.`idNew`=".$idNew;
		} 
		$mySql .= " ORDER BY `news`.`date` DESC"; 
		//TODO echo $mySql."<br/>";
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

			$row['title']=str_replace("'", "\'", $row['title']);
			$row['titleSub']=str_replace("'", "\'", $row['titleSub']);
			$dataNews .= '{"urlPreferred":"'.$row['url'].'", "title":"'.$row['title'].'", "dateList":"'.$row['dateList'].'","date":"'.$row['date'].'","idNew":"'.$row['idNew'].'","titleSub":"'.$row['titleSub'].'","idUser":"'.$row['idUser'].'"';

			if($idNew!=""){
				$dataNews .= ',"images":';
				$dataNews .= listNewsMedia($idNew);
			}

			$dataNews .= '}';
			$i++;
		}
		$dataNews .=']';
		return $dataNews;

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
	
?>