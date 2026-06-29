<?php
session_start();
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Login.php');
    exit;
}

$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';

if ($email === '' || $password === '') {
    $_SESSION['login_error'] = 'Por favor completa todos los campos.';
    header('Location: Login.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['login_error'] = 'Ingresa un correo electronico valido.';
    header('Location: Login.php');
    exit;
}

if (DB_ACTIVA && $pdo) {
    try {
        $stmt = $pdo->prepare('SELECT id_persona, nombre, email, password FROM aprende_persona WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($password, $usuario['password'])) {
            $_SESSION['usuario_id'] = $usuario['id_persona'];
            $_SESSION['nombre']     = $usuario['nombre'];
            $_SESSION['email']      = $usuario['email'];
            $_SESSION['progreso']   = 0;
            header('Location: ../dashboard/dashboard.php');
            exit;
        }

        $_SESSION['login_error'] = 'Correo o contrasena incorrectos.';
        header('Location: Login.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['login_error'] = 'Error del servidor. Intenta mas tarde.';
        header('Location: Login.php');
        exit;
    }
}

$_SESSION['usuario_id'] = 0;
$_SESSION['nombre']     = 'Usuario invitado';
$_SESSION['email']      = $email;
$_SESSION['progreso']   = 0;

header('Location: ../dashboard/dashboard.php');
exit;

