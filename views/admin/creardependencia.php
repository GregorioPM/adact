<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/expense.css">


<form id="form-expense-container" action="admin/newDependencia" method="POST">
    <h3>Registrar nueva Dependencia</h3>
    <div class="section">
        <label for="amount">Nombre</label>
        <input type="text" name="dependencia" id="color" autocomplete="off" required>
    </div>
    <div class="center">
        <input type="submit" value="Registrar nueva dependencia">
    </div>
    
</form>