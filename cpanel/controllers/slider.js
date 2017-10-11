angular.module('spaApp')															 
.controller('SliderCtrl', function($scope, $http) {

$http({
		method : "GET",
		url : "models/slider.php?acc=imgSlider"
	}).then(function mySucces (response) {
		$scope.slider=response.data;
		console.log($scope.slider);
	}, function myError (response) {
		$scope.slider = response.statusText;
	});

	$scope.addImgSlide = function(){
		$scope.spanEditarImatges = true;
		$scope.btnAfegir = true;
		$scope.sliderSetting = true;
		$scope.sliderAdding = true;
	};
	$scope.editImgSlide = function(){
		$scope.spanEditarImatges = true;
		$scope.btnAfegir = true;
		$scope.sliderSetting = true;
		$scope.sliderEditing = true;
	};
	$scope.backSettingSlide = function(){
		$scope.spanEditarImatges = false;
		$scope.btnAfegir = false;
		$scope.sliderSetting = false;
		$scope.sliderAdding = false;
		$scope.sliderEditing = false;
	}

	// 	$modificarUsuarios=modificarUsuario($_POST['idUsuari'],$_POST['nom'],$_POST['cog1'],$_POST['cog2'],$_POST['telf1'],$_POST['telf2'],$_POST['email'],$_POST['direc'],$_POST['direcPlta'],$_POST['direcPrta'],$_POST['direcEsc'],$_POST['cp'],$_POST['nif'],$_POST['assessor']);	
	// 	header("Location: ../view/usuarios.php");
	// }
	// $scope.editImgSlide = function()
	// {
	// 	$connexio = connect();
	// 	$mySql = "UPDATE usuaris SET nom='$nom',cog1='$cog1',cog2='$cog2',telf1='$telf1',telf2='$telf2',email='$email',direc='$direc',direcPlta='$direcPlta',direcPrta='$direcPrta',direcEsc='$direcEsc',cp='$cp',assessor='$assessor' WHERE idUsuari='$idUsuari'"; 

	// 	$modifyUsuarios = mysqli_query($connexio, $mySql);
	// 	disconnect($connexio);

	// 	return ($modifyUsuarios);
	// }
});
	