angular.module('spaApp')
.controller('NewsCtrl', function($scope, $http,upload,$q) {
	$scope.formNew = {};
	$scope.formNew.descripcio="Descripció de l'imatge";

	$scope.btnAdd=true;	
 	$scope.loading=true;
	$scope.divNew=false;
	$scope.listNew=true;
	$scope.updateImgPreferred=false;
	$scope.updateNew=false;
	$scope.newNews=false;

	$scope.act="";
	$scope.idNew=""; /*TODO, actualizar este campo al insertarla.*/ $scope.idNew="1";
	$scope.title="";
	$scope.titleSub="";
	$scope.dateNew="";
	$scope.imagesUpload=[];
	$scope.arrayFilesUp="";
		
	$http({

	method : "GET",
	url : "models/news.php?acc=news"
	})
	.then(function mySucces (response) {
		$scope.news = response.data;
		console.log($scope.news);
		$scope.createVideo=false;	
	}, function myError (response) {
		$scope.news = response.statusText;
	})
	.finally(function() 
		{ 
		    $scope.loading=false; 
		})


	$scope.createNewD=function(act="", idNew=""){
		$scope.btnAdd=false;
		console.log("llega desglose de noticia"+idNew);
		
		$scope.act=act;
		$scope.divNew=true;
		$scope.listNew=false;
		console.log(act+$scope.divNew);
		if (idNew!="")
		{
			$scope.loading=true;
			$http({
			method : "GET",
			url : "models/news.php?acc=newSel&idNew="+idNew
			}).then(function mySucces (response) {

					$scope.newSelect = response.data;
					$scope.idNew=idNew;
					$scope.title= $scope.newSelect[0].title;
					$scope.titleSub= $scope.newSelect[0].titleSub;
					$scope.dateNew= $scope.newSelect[0].date;

					$scope.images = $scope.newSelect[0].url;

					$scope.newNews=false;	
					$scope.updateImgPreferred=false;
					$scope.createVideo=false;
					console.log($scope.newSelect);
					
				}, function myError (response) {
					$scope.newSelect = response.statusText;
				})
			.finally(function() 
			{ 
			    $scope.loading=false; 
			})
		}
	};

	$scope.imgDelete = function(idNewMedia="",url=""){
		console.log("elimi "+idNewMedia+" "+url+" "+$scope.idNew);
		$scope.images="";
		$http({
			method : "GET",
			url : "models/news.php?acc=delete&idNewMedia=" +idNewMedia+"&idNew="+$scope.idNew+"&url="+url
		}).then(function mySucces (response) {
			$scope.images = response.data;
			$scope.divNew=true;

		}, function myError (response) {
			$scope.newSelect = response.data;
		});
	};











	$scope.cogeDetalleFicheros = function (e) {
			console.log("entro a mirar ficheros, hay: "+e.files.length);
            $scope.files = [];
            $scope.$apply(function () {
                // Guardamos los ficheros en un array.
                for (var i = 0; i < e.files.length; i++) {
                    $scope.files.push(e.files[i])
                }
            });
        };

    $scope.enviaForm = function (formNew) {
        	console.log('Submit del Formulario con: ' + JSON.stringify(formNew));
        	console.log( $scope.formNew.descripcio);
			var data = new FormData();
			data.append("idNew", $scope.idNew);
			data.append("descripcio", $scope.formNew.descripcio);
			for (var i in $scope.files) {
                data.append("uploadedFile"+i, $scope.files[i]);
            }
            data.append("cantImagen", i);
 
			var deferred=$q.defer();
			return $http.post("models/news.php?acc=add", data,{
				headers:{
					"Content-type":undefined
				},
				transformRequest:angular.identity
			})
			.then(function(res)
				{
					console.log ("lo sube"+ res);
					deferred.resolve(res);
					console.log ("lo sube");
				})
			// .error(function(msg,code)
			// 	{
			// 		deferred.reject(msg);
			// 	})
			return deferred.promise;
		};
	

})

