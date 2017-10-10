<div class="row">
	<button ng-click="shopOneAdd()">add</button>
</div>
<div class="row" ng-repeat="shops in shopsList">
	<div class="col-md-3"><img src="img/shops/{{shops.image}}"></div>
	<div class="col-md-9">
		<div class="row"><label>{{shops.name}}</label></div>
		<div class="row"><p>{{shops.description}}</p></div>
	</div>
	<button ng-click="shopOneEdit(shops.idShop)">edit</button>
	<!-- <button ng-click="shopOneDelete(shops.idShop)">delete tienda: {{shops.idShop}}</button> -->
	<button>delete</button>
</div>
	
<div class="row col-md-12" ng-show="showShop"> <!-- ng-repeat="shop in shopOne" -->
	<form id="i-shop" name="i-shop" ng-submit="infoShop()">
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<input type="text" ng-model="prueba">
				<span>Nom comerç</span>
				<input type="text" id="n-shop" ng-name="n-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].name">
			</div>
			<div id="user" class="col-md-4 col-md-push-1">
				<select id="u-shop" name="u-shop" ng-change="userOwner(idUser)" ng-model="idUser">
					<option ng-repeat="user in users" ng-value="user.name" ng-selected="user.idUser==shopOne[0].idUser">{{user.name}}</option>
				</select>
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Descripció llarga</span>
				<textarea cols="21" rows="10" id="descL-shop" name="descL-shop" value="">{{shopOne[0].descriptionLong}}</textarea>
			</div>
			<div class="row col-md-4 col-md-push-1">
				<div>
					<span>Descripció curta</span>
					<textarea cols="21" rows="5" id="descS-shop" name="descS-shop" value="">{{shopOne[0].description}}</textarea>
				</div>
				<div class="row col-md-4 col-md-push-1">
					<span>Ciutat</span>
					<input type="text" id="c-shop" name="c-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].ciutat">
				</div>
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Logo comerç</span>
				<input type="file" id="lg-shop" name="lg-shop">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Adreça electronica</span>
				<input type="text" id="url-shop" name="url-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].url">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Latitud</span>
				<input type="text" id="lat-shop" name="lat-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].lat">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Longitud</span>
				<input type="text" id="lng-shop" name="lng-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].lng">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Teléfon</span>
				<input type="text" id="p-shop" name="p-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].telephone">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Codi Postal</span>
				<input type="text" id="cp-shop" name="cp-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].cp">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-4 col-md-push-1">
				<span>Adreça</span>
				<input type="text" id="a-shop" name="a-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].address">
			</div>
			<div class="col-md-4 col-md-push-1">
				<span>Horari</span>
				<input type="text" id="s-shop" name="s-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].schedule">
			</div>
		</div>
		<div class="row col-md-12">
			<div class="col-md-3 col-md-push-1">
				<span>Email</span>
				<input type="text" id="e-shop" name="e-shop" placeholder="nom de la tenda" name="" ng-value="shopOne[0].email">
			</div>		
		</div>
		<div>
			<input type="submit" value="Confirmar canvis">
		</div>
	</form>
	<div class="row col-md-12">
		<div class="col-md-3 col-md-push-1">
			<span>Subcategoria preferida</span>
			<select ng-change="preferredSubCat(idShopCategorySub)" ng-model="idShopCategorySub">
				<option ng-repeat="subCategoryShop in subCategoriesShop" ng-value="subCategoryShop.idShopCategorySub" ng-selected="subCategoryShop.preferred=='Y'">{{subCategoryShop.nameSubCategoryShop}}</option>
			</select>
		</div>
	</div>
	<div class="row col-md-12">
		<div id="subcategories" class="shop-email col-md-4 col-md-push-1">
			<span>Subcategorias</span>
			<ul>
				<li ng-repeat="subCategoryShop in subCategoriesShop | filter : {preferred:'N'}">{{subCategoryShop.nameSubCategoryShop}}<button>-</button></li>
			</ul>
		</div>
		<div class="col-md-3 col-md-push-1">
			<span>Subcategories</span>
			<select ng-change="subCategory(idSubCategory)" ng-model="idSubCategory">
				<option ng-repeat="subCategory in subCategories" ng-value="subCategory.idSubCategory" ng-selected="subCategory.idSubCategory=='1'">{{subCategory.nameSubCategory}}</option>
			</select>
		</div>
	</div>
	<div class="row col-md-12">
		<div class="col-md-9 col-md-push-1">
			<span class="row">Imatge preferida</span>
			<div class="col-md-3" ng-repeat="image in images | filter : {preferred:'Y'}">
				<img  src="../img/shops/{{image.url}}">
			</div>				
			<input type="file" placeholder="nom de la tenda" class="row" name="" ng-value="shopOne[0].image">
		</div>
	</div>
	<div class="row col-md-12">
		<div class="shop-lon col-md-9 col-md-push-1">
			<span class="row">Imatges</span>
			<div class="col-md-2" ng-repeat="image in images | filter : {preferred:'N'}">
				<img  src="../img/shops/{{image.url}}">
				<button>delete</button>
			</div>				
			<input type="file" placeholder="nom de la tenda" class="row" name="" ng-value="shopOne[0].image">
		</div>
	</div>
</div>
