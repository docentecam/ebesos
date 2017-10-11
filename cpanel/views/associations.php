<div class="glb">	
	<div class="row">
		<div class="col-lg-12"><b>Associacions</b></div>
			<div class="col-lg-12 select">
				<div for="selectAsso" id="select"></div>
				<!-- <img id="moveImg" src="img/circledown.png"> -->
				<select ng-change="changeDataUser(idUser)" ng-model="idUser" id="selectAsso">
					<option ng-repeat="user in users" ng-value="user.idUser">
						{{user.name}}
					</option>
				</select>
			</div>
	</div>
	<div ng-show="formDataUser">
		<form id="dataUser">
			<div class="row" ng-repeat="association in associations">
				<div class="col-lg-4">
					<div class="row">
						<div class="row">
							<div class="col-lg-12 padd">
								<input type="text" id="userId" ng-value="association.idUser" disabled hidden>
							</div>
						</div>
						<div class="col-lg-6 padd">Associació / Eix:</div>
						<div class="col-lg-6 padd">
								<input type="text" id="name" name="name" ng-value="association.name">
						</div>
						<div class="col-lg-6 padd">E-mail:</div>
						<div class="col-lg-6 padd">
							<input type="email" id="email" name="email" ng-value="association.email">
						</div>
						<div class="col-lg-6 padd">Password e-mail:</div>
						<div class="col-lg-6 padd">
							<input type="text" id="pswdMail" name="pswdMail" ng-value="association.emailPass">
						</div>
						<div class="col-lg-6 padd">Adreça:</div>
						<div class="col-lg-6 padd">
							<input type="text" id="address" name="address" ng-value="association.address">
						</div>
						<div class="col-lg-6 padd">Telèfon:</div>
						<div class="col-lg-6 padd">
							<input type="number" id="telephone" name="telephone" ng-value="association.telephone">
						</div>
						<div class="col-lg-6 padd">Actiu:</div>
						<div class="col-lg-6 padd">
							<select id="active">
								<option value="Y">Si</option>
								<option value="N">No</option>
							</select>
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-lg-offset-1">
					<div class="row">
						<div class="col-lg-12" id="textTitleHistory">Editar història:</div>
					</div>
					<div class="row">
						<div class="col-lg-12"><textarea id="history">{{association.history}}</textarea></div>
					</div>
				</div>
				<div class="col-lg-6 col-lg-offset-3">
					<input type="button" class="btn btn-default" value="Guardar dades" ng-click="updateUser()">
				</div>
			</div>
		</form>
	</div>
	<div class="row padd-t">
		<div class="col-lg-12">
			<input type="button" class="btn btn-default" value="Cambiar password" ng-click="showChangePass()">
		</div>
		<div class="col-lg-12" ng-show="changePass">
			<form id="newPassword">
				<div class="row">
					<div class="col-lg-12"><input type="text" id="usrId" ng-value="idUser" disabled hidden></div>
				</div>
				<div class="row padd-p">
					<div class="col-lg-3">Contrasenya actual:</div>
					<div class="col-lg-6">
						<input type="password" name="actualPass" id="actualPass">
					</div>
				</div>
				<div class="row padd-p">
					<div class="col-lg-3">Nova contrasenya:</div>
					<div class="col-lg-6">
						<input type="password" name="newPass" id="newPass">
					</div>
				</div>
				<div class="row padd-p">
					<div class="col-lg-3">Confirmar contrasenya:</div>
					<div class="col-lg-6">
						<input type="password" name="confirmPass" id="confirmPass">
					</div>
				</div>
				<div class="row">
					<div class="col-lg-6">
						<input type="button" class="btn btn-default" value="Enviar" ng-click="updatePass()">
					</div>
				</div>
			</form>
		</div>
	</div>
	<div class="row padd-t" ng-repeat="association in associations">
		<div class="col-lg-4 col-lg-offset-2">
			<div class="row">
				<div class="col-lg-5">Logo Associació</div>
			</div>
			<div class="row">
				<img class="col-lg-3" src="../img/logos-assoc/{{association.logo}}">
				<div class="col-lg-6 col-lg-offset-3">
					<div class="row"><a class="col-lg-8" href="" ng-click="showEdit()">Editar logo</a></div>
					<div class="row"><span class=" col-lg-9">Eliminar logo</span></div>
				</div>
			</div>
			<div class="col-lg-3">
				<input type="file" name="" ng-show="logoEdit">
			</div>
		</div>
	</div>
	

	<div class="row padd-t" ng-repeat="association in associations">
		<div class="col-lg-4 col-lg-offset-2">
			<div class="row">
				<div class="col-lg-5">Logo Associació</div>
			</div>
			<div class="row">
				<img class="col-lg-6" src="../img/logos-assoc/{{association.footer}}">
				<div class="col-lg-6">
					<div class="row"><a class="col-lg-8" href="" ng-click="showEdit2()">Editar logo</a></div>
					<div class="row"><span class=" col-lg-9">Eliminar logo</span></div>
				</div>
			</div>
			<div class="col-lg-3">
				<input type="file" name="" ng-show="logoEdit2">
			</div>
		</div>
	</div>
</div>