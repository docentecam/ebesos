// angular.module('spaApp')
// .controller('SubirCtrl',['$scope','upload', function($scope, upload) {
// 	$scope.uploadFile=function()
// 	{
// 		console.log("carga");
// 		var name= $scope.name;
// 		var file= $scope.file;
// 		var n= $scope.n;
// 		var u= $scope.u;
// 		var descL= $scope.descL;
// 		var descS= $scope.descS;
// 		var c= $scope.c;
// 		var lg= $scope.lg;
// 		var url= $scope.url;
// 		var lat= $scope.lat;
// 		var lng= $scope.lng;
// 		var p= $scope.p;
// 		var cp= $scope.cp;
// 		var a= $scope.a;
// 		var s= $scope.s;
// 		var e= $scope.e;
// 		var variable = upload.uploadFile(file,name, n, u, descL, descS, c, lg, url, lat, lng, p, cp, a, s, e);
// 	}
// }])

// .directive('uploaderModel', ["$parse",function($parse){
// 	return{
// 		restrict:'A',
// 		link: 	function(scope, iElement, iAtrrs){
// 				iElement.on("change",
// 				function(e)
// 				{
// 					$parse(iAtrrs.uploaderModel).assign(scope,
// 						iElement[0].files[0]);
// 				});
// 		}
// 	};
// }])

// .service('upload',["$http","$q", function($http,$q)
// {
// 	this.uploadFile=function(file,name, n, u, descL, descS, c, lg, url, lat, lng, p, cp, a, s, e)
// 	{
// 		console.log("nombre en upload: "+name); 
// 		console.log("fichero en upload: "+file);
// 		console.log("fichero en upload: "+lg);
// 			var	deferred=$q.defer();
// 			var formData= new FormData();
// 			formData.append("name", name);
// 			formData.append("file",	file);
// 			formData.append("n",	n);
// 			formData.append("u",	u);
// 			formData.append("descL",	descL);
// 			formData.append("descS",	descS);
// 			formData.append("c",	c);
// 			formData.append("lg",	lg);
// 			formData.append("url",	url);
// 			formData.append("lat",	lat);
// 			formData.append("lng",	lng);
// 			formData.append("p",	p);
// 			formData.append("cp",	cp);
// 			formData.append("a",	a);
// 			formData.append("s",	s);
// 			formData.append("e",	e);

// 			var resultado = 	$http.post("models/subeFichero.php?acc=edit", formData,{
// 				headers:{
// 					"Content-type":undefined
// 				},
// 				transformRequest:angular.identity
// 			})
// 			.then(function()
// 			{
// 				// console.log	("lo sube"+ res);
// 				// //deferred.resolve(res);
// 				// console.log	(deferred.resolve(res));
// 				console.log	("lo sube"+resultado.toString());
// 			})
// //.error(function(msg,code)
// //{
// //deferred.reject(msg);
// //})
// //return deferred.promise;
// }
// }])