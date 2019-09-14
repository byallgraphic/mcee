<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.tipo_cantidad_poblacion_ise".
 *
 * @property int $id
 * @property string $edu_derechos
 * @property string $sexualidad_ciudadania
 * @property string $medio_ambiente
 * @property string $familia
 * @property string $directivos
 * @property string $tiempo_libre
 * @property int $id_proyecto
 * @property int $estado
 * @property int $id_actividad_ise
 * @property int $id_sede
 * @property string $docentes
 * @property string $psicoorientador
 */
class EcTipoCantidadPoblacionIse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.tipo_cantidad_poblacion_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['edu_derechos', 'sexualidad_ciudadania', 'medio_ambiente', 'familia', 'directivos', 'tiempo_libre', 'docentes', 'psicoorientador'], 'string'],
            [['familia', 'directivos'], 'required'],
            [['id_proyecto', 'estado', 'id_actividad_ise', 'id_sede'], 'default', 'value' => null],
            [['id_proyecto', 'estado', 'id_actividad_ise', 'id_sede'], 'integer'],

            [['id_actividad_ise'], 'exist', 'skipOnError' => true, 'targetClass' => EcActividadesIse::className(), 'targetAttribute' => ['id_actividad_ise' => 'id']],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => EcProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'edu_derechos' => 'Edu Derechos',
            'sexualidad_ciudadania' => 'Sexualidad Ciudadanía',
            'medio_ambiente' => 'Medio Ambiente',
            'familia' => 'Familia',
            'directivos' => 'Directivos',
            'tiempo_libre' => 'Tiempo Libre',
            'id_proyecto' => 'Id Proyecto',
            'estado' => 'Estado',
            'id_actividad_ise' => 'Id Actividad Ise',
            'id_sede' => 'Id Sede',
            'docentes' => 'Docentes',
            'psicoorientador' => 'Psicoorientador',
        ];
    }
}
