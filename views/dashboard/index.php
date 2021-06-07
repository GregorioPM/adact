<title>Dashboard</title>
<?php
$user = $this->d['user'];
$totalParticipaciones= $this->d['totalParticipaciones'];
$totalActasAprobadas= $this->d['totalActasAprobadas'];
$totalActasRevision= $this->d['totalActasRevision'];

?>
<?php require_once 'header.php'; ?>
<!-- Page content holder -->
<div class="page-content p-5" id="content">
    <!-- Toggle button -->
    <button id="sidebarCollapse" type="button" class="btn btn-light bg-white rounded-pill shadow-sm px-4 mb-4"><i class="fa fa-bars mr-2"></i><small class="text-uppercase font-weight-bold"></small></button>
    <div id="main-container">

    <div class="panel">
                <div class="title">Participaciones</div>
                <div class="datum"> <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                <?php echo $totalParticipaciones; ?></div>
                <div class="description">Total Participaciones en Actas</div>
            </div>

            <div class="panel">
                <div class="title">Actas Aprobadas</div>
                <div class="datum"> <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                <?php echo $totalActasAprobadas; ?></div>
                <div class="description">Total Actas aprobadas donde participe</div>
            </div>
            <div class="panel">
                <div class="title">Actas En Revisión</div>
                <div class="datum"> <i class="fas fa-user mr-3 text-primary fa-fw"></i>
                <?php echo $totalActasRevision; ?></div>
                <div class="description">Total Actas en Revisión donde participe</div>
            </div>
     <h2><?php echo $totalParticipaciones; ?></h2>


    </div>
</div>


<!--<h1>admin logeado</h1>
    <a href="<?= URL ?>/admin/getDependencias">Dependecias</a>
    <button class="btn-main" id="new-dependencia">
                            <i class="material-icons">add</i>
                            <span>Registrar nueva Dependencia</span>
</button>-->


<script src="public/js/admin.js"></script>
<?php require_once 'views/footer.php'; ?>
<script src="<?php echo constant('URL'); ?>/public/js/sidebar.js"></script>


</body>

</html>