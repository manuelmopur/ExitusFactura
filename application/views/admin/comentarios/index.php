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
                    <li class="active show">
                        <a class="nav-link" data-toggle="tab" href="#informacion"><i class="fa fa-user"></i> Información</a>
                    </li>
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
                                <div id="divComentarios">
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Comentarios de Docentes</h5>
                                        </div>
                                        <div class="ibox-content">
                                            <div class="table-responsive">
                                                <table class="table tabla_comentarios display table-striped table-bordered table-hover center" id="dataTable" width= "100%" cellspacing="0">
                                                    <thead>
                                                        <tr>
                                                            <th>Profesor</th>
                                                            <th>Fecha</th>
                                                            <th>Comentario</th>
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
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };     
        var t_comentarios = $('.tabla_comentarios').dataTable({
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
        t_comentarios.api().button().add( 1, {
            action: function ( e, dt, button, config ) {                
            },
            text: '<i class="fa fa-plus"></i> Nuevo',
            className: 'btn btn-primary boton-agregar ' 
        } )             
            
        var busqueda = function(id_alumno){
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('comentarios/getAlumno') ?>',
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
                            var comentarios = response.data.comentarios
                            t_comentarios.fnClearTable()
                            t_comentarios.fnDraw()
                            if(response.data.comentarios != 0){
                                for(i in comentarios){
                                    ops = '<a class="btn btn-success" href="<?= base_url('comentarios/editar/') ?>'+comentarios[i].id+'/'+comentarios[i].usuario_id+'/'+id_alumno+'" data-target="tooltip" data-placement="top" title="Editar Comentario"><i class="fa fa-edit"></i></a>'
                                    t_comentarios.fnAddData([
                                        comentarios[i].Profesor,
                                        comentarios[i].Fecha,
                                        comentarios[i].Comentario,
                                        ops
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
            serviceUrl: '<?= base_url('comentarios/getAlumnoActualAutocomplete') ?>',
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
                t_comentarios.api().button(1).remove()
                t_comentarios.api().button().add( 1, {
                    action: function ( e, dt, button, config ) {
                        window.location.href = '<?= base_url('comentarios/nuevo/') ?>'+a.id_alumno
                    },
                    text: '<i class="fa fa-plus"></i> Nuevo',
                    className: 'btn btn-primary boton-agregar ' 
                } )             
            }
        })
	})
</script>