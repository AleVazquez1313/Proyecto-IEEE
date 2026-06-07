<?php

$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';

echo "Correo: " . htmlspecialchars($email) . "<br>";
echo "Contraseña recibida correctamente.";