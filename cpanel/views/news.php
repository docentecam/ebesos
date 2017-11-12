<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<div class="col-sm-12 text-center" ng-show="divMessages">
		<label>{{message}}</label>
	</div>
</div>

<div class="row">
	<div class="col-sm-12" ng-show="showListNews">
		<a ng-href="#/news/0"><input type="button" name="newNew" value="Afegir Noticia" alt="Afegir noticia" class="btn btn-default"></a>
	</div>
</div>

<form name="formListNews" class="row" ng-show="showListNews" ng-repeat="newList in newsList">
	<div class="col-sm-3">
		<div class="form-group col-sm-12">
			<img class="img-fluid" id="photo" ng-src="../img/newsmedia/{{newList.urlPreferred}}" width="150px"> 
		</div>
	</div>
	<div class="col-sm-9">
		<div class="row">
			<div class="col-sm-3">
			</div>
			<div class="col-sm-5">
				<span class="pull-right">Data Publicació {{newList.dateList}}</span>
			</div>
			<div class="col-sm-4">
				<div class="form-group col-sm-12">
					<a ng-href="#/news/{{newList.idNew}}"><input type="button" class="btn btn-success pull-left" value="Editar" alt="Edita dades de la noticia" class="btn btn-default"></a>&nbsp;&nbsp;&nbsp;
					<input type="button" class="btn btn-success" value="Esborrar" alt="Esborrar dades de la noticia" class="btn btn-default" ng-click="deleteNew(newList.idNew)">
				</div>
			</div>
		</div>
		<div class="row">
			<span class="col-sm-12 pull-left"><strong>{{newList.title}}</strong></span>
		</div>
		<div class="row">
			<span class="col-sm-12 pull-left">{{newList.titleSub}}</span>
		</div>
			
		
	</div>	
</form>



<form name="formNew" ng-show="divNew" >
	<div class="row" >
		<div class="form-group">
			<h1>Notícia</h1>
		</div>
		<div class="form-group">
			<label class="col-sm-1" for="title">Títol</label>
			<input type="text" class="col-sm-9 input-sm" name="title" ng-model="new.title">
			<input type="date" class="col-sm-2 input-sm" name="dateBox" id="dateForm" name="date" ng-model="new.date">
		</div>
		<div class="form-group">
			<label class="col-sm-1" for="titleSub">Subtítol</label>
			<textarea class="col-sm-11" name="titleSub" ng-model="new.titleSub"></textarea>
		</div>
		<div class="row form-group">
			<span class="col-sm-1"></span>
			<input type="button" class="btn btn-success pull-left col-sm-10" name="editNew" value="{{act}} Noticia" class="btn btn-default" ng-click="newEdit()">
		</div>
	</div>
	<div class="row form-group">

			<label class="col-sm-12"><h2> Imatge Destacada</h2></label>
			
			<input type="file" id="imgPref" accept="image/jgp, image/jgep, image/png" onchange="angular.element(this).scope().changePreferred(this)" ng-show="false"> 
			<img class="col-sm-4 pull-left img-fluid" id="photo" ng-src="../img/newsmedia/{{new.urlPreferred}}" >
			<label class="col-sm-2 btn btn-default" for="imgPref" ng-show="addImage">Canviar preferida</label>
		</div>

	
</form>



<form class="row" name="formImgs" ng-show="divImgs">
	<div class="for-group">
		<h2 class="col-sm-10"> Imatges de la noticia </h2> 
		<span class="col-sm-2">
			<label for="addImage"><i class="fa fa-plus" aria-hidden="true">Afegir</i></label>
			<input type="file" id="addImage" accept="image/jgp, image/jgep, image/png" onchange="angular.element(this).scope().addMedia(this,'I')" ng-show="false"> 
		</span>
		<div class="col-sm-4" ng-repeat="image in new.images | filter : {preferred:'N' , type:'I'}">
			<img class="col-sm-12 img-fluid" ng-src="../img/newsmedia/{{image.url}}">		
			<a href="" ng-click="imgDelete(image.idNewMedia, image.url)"><i class=" col-sm-6 fa fa-trash" aria-hidden="true" >Eliminar</i></a>
		</div>
	</div>
</form>

<form class="row" name="formVideos" ng-show="divVideos">
	<div class="for-group">
		<h2 class="col-sm-10"> Vídeos de la noticia </h2> <span class="col-sm-2"><a href="" ng-click="activeAddVideo()"><i class="fa fa-plus" aria-hidden="true">Afegir</i></a></span>
			<div class="col-sm-12" ng-show="divAddVideo">
				<label>Url Vídeo youtube</label>
				<input type="text" ng-model="urlVideoAdd" />
				<input type="button" ng-click="addMedia('','V')" value="Pujar">
			</div>

		<div class="col-sm-2" ng-repeat="image in new.images | filter : {type:'V'}">
			<iframe width="400" height="215"  frameborder="0" allowfullscreen ng-src="https://www.youtube.com/embed/image.url"></iframe>
			<a href="" ng-click="imgDelete(image.idNewMedia, '0')"><i class=" col-sm-6 fa fa-trash" aria-hidden="true" >Eliminar</i></a>
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

