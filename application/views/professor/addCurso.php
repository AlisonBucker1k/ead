<!-- Page Content -->

<div class="py-32pt navbar-submenu">
    <div class="container page__container">
        <div class="progression-bar progression-bar--active-accent">
            <!-- <a href="pricing.html"
                class="progression-bar__item progression-bar__item--complete">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon">done</i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Pricing</span>
                </span>
            </a>
            <a href="signup.html"
                class="progression-bar__item progression-bar__item--complete progression-bar__item--active">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Account details</span>
                </span>
            </a>
            <a href="signup-payment.html"
                class="progression-bar__item">
                <span class="progression-bar__item-content">
                    <i class="material-icons progression-bar__item-icon"></i>
                    <span class="progression-bar__item-text h5 mb-0 text-uppercase">Payment details</span>
                </span>
            </a> -->

            <span class="progression-bar__item-text h5 mb-0 text-uppercase">
                Cadastro de Cursos
            </span>
        </div>
    </div>
</div>

<div class="page-section container page__container">
    <div class="col-lg-10 p-0 mx-auto">
        <div class="row">
            <div class="col-md-6 mb-24pt mb-md-0">
                <form action="<?php echo base_url();?>admin/cursos/inserir" enctype="multipart/form-data" method="POST">
                    <div class="form-group">
                        <label class="form-label"
                                for="name">Modalidade:</label>
                        <select name="id_modalidade" class="form-control">
                            <option value="">Selecionar Modalidade</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="foto">Nome:</label>
                                <input id="login"
                                type="text"
                                class="form-control"
                                placeholder="Login" name="nome">
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Capa:</label>
                        <input id="file"
                                type="text"
                                class="form-control"
                                placeholder="Login" name="capa">
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Status:</label>
                        <select name="id_modalidade" class="form-control">
                            <option value="">Selecionar Status</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Venda:</label>
                        <input id="file"
                                type="text"
                                class="form-control"
                                placeholder="Venda" name="venda">
                    </div>

                    <div class="form-group">
                        <label class="form-label"
                                for="name">Assinatura:</label>
                        <input id="file"
                                type="text"
                                class="form-control"
                                placeholder="Assunatura" name="assinatura">
                    </div>

                    <button class="btn btn-primary">Cadastrar novo Curso</button>
                </form>
            </div>
            <div class="col-md-6">
                <div class="card mb-0">
                    <div class="card-body">
                        <h5>Inserir</h5>
                        <div class="d-flex mb-8pt">
                            <div class="flex"><strong class="text-70"></strong></div>
                            <strong></strong>
                        </div>

                        <div class="alert alert-soft-warning">
                            <div class="d-flex flex-wrap align-items-start">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="removerCampo()">
                                    Cadastrar Modalidade
                                </button>
                            </div>
                        </div>

                        <div class="alert alert-soft-warning">
                            <div class="d-flex flex-wrap align-items-start">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalAulas" onclick="removerCampo()">
                                    Cadastrar Aula
                                </button>
                            </div>
                        </div>

                        

                        <div class="d-flex mb-16pt pb-16pt border-bottom">
                            <!-- <div class="flex"><strong class="text-70">Price</strong></div>
                            <strong>US &dollar;9 per month</strong> -->
                        </div>
                        <div class="custom-control custom-checkbox">
                            <!-- <input type="checkbox"
                                    class="custom-control-input"
                                    checked
                                    id="topic-all">
                            <label class="custom-control-label">Terms and conditions</label>
                            <small class="form-text text-muted">By checking here and continuing, I agree to the Luma Terms of Use</small> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- // END Page Content -->

<!-- Modal Modalidades -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" style="z-index: 5000;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modalidade</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="">
            <div class="modal-body">
            <div class="form-group">
                        <label class="form-label"
                                for="name">Modalidade:</label>
                        <input id="nome"
                                type="text"
                                class="form-control"
                                placeholder="Nome da modalidade" name="modalidade">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Inserir Modalidade</button>
            </div>
        </form>
    </div>
  </div>
</div>
<!-- Modal Aulas -->
<div class="modal fade" id="exampleModalAulas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" style="z-index: 5000;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Inserir Aulas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <form action="">
            <div class="modal-body">
            <div class="form-group">
                        <label class="form-label"
                                for="name">Modalidade:</label>
                        <input id="nome"
                                type="text"
                                class="form-control"
                                placeholder="Nome da modalidade" name="modalidade">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-primary">Inserir Modalidade</button>
            </div>
        </form>
    </div>
  </div>
</div>

<script>
    function removerCampo(){

        setTimeout(function() {
            $('.modal-backdrop').remove();
        }, 700);

        
    }
</script>
