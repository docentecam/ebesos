<?php
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<div class="col-lg-3"><b>Enllaços peu de pàgina</b></div>
	<div class="col-lg-5" ng-show="tableLinks">
		<button id="btnAfegir" class="btn btn-default" ng-hide="btnAfegir" ng-click="createLink()">Afegir <i class="fa fa-plus-circle"></i></button>
	</div>
</div>
<div ng-show="tableLinks">
	<div class="row">
		<table border="1">
			<thead>
			<tr>
				<th>Nom</th>
				<th>Url</th>
				<th>Editar</th>
				<th>Eliminar</th>
			</tr>
		</thead>
		<tbody>
			<tr ng-repeat="link in linksList">
				<td>{{link.description}}</td>
				<td>{{link.url}}</td>
				<td><a ng-click="editLink(link.idLink,link.description,link.url)" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
				<td><a ng-click="deleteLink(link.idLink)" href=""><i class="fa fa-times" aria-hidden="true"></i></a></td>	
			</tr>
		</tbody>
		</table>
	</div>
</div>
<div ng-show="formLinks">
	<div class="row">
		<form id="linksForm" ng-submit="updateLink()">
			<input type="text" id="userId" ng-value="idLinkC" disabled hidden>
			<label class="col-lg-3">Nom: </label>
			<div class="col-lg-9"><input type="text" name="name" ng-model="nameC" style="width: 40%;"></div>
			<label class="col-lg-3">Url: </label>
			<div class="col-lg-9"><input type="text" name="url" ng-model="urlC" style="width: 40%;"></div>
			<div class="col-lg-2"><input class="btn btn-default" type="submit" value="Confirmar"></div>
		</form>		
	</div>
</div>