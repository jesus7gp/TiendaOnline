<div class="container">
<br>
<div class="row">
<div class="col-md-3"></div><div class="col-md-6">
<h1><i class="fa fa-user-circle" aria-hidden="true"></i> Mi cuenta</h1><br>

<FORM ACTION="" METHOD="POST">
<div class="row">
<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">Nombre:</label>
		<input type="text" name="nombre" class="form-control" value="<?=set_value('nombre', $usuario['nombre'])?>">
		<?=form_error('nombre')?>
	</fieldset></div>
	<div class="col-md-8">
	<fieldset class="form-group">
		<label for="">Apellidos:</label>
		<input type="text" name="apellidos" class="form-control" value="<?=set_value('apellidos', $usuario['apellidos'])?>">
		<?=form_error('apellidos')?>
	</fieldset></div></div>
	<div class="row">
<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">DNI:</label>
		<input type="text" name="dni" class="form-control" value="<?=set_value('dni', $usuario['dni'])?>">
		<?=form_error('dni')?>
	</fieldset>
	</div>
	<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">Provincia:</label><br>
		<?php echo form_dropdown('provincia', $ListaProvincias, set_value('provincia', $usuario['provincia']), 'class="form-control"'); ?>
		<?=form_error('provincia')?>
	</fieldset></div>
	<div class="col-md-4">
	<fieldset class="form-group">
		<label for="">Código postal:</label>
		<input type="text" name="cp" class="form-control" value="<?=set_value('cp', $usuario['cp'])?>">
		<?=form_error('cp')?>
	</fieldset></div></div>
	<fieldset class="form-group">
		<label for="">Dirección:</label>
		<input type="text" name="direccion" class="form-control" value="<?=set_value('direccion', $usuario['direccion'])?>">
		<?=form_error('direccion')?>
	</fieldset>
	<div class="btn-group">
	<button class="btn btn-primary" type="submit">Guardar cambios</button>
	<a href="<?=base_url('index.php/Ctrl_user/NuevaClave')?>" class="btn btn-success" type="submit">Cambiar contraseña</a>
	<a href="<?=base_url('index.php/Ctrl_user/Baja')?>" class="btn btn-danger" type="submit">Cancelar cuenta</a>
	</div>
</FORM>
<br><br>
<div class="alert alert-info" role="alert"><i class="fa fa-exclamation-circle" aria-hidden="true"></i><b>	IMPORTANTE: </b>Todos los campos son obligatorios.</div>
<br><br>
<br><br>
</div>
<div class="col-md-3"></div>
</div>
</div>