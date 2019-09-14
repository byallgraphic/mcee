<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.producto".
 *
 * @property int $id
 * @property int $ieo_id
 * @property string $imforme_ruta
 * @property string $plan_accion_ruta
 * @property int $id_proyecto
 * @property int $id_actividad
 */
class Producto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.producto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ieo'], 'default', 'value' => null],
            [['id_ieo'], 'integer'],
            [['informe_ruta', 'plan_accion_ruta','presentacion_plan'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ieo' => 'Ieo ID',
            'informe_ruta' => 'Informe Ruta',
            'plan_accion_ruta' => 'Plan Accion Ruta',
			'presentacion_plan'=>'presentacion_plan'
        ];
    }
}
