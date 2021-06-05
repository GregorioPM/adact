<?php
$dependencias = $this->d['dependencias'];
$user = $this->d['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php require_once 'header.php'; ?>
  <div id="probar">
    <?php $this->showMessages(); ?>

  </div>
  <div class="page-content p-5 tama" id="content">


    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"></small></button>
    <div class="container">
      <button type="button" class="btn btn-registrar" data-toggle="modal" data-target="#newDependencia">
        Agregar Dependencia
      </button>
      <h2 class="titulo" style="text-align: center;">Listado de Dependencias</h2>

      <!-- Modal -->
      <div class="modal fade" id="newDependencia" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header mod-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Registrar Dependencia</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="form-expense-container" action="<?php echo constant('URL'); ?>/dependencia/crearDependencia" method="POST">
                <div class="form-user">
                  <div class="section">
                    <label for="amount"><b>Nombre</b></label>
                    <input type="hidden" name="id">
                    <input type="text" name="dependenciaa" id="color"" autocomplete=" off" required>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="dependencia" class="btn btn-registrar">Registrar</button>
            </div>
            </form>
          </div>
        </div>
      </div>
      <table class="table mt-4 table-striped table-bordered width=" 80%"">
        <thead>
          <tr class="text-center">
            <th scope="col">Dependencia</th>
            <th scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($dependencias as $dependencia) {
          ?>
            <tr>

              <td class="text-center"><?php echo $dependencia->getDependencia(); ?></td>
              <td class="text-center">

                <!--<a href="<?= URL ?>/admin/editDependencia?id=<?= $dependencia->getId() ?>"><span class="material-icons action-update" data-toggle="modal" data-target="#exampleModalCenter">mode_edit</span></a>-->
                <button type="button" class="btn action-update" data-toggle="modal" data-target="#editDependencia<?php echo $dependencia->getId(); ?>"><i class="fas fa-edit"></i></button>
                <a href="<?= URL ?>/dependencia/deleteDependencias?id=<?= $dependencia->getId() ?>"><span class="material-icons action-delete">delete</span></a>
              </td>

            </tr>
            <?php include('updateDependencia.php'); ?>

          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>

  <?php require_once 'views/footer.php'; ?>
  <script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>

</body>

</html>