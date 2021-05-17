<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>

<body>
    <?php $this->showMessages(); ?>
    <form action="<?php echo constant('URL'); ?>/signup/newUser" method="POST">
        <h2>Registrar Usuario</h2>
        <p>
            <label for="correo">Correo</label>
            <input type="email" name="correo" id="correo">
        </p>
        <p>
            <label for="password">Contraseña</label>
            <input type="text" name="password" id="password">
        </p>
        <p>
            <input type="submit" value="Registrar">
        </p>
        <p>
            <a href="<?php echo constant('URL'); ?>">Registrar</a>
        </p>
    </form>
</body>

</html>