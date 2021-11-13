<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Renato Mtz">
    <meta name="theme-color" content="#6f42c1">
    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="<?=media(); ?>/css/main.css">
    <link rel="stylesheet" type="text/css" href="<?=media(); ?>/css/style.css">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?= $data['page_tag']?></title>
  </head>
  <body>
    <section class="material-half-bg">
      <div class="cover"></div>
    </section>
    <section class="login-content">
      <div class="logo">
        <h1><?= $data['page_title']?></h1>
      </div> 
      <div class="login-box flipped">
        <form id="formResetPass" name="formResetPass" class="forget-form" action="">
            <input type="hidden" id="idUser" name="idUser" value="<?=$data['UserID'];?>" required>
            <input type="hidden" id="txtEmail" name="txtEmail" value="<?=$data['UserEmail'];?>" required>
            <input type="hidden" id="txtToken" name="txtToken" value="<?=$data['UserToken'];?>" required>
          <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Cambiar Contraseña</h3>
          <div class="form-group">
            <input id="txtPassword" name="txtPassword" class="form-control" type="password" placeholder="Nueva Contraseña" required>
          </div>
          <div class="form-group">
            <input id="txtPasswordConfirm" name="txtPasswordConfirm" class="form-control" type="password" placeholder="Confirmar Contraseña" required>
          </div>
          <div class="form-group btn-container">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>RESTABLECER</button>
          </div>
        </form>
      </div>
    </section>
    <!-- Essential javascripts for application to work-->
    <script>
        const base_url = "<?= base_url(); ?>";
    </script>

    <script src="<?= media();?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= media();?>/js/popper.min.js"></script>
    <script src="<?= media();?>/js/bootstrap.min.js"></script>
    <script src="<?= media();?>/js/main.js"></script>
    <!-- The javascript plugin to display page loading on top-->
    <script src="<?= media();?>/js/plugins/pace.min.js"></script>
    <script src="<?= media();?>/js/plugins/sweetalert.min.js"></script>
    <script src="<?= media();?>/js/<?= $data['page_function_js']?>"></script>
    
  </body>
</html>