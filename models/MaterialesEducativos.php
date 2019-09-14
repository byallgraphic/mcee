<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materiales_educativos".
 *
 * @property string $id
 * @property int $tipo
 * @property int $autor
 * @property int $nivel
 * @property string $estado
 * @property string $otro_cual
 * @property string $nombre_apellidos
 * @property string $reseña
 */
class MaterialesEducativos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'materiales_educativos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo', 'autor', 'nivel', 'estado'], 'required'],
            [['tipo', 'autor', 'nivel', 'estado'], 'default', 'value' => null],
            [['tipo', 'autor', 'nivel', 'estado'], 'integer'],
            [['otro_cual', 'nombre_apellidos', 'reseña','ruta'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo' => 'Tipo',
            'autor' => 'Autor',
            'nivel' => 'Nivel',
            'estado' => 'Estado',
            'otro_cual' => 'Otro Cual',
            'nombre_apellidos' => 'Nombre y Apellidos',
            'reseña' => 'Breve Reseña',
            'ruta' => 'Ruta',
        ];
    }
}
