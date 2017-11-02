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
			$scope.accBbdd="Add";
		}

		else if (act=="Update" || act=="Add"){

			$http({
				method : "GET",
				url : "models/settings.php?acc=addUpdate&act="+act+"literal="+$scope.literal
			}).then(function mySucces(response) {
				$scope.prueba = response.data;
				$scope.showSettings=true;

			}, function myError(response) {
				$scope.prueba = response.statusText;
			})
			.finally(function() {
					$scope.loading=false;
					console.log($scope.prueba);

			});	

		}
}

	$scope.updateSettings = function(){
		$scope.literal=validationSetting["updateLiteral"].value;
		$scope.value=validationSetting["updatevalue"].value;
		$scope.idSetting=validationSetting["idSetting"].value;
	};
	

	// $scope.shopOneEdit = function($idShop){
	// 	$http({
	// 		method : "GET",
	// 		url : "models/shops.php?acc=edit&idShop=" + $idShop
	// 	}).then(function mySucces (response) {
	// 		$scope.shopOne = response.data;
	// 		$scope.showShop = true;
	// 	}, function myError (response) {
	// 		$scope.showShop = response.statusText;
	// 	});
	// };
	// $scope.shopOneDelete = function($idShop){
	// 	console.log($idShop);
	// 	$http({
	// 		method : "GET",
	// 		url : "models/shops.php?acc=delete&idShop=" + $idShop
	// 	}).then(function mySucces (response) {
	// 		$scope.shopDeleted = response.data
	// 		//shopOneEdit($idShop);
	// 	}, function myError (response) {
	// 		$scope.shopOne = response.statusText;
	// 	});
	// };
	// $scope.shopOneAdd = function($idShop){
	// 	$scope.showShop = true;
	// };
});