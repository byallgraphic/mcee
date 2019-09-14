<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.avances".
 *
 * @property string $id
 * @property string $logros
 * @property string $fortalezas
 * @property string $debilidades
 * @property string $alternativas
 * @property string $retos
 * @property string $observaciones
 * @property string $alarmas
 * @property string $necesidades
 * @property string $estrategias_fortalezas
 * @property string $estrategias_debilidades
 * @property string $ajustes
 * @property string $temas_abordar
 * @property string $como
 * @property string $necesidades_articulacion
 * @property string $indique
 * @property int $estado
 * @property string $id_acciones
 * @property string $id_orientacion_proceso
 */
class CbacAvances extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.avances';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'observaciones', 'alarmas', 'necesidades', 'estrategias_fortalezas', 'estrategias_debilidades', 'ajustes', 'temas_abordar', 'como', 'necesidades_articulacion', 'indique', 'estado', 'id_acciones', 'id_orientacion_proceso'], 'required'],
            [['logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'observaciones', 'alarmas', 'necesidades', 'estrategias_fortalezas', 'estrategias_debilidades', 'ajustes', 'temas_abordar', 'como', 'necesidades_articulacion', 'indique'], 'string'],
            [['estado', 'id_acciones', 'id_orientacion_proceso'], 'default', 'value' => null],
            [['estado', 'id_acciones', 'id_orientacion_proceso'], 'integer'],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => CbacAcciones::className(), 'targetAttribute' => ['id' => 'id']],
            [['id_orientacion_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => CbacOrientacionProceso::className(), 'targetAttribute' => ['id_orientacion_proceso' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
         return [
            'id' => 'ID',
            'logros' => 'Logros: Resultados de avance que permitan constatar que, por medio de las actividades realizadas, se está logrando desarrollar herramientas en docentes y directivos ',
            'fortalezas' => 'Fortalezas',
            'debilidades' => 'Debilidades',
            'alternativas' => 'Alternativas adoptadas por los profesionales de campo',
            'retos' => 'Retos',
            'observaciones' => 'Observaciones de los profesionales del equipo de campo',
            'alarmas' => 'Alarmas',
            'necesidades' => 'Necesidades de orientación identificadas',
            'estrategias_fortalezas' => ' Estrategias para aprovechar las fortalezas: Indique las estrategias que se plantean y actividades realizadas para aprovechar y potencializar las fortalezas detectadas.',
            'estrategias_debilidades' => 'Estrategias para enfrentar las debilidades, dificultades y retos: Indique las estrategias diseñadas y las acciones realizadas para superar los retos y debilidades detectadas.',
            'ajustes' => 'Ajustes incorporados para estas actividades en la propuesta:  ',
            'temas_abordar' => 'Temas a abordar',
            'como' => 'Como se articula el plan de acción formulado para la institución en las actividades propuestas',
            'necesidades_articulacion' => 'Necesidades de articulación con otros proyectos ',
            'indique' => 'Indique cómo se garantiza el cumplimiento de los objetivos del proyecto con las actividades realizadas o incorporadas en términos metodológicos y programáticos.',
            'estado' => 'Estado',
            'id_acciones' => 'Id Acciones',
            'id_orientacion_proceso' => 'Id Orientacion Proceso',
        ];
    }
}
