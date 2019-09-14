<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.equipos_campo".
 *
 * @property string $id
 * @property string $nombre
 * @property string $descripcion
 * @property string $estado
 */
class CbacEquiposCampo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.equipos_campo';
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
