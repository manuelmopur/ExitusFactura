<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10 col-md-10 col-sm-10">
        <h2 class="tituloPaginaActual">Control de asistencia del alumno</h2>
    </div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
	<div class="row" id="detalle_mensaje">
		<div class="col-lg-12 col-md-12 col-sm-12">
			<div class="ibox">
				<div class="ibox-content">
					<div class="row">
						<form id="consulta">
							<div class="col-lg-6 col-lg-offset-2 col-md-6 col-md-offset-2 col-sm-6 col-sm-offset-2">
									<label>Alumno</label>
									<input type="text" class="form-control" name="campo" id="campo" placeholder="Consulte el alumno por Apellidos">
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
								<label>Tardanza</label><br>
								<input type="checkbox" class="js-switch" name="tardanza" /> 
							</div>
						</form>
					</div>
				</div>
			</div>
			<div class="ibox">
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Nombres</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="nombres"></label>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Area</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="info-area"></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Apellidos</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="apellidos"></label>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Ciclo</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="info-ciclo"></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Email</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="email"></label>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Turno</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="info-turno"></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-md-6 col-sm-6">
							<div class="col-lg-4 col-md-4 col-sm-4">
								<p>Fch. Nacimiento</p>
							</div>
							<div class="col-lg-8 col-md-8 col-sm-8">
								<label id="fch_nac"></label>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="ibox">
				<div class="ibox-content">
					<div class="row">
						<div class="col-lg-4 col-md-4 col-sm-4" id="logo-estado"></div>
						<div class="col-lg-8 col-md-8 col-sm-8" >
							<p>Información</p>
							<label id="informacion"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(function(){
		var elemn = document.querySelector('.js-switch')
		var init = new Switchery(elemn,{ color: '#1ab394' });
		/*$('.switchery').on('click',function(){
			if(elemn.checked)
				toastr.success('activado')
			else
				toastr.error('desactivado')
		})*/
		//if (init.markedAsSwitched()) { }

		busqueda = function(id_alumno,tardanza = 0){
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('admin/consultAlumnoScanner') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id_alumno: id_alumno,
                            tardanza: tardanza
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            //$('#id_alumno_input').val(id_alumno)
                            //toastr.success('')
                            console.log(response.data)
                            $('#nombres').html(response.data.alumno.nombres)
                            $('#apellidos').html(response.data.alumno.apellidos)
                            $('#info-ciclo').html(response.data.alumno.ciclo)
                            $('#info-area').html(response.data.alumno.area)
                            $('#info-turno').html(response.data.alumno.turno)
                            $('#email').html(response.data.alumno.email)
                            $('#fch_nac').html(response.data.alumno.fch_nac)
                            $('#codigo').html(response.data.alumno.codigo)
                            if(response.data.estado == 1){
                            	$('#logo-estado').html('<center><img class="img-thumbnail " width="150" src="<?= base_url('assets/assets/img/check-true-alumno.png') ?>"></center>')
                            	if(response.data.material == 'NO PAGADO'){
                            		$('#informacion').html('Alumno al dia en sus cuotas<br><p style="color:red;">Material '+response.data.material)+'</p>'
                            	}
                            	else{
                            		if(response.data.material.substring(0, 6) == 'PAGADO'){
                            			$('#informacion').html('Alumno al dia en sus cuotas<br><p style="color:green;">Material '+response.data.material)+'</p>'
                            		}
                            		else{
                            			$('#informacion').html('Alumno al dia en sus cuotas<br><p style="color:yellow;">Material '+response.data.material)+'</p>'
                            		}
                            	}                            	
                            }else{
                            	$('#logo-estado').html('<center><img class="img-thumbnail" width="150" src="<?= base_url('assets/assets/img/check-false-alumno.png') ?>"></center>')
                            	if(response.data.material == 'NO PAGADO'){
                            		$('#informacion').html('El alumno tiene una deuda de '+response.data.monto+' vencida el '+response.data.fecha+'<br><p style="color:red;">Material '+response.data.material)+'</p>'
                            	}
                            	else{
                            		if(response.data.material.substring(0, 6) == 'PAGADO'){
                            			$('#informacion').html('El alumno tiene una deuda de '+response.data.monto+' vencida el '+response.data.fecha+'<br><p style="color:green;">Material '+response.data.material)+'</p>'
                            		}
                            		else{
                            			$('#informacion').html('El alumno tiene una deuda de '+response.data.monto+' vencida el '+response.data.fecha+'<br><p style="color:yellow;">Material '+response.data.material)+'</p>'
                            		}
                            	} 
                            }
                            //$('#colegio').html(response.data.alumno.colegio)
                            /*$('#tutor').html(response.data.alumno.tutor.nombres+' '+response.data.alumno.tutor.apellidos)
                            $('#telefono_tutor').html(response.data.alumno.tutor.telefono)*/
                        }else{
                            toastr.error(response.message)
                        }
                            self.close()
                            $('#campo').val('')
                            $('#campo').focus()
                    }).fail(function(){
                        toastr.error('Error en la consulta')
                        self.close()
                    })
                }
            })
        }
		$('#campo').focus()
		$('#consulta').on('submit',function(e){
			e.preventDefault()
			var cadena = $('#campo').val()
			var cad = cadena.split(']')
			$('#campo').val(cad[1]+' - '+cad[3]+' '+cad[2])
			var tarde = elemn.checked ? 1 : 0
			console.log(tarde)
			busqueda(cad[0],tarde)
			//$.alert($('#campo').val())
		})
		$('#campo').autocomplete({
            serviceUrl: '<?= base_url('alumnos/getAlumnoAutocomplete') ?>',
            minChars: 3,
            dataType: 'text',
            type: 'POST',
            dataType: 'json',
            paramName: 'data',
            params: {
              'data': $('#alumno_busqueda').val()
            },
            onSelect: function(suggestion){
                var a = JSON.parse(suggestion.data)
                console.log(a)
				var tarde = elemn.checked ? 1 : 0
				console.log(tarde)
                busqueda(a.id_alumno,tarde)
               //$('#')
            }
        })
	})
</script>	