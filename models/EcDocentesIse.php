<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.docentes_ise".
 *
 * @property int $id
 * @property int $tipo_cantidad_poblacion_ise_id
 * @property string $edu_derechos
 * @property string $sexualidad_ciudadania
 * @property string $medio_ambiente
 * @property string $familia
 * @property string $directivos
 */
class EcDocentesIse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.docentes_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_cantidad_poblacion_ise_id'], 'default', 'value' => null],
            [['tipo_cantidad_poblacion_ise_id'], 'integer'],
            [['edu_derechos', 'sexualidad_ciudadania', 'medio_ambiente', 'familia', 'directivos'], 'string'],
            [['familia', 'directivos'], 'required'],
            [['tipo_cantidad_poblacion_ise_id'], 'exist', 'skipOnError' => true, 'targetClass' => EcTipoCantidadPoblacionIse::className(), 'targetAttribute' => ['tipo_cantidad_poblacion_ise_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tipo_cantidad_poblacion_ise_id' => 'Tipo Cantidad Poblacion Ise ID',
            'edu_derechos' => 'Edu Derechos',
            'sexualidad_ciudadania' => 'Sexualidad Ciudadanía',
            'medio_ambiente' => 'Medio Ambiente',
            'familia' => 'Familia',
            'directivos' => 'Directivos',
        ];
    }
}
