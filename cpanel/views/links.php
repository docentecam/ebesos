<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<div class="col-xs-6 noPadding linkTitle"><b>Enllaços peu de pàgina</b></div>	
</div>
<div ng-show="fail">
	<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
		<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
		<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
		<b>{{statusValidation}}</b>
	</div>
</div>
<div class="row">
	<div class="col-xs-1 noPadding" ng-show="tableLinks">
		<a ng-href="#/links/a/-1"><button id="btnAfegir" class="btn btn-default btnAfegirLinks " ng-hide="btnAfegir" ng-click="createLink()">Afegir <i class="fa fa-plus-circle"></i></button></a>
	</div>
</div>
<div ng-show="tableLinks">
	<div class="row">
		<table class="tableLinks col-xs-4 col-sm-7 col-md-9 col-lg-11">
			<thead>
			<tr>
				<th class="centerPadding thCenterLinks col-xs-4">Nom</th>
				<th class="centerPadding thCenterLinks col-xs-4">Url</th>
				<th class="centerPadding thCenterLinks col-xs-2">Editar</th>
				<th class="centerPadding thCenterLinks col-xs-2">Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="link in linksList">
				<td class="tdCenterLinks borderTableLinks">{{link.description}}</td>
				<td class="tdCenterLinks borderTableLinks">{{link.url | limitTo: 20}}</td>
				<td class="centerPadding borderTableLinks"><a ng-href="#/links/e/{{link.idLink}}" class="iconLinkCenter" href=""><i class="fa fa-2x fa-pencil editDeleteIconLinks" aria-hidden="true"></i></a></td>
				<td class="centerPadding borderTableLinks"><a ng-click="deleteLink(link.idLink)" class="iconLinkCenter" href=""><i class="fa fa-2x fa-times editDeleteIconLinks" aria-hidden="true"></i></a></td>	
			</tr>
		</tbody>
		</table>
	</div>
</div>


<div ng-hide="tableLinks">
	<form id="linksForm" ng-submit="updateLink()">
		<div class="row">
			<input type="text" id="userId" ng-value="idLinkC"  disabled hidden>
			<label class="col-xs-1 noPadding marginFormulariLinks">Nom: </label>
			<div class="col-xs-9">
				<input type="text" class="col-xs-8 col-sm-6 col-md-4" name="name" ng-model="nameC"></div>
			</div>
		<div class="row">
			<label class="col-xs-1 noPadding marginFormulariLinks">Url: </label>
			<div class="col-xs-9">
				<input class="col-xs-8 col-sm-6 col-md-4" type="text" name="url" ng-model="urlC">
			</div>
		</div>
		<div class="col-xs-6 col-sm-5 col-md-5 btnConfirmarPositionLinks">
			<input class="btn btn-default col-xs-10 col-sm-8 col-md-4 btnConfirmarLinks" type="submit" value="Confirmar">
		</div>
	</form>		
</div>