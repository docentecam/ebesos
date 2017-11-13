<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<label class="col-xs-1 col-xs-12">Subcategories</label>
</div>
<div class="row">
	<span class="col-xs-4 titleCategoria">Categoria:</span>
	<select name="subCategoriesSelect" class="col-xs-3 col-lg-pull-2 col-sm-pull-1 selectSubCategories" ng-change="changeCat(idCategory,name,urlPicto1)" ng-model="idCategory">
		<option ng-repeat="category in categories" ng-value="category.name" ng-selected="category.idCategory==1">{{category.name}}</option>
	</select>
</div>
<div class="row tableSubCategories">
	<div class="col-xs-11 col-lg-8 borderTableSubCategories noPadding">
		<div class="col-xs-6 borderTitlesSubCategories centerPadding">
			<div class="col-xs-12 tableCategoriaSubCategoria noPadding">
				CATEGORIA
			</div>
		</div>
		<img class="iconSubCategory" width="50px" height="50px" src="../img/burger.svg" alt="" >
		<div class="col-xs-6 borderTitlesSubCategories centerPadding">
			<div class="col-xs-12 tableAlimentacioSubCategoria">
				<div ng-show="firstC">ALIMENTACIÓ</div>{{idCategoryC | uppercase}}
			</div>
		</div>
		<div class="col-xs-8 borderContentSubCategories">
			<div class="col-xs-12 centerPadding">
				Aviram
			</div>
		</div>
		<button class="col-xs-2 btn btn-SubCategory borderBtnEditSubCategories">
			Editar
		</button>
		<button class="col-xs-2 btn btn-SubCategory borderBtnDelSubCategories">
			Eliminar
		</button>
	</div>
</div>
<div class="row">
	<button id="btnAfegirSubCategoria" class="btn btn-default">Afegir <i class="fa fa-plus-circle"></i></button>
</div>
<div class="row">
	<span class="titleCategoria col-xs-4">Escull categoria:</span>
	<select name="subCategoriesSelect" class="col-xs-3 col-lg-pull-2 col-sm-pull-1 selectSubCategories">
		<option value="-1">Categoria</option>
		<option value="alimentacio">Alimentació</option>
	</select>
</div>
<div class="row">
	<span class="titleCategoria col-xs-4">Nom subcategoria:</span>
	<input type="text" class="col-xs-3 col-lg-pull-2 col-sm-pull-1 inputTextSubCategories">
</div>
<div class="row">
	<button id="afegirSubCategoria" class="btn btn-default col-xs-offset-8 col-lg-offset-6 centerPadding">Afegir</button> 
</div>
