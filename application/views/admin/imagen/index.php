<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Imagen institucional</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
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
                        <a class="nav-link" data-toggle="tab" href="#imagen"><i class="fa fa-user"></i> Imagen institucional</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#agenda"><i class="fa fa-user"></i> Agenda</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#records"><i class="fa fa-users"></i> Records</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#ciclos"><i class="fa fa-user"></i> Ciclos</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="imagen">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h2>Imagenes de Portada</h2>
                                            </div>
                                        </div>
                                        <div class="row portadas">
                                            <?php if(!is_numeric($portadas)) foreach ($portadas as $key => $value) { ?>
                                                <div class="col-lg-4 col-md-4 col-sm-6">
                                                    <div class="contact-box">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <img alt="image" width="150" src="<?= base_url('assets/assets/img/').$value->imagen ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="text-center">
                                                                    <h3><?= $value->titulo ?></h3>
                                                                    <address>
                                                                        <?= $value->descripcion ?>
                                                                    </address>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <?php if($value->estado == 0){ ?>
                                                                    <h3>INACTIVO</h3>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <?php if($value->estado == 1){ ?>
                                                                    <button class="btn btn-warning baja" data-id="<?= $value->id ?>" data-value="0"><i class="fa fa-trash"></i> Dar de Baja</button>
                                                                <?php }else{ ?>
                                                                    <button class="btn btn-primary baja" data-id="<?= $value->id ?>" data-value="1"><i class="fa fa-check"></i> Activar</button>
                                                                <?php } ?>
                                                                <button class="btn btn-danger eliminar" data-id="<?= $value->id ?>"><i class="fa fa-trash"></i> Eliminar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div><br>
                                        <div class="">
                                            <div class="btn-group">
                                                <button class="btn btn-primary" type="button" id="nueva-portada"><i class="fa fa-plus"></i> Nueva</button>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h2>Videos de Portada</h2>
                                            </div>
                                        </div>
                                        <form method="post" id="videos-post">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Video Post</label>
                                                        <input type="text" class="form-control" name="video-post[]" id="video-post" value="<?= $video_post->video ?>" placeholder="https://www.youtube.com/embed/VZE_ZBdLgj8" data-id="<?= is_numeric($video_manual) ? 0 : $video_post->id ?>">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Video Manual</label>
                                                        <input type="text" class="form-control" name="video-post[]" id="video-manual" value="<?= $video_manual->video ?>" placeholder="https://www.youtube.com/embed/0G3CJWJQNkg" data-id="<?= is_numeric($video_manual) ? 0 : $video_manual->id ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3 col-md-3 col-sm-3">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="agenda">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <h2>Agenda</h2>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12">
                                                <div class="table-responsive">
                                                    <table class="table tabla_agenda display table-striped table-bordered table-hover center" style="width: 100% !important;">
                                                        <thead>
                                                            <tr>
                                                                <td>#</td>
                                                                <td>Titulo</td>
                                                                <td>Fecha</td>
                                                                <td>Estado</td>
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
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function(){
        var t_agenda = $('.tabla_agenda').dataTable({
          "columns": [
                { "width": "10%" }, 
                { "width": "30%" }, 
                { "width": "20%" }, 
                { "width": "20%" }, 
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
        t_agenda.api().button().add( 0, {
            action: function ( e, dt, button, config ) {
                window.location.href = '<?= base_url('imagen/nuevAgenda') ?>'
            },
            text: '<i class="fa fa-money-check"></i> Nuevo',
            className: 'btn btn-primary boton-agregar' 
        } )
        $('.portadas button.baja').on('click',function(){
            var idPortada = $(this).attr('data-id')
            var valor = $(this).attr('data-value')
            $.confirm({
                title: 'Atención',
                content: 'Esta seguro de los datos ingresados?',
                buttons: {
                    si: {
                        text: 'si',
                        btnClass: 'btn-primary',
                        action: function(){
                            $.confirm({
                                title: 'Respuesta',
                                content: function(){
                                    var self = this
                                    return $.ajax({
                                        url: '<?= base_url('imagen/bajaPortada') ?>',
                                        method: 'POST',
                                        dataType: 'json',
                                        data: {
                                            id: idPortada,
                                            valor: valor
                                        }
                                    }).done(function(response){
                                        if(response.status == 200){
                                            toastr.success(response.message)
                                            setTimeout(function(){window.location.reload()},2500)
                                        }else{
                                            toastr.error(response.message)
                                        }
                                        self.close()
                                    }).fail(function(){
                                        toastr.error('Error, consulte con su administrador')
                                        self.close()
                                    })
                                }
                            })
                        }
                    },
                    no: function(){}
                }
            })
            //$.alert($(this).attr('data-id'))
        })
        $('.portadas button.eliminar').on('click',function(){
            var idPortada = $(this).attr('data-id')
            $.confirm({
                title: 'Atención',
                content: 'Esta seguro de los datos ingresados?',
                buttons: {
                    si: {
                        text: 'si',
                        btnClass: 'btn-primary',
                        action: function(){
                            $.confirm({
                                title: 'Respuesta',
                                content: function(){
                                    var self = this
                                    return $.ajax({
                                        url: '<?= base_url('imagen/eliminarPortada') ?>',
                                        method: 'POST',
                                        dataType: 'json',
                                        data: {
                                            id: idPortada,
                                        }
                                    }).done(function(response){
                                        if(response.status == 200){
                                            toastr.success(response.message)
                                            setTimeout(function(){window.location.reload()},2500)
                                        }else{
                                            toastr.error(response.message)
                                        }
                                        self.close()
                                    }).fail(function(){
                                        toastr.error('Error, consulte con su administrador')
                                        self.close()
                                    })
                                }
                            })
                        }
                    },
                    no: function(){}
                }
            })
            //$.alert($(this).attr('data-id'))
        })
        $('#videos-post').on('submit',function(e){
            e.preventDefault()
            $.alert({
                title: 'Atención',
                content: 'Esta seguro de los datos ingresados?',
                buttons: {
                    si: {
                        text: 'Si',
                        btnClass: 'btn-primary',
                        action: function(){
                            $.confirm({
                                title: 'Respuesta',
                                content: function(){
                                    var self = this
                                    return $.ajax({
                                        url: '<?= base_url("imagen/guardarVideo") ?>',
                                        method: 'post',
                                        dataType: 'json',
                                        data: {
                                            videopost: $('#video-post').val(),
                                            videomanual: $('#video-manual').val(),
                                            idvideopost: $('#video-post').attr('data-id'),
                                            idvideomanual: $('#video-manual').attr('data-id')
                                        }
                                    }).done(function(response){
                                        console.log(response)
                                        if(response.status == 200)
                                            toastr.success(response.message)
                                        else
                                            toastr.error(response.message)
                                        self.close()
                                    }).fail(function(){
                                        toastr.error('Error, consulte con su administrador')
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
        $('#nueva-portada').on('click',function(){
            $.confirm({
                title: 'Nueva Portada',
                columnClass: 'col-lg-6 col-md-6 col-sm-6 col-lg-offset-3 col-md-offset-3 col-sm-offset-3',
                content: `
                <div class="container">
                    <div class="row">
                        <div class="col-lg-5 col-md-5 col-sm-5">
                            <form enctype="multipart/form-data" method="post">
                                <div class="form-group">
                                    <label>Titulo</label>
                                    <input type="text" class="form-control" required name="titulo" placeholder="Titulo de la Portada">
                                </div>
                                <div class="form-group">
                                    <label>Contenido</label>
                                    <textarea class="form-control" name="contenido" placeholder="Es una breve descripción..."></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Imagen</label><br><label class="btn btn-success"><input type="file" name="imagen" class="hide" accept="image/x-png,image/jpg,image/jpeg">Subir imagen<label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                `,
                buttons: {
                    guardar: {
                        text: 'GUARDAR',
                        btnClass: 'btn-primary',
                        action: function(){
                            var self = this
                            $.confirm({
                                title: 'Atención',
                                content: 'Esta seguro de los datos ingresados?',
                                buttons: {
                                    si: {
                                        text: 'si',
                                        btnClass: 'btn-primary',
                                        action: function(){
                                            self.close()
                                            $.confirm({
                                                title: 'Respuesta',
                                                content: function(){
                                                    var self2 = this
                                                    return $.ajax({
                                                        url: '<?= base_url('imagen/nuevaPortada') ?>',
                                                        method: 'POST',
                                                        dataType: 'JSON',
                                                        contentType: false,
                                                        processData: false,
                                                        data: new FormData(self.$content.find('form')[0])
                                                    }).done(function(response){
                                                        console.log(response)
                                                        if(response.status == 200){
                                                            toastr.success(response.message)
                                                            setTimeout(function(){window.location.reload()},2500)
                                                        }else{
                                                            toastr.error(response.message)
                                                        }
                                                        self2.close()
                                                    }).fail(function(){
                                                        toastr.error('Error, consulte con su administrador')
                                                        self2.close()
                                                    })
                                                }
                                            })
                                        }
                                    },
                                    no: function(){}
                                }
                            })
                            return false
                        }
                    },
                    salir: function(){}
                }
            })
        })
    })
</script>