<?php
require('../../inc/functions.php');

		if(isset($_GET['acc']) && ($_GET['acc'] == "list"))
		{
			

			echo listSettings();
		}
		

		else if(isset($_GET['acc']) && $_GET['acc'] == 'addUpdate'){
			
			if (isset($_GET['act']) && $_GET['act']=='Add') {

			$mySql = "INSERT INTO settings (idSetting, literal, value)
			VALUES ('', '".$_GET['literal']."', '".$_GET['value']."')";

			$connexio = connect();
			$resultNewSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			}


			else if (isset($_GET['act']) && $_GET['act']=='Update') {

			$mySql = "UPDATE settings
			SET literal='".$_GET['literal']."', value='".$_GET['value']."'
			WHERE idSetting=".$_GET['idSetting'];

			$connexio = connect();
			$resultNewSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);
			
				
			}

		echo listSettings();

		}



function listSettings(){
	$mySql = "SELECT idSetting, literal, value FROM settings";

			$connexio = connect();
			$resultSettings = mysqli_query($connexio, $mySql);
			disconnect($connexio);

			$dataSettings = "[";
			$i = 0;
			while($row = mysqli_fetch_array($resultSettings))
			{
				if($i != 0)
				{
					$dataSettings .= ",";
				}
				$dataSettings .= '{"literal":"'.$row['literal'].'", "idSetting":"'.$row['idSetting'].'", "value":"'.$row['value'].'"}'; 
				$i++;
			}
			$dataSettings .= "]";
			return $dataSettings;
}


?>