<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="row">
	<div><h1>Paràmetres</h1></div>	
	<div ng-show="confirm"> <h3> Ha sigut actualizat</h3> </div>
</div>
<div class="row">
	<button id="btnAfegir" class="btn btn-default" ng-hide="btnAfegir" ng-click="editParameter('Afegir')" >Afegir <i class="fa fa-plus-circle"></i></button>
	<br>
	<table border="1">
		<thead>
		<tr>
			<th>Literal</th>
			<th>Value</th>
			<th>Editar</th>
		</tr>
	</thead>

	<tbody>
		<tr ng-repeat="setting in settingsList">
			<td>{{setting.literal}}</td>
			<td>{{setting.value}}</td>
			<td><a ng-click="editParameter('Editar',setting.idSetting, setting.value, setting.literal)" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a></td>		
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
