<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<label class="col-lg-1 col-xs-12">Subcategories</label>
</div>
<div class="row">
	<span class="col-lg-1 titleCategoria">Categoria:</span>
	<select name="subCategoriesSelect" class="col-lg-3 selectSubCategories" ng-change="changeCat(idCategory,name,urlPicto1)" ng-model="idCategory">
		<option ng-repeat="category in categories" ng-value="category.name" ng-selected="category.idCategory==1">{{category.name}}</option>
	</select>
</div>
<div class="row tableSubCategories">
	<div class="col-lg-8 borderTableSubCategories noPadding">
		<div class="col-lg-6 borderTitlesSubCategories centerPadding">
			<div class="col-lg-12 tableCategoriaSubCategoria">
				CATEGORIA
			</div>
		</div>
		<div class="col-lg-6 borderTitlesSubCategories centerPadding">
			<div class="col-lg-12 tableAlimentacioSubCategoria">
				<div ng-show="firstC">ALIMENTACIÓ</div>{{idCategoryC | uppercase}}
			</div>
		</div>
		<div class="col-lg-8 borderContentSubCategories">
			<div class="col-lg-12 centerPadding">
				Aviram
			</div>
		</div>
		<button class="col-lg-2 btn btn-SubCategory borderBtnEditSubCategories">
			Editar
		</button>
		<button class="col-lg-2 btn btn-SubCategory borderBtnDelSubCategories">
			Eliminar
		</button>
	</div>
</div>
<div class="row">
	<button id="btnAfegirSubCategoria" class="btn btn-default">Afegir <i class="fa fa-plus-circle"></i></button>
</div>
<div class="row">
	<span class="titleCategoria col-lg-1">Escull categoria:</span>
	<select name="subCategoriesSelect" class="col-lg-3 selectSubCategories">
		<option value="-1">Categoria</option>
		<option value="alimentacio">Alimentació</option>
	</select>
</div>
<div class="row">
	<span class="titleCategoria col-lg-1">Nom subcategoria:</span>
	<input type="text" class="col-lg-3 inputTextSubCategories">
</div>
<button id="afegirSubCategoria" class="btn btn-default centerPadding">Afegir</button> 