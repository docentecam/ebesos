<?php 
	// session_start()
	// isset(var)

 ?>
<div class="col-lg-12 col-xs-12" id="sliderCpanel">
  	<h2 class="col-lg-12 col-xs-12">Slider</h2>  
  	<div class="row">
  		<div id="myCarousel" class="carousel slide col-lg-12 col-xs-12" data-ride="carousel">
			<div class="col-lg-12 col-xs-12" id="myCarousel" class="carousel slide" data-ride="carousel" ng-controller="SliderCtrl">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" ng-repeat="sliderImg in slider"  data-slide-to="{{$index}}" ng-class="{active : $index == 0}"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item" ng-repeat="sliderImg in slider" ng-class="{active : $index == 0}">
						<a href="{{sliderImg.link}}" target="_blank">
							<img  src="../img/slider/{{sliderImg.image}}" alt="{{sliderImg.description}}">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12 col-xs-12">
		<span id=editarSliderSpan ng-hide="spanEditarImatges" class="col-lg-2 col-xs-3">Editar Imatges: </span>
		<div id="divOpcioAfegir" class="col-lg-3 col-xs-6 col-xs-offset-1">
			<button id="btnAfegir" class="btn btn-default" ng-hide="btnAfegir" ng-click="addImgSlide()">Afegir <i class="fa fa-plus-circle"></i></button>
		</div>
		<div id="whiteSliderDiv" class="col-lg-12 col-xs-12">

				<!-- Estado Inicial -->

			<div id="divSliderSetting" ng-hide="sliderSetting" class="col-lg-6 col-xs-12" ng-repeat="sliderImg in slider">
				<form>
					<div class="row">
						<img id="imgSliderSetting" class="col-lg-12 col-xs-12" src="../img/slider/{{sliderImg.image}}" alt=""><!-- TODO alt + dinamizar la imagen con angular -->
					</div>
					<div class="row">
						<div class="col-lg-12 col-xs-12" id="sliderText">
							<div class="row">
								<span>Descripció:</span>
							</div>
							<div class="row">
								<p>{{sliderImg.description}}</p>
							</div>
							<div class="row">
								<span>Títol:</span>
							</div>
							<div class="row">
								<p>{{sliderImg.title}}</p>
							</div>
							<div class="row">
								<span>Subtítol:</span>
							</div>
							<div class="row">
								<p>{{sliderImg.subtitle}}</p>
							</div>
						</div>
						<div class="col-lg-12 col-xs-12">
							<input type="hidden" ng-value="sliderImg.idSlider">
							<button id="btnEditarSlider" class="btn btn-default" ng-click="editImgSlide(sliderImg.idSlider, sliderImg.description, sliderImg.title, sliderImg.subtitle)">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>
							<button id="btnDeleteSlider" class="col-xs-offset-1 btn btn-default" ng-click="deleteImgSlide(sliderImg.idSlider)">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
						</div>
					</div>
				</form>
			</div>
			
				<!-- Al pulsar añadir -->

			<div ng-show="sliderAdding">
				<form id="addingForm">
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Descripció: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" maxlength="" name="" id="descriptionC" cols="30" rows="6" placeholder="Escriu aquí la descripció de la imatge a mostrar dins del Slider..."></textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Títol: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="titleC" cols="30" rows="6" placeholder="Escriu aquí el títol de la imatge a mostrar dins del Slider..."></textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Subtítol: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="subTitleC" cols="30" rows="6" placeholder="Escriu aquí el subtítol de la imatge a mostrar dins del Slider..."></textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Enllaç: </label>
						<input type="text" class="col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="linkC" size="40" placeholder="Escriu aquí l'enllaç de la imatge a relacionar" >
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Imatge: </label>
						<input type="file" class="editAndAddSlider">
					</div>
					<div class="row">
						<input class="col-lg-offset-5 col-xs-offset-5 editAndAddSlider" type="button" value="Actualitzar" ng-click=createImgSlide()>
					</div>
				</form>
			</div>

				<!-- Al pulsar editar -->

			<div ng-show="sliderEditing" ng-repeat="infoSlider in onlyInfoSlider">
				<form id="editingForm">
					<input type="hidden" id="hidEditSlider" ng-value="infoSlider.idSlider">
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Descripció: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="description" cols="30" rows="6">{{infoSlider.description}}</textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Títol: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="title" cols="30" rows="6">{{infoSlider.title}}</textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Subtítol: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="subTitle" cols="30" rows="6">{{infoSlider.subTitle}}</textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Enllaç: </label>
						<input type="text" class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="linkSlider" size="40"  ng-value="infoSlider.link">
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Imatge: </label>
						<input type="file" class="editAndAddSlider">
					</div>
					<div class="row">
						<input class="col-lg-offset-5 col-xs-offset-5 editAndAddSlider" type="button" value="Actualitzar" ng-click=updateImgSlide()>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>



