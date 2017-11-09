<?php
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>

<div class="row">
	<button id="btnAfegir" class="btn btn-default" ng-hide="btnAfegir" ng-click="" >Afegir <i class="fa fa-plus-circle"></i></button>
	<br>
	<table border="1">
		<thead>
		<tr>
			<th>Literal</th>
			<th>Value</th>
			<th>Editar</th>
			<th>Eliminar</th>
		</tr>
	</thead>

	<tbody>
		<tr ng-repeat="link in linksList">
			<td>{{link.description}}</td>
			<td>{{link.url}}</td>
			<td><a ng-click="" href=""><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
			<td><a ng-click="" href=""><i class="fa fa-times" aria-hidden="true"></i></a></td>	
		</tr>
	</tbody>
	</table>

</div>