<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.requerimientos_tecnicos".
 *
 * @property string $id
 * @property int $id_requerimiento
 * @property int $cantidad
 * @property string $id_ iniciacion_sencibilizacion_artistica
 * @property string $id_actividad
 * @property string $estado
 */
class IsaRequerimientosTecnicos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.requerimientos_tecnicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_requerimiento', 'cantidad', 'id_ iniciacion_sencibilizacion_artistica', 'id_actividad', 'estado'], 'default', 'value' => null],
            [['id_requerimiento', 'cantidad', 'id_ iniciacion_sencibilizacion_artistica', 'id_actividad', 'estado'], 'integer'],
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
            'id_ iniciacion_sencibilizacion_artistica' => 'Id  Iniciacion Sencibilizacion Artistica',
            'id_actividad' => 'Id Actividad',
            'estado' => 'Estado',
        ];
    }
}
