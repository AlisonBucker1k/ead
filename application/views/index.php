<!-- main content start -->
<div class="main-content">

    <!-- statistics data -->
    <div class="statistics">
        <!-- row 1 -->
        <div class="row">
            <div class="col-xl-12 pr-xl-2">
              <div class="card">
                  <div class="card-body">
                    <b>Link de convite:</b><br/>
                    <div class="input-group mb-3">
                      <input id="url" type="text" class="form-control" placeholder="Url" aria-label="Url" value="<?php echo site_url('inicio/index?&ref='.$this->session->userdata('minha_url')); ?>" readonly aria-describedby="basic-addon2">
                      <div class="input-group-append">
                        <button onclick="copiarURL()" type="button" class="btn btn-info"><i class="fa fa-link"></i> Copiar URL</button>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
      </div>


    <!-- data tables -->
    <div class="data-tables">
      <div class="row">
        <div class="col-lg-12 mb-4">
          <div class="card card_border p-4">
            <h3 class="card__title">Minha rede</h3>
            <div class="table-responsive">
              <table class="display data-table-index" style="width:100%">
                <thead>
                  <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                <?php foreach($cadastros as $sq){ ?>
                  <tr>
                    <td><?php echo $sq['id']; ?></td>
                    <td><?php echo $sq['nome']; ?></td>
                    <td>$<?php echo $sq['email']; ?></td>
                    </tr>
                <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
  </div>
  <!-- //content -->
</div>
<!-- main content end-->

<!-- Modal -->
    <div class="modal fade" id="modalAceitarSaque" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-check"></i> Concluir Saque</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="<?php echo site_url('admin/saques/responder_saque'); ?>" >
                        <div class="modal-body">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="resposta" value="1" />
                            <div class="alert alert-primary" role="alert">
Concluindo pedido de saque do usuário <b class="nmus"></b>
</div>
                          
                          <b>Detalhes do pedido:</b><br/>
                          Valor: <b class="vl"></b><br/>
                          <span class="text-danger">Taxa: <b class="tx"></b></span><br/>
                          <span class="text-info">Valor transferido: <b class="valt"></b></span><br/><br/>
                          <textarea name="hash_pagamento" class="form-control" rows="2" placeholder="hash de pagamento da transferência" required></textarea>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-success">Concluir Saque</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  
                  <!-- Modal -->
    <div class="modal fade" id="modalRejeitarSaque" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i> Estornar e Excluir Saque</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="<?php echo site_url('admin/saques/responder_saque'); ?>" >
                        <div class="modal-body">
                            <input type="hidden" name="id" />
                            <input type="hidden" name="resposta" value="0" />
                          <div class="alert alert-primary" role="alert">
Estornando e excluindo pedido de saque do usuário <b class="nmus"></b>
</div>
                          <b>Detalhes do pedido:</b><br/>
                          Valor: <b class="vl"></b><br/>
                          <span class="text-danger">Taxa: <b class="tx"></b></span><br/>
                          <span class="text-info">Valor transferido: <b class="valt"></b></span><br/>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                          <button type="submit" class="btn btn-success">Estornar e excluir</button>
                        </div>
                        </form>
                      </div>
                    </div>
                  </div>
<!-- Modal -->
    <div class="modal fade" id="modalInfoAss" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Informações da assinatura</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
<!-- Modal -->
    <div class="modal fade" id="modalInfoSq" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-info"></i> Informações do saque</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                        </div>
                      </div>
                    </div>
                  </div>
</section>
  <!--footer section start-->
<footer class="dashboard">
  <p>&copy 2020 <a href="https://agenciaennove.com.br/">Agência Ennove</a></p>
</footer>
<!--footer section end-->
<!-- move top -->
<button onclick="topFunction()" id="movetop" class="bg-primary" title="Ir ao topo">
  <span class="fa fa-angle-up"></span>
</button>
<script>
  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function () {
    scrollFunction()
  };

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      document.getElementById("movetop").style.display = "block";
    } else {
      document.getElementById("movetop").style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
  
  function copiarURL(){
      /* Get the text field */
      var copyText = document.getElementById("url");
    
      /* Select the text field */
      copyText.select();
      copyText.setSelectionRange(0, 99999); /*For mobile devices*/
    
      /* Copy the text inside the text field */
      document.execCommand("copy");
    
      /* Alert the copied text */
      alert("Url copiada: " + copyText.value);
  }
</script>
<!-- /move top -->


<script src="<?php echo site_url('assets'); ?>/assets/js/jquery-3.3.1.min.js"></script>
<script src="<?php echo site_url('assets'); ?>/assets/js/jquery-1.10.2.min.js"></script>

<!-- chart js -->
<!-- <script src="<?php echo site_url('assets'); ?>/assets/js/Chart.min.js"></script> -->
<script src="<?php echo site_url('assets'); ?>/assets/js/utils.js"></script>
<!-- //chart js -->

<!-- Different scripts of charts.  Ex.Barchart, Stackedchart, Linechart, Piechart -->
<!-- <script src="<?php echo site_url('assets'); ?>/assets/js/bar.js"></script>
<script src="<?php echo site_url('assets'); ?>/assets/js/stacked.js"></script>
<script src="<?php echo site_url('assets'); ?>/assets/js/linechart.js"></script>
<script src="<?php echo site_url('assets'); ?>/assets/js/pie.js"></script> -->
<!-- //Different scripts of charts.  Ex.Barchart, Stackedchart, Linechart, Piechart -->


<!-- //data tables js -->

<script src="<?php echo site_url('assets'); ?>/assets/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>




<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
<script src="<?php echo site_url('assets/summernote/dist/summernote-bs4.min.js'); ?>"></script>
<script src="<?php echo site_url('assets/summernote/js/summer.pt-BR.js'); ?>"></script>
<!-- data tables js -->
<script>
function geraAlerta(titulo, texto, footer="", tipomodal=""){
  if ($('#modal_aviso').length){
    $('#titulo_aviso').html(titulo);
    $('#modal_aviso .modal-body').html(texto);
    if (footer !== ""){
      if ($('#modal_aviso .modal-footer').length){
        $('#modal_aviso .modal-footer').html(footer);
      } else {
        $('#modal_aviso .modal-content').append('<div class="modal-footer">'+footer+'</div>');
      }
    } else {
      if ($('#modal_aviso .modal-footer').length) { $('#modal_aviso .modal-footer').remove(); }
    }
  } else {
    var modal = '<div id="modal_aviso" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="titulo_aviso" aria-hidden="true" style="display: none;">';
    modal += '<div class="modal-dialog '+tipomodal+'"><div class="modal-content"><div class="modal-header"><h4 class="modal-title" id="titulo_aviso">'+titulo+'</h4>';
    modal += '<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button></div><div class="modal-body">'+texto+'</div>';
    if (footer !== ""){
      modal += '<div class="modal-footer">'+footer+'</div>';
    }
    modal += '</div></div></div><!-- /.modal -->';
    $('body').append(modal);
  }
  $('#modal_aviso').modal('show');
}

function confirmaFechamentoTicket(url, id, titulo){
  var texto = '<b>Deseja realmente fechar o ticket #'+id+"?"+'</b>';
  var footer = '<button type="button" class="btn btn-light waves-effect" data-dismiss="modal">Não, cancelar</button>';
  footer += '<a href="'+url+'"><button type="button" class="btn btn-danger waves-effect">Sim, fechar ticket</button></a>';
  geraAlerta(titulo, texto, footer);
}
  $(document).ready(function () {
    if ($('.summernoteEditor').length){
      $('.summernoteEditor').summernote({
      lang: "pt-BR",
      height: 450,
      tabsize: 2
    });
    }

    if ($('.data-table-index').length){
        $('.data-table-index').DataTable(
            {
                "bInfo" : false,
                "oLanguage": {
                    "sProcessing":   "Processando...",
                    "sLengthMenu":   "Mostrar _MENU_ registros",
                    "sZeroRecords":  "Não foram encontrados resultados",
                    "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                    "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
                    "sInfoFiltered": "",
                    "sInfoPostFix":  "",
                    "sSearch":       "Buscar:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Primeiro",
                        "sPrevious": "Anterior",
                        "sNext":     "Seguinte",
                        "sLast":     "Último"
                    }
                }
            }
        );
    }
    
  });
</script>

<script src="<?php echo site_url('assets'); ?>/assets/js/faq.js"></script>

<script src="<?php echo site_url('assets'); ?>/assets/js/jquery.nicescroll.js"></script>
<script src="<?php echo site_url('assets'); ?>/assets/js/scripts.js"></script>

<!-- close script -->
<script>
  var closebtns = document.getElementsByClassName("close-grid");
  var i;

  for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function () {
      this.parentElement.style.display = 'none';
    });
  }
</script>
<!-- //close script -->

<!-- disable body scroll when navbar is in active -->
<script>
  $(function () {
    $('.sidebar-menu-collapsed').click(function () {
      $('body').toggleClass('noscroll');
    })
  });
</script>
<!-- disable body scroll when navbar is in active -->

 <!-- loading-gif Js -->
 <script src="assets/js/modernizr.js"></script>
 <script>
     $(window).load(function () {
         // Animate loader off screen
         $(".se-pre-con").fadeOut("slow");;
     });
 </script>
 <!--// loading-gif Js -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<!-- Bootstrap Core JavaScript -->
<script src="<?php echo site_url('assets'); ?>/assets/js/bootstrap.min.js"></script>


<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.pt-BR.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script>
    function concluir_saque(id, usuario, valor, taxa, val_liq){
        $('#modalAceitarSaque input[name="id"]').val(id);
        $('#modalAceitarSaque .nmus').html(usuario);
        $('#modalAceitarSaque .vl').html('$'+valor);
        $('#modalAceitarSaque .tx').html('$'+taxa);
        $('#modalAceitarSaque .valt').html('$'+val_liq);
        $('#modalAceitarSaque').modal('show');
    }
    
    function rejeitar_saque(id, usuario, valor, taxa, val_liq){
        $('#modalRejeitarSaque input[name="id"]').val(id);
        $('#modalRejeitarSaque .nmus').html(usuario);
        $('#modalRejeitarSaque .vl').html('$'+valor);
        $('#modalRejeitarSaque .tx').html('$'+taxa);
        $('#modalRejeitarSaque .valt').html('$'+val_liq);
        $('#modalRejeitarSaque').modal('show');
    }
    $(document).ready(function () {
        if ($('.selectpicker').length){    
       $('.selectpicker').selectpicker();
        }
        <?php if ($this->session->userdata('notif') != ""){ ?>
        var notif = '<div class="alert alert-<?php echo $this->session->userdata('notif_tipo'); ?> alert-dismissible fade show" role="alert"><strong><?php echo $this->session->userdata('notif_titulo'); ?></strong> <?php echo $this->session->userdata('notif'); ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>';
        $('.main-content .container-fluid.content-top-gap').prepend(notif);
        <?php $this->session->unset_userdata(array('notif', 'notif_titulo', 'notif_tipo')); } ?>
    });
    
    function informacoesAss(tipo, usuario, nome, valor, data){
        var innerhtml = "";
        if (tipo == "plano"){
            innerhtml += "<b class='text-success'>Plano Ativo</b><br/>";
        } else {
            innerhtml += "<b class='text-warning'>Volcher Ativo</b><br/>";
        }
        innerhtml += "<b class='text-primary'>Usuário: </b>"+usuario+"<br/>";
        innerhtml += "<b class='text-primary'>Plano: </b>"+nome+"<br/>";
        innerhtml += "<b class='text-primary'>Valor: </b>$"+valor+"<br/>";
        innerhtml += "<b class='text-primary'>Data de ativação: </b>"+data+"<br/>";
        $('#modalInfoAss .modal-body').html(innerhtml);
        $('#modalInfoAss').modal('show');
    }
    
    function info_saque(id, usuario, ip, data_pedido, hora_pedido, gAuth, hash_pagamento=''){
        var innerhtml = "";
        if (gAuth == 1){
            innerhtml += "<b class='text-success'>Google Authenticator Ativado</b><br/>";
        } else {
            innerhtml += "<b class='text-danger'>Google Authenticator Desativado</b><br/>";
        }
        innerhtml += "<b class='text-primary'>ID: </b>"+id+"<br/>";
        innerhtml += "<b class='text-primary'>Usuário: </b>"+usuario+"<br/>";
        innerhtml += "<b class='text-primary'>IP: </b>"+ip+"<br/>";
        innerhtml += "<b class='text-primary'>Data do pedido: </b>"+data_pedido+"<br/>";
        if (hash_pagamento != ''){
            innerhtml += "<b class='text-primary'>Hash do pagamento: </b>"+hash_pagamento+"<br/>";
            $('#modalInfoSq .modal-dialog').addClass('modal-lg');
        } else {
            if ($('#modalInfoSq .modal-lg').length){
                $('#modalInfoSq .modal-lg').removeClass('modal-lg');
            }
        }
        $('#modalInfoSq .modal-body').html(innerhtml);
        $('#modalInfoSq').modal('show');
    }
    $(document).ready(function () {
      if ($('.datepicker').length){
        $('.datepicker').datepicker({
            format: 'yyyy/mm/dd',
            startDate: '<?php echo date('Y-m-d'); ?>',
            language: 'pt-BR'
        });
      }
    });
</script>

<?php if (isset($script) && $script != ""){ ?>
<script>
    <?php echo $script; ?>
    
</script>
<?php } ?>
</body>

</html>
  