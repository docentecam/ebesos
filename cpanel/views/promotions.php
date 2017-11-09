<H1>HOLA?</H1>
<div class="row">

	<button id="btnAdd" class="btn btn-default" ng-click="editPromotions('Afegir')">Afegir <i class="fa fa-plus-circle"></i></button>

	<div class="row" ng-repeat="promotion in promotionsList | filter:{active: 'N'}">		
		<div class="col-lg-3">
			<img class="img-responsive" ng-src="../img/promotions/{{promotion.image}}">	
		</div>
		
		<div>
			{{promotion.creation}}
		</div>
		<div class="col-lg-5">
			{{promotion.conditionsVals}}
		</div>
		<div class="col-lg-2">
			{{promotion.dateExpireVals}}
			<br>
			{{promotion.dateExpireEix}}
		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default" ng-click="editParameter('Editar')">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>

		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
		</div>
	</div>
<hr>
	<div class="row" ng-repeat="promotion in promotionsList | filter:{active: 'Y'}">		
		<div class="col-lg-3">
			<img class="img-responsive" ng-src="../img/promotions/{{promotion.image}}">	
		</div>
		
		<div>
			{{promotion.creation}}
		</div>
		<div class="col-lg-5">
			{{promotion.conditionsVals}}
		</div>
		<div class="col-lg-2">
			{{promotion.dateExpireVals}}
			<br>
			{{promotion.dateExpireEix}}
		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default" ng-click="()">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>

		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
		</div>
	</div>
</div>


<div class="row" ng-show="showPromotions">
	<form action="#" id="validationPromotion" name="validation" method="POST" >
		<h1>{{act}} Promotions</h1>
	<div class="row">
		<div class="col-lg-6">
			<div>
				<label>Titol </label>
				<input type="text" ng-model="" id="">
			</div>
			<div>
				<label>Actualitzada data de pujada </label>
				<input type="date" ng-model="" id="">
			</div>
			<div>
				<label>Seleccionar comerç </label>
				<select></select>
			</div>
			<div>
				<label>Condicions del Val </label>
				<textarea></textarea>
			</div>
		</div>

