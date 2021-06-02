<title>Detalle acta</title>
<?php
$user = $this->d['user'];
$dependencias = $this->d['dependencias'];
$usuarios = $this->d['usuarios'];

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
      <h2 class="titulo">Registrar Información Del Acta</h2>

      <form class="col-md-10 acta" action="<?php echo constant('URL') ?>/acta/newActa" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
          <label for="inputPassword4"><b>Asunto</b></label>
          <input type="text" name="asunto" class="form-control" id="inputPassword4">
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="actaLugar"><b>Lugar</b></label>
            <input type="text" name="lugar" class="form-control" id="actaLugar" value="">
          </div>
          <div class="form-group col-md-4">
            <label for="inputAddress"><b>Fecha</b></label>
            <input type="date" name="fecha" class="form-control" min="2014-01-01" max="2100-12-31" id="inputAddress" value="<?php echo $user->getApellidos(); ?>">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="inputPassword4"><b>Hora Inicio</b></label>
            <input type="time" name="horaInicio" class="form-control" id="inputPassword4" value="<?php echo $user->getNombres(); ?>">
          </div>
          <div class="form-group col-md-3">
            <label for="inputAddress"><b>Hora Final</b></label>
            <input type="time" name="horaFinal" class="form-control" id="inputAddress" value="<?php echo $user->getApellidos(); ?>">
          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress"><b>Dependencia</b></label>
            <select name="dependencia" class="form-control">
              <option value="">Seleccione:</option>
              <?php

              foreach ($dependencias as $dependencia) :
                echo '<option value="' . $dependencia->getId() . '">' . $dependencia->getDependencia() . '</option>';
              endforeach;
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword4"><b>Orden del dia</b></label>
          <input type="text" name="orden" class="form-control" id="inputPassword4">
        </div>
        <div class="form-group">
          <label for="inputPassword4"><b>Conclusiones</b></label>
          <br>
          <textarea class="rounded" name="conclusiones" id="conclu" cols="100" rows="10"></textarea>
        </div>
        <div class="form-group">
          <div class="input-group mt-4">
            <label for="inputPassword4"><b>Agregar Temas</b></label>
            <div class="abajoInput">
              <input type="text" name="temas" class="form-control rounded" id="temas" placeholder="Agregar Temas">
              <button type="button" id="enviarTemas" class="btn ml-2 btn-form">Agregar</button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <table id="tablaTemas" class="table mt-4 table-striped table-bordered tablelist" style="display: none;">
            <thead>
              <tr class="text-center">
                <th scope="col">Temas</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody id="salida">

            </tbody>
          </table>
        </div>
        <div class="form-group">
          <div class="input-group mt-4">
            <label for="exampleDataList"><b>Agregar Participantes</b></label>
            <div class="abajoInput">
              <input class="form-control rounded" list="datalistOptions" id="exampleDataList" placeholder="Buscar participantes">
              <datalist id="datalistOptions">
                <?php

                foreach ($usuarios as $usuario) {
                ?>

                  <option data-id="<?php echo $usuario->getId(); ?>" value="<?php echo $usuario->getNombres() . " " . $usuario->getApellidos() ?>">

                  <?php
                }
                  ?>
              </datalist>
              <button type="button" id="enviarParticipantes" class="btn ml-2 btn-form">Agregar</button>
            </div>
          </div>
        </div>
        <div class="form-group">
          <table id="tablaParticipantes" class="table mt-4 table-striped table-bordered tablelist" style="display: none;">
            <thead>
              <tr class="text-center">
                <th scope="col">ID</th>
                <th scope="col">Participantes</th>
                <th scope="col">Acciones</th>
              </tr>
            </thead>
            <tbody id="salidaP">

            </tbody>
          </table>
        </div>
        <button type="submit" class="btn mt-4 btn-registrar float-right">Guardar</button>
      </form>


    </div>
  </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php require_once 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>
<script src="<?php echo constant('URL'); ?>/public/js/ajax.js"></script>


</body>

</html>