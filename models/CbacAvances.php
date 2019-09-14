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
 * @property string $id_acciones
 * @property string $id_orientacion_proceso
 * @property string $retos
 * @property string $necesidades
 * @property string $estrategias_fortalezas
 * @property string $estrategias_debilidades
 * @property string $ajustes
 * @property string $temas_abordar
 * @property string $como
 * @property string $necesidades_articulacion
 * @property string $indique
 * @property string $observaciones
 * @property int $estado
 * @property string $alarmas
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
            [['logros', 'fortalezas', 'debilidades', 'alternativas', 'id_acciones', 'id_orientacion_proceso', 'retos', 'necesidades', 'estrategias_fortalezas', 'estrategias_debilidades', 'ajustes', 'temas_abordar', 'como', 'necesidades_articulacion', 'indique', 'observaciones', 'estado','alarmas'], 'required'],
            [['logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'necesidades', 'estrategias_fortalezas', 'estrategias_debilidades', 'ajustes', 'temas_abordar', 'como', 'necesidades_articulacion', 'indique', 'observaciones', 'alarmas'], 'string'],
            [['id_acciones', 'id_orientacion_proceso', 'estado'], 'default', 'value' => null],
            [['id_acciones', 'id_orientacion_proceso', 'estado'], 'integer'],
            [['id_acciones'], 'exist', 'skipOnError' => true, 'targetClass' => CbacAcciones::className(), 'targetAttribute' => ['id_acciones' => 'id']],
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
            'logros' => 'Logros: Resultados de avance que permiten constatar que, por medio de las actividades realizadas, se está logrando sensibilizar a la comunidad sobre la importancia del arte y la cultura a través de la oferta cultural del municipio para fortalecer el vínculo comunidad-escuela mediante el mejoramiento de la oferta en artes y cultura desde las instituciones educativas oficiales para la ocupación del tiempo libre en las comunas y corregimientos de Santiago de Cali.',
            'fortalezas' => 'Fortalezas',
            'debilidades' => 'Debilidades',
            'alternativas' => 'Alternativas adoptadas por los profesionales de campo',
            'id_acciones' => 'Id Acciones',
            'id_orientacion_proceso' => 'Id Orientacion Proceso',
            'retos' => 'Retos',
			'observaciones' => 'Observaciones de los profesionales del equipo de campo',
			'alarmas' => 'Alarmas',
            'necesidades' => 'Necesidades de orientación identificadas',
            'estrategias_fortalezas' => ' Estrategias para aprovechar las fortalezas: Indique las estrategias que se plantean y actividades realizadas para aprovechar y potencializar las fortalezas detectadas.',
            'estrategias_debilidades' => 'Estrategias para enfrentar las debilidades, dificultades y retos: Indique las estrategias diseñadas y las acciones realizadas para superar los retos y debilidades detectadas.',
            'ajustes' => 'Ajustes incorporados para estas actividades en la propuesta:  ',
            'temas_abordar' => 'Temas a Abordar',
            'como' => 'Como se articula el plan de acción formulado para la institución en las actividades propuestas',
            'necesidades_articulacion' => 'Necesidades de articulación con otros proyectos ',
            'indique' => 'Indique cómo se garantiza el cumplimiento de los objetivos del proyecto con las actividades realizadas o incorporadas en términos metodológicos y programáticos.',
            'estado' => 'Estado',
        ];
    }
}
