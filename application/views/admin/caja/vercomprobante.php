<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Caja</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li>Caja</li>
            <li class="active"><strong>Ver comprobante</strong></li>
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
	            		<h5>Datos del comprobante</h5>
	            	</div>
	            	<div class="ibox-content">
	                	<div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Comprobante</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <label><?= $comprobante->num_serie.'-'.$comprobante->num_documento ?></label>
                                        <input type="hidden" name="cod_doc" id="cod_doc" value="<?= $comprobante->cod_doc ?>">
                                        <input type="hidden" name="num_serie" id="num_serie" value="<?= $comprobante->num_serie ?>">
                                        <input type="hidden" name="num_documento" id="num_documento" value="<?= $comprobante->num_documento ?>">
                                        <input type="hidden" name="total" id="total" value="<?= $comprobante->total ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Cliente</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <label><?= $comprobante->cod_doc == '03' ? $cliente->persona : $cliente->razon_social ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Documento</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <label><?= $cliente->nroidentificacion ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Fecha</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <label><?= $comprobante->fecha ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Monto</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <label><?= $comprobante->total ?></label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Observación</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <label><?= $comprobante->observacion ?></label>
                                    </div>
                                </div>
                            </div>
		                	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Nota</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <select class="form-control" name="doc_nota" id="nota">
                                            <option value="07">Credito</option>
                                            <option value="08">Debito</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="motivo_credito">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Motivo</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <select class="form-control" name="motivo_credito" id="motivo_credito_">
                                            <option value="01">Anulación de la operación</option>
                                              <option value="02">Anulación por error en el RUC</option>
                                              <option value="03">Corrección por error en la descripción</option>
                                              <option value="04">Descuento global</option>
                                              <option value="05">Descuento por ítem</option>
                                              <option value="06">Devolución total</option>
                                              <option value="07">Devolución por ítem</option>
                                              <option value="08">Bonificación</option>
                                              <option value="09">Disminución en el valor</option>
                                              <option value="10">Otros Conceptos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row" id="motivo_debito" style="display: none;">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                        <h5>Motivo</h5>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                        <select class="form-control" name="motivo_debito" id="motivo_debito_">
                                            <option value="01">Interes por mora</option>
                                            <option value="02">Aumento en el valor</option>
                                            <option value="03">Penalidades/Otros conceptos</option>
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
	            			<table class="table tabla-items display table-striped table-bordered table-hover" style="width: 100% !important;" cellspacing="0">
	            				<thead>
	            					<tr>
	            						<th>Codigo</th>
	            						<th>Descripción</th>
	            						<th>Precio</th>
	            						<th>Cantidad</th>
	            						<th>Total</th>
                                        <th>&nbsp;</th>
	            					</tr>
	            				</thead>
	            				<tbody>
	            					<?php $total = 0; $gravado = 0; $inafecto = 0; $exonerado = 0; $igv = 0; 
	            					 if(isset($items)) foreach ($items as $key => $value) { ?>
	            						<tr data-id="<?= $value->id ?>" data-precio="<?= $value->precio ?>" data-cantidad="<?= $value->cantidad ?>" data-igv="<?= $value->tipo_igv ?>">
	            							<td><?= $value->id ?></td>
	            							<td><?= $value->descripcion ?></td>
	            							<td><?= $value->precio ?></td>
	            							<td><?= $value->cantidad ?></td>
	            							<td><?= $value->precio*$value->cantidad ?></td>
                                            <td class="opciones"></td>
	            						</tr>
	            					<?php 
	            					$t = number_format($value->precio*$value->cantidad,2,'.','');
                    $t = number_format($t - $t*$value->descuento/100,2,'.','');
                    if($value->tipo_igv == 1){
                      $gravado += number_format($t/1.18,2,'.','');
                      $igv += number_format($t-$t/1.18,2,'.','');
                    }
                    if($value->tipo_igv == 2){
                      $inafecto += number_format($t,2,'.','');
                    }
                    if($value->tipo_igv == 3){
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
                                        <td><?= $moneda[$comprobante->moneda] ?></td>
                                        <td style="float: right;"><?= number_format($gravado,2,'.','') ?></td>
                                      </tr>
                                      <tr>
                                        <td>OP. INAFECTA</td>
                                        <td><?= $moneda[$comprobante->moneda] ?></td>
                                        <td style="float: right;"><?= number_format($inafecto,2,'.','') ?></td>
                                      </tr>
                                      <tr>
                                        <td>OP. EXONERADA</td>
                                        <td><?= $moneda[$comprobante->moneda] ?></td>
                                        <td style="float: right;"><?= number_format($exonerado,2,'.','') ?></td>
                                      </tr>
                                      <?php 
                                      $total = number_format($gravado+$inafecto+$exonerado+$igv,2,'.','');
                                       ?>
                                      <tr>
                                        <td>I.G.V.</td>
                                        <td><?= $moneda[$comprobante->moneda] ?></td>
                                        <td style="float: right;"><?= number_format($igv,2,'.','') ?></td>
                                      </tr>
                                      <tr>
                                        <td>IMPORTE A PAGAR</td>
                                        <td><?= $moneda[$comprobante->moneda] ?></td>
                                        <td style="float: right;"><?= number_format($total,2,'.','') ?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
	            			</div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="row" id="importe" style="display: none;">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Importe</label>
                                        <input type="number" step="0.01" name="importe" class="form-control" id="importe_">
                                    </div>
                                </div>
                                <div class="row" id="obs" >
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <label>Observación</label>
                                        <textarea class="form-control" name="observacion" required placeholder="Motivo de la emisión de la nota....."></textarea>
                                    </div>
                                </div>
                            </div>
	            		</div><br>
	            	</div>
	            	<div class="ibox-content">
	            		<div class="row">
	            			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	            				<div class="btn-group">
	            					<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Volver</a>
	            					<button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Generar</button>
                                    <button type="button" class="btn btn-danger" id="dar-baja" data-toggle="tooltip" data-placement="top" title="Dar de baja"><i class="fa fa-trash"></i> Anular</button>
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
        $('#nota').on('change',function(){
            if($(this).val() == '07'){
                $('#motivo_debito').hide()
                $('#motivo_credito').show()
            }else{
                $('#motivo_debito').show()
                $('#motivo_credito').hide()
            }
        })
        $('#dar-baja').on('click',function(){
            $.confirm({
              title: 'Dar de baja al comprobante',
              content: '<label>Motivo</label><input type="text" class="form-control motivo" required placeholder="Ingrese el motivo de baja">',
              buttons: {
                enviar: {
                    text: 'Enviar',
                    btnClass: 'btn-success',
                    action: function(){
                      var motivo = this.$content.find('.motivo').val()
                      //$.alert($(this).attr('data-in'))
                      $.confirm({
                        title: 'Resultado',
                        content: function(){
                              var self = this;
                              return $.ajax({
                                  url: '<?= base_url() ?>caja/baja/<?= $comprobante->num_serie.'-'.$comprobante->num_documento ?>',
                                  //dataType: 'json',
                                  method: 'POST',
                                  data: {
                                    d: 1,
                                    motivo: motivo
                                  }
                              }).done(function (response) {
                                var r = JSON.parse(response)
                                //self.setContentAppend(response);
                                if(r.status == 200){
                                    self.setContentAppend('Comprobante: '+r.data);
                                    $('#nota').hide()
                                    $('#motivo_credito').hide()
                                    $('#motivo_debito').hide()
                                    toastr.success(r.msg)
                                }else{
                                    self.close()
                                    toastr.error(r.msg)
                                }
                              }).fail(function(){
                                  self.setContentAppend('<div>Error</div>');
                              }).always(function(){
                                  //self.setContentAppend('<div>Always!</div>');
                              });
                          },
                          contentLoaded: function(data, status, xhr){
                              //self.setContentAppend('<div>Content loaded!</div>');
                          },
                          onContentReady: function(){
                              //this.setContentAppend('<div>Content ready!</div>');
                          }
                      })
                    },
                  },
                    cancelar: function(){}
                }
            })
        })
        var funcionalidades_ = function(){
            $('.tabla-items tbody tr td.opciones button.descuento').unbind('click')
            $('.tabla-items tbody tr td.opciones button.descuento').on('click',function(){
                var id_item = $(this).parent().parent().attr('data-id')
                var precio = $(this).parent().parent().attr('data-precio')
                var cantidad = $(this).parent().parent().attr('data-cantidad')
                $.confirm({
                    title: 'Descuento del item',
                    content: '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><label>Precio del item '+precio+'</label><br><label>Descuento</label><input type="number" step="0.01" class="form-control descuento"></div></div>',
                    buttons: {
                        guardar: {
                            text: 'Guardar',
                            btnClass: 'btn-success',
                            action: function(){
                                var desc = this.$content.find('.descuento').val()
                                if(desc == '' || parseInt(desc) == 0 || parseFloat(desc) >= parseFloat(precio)){
                                    toastr.error('Ingrese un monto valido')
                                    return false
                                }
                                var obj = {}
                                obj.id = id_item
                                obj.precioventa = precio
                                obj.nombre = id_item+' '+precio
                                obj.cantidad = cantidad
                                obj.descuento = desc
                                $.ajax({
                                    url: '<?= base_url() ?>caja/saveItem',
                                    type: 'POST',
                                    data: obj
                                }).done(function(){}).fail(function(){})
                            }
                        },
                        cancelar: function(){}
                    }
                })
            })
            $('.tabla-items tbody tr td.opciones button.editar').unbind('click')
            $('.tabla-items tbody tr td.opciones button.editar').on('click',function(){
                var id_item = $(this).parent().parent().attr('data-id')
                $.confirm({
                    title: 'Editar item',
                    columnClass: 'col-lg-12 col-md-12 col-sm-12',
                    content: function(){
                        var self = this
                        return $.ajax({
                            url: '<?= base_url('caja/getItemComprobante') ?>',
                            method: 'POST',
                            dataType: 'JSON',
                            data: {
                                id: id_item,
                                num_serie: $('#num_serie').val(),
                                num_documento: $('#num_documento').val()
                            }
                        }).done(function(response){
                            if(response.status == 200){
                                var med = response.data.medidas
                                var dat = response.data.item
                                var medida = '<div class="col-lg-6 col-md-6 col-sm-6"><label>Unidades</label><select class="form-control chosen-select" id="unidad1">'
                                for(var i in med)
                                    medida += '<option value="'+med[i].id+'" '+(dat.medida_id == med[i].id ? 'selected' : '')+'>'+med[i].nombre+'</option>'
                                medida += '</select></div>'
                                self.setContentAppend('<div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Descripción</label><div class="input-group col-lg-12 col-md-12 col-sm-12"><input type="text" class="form-control nombreproducto" id="nombreproducto" placeholder="Busque el producto en el catalogo..."><span class="input-group-addon codigo_catalogo" id="basic-addon1">'+dat.cod_catalogo+'</span><input type="hidden" class="form-control codigocatalogo" value="'+dat.cod_catalogo+'" disabled></div><h6 style="color: red; padding: 0px !important margin: 0px !important;">Por favor primero consulte el producto o similar en el catalogo de SUNAT*</h6><hr><textarea class="form-control" rows="10" id="descripcion">'+dat.descripcion+'</textarea></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Cantidad</label><input class="form-control" id="cantidad" type="number" value="'+dat.cantidad+'"></div>'+medida+'</div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Precio</label><input class="form-control" id="precio1" type="number" step="0.001" value="'+dat.precio+'"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Tipo</label><select class="form-control" id="tipoitem"><option value="0" '+(dat.tipo == 2 ? 'selected' : '')+'>Servicio</option><option value="1" '+(dat.tipo == 1 ? 'selected' : '')+'>Bien</option></select></div></div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Descuento 0-100%</label><input class="form-control" id="descuento2" placeholder="Ejm. 50%" type="number" value="'+dat.descuento+'"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>IGV</label><select class="form-control" id="igvs"><option value="2" '+(dat.tipo_igv == 2 ? 'selected' : '')+'>Inafecto</option><option value="1" '+(dat.tipo_igv == 1 ? 'selected' : '')+'>Gravado</option><option value="3" '+(dat.tipo_igv == 3 ? 'selected' : '')+'>Exonerado</option></select></div></div><br><div class="row"><div class="col-lg-3 col-md-3 col-sm-3"><label>Subtotal: </label><spam class="subtotal">0</spam></div><div class="col-lg-3 col-md-3 col-sm-3"><label>IGV: </label><spam class="igv">0</spam></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Total: </label><spam class="total">0</spam></div></div></div></div>')
                            }
                        }).fail(function(){
                            toastr.error('Error consulte con su Administrador')
                        })
                    },
                    buttons: {
                        guardar: {
                            text: 'Guardar',
                            btnClass: 'btn-success',
                            action: function(){
                                var obj = {}
                                obj.id = 0
                                obj.nombre = $('#descripcion').val()
                                obj.precioventa = $('#precio1').val()
                                obj.cantidad = $('#cantidad').val()
                                obj.id_medida = $('#unidad1').val()
                                obj.medida = $('#unidad1 option:selected').text()
                                obj.tipoigv = $('#igvs').val()
                                obj.descuento = $('#descuento2').val()
                                obj.tipo = $('#tipoitem').val()
                                obj.codigo_catalogo = this.$content.find('.codigocatalogo').val()
                                $.ajax({
                                    url: '<?= base_url() ?>caja/saveItem',
                                    type: 'POST',
                                    data: obj
                                }).done(function(){}).fail(function(){})
                            }
                        },
                        cancelar: function(){}
                    },
                    onContentReady: function(){
                        var nR = this
          
                          nR.$content.find('.nombreproducto').autocomplete({
                            serviceUrl: '<?= base_url('admin/') ?>searchCatalogo',
                            minChars: 4,
                            dataType: 'text',
                            type: 'POST',
                            paramName: 'data',
                            params: {
                              'data': $('#nombreproducto').val()
                            },
                            onSelect: function(suggestion){
                              var datos = JSON.parse(suggestion.data)
                              nR.$content.find('.nombreproducto').val(datos.nombre)
                              $('#descripcion').val(datos.nombre)
                              nR.$content.find('.codigocatalogo').val(datos.codigo)
                              nR.$content.find('.codigo_catalogo').html(datos.codigo)
                            },
                            onSearchStart: function(q){},
                            onSearchComplete: function(q,suggestions){}
                          })
                        $(".chosen-select").chosen({no_results_text: "Oops, nothing found!"}); 
                          var cal = function(){
                            var tol = parseFloat(parseFloat($('#cantidad').val())*parseFloat($('#precio1').val())).toFixed(2)
                            var des = parseFloat(parseFloat($('#descuento2').val())*parseFloat(tol)).toFixed(2)
                            if($('#igvs').val() == '1'){
                              nR.$content.find('.subtotal').html(parseFloat(parseFloat(parseFloat(tol)-parseFloat(des))/1.18).toFixed(2))
                              nR.$content.find('.igv').html(parseFloat(parseFloat(tol)-parseFloat(nR.$content.find('.subtotal').html())).toFixed(2))
                            }else{
                              nR.$content.find('.subtotal').html(parseFloat(tol).toFixed(2))
                              nR.$content.find('.igv').html(parseFloat(0).toFixed(2))
                            }
                            nR.$content.find('.total').html(parseFloat(parseFloat(nR.$content.find('.subtotal').html())+parseFloat(nR.$content.find('.igv').html())).toFixed(2))
                          }
                          $('#precio1, #cantidad').on('keyup',function(){
                            cal()
                          })
                          $('#igvs').on('change',function(){
                            cal()
                          })
                          cal()
                    }
                })
            })
        }
        $('#motivo_debito_').on('change',function(){
            $('#importe_').val('')
            if($('#nota').val() == '08'){
                $('.tabla-items tbody tr').each(function(index,value){
                    $(this).find('td.opciones').html('')
                })
                $('#importe').hide()
                $('#importe_').removeAttr('required')
                switch($('#motivo_debito_').val()){
                    case '01': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Importe del interes calculado.')
                    }
                    break;
                    case '02': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Importe a aumentar.')
                    }
                    break;
                    case '03': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Importe.')
                    }
                    break;
                }
            }
        })
        $('#motivo_credito_').on('change',function(){
            //console.log($(this).val())
            $('#importe_').val('')
            $('#importe_').removeAttr('required')
            if($('#nota').val() == '07'){
                $('.tabla-items tbody tr').each(function(index,value){
                    $(this).find('td.opciones').html('')
                })
                $('#importe').hide()
                switch($('#motivo_credito_').val()){
                    case '01': {}
                    break;
                    case '02': {}
                    break;
                    case '03': {
                        $('.tabla-items tbody tr').each(function(index,value){
                            $(this).find('td.opciones').append('<button type="button" class="btn btn-success editar" data-toggle="tooltip" data-placement="top" title="editar"><i class="fa fa-edit"></i></button>')
                            funcionalidades_()
                        })
                    }
                    break;
                    case '04': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Importe del descuento.')
                    }
                    break;
                    case '05': {
                        $('.tabla-items tbody tr').each(function(index,value){
                            $(this).find('td.opciones').append('<button type="button" class="btn btn-success descuento" data-toggle="tooltip" data-placement="top" title="editar"><i class="fa fa-edit"></i></button>')
                            funcionalidades_()
                        })
                    }
                    break;
                    case '06': {}
                    break;
                    case '07': {
                        $('.tabla-items tbody tr').each(function(index,value){
                            var id = $(this).attr('data-id')
                            $(this).find('td.opciones').append('<input type="checkbox" name="items[]" value="'+id+'">')
                        })
                    }
                    break;
                    case '08': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Importe de la bonificacion.')
                    }
                    break;
                    case '09': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Importe a disminuir.')
                    }
                    break;
                    case '10': {
                        $('#importe').show()
                        $('#importe_').attr('required','required')
                        $('#importe_').attr('placeholder','Ingrese el importe.')
                    }
                    break;
                }
            }
        })
        $('#item_form').on('submit',function(e){
        	e.preventDefault()
            if($('#importe_').val() != '' && parseInt($('#importe_').val()) >= parseInt($('#total').val())){
                toastr.error('Por favor ingrese un monto valido o menor que el total')
                return false
            }
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
        								url: '<?= base_url('caja/generanota') ?>',
        								method: 'POST',
        								dataType: 'json',
        								data: $('#item_form').serialize()
        							}).done(function(response){
        								if(response.status == 200){
        									var data = response.data
        									self.setContentAppend('<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><h4>Comprobante '+data.num_serie+'-'+data.num_documento+'</h4><h5>Fecha: '+data.fecha+'</h5></div></div><input type="hidden" class="comprobante" value="'+data.num_serie+'-'+data.num_documento+'"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12">'+(data.cod_doc != '99' ? '<img class="img-responsive" src="<?= base_url('/barcodes/') ?>'+data.imagen+'" style="height: 120px !important; width: auto;">' : '')+'</div></div>')
        								}
        								else{
        									toastr.error(response.message)
                                            self.close()
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
        									window.open('<?= base_url() ?>impreso/nota/'+this.$content.find('.comprobante').val(),'_blank')
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
	})
</script>