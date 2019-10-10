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
		
			$numero = 16;
			echo  dmstr\widgets\Menu::widget(
            [
                'options' => ['id'=>'menuLeft','class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
					['label' => 'Inicio', 'url' => Yii::$app->homeUrl,'icon' => 'home',],
					//menu mcee
					[
						'label' => 'Hoja de Vida',
						'icon' => 'building-o',
						'visible' =>@$permiso[17]? true : false,
						'url' => '#',
						'options' => ['id'=>'idModulo' .  ++$numero  .'',],
						'items' =>
						[

							[
								'label' => 'Información General',
								'icon' => 'folder',
								'visible' =>@$permiso[18]? true : false,
								'url' => '#',
								'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
								'items' =>
								[

										['label' => 'Resumen IEO','icon' => 'circle-o', 'visible' =>@$permiso[19]? true : false,'url' => ['instituciones/resumen'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Instituciones','icon' => 'circle-o','visible' =>@$permiso[20]? true : false,'url' => ['instituciones/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										// ['label' => 'Documentos Institucionales','icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['documentos-oficiales/index'],],
										// ['label' => 'Instancias','icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['documentos-instancias-institucionales/index'],],
										['label' => 'Sedes','icon' => 'circle-o','visible' =>@$permiso[21]? true : false,'url' => ['sedes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Aulas','icon' => 'circle-o','visible' =>@$permiso[22]? true : false,'url' => ['aulas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Jornadas','icon' => 'circle-o','visible' =>@$permiso[23]? true : false,'url' => ['jornadas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Sedes - Jornadas','icon' => 'circle-o','visible' =>@$permiso[24]? true : false,'url' => ['sedes-jornadas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Sedes - Niveles','icon' => 'circle-o','visible' =>@$permiso[25]? true : false,'url' => ['sedes-niveles/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Periodos','icon' => 'circle-o','visible' =>@$permiso[26]? true : false,'url' => ['periodos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Asignaturas','icon' => 'circle-o','visible' =>@$permiso[27]? true : false,'url' =>  ['asignaturas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Especialidades','icon' => 'circle-o','visible' =>@$permiso[28]? true : false,'url' => ['sedes-areas-ensenanza/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Niveles','icon' => 'circle-o','visible' =>@$permiso[29]? true : false,'url' => ['niveles/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Bloques por sede','icon' => 'circle-o','visible' =>@$permiso[30]? true : false,'url' => ['sedes-bloques/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Grupos por nivel','icon' => 'circle-o','visible' =>@$permiso[31]? true : false,'url' => ['paralelos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Distribución académica', 'icon' => '', 'visible' =>@$permiso[32]? true : false,'url' => ['distribuciones-academicas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Asignatura niveles', 'icon' => '', 'visible' =>@$permiso[33]? true : false,'url' => ['asignaturas-niveles-sedes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Director de grupo', 'icon' => '', 'visible' =>@$permiso[34]? true : false,'url' => ['director-paralelo/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Carga Masiva', 'icon' => '', 'visible' =>@$permiso[35]? true : false,'url' => ['poblar-tabla/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

										['label' => 'Matricular Estudiante', 'icon' => 'circle-o', 'visible' =>@$permiso[36]? true : false,'url' => ['estudiantes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

										['label' => 'Infraestructura Educativa','icon' => 'circle-o','visible' =>@$permiso[37]? true : false,'url' => ['infraestructura-educativa/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Rangos calificación','icon' => 'circle-o','visible' =>@$permiso[38]? true : false,'url' => ['rangos-calificacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Ponderación resultados','icon' => 'circle-o','visible' =>@$permiso[39]? true : false,'url' => ['ponderacion-resultados/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

										['label' => 'Reportes-Estadisticas', 'icon' => '', 'visible' =>@$permiso[40]? true : false,'url' =>  ['reportes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Recursos',
										'icon' => 'circle-o',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
										'visible' =>@$permiso[41]? true : false,'url' => '#',
										'items' => [
														 ['label' => 'Humanos', 'icon' => '', 'visible' =>@$permiso[42]? true : false,'url' =>  ['perfiles-personas-institucion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														 ['label' => 'Infraestructra física', 'icon' => 'circle-o', 'visible' =>@$permiso[43]? true : false,'url' => ['recursos-infraestructura-fisica/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														 ['label' => 'Infraestructra pedagógica', 'icon' => 'circle-o', 'visible' =>@$permiso[44]? true : false,'url' => ['recurso-infraestructura-pedagogica/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

													],

										],
										['label' => 'Cobertura', 'icon' => '', 'visible' =>@$permiso[45]? true : false,'url' =>  ['cobertura/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Soporte Académico', 'icon' => '', 'visible' =>@$permiso[46]? true : false,'url' =>  ['grupos-soporte/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

										['label' => 'Docentes-Institución', 'icon' => '', 'visible' =>@$permiso[47]? true : false,'url' =>  ['docente-institucion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Resultados',
										'icon' => 'circle-o',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
										'visible' =>@$permiso[48]? true : false,
										'url' => '#',
										'items' => [
														['label' => 'Institución', 'icon' => '', 'visible' =>@$permiso[49]? true : false,'url' =>  ['resultados-pruebas-saber-ie/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Cali', 'icon' => '', 'visible' =>@$permiso[50]? true : false,'url' =>  ['resultados-pruebas-saber-cali/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'PMI', 'icon' => '', 'visible' =>@$permiso[51]? true : false,'url' =>  ['pmi/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Sem', 'icon' => '', 'visible' =>@$permiso[52]? true : false,'url' =>  ['resultados-sem/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Evaluación Docente', 'icon' => '', 'visible' =>@$permiso[53]? true : false,'url' =>  ['resultados-evaluacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Pruebas externas', 'icon' => '', 'visible' =>@$permiso[54]? true : false,'url' =>  ['resultados-pruebas-externas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Resultados', 'icon' => '', 'visible' =>@$permiso[55]? true : false,'url' =>  ['resultados/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

													],

										],

								],//
							],
							[
								'label' => 'Gestión Directiva',
								'icon' => 'sitemap',
								'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
								'visible' =>@$permiso[56]? true : false,'url' => '#',
								 'items' => [
									['label' => 'Documentos Institucionales','icon' => 'circle-o','visible' =>@$permiso[57]? true : false,'url' => ['documentos-oficiales/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Instancias','icon' => 'circle-o','visible' =>@$permiso[58]? true : false,'url' => ['documentos-instancias-institucionales/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Proyectos',
									'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
									'icon' => 'circle-o',
									'visible' =>@$permiso[59]? true : false,'url' => '#',
										'items' => [
											['label' => 'Por institución', 'icon' => 'circle-o', 'visible' =>@$permiso[60]? true : false,'url' => ['participacion-proyectos-i-e/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											['label' => 'Por maestro o directivo', 'icon' => 'circle-o', 'visible' =>@$permiso[61]? true : false,'url' => ['participacion-proyectos-maestro/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											['label' => 'Proyectos jornada complementaria', 'icon' => 'circle-o', 'visible' =>@$permiso[62]? true : false,'url' => ['participacion-proyectos-jornada/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											// ['label' => 'Proyectos-pedagagógicos', 'icon' => '', 'visible' =>@$permiso[numero]? true : false,'url' =>  ['proyectos-pedagogicos-transversales/index'],],
											],
									],
								],
							],
							[
								'label' => 'Gestión Académica',
								'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
								'icon' => 'mortar-board',
								'visible' =>@$permiso[63]? true : false,'url' => '#',
								 'items' => [
									['label' => 'Curriculum de la IEO','icon' => 'circle-o','visible' =>@$permiso[64]? true : false,'url' => ['documentos-curriculum-ieo/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Modelo Pegagógico','icon' => 'circle-o','visible' =>@$permiso[65]? true : false,'url' => ['modelo-pedagogico/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Plan de estudios','icon' => 'circle-o','visible' =>@$permiso[66]? true : false,'url' => ['plan-estudios/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Plan de área','icon' => 'circle-o','visible' =>@$permiso[67]? true : false,'url' => ['plan-de-area/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Intensidad horaria','icon' => 'circle-o','visible' =>@$permiso[68]? true : false,'url' => ['intensidad-horaria-semanal/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Prueba Evaluación','icon' => 'circle-o','visible' =>@$permiso[69]? true : false,'url' => ['plan-evaluacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Materiales Educativos','icon' => 'circle-o','visible' =>@$permiso[70]? true : false,'url' => ['materiales-educativos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Seguimiento Egresados','icon' => 'circle-o','visible' =>@$permiso[71]? true : false,'url' => ['seguimiento-egresados/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],


								],//
							],
							[
								'label' => 'Gestión Administrativa',
								'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
								'icon' => 'institution',
								'visible' =>@$permiso[72]? true : false,'url' => '#',
								'items' => [
									['label' => 'Matrícula', 'icon' => 'circle-o', 'visible' =>@$permiso[73]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Talento Humano',
									'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
									'icon' => 'circle-o',
									'visible' =>@$permiso[74]? true : false,
									'url' => '#',
									'items' => [
											['label' => 'Evaluación', 'icon' => 'circle-o', 'visible' =>@$permiso[75]? true : false,'url' => ['evaluacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											['label' => 'Programas', 'icon' => 'circle-o', 'visible' =>@$permiso[76]? true : false,'url' => ['programas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											['label' => 'Estimulos', 'icon' => 'circle-o', 'visible' =>@$permiso[77]? true : false,'url' => ['estimulos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										],
									],
									['label' => 'Presupuesto', 'icon' => 'circle-o', 'visible' =>@$permiso[78]? true : false,'url' => ['documentos-presupuesto/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Infraestructra', 'icon' => 'circle-o', 'visible' =>@$permiso[79]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Estrategia Adecuación', 'icon' => 'circle-o', 'visible' =>@$permiso[80]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Seguimiento', 'icon' => 'circle-o', 'visible' =>@$permiso[81]? true : false,'url' => ['estrategia-embellecimiento-espacios/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
									['label' => 'Permisos módulos', 'icon' => 'circle-o', 'visible' =>@$permiso[82]? true : false,'url' => ['permisos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
								],
							],
							['label' => 'Gestión Comunitaria',
							'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
							'icon' => 'users',
							'visible' =>@$permiso[83]? true : false,'url' => '#',
							'items' => [
								['label' => 'Documentos', 'icon' => 'circle-o', 'visible' =>@$permiso[84]? true : false,'url' => ['documentos-gestion-comunitaria/index', 'tipo_documento'=>'Gestion Comunitaria'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
								['label' => 'Aliados', 'icon' => 'circle-o', 'visible' =>@$permiso[85]? true : false,'url' => ['documentos-aliados/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										// ['label' => 'Comité Gestión Riesgo', 'icon' => 'circle-o', 'visible' =>@$permiso[numero]? true : false,'url' => '#'],
										// ['label' => 'PGIR', 'icon' => 'circle-o', 'visible' =>@$permiso[numero]? true : false,'url' => '#'],
										// ['label' => 'Aliados', 'icon' => 'circle-o', 'visible' =>@$permiso[numero]? true : false,'url' => '#'],
										['label' => 'Actividades Vinulación', 'icon' => 'circle-o', 'visible' =>@$permiso[86]? true : false,'url' => ['documentos-actividades-vinculacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										['label' => 'Relaciones Sector', 'icon' => 'circle-o', 'visible' =>@$permiso[87]? true : false,'url' => ['documentos-relaciones-sector/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],

										],
							],
						],// Hoja de vida
                                   
                    ],
					['label' => 'MCEE', 
									'icon' => 'book',
									'visible' =>@$permiso[88]? true : false,'url' => '#',
									'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
									'items' => [
													
													['label' => 'Gestión Escolar', 
													'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
													'icon' => 'address-book',
													'visible' =>@$permiso[89]? true : false,'url' => '#',
													'items' => [
														['label' => 'Acompañamiento in Situ', 
														'icon' => 'arrow-right', 
														'visible' =>@$permiso[90]? true : false,'url' => ['acompanamiento-in-situ/index'],
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
														],
														[
														'label' => 'Formación en liderazgo',
														'icon' => 'arrow-right',
														'visible' =>@$permiso[95]? true : false,'url' => ['ge-seguimiento-gestion/','idTipoSeguimiento'=> 4],
														'options' => ['id'=>'idModulo' . ( $numero+=4 ) .'',],
														],  //se agrega el index
														['label' => 'Comunicación para la gestión', 'icon' => 'arrow-right','visible' =>@$permiso[96]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],], //se agrega el index
														['label' => 'Clima escolar y convivencia',
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
														'icon' => 'arrow-right', 
														'visible' =>@$permiso[97]? true : false,'url' => '#',
															'items' => [
																['label' => 'Clima escolar', 'icon' => 'circle-o','visible' =>@$permiso[98]? true : false,'url' => ['clima-escolar/index'],'options' => ['id'=>'idModulo' . ( $numero+=1 ) .'',],],
																['label' => 'Medición', 'icon' => 'circle-o','visible' =>@$permiso[101]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( $numero+=3 ) .'',],],
																['label' => 'Caja de herramientas', 'icon' => 'circle-o','visible' =>@$permiso[102]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( $numero+=1 ) .'',],],
															],
														],
														['label' => 'Proyectos pedagogicos productivos', 'icon' => 'arrow-right', 'visible' =>@$permiso[104]? true : false,'url' => ['ppp-seguimiento-operador/index', 'idTipoSeguimiento'	=> 5],'options' => ['id'=>'idModulo' . ( $numero+=2 ) .'',],],

														],
													],
													['label' => 'Mejoramiento Aprendizajes',
													'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
													'icon' => 'american-sign-language-interpreting', 
													'visible' =>@$permiso[105]? true : false,'url' => '#',
													'items' => [
														['label' => 'Gestión Curricular',
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
														'icon' => 'arrow-right',
														'visible' =>@$permiso[106]? true : false,'url' => '#',
														'items' => [
															['label' => 'Ciclos', 'icon' => 'arrow-right', 'visible' =>@$permiso[107]? true : false,'url' => ['gc-ciclos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
															['label' => 'Bitácora', 'icon' => 'arrow-right', 'visible' =>@$permiso[108]? true : false,'url' => ['gc-bitacora/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
															['label' => 'Acompañamiento docentes tutores',
															'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
															'icon' => 'circle-o',
															'visible' =>@$permiso[109]? true : false,'url' => '#',
															'items' => [
																	['label' => 'Bitácora Visitas', 'icon' => 'circle-o', 'visible' =>@$permiso[110]? true : false,'url' => ['gestion-curricular-bitacoras-visitas-ieo/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																	['label' => 'Evaluación docente tutor', 'icon' => 'circle-o', 'visible' =>@$permiso[111]? true : false,'url' => ['dimension-opciones-seguimiento-docente/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																	['label' =>' Autoevaluación docente tutor', 'icon' => 'circle-o', 'visible' =>@$permiso[112]? true : false,'url' => ['dimension-opciones-autoevaluacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																	['label' => 'Instrumento seguimiento', 'icon' => 'circle-o', 'visible' =>@$permiso[113]? true : false,'url' => ['dimension-opciones-instrumento-seguimiento/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																	['label' => 'Seguimiento Directivos', 'icon' => 'circle-o', 'visible' =>@$permiso[114]? true : false,'url' => ['dimension-opciones-seguimiento-directivos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																	['label' => 'Acompañamiento Docente', 'icon' => 'circle-o', 'visible' =>@$permiso[115]? true : false,'url' => ['gestion-curricular-docente-tutor-acompanamiento/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														
																],	
															],
															['label' => 'Formación tutores','options' => ['id'=>'idModulo' . ( ++$numero ) .'',], 'icon' => 'circle-o', 'visible' =>@$permiso[116]? true : false,'url' => '#',],
															['label' => 'Acuerdos curriculares','options' => ['id'=>'idModulo' . ( ++$numero ) .'',], 'icon' => 'circle-o', 'visible' =>@$permiso[117]? true : false,'url' => '#',],
															
														],
													],
														['label' => 'Semilleros TIC',
														'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
														'icon' => 'arrow-right', 
														'visible' =>@$permiso[118]? true : false,'url' => ['semilleros/index'],
														// 'items' => [
																// ['label' => 'Docentes', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['semilleros-datos-ieo/create'],], 
																// ['label' => 'Ejecución fase I', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['ejecucion-fase-i/create'],],  
																// ['label' => 'Ejecución fase II', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['ejecucion-fase-ii/create'],],  
																// ['label' => 'Ejecución fase III', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['ejecucion-fase-iii/create'],],  
																// ['label' => 'Diario de campo', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['semilleros-tic-diario-de-campo/index'],],
																// ['label' => 'Resumen operativo', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['resumen-operativo-fases-docentes/index'],],
																// ['label' => 'Estudiantes', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['semilleros-datos-ieo-estudiantes/create'],], 
																// ['label' => 'Ejecución fase I', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['ejecucion-fase-i-estudiantes/create'],],
																// ['label' => 'Ejecución fase II', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['ejecucion-fase-ii-estudiantes/create'],],
																// ['label' => 'Ejecución fase III', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['ejecucion-fase-iii-estudiantes/create'],],
																// ['label' => 'Diario de campo', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['semilleros-tic-diario-de-campo-estudiantes/index'],],
																// ['label' => 'Resumen operativo', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['resumen-operativo-fases-estudiantes/index'],],
																// ['label' => 'Población', 'icon' => 'long-arrow-right', 'visible' =>@$permiso[numero]? true : false,'url' => ['instrumento-poblacion-estudiantes/create'],],
														
																// ],
															],
														
														],
													],
													['label' => 'Pedagogías para la Vida', 
													'options' => ['id'=>'idModulo' . ( $numero+=15 ) .'',],
													'icon' => 'edit',
													'visible' =>@$permiso[133]? true : false,'url' => '#',
													'items' => [
													
															['label' => 'Competencias básicas',
															'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
															'icon' => 'arrow-right', 
															'visible' =>@$permiso[134]? true : false,'url' => '#',
															'items' => [
																['label' => 'Articulación Familiar', 'icon' => 'circle-o','visible' =>@$permiso[134]? true : false,'url' => ['ec-competencias-basicas-proyectos-articulacion/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																['label' => 'Proyecto de Servicio Social Estudiantil', 'icon' => 'circle-o','visible' =>@$permiso[148]? true : false,'url' => ['ec-competencias-basicas-proyectos-obligatorio/index'],'options' => ['id'=>'idModulo' . ( $numero+=13 ) .'',],],
																['label' => 'Proyectos pedagógicos transversales',
																'options' => ['id'=>'idModulo' . ( $numero+=13 ) .'',],
																'icon' => 'circle-o',
																'visible' =>@$permiso[161]? true : false,'url' => ['ec-competencias-basicas-proyectos/index'],
																// 'items' => [
																		// ['label' => 'Planeación', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-datos-basicos/create'],],
																		// ['label' => 'Levantamiento', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-levantamiento-orientacion/index'],],
																		// ['label' => 'Informe avance mensual Ejecución', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ieo/index'],],
																		// ['label' => 'Informe avance mensual Misional', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ecinformeplaneacionieo/index'],],
																		// ['label' => 'Informe semanal ejecución', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['informe-semanal-ejecucion-ise/index'],],
																		// ['label' => 'Informe semanal total ejecutivo', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-informe-semanal-total-ejecutivo/index'],],
																		// ['label' => 'Articulación Familiar', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => '#',],
																		// ['label' => 'ASSC', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => '#',],
																		// ['label' => 'Semilleros para Paz', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => '#',],
																		// ['label' => 'Vinculo C+E', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => '#',],
																		// ['label' => 'Competencias Lúdicas', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => '#',],
																		// // ['label' => 'Avance Misional X IEO PPT', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-avance-misional-ppt/index'],],
																		// // ['label' => 'Avance Misional X IEO SS', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-avance-misional-ss/index'],],
																		// // ['label' => 'Avance Misional X IEO AF', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-avance-misional/index'],],
																		// // ['label' => 'Avance Misional X EJE PPT', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-avance-misional-ppt/index'],],
																		// // ['label' => 'Avance Misional X PROYECTO', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => ['ec-avance-misional-proyecto/index'],],
																		// ['label' => 'Informe semanal ejecución - ciere fase total ejecutivo', 'icon' => 'circle-o','visible' =>@$permiso[numero]? true : false,'url' => '#'],
																
																	// ],
																],
																['label' => 'Competencias transversalidad', 'icon' => 'circle-o','visible' =>@$permiso[174]? true : false,'url' => ['ec-competencias-basicas-transversalidad/index'],'options' => ['id'=>'idModulo' . ( $numero+=13 ) .'',],],
																['label' => 'Estrategia de financiamiento', 'icon' => 'circle-o','visible' =>@$permiso[177]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( $numero+=3 ) .'',],],
																
																],
															],
															['label' => 'Competencias ciudadanas',
															'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
															'icon' => 'arrow-right',
															'visible' =>@$permiso[178]? true : false,'url' => '#',
															'items' => [
                                                                    ['label' => 'Paz y cultura ciudadana', 'icon' => 'circle-o','visible' =>@$permiso[179]? true : false,'url' => 'index.php?r=paz-cultural%2Findex'],
                                                                    ['label' => 'Consolidación mensual de articulación', 'icon' => 'circle-o','visible' =>@$permiso[224]? true : false,'url' => ['pcc-tb-consolidacion-articulacion/index']],
                                                                    ['label' => 'Ver eventos programados', 'icon' => 'circle-o','visible' =>@$permiso[225]? true : false,'url' => ['pcc-tb-calendario/index']],
                                                                    ['label' => 'Formación a formadores culturales', 'icon' => 'circle-o','visible' =>@$permiso[180]? true : false,'url' => '#',],
                                                                    ['label' => 'Formación a formadores deportivos', 'icon' => 'circle-o','visible' =>@$permiso[181]? true : false,'url' => '#',],
																],		
															],
															['label' => 'Arte y cultura', 'icon' => 'arrow-right','visible' =>@$permiso[182]? true : false,'url' => ['arte-cultura/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
															['label' => 'Formación deportiva', 'icon' => 'arrow-right','visible' =>@$permiso[191]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( $numero+=9 ) .'',],],
														],
													],
												['label' => 'Escuela + ciudad',
												'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
												'icon' => 'university',
												'visible' =>@$permiso[192]? true : false,'url' => '#',
												'items' => [
																	['label' => 'Sensibilización artistica', 'icon' => 'arrow-right','visible' =>@$permiso[193]? true : false,'url' => ['sensibilizacion-artistica/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
																	['label' => 'Competencias lúdicas', 'icon' => 'arrow-right','visible' =>@$permiso[202]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( $numero+=9 ) .'',],],
																	['label' => 'Primera infancia', 'icon' => 'arrow-right','visible' =>@$permiso[203]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
															],
												],
					
					['label' => 'Poblaciones',
					'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
						'icon' => 'user-circle',
						'visible' =>@$permiso[204]? true : false,'url' => '#',
						'items' => [
										[	'label' => 'Personas',
											'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
											'icon' => 'user-circle-o',
											'visible' =>@$permiso[205]? true : false,'url' => '#',
											'items' => [
												['label' => 'Datos generales', 'icon' => 'circle-o', 'visible' =>@$permiso[206]? true : false,'url' => ['personas/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
												['label' => 'Formaciones', 'icon' => 'circle-o', 'visible' =>@$permiso[207]? true : false,'url' => ['personas-formaciones/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
												['label' => 'Discapacidades', 'icon' => 'circle-o', 'visible' =>@$permiso[208]? true : false,'url' => ['personas-discapacidades/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
												['label' => 'Escolaridades', 'icon' => 'circle-o', 'visible' =>@$permiso[209]? true : false,'url' => ['personas-escolaridades/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
												['label' => 'Reconocimientos', 'icon' => 'circle-o', 'visible' =>@$permiso[210]? true : false,'url' => ['reconocimientos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											],
										],
										['label' => 'Docentes',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
										'icon' => 'vcard-o',
										'visible' =>@$permiso[211]? true : false,'url' => '#',
										 'items' => [
														['label' => 'Docentes', 'icon' => 'circle-o', 'visible' =>@$permiso[212]? true : false,'url' => ['docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Docentes areas trabajo', 'icon' => 'circle-o', 'visible' =>@$permiso[213]? true : false,'url' => ['docentes-x-areas-trabajos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Evaluación', 'icon' => 'circle-o', 'visible' =>@$permiso[214]? true : false,'url' => ['evaluacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Vinculación', 'icon' => 'circle-o', 'visible' =>@$permiso[215]? true : false,'url' => ['vinculacion-docentes/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Documentos Interés', 'icon' => 'circle-o', 'visible' =>@$permiso[216]? true : false,'url' => ['documentos/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														
														
														
													],
										],
										['label' => 'Estudiantes',
										'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
										'icon' => 'male',
										'visible' =>@$permiso[217]? true : false,'url' => '#',
										 'items' => [
														['label' => 'Estudiantes', 'icon' => 'circle-o', 'visible' =>@$permiso[218]? true : false,'url' => ['representantes-legales/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
														['label' => 'Hoja de vida', 'icon' => 'circle-o', 'visible' =>@$permiso[219]? true : false,'url' => ['hoja-vida-estudiante/index'],'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
													],
										
										],
										
									],
						
						],
						['label' => 'Indicadores',
						'options' => ['id'=>'idModulo' . ( ++$numero ) .'',],
							'icon' => 'line-chart',
							'visible' =>@$permiso[220]? true : false,'url' => '#',
							'items' => [
											['label' => 'Clima Escolar', 'icon' => 'thermometer-0', 'visible' =>@$permiso[221]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
											['label' => 'Sistema de Monitoreo', 'icon' => 'desktop', 'visible' =>@$permiso[222]? true : false,'url' => '#','options' => ['id'=>'idModulo' . ( ++$numero ) .'',],],
										],
						],
						['label' => 'Gestor Documental',
							'icon' => 'file-archive',
							'options' => ["id"=>'idModulo' . ( ++$numero ) .'',],
							'visible' =>@$permiso[223]? true : false,'url' => 'http://200.29.107.196:8080/share/page',

							'template' => '<a href="{url}" target="_blank"  class="">{label}</a>',
						],
					],  //mcee				
                ],
            ],
		]
        ) ;




		?>

    </section>

</aside>

