<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Editar Comentario</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Editar Comentario</strong></li>
        </ol>
    </div>
    <div class="col-lg-2"></div>
</div> 
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="ibox">
                <div class="ibox-content">
                    <form id="editar" class="form-horizontal" method="post" accept-charset="utf-8" >
                        <div class="form-group">
                            <label class="col-sm-6 control-label campoObligatorio">Comentario a Editar</label>
                            </br></br>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <textarea class="form-control" rows="10" cols="30" name="comentario" required><?= $comentario->Comentario ?></textarea>
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
		$('#editar').on('submit',function(e){
            e.preventDefault()
            var data = $('#editar').serialize()
            $.confirm({
                title: 'Atención',
                content: '¿Estás seguro de los datos ingresados?',
                buttons: {
                    si: function(){
                        $.confirm({
                            title: 'Editando comentario...',
                            content: function(){
                                var self = this
                                return $.ajax({
                                    url: '<?= base_url('comentarios/editar/').$id_comentario.'/'.$id_usuario.'/'.$id_alumno ?>',
                                    method: 'post',
                                    dataType: 'JSON',
                                    data: data
                                }).done(function(response){
                                    if(response.status == 200){
                                        toastr.success('Edición Satisfactoria')                                        
                                        setTimeout(function(){window.location.href = '<?= base_url('comentarios/index/').$id_alumno ?>'},2500)
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