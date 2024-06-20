<section style="margin-top: 120px; background: #fff;">
	<div class="container align-center">
        <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">Pre-Inscripción</h2>
        <div class="container timelines-container" mbri-timelines="">
        <form method="post" class="form-horizontal" id="preregistro">
        	<h4 class="mbr-section-title pb-3 mbr-fonts-style display-5">Datos del Alumno</h4>
            <p class="col-lg-3 col-md-3 col-sm-3 align-center" style="color: red; border: 2px solid #c2c2c2; border-radius: 10px;"><i><b>NOTA: (*)Campos Obligatorios</b></i></p>
        	<div class="row">
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Nombres *</label>
        				<input type="text" name="nombres" class="form-control" required id="nombres" placeholder="ejemplo: Juan Albert" onkeyup="mayus(this);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Apellidos *</label>
        				<input type="text" name="apellidos" class="form-control" required id="apellidos" placeholder="ejemplo: Perez Cordova" onkeyup="mayus(this);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">DNI</label>
        				<input type="text" name="dni" class="form-control" maxlength="8" id="dni" placeholder="ejemplo: 12345678"  onkeypress="return numeros(event);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Email</label>
        				<input type="text" name="email" class="form-control"  id="email" placeholder="ejemplo: email@hotmail.com">
        			</div>
        		</div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="pull-left">Dirección *</label>
                        <input type="text" name="direccion" class="form-control" required id="direccion" placeholder="Urb. Ignacio Merino M1-9">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="pull-left">Fecha de Nacimiento</label>
                        <input type="text" name="fch_nac" class="form-control datepicker" id="fch_nac" placeholder="<?= date('d-m-Y') ?>" value="">
                    </div>
                </div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Area *</label>
        				<select class="form-control" name="area" required id="area">
                            <?php if(!is_numeric($areas)) foreach ($areas as $key => $value) { ?>
                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                            <?php } ?>
                        </select>
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Telefono o Celular</label>
        				<input type="text" name="telefono" class="form-control" id="telefono" maxlength="9" placeholder="(073123456) o 987654321"  onkeypress="return numeros(event);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Turno *</label>
        			</div>
        			<div class="form-group">
                        <?php if(!is_numeric($turnos)) foreach ($turnos as $key => $value) { ?>
                                <label><input type="radio" name="turno" class="input-turno" required value="<?= $value->id ?>">&nbsp;&nbsp;<?= $value->descripcion ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                        <?php } ?>
        			</div>
        		</div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <label class="pull-left">Colegio de Procedencia</label>
                        <input type="text" name="colegio" class="form-control" id="colegio" placeholder="I.E.P Exitus Piura">
                    </div>
                </div>
        	</div>

        	<hr>

        	<h4 class="mbr-section-title pb-3 mbr-fonts-style display-5">Datos del Apoderado</h4>
        	<div class="row">
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Nombres *</label>
        				<input type="text" name="nombres2" class="form-control" required id="nombres2" placeholder="ejemplo: Juan Alberto" onkeyup="mayus(this);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Apellidos *</label>
        				<input type="text" name="apellidos2" class="form-control" required id="apellidos2" placeholder="ejemplo: Perez Silva" onkeyup="mayus(this);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">DNI</label>
        				<input type="text" name="dni2" class="form-control" maxlength="8" id="dni2" placeholder="ejemplo: 12345678" onkeypress="return numeros(event);">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Email</label>
        				<input type="text" name="email2" class="form-control" id="email2" placeholder="email@hotmail.com o email@gmail.com">
        			</div>
        		</div>
        		<div class="col-lg-6 col-md-6 col-sm-6">
        			<div class="form-group">
        				<label class="pull-left">Telefono o Celular</label>
        				<input type="text" name="telefono2" class="form-control" maxlength="9" id="telefono2" placeholder="(073 123456) o 987654321" onkeypress="return numeros(event);">
        			</div>
        		</div>
        	</div>

            <hr>

            <h4 class="mbr-section-title pb-3 mbr-fonts-style display-5">Comprobantes</h4>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="foto-dni">
                        <label class="custom-file-label" for="customFile">Foto de DNI</label>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="foto-boucher">
                        <label class="custom-file-label" for="customFile">Boucher 1</label>
                    </div>
                </div>
            </div><br>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="foto">
                        <label class="custom-file-label" for="customFile">Foto</label>
                    </div>
                </div>
            </div>
        	<div class="row">
        		<div class="col-lg-12 col-md-12 col-sm-12">
        			<center>
        				<button type="submit" class="btn btn-primary"><i class="fas fa-check"></i>&nbsp;&nbsp;Inscribir</button>
        			</center>
        		</div>
        	</div>
        </form>
        </div>
    </div>
</section>
<br>
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
        $('.custom-file-label::after').css('content','Buscar')
        $('#preregistro').on('submit',function(e){
            e.preventDefault()
            //var dataSerialize = $('#preregistro').serialize()
            var formData= new FormData($('#preregistro')[0])
            $.confirm({
                title: 'Atención',
                columnClass: 'col-lg-4 col-md-4 col-sm-4 col-lg-offset-4 col-md-offset-4 col-sm-offset-4',
                content: '¿Esta seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Registro',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= base_url('preregistro/nuevo') ?>',
                                    method: 'POST',
                                    //dataType: 'json',
                                    cache: false,
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                }).done(function(response){
                                    var r = JSON.parse(response)
                                    if(r.status == 200){
                                        toastr.success('Registro satisfactorio.')
                                        $('#nombres').val('')
                                        $('#apellidos').val('')
                                        $('#dni').val('')
                                        $('#email').val('')
                                        $('#direccion').val('')
                                        $('#telefono').val('')                                        
                                        $('#colegio').val('')
                                        $('#nombres2').val('')
                                        $('#apellidos2').val('')
                                        $('#dni2').val('')
                                        $('#email2').val('')
                                        $('#telefono2').val('')
                                    }else{
                                        toastr.error('Error en el registro consulte con su administrador')
                                    }
                                    self.close()
                                }).fail(function(){
                                    self.close()
                                    toastr.error('Ocurrio un error en el registro.')
                                })
                            }
                        })
                    },
                    no: function(){}
                }
            })
        })
    })

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
            alert("ingrese solo numero");
            return false;
        }
    }

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }

</script>