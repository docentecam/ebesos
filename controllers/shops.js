angular.module('spaApp')
.controller('ShopCtrl', function($scope, $http, $routeParams) {
  $scope.loading = true;
	$http({
		method : "GET",
		url : "models/shops.php?acc=shop&idShop="+$routeParams.idShop
	}).then(function mySucces(response) {
		$scope.shops = response.data;
    $scope.loading = false;
	}, function myError(response) {
		$scope.shops = response.statusText;
	});

  $http({
    method : "GET",
    url : "models/xmlCreation.php?acc=shop&idShop="+$routeParams.idShop
  }).then(function mySucces (response) {
    $scope.categories=response.data;
    $scope.loading = false;
    console.log(response.data);
  }, function myError (response) {
    $scope.categories = response.statusText;
  });
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
    console.log(response.data);
  }, function myError (response) {
    $scope.categories = response.statusText;
  });

  $scope.categoryFilter = function(filter = "", parameter = ""){
     var map = new google.maps.Map(document.getElementById('map'), {
      center: new google.maps.LatLng(41.416962, 2.214625),
      zoom: 16
    });

    var infoWindow = new google.maps.InfoWindow;
    // Change this depending on the name of your PHP or XML file

    downloadUrl('files/shops.xml', function(data) {
      var xml = data.responseXML;
      var markers = xml.documentElement.getElementsByTagName('marker');
      var markerPoints = new Array();
      console.log(parameter);
      console.log(filter);
      Array.prototype.forEach.call(markers, function(markerElem) {
        //Inicio filtrado categoria
        var draw = false;
        if(filter == 'category' && markerElem.getAttribute('idCategory') == parameter) draw = true;
        if(filter == 'categorySub' && markerElem.getAttribute('idSubCategory') == parameter) draw = true;

        if(draw)
        {
          var repeated = false;
          var i = 0;
          console.log(markerPoints.length)
          while(!repeated && i<markerPoints.length)
          {
            if(markerElem.getAttribute('idShop') == markerPoints[i])
            {
              repeated = true;
              console.log("entra en repetido"+repeated);
            }
            i++;
            console.log(markerElem.getAttribute('idShop')+repeated);
          }
          
          if(!repeated)
          {
            markerPoints[markerPoints.length] = markerElem.getAttribute('idShop');
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
            icon.setAttribute('src', "img/logos-shops/"+logo+"");
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
             link.setAttribute('href', "#/shop/"+idShop+"");

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
          }
        }// fin Comprobacio categoria
      });
    });
  };

});

