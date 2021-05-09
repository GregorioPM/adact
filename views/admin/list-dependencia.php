<?php
$dependencias = $this->d['dependencias'];
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
<?php require_once 'header.php';?>
    <h1>lista de dependencias</h1>
    <table width="100%">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Dependencia</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tbody-alumnos">
                <?php
                        foreach($dependencias as $row){
                    
                ?>

                <tr id="fila-<?php echo $row->dependecia; ?>">
                    <td><?php echo $row->getID(); ?></td>
                    <td><?php echo $row->getDependencia(); ?></td>
                    <td><button class="bEliminar" data-matricula="<?php echo $row->getID(); ?>">Eliminar</button></td>
                    <td><a href="<?= URL ?>/admin/deleteDependencias?id=<?= $row->getId() ?>">Eliminar</a></td>
                </tr>

                <?php } ?>
            </tbody>
        </table>
</body>
</html>