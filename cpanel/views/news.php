<?php
// session_start();
// if(!isset($_SESSION['user']['idUser']) header("Location: login.php");
?>


<div ng-show="listNew" class="row" ng-repeat="new in news">

<div class="row" ng-show="createNew">
	
	<div class="col-lg-6">
		<input type="button" name="newNew" value="Afegir Noticia" alt="Afegir noticia" class="btn btn-default" ng-click="createNewD('Afegir')">
	</div>
	
</div>

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
			<input type="button" value="Editar" alt="Edita dades de la noticia" class="btn btn-default" ng-click="createNewD('Editar',new.idNew)">
			<input type="button" value="Esborrar" alt="Esborrar dades de la noticia" class="btn btn-default"" ng-click="">
		</div>
	<br>
	
</div>

<div  class="row">
	<div id="formNews" ng-show="divNew" >
		<div>
		
			<form action="#" id="validation" name="validation" method="POST" >
				<div class="containerText">

					<h1> {{act}} Notícia</h1>{{dateNew}}
						<br>
					
					<div class="row">
						<div class="col-md-8">
							<input type="text" class="titleForm"  name="title" ng-model="title">
						</div>

						<div class="col-md-3 col-md-pull-1" id="dateBox">
							<input type="date"  id="dateForm" name="date" ng-model="dateNew" >
						</div>					
					</div>

					<div class="row">
						<div class="col-md-12">
							<textarea class="titleSub" ng-model="titleSub">  </textarea>
						</div>
					</div>

				<div id="containerImg" class="row">
					<h2> Imatge Destacada</h2> <input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="changeImgP()"> 
				
						<div id="containerPreferred" ng-repeat="image in images | filter : {preferred:'Y'}">
							<img id="photo" src="../img/newsmedia/{{image.url}}"> 
						</div> 
						
					</div>
					<div class="col-sm-6">
					<input type="button" name="editNew" value="{{act}} Noticia" class="btn btn-default" ng-click="">
					<br><br>
				</div>

		</div>		
						<div id="containerImagesOfNew">
							<input type="button" value="Afegir foto" alt="" class="btn btn-default"" ng-click="">
							<div ng-repeat="image in images | filter : {preferred:'N' , type:'I'}">
								<label> Imatge de les noticia </label> 
								<img src="../img/newsmedia/{{image.url}}"> 
								<input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="changeImgN()">
								<input type="button" value="Eliminar" alt="" class="btn btn-default"" ng-click="imgD(image.idNewMedia,image.idNew)">
							</div>
						</div>

						<div id="containerVideosOfNew">
							<input type="button" value="Afegir video" alt="" class="btn btn-default"" ng-click="createVideo()">
							<div ng-repeat="image in images | filter : {type:'V' , preferred:'N' }">
								<label> Video de les noticia </label>
								<iframe width="560" height="315"  frameborder="0" allowfullscreen ng-src="https://www.youtube.com/embed/image.url"></iframe>
								<input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="">
								<input type="button" value="Eliminar" alt="" class="btn btn-default"" ng-click="">
							</div>
						</div>

					</div>
				</div>
			</form>
		
	</div>
</div>

<!-- <div class="row">
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

			<label> Afegueix la teva Url: </label>
			<input type="file" name="VideoNew" id="updateImgNew">
		</div>	
		<br>

		<div>
			<label> Afegueix la teva Imatge: </label>
			<input type="file" name="imgNew" id="updateImgNew">
		</div>	
		<div>
			<input  type="button" value="Actualitzar" alt="enviar dades del formulari" class="btn btn-default"" ng-click="">
		</div>
	</div>	
</div>

<div class="row">
	<div  ng-show="newNews">
		<form id="validationNewForm" name="validationNewForm" ng-submit="uploadFile()">	
			
			<div class="col-lg-12 padd">
				<input type="text" name="userId" id="userId"  disabled hidden>
			</div>
			
			<table  align="center">  	
		      	<tr>
		          <td> Titol de la noticia: </td>
		          <td><input type="text"  ng-model="titleNew" id="title"></td>
		        </tr>
				<tr>
		          <td>Foto de Portada: </td> 
		          <td> <input type="file" name="file" uploader-model="file"</td>
		        </tr>
		        <tr>
		          <td> Data de creació: </td>
		          <td><input name="date" type="date" id="date"> </td>
		        </tr>

		        <tr>
		          <td> Contingut de la noticia: </td>
		          <td><textarea name="titleSub" type="text" id="titleSub"></textarea>
		          </td>
		        </tr>

		        

		         <tr>
		          <td>Foto/s de la noticia: </td>
		          <td><input name="ImgNoPreferred" type="file" id="imgNoPreferred"></td>
		        </tr>

		         <tr>
		          <td> URL del/s Video/s de la noticia: </td>
		          <td><input name="video" type="text" id="video"></td>
		        </tr>
		    </table>

		    <div>
				<input  type="submit" value="Enviar">
			</div>
		</form>
	</div>	
</div>

<div class="row">
	<div class="containerEditImg" ng-show="createVideo">
		<div>
			<label> Afegueix la teva Url: </label>
			<input type="file" name="newVideo" id="newVideo">
		</div>	
		<div>
			<input  type="button" value="Crear" alt="enviar dades del formulari" class="btn btn-default"" ng-click="createVideo()">
		</div>
	</div>	
</div>


 -->

