<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Alumnos</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Alumnos</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#lista"><i class="fa fa-users"></i> Alumnos</a>
                    </li>
                    <li class="active show">
                        <a class="nav-link" data-toggle="tab" href="#informacion"><i class="fa fa-user"></i> Información</a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#carnets"><i class="fa fa-id-card"></i> Carnets</a>
                    </li>
                    <li>
                        <a class="nav-link" data-toggle="tab" href="#reporte"><i class="fa fa-list-alt"></i> Reporte</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="lista">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="content center">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Sede</label>
                                                        <select class="form-control" name="sede" id="sede">
                                                            <?php if(isset($sedes)) foreach ($sedes as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <select class="form-control" name="area" id="area">
                                                            <?php if(isset($areas)) foreach ($areas as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label>Ciclo</label>
                                                        <select class="form-control" name="ciclo" id="ciclo">
                                                            <?php if(isset($ciclos)) foreach ($ciclos as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label>&nbsp;</label><br>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" id="buscar"><i class="fa fa-search"></i> Buscar</button>
                                                        <button type="button" class="btn btn-primary" id="buscar_todos"><i class="fa fa-search"></i> Buscar Todos</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table tabla_alumnos display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Codigo</th>
                                                        <th class="center">Apellidos y Nombres</th>
                                                        <th class="center">Foto</th>
                                                        <th class="center">Ciclo</th>
                                                        <th class="center">Área</th>
                                                        <th class="center">Turno</th>
                                                        <th class="center">Inicia Grupo</th>
                                                        <th class="center">Culmina Grupo</th>
                                                        <th class="center">Email</th>
                                                        <th class="center">Telefono</th>
                                                        <th class="center">&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!--<?php if(!is_numeric($alumnos)) foreach ($alumnos as $key => $value) { ?>
                                                        <tr>
                                                            <td class="center"><?= $value->codigo ?></td>
                                                            <td><?= $value->persona ?></td>
                                                             <td class="center"><?= $value->ciclo ?></td>
                                                            <td class="center"><?= $value->area ?></td>
                                                            <td class="center"><?= $value->turno ?></td>
                                                            <td class="center"><?= $value->grupo ?></td>
                                                             <td class="center"><?= $value->grupo_fin ?></td>
                                                            <td class="center">
                                                                <div class="btn-group">
                                                                    <button class="btn btn-primary ver" type="button" data-toggle="tooltip" data-placement="top" title="Ver" data-info="<?= $value->codigo.' - '.$value->persona ?>" data-id="<?= $value->id_alumno ?>"><i class="fa fa-eye"></i></button>
                                                                    <a href="<?= base_url('alumnos/editar/').$value->id_alumno ?>" class="btn btn-success editar" data-toggle="tooltip"  data-placement="top" title="Editar" data-id="<?= $value->id_alumno ?>"><i class="fa fa-edit"></i></a>
                                                                    <a href="<?= base_url('alumnos/ficha/').$value->codigo ?>" class="btn btn-warning " target="_blank" data-toggle="tooltip" data-placement="top" title="Ficha"><i class="fa fa-file-alt"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?> -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="reporte">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="content center">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Sede</label>
                                                        <select class="form-control" name="sede" id="rsede">
                                                            <?php if(isset($sedes)) foreach ($sedes as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <select class="form-control" name="area" id="rarea">
                                                            <?php if(isset($areas)) foreach ($areas as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <label>Ciclo</label>
                                                        <select class="form-control" name="ciclo" id="rciclo">
                                                            <?php if(isset($ciclos)) foreach ($ciclos as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label>&nbsp;</label><br>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" id="buscar_reporte"><i class="fa fa-search"></i> Buscar</button>
                                                        <button type="button" class="btn btn-primary" id="buscar_todos_reporte"><i class="fa fa-search"></i> Buscar Todos</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table tabla_reporte display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Codigo</th>
                                                        <th class="center">Apellidos y Nombres</th>
                                                        <th class="center">Ciclo</th>
                                                        <th class="center">Área</th>
                                                        <th class="center">Turno</th>
                                                        <th class="center">Total Pagos</th>
                                                        <th class="center">Total Deuda</th>
                                                        <th class="center">Cuota1</th>
                                                        <th class="center">Cuota2</th>
                                                        <th class="center">Material</th>
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
                    <div class="tab-pane active" id="informacion">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="content">
                                            <div class="row">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label campoObligatorio">Apellidos y Nombres</label>
                                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                                        <input type="text" class="form-control" name="autocomplete" id="alumno_busqueda" placeholder="0512010044 - Perez Cordova Juan" required>
                                                    </div>  
                                                    <!--a href="" class="btn btn-primary col-md-2 col-ms-2 col-lg-2"><i class="fa fa-plus"></i> Nuevo Alumno</a-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Información</h5>
                                        </div>

                                        <div class="col-lg-5">
                                            <div class="ibox-content">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <center>
                                                            <img src="<?= base_url('assets/assets/img/user.jpg') ?>" id="foto-alumno" class="img-responsive img-fluid" style="width: 60%;" alt="Foto">
                                                            <input type="hidden" name="id_alumno" id="id_alumno_input" value="0">
                                                        </center>
                                                    </div>
                                                </div>
                                                
                                                <div class="row" style="margin: 10px 0;">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <center>
                                                            <div class="btn-group">
                                                                <button type="button" class="btn btn-success" style="margin-right: 5px; border-radius: 5px" id="subir-foto" disabled><i class="fa fa-camera" style="margin-right: 5px"></i>Subir Foto</button>
                                                            </div>
                                                        </center>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-7">
                                            <div class="ibox-content">
                                                <div> <!--class="col-md-offset-4"-->
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Nombres</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="nombres"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Apellidos</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="apellidos"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Ciclo</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="info-ciclo"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Area</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="info-area"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Turno</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="info-turno"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Email</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="email"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Fch. Nacimiento</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="fch_nac"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Cod. Alumno</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="codigo"></label>
                                                        </div>
                                                    </div>
                                                   <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Colegio Procedencia</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="colegio"></label>
                                                        </div>
                                                    </div>
                                                   <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Tutor</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="tutor"></label>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <h5>Telefono tutor</h5>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6">
                                                            <label id="telefono_tutor"></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php if($rol != 5){?>                                
                                <div id="divPagos">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Pagos</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_pagos display table-striped table-bordered table-hover center" id="dataTable" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Concepto</th>
                                                            <th>Monto</th>
                                                            <th>Material</th>
                                                            <th>Inicial</th>
                                                            <th>Fecha_Pago</th>
                                                            <th>Fecha_Expiracion</th>
                                                            <th>Observacion</th>
                                                            <th>Estado</th>
                                                            <th>&nbsp;</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="divComprobantes">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Comprobantes</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_comprobantes display table-striped table-bordered table-hover center" width ="100%">
                                                    <thead>
                                                        <tr>
                                                            <td>Comprobante</td>
                                                            <td>Cliente</td>
                                                            <td>Fecha</td>
                                                            <td>Total</td>
                                                            <td>Estado</td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--div class="col-lg-3 col-md-3 col-sm-3">
                                        <label>&nbsp;</label><br>
                                        <div class="btn-group">
                                            <a href="<?= base_url('caja/emitirConAlumno/'.$value->id_alumno) ?>" class="btn btn-success" data-toogle="tooltip" data-placement="top" title="Emitir comprobante"><i class="fa fa-edit"></i> Emitir</a>
                                        </div>
                                    </div-->                                
                                </div> 
                                <?php }?>                               
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="carnets">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="content center">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Sede</label>
                                                        <select class="form-control" name="sede" id="sede_carnets">
                                                            <?php if(isset($sedes)) foreach ($sedes as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Area</label>
                                                        <select class="form-control" name="area" id="area_carnets">
                                                            <?php if(isset($areas)) foreach ($areas as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <div class="form-group">
                                                        <label>Ciclo</label>
                                                        <select class="form-control" name="ciclo" id="ciclo_carnets">
                                                            <?php if(isset($ciclos)) foreach ($ciclos as $key => $value) { ?>
                                                                <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Impresos</label><br>
                                                    <input type="checkbox" class="js-switch" name="impreso" /> 
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                    <label>&nbsp;</label><br>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-success" id="buscar_carnets"><i class="fa fa-search"></i> Buscar</button>
                                                        <button type="button" class="btn btn-primary" id="buscar_todos_carnets"><i class="fa fa-search"></i> Buscar Todos</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table tabla_carnets display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                <thead>
                                                    <tr>
                                                        <th class="center">Codigo</th>
                                                        <th class="center">Apellidos y Nombres</th>
                                                        <th class="center">Área</th>
                                                        <th class="center">Turno</th>
                                                        <th class="center">Impreso</th>
                                                        <th class="center">
                                                            <input type="checkbox" name="allreadycarnets" class="allreadycarnets">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php /*if(!is_numeric($alumnos)) foreach ($alumnos as $key => $value) if(photo_exits(BASEPATH.'../fotos/'.strtoupper($value->area).'/'.str_replace(' ', '_', strtoupper(trim($value->apellidos).' '.trim($value->nombres))))) { ?>
                                                        <tr>
                                                            <td class="center"><?= $value->codigo ?></td>
                                                            <td><?= $value->persona ?></td>
                                                            <td class="center"><?= $value->area ?></td>
                                                            <td class="center">
                                                                <input type="checkbox" name="readycarnets" class="readycarnets" data-codigo="<?= $value->codigo ?>" data-id="<?= $value->id_alumno ?>">
                                                            </td>
                                                        </tr>
                                                    <?php }*/ ?>
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
<script type="text/javascript">
	$(function(){
        var elemn = document.querySelector('.js-switch')
		var init = new Switchery(elemn,{ color: '#1ab394' });
        function removeItemFromArr ( arr, item ) {
            var i = arr.indexOf( item );
         
            if ( i !== -1 ) {
                arr.splice( i, 1 );
            }
        }
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        $('#subir-foto').on('click',function(){
            $.confirm({
                title: 'Nuevo Foto',
                content: '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><form method="post" id="formulario" enctype="multipart/form-data"><div class="btn-group"><label class="btn btn-primary" title="Subir Imagen"><input id="subida" class="hide" type="file" accept="image/x-png,image/jpg,image/jpeg" name="archivo">Seleccion Imagen</label></div><br><label id="archivo"></label><input type="hidden" name="id_alumno" value="'+$('#id_alumno_input').val()+'"></form></div></div>',
                buttons: {
                  subir: function(){
                    var formData= new FormData($('#formulario')[0]);
                    $.confirm({
                      title: 'Subiendo',
                      content: function(){
                        var self = this
                        return $.ajax({
                          url: '<?= base_url('alumnos/subirImagen') ?>',
                          method: 'post',
                          dataType: 'json',
                          contentType: false,
                          processData: false,
                          data: formData
                        }).done(function(response){
                          if(response.status == 200){
                            self.close()
                            toastr.success(response.message)
                            $('#foto-alumno').attr('src','<?= base_url() ?>'+response.data.ruta+'/'+response.data.archivo)
                            /*setTimeout(function(){
                              window.location.reload()
                            },300)*/
                          }
                          else{
                            self.close()
                            toastr.error(response.message)
                          }
                          console.log(response)
                        }).fail(function(){
                          self.setContentAppend('Error cargando archivo')
                        })
                      },
                      buttons: {
                        ok: function(){}
                      }
                    })
                  },
                  cancelar: function(){}
                },
                onContentReady: function(){
                  $('#subida').on('change',function(){
                    //let fileName = $(this).val().split('\\').pop();
                    $('#archivo').html($('#apellidos').html()+' '+$('#nombres').html())
                  })
                }
            })
        })

        var carnets = []
        var t_carnets = $('.tabla_carnets').dataTable({
          "columns": [
                { "width": "20%" }, 
                { "width": "30%" }, 
                { "width": "20%" }, 
                { "width": "10%" },
                { "width": "10%" },
                { "width": "10%" } 
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
            buttons: []
        })

        $('.allreadycarnets').on('change',function(){
            carnets = []
            t_carnets.api().page.len( -1 ).draw()
            var dat = t_carnets.api().rows().data()
            if($(this).is(':checked')){
                //console.log(dat)
                for(var i in dat)
                    if(typeof $('input.readycarnets[data-codigo="'+dat[i][0]+'"]').attr('data-id') !== 'undefined'){
                        carnets.push($('input.readycarnets[data-codigo="'+dat[i][0]+'"]').attr('data-id'))
                        $('input.readycarnets[data-codigo="'+dat[i][0]+'"]').attr('checked','checked')
                    }
            }else{
                for(var i in dat)
                    if(typeof $('input.readycarnets[data-codigo="'+dat[i][0]+'"]').attr('data-id') !== 'undefined')
                        $('input.readycarnets[data-codigo="'+dat[i][0]+'"]').removeAttr('checked')
            }
            console.log(carnets)
            t_carnets.api().draw()
            t_carnets.api().page.len( 10 ).draw()
        })
        $('.tabla_carnets').on('change','tbody input.readycarnets',function(){
            if($(this).is(':checked')){
                carnets.push($(this).attr('data-id'))
                //console.log($(this).attr('data-codigo'))
            }else{
                //carnets.pop($(this).attr('data-codigo'))
                removeItemFromArr(carnets,$(this).attr('data-id'))
            }
        })
        t_carnets.api().button().add( 0, {
            action: function ( e, dt, button, config ) {
                console.log(carnets)
                if(carnets.length == 0){
                    toastr.error('Seleccione al menos un alumno')
                    return false
                }
                var form = document.createElement('FORM');
                form.method='POST';
                form.action = '<?= base_url() ?>impreso/carnetsalumno';
                form.target = '_blank'

                for(var i in carnets){
                    var input = document.createElement("INPUT");
                    input.id="q";
                    input.name="codigos[]"
                    input.type="hidden";
                    input.value=carnets[i];
                    form.appendChild(input);
                }

                document.body.appendChild(form);

                //window.open('',"");
                form.submit();
            },
            text: '<i class="fa fa-print"></i> Imprimir',
            className: 'btn btn-primary' 
        } )
        var t_comprobantes = $('.tabla_comprobantes').dataTable({
          "columns": [
                { "width": "15%" }, 
                { "width": "40%" }, 
                { "width": "10%" }, 
                { "width": "10%" }, 
                { "width": "10%" }, 
                { "width": "15%" }, 
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

		var t_alumnos = $('.tabla_alumnos').dataTable({
        //   "columns": [//estaba comentado
	    //         { "width": "6%" },     //codigo
	    //         { "width": "30%" },    //ape y nom
        //         { "width": "4%" },     //tiene foto
	    //         { "width": "10%" },    //ciclo
	    //         { "width": "10%" },    //area
	    //         { "width": "7%" },     //turno
	    //         { "width": "10%" },    //inicia
        //         { "width": "10%" },    //culmina
        //         { "width": "13%" },    //botones
        //     ],
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
        var t_reporte = $('.tabla_reporte').dataTable({
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

        var t_pagos = $('.tabla_pagos').dataTable({
          "columns": [//estaba comentado
                { "width": "6%" },  //Concepto
                { "width": "6%" },  //Monto
                { "width": "6%" },  //Material
                { "width": "6%" },  //Inicial
                { "width": "8%" },  //Fecha_Pago
                { "width": "8%" },  //Fecha_Expiracion
                { "width": "48%" }, //Observacion
                { "width": "6%" },  //Estado
                { "width": "6%" },  //Boton
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
        /*t_pagos.api().button().add( 0, {
            action: function ( e, dt, button, config ) {
                //window.location.href = '<?= base_url('preinscripcion/nuevo') ?>'
            },
            text: '<i class="fa fa-money-check"></i> Pagar',
            className: 'btn btn-primary boton-agregar' 
        } )*/
        var busqueda = function(id_alumno){
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/getAlumno') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id_alumno: id_alumno
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            $('#id_alumno_input').val(id_alumno)
                            //toastr.success('')
                            console.log(response.data)
                            $('#nombres').html(response.data.nombres)
                            $('#apellidos').html(response.data.apellidos)
                            $('#info-ciclo').html(response.data.ciclo)
                            $('#info-area').html(response.data.area)
                            $('#info-turno').html(response.data.turno)
                            $('#email').html(response.data.email)
                            $('#fch_nac').html(response.data.fch_nac)
                            $('#codigo').html(response.data.codigo)
                            $('#colegio').html(response.data.colegio)
                            $('#tutor').html(response.data.tutor.nombres+' '+response.data.tutor.apellidos)
                            $('#telefono_tutor').html(response.data.tutor.telefono)
                            if(response.data.imagen != '')
                                $('#foto-alumno').attr('src','<?= base_url() ?>'+response.data.imagen)
                            else
                                $('#foto-alumno').attr('src','<?= base_url('assets/assets/img/user.jpg') ?>')
                            $('#link-carnet').removeAttr('disabled')
                            $('#link-carnet').attr('href','<?= base_url('impreso/carnetalumno/') ?>'+id_alumno)
                            var pagos = response.data.pagos
                            var cuotas = response.data.cuotas
                            var est = 'Deuda'
                            var ops = ''
                            t_pagos.api().clear()
                            
                                if(pagos.Estado == 1){
                                    est = 'Pagado'
                                    ops = '<a class="btn btn-primary" target="_blank" href="<?= base_url('impreso/comprobante/') ?>'+pagos.Boleta_Inicial+'" data-target="tooltip" data-placement="top" title="Ver comprobante"><i class="fa fa-file"></i></a>'
                                }
                                else{
                                    est = 'Deuda'
                                    ops = '<a class="btn btn-success" href="<?= base_url('caja/pagar/') ?>'+pagos.id+'" data-target="tooltip" data-placement="top" title="Generar comprobante de pago"><i class="fa fa-money-check"></i></a>'
                                    ops = ''
                                }
                                if(pagos.Tipo_Pago == 1){
                                    t_pagos.fnAddData([
                                        'Contado',
                                        pagos.Monto,
                                        pagos.Material,
                                        pagos.Inicial,
                                        pagos.Fecha_Pago_Inicial,
                                        '',
                                        pagos.Observacion,
                                        est,
                                        ops
                                    ])
                                }
                                else{
                                    t_pagos.fnAddData([
                                        'Credito',
                                        pagos.Monto,
                                        pagos.Material,
                                        pagos.Inicial,
                                        pagos.Fecha_Pago_Inicial,
                                        '',
                                        pagos.Observacion,
                                        est,
                                        ops
                                    ])
                                    ops = ''
                                    for(var j in cuotas){
                                        if(cuotas[j].Estado == 1){
                                            est = 'Pagado'
                                            <?php $prov = explode('.', $_SERVER['HTTP_HOST']);
                                            if($prov[0] == 'provi'){ ?>
                                                if(cuotas[j].Boleta.substring(0,1) == 'X') {
                                                    ops = '<a class="btn btn-primary" target="_blank" href="<?= base_url('impreso/provisional/') ?>'+cuotas[j].Boleta+'" data-target="tooltip" data-placement="top" title="Ver comprobante"><i class="fa fa-file"></i></a>'
                                                }
                                                else{
                                                    ops = '<a class="btn btn-primary" target="_blank"  data-target="tooltip" data-placement="top" title="Ver comprobante"><i class="fa fa-file"></i></a>'
                                                }      
                                            <?php } else { ?>
                                                ops = '<a class="btn btn-primary" target="_blank" href="<?= base_url('impreso/comprobante/') ?>'+cuotas[j].Boleta+'" data-target="tooltip" data-placement="top" title="Ver comprobante"><i class="fa fa-file"></i></a>'          
                                            <?php } ?> 
                                        }
                                        else{
                                            est = 'Deuda'
                                            ops = '<a class="btn btn-success" href="<?= base_url('caja/pagarcuota/') ?>'+cuotas[j].id+'/'+(parseInt(j)+1)+'" data-target="tooltip" data-placement="top" title="Emitir comprobante"><i class="fa fa-money-check"></i></a><a class="btn btn-success" href="<?= base_url('alumnos/dividircuota/') ?>'+cuotas[j].id+'/'+cuotas[j].Pagos_id+'/'+id_alumno+'" data-target="tooltip" data-placement="top" title="Dividir Cuota"><i class="fas fa-copy"></i></a><a class="btn btn-success" href="<?= base_url('alumnos/editarcuota/') ?>'+cuotas[j].id+'/'+cuotas[j].Pagos_id+'/'+id_alumno+'" data-target="tooltip" data-placement="top" title="Editar Cuota"><i class="fa fa-edit"></i></a></a><button type="button" class="delete-item btn btn-danger" data-id-cuota="'+cuotas[j].id+'" id="delete" title="Eliminar Cuota"><i class="fa fa-trash"></i></button>'
                                        }
                                        t_pagos.fnAddData([
                                            'Cuota',
                                            cuotas[j].Monto,
                                            '',
                                            '',
                                            cuotas[j].Fecha_Pago,
                                            cuotas[j].Fecha_Expiracion,
                                            '',
                                            est,
                                            ops
                                        ])
                                        $('.delete-item').unbind('click')
                                        $('.delete-item').on('click',function(){
                                            var element = this
                                            $.confirm({
                                                title: 'Atención',
                                                content: '¿Estás seguro que desea elimminar esta cuota?',
                                                buttons: {
                                                    si: function(){
                                                        $.confirm({
                                                            title: 'Eliminando',
                                                            columnClass: 'large',
                                                            content: function(){
                                                                var self = this
                                                                return $.ajax({
                                                                    url: '<?= base_url('alumnos/eliminarcuota') ?>',
                                                                    method: 'post',
                                                                    dataType: 'JSON',
                                                                    data: {
                                                                        id: $(element).attr('data-id-cuota'),
                                                                        id_pagos: cuotas[j].Pagos_id
                                                                    }
                                                                }).done(function(response){
                                                                    if(response.status == 200){
                                                                        toastr.success('Eliminacion Satisfactoria')
                                                                        $(element).parent().parent().remove()
                                                                        busqueda(id_alumno)
                                                                    }                                    
                                                                    else{
                                                                        toastr.error('Error')
                                                                    }
                                                                    self.close()
                                                                }).fail(function(){
                                                                    toastr.error('Error en la Eliminacion consulte con su administrador')
                                                                    self.close()
                                                                })
                                                            }
                                                        })
                                                    },
                                                    no: function(){}
                                                }    
                                            })            
                                        });
                                    }
                                }                                              
                            //fin de for en pagos

                            var comprobantes = response.data.comprobantes
                            var estado = ''
                            var opciones = ''
                            t_comprobantes.api().clear()
                            for(var i in comprobantes){
                                estado = ''
                                opciones = '<div class="btn-group"><a class="btn btn-primary" target="_blank" data-toggle="tooltip" data-placement="top" title="Ver" href="<?= base_url() ?>impreso/'+(comprobantes[i].cod_doc == '99' ? 'provisional' : 'comprobante') +'/'+comprobantes[i].num_serie+'-'+comprobantes[i].num_documento+'"><i class="fa fa-print"></i></a>'
                                switch(comprobantes[i].estado){
                                    case '1':{
                                        estado = 'Emitido'
                                    }
                                    break;
                                    case '2':{
                                        estado = 'Enviado'
                                    }
                                    break;
                                    case '3':{
                                        estado = 'Anulado'
                                    }
                                    break;
                                }
                                opciones += '</div>'
                                t_comprobantes.fnAddData([
                                    comprobantes[i].num_serie+'-'+comprobantes[i].num_documento,
                                    comprobantes[i].cliente,
                                    comprobantes[i].fecha.substring(0,10),
                                    comprobantes[i].total,
                                    estado,
                                    opciones
                                    ])                                                                           
                            }//fin de for comprobantes

                            $('[data-toggle="tooltip"]').tooltip()
                            $('#subir-foto').removeAttr('disabled')
                        }else{
                            toastr.error('Error, consulte con su administrador')
                        }
                            self.close()
                    }).fail(function(){
                        toastr.error('Error en la consulta')
                        self.close()
                    })
                }
            })
        }

        var funcionalidades = function(){
            $('.table tbody tr button.ver').unbind('click')
            $('.table tbody tr button.ver').on('click',function(){
                $('a[href="#informacion"]').tab('show')
                $('#alumno_busqueda').val($(this).attr('data-info'))
                busqueda($(this).attr('data-id'))
            })
        }

        t_alumnos.on('draw.dt',function(){
            funcionalidades()
        })

        funcionalidades()
        
        $('#alumno_busqueda').autocomplete({
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
                busqueda(a.id_alumno)
               
            }
        })
        $('#buscar_carnets').on('click',function(){
            t_carnets.api().clear()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/buscarCarnets') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            sede: $('#sede_carnets').val(),
                            area: $('#area_carnets').val(),
                            ciclo: $('#ciclo_carnets').val(),
                            impresos: elemn.checked ? 1 : 0
                        }
                    }).done(function(response){
                        t_carnets.api().clear()
                        self.close()
                        t_carnets.fnDraw()
                        if(response.status == 200){
                            var d = response.data
                            console.log(d)
                            for(var i in d){
                                t_carnets.fnAddData([
                                    d[i].codigo,
                                    d[i].apellidos+' '+d[i].nombres,
                                    d[i].area,
                                    d[i].turno,
                                    d[i].carnet_impreso == 1 ? 'Si' : 'No',
                                    '<div class="btn-group center"><input type="checkbox" name="readycarnets" class="readycarnets" data-codigo="'+d[i].codigo+'" data-id="'+d[i].id_alumno+'"></div>'
                                    ])
                            }
                            funcionalidades()
                        }
                        else{
                            toastr.error(response.message)
                        }
                    }).fail(function(){
                        self.close()
                        t_carnets.api().clear()
                        t_carnets.fnDraw()
                        toastr.error('Error, consulte con su administrador')
                    })
                }
            })
        })
        $('#buscar_todos_carnets').on('click',function(){
            t_carnets.api().clear()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/buscarTodosCarnets') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            sede: $('#sede_carnets').val(),
                            area: $('#area_carnets').val(),
                            ciclo: $('#ciclo_carnets').val()
                        }
                    }).done(function(response){
                        t_carnets.api().clear()
                        self.close()
                        t_carnets.fnDraw()
                        if(response.status == 200){
                            var d = response.data
                            console.log(d)
                            for(var i in d){
                                t_carnets.fnAddData([
                                    d[i].codigo,
                                    d[i].apellidos+' '+d[i].nombres,
                                    d[i].area,
                                    d[i].turno,
                                    d[i].carnet_impreso == 1 ? 'Si' : 'No',
                                    '<div class="btn-group center"><input type="checkbox" name="readycarnets" class="readycarnets" data-codigo="'+d[i].codigo+'" data-id="'+d[i].id_alumno+'"></div>'
                                    ])
                            }
                        }
                        else{
                            toastr.error(response.message)
                        }
                    }).fail(function(){
                        self.close()
                        t_carnets.api().clear()
                        t_carnets.fnDraw()
                        toastr.error('Error, consulte con su administrador')
                    })
                }
            })
        })
        $('#buscar').on('click',function(){
            t_alumnos.api().clear()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/buscardatos') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            sede: $('#sede').val(),
                            area: $('#area').val(),
                            ciclo: $('#ciclo').val()
                        }
                    }).done(function(response){
                        t_alumnos.api().clear()
                        self.close()
                        t_alumnos.fnDraw()
                        if(response.status == 200){
                            var d = response.data
                            console.log(d)
                            for(var i in d){
                                t_alumnos.fnAddData([
                                    d[i].codigo,
                                    d[i].apellidos+' '+d[i].nombres,
                                    d[i].tienefoto,
                                    d[i].ciclo,
                                    d[i].area,
                                    d[i].turno,
                                    d[i].grupo,
                                    d[i].grupo_fin,
                                    d[i].email,
                                    d[i].telefono,
                                    '<div class="btn-group"><button class="btn btn-primary ver" type="button" data-toggle="tooltip" data-placement="top" title="Ver" data-info="'+d[i].codigo+' - '+d[i].nombres+' '+d[i].apellidos+'" data-id="'+d[i].id_alumno+'"><i class="fa fa-eye"></i></button><a href="<?= base_url('alumnos/editar/') ?>'+d[i].id_alumno+'" class="btn btn-primary editar" data-toggle="tooltip"  data-placement="top" title="Editar" data-id="'+d[i].id_alumno+'"><i class="fa fa-edit"></i></a><a href="<?= base_url('alumnos/ficha/')?>'+d[i].id_alumno+'" class="btn btn-warning " target="_blank" data-toggle="tooltip" data-placement="top" title="Ficha"><i class="fa fa-file-alt"></i></a></div>'
                                    ])
                            }
                            funcionalidades()
                        }
                        else{
                            toastr.error(response.message)
                        }
                    }).fail(function(){
                        self.close()
                        t_alumnos.api().clear()
                        t_alumnos.fnDraw()
                        toastr.error('Error, consulte con su administrador')
                    })
                }
            })
        })
        $('#buscar_todos').on('click',function(){
            t_alumnos.api().clear()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/buscardatostodos') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            sede : $('#sede').val()
                        }
                    }).done(function(response){
                        t_alumnos.api().clear()
                        self.close()
                        t_alumnos.fnDraw()
                        if(response.status == 200){
                            var d = response.data
                            console.log(d)
                            for(var i in d){
                                t_alumnos.fnAddData([
                                    d[i].codigo,
                                    d[i].apellidos+' '+d[i].nombres,
                                    d[i].tienefoto,
                                    d[i].ciclo,
                                    d[i].area,
                                    d[i].turno,
                                    d[i].grupo,
                                    d[i].grupo_fin,
                                    d[i].email,
                                    d[i].telefono,
                                    '<div class="btn-group"><button class="btn btn-primary ver" type="button" data-toggle="tooltip" data-placement="top" title="Ver" data-info="'+d[i].codigo+' - '+d[i].nombres+' '+d[i].apellidos+'" data-id="'+d[i].id_alumno+'"><i class="fa fa-eye"></i></button><a href="<?= base_url('alumnos/editar/') ?>'+d[i].id_alumno+'" class="btn btn-primary editar" data-toggle="tooltip"  data-placement="top" title="Editar" data-id="'+d[i].id_alumno+'"><i class="fa fa-edit"></i></a><a href="<?= base_url('alumnos/ficha/')?>'+d[i].codigo+'" class="btn btn-warning " target="_blank" data-toggle="tooltip" data-placement="top" title="Ficha"><i class="fa fa-file-alt"></i></a></div>'
                                    ])
                            }
                            funcionalidades()
                        }
                        else{
                            toastr.error(response.message)
                        }
                    }).fail(function(){
                        self.close()
                        t_alumnos.api().clear()
                        t_alumnos.fnDraw()
                        toastr.error('Error, consulte con su administrador')
                    })
                }
            })
        })
        $('#buscar_reporte').on('click',function(){
            t_reporte.api().clear()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/buscardatosreporte') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            sede: $('#rsede').val(),
                            area: $('#rarea').val(),
                            ciclo: $('#rciclo').val()
                        }
                    }).done(function(response){
                        t_reporte.api().clear()
                        self.close()
                        t_reporte.fnDraw()
                        if(response.status == 200){
                            var d = response.data
                            console.log(d)
                            for(var i in d){
                                t_reporte.fnAddData([
                                    d[i].codigo,
                                    d[i].apellidos+' '+d[i].nombres,
                                    d[i].ciclo,
                                    d[i].area,
                                    d[i].turno,
                                    d[i].pagos,
                                    d[i].deudas,
                                    d[i].cuota,
                                    d[i].cuota2,
                                    d[i].material
                                ])
                            }
                        }
                        else{
                            toastr.error(response.message)
                        }
                    }).fail(function(){
                        self.close()
                        t_reporte.api().clear()
                        t_reporte.fnDraw()
                        toastr.error('Error, consulte con su administrador')
                    })
                }
            })
        })
        $('#buscar_todos_reporte').on('click',function(){
            t_reporte.api().clear()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('alumnos/buscardatosreportetodos') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            sede: $('#rsede').val()
                        }
                    }).done(function(response){
                        t_reporte.api().clear()
                        self.close()
                        t_reporte.fnDraw()
                        if(response.status == 200){
                            var d = response.data
                            console.log(d)
                            for(var i in d){
                                t_reporte.fnAddData([
                                    d[i].codigo,
                                    d[i].apellidos+' '+d[i].nombres,
                                    d[i].ciclo,
                                    d[i].area,
                                    d[i].turno,
                                    d[i].pagos,
                                    d[i].deudas,
                                    ''
                                    ])
                            }
                        }
                        else{
                            toastr.error(response.message)
                        }
                    }).fail(function(){
                        self.close()
                        t_reporte.api().clear()
                        t_reporte.fnDraw()
                        toastr.error('Error, consulte con su administrador')
                    })
                }
            })
        })
        <?php if($id_alumno != 0){ ?>
            busqueda(<?= $id_alumno ?>)
        <?php } ?>

	})
</script>