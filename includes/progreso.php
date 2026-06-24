<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function progresoInicializar(): void
{
    if (!isset($_SESSION['progreso_curso'])) {
        $_SESSION['progreso_curso'] = [
            'modulos_vistos'      => [],
            'evaluaciones_ok'     => [],
        ];
    }
}

function marcarModuloVisto(int $idModulo): void
{
    progresoInicializar();
    if (!in_array($idModulo, $_SESSION['progreso_curso']['modulos_vistos'], true)) {
        $_SESSION['progreso_curso']['modulos_vistos'][] = $idModulo;
    }
}

function marcarEvaluacionAprobada(string $idEval): void
{
    progresoInicializar();
    if (!in_array($idEval, $_SESSION['progreso_curso']['evaluaciones_ok'], true)) {
        $_SESSION['progreso_curso']['evaluaciones_ok'][] = $idEval;
    }
}

function moduloFueVisto(int $idModulo): bool
{
    progresoInicializar();
    return in_array($idModulo, $_SESSION['progreso_curso']['modulos_vistos'], true);
}

function evaluacionAprobada(string $idEval): bool
{
    progresoInicializar();
    return in_array($idEval, $_SESSION['progreso_curso']['evaluaciones_ok'], true);
}


function requisitosConstancia(): array
{
    progresoInicializar();
    return [
        ['clave' => 'mod1',  'etiqueta' => 'Revisar el Módulo I',            'completo' => moduloFueVisto(1)],
        ['clave' => 'mod2',  'etiqueta' => 'Revisar el Módulo II',           'completo' => moduloFueVisto(2)],
        ['clave' => 'mod3',  'etiqueta' => 'Revisar el Módulo III',          'completo' => moduloFueVisto(3)],
        ['clave' => 'eval2', 'etiqueta' => 'Aprobar la Evaluación del Módulo II',  'completo' => evaluacionAprobada('modulo2')],
        ['clave' => 'eval3', 'etiqueta' => 'Aprobar la Evaluación del Módulo III', 'completo' => evaluacionAprobada('modulo3')],
        ['clave' => 'final', 'etiqueta' => 'Aprobar la Evaluación Final',     'completo' => evaluacionAprobada('final')],
    ];
}

function progresoPorcentaje(): int
{
    $reqs = requisitosConstancia();
    $total = count($reqs);
    $hechos = count(array_filter($reqs, fn($r) => $r['completo']));
    return $total > 0 ? (int) round(($hechos / $total) * 100) : 0;
}

function constanciaDesbloqueada(): bool
{
    foreach (requisitosConstancia() as $r) {
        if (!$r['completo']) {
            return false;
        }
    }
    return true;
}
