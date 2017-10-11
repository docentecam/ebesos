<<?php 
	// session_start()
	// isset(var)

 ?>
<div class="col-lg-l2" id="sliderCpanel">
  	<h2 class="col-lg-12">Slider</h2>  
  	<div class="row">
  		<div id="myCarousel" class="carousel slide col-lg-12" data-ride="carousel">
			<div class="col-lg-12" id="myCarousel" class="carousel slide" data-ride="carousel" ng-controller="SliderCtrl">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" ng-repeat="sliderImg in slider"  data-slide-to="{{$index}}" ng-class="{active : $index == 0}"></li>
				</ol>
				<div class="carousel-inner">
					<div class="item" ng-repeat="sliderImg in slider" ng-class="{active : $index == 0}">
						<a href="{{sliderImg.link}}" target="_blank">
							<img src="img/slider/{{sliderImg.image}}" alt="{{sliderImg.description}}">
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-12">
		<span id=editarSliderSpan ng-hide="spanEditarImatges" class="col-lg-2">Editar Imatges: </span>
		<div id="divOpcioAfegir" class="col-lg-3">
			<button id="btnAfegir" class="btn btn-default col-lg-5" ng-hide="btnAfegir" ng-click="addImgSlide()">Afegir <i class="fa fa-plus-circle"></i></button>
		</div>
		<div id="whiteSliderDiv" class="col-lg-12">

				<!-- Estado Inicial -->

			<div id="divSliderSetting" ng-hide="sliderSetting" class="col-lg-6" ng-repeat="sliderImg in slider">
				<div class="row">
					<img id="imgSliderSetting" class="col-lg-12" src="img/imagen2.jpg" alt=""><!-- TODO alt + dinamizar la imagen con angular -->
				</div>
				<div class="row">
					<div class="col-lg-12" id="sliderText">
						<div class="row">
							<span id="spanDescripcioSlider">Descripció:</span>
						</div>
						<div class="row">
							<p>io, voluptates, enim doloremque. Commodi aliquid aliquam labore voluptatibus voluptates sit, necessitatibus alias!</p>
						</div>
						<div class="row">
							<span id="spanDescripcioSlider">Títol:</span>
						</div>
						<div class="row">
							<p>io, voluptates, enim doloremque. Commodi aliquid aliquam labore voluptatibus voluptates sit, necessitatibus alias!</p>
						</div>
						<div class="row">
							<span id="spanDescripcioSlider">Subtítol:</span>
						</div>
						<div class="row">
							<p>io, voluptates, enim doloremque. Commodi aliquid aliquam labore voluptatibus voluptates sit, necessitatibus alias!</p>
						</div>
					</div>
					<div class="col-lg-12">
						<button id="btnEditarSlider" class="col-lg-5 btn btn-default" ng-click="editImgSlide()">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>
						<button id="btnDeleteSlider" class="col-lg-5 col-lg-offset-1 btn btn-default">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
					</div>
				</div>
			</div>
			
				<!-- Al pulsar añadir -->

			<div ng-show="sliderAdding">
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Descripció: </label>
					<textarea class=" col-lg-4" name="" id="" cols="30" rows="6" placeholder="Escriu aquí la descripció de la imatge a mostrar dins del Slider..." style="margin-bottom: 3.5%"></textarea>
				</div>
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Títol: </label>
					<textarea class=" col-lg-4" name="" id="" cols="30" rows="6" placeholder="Escriu aquí el títol de la imatge a mostrar dins del Slider..." style="margin-bottom: 3.5%"></textarea>
				</div>
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Subtítol: </label>
					<textarea class=" col-lg-4" name="" id="" cols="30" rows="6" placeholder="Escriu aquí el subtítol de la imatge a mostrar dins del Slider..." style="margin-bottom: 3.5%"></textarea>
				</div>
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Imatge:</label>
					<input type="file" style="margin-bottom: 3.5%">
				</div>
				<div class="row">
					<input class="col-lg-offset-5" type="button" value="Actualitzar" ng-click=backSettingSlide() style="margin-bottom: 3.5%">
				</div>
			</div>

				<!-- Al pulsar editar -->

			<div ng-show="sliderEditing">
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Descripció: </label>
					<textarea class=" col-lg-4" name="" id="" cols="30" rows="6" style="margin-bottom: 3.5%"></textarea>
				</div>
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Títol: </label>
					<textarea class=" col-lg-4" name="" id="" cols="30" rows="6" style="margin-bottom: 3.5%"></textarea>
				</div>
				<div class="row">
					<label class="col-lg-2 col-lg-offset-3">Subtítol: </label>
					<textarea class=" col-lg-4" name="" id="" cols="30" rows="6" style="margin-bottom: 3.5%"></textarea>
				</div>
				<div class="row">
					<input class="col-lg-offset-5" type="button" value="Actualitzar" ng-click=backSettingSlide() style="margin-bottom: 3.5%">
				</div>
			</div>
		</div>
	</div>
</div>

<!-- sliderSetting
sliderAdding -->


