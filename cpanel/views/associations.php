<div class="row">
	<div class="col-lg-12"><b>Associacions</b></div>
</div>
<div>
	<form id="dataUser">
		<div class="row" ng-repeat="association in associations">
			<div class="col-lg-4">
				<div class="row">
					<div class="col-lg-12">
						<select>
							<option>WIP</option>
						</select>
					</div>
					<div class="row">
						<div class="col-lg-12">
							<input type="text" id="userId" ng-value="association.idUser" disabled hidden>
						</div>
					</div>
					<div class="col-lg-6">Associació:</div>
					<div class="col-lg-6">
							<input type="text" id="name" name="name" ng-value="association.name">
					</div>
					<div class="col-lg-6">E-mail:</div>
					<div class="col-lg-6">
						<input type="email" id="email" name="email" ng-value="association.email">
					</div>
					<div class="col-lg-6">Password e-mail:</div>
					<div class="col-lg-6">
						<input type="text" id="pswdMail" name="pswdMail" ng-value="association.emailPass">
					</div>
					<div class="col-lg-6">Adreça:</div>
					<div class="col-lg-6">
						<input type="text" id="address" name="address" ng-value="association.address">
					</div>
					<div class="col-lg-6">Telèfon:</div>
					<div class="col-lg-6">
						<input type="number" id="telephone" name="telephone" ng-value="association.telephone">
					</div>
					<div class="col-lg-6">Actiu:</div>
					<div class="col-lg-6">
						<select id="active">
							<option value="Y">Si</option>
							<option value="N">No</option>
						</select>
					</div>
				</div>
			</div>
			<div class="col-lg-7 col-lg-offset-1">
				<div class="row">
					<div class="col-lg-12">Editar història:</div>
				</div>
				<div class="row">
					<div class="col-lg-12"><textarea id="history">{{association.history}}</textarea></div>
				</div>
			</div>
			<div class="col-lg-6 col-lg-offset-10"> <!--Quitar el offset-->
				<input type="button" class="btn btn-default" value="Enviar" ng-click="updateUser()">
			</div>
		</div>
	</form>
</div>
<div class="row">
	<div class="col-lg-12">
		<input type="button" class="btn btn-default" value="Cambiar password" ng-click="showChangePass()">
	</div>
	<div class="col-lg-12" ng-show="changePass">
		<form id="newPassword">
			<div class="row">
				<div class="col-lg-12"><input type="text" id="usrId" ng-value="idUser" disabled hidden></div>
			</div>
			<div class="row">
				<div class="col-lg-3">Contrasenya actual:</div>
				<div class="col-lg-6">
					<input type="password" name="actualPass" id="actualPass">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-3">Nova contrasenya:</div>
				<div class="col-lg-6">
					<input type="password" name="newPass" id="newPass">
				</div>
			</div>
			<div class="row">
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
<div class="row" ng-repeat="association in associations">
	<div class="col-lg-12 col-lg-offset-2">
		<div class="row">
			<div class="col-lg-12">Logo Associació</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<img src="../img/logos-assoc/{{association.logo}}">
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">Editar logo</div>
					<div class="col-lg-12">Eliminar logo</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row" ng-repeat="association in associations">
	<div class="col-lg-12 col-lg-offset-2">
		<div class="row">
			<div class="col-lg-12">Logo Footer</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<img src="../img/logos-assoc/{{association.footer}}">
			</div>
			<div class="col-lg-6">
				<div class="row">
					<div class="col-lg-12">Editar logo</div>
					<div class="col-lg-12">Eliminar logo</div>
				</div>
			</div>
		</div>
	</div>
</div>