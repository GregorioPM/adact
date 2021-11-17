<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/default.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

</head>
<body>
    <div class="container-index">
        <section>
            <div class="banner">
                <img src="<?php echo constant('URL'); ?>/public/img/image-2.jpg" alt="">
            </div>
        </section>
<h1>Este es login</h1>

<div class="login">
<div class="form-login">
<div style="position: relative;"><?php
    $this->showMessages();
?></div> 
<form action="<?php echo constant('URL'); ?>/login/authenticate" method="POST">
        <div><?php (isset($this->errorMessage))?  $this->errorMessage : '' ?></div>

            <p>
                <b>Correo</b>
            <br>
                <input class="input-login" type="email" name="correo" placeholder="ejemplo@gmail.com" id="correo" >
            </p>
            <p>
                <b>Contraseña</b>
                <input class="input-login" type="password" name="password" id="password" >
            </p>
            <p align="right">
                <input class="btn-login" type="submit" value="Iniciar sesión" />
                <b class="mt-2">Olvidaste la Contraseña</b>
            </p>
        </form>
</div>
</div>

        </div>

        <?php require_once 'views/footer.php';?>
</body>
</html>