<?php

function datosCurso(): array
{
    return [
        'id_curso'            => 1,
        'nombre_curso'        => 'ABC de la Función Electoral',
        'presentacion_curso'  => 'Este curso te proporcionará los conocimientos mínimos necesarios para integrarte al ámbito electoral del IEEQ en el marco del Proceso Electoral Local 2026-2027. El contenido está diseñado con lenguaje claro y accesible, sin tecnicismos, para que cualquier ciudadana o ciudadano pueda comprenderlo y aplicarlo.',
        'objetivo_curso'      => 'Brindar a la ciudadanía las herramientas y conocimientos fundamentales sobre la función electoral, el sistema político-electoral mexicano y el desarrollo del proceso electoral, fomentando una participación informada y responsable.',
        'objetivos'           => [
            'Comprender los conceptos fundamentales de la democracia y la participación ciudadana.',
            'Conocer el sistema político-electoral mexicano y las autoridades que lo integran.',
            'Identificar las etapas del proceso electoral y el rol de las Mesas Directivas de Casilla.',
            'Reconocer los derechos y obligaciones político-electorales de la ciudadanía.',
            'Obtener la constancia de participación al aprobar las evaluaciones con mínimo 80 puntos.',
        ],
    ];
}

function datosModulos(): array
{
    return [
        1 => [
            'id_modulo'     => 1,
            'numero'        => 'I',
            'nombre_modulo' => 'Conceptos clave: Democracia, participación y derechos político-electorales',
            'resumen'       => 'Fundamentos de la democracia, la ciudadanía y los derechos político-electorales.',
            'unidades'      => 5,
        ],
        2 => [
            'id_modulo'     => 2,
            'numero'        => 'II',
            'nombre_modulo' => 'Sistema Político-Electoral Mexicano',
            'resumen'       => 'Normatividad, autoridades electorales y geografía del proceso electoral.',
            'unidades'      => 5,
        ],
        3 => [
            'id_modulo'     => 3,
            'numero'        => 'III',
            'nombre_modulo' => 'Elecciones: Proceso, Jornada y Resultados',
            'resumen'       => 'Etapas del proceso electoral, jornada electoral y cómputo de resultados.',
            'unidades'      => 5,
        ],
    ];
}

function datosModulo2(): array
{
    return [
        'id_modulo'           => 2,
        'numero'              => 'II',
        'id_curso'            => 1,
        'nombre_curso'        => 'ABC de la Función Electoral',
        'nombre_modulo'       => 'Sistema Político-Electoral Mexicano',
        'presentacion_modulo' => 'En este módulo conocerás cómo está organizado el sistema político-electoral de México: las leyes que lo rigen, las autoridades que lo operan y la geografía electoral que define cómo se distribuye la representación ciudadana.',
        'objetivo_modulo'     => 'Identificar las autoridades electorales, la normatividad vigente y la estructura del sistema político-electoral mexicano.',
        'acento'              => '#346484',
        'acento_rgb'          => '52, 100, 132',
        'unidades' => [
            [
                'id_unidad' => 4, 'numero_unidad' => 1,
                'nombre_unidad' => 'Las reglas del juego electoral',
                'descripcion_unidad' => 'Marco normativo que regula los procesos electorales en México.',
                'temas' => [
                    ['id_tema' => 10, 'numero_tema' => 1, 'nombre_tema' => 'La Constitución y los derechos político-electorales', 'descripcion_tema' => 'La Constitución Política de los Estados Unidos Mexicanos establece en su artículo 35 los derechos de la ciudadanía para votar, ser votada y asociarse políticamente. Estos derechos son la base del sistema democrático y su ejercicio está regulado por leyes secundarias como la LGIPE y la LGPP.'],
                    ['id_tema' => 11, 'numero_tema' => 2, 'nombre_tema' => 'Ley General de Instituciones y Procedimientos Electorales', 'descripcion_tema' => 'La LGIPE es el principal ordenamiento jurídico que regula la organización y el desarrollo de los procesos electorales federales y locales en México. Establece las atribuciones del INE, los procedimientos para la organización de elecciones y los derechos y obligaciones de partidos y ciudadanía.'],
                    ['id_tema' => 12, 'numero_tema' => 3, 'nombre_tema' => 'Código Electoral del Estado de Querétaro', 'descripcion_tema' => 'El Código Electoral del Estado de Querétaro regula los procesos electorales locales. Establece las atribuciones del IEEQ y los procedimientos para la elección de gobernador, diputaciones locales y ayuntamientos, así como los derechos y obligaciones de los actores políticos en el ámbito estatal.'],
                ],
            ],
            [
                'id_unidad' => 5, 'numero_unidad' => 2,
                'nombre_unidad' => 'Autoridades electorales en México',
                'descripcion_unidad' => 'Organismos responsables de organizar, vigilar y resolver los procesos electorales.',
                'temas' => [
                    ['id_tema' => 13, 'numero_tema' => 1, 'nombre_tema' => 'Instituto Nacional Electoral (INE)', 'descripcion_tema' => 'El INE es el organismo público autónomo responsable de organizar las elecciones federales en México. Entre sus funciones destacan organizar la jornada electoral, integrar el padrón electoral, acreditar observadores electorales y fiscalizar las finanzas de los partidos políticos. Su órgano de dirección es el Consejo General, integrado por once consejerías.'],
                    ['id_tema' => 14, 'numero_tema' => 2, 'nombre_tema' => 'Instituto Electoral del Estado de Querétaro (IEEQ)', 'descripcion_tema' => 'El IEEQ es el organismo público autónomo encargado de organizar los procesos electorales locales en Querétaro. Organiza las elecciones de gubernatura, diputaciones al Congreso local y ayuntamientos. Su máximo órgano de dirección es el Consejo General del IEEQ, integrado por consejerías electorales designadas por el Congreso del Estado.'],
                    ['id_tema' => 15, 'numero_tema' => 3, 'nombre_tema' => 'Tribunal Electoral del Poder Judicial de la Federación', 'descripcion_tema' => 'El TEPJF es la máxima autoridad jurisdiccional en materia electoral a nivel federal. Resuelve impugnaciones sobre resultados electorales, actos de autoridades electorales y conflictos entre partidos. Su resolución es definitiva e inatacable. A nivel local, el Tribunal Electoral del Estado de Querétaro cumple esta función en el ámbito estatal.'],
                    ['id_tema' => 16, 'numero_tema' => 4, 'nombre_tema' => 'Partidos políticos: función y financiamiento', 'descripcion_tema' => 'Los partidos políticos son entidades de interés público que promueven la participación ciudadana en la vida democrática. Reciben financiamiento público para sus actividades ordinarias y de campaña, fiscalizado por el INE. Para mantener su registro deben obtener al menos el 3% de la votación válida emitida en las elecciones federales.'],
                ],
            ],
            [
                'id_unidad' => 6, 'numero_unidad' => 3,
                'nombre_unidad' => 'Geografía electoral',
                'descripcion_unidad' => 'Organización territorial del país para efectos de la representación política.',
                'temas' => [
                    ['id_tema' => 17, 'numero_tema' => 1, 'nombre_tema' => 'Distritos electorales federales y locales', 'descripcion_tema' => 'México se divide en 300 distritos electorales uninominales para la elección de diputaciones federales de mayoría relativa. Cada distrito elige una diputación. Querétaro cuenta con distritos federales y locales para la elección de diputaciones al Congreso del Estado. La distritación es realizada por el INE de forma periódica.'],
                    ['id_tema' => 18, 'numero_tema' => 2, 'nombre_tema' => 'Circunscripciones plurinominales', 'descripcion_tema' => 'Para la elección de diputaciones federales por representación proporcional, el país se divide en cinco circunscripciones plurinominales. Cada una elige cuarenta diputaciones de lista. Querétaro pertenece a la Segunda Circunscripción, que también incluye estados del centro y occidente del país.'],
                    ['id_tema' => 19, 'numero_tema' => 3, 'nombre_tema' => 'Secciones electorales y casillas', 'descripcion_tema' => 'Las secciones electorales son la unidad territorial más pequeña del sistema electoral. Cada sección agrupa a un número determinado de electores. En cada sección se instala al menos una casilla el día de la jornada electoral, atendida por ciudadanía sorteada del padrón electoral que integra las Mesas Directivas de Casilla.'],
                ],
            ],
            [
                'id_unidad' => 7, 'numero_unidad' => 4,
                'nombre_unidad' => 'Participación política y representación',
                'descripcion_unidad' => 'Mecanismos de acceso al poder y principios de representación.',
                'temas' => [
                    ['id_tema' => 20, 'numero_tema' => 1, 'nombre_tema' => 'Mayoría relativa y representación proporcional', 'descripcion_tema' => 'El sistema electoral mexicano combina dos principios: la mayoría relativa, donde gana la candidatura con más votos en un distrito; y la representación proporcional, que distribuye escaños según el porcentaje de votos de cada partido. Esta combinación busca que los congresos reflejen la pluralidad política.'],
                    ['id_tema' => 21, 'numero_tema' => 2, 'nombre_tema' => 'Paridad de género en las candidaturas', 'descripcion_tema' => 'La paridad de género obliga a los partidos a postular el mismo número de candidaturas de hombres y mujeres. Esta medida busca garantizar la participación igualitaria en los cargos de representación popular y está consagrada en la Constitución desde la reforma de paridad total.'],
                    ['id_tema' => 22, 'numero_tema' => 3, 'nombre_tema' => 'Candidaturas independientes', 'descripcion_tema' => 'Las candidaturas independientes permiten a la ciudadanía postularse a cargos de elección popular sin pertenecer a un partido político. Para registrarse deben reunir un porcentaje de firmas de apoyo ciudadano dentro del ámbito territorial de la elección, conforme a la legislación electoral aplicable.'],
                ],
            ],
            [
                'id_unidad' => 8, 'numero_unidad' => 5, 'es_evaluacion' => true,
                'nombre_unidad' => 'Evaluación del Módulo II',
                'descripcion_unidad' => 'Evaluación de los conocimientos adquiridos en este módulo.',
                'temas' => [
                    ['id_tema' => 23, 'numero_tema' => 1, 'nombre_tema' => 'Evaluación parcial — Módulo II', 'descripcion_tema' => 'Evaluación de conocimientos sobre el Sistema Político-Electoral Mexicano.'],
                ],
            ],
        ],
    ];
}

function datosModulo3(): array
{
    return [
        'id_modulo'           => 3,
        'numero'              => 'III',
        'id_curso'            => 1,
        'nombre_curso'        => 'ABC de la Función Electoral',
        'nombre_modulo'       => 'Elecciones: Proceso, Jornada y Resultados',
        'presentacion_modulo' => 'En este módulo aprenderás cómo se desarrolla un proceso electoral de principio a fin: desde las actividades preparatorias hasta el cómputo de resultados. Conocerás el rol de las Mesas Directivas de Casilla y la importancia de tu participación en la Jornada Electoral del PEL 2026-2027.',
        'objetivo_modulo'     => 'Identificar las etapas del proceso electoral, el funcionamiento de la jornada electoral y el rol de la ciudadanía en el Proceso Electoral Local 2026-2027.',
        'acento'              => '#0a8c4d',
        'acento_rgb'          => '10, 140, 77',
        'timeline' => [
            ['n' => 1, 'titulo' => 'Preparación de la elección', 'detalle' => 'Convocatoria, registro de candidaturas y capacitación de funcionariado.'],
            ['n' => 2, 'titulo' => 'Campañas electorales', 'detalle' => 'Presentación de propuestas y actos de campaña autorizados.'],
            ['n' => 3, 'titulo' => 'Jornada Electoral', 'detalle' => 'Votación, escrutinio y cómputo en casillas.', 'destacado' => true],
            ['n' => 4, 'titulo' => 'Cómputos distritales', 'detalle' => 'Suma de resultados en los consejos del IEEQ.'],
            ['n' => 5, 'titulo' => 'Declaración de validez', 'detalle' => 'Constancias de mayoría y resolución de impugnaciones.'],
        ],
        'unidades' => [
            [
                'id_unidad' => 9, 'numero_unidad' => 1,
                'nombre_unidad' => 'El proceso electoral: etapas y actores',
                'descripcion_unidad' => 'Las fases del proceso electoral y quiénes participan en cada una.',
                'temas' => [
                    ['id_tema' => 30, 'numero_tema' => 1, 'nombre_tema' => 'Etapas del proceso electoral local', 'descripcion_tema' => 'El proceso electoral local en Querétaro se divide en cuatro etapas: preparación de la elección, jornada electoral, resultados y declaraciones de validez, y dictamen de validez de la elección. Cada etapa tiene plazos y actividades específicas definidas por la legislación electoral.'],
                    ['id_tema' => 31, 'numero_tema' => 2, 'nombre_tema' => 'Registro de candidaturas y campañas', 'descripcion_tema' => 'Los partidos presentan sus candidaturas ante el IEEQ dentro de los plazos establecidos. Cada candidatura debe cumplir los requisitos de elegibilidad. Las campañas son el periodo en que se presentan propuestas a la ciudadanía, con tiempos de radio y televisión administrados por el INE.'],
                    ['id_tema' => 32, 'numero_tema' => 3, 'nombre_tema' => 'Prerrogativas de los partidos políticos', 'descripcion_tema' => 'Los partidos tienen derecho a prerrogativas como acceso a tiempos en radio y televisión, financiamiento público y uso de espacios para reuniones. El financiamiento se distribuye según el porcentaje de votos de la última elección y su uso está sujeto a fiscalización.'],
                    ['id_tema' => 33, 'numero_tema' => 4, 'nombre_tema' => 'Periodo de veda electoral', 'descripcion_tema' => 'La veda electoral es el periodo previo y durante la jornada en el que está prohibido publicar encuestas, realizar actos de campaña y difundir publicidad gubernamental. Busca garantizar que la ciudadanía emita su voto libre de influencias de última hora.'],
                ],
            ],
            [
                'id_unidad' => 10, 'numero_unidad' => 2,
                'nombre_unidad' => 'La Jornada Electoral',
                'descripcion_unidad' => 'Todo lo que ocurre el día de la elección, desde la instalación hasta el cierre.',
                'temas' => [
                    ['id_tema' => 34, 'numero_tema' => 1, 'nombre_tema' => 'Instalación y apertura de la casilla', 'descripcion_tema' => 'La casilla se instala a las 8:00 horas del día de la elección y el funcionariado se reúne previamente. Si la presidencia no se presenta, asume el cargo la secretaría, y así sucesivamente. La casilla se instala en el lugar designado por el IEEQ o, de no ser posible, en un lugar visible y accesible.'],
                    ['id_tema' => 35, 'numero_tema' => 2, 'nombre_tema' => 'La Mesa Directiva de Casilla', 'descripcion_tema' => 'La Mesa Directiva de Casilla es el órgano electoral integrado por ciudadanía sorteada del padrón que recibe el voto el día de la jornada. Se integra por una presidencia, una secretaría y dos escrutadores, además de suplencias. Su función es garantizar el libre ejercicio del voto.'],
                    ['id_tema' => 36, 'numero_tema' => 3, 'nombre_tema' => 'Proceso de votación paso a paso', 'descripcion_tema' => 'El proceso de votación sigue estos pasos: la persona electora se identifica con su credencial, la secretaría verifica su nombre en la lista nominal, recibe sus boletas, vota en secreto tras la mampara, deposita las boletas en las urnas y marca su participación. Finalmente puede estampar su huella.'],
                    ['id_tema' => 37, 'numero_tema' => 4, 'nombre_tema' => 'Cierre, escrutinio y cómputo', 'descripcion_tema' => 'A las 18:00 horas se cierra la votación y el funcionariado realiza el escrutinio y cómputo: cuenta los votos emitidos, clasifica votos válidos y nulos, llena las actas, integra el paquete electoral y fija los resultados en un lugar visible fuera de la casilla.'],
                ],
            ],
            [
                'id_unidad' => 11, 'numero_unidad' => 3,
                'nombre_unidad' => 'Paquetes electorales y cómputos',
                'descripcion_unidad' => 'Qué ocurre después de la jornada: traslado, cómputos y resultados.',
                'temas' => [
                    ['id_tema' => 38, 'numero_tema' => 1, 'nombre_tema' => 'Integración y traslado del paquete electoral', 'descripcion_tema' => 'Al terminar el escrutinio se integra el paquete electoral con las boletas sobrantes, las boletas de las urnas, las actas, la lista nominal y la documentación de incidentes. El paquete se envía al consejo distrital o municipal correspondiente bajo custodia.'],
                    ['id_tema' => 39, 'numero_tema' => 2, 'nombre_tema' => 'Cómputo distrital y declaración de validez', 'descripcion_tema' => 'El cómputo distrital se realiza los días posteriores a la jornada. Los consejos del IEEQ suman los resultados de todas las casillas del distrito. Sin impugnaciones, se expiden las constancias de mayoría. Con impugnaciones, el proceso se remite al Tribunal Electoral.'],
                    ['id_tema' => 40, 'numero_tema' => 3, 'nombre_tema' => 'Observación electoral y representaciones', 'descripcion_tema' => 'La observación electoral la realiza ciudadanía acreditada para presenciar las actividades de la jornada. Las representaciones de partido y de candidaturas independientes pueden estar presentes en las casillas para vigilar el proceso. Ambas tienen prohibido interferir o hacer proselitismo.'],
                ],
            ],
            [
                'id_unidad' => 12, 'numero_unidad' => 4,
                'nombre_unidad' => 'Medios de impugnación electoral',
                'descripcion_unidad' => 'Cómo se impugnan los resultados y qué instancias los resuelven.',
                'temas' => [
                    ['id_tema' => 41, 'numero_tema' => 1, 'nombre_tema' => 'Recurso de inconformidad', 'descripcion_tema' => 'El recurso de inconformidad es el medio que se interpone ante el Tribunal Electoral local para impugnar resultados o actos del proceso electoral. Partidos, candidaturas y ciudadanía pueden interponerlo dentro de los plazos establecidos.'],
                    ['id_tema' => 42, 'numero_tema' => 2, 'nombre_tema' => 'Juicio ante el TEPJF', 'descripcion_tema' => 'El juicio ante el Tribunal Electoral del Poder Judicial de la Federación es el medio para impugnar las resoluciones de los tribunales locales. Es la última instancia en materia electoral y sus resoluciones son definitivas e inatacables.'],
                    ['id_tema' => 43, 'numero_tema' => 3, 'nombre_tema' => 'Nulidad de elecciones', 'descripcion_tema' => 'La nulidad de una elección puede declararse cuando se acredita que los resultados fueron afectados por irregularidades graves, generalizadas y determinantes. La nulidad de una elección conlleva la celebración de una elección extraordinaria.'],
                ],
            ],
            [
                'id_unidad' => 13, 'numero_unidad' => 5, 'es_evaluacion' => true,
                'nombre_unidad' => 'Evaluación del Módulo III',
                'descripcion_unidad' => 'Evaluación final del módulo sobre el proceso electoral.',
                'temas' => [
                    ['id_tema' => 44, 'numero_tema' => 1, 'nombre_tema' => 'Evaluación parcial — Módulo III', 'descripcion_tema' => 'Evaluación sobre el proceso electoral, la jornada electoral y los resultados.'],
                ],
            ],
        ],
    ];
}
