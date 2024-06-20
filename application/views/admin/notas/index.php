<div class="row wrapper border-bottom white-bg page-heading">
    <input type="hidden" name="id-usuario" id="id-usuario" value="<?= $id_usuario ?>">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Control de Notas</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Notas</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="tabs-container">
                <ul class="nav nav-tabs">
                    <li class="active show">
                        <a class="nav-link" data-toggle="tab" href="#informacion"><i class="fa fa-user"></i> Información</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#busqueda_examen"><i class="fa fa-user"></i> Busqueda</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#reporte"><i class="fa fa-user"></i> Reporte</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#reporte_detallado"><i class="fa fa-user"></i> Reporte Detallado</a>
                    </li>
                </ul>
                <div class="tab-content">
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
                                                    <button type="button" class="btn btn-success" style="margin-right: 5px; border-radius: 5px" id="subir-notas"><i class="far fa-file-excel" style="margin-right: 5px"></i>Subir Notas Desde Excel
                                                    </button>
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
                                <div id="divComentarios">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Notas del Alumno</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_notas display table-striped table-bordered table-hover center" id="dataTable" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Tipo</th>
                                                            <th class="center">Fecha</th>
                                                            <th class="center">Respuestas Buenas</th> 
                                                            <th class="center">Respuestas Malas</th> 
                                                            <th class="center">Puntaje</th>   
                                                            <th class="center">Nota</th>        
                                                            <th class="center">Ubicacion</th> 
                                                            <th class="center">&nbsp;</th>
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
                    <div class="tab-pane" id="busqueda_examen">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Sede</label>
                                                    <select class="form-control" id="sede_busqueda" name="sede">
                                                        <?php foreach ($sedes as $key => $value) { ?>
                                                            <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <label>Ciclo</label>
                                                    <select class="form-control" name="ciclo" id="ciclo_busqueda">
                                                        <?php if(isset($ciclos)) foreach ($ciclos as $key => $value) { ?>
                                                            <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Area</label>
                                                    <select class="form-control chosen-select" id="area_busqueda" name="area" multiple>
                                                        <?php foreach ($areas as $key => $value) { ?>
                                                            <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <label>Turno</label>
                                                    <select class="form-control" name="turno" id="turno_busqueda">
                                                        <?php if(isset($turnos)) foreach ($turnos as $key => $value) { ?>
                                                            <option value="<?= $value->id ?>"><?= $value->descripcion ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <label>&nbsp;</label><br>
                                                    <div>
                                                        <button type="button" id="buscar_examen" class="btn btn-primary" style="margin-right: 5px; border-radius: 5px"><i class="fa fa-search"></i> Buscar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div id="divComentarios">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Lista de Examenes</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_busqueda display table-striped table-bordered table-hover center" id="" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Tipo</th>
                                                            <th class="center">Area</th>
                                                            <th class="center">Fecha</th>
                                                            <th class="center">&nbsp;</th>
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
                    <div class="tab-pane" id="reporte">
                        <div class="panel-body">
                            <div class="row">
                                <div id="divComentarios">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Reporte</h5>
                                        </div>
                                        <div class="ibox-content">                                            
                                            <div>
                                                <label class="col-sm-2 control-label">Resultados de </label>
                                                <div class="col-lg-8 col-md-8 col-sm-8">
                                                    <input type="text" class="form-control" id="resultados" name="resultados" readonly required>
                                                </div>
                                            </div>  
                                            </br></br></br>
                                            <div class="table-responsive">
                                                <table class="table tabla_reporte display table-striped table-bordered table-hover center" id="" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Codigo</th>
                                                            <th class="center">Alumno</th>
                                                            <th class="center">Respuestas Buenas</th>
                                                            <th class="center">Respuestas Malas</th>
                                                            <th class="center">Puntaje</th>
                                                            <th class="center">Nota</th>
                                                            <th class="center">Ubicacion</th>
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
                    <div class="tab-pane" id="reporte_detallado">
                        <div class="panel-body">
                            <div class="row">
                                <div id="divComentarios">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Reporte Detallado</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div>
                                                <label class="col-sm-2 control-label">Resultados de </label>
                                                <div class="col-lg-8 col-md-8 col-sm-8">
                                                    <input type="text" class="form-control" id="resultadosdetalle" name="resultadosdetalle" readonly required>
                                                </div>
                                            </div>  
                                            </br></br></br>
                                            <div class="table-responsive">
                                                <table class="table tabla_reportedetalle display table-striped table-bordered table-hover center" id="" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Codigo</th>
                                                            <th class="center">Alumno</th>
                                                            <th class="center">Respuestas</th>
                                                            <th class="center">Respuestas Buenas</th>
                                                            <th class="center">Respuestas Malas</th>
                                                            <th class="center">Puntaje</th>
                                                            <th class="center">Nota</th>
                                                            <th class="center">Respuestas Blancas</th>
                                                            <th class="center">Respuestas Multiples</th>
                                                            <th class="center">Marcas Incorrectas</th>
                                                            <th class="center">Marcas Correctas</th>
                                                            <th class="center">Sumario de Marcas</th>
                                                            <th class="center">Ubicacion</th>
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
        $('#subir-notas').on('click',function(){
            $.confirm({
                title: 'Nuevo Excel de Notas',
                content: '<div class="row"><div class="col-lg-12 col-md-12 col-sm-12"><form method="post" id="formulario" enctype="multipart/form-data"><div class="btn-group"><label class="btn btn-primary" title="Subir Excel"><input id="subida" class="hide" type="file" accept=".xlsx, .xlsm, .xlsb, .xltx, .xltm, .xls, .xlt, .xml" name="archivo">Seleccionar Excel</label></div><input type="hidden" name="id_alumno" value="0"><div class="col-lg-12 col-md-12 col-sm-12"><label>Tipo de Examen</label><select class="form-control" id="tipo_subir" name="tipo"> <?php foreach ($tipos as $key => $value) { ?><option value="<?= $value->id ?>"><?= $value->descripcion ?></option><?php } ?></select></div></br><div class="col-lg-12 col-md-12 col-sm-12"><label>Sede</label><select class="form-control" id="sede_subir" name="sede"> <?php foreach ($sedes as $key => $value) { ?><option value="<?= $value->id ?>"><?= $value->Descripcion ?></option><?php } ?></select></div></br><div class="col-lg-12 col-md-12 col-sm-12"><label>Ciclo</label><select class="form-control" name="ciclo" id="ciclo_subir"><?php if(isset($ciclos)) foreach ($ciclos as $key => $value) { ?><option value="<?= $value->id ?>"><?= $value->Descripcion ?></option><?php } ?></select></div></br><div class="col-lg-12 col-md-12 col-sm-12"><label>Area</label><select class="form-control chosen-select" id="area_subir" name="area"><?php foreach ($areas as $key => $value) { ?><option value="<?= $value->id ?>"><?= $value->Descripcion ?></option><?php } ?></select></div></br><div class="col-lg-12 col-md-12 col-sm-12"><label>Turno</label><select class="form-control" name="turno" id="turno_subir"><?php if(isset($turnos)) foreach ($turnos as $key => $value) { ?><option value="<?= $value->id ?>"><?= $value->descripcion ?></option><?php } ?></select></div></div></div>',
                buttons: {
                  subir: function(){
                    var formData= new FormData($('#formulario')[0]);
                    $.confirm({
                      title: 'Subiendo',
                      content: function(){
                        var self = this
                        return $.ajax({
                          url: '<?= base_url('notas/subirNotas') ?>',
                          method: 'post',
                          dataType: 'json',
                          contentType: false,
                          processData: false,
                          data: formData
                        }).done(function(response){
                          if(response.status == 200){
                            self.close()
                            toastr.success(response.message)
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
        $(".chosen-select").chosen()

        var t_notas = $('.tabla_notas').dataTable({
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
        var t_busqueda = $('.tabla_busqueda').dataTable({
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
        var t_reportedetalle = $('.tabla_reportedetalle').dataTable({
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

        $('#buscar_examen').on('click',function(){
            t_busqueda.fnClearTable()
            t_busqueda.fnDraw()
            if($('#area_busqueda').val().length == 0){
                toastr.error('Seleccione al menos un area')
                return false
            }
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('notas/buscarExamen') ?>',
                        dataType: 'JSON',
                        method: 'POST',
                        data: {
                            sede: $('#sede_busqueda').val(),
                            ciclo: $('#ciclo_busqueda').val(),
                            area: $('#area_busqueda').val(),
                            turno: $('#turno_busqueda').val()
                        }
                    }).done(function(response){
                        console.log(response)
                        if(response.status == 200){
                            var examenes = response.data.examenes
                            for(var i in examenes){
                                t_busqueda.fnAddData([
                                    examenes[i].descripcion,
                                    examenes[i].area,
                                    examenes[i].fecha,
                                    '<div class="btn-group"><button class="btn btn-primary ver" type="button" data-toggle="tooltip" data-placement="top" title="Ver" data-info="'+examenes[i].id+'" data-id="'+examenes[i].id+'"><i class="fa fa-eye"></i></button></div>'
                                ])                                
                            }
                            funcionalidades()
                        }
                        else{
                            toastr.error(response.message)
                        }
                        self.close()
                    }).fail(function(){
                        toastr.error('Error, consulte con su administrador')
                        self.close()
                    })
                }
            })
        })    

        var funcionalidades = function(){
            $('.table tbody tr button.ver').unbind('click')
            $('.table tbody tr button.ver').on('click',function(){
                $('a[href="#reporte"]').tab('show')
                reportar($(this).attr('data-id'))
            })
        }
            
        var reportar = function(id_examen){
            t_reporte.fnClearTable()
            t_reporte.fnDraw()
            t_reportedetalle.fnClearTable()
            t_reportedetalle.fnDraw()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('notas/reporte') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id_examen: id_examen
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            $('#resultados').val(response.data.titulo)
                            $('#resultadosdetalle').val(response.data.titulo)
                            var reporte = response.data.reporte
                            if(response.data.reporte != 0){
                                for(var i in reporte){
                                    t_reporte.fnAddData([
                                        reporte[i].codigo,
                                        reporte[i].persona,
                                        reporte[i].respuestas_buenas,
                                        reporte[i].respuestas_malas,
                                        reporte[i].puntaje,
                                        reporte[i].nota,
                                        reporte[i].ubicacion
                                    ])

                                    t_reportedetalle.fnAddData([
                                        reporte[i].codigo,
                                        reporte[i].persona,
                                        reporte[i].respuestas,
                                        reporte[i].respuestas_buenas,
                                        reporte[i].respuestas_malas,
                                        reporte[i].puntaje,
                                        reporte[i].nota,
                                        reporte[i].respuestas_blancas,
                                        reporte[i].respuestas_multiples,
                                        reporte[i].marcas_incorrectas,
                                        reporte[i].marcas_correctas,
                                        reporte[i].sumario_marcas,
                                        reporte[i].ubicacion
                                    ])
                                }
                            }
                            $('[data-toggle="tooltip"]').tooltip()
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
        var busqueda = function(id_alumno){
            t_notas.fnClearTable()
            t_notas.fnDraw()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('notas/getAlumno') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            id_alumno: id_alumno
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            $('#id_alumno_input').val(id_alumno)
                            //toastr.success('')
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
                            var notas = response.data.notas
                            if(response.data.faltas != 0){
                                for(var i in notas){
                                    t_notas.fnAddData([
                                        notas[i].descripcion,
                                        notas[i].fecha,
                                        notas[i].buenas,
                                        notas[i].malas,
                                        notas[i].puntaje,
                                        notas[i].nota,
                                        notas[i].ubicacion,
                                        ""
                                    ])
                                }
                            }
                            $('[data-toggle="tooltip"]').tooltip()
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

        <?php if($id_alumno != 0){ ?>
            busqueda(<?= $id_alumno ?>)
        <?php } ?>

        $('#alumno_busqueda').autocomplete({
            serviceUrl: '<?= base_url('notas/getAlumnoActualAutocomplete') ?>',
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
	})
</script>