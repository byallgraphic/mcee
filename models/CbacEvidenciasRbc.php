<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.evidencias_rbc".
 *
 * @property int $id
 * @property int $id_actividad_rcb
 * @property string $actas
 * @property string $reportes
 * @property string $listados
 * @property string $plan_trabajo
 * @property string $formato_seguimiento
 * @property string $formato_evaluacion
 * @property string $fotografias
 * @property string $vidoes
 * @property string $otros_productos
 * @property int $cantidad
 * @property string $archivos_enviados_entregados
 * @property string $fecha_entrega_envio
 * @property int $estado
 */
class CbacEvidenciasRbc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.evidencias_rbc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad_rcb', 'cantidad', 'estado'], 'default', 'value' => null],
            [['id_actividad_rcb', 'cantidad', 'estado'], 'integer'],
            [['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos', 'archivos_enviados_entregados'], 'string'],
            [['fecha_entrega_envio'], 'safe'],
            [['id_actividad_rcb'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesRcb::className(), 'targetAttribute' => ['id_actividad_rcb' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividad_rcb' => 'Id Actividad Rcb',
            'actas' => 'ACTAS (Cantidad)',
            'reportes' => 'REPORTES  (Cantidad)',
            'listados' => 'LISTADOS  (Cantidad)',
            'plan_trabajo' => 'PLAN DE TRABAJO   (Cantidad)',
            'formato_seguimiento' => 'FORMATOS DE SEGUIMIENTO (Cantidad)',
            'formato_evaluacion' => 'FORMATOS DE EVALUACIÓN (Cantidad)',
            'fotografias' => 'FOTOGRAFÍAS (Cantidad)',
            'vidoes' => 'VIDEOS (Cantidad)',
            'otros_productos' => 'Otros productos  de la actividad',
            'cantidad' => 'Cantidad',
            'archivos_enviados_entregados' => 'Archivos enviados o entregados a:',
            'fecha_entrega_envio' => 'Fecha de entrega o envío',
            'estado' => 'Estado',
        ];
    }
}
