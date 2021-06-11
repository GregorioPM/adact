<title>Perfil</title>
<?php
$user = $this->d['user'];

?>
<?php require_once 'header.php'; ?>
<div id="probar">
  <?php $this->showMessages(); ?>

</div>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
  <!-- Toggle button -->
  <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"></small></button>

  <div class="container">

    <div class="row justify-content-md-center mx-auto col-md-10">
      <h2 class="titulo" style="text-align: center;">Actualizar Perfil</h2>


      <form class="col-md-10 acta" action="<?php echo constant('URL') ?>/signup/updateUser" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
          <label for="inputEmail4"><b>Email</b></label>
          <input type="email" name="correo" class="form-control" id="inputEmail4" value="<?php echo $user->getCorreo(); ?>">
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputPassword4"><b>Nombres</b></label>
            <input type="text" name="nombres" class="form-control" id="inputPassword4" value="<?php echo $user->getNombres(); ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress"><b>Apellidos</b></label>
            <input type="text" name="apellidos" class="form-control" id="inputAddress" value="<?php echo $user->getApellidos(); ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="inputEmail4"><b>Telefono</b></label>
            <input type="text" name="telefono" class="form-control" id="inputEmail4" value="<?php echo $user->getTelefono(); ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress"><b>Cargo</b></label>
            <input type="text" name="cargo" class="form-control" id="inputAddress" value="<?php echo $user->getCargo(); ?>">
          </div>
        </div>

        <div class="form-group img-per">
          <label for="inputEmail4"><b>Foto Perfil</b></label>
          <br>
          <?php
          if (!empty($user->getFoto())) {
          ?>
            <img class="img-perfil" src="<?php echo constant('URL') ?>/public/img/fotos/<?php echo $user->getFoto(); ?>" width="200" height="200" />
          <?php
          } else {
          ?>
            <img src="<?php echo constant('URL') ?>/public/img/logo.png" width="300" height="300" />
          <?php
          }
          ?>
          <br>
          <label for="photo">Foto de perfil</label>

          <input style="border: none;" type="file" name="photo" id="photo" autocomplete="off">



        </div>



        <button type="submit" class="btn mt-4 btn-registrar float-right">Actualizar</button>
      </form>


    </div>
  </div>

</div>
<?php require_once 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>


</body>

</html>