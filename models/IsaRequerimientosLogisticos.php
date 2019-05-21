<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.requerimientos_logisticos".
 *
 * @property string $id
 * @property int $id_requerimiento
 * @property int $cantidad
 * @property string $id_iniciacion_sencibilizacion_artistica
 * @property string $id_actividad
 * @property string $estado
 */
class IsaRequerimientosLogisticos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.requerimientos_logisticos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_requerimiento', 'cantidad', 'id_iniciacion_sencibilizacion_artistica', 'id_actividad', 'estado'], 'default', 'value' => null],
            [['id_requerimiento', 'cantidad', 'id_iniciacion_sencibilizacion_artistica', 'id_actividad', 'estado'], 'integer'],
            [['id_iniciacion_sencibilizacion_artistica'], 'exist', 'skipOnError' => true, 'targetClass' => IsaIniciacionSencibilizacionArtistica::className(), 'targetAttribute' => ['id_iniciacion_sencibilizacion_artistica' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_requerimiento' => 'Id Requerimiento',
            'cantidad' => 'Cantidad',
            'id_iniciacion_sencibilizacion_artistica' => 'Id Iniciacion Sencibilizacion Artistica',
            'id_actividad' => 'Id Actividad',
            'estado' => 'Estado',
        ];
    }
}
