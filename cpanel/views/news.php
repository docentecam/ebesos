<?php
// session_start();
// if(!isset($_SESSION['user']['idUser']) header("Location: login.php");
?>
<div class="row">
	<div class="col-sm-12 text-center" ng-show="divMessages">
		<label>{{message}}</label>
	</div>
</div>

<div class="row">
	<div class="col-sm-12" ng-show="btnAddNew">
		<input type="button" name="newNew" value="Afegir Noticia" alt="Afegir noticia" class="btn btn-default" ng-click="createNew('Afegir','')" >
	</div>
</div>

<form name="formListNews" class="row" ng-show="showListNews" ng-repeat="newList in newsList">
	 <div class="form-group col-sm-12">
		<img id="photo" ng-src="../img/newsmedia/{{newList.urlPreferred}}" width="150px"> 
	</div>
	<div class="form-group col-sm-12">
		<span>{{newList.date}}</span><br/><span>{{newList.title}}</span><br/><span>{{newList.titleSub}}</span>
	</div>	
	<div class="form-group col-sm-12">
		<input type="button" class="btn btn-success pull-left" value="Editar" alt="Edita dades de la noticia" class="btn btn-default" ng-click="createNew('Editar',newList.idNew)">&nbsp;&nbsp;&nbsp;
		<input type="button" class="btn btn-success" value="Esborrar" alt="Esborrar dades de la noticia" class="btn btn-default" ng-click="deleteNew(newList.idNew)">
	</div>
</form>



<form class="row" name="formNew" ng-show="divNew" >
	<div class="form-group">
		<h1>Notícia</h1>
	</div>
	<div class="form-group">
		<label class="col-sm-1" for="title">Títol</label>
		<input type="text" class="col-sm-8 input-sm" name="title" ng-model="new.title">
		<span class="col-sm-1"></span>
		<input type="date" class="col-sm-2 input-sm" name="dateBox" id="dateForm" name="date" ng-model="new.dateNew">
	</div>
	<div class="form-group">
		<label class="col-sm-1" for="titleSub">Subtítol</label>
		<textarea class="col-sm-11" name="titleSub" ng-model="new.titleSub"></textarea>
	</div>
	<div class="form-group">
		<label for="description">Descripció</label>
		<input type="text" class="input-sm" placeholder="Descripció" name="description" ng-model="new.descPreferred" required >
	</div>
	<div class="form-group">
		<label for="title" class="col-sm-10"><h2> Imatge Destacada</h2></label>
		<input type="file" class="col-sm-2 btn btn-default" value="Canviar preferida" accept="image/jgp, image/png" onchange="angular.element(this).scope().selImages(this,'preferred')"> 
		<img class="col-sm-4 pull-left" id="photo" ng-src="../img/newsmedia/{{new.urlPreferred}}" > 
	</div>
	
	<div class="form-group">
		<span class="col-sm-1"></span>
		<input type="button" class="btn btn-success pull-left col-sm-10" name="editNew" value="{{act}} Noticia" class="btn btn-default" ng-click="">
	</div>
</form>

<form class="row" name="formImgs" ng-show="divImgs">
	<div class="form-group">
		<label class="col-sm-2" for="descripcio">Descripció</label>
		<input type="text" class="col-sm-8 input-sm" placeholder="Descripció" name="descripcio" ng-model="newImgAdd.descripcio" required >
	</div>
	<div class="for-group">
		<h2 class="col-sm-12"> Imatges de la noticia </h2> 
		<div class="col-sm-4" ng-repeat="image in new.images | filter : {preferred:'N' , type:'I'}">
			<img class="col-sm-12" ng-src="../img/newsmedia/{{image.url}}">
			<input type="button" class="col-sm-6 btn btn-default pull-left" value="Modificar" alt="" class="btn btn-default" ng-click="changeImgN()">
			<input type="button" class="col-sm-6 btn btn-default pull-left" value="Eliminar" alt="" class="btn btn-default" ng-click="imgDelete(image.idNewMedia, image.url)">
			<i class="col-sm-6 fa fa-pencil" aria-hidden="true"></i><i class=" col-sm-6 fa fa-trash" aria-hidden="true"></i>
			<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
<span class="sr-only">Loading...</span>
		</div>
	</div>
</form>

<form class="row" name="formVideos" ng-show="divVideos">
	<div class="form-group">
		<label class="col-sm-2" for="url">Url</label>
		<input type="text" class="col-sm-8 input-sm" placeholder="Descripció" name="descripcio" ng-model="newVideo.url" required >
	</div>
	<div class="for-group">
		<h2 class="col-sm-12"> Vídeos de la noticia </h2> 
		<div class="col-sm-4" ng-repeat="image in new.images | filter : {type:'V'}">
			<iframe width="400" height="215"  frameborder="0" allowfullscreen ng-src="https://www.youtube.com/embed/image.url"></iframe>
			<input type="button" class="col-sm-6 btn btn-default pull-left" value="Modificar" alt="" class="btn btn-default" ng-click="changeImgN()">
			<input type="button" class="col-sm-6 btn btn-default pull-left" value="Eliminar" alt="" class="btn btn-default" ng-click="imgDelete(image.idNewMedia, image.url)">
			<i class="col-sm-6 fa fa-pencil" aria-hidden="true"></i><i class=" col-sm-6 fa fa-trash" aria-hidden="true"></i>
			<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>
<span class="sr-only">Loading...</span>
		</div>
	</div>
</form>


<!-- <div id="containerImagesOfNew">
	<form name="newFormFile">
		<div class="form-group">
		    <label for="descripcio">Descripción</label>
		    <input type="text" class="form-control" placeholder="Descripció" name="descripcio" ng-model="formNew.descripcio" required >
		</div>
			<input type="file" id="file" name="img[]" multiple onchange="angular.element(this).scope().selImages(this)" />
			<input type="submit" class="btn btn-success pull-right" ng-click="enviaForm(formNew, 1)" >
	</form>
	<div ng-repeat="image in images | filter : {preferred:'N' , type:'I'}">
		<h2> Imatge de les noticia </h2> 
		<img ng-src="../img/newsmedia/{{image.url}}"> {{image.idNewMedia}}
		<input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="changeImgN()">
		<input type="button" value="Eliminar" alt="" class="btn btn-default"" ng-click="imgDelete(image.idNewMedia, image.url)">
	</div>
	<div id="containerVideosOfNew">
		<input type="button" value="Afegir video" alt="" class="btn btn-default"" ng-click="createVideo()">
		<div ng-repeat="image in images | filter : {type:'V'}">
			<label> Video de les noticia </label>
			<iframe width="560" height="315"  frameborder="0" allowfullscreen ng-src="https://www.youtube.com/embed/image.url"></iframe>
			<input type="button" value="Modificar" alt="" class="btn btn-default"" ng-click="">
			<input type="button" value="Eliminar" alt="" class="btn btn-default"" ng-click="">
		</div>
	</div>
</div> -->




















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

