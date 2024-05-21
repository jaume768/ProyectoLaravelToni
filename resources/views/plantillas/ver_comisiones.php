<?php
use App\Http\Controllers\AdminController;

$adminController = new AdminController();
$mes = $_GET['mes'] ?? date('m');
$comisiones = $adminController->calculateCommissions(new \Illuminate\Http\Request(['mes' => $mes]));
?>

<div class="ver-comisiones">
    <h2>Comisiones Mensuales</h2>
    <form action="ver_comisiones.php" method="GET">
        <label for="mes">Mes:</label>
        <select name="mes" id="mes">
            <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?php echo $i; ?>" <?php echo $i == $mes ? 'selected' : ''; ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <button type="submit">Ver Comisiones</button>
    </form>

    <?php if(!empty($comisiones)): ?>
        <table>
            <thead>
                <tr>
                    <th>Hotel</th>
                    <th>Comisión Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($comisiones as $comision): ?>
                    <tr>
                        <td><?php echo $comision->hotel->nombre; ?></td>
                        <td><?php echo $comision->comision_total; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>
