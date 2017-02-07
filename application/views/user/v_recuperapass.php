<div class="container">
<br>
<div class="row">
<div class="col-md-3"></div><div class="col-md-6">
<h1>Recuperar contraseña</h1><br>

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

	<button class="btn btn-primary sesion" type="submit">Recuperar contraseña</button>
</FORM>

</div>
<div class="col-md-3"></div>
</div>
</div>