<div class="row wrapper border-bottom white-bg page-heading">
    <input type="hidden" name="id-usuario" id="id-usuario" value="<?= $id_usuario ?>">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Asistencia</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Faltas</strong></li>
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
                        <a class="nav-link" data-toggle="tab" href="#reporte"><i class="fa fa-user"></i> Reporte</a>
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
                                                    <a href="<?= base_url('control') ?>" class="btn btn-primary col-md-2 col-ms-2 col-lg-2"><i class="fa fa-cog"></i> Control de Asistencia</a>
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
                                            <h5>Faltas del Alumno</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_faltas display table-striped table-bordered table-hover center" id="dataTable" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Tipo</th>
                                                            <th class="center">Fecha</th>
                                                            <th class="center">Estado</th>        
                                                            <th class="center">Justificacion</th> 
                                                            <th class="center">Auxiliar</th>
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
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="content">
                                            <div class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Desde</label>
                                                    <input type="text" class="form-control center datepicker" name="desde" id="desde" value="<?= date('d-m-Y') ?>">
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Hasta</label>
                                                    <input type="text" class="form-control center datepicker" name="hasta" id="hasta" value="<?= date('d-m-Y') ?>">
                                                    <input type="hidden" name="hoy" id="hoy" value="<?= date('d-m-Y') ?>">
                                                </div>
                                                <div class="col-lg-2 col-md-2 col-sm-2">
                                                    <label>Sede</label>
                                                    <select class="form-control" id="sede_busqueda" name="sede">
                                                        <?php foreach ($sedes as $key => $value) { ?>
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
                                                        <label>&nbsp;</label><br>
                                                    <div>
                                                        <button type="button" id="buscar_reporte" class="btn btn-primary" style="margin-right: 5px; border-radius: 5px"><i class="fa fa-search"></i> Buscar</button>
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
                                            <h5>Asistencia del Alumno</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_asistencia display table-striped table-bordered table-hover center" id="" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th class="center">Codigo</th>
                                                            <th class="center">Alumno</th>
                                                            <th class="center">Telf. Tutor</th>
                                                            <th class="center">Area</th>
                                                            <th class="center">Turno</th>
                                                            <th class="center">Faltas</th>
                                                            <th class="center">Tardanzas</th>
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
        $(".chosen-select").chosen()

        var t_faltas = $('.tabla_faltas').dataTable({
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
        var tabla_asistencia = $('.tabla_asistencia').dataTable({
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

        $('#buscar_reporte').on('click',function(){
            tabla_asistencia.fnClearTable()
            tabla_asistencia.fnDraw()
            if($('#area_busqueda').val().length == 0){
                toastr.error('Seleccione al menos un area')
                return false
            }
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('asistencia/reporte') ?>',
                        dataType: 'JSON',
                        method: 'POST',
                        data: {
                            desde: $('#desde').val(),
                            hasta: $('#hasta').val(),
                            sede: $('#sede_busqueda').val(),
                            area: $('#area_busqueda').val()
                        }
                    }).done(function(response){
                        console.log(response)
                        if(response.status == 200){
                            var alumnos = response.data.alumnos
                            for(var i in alumnos){
                                var falta = alumnos[i].falta
                                if($('#hasta').val() == $('#hoy').val()){
                                    if(alumnos[i].estado_asistencia == 0)
                                        falta += 1
                                }
                                tabla_asistencia.fnAddData([
                                    alumnos[i].codigo,
                                    alumnos[i].apellidos+' '+alumnos[i].nombres,
                                    alumnos[i].tutor,
                                    alumnos[i].area,
                                    alumnos[i].turno,
                                    falta,
                                    alumnos[i].tardanza
                                ])                                
                            }
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
            
        var busqueda = function(id_alumno){
            t_faltas.fnClearTable()
            t_faltas.fnDraw()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('asistencia/getAlumno') ?>',
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
                            var faltas = response.data.faltas
                            if(response.data.faltas != 0){
                                for(var i in faltas){
                                    switch (faltas[i].Estado) {
                                        case '0':
                                            var e = 'NO JUSTIFICADA'
                                            var ops = '<a class="btn btn-success justificar" data-id-usuario="'+faltas[i].usuario_id+'" href="<?= base_url('asistencia/editar/') ?>'+faltas[i].id+'/'+id_alumno+'/'+faltas[i].Estado+'" data-target="tooltip" data-placement="top" title="Justificar Falta"><i class="fas fa-pencil-alt"></i></i></a>'
                                            break
                                        case '1':
                                            var e = 'JUSTIFICADA'
                                            var ops = '<a class="btn btn-success justificar" data-id-usuario="'+faltas[i].usuario_id+'" href="<?= base_url('asistencia/editar/') ?>'+faltas[i].id+'/'+id_alumno+'/'+faltas[i].Estado+'/'+faltas[i].usuario_id+'" data-target="tooltip" data-placement="top" title="Editar Justificacion de Falta"><i class="fa fa-edit"></i></a>'
                                            break
                                        case '2':
                                            var e = 'NO JUSTIFICADA'
                                            var ops = '<a class="btn btn-success justificar" data-id-usuario="'+faltas[i].usuario_id+'" href="<?= base_url('asistencia/editar/') ?>'+faltas[i].id+'/'+id_alumno+'/'+faltas[i].Estado+'" data-target="tooltip" data-placement="top" title="Justificar Tardanza"><i class="fas fa-pencil-alt"></i></a>'
                                            break
                                        case '3':
                                            var e = 'JUSTIFICADA'
                                            var ops = '<a class="btn btn-success justificar" data-id-usuario="'+faltas[i].usuario_id+'" href="<?= base_url('asistencia/editar/') ?>'+faltas[i].id+'/'+id_alumno+'/'+faltas[i].Estado+'/'+faltas[i].usuario_id+'" data-target="tooltip" data-placement="top" title="Editar Justificacion de Tardanza"><i class="fa fa-edit"></i></a>'
                                            break
                                    }                                    
                                    t_faltas.fnAddData([
                                        faltas[i].Estado == 2 || faltas[i].Estado == 3 ? 'TARDANZA' : 'FALTA',
                                        faltas[i].Fecha,
                                        e,
                                        faltas[i].Justificacion,
                                        faltas[i].Auxiliar == 'asistencia'? '-' : faltas[i].Auxiliar,
                                        ops
                                    ])
                                }
                            }
                            if(response.data.estado_asistencia == 0){
                                t_faltas.fnAddData([
                                    'FALTA',
                                    '<?= date('Y-m-d') ?>',
                                    'NO JUSTIFICADA',
                                    'NO PUEDE JUSTIFICARSE EL MISMO DIA',
                                    '-',
                                    '-'
                                ])
                            }
                            $('.tabla_faltas tbody tr td a.justificar').unbind('click')
                            $('.tabla_faltas tbody tr td a.justificar').on('click',function(e){
                                if($(this).attr('data-id-usuario') == 43 || $('#id-usuario').val() == $(this).attr('data-id-usuario')){
                                    window.location.href=$(this).attr('href')                                    
                                }else{
                                    toastr.error('No puede editar la justificación')
                                    e.preventDefault()
                                }
                            })
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
            serviceUrl: '<?= base_url('asistencia/getAlumnoActualAutocomplete') ?>',
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
        <?php if(!isset($areas_activas)){ ?>
            $.confirm({
                columnClass: 'col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3',
                title: 'Atención',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('asistencia/preparaAreas') ?>',
                        method: 'POST',
                        dataType: 'JSON',
                        data: {
                            status: 1
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            var sedes = response.data
                            var htmlareas = ''
                            for(var i in sedes)
                                htmlareas += '<div class="i-checks"><label><input type="checkbox" name="areas[]" value="'+sedes[i].id+'">&nbsp;'+sedes[i].Descripcion+'</label></div>'
                            self.setContentAppend('<label>Seleccione las areas a controlar su asistencia</label>'+
                            '<form><div class="form">'+htmlareas+'</div><form><label id="mensaje"></label>')
                        }else{
                            toastr.error(response.message)
                            self.close()
                        }
                    }).fail(function(){
                        toastr.error('Error consulte con su Administrador')
                    })
                },
                buttons: {
                    listo: {
                        text: 'Listo',
                        btnClass: 'btn-primary',
                        action: function(){
                            var datos = this.$content.find('form').serialize()
                            if(datos == ''){
                                toastr.error('Seleccione al menos un area')
                                return false
                            }
                            $.confirm({
                                title: 'Registrando',
                                content: function(){
                                    var self1 = this
                                    return $.ajax({
                                        url: '<?= base_url('asistencia/guardaAreas') ?>',
                                        method: 'POST',
                                        dataType: 'JSON',
                                        data: datos
                                    }).done(function(response){
                                        if(response.status == 200){
                                            toastr.success(response.message)
                                        }
                                        else{
                                            toastr.error(response.message)
                                        }
                                        self1.close()
                                    }).fail(function(){
                                        toastr.error('Error consulte con su Administrador')
                                    })
                                }
                            })
                        }
                    }
                },
                onContentReady: function(){
                    $('.i-checks').iCheck({
                        checkboxClass: 'icheckbox_square-green',
                        radioClass: 'iradio_square-green',
                    });
                }
            })

            $(document).ready(function () {
            });
        
        <?php } ?>
	})
</script>