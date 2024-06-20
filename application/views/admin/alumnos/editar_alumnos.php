<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Editar Alumno</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li>Editar Alumno</li>
            <li class="active"><strong>Editar Alumno</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <form id="item_form" class="form-horizontal" method="post" accept-charset="utf-8" >
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Datos del Alumno</h5>
                </div>
                <div class="ibox-content">
            		<div class="form-group">
            			<label class="col-sm-3 control-label campoObligatorio">Nombres *</label>
	                	<div class="col-lg-9 col-md-9 col-sm-9">
	                		<input type="text" class="form-control" name="nombres" id="nombres_alumno" placeholder="Juan Alber" required value="<?= isset($alumno) ? $alumno->nombres : '' ?>" onkeyup="mayus(this);">
                            <input type="hidden" name="persona_id" id="persona_id" value="0">
                            <input type="hidden" name="alumno_id" id="alumno_id" value="0">
	                	</div>	
            		</div>
            		<div class="form-group">
            			<label class="col-sm-3 control-label campoObligatorio">Apellidos *</label>
	                	<div class="col-lg-9 col-md-9 col-sm-9">
	                		<input type="text" class="form-control" name="apellidos" id="apellidos_alumno" placeholder="Perez Cordova" required value="<?= isset($alumno) ? $alumno->apellidos : '' ?>" onkeyup="mayus(this);">
	                	</div>	
            		</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">DNI</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="texto" class="form-control" name="dni" id="dni_alumno" value="<?= isset($alumno) ? $alumno->nroidentificacion : '' ?>" maxlength="8" onkeypress="return numeros(event);">
                        </div>  
                    </div>
            		<div class="form-group">
            			<label class="col-sm-3 control-label campoObligatorio">Email</label>
	                	<div class="col-lg-9 col-md-9 col-sm-9">
	                		<input type="email" class="form-control" name="email" placeholder="email@emai.com" value="<?= isset($alumno) ? $alumno->email : '' ?>">
	                	</div>	
            		</div>
            		<div class="form-group">
            			<label class="col-sm-3 control-label campoObligatorio">Dirección *</label>
	                	<div class="col-lg-9 col-md-9 col-sm-9">
	                		<input type="text" class="form-control" name="direccion" placeholder="Dirección" id="direccion_alumno" required value="<?= isset($alumno) ? $alumno->direccion : '' ?>">
	                	</div>	
            		</div>
            		<div class="form-group">
            			<label class="col-sm-3 control-label campoObligatorio">Fch. Nacimiento</label>
	                	<div class="col-lg-9 col-md-9 col-sm-9">
	                		<input type="text" class="form-control datepicker" name="fch_nac" required value="<?= isset($alumno) ? $alumno->fch_nac : '' ?>">
	                	</div>	
            		</div>
            		<div class="form-group">
            			<label class="col-sm-3 control-label campoObligatorio">Telefono</label>
	                	<div class="col-lg-9 col-md-9 col-sm-9">
	                		<input type="texto" class="form-control" name="telefono"  value="<?= isset($alumno) ? $alumno->telefono : '' ?>" maxlength="9" onkeypress="return numeros(event);">
	                	</div>	
            		</div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Colegio</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control" name="colegio"  value="<?= isset($alumno) ? $alumno->colegio : '' ?>" onkeyup="mayus(this);">
                        </div>  
                    </div>                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Area</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" name="area" required id="area">
                                <?php if(isset($alumno)) foreach ($areas as $key => $value) { ?>
                                    <option value="<?= $value->id ?>" <?= $value->id == $alumno->area_id ? 'selected' : '' ?>><?= $value->Descripcion ?></option>
                                <?php } ?> 
                                <?php if(!isset($alumno)) foreach ($areas as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                <?php } ?>                                
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php if(isset($alumno)) foreach ($turnos as $key => $value) { ?>
                                <label class="col-sm-5 control-label campoObligatorio"><input type="radio" name="turno" required class="input-turno" value="<?= $value->id ?>" <?= $value->id == $alumno->turno_id ? 'checked' : '' ?>>&nbsp;<?= $value->descripcion ?>&nbsp;</label>
                        <?php } ?>
                        <?php if(!isset($alumno)) foreach ($turnos as $key => $value) { ?>
                                <label class="col-sm-5 control-label campoObligatorio"><input type="radio" name="turno" required class="input-turno" value="<?= $value->id ?>">&nbsp;<?= $value->descripcion ?>&nbsp;</label>
                        <?php } ?>
                    </div>
                     <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Ciclo</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                        <select class="form-control" required name="ciclo" id="ciclo">
                                <?php if(isset($alumno)) foreach ($ciclos as $key => $value) { ?>
                                    <option value="<?= $value->id ?>" <?= $value->id == $alumno->ciclo_id ? 'selected' : '' ?>><?= $value->Descripcion ?></option>
                                <?php } ?> 
                                <?php if(!isset($alumno)) foreach ($ciclos as $key => $value) { ?>
                                    <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                <?php } ?>                                
                        </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Fecha Inicio de Grupo*</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control datepicker" name="grupo" required value="<?= isset($alumno) ? $alumno->grupo : '' ?>">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Fecha de Fin de Grupo*</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control datepicker" name="grupo_fin" required value="<?= isset($alumno) ? $alumno->Grupo_fin : '' ?>">
                        </div>  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Datos del Tutor</h5>
                </div>
                <div class="ibox-content">
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Nombres *</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control" name="nombres2" placeholder="Juan Alber" required value="<?= isset($tutor) ? $tutor->nombres : '' ?>" onkeyup="mayus(this);">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Apellidos *</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control" name="apellidos2" placeholder="Perez Cordova" required value="<?= isset($tutor) ? $tutor->apellidos : '' ?>" onkeyup="mayus(this);">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">DNI</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="texto" class="form-control" name="dni2" value="<?= isset($tutor) ? $tutor->nroidentificacion : '' ?>" maxlength="8" onkeypress="return numeros(event);">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Telefono</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="texto" class="form-control" name="telefono2" value="<?= isset($tutor) ? $tutor->telefono : '' ?>" maxlength="9" onkeypress="return numeros(event);">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Email</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="email" class="form-control" name="email2" placeholder="email@emai.com"  value="<?= isset($tutor) ? $tutor->email : '' ?>">
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <center>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Editar</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
</div>
<script type="text/javascript">
	$(function(){
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });       
		$('#item_form').on('submit',function(e){
			e.preventDefault()
			var data = $('#item_form').serialize()
            $.confirm({
                title: 'Atención',
                content: '¿Estás seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Editando',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= base_url('alumnos/editar/').$alumno->id_alumno ?>',
                                    method: 'post',
                                    dataType: 'JSON',
                                    data: data
                                }).done(function(response){
                                    if(response.status == 200){
                                        toastr.success('Edición Satisfactoria')              
                                        var data = response.data
                                        $('#persona_id').val(data.persona_id)  
                                        $('#alumno_id').val(data.alumno_id)          
                                        setTimeout(function(){window.location.href = '<?= base_url('alumnos') ?>'},2500)
                                    }                                    
                                    else{
                                        toastr.error('Error')
                                    }
                                    self.close()
                                }).fail(function(){
                                    toastr.error('Error en la Edición consulte con su administrador')
                                    self.close()
                                })
                            }                       
                        })
                    },
                    no: function(){}
                }
            })
		})
	})

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

    function letras(evt){

    }

    function numeros(evt){
        if (window.event) {
            keynum = evt.keyCode;
        }
        else{
            keynum = evt.which;
        }

        if (keynum > 47 && keynum < 58 || keynum ==8 || keynum ==13) {
            return true;
        }
        else{
            //alert("ingrese solo numero");
            return false;
        }
    }

</script>