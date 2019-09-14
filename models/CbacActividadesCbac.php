<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividades_cbac".
 *
 * @property int $id
 * @property int $id_orientacion_proceso_cbac
 * @property string $logors
 * @property string $fortalezas
 * @property string $debilidades
 * @property string $alternativas
 * @property string $retos
 * @property string $observaciones
 * @property string $alarmas
 * @property string $necesidades
 * @property string $estrategias_aprovechar
 * @property string $estrategias_enfrentar
 * @property string $ajustes
 * @property string $temas
 * @property string $articulacion
 * @property string $necesidades_articulacion
 * @property string $cumplimiento_objetivos
 * @property int $id_actividad_c
 * @property int $id_componente
 * @property int $estado
 */
class CbacActividadesCbac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividades_cbac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_orientacion_proceso_cbac', 'id_actividad_c', 'id_componente', 'estado'], 'default', 'value' => null],
            [['id_orientacion_proceso_cbac', 'id_actividad_c', 'id_componente', 'estado'], 'integer'],
            [['logors', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'observaciones', 'alarmas', 'necesidades', 'estrategias_aprovechar', 'estrategias_enfrentar', 'ajustes', 'temas', 'articulacion', 'necesidades_articulacion', 'cumplimiento_objetivos'], 'string'],
            [['logors', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'observaciones', 'alarmas', 'necesidades', 'estrategias_aprovechar', 'estrategias_enfrentar', 'ajustes', 'temas', 'articulacion', 'necesidades_articulacion', 'cumplimiento_objetivos'],'required'],
            [['id_orientacion_proceso_cbac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacOrientacionProcesoCbac::className(), 'targetAttribute' => ['id_orientacion_proceso_cbac' => 'id']],
            [['id_componente'], 'exist', 'skipOnError' => true, 'targetClass' => IsaComponentes::className(), 'targetAttribute' => ['id_componente' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_orientacion_proceso_cbac' => 'Id Orientacion Proceso Cbac',
            'logors' => 'Logros: Resultados de avance que permitan constatar que, por medio de las actividades realizadas, se está logrando desarrollar herramientas en docentes y directivos docentes que implementen componentes artísticos y culturales para el fortalecimiento de competencias básicas ..)',
            'fortalezas' => 'Fortalezas',
            'debilidades' => 'Debilidades',
            'alternativas' => 'Alternativas adoptadas por los profesionales de campo',
            'retos' => 'Retos',
            'observaciones' => 'Observaciones de los profesionales del equipo de campo',
            'alarmas' => 'Alarmas',
            'necesidades' => 'Necesidades de orientación identificadas',
            'estrategias_aprovechar' => 'Estrategias para aprovechar las fortalezas: Indique las estrategias que se plantean y actividades realizadas para aprovechar y potencializar las fortalezas detectadas.',
            'estrategias_enfrentar' => 'Estrategias para enfrentar las debilidades, dificultades y retos: Indique las estrategias diseñadas y las acciones realizadas para superar los retos y debilidades detectadas.',
            'ajustes' => 'Ajustes incorporados para estas actividades en la propuesta:  ',
            'temas' => 'Temas a abordar',
            'articulacion' => 'Como se articula el plan de acción formulado para la institución en las actividades propuestas',
            'necesidades_articulacion' => 'Necesidades de articulación con otros proyectos ',
            'cumplimiento_objetivos' => 'Indique cómo se garantiza el cumplimiento de los objetivos del proyecto con las actividades realizadas o incorporadas en términos metodológicos y programáticos.',
            'id_actividad_c' => 'Id Actividad C',
            'id_componente' => 'Id Componente',
            'estado' => 'Estado',
        ];
    }
}
