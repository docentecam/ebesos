<?php
	session_start();
	if(!isset($_SESSION['user']['idUser'])) header("Location: index.html");
?>
<div class="glb">	
	<div class="row">
		<div class="col-lg-12"><b>Associacions</b></div>
		<div class="col-lg-5">
			<?php
			if(isset($_SESSION['user']['privileges']) && $_SESSION['user']['privileges'] != 'E')
			{
			?>
				<select ng-change="changeDataUser(idUser)" ng-model="idUser" id="selectAsso" disabled>
					<option ng-repeat="user in users" ng-value="user.idUser" ng-selected="user.idUser==<?php echo $_SESSION['user']['idUser']?>">
						{{user.name}}
					</option>
				</select>
			<?php
			}
			else
			{
			?>
				<select ng-change="changeDataUser(idUser)" ng-model="idUser" id="selectAsso">
					<option ng-repeat="user in users" ng-value="user.idUser" ng-selected="user.idUser==<?php echo $_SESSION['user']['idUser']?>">
						{{user.name}}
					</option>
				</select>
			<?php
			}
			?>
		</div>
		<?php
		if(isset($_SESSION['user']['privileges']) && $_SESSION['user']['privileges'] == 'E')
		{
		?>
			<div class="col-lg-2"  ng-show="cUser">
		 		<button id="btnAdd" class="btn btn-default" ng-click="changeDataUser(idUser=-1)" >Afegir <i class="fa fa-plus-circle"></i></button>
			</div>
		<?php
		}
		?>
	</div>
	<div ng-show="fail">
		<div ng-class="validation ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
			<i class="fa fa-times" ng-hide="validation" aria-hidden="true"></i>
			<i class="fa fa-check" ng-show="validation" aria-hidden="true"></i>
			<b>{{statusValidation}}</b>
		</div>
	</div>
	<div>
		<form id="dataUser" ng-submit="updateUser()">
			<div class="row">
				<div class="col-lg-4">
					<div class="row">
						<div class="row">
							<div class="col-lg-12 padd">
								<input type="text" id="userId" ng-value="idUserC" disabled hidden>
							</div>
						</div>
						<div class="col-lg-6 padd">Associació / Eix:</div>
						<div class="col-lg-6 padd">
								<input type="text" id="name" name="name" ng-model="nameC">
						</div>
						<div class="col-lg-6 padd">E-mail:</div>
						<div class="col-lg-6 padd">
							<input type="email" id="email" name="email" ng-model="emailC">
						</div>
						<div class="col-lg-6 padd">Password e-mail:</div>
						<div class="col-lg-6 padd">
							<input type="text" id="pswdMail" name="pswdMail" ng-model="emailPassC">
						</div>
						<div class="col-lg-6 padd">Adreça:</div>
						<div class="col-lg-6 padd">
							<input type="text" id="address" name="address" ng-model="addressC">
						</div>
						<div class="col-lg-6 padd">Telèfon:</div>
						<div class="col-lg-6 padd">
							<input type="number" id="telephone" name="telephone" ng-model="telephoneC">
						</div>
						<div class="col-lg-6 padd">
							<div ng-hide="cUser">Contrasenya:</div><div ng-show="cUser">Nova contrasenya:</div>
						</div>
						<div class="col-lg-6 padd">
							<input type="password" id="pswd" name="pswd" ng-model="pswdC">
						</div>
						<div class="col-lg-6 padd">Confirmar contrasenya:</div>
						<div class="col-lg-6 padd">
							<input type="password" id="confirmPswd" name="cpswd" ng-model="confirmPswdC">
						</div>
						<div class="col-lg-6 padd" ng-show="cUser">Contrasenya Actual:</div>
						<div class="col-lg-6 padd" ng-show="cUser">
							<input type="password" id="currentPswd" name="cpswd" ng-model="currentPswdC">
						</div>
						<div class="col-lg-6 padd" ng-show="cUser">Actiu:</div>
						<div class="col-lg-6 padd" ng-show="cUser">
							<?php
							if(isset($_SESSION['user']['privileges']) && $_SESSION['user']['privileges'] != 'E')
							{
							?>
								<select id="active" disabled>
									<option value="Y" ng-selected="activeC=='Y'" ng-model="activeCY">Si</option>
									<option value="N" ng-selected="activeC=='N'" ng-model="activeCN">No</option>
								</select>
							<?php
							}
							else
							{
							?>
								<select id="active">
									<option value="Y" ng-selected="activeC=='Y'" ng-model="activeCY">Si</option>
									<option value="N" ng-selected="activeC=='N'" ng-model="activeCN">No</option>
								</select>
							<?php
							}
							?>
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-lg-offset-1">
					<div class="row">
						<div class="col-lg-12" id="textTitleHistory">Editar història:</div>
					</div>
					<div class="row">
						<div class="col-lg-12"><textarea id="history" ng-model="historyC"></textarea></div>
					</div>
				</div>
				<div class="col-lg-6 col-lg-offset-3">
					<input type="submit" class="btn btn-default" value="Guardar dades">
				</div>
			</div>
		</form>
	</div>

	<div ng-show="fail2">
		<div ng-class="validation2 ? 'alert alert-success' : 'alert alert-danger'" id="validationAssociation">
			<i class="fa fa-times" ng-hide="validation2" aria-hidden="true"></i>
			<i class="fa fa-check" ng-show="validation2" aria-hidden="true"></i>
			<b>{{statusValidation2}}</b>
		</div>
	</div>

	<div class="row padd-t" ng-show="cUser">
		<div class="col-lg-4 col-lg-offset-1">
			<div class="row">
				<div class="col-lg-6">Logo Associació</div>
			</div>
			<div class="row">
				<img class="col-lg-3" ng-src="../img/logos-assoc/{{logoC}}">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="row"><a class="col-lg-8" href="" ng-click="showEdit()">Editar logo</a></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 pt-3">
			<label for="logoA" ng-show="logoEdit" class="labelFor">Examinar</label>
			<input type="file" id="logoA" name="" ng-show="false" onchange="angular.element(this).scope().selImages(this,'logo')">
		</div>
	</div>
	

	<div class="row padd-t" ng-show="cUser">
		<div class="col-lg-4 col-lg-offset-1">
			<div class="row">
				<div class="col-lg-6">Logo Footer</div>
			</div>
			<div class="row">
				<img class="col-xs-6 col-lg-6" ng-src="../img/logos-assoc/{{footerC}}">
				<div class="col-xs-12 col-lg-6">
					<div class="row"><a class="col-lg-8" href="" ng-click="showEdit2()">Editar logo</a></div>
				</div>
			</div>
		</div>
		<div class="col-lg-3 pt-3">
			<label for="logoF" ng-show="logoEdit2" class="labelFor">Examinar</label>
			<input type="file" id="logoF" name="" ng-show="false" onchange="angular.element(this).scope().selImages(this,'footer')">
		</div>
	</div>
</div>