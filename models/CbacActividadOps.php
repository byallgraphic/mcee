<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividad_ops".
 *
 * @property int $id
 * @property int $id_orientacion_proceso_seguimiento
 * @property int $total_sesiones_realizadas
 * @property int $avance_sede
 * @property int $avance_ieo
 * @property string $documentos_seguimiento
 * @property string $documentos_evaluacion
 * @property string $resumen_alertar
 * @property string $id_actividad
 */
class CbacActividadOps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividad_ops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_orientacion_proceso_seguimiento', 'total_sesiones_realizadas', 'avance_sede', 'avance_ieo'], 'default', 'value' => null],
            [['id_orientacion_proceso_seguimiento', 'total_sesiones_realizadas', 'avance_sede', 'avance_ieo', 'id_actividad'], 'integer'],
            [['documentos_seguimiento', 'documentos_evaluacion', 'resumen_alertar'], 'string'],
            [['id_orientacion_proceso_seguimiento'], 'exist', 'skipOnError' => true, 'targetClass' => CbacOrientacionProcesoSeguimiento::className(), 'targetAttribute' => ['id_orientacion_proceso_seguimiento' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_orientacion_proceso_seguimiento' => 'Id Orientacion Proceso Seguimiento',
            'total_sesiones_realizadas' => 'Total de sesiones realizadas en el mes',
            'avance_sede' => '% Avance por sede',
            'avance_ieo' => '% Avance por IEO',
            'documentos_seguimiento' => 'Se cuenta con documentos de seguimiento de actividades desarrolladas',
            'documentos_evaluacion' => 'Se cuenta con documentos de evaluación de actividades desarrolladas',
            'resumen_alertar' => 'Resumen Alertar',
            'id_actividad' => 'Id Actividad',
        ];
    }
}
