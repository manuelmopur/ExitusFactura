<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Inscribir Alumno</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li>Pre-Inscripcion</li>
            <li class="active"><strong>Inscripcion</strong></li>
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
                            <input type="hidden" name="pago_id" id="pago_id" value="0">
                            <input type="hidden" name="codigo" id="codigo" value="0">
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
	                		<input type="email" class="form-control" name="email" placeholder="email@emai.com" value="<?= isset($alumno) ? $alumno->email : '' ?>" required>
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
	                		<input type="text" class="form-control datepicker" name="fch_nac" value="<?= isset($alumno) ? $alumno->fch_nac : '' ?>">
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
                                <label class="col-sm-5 control-label campoObligatorio"><input type="radio" required name="turno" class="input-turno" value="<?= $value->id ?>" <?= $value->id == $alumno->turno_id ? 'checked' : '' ?>>&nbsp;<?= $value->descripcion ?>&nbsp;</label>
                        <?php } ?>
                        <?php if(!isset($alumno)) foreach ($turnos as $key => $value) { ?>
                                <label class="col-sm-5 control-label campoObligatorio"><input type="radio" required name="turno" class="input-turno" value="<?= $value->id ?>">&nbsp;<?= $value->descripcion ?>&nbsp;</label>
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
                        <label class="col-sm-3 control-label campoObligatorio">Fecha de Inicio de Grupo*</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control datepicker" name="grupo" required value="">
                        </div>  
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label campoObligatorio">Fecha de Fin de Grupo*</label>
                        <div class="col-lg-9 col-md-9 col-sm-9">
                            <input type="text" class="form-control datepicker" name="grupo_fin" required value="">
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
                <div class="ibox-title">
                    <h5>Datos de Pago</h5>
                </div>
                <div class="ibox-content">
                    <div class="row center">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <label>Monto</label>
                            <input type="text" name="monto" class="form-control center" required id="monto" placeholder="000.00">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <label>Material y Carnet</label>
                            <input type="text" name="material" class="form-control center" maxlength="2" id="material" placeholder="000.00">
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <label>Fecha de Pago</label>
                            <input type="text" class="form-control datepicker center" name="fch_pago" value="<?= date('d-m-Y') ?>">
                        </div>
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <label class="col-lg-12 col-md-12 col-sm-12"><u>Tipo de Pago</u></label>
                            <label><input type="radio" required name="tipo_pago" id='contado' value="1"> Contado</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" required name="tipo_pago" id='credito' value="0"> Credito</label>&nbsp;&nbsp;&nbsp;&nbsp;
                            <label><input type="radio" required name="tipo_pago" id='becado' value="0"> Becado Sin Pago Inicial</label>
                        </div>                         
                    </div><br>
                    <div id='fila_cuotas' class="row center" hidden>
                        <div id='cuotas' class="col-lg-2 col-md-2 col-sm-2">
                            <label>Cuotas</label>
                            <select class="form-control" name="lcuotas" id="lcuotas">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                            </select>                            
                        </div>                      
                        <div id = ini class="col-lg-2 col-md-2 col-sm-2" hidden>
                            <label class="center">Inicial</label>
                            <input type="text" name="inicial" class="form-control center" id="inicial" placeholder="000.00">
                        </div> 
                        <div id='cuota' class="col-lg-8 col-md-8 col-sm-8 center">                        
                        </div>                     
                    </div><br>                    
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <label>Observacion</label>
                            <textarea class="form-control" name="observacion" placeholder="Ingrese una observación..."></textarea>
                        </div>
                    </div><br>
                    <div class="row" id="boton_inscribir">
                        <div class="col-lg-2 col-md-2 col-sm-2">
                            <center>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Inscribir</button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php if(!is_numeric($imagenes)){ ?>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Imagenes comprobantes</h5>
                    </div>
                    <?php if(!is_numeric($imagenes)) foreach ($imagenes as $key => $value) { ?>
                        <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="ibox-content product-box">
                                <center>
                                    <img src="<?= base_url('imgs/'.$value->file) ?>" width="200">
                                </center>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>
    </form>
</div>

<script type="text/javascript">
    function initControls(){
        window.location.hash="red";
        window.location.hash="Red" //chrome
        window.onhashchange=function(){window.location.hash="red";}
    }
	$(function(){
        <?php if(isset($alumno) && $alumno->estado_alumno == 1){ ?>
            $.alert({
                title: 'Atención',
                content: 'El alumno ya se encuentra registrado con el codigo: <?= $alumno->cod_alumno ?>',
                buttons: {
                    ok: {
                        text: 'Esta bien',
                        btnClass: 'btn btn-success',
                        action: function(){
                            window.location.href="<?= base_url('preinscripcion') ?>"
                        }
                    }
                }
            })
        <?php } ?>
		toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        $('select#lcuotas').on('click',function(){
            $('#boton_inscribir').show()
            $("#cuota").html('')
            var valor = $(this).val()
            for(var i=0; i<valor;i++){
                var fieldHTML = '<div class="col-lg-3 col-md-3 col-sm-3"><label>Cuota '+(i+1)+'</label><input type="text" class="form-control center" required id="monto_'+(i+1)+'" name="monto_'+(i+1)+'" placeholder="000.00"><input type="text" class="form-control center datepicker" required id="fecha_'+(i+1)+'" name="fecha_'+(i+1)+'" placeholder="<?= date('d-m-Y') ?>"></div>' //New input field html  
                $('#cuota').append(fieldHTML); // Add field html
                $('.datepicker').datepicker({
                    format: 'dd-mm-yyyy'
                });
            }
            
        });
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });
        $('input[type=radio]').on('click',function(){
            $('#inicial').val('')
            if($('#credito').is(':checked')){
                $('#fila_cuotas').show()
                $('#ini').show()
                $('#inicial').attr('required','required')
                $('#inicial').removeAttr('readonly')
                $('#boton_inscribir').hide()
            }
            if($('#contado').is(':checked')){
                $('#fila_cuotas').hide()
                $('#ini').hide()
                $('#inicial').removeAttr('readonly')
                $('#boton_inscribir').show()
                $('#inicial').removeAttr('required')
            }
            if($('#becado').is(':checked')){
                $('#fila_cuotas').show()
                $('#ini').show()
                $('#inicial').removeAttr('required')
                $('#inicial').val('0')
                $('#inicial').attr('readonly','readonly')
                $('#boton_inscribir').hide()
            }
        })        
		$('#item_form').on('submit',function(e){
			e.preventDefault()
            if($('#becado').is(':checked') || $('#credito').is(':checked')){
                    //aqui valido los montos
                var total = 0
                var cuotas = parseInt($('#lcuotas').val())

                for (var i = 1; i <= cuotas; i++) {
                    total = parseInt(total)+parseInt($('#monto_'+i).val())
                }

                total = parseInt(total)+parseInt($('#inicial').val())

            if ( !$('#contado').is(':checked') && total != parseInt($('#monto').val()) ) {
                $.alert({
                    title : 'ALERTA',
                    content : 'REVISAR LAS CUOTAS <br> monto = '+$('#monto').val()+'<br>inicial + cuotas = '+ total,

                        buttons : {
                            ok : function(){}
                        }

                    })
                    //toastr.error('ESCRIBRE BIEN LOS MONTOS CTM')
                    return false
                }
                console.log(total)
                console.log($('#monto').val())
                //aqui termino de kgarla
            }
            

			var data = $('#item_form').serialize()
            $.confirm({
                title: 'Atención',
                content: '¿Estás seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Inscribiendo',
                            columnClass: 'large',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= isset($alumno) ?  base_url('preinscripcion/inscribir/').$alumno->id_alumno : base_url('preinscripcion/nuevo') ?>',
                                    method: 'post',
                                    dataType: 'JSON',
                                    data: data
                                }).done(function(response){
                                    if(response.status == 200){
                                        toastr.success('Inscripcion Satisfactoria')              
                                        var data = response.data
                                        $('#persona_id').val(data.persona_id)  
                                        $('#alumno_id').val(data.alumno_id)           
                                        $('#pago_id').val(data.pago_id)
                                        $('#codigo').val(data.codigo)          
                                        var matricula = ''
                                        if(typeof data.matricula[0] === 'object'){
                                            var courses = data.matricula
                                            for(var i in courses){
                                                matricula += '<li>'+courses[i].fullname+'</li>'
                                            }
                                        }
                                        //setTimeout(function(){window.location.href = '<?= base_url('preinscripcion') ?>'},2500)
                                        self.setContentAppend(('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h3>Cursos Inscritos</h3><ol>'+matricula+'</ol></div></div>')+'<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h3>Generar Comprobante</h3></div></div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6">Datos Cliente</div></div><div class="row"><div class="col-lg-3 col-md-3 col-sm-3"><h5>Nombres</h5></div><div class="col-lg-9 col-md-9 col-sm-9">'+($('#nombres_alumno').val()+' '+$('#apellidos_alumno').val())+'</div></div><div class="row"><div class="col-lg-3 col-md-3 col-sm-3"><h5>Documento</h5></div><div class="col-lg-9 col-md-9 col-sm-9">'+($('#dni_alumno').val())+'</div></div><div class="row"><div class="col-lg-3 col-md-3 col-sm-3"><h5>Dirección</h5></div><div class="col-lg-9 col-md-9 col-sm-9">'+($('#direccion_alumno').val())+'</div></div><div class="row"><div class="col-lg-12 col-md-12 col-sm-12">Datos del Comprobante</div></div><div class="row"><div class="col-lg-9 col-md-9 col-sm-9"><label>'+($('#contado').is(':checked') ? ''+$('#area option:selected').text().toUpperCase()+($('#material').val() != '' && parseInt($('#material').val()) != 0 ? ' + M/C' : '') : 'INICIAL '+$('#area option:selected').text().toUpperCase()+($('#material').val() != '' && parseInt($('#material').val()) != 0 ? ' + M/C' : ''))+'</label></div><div class="col-lg-3 col-md-3 col-sm-3"><h5>'+($('#credito').is(':checked') ? parseFloat($('#inicial').val()).toFixed(2) : parseFloat(parseFloat($('#monto').val())+parseFloat($('#material').val() == '' ? 0 : $('#material').val())).toFixed(2))+'</h5></div></div>'+( !$('#becado').is(':checked') ? '<div class="row"><div class="col-lg-3 col-md-3 col-sm-3"><label>Comprobante</label><select name="comprobante_emitir" id="comprobante_emitir" class="form-control comprobante_emitir"><option value="03">Boleta</option><option value="01">Factura</option></select></div><div class="col-lg-7 col-md-7 col-sm-7 input-group consulta_ruc" id="consulta_ruc" style="display: none;"><label>Cliente</label><input type="hidden" class="id_cliente_consulta" value="1"><input type="text" name="cliente" required class="form-control input_cliente" disabled id="input_cliente" placeholder="Busque por RUC o Razon Social"></div><div class="col-lg-1 col-md-1 col-sm-1 consulta_ruc_boton" style="display: none;"><label>&nbsp;</label><br><button class="btn btn-success button_consulta_ruc" type="button" id="consulta_"><i class="fa fa-search"></i> SUNAT</button></div></div>' : '' ))
                                        initControls();
                                    }                                    
                                    else{
                                        toastr.error('Error')
                                    }
                                    //self.close()
                                }).fail(function(){
                                    toastr.error('Error en la Inscripcion consulte con su administrador')
                                    self.close()
                                })
                            },
                            buttons: {
                                ok: {
                                    text: 'ok',
                                    action: function(){
                                        window.location.href = '<?= base_url('alumnos') ?>'
                                    }
                                },
                                ficha:{
                                    text: 'ficha',
                                    action: function(){
                                        window.open('<?= base_url() ?>alumnos/ficha/'+$('#codigo').val(),'_blank')
                                        return false
                                    }
                                },
                                genera: {
                                    text: 'generar',
                                    btnClass: 'btn-primary',
                                    action: function(){
                                        var self3 = this
                                        if(this.$content.find('.comprobante_emitir').val() == '01' && this.$content.find('.id_cliente_consulta').val() == '1'){
                                            toastr.error('Debe consultar el RUC para emitir el comprobante')
                                            return false
                                        }
                                        var comprobante = this.$content.find('.comprobante_emitir').val()
                                        var empresa_id = this.$content.find('.id_cliente_consulta').val()
                                        $.confirm({
                                            title: 'Emitir comprobante',
                                            columnClass: 'medium',
                                            content: function(){
                                                var self2 = this
                                                var monto = 0
                                                if($('#credito').is(':checked'))
                                                    monto = parseFloat(parseFloat($('#inicial').val() == '' ? 0 : $('#inicial').val())+parseFloat($('#material').val() == '' ? 0 : $('#material').val())).toFixed(2)
                                                else
                                                    monto = parseFloat(parseFloat($('#monto').val() == '' ? 0 : $('#monto').val())+parseFloat($('#material').val() == '' ? 0 : $('#material').val())).toFixed(2)
                                                return $.ajax({
                                                    url: '<?= base_url('caja/emitecomprobante') ?>',
                                                    method: 'POST',
                                                    dataType: 'json',
                                                    data: {
                                                        comprobante: comprobante,//has el on contentReady porque falta consultar el RUC
                                                        empresa_id: empresa_id,
                                                        persona_id: $('#persona_id').val(),
                                                        alumno_id: $('#alumno_id').val(),
                                                        pago_id: $('#pago_id').val(),
                                                        efectivo: monto,
                                                        total: monto,
                                                        concepto: $('#contado').is(':checked') ? 'Matricula completa en el area de '+$('#area option:selected').text()+($('#material').val() != '' ? ' y Material' : '') : 'Inicial de la matricula en el area de '+$('#area option:selected').text()+($('#material').val() != '' ? ' y Material' : '')
                                                    }
                                                }).done(function(response){
                                                    if(response.status == 200){
                                                        var data = response.data
                                                        self2.setContentAppend('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h4>Comprobante '+data.num_serie+'-'+data.num_documento+'</h4><h5>Fecha: '+data.fecha+'</h5></div></div><input type="hidden" class="comprobante" value="'+data.num_serie+'-'+data.num_documento+'"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><img class="img-responsive" src="<?= base_url('/barcodes/') ?>'+data.imagen+'" style="height: 120px !important; width: auto;"></div></div>')
                                                    }
                                                    else{
                                                        toastr.error(response.message)
                                                    }
                                                }).fail(function(){
                                                    toastr.error('Error en la emisión consulte con su Administrador')
                                                    self2.close()
                                                })
                                            },
                                            buttons: {
                                                xml: {
                                                    text: '<i class="fa fa-file-archive"></i> XML',
                                                    btnClass: 'btn btn-primary',
                                                    action: function(){
                                                        window.open('<?= base_url() ?>caja/xml/'+this.$content.find('.comprobante').val(),'_blank')
                                                        return false
                                                    }
                                                },
                                                ficha2: {
                                                    text: '<i class="fa fa-id-card"></i> Ficha',
                                                    btnClass: 'btn btn-success',
                                                    action: function(){
                                                        window.open('<?= base_url() ?>alumnos/ficha/'+$('#alumno_id').val(),'_blank')
                                                        return false
                                                    }
                                                },
                                                imprimir: {
                                                    text: '<i class="fa fa-print"></i> Imprimir',
                                                    btnClass: 'btn btn-success',
                                                    action: function(){
                                                        window.open('<?= base_url() ?>impreso/comprobante/'+this.$content.find('.comprobante').val(),'_blank')
                                                        return false
                                                    }
                                                },
                                                impreso: {
                                                    text: '<i class="fa fa-file"></i> A4',
                                                    btnClass: 'bt btn-success',
                                                    action: function(){
                                                        window.open('<?= base_url() ?>impreso/comprobanteA4/'+this.$content.find('.comprobante').val(),'_blank')
                                                        return false
                                                    }
                                                },
                                                ok: function(){
                                                    window.location.href="<?= base_url('preinscripcion') ?>"
                                                }
                                            }
                                        })
                                    }
                                }
                            },
                            contentLoaded: function(){
                                var id_input_cliente = this.$content.find('.id_cliente_consulta')
                                /*this.$content.find('.input_cliente').autocomplete({
                                      serviceUrl: '<?= base_url() ?>admin/autocompletecliente',
                                      minChars: 5,
                                      dataType: 'json',
                                      type: 'POST',
                                      paramName: 'data',
                                      params: {
                                        'data': $(this).val(),
                                        'cod_doc': '01'
                                      },
                                      onSelect: function(suggestion){
                                        var datos = suggestion.data
                                        $(id_input_cliente).val(datos.id)
                                        //$('#id_direccion').val(datos.direccion)
                                        /*$('#idPersona').val(datos.id)
                                      },
                                      onSearchStart: function(q){},
                                      onSearchComplete: function(q,suggestions){}
                                    })*/
                            },
                            onContentReady: function(){
                                if($('#becado').is(':checked')){
                                    this.buttons.genera.hide()
                                }else{
                                    this.buttons.ok.hide()
                                    this.buttons.ficha.hide()
                                }
                                var busq = this.$content.find('.consulta_ruc')
                                var busqb = this.$content.find('.consulta_ruc_boton')
                                var input_cliente = this.$content.find('.input_cliente')
                                var id_input_cliente = this.$content.find('.id_cliente_consulta')
                                this.$content.find('.comprobante_emitir').on('change',function(){
                                    if($(this).val() == '01'){
                                        $(busq).show()
                                        $(busqb).show()
                                    }
                                    else{
                                        $(busq).hide()
                                        $(busqb).hide()
                                    }
                                })
                                //$(input_cliente)
                                this.$content.find('.button_consulta_ruc').on('click', function(){
                                    $.confirm({
                                        title: 'Consulta Sunat',
                                        content: '<label>Ingrese RUC</label><input id="consulta_documento" placeholder="12345678912" type="text" class="form-control consulta_documento">',
                                        buttons: {
                                          buscar: function(){
                                            var documento = this.$content.find('.consulta_documento').val()
                                            $.confirm({
                                              title: 'Realizando consulta',
                                              content: function(){
                                                var selfconsulta = this
                                                return $.ajax({
                                                  url: '<?= base_url() ?>admin/buscaComprobante',
                                                  type: 'POST',
                                                  dataType: 'json',
                                                  data: {
                                                    documento: documento,
                                                    cod_doc: '01'
                                                  }
                                                }).done(function(response){
                                                  if(response.status == 200){
                                                    var d = response.data
                                                        $.alert({
                                                            title: 'Econtrado',
                                                            columnClass: 'medium',
                                                            content: '<label>Razon Social: &nbsp;&nbsp;</label>'+d.razon_social+'<br>'+
                                                                '<label>RUC: &nbsp;&nbsp;&nbsp;&nbsp;</label>'+d.ruc+'<br>'+
                                                                '<label>Direccion: &nbsp;&nbsp;</label>'+d.direccion+''
                                                        })
                                                      $(id_input_cliente).val(response.id)
                                                      $(input_cliente).val(d.ruc+' - '+d.razon_social)
                                                      //$('#id_direccion').val(d.direccion)
                                                      toastr.success('Consulta satisfactoria')
                                                      selfconsulta.close()
                                                  }
                                                  else{
                                                    toastr.error(response.message)
                                                    selfconsulta.close()
                                                  }
                                                }).fail(function(){
                                                  toastr.error('Error, Consulte con su administrador')
                                                  selfconsulta.close()
                                                })
                                              }
                                            })
                                          },
                                          cancelar: function(){}
                                        }
                                      })
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
            //alert("ingrese solo numero");
            return false;
        }
    }

    function mayus(e) {
        e.value = e.value.toUpperCase();
    }
</script>