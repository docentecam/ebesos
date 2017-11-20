<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>

<div class="row">
	<label class="col-lg-1 col-xs-12">
		Promocions
	</label>
	<div class="col-lg-2 btnAddPromo">
		<a ng-href="#/promotion/0"><button id="btnAdd" class="btn btn-default">Afegir<i class="fa fa-plus-circle"></i></button></a>
	</div>	
</div>
<div ng-show="loadPromotions" class="row">
	<div id="whiteDivNews">
		<div class="row" ng-repeat="promotionList in promotionsList | filter:{active: 'N'}">		
			<div class="col-lg-4">
				<img class="img-responsive col-lg-10 imgPromos" ng-src="../img/promotions/{{promotionList.image}}">	
			</div>
			
			<div class="col-lg-5">
				{{promotionList.conditionsVals}}<br>
				<label>Pendent De Aprovació</label> &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-success" value="Activar"  class="btn btn-default" ng-click="activePromotion(promotionList.idPromotion)" >
			</div>
			<div class="col-lg-2">
				Data Caducitat Vals {{promotionList.dateExpireVals}}
				<br>
				Data Caducitat Eix{{promotionList.dateExpireEix}} 
			</div>
			<div class="col-lg-1">
				<a ng-href="#/promotion/{{promotionList.idPromotion}}"><button id="" class="btn btn-default">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button></a>

			</div>
			<div class="col-lg-1">
				<button id="" class="btn btn-default" ng-click="deletePromotion(promotionList.idPromotion)">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
			</div>
		</div>
	</div>
<hr>
	<div class="row" ng-repeat="promotionList in promotionsList | filter:{active: 'Y'}">		
		<div class="col-lg-3">
			<img class="img-responsive" ng-src="../img/promotions/{{promotionList.image}}">	
		</div>
		
		<div>
			{{promotionList.creation}}
		</div>
		<div class="col-lg-5">
			{{promotionList.conditionsVals}}
			{{promotionList.conditionsEix}}
		</div>
		<div class="col-lg-2">
			Data Caducitat Vals{{promotionList.dateExpireVals}}
			<br>
			 Data Caducitat Eix{{promotionList.dateExpireEix}}
		</div>
		<div class="col-lg-1">
			<a ng-href="#/promotion/{{promotionList.idPromotion}}"><button id="" class="btn btn-default">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button></a>
		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default" ng-click="deletePromotion(promotionList.idPromotion)">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
		</div>
	</div>
</div>


<div class="row" ng-hide="loadPromotions">
	<form action="#" id="validationPromotion" name="validation" method="POST" >
		<h1>{{act}} Promocions</h1>
		<label>Seleccionar comerç </label> <select id="listShops" name="listShops" ng-model="promotion.shopSelected" > <option value="-1"> --Escull Comerç</option><option ng-repeat="shop in shopsList" ng-selected="promotion.shopSelected==shop.idShop" ng-value="shop.idShop">{{shop.name}}</option> </select>
		<br><br>
		<label>Imatge: </label>
		<img class="img-responsive" ng-src="../img/promotions/{{promotion.image}}">
		<label for="updateImg" class="labelFor"> examinar</label>
		<input type="file" id="updateImg" onchange="angular.element(this).scope().changeImg(this)" ng-hide="true">

	<div class="row">
		<div class="col-lg-6">
			<fieldset>
			 <legend> VALS </legend>
				<div>
					<label>OFERTA </label>
					<input type="text" ng-model="promotion.oferVals">
				</div>
				<div>
					<label>Data Expire Vals </label>
					<input type="date" ng-model="promotion.dateExpireVals">
				</div>
				
				<div>
					<label>Condicions del Val </label>
					<input type="text"  ng-model="promotion.conditionsVals">
				</div>
				
			</fieldset>
		</div>

	</div>

	<div class="row">
		<div class="col-lg-6">
			<h1>Eix</h1>
			
			<div>
				<label>OFERTA </label>
				<input type="text" ng-model="promotion.oferEix">
			</div>

			<div>
				<label>Data Expire Eix </label>
				<input type="date" ng-model="promotion.dateExpireEix" id="">
			</div>

			<div>
				<label>Condicions del Val </label>
				<input type="text" ng-model="promotion.conditionsEix">
			</div>
		</div>
	</div>
	<div>
		<input type="button" class="btn btn-default"  value="{{act}}" ng-click="editPromotion(act)">
	</div>
	
	</form>
</div>


