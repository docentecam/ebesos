<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="col-lg-12 col-xs-12" id="sliderCpanel">
  	<label class="col-lg-12 col-xs-12 sliderTitle">Slider</label>  
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
	<div ng-show="fail">
		<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
			<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
			<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
			<b>{{statusValidation}}</b>
		</div>
	</div>
	<div class="col-lg-12 col-xs-12">
		<span id="editarSliderSpan" ng-show="listSliders" class="col-lg-2 col-xs-3">Editar Imatges: </span>
		<div id="divOpcioAfegir" class="col-lg-3 col-xs-6 col-xs-offset-1">
				<a ng-href="#/slider/0"><button id="btnAfegir" class="btn btn-default" ng-hide="btnAfegir" >Afegir <i class="fa fa-plus-circle"></i></button></a>
		</div>
		<div id="whiteSliderDiv" class="col-lg-12 col-xs-12">
			<div id="divSliderSetting" ng-show="listSliders" class="col-lg-6 col-xs-12" ng-repeat="sliderImg in slider">
				<form>
					<div class="row">
						<img id="imgSliderSetting" class="col-lg-12 col-xs-12" src="../img/slider/{{sliderImg.image}}" alt="">
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
							<a ng-href="#/slider/{{sliderImg.idSlider}}"><button id="btnEditarSlider" class="btn btn-default" >Editar <i class="fa fa-pencil" aria-hidden="true"></i></button></a>
							<button id="btnDeleteSlider" class="col-xs-offset-1 btn btn-default" ng-click="deleteImgSlide(sliderImg.idSlider,sliderImg.image)">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
						</div>
					</div>
				</form>
			</div>
			<div ng-hide="listSliders">
				<form id="editingForm">
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Descripció: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="description" cols="30" rows="6" ng-model="slider.description"></textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Títol: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="title" cols="30" rows="6" ng-model="slider.title"></textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Subtítol: </label>
						<textarea class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="subTitle" cols="30" rows="6" ng-model="slider.subtitle"></textarea>
					</div>
					<div class="row">
						<label class="col-lg-2 col-lg-offset-2 col-xs-2 col-xs-offset-1">Enllaç: </label>
						<input type="text" class=" col-lg-5 col-xs-6 col-xs-offset-1 editAndAddSlider" name="" id="linkSliderr" size="40"  ng-model="slider.linkSlider">
					</div>
					<div class="row">
						<label class="col-lg-offset-2 col-xs-3 col-xs-offset-1">Imatge: </label>
						<input type="file" class="col-xs-5 editAndAddSlider noPadding" onchange="angular.element(this).scope().uploadedImgFileE(this)">
					</div>
					<div class="row">
						<input class="col-lg-offset-5 col-xs-offset-5 editAndAddSlider" type="button" value="Guardar" ng-click="updateImgSlider()">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

