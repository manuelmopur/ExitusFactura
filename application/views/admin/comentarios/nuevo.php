<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Nuevo Comentario</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Nuevo Comentario</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="nuevo" class="form-horizontal" method="post" accept-charset="utf-8" >
                        <div class="form-group">
                            <label class="col-sm-6 control-label campoObligatorio">Comentario a Agregar</label>
                            </br></br>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="form-control" rows="10" cols="30" name="comentario" required></textarea>
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
		$('#nuevo').on('submit',function(e){
            e.preventDefault()
            var data = $('#nuevo').serialize()
            $.confirm({
                title: 'Atención',
                content: '¿Estás seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Agregando comentario...',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= base_url('comentarios/nuevo/').$id_alumno ?>',
                                    method: 'post',
                                    dataType: 'JSON',
                                    data: data
                                }).done(function(response){
                                    if(response.status == 200){
                                        toastr.success('Registro Satisfactorio')                                        
                                        setTimeout(function(){window.location.href = '<?= base_url('comentarios/index/').$id_alumno ?>'},2500)
                                    }                                    
                                    else{
                                        toastr.error('Error')
                                    }self.close()
                                }).fail(function(){
                                    toastr.error('Error en el Registro consulte con su administrador')
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