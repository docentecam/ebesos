var getIdUser = $_GET["idUser"];

angular.module('spaApp')

	.controller('AssociationsCtrl', function ($scope) {

		$scope.idUser = getIdUser;

	});