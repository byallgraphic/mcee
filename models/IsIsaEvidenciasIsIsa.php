<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_isa.evidencias_is_isa".
 *
 * @property int $id
 * @property int $id_actividades_is_isa
 * @property string $acta
 * @property string $reprote
 * @property string $listados
 * @property string $plan_trabajo
 * @property string $formato_seguimiento
 * @property string $formato_evaluacion
 * @property string $fotografias
 * @property string $videos
 * @property string $otros
 * @property int $estado
 */
class IsIsaEvidenciasIsIsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.evidencias_is_isa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividades_is_isa', 'estado'], 'default', 'value' => null],
            [['id_actividades_is_isa', 'estado'], 'integer'],
            [['acta', 'reprote', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'videos', 'otros'], 'string'],
            [['id_actividades_is_isa'], 'exist', 'skipOnError' => true, 'targetClass' => IsIsaActividadesIsIsa::className(), 'targetAttribute' => ['id_actividades_is_isa' => 'id']],
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
            'id_actividades_is_isa' => 'Id Actividades Is Isa',
            'acta' => 'Acta',
            'reprote' => 'Reprote',
            'listados' => 'Listados',
            'plan_trabajo' => 'Plan Trabajo',
            'formato_seguimiento' => 'Formato Seguimiento',
            'formato_evaluacion' => 'Formato Evaluación',
            'fotografias' => 'Fotografías',
            'videos' => 'Videos',
            'otros' => 'Otros',
            'estado' => 'Estado',
        ];
    }
}
