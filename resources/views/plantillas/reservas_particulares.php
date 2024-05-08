<?php
use App\Http\Controllers\UserController;

$userController = new UserController();

$reservations = [];
$email = '';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $reservations = $userController->getUserReservations($email);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {
    $idReserva = $_POST['id_reserva'];
    $email = $_POST['email'];
    $userController->cancelReservation($idReserva);
    $reservations = $userController->getUserReservations($email);
    echo "<p>Reserva cancelada con éxito.</p>";
}

?>
<div>
    <h2>Buscar Reservas por Email</h2>
    <form method="post">
        <label for="email">Email del Usuario:</label>
        <input type="email" id="email" name="email" required>
        <input type="submit" value="Ver Reservas">
    </form>

    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email']) && !isset($_POST['cancel'])):
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
                        <form method="post" action="/reservas/cancelar/<?= $reservation->id ?>">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
                            <button type="submit" name="cancel">Cancelar</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>
        <?php else: ?>
            <p>Este usuario no tiene reservas.</p>
        <?php endif;
    endif; ?>
</div>
