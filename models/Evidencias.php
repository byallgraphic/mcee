<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.evidencias".
 *
 * @property int $id
 * @property string $producto_ruta
 * @property string $resultados_actividad_ruta
 * @property string $acta_ruta
 * @property string $listado_ruta
 * @property string $fotografias_ruta
 * @property int $ieo_id
 * @property int $proyecto_id
 * @property int $actividad_id
 */
class Evidencias extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.evidencias';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['producto_ruta', 'resultados_actividad_ruta', 'acta_ruta', 'listado_ruta', 'fotografias_ruta'], 'string'],
            [['ieo_id', 'proyecto_id', 'actividad_id'], 'default', 'value' => null],
            [['ieo_id', 'proyecto_id', 'actividad_id'], 'integer'],
            [['ieo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ieo::className(), 'targetAttribute' => ['ieo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'producto_ruta' => 'Producto Ruta',
            'resultados_actividad_ruta' => 'Resultados Actividad Ruta',
            'acta_ruta' => 'Acta Ruta',
            'listado_ruta' => 'Listado Ruta',
            'fotografias_ruta' => 'Fotografias Ruta',
            'ieo_id' => 'Ieo ID',
            'proyecto_id' => 'Proyecto ID',
            'actividad_id' => 'Actividad ID',
        ];
    }
}
