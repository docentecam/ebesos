angular.module('spaApp')
.controller('NewsCtrl', function($scope, $http,upload,$q) {
	$scope.divMessages=true; //Div per mostrar missatge al esborrar, modificar...
	$scope.message="fdfdfd";
	$scope.btnAddNew=true;	//TODO botó afegir imatge
	$scope.showListNews=true; //TODO div llistat notícies
	$scope.divNew=false; //TODO div dades notícia seleccionada
	$scope.divImgs=false;//TODO div mostra les imatges no preferides de la noticia
	$scope.divVideos=false;//TODO div mostra els vídeos.
	$scope.act="";
	$scope.new = {};
	$scope.new.idNew=""; /*TODO, actualizar este campo al insertarla.*/ $scope.new.idNew="1";
	$scope.new.title="";
	$scope.new.titleSub="";
	$scope.new.urlPreferred="";
	$scope.new.descPreferred="";
	$scope.new.dateNew="";
	$scope.new.idUser="";
	$scope.new.images ="";

	$scope.loading=true;	
	$http({
			method : "GET",
			url : "models/news.php?acc=l&iduser=1&preferredImg=Y"
		})
		.then(function mySucces (response) {
			$scope.newsList = response.data;
		}, function myError (response) {
			$scope.newsList = response.statusText;
		})
		.finally(function() 
		{ 
		    $scope.loading=false; 
		})


	$scope.createNew=function(act="", idNew=""){
		$scope.btnAddNew=false;
		
		$scope.act=act;
		$scope.divNew=true;
		$scope.showListNews=false;
		$scope.divImgs=true;
		$scope.divVideos=true;
		if (idNew!="")
		{
			$scope.loading=true;
			$http({
			method : "GET",
			url : "models/news.php?acc=l&idNew="+idNew
			}).then(function mySucces (response) {

					$scope.newSelect = response.data;
					$scope.new.idNew=$scope.newSelect[0].idNew;
					$scope.new.title= $scope.newSelect[0].title;
					$scope.new.titleSub= $scope.newSelect[0].titleSub;
					$scope.new.urlPreferred=$scope.newSelect[0].urlPreferred;
					$scope.new.descPreferred=$scope.newSelect[0].descPreferred;
					$scope.new.dateNew= $scope.newSelect[0].date;
					$scope.new.idUser= $scope.newSelect[0].idUser;
					$scope.new.images = $scope.newSelect[0].images;


					$scope.showListNews=false;	
					$scope.divNew=true;
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

	$scope.selImages=function(e,type="")
	{
		console.log("Seleccionem imatges");
		$scope.message="blabla-";
		if(type=="preferred")
		{
			$scope.new.urlPreferred=e.files[0]["name"];
			$scope.message+=$scope.new.urlPreferred;
		}
		else
		{
			$scope.filesImages = [];
            $scope.$apply(function () {
            	
                // Guardamos los ficheros en un array.

                for (var i = 0; i < e.files.length; i++) {
                    $scope.filesImages.push(e.files[i]);
                    $scope.message+=e.files[i]['name'];
                }
            });
		}
		$scope.divMessages=true; 
		console.log($scope.message+" "+$scope.divMessages);

	}

	$scope.deleteNew= function(idNew="",type=""){
		$scope.divMessages=true; //Div per mostrar missatge al esborrar, modificar...

		$scope.message="Esborrar notícia"+idNew;

	}

	$scope.imgDelete = function(idNewMedia=""){
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


	// $scope.cogeDetalleFicheros = function (e) {
	// 		console.log("entro a mirar ficheros, hay: "+e.files.length);
 //            $scope.filesImages = [];
 //            $scope.$apply(function () {
 //                // Guardamos los ficheros en un array.
 //                for (var i = 0; i < e.files.length; i++) {
 //                    $scope.filesImages.push(e.files[i])
 //                }
 //            });
 //        };

    $scope.enviaForm = function (formNew) {
        	console.log('Submit del Formulario con: ' + JSON.stringify(formNew));
        	console.log( $scope.formNew.descripcio);
			var data = new FormData();
			data.append("idNew", $scope.idNew);
			data.append("descripcio", $scope.formNew.descripcio);
			for (var i in $scope.files) {
                data.append("uploadedFile"+i, $scope.filesImages[i]);
            }
            data.append("cantImagen", i);
 
			var deferred=$q.defer();
			return $http.post("models/news.php?acc=addImages", data,{
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

