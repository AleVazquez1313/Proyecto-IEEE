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
            'resumen'       => 'Fundamentos de la democracia, la ciudadanía, la cultura política y los derechos político-electorales.',
            'unidades'      => 5,
        ],
        2 => [
            'id_modulo'     => 2,
            'numero'        => 'II',
            'nombre_modulo' => 'Sistema Político-Electoral',
            'resumen'       => 'Normatividad, autoridades electorales, geografía electoral, partidos y medios de impugnación.',
            'unidades'      => 6,
        ],
        3 => [
            'id_modulo'     => 3,
            'numero'        => 'III',
            'nombre_modulo' => 'Elecciones',
            'resumen'       => 'Etapas del proceso electoral, jornada electoral, cómputos y resultados.',
            'unidades'      => 3,
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
        'nombre_modulo'       => 'Sistema Político-Electoral',
        'presentacion_modulo' => 'En este módulo conocerás cómo está organizado el sistema político-electoral de México. Verás las reglas que rigen las elecciones, quiénes son las autoridades que las organizan, cómo se divide el territorio para votar, qué papel juegan los partidos y las candidaturas independientes, y qué ocurre cuando alguien no está de acuerdo con un resultado.',
        'objetivo_modulo'     => 'Comprender las reglas, las autoridades, la organización territorial, los actores políticos y los mecanismos de defensa que conforman el sistema político-electoral mexicano.',
        'acento'              => '#346484',
        'acento_rgb'          => '52, 100, 132',
        'unidades' => [
            [
                'id_unidad' => 4, 'numero_unidad' => 1,
                'nombre_unidad' => 'Las reglas del juego',
                'descripcion_unidad' => 'La normatividad que ordena cómo se hacen las elecciones en México.',
                'temas' => [
                    ['id_tema' => 10, 'numero_tema' => 1, 'nombre_tema' => 'La Constitución: la regla más importante', 'descripcion_tema' => 'Todas las elecciones en México parten de un mismo punto: la Constitución. En ella se reconoce que el pueblo elige a quienes lo gobiernan y se establecen los derechos de la ciudadanía para votar y ser votada. La Constitución es como el reglamento general del juego democrático: marca lo que se puede y lo que no se puede hacer, y de ahí se desprenden todas las demás leyes electorales.'],
                    ['id_tema' => 11, 'numero_tema' => 2, 'nombre_tema' => 'Leyes federales', 'descripcion_tema' => 'A nivel nacional existe una ley que ordena cómo se organizan las elecciones en todo el país. Esta ley define cómo se preparan los comicios, qué le toca hacer a cada autoridad y cuáles son los derechos y obligaciones de los partidos y de la ciudadanía. Su objetivo es que las elecciones sean iguales de claras y confiables en cualquier estado de la República.'],
                    ['id_tema' => 12, 'numero_tema' => 3, 'nombre_tema' => 'Leyes locales', 'descripcion_tema' => 'Cada estado tiene además su propia ley electoral para organizar sus elecciones locales. En Querétaro, esta ley establece cómo se eligen la gubernatura, las diputaciones locales y los ayuntamientos, y define qué le corresponde hacer al Instituto Electoral del Estado de Querétaro. Las leyes locales siempre deben respetar lo que dicen la Constitución y las leyes federales.'],
                ],
            ],
            [
                'id_unidad' => 5, 'numero_unidad' => 2,
                'nombre_unidad' => 'Autoridades electorales',
                'descripcion_unidad' => 'Quiénes organizan y vigilan las elecciones, y qué hace cada uno.',
                'temas' => [
                    ['id_tema' => 13, 'numero_tema' => 1, 'nombre_tema' => '¿Cuáles son y qué hacen?', 'descripcion_tema' => 'Organizar una elección no lo hace una sola persona ni una sola oficina. Existen autoridades electorales que se encargan de preparar todo, vigilar que se cumplan las reglas y resolver los conflictos que surjan. Unas organizan la elección y otras se dedican a impartir justicia electoral. Conocerlas ayuda a entender quién es responsable de cada parte del proceso.'],
                    ['id_tema' => 14, 'numero_tema' => 2, 'nombre_tema' => 'INE: el árbitro nacional', 'descripcion_tema' => 'El Instituto Nacional Electoral es la autoridad que organiza las elecciones federales en México. Entre sus tareas está mantener actualizada la lista de personas que pueden votar, emitir la credencial para votar, capacitar a quienes atenderán las casillas y vigilar que los partidos usen bien sus recursos. Es, en pocas palabras, el árbitro que cuida que la elección nacional sea pareja para todos.'],
                    ['id_tema' => 15, 'numero_tema' => 3, 'nombre_tema' => 'IEEQ: el árbitro en Querétaro', 'descripcion_tema' => 'El Instituto Electoral del Estado de Querétaro es la autoridad que organiza las elecciones locales en el estado. Se encarga de las elecciones de gubernatura, diputaciones locales y ayuntamientos. Trabaja de la mano con el INE y, al igual que éste, debe actuar con imparcialidad para que la ciudadanía confíe en los resultados. Es la institución donde se desarrolla este proyecto.'],
                ],
            ],
            [
                'id_unidad' => 6, 'numero_unidad' => 3,
                'nombre_unidad' => 'Geografía electoral',
                'descripcion_unidad' => 'Cómo se organiza el territorio y qué cargos se eligen en el PEL 2026-2027.',
                'temas' => [
                    ['id_tema' => 16, 'numero_tema' => 1, 'nombre_tema' => 'Cargos por renovarse en el PEL 2026-2027', 'descripcion_tema' => 'En el Proceso Electoral Local 2026-2027, la ciudadanía de Querétaro elegirá a varias de sus autoridades. Se renuevan cargos como las diputaciones del Congreso del Estado y los ayuntamientos de los municipios. Saber qué cargos están en juego ayuda a entender la importancia de participar y de conocer a quienes buscan representarnos.'],
                    ['id_tema' => 17, 'numero_tema' => 2, 'nombre_tema' => 'Distritos uninominales', 'descripcion_tema' => 'Para organizar la votación, el territorio se divide en zonas llamadas distritos. En cada distrito se elige a una sola persona para un cargo, por eso se les llama uninominales. Esta división busca que cada zona tenga representación y que el número de habitantes por distrito sea más o menos parejo, para que el voto de cada persona valga lo mismo.'],
                    ['id_tema' => 18, 'numero_tema' => 3, 'nombre_tema' => 'Secciones y casillas', 'descripcion_tema' => 'Cada distrito se divide a su vez en secciones, que son las zonas más pequeñas del mapa electoral. En cada sección se instalan una o varias casillas el día de la elección, que es el lugar donde la gente acude a votar. Esta organización permite que la votación esté cerca de donde vive cada persona y que sea más fácil ordenar el conteo.'],
                ],
            ],
            [
                'id_unidad' => 7, 'numero_unidad' => 4,
                'nombre_unidad' => 'Sistema de partidos y candidaturas independientes',
                'descripcion_unidad' => 'Qué son los partidos, sus derechos y obligaciones, y las candidaturas independientes.',
                'temas' => [
                    ['id_tema' => 19, 'numero_tema' => 1, 'nombre_tema' => 'Qué son los partidos políticos', 'descripcion_tema' => 'Los partidos políticos son organizaciones de personas que comparten ideas sobre cómo debe gobernarse el país. Su función es acercar a la ciudadanía a la vida pública, presentar propuestas y postular candidaturas a los cargos de elección. Se les considera entidades de interés público porque cumplen una tarea importante para la democracia, no son ni empresas ni oficinas de gobierno.'],
                    ['id_tema' => 20, 'numero_tema' => 2, 'nombre_tema' => 'Derechos y obligaciones de los partidos', 'descripcion_tema' => 'Los partidos tienen derechos, como recibir recursos públicos para sus actividades y tener espacios en radio y televisión. Pero también tienen obligaciones: deben informar cómo gastan su dinero, respetar las reglas de las campañas y promover la participación. Cuando un partido no cumple, las autoridades electorales pueden sancionarlo.'],
                    ['id_tema' => 21, 'numero_tema' => 3, 'nombre_tema' => 'Candidaturas independientes', 'descripcion_tema' => 'No es obligatorio pertenecer a un partido para buscar un cargo. Las candidaturas independientes permiten que una persona se postule por su cuenta, siempre que reúna un número determinado de firmas de apoyo de la ciudadanía. Esta opción abre la puerta a más personas y le da a la ciudadanía más alternativas para elegir.'],
                ],
            ],
            [
                'id_unidad' => 8, 'numero_unidad' => 5,
                'nombre_unidad' => 'Régimen sancionador y medios de impugnación',
                'descripcion_unidad' => 'Qué pasa cuando se rompen las reglas y cómo se defienden los derechos electorales.',
                'temas' => [
                    ['id_tema' => 22, 'numero_tema' => 1, 'nombre_tema' => 'Régimen sancionador electoral', 'descripcion_tema' => 'Así como hay reglas, hay consecuencias cuando se rompen. El régimen sancionador es el conjunto de procedimientos para revisar las conductas que violan la ley electoral, como hacer campaña fuera de tiempo o usar mal los recursos. Si se comprueba una falta, la autoridad puede aplicar una sanción. Su propósito es que todos compitan en condiciones justas.'],
                    ['id_tema' => 23, 'numero_tema' => 2, 'nombre_tema' => 'Sistema de medios de impugnación', 'descripcion_tema' => 'Cuando alguien considera que una decisión electoral no fue correcta, no se queda sin opciones: puede inconformarse. Los medios de impugnación son los recursos legales que permiten pedir que una autoridad revise un acto o un resultado. Gracias a ellos, las decisiones se pueden corregir si hubo un error, lo que da certeza y confianza al proceso.'],
                ],
            ],
            [
                'id_unidad' => 9, 'numero_unidad' => 6, 'es_evaluacion' => true,
                'nombre_unidad' => 'Evaluación del Módulo II',
                'descripcion_unidad' => 'Evaluación de los conocimientos adquiridos en este módulo.',
                'temas' => [
                    ['id_tema' => 24, 'numero_tema' => 1, 'nombre_tema' => 'Evaluación del Módulo II', 'descripcion_tema' => 'Evaluación de conocimientos sobre el sistema político-electoral mexicano.'],
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
        'nombre_modulo'       => 'Elecciones',
        'presentacion_modulo' => 'En este módulo aprenderás cómo se desarrolla una elección de principio a fin. Conocerás las etapas del proceso electoral y, de manera muy cercana, todo lo que ocurre el día de la Jornada Electoral: cómo se integran e instalan las casillas, cómo se vota, cómo se cuentan los votos y cómo se dan a conocer los resultados.',
        'objetivo_modulo'     => 'Identificar las etapas del proceso electoral y comprender el desarrollo completo de la Jornada Electoral, desde la instalación de las casillas hasta la entrega de constancias.',
        'acento'              => '#0a8c4d',
        'acento_rgb'          => '10, 140, 77',
        'timeline' => [
            ['n' => 1, 'titulo' => 'Preparación de la elección', 'detalle' => 'Convocatoria, registro de candidaturas y capacitación.'],
            ['n' => 2, 'titulo' => 'Jornada Electoral', 'detalle' => 'Votación, escrutinio y cómputo en las casillas.', 'destacado' => true],
            ['n' => 3, 'titulo' => 'Resultados', 'detalle' => 'Cómputos, conteos rápidos y PREP.'],
            ['n' => 4, 'titulo' => 'Declaración de validez', 'detalle' => 'Entrega de constancias a quienes ganaron.'],
        ],
        'unidades' => [
            [
                'id_unidad' => 10, 'numero_unidad' => 1,
                'nombre_unidad' => 'Proceso electoral',
                'descripcion_unidad' => 'Las etapas de una elección, desde su preparación hasta la validez de los resultados.',
                'temas' => [
                    ['id_tema' => 30, 'numero_tema' => 1, 'nombre_tema' => 'Etapas del proceso electoral', 'descripcion_tema' => 'Una elección no ocurre en un solo día: es un proceso ordenado con etapas. Primero viene la preparación, después la Jornada Electoral, luego el conteo y la entrega de resultados, y al final la declaración de validez. Conocer estas etapas ayuda a entender que detrás del voto hay meses de trabajo planeado para que todo salga bien.'],
                    ['id_tema' => 31, 'numero_tema' => 2, 'nombre_tema' => 'Preparación de la elección', 'descripcion_tema' => 'Es la primera etapa y la más larga. En ella se hace la convocatoria, se registran las candidaturas, se diseñan e imprimen las boletas, se ubican las casillas y se capacita a las personas que las atenderán. Es como alistar todo antes de un gran evento: si la preparación es buena, el día de la elección todo fluye con orden.'],
                    ['id_tema' => 32, 'numero_tema' => 3, 'nombre_tema' => 'Registro de candidaturas', 'descripcion_tema' => 'Para aparecer en la boleta, las personas que quieren un cargo deben registrarse formalmente ante la autoridad electoral dentro de los plazos marcados. Se revisa que cumplan los requisitos para el cargo. Una vez aprobado el registro, ya pueden iniciar sus campañas y presentar sus propuestas a la ciudadanía.'],
                    ['id_tema' => 33, 'numero_tema' => 4, 'nombre_tema' => 'Resultados y declaración de validez', 'descripcion_tema' => 'Después de que la gente vota, se cuentan los votos y se suman los resultados de todas las casillas. Si no hay inconformidades, la autoridad declara válida la elección y entrega la constancia a quien ganó. Esta etapa cierra el proceso y le da certeza legal a quienes resultaron electos.'],
                ],
            ],
            [
                'id_unidad' => 11, 'numero_unidad' => 2,
                'nombre_unidad' => 'Jornada Electoral',
                'descripcion_unidad' => 'Todo lo que ocurre el día de la elección, paso a paso.',
                'temas' => [
                    ['id_tema' => 34, 'numero_tema' => 1, 'nombre_tema' => 'Integración de las Mesas Directivas de Casilla', 'descripcion_tema' => 'Las casillas no las atienden empleados del gobierno, sino ciudadanía como tú. A través de un sorteo se elige a las personas que recibirán y contarán los votos. A este grupo se le llama Mesa Directiva de Casilla, y se integra por una presidencia, una secretaría y escrutadores. Ser parte de ella es una de las formas más directas de participar en la democracia.'],
                    ['id_tema' => 35, 'numero_tema' => 2, 'nombre_tema' => 'Instalación de las casillas', 'descripcion_tema' => 'El día de la elección, en la mañana, las personas de la Mesa Directiva se reúnen para instalar la casilla. Acomodan la mampara, las urnas y la documentación, y verifican que todo esté en orden antes de abrir. La instalación correcta es lo que permite que la votación empiece a tiempo y de manera segura.'],
                    ['id_tema' => 36, 'numero_tema' => 3, 'nombre_tema' => 'Desarrollo de la jornada electoral', 'descripcion_tema' => 'Una vez abierta la casilla, la gente acude a votar. Cada persona se identifica con su credencial, se busca su nombre en la lista, recibe sus boletas, marca su voto en secreto detrás de la mampara y lo deposita en la urna. Este momento es el corazón de la democracia: la decisión libre y secreta de cada persona.'],
                    ['id_tema' => 37, 'numero_tema' => 4, 'nombre_tema' => 'Clausura de la casilla', 'descripcion_tema' => 'A la hora marcada se cierra la votación. La Mesa Directiva cuenta los votos, separa los válidos de los nulos, llena las actas con los resultados y los coloca a la vista de todos en el exterior de la casilla. Con esto se cierra de forma transparente la votación de ese lugar.'],
                    ['id_tema' => 38, 'numero_tema' => 5, 'nombre_tema' => 'Cadena de custodia y recolección de paquetes', 'descripcion_tema' => 'Después del conteo, las boletas, las actas y los documentos se guardan en el paquete electoral. Este paquete se traslada con cuidado y bajo vigilancia hasta el consejo correspondiente. A este cuidado se le llama cadena de custodia, y sirve para garantizar que nada se pierda ni se altere en el camino.'],
                    ['id_tema' => 39, 'numero_tema' => 6, 'nombre_tema' => 'Conteos rápidos y PREP', 'descripcion_tema' => 'La misma noche de la elección, la ciudadanía quiere saber resultados. Para eso existen dos herramientas: el conteo rápido, que estima tendencias con una muestra de casillas, y el Programa de Resultados Electorales Preliminares (PREP), que va publicando los resultados conforme llegan las actas. Son resultados preliminares: dan una idea, pero no son los oficiales.'],
                    ['id_tema' => 40, 'numero_tema' => 7, 'nombre_tema' => 'Sesiones de cómputo y entrega de constancias', 'descripcion_tema' => 'Los días siguientes a la elección, los consejos se reúnen para hacer el cómputo oficial: suman acta por acta los resultados de todas las casillas. Cuando el conteo termina y no hay inconformidades, se declara la validez de la elección y se entregan las constancias a las candidaturas ganadoras. Aquí concluye formalmente el proceso.'],
                ],
            ],
            [
                'id_unidad' => 12, 'numero_unidad' => 3, 'es_evaluacion' => true,
                'nombre_unidad' => 'Evaluación del Módulo III',
                'descripcion_unidad' => 'Evaluación final del módulo sobre el proceso y la jornada electoral.',
                'temas' => [
                    ['id_tema' => 41, 'numero_tema' => 1, 'nombre_tema' => 'Evaluación del Módulo III', 'descripcion_tema' => 'Evaluación sobre las etapas del proceso electoral y el desarrollo de la jornada electoral.'],
                ],
            ],
        ],
    ];
}
