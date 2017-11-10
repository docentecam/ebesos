<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row" id="topDiv1">
	<label class="col-lg-1 col-xs-12 labelSubCategoria">Subcategories</label>
</div>
<div class="row">
	<span class="col-lg-1 titleCategoria">Categoria:</span>
	<select name="subCategoriesSelect" class="col-lg-3 selectSubCategories">
		<option value="alimentacio">Alimentació</option>
	  	<option value="restauració">Restauració</option>
	  	<option value="comerç">Comerç al detall</option>
	 	<option value="serveis">Serveis</option>
	</select>
</div>
<div class="row tableSubCategories">
	<div class="col-lg-8 borderTableSubCategories noPadding">
		<div class="col-lg-6 borderTitlesSubCategories centerPadding">
			<div class="col-lg-12 tableCategoriaSubCategoria noPadding">
				CATEGORIA
			</div>
		</div>
		<img class="iconSubCategory" width="50px" height="50px" src="../img/burger.svg" alt="" >
		<div class="col-lg-6 borderTitlesSubCategories centerPadding">
			<div class="col-lg-12 tableAlimentacioSubCategoria noPadding">
				ALIMENTACIÓ
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
		<div class="col-lg-8 borderContentSubCategories">
			<div class="col-lg-12 centerPadding">
				Carnisseria
			</div>
		</div>
		<button class="col-lg-2 btn btn-SubCategory borderBtnEditSubCategories">
			Editar
		</button>
		<button class="col-lg-2 btn btn-SubCategory borderBtnDelSubCategories">
			Eliminar
		</button>
		<div class="col-lg-8 borderContentSubCategories">
			<div class="col-lg-12 centerPadding">
				Verdures
			</div>
		</div>
		<button class="col-lg-2 btn btn-SubCategory borderBtnEditSubCategories">
			Editar
		</button>
		<button class="col-lg-2 btn btn-SubCategory borderBtnDelSubCategories">
			Eliminar
		</button><div class="col-lg-8 borderContentSubCategories">
			<div class="col-lg-12 centerPadding">
				Peixateria
			</div>
		</div>
		<button class="col-lg-2 btn btn-SubCategory borderBtnEditSubCategories">
			Editar
		</button>
		<button class="col-lg-2 btn btn-SubCategory borderBtnDelSubCategories">
			Eliminar
		</button><div class="col-lg-8 borderContentSubCategories">
			<div class="col-lg-12 centerPadding">
				Supermercats
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
	  	<option value="restauració">Restauració</option>
	  	<option value="comerç">Comerç al detall</option>
	 	<option value="serveis">Serveis</option>
	</select>
</div>
<div class="row">
	<span class="titleCategoria col-lg-1">Nom subcategoria:</span>
	<input type="text" class="col-lg-3 inputTextSubCategories">
</div>
<button id="afegirSubCategoria" class="btn btn-default centerPadding">Afegir</button> 