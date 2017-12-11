<?php
session_start();
if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<h1>HOLA</h1>

<div id="whiteDivNews" class="col-lg-12" ng-show="loadMails">
	<div class="row divContainerMails"  ng-repeat="mailList in mailsList>
		<div class="col-lg-3">
					
		</div>
		
		<div class="col-lg-3 col-xs-12">
					
		</div>
		
		<div class="col-lg-8">
					
		</div>
		
		<div class="row">
						
		</div>
</div>





<div class="row" >
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