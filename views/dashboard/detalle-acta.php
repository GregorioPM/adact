<title>Detalle acta</title>
<?php
$user = $this->d['user'];
$dependencias = $this->d['dependencias'];
$usuarios = $this->d['usuarios'];
$acta = $this->d['acta'];
$temas = $this->d['temas'];
$participantes = $this->d['participantes'];
$compromisos = $this->d['compromisos'];
$estado = $this->d['estado'];

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
    <div class="col-12">
    <button id="btnCrearPdf" onclick="generatePDF()" class="btn mt-14 btn-registrar float-right">Descargar PDF</button>

    </div>
      <h2 class="titulo">
        <?php if (isset($acta)) {
          echo 'Actualizar Información Del Acta';
        } else {
          echo 'Registrar Información Del Acta';
        } ?>
      </h2>
      <div id="genPDF">

      <form class="col-md-10 acta" action="<?php echo constant('URL') ?>/acta/newActa" method="POST" enctype="multipart/form-data">
        <div class="form-group">
          <input type="hidden" name="id" value="<?php echo $user->getId(); ?>">
          <label for="inputPassword4"><b>Asunto</b></label>
          <input type="text" name="asunto" class="form-control" id="inputPassword4" <?php if (isset($acta)) {
                                                                                      echo 'value="' . $acta->getAsunto() . '"';
                                                                                    } ?> disabled>
        </div>
        <div class="form-row">
          <div class="form-group col-md-8">
            <label for="actaLugar"><b>Lugar</b></label>
            <input type="text" name="lugar" class="form-control" id="actaLugar" <?php if (isset($acta)) {
                                                                                  echo 'value="' . $acta->getLugar() . '"';
                                                                                } ?>disabled>
          </div>
          <div class="form-group col-md-4">
            <label for="inputAddress"><b>Fecha</b></label>
            <input type="date" name="fecha" class="form-control" min="2014-01-01" max="2100-12-31" id="inputAddress" <?php if (isset($acta)) {
                                                                                                                        echo 'value="' . $acta->getFecha() . '"';
                                                                                                                      } ?>disabled>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-3">
            <label for="inputPassword4"><b>Hora Inicio</b></label>
            <input type="time" name="horaInicio" class="form-control" id="inputPassword4" <?php if (isset($acta)) {
                                                                                            echo 'value="' . $acta->getHoraInicio() . '"';
                                                                                          } ?>disabled>
          </div>
          <div class="form-group col-md-3">
            <label for="inputAddress"><b>Hora Final</b></label>
            <input type="time" name="horaFinal" class="form-control" id="inputAddress" <?php if (isset($acta)) {
                                                                                          echo 'value="' . $acta->getHoraFinal() . '"';
                                                                                        } ?>disabled>
          </div>
          <div class="form-group col-md-6">
            <label for="inputAddress"><b>Dependencia</b></label>
            <select name="dependencia" class="form-control">
              <option value="">Seleccione:</option>
              <?php

              foreach ($dependencias as $dependencia) :
                if (isset($acta)) {
                  if ($acta->getIdDependencia() == $dependencia->getId()) {
                    echo '<option selected="selected" value="' . $dependencia->getId() . '">' . $dependencia->getDependencia() . '</option>';
                  } else {
                    echo '<option value="' . $dependencia->getId() . '">' . $dependencia->getDependencia() . '</option>';
                  }
                } else {
                  echo '<option value="' . $dependencia->getId() . '">' . $dependencia->getDependencia() . '</option>';
                }


              endforeach;
              ?>
            </select>
          </div>
        </div>
        <div class="form-group">
          <label for="inputPassword4"><b>Orden del dia</b></label>
          <input type="text" name="orden" class="form-control" id="inputPassword4" <?php if (isset($acta)) {
                                                                                      echo 'value="' . $acta->getOrden() . '"';
                                                                                    } ?>disabled>
        </div>
        <div class="form-group">
          <label for="inputPassword4"><b>Conclusiones</b></label>
          <br>
          <textarea class="rounded" name="conclusiones" id="conclu" cols="100" rows="10" disabled>
          <?php if (isset($acta)) {
            echo $acta->getConclusiones();
          } ?>
          </textarea>
        </div>
        <?php if($user->getRol()=="admin") {
          echo '<div class="form-group">
          <div class="input-group mt-4">
            <label for="inputPassword4"><b>Agregar Temas</b></label>
            <div class="abajoInput">
              <input type="text" name="temas" class="form-control rounded" id="temas" placeholder="Agregar Temas">
              <button type="button" id="enviarTemas" class="btn ml-2 btn-form">Agregar</button>
            </div>
          </div>
        </div>';
        }?>
        
     
        <div class="form-group">
          <?php
          if (isset($acta)) {
            echo '<table class="table mt-4 table-striped table-bordered width=" 100%"">
              <caption>Listado Temas Guardados</caption>
              <thead>
                <tr class="text-center">
                  <th scope="col">Descripción</th>
                
      
                </tr>
              </thead>
              <tbody>';
            foreach ($temas as $tema) {

              echo '<tr>
      
                    <td class="text-center">' . $tema->getDescripcion() . '</td>
                 
      
                  </tr>';
            }
            echo '
               </tbody>
              </table>
            ';
          }
          ?>
        </div>


        
        <div class="form-group">
          <table id="tablaParticipantes" class="table mt-4 table-striped table-bordered tablelist" style="display: none;">
            <caption>Listado Participantes para Agregar</caption>
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
        <div class="form-group">
          <?php
          if (isset($acta)) {
            echo '<table class="table mt-4 table-striped table-bordered width=" 100%"">
              <caption>Listado Participantes Guardados</caption>

              <thead>
                <tr class="text-center">
                  <th scope="col">Id</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Estado</th>
      
                </tr>
              </thead>
              <tbody>';
            foreach ($participantes as $participante) {


              echo '<tr>
      
                    <td class="text-center">' . $participante->getId() . '</td>
                    <td class="text-center">' . $participante->getNombres() . '</td>
                    <td class="text-center">' . $participante->getEstado() . '</td>
                   
      
                  </tr>';
            }
            echo '
               </tbody>
              </table>
            ';
          }
          ?>
        </div>

        <div class="form-group">
            <?php
            if (!$compromisos==null) {
              echo '<table class="tableG table mt-4 table-striped table-bordered width=" 100%"">
              <caption>Listado Compromisos Guardados</caption>
              <thead>
                <tr class="text-center">
                  <th scope="col">Id</th>
                  <th scope="col">Acta</th>
                  <th scope="col">Participante</th>
                  <th scope="col">Compromiso</th>
                  <th scope="col">Fecha</th>

      
                </tr>
              </thead>
              <tbody>';
              foreach ($compromisos as $c) {

                echo '<tr>
                    <td class="text-center">' . $c->getId() . '</td>
                    <td class="text-center">' . $c->getIdActa() . '</td>
                    <td class="text-center">' . $c->nombresParticipante($c->getIdParticipante()). '</td>
                    <td class="text-center">' . $c->getCompromiso() . '</td>
                    <td class="text-center">' . $c->getFecha() . '</td>


                    
      
                  </tr>';
              }
              echo '
               </tbody>
              </table>
            ';
            }
            ?>
          </div>
 
      
      </form>

      
      <?php if (isset($acta)) {
          echo '<hr class="someClass mt-5">
          <h3>Cambiar estado del Acta</h3>
          <form class="col-md-10 acta  mt-4" action="'.constant('URL').'/dashboard/detalleActa?id='.$acta->getId().'" method="POST" enctype="multipart/form-data">
            <!-- Rounded switch -->
            <div class="estadoActa mb-4">
            <input type="hidden" name="idacta" value="'.$acta->getid().'">
            <input type="hidden" name="idusuario" value="'.$user->getid().'">


            <b>Estado Del acta</b>
            <label class="switch">
              <input id="estadoActa" type="checkbox" name="estado">
              <span class="slider round"></span>
            </label>
            </div>
            <button  type="submit" class="btn mt-14 btn-registrar float-right">Guardar</button>
          </form>';
        }?>
 <?php 
if($estado=="Aprobado"){
  echo '<script>
document.getElementById("estadoActa").checked = true;
</script>';
}
?>     
   
    </div>
    </div>

  </div>

</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php require_once 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>
<script src="<?php echo constant('URL'); ?>/public/js/ajax.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="<?php echo constant('URL'); ?>/public/js/pdf.js"> </script>


</body>

</html>