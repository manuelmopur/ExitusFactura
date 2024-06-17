<div class="wrapper wrapper-content">
  <div class="row">
      <div class="col-sm-3">
          <div class="widget style1 lazur-bg">
              <div class="row">
                  <div class="col-sm-3">
                      <i class="fa fa-edit fa-4x"></i>
                  </div>
                  <div class="col-sm-9 text-right">
                      <span> Inscripciones Pendientes </span>
                      <h2 id="inscripciones_pendientes" class="font-bold" > </h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-3">
          <div class="widget style1 navy-bg">
              <div class="row">
                  <div class="col-sm-3">
                      <i class="fa fa-users fa-4x"></i>
                  </div>
                  <div class="col-sm-8 text-right">
                      <span> Alumnos Registrados </span>
                      <h2 id="alumnos_registrados" class="font-bold" > </h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-3">
          <div class="widget style1 yellow-bg">
              <div class="row">
                  <div class="col-sm-3">
                      <i class="fa fa-file-alt fa-4x"></i>
                  </div>
                  <div class="col-sm-9 text-right">
                      <span> Comprobantes registrados </span>
                      <h2 id="comprobantes_registrados" class="font-bold"> </h2>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-sm-3">
          <div class="widget style1 red-bg">
              <div class="row">
                  <div class="col-sm-3">
                      <i class="fa fa-check fa-4x"></i>
                  </div>
                  <div class="col-sm-9 text-right">
                      <span> Creditos </span>
                      <h2 id="creditos" class="font-bold"></h2>
                  </div>
              </div>
          </div>
      </div>
  </div>  
</div>
<script type="text/javascript">
  $(function(){
    var inscripciones_pendientes = $.ajax({
        type:"post",
        url: '<?php echo base_url("admin/getInscripcionesPendientes" );?>',
        dataType: "json",
        async: false,
    }).responseJSON;  

    var alumnos_registrados = $.ajax({
        type:"post",
        url: '<?php echo base_url("admin/getAlumnosInscritos" );?>',
        dataType: "json",
        async: false,
    }).responseJSON; 

    var comprobantes_registrados = $.ajax({
        type:"post",
        url: '<?php echo base_url("admin/getComprobantesRegistrados" );?>',
        dataType: "json",
        async: false,
    }).responseJSON; 

    var creditos = $.ajax({
        type:"post",
        url: '<?php echo base_url("admin/getPagosEnCreditos" );?>',
        dataType: "json",
        async: false,
    }).responseJSON; 



    $('#inscripciones_pendientes').html(inscripciones_pendientes);
    $('#alumnos_registrados').html(alumnos_registrados);
    $('#comprobantes_registrados').html(comprobantes_registrados);
    $('#creditos').html(creditos);
  })
</script>