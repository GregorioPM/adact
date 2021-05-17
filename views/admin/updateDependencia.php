<!-- Modal -->
<div class="modal fade" id="editDependencia<?php echo $dependencia->getId() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header mod-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Actualizar Dependencia</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p></p>
        <form id="form-expense-container" action="<?php echo constant('URL'); ?>/dependencia/updateDependencia" method="POST">
          <div class="form-user">
            <div class="section">
              <label for="amount">Nombre</label>
              <input type="hidden" name="id" value="<?php
                                                    if ($dependencia != NULL) {
                                                      echo $dependencia->getId();
                                                    }
                                                    ?>">
              <input type="text" name="dependencia" id="color" value="<?php
                                                                      if ($dependencia === NULL) {
                                                                        echo "";
                                                                      } else {
                                                                        echo $dependencia->getDependencia();
                                                                      }
                                                                      ?>" autocomplete="off" required>
            </div>
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-registrar">Actualizar</button>
      </div>
      </form>
    </div>
  </div>
</div>