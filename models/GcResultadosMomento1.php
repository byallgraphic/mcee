<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.resultados_momento1".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_momento1
 * @property string $estado
 * @property string $nombre
 */
class GcResultadosMomento1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.resultados_momento1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_momento1', 'estado', 'nombre'], 'required'],
            [['id_momento1', 'estado'], 'default', 'value' => null],
            [['id_momento1', 'estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 600],
            [['nombre'], 'string', 'max' => 100],
            [['id_momento1'], 'exist', 'skipOnError' => true, 'targetClass' => GcMomento1::className(), 'targetAttribute' => ['id_momento1' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
		$descripcion = utf8_encode('Descripción');
        return [
            'id' => 'ID',
            'descripcion' => $descripcion,
            'id_momento1' => 'Id Momento1',
            'estado' => 'Estado',
            'nombre' => 'Nombre',
        ];
    }
}
