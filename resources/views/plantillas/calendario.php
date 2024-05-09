<?php

use App\Http\Controllers\ConductorController;

if (!function_exists('getTrayectos')) {
    function getTrayectos($email) {
        $conductorController = new ConductorController();
        return $conductorController->calendarioGet(request(), $email);
    }
}

if (!function_exists('escape')) {
    function escape($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    }
}

$email = session('user_email'); 
$calendarioData = getTrayectos($email);  
?>

<div class="container">
    <h2>Calendario de Trayectos</h2>
    <form method="post">
        <?php echo csrf_field(); ?>
        <label for="startDate">Inicio:</label>
        <input type="date" id="startDate" name="startDate" value="<?= escape($calendarioData['startDate'] ?? date('Y-m-01')) ?>">
        <label for="endDate">Fin:</label>
        <input type="date" id="endDate" name="endDate" value="<?= escape($calendarioData['endDate'] ?? date('Y-m-t')) ?>">
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
    <?php if (!empty($calendarioData['trayectos'])): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Detalles del Trayecto</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($calendarioData['trayectos'] as $trayecto): ?>
                    <tr>
                        <td><?= escape($trayecto->fecha_entrada) ?></td>
                        <td>
                            Localizador: <?= escape($trayecto->localizador) ?><br>
                            Hora de entrada: <?= escape($trayecto->hora_entrada) ?><br>
                            Vuelo de entrada: <?= escape($trayecto->numero_vuelo_entrada) ?> desde <?= escape($trayecto->origen_vuelo_entrada) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
