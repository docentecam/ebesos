angular.module('spaApp')
 .controller('NewsCtrl', function($scope, $http) {
			
			$scope.createNew=true;
			$scope.showDiv=false;
			$scope.listNew=true;
			$scope.updateImgPreferred=false;
			$scope.updateNew=false;
			$scope.newNews=false;
			$scope.createVideo=false;	
			$http({

				method : "GET",
				url : "models/news.php?acc=news"
			}).then(function mySucces (response) {
				$scope.news = response.data;
				console.log($scope.news);
				
			}, function myError (response) {
				$scope.news = response.statusText;
			});
		
		$scope.selNew = function(idNew)
		{  
			$http({
				method : "GET",
				url : "models/news.php?acc=newSel&idNew="+idNew
			}).then(function mySucces (response) {

				$scope.createNew=false;
				$scope.newSelect = response.data;
				$scope.images = $scope.newSelect[0].url;
				$scope.showDiv=true;
				$scope.listNew=false;
				$scope.newNews=false;	
				$scope.updateImgPreferred=false;
				$scope.createVideo=false;
				console.log($scope.newSelect);
				
			}, function myError (response) {
				$scope.newSelect = response.statusText;
			});
		}

		
		$scope.editNew = function()
		{ 
			$scope.createNew=false;
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=true;	
			$scope.updateImgNew=false;	
			$scope.newNews=false;
			$scope.createVideo=false;		
		}

		$scope.changeImgP = function()
		{ 
			$scope.createNew=false;
			$scope.updateImgPreferred=true;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=false;	
			$scope.newNews=false;
			$scope.createVideo=false;
		}


		$scope.changeImgN = function()
		{ 
			$scope.createNew=false;
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=true;
			$scope.newNews=false;	
			$scope.createVideo=false;
		}
		

		$scope.newNew = function()
		{ 
			$scope.createNew=false;
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=false;	
			$scope.newNews=true;
			$scope.createVideo=false;		
		}

		$scope.createVideo = function()
		{ 

			$scope.newNews=false;
			$scope.createNew=false;
			$scope.updateImgPreferred=false;
			$scope.showDiv=false;
			$scope.listNew=false;
			$scope.updateNew=false;
			$scope.updateImgNew=false;
			$scope.createVideo=true;	
		}



		


		$scope.changeImgPeferred = function(idNew)
		{  
			$http({	
				method : "GET",
				url : "models/news.php?acc=changeImgPeferred&idNew="+idNew
			}).then(function mySucces (response) {
				$scope.changeImgPreferred = response.data;
				console.log($scope.newSelect);
			}, function myError (response) {
				$scope.newSelect = response.statusText;				
			});
		}

		$scope.uploadFile=function(){
			console.log("carga");
			var name= $scope.name;
			var file= $scope.file;
			upload.uploadFile(file,name).then(function(res)
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

	this.uploadFile=function(file,name)
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
	}
	)



return deferred.promise;
}
}])
