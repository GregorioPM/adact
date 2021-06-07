<?php
$compromisos = $this->d['compromisos'];
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

      <h2 class="titulo" style="text-align: center;">Listado de mis Compromisos en Actas</h2>

      <table class="table mt-4 table-striped table-bordered width=" 80%"">
        <thead>
          <tr class="text-center">
            <th scope="col">Id</th>
            <th scope="col">Compromiso</th>
            <th scope="col">Fecha Compromiso</th>

            <th scope="col">Acta</th>
            <th scope="col">Acciones</th>

          </tr>
        </thead>
        <tbody>
          <?php
          foreach ($compromisos as $c) {
          ?>
            <tr>
              <td class="text-center"><?php echo $c->getId(); ?></td>
              <td class="text-center"><?php echo $c->getCompromiso(); ?></td>
              <td class="text-center"><?php echo $c->getFecha(); ?></td>
              <td class="text-center"><?php echo $c->getIdActa(); ?></td>


              <td class="text-center">


                <a href="<?= URL ?>/dashboard/detalleActa?id=<?php echo $c->getIdActa() ?>"><span class="material-icons action-edit">
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