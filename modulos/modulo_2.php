<?php
require_once '../includes/auth.php';
require_once '../includes/conexion.php';
require_once '../includes/datos.php';
requireLogin();

$pageTitle  = 'Módulo II — Sistema Político-Electoral';
$pageActive = 'modulo2';

$moduloData     = datosModulo2();
$progresoModulo = 0;

if (DB_ACTIVA && $pdo) {
    try {
        $stmt = $pdo->prepare('SELECT m.*, c.nombre_curso, c.id_curso FROM aprende_modulo m JOIN aprende_curso c ON c.id_curso = m.id_curso WHERE m.id_modulo = 2');
        $stmt->execute();
        $bd = $stmt->fetch();

        if ($bd) {
            $stmtU = $pdo->prepare('SELECT * FROM aprende_unidad WHERE id_modulo = 2 ORDER BY numero_unidad');
            $stmtU->execute();
            $unidades = $stmtU->fetchAll();

            if (!empty($unidades)) {
                foreach ($unidades as &$unidad) {
                    $stmtT = $pdo->prepare('SELECT * FROM aprende_tema WHERE id_unidad = ? ORDER BY numero_tema');
                    $stmtT->execute([$unidad['id_unidad']]);
                    $unidad['temas'] = $stmtT->fetchAll();
                }
                unset($unidad);

                $moduloData = array_merge($moduloData, [
                    'nombre_modulo'       => $bd['nombre_modulo'],
                    'presentacion_modulo' => $bd['presentacion_modulo'],
                    'objetivo_modulo'     => $bd['objetivo_modulo'],
                    'nombre_curso'        => $bd['nombre_curso'],
                    'id_curso'            => $bd['id_curso'],
                    'unidades'            => $unidades,
                ]);
            }
        }
    } catch (PDOException $e) {
    }
}

include '../includes/vista_modulo.php';
