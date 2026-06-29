<?php
session_start();
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: Registro.php');
    exit;
}

$nombre          = trim($_POST['nombre'] ?? '');
$apellidos       = trim($_POST['apellidos'] ?? '');
$email           = trim($_POST['email'] ?? '');
$genero          = trim($_POST['genero'] ?? '');
$telefono        = trim($_POST['telefono'] ?? '');
$password        = $_POST['password'] ?? '';
$confirmPassword = $_POST['confirm_password'] ?? '';

$_SESSION['registro_old'] = compact('nombre', 'apellidos', 'email', 'genero', 'telefono');

if ($nombre === '' || $apellidos === '' || $email === '' || $genero === '' || $password === '') {
    $_SESSION['registro_error'] = 'Por favor completa todos los campos obligatorios.';
    header('Location: Registro.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['registro_error'] = 'El formato del correo electronico no es valido.';
    header('Location: Registro.php');
    exit;
}

if ($telefono !== '') {
    $telDigitos = preg_replace('/\s/', '', $telefono);
    if (!preg_match('/^\d{10}$/', $telDigitos)) {
        $_SESSION['registro_error'] = 'El telefono debe tener 10 digitos.';
        header('Location: Registro.php');
        exit;
    }
}

if (strlen($password) < 10
    || !preg_match('/[A-Z]/', $password)
    || !preg_match('/[a-z]/', $password)
    || !preg_match('/[0-9]/', $password)
    || !preg_match('/[^A-Za-z0-9]/', $password)) {
    $_SESSION['registro_error'] = 'La contrasena debe tener al menos 10 caracteres, con mayuscula, minuscula, numero y simbolo.';
    header('Location: Registro.php');
    exit;
}

if ($password !== $confirmPassword) {
    $_SESSION['registro_error'] = 'Las contrasenas no coinciden.';
    header('Location: Registro.php');
    exit;
}

$nombreCompleto = $nombre . ' ' . $apellidos;

if (DB_ACTIVA && $pdo) {
    try {
        $check = $pdo->prepare('SELECT id_persona FROM aprende_persona WHERE email = ? LIMIT 1');
        $check->execute([$email]);

        if ($check->fetch()) {
            $_SESSION['registro_error'] = 'Este correo ya esta registrado. Intenta iniciar sesion.';
            header('Location: Registro.php');
            exit;
        }

        $hash = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $pdo->prepare('INSERT INTO aprende_persona (nombre, email, password, genero, telefono, fecha_registro) VALUES (?, ?, ?, ?, ?, NOW())');
        $stmt->execute([$nombreCompleto, $email, $hash, $genero, $telefono]);
        $idPersona = (int) $pdo->lastInsertId();

        unset($_SESSION['registro_old']);

        $_SESSION['usuario_id'] = $idPersona;
        $_SESSION['nombre']     = $nombreCompleto;
        $_SESSION['email']      = $email;
        $_SESSION['progreso']   = 0;

        header('Location: ../dashboard/dashboard.php');
        exit;
    } catch (PDOException $e) {
        $_SESSION['registro_error'] = 'Ocurrio un error al registrar. Intenta de nuevo.';
        header('Location: Registro.php');
        exit;
    }
}

unset($_SESSION['registro_old']);

$_SESSION['usuario_id'] = 0;
$_SESSION['nombre']     = $nombreCompleto;
$_SESSION['email']      = $email;
$_SESSION['progreso']   = 0;

header('Location: ../dashboard/dashboard.php');
exit;
