<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Lista de Usuarios</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Lista de Usuarios</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox">
                <div class="ibox-title">
                    <h5>Lista de Usuarios</h5>
                </div>
                <div class="ibox-content">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th class="center">Id</th>
                                    <th class="center">Nombres</th>
                                    <th class="center">Usuario</th>
                                    <th class="center">Rol</th>
                                    <th class="center">Sede</th>
                                    <th class="center">Estado</th>
                                    <th class="center">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(!is_numeric($usuarios)) foreach ($usuarios as $key => $value) { ?>
                                    <tr>
                                        <td class="center"><?= $value->id_usuario ?></td>
                                        <td><?= $value->nombres.' '.$value->apellidos ?></td>
                                        <td><?= $value->usuario ?></td>
                                        <td><?= $value->nombre ?></td>
                                        <td class="center"><?= $value->sede ?></td>
                                        <td class="center"><?= $value->estado == 1 ? 'Activo' : 'Inactivo' ?></td>
                                        <td class="center">
                                            <div class="btn-group">
                                                <a href="<?= base_url('usuarios/editar/'.$value->id_usuario) ?>" class="btn btn-success" data-id="<?= $value->id_usuario ?>" data-toggle="tooltip" data-placement="top" title="Editar Usuario"><i class="fa fa-edit"></i></a>
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
<script type="text/javascript">
    $(function(){
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        var t = $('.table').dataTable({
          "columns": [
            { "width": "10%" }, 
            { "width": "30%" }, 
            { "width": "10%" }, 
            { "width": "10%" }, 
            { "width": "20%" }, 
            { "width": "10%" }, 
            { "width": "10%" }, 
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
        t.api().button().add( 0, {
            action: function ( e, dt, button, config ) {
                window.location.href = '<?= base_url('usuarios/nuevo') ?>'
            },
            text: '<i class="fa fa-plus"></i> Nuevo',
            className: 'btn btn-primary boton-agregar' 
        } )
    })
</script>