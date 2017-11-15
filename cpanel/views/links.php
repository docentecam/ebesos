<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<div class="col-lg-3 noPadding linkTitle"><b>Enllaços peu de pàgina</b></div>	
</div>
<div ng-show="fail">
	<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
		<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
		<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
		<b>{{statusValidation}}</b>
	</div>
</div>
<div ng-show="tableLinks">
	<div class="row">
		<table class="borderTableLinks tableLinks col-lg-12">
			<thead>
			<tr>
				<th class="centerPadding thCenterLinks col-lg-4">Nom</th>
				<th class="centerPadding thCenterLinks col-lg-4">Url</th>
				<th class="centerPadding thCenterLinks col-lg-2">Editar</th>
				<th class="centerPadding thCenterLinks col-lg-2">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="link in linksList">
				<td class="tdCenterLinks borderTableLinks">{{link.description}}</td>
				<td class="tdCenterLinks borderTableLinks">{{link.url | limitTo: 20}}</td>
				<td class="centerPadding borderTableLinks"><a ng-click="editLink(link.idLink,link.description,link.url)" class="iconLinkCenter" href=""><i class="fa fa-2x fa-pencil editDeleteIconLinks" aria-hidden="true"></i></a></td>
				<td class="centerPadding borderTableLinks"><a ng-click="deleteLink(link.idLink)" class="iconLinkCenter" href=""><i class="fa fa-2x fa-times editDeleteIconLinks" aria-hidden="true"></i></a></td>	
			</tr>
		</tbody>
		</table>
	</div>
</div>
<div class="row">
	<div class="col-lg-1 noPadding" ng-show="tableLinks">
		<button id="btnAfegir" class="btn btn-default btnAfegirLinks " ng-hide="btnAfegir" ng-click="createLink()">Afegir <i class="fa fa-plus-circle"></i></button>
	</div>
</div>

<div ng-show="formLinks">
	<form id="linksForm" ng-submit="updateLink()">
		<div class="row">
			<input type="text" id="userId" ng-value="idLinkC"  disabled hidden>
			<label class="col-lg-1 noPadding marginFormulariLinks">Nom: </label>
			<div class="col-lg-9">
				<input type="text" class="col-lg-4" name="name" ng-model="nameC"></div>
			</div>
		<div class="row">
			<label class="col-lg-1 noPadding marginFormulariLinks">Url: </label>
			<div class="col-lg-9">
				<input class="col-lg-4" type="text" name="url" ng-model="urlC">
			</div>
		</div>
		<div class="col-lg-2 btnConfirmarPositionLinks">
			<input class="btn btn-default col-lg-10 btnConfirmarLinks" type="submit" value="Confirmar">
		</div>
	</form>		
</div>