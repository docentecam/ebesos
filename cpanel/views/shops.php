<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<label class="col-lg-1 title-comerços no-padding">Comerços:</label>
	<button ng-click="shopOneAdd()" class="btn-add col-lg-1 col-lg-offset-1 no-padding">Afegir <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
	<div class="col-lg-12"></div>
	<select class="col-lg-4 select-users" ng-disabled="privilegesLg=='A'" ng-change="listChange(idUserL)" ng-model="idUserL">
		<option ng-value="userL.idUser" ng-repeat="userL in userList" ng-selected="userL.idUser==<?php echo $_SESSION['user']['idUser']?>">{{userL.name}}</option>
	</select>
</div>
<div class="row shops-list" ng-repeat="shops in shopsList | filter : {idUser:filterShops}:true" ng-show="(showList)">
	<div class="col-lg-10 shop-cage">
		<div class="col-md-3"><img class="img-responsive" src="../img/shops/{{shops.imgPref}}"></div>
		<div class="col-md-9">
			<label class="col-lg-12">{{shops.name}}/{{shops.idUser}}/{{idUserLg}}</label><!-- TODO: quitar shops.idUser y idUserLg -->
			<p class="col-lg-12">{{shops.description}}</p>
		</div>
	</div>
	<div class="col-lg-2 botones">
		<button ng-click="shopOneEdit($index, 'e', shops.idShop)" class="btn-edit col-lg-5 col-lg-push-2">Editar</button>
		<!-- <button ng-click="shopOneDelete(shops.idShop)" class="btn-default col-lg-6">delete tienda: {{shops.idShop}}</button> -->
		<button class="btn-delete col-lg-5 col-lg-push-2">Eliminar</button>
	</div>
</div>
	
<div class="row" ng-show="showShop"> <!-- ng-repeat="shop in shopOne" -->
	<form id="i-shop" class="row" name="i-shop" ng-submit="uploadFile()">
		<input type="text" name="" ng-model="shopOne.idShop" hidden>
		<div class="col-md-12">
			<span class="col-lg-12">Nom comerç</span>
			<input class="col-lg-4" type="text" id="n-shop" ng-name="n-shop" ng-model="shopOne.name" placeholder="nom de la tenda" name="">
			<select class="col-lg-4 col-lg-offset-2" id="u-shop" name="u-shop" ng-change="userOwner(idUser)" ng-model="idUser">
				<option ng-value="userL.idUser" ng-repeat="userL in userList | filter: {idUser:'!1'}" ng-selected="userL.idUser==shopOne.idUser">{{userL.name}}</option>
			</select>
		</div>
		<div class="col-md-12">
			<span class="col-lg-6">Descripció llarga</span>
			<span class="col-lg-6">Descripció curta</span>
			<textarea class="col-lg-4" rows="8" id="descL-shop" name="descL-shop" ng-model="shopOne.descriptionLong">{{shopOne.descriptionLong}}</textarea>
			<textarea class="col-lg-4 col-lg-offset-2" rows="5" id="descS-shop" name="descS-shop" ng-model="shopOne.description">{{shopOne.description}}</textarea>
			<span class="col-lg-4 col-lg-offset-2">Ciutat</span>
			<input class="col-lg-4 col-lg-offset-2" type="text" id="c-shop" name="c-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.ciutat">
		</div>
		<div class="col-md-12">
			<span class="col-lg-6">Logo comerç</span>
			<span class="col-lg-6">Adreça electronica</span>
			<input type="file" class="col-lg-4" id="lg-shop" name="lg-shop" uploader-model="shopOne.logo">
			<input type="text" class="col-lg-4 col-lg-offset-2" id="url-shop" name="url-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.web">
		</div>
		<div class="col-md-12">
			<span class="col-lg-6">Latitud</span>
			<span class="col-lg-6">Longitud</span>
			<input type="text" class="col-lg-4" id="lat-shop" name="lat-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.lat">
			<input type="text" class="col-lg-4 col-lg-offset-2" id="lng-shop" name="lng-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.lng">
		</div>
		<div class="col-md-12">
				<span class="col-lg-6">Teléfon</span>
				<span class="col-lg-6">Codi Postal</span>
				<input type="text" class="col-lg-4" id="p-shop" name="p-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.telephone">
				<input type="text" class="col-lg-4 col-lg-offset-2" id="cp-shop" name="cp-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.cp">
		</div>
		<div class="col-md-12">
			<span class="col-lg-6">Adreça</span>
			<span class="col-lg-6">Horari</span>
			<input type="text" class="col-lg-4" id="a-shop" name="a-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.address">
			<input type="text" class="col-lg-4 col-lg-offset-2" id="s-shop" name="s-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.schedule">
		</div>
		<div class="col-md-12">
			<span class="col-lg-12">Email</span>
			<input type="text" class="col-lg-4" id="e-shop" name="e-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.email">
			<input type="submit" class="col-lg-4 col-lg-offset-2" value="Confirmar canvis" class="btn-default">
	</form>
	<div class="row">
		<div class="col-lg-12">
			<span class="col-lg-12">Subcategoria principal</span>
			<select class="col-lg-4" ng-change="preferredSubCat(idSubCategory, shopOne.idShop)" ng-model="idSubCategory">
				<option ng-repeat="subCategory in allSubCat" ng-value="subCategory.idSubCategory" ng-selected="subCategoriesShop.preferred=='Y'">{{subCategory.nameSubCategory}}</option>
			</select>
		</div>
		<div class="col-lg-12">	
			<span class="col-lg-6">Afegir subcategoria</span>
			<span class="col-lg-6">Altres subcategories</span>
			<select class="col-lg-4" ng-change="subCategory(idSubCategory, shopOne.idShop)" ng-model="idSubCategory">
				<option>--Escull subcategoria--</option>
				<option ng-repeat="subCategory in subCategories" ng-value="subCategory.idSubCategory" ng-selected="subCategory.idSubCategory=='1'">{{subCategory.nameSubCategory}}</option>
			</select>
			<ul class="col-lg-4 col-lg-offset-2 subCategory-list">
				<li class="col-lg-12" ng-repeat="subCategoryShop in subCategoriesShop | filter : {preferred:'N'}">{{subCategoryShop.nameSubCategoryShop}}<button class="col-lg-1 col-lg-offset-11 btn-subCat-delete" ng-click="deleteSubCategory(subCategoryShop.idShopCategorySub, shopOne.idShop)">-</button></li>
			</ul>
			<!-- <button ng-repeat="subCategoryShop in subCategoriesShop | filter : {preferred:'N'}" class="btn-default col-md-1" ng-click="deleteSubCategory(subCategoryShop.idShopCategorySub, shopOne[0].idShop)">-</button> -->
		</div>
	</div>
	<div class="row images-edit">
		<div class="col-lg-11 images-prefered">
			<span class="col-lg-10 col-lg-offset-2 image-span">Imatge Destacada</span>
			<div class="col-lg-8 col-lg-offset-2 images-shop" ng-repeat="image in images | filter : {preferred:'Y'}">
				<img class="img-responsive" src="../img/shops/{{image.url}}">
			</div>
			<label for="addImagePref" class="btn-image-edit col-lg-offset-7">Canviar imatge destacada</label><input type="file" id="addImagePref" ng-show="false" ng-model="image.url" onchange="angular.element(this).scope().changeImagesShops(this,'e')">
		</div>
		<div class="col-lg-11 images-other">
			<label for="addImage" class="btn-add col-lg-2">Afegir imatge <i class="fa fa-plus-circle" aria-hidden="true"></i></label><input type="file" id="addImage" ng-show="false" onchange="angular.element(this).scope().changeImagesShops(this,'n')">
			<span class="col-lg-10 image-span">Imatges</span>
			<div class="col-md-6 images-shop" ng-repeat="image in images | filter : {preferred:'N'}">
				<img class="img-responsive" src="../img/shops/{{image.url}}">
				<button class="col-lg-3 col-lg-offset-5 btn-delete" ng-model="imageDelete" ng-click="deleteImage(image.idShopImage, image.url, shopOne.idShop)">Eliminar <i class="fa fa-times" aria-hidden="true"></i></button>
			</div>				
		</div>
	</div>
</div>
