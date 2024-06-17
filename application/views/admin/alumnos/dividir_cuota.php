<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Dividir Cuota</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Dividir Cuota</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="dividir" class="form-horizontal" method="post" accept-charset="utf-8" >
                        <div class="form-group">
                            <label class="col-sm-3 control-label campoObligatorio">Monto de Cuota a Dividir</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="text" class="form-control" name="cuota_1" value="<?= $cuota->Monto ?>" readonly required>
                                </div>  
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label campoObligatorio">Monto de Nueva Cuota</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="text" class="form-control" name="cuota_2" placeholder="000.00" required>
                                </div>  
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label campoObligatorio">Fecha de Expiracion de Nueva Cuota</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="text" class="form-control datepicker" name="fecha_expiracion" required>
                                </div>                                      
                        </div>
                        <div class="form-group">
                            <div class="col-lg-6 col-md-6 col-sm-6">
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
		$('#dividir').on('submit',function(e){
            e.preventDefault()
            var data = $('#dividir').serialize()
            $.confirm({
                title: 'Atención',
                content: '¿Estás seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Dividiendo cuota...',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= base_url('alumnos/dividircuota/').$cuota->id."/".$cuota->Pagos_id."/".$id_alumno ?>',
                                    method: 'post',
                                    dataType: 'JSON',
                                    data: data
                                }).done(function(response){
                                    if(response.status == 200){
                                        toastr.success('Edición Satisfactoria')                                        
                                        setTimeout(function(){window.location.href = '<?= base_url('alumnos/index/').$id_alumno ?>'},2500)
                                    }                                    
                                    else{
                                        toastr.error('Error')
                                    }self.close()
                                }).fail(function(){
                                    toastr.error('Error en la Edición consulte con su administrador')
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