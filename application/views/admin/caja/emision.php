<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Caja</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li>Pagos</li>
            <li class="active"><strong>Emisión</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <form id="item_form" class="form-horizontal" method="post" accept-charset="utf-8" >
	    <div class="row">
	        <div class="col-lg-12 col-md-12 col-sm-12">
	        	<div class="ibox">
	        		<div class="ibox-content">
	        			<div class="row">
	        				<div class="col-lg-12 col-md-12 col-sm-12">
	        					<center><h3><?= $parameters['razon_social'] ?></h3></center>
	        				</div>
	        				<div class="col-lg-12 col-md-12 col-sm-12">
	        					<center><h3><?= $parameters['ruc'] ?></h3></center>
	        				</div>
	        			</div>
	        		</div>
	        	</div>
	            <div class="ibox">
	                <div class="ibox-title">
	                    <h5>Generar Pago - Datos del Cliente</h5>
	                </div>
	                <div class="ibox-content">
	                	<div class="row">
		                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			                	<div class="row">
			                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			                			<h5>Alumno</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			                			<label><?= $alumno->nombres.' '.$alumno->apellidos ?></label>
			                			<input type="hidden" name="persona_id" id="persona_id" value="<?= $alumno->persona_id ?>">
			                		</div>
			                	</div>
			                	<?php if(isset($alumno->nroidentificacion) && $alumno->nroidentificacion != ''){ ?>
				                	<div class="row">
				                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
				                			<h5>Documento</h5>
				                		</div>
				                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
				                			<label><?= isset($alumno->nroidentificacion) ? (strlen($alumno->nroidentificacion) == 8 ? 'DNI: ' : 'RUC: ').$alumno->nroidentificacion : '-' ?></label>
				                		</div>
				                	</div>
				                <?php } ?>
			                	<div class="row">
			                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			                			<h5>Dirección</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			                			<label><?= $alumno->direccion ?></label>
			                		</div>
			                	</div>
			                </div>
			                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			                	<div class="row">
			                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="label-razon" style="display: none;">
			                			<h5>Razon Social</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="label-razon-social"  style="display: none;">
			                			<label id="razon_social"></label>
			                			<input type="hidden" name="empresa_id" id="empresa_id" value="1">
			                		</div>
			                	</div>
			                	<div class="row">
			                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="label-ruc"  style="display: none;">
			                			<h5>RUC</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="label-ruc-identificacion" style="display: none;">
			                			<label id="ruc-iden"></label>
			                		</div>
			                	</div>
			                	<div class="row">
			                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4" id="label-direccion" style="display: none;">
			                			<h5>Dirección</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8" id="label-direccion-emp" style="display: none;">
			                			<label id="dire-emp"></label>
			                		</div>
			                	</div>
			                </div>
			            </div>
	                </div>
	            </div>
	            <div class="ibox">
	            	<div class="ibox-title">
	            		<h5>Datos del comprobante</h5>
	            	</div>
	            	<div class="ibox-content">
	                	<div class="row">
		                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			                	<div class="row">
			                		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			                			<h5>Fecha</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			                			<label><?= date('Y-m-d H:i:s') ?></label>
			                			<input type="hidden" name="fecha" id="fecha" value="<?= date('Y-m-d H:i:s') ?>">
			                		</div>
			            		</div>
			            	</div>
		                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
			                	<div class="row">
			            			<div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
			                			<h5>Comprobante</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			                			<select class="form-control" id="comprobante" name="comprobante">
			                				<?php $prov = explode('.', $host);
							                if($prov[0] == 'provi'){ ?>
							                  <option value="99">Provisional</option>
							                <?php } else {?>
								                <option value="03">Boleta</option>
				                				<option value="01">Factura</option>
			                				<?php } ?>
			                			</select>
			                		</div>
			                	</div>
			                </div>
			            </div>
	            	</div>
	            </div>
	            <div class="ibox">
	            	<div class="ibox-title">
	            		<h5>Detalles</h5>
	            	</div>
	            	<div class="ibox-content">
	            		<div class="table-responsive">
	            			<table class="table display table-striped table-bordered table-hover" style="width: 100% !important;" cellspacing="0">
	            				<thead>
	            					<tr>
	            						<th>Codigo</th>
	            						<th>Descripción</th>
	            						<th>Precio</th>
	            						<th>Cantidad</th>
	            						<th>Total</th>
	            					</tr>
	            				</thead>
	            				<tbody>
	            					<tr>
	            						<td>86131801</td>
	            						<td><?= 'Cuota N° '.$nro.' por enseñanza en '.$alumno->area.', Turno '.$alumno->turno ?></td>
	            						<td><?= $cuota->Monto ?></td>
	            						<td><?= 1 ?></td>
	            						<td><?= $cuota->Monto ?></td>
	            					</tr>
	            				</tbody>
	            			</table>
	            		</div>
	            	</div>
	            	<div class="ibox-content">
	            		<div class="row">
	            			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>Op. Gravada</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<label id="label-op_gravada">S/ <?= number_format($cuota->Monto,2,'.','') ?></label>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>Op. Exonerada</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<label id="label-op_exonerada">S/ <?= number_format(0,2,'.','') ?></label>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>Subtotal</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<label id="label-subtotal">S/ <?= number_format($cuota->Monto,2,'.','') ?></label>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>IGV</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<label id="label-igv">S/ <?= number_format(0,2,'.','') ?></label>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>Descuento</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<label id="label-descuento">S/ 0.00</label>
	            					</div>
	            				</div>
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>Total</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<label id="label-total">S/ <?= number_format($cuota->Monto,2,'.','') ?></label>
	            					</div>
	            				</div>
	            			</div>
	            			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            				<div class="row">
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<h5>Descuento</h5>
	            					</div>
	            					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            						<input type="number" step="0.00" class="form-control" id="descuento" name="descuento" placeholder="Ingrese monto">
	            					</div>
	            				</div>
	            			</div>
	            		</div>
	            	</div>
	            	<input type="hidden" name="id_cuota" id="id_cuota" value="<?= $cuota->id ?>">
	            	<input type="hidden" name="total" id="total" value="<?= $cuota->Monto ?>">
	            	<input type="hidden" name="efectivo" id="efectivo" value="<?= $cuota->Monto ?>">
	            	<div class="ibox-content">
	            		<div class="row">
	            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            				<div class="btn-group">
	            					<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Volver</a>
	            					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Generar</button>
	            				</div>
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
        $('#descuento').on('keyup',function(){
        	var monto_descuento = parseFloat($(this).val())
        	var total = parseFloat($('#total').val())
        	if(monto_descuento > total){
        		toastr.error('Ingrese un monto menor al total')
        		return false
        	}
        	var nuevo_total = parseFloat(parseFloat(total)-parseFloat(monto_descuento)).toFixed(2)
        	$('#efectivo').val(nuevo_total)
        	$('#label-total').html('S/ '+nuevo_total)
        	$('#label-descuento').html('S/ '+parseFloat(monto_descuento).toFixed(2))
        	$('#label-subtotal').html('S/ '+parseFloat(parseFloat(nuevo_total)/1.18).toFixed(2))
        	$('#label-igv').html('S/ '+parseFloat(parseFloat(nuevo_total)-parseFloat(nuevo_total)/1.18).toFixed(2))
        })
        $('#item_form').on('submit',function(e){
        	e.preventDefault()
        	$.confirm({
        		title: 'Atención',
        		content: 'Esta seguro de los datos ingresados?',
        		buttons: {
        			si: {
        				text: 'si',
        				btnClass: 'btn-success',
        				action: function(){
        					//$('#item_form').unbind('submit').submit()
        					$.confirm({
        						title: 'Emitir comprobante',
        						content: function(){
        							var self = this
        							return $.ajax({
        								url: '<?= base_url('caja/pagarcuota/').$cuota->id."/".$nro ?>',
        								method: 'POST',
        								dataType: 'json',
        								data: $('#item_form').serialize()
        							}).done(function(response){
        								if(response.status == 200){
        									var data = response.data
        									self.setContentAppend('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h4>Comprobante '+data.num_serie+'-'+data.num_documento+'</h4><h5>Fecha: '+data.fecha+'</h5></div></div><input type="hidden" class="tipocomprobante" value="'+data.cod_doc+'"><input type="hidden" class="comprobante" value="'+data.num_serie+'-'+data.num_documento+'"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12">'+(data.cod_doc != '99' ? '<img class="img-responsive" src="<?= base_url('/barcodes/') ?>'+data.imagen+'" style="height: 120px !important; width: auto;">' : '')+'</div></div>')
        								}
        								else{
        									toastr.error(response.message)
        								}
        								//self.close()
        							}).fail(function(){
        								toastr.error('Error en la emisión consulte con su Administrador')
        								self.close()
        							})
        						},
        						buttons: {
        							imprimir: {
        								text: '<i class="fa fa-print"></i> Imprimir',
        								btnClass: 'btn btn-success',
        								action: function(){
        									if($('#comprobante').val() == '99')
        										window.open('<?= base_url() ?>impreso/provisional/'+this.$content.find('.comprobante').val(),'_blank')
        									else
        										window.open('<?= base_url() ?>impreso/comprobante/'+this.$content.find('.comprobante').val(),'_blank')
        									return false
        								}
        							},
        							<?php $prov = explode('.', $host);
							            if($prov[0] != 'provi'){ ?>
	        							impreso: {
	        								text: '<i class="fa fa-file"></i> A4',
	        								btnClass: 'bt btn-success',
	        								action: function(){
	        									window.open('<?= base_url() ?>impreso/comprobanteA4/'+this.$content.find('.comprobante').val(),'_blank')
	        									return false
	        								}
	        							},
	        						<?php } ?>
        							ok: function(){
        								window.location.href="<?= base_url('alumnos') ?>"
        							}
        						}
        					})
        				}
        			},
        			no: function(){}
        		}
        	})
        })
		$('#comprobante').on('change',function(){
			if($(this).val() == '01'){
				$.confirm({
					title: 'Consulta RUC',
					content: '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><label>Ingrese RUC para el comprobante</label><input class="form-control ruc" type="text" name="ruc"></div></div>',
					buttons: {
						buscar: {
							text: 'BUSCAR',
							btnClass: 'btn btn-primary',
							action: function(){
								var ruc = this.$content.find('.ruc').val()
								if(ruc == ''){
									toastr.error('Ingrese un dato valido.')
									return false
								}
								$.confirm({
									title: 'Buscando',
									content: function(){
										var self = this
										return $.ajax({
											url: '<?= base_url('caja/consultaRuc') ?>',
											method: 'POST',
											dataType: 'json',
											data: {
												ruc: ruc
											}
										}).done(function(response){
											//console.log(response)
											if(response.status == 200){
												var data = response.data
												$('#label-razon').show('slow')
												$('#label-razon-social').show('slow')
												$('#razon_social').html(data.RazonSocial)
												$('#label-ruc').show('slow')
												$('#label-ruc-identificacion').show('slow')
												$('#ruc-iden').html(data.RUC)
												$('#label-direccion').show('slow')
												$('#label-direccion-emp').show('slow')
												$('#dire-emp').html(data.Direccion)
												$('#empresa_id').val(data.id)
												$('#persona_id').val(1)
												toastr.success('Datos encontrados.')
											}
											else{
												toastr.error('Error en la consulta')
											}
											self.close()
										}).fail(function(){
											self.close()
											toastr.error('Error, consulte con su Administrador')
										})
									}
								})
							}
						},
						cancelar: function(){
							$('#comprobante').val('03')
						}
					}
				})
				//$('#datos_ruc').show('slow')
			}
			else{
				$('#datos_ruc').hide('slow')
			}
		})
		var t = $('.table').dataTable({
          /*"columns": [
	            { "width": "10%" }, 
	            { "width": "10%" }, 
	            { "width": "10%" }, 
	            { "width": "50%" }, 
	            { "width": "10%" }, 
	            { "width": "10%" }, 
            ],
            order: [[ 1, "desc" ]],*/
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
        })
	})
</script>