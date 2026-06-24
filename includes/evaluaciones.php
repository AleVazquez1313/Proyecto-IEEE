<?php

function catalogoEvaluaciones(): array
{
    return [
        'modulo2' => [
            'id'             => 'modulo2',
            'modulo'         => 2,
            'numero'         => 'II',
            'titulo'         => 'Evaluación del Módulo II',
            'subtitulo'      => 'Sistema Político-Electoral Mexicano',
            'descripcion'    => 'Esta evaluación valida los conocimientos adquiridos sobre la normatividad electoral, las autoridades que organizan las elecciones, la geografía electoral y el sistema de partidos en México.',
            'acento'         => '#346484',
            'acento_rgb'     => '52, 100, 132',
            'preguntas_total'=> 8,
            'minimo'         => 80,
            'intentos'       => 2,
            'minutos'        => 15,
            'temas'          => [
                'Normatividad electoral (Constitución y leyes)',
                'Autoridades electorales: INE e IEEQ',
                'Geografía electoral y cargos del PEL 2026-2027',
                'Partidos políticos y candidaturas independientes',
            ],
            'preguntas' => [
                [
                    'texto'    => '¿Cuál es la ley general que regula la organización de las elecciones federales y locales en México?',
                    'opciones' => [
                        'La Ley Federal del Trabajo',
                        'La Ley General de Instituciones y Procedimientos Electorales (LGIPE)',
                        'El Código Civil Federal',
                        'La Ley de Amparo',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Qué autoridad electoral se encarga de organizar las elecciones federales en México?',
                    'opciones' => [
                        'El Instituto Electoral del Estado de Querétaro',
                        'La Suprema Corte de Justicia de la Nación',
                        'El Instituto Nacional Electoral (INE)',
                        'La Cámara de Diputados',
                    ],
                    'correcta' => 2,
                ],
                [
                    'texto'    => '¿Cuál es la función principal del Instituto Electoral del Estado de Querétaro (IEEQ)?',
                    'opciones' => [
                        'Organizar las elecciones locales en Querétaro',
                        'Vigilar las elecciones de todo el país',
                        'Designar a los gobernadores',
                        'Aprobar las leyes federales',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => '¿Qué documento establece los derechos político-electorales fundamentales de la ciudadanía mexicana?',
                    'opciones' => [
                        'El reglamento interno del INE',
                        'La Constitución Política de los Estados Unidos Mexicanos',
                        'El manual de casillas',
                        'La convocatoria electoral',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => 'Los partidos políticos en México se definen principalmente como:',
                    'opciones' => [
                        'Empresas privadas con fines de lucro',
                        'Dependencias del gobierno federal',
                        'Entidades de interés público que promueven la participación ciudadana',
                        'Asociaciones religiosas',
                    ],
                    'correcta' => 2,
                ],
                [
                    'texto'    => '¿Qué permiten las candidaturas independientes?',
                    'opciones' => [
                        'Que solo los partidos postulen candidatos',
                        'Que la ciudadanía se postule a cargos sin pertenecer a un partido político',
                        'Que se elija al presidente sin votación',
                        'Que se cancelen las elecciones',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => 'En el marco del Proceso Electoral Local 2026-2027, ¿qué tipo de cargos se renuevan en Querétaro?',
                    'opciones' => [
                        'Únicamente la Presidencia de la República',
                        'Gubernatura, diputaciones locales y ayuntamientos',
                        'Solo jueces y magistrados',
                        'Embajadores y cónsules',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Qué principio obliga a los partidos a postular el mismo número de candidaturas de hombres y mujeres?',
                    'opciones' => [
                        'La reelección',
                        'La paridad de género',
                        'La mayoría relativa',
                        'La veda electoral',
                    ],
                    'correcta' => 1,
                ],
            ],
        ],

        'modulo3' => [
            'id'             => 'modulo3',
            'modulo'         => 3,
            'numero'         => 'III',
            'titulo'         => 'Evaluación del Módulo III',
            'subtitulo'      => 'Elecciones: Proceso, Jornada y Resultados',
            'descripcion'    => 'Esta evaluación valida los conocimientos sobre las etapas del proceso electoral, el desarrollo de la jornada electoral, la integración de las Mesas Directivas de Casilla y el cómputo de resultados.',
            'acento'         => '#0a8c4d',
            'acento_rgb'     => '10, 140, 77',
            'preguntas_total'=> 8,
            'minimo'         => 80,
            'intentos'       => 2,
            'minutos'        => 15,
            'temas'          => [
                'Etapas del proceso electoral',
                'La Jornada Electoral y las Mesas Directivas de Casilla',
                'Paquetes electorales y cómputos',
                'Medios de impugnación',
            ],
            'preguntas' => [
                [
                    'texto'    => '¿A qué hora se instala la casilla el día de la Jornada Electoral?',
                    'opciones' => [
                        'A las 6:00 horas',
                        'A las 8:00 horas',
                        'A las 10:00 horas',
                        'A las 12:00 horas',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Quiénes integran la Mesa Directiva de Casilla?',
                    'opciones' => [
                        'Funcionarios designados por los partidos',
                        'Policías y militares',
                        'Ciudadanía sorteada del padrón electoral',
                        'Empleados del INE',
                    ],
                    'correcta' => 2,
                ],
                [
                    'texto'    => '¿Cuál es el primer paso cuando una persona acude a votar?',
                    'opciones' => [
                        'Depositar la boleta en la urna',
                        'Identificarse con su credencial para votar',
                        'Firmar el acta de cierre',
                        'Contar los votos',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿A qué hora se cierra normalmente la votación?',
                    'opciones' => [
                        'A las 15:00 horas',
                        'A las 18:00 horas',
                        'A las 20:00 horas',
                        'A las 22:00 horas',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => 'El escrutinio y cómputo en la casilla consiste en:',
                    'opciones' => [
                        'Repartir las boletas a los votantes',
                        'Contar y clasificar los votos emitidos',
                        'Instalar la mampara',
                        'Registrar a las candidaturas',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => 'Después del escrutinio, ¿qué se hace con el paquete electoral?',
                    'opciones' => [
                        'Se destruye en la casilla',
                        'Se entrega al consejo distrital o municipal bajo custodia',
                        'Se lo lleva el presidente de casilla a su casa',
                        'Se publica en redes sociales',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Qué son las etapas del proceso electoral?',
                    'opciones' => [
                        'Fases ordenadas que van desde la preparación hasta la declaración de validez',
                        'Reuniones de los partidos políticos',
                        'Encuestas de opinión',
                        'Campañas publicitarias únicamente',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => '¿Para qué sirven los medios de impugnación electoral?',
                    'opciones' => [
                        'Para promover a los candidatos',
                        'Para inconformarse y revisar resultados o actos del proceso electoral',
                        'Para repartir el financiamiento',
                        'Para capacitar a la ciudadanía',
                    ],
                    'correcta' => 1,
                ],
            ],
        ],

        'final' => [
            'id'             => 'final',
            'modulo'         => 0,
            'numero'         => 'Final',
            'titulo'         => 'Evaluación Final del Curso',
            'subtitulo'      => 'ABC de la Función Electoral',
            'descripcion'    => 'Esta evaluación final integra los conocimientos de los tres módulos del curso: conceptos clave de democracia y participación, el sistema político-electoral mexicano y el desarrollo de las elecciones. Al aprobarla obtendrás tu constancia de participación.',
            'acento'         => '#741484',
            'acento_rgb'     => '116, 20, 132',
            'preguntas_total'=> 10,
            'minimo'         => 80,
            'intentos'       => 2,
            'minutos'        => 20,
            'temas'          => [
                'Módulo I: Democracia, participación y derechos político-electorales',
                'Módulo II: Sistema político-electoral mexicano',
                'Módulo III: Elecciones y jornada electoral',
            ],
            'preguntas' => [
                [
                    'texto'    => '¿Qué caracteriza a la democracia representativa?',
                    'opciones' => [
                        'La ciudadanía vota directamente cada decisión de gobierno',
                        'La ciudadanía elige representantes para que tomen decisiones en su nombre',
                        'Las decisiones las toma una sola persona',
                        'No existe el voto',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿A qué edad se adquiere la ciudadanía en México?',
                    'opciones' => [
                        'A los 16 años',
                        'A los 18 años',
                        'A los 21 años',
                        'A los 15 años',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Cuál es un ejemplo de mecanismo de participación ciudadana?',
                    'opciones' => [
                        'La consulta popular',
                        'El pago de impuestos',
                        'El servicio militar',
                        'La compra de bienes',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => '¿Qué busca la paridad de género en las candidaturas?',
                    'opciones' => [
                        'Que solo participen hombres',
                        'La participación igualitaria de mujeres y hombres en los cargos',
                        'Que solo participen mujeres',
                        'Eliminar las elecciones',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Qué autoridad organiza las elecciones locales en Querétaro?',
                    'opciones' => [
                        'El INE',
                        'El IEEQ',
                        'La Presidencia de la República',
                        'El Congreso de la Unión',
                    ],
                    'correcta' => 1,
                ],
                [
                    'texto'    => '¿Qué ley regula los procesos electorales en México?',
                    'opciones' => [
                        'La LGIPE',
                        'La Ley del Seguro Social',
                        'La Ley de Aguas Nacionales',
                        'El Código Penal',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => 'Los partidos políticos son:',
                    'opciones' => [
                        'Entidades de interés público',
                        'Empresas privadas',
                        'Oficinas de gobierno',
                        'Asociaciones deportivas',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => '¿Quiénes integran las Mesas Directivas de Casilla?',
                    'opciones' => [
                        'Ciudadanía sorteada del padrón electoral',
                        'Únicamente personal del INE',
                        'Los candidatos',
                        'La policía',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => '¿A qué hora se instala la casilla el día de la elección?',
                    'opciones' => [
                        'A las 8:00 horas',
                        'A las 6:00 horas',
                        'A las 12:00 horas',
                        'A las 9:00 horas',
                    ],
                    'correcta' => 0,
                ],
                [
                    'texto'    => 'Al concluir la votación, el funcionariado de casilla realiza:',
                    'opciones' => [
                        'El escrutinio y cómputo de los votos',
                        'Una campaña política',
                        'El registro de nuevos votantes',
                        'La compra de boletas',
                    ],
                    'correcta' => 0,
                ],
            ],
        ],
    ];
}

function obtenerEvaluacion(string $id): ?array
{
    $catalogo = catalogoEvaluaciones();
    return $catalogo[$id] ?? null;
}
