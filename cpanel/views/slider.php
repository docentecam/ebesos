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
		<div class="col-lg-12">
			<span id=editarSliderSpan class="col-lg-2">Editar Imatges: </span>
			<div id="divOpcioAfegir" class="col-lg-3">
				<button id="btnAfegir" class="btn btn-default col-lg-5">Afegir <i class="fa fa-plus-circle"></i></button>
			</div>
			<div id="whiteSliderDiv" class="col-lg-12">
				<div id="divSliderSetting" class="col-lg-10" ng-repeat="sliderImg in slider">
					<img id="imgSliderSetting" class="col-lg-6" src="img/imagen2.jpg" alt=""><!-- TODO alt + dinamizar la imagen con angular -->
					<div class="col-lg-6 col-lg-push-1" ">
						<span id="spanDescripcioSlider" class="col-lg-12">Descripció:</span>
						<div>
							<p class="col-lg-12" >io, voluptates, enim doloremque. Commodi aliquid aliquam labore voluptatibus voluptates sit, necessitatibus alias!</p>
						</div>
						<div>
							<button id="btnEditarSlider" class="col-lg-5 btn btn-default"">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>
							<button id="btnDeleteSlider" class="col-lg-5 col-lg-push-1 btn btn-default">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>



