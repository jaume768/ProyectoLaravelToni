<?php
$reservations = session('reservations', []);
$email = session('search_email', '');

// Obtener el mensaje de éxito o error de la sesión
$successMessage = session('success');
$errorMessage = session('error');

// Eliminar los mensajes flash de la sesión
session()->forget(['reservations', 'search_email', 'success', 'error']);  
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar Reservas</title>
</head>
<body>
    <div>
        <h2>Buscar Reservas por Email</h2>
        <form method="post" action="/admin/buscar-reservas">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
            <label for="email">Email del Usuario:</label>
            <input type="email" id="email" name="email" required>
            <input type="submit" value="Ver Reservas">
        </form>
    </div>

    <?php
    if ($successMessage): ?>
        <div>
            <p><?= $successMessage ?></p>
        </div>
    <?php endif; ?>

    <?php
    if ($errorMessage): ?>
        <div>
            <p><?= $errorMessage ?></p>
        </div>
    <?php endif; ?>

    <?php
    if (!empty($reservations)): ?>
        <h2>Reservas para <?= htmlspecialchars($email) ?></h2>
        <table>
            <tr>
                <th>Localizador</th>
                <th>Hotel</th>
                <th>Tipo de Reserva</th>
                <th>Fecha de Reserva</th>
                <th>Fecha de Entrada</th>
                <th>Detalles del Vuelo</th>
                <th>Num. de Viajeros</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($reservations as $reservation): ?>
            <tr>
                <td><?= htmlspecialchars($reservation->localizador) ?></td>
                <td><?= htmlspecialchars($reservation->id_hotel) ?></td>
                <td><?= htmlspecialchars($reservation->id_tipo_reserva) ?></td>
                <td><?= htmlspecialchars($reservation->fecha_reserva) ?></td>
                <td><?= htmlspecialchars($reservation->fecha_entrada) ?> a las <?= htmlspecialchars($reservation->hora_entrada) ?></td>
                <td>
                    Vuelo <?= htmlspecialchars($reservation->numero_vuelo_entrada) ?> desde <?= htmlspecialchars($reservation->origen_vuelo_entrada) ?>
                </td>
                <td><?= htmlspecialchars($reservation->num_viajeros) ?></td>
                <td>
                    <form method="post" action="/admin/cancelar-reserva/<?= $reservation->id_reserva ?>">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <button type="submit" name="cancel">Cancelar</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif(isset($_POST['email'])): ?>
        <p>No se encontraron reservas para este email.</p>
    <?php endif; ?>
</body>
</html>
