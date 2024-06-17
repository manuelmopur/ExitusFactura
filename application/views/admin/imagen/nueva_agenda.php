<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2 class="tituloPaginaActual">Imagen institucional</h2>
        <ol class="breadcrumb">
            <li><a href="<?= base_url() ?>">Inicio</a></li>
            <li class="active"><strong>Agenda</strong></li>
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
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label campoObligatorio">Titulo*</label>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <input type="text" class="form-control" name="titulo" required>
                                    </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label campoObligatorio">Fecha*</label>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <input type="text" class="form-control datepicker" name="fecha" required value="<?= date('Y-m-d') ?>">
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label campoObligatorio">Imagen</label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <label class="btn btn-success"><input type="file" name="imagen" class="hide" accept="image/x-png,image/jpg,image/jpeg"/>Subir imagen</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <label class="col-sm-3 control-label campoObligatorio">Descripción*</label>
                                <div class="col-lg-6 col-md-6 col-sm-6">
                                    <textarea class="form-control" name="descripcion" placeholder="Esta es la descripcion\nen la agenda"></textarea>
                                </div>  
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-3">
                                <a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Volver</a>
                                <button class="btn btn-primary" rows="15" type="submit"><i class="fa fa-save"></i> Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('.datepicker').datepicker({
            format: 'yyyy-mm-dd'
        });  
</script>