<?php
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;

$userController = new UserController();
$user = $userController->getUserData();

if (isset($_SESSION['update_success'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['update_success']; ?>
        <?php unset($_SESSION['update_success']);?>
    </div>
<?php endif; ?>

<h2>Mis Datos Personales</h2>
<form action="<?= route('user.update') ?>" method="post">
    <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
    <input type="hidden" name="id" value="<?= $user->id; ?>">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" value="<?= $user->nombre; ?>">
    <label for="apellido1">Primer Apellido:</label>
    <input type="text" id="apellido1" name="apellido1" value="<?= $user->apellido1; ?>">
    <label for="apellido2">Segundo Apellido:</label>
    <input type="text" id="apellido2" name="apellido2" value="<?= $user->apellido2; ?>">
    <label for="direccion">Dirección:</label>
    <input type="text" id="direccion" name="direccion" value="<?= $user->direccion; ?>">
    <label for="codigoPostal">Código Postal:</label>
    <input type="text" id="codigoPostal" name="codigoPostal" value="<?= $user->codigoPostal; ?>">
    <label for="ciudad">Ciudad:</label>
    <input type="text" id="ciudad" name="ciudad" value="<?= $user->ciudad; ?>">
    <label for="pais">País:</label>
    <input type="text" id="pais" name="pais" value="<?= $user->pais; ?>">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="<?= $user->email; ?>">
    <input type="submit" value="Actualizar Datos">
</form>
<form action="/logout" method="get">
    <button type="submit" class="button-logout">Cerrar Sesión</button>
</form>
