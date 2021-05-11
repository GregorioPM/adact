<?php require_once 'header.php';?>
<div id="main-container">


    <h1>admin logeado</h1>
    <a href="<?= URL ?>/admin/getDependencias">Dependecias</a>
    <button class="btn-main" id="new-dependencia">
                            <i class="material-icons">add</i>
                            <span>Registrar nueva Dependencia</span>
</button>
</div>
    <script src="public/js/admin.js"></script>
    <?php require_once 'views/footer.php';?>
</body>
</html>