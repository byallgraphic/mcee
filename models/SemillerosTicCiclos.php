<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.ciclos".
 *
 * @property string $id
 * @property string $estado
 * @property string $id_anio
 * @property string $descripcion
 */
class SemillerosTicCiclos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.ciclos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'id_anio'], 'required'],
            [['estado', 'id_anio'], 'default', 'value' => null],
            [['estado', 'id_anio','id'], 'integer'],
            [['descripcion'], 'string'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_anio'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicAnio::className(), 'targetAttribute' => ['id_anio' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 			=> 'ID',
            'estado' 		=> 'Estado',
            'id_anio' 		=> 'Año',
            'descripcion' 	=> 'Descripcion',
        ];
    }
}
