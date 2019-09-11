<?php

use app\models\Permisos;
use yii\helpers\ArrayHelper;
?>
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

        <?php
		
		$perfil = $_SESSION['perfil'];
		
		$permiso = Permisos::find()->andWhere("id_perfiles = $perfil and estado = 1" )->orderby("id")->all();
		$permiso = ArrayHelper::map($permiso,'id_modulos','id_modulos');
			
			$numero= 17;
			echo  dmstr\widgets\Menu::widget(
            [
                'options' => ['id'=>'menuLeft','class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
					['label' => 'Inicio', 'url' => Yii::$app->homeUrl,'icon' => 'home',],
					//menu mcee
					[					
						'label' => 'Hoja de Vida',
						'icon' => 'building-o',
						'url' => '#',
						'options' => ['id'=>'idModulo' .  $numero++  .'','style' =>@$permiso[$numero]?"":"display:none"],
						'items' => 
						[
							
							[
								'label' => 'Información General',
								'icon' => 'folder',
								'url' => '#',
								'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
								'items' => 
								[
										
										['label' => 'Resumen IEO','icon' => 'circle-o', 'url' => ['instituciones/resumen'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Instituciones','icon' => 'circle-o','url' => ['instituciones/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										// ['label' => 'Documentos Institucionales','icon' => 'circle-o','url' => ['documentos-oficiales/index'],],
										// ['label' => 'Instancias','icon' => 'circle-o','url' => ['documentos-instancias-institucionales/index'],],
										['label' => 'Sedes','icon' => 'circle-o','url' => ['sedes/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Aulas','icon' => 'circle-o','url' => ['aulas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Jornadas','icon' => 'circle-o','url' => ['jornadas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Sedes - Jornadas','icon' => 'circle-o','url' => ['sedes-jornadas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Sedes - Niveles','icon' => 'circle-o','url' => ['sedes-niveles/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Periodos','icon' => 'circle-o','url' => ['periodos/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Asignaturas','icon' => 'circle-o','url' =>  ['asignaturas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Especialidades','icon' => 'circle-o','url' => ['sedes-areas-ensenanza/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Niveles','icon' => 'circle-o','url' => ['niveles/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Bloques por sede','icon' => 'circle-o','url' => ['sedes-bloques/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Grupos por nivel','icon' => 'circle-o','url' => ['paralelos/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Distribución académica', 'icon' => '', 'url' => ['distribuciones-academicas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Asignatura niveles', 'icon' => '', 'url' => ['asignaturas-niveles-sedes/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Director de grupo', 'icon' => '', 'url' => ['director-paralelo/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Carga Masiva', 'icon' => '', 'url' => ['poblar-tabla/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										
										['label' => 'Matricular Estudiante', 'icon' => 'circle-o', 'url' => ['estudiantes/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										
										['label' => 'Infraestructura Educativa','icon' => 'circle-o','url' => ['infraestructura-educativa/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Rangos calificación','icon' => 'circle-o','url' => ['rangos-calificacion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Ponderación resultados','icon' => 'circle-o','url' => ['ponderacion-resultados/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									
										['label' => 'Reportes-Estadisticas', 'icon' => '', 'url' =>  ['reportes/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Recursos', 
										'icon' => 'circle-o',
										'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
										'url' => '#',
										'items' => [
														 ['label' => 'Humanos', 'icon' => '', 'url' =>  ['perfiles-personas-institucion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														 ['label' => 'Infraestructra física', 'icon' => 'circle-o', 'url' => ['recursos-infraestructura-fisica/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														 ['label' => 'Infraestructra pedagógica', 'icon' => 'circle-o', 'url' => ['recurso-infraestructura-pedagogica/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														
													],
										
										],
										['label' => 'Cobertura', 'icon' => '', 'url' =>  ['cobertura/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Soporte Académico', 'icon' => '', 'url' =>  ['grupos-soporte/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										
										['label' => 'Docentes-Institución', 'icon' => '', 'url' =>  ['docente-institucion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Resultados', 
										'icon' => 'circle-o',
										'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
										'url' => '#',
										'items' => [
														['label' => 'Institución', 'icon' => '', 'url' =>  ['resultados-pruebas-saber-ie/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Cali', 'icon' => '', 'url' =>  ['resultados-pruebas-saber-cali/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'PMI', 'icon' => '', 'url' =>  ['pmi/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Sem', 'icon' => '', 'url' =>  ['resultados-sem/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Evaluación Docente', 'icon' => '', 'url' =>  ['resultados-evaluacion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Pruebas externas', 'icon' => '', 'url' =>  ['resultados-pruebas-externas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Resultados', 'icon' => '', 'url' =>  ['resultados/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														
													],
										
										],
										
								],//
							],
							[
								'label' => 'Gestión Directiva',
								'icon' => 'sitemap',
								'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
								'url' => '#',
								 'items' => [
									['label' => 'Documentos Institucionales','icon' => 'circle-o','url' => ['documentos-oficiales/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Instancias','icon' => 'circle-o','url' => ['documentos-instancias-institucionales/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Proyectos',
									'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
									'icon' => 'circle-o',
									'url' => '#',
										'items' => [
											['label' => 'Por institución', 'icon' => 'circle-o', 'url' => ['participacion-proyectos-i-e/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											['label' => 'Por maestro o directivo', 'icon' => 'circle-o', 'url' => ['participacion-proyectos-maestro/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											['label' => 'Proyectos jornada complementaria', 'icon' => 'circle-o', 'url' => ['participacion-proyectos-jornada/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											// ['label' => 'Proyectos-pedagagógicos', 'icon' => '', 'url' =>  ['proyectos-pedagogicos-transversales/index'],],
											],
									],
								],
							],
							[
								'label' => 'Gestión Académica',
								'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
								'icon' => 'mortar-board',
								'url' => '#',
								 'items' => [
									['label' => 'Curriculum de la IEO','icon' => 'circle-o','url' => ['documentos-curriculum-ieo/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Modelo Pegagógico','icon' => 'circle-o','url' => ['modelo-pedagogico/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Plan de estudios','icon' => 'circle-o','url' => ['plan-estudios/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Plan de área','icon' => 'circle-o','url' => ['plan-de-area/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Intensidad horaria','icon' => 'circle-o','url' => ['intensidad-horaria-semanal/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Prueba Evaluación','icon' => 'circle-o','url' => ['plan-evaluacion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Materiales Educativos','icon' => 'circle-o','url' => ['materiales-educativos/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Seguimiento Egresados','icon' => 'circle-o','url' => ['seguimiento-egresados/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										
										
								],//
							],
							[
								'label' => 'Gestión Administrativa',
								'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
								'icon' => 'institution',
								'url' => '#',
								'items' => [
									['label' => 'Matrícula', 'icon' => 'circle-o', 'url' => '#','options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Talento Humano',
									'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
									'icon' => 'circle-o',
									'url' => '#',
									'items' => [
											['label' => 'Evaluación', 'icon' => 'circle-o', 'url' => ['evaluacion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											['label' => 'Programas', 'icon' => 'circle-o', 'url' => ['programas/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											['label' => 'Estimulos', 'icon' => 'circle-o', 'url' => ['estimulos/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										],
									],
									['label' => 'Presupuesto', 'icon' => 'circle-o', 'url' => ['documentos-presupuesto/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Infraestructra', 'icon' => 'circle-o', 'url' => '#','options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Estrategia Adecuación', 'icon' => 'circle-o', 'url' => '#','options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Seguimiento', 'icon' => 'circle-o', 'url' => ['estrategia-embellecimiento-espacios/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
									['label' => 'Permisos módulos', 'icon' => 'circle-o', 'url' => ['permisos/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
								],
							],
							['label' => 'Gestión Comunitaria',
							'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
							'icon' => 'users',
							'url' => '#',
							'items' => [
								['label' => 'Documentos', 'icon' => 'circle-o', 'url' => ['documentos-gestion-comunitaria/index', 'tipo_documento'=>'Gestion Comunitaria'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
								['label' => 'Aliados', 'icon' => 'circle-o', 'url' => ['documentos-aliados/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										// ['label' => 'Comité Gestión Riesgo', 'icon' => 'circle-o', 'url' => '#'],
										// ['label' => 'PGIR', 'icon' => 'circle-o', 'url' => '#'],
										// ['label' => 'Aliados', 'icon' => 'circle-o', 'url' => '#'],
										['label' => 'Actividades Vinulación', 'icon' => 'circle-o', 'url' => ['documentos-actividades-vinculacion/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										['label' => 'Relaciones Sector', 'icon' => 'circle-o', 'url' => ['documentos-relaciones-sector/index'],'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										
										],
							],
						],// Hoja de vida
                                   
                    ],
					['label' => 'MCEE', 
									'icon' => 'book',
									'url' => '#',
									'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
									'items' => [
													
													['label' => 'Gestión Escolar', 
													'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
													'icon' => 'address-book', 
													'url' => '#',
													'items' => [
														['label' => 'Acompañamiento in Situ', 
														'icon' => 'arrow-right', 
														'url' => ['acompanamiento-in-situ/index'],
														'options' => ['id'=>'idModulo' . ( $numero++ ) .'','style' =>@$permiso[$numero]?"":"display:none"],
														],
														[
														'label' => 'Formación en liderazgo', 
														'icon' => 'arrow-right', 
														'url' => ['ge-seguimiento-gestion/','idTipoSeguimiento'=> 4],
														'options' => ['id'=>'idModulo' . ( $numero+=4 ) .'','style' =>@$permiso[$numero]?"":"display:none"],
														],  //se agrega el index
														['label' => 'Comunicación para la gestión', 'icon' => 'arrow-right','url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],], //se agrega el index
														['label' => 'Clima escolar y convivencia',
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
														'icon' => 'arrow-right', 
														'url' => '#',
															'items' => [
																['label' => 'Clima escolar', 'icon' => 'circle-o','url' => ['clima-escolar/index'],'options' => ['id'=>'idModulo' . ( $numero+=1 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																['label' => 'Medición', 'icon' => 'circle-o','url' => '#','options' => ['id'=>'idModulo' . ( $numero+=3 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																['label' => 'Caja de herramientas', 'icon' => 'circle-o','url' => '#','options' => ['id'=>'idModulo' . ( $numero+=1 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
															],
														],
														['label' => 'Proyectos pedagogicos productivos', 'icon' => 'arrow-right', 'url' => ['ppp-seguimiento-operador/index', 'idTipoSeguimiento'	=> 5],'options' => ['id'=>'idModulo' . ( $numero+=2 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],

														],
													],
													['label' => 'Mejoramiento Aprendizajes',
													'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],													
													'icon' => 'american-sign-language-interpreting', 
													'url' => '#',
													'items' => [
														['label' => 'Gestión Curricular',
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
														'icon' => 'arrow-right',
														'url' => '#',
														'items' => [
															['label' => 'Ciclos', 'icon' => 'arrow-right', 'url' => ['gc-ciclos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
															['label' => 'Bitácora', 'icon' => 'arrow-right', 'url' => ['gc-bitacora/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
															['label' => 'Acompañamiento docentes tutores',
															'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
															'icon' => 'circle-o',
															'url' => '#',
															'items' => [
																	['label' => 'Bitácora Visitas', 'icon' => 'circle-o', 'url' => ['gestion-curricular-bitacoras-visitas-ieo/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' => 'Evaluación docente tutor', 'icon' => 'circle-o', 'url' => ['dimension-opciones-seguimiento-docente/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' =>' Autoevaluación docente tutor', 'icon' => 'circle-o', 'url' => ['dimension-opciones-autoevaluacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' => 'Instrumento seguimiento', 'icon' => 'circle-o', 'url' => ['dimension-opciones-instrumento-seguimiento/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' => 'Seguimiento Directivos', 'icon' => 'circle-o', 'url' => ['dimension-opciones-seguimiento-directivos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' => 'Acompañamiento Docente', 'icon' => 'circle-o', 'url' => ['gestion-curricular-docente-tutor-acompanamiento/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														
																],	
															],
															['label' => 'Formación tutores','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"], 'icon' => 'circle-o', 'url' => '#',],
															['label' => 'Acuerdos curriculares','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"], 'icon' => 'circle-o', 'url' => '#',],
															
														],
													],
														['label' => 'Semilleros TIC',
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
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
													'options' => ['id'=>'idModulo' . ( $numero+=15 ) .'','style' =>@$permiso[$numero]?"":"display:none"],
													'icon' => 'edit', 
													'url' => '#',
													'items' => [
													
															['label' => 'Competencias básicas',
															'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
															'icon' => 'arrow-right', 
															'url' => '#',
															'items' => [
																['label' => 'Articulación Familiar', 'icon' => 'circle-o','url' => ['ec-competencias-basicas-proyectos-articulacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																['label' => 'Proyecto de Servicio Social Estudiantil', 'icon' => 'circle-o','url' => ['ec-competencias-basicas-proyectos-obligatorio/index'],'options' => ['id'=>'idModulo' . ( $numero+=13 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																['label' => 'Proyectos pedagógicos transversales',
																'options' => ['id'=>'idModulo' . ( $numero+=13 ) .'','style' =>@$permiso[$numero]?"":"display:none"],
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
																['label' => 'Competencias transversalidad', 'icon' => 'circle-o','url' => ['ec-competencias-basicas-transversalidad/index'],'options' => ['id'=>'idModulo' . ( $numero+=13 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																['label' => 'Estrategia de financiamiento', 'icon' => 'circle-o','url' => '#','options' => ['id'=>'idModulo' . ( $numero+=3 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																
																],
															],
															['label' => 'Competencias ciudadanas',
															'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
															'icon' => 'arrow-right',
															'url' => '#',
															'items' => [
																		['label' => 'Paz y cultura ciudadana', 'icon' => 'circle-o','url' => 'index.php?r=paz-cultural%2Findex','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																		['label' => 'Formación a formadores culturales', 'icon' => 'circle-o','url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																		['label' => 'Formación a formadores deportivos', 'icon' => 'circle-o','url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																],		
															],
															['label' => 'Arte y cultura', 'icon' => 'arrow-right','url' => ['arte-cultura/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
															['label' => 'Formación deportiva', 'icon' => 'arrow-right','url' => '#','options' => ['id'=>'idModulo' . ( $numero+=9 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														],
													],
												['label' => 'Escuela + ciudad',
												'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
												'icon' => 'university',
												'url' => '#',
												'items' => [
																	['label' => 'Sensibilización artistica', 'icon' => 'arrow-right','url' => ['sensibilizacion-artistica/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' => 'Competencias lúdicas', 'icon' => 'arrow-right','url' => '#','options' => ['id'=>'idModulo' . ( $numero+=9 ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
																	['label' => 'Primera infancia', 'icon' => 'arrow-right','url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
															],
												],
					
					['label' => 'Poblaciones',
					'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
						'icon' => 'user-circle',
						'url' => '#',
						'items' => [
										[	'label' => 'Personas',
											'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
											'icon' => 'user-circle-o',
											'url' => '#',
											'items' => [
												['label' => 'Datos generales', 'icon' => 'circle-o', 'url' => ['personas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Formaciones', 'icon' => 'circle-o', 'url' => ['personas-formaciones/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Discapacidades', 'icon' => 'circle-o', 'url' => ['personas-discapacidades/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Escolaridades', 'icon' => 'circle-o', 'url' => ['personas-escolaridades/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Reconocimientos', 'icon' => 'circle-o', 'url' => ['reconocimientos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											],
										],
										['label' => 'Docentes',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
										'icon' => 'vcard-o',
										'url' => '#',
										 'items' => [
														['label' => 'Docentes', 'icon' => 'circle-o', 'url' => ['docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Docentes areas trabajo', 'icon' => 'circle-o', 'url' => ['docentes-x-areas-trabajos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Evaluación', 'icon' => 'circle-o', 'url' => ['evaluacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Vinculación', 'icon' => 'circle-o', 'url' => ['vinculacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Documentos Interés', 'icon' => 'circle-o', 'url' => ['documentos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														
														
														
													],
										],
										['label' => 'Estudiantes',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
										'icon' => 'male',
										'url' => '#',
										 'items' => [
														['label' => 'Estudiantes', 'icon' => 'circle-o', 'url' => ['representantes-legales/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Hoja de vida', 'icon' => 'circle-o', 'url' => ['hoja-vida-estudiante/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
													],
										
										],
										
									],
						
						],
						['label' => 'Indicadores',
						'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
							'icon' => 'line-chart',
							'url' => '#',
							'items' => [
											['label' => 'Clima Escolar', 'icon' => 'thermometer-0', 'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											['label' => 'Sistema de Monitoreo', 'icon' => 'desktop', 'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
										],
						],
						['label' => 'Gestor Documental',
							'icon' => 'file-archive',
							'options' => ["id"=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
							'url' => 'http://200.29.107.196:8080/share/page',
							
							'template' => '<a href="{url}" target="_blank"  class="">{label}</a>',
						],
					],  //mcee
					['label' => 'Poblaciones',
						'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
						'icon' => 'user-circle',
						'url' => '#',
						'items' => [
										[
											'label' => 'Personas',
											'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
											'icon' => 'user-circle-o',
											'url' => '#',
											'items' => [
												['label' => 'Datos generales', 'icon' => 'circle-o', 'url' => ['personas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Formaciones', 'icon' => 'circle-o', 'url' => ['personas-formaciones/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Discapacidades', 'icon' => 'circle-o', 'url' => ['personas-discapacidades/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Escolaridades', 'icon' => 'circle-o', 'url' => ['personas-escolaridades/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
												['label' => 'Reconocimientos', 'icon' => 'circle-o', 'url' => ['reconocimientos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
											],
										],
										['label' => 'Docentes',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],
										'icon' => 'vcard-o',
										'url' => '#',
										 'items' => [
														['label' => 'Docentes', 'icon' => 'circle-o', 'url' => ['docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Docentes areas trabajo', 'icon' => 'circle-o', 'url' => ['docentes-x-areas-trabajos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Evaluación', 'icon' => 'circle-o', 'url' => ['evaluacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
														['label' => 'Vinculación', 'icon' => 'circle-o', 'url' => ['vinculacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'','style' =>@$permiso[$numero]?"":"display:none"],],
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
        ) ;
		
			
			
		
		?>

    </section>

</aside>

