<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>

<div ng-show="messageConfirm">
	<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
		<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
		<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
		<b>{{message}}</b>
	</div>
</div>

<div class="row" ng-show="loadPromotions">
	<label class="col-lg-1 col-xs-3">
		Promocions
	</label>
	<div class="col-lg-2 col-xs-3 btnAddPromo">
		<a ng-href="#/promotion/0"><button id="btnAdd" class="btn btn-default">Afegir<i class="fa fa-plus-circle"></i></button></a>
	</div>	
</div>
<div ng-show="loadPromotions" class="row">
	<div id="whiteDivNews" class="col-lg-12">
		<div class="row divContainerPromos" ng-repeat="promotionList in promotionsList | filter:{active: 'N'}">
			<div class="col-lg-4">
				<div class="col-lg-12">
					<img class="img-responsive imgPromos" ng-src="../img/promotions/{{promotionList.image}}">	
				</div>
			</div>		
			<div class="col-lg-2 divPromosCond">
				<label>
					Condicions:
				</label>
				<span>
					{{promotionList.conditionsVals}}
					{{promotionList.conditionsEix}}
				</span>
			<label>

				</label> &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-success"  value="Activar"  ng-click="activePromotion(promotionList.idPromotion,'Y')" >
			</div>
			<div class="col-lg-4">
				<div class="col-lg-12 col-lg-push-2 divDatePromos">
					Caducitat Vals {{promotionList.dateExpireValsE}}
				<br>
					Caducitat Eix {{promotionList.dateExpireEixE}} 
				</div>
			</div>
			<div class="col-lg-2">
				<div class="col-lg-12 col-lg-push-5 buttonsPromos">
					<a ng-href="#/promotion/{{promotionList.idPromotion}}"><button id="" class="btn-edit col-lg-5">Editar</button></a>
					<button id="" class="btn-delete col-lg-6" ng-click="deletePromotion(promotionList.idPromotion)">Eliminar</button>
				</div>
			</div>
		</div>
	</div>





	<div id="whiteDivNews" class="col-lg-12">
		<div class="row divContainerPromos" ng-repeat="promotionList in promotionsList | filter:{active: 'Y'}">
			<div class="col-lg-4">
				<div class="col-lg-12">
					<img class="img-responsive imgPromos" ng-src="../img/promotions/{{promotionList.image}}">	
				</div>
			</div>		
			<div class="col-lg-2 divPromosCond">
				<label>
					Condicions:
				</label>
				<span>
					{{promotionList.conditionsVals}}
					{{promotionList.conditionsEix}}
				</span>
			<label>

				</label> &nbsp;&nbsp;&nbsp;<input type="button" class="btn btn-warning"  value="Desactivar"  ng-click="activePromotion(promotionList.idPromotion,'N')" >
			</div>
			<div class="col-lg-4">
				<div class="col-lg-12 col-lg-push-2 divDatePromos">
					Caducitat Vals {{promotionList.dateExpireValsE}}
				<br>
					Caducitat Eix {{promotionList.dateExpireEixE}} 
				</div>
			</div>
			<div class="col-lg-2">
				<div class="col-lg-12 col-lg-push-5 buttonsPromos">
					<a ng-href="#/promotion/{{promotionList.idPromotion}}"><button id="" class="btn-edit col-lg-5">Editar</button></a>
					<button id="" class="btn-delete col-lg-6" ng-click="deletePromotion(promotionList.idPromotion)">Eliminar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" ng-hide="loadPromotions">	
	<form action="#" id="validationPromotion" name="validation" >	
		<div class="col-lg-12">
			<label class="labelFontSizePromo">{{act}} promoció</label>
		</div>
		<div class="col-lg-12">
			<label class="marginTopLabel">Seleccionar comerç:&nbsp;&nbsp;&nbsp; </label>
			<select id="listShops" name="listShops" ng-model="promotion.shopSelected" class="select-users"> <option value="-1" ng-selected="promotion.shopSelected==-1"> --Escull Comerç</option>
				<option ng-repeat="shop in shopsList" ng-selected="promotion.shopSelected==shop.idShop" ng-value="shop.idShop">{{shop.name}}</option> </select>
		</div>
		<div class="col-lg-12">
			<label class="labelImgMarginTop">
				Imatge: 
			</label>
		</div>
		<div class="col-lg-12">
			<img class="img-responsive col-lg-8 imgPromo" ng-src="../img/promotions/{{promotion.image}}">
				<label for="updateImg" class="labelFor col-lg-4">Examinar</label>
				<input type="file" id="updateImg" onchange="angular.element(this).scope().changeImg(this)" ng-hide="true">
		</div>
<div class="row">
	<div class="col-lg-12">
		<fieldset class="col-lg-12">
			<label class="labelFontSizePromo marginTopLabel"> 
				Vals 
			</label>
			<div class="col-lg-12">
				<span class="col-lg-2 noPadding">
					Oferta:
				</span>
				<div class="col-lg-10">
					<textarea name="" id="" cols="50" rows="3" ng-model="promotion.oferVals" class="txtAreaNoBorder">promotion.oferVals</textarea>
				</div>
			</div>
			<div class="col-lg-12">
				<span class="col-lg-2 noPadding">
					Data d'expiració vals:
				</span>
				<div class="col-lg-10">
					<input type="date" ng-model="promotion.dateExpireVals" class="inputDateWidth txtAreaNoBorder">
				</div>
			</div>
			<div class="col-lg-12">
				<span class="col-lg-2 noPadding">
					Condicions del val:
				</span>
				<div class="col-lg-10">
					<textarea name="" id="" cols="50" rows="3" ng-model="promotion.conditionsVals" class="txtAreaNoBorder txtAreaMarginTop">promotion.conditionsVals</textarea>
				</div>
			</div>
		</fieldset>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<fieldset class="col-lg-12">
			<label class="labelFontSizePromo marginTopLabel"> 
				Eix 
			</label>
			<div class="col-lg-12">
				<span class="col-lg-2 noPadding">
					Oferta:
				</span>
				<div class="col-lg-10">
					<textarea name="" id="" cols="50" rows="3" ng-model="promotion.oferEix" class="txtAreaNoBorder">promotion.oferEix</textarea>
				</div>
			</div>
			<div class="col-lg-12">
				<span class="col-lg-2 noPadding">
					Data d'expiració vals:
				</span>
				<div class="col-lg-10">
					<input type="date" ng-model="promotion.dateExpireEix" class="">
				</div>
			</div>
			<div class="col-lg-12">
				<span class="col-lg-2 noPadding">
					Condicions del val:
				</span>
				<div class="col-lg-10">
					<textarea name="" id="" cols="50" rows="3" ng-model="promotion.conditionsEix" class="txtAreaNoBorder txtAreaMarginTop">promotion.conditionsEix</textarea>
					<div class="col-lg-12">
						<div class="col-lg-2 col-lg-pull-1">
							<input type="button" class="btn btn-default btnEditPromo"  value="{{act}}" ng-click="editPromotion(act)">
						</div>
					</div>
				</div>
			</div>
		</fieldset>
	</div>
</div>
	</form>
</div>


