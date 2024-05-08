<?php
use App\Http\Controllers\HotelController;

$hotelController = new HotelController();
$hotels = $hotelController->getHotels();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="<?= asset('css/admin.css'); ?>">
</head>
<body>
<div class="admin-container">
    <h2>Crear reserva</h2>
    <form action="<?= route('reservation.store'); ?>" method="post" id="reservationForm">
        <input type="hidden" name="_token" value="<?= csrf_token(); ?>">
        
        <label for="emailCliente">Email del Cliente:</label>
        <input type="email" id="emailCliente" name="emailCliente" required>

        <label for="tipoTrayecto">Tipo de Trayecto:</label>
        <select name="id_tipo_reserva" id="tipoTrayecto" onchange="updateFormFields()">
            <option value="1">Aeropuerto a Hotel</option>
            <option value="2">Hotel a Aeropuerto</option>
            <option value="3">Ida y Vuelta</option>
        </select>

        <div id="aeropuertoHotelFields" style="display:none;">
            <label for="diaLlegada">Día de llegada:</label>
            <input type="date" id="diaLlegada" name="dia_llegada">
            <label for="horaLlegada">Hora de llegada:</label>
            <input type="time" id="horaLlegada" name="hora_llegada">
            <label for="numeroVueloLlegada">Número del vuelo:</label>
            <input type="text" id="numeroVueloLlegada" name="numero_vuelo_llegada">
            <label for="origenVuelo">Aeropuerto de origen:</label>
            <input type="text" id="origenVuelo" name="origen_vuelo_entrada">
        </div>

        <div id="hotelAeropuertoFields" style="display:none;">
            <label for="diaVuelo">Día del vuelo:</label>
            <input type="date" id="diaVuelo" name="dia_vuelo">
            <label for="horaVuelo">Hora del vuelo:</label>
            <input type="time" id="horaVuelo" name="hora_vuelo">
            <label for="numeroVueloSalida">Número de vuelo:</label>
            <input type="text" id="numeroVueloSalida" name="numero_vuelo_salida">
            <label for="horaRecogida">Hora de recogida:</label>
            <input type="time" id="horaRecogida" name="hora_recogida">
        </div>

        <label for="hotelDestino">Hotel de destino/recogida:</label>
        <select id="hotelDestino" name="id_hotel">
            <?php foreach ($hotels as $hotel): ?>
                <option value="<?= $hotel->id; ?>"><?= $hotel->nombre; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="numViajeros">Número de viajeros:</label>
        <input type="number" id="numViajeros" name="num_viajeros">

        <input type="submit" value="Crear Reserva">
    </form>
</div>

<script>
function updateFormFields() {
    var selectedOption = document.getElementById('tipoTrayecto').value;
    document.getElementById('aeropuertoHotelFields').style.display = (selectedOption === '1' || selectedOption === '3') ? 'block' : 'none';
    document.getElementById('hotelAeropuertoFields').style.display = (selectedOption === '2' || selectedOption === '3') ? 'block' : 'none';
}
document.addEventListener('DOMContentLoaded', function() {
    updateFormFields();
});
</script>
</body>
</html>
