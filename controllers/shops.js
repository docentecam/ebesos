angular.module('spaApp')

.controller('AssociationsCtrl', function($scope, $http) {

	$scope.listShops = function(idUser){		
		$http({
			method : "GET",
			url : "models/shops.php?idUser="+idUser
		}).then(function mySucces(response) {
			templateUrl:'views/shops.html'
			$scope.names = response.data;
			$scope.div4 = false;
			$scope.div3 = false;
			$scope.div2 = false;
			$scope.div1 = true;
		}, function myError(response) {
			$scope.names = response.statusText;
		});
	};
});

angular.module('spaApp')

.controller('ShopsCtrl', function($scope, $http) {

	$scope.showShop = function(idShop){		
		$http({
			method : "GET",
			url : "models/shops.php?idShop="+idShop
		}).then(function mySucces(response) {
			templateUrl:'views/shop.html'
			$scope.names = response.data;
		}, function myError(response) {
			$scope.names = response.statusText;
		});
	};
});

angular.module('spaApp')                               
.controller('ComercialMapCtrl', function($scope, $http) {

$http({
    method : "GET",
    url : "models/xmlCreation.php"
  }).then(function mySucces (response) {
    $scope.categories=response.data;
    console.log(response.data);
  }, function myError (response) {
    $scope.categories = response.statusText;
  });

  $http({
    method : "GET",
    url : "models/categories.php?acc=cat"
  }).then(function mySucces (response) {
    $scope.categories=response.data;
    //$scope.subCategories1=$scope.categories[0]["subCategories"];
    console.log(response.data);
  }, function myError (response) {
    $scope.categories = response.statusText;
  });

  $scope.categoryFilter = function(category=""){
  	console.log(category);
  	console.log("hola");
    //category = "serveis";
     var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(41.416962, 2.214625),
      zoom: 16
    });

    var infoWindow = new google.maps.InfoWindow;
    // Change this depending on the name of your PHP or XML file

    downloadUrl('files/shops.xml', function(data) {
      var xml = data.responseXML;
      var markers = xml.documentElement.getElementsByTagName('marker');

      Array.prototype.forEach.call(markers, function(markerElem) {
        //Inicio filtrado categoria
        if(markerElem.getAttribute('nameCategoria') == category || category == "")
        {
          //TODO: schedule, email, address(?)
          var name = markerElem.getAttribute('name');

          var address = markerElem.getAttribute('address');

          var telephone = markerElem.getAttribute('telephone');

          var email = markerElem.getAttribute('email');

          var schedule = markerElem.getAttribute('schedule');

          var logo = markerElem.getAttribute('logo');

          var type = markerElem.getAttribute('nameCategoria');

          var idShop = markerElem.getAttribute('idShop');

          var point = new google.maps.LatLng(
            parseFloat(markerElem.getAttribute('lat')),
            parseFloat(markerElem.getAttribute('lng'))
          );

          var infowincontent = document.createElement('div');

          var icon = document.createElement('img');
          icon.setAttribute('src', "img/logos-shops/duck.svg");
          icon.setAttribute('width', "32");
          icon.setAttribute('height', "32");

          //icon.textContent = logo

          infowincontent.appendChild(icon);
          infowincontent.appendChild(document.createElement('br'));

          var strong = document.createElement('strong');

          strong.textContent = name

          infowincontent.appendChild(strong);
          infowincontent.appendChild(document.createElement('br'));

          var phone = document.createElement('text');

          phone.textContent = "Tel. "+telephone

          infowincontent.appendChild(phone);
          infowincontent.appendChild(document.createElement('br'));

          var mail = document.createElement('text');

          mail.textContent = email

          infowincontent.appendChild(mail);
          infowincontent.appendChild(document.createElement('br'));

          var time = document.createElement('text');

          time.textContent = schedule

          infowincontent.appendChild(time);
          infowincontent.appendChild(document.createElement('br'));

          var link = document.createElement('a');
          link.setAttribute('href', "#/shops/"+idShop+"");

          link.textContent = "Ver mas"

          infowincontent.appendChild(link);

          var icon = customLabel[type] || {};

          var marker = new google.maps.Marker({
            map: map,
            position: point,
            label: icon.label
          });

          marker.addListener('mouseover', function() {
            infoWindow.setContent(infowincontent);
            infoWindow.open(map, marker);
          });

          marker.addListener('click', function() {
            alert("Obrirem finestra amb dades del comerç");
          });

          /*Mostrem els icones segons la categoria i associacio*/
          
            if(markerElem.getAttribute('nameCategoria')=='alimentacio')
            {
              if(markerElem.getAttribute('nameAssociacio')=='Xavier Nogues') marker.setIcon(new google.maps.MarkerImage('img/pictograms/aliXno.png', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='019') marker.setIcon(new google.maps.MarkerImage('img/pictograms/ali019', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='Mercats') marker.setIcon(new google.maps.MarkerImage('img/pictograms/aliMer', null, null, null, new google.maps.Size(30, 30)));
            }
            else if(markerElem.getAttribute('nameCategoria')=='serveis')
            {
             if(markerElem.getAttribute('nameAssociacio')=='Xavier Nogues') marker.setIcon(new google.maps.MarkerImage('img/pictograms/servXno', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='019') marker.setIcon(new google.maps.MarkerImage('img/pictograms/serv019', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='Mercats') marker.setIcon(new google.maps.MarkerImage('img/pictograms/servMer', null, null, null, new google.maps.Size(30, 30)));
            }
            else if(markerElem.getAttribute('nameCategoria')=='comerç al detall')
            {
              if(markerElem.getAttribute('nameAssociacio')=='Xavier Nogues') marker.setIcon(new google.maps.MarkerImage('img/pictograms/cdXno', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='019')  marker.setIcon(new google.maps.MarkerImage('img/pictograms/cd019', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='Mercats') marker.setIcon(new google.maps.MarkerImage('img/pictograms/cdMer', null, null, null, new google.maps.Size(30, 30)));
            }
            else if(markerElem.getAttribute('nameCategoria')=='restauracio')
            {
              if(markerElem.getAttribute('nameAssociacio')=='Xavier Nogues') marker.setIcon(new google.maps.MarkerImage('img/pictograms/restXno', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='019') marker.setIcon(new google.maps.MarkerImage('img/pictograms/rest019', null, null, null, new google.maps.Size(30, 30)));

              else if(markerElem.getAttribute('nameAssociacio')=='Mercats') marker.setIcon(new google.maps.MarkerImage('img/pictograms/restMer', null, null, null, new google.maps.Size(30, 30)));
            }
        }// fin Comprobacio categoria
      });
    });
  };

});

