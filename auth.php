<?php

// Conexión a la base de datos
$conn = new mysqli("127.0.0.1:3308", "root", "", "flight_reservation");

// Verificar conexión
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verificar si se envió el formulario con acción 'register'
if (isset($_POST['action']) && $_POST['action'] == 'register') {
    $user = $_POST['username'];
    $pass = $_POST['password']; // Sin encriptar
    $email = $_POST['email'];
    
    // Consulta para insertar el nuevo usuario
    $sql = "INSERT INTO Users (username, password, email) VALUES ('$user', '$pass', '$email')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $conn->error;
    }
}

// Verificar si se envió el formulario con acción 'login'
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $user = $_POST['username'];
    $pass = $_POST['password'];
    
    // Consulta para verificar el nombre de usuario
    $sql = "SELECT password FROM Users WHERE username='$user'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Verificar la contraseña
        if ($pass == $row['password']) { // Comparar sin encriptar
            // Redirigir a reservation.html
            header("Location: search.html");
            exit();
        } else {
            echo "Credenciales inválidas";
        }
    } else {
        echo "No existe el usuario";
    }
}

$conn->close();
