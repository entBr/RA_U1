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

// Obtener el nombre de usuario de la solicitud POST
$username = $_POST['username'];

// Consultar las reservas basadas en el nombre de usuario
$sql = "SELECT * FROM Reservations WHERE username = '$username'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservaciones</title>
    <link rel="stylesheet" href="reservation.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Reservaciones de <?php echo htmlspecialchars($username); ?></h1>

    <?php
    if ($result->num_rows > 0) {
        echo "<table>
                <tr>
                    <th>Origen</th>
                    <th>Destino</th>
                    <th>Fecha de Salida</th>
                    <th>Fecha de Regreso</th>
                    <th>Clase</th>
                    <th>Precio</th>
                </tr>";
        // Mostrar los datos de cada fila
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['origin']) . "</td>
                    <td>" . htmlspecialchars($row['destination']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_salida']) . "</td>
                    <td>" . htmlspecialchars($row['fecha_regreso']) . "</td>
                    <td>" . htmlspecialchars($row['clase']) . "</td>
                    <td>" . htmlspecialchars($row['precio']) . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>No se encontraron reservaciones para el usuario.</p>";
    }

    $conn->close();
    ?>
</body>
</html>
