<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Noticias</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Noticias</strong></li>
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
                        <a class="nav-link" data-toggle="tab" href="#lista"><i class="fa fa-newspaper"></i> Noticias</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#informacion"><i class="fa fa-file-alt"></i> Información</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="lista">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="table-responsive">
                                            <table class="table tabla_noticias display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                <thead>
                                                    <tr>
                                                        <th>Codigo</th>
                                                        <th>Titulo</th>
                                                        <th>Fecha</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(!is_numeric($noticias)) foreach ($noticias as $key => $value) { ?>
                                                        <tr>
                                                            <td><?= $value->codigo ?></td>
                                                            <td><?= $value->persona ?></td>
                                                            <td><?= $value->turno ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-primary ver" type="button" data-toggle="tooltip" data-placement="top" title="Ver" data-info="<?= $value->codigo.' - '.$value->persona ?>" data-id="<?= $value->id_alumno ?>"><i class="fa fa-eye"></i></button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="informacion">
                        <div class="panel-body">
                            <div class="row">
                                <div>
                                    <div class="ibox">
                                        <div class="ibox-title">
                                            <h5>Noticia</h5>
                                        </div>
                                        <div class="ibox-content ">
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label>Titulo</label>
                                                            <input type="text" name="titulo" class="form-control" placeholder="TITULO DE LA NOTICIA" style="text-transform: uppercase;">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <label>Contenido</label>
                                                            <textarea class="form-control" name="contenido" placeholder="Noticia...."></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6">
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <center>
                                                                <h4>Lista de adjuntos</h4>
                                                            </center>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                                            <div class="table-responsive">
                                                                <table class="table tabla_adjuntos display table-striped table-bordered table-hover" style="width: 100% !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>#</th>
                                                                            <th>Tipo</th>
                                                                            <th>Nombre</th>
                                                                            <th>&nbsp;</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-sm-12">
                                                    <center>
                                                        <button type="button" class="btn btn-success" title="Guardar Noticia" data-placement="top" data-toggle="tooltip"><i class="fa fa-save"></i> Guardar</button>
                                                    </center>
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
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };

        var t_noticias = $('.tabla_noticias').dataTable({
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

        var t_adjuntos = $('.tabla_adjuntos').dataTable({
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
        t_adjuntos.api().button().add( 0, {
            action: function ( e, dt, button, config ) {
                //window.location.href = '<?= base_url('preinscripcion/nuevo') ?>'
            },
            text: '<i class="fa fa-plus"></i> Nuevo',
            className: 'btn btn-primary boton-agregar' 
        } )
	})
</script>