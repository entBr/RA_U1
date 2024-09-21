<?php
$servername = "127.0.0.1:3308";
$username = "root";
$password = "";
$dbname = "flight_reservation";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Recibir datos del formulario
$origin = $_POST['origin'];
$destination = $_POST['destination'];
$fecha_salida = $_POST['fecha_salida'];
$fecha_regreso = $_POST['fecha_regreso'];
$clase = $_POST['clase'];
$precio = $_POST['precio']; 
$usuario = $_POST['username'];


$sql = "INSERT INTO Reservations (username, origin, destination, fecha_salida, fecha_regreso, clase, precio)
        VALUES ('$usuario', '$origin', '$destination', '$fecha_salida', '$fecha_regreso', '$clase', '$precio')";

if ($conn->query($sql) === TRUE) {
    echo "Reservacion Exitosa";
} else {
    echo "Error: " . $conn->error;
}

$conn->close();

