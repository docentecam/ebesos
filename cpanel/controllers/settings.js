angular.module('spaApp')
.controller('SettingsCtrl', function($scope, $http) {
	$http({
		method : "GET",
		url : "models/settings.php?acc=list"
	}).then(function mySucces(response) {
		$scope.settingsList = response.data;
	}, function myError(response) {
		$scope.settingsList = response.statusText;
	});


$scope.editParameter = function(idSetting, value, literal){

		$scope.idSetting = idSetting;
		$scope.value= value;
		$scope.literal= literal;
		$scope.showSettings=true;
	}

	$scope.updateSettings = function(){
		$scope.literal=validationSetting["updateLiteral"].value;
		$scope.value=validationSetting["updatevalue"].value;
		$scope.idSetting=validationSetting["idSetting"].value;
	}






















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