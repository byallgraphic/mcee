<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.evidencias_cac".
 *
 * @property int $id
 * @property int $id_actividades_is_cac
 * @property string $actas
 * @property string $reportes
 * @property string $listados
 * @property string $plan_trabajo
 * @property string $formato_seguimiento
 * @property string $formato_evaluacion
 * @property string $fotografias
 * @property string $vidoes
 * @property string $otros_productos
 * @property int $estado
 */
class CbacEvidenciasCac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.evidencias_cac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividades_is_cac', 'estado'], 'default', 'value' => null],
            [['id_actividades_is_cac', 'estado'], 'integer'],
            [['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos'], 'string'],
            [['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes'], 'required'],
            [['id_actividades_is_cac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesIsCac::className(), 'targetAttribute' => ['id_actividades_is_cac' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividades_is_cac' => 'Id Actividades Is Cac',
            'actas' => 'Actas',
            'reportes' => 'Reportes',
            'listados' => 'Listados',
            'plan_trabajo' => 'Plan Trabajo',
            'formato_seguimiento' => 'Formato Seguimiento',
            'formato_evaluacion' => 'Formato Evaluacion',
            'fotografias' => 'Fotografias',
            'vidoes' => 'Videos',
            'otros_productos' => 'Otros Productos',
            'estado' => 'Estado',
        ];
    }
}
