	<!-- 
	Nombre de usuario

	Email

	Contraseña

	Repetir contraseña

	Nombre

	Apellidos

	DNI

	Provincia

	Dirección

	Código postal

	-->
<body>
<div class="container">
<br>
<div class="row">
<div class="col-md-3"></div><div class="col-md-6">
<h1>Registro de usuario</h1><br>

<FORM ACTION="" METHOD="POST">
<div class="row">
<div class="col-md-6">
	<fieldset class="form-group">
		<label for="">Nombre de usuario:</label>
		<input type="text" name="usuario" class="form-control" value="">
		<?=form_error('usuario')?>
	</fieldset></div>
	<div class="col-md-6">
	<fieldset class="form-group">
		<label for="">Email:</label>
		<input type="text" name="correo" class="form-control" value="">
		<?=form_error('correo')?>
	</fieldset></div>
</div>
<div class="row">
<div class="col-md-6">
	<fieldset class="form-group">
		<label for="">Contraseña:</label>
		<input type="password" name="clave" class="form-control" value="">
		<?=form_error('clave')?>
	</fieldset></div>
<div class="col-md-6">	
	<fieldset class="form-group">
		<label for="">Confirmar contraseña:</label>
		<input type="password" name="repclave" class="form-control" value="">
		<?=form_error('repclave')?>
	</fieldset></div>
</div>
<div class="row">
<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">Nombre:</label>
		<input type="text" name="nombre" class="form-control" value="">
		<?=form_error('nombre')?>
	</fieldset></div>
	<div class="col-md-8">
	<fieldset class="form-group">
		<label for="">Apellidos:</label>
		<input type="text" name="apellidos" class="form-control" value="">
		<?=form_error('apellidos')?>
	</fieldset></div></div>
	<div class="row">
<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">DNI:</label>
		<input type="text" name="dni" class="form-control" value="">
		<?=form_error('dni')?>
	</fieldset>
	</div>
	<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">Provincia:</label><br>
		<?php echo form_dropdown('provincia', $ListaProvincias, set_value('provincia'), 'class="form-control"'); ?>
		<?=form_error('provincia')?>
	</fieldset></div>
	<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">Código postal:</label>
		<input type="text" name="cp" class="form-control" value="">
		<?=form_error('cp')?>
	</fieldset></div></div>
	<fieldset class="form-group">
		<label for="">Dirección:</label>
		<input type="text" name="direccion" class="form-control" value="">
		<?=form_error('direccion')?>
	</fieldset>
	<button class="btn btn-primary sesion" type="submit">Finalizar registro</button>
</FORM>
<br><br>
<div class="alert alert-info" role="alert"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><b>	IMPORTANTE: </b>Todos los campos son obligatorios.</div>
<br><br>
<br><br>
</div>
<div class="col-md-3"></div>
</div>
</div>
</body>