<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Caja</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Comprobantes</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<?php $prov = explode('.', $host); ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active show">
                        <a class="nav-link" data-toggle="tab" href="#comprobantes"><i class="fa fa-archive"></i> Comprobantes</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#reportes"><i class="fa fa-bars"></i> Reportes</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#notas"><i class="fa fa-bars"></i> Notas</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active " id="comprobantes">
                        <div class="panel-body">
                        	<div class="row">
                        		<div class="ibox">
                        			<div class="ibox-content center col-lg-12 col-md-12 col-sm-12">
		                        		<div class="col-lg-3 col-md-3 col-sm-3">
		                        			<label>Comprobante</label>
		                        			<select class="form-control" name="comprobante" id="tipo_comprobante">
                                                <?php if($prov[0] != 'provi'){ ?>
                                                    <option value="03">Boletas</option>
                                                    <option value="01">Facturas</option>
                                                    <?php } 
                                                    if($prov[0] == 'provi'){ ?>
                                                      <option value="99">Provisional</option>
                                                    <?php } ?>
		                        			</select>
                                            <input type="hidden" id="id_perfil" name="id_perfil" value="<?= $perfil ?>">
		                        		</div>
		                        		<div class="col-lg-3 col-md-3 col-sm-3">
		                        			<label>Desde</label>
		                        			<input type="text" class="form-control center datepicker" name="desde" id="desde" value="<?= date('d-m-Y') ?>">
		                        		</div>
		                        		<div class="col-lg-3 col-md-3 col-sm-3">
		                        			<label>Hasta</label>
		                        			<input type="text" class="form-control center datepicker" name="hasta" id="hasta" value="<?= date('d-m-Y') ?>">
		                        		</div>
		                        		<div class="col-lg-3 col-md-3 col-sm-3">
                                                <label>&nbsp;</label><br>
                                            <div>
    		                        			<button type="button" id="buscar" class="btn btn-primary" style="margin-right: 5px; border-radius: 5px"><i class="fa fa-search"></i> Buscar</button>
                                                <a href="<?= base_url('caja/emitir') ?>" class="btn btn-success" style="margin-left: 5px; border-radius: 5px" data-toogle="tooltip" data-placement="top" title="Emitir comprobante"><i class="fa fa-edit"></i> Emitir</a>
                                            </div>
		                        		</div>
		                        	</div>
		                        </div>
                        	</div>
                        	<div class="row">
                        		<div class="ibox">
                        			<div class="ibox-content">
                        				<div class="row"></div><br>
                        				<div class="row">
                        					<div class="col-lg-12 col-md-12 col-sm-12">
			                        			<div class="table-responsive">
			                        				<table class="table tabla_comprobantes display table-striped table-bordered table-hover" style="width: 100% !important;">
			                        					<thead>
			                        						<tr>
			                        							<td class="center">Comprobante</td>
			                        							<td class="center">Cliente</td>
			                        							<td class="center">Fecha</td>
			                        							<td class="center">Total</td>
			                        							<td class="center">Estado</td>
			                        							<td class="center">&nbsp;</td>
			                        						</tr>
			                        					</thead>
			                        					<tbody></tbody>
			                        				</table>
			                        			</div>
			                        		</div>
			                        	</div>
	                        		</div>
                        		</div>
                        	</div>
                        </div>
                    </div>
                    <div class="tab-pane " id="notas">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content center col-lg-12 col-md-12 col-sm-12">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Nota</label>
                                            <select class="form-control" name="comprobante" id="tipo_nota">
                                                <option value="07">Credito</option>
                                                <option value="08">Debito</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Desde</label>
                                            <input type="text" class="form-control center datepicker" name="desde" id="desde_nota" value="<?= date('d-m-Y') ?>">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Hasta</label>
                                            <input type="text" class="form-control center datepicker" name="hasta" id="hasta_nota" value="<?= date('d-m-Y') ?>">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                                <label>&nbsp;</label><br>
                                            <div>
                                                <button type="button" id="buscar_nota" class="btn btn-primary" style="margin-right: 5px; border-radius: 5px"><i class="fa fa-search"></i> Buscar</button>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="row"></div><br>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table tabla_notas display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                        <thead>
                                                            <tr>
                                                                <td>Nota</td>
                                                                <td>Comprobante</td>
                                                                <td>Cliente</td>
                                                                <td>Fecha</td>
                                                                <td>Afecto</td>
                                                                <td>Motivo</td>
                                                                <td>Detalle</td>
                                                                <td>&nbsp;</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane  " id="reportes">

                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content center">
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Desde</label>
                                            <input type="text" class="form-control center datepicker" name="desde" id="desde_reporte" value="<?= date('d-m-Y') ?>">
                                        </div>
                                        <div class="col-lg-3 col-md-3 col-sm-3">
                                            <label>Hasta</label>
                                            <input type="text" class="form-control center datepicker" name="hasta" id="hasta_reporte" value="<?= date('d-m-Y') ?>">
                                            <?php $prov = explode('.', $host);
                                            if($prov[0] == 'provi'){ $prov = 1; } else{ $prov = 0; } ?>
                                            <input type="hidden" name="provisional" id="prov_" value="<?= $prov ?>">
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-2">
                                            <label>&nbsp;</label><br>
                                            <button type="button" id="buscar_reporte" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                                        </div>
                                    </div>
                                </div>
                            </div><br>
                            <?php $prov = explode('.', $host);
                                if($prov[0] == 'provi'){ $prov_ = true; } else{ $prov_ = false; } ?>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 ibox-content">
                                    <center><h3><u>Totales</u></h3></center>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 center <?= !$prov_ ? 'col-lg-offset-2 col-md-offset-2 col-sm-offset-2' : '' ?> ">
                                    <label>Boletas</label>
                                    <h5 id="boletas"></h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 center">
                                    <label>Facturas</label>
                                    <h5 id="facturas"></h5>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 center" style="display: <?= !$prov_ ? 'none' : 'block'; ?>;">
                                    <label>Provisional</label>
                                    <h5 id="provicional"></h5>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="row"></div><br>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table tabla_reporte display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                        <thead>
                                                            <tr>
                                                                <td class="center">Comprobante</td>
                                                                <td class="center">Cliente</td>
                                                                <td class="center">Area</td>
                                                                <td class="center">Fecha</td>
                                                                <td class="center">Total</td>
                                                                <td class="center">Sede</td>
                                                                <td class="center">Usuario</td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	$(function(){

        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        });

		toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };

		var t_comprobantes = $('.tabla_comprobantes').dataTable({
          "columns": [
	            { "width": "5%" }, 
	            { "width": "35%" }, 
	            { "width": "10%" }, 
	            { "width": "20%" }, 
	            { "width": "10%" }, 
	            { "width": "20%" }, 
            ],
            order: [[ 1, "desc" ]],
            paging: true,
          "language": {
            "paginate": {
              "first": "Primera pagina",
              "last": "Ultima pagina",
              "next": "Siguiente",
              "previous": "Anterior"
            },
            "infoEmpty": "Observando 0 a 0 d 0 registros",
            "info": "Observando pagina _PAGE_ de _PAGES_",
            "lengthMenu": "Desplegando _MENU_ Registros",
            "sSearch": 'Buscador'
          },
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'print',
                    customize: function (win){
                           $(win.document.body).addClass('white-bg');
                           $(win.document.body).css('font-size', '10px');

                           $(win.document.body).find('table')
                                   .addClass('compact')
                                   .css('font-size', 'inherit');
                   },
                   className: 'btn btn-primary',
                   text: '<i class="fa fa-print"></i> Imprimir'
                }
            ]
        })

        var t_notas = $('.tabla_notas').dataTable({
          "columns": [
                { "width": "10%" }, 
                { "width": "10%" }, 
                { "width": "20%" }, 
                { "width": "10%" }, 
                { "width": "10%" }, 
                { "width": "25%" }, 
                { "width": "10%" },
                { "width": "5%" }
            ],
            order: [[ 1, "desc" ]],
            paging: true,
          "language": {
            "paginate": {
              "first": "Primera pagina",
              "last": "Ultima pagina",
              "next": "Siguiente",
              "previous": "Anterior"
            },
            "infoEmpty": "Observando 0 a 0 d 0 registros",
            "info": "Observando pagina _PAGE_ de _PAGES_",
            "lengthMenu": "Desplegando _MENU_ Registros",
            "sSearch": 'Buscador'
          },
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'print',
                    customize: function (win){
                           $(win.document.body).addClass('white-bg');
                           $(win.document.body).css('font-size', '10px');

                           $(win.document.body).find('table')
                                   .addClass('compact')
                                   .css('font-size', 'inherit');
                   },
                   className: 'btn btn-primary',
                   text: '<i class="fa fa-print"></i> Imprimir'
                }
            ]
        })

        var t_reporte = $('.tabla_reporte').dataTable({
            /*"columns": [
                { "width": "10%" }, 
                { "width": "35%" }, 
                { "width": "10%" }, 
                { "width": "10%" }, 
                { "width": "10%" }, 
                { "width": "25%" }, 
            ],*/
            order: [[ 1, "desc" ]],
            paging: true,
              "language": {
                "paginate": {
                  "first": "Primera pagina",
                  "last": "Ultima pagina",
                  "next": "Siguiente",
                  "previous": "Anterior"
                },
                "infoEmpty": "Observando 0 a 0 d 0 registros",
                "info": "Observando pagina _PAGE_ de _PAGES_",
                "lengthMenu": "Desplegando _MENU_ Registros",
                "sSearch": 'Buscador'
              },
            responsive: true,
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                {extend: 'excel', title: 'ExampleFile',className: 'btn btn-primary', text: '<i class="fa fa-file-excel"></i> Excel'},
                {extend: 'pdf', title: 'ExampleFile',className: 'btn btn-primary', text: '<i class="fa fa-file-pdf"></i> PDF'},
                {extend: 'print',
                    customize: function (win){
                           $(win.document.body).addClass('white-bg');
                           $(win.document.body).css('font-size', '10px');

                           $(win.document.body).find('table')
                                   .addClass('compact')
                                   .css('font-size', 'inherit');
                   },
                   className: 'btn btn-primary',
                   text: '<i class="fa fa-print"></i> Imprimir'
                }
            ]
        })

        var funcionalidades_botones = function(){
        	$('.table tbody tr td button.enviar').unbind('click')
        	$('.table tbody tr td button.enviar').on('click', function(){
        		var comprobante = $(this).attr('data-documento')
        		var boton = $(this)
        		$.confirm({
        			title: 'Ateción',
        			content: 'Esta seguro de realizar el envio?',
        			buttons: {
        				si: {
        					text: 'si',
        					btnClass: 'btn-primary',
        					action: function(){
        						$.confirm({
        							title: 'Enviando',
        							content: function(){
        								var self = this
        								return $.ajax({
        									url: '<?= base_url('caja/enviar') ?>',
        									method: 'POST',
        									dataType: 'json',
        									data: {
        										comprobante: comprobante
        									}
        								}).done(function(response){
        									if(response.status == 200){
        										$(boton).parent().append('<a class="btn btn-success" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver XML" href="<?= base_url() ?>caja/xml/'+comprobante+'"><i class="fa fa-file-archive"></i></a><a class="btn btn-info" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver CDR" href="<?= base_url() ?>caja/respuesta/'+comprobante+'"><i class="fa fa-check"></i></a>')
        										$(boton).remove()
        										funcionalidades_botones()
        										toastr.success('Envio satisfactorio, Aceptado')
        									}
        									else{
        										toastr.error(response.message)
        									}
        									self.close()
        								}).fail(function(){
        									toastr.error('Error, consulte con su Administrador')
        									self.close()
        								})
        							}
        						})
        					}
        				},
        				no: function(){}
        			}
        		})
        	})
        }

        t_comprobantes.on('draw.dt',function(){
            funcionalidades_botones()
        })

        $('#buscar_reporte').on('click',function(){
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('caja/consultaReporte') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            data: 1,
                            desde: $('#desde_reporte').val(),
                            hasta: $('#hasta_reporte').val(),
                            provisional: $('#prov_').val()
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            t_reporte.api().clear()
                            var comp = response.data.comprobantes
                            var boletas = 0
                            var facturas = 0
                            var provicionales = 0
                            for(var i in comp){
                                if(comp[i].cod_doc == '01')
                                    facturas = parseFloat(parseFloat(comp[i].total)+parseFloat(facturas))
                                if(comp[i].cod_doc == '03')
                                    boletas = parseFloat(parseFloat(comp[i].total)+parseFloat(boletas))
                                if(comp[i].cod_doc == '99')
                                    provicionales = parseFloat(parseFloat(comp[i].total)+parseFloat(provicionales))
                                t_reporte.fnAddData([
                                    comp[i].num_serie+'-'+comp[i].num_documento,
                                    comp[i].cliente,
                                    typeof comp[i].area == 'undefined' ? '-' : comp[i].area,
                                    comp[i].fecha,
                                    comp[i].total,
                                    comp[i].sede,
                                    comp[i].usuario
                                    ])
                            }
                            $('#boletas').html(boletas)
                            $('#facturas').html(facturas)
                            $('#provicional').html(provicionales)
                            toastr.success('Resultados encontrados')
                        }
                        else{
                            toastr.error(response.message)
                        }
                        self.close()
                    }).fail(function(){
                        toastr.error('Error, consulte con su Administrador')
                        self.close()
                    })
                }
            })
        })

		$('#buscar').on('click',function(){
			$.confirm({
				title: 'Buscando',
				content: function(){
					var self = this
					return $.ajax({
						url: '<?= base_url('caja/consultaComprobante') ?>',
						method: 'POST',
						dataType: 'json',
						data: {
							cod_doc: $('#tipo_comprobante').val(),
                            desde: $('#desde').val(),
                            hasta: $('#hasta').val()
						}
					}).done(function(response){
						if(response.status == 200){
							t_comprobantes.api().clear()
							var comp = response.data
							for(var i in comp){
								estado = ''
								opciones = '<div class="btn-group">'+($('#id_perfil').val() == '1' || $('#id_perfil').val() == '3' ? '<a class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Ver" href="<?= base_url() ?>caja/ver/'+comp[i].num_serie+'-'+comp[i].num_documento+'"><i class="fa fa-eye"></i></a>' : '')+'<a class="btn btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Imprimir" href="<?= base_url() ?>impreso/'+(comp[i].cod_doc == '99' ? 'provisional' : 'comprobante')+'/'+comp[i].num_serie+'-'+comp[i].num_documento+'"><i class="fa fa-print"></i></a>'
								switch(comp[i].estado){
									case '1':{
										estado = 'Emitido'
									}
									break;
									case '2':{
										estado = 'Enviado'
										opciones += '<a class="btn btn-success" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver XML" href="<?= base_url() ?>caja/xml/'+comp[i].num_serie+'-'+comp[i].num_documento+'"><i class="fa fa-file-archive"></i></a><a class="btn btn-info" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver CDR" href="<?= base_url() ?>caja/respuesta/'+comp[i].num_serie+'-'+comp[i].num_documento+'"><i class="fa fa-check"></i></a><button type="button" class="btn btn-danger anular" data-documento="'+comp[i].num_serie+'-'+comp[i].num_documento+'" data-toggle="tooltip" data-placement="top" title="Anular"><i class="fa fa-trash"></i></button>'
									}
									break;
									case '3':{
										estado = 'Anulado'
									}
									break;
								}
								opciones += '</div>'
								t_comprobantes.fnAddData([
									comp[i].num_serie+'-'+comp[i].num_documento,
									comp[i].cliente,
									comp[i].fecha.substring(0,10),
									comp[i].total,
									estado,
									comp[i].cod_doc == '99' ? '<div class="btn-group">'+'<a class="btn btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Imprimir" href="<?= base_url() ?>impreso/provisional/'+comp[i].num_serie+'-'+comp[i].num_documento+'"><i class="fa fa-print"></i></a>' : opciones
									])
								funcionalidades_botones()
							}
						}
						else{
							toastr.error(response.message)
						}
						self.close()
					}).fail(function(){
						toastr.error('Error, consulte con su Administrador')
						self.close()
					})
				}
			})
		})
        $('#buscar_nota').on('click',function(){
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('caja/consultaNota') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            cod_doc: $('#tipo_nota').val(),
                            desde: $('#desde_nota').val(),
                            hasta: $('#hasta_nota').val()
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            t_notas.api().clear()
                            var comp = response.data
                            for(var i in comp){
                                estado = ''
                                opciones = '<div class="btn-group">'+'<a class="btn btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Imprimir" href="<?= base_url() ?>impreso/nota/'+comp[i].num_serie+'-'+comp[i].num_documento+'"><i class="fa fa-print"></i></a></div>'
                                switch(comp[i].cod_tipo){
                                    case '01':{
                                        motivo = 'Anulación de la operación'
                                    }
                                    break;
                                    case '02':{
                                        motivo = 'Anulación por error en el RUC'
                                    }
                                    break;
                                    case '03':{
                                        motivo = 'Corrección por error en la descripción'
                                    }
                                    break;
                                    case '04':{
                                        motivo = 'Descuento global'
                                    }
                                    break;
                                    case '05':{
                                        motivo = 'Descuento por ítem'
                                    }
                                    break;
                                    case '06':{
                                        motivo = 'Devolución total'
                                    }
                                    break;
                                    case '07':{
                                        motivo = 'Devolución por ítem'
                                    }
                                    break;
                                    case '08':{
                                        motivo = 'Bonificación'
                                    }
                                    break;
                                    case '09':{
                                        motivo = 'Disminución en el valor'
                                    }
                                    break;
                                    case '10':{
                                        motivo = 'Otros Conceptos'
                                    }
                                    break;
                                }
                                t_notas.fnAddData([
                                    comp[i].num_serie+'-'+comp[i].num_documento,
                                    comp[i].nu_se+'-'+comp[i].nu_doc,
                                    comp[i].cliente,
                                    comp[i].cancelado.substring(0,10),
                                    comp[i].afecto,
                                    motivo,
                                    comp[i].detalle,
                                    opciones
                                    ])
                            }
                        }
                        else{
                            toastr.error(response.message)
                        }
                        self.close()
                    }).fail(function(){
                        toastr.error('Error, consulte con su Administrador')
                        self.close()
                    })
                }
            })
        })
	})
</script>