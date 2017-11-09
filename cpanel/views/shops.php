<!-- <?php
	// session_start();
	// if(!isset($_SESSION['user']['nom'])) header("Location: ../view/login.php");
?> -->
<div class="row">
	<button ng-click="shopOneAdd()" class="btn-default">add</button>
	<select ng-disabled="privilegesLg=='A'" ng-change="listChange(idUserL)" ng-model="idUserL">
		<option ng-value="userL.idUser" ng-repeat="userL in userList" ng-selected="userL.idUser==idUserLg">{{userL.name}}</option>
	</select>
</div>
<div class="row shops-list" ng-repeat="shops in shopsList | filter : {idUser:filterShops}:true" ng-show="(showList)">
	<div class="col-lg-10 shop-cage">
		<div class="col-md-3"><img class="img-responsive" src="../img/shops/{{shops.imgPref}}"></div>
		<div class="col-md-9">
			<label class="col-lg-12">{{shops.name}}/{{shops.idUser}}/{{idUserLg}}</label>
			<p class="col-lg-12">{{shops.description}}</p>
		</div>
	</div>
	<div class="col-lg-2 botones">
		<button ng-click="shopOneEdit($index, 'e', shops.idShop)" class="btn-edit col-lg-5 col-lg-push-2">Editar</button>
		<!-- <button ng-click="shopOneDelete(shops.idShop)" class="btn-default col-lg-6">delete tienda: {{shops.idShop}}</button> -->
		<button class="btn-delete col-lg-5 col-lg-push-2">Eliminar</button>
	</div>
</div>
	
<div class="row col-md-12" ng-show="showShop"> <!-- ng-repeat="shop in shopOne" -->
	<form id="i-shop" name="i-shop" ng-submit="uploadFile()">
		<input type="text" name="" ng-model="shopOne.idShop" hidden>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Nom comerç</span>
				<input type="text" id="n-shop" ng-name="n-shop" ng-model="shopOne.name" placeholder="nom de la tenda" name="">
			</div>
			<div id="user" class="col-md-4 col-md-push-1">
				<select id="u-shop" name="u-shop" ng-change="userOwner(idUser)" ng-model="idUser">
					<option ng-value="userL.idUser" ng-repeat="userL in userList | filter: {idUser:'!1'}" ng-selected="userL.idUser==shopOne.idUser">{{userL.name}}</option>
				</select>
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Descripció llarga</span>
				<textarea cols="21" rows="10" id="descL-shop" name="descL-shop" ng-model="shopOne.descriptionLong">{{shopOne.descriptionLong}}</textarea>
			</div>
			<div class="row col-md-4 col-md-push-1">
				<div>
					<span>Descripció curta</span>
					<textarea cols="21" rows="5" id="descS-shop" name="descS-shop" ng-model="shopOne.description">{{shopOne.description}}</textarea>
				</div>
				<div class="row col-md-4 col-md-push-1">
					<span>Ciutat</span>
					<input type="text" id="c-shop" name="c-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.ciutat">
				</div>
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Logo comerç</span>
				<input type="file" id="lg-shop" name="lg-shop" uploader-model="shopOne.logo">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Adreça electronica</span>
				<input type="text" id="url-shop" name="url-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.web">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Latitud</span>
				<input type="text" id="lat-shop" name="lat-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.lat">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Longitud</span>
				<input type="text" id="lng-shop" name="lng-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.lng">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Teléfon</span>
				<input type="text" id="p-shop" name="p-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.telephone">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Codi Postal</span>
				<input type="text" id="cp-shop" name="cp-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.cp">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Adreça</span>
				<input type="text" id="a-shop" name="a-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.address">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Horari</span>
				<input type="text" id="s-shop" name="s-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.schedule">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-3 col-md-push-1">
				<span>Email</span>
				<input type="text" id="e-shop" name="e-shop" placeholder="nom de la tenda" name="" ng-model="shopOne.email">
			</div>		
		</div>
		<div>
			<input type="submit" value="Confirmar canvis" class="btn-default">
		</div>
	</form>
	<div class="row col-md-12">
		<div class="col-md-3 col-md-push-1">
			<span>Subcategoria principal</span>
			<select ng-change="preferredSubCat(idSubCategory, shopOne.idShop)" ng-model="idSubCategory">
				<option ng-repeat="subCategory in allSubCat" ng-value="subCategory.idSubCategory" ng-selected="subCategoriesShop.preferred=='Y'">{{subCategory.nameSubCategory}}</option>
			</select>
		</div>
	</div>
	<div class="row col-md-12">
		<div id="subcategories" class="shop-email col-md-4 col-md-push-1">
			<span class="row">Altres subcategories</span>
			<ul class="col-md-10">
				<li ng-repeat="subCategoryShop in subCategoriesShop | filter : {preferred:'N'}">{{subCategoryShop.nameSubCategoryShop}}<button ng-click="deleteSubCategory(subCategoryShop.idShopCategorySub, shopOne.idShop)">-</button></li>
			</ul>
			<!-- <button ng-repeat="subCategoryShop in subCategoriesShop | filter : {preferred:'N'}" class="btn-default col-md-1" ng-click="deleteSubCategory(subCategoryShop.idShopCategorySub, shopOne[0].idShop)">-</button> -->
		</div>
		<div class="col-md-3 col-md-push-1">
			<span>Subcategories</span>
			<select ng-change="subCategory(idSubCategory, shopOne.idShop)" ng-model="idSubCategory">
				<option>--Escull subcategoria--</option>
				<option ng-repeat="subCategory in subCategories" ng-value="subCategory.idSubCategory" ng-selected="subCategory.idSubCategory=='1'">{{subCategory.nameSubCategory}}</option>
			</select>
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-9 col-md-push-1">
			<span class="row">Imatge preferida</span>
			<div class="col-md-3" ng-repeat="image in images | filter : {preferred:'Y'}">
				<img class="img-responsive" src="../img/shops/{{image.url}}">
			</div>				
			<input type="file" placeholder="nom de la tenda" class="row" name="" ng-value="shopOne[0].image">
		</div>
	</div>
	<div class="row col-md-12">
		<div class="shop-lon col-md-9 col-md-push-1">
			<span class="row">Imatges</span>
			<div class="col-md-2" ng-repeat="image in images | filter : {preferred:'N'}">
				<img class="img-responsive" src="../img/shops/{{image.url}}">
				<button class="btn-default">delete</button>
			</div>				
			<input type="file" placeholder="nom de la tenda" class="row" name="" ng-value="shopOne[0].image">
		</div>
	</div>
</div>
