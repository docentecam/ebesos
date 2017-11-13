<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<label class="col-xs-1 col-xs-12">Subcategories</label>
</div>
<div ng-show="subCatTable">
	<div class="row">
		<span class="col-lg-1 titleCategoria">Categoria:</span>
		<select name="subCategoriesSelect" class="col-lg-3 selectSubCategories" ng-change="changeCat(idCategory)" ng-model="idCategory">
			<option ng-repeat="category in categories" ng-value="category.name" ng-selected="category.idCategory==1">{{category.name}}</option>
		</select>
	</div>
	<div class="row tableSubCategories">
		<div class="col-lg-8 borderTableSubCategories noPadding">
			<div class="col-lg-6 borderTitlesSubCategories centerPadding">
				<div class="col-lg-12 tableCategoriaSubCategoria noPadding">
					CATEGORIA
				</div>
			</div>
			<img class="iconSubCategory" width="50px" height="50px" src="../img/pictograms/{{urlPicto1C}}" alt="" >
			<div class="col-lg-6 borderTitlesSubCategories centerPadding">
				<div class="col-lg-12 tableAlimentacioSubCategoria">
					<div ng-show="firstC">ALIMENTACIÓ</div>{{nameC | uppercase}}
				</div>
			</div>
			<div ng-repeat="subCategory in subCategories">
				<div class="col-lg-8 borderContentSubCategories">
					<div class="col-lg-12 centerPadding">
						{{subCategory.name+"-"+subCategory.idSubCategory}}
					</div>
				</div>
				<button class="col-lg-2 btn btn-SubCategory borderBtnEditSubCategories" id="editTable" ng-click="editSubCat(subCategory.idSubCategory,subCategory.name,'e')">
					Editar
				</button>
				<button class="col-lg-2 btn btn-SubCategory borderBtnDelSubCategories" id="deleteTable" ng-click="deleteSubCat(subCategory.idSubCategory)">
					Eliminar
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<button id="btnAfegirSubCategoria" class="btn btn-default" ng-click="addSubCat('a')">Afegir <i class="fa fa-plus-circle"></i></button>
	</div>
</div>
<div ng-hide="subCatTable">
	<form id="subCategoresAE">
		<div class="row">
			<span class="titleCategoria col-lg-1">Escull categoria:</span>
			<select name="subCategoriesSelect" class="col-lg-3 selectSubCategories" id="CategoryName">
				<option value="-1">Categoria</option>
				<option ng-repeat="category in categories" ng-value="category.idCategory">{{category.name}}</option>
			</select>
		</div>
		<div>
			<input type="text" class="col-lg-3 inputTextSubCategories" id="idSubC" ng-model="idSubCategorySC" hidden disabled>
			<input type="text" class="col-lg-3 inputTextSubCategories" id="addAcc" ng-model="accA" hidden disabled>
		</div>
		<div class="row">
			<span class="titleCategoria col-lg-1">Nom subcategoria:</span>
			<input type="text" class="col-lg-3 inputTextSubCategories" ng-model="nameSC" id="nsc">
		</div>
		<button id="afegirSubCategoria" class="btn btn-default centerPadding" ng-click="addBBDDSubCat()"><span ng-show="btnName">Afegir</span><span ng-hide="btnName">Editar</span></button>
	</form>
</div>