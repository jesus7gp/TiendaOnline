<div class="container">
<br>
<div class="row">
<div class="col-md-3"></div><div class="col-md-6">
<h1>Nueva contraseña</h1><br>

<FORM ACTION="" METHOD="POST">
<div class="row">
<div class="col-md-6">
	<fieldset class="form-group">
		<label for="">Nueva contraseña:</label>
		<input type="password" name="clave" class="form-control" value="<?=set_value('clave')?>">
		<?=form_error('clave')?>
	</fieldset></div>
<div class="col-md-6">	
	<fieldset class="form-group">
		<label for="">Confirmar contraseña:</label>
		<input type="password" name="repclave" class="form-control" value="<?=set_value('repclave')?>">
		<?=form_error('repclave')?>
	</fieldset></div>
</div>
	<button class="btn btn-primary sesion" type="submit">Cambiar contraseña</button>
</FORM>
<br><br>
<br><br>
<br><br>
</div>
<div class="col-md-3"></div>
</div>
</div>