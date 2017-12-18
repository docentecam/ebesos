<?php
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div>
	<input type="button" class="btn bttnsPromos" value="Crear Missatge" ng-click="newMessage()">
</div>

<div class="row" ng-repeat="mailList in mailsList" >

		<div>
			<label> Assumpte:</label>
			<input type="text" name="" ng-value="mailList.asunto">
		</div>
		
		<div>
			<label> Data:</label>
			<input type="date" name="" ng-value="mailList.fecha">
		</div>

		<div>
			<label>Missatge:</label>
			<span> {{mailList.contenido}} </span>
		</div>

		<div>
			<input type="button" class="btn bttnsPromos" value="Veure Usuaris" ng-click="listUsersMailing()">
		</div>

		<div class="row" ng-show="showMailing">
			<table>
				<thead>
				<tr>
					<th class="centerPadding thCenterLinks">Email</th>
					<th class="centerPadding thCenterLinks">Nom Contacte</th>
					
				</tr>
			</thead>

			<tbody>
				<tr ng-repeat="mailListMailing in mailsListMailing" >
					<td class="tdCenterLinks borderTableLinks">{{mailListMailing.email}}</td>
					<td class="tdCenterLinks borderTableLinks">{{mailListMailing.nomContacte }}</td>
				</tr>
			</tbody>
			</table>
		</div>
	
</div>




<div class="row" ng-show="messageNew">
	<form action="#" id="validationPromotion" name="validation" >
		<div>
				<label> Assumpte:</label>
				<input type="text" ng-value="asunto">
		</div>
			
		<div>
			<label> Data:</label>
			<input type="date" ng-value="fecha" >
		</div>

		<div>
			<label>Missatge:</label>
			<textarea ng-value="contenido"></textarea>
		</div>

		<div>
			<input type="button" class="btn bttnsPromos" value="Enviar Missatge" ng-click="sendMails()">
		</div>
	</form>
</div>