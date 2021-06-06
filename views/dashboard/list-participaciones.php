<?php
$actas = $this->d['actas'];
$user = $this->d['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mis Participaciones</title>
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
        <a class="btn-a" href="<?php echo constant('URL'); ?>/admin/detalleActa">Agregar Acta</a>

      </button>
      <h2 class="titulo" style="text-align: center;">Listado de mis Participaciones en Actas</h2>

      <table class="table mt-4 table-striped table-bordered width=" 80%"">
        <thead>
          <tr class="text-center">
            <th scope="col">Id</th>
            <th scope="col">Asunto</th>
            <th scope="col">Fecha</th>
            <th scope="col">Lugar</th>
            <th scope="col">Estado</th>
            <th scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($actas as $acta) {
          ?>
            <tr>
              <td class="text-center"><?php echo $acta->getId(); ?></td>
              <td class="text-center"><?php echo $acta->getAsunto(); ?></td>
              <td class="text-center"><?php echo $acta->getFecha(); ?></td>
              <td class="text-center"><?php echo $acta->getLugar(); ?></td>
              <td class="text-center"><?php echo $acta->getEstado(); ?></td>

              <td class="text-center">

                <!--<a href="<?= URL ?>/admin/editDependencia?id=<?= $acta->getId() ?>"><span class="material-icons action-update" data-toggle="modal" data-target="#exampleModalCenter">mode_edit</span></a>-->

                <a href="<?= URL ?>/dashboard/detalleActa?id=<?= $acta->getId() ?>"><span class="material-icons action-edit">
                    edit
                  </span></a>
              
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