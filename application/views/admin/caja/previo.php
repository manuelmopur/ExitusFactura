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
			                			<h5>Cliente</h5>
			                		</div>
			                		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
			                			<label><?= $data_comprobante['cliente'] ?></label>
			                			<input type="hidden" name="persona_id" id="persona_id" value="<?= $data_comprobante['id_cliente'] ?>">
                                        <input type="hidden" name="cod_doc" id="cod_doc" value="<?= $data_comprobante['cod_doc'] ?>">
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
	            					<?php $total = 0; $gravado = 0; $inafecto = 0; $exonerado = 0; $igv = 0; 
	            					 if(isset($items)) foreach ($items as $key => $value) { ?>
	            						<tr>
	            							<td><?= substr($key, 0,5) ?></td>
	            							<td><?= $value['nombre'] ?></td>
	            							<td><?= $value['precioventa'] ?></td>
	            							<td><?= $value['cantidad'] ?></td>
	            							<td><?= $value['precioventa']*$value['cantidad'] ?></td>
	            						</tr>
	            					<?php 
	            					$t = number_format($value['precioventa']*$value['cantidad'],2,'.','');
                    $t = number_format($t - $t*$value['descuento']/100,2,'.','');
                    if($value['tipoigv'] == 1){
                      $gravado += number_format($t/1.18,2,'.','');
                      $igv += number_format($t-$t/1.18,2,'.','');
                    }
                    if($value['tipoigv'] == 2){
                      $inafecto += number_format($t,2,'.','');
                    }
                    if($value['tipoigv'] == 3){
                      $exonerado += number_format($t,2,'.','');
                    }
	            					 } ?>
	            				</tbody>
	            			</table>
	            		</div>
	            	</div>
	            	<div class="ibox-content">
	            		<div class="row">
	            			<?php $moneda = ['PEN'=>'S/','USD'=>'$','EUR'=>'€']; ?>
	            			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	            				<div style="width: 80%; float: right; border: 1px solid #000; margin-top: 10px;">
                  <table>
                    <tbody>
                      <tr>
                        <td>OP. GRAVADA</td>
                        <td><?= $moneda[$data_comprobante['moneda']] ?></td>
                        <td style="float: right;"><?= number_format($gravado,2,'.','') ?></td>
                      </tr>
                      <tr>
                        <td>OP. INAFECTA</td>
                        <td><?= $moneda[$data_comprobante['moneda']] ?></td>
                        <td style="float: right;"><?= number_format($inafecto,2,'.','') ?></td>
                      </tr>
                      <tr>
                        <td>OP. EXONERADA</td>
                        <td><?= $moneda[$data_comprobante['moneda']] ?></td>
                        <td style="float: right;"><?= number_format($exonerado,2,'.','') ?></td>
                      </tr>
                      <?php 
                      $total = number_format($gravado+$inafecto+$exonerado+$igv,2,'.','');
                       ?>
                      <tr>
                        <td>I.G.V.</td>
                        <td><?= $moneda[$data_comprobante['moneda']] ?></td>
                        <td style="float: right;"><?= number_format($igv,2,'.','') ?></td>
                      </tr>
                      <tr>
                        <td>IMPORTE A PAGAR</td>
                        <td><?= $moneda[$data_comprobante['moneda']] ?></td>
                        <td style="float: right;"><?= number_format($total,2,'.','') ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
	            			</div>
	            		</div><br>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <label>Observación</label>
                                <h5><?= $data_comprobante['observacion'] ?></h5>
                            </div>
                        </div>
	            	</div>
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
        								url: '<?= base_url('caja/generacomprobante') ?>',
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
                                            console.log(this.$content.find('.tipocomprobante'))
                                            if($('#cod_doc').val() == '99')
                                                window.open('<?= base_url() ?>impreso/provisional/'+this.$content.find('.comprobante').val(),'_blank')
                                            else
        									   window.open('<?= base_url() ?>impreso/comprobante/'+this.$content.find('.comprobante').val(),'_blank')
        									return false
        								}
        							},
        							/*impreso: {
        								text: '<i class="fa fa-file"></i> A4',
        								btnClass: 'bt btn-success',
        								action: function(){
        									window.open('<?= base_url() ?>impreso/comprobanteA4/'+this.$content.find('.comprobante').val(),'_blank')
        									return false
        								}
        							},*/
        							ok: function(){
        								window.location.href="<?= base_url('caja') ?>"
        							}
        						}
        					})
        				}
        			},
        			no: function(){}
        		}
        	})
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