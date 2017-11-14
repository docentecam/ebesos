<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div ng-show="loadPromotions"  class="row">

	<button id="btnAdd" class="btn btn-default" ng-click="editPromotions('Afegir')">Afegir <i class="fa fa-plus-circle"></i></button>

	<div class="row" ng-repeat="promotionList in promotionsList | filter:{active: 'N'}">		
		<div class="col-lg-3">
			<img class="img-responsive" ng-src="../img/promotions/{{promotionList.image}}">	
		</div>
		
		<div class="col-lg-5">
			{{promotionList.conditionsVals}}<br>
			<label>Pendent De Aprovació</label> &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-success" value="Activar"  class="btn btn-default">
		</div>
		<div class="col-lg-2">
			Data Caducitat Vals {{promotionList.dateExpireVals}}
			<br>
			Data Caducitat Eix{{promotionList.dateExpireEix}} 
		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default" ng-click="editPromotions('Editar' , promotionList.idPromotion)">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>

		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
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
			<button id="" class="btn btn-default" ng-click="dataPromotion('Editar', promotionList.idPromotion)">Editar <i class="fa fa-pencil" aria-hidden="true"></i></button>

		</div>
		<div class="col-lg-1">
			<button id="" class="btn btn-default">Eliminar <i class="fa fa-eraser" aria-hidden="true"></i></button>
		</div>
	</div>
</div>


<div class="row" ng-show="showPromotions">
	<form action="#" id="validationPromotion" name="validation" method="POST" >
		<h1>{{act}} Promocions</h1>
		<label>Seleccionar comerç </label> <select name="listShops" ng-model="promotion.shopSelected" > <option ng-repeat="shop in shopsList" ng-selected="promotion.shopSelected==shop.idShop">{{shop.name}}</option> </select>
		<br><br>
		<label>Imatge: </label>  <input type="file" name="">

	<div class="row">
		<div class="col-lg-6">
			<fieldset>
			 <legend> VALS </legend>
				<div>
					<label>OFERTA </label>
					<textarea>{{promotion.oferVals}}</textarea>
				</div>
				<div>
					<label>Data Expire Vals </label>
					<input type="date" ng-model="promotion.dateExpireVals" id="">
				</div>
				
				<div>
					<label>Condicions del Val </label>
					<textarea>{{promotion.conditionsVals}}</textarea>
				</div>
			</fieldset>
		</div>

	</div>

	<div class="row">
		<div class="col-lg-6">
			<h1>Eix</h1>
			
			<div>
				<label>OFERTA </label>
			<textarea>{{promotion.oferEix}}</textarea>
			</div>

			<div>
				<label>Data Expire Eix </label>
				<input type="date" ng-model="promotion.dateExpireEix" id="">
			</div>

			<div>
				<label>Condicions del Val </label>
				<textarea>{{promotion.conditionsEix}}</textarea>
			</div>
		</div>
	</div>
	<div>
		<input type="submit" class="btn btn-default" value="Guardar dades" ng-click="editPromotion()">
	</div>
	
	</form>
</div>


