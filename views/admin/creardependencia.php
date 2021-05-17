<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/expense.css">
<?php
$dependencia = $this->d['dependencia'];

if ($dependencia != NULL) {
    require("header.php");
}
?>
<form id="form-expense-container" action="
    <?php
    if ($dependencia === NULL) {
        echo "admin/crearDependencia";
    } else {
        echo "../admin/updateDependencia";
    }
    ?>
    " method="POST">

    <?php
    if ($dependencia === NULL) {
        echo "<h3>Registrar nueva Dependencia</h3>";
    } else {
        echo "<h3>Actualizar Dependencia</h3>";
    }
    ?>
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
    <div class="center">
        <input type="submit" value="
        <?php
        if ($dependencia === NULL) {
            echo "Registrar nueva dependencia";
        } else {
            echo "Actualizar dependencia";
        }
        ?>
        ">
    </div>


</form>