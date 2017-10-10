angular.module('spaApp')
.controller('SubirCtrl',['$scope','upload', function($scope, upload) {
	$scope.uploadFile=function()
	{
		console.log("carga");
		var name= $scope.name;
		var file= $scope.file;
		upload.uploadFile(file,name);
	}
}])

.directive('uploaderModel', ["$parse",function($parse){
	return{
		restrict:'A',
		link: 	function(scope, iElement, iAtrrs){
				iElement.on("change",
				function(e)
				{
					$parse(iAtrrs.uploaderModel).assign(scope,
						iElement[0].files[0]);
				});
		}
	};
}])

.service('upload',["$http","$q", function($http,$q)
{
	this.uploadFile=function(file,name)
	{
		console.log("nombre en upload: "+name); 
			console.log("fichero en upload: "+file);
				var	deferred=$q.defer();
				var formData= new FormData();
				formData.append("name", name);
				formData.append("file",	file);
				return 	$http.post("models/subeFichero.php", formData,{
					headers:{
						"Content-type":undefined
					},
					transformRequest:angular.identity
				})
				.then(function()
				{
					// console.log	("lo sube"+ res);
					// //deferred.resolve(res);
					// console.log	(deferred.resolve(res));
					console.log	("lo sube");
				})
//.error(function(msg,code)
//{
//deferred.reject(msg);
//})
//return deferred.promise;
}
}])