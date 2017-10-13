<?php
// session_start();
// if(!isset($_SESSION['user']['nom'])) header("Location: ../view/login.php");
?>

<div class="row">

	<input type="button" name="newNew" value="Afegir Noticia" alt="Afegir noticia" class="btn btn-default" ng-click="newNew()">
</div>

<div ng-show="listNew" class="row" ng-repeat="new in news">
	
	<div class="row">
		<img id="photo" src="../img/newsmedia/{{new.url}}"> 
	</div>

	<div class="row">
		<div>
			{{new.date}}
		</div>
		
	 </div>
	<div class="row">	
		<div>
		{{new.title}}
		</div>
	</div>

	<div>
		<div>
		{{new.titleSub}}
		</div>
	</div>	
		<div>
			<input type="button" value="Editar" alt="Edita dades de la noticia" class="btn btn-default" ng-click="selNew(new.idNew)">
			<input type="button" value="Esborrar" alt="Esborrar dades de la noticia" class="btn btn-default"" ng-click="">
		</div>
	<br>
	
</div>

<div  class="row">
	<div id="formNews" ng-show="showDiv" >
		<div ng-repeat="newSelected in newSelect">
		
		
			<form action="#" id="validation" name="validation" method="POST" >
				<div class="containerText">

					<h1> Editar Notícia</h1>
						<br>
					<div class="row">
						<div class="col-md-8">
							<input type="text" class="titleForm"  name="title" ng-model="newSelected.title">
						</div>

						<div class="col-md-3 col-md-pull-1" id="dateBox">
							<input type="date"  id="dateForm" name="date" ng-value="newSelected.date">
						</div>					
					</div>

					<div class="row">
						<div class="col-md-12">
							<textarea class="titleSub"> {{newSelected.titleSub}} </textarea>
						</div>
					</div>
					<input type="button" name="editNew" value="Editar Noticia" class="btn btn-default" ng-click="editNew()">
					<br><br>
				</div>
				<div id="containerImg" class="row">
					
					<div class="col-sm-6">
						<div id="containerPreferred">
							<label>Imatge Destacada</label>
							<img id="photo" src="../img/newsmedia/{{newSelected.url}}"> 
							<input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="changeImgP()">
							<input type="button" value="Eliminar" alt="" class="btn btn-default"" ng-click="">
						</div>
							<div id="containerImagesOfNew">
								<div ng-repeat="img in newSelected.images">
								
									<label> Imatges de les noticies </label> 
									<input type="button" value="Afegir foto" alt="" class="btn btn-default"" ng-click="">

									<img src="../img/newsmedia/{{img.url}}"> 
									<input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="changeImgN()">
									<input type="button" value="Eliminar" alt="" class="btn btn-default"" ng-click="">
								</div>
							</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="row">
	<div class="containerEditImg" ng-show="updateImgPreferred">
		<div>
			<input type="file" name="imgPreferred" id="updateImg">
		</div>	
		<br>
		<div>
			<input type="button" value="Actualitzar" alt="enviar dades del formulari" class="btn btn-default"" ng-click="changeImgPeferred(new.idNew)">
		</div>
	</div>	
</div>

<div class="row">
	<div id="containerEditNew" ng-show="updateNew">
		<form action="#" id="validation" name="validation" method="POST" >
				<div class="containerText">
					<h1> Editar Notícia</h1>
						<br>
					<div class="row">
						<div class="col-md-8">
							<input type="text" class="titleForm"  name="title" ng-value="newSelected.title">
						</div>

						<div class="col-md-3 col-md-pull-1" id="dateBox">
							<input type="date"  id="dateForm" name="date" ng-value="newSelected.date">
						</div>					
					</div>

					<div class="row">
						<div class="col-md-12">
							<textarea class="titleSub"> </textarea>
						</div>
					</div>
					<div>
						<input type="button" value="Actualitzar" alt="enviar dades del formulari" class="btn btn-default"" ng-click="">
					</div>
				</div>
		</form>
	</div>	
</div>

<div class="row">
	<div class="containerEditImg" ng-show="updateImgNew">
		<div>
			<input type="file" name="imgNew" id="updateImgNew">
		</div>	
		<br>
		<div>
			<input  type="button" value="Actualitzar" alt="enviar dades del formulari" class="btn btn-default"" ng-click="">
		</div>
	</div>	
</div>

<div class="row">
	<div  ng-show="newNews">
		<form id="validationNewForm" name="validationNewForm" ng-submit="validationNew()" >	
			<table  align="center">
		      	<tr>
		          <td> Titol de la noticia: </td>
		          <td><input name="titleNewNew" type="text"></td>
		        </tr>

		        <tr>
		          <td> Data de creació: </td>
		          <td><input name="dateNewNew" type="date"></td>
		        </tr>

		        <tr>
		          <td> Contingut de la noticia: </td>
		          <td><input name="titleSubNewNew" type="text"></td>
		        </tr>

		        <tr>
		          <td>Foto de Portada: </td> 
		          <td><input name="imgPreferred" type="file" uploader-model="file"></td>
		        </tr>

		         <tr>
		          <td>Foto/s de la noticia: </td>
		          <td><input name="ImgNoPreferred" type="file"></td>
		        </tr>

		         <tr>
		          <td>Video/s de la noticia: </td>
		          <td><input name="video" type="text"></td>
		        </tr>
		    </table>

		    <div>
				<input  type="button" value="Crear Noticia" alt="" class="btn btn-default">
			</div>
		</form>
	</div>	
</div>




