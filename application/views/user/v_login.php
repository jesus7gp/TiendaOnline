<div class="container" id="login"><br><br>
	<form method="POST" action="">
	<div class="row">
	<div class="col-md-4"></div><div class="col-md-4">
	<h2>Iniciar sesión</h2><br>
	<a class="h5" href="<?php echo base_url('index.php/Ctrl_user/registro') ?>">¿Aún no está registrado?</a><br><br>
		<fieldset class="form-group">
			<label for="">Usuario:</label>
			<input type="text" name="usuario" placeholder="Introduzca nombre de usuario" class="form-control" value=""><br>
		</fieldset>
		<fieldset class="form-group">
			<label for="">Clave:</label>
			<input type="password" name="clave" placeholder="Introduzca clave de acceso" class="form-control" value=""><br>
		</fieldset>
		<button class="btn btn-primary sesion" type="submit">Iniciar sesión</button><br><br>
		<a class="h6" href="<?=base_url('index.php/Ctrl_user/correo')?>">¿Ha olvidado la contraseña?</a>
		</div>
		<div class="col-md-4"></div>
	</div>
	</form>

	<br><br>
	<br><br>
	<br>
</div>