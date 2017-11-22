angular.module('spaApp')
.controller('SettingsCtrl', function($scope, $http) {

$scope.act="";
$scope.accBbdd="";

	$scope.loading=true;
	$http({
		method : "GET",
		url : "models/settings.php?acc=list"
	}).then(function mySucces(response) {
		$scope.settingsList = response.data;
	}, function myError(response) {
		$scope.settingsList = response.statusText;
	})
	.finally(function() {
			$scope.loading=false;
	});	


$scope.editParameter = function(act="",idSetting, value, literal ){
	

		if (act=='Editar'){
			$scope.act=act;
			$scope.showSettings=true;
			$scope.confirm=false;
			$scope.idSetting = idSetting;
			$scope.value= value;
			$scope.literal= literal;
			$scope.accBbdd="Update";
		}

		else if (act=='Afegir'){
			$scope.act=act;
			$scope.value= "";
			$scope.literal= "";
			$scope.idSetting = "";
			$scope.showSettings=true;
			$scope.confirm=false;	
			$scope.accBbdd="Add";
		}

		else if (act=="Update" || act=="Add"){
			if($scope.value != "" && $scope.literal != "")
			{
				$scope.loading=true;
				$http({
					method : "GET",
					url : "models/settings.php?acc=addUpdate&act="+act+"&literal="+$scope.literal+"&value="+$scope.value+"&idSetting="+$scope.idSetting
				}).then(function mySucces(response) {
					$scope.settingsList = response.data;
					$scope.value= "";
					$scope.literal= "";
					$scope.confirm=true;
					$scope.validation = true;
					if(act=="Update")
					{
						$scope.statusValidation = "El paràmetre s'ha creat correctament";
					}
					else
					{
						$scope.statusValidation = "El paràmetre s'ha modificat correctament";
					}

				}, function myError(response) {
					$scope.prueba = response.statusText;
				})
				.finally(function() {
						$scope.loading=false;
						$scope.showSettings=false;
				});	
			}
			else
			{
				$scope.confirm=true;
				$scope.validation = false;
				$scope.statusValidation = "Hi ha camps sense omplir";
			}
				
}

	}

	$scope.updateSettings = function(){
		$scope.literal=validationSetting["updateLiteral"].value;
		$scope.value=validationSetting["updatevalue"].value;
		$scope.idSetting=validationSetting["idSetting"].value;
	};
	
});