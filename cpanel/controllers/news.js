angular.module('spaApp')
.controller('NewsCtrl', function($scope, $http,upload) {


		
 	$scope.loading=true;
 	$scope.createNew=true;
	$scope.divNew=false;
	$scope.listNew=true;
	$scope.updateImgPreferred=false;
	$scope.updateNew=false;
	$scope.newNews=false;

	$scope.act="";
	$scope.title="";
	$scope.titleSub="";
	$scope.dateNew="";
			
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
		console.log("llega desglose de noticia");
		$scope.loading=true;
		$scope.act=act;
		$scope.divNew=true;
		$scope.listNew=false;
		if (idNew!="")
		{
			$http({
			method : "GET",
			url : "models/news.php?acc=newSel&idNew="+idNew
			}).then(function mySucces (response) {
					$scope.createNew=false;
					$scope.newSelect = response.data;
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
	}

	$scope.imgD = function($idNewMedia){
		
		$http({
			method : "GET",
			url : "models/news.php?acc=delete&idNewMedia=" + $idNewMedia
		}).then(function mySucces (response) {
			$scope.divNew=true;

		}, function myError (response) {
			$scope.newSelect = response.data;
		});
	};

		// $scope.createNewD = function()
		// { 
		// 	var correcto=true;

		// 	$scope.title = validationNewForm['title'].value;	
		// 	$scope.titleSub = validationNewForm['title'].value;
		// 	$scope.date = validationNewForm['date'].value;
		// 	$scope.video = validationNewForm['video'].value;
		// 	$scope.imgPreferred = validationNewForm['imgPreferred'].value;imgPreferred

		// 	if( $scope.title=="")
		// 		{		
		// 			alert("No hi ha Titul de la noticia");
		// 			correcto=false;	 
		// 		}
		
		// 	if( $scope.date=="")
		// 		{		
		// 			alert("No hi ha data de creacio de la noticia");
		// 			correcto=false;	 
		// 		}
		// 	if( $scope.titleSub=="")
		// 		{		
		// 	 		alert("No hi ha Contingut de la noticia");
		// 			correcto=false;	 
		// 		}

		// 	if( $scope.imgPreferred=="")
		// 		{		
		// 			alert("Ha de tenir una imatge de portada");
		// 			correcto=false;	 
		// 		}

		// 	if (correcto!=false)
		// 	{
  // 				$http({
		// 		method : "GET",
		// 		url : "models/news.php?acc=createNew&title="+$scope.title+"&titleSub="+$scope.titleSub+"&date="+$scope.date+"&video="+$scope.video
		// 		}).then(function mySucces (response) {
		// 		$scope.newCreate = response.data;
		// 		alert("Noticia creada");
		// 		$scope.listNew=true;
		// 		$scope.createNew=true;
		// 		$scope.newNews=false;
		// 		}, function myError (response) {
		// 		$scope.newCreate = response.statusText;
		// 		});
  // 			}
		// }

		
		// $scope.editNew = function()
		// { 
		// 	$scope.createNew=false;
		// 	$scope.updateImgPreferred=false;
		// 	$scope.showDiv=false;
		// 	$scope.listNew=false;
		// 	$scope.updateNew=true;	
		// 	$scope.updateImgNew=false;	
		// 	$scope.newNews=false;
		// 	$scope.createVideo=false;		
		// }

		// $scope.changeImgP = function()
		// { 
		// 	$scope.createNew=false;
		// 	$scope.updateImgPreferred=true;
		// 	$scope.showDiv=false;
		// 	$scope.listNew=false;
		// 	$scope.updateNew=false;
		// 	$scope.updateImgNew=false;	
		// 	$scope.newNews=false;
		// 	$scope.createVideo=false;
		// }


		// $scope.changeImgN = function()
		// { 
		// 	$scope.createNew=false;
		// 	$scope.updateImgPreferred=false;
		// 	$scope.showDiv=false;
		// 	$scope.listNew=false;
		// 	$scope.updateNew=false;
		// 	$scope.updateImgNew=true;
		// 	$scope.newNews=false;	
		// 	$scope.createVideo=false;
		// }
		

		// $scope.newNew = function()
		// { 
		// 	$scope.createNew=false;
		// 	$scope.updateImgPreferred=false;
		// 	$scope.showDiv=false;
		// 	$scope.listNew=false;
		// 	$scope.updateNew=false;
		// 	$scope.updateImgNew=false;	
		// 	$scope.newNews=true;
		// 	$scope.createVideo=false;		
		// }

		// $scope.createVideo = function()
		// { 

		// 	$scope.newNews=false;
		// 	$scope.createNew=false;
		// 	$scope.updateImgPreferred=false;
		// 	$scope.showDiv=false;
		// 	$scope.listNew=false;
		// 	$scope.updateNew=false;
		// 	$scope.updateImgNew=false;
		// 	$scope.createVideo=true;	
		// }


		$scope.uploadFile=function(){
			console.log("carga");
			var titleNew= $scope.titleNew;
			var file= $scope.file;
			console.log(titleNew,file);
			upload.uploadFile(file,titleNew).then(function(res)
				{
				console.log(res);
				}
			)
		}
})

.directive('uploaderModel', ["$parse",function($parse){
return{
restrict:'A',
link: function(scope, iElement, iAtrrs){


iElement.on("change",function(e)
{
$parse(iAtrrs.uploaderModel).assign(scope,
 iElement[0].files[0]);
});
}
};
}])
 
.service('upload',["$http","$q", function($http,$q)
{

	this.uploadFile=function(file,titleNew)
	{
		console.log("nombre en upload: "+name);
		console.log("fichero en upload: "+file);
		var deferred=$q.defer();
		var formData= new FormData();
		formData.append("name", name);
		formData.append("file", file);
		return $http.post("models/recibeSubir.php", formData,{
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

		return deferred.promise;
	}
		}])

