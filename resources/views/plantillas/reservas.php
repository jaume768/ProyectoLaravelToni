<div class="container">
    <table class="table">
        <thead>
            <tr>
                <th>Localizador</th>
                <th>Fecha de Reserva</th>
                <th>Hora entrada</th>
                <th>Numero de vuelo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($reservations)): ?>
                <tr><td colspan="4">No hay reservas disponibles.</td></tr>
            <?php elseif (is_iterable($reservations)): ?>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?php echo isset($reservation->localizador) ? $reservation->localizador : 'N/A'; ?></td>
                        <td><?php echo isset($reservation->fecha_reserva) ? $reservation->fecha_reserva : 'N/A'; ?></td>
                        <td><?php echo isset($reservation->hora_entrada) ? $reservation->hora_entrada : 'N/A'; ?></td>
                        <td><?php echo isset($reservation->numero_vuelo_entrada) ? $reservation->numero_vuelo_entrada : 'N/A'; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
