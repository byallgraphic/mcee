<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rom.actividades_rom".
 *
 * @property int $id
 * @property int $id_rom_actividad
 * @property string $fehca_desde
 * @property string $fecha_hasta
 * @property string $estado
 * @property string $num_equipos
 * @property string $perfiles
 * @property string $docente_orientador
 * @property string $nombre_actividad
 * @property string $duracion_sesion
 * @property string $logros
 * @property string $fortalezas
 * @property string $debilidades
 * @property string $alternativas
 * @property string $retos
 * @property string $articulacion
 * @property string $evaluacion
 * @property string $observaciones_generales
 * @property string $alarmas
 * @property string $justificacion_activiad_no_realizada
 * @property string $fecha_reprogramacion
 * @property string $diligencia
 * @property string $rol
 * @property string $fecha_diligencia
 * @property int $id_componente
 * @property int $id_actividad
 */
class RomActividadesRom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.actividades_rom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rom_actividad', 'id_componente', 'id_actividad'], 'default', 'value' => null],
            [['id_rom_actividad', 'id_componente', 'id_actividad'], 'integer'],
            [['fehca_desde', 'fecha_hasta', 'fecha_reprogramacion'], 'safe'],
            [['estado', 'num_equipos', 'perfiles', 'docente_orientador', 'nombre_actividad', 'duracion_sesion', 'logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'articulacion', 'evaluacion', 'observaciones_generales', 'alarmas', 'justificacion_activiad_no_realizada', 'diligencia', 'rol', 'fecha_diligencia'], 'string'],
            [['id_componente'], 'exist', 'skipOnError' => true, 'targetClass' => IsaComponentes::className(), 'targetAttribute' => ['id_componente' => 'id']],
            [['id_rom_actividad'], 'exist', 'skipOnError' => true, 'targetClass' => RomReporteOperativoMisional::className(), 'targetAttribute' => ['id_rom_actividad' => 'id']],
			[['id_rom_actividad','fecha_desde','fecha_hasta','estado','num_equipos','perfiles','docente_orientador','nombre_actividad','duracion_sesion','logros','fortalezas','debilidades','alternativas','retos','articulacion','evaluacion','observaciones_generales','alarmas','justificacion_activiad_no_realizada','fecha_reprogramacion','diligencia','rol','fecha_diligencia','id_componente','id_actividad' ], 'required'],
			[['id_reporte_operativo_misional'], 'exist', 'skipOnError' => true, 'targetClass' => RomReporteOperativoMisional::className(), 'targetAttribute' => ['id_reporte_operativo_misional' => 'id']],
		];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_rom_actividad' => 'Id Rom',
            'fehca_desde' => 'Fecha Desde',
            'fecha_hasta' => 'Fecha Hasta',
            'estado' => 'Estado',
            'num_equipos' => 'No. del Equipo o equipos en campo',
            'perfiles' => 'Perfiles (Seleccione el perfil y cantidad por perfiles de profesionales en campo)',
            'docente_orientador' => 'Docente orientador(a) (Nombre del o la profesional)',
            'nombre_actividad' => 'Nombre o título de la actividad o encuentro ',
            'duracion_sesion' => 'Duración de la sesión (Indique el tiempo  en horas y minutos)',
            'logros' => 'Logros (Indique los resultados de avance que permitan constatar que, por medio de las actividades realizadas, se está logrando desarrollar de programas de iniciación y sensibilización artística desde las instituciones educativas oficiales dirigidos a la comunidad...)',
            'fortalezas' => 'Fortalezas (Describa las fortalezas que se detectaron en el desarrollo de la actividad para potenciar los objetivos del proyecto.)',
            'debilidades' => 'Debilidades (Describa las debilidades, dificultades, problemas que se le presentaron en el desarrollo de la actividad y que pueden afectar negativamente el  cumplimiento de los objetivos del proyecto)',
            'alternativas' => 'Alternativas: Describa las decisiones y acciones adoptadas por su equipo para superar las dificultades presentadas.',
            'retos' => 'Retos (Condiciones externas a tener en cuenta y que pueden afectar o beneficiar el logro de  los objetivos del proyecto)',
            'articulacion' => 'Articulación  Resultado de la articulación con otros proyectos de la iniciativa MCEE (Si aplica)',
            'evaluacion' => 'Evaluación (Si se realizó evaluación de las actividades desarrolladas, describa el método y nombre del documento)',
            'observaciones_generales' => 'Observaciones generales (Mencione temas identificados y aspectos adicionales que deban considerarse en el proceso que se sigue en esta sede)',
            'alarmas' => 'Alarmas:  Situaciones emergentes que pueden impedir el desarrollo de actividades y/o el logro de objetivos.',
            'justificacion_activiad_no_realizada' => 'Si la actividad no se realizó explique por qué',
            'fecha_reprogramacion' => 'Fecha de reprogramación',
            'diligencia' => 'Nombre completo de quien diligenció',
            'rol' => 'Rol',
            'fecha_diligencia' => 'Fecha',
            'id_componente' => 'Id Componente',
            'id_actividad' => 'Id Actividad',
            'id_reporte_operativo_misional' => 'id_reporte_operativo_misional',
        ];
    }
}
