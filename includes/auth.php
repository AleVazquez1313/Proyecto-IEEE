<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function requireLogin(): void
{
    if (!isset($_SESSION['usuario_id'])) {
        header('Location: ../auth/Login.php');
        exit;
    }
}

function usuarioActual(): array
{
    return [
        'id'       => $_SESSION['usuario_id'] ?? null,
        'nombre'   => $_SESSION['nombre']     ?? 'Invitado',
        'email'    => $_SESSION['email']      ?? '',
        'progreso' => $_SESSION['progreso']   ?? 0,
    ];
}

function iniciales(string $nombre): string
{
    $partes = preg_split('/\s+/', trim($nombre));
    $ini = strtoupper(substr($partes[0] ?? '', 0, 1));
    if (count($partes) > 1) {
        $ini .= strtoupper(substr(end($partes), 0, 1));
    }
    return $ini ?: 'U';
}
