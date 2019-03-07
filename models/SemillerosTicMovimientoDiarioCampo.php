<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.movimiento_diario_campo".
 *
 * @property string $id
 * @property string $id_diario_de_campo
 * @property string $descripcion
 * @property string $hallazgos
 * @property string $estado
 * @property int $anio
 * @property string $id_sesion
 */
class SemillerosTicMovimientoDiarioCampo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.movimiento_diario_campo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_diario_de_campo', 'descripcion', 'hallazgos', 'estado', 'anio', 'id_sesion'], 'required'],
            [['id_diario_de_campo', 'estado', 'anio', 'id_sesion'], 'default', 'value' => null],
            [['id_diario_de_campo', 'estado', 'anio', 'id_sesion'], 'integer'],
            [['descripcion', 'hallazgos'], 'string', 'max' => 5000],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_diario_de_campo'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDiarioDeCampo::className(), 'targetAttribute' => ['id_diario_de_campo' => 'id']],
            [['id_sesion'], 'exist', 'skipOnError' => true, 'targetClass' => Sesiones::className(), 'targetAttribute' => ['id_sesion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_diario_de_campo' => 'Id Diario De Campo',
            'descripcion' => 'Descripcion',
            'hallazgos' => 'Hallazgos',
            'estado' => 'Estado',
            'anio' => 'Anio',
            'id_sesion' => 'Id Sesion',
        ];
    }
}
