<title>Perfil</title>
<?php
    $user= $this->d['user'];

?>
<?php require_once 'header.php';?>
    <!-- Page content holder -->
    <div class="page-content p-5" id="content">
  <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"></small></button>

    <div class="container">
        <div class="row justify-content-md-center">
          
    <form action="<?php echo constant('URL') ?>/signup/updateUser" method="POST" enctype="multipart/form-data">
    <div class="form-group">
      <label for="inputEmail4">Email</label>
      <input type="email" name="correo" class="form-control" id="inputEmail4" value="<?php echo $user->getCorreo();?>">
    </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputPassword4">Nombres</label>
      <input type="text" class="form-control" id="inputPassword4" value="<?php echo $user->getNombres();?>">
    </div>
    <div class="form-group col-md-6">
        <label for="inputAddress">Apellidos</label>
        <input type="text" class="form-control" id="inputAddress" value="<?php echo $user->getApellidos();?>">
    </div>
  </div>
  <div class="form-group img-per">
      <label for="inputEmail4">Foto perfil</label>
      <br>
      <?php
        if(!empty($user->getFoto())){
    ?>
            <img class="img-perfil" src="<?php echo constant('URL') ?>/public/img/fotos/<?php echo $user->getFoto(); ?>" width="200" height="200" />
       <?php
         }else{
       ?>
        <img src="<?php echo constant('URL') ?>/public/img/logo.png" width="300" height="300" />
       <?php
         }
       ?>
      <br>
      <label for="photo">Foto de perfil</label>
                                                        
        <input type="file" name="photo" id="photo" autocomplete="off" required>
       
                        

    </div>


  
  <button type="submit" class="btn btn-primary">Sign in</button>
</form>


</div>
</div>

    </div>
    <?php require_once 'views/footer.php';?>
    <script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>


</body>
</html>