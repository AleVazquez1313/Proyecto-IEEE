<?php
session_start();
require_once '../includes/conexion.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: recuperar-password.php');
    exit;
}

if (isset($_POST['reenviar'])) {
    $_SESSION['recuperar_success'] = true;
    header('Location: recuperar-password.php');
    exit;
}

$email = trim($_POST['email'] ?? '');

if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['recuperar_error'] = 'Ingresa un correo electronico valido.';
    header('Location: recuperar-password.php');
    exit;
}

if (DB_ACTIVA && $pdo) {
    try {
        $stmt = $pdo->prepare('SELECT id_persona FROM aprende_persona WHERE email = ? LIMIT 1');
        $stmt->execute([$email]);
        $usuario = $stmt->fetch();

        if ($usuario) {
            $token  = bin2hex(random_bytes(32));
            $expira = date('Y-m-d H:i:s', strtotime('+30 minutes'));
            $ins = $pdo->prepare('INSERT INTO aprende_reset_tokens (id_persona, token, expira_en, usado) VALUES (?, ?, ?, 0)');
            $ins->execute([$usuario['id_persona'], $token, $expira]);
        }
    } catch (PDOException $e) {
    }
}

$_SESSION['recuperar_success'] = true;
header('Location: recuperar-password.php');
exit;
