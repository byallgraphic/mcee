<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?php echo $_SESSION['nombres']?></p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form" autocomplete="off">
            <div class="input-group">
                <input id="searchLeft" type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['id'=>'menuLeft','class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
					['label' => 'Inicio', 'url' => Yii::$app->homeUrl,'icon' => 'home',],
					//menu mcee
					[
                                
                                        'label' => 'Hoja de Vida',
                                        'icon' => 'building-o',
                                        'url' => '#',
                                        'items' => 
										[
											
                                            [
												'label' => 'Información General',
												'icon' => 'folder',
												'url' => '#',
												'items' => 
												[
														
														['label' => 'Resumen IEO','icon' => 'circle-o', 'url' => ['instituciones/resumen'],],
														['label' => 'Instituciones','icon' => 'circle-o','url' => ['instituciones/index'],],
														// ['label' => 'Documentos Institucionales','icon' => 'circle-o','url' => ['documentos-oficiales/index'],],
														// ['label' => 'Instancias','icon' => 'circle-o','url' => ['documentos-instancias-institucionales/index'],],
														['label' => 'Sedes','icon' => 'circle-o','url' => ['sedes/index'],],
														['label' => 'Aulas','icon' => 'circle-o','url' => ['aulas/index'],],
														['label' => 'Jornadas','icon' => 'circle-o','url' => ['jornadas/index'],],
														['label' => 'Sedes - Jornadas','icon' => 'circle-o','url' => ['sedes-jornadas/index'],],
														['label' => 'Sedes - Niveles','icon' => 'circle-o','url' => ['sedes-niveles/index'],],
														['label' => 'Periodos','icon' => 'circle-o','url' => ['periodos/index'],],
														['label' => 'Asignaturas','icon' => 'circle-o','url' =>  ['asignaturas/index'],],
														['label' => 'Especialidades','icon' => 'circle-o','url' => ['sedes-areas-ensenanza/index'],],
														['label' => 'Niveles','icon' => 'circle-o','url' => ['niveles/index'],],
														['label' => 'Bloques por sede','icon' => 'circle-o','url' => ['sedes-bloques/index'],],
														['label' => 'Grupos por nivel','icon' => 'circle-o','url' => ['paralelos/index'],],
														['label' => 'Distribución académica', 'icon' => '', 'url' => ['distribuciones-academicas/index'],],
														['label' => 'Asignatura niveles', 'icon' => '', 'url' => ['asignaturas-niveles-sedes/index'],],
														['label' => 'Director de grupo', 'icon' => '', 'url' => ['director-paralelo/index'],],
														['label' => 'Carga Masiva', 'icon' => '', 'url' => ['poblar-tabla/index'],],
														
														['label' => 'Matricular Estudiante', 'icon' => 'circle-o', 'url' => ['estudiantes/index'],],
														
														['label' => 'Infraestructura Educativa','icon' => 'circle-o','url' => ['infraestructura-educativa/index'],],
														['label' => 'Rangos calificación','icon' => 'circle-o','url' => ['rangos-calificacion/index'],],
														['label' => 'Ponderación resultados','icon' => 'circle-o','url' => ['ponderacion-resultados/index'],],
													
														['label' => 'Reportes-Estadisticas', 'icon' => '', 'url' =>  ['reportes/index'],],
														['label' => 'Recursos', 
														'icon' => 'circle-o',
														'url' => '#',
														'items' => [
																		 ['label' => 'Humanos', 'icon' => '', 'url' =>  ['perfiles-personas-institucion/index'],],
																		 ['label' => 'Infraestructra física', 'icon' => 'circle-o', 'url' => ['recursos-infraestructura-fisica/index'],],
																		 ['label' => 'Infraestructra pedagógica', 'icon' => 'circle-o', 'url' => ['recurso-infraestructura-pedagogica/index'],],
																		
																	],
														
														],
														['label' => 'Cobertura', 'icon' => '', 'url' =>  ['cobertura/index'],],
														['label' => 'Soporte Académico', 'icon' => '', 'url' =>  ['grupos-soporte/index'],],
														
														['label' => 'Docentes-Institución', 'icon' => '', 'url' =>  ['docente-institucion/index'],],
														['label' => 'Resultados', 
														'icon' => 'circle-o',
														'url' => '#',
														'items' => [
																		['label' => 'Institución', 'icon' => '', 'url' =>  ['resultados-pruebas-saber-ie/index'],],
																		['label' => 'Cali', 'icon' => '', 'url' =>  ['resultados-pruebas-saber-cali/index'],],
																		['label' => 'PMI', 'icon' => '', 'url' =>  ['pmi/index'],],
																		['label' => 'Sem', 'icon' => '', 'url' =>  ['resultados-sem/index'],],
																		['label' => 'Evaluación Docente', 'icon' => '', 'url' =>  ['resultados-evaluacion/index'],],
																		['label' => 'Pruebas externas', 'icon' => '', 'url' =>  ['resultados-pruebas-externas/index'],],
																		['label' => 'Resultados', 'icon' => '', 'url' =>  ['resultados/index'],],
																		
																	],
														
														],
														
												],//
											],
											[
												'label' => 'Gestión Directiva',
												'icon' => 'sitemap',
												'url' => '#',
												 'items' => [
													['label' => 'Documentos Institucionales','icon' => 'circle-o','url' => ['documentos-oficiales/index'],],
												    ['label' => 'Instancias','icon' => 'circle-o','url' => ['documentos-instancias-institucionales/index'],],
													['label' => 'Proyectos',
													'icon' => 'circle-o',
													'url' => '#',
														'items' => [
															['label' => 'Por institución', 'icon' => 'circle-o', 'url' => ['participacion-proyectos-i-e/index'],],
															['label' => 'Por maestro o directivo', 'icon' => 'circle-o', 'url' => ['participacion-proyectos-maestro/index'],],
															['label' => 'Proyectos jornada complementaria', 'icon' => 'circle-o', 'url' => ['participacion-proyectos-jornada/index'],],
															// ['label' => 'Proyectos-pedagagógicos', 'icon' => '', 'url' =>  ['proyectos-pedagogicos-transversales/index'],],
															],
													],
												],
											],
											[
												'label' => 'Gestión Académica',
												'icon' => 'mortar-board',
												'url' => '#',
												 'items' => [
													
													['label' => 'Curriculum de la IEO','icon' => 'circle-o','url' => ['documentos-curriculum-ieo/index']],
													['label' => 'Modelo Pegagógico','icon' => 'circle-o','url' => ['modelo-pedagogico/index']],
													['label' => 'Plan de estudios','icon' => 'circle-o','url' => ['plan-estudios/index']],
													['label' => 'Plan de área','icon' => 'circle-o','url' => ['plan-de-area/index']],
													['label' => 'Intensidad horaria','icon' => 'circle-o','url' => ['intensidad-horaria-semanal/index']],
													['label' => 'Prueba Evaluación','icon' => 'circle-o','url' => ['plan-evaluacion/index']],
													['label' => 'Materiales Educativos','icon' => 'circle-o','url' => ['materiales-educativos/index']],
													['label' => 'Seguimiento Egresados','icon' => 'circle-o','url' => ['seguimiento-egresados/index']],
														
														
												],//
											],
											[
												'label' => 'Gestión Administrativa',
												'icon' => 'institution',
												'url' => '#',
												'items' => [
													['label' => 'Matrícula', 'icon' => 'circle-o', 'url' => '#'],
													['label' => 'Talento Humano',
													'icon' => 'circle-o',
													'url' => '#',
													'items' => [
															['label' => 'Evaluación', 'icon' => 'circle-o', 'url' => ['evaluacion/index']],
															['label' => 'Programas', 'icon' => 'circle-o', 'url' => ['programas/index']],
															['label' => 'Estimulos', 'icon' => 'circle-o', 'url' => ['estimulos/index']],
														],
													],
													['label' => 'Presupuesto', 'icon' => 'circle-o', 'url' => ['documentos-presupuesto/index']],
													['label' => 'Infraestructra', 'icon' => 'circle-o', 'url' => '#'],
													['label' => 'Estrategia Adecuación', 'icon' => 'circle-o', 'url' => '#'],
													['label' => 'Seguimiento', 'icon' => 'circle-o', 'url' => ['estrategia-embellecimiento-espacios/index']],
													['label' => 'Permisos módulos', 'icon' => 'circle-o', 'url' => ['permisos/index']],
												],
											],
											['label' => 'Gestión Comunitaria',
											'icon' => 'users',
											'url' => '#',
											'items' => [
                                                ['label' => 'Documentos', 'icon' => 'circle-o', 'url' => ['documentos-gestion-comunitaria/index', 'tipo_documento'=>'Gestion Comunitaria']],
                                                ['label' => 'Paz Cultural', 'icon' => 'circle-o', 'url' => ['paz-cultural/index', 'tipo_documento'=>'Gestion Comunitaria']],
                                                ['label' => 'Aliados', 'icon' => 'circle-o', 'url' => ['documentos-aliados/index']],
														// ['label' => 'Comité Gestión Riesgo', 'icon' => 'circle-o', 'url' => '#'],
														// ['label' => 'PGIR', 'icon' => 'circle-o', 'url' => '#'],
														// ['label' => 'Aliados', 'icon' => 'circle-o', 'url' => '#'],
														['label' => 'Actividades Vinulación', 'icon' => 'circle-o', 'url' => ['documentos-actividades-vinculacion/index']],
														['label' => 'Relaciones Sector', 'icon' => 'circle-o', 'url' => ['documentos-relaciones-sector/index']],
														
														],
											],
                                        ],// Hoja de vida
                                   
                    ],
					['label' => 'MCEE', 
									'icon' => 'book',
									'url' => '#',
									'items' => [
													
													['label' => 'Gestión Escolar', 
													'icon' => 'address-book', 
													'url' => '#',
													'items' => [
														['label' => 'Acompañamiento in Situ', 
														'icon' => 'arrow-right', 
														'url' => ['acompanamiento-in-situ/index'],
														],
														
														[
															'label' => 'Formación en liderazgo', 'icon' => 'arrow-right', 'url' => [
																'ge-seguimiento-gestion/',
																'idTipoSeguimiento'		=> 4,
																],
														],  //se agrega el index
														['label' => 'Comunicación para la gestión', 'icon' => 'arrow-right','url' => '#',], //se agrega el index
														['label' => 'Clima escolar y convivencia', 
														'icon' => 'arrow-right', 
														'url' => '#',
															'items' => [
																['label' => 'Clima escolar', 'icon' => 'circle-o','url' => ['clima-escolar/index'],],
																['label' => 'Medición', 'icon' => 'circle-o','url' => '#',],
																['label' => 'Caja de herramientas', 'icon' => 'circle-o','url' => '#',],  
															],
														],
														['label' => 'Proyectos pedagogicos productivos', 'icon' => 'arrow-right', 'url' => ['ppp-seguimiento-operador/index', 'idTipoSeguimiento'	=> 5],],

														],
													],
													
													['label' => 'Mejoramiento Aprendizajes', 
													'icon' => 'american-sign-language-interpreting', 
													'url' => '#',
													'items' => [
													     ['label' => 'Gestión Curricular',
														'icon' => 'arrow-right',
														'url' => '#',
														'items' => [
															['label' => 'Ciclos', 'icon' => 'arrow-right', 'url' => ['gc-ciclos/index'],],
															['label' => 'Bitácora', 'icon' => 'arrow-right', 'url' => ['gc-bitacora/index'],],
															['label' => 'Acompañamiento docentes tutores',
															'icon' => 'circle-o',
															'url' => '#',
															'items' => [
																	['label' => 'Bitácora Visitas', 'icon' => 'circle-o', 'url' => ['gestion-curricular-bitacoras-visitas-ieo/index'],],
																	['label' => 'Evaluación docente tutor', 'icon' => 'circle-o', 'url' => ['dimension-opciones-seguimiento-docente/index'],],
																	['label' =>' Autoevaluación docente tutor', 'icon' => 'circle-o', 'url' => ['dimension-opciones-autoevaluacion-docentes/index'],],
																	['label' => 'Instrumento seguimiento', 'icon' => 'circle-o', 'url' => ['dimension-opciones-instrumento-seguimiento/index'],],
																	['label' => 'Seguimiento Directivos', 'icon' => 'circle-o', 'url' => ['dimension-opciones-seguimiento-directivos/index'],],
																	['label' => 'Acompañamiento Docente', 'icon' => 'circle-o', 'url' => ['gestion-curricular-docente-tutor-acompanamiento/index'],],
														
																],	
															],
															['label' => 'Formación tutores', 'icon' => 'circle-o', 'url' => '#',],
															['label' => 'Acuerdos curriculares', 'icon' => 'circle-o', 'url' => '#',],
															
														],
													],
														['label' => 'Semilleros TIC', 
														'icon' => 'arrow-right', 
														'url' => ['semilleros/index'],
														// 'items' => [
																// ['label' => 'Docentes', 'icon' => 'long-arrow-right', 'url' => ['semilleros-datos-ieo/create'],], 
																// ['label' => 'Ejecución fase I', 'icon' => 'long-arrow-right', 'url' => ['ejecucion-fase-i/create'],],  
																// ['label' => 'Ejecución fase II', 'icon' => 'long-arrow-right', 'url' => ['ejecucion-fase-ii/create'],],  
																// ['label' => 'Ejecución fase III', 'icon' => 'long-arrow-right', 'url' => ['ejecucion-fase-iii/create'],],  
																// ['label' => 'Diario de campo', 'icon' => 'long-arrow-right', 'url' => ['semilleros-tic-diario-de-campo/index'],],
																// ['label' => 'Resumen operativo', 'icon' => 'long-arrow-right', 'url' => ['resumen-operativo-fases-docentes/index'],],
																// ['label' => 'Estudiantes', 'icon' => 'long-arrow-right', 'url' => ['semilleros-datos-ieo-estudiantes/create'],], 
																// ['label' => 'Ejecución fase I', 'icon' => 'long-arrow-right', 'url' => ['ejecucion-fase-i-estudiantes/create'],],
																// ['label' => 'Ejecución fase II', 'icon' => 'long-arrow-right', 'url' => ['ejecucion-fase-ii-estudiantes/create'],],
																// ['label' => 'Ejecución fase III', 'icon' => 'long-arrow-right', 'url' => ['ejecucion-fase-iii-estudiantes/create'],],
																// ['label' => 'Diario de campo', 'icon' => 'long-arrow-right', 'url' => ['semilleros-tic-diario-de-campo-estudiantes/index'],],
																// ['label' => 'Resumen operativo', 'icon' => 'long-arrow-right', 'url' => ['resumen-operativo-fases-estudiantes/index'],],
																// ['label' => 'Población', 'icon' => 'long-arrow-right', 'url' => ['instrumento-poblacion-estudiantes/create'],],
														
																// ],
															],
														
														],
													],
													['label' => 'Pedagogías para la Vida', 
													'icon' => 'edit', 
													'url' => '#',
													'items' => [
													
															['label' => 'Competencias básicas', 
															'icon' => 'arrow-right', 
															'url' => '#',
															'items' => [
																['label' => 'Articulación Familiar', 'icon' => 'circle-o','url' => ['ec-competencias-basicas-proyectos-articulacion/index'],],
																['label' => 'Proyecto de Servicio Social Estudiantil', 'icon' => 'circle-o','url' => ['ec-competencias-basicas-proyectos-obligatorio/index'],],
																['label' => 'Proyectos pedagógicos transversales',
																'icon' => 'circle-o',
																'url' => ['ec-competencias-basicas-proyectos/index'],
																// 'items' => [
																		// ['label' => 'Planeación', 'icon' => 'circle-o','url' => ['ec-datos-basicos/create'],],
																		// ['label' => 'Levantamiento', 'icon' => 'circle-o','url' => ['ec-levantamiento-orientacion/index'],],
																		// ['label' => 'Informe avance mensual Ejecución', 'icon' => 'circle-o','url' => ['ieo/index'],],
																		// ['label' => 'Informe avance mensual Misional', 'icon' => 'circle-o','url' => ['ecinformeplaneacionieo/index'],],
																		// ['label' => 'Informe semanal ejecución', 'icon' => 'circle-o','url' => ['informe-semanal-ejecucion-ise/index'],],
																		// ['label' => 'Informe semanal total ejecutivo', 'icon' => 'circle-o','url' => ['ec-informe-semanal-total-ejecutivo/index'],],
																		// ['label' => 'Articulación Familiar', 'icon' => 'circle-o','url' => '#',],
																		// ['label' => 'ASSC', 'icon' => 'circle-o','url' => '#',],
																		// ['label' => 'Semilleros para Paz', 'icon' => 'circle-o','url' => '#',],
																		// ['label' => 'Vinculo C+E', 'icon' => 'circle-o','url' => '#',],
																		// ['label' => 'Competencias Lúdicas', 'icon' => 'circle-o','url' => '#',],
																		// // ['label' => 'Avance Misional X IEO PPT', 'icon' => 'circle-o','url' => ['ec-avance-misional-ppt/index'],],
																		// // ['label' => 'Avance Misional X IEO SS', 'icon' => 'circle-o','url' => ['ec-avance-misional-ss/index'],],
																		// // ['label' => 'Avance Misional X IEO AF', 'icon' => 'circle-o','url' => ['ec-avance-misional/index'],],
																		// // ['label' => 'Avance Misional X EJE PPT', 'icon' => 'circle-o','url' => ['ec-avance-misional-ppt/index'],],
																		// // ['label' => 'Avance Misional X PROYECTO', 'icon' => 'circle-o','url' => ['ec-avance-misional-proyecto/index'],],
																		// ['label' => 'Informe semanal ejecución - ciere fase total ejecutivo', 'icon' => 'circle-o','url' => '#'],
																
																	// ],
																],
																['label' => 'Competencias transversalidad', 'icon' => 'circle-o','url' => ['ec-competencias-basicas-transversalidad/index'],],
																['label' => 'Estrategia de financiamiento', 'icon' => 'circle-o','url' => '#',],
																
																],
															],
															['label' => 'Competencias ciudadanas',
															'icon' => 'arrow-right',
															'url' => '#',
															'items' => [
																		['label' => 'Paz y cultura ciudadana', 'icon' => 'circle-o','url' => '#',],
																		['label' => 'Formación a formadores culturales', 'icon' => 'circle-o','url' => '#',],
																		['label' => 'Formación a formadores deportivos', 'icon' => 'circle-o','url' => '#',],
																],		
															],
															['label' => 'Arte y cultura', 'icon' => 'arrow-right','url' => ['arte-cultura/index'],],
															['label' => 'Formación deportiva', 'icon' => 'arrow-right','url' => '#',],
														],
													],
												['label' => 'Escuela + ciudad', 
												'icon' => 'university',
												'url' => '#',
												'items' => [
																	['label' => 'Sensibilización artistica', 'icon' => 'arrow-right','url' => ['sensibilizacion-artistica/index'],],
																	['label' => 'Competencias lúdicas', 'icon' => 'arrow-right','url' => '#',],
																	['label' => 'Primera infancia', 'icon' => 'arrow-right','url' => '#',],
															],
												],
					
					['label' => 'Poblaciones',
						'icon' => 'user-circle',
						'url' => '#',
						'items' => [
										[	'label' => 'Personas',
											'icon' => 'user-circle-o',
											'url' => '#',
											'items' => [
												['label' => 'Datos generales', 'icon' => 'circle-o', 'url' => ['personas/index'],],
												['label' => 'Formaciones', 'icon' => 'circle-o', 'url' => ['personas-formaciones/index'],],
												['label' => 'Discapacidades', 'icon' => 'circle-o', 'url' => ['personas-discapacidades/index'],],
												['label' => 'Escolaridades', 'icon' => 'circle-o', 'url' => ['personas-escolaridades/index'],],
												['label' => 'Reconocimientos', 'icon' => 'circle-o', 'url' => ['reconocimientos/index'],],
											],
										],
										['label' => 'Docentes', 
										'icon' => 'vcard-o',
										'url' => '#',
										 'items' => [
														['label' => 'Docentes', 'icon' => 'circle-o', 'url' => ['docentes/index'],],
														['label' => 'Docentes areas trabajo', 'icon' => 'circle-o', 'url' => ['docentes-x-areas-trabajos/index'],],
														['label' => 'Evaluación', 'icon' => 'circle-o', 'url' => ['evaluacion-docentes/index'],],
														['label' => 'Vinculación', 'icon' => 'circle-o', 'url' => ['vinculacion-docentes/index'],],
														['label' => 'Documentos Interés', 'icon' => 'circle-o', 'url' => ['documentos/index'],],
														
														
														
													],
										],
										['label' => 'Estudiantes',
										'icon' => 'male',
										'url' => '#',
										 'items' => [
														['label' => 'Estudiantes', 'icon' => 'circle-o', 'url' => ['representantes-legales/index'],],
														['label' => 'Hoja de vida', 'icon' => 'circle-o', 'url' => ['hoja-vida-estudiante/index'],],
													],
										
										],
										
									],
						
					],
					['label' => 'Indicadores',
						'icon' => 'line-chart',
						'url' => '#',
						'items' => [
										['label' => 'Clima Escolar', 'icon' => 'thermometer-0', 'url' => '#',],
										['label' => 'Sistema de Monitoreo', 'icon' => 'desktop', 'url' => '#',],
									],
					],
					['label' => 'Gestor Documental',
						'icon' => 'file-archive',
						'url' => 'http://200.29.107.196:8080/share/page',
						'template' => '<a href="{url}" target="_blank"  class="">{label}</a>',
					],
					],  //mcee
					['label' => 'Poblaciones',
						'icon' => 'user-circle',
						'url' => '#',
						'items' => [
										[
											'label' => 'Personas',
											'icon' => 'user-circle-o',
											'url' => '#',
											'items' => [
												['label' => 'Datos generales', 'icon' => 'circle-o', 'url' => ['personas/index'],],
												['label' => 'Formaciones', 'icon' => 'circle-o', 'url' => ['personas-formaciones/index'],],
												['label' => 'Discapacidades', 'icon' => 'circle-o', 'url' => ['personas-discapacidades/index'],],
												['label' => 'Escolaridades', 'icon' => 'circle-o', 'url' => ['personas-escolaridades/index'],],
												['label' => 'Reconocimientos', 'icon' => 'circle-o', 'url' => ['reconocimientos/index'],],
											],
										],
										['label' => 'Docentes', 
										'icon' => 'vcard-o',
										'url' => '#',
										 'items' => [
														['label' => 'Docentes', 'icon' => 'circle-o', 'url' => ['docentes/index'],],
														['label' => 'Docentes areas trabajo', 'icon' => 'circle-o', 'url' => ['docentes-x-areas-trabajos/index'],],
														['label' => 'Evaluación', 'icon' => 'circle-o', 'url' => ['evaluacion-docentes/index'],],
														['label' => 'Vinculación', 'icon' => 'circle-o', 'url' => ['vinculacion-docentes/index'],],
														['label' => 'Documentos Interés', 'icon' => 'circle-o', 'url' => ['documentos/index'],],
														
														
														
													],
										],
										// ['label' => 'Estudiantes',
										// 'icon' => 'male',
										// 'url' => '#',
										 // 'items' => [
														// ['label' => 'Estudiantes', 'icon' => 'circle-o', 'url' => ['representantes-legales/index'],],
														// ['label' => 'Hoja de vida', 'icon' => 'circle-o', 'url' => ['hoja-vida-estudiante/index'],],
													// ],
										
										// ],
										
									],
						
					],
					// ['label' => 'Indicadores',
						// 'icon' => 'line-chart',
						// 'url' => '#',
						// 'items' => [
										// ['label' => 'Clima Escolar', 'icon' => 'thermometer-0', 'url' => '#',],
										// ['label' => 'Sistema de Monitoreo', 'icon' => 'desktop', 'url' => '#',],
									// ],
					// ],
									
									
                ],
            ],
		]
        ) ?>

    </section>

</aside>
