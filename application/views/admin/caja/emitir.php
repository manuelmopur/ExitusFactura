
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Caja</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="">Comprobantes</li>
            <li class="active"><strong>Emitir</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <form method="post" id="generar_comprobante">
    <div class="col-lg-12 col-md-12 col-sm-12">
      <div class="ibox">
        <div class="ibox-title">
          <h5>Elaboración de comprobante</h5>
        </div>
        <div class="ibox-content">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
              <label>Tipo de comprobante</label>
              <?php $prov = explode('.', $host); ?>
              <select class="form-control" name="cod_doc" id="cod_doc">
                <?php if($prov[0] != 'provi'){ ?>
                <option value="03">Boleta</option>
                <option value="01">Factura</option>
                <?php } 
                if($prov[0] == 'provi'){ ?>
                  <option value="99">Provisional</option>
                <?php } ?>
              </select>
            </div>
            <div class="col-lg-7 col-md-7 col-sm-7">
              <label>Cliente</label>
              <div class="input-group col-lg-12 col-md-12 col-sm-12">
                <input type="text" name="cliente" required class="form-control" id="input_cliente" placeholder="Busque por DNI o Apellidos" value="<?= isset($alumno) ? $alumno->persona : '' ?>">
                <div class="input-group-btn">
                  <button class="btn btn-success" style="margin: 0 10px;" type="button" id="nuevo_cliente"><i class="fa fa-plus"></i></button>
                  <button class="btn btn-default" type="button" id="consulta_" style="display: none;">
                    <img width="15" height="15" id="logo_cliente" src="<?php echo base_url() ?>assets/assets/img/reniec_logo.png">
                  </button>
                </div>
              </div>
              <input type="hidden" name="id_cliente" value="0" id="id_cliente">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2">
              <label>Fecha <i class="fa fa-calendar"></i></label>
              <input type="text" name="fecha" required class="form-control datepicker" value="<?php echo date('d-m-Y') ?>">
            </div>
            <input type="hidden" name="band" id="band">
            <div class="col-lg-8 col-md-8 col-sm-8">
              <div class="form-group">
                <label>Producto <i class="fa fa-search"></i></label>
                <div class="input-group  col-lg-12 col-md-12 col-sm-12">
                  <input type="text" name="producto" class="form-control" id="productoautocomplete" placeholder="Busque producto o Servicio">
                  <span class="input-group-btn">
                    <button class="btn btn-primary" style="margin: 0 10px;" type="button" id="listar"><i class="fa fa-fw fa-angle-down"></i> Listar</button>
                    <button class="btn btn-success" type="button" id="agregar"><i class="fa fa-plus"></i> Agregar</button>
                  </span>
                </div>
              </div>
              <input type="hidden" name="id" id="id">
              <input type="hidden" name="precio" id="precio">
              <input type="hidden" name="unidad" id="unidad">
              <input type="hidden" name="id_medida" id="id_medida">
              <input type="hidden" name="nombre" id="nombre">
              <input type="hidden" name="tipo" id="tipo">
              <input type="hidden" name="codigo_catalogo" id="cod_catalogo">
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nombre</th>
                      <th>Unidad</th>
                      <th>Cantidad</th>
                      <th>Precio</th>
                      <th>Descuento</th>
                      <th>Total</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if($items) foreach ($items as $key => $value) { ?>
                      <tr>
                        <td><?= is_numeric($value) ? $value['id'] : substr($value['id'], 0,4) ?></td>
                        <td><?= $value['nombre'] ?></td>
                        <td><?= $value['medida'] ?></td>
                        <td><?= $value['cantidad'] ?></td>
                        <td><?= number_format($value['precioventa'],2,'.','') ?></td>
                        <td><?= $value['descuento'] ?></td>
                        <td><?= $value['cantidad']*$value['precioventa']-$value['cantidad']*$value['precioventa']*$value['descuento']/100 ?></td>
                        <td>
                          <div class="btn-group">
                            <button class="btn btn-success editar" data-in="<?= $value['id'] ?>" type="button"><i class="fa fa-edit"></i></button>
                            <button class="btn btn-danger eliminar" data-in="<?= $value['id'] ?>" type="button"><i class="fa fa-trash"></i></button>
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div style="width: 80%; float: right; border: 1px solid #000; margin-top: 10px;">
                <table id="totales">
                  <tbody>
                    <tr>
                      <td>OP. GRAVADA</td>
                      <td class="moneda">S/</td>
                      <td style="float: right;" id="op-g"><?php echo number_format(0,2) ?></td>
                    </tr>
                    <tr>
                      <td>OP. INAFECTA</td>
                      <td class="moneda">S/</td>
                      <td style="float: right;" id="op-i">0.00</td>
                    </tr>
                    <tr>
                      <td>OP. EXONERADA</td>
                      <td class="moneda">S/</td>
                      <td style="float: right;" id="op-e">0.00</td>
                    </tr>
                    <tr>
                      <td>I.G.V.</td>
                      <td class="moneda">S/</td>
                      <td style="float: right;" id="igv"><?php echo number_format(0,2) ?></td>
                    </tr>
                    <tr>
                      <td>IMPORTE A PAGAR</td>
                      <td class="moneda">S/</td>
                      <td style="float: right;" id="total"><?php echo number_format(0,2) ?></td>
                      <input type="hidden" name="total" id="total-in">
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <div class="row">
                <div class="col-lg-5 col-md-5 col-sm-5">
                  <div class="form-group">
                    <label>Metodo Pago</label>
                    <select class="form-control" name="pago">
                      <option value="1">Efectivo</option>
                      <option value="2">Trj. Debito</option>
                      <option value="3">Trj. Credito</option>
                      <option value="4">Transferencia/Deposito</option>
                      <!--option value="5">Efectivo-Tarjeta</option-->
                    </select>
                  </div>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5">
                  <div class="form-group">
                    <label>Moneda</label>
                    <select class="form-control" name="moneda" id="moneda">
                      <option value="PEN">Nuevo Sol Peruano</option>
                      <option value="USD">Dólar Estadounidense</option>
                      <option value="EUR">Euro</option>
                    </select>
                  </div>
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10">
                  <div class="form-group">
                    <label>Observación</label>
                    <textarea class="form-control" name="observacion"></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <br>
          <div class="row">
            <center>
              <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
            </center>
          </div>
        </div>
      </div>
    </div>
  </form>
  </div>
</div>
<script type="text/javascript">
  $(function(){
    var base_url = '<?php echo base_url() ?>'
    toastr.options = {
        closeButton: true,
        progressBar: true,
        showMethod: 'slideDown',
        timeOut: 4000
    };
    <?php if($this->session->flashdata('datos_ingresado')){ ?>
      toastr.error('<?= $this->session->flashdata("datos_ingresado") ?>')
    <?php } ?>

    $('#input_cliente').autocomplete({
      serviceUrl: base_url+'admin/autocompletecliente',
      minChars: 5,
      dataType: 'text',
      type: 'POST',
      paramName: 'data',
      cache: false,
      params: {
        'data': $(this).val(),
        'cod_doc': $('#cod_doc').val()
      },
      onSelect: function(suggestion){
        var datos = JSON.parse(suggestion.data)
        $('#id_cliente').val(datos.id)
        $('#id_direccion').val(datos.direccion)
        /*$('#idPersona').val(datos.id)*/
      },
      onSearchStart: function(q){},
      onSearchComplete: function(q,suggestions){}
    })
    var cod_doc = '03'
    $('#cod_doc').on('change',function(){
      $('#input_cliente').val('')
      switch($(this).val()){
        case '03': {
          $('#input_cliente').attr('placeholder','Busque por DNI o Apellidos')
          //$('#logo_cliente').attr('src','<?= base_url('assets/assets/img/reniec_logo.png') ?>')
          $('#consulta_').hide()
          cod_doc = '03'
          $('#cod_doc').val(cod_doc)
        }
        break;
        case '01': {
          $('#input_cliente').attr('placeholder','Busque por RUC o Razon Social')
          $('#logo_cliente').attr('src','<?= base_url('assets/assets/img/sunat_logo.png') ?>')
          cod_doc = '01'
          $('#cod_doc').val(cod_doc)
        }
        break;
        case '99': {
          $('#input_cliente').attr('placeholder','Busque por DNI o Apellidos')
          //$('#logo_cliente').attr('src','<?= base_url('assets/assets/img/reniec_logo.png') ?>')
          $('#consulta_').hide()
          cod_doc = '99'
          $('#cod_doc').val(cod_doc)
        }
        break;
      }
      $('#input_cliente').autocomplete('destroy')
      $('#input_cliente').autocomplete({
        serviceUrl: base_url+'admin/autocompletecliente',
        minChars: 5,
        dataType: 'text',
        type: 'POST',
        paramName: 'data',
        cache: false,
        params: {
          'data': $(this).val(),
          'cod_doc': cod_doc
        },
        onSelect: function(suggestion){
          var datos = JSON.parse(suggestion.data)
          $('#id_cliente').val(datos.id)
          $('#id_direccion').val(datos.direccion)
          /*$('#idPersona').val(datos.id)*/
        },
        onSearchStart: function(q){},
        onSearchComplete: function(q,suggestions){}
      })
    })
    $('#moneda').on('change',function(){
      var coin = 'S/'
      switch($(this).val()){
        case 'PEN': {
          coin = 'S/'
        }
        break;
        case 'USD': {
          coin = '$ '
        }
        break;
        case 'EUR': {
          coin = '€'
        }
        break;
      }
      $('#totales tr td.moneda').each(function(index,element){
        $(this).html(coin)
      })
    })
    $('#generar_comprobante').on('submit',function(e){
      e.preventDefault()
      if($('#id_cliente').val() == 0){
        toastr.error('Seleccione un cliente valido, asegurese de estar registrado.')
        return false
      }
      $.confirm({
        title: 'Atención',
        content: 'Esta seguro de los datos ingresados?',
        buttons: {
          si: function(){
            $('#generar_comprobante').unbind('submit').submit() 
          },
          no: function(){}
        }
      })
    })
    var items = [
    <?php if($items) foreach ($items as $key => $value) {
      echo json_encode($value).',';
    } ?>
    ]
    var calcular = function(){
      var total = 0
      var gravado = 0
      var inafecto = 0
      var exonerado = 0
      var igv = 0
      var descuento = 0
      for(var i in items){
        var t = parseFloat(parseFloat(items[i].cantidad)*parseFloat(items[i].precioventa)).toFixed(2)
        t = parseFloat(parseFloat(t)-parseFloat(t)*parseFloat(items[i].descuento)/parseFloat(100)).toFixed(2)
        if(items[i].tipoigv == 1){
          gravado = parseFloat(parseFloat(gravado)+parseFloat(t)/1.18).toFixed(2)
          igv = parseFloat(parseFloat(igv)+parseFloat(parseFloat(t)-parseFloat(t)/1.18)).toFixed(2)
        }
        if(items[i].tipoigv == 2){
          inafecto = parseFloat(parseFloat(inafecto)+parseFloat(t)).toFixed(2)
        }
        if(items[i].tipoigv == 3){
          exonerado = parseFloat(parseFloat(exonerado)+parseFloat(t)).toFixed(2)
        }
      }
      $('#op-g').html(gravado)
      $('#op-i').html(inafecto)
      $('#op-e').html(exonerado)
      $('#igv').html(igv)
      total = parseFloat(parseFloat(gravado)+parseFloat(inafecto)+parseFloat(exonerado)+parseFloat(igv)).toFixed(2)
      //$('#desc').html(parseFloat(parseFloat(total)*parseFloat(descuento)/100).toFixed(2))
      $('#total').html(parseFloat(parseFloat(total)-parseFloat(total)*parseFloat(descuento)/100).toFixed(2))
      $('#total-in').val(parseFloat(parseFloat(total)-parseFloat(total)*parseFloat(descuento)/100).toFixed(2))
      if(parseFloat($('#total-in').val())>=700)
        $('#detraccion').show('slow')
      else
        $('#detraccion').hide('slow')
      //$('#op-g').html(parseFloat(sub).toFixed(2))
    }
    calcular()
    var opciones = function(){
      $('.table tbody tr td button.editar').unbind('click')
      $('.table tbody tr td button.editar').on('click',function(){
        var e = $(this)
        $.confirm({
          title: 'Resultado',
          columnClass: 'col-lg-8 col-md-8 col-sm-8 col-lg-offset-2 col-md-offset-2 col-sm-offset-2',
          content: function(){
              var self = this;
              //self.setContent('Checking callback flow');
              return $.ajax({
                  url: base_url+'producto/searchItem',
                  dataType: 'json',
                  data: {
                      id: $(e).attr('data-in')
                  },
                  method: 'POST'
              }).done(function (response) {
                //var d = JSON.parse(response)
                if(response.status == 200){
                  var a = response.data
                  var m = response.medidas
                  var s = '<select class="form-control unidad">'
                  for(var i in m){
                    s += '<option value="'+m[i].id+'" '+(m[i].id == a.id_medida ? 'selected' : '')+' >'+m[i].nombre+'</option>'
                  }
                  s += '</select>'
                  console.log(a)
                  self.setContentAppend('<form method="POST"><div class="content"><div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><label>Nombre</label><textarea class="form-control nombre" rows="5">'+a.nombre+'</textarea><input type="hidden" class="id" value="'+a.id+'"></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Cod. Catalogo</label><input type="text" class="form-control codigo_catalogo" disabled value="'+a.codigo_catalogo+'"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Unidad</label>'+s+'</div><div class="col-lg-3 col-md-3 col-sm-3"><label>Cantidad</label><input type="number" step="1" class="form-control cantidad" value="'+a.cantidad+'"></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Precio</label><input type="number" class="form-control precio" value="'+parseFloat(a.precioventa).toFixed(2)+'" step="0.01"></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Desc. 0-100%</label><input type="number" class="form-control descuento" step="1" value="'+a.descuento+'"></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Tipo</label><select class="form-control tipo"><option value="1" '+(a.tipo == 1 ? 'selected' : '')+'>Bien</option><option value="0" '+(a.tipo == 0 ? 'selected' : '')+'>Servicio</option></select></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Tipo de IGV</label><select class="form-control tipoigv"><option value="1" '+(a.tipoigv == 1 ? 'selected' : '')+'>Gravado</option><option value="2" '+(a.tipoigv == 2 ? 'selected' : '')+'>Inafecto</option><option value="3" '+(a.tipoigv == 4 ? 'selected' : '')+'>Exonerado</option></select></div></div></div></form>')
                }
              }).fail(function(){
                  self.setContentAppend('<div>Error consulte con su Administrador</div>');
              }).always(function(){
                  //self.setContentAppend('<div>Always!</div>');
              })
          },
          contentLoaded: function(data, status, xhr){
              //self.setContentAppend('<h2>Resultado:</h2>');
          },
          onContentReady: function(){
              //this.setContentAppend('<div>Resultado:</div>');
          },
          buttons: {
            guardar: function(){
              var ar = {
                id : this.$content.find('.id').val(),
                nombre : this.$content.find('.nombre').val(),
                id_medida : this.$content.find('.unidad').val(),
                medida : this.$content.find('.unidad option:selected').text(),
                precioventa : this.$content.find('.precio').val(),
                codigo_catalogo : this.$content.find('.codigo_catalogo').removeAttr('disabled').val(),
                cantidad : this.$content.find('.cantidad').val(),
                descuento : this.$content.find('.descuento').val(),
                tipo : this.$content.find('.tipo').val(),
                tipoigv: this.$content.find('.tipoigv').val()
              }
              $.ajax({
                url: base_url+'producto/saveItem',
                type: 'POST',
                data: ar,
                success: function(data){
                  window.location.reload()
                  t.fnAddData([
                    ar.id,
                    ar.nombre,
                    ar.medida,
                    ar.cantidad,
                    ar.precioventa,
                    ar.descuento,
                    parseFloat(ar.cantidad)*parseFloat(ar.precioventa)-parseFloat(ar.cantidad)*parseFloat(ar.precioventa)*parseFloat(ar.descuento)/100,
                    ''
                    ])
                  t.fnDeleteRow(t.fnGetPosition(e.closest('tr').get(0)))
                  //$(e).parent().parent().remove()
                  t.fnDraw()
                  calcular()
                }
              })
            },
            cerrar: function(){}
          }
        });
      })
      $('.table tbody tr td button.eliminar').unbind('click')
      $('.table tbody tr td button.eliminar').on('click',function(){
        var b = $(this)
        $.confirm({
          title: 'Atencion',
          content: 'Esta seguro de eliminar el item?',
          buttons: {
            si: function(){
              $.ajax({
                url: base_url+'caja/deleteItem',
                type: 'POST',
                data: {
                  id: $(b).attr('data-in')
                },
                success: function(data){
                  //$(b).parent().parent().remove()
                  //t.fnClearTable()
                  t.fnDeleteRow(t.fnGetPosition(b.closest('tr').get(0)))
                  //t.fnDeleteRow(t.fnGetPosition(current.closest('tr').get(0)))
                  t.fnDraw()
                  calcular()
                }
              })
            },
            no: function(){}
          }
        })
      })
    }
    opciones()
    $('.datepicker').datepicker({
      format: 'dd-mm-yyyy'
    })
    var t = $('.table').dataTable({
      "language": {
        "paginate": {
          "first": "Primera pagina",
          "last": "Ultima pagina",
          "next": "Siguiente",
          "previous": "Anterior"
        },
        "infoEmpty": "Observando 0 a 0 d 0 registros",
        "info": "Observando pagina _PAGE_ de _PAGES_",
        "lengthMenu": "Desplegando _MENU_ Registros"
      },
      "aoColumns" : [
        {sWidth: "40px"},
        {sWidth: "390px"},
        {sWidth: "145px"},
        {sWidth: "70px"},
        {sWidth: "80px"},
        {sWidth: "80px"},
        {sWidth: "80px"},
        {sWidth: "180px"},
        ]
    })
    $('#consulta_').on('click',function(){
      $.confirm({
        title: 'Consulta '+($('#cod_doc').val() == '01' ? 'Sunat' : 'Reniec'),
        content: '<label>Ingrese '+($('#cod_doc').val() == '01' ? 'RUC' : 'DNI')+'</label><input id="consulta_documento" placeholder="'+(($('#cod_doc').val() == '01' ? '12345678912' : '12345678'))+'" type="text" class="form-control">',
        buttons: {
          buscar: function(){
            var documento = this.$content.find('#consulta_documento').val()
            $.confirm({
              title: 'Realizando consulta',
              content: function(){
                var selfconsulta = this
                return $.ajax({
                  url: base_url+'admin/buscaComprobante',
                  type: 'POST',
                  dataType: 'json',
                  data: {
                    documento: documento,
                    cod_doc: $('#cod_doc').val()
                  }
                }).done(function(response){
                  if(response.status == 200){
                    var d = a.data
                        $.alert({
                            title: 'Econtrado',
                            columnClass: 'medium',
                            content: '<label>Razon Social: &nbsp;&nbsp;</label>'+d.razonsocial+'<br>'+
                                '<label>RUC: &nbsp;&nbsp;&nbsp;&nbsp;</label>'+d.ruc+'<br>'+
                                '<label>Direccion: &nbsp;&nbsp;</label>'+d.direccion+''
                        })
                      $('#id_cliente').val(a.id)
                      $('#cliente').val(d.ruc+' - '+d.razonsocial)
                      $('#id_direccion').val(d.direccion)
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
    $('#productoautocomplete').autocomplete({
      serviceUrl: base_url+'caja/autocompleteproducto',
      minChars: 5,
      dataType: 'text',
      type: 'POST',
      paramName: 'data',
      params: {
        'data': $(this).val()
      },
      onSelect: function(suggestion){
        var datos = JSON.parse(suggestion.data)
        console.log(datos)
        $('#productoautocomplete').val('')
        obj.id = datos.id
        obj.nombre = datos.descripcion
        obj.precioventa = datos.precio
        obj.cantidad = 1
        obj.id_medida = datos.medida_id
        obj.medida = 'ZZ'
        obj.tipoigv = 2
        obj.descuento = 0
        obj.tipo = datos.tipo
        obj.codigo_catalogo = datos.cod_catalogo
        $.ajax({
          url: base_url+'caja/saveItem',
          type: 'POST',
          data: obj,
          success: function(data){
            var obj = JSON.parse(data)
            items.push(obj)
            $('.table').dataTable().fnAddData([
              obj.id.substr(0,4),
              obj.nombre,
              obj.medida,
              obj.cantidad,
              parseFloat(obj.precioventa).toFixed(2),
              parseFloat(obj.descuento).toFixed(2),
              parseFloat(parseFloat(parseFloat(obj.precioventa)*parseFloat(obj.cantidad))-parseFloat(parseFloat(obj.precioventa)*parseFloat(obj.cantidad))*parseFloat(parseFloat(obj.descuento)/parseFloat(100)).toFixed(2)).toFixed(2),
              '<div class="btn-group"><button class="btn btn-success editar" data-in="'+obj.id+'" type="button"><i class="fa fa-edit"></i></button><button class="btn btn-danger eliminar" data-in="'+obj.id+'" type="button"><i class="fa fa-trash"></i></button></div>'
            ])
        opciones()   
        calcular()
          }
        })
        //$('#idCliente').val(datos.id)
        /*$('#idPersona').val(datos.id)*/
	//opciones()
      },
      onSearchStart: function(q){
      },
      onSearchComplete: function(q,suggestions){}
    })
    $('#listar').on('click',function(){
      if($('#id').val() == ''){
        $.alert('Seleccione un producto')
        return false
      }
      t.fnAddData([
        $('#id').val(),
        $('#nombre').val(),
        $('#unidad').val(),
        1,
        parseFloat($('#precio').val()).toFixed(2),
        '0',
        parseFloat($('#precio').val()),
        '<div class="btn-group"><button class="btn btn-success editar" data-in="'+$('#id').val()+'" type="button"><i class="fa fa-edit"></i></button><button class="btn btn-danger eliminar" data-in="'+$('#id').val()+'" type="button"><i class="fa fa-trash"></i></button></div>'
        ])
      opciones()
	
	//t.fnClearTable()
      var data = {
          id: $('#id').val(),
          nombre: $('#nombre').val(),
          id_medida: $('#id_medida').val(),
          medida: $('#unidad').val(),
          precioventa: $('#precio').val(),
          codigo_catalogo: $('#cod_catalogo').val(),
          cantidad: 1,
          descuento: 0,
          tipo: $('#tipo').val(),
          tipoigv: 1
        }
        items.push(data)
      t.fnDraw()
      $.ajax({
        url: base_url+'producto/saveItem',
        type: 'POST',
        data: data,
        success: function(data){
          calcular()
        }
      })
      $('#productoautocomplete').val('')
      $('#id').val('')
      $('#nombre').val('')
      $('#precio').val('')
      $('#unidad').val('')
      $('#cod_catalogo').val('')
      $('#tipo').val('')
    })
    $('#nuevo_cliente').on('click',function(){
      $.confirm({
        title: 'Resultado',
        columnClass: 'col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3',
        content: function(){
            var self = this;
            //self.setContent('Checking callback flow');
            return $.ajax({
                url: base_url+'caja/buscadocdep',
                dataType: 'json',
                data: {
                    dato: 1
                },
                method: 'POST'
            }).done(function (response) {
              //si es satisfecho
              var depas = response.data.departamentos
              var docs = response.data.documentos
              var departamentos = '<select class="form-control depa">'
              for(var i in depas)
                departamentos += '<option value="'+depas[i].id+'">'+depas[i].nombre+'</option>'
              departamentos += '</select>'
              var documentos = '<select class="form-control docs">'
              for(var i in docs) if(docs[i].abrev != '')
                documentos += '<option value="'+docs[i].id+'">'+docs[i].abrev+'</option>'
              documentos += '</select>'
              var contenido = ''
              var areas = '<select class="form-control areas chosen-select" style="index-z=999999999 !important;"><option value=""></option>'
              var ars = response.data.areas
              for(var i in ars)
                areas += '<option value="'+ars[i].id+'">'+ars[i].Descripcion+'</option>'
              areas += '</select>'
              if($('#cod_doc').val() == '01')
                contenido = '<form method="POST"><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Razon Social*</label><input type="text" class="form-control razonsocial" placeholder="NATIVIDAD SOCIEDAD ANONIMA CERRADA - NATIVIDAD S.A.C." required></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Nombre Comercial*</label><input type="text" class="form-control nombrecomercial" placeholder="ACAD PREUNIVERSITARIA EXITUS"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Documentos*</label>'+documentos+'</div><div class="col-lg-6 col-md-6 col-sm-6"><label>Nro. Documento*</label><input type="number" class="form-control nrodoc" placeholder="20483752947"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Departamentos*</label>'+departamentos+'</div><div class="col-lg-6 col-md-6 col-sm-6"><label>Provincias*</label><select class="form-control prov"></select></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Distritos*</label><select class="form-control dist"></select></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Dirección*</label><input type="text" class="form-control direccion" placeholder="Av. Direccion"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Email</label><input type="email" class="form-control email" placeholder="email@email.com"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Telefono 1*</label><input class="form-control telefono1" type="number" placeholder="987654321"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Telefono 2</label><input type="text" class="form-control telefono2 datepicker" placeholder="987654321"></div></div></form>'
              else
                contenido = '<form method="POST"><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Nombres*</label><input type="text" class="form-control nombres" placeholder="Juan" required></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Apellidos*</label><input type="text" class="form-control apellidos" placeholder="Peres"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Documentos*</label>'+documentos+'</div><div class="col-lg-6 col-md-6 col-sm-6"><label>Nro. Documento*</label><input type="number" class="form-control nrodoc" placeholder="87654321"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Departamentos</label>'+departamentos+'</div><div class="col-lg-6 col-md-6 col-sm-6"><label>Provincias</label><select class="form-control prov"></select></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Distritos</label><select class="form-control dist"></select></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Dirección*</label><input type="text" class="form-control direccion" placeholder="Av. Direccion"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Email</label><input type="email" class="form-control email" placeholder="email@email.com"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Telefono</label><input class="form-control telefono" type="number" placeholder="987654321"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Fecha Nac.</label><input type="text" class="form-control fecha datepicker" value="<?= date('d-m-Y') ?>"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Area</label>'+areas+'</div></div></form>'
              self.setContentAppend(contenido);
            }).fail(function(){
              //self.setContentAppend('<div>Fail!</div>');
            }).always(function(){
              //self.setContentAppend('<div>Always!</div>');
            })
          },
          buttons: {
            formSubmit: {
              text: 'Guardar',
              btnClass: 'btn-blue',
              action: function () {
                if($('#cod_doc').val() == '01'){
                  var razonsocial = this.$content.find('.razonsocial').val();
                  if(!razonsocial){
                      $.alert('Ingrese Razon Social');
                      return false;
                  }
                  var nombrecomercial = this.$content.find('.nombrecomercial').val();
                  if(!nombrecomercial){
                      $.alert('Ingrese Nombre Comercial');
                      return false;
                  }
                }else{
                  var name = this.$content.find('.nombres').val();
                  if(!name){
                      $.alert('Ingrese nombres');
                      return false;
                  }
                  if(!this.$content.find('.apellidos').val()){
                      $.alert('Ingrese Apellidos');
                      return false;
                  }
                }
                if(!this.$content.find('.nrodoc').val()){
                    $.alert('Ingrese Nro. de Documento');
                    return false;
                }
                if(!this.$content.find('.direccion').val()){
                    $.alert('Ingrese Direccion');
                    return false;
                }
                var oR = this
                if($('#cod_doc').val() == '01'){
                  var data_client = {
                      cod_doc: $('#cod_doc').val(),
                      razon: oR.$content.find('.razonsocial').val(),
                      nombre: oR.$content.find('.nombrecomercial').val(),
                      direccion: oR.$content.find('.direccion').val() ? oR.$content.find('.direccion').val() : '',
                      email: oR.$content.find('.email').val() ? oR.$content.find('.email').val() : 'email@email.com',
                      telefono1: oR.$content.find('.telefono1').val(),
                      telefono2: oR.$content.find('.telefono2').val(),
                      distrito: oR.$content.find('.dist').val(),
                      provincia: oR.$content.find('.prov').val(),
                      departamento: oR.$content.find('.depa').val(),
                      tipodoc: oR.$content.find('.docs').val(),
                      nrodoc: oR.$content.find('.nrodoc').val()
                    }
                }else{
                  var data_client = {
                      cod_doc: $('#cod_doc').val(),
                      nombres: oR.$content.find('.nombres').val(),
                      apellidos: oR.$content.find('.apellidos').val(),
                      direccion: oR.$content.find('.direccion').val() ? oR.$content.find('.direccion').val() : '',
                      email: oR.$content.find('.email').val() ? oR.$content.find('.email').val() : 'email@email.com',
                      distrito: oR.$content.find('.dist').val() ? oR.$content.find('.dist').val() : 1,
                      provincia: oR.$content.find('.prov').val() ? oR.$content.find('.prov').val() : 1,
                      departamento: oR.$content.find('.depa').val(),
                      tipodoc: oR.$content.find('.docs').val(),
                      nrodoc: oR.$content.find('.nrodoc').val(),
                      fch_nac: oR.$content.find('.fecha').val(),
                      area: oR.$content.find('.areas').val()
                    }
                }
                //$.alert('Your name is ' + name);
                $.confirm({
                  title: 'Registrando cliente',
                  content: function(){
                    var selfreg = this
                    return $.ajax({
                      url: base_url+'admin/newCliente',
                      type: 'POST',
                      dataType: 'json',
                      data: data_client,
                      success: function(response){
                        //var d = JSON.parse(data)
                        if(response.status == 200){
                          //$.alert(d.msg)
                          $('#input_cliente').val(response.data.nroidentificacion+' - '+($('#cod_doc').val() == '01' ? response.data.razon_social : response.data.apellidos+' '+response.data.nombres))
                          $('#id_cliente').val(response.data.id_cliente)
                          toastr.success(response.response)
                          //$('#id_direccion').val(d.data.direccion)
                        }else{
                          toastr.success(response.response)
                        }
                        selfreg.close()
                      },
                    }).fail(function(){
                      selfreg.close()
                      toastr.error('Error, consulte con su Administrador')
                    })
                  }
                })
              }
            },
            cancel: function () {
              //close
            },
          },
          contentLoaded: function(data, status, xhr){
              //self.setContentAppend('<h2>Resultado:</h2>');
          },
          onContentReady: function(){
            $('.datepicker').datepicker({
              format: 'dd-mm-yyyy'
            })
            //$(".chosen-select").chosen(); 
            var oR = this
            this.$content.find('.depa').on('change',function(){
              oR.$content.find('.prov').html('')
              oR.$content.find('.dist').html('')
              $.ajax({
                url: base_url+'admin/provincias',
                type: 'POST',
                data: {
                  id_dep: oR.$content.find('.depa').val()
                },
                success: function(data){
                  var a = JSON.parse(data)
                  console.log(a)
                  if(a.status == 202)
                    $.alert('Error en la consulta')
                  else{
                    oR.$content.find('.prov').html('')
                    var d = a.data
                    console.log(d)
                    for(var i in d)
                      oR.$content.find('.prov').append('<option value="'+d[i].id+'">'+d[i].nombre+'</option>')
                    $.ajax({
                      url: base_url+'admin/distritos',
                      type: 'POST',
                      data: {
                        id_prov: d[0].id
                      },
                      success: function(data){
                        var a = JSON.parse(data)
                        console.log(a)
                        if(a.status == 202)
                          $.alert('Error en la consulta')
                        else{
                          oR.$content.find('.dist').html('')
                          var d = a.data
                          for(var i in d)
                            oR.$content.find('.dist').append('<option value="'+d[i].id+'">'+d[i].nombre+'</option>')
                        }
                      }
                    })
                  }
                }
              })
            })
            this.$content.find('.prov').on('change',function(){
              oR.$content.find('.dist').html('')
              $.ajax({
                url: base_url+'admin/distritos',
                type: 'POST',
                data: {
                  id_prov: oR.$content.find('.prov').val()
                },
                success: function(data){
                  var a = JSON.parse(data)
                  console.log(a)
                  if(a.status == 202)
                    $.alert('Error en la consulta')
                  else{
                    oR.$content.find('.dist').html('')
                    var d = a.data
                    for(var i in d)
                      oR.$content.find('.dist').append('<option value="'+d[i].id+'">'+d[i].nombre+'</option>')
                  }
                }
              })
            })
            //this.setContentAppend('<div>Resultado:</div>');
          }
      })
    })

    var obj = {}
    $('#agregar').on('click',function(){
      var medida = '<div class="col-lg-6 col-md-6 col-sm-6"><label>Unidades</label><select class="form-control chosen-select" id="unidad1"><?php foreach($medidas as $medida){
          $s = $medida->id == '16' ? 'selected' : '';
          echo '<option value="'.$medida->id.'" '.$s.'>'.$medida->nombre."</option>";
      } ?></select></div>'
      $.confirm({
        title: 'AGREGAR ITEM',
        content: '<div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Descripción</label><div class="input-group col-lg-12 col-md-12 col-sm-12"><input type="text" class="form-control nombreproducto" id="nombreproducto" placeholder="Busque el producto en el catalogo..."><span class="input-group-addon codigo_catalogo" id="basic-addon1">....</span><input type="hidden" class="form-control codigocatalogo" disabled></div><h6 style="color: red; padding: 0px !important margin: 0px !important;">Por favor primero consulte el producto o similar en el catalogo de SUNAT*</h6><hr><textarea class="form-control" rows="10" id="descripcion"></textarea></div><div class="col-lg-6 col-md-6 col-sm-6"><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Cantidad</label><input class="form-control" id="cantidad" type="number" value="1"></div>'+medida+'</div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Precio</label><input class="form-control" id="precio1" type="number" step="0.001" value="0.000"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>Tipo</label><select class="form-control" id="tipoitem"><option value="0">Servicio</option><option value="1">Bien</option></select></div></div><div class="row"><div class="col-lg-6 col-md-6 col-sm-6"><label>Descuento 0-100%</label><input class="form-control" id="descuento2" placeholder="Ejm. 50%" type="number" value="0"></div><div class="col-lg-6 col-md-6 col-sm-6"><label>IGV</label><select class="form-control" id="igvs"><option value="2">Inafecto</option><option value="1">Gravado</option><option value="3">Exonerado</option></select></div></div><br><div class="row"><div class="col-lg-3 col-md-3 col-sm-3"><label>Subtotal: </label><spam class="subtotal">0</spam></div><div class="col-lg-3 col-md-3 col-sm-3"><label>IGV: </label><spam class="igv">0</spam></div><div class="col-lg-3 col-md-3 col-sm-3"><label>Total: </label><spam class="total">0</spam></div></div></div></div>',
        columnClass: 'col-lg-12 col-md-12 col-sm-12',
        buttons: {
          agregar: function(){
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
              url: base_url+'caja/saveItem',
              type: 'POST',
              data: obj,
              success: function(data){
                var obj = JSON.parse(data)
                items.push(obj)
                $('.table').dataTable().fnAddData([
                  obj.id.substr(0,4),
                  obj.nombre,
                  obj.medida,
                  obj.cantidad,
                  parseFloat(obj.precioventa).toFixed(2),
                  parseFloat(obj.descuento).toFixed(2),
                  parseFloat(parseFloat(parseFloat(obj.precioventa)*parseFloat(obj.cantidad))-parseFloat(parseFloat(obj.precioventa)*parseFloat(obj.cantidad))*parseFloat(parseFloat(obj.descuento)/parseFloat(100)).toFixed(2)).toFixed(2),
                  '<div class="btn-group"><button class="btn btn-success editar" data-in="'+obj.id+'" type="button"><i class="fa fa-edit"></i></button><button class="btn btn-danger eliminar" data-in="'+obj.id+'" type="button"><i class="fa fa-trash"></i></button></div>'
                ])
            opciones()   
            calcular()
              }
            })
          },
          cancelar: function(){}
        },
        onOpen: function(){
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
        }
      })
    })
  })
</script>
