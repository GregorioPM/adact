<?php
$usuarios = $this->d['usuarios'];
$user = $this->d['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listado Usuarios</title>
</head>

<body>
  <?php require_once 'header.php'; ?>
  <div id="probar">
    <?php $this->showMessages(); ?>

  </div>
  <div class="page-content p-5 tama" id="content">
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"></small></button>
    <div class="container">
      <button type="button" class="btn btn-add" data-toggle="modal" data-target="#newDependencia">
        Registrar Usuario
      </button>
      <h2 class="titulo" style="text-align: center;">Listado de Usuarios</h2>


      <!-- Modal -->
      <div class="modal fade" id="newDependencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header mod-header">
              <h5 class="modal-title" id="exampleModalLongTitle"><b>Registrar Usuario</b></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?php echo constant('URL'); ?>/signup/newUser" method="POST">
                <div class="form-user">
                  <p>
                    <label for="correo"><b>Correo</b></label>
                    <input type="email" name="correo" id="correo">
                  </p>
                  <p>
                    <label for="password"><b>Contraseña</b></label>
                    <input type="text" name="password" id="password">
                  </p>
                  <p>
                    <label for="nombres"><b>Nombres</b></label>
                    <input type="text" name="nombres" id="nombres">
                  </p>
                  <p>
                    <label for="nombres"><b>Apellidos</b></label>
                    <input type="text" name="apellidos" id="apellidos">
                  </p>
                </div>
                <div class="modal-footer">
                  <button type="submit" name="dependencia" class="btn btn-registrar">Registrar</button>
                </div>

              </form>



            </div>

          </div>
        </div>
      </div>

      <table class="table mt-4 table-striped table-bordered width=" 80%"">
        <thead>
          <tr class="text-center">
            <th scope="col">Nombre</th>
            <th scape="col">Correo</th>
            <th scape="col">Rol</th>
            <th scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($usuarios as $u) {
          ?>
            <tr>

              <td class="text-center"><?php echo $u->getNombres() . " " . $u->getApellidos();  ?></td>
              <td class="text-center"><?php echo $u->getCorreo() ?></td>
              <td class="text-center"><?php echo $u->getRol() ?></td>

              <td class="text-center">

                <!--<a href="<?= URL ?>/admin/editDependencia?id=<?= $u->getId() ?>"><span class="material-icons action-update" data-toggle="modal" data-target="#exampleModalCenter">mode_edit</span></a>-->
                <?php if ($u->getRol() == "user") { ?>
                  <a href="<?= URL ?>/signup/deleteUser?id=<?= $u->getId() ?>"><span class="material-icons action-delete">delete</span></a>
                <?php } ?>
              </td>

            </tr>


          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php require_once 'views/footer.php'; ?>
  <script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>

</body>

</html>