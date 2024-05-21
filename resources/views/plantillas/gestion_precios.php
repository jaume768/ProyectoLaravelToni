<?php
use App\Http\Controllers\AdminController;

$adminController = new AdminController();
$data = $adminController->listHotels();
$hoteles = $data['hoteles'];
$vehiculos = $data['vehiculos'];
?>

<div class="gestion-precios">
    <h2>Gestionar Precios</h2>
    <?php if(isset($_GET['success'])): ?>
        <div class="alert alert-success">
            <?php echo urldecode($_GET['success']); ?>
        </div>
    <?php endif; ?>
    <form action="/admin/actualizar-precios" method="POST">
        <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
        <label for="hotel">Hotel:</label>
        <select name="hotel" id="hotel">
            <?php foreach($hoteles as $hotel): ?>
                <option value="<?php echo $hotel->id_hotel; ?>"><?php echo $hotel->nombre; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="vehiculo">Vehículo:</label>
        <select name="vehiculo" id="vehiculo">
            <?php foreach($vehiculos as $vehiculo): ?>
                <option value="<?php echo $vehiculo->id_vehiculo; ?>"><?php echo $vehiculo->Descripción; ?></option>
            <?php endforeach; ?>
        </select>
        <label for="precio">Precio:</label>
        <input type="number" name="precio" id="precio" required>
        <button type="submit">Actualizar Precio</button>
    </form>
</div>
