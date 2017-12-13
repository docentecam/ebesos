angular.module('spaApp')
.controller('NewsCtrl', function($scope, $http) {
	$scope.divMessages=true; //Div per mostrar missatge al esborrar, modificar...
	$scope.message="";
	$scope.btnAddNew=true;	//TODO botó afegir imatge

	$scope.showListNews=true; //TODO div llistat notícies
	$scope.divNew=false; //TODO div dades notícia seleccionada
	$scope.divImgs=false;//TODO div mostra les imatges no preferides de la noticia
	$scope.divVideos=false;//TODO div mostra els vídeos.
	$scope.divAddVideo=false;
	$scope.new={};
	$scope.filterAssoc="";
	$scope.loading=true;	
	$http({
			method : "GET",
			url : "models/news.php?acc=l&preferredImg=Y"
		})
		.then(function mySucces (response) {
			$scope.newsList = response.data.news;
			$scope.assoList= response.data.associations;
			$scope.new.idUser=response.data.userConnect;
		}, function myError (response) {
			$scope.newsList = response.statusText;
		})
		.finally(function() 
		{ 
		    $scope.loading=false; 
		})
	$scope.changeAssociation=function(){
		if($scope.new.idUser==1)$scope.filterAssoc="";
		else $scope.filterAssoc=$scope.new.idUser;
	}

	$scope.deleteNew= function(idNew=""){
		var confirmat=confirm("Segur vols esborrar la notícia?");
		if(confirmat)
		{
			$http({
				method : "GET",
				url : "models/news.php?acc=deleteNew&idNew="+idNew
			}).then(function mySucces (response) {
				$scope.newsList=response.data.news;
				$scope.divMessages=true; //Div per mostrar missatge al esborrar, modificar...
				$scope.message="Notícia esborrada";
			}, function myError (response) {
				$scope.newsList = response.data;
			}).finally(function() {
				$scope.loading=false;
			});
		};
	}
})
angular.module('spaApp')
.controller('NewsEditCtrl', function($scope, $http, $routeParams, $q) {
	$scope.showListNews=false;	
	$scope.divNew=true;
	$scope.addImage=false;
	$scope.divImgs=false;
	$scope.videos=false;
	$scope.new = {};
	if($routeParams.idNew==0)
	{
		$scope.new.idNew=0;
		$scope.new.idUser=1;
		$scope.act="Afegir";
	}
	else
	{
		$scope.new.idNew=$routeParams.idNew;
		$scope.act="Editar";
	} 
	
	$scope.new.title="";
	$scope.new.titleSub="";
	$scope.new.urlPreferred="";
	$scope.new.descPreferred="";
	var d = new Date();
	var yyyy = d.getFullYear();
	var mm = d.getMonth() < 9 ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1); // getMonth() is zero-based
	var dd  = d.getDate() < 10 ? "0" + d.getDate() : d.getDate();
	$scope.new.date=yyyy+"-"+mm+"-"+dd;
	
	
		$scope.loading=true;
		$http({
		method : "GET",
		url : "models/news.php?acc=l&idNew="+$scope.new.idNew
		}).then(function mySucces (response) {
				$scope.assoList= response.data.associations;
				if ($scope.new.idNew!=0)
				{
					$scope.newSelect = response.data.news;
					$scope.new.idNew=$scope.newSelect[0].idNew;
					$scope.new.title= $scope.newSelect[0].title;
					$scope.new.titleSub= $scope.newSelect[0].titleSub;
					$scope.new.urlPreferred=$scope.newSelect[0].urlPreferred;
					$scope.new.date= $scope.newSelect[0].date;
					$scope.new.idUser= $scope.newSelect[0].idUser;
					$scope.new.images = $scope.newSelect[0].images;

					$scope.addImage=true;
					$scope.divImgs=true;
					$scope.divVideos=true;
					$scope.assocSelec=$scope.newSelect[0].idUser;
				}
				
			}, function myError (response) {
				$scope.newSelect = response.statusText;
			})
		.finally(function() 
		{ 
		    $scope.loading=false; 
		})

	


	$scope.newEdit=function(){
		
		if($scope.act=="Editar"){
			$scope.loading=true;	
			$http({
			method : "GET",
			url : "models/news.php?acc=editNew&idNew="+$scope.new.idNew+"&title="+$scope.new.title+"&titleSub="+$scope.new.titleSub+"&date="+$scope.new.date+"&idUser="+$scope.new.idUser
			}).then(function mySucces (response) {
					$scope.newSelect = response.data.news;
					$scope.new.idNew=$scope.newSelect[0].idNew;
					$scope.new.title= $scope.newSelect[0].title;
					$scope.new.titleSub= $scope.newSelect[0].titleSub;
					$scope.new.urlPreferred=$scope.newSelect[0].urlPreferred;
					$scope.new.date= $scope.newSelect[0].date;
					$scope.new.idUser= $scope.newSelect[0].idUser;
					$scope.new.images = $scope.newSelect[0].images;

					$scope.addImage=true;
					$scope.divImgs=true;
					$scope.divVideos=true;
					
				}, function myError (response) {
					$scope.newSelect = response.statusText;
				})
			.finally(function() 
			{ 
			    $scope.loading=false; 
			});
			
		}
		else if($scope.act=="Afegir"){
			$scope.loading=true;	
			//TODO la llamada para hacer el insert, cambiar el idUser por el del combo.
			$http({
			method : "GET",
			url : "models/news.php?acc=addNew&idNew="+$scope.new.idNew+"&title="+$scope.new.title+"&titleSub="+$scope.new.titleSub+"&date="+$scope.new.date+"&idUser="+$scope.new.idUser
			}).then(function mySucces (response) {
					$scope.assoList= response.data.associations;
					$scope.newSelect = response.data.news;
					$scope.new.idNew=$scope.newSelect[0].idNew;
					$scope.new.title= $scope.newSelect[0].title;
					$scope.new.titleSub= $scope.newSelect[0].titleSub;
					$scope.new.urlPreferred=$scope.newSelect[0].urlPreferred;
					$scope.new.date= $scope.newSelect[0].date;
					$scope.new.idUser= $scope.newSelect[0].idUser;
					$scope.new.images = $scope.newSelect[0].images;

					$scope.addImage=true;
					$scope.divImgs=true;
					$scope.divVideos=true;
					
				}, function myError (response) {
					$scope.newSelect = response.statusText;
				})
			.finally(function() 
			{ 
			    $scope.loading=false; 
			    $scope.addImage=true;
			})

		}
	}

	$scope.changePreferred=function(e){
		var data = new FormData();
		data.append("idNew", $scope.new.idNew);
		data.append("uploadedFile",e.files[0]);
		data.append("urlPreferred",$scope.new.urlPreferred);

		var deferred=$q.defer();
		$http.post("models/news.php?acc=changeImgPeferred", data,{
			headers:{
				"Content-type":undefined
			},
				transformRequest:angular.identity
			})
			.then(function(res)
			{
				deferred.resolve(res);
				$scope.new.urlPreferred=$scope.new.idNew+"-"+e.files[0]['name'];
			});
	}



	$scope.imgDelete=function(idNewMedia, url){
		$scope.loading=true;	
		$http({
			method : "GET",
			url : "models/news.php?acc=imgDeleteNew&idNewMedia="+idNewMedia+"&urlDelete="+url+"&idNew="+$scope.new.idNew
			}).then(function mySucces (response) {
				$scope.newSelectImg = response.data;
				$scope.new.images = $scope.newSelectImg;
				}, function myError (response) {
					$scope.newSelectImg = response.statusText;
				})
			.finally(function() 
			{ 
			    $scope.loading=false; 
			})

	}

	$scope.addMedia=function(e,type){
		var data = new FormData();
		data.append("idNew", $scope.new.idNew);
		data.append("type", type);
		if(type=='I')
		{		
			data.append("url", e.files[0]["name"]);
			data.append("uploadedFile",e.files[0]);
		}
		if(type=='V')
		{		
			data.append("url", $scope.urlVideoAdd);
		}

		var deferred=$q.defer();
		$http.post("models/news.php?acc=addMedia", data,{
			headers:{
				"Content-type":undefined
			},
				transformRequest:angular.identity
			})
			.then(function(res)
			{
				deferred.resolve(res);
				$scope.loading=true;	
				$http({
					method : "GET",
					url : "models/news.php?acc=listMedia"+"&idNew="+$scope.new.idNew
					}).then(function mySucces (response) {
						$scope.newSelectImg = response.data;
						$scope.new.images = $scope.newSelectImg;
						}, function myError (response) {
							$scope.newSelectImg = response.statusText;
						})
					.finally(function() 
					{ 
					    $scope.loading=false; 
					    if(type=='V') $scope.divAddVideo=false;
				    		
					});
			});
	}
	$scope.activeAddVideo=function(){
		$scope.divAddVideo=true;
	}
	
});

app.filter('trusted', ['$sce', function ($sce) {
    return function(url) {
        return $sce.trustAsResourceUrl("https://www.youtube.com/embed/" + url);
    };
}]);

