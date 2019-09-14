<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.datos_sesiones".
 *
 * @property string $id
 * @property string $id_sesion
 * @property string $fecha_sesion
 * @property string $estado
 */
class DatosSesiones extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.datos_sesiones';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_sesion', 'fecha_sesion', 'estado','duracion_sesion'], 'required'],
            [['id_sesion', 'fecha_sesion', 'estado'], 'default', 'value' => null],
            [['id_sesion', 'estado'], 'integer'],
            [['duracion_sesion'], 'string'],
            [['fecha_sesion'], 'date', 'format' => 'php:d-m-Y'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_sesion'], 'exist', 'skipOnError' => true, 'targetClass' => Sesiones::className(), 'targetAttribute' => ['id_sesion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 				=> 'ID',
            'id_sesion' 		=> 'Id Sesion',
            'fecha_sesion' 		=> 'Facha Sesion',
            'estado' 			=> 'Estado',
            'duracion_sesion'	=> 'Duración de la sesión',
        ];
    }
}
