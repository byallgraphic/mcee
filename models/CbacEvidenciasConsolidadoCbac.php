<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.evidencias_consolidado_cbac".
 *
 * @property int $id
 * @property string $id_imp_consolidado_mes_cbac
 * @property string $actas
 * @property string $reportes
 * @property string $listados
 * @property string $plan_trabajo
 * @property string $formato_seguimiento
 * @property string $formato_evaluacion
 * @property string $fotografias
 * @property string $vidoes
 * @property string $otros_productos
 */
class CbacEvidenciasConsolidadoCbac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.evidencias_consolidado_cbac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_imp_consolidado_mes_cbac'], 'default', 'value' => null],
            [['id_imp_consolidado_mes_cbac'], 'integer'],
            [['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos'], 'string'],
            //[['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes'], 'required'],
            [['id_imp_consolidado_mes_cbac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacImpConsolidadoMesCbac::className(), 'targetAttribute' => ['id_imp_consolidado_mes_cbac' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_imp_consolidado_mes_cbac' => 'Id Imp Consolidado Mes Cbac',
            'actas' => 'Actas',
            'reportes' => 'Reportes',
            'listados' => 'Listados',
            'plan_trabajo' => 'Plan Trabajo',
            'formato_seguimiento' => 'Formato Seguimiento',
            'formato_evaluacion' => 'Formato Evaluacion',
            'fotografias' => 'Fotografias',
            'vidoes' => 'Vidoes',
            'otros_productos' => 'Otros Productos',
        ];
    }
}
