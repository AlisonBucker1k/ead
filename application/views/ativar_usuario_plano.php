<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- estilo -->
    <link href="<?php echo site_url('assets/').'estilo.css'; ?>" rel="stylesheet">
    
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <title>API</title>
  </head>
  <body>

    <main>
        <div class="container">
            <h3>ATIVAR PLANO USUÁRIO</h3><br/>
        <form method="post" action="<?php echo site_url('api/sending_plano_atv'); ?>">
            <div class="form-group">
                <label for="exampleInputEmail1">Senha Admin</label>
                <input name="senha" type="password" class="form-control" id="senha" aria-describedby="emailHelp" required placeholder="Senha">
              </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Usuário</label>
                <select class="selectpicker form-control" name="usuario" data-live-search="true" >
                    <?php foreach($usuarios as $us){
                        echo '<option value="'.$us['id'].'">'.$us['login'].'</option>';
                    } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Plano</label>
                <select class="selectpicker form-control" name="plano" data-live-search="true" >
                    <?php foreach($planos as $us){
                        echo '<option value="'.$us['id'].'">'.$us['nome'].'</option>';
                    } ?>
                </select>
              </div>
              <button type="submit" class="btn btn-block btn-info">Ativar</button>
        </form>
        </div>
    </main><!-- /.container -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script>
    $(document).ready(function () {
       $('.selectpicker').selectpicker(); 
    });
</script>
  </body>
</html>
