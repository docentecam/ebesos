<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row users-list" ng-show="showList">
	<label class="col-lg-1 title-comerços no-padding">Comerços:</label>
	<div class="col-lg-1 no-padding">
		<a href="#/shops/0/a"><button class="btn-add col-lg-12 col-lg-offset-2 no-padding">Afegir <i class="fa fa-plus-circle" aria-hidden="true"></i></button></a>
	</div>
	<div class="col-lg-12"></div>
	<select class="col-lg-4 select-users" ng-disabled="privilegesLg=='A'" ng-change="listChange(idUserL)" ng-model="idUserL">
		<option ng-value="userL.idUser" ng-repeat="userL in userList" ng-selected="userL.idUser==<?php echo $_SESSION['user']['idUser']?>">{{userL.name}}</option>
	</select>
</div>
<div ng-show="fail">
	<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
		<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
		<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
		<b>{{statusValidation}}</b>
	</div>
</div>
<div class="row shops-list" ng-repeat="shops in shopsList | filter : {idUser:filterShops}:true" ng-show="(showList)">
	<div class="col-xs-12 col-lg-10 shop-cage">
		<div class="col-xs-12 col-md-3"><img class="img-responsive" src="../img/shops/{{shops.imgPref}}"></div>
		<div class="col-xs-12 no-padding col-md-9">
			<label class="col-lg-12">{{shops.name}}</label>
			<p class="col-lg-12">{{shops.description}}</p>
		</div>
	</div>
	<div class="col-xs-12 col-lg-2 botones">
		<a ng-href="#/shops/{{shops.idShop}}/{{$index}}"><button class="btn-edit col-xs-5 col-xs-push-1 col-lg-5 col-lg-push-2">Editar</button></a>
		<button ng-click="shopOneDelete(shops.idShop)" class="btn-delete col-xs-5 col-xs-push-1 col-lg-5 col-lg-push-2">Eliminar</button>
	</div>
</div>
	
<div class="row" ng-show="showShop">
	<label class="col-lg-12 title-comerços no-padding">Afegir comerç:</label>
	<form id="i-shop" class="row" name="i-shop">
		<input type="text" name="" ng-model="shopOne.idShop" hidden>
		
			<div class="col-lg-6 col-xs-12">
				<span class="col-xs-12 col-lg-12 no-padding">Nom comerç</span>
				<input class="col-lg-8" type="text" id="n-shop" ng-name="n-shop" ng-model="shopOne.name" placeholder="nom de la tenda" name="" required>
			</div>
			<div class="col-lg-6 col-xs-12">
				<select class="col-lg-10 select-users" id="u-shop" name="u-shop" ng-change="userOwner(idUser)" ng-model="shopOne.idUser">
					<option ng-value="userL.idUser" ng-repeat="userL in userList | filter: {idUser:'!1'}" ng-selected="userL.idUser==shopOne.idUser">{{userL.name}}</option>
				</select>
			</div>
		
		<div class="col-lg-6 col-xs-12">
			<span class="col-xs-12 col-lg-12 no-padding">Contrasenya</span>
			<input class="col-lg-8" type="password" ng-name="ps-shop" ng-model="shopOne.password" placeholder="contrasenya">
		</div>
		<div class="col-lg-12 no-padding">
			<div class="col-lg-6 col-xs-12">
				<span class="col-xs-12 col-lg-10 no-padding">Descripció llarga</span>
				<textarea class="col-xs-7 col-lg-8" rows="8" id="descL-shop" name="descL-shop" ng-model="shopOne.descriptionLong">{{shopOne.descriptionLong}}</textarea>
			</div>
			<div class="col-lg-6 col-xs-12">
				<span class="col-xs-6 col-lg-12 no-padding">Descripció curta</span>
				<textarea class="col-lg-8" rows="4" id="descS-shop" name="descS-shop" ng-model="shopOne.description">{{shopOne.description}}</textarea>
			</div>
			<div class="col-lg-6 col-xs-12">
				<span id="i-shop-city" class="col-lg-12 col-xs-12 no-padding">Ciutat</span>
				<input class="col-lg-8" type="text" id="c-shop" name="c-shop" placeholder="ciutat" name="" ng-model="shopOne.ciutat">
			</div>
		</div>
		<div class="col-lg-12 col-xs-12 no-padding">
			<div class="col-lg-6 col-xs-12">
				<span class="col-lg-12 col-xs-12 no-padding">Logo comerç</span>
				<label for="lg-shop" class="btn-add col-lg-4">Examinar<i class="fa fa-plus-circle add-examinar" aria-hidden="true"></i></label><input type="file" class="col-lg-4" id="lg-shop" name="lg-shop" uploader-model="shopOne.logo" ng-show="false" onchange="angular.element(this).scope().uploadLogo(this)">
			</div>
			<div class="col-lg-6 col-xs-12">
				<span class="col-lg-12 col-xs-12 no-padding">Pàgina web</span>
				<input type="text" class="col-lg-8" id="url-shop" name="url-shop" placeholder="www.webtenda.com" name="" ng-model="shopOne.web">
			</div>
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Latitud</span>
			<input type="text" class="col-lg-8" id="lat-shop" name="lat-shop" placeholder="00.000000" name="" ng-model="shopOne.lat">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Longitud</span>
			<input type="text" class="col-lg-8" id="lng-shop" name="lng-shop" placeholder="00.000000" name="" ng-model="shopOne.lng">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Teléfon</span>
			<input type="text" class="col-lg-8" id="p-shop" name="p-shop" placeholder="telefon o móbil" name="" ng-model="shopOne.telephone">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Codi Postal</span>
			<input type="text" class="col-lg-8" id="cp-shop" name="cp-shop" placeholder="XXXXX" name="" ng-model="shopOne.cp">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Adreça</span>
			<input type="text" class="col-lg-8" id="a-shop" name="a-shop" placeholder="C/carrer, numero" name="" ng-model="shopOne.address">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Horari</span>
			<input type="text" class="col-lg-8" id="s-shop" name="s-shop" placeholder="Dl-Dv XX:XX-XX:XX  i de XX:XX-XX:XX" name="" ng-model="shopOne.schedule">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Email</span>
			<input type="text" class="col-lg-8" id="e-shop" name="e-shop" placeholder="comerç@gmail.com" name="" ng-model="shopOne.email">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Whatsapp</span>
			<input type="text" class="col-lg-8" id="wa-shop" name="wa-shop" placeholder="telefon o móbil" name="" ng-model="shopOne.userWa">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Facebook</span>
			<input type="text" class="col-lg-8" id="fb-shop" name="fb-shop" placeholder="pàgina facebook" name="" ng-model="shopOne.userFb">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Twitter</span>
			<input type="text" class="col-lg-8" id="tt-shop" name="tt-shop" placeholder="pàgina de twitter" name="" ng-model="shopOne.userTt">
		</div>
		<div class="col-lg-6 col-xs-12">
			<span class="col-lg-12 col-xs-12 no-padding">Instagram</span>
			<input type="text" class="col-lg-8" id="ig-shop" name="ig-shop" placeholder="pàgina d'instagram" name="" ng-model="shopOne.userIg">
		</div>
		<div class="col-lg-6 col-xs-12">
			<input type="button" class="col-lg-4 col-lg-offset-2 btn-up" value="Actualitzar" ng-click="uploadFile()">
		</div>
	</form>
	<div class="row categories-edit" ng-hide="new">
		<div class="col-lg-12">
			<label class="col-lg-12 no-padding">Subcategoria principal</label>
			<select class="col-lg-4" ng-change="preferredSubCat(idSubCategory, shopOne.idShop)" ng-model="idSubCategory">
				<option ng-repeat="subCategory in allSubCat" ng-value="subCategory.idSubCategory" ng-selected="subCategoriesShop[0].nameSubCategoryShop==subCategory.nameSubCategory">{{subCategory.nameSubCategory}}</option>
			</select>
		</div>
		<div class="col-lg-12">	
			<label class="col-lg-6 no-padding">Afegir subcategoria</label>
			<label class="col-lg-6 no-padding">Altres subcategories</label>
			<select class="col-lg-4" ng-change="subCategory(idSubCategory, shopOne.idShop)" ng-model="idSubCategory">
				<option>--Escull subcategoria--</option>
				<option ng-repeat="subCategory in subCategories" ng-value="subCategory.idSubCategory" ng-selected="subCategory.idSubCategory=='1'">{{subCategory.nameSubCategory}}</option>
			</select>
			<ul class="col-lg-4 col-lg-offset-3 subCategory-list no-padding">
				<li class="col-lg-12 no-padding" ng-repeat="subCategoryShop in subCategoriesShop | filter : {preferred:'N'}">{{subCategoryShop.nameSubCategoryShop}}<button class="col-lg-1 col-lg-offset-11 btn-subCat-delete" ng-click="deleteSubCategory(subCategoryShop.idShopCategorySub, shopOne.idShop)">-</button></li>
			</ul>
		</div>
	</div>
	<div class="row images-edit" ng-hide="new">
		<div class="col-lg-11 images-prefered">
			<span class="col-lg-10 col-lg-offset-2 image-span">Imatge Destacada</span>
			<div class="col-lg-8 col-lg-offset-2 images-shop" ng-repeat="image in images | filter : {preferred:'Y'}">
				<img class="img-responsive" ng-src="../img/shops/{{image.url}}">
			</div>
			<label for="addImagePref" class="btn-image-edit col-lg-offset-7">Canviar imatge destacada</label><input type="file" id="addImagePref" ng-show="false" ng-model="image.url" onchange="angular.element(this).scope().changeImagesShops(this,'e')">
		</div>
		<div class="col-lg-11 images-other">
			<label for="addImage" class="btn-add col-lg-2">Afegir imatge <i class="fa fa-plus-circle" aria-hidden="true"></i></label><input type="file" id="addImage" ng-show="false" onchange="angular.element(this).scope().changeImagesShops(this,'n')">
			<span class="col-lg-10 image-span">Imatges</span>
			<div class="col-md-6 images-shop" ng-repeat="image in images | filter : {preferred:'N'}">
				<img class="img-responsive" ng-src="../img/shops/{{image.url}}">
				<button class="col-lg-3 col-lg-offset-5 btn-delete" ng-model="imageDelete" ng-click="deleteImage(image.idShopImage, image.url, shopOne.idShop)">Eliminar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>				
		</div>
	</div>
</div>
