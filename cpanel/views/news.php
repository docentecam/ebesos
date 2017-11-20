<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<!-- <div class="row">
	<div class="col-sm-12 col-lg-12 text-center" ng-show="divMessages">
		<label>{{message}}</label>
	</div>
</div> -->

<div class="row" ng-hide="divNew">
	<label class="col-lg-12 col-xs-12">
		Notícies
	</label>
</div>
<div class="row">
	<div class="col-lg-2 col-lg-offset-10 col-xs-4 col-xs-offset-8" ng-show="showListNews">
		<a ng-href="#/news/0"><input type="button" name="newNew" value="Afegir Noticia" alt="Afegir noticia" class="btn btn-default"></a>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-xs-12">
		<select name="assocSelect" id="assocSelect" ng-model="new.idUser" ng-change="changeAssociation()" class="select-users">
			<option ng-repeat="association in assoList" ng-value="association.idUser" ng-selected="association.idUser==new.idUser" >{{association.name}}</option> 
		</select>
	</div>
</div>
<div id="whiteDivNews" ng-hide="divNew">
	<div name="formListNews" class="row" ng-show="showListNews" ng-repeat="newList in newsList | filter:{idUser:filterAssoc}">
		<div class="col-lg-3 col-xs-12">
			<div class="form-group col-lg-12 imgNews">
				<img class="img-responsive" id="photo" ng-src="../img/newsmedia/{{newList.urlPreferred}}"> 
			</div>
		</div>
		<div class="col-lg-4 col-lg-offset-2 col-xs-8 col-sm-6">
			<div class="col-lg-12 col-xs-12 col-sm-12 dateNews">
				<span class="">Data Publicació {{newList.dateList}}</span>
			</div>
		</div>
		<div class="col-lg-3 col-xs-12">
			<div class="form-group col-lg-12 col-xs-8 col-xs-offset-4 buttonsNews">
				<a ng-href="#/news/{{newList.idNew}}" class="urlBlackEditNews"><button class="btn-edit col-lg-4 col-lg-push-2 col-xs-4 " value="Editar" alt="Edita dades de la noticia">Editar</a></button>
				<button class="btn-delete col-lg-5 col-lg-push-2 col-xs-4" value="Esborrar" alt="Esborrar dades de la noticia" ng-click="deleteNew(newList.idNew)">Eliminar</button>
			</div>
		</div>
		<div class="col-lg-9 col-xs-12 newsDiv">
			<div class="col-lg-12 col-xs-12">
				<label class="col-lg-12 col-lg-offset-0 col-xs-11 col-xs-offset-1 col-sm-8 titleNews">{{newList.title}}</label>
			</div>
			<div class="">
				<span class="col-lg-12 col-lg-offset-0 col-xs-11 col-xs-offset-1 col-sm-11 col-sm-offset-1">{{newList.titleSub | limitTo: 110}}...</span>
			</div>
		</div>
	</div>
</div>	
							
<div name="formNew" ng-show="divNew">
	<div class="row">
		<div class="form-group col-lg-12 divNewPadd">
			<label>
				Notícia
			</label>
		</div>
		<div class="form-group col-lg-12">
			<span class="col-lg-1 col-xs-2 noPaddNews" for="title">Títol</span>
			<input type="text" class="col-lg-9 col-xs-12" name="title" ng-model="new.title">
			<input type="date" class="col-lg-2 col-xs-6 col-sm-4 name="dateBox" id="dateForm" name="date" ng-model="new.date">
		</div>
		<div class="form-group col-lg-12">
			<span class="col-lg-1 col-xs-8 col-sm-10 subtitolNewsMargin noPaddNews" for="titleSub">Subtítol</span>
			<textarea cols=30 rows=12 class="col-lg-11 col-xs-12 txtAreaNew" name="titleSub" ng-model="new.titleSub"></textarea>
		</div>
		<div class="form-group">
			<button class="btn-edit col-lg-10 col-lg-push-1 col-xs-11 btnEditNew" name="editNew" value="{{act}} Noticia" ng-click="newEdit()">Editar Notícia</button>
		</div>
	</div>
	<div id="whiteDivNews" class="col-lg-11 col-lg-offset-1">
		<label class="col-lg-4 col-lg-offset-1 col-xs-4 col-xs-offset-0 imgPreferNew">Imatge Destacada</label>
		<input type="file" id="imgPref" accept="image/jgp, image/jgep, image/png" onchange="angular.element(this).scope().changePreferred(this)" ng-show="false"> 
		<label class="col-lg-3 col-lg-pull-2 col-xs-pull-1 btn btn-default imgPrefChange" for="imgPref" ng-show="addImage">Canviar imatge destacada</label>
		<img class="col-lg-6 col-lg-offset-3 img-responsive" id="photoNew" ng-src="../img/newsmedia/{{new.urlPreferred}}" >
	</div>	
</div>
<div id="whiteDivImgNew" class="col-lg-11 col-lg-offset-1" name="formImgs" ng-show="divImgs">
	<div class="for-group">
		<label class="col-lg-1 col-lg-offset-1 imgNewlabel">Imatges</label> 
			<label for="addImage" class="btn btn-default col-lg-2 col-lg-offset-1 btnAddImgNew">Afegir imatges</label>
			<input type="file" id="addImage" accept="image/jgp, image/jgep, image/png" onchange="angular.element(this).scope().addMedia(this,'I')" ng-show="false">
			<div class="col-lg-12">
				<div class="col-lg-4 imgNewChange" ng-repeat="image in new.images | filter : {preferred:'N' , type:'I'}">
			<img class="img-responsive imgNewsPadd" ng-src="../img/newsmedia/{{image.url}}">		
			<a href="" ng-click="imgDelete(image.idNewMedia, image.url)" class="btn btn-default">Eliminar</a>
		</div>
			</div>
		
	</div>
</div>
<div class="col-lg-11 col-lg-offset-1" name="formVideos" ng-show="divVideos" id="whiteDivVidNew">
	<div class="for-group">
		<label class="col-lg-1 col-lg-offset-1 vidLabel">Vídeos</label>
		<a href="" ng-click="activeAddVideo()" class="btn btn-default col-lg-2 col-lg-offset-1 addVidNew">Afegir vídeos</a>
			<div class="col-lg-12" ng-show="divAddVideo">
				<label>Url Vídeo youtube</label>
				<input type="text" ng-model="urlVideoAdd">
				<input type="button" ng-click="addMedia('','V')" value="Pujar">
			</div>
		<div class="col-lg-12">
			<div class="col-lg-4 vidChangeNews" ng-repeat="image in new.images | filter : {type:'V'}">
				<iframe  frameborder="0" allowfullscreen ng-src="https://www.youtube.com/embed/image.url" class="col-lg-12 col-xs-12"></iframe>
				<a href="" ng-click="imgDelete(image.idNewMedia, '0')" class="btn btn-default btnDeleteVid">Eliminar</a>
			</div>
		</div>
		
	</div>
</div>


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

