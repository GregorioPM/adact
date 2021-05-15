<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/dashboard.css">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/default.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>/public/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    
</head>
<body>
    <nav class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow nav-color">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?php echo constant('URL'); ?>/admin">
          <img src="<?php echo constant('URL'); ?>/public/img/logo.png" alt="">
          <b>Adact</b>
          
      </a>
      
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link nav-letra" href="<?php echo constant('URL'); ?>/logout">Cerrar Sesión</a>
        </li>
      </ul>
    </nav>
    <!-- Vertical navbar -->
<div class="vertical-nav bg-white" id="sidebar">
  <div class="py-4 px-3 mb-4 bg-light">
    <div class="media d-flex align-items-center">
      <img loading="lazy" src="
      <?php if($user->getFoto()==="" || $user->getFoto()===NULL){
            echo constant('URL') . "/public/img/logo.png";
      }else{
        echo constant('URL') . "/public/img/logo.png";
      }
        ?>" alt="..." width="80" height="80" class="mr-3 rounded-circle img-thumbnail shadow-sm">
      <div class="media-body">
        <h4 class="m-0"><?php echo $user->getNombres() ?></h2>
</h4>
        <p class="font-weight-normal text-muted mb-0"><?php  if($user->getRol()=="admin"){
          echo "Administrador";
          }else{
            echo "Participante";
          } ?>
          </p>
      </div>
    </div>
  </div>

  <p class="text-gray font-weight-bold text-uppercase px-3 small pb-4 mb-0">Dashboard</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="<?php echo constant('URL'); ?>/admin" class="nav-link text-dark bg-light">
                <i class="fa fa-th-large mr-3 text-primary fa-fw"></i>
                Inicio
            </a>
    </li>
    <li class="nav-item">
      <a href="<?= URL ?>/admin/perfil" class="nav-link text-dark">
                <i class="fa fa-address-card mr-3 text-primary fa-fw"></i>
                Perfil
            </a>
    </li>
    <li class="nav-item">
      <a href="<?= URL ?>/admin/listDependencias" class="nav-link text-dark">
                <i class="fa fa-cubes mr-3 text-primary fa-fw"></i>
                Dependencias
            </a>
    </li>
    <li class="nav-item">
      <a href="<?= URL ?>/admin/listUsuarios" class="nav-link text-dark">
                <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                Usuarios
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark">
                <i class="fas fa-book-open mr-3 text-primary fa-fw"></i>
                Actas
            </a>
    </li>
  </ul>

  <!--<p class="text-gray font-weight-bold text-uppercase px-3 small py-4 mb-0">Charts</p>

  <ul class="nav flex-column bg-white mb-0">
    <li class="nav-item">
      <a href="#" class="nav-link text-dark">
                <i class="fa fa-area-chart mr-3 text-primary fa-fw"></i>
                area charts
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark">
                <i class="fa fa-bar-chart mr-3 text-primary fa-fw"></i>
                bar charts
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark">
                <i class="fa fa-pie-chart mr-3 text-primary fa-fw"></i>
                pie charts
            </a>
    </li>
    <li class="nav-item">
      <a href="#" class="nav-link text-dark">
                <i class="fa fa-line-chart mr-3 text-primary fa-fw"></i>
                line charts
            </a>
    </li>
  </ul>-->
</div>
<!-- End vertical navbar -->
   
        </body>
</html>