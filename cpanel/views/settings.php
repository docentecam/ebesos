<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<div class="col-xs-6 noPadding linkTitle"><b>Enllaços peu de pàgina</b></div>	
	<div ng-show="confirm"> <h3> Ha sigut actualizat</h3> </div>
</div>
<div class="row">
	<button id="btnAfegir" class="btn btn-default" ng-hide="btnAfegir" ng-click="editParameter('Afegir')" >Afegir <i class="fa fa-plus-circle"></i></button>
	<br>
	<table class="tableLinks  col-xs-4 col-sm-7 col-md-9 col-lg-11">
		<thead>
		<tr>
			<th class="centerPadding thCenterLinks col-xs-2">Literal</th>
			<th class="centerPadding thCenterLinks col-xs-2">Valors</th>
			<th class="centerPadding thCenterLinks col-xs-5">Editar</th>
		</tr>
	</thead>

	<tbody>
		<tr ng-repeat="setting in settingsList">
			<td class="tdCenterLinks borderTableLinks">{{setting.literal}}</td>
			<td class="tdCenterLinks borderTableLinks">{{setting.value | limitTo: 20}}</td>
			<td class="centerPadding tdCenterLinks borderTableLinks"><a ng-click="editParameter('Editar',setting.idSetting, setting.value, setting.literal)" href="" class="iconLinkCenter"><i class="fa fa-2x fa-pencil editDeleteIconLinks" aria-hidden="true"></i></a></td>		
		</tr>
	</tbody>
	</table>

</div>



<div class="row" ng-show="showSettings">
	<form action="#" id="validationSetting" name="validation" method="POST" >
		<h1>{{act}} Paràmetres</h1>
		<div class="row">
			<div class="col-xs-6">
				<label>Paràmetre </label>
				<input type="text" ng-model="literal" id="updateLiteral">
			</div>

			<div class="col-xs-6">
				<label>Valor Paràmetre </label>
				<input type="text" ng-model="value" id="updateValue">
			</div>
		</div>
		<div class="row">
		<input type="text" hidden id="settingId" ng-model="idSetting">
		<input type="button" name="actParameter" value="{{act}}" class="btn btn-default"" ng-click="editParameter(accBbdd)">
		

		</div>
	</form>
	
</div>
