<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Nuevo Usuario</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li>Usuarios</li>
            <li class="active"><strong>Nuevo Usuario</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Nuevo Usuario</h5>
                </div>
                <div class="ibox-content">
                	<form id="item_form" class="form-horizontal col-md-offset-3" method="post" accept-charset="utf-8" >
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Nombres *</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<input type="text" class="form-control" name="nombres" placeholder="Juan Alber" required>
		                	</div>	
                		</div>
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Apellidos *</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<input type="text" class="form-control" name="apellidos" placeholder="Perez Cordova" required>
		                	</div>	
                		</div>
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Email</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<input type="email" class="form-control" name="email" placeholder="email@emai.com" required>
		                	</div>	
                		</div>
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Rol *</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<select class="form-control" name="rol">
		                			<?php if(!is_numeric($roles)) foreach ($roles as $key => $value) { ?>
		                				<option value="<?= $value->id ?>"><?= $value->nombre ?></option>
		                			<?php } ?>
		                		</select>
		                	</div>	
                		</div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label campoObligatorio">Sede *</label>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <select class="form-control" name="sede">
                                    <?php if(!is_numeric($sedes)) foreach ($sedes as $key => $value) { ?>
                                        <option value="<?= $value->id ?>"><?= $value->Descripcion.' - '.$value->direccion ?></option>
                                    <?php } ?>
                                </select>
                            </div>  
                        </div>
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Usuario *</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<input type="text" class="form-control" name="usuario" placeholder="jperez" required>
		                	</div>	
                		</div>
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Contraseña</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<input type="password" class="form-control" name="password" id="password" placeholder="*********" required>
		                	</div>	
                		</div>
                		<div class="form-group">
                			<label class="col-sm-2 control-label campoObligatorio">Repite Contraseña</label>
		                	<div class="col-lg-6 col-md-6 col-sm-6">
		                		<input type="password" class="form-control" name="repeat-password" id="repeat-password" placeholder="*********" required>
		                	</div>	
                		</div>
                		<div class="form-group">
                			<div class="col-lg-8 col-md-8 col-sm-8">
	                			<center>
	                				<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Volver</a>
	                				<button type="submit" class="btn btn-primary" id="guardar"><i class="fa fa-save"></i> Guardar</button>
	                			</center>
	                		</div>
                		</div>
                	</form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function(){
		toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
		$('#item_form').on('submit',function(e){
			e.preventDefault()
			if($('#password').val() == $('#repeat-password').val()){
				$('#item_form').unbind('submit').submit()
			}
			else{
				toastr.error('Contraseñas no coinciden')
			}
		})
	})
</script>