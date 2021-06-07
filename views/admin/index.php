<title>Admin</title>
<?php
$user = $this->d['user'];
$totalActas = $this->d['totalActas'];
$totalActasAprovadas = $this->d['totalActasAprovadas'];
$totalActasRevision = $this->d['totalActasRevision'];
$totalDependencias = $this->d['totalDependencias'];
$totalUsers = $this->d['totalUsers'];
$totalCompromisos= $this->d['totalCompromisos'];


?>
<?php require_once 'header.php'; ?>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"></small></button>
    <div id="main-container">
        <?php $this->showMessages(); ?>
        <div id="expenses-container" class="container con-index">
           
           <a href="<?= URL ?>/admin/listActas"><div class="panel">
                <div class="title">Total De actas</div>
                <div class="datum"> <i class="fas fa-book-open mr-3 text-primary fa-fw"></i><?php echo $totalActas; ?></div>
                <div class="description">Total Actas Creadas</div>
            </div>
            </a> 
            <a href="<?= URL ?>/admin/listActas"> <div class="panel">
                <div class="title">Actas Aprobadas</div>
                <div class="datum"> <i class="fas fa-award mr-3 text-primary fa-fw"></i><?php echo $totalActasAprovadas; ?></div>
                <div class="description">Total Actas Aprobadas</div>
            </div>
            </a> 

            <a href="<?= URL ?>/admin/listActas"> <div class="panel">
                <div class="title">Actas en Revisión</div>
                <div class="datum"> <i class="fas fa-glasses mr-3 text-primary fa-fw"></i></i><?php echo $totalActasRevision; ?></div>
                <div class="description">Total Actas Revisión</div>
            </div>
            </a> 

           
            <a href="<?= URL ?>/admin/listDependencias"><div class="panel">
                <div class="title">Dependencias</div>
                <div class="datum"> <i class="fa fa-cubes mr-3 text-primary fa-fw"></i><?php echo $totalDependencias; ?></div>
                <div class="description">Total Dependencias Creadas</div>
            </div>            </a> 

            <a href="<?= URL ?>/admin/listUsuarios"><div class="panel">
                <div class="title">Usuarios</div>
                <div class="datum"> <i class="fas fa-user mr-3 text-primary fa-fw"></i>
          <?php echo $totalUsers; ?></div>
                <div class="description">Total Usuarios</div>
            </div>
            </a> 
            <a href="<?= URL ?>/admin/listCompromisos">
            <div class="panel">
                <div class="title">Mis Compromisos</div>
                <div class="datum"> 
                <i class="fas fa-thumbtack mr-3 text-primary fa-fw"></i>

                <?php echo $totalCompromisos; ?></div>
                <div class="description">Total Compromiso en las Actas donde participe</div>
            </div>
            </a>
        </div>



    </div>
</div>



<script src="public/js/admin.js"></script>
<?php require_once 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>


</body>

</html>