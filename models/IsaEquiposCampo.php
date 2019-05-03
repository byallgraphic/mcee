<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.equipos_campo".
 *
 * @property string $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $cantidad
 */
class IsaEquiposCampo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.equipos_campo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'descripcion', 'cantidad'], 'required'],
            [['nombre', 'descripcion', 'cantidad'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'descripcion' => 'Descripción',
            'cantidad' => 'Cantidad',
			'integrantes' => 'Integrantes'
        ];
    }
}
