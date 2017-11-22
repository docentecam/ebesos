<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<label class="col-lg-1 col-xs-12 titleSubcategoria">Subcategories</label>
</div>
<div ng-show="fail">
	<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
		<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
		<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
		<b>{{statusValidation}}</b>
	</div>
</div>
<div ng-show="subCatTable">
	<div class="row">
		<span class="col-xs-4 col-sm-3 col-md-2 titleCategoria">Categoria:</span>
		<select name="subCategoriesSelect" class="col-xs-3 selectSubCategories" ng-change="changeCat(idCategory)" ng-model="idCategory">
			<option ng-repeat="category in categories" ng-value="category.name" ng-selected="category.idCategory==1">{{category.name}}</option>
		</select>
	</div>
	<div class="row tableSubCategories">
		<div class="col-xs-11 col-lg-10 borderTableSubCategories noPadding">
			<div class="col-xs-6 borderTitlesSubCategories centerPadding">
				<div class="col-xs-12 tableCategoriaSubCategoria noPadding">
					CATEGORIA
				</div>
			</div>
			<img class="iconSubCategory" width="50px" height="50px" src="../img/pictograms/{{urlPicto1C}}" alt="" >
			<div class="col-xs-6 borderTitlesSubCategories centerPadding">
				<div class="col-xs-12 tableAlimentacioSubCategoria">
					<div ng-show="firstC">ALIMENTACIÓ</div>{{nameC | uppercase}}
				</div>
			</div>
			<div ng-repeat="subCategory in subCategories">
				<div class="col-xs-8 borderContentSubCategories">
					<div class="col-xs-12 centerPadding">
						{{subCategory.name}}
					</div>
				</div>
				<button class="col-xs-2 btn btn-SubCategory borderBtnEditSubCategories" id="editTable">
					<a ng-href="#/subcategories/e/{{subCategory.idSubCategory}}/{{subCategory.name}}">Editar</a>
				</button>
				<button class="col-xs-2 btn btn-SubCategory borderBtnDelSubCategories" id="deleteTable" ng-click="deleteSubCatT(subCategory.idSubCategory)">
					Eliminar
				</button>
			</div>
		</div>
	</div>
	<div class="row">
		<button id="btnAfegirSubCategoria" class="btn btn-default" ng-click="addSubCat('a')"><a ng-href="#/subcategories/a/-1/n">Afegir <i class="fa fa-plus-circle"></i></a></button>
	</div>
</div>
<div ng-hide="subCatTable">
	<form id="subCategoresAE">
		<div class="row">
			<span class="titleCategoria col-xs-4 col-md-3">Escull categoria:</span>
			<select name="subCategoriesSelect" class="col-xs-3 selectSubCategories" id="CategoryName">
				<option value="-1">Categoria</option>
				<option ng-repeat="category in categories" ng-value="category.idCategory">{{category.name}}</option>
			</select>
		</div>
		<div>
			<input type="text" class="col-xs-3 inputTextSubCategories" id="idSubC" ng-model="idSubCategorySC" hidden disabled>
			<input type="text" class="col-xs-3 inputTextSubCategories" id="addAcc" ng-model="accA" hidden disabled>
		</div>
		<div class="row">
			<span class="titleCategoria col-xs-4 col-md-3">Nom subcategoria:</span>
			<input type="text" maxlength="20" class="col-xs-3 inputTextSubCategories" ng-model="nameSC" id="nsc">
		</div>
		<button id="afegirSubCategoria" class="btn btn-default centerPadding" ng-click="addBBDDSubCat()"><span ng-show="btnName">Afegir</span><span ng-hide="btnName">Editar</span></button>
	</form>
</div>