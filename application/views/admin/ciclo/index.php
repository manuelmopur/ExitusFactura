<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Ciclo</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Ciclo</strong></li>
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
                        <a class="nav-link" data-toggle="tab" href="#lista_areas"><i class="fa fa-user"></i> Lista de Areas</a>
                    </li>
                    <li class="active show">
                        <a class="nav-link" data-toggle="tab" href="#ciclo"><i class="fa fa-users"></i> Crear Ciclo</a>
                    </li>
                    <li class="">
                        <a class="nav-link" data-toggle="tab" href="#areas"><i class="fa fa-user"></i> Revisar Codigo de Areas</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane" id="lista_areas">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="">
                                            <form id="item_form_ciclo" class="form-horizontal" method="post" accept-charset="utf-8" >
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label campoObligatorio">Nombre de area</label>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="text" class="form-control" name="nombre" id="nombre-area" placeholder="Ciencias" required>
                                                    </div>  
                                                    <button class="btn btn-success" id="editar-area" type="button"> <i class="fa fa-save"></i> Guardar</button>
                                                    <button class="btn btn-success" id="nueva-area" style="display: none;" type="button"><i class="fa fa-plus"></i> Nuevo</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tabel-responsive">
                                            <table class="table tabla_areas display table-striped table-bordered table-hover center">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Nombre de Area</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($areas as $key => $area){ ?>
                                                        <tr>
                                                            <td><?= ($key+1) ?></td>
                                                            <td><?= $area->Descripcion ?></td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <button class="btn btn-primary editar" type="button" title="Editar" data-id="<?= $area->id ?>" data-data="<?= $area->Descripcion ?>"><i class="fa fa-edit"></i></button>
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
                    <div class="tab-pane active" id="ciclo">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class=""><!--col-md-offset-4-->
                                            <form id="item_form_ciclo" class="form-horizontal" method="post" accept-charset="utf-8" >
                                                
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label campoObligatorio">Descripcion</label>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="text" class="form-control center" name="descripcion" placeholder="Verano 2020" required>
                                                    </div>  
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label campoObligatorio">Fecha de Inicio</label>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="text" class="form-control center datepicker" name="fecha_inicio" placeholder="<?= date('d-m-Y') ?>" value="<?= date('d-m-Y') ?>" required>
                                                    </div>  
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label campoObligatorio">Fecha de Fin</label>
                                                    <div class="col-lg-3 col-md-3 col-sm-3">
                                                        <input type="text" class="form-control center datepicker" name="fecha_fin" placeholder="<?= date('d-m-Y') ?>" required>
                                                    </div>  
                                                </div>
                                                
                                                
                                                <div class="form-group">
                                                    </br>
                                                    <label class="col-lg-12 col-md-12 col-sm-12 center" style="font-size: 20px"><u>Códigos de Áreas</u></label>
                                                    </br>
                                                    </br>
                                                    <div style="display: inline-block;">
                                                        <?php if(!is_numeric($areas)) foreach ($areas as $key => $value) { ?>
                                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                                <div class="form-group">
                                                                    <label class="col-sm-4 control-label campoObligatorio"><?= $value->Descripcion ?></label>
                                                                    <div class="col-lg-4 col-md-4 col-sm-4">
                                                                        <input type="text" class="form-control center" maxlength="2" name="<?= $value->id ?>" required>
                                                                    </div>  
                                                                </div>
                                                            </div>
                                                               
                                                        <?php } ?>
                                                    </div>
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                                        <center>
                                                            <a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                                            <button type="submit" class="btn btn-primary" id="guardar"><i class="fa fa-save"></i> Guardar</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="areas">
                        <div class="panel-body">
                            <div class="row">
                                <div class="ibox">
                                    <div class="ibox-content">
                                        <div class="form-group">
                                            <label class="col-sm-1 control-label">Ciclo</label>
                                            <div class="col-lg-4 col-md-4 col-sm-4">
                                                <select class="form-control" required name="ciclo" id="ciclo">
                                                    <?php if(isset($ciclos)) foreach ($ciclos as $key => $value) { ?>
                                                        <option value="<?= $value->id ?>"><?= $value->Descripcion ?></option>
                                                    <?php } ?>                                
                                                </select>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                <button type="button" class="btn btn-primary" id="buscar"><i class="fa fa-search"></i> Buscar</button>
                                            </div>
                                            <div class="col-lg-1 col-md-1 col-sm-1">
                                                <button type="button" class="btn btn-primary" style="display: none;" id="editar"><i class="fa fa-search"></i> Editar</button>
                                            </div>
                                        </div>    
                                    </div>
                                </div>
                                <div class="ibox">
                                    <div class="ibox-content">
                                        </br><label class="col-lg-12 col-md-12 col-sm-12 center" style="font-size: 20px"><u>Códigos de Áreas</u></label></br></br>
                                        <div class="" style="display: inline-block;">
                                            <form id="item_form_area" class="form-horizontal" method="post" accept-charset="utf-8">
                                            
                                            </form>
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
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy'
        }); 
        var tabla_areas = $('.tabla_areas').dataTable({
            "pageLength": 50,
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
          }
        }) 
        var cargarFuncionalidades = function(){
            $('table.tabla_areas tbody tr td button.editar').unbind('click')
            $('table.tabla_areas tbody tr td button.editar').on('click',function(){
                $('#nombre-area').val($(this).attr('data-data'))
                $('#editar-area').attr('data-id',$(this).attr('data-id'))
                $('#editar-area').removeClass('btn-success').addClass('btn-primary')
                $('#nueva-area').show()
            })
            $('#nueva-area').unbind('click')
            $('#nueva-area').on('click',function(){
                $('#nombre-area').val('')
                $('#editar-area').removeAttr('data-id')
                $('#editar-area').removeClass('btn-primary').addClass('btn-success')
                $('#nueva-area').hide()
            })
        }
        cargarFuncionalidades()
        $('#editar-area').on('click',function(){
            var idArea = $(this).attr('data-id')
            if(typeof idArea === 'undefined'){
                if($('#nombre-area').val() == ''){
                    toastr.error('Seleccione al menos una area a editar')
                    return false
                }else{
                    $.confirm({
                        title: 'Atención',
                        content: 'Esta seguro de los datos ingresados?',
                        buttons: {
                            si: function(){
                                $.confirm({
                                    title: 'Resultado',
                                    content: function(){
                                        var self = this
                                        return $.ajax({
                                            url: '<?= base_url("ciclos/registrarArea")  ?>',
                                            method: 'POST',
                                            dataType: 'JSON',
                                            data: {
                                                nombre: $('#nombre-area').val()
                                            }
                                        }).done(function(response){
                                            if(response.status == 200){
                                                toastr.success(response.message)
                                                window.location.reload()
                                            } 
                                            else toastr.error(response.message) 
                                            self.close()
                                        }).fail(function(){
                                            toastr.error('Error, consulte con su administrador')
                                            self.close()
                                        })
                                    }
                                })
                            },
                            no: function(){}
                        }
                    })
                }
            }else{
                $.confirm({
                    title: 'Atención',
                    content: 'Esta seguro de los datos ingresados?',
                    buttons: {
                        si: function(){
                            $.confirm({
                                title: 'Resultado',
                                content: function(){
                                    var self = this
                                    return $.ajax({
                                        url: '<?= base_url("ciclos/actualizaArea")  ?>',
                                        method: 'POST',
                                        dataType: 'JSON',
                                        data: {
                                            nombre: $('#nombre-area').val(),
                                            id: idArea
                                        }
                                    }).done(function(response){
                                        if(response.status == 200){
                                            toastr.success(response.message)
                                            window.location.reload()
                                        } 
                                        else toastr.error(response.message) 
                                        self.close()
                                    }).fail(function(){
                                        toastr.error('Error, consulte con su administrador')
                                        self.close()
                                    })
                                }
                            })
                        },
                        no: function(){}
                    }
                })
            }
        })
        $('#buscar').on('click',function(){
            var valor = $('select#ciclo').val()
            $("#item_form_area").html('')
            // $('#editar').hide()
            $.confirm({
                title: 'Buscando',
                content: function(){
                    var self = this
                    return $.ajax({
                        url: '<?= base_url('ciclos/getCodigos') ?>',
                        method: 'POST',
                        dataType: 'json',
                        data: {
                            valor: valor
                        }
                    }).done(function(response){
                        if(response.status == 200){
                            //toastr.success('')
                            console.log(response.data)
                            var ac = response.data
                            for(var i in ac){
                                var fieldHTML = '<div class="col-lg-4 col-md-4 col-sm-4"><div class="form-group"><label class="col-sm-4">'+ac[i].Descripcion+'</label><div class="col-lg-4 col-md-4 col-sm-4"><input type="text" class="form-control center" name="'+ac[i].Descripcion+'" value="'+ac[i].codigo+'" readonly required></div></div></div>' //New input field html  
                                $('#item_form_area').append(fieldHTML); // Add field html
                            }
                            $('[data-toggle="tooltip"]').tooltip()
                            // $('#editar').show()
                        }   else{
                            toastr.error('Error, consulte con su administrador')
                        }
                            self.close()
                    }).fail(function(){
                        toastr.error('Error en la consulta')
                        self.close()
                    })
                }
            })                  
        });
        $('#item_form_ciclo').on('submit',function(e){
            e.preventDefault()
            var data = $('#item_form_ciclo').serialize()
            $.confirm({
                title: 'Atención',
                content: '¿Estás seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Insertando nuevo ciclo',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= base_url('ciclos/index') ?>',
                                    method: 'post',
                                    dataType: 'JSON',
                                    data: data
                                }).done(function(response){
                                    if(response.status == 200){
                                        toastr.success('Inserción Satisfactoria')                                        
                                        setTimeout(function(){window.location.href = '<?= base_url('ciclos') ?>'},2500)
                                    }                                    
                                    else{
                                        toastr.error('Error')
                                    }self.close()
                                }).fail(function(){
                                    toastr.error('Error en la Inserción consulte con su administrador')
                                    self.close()
                                })
                            }
                        })
                    },
                    no: function(){}
                }
            })
        })        
	})
</script>