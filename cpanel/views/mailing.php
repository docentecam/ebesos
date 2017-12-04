<?php
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<h1>HOLA</h1>

<div class="row" ng-show="loadMails">
	<form action="#" id="validationPromotion" name="validation" >	
		<div>
			<label> Assumpte:</label>
			<input type="text" name="">
		</div>
		
		<div>
			<label> Data:</label>
			<input type="date" name="">
		</div>

		<div>
			<label>Missatge:</label>
			<textarea></textarea>
		</div>

		<div>
			<input type="button" class="btn bttnsPromos" value="Veure Usuaris" ng-click="enviar()">
		</div>
	</form>
</div>