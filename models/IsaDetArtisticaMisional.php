<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.det_artistica_misional".
 *
 * @property string $id
 * @property string $estado
 * @property string $id_enc_artistica_misional
 * @property string $mision
 * @property string $descripcion_proceso
 * @property string $hallazgos
 * @property int $avance_sede_sensibilizacion
 */
class IsaDetArtisticaMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.det_artistica_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'id_enc_artistica_misional','mision','descripcion_proceso','hallazgos','avance_sede_sensibilizacion'], 'required'],
            [['estado', 'id_enc_artistica_misional', 'avance_sede_sensibilizacion'], 'default', 'value' => null],
            [['estado', 'id_enc_artistica_misional', 'avance_sede_sensibilizacion'], 'integer'],
            [['mision', 'descripcion_proceso', 'hallazgos'], 'string'],
            [['id_enc_artistica_misional'], 'exist', 'skipOnError' => true, 'targetClass' => IsaEncArtisticaMisional::className(), 'targetAttribute' => ['id_enc_artistica_misional' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 							=> 'ID',
            'estado' 						=> 'Estado',
            'id_enc_artistica_misional' 	=> 'Id Enc Artistica Misional',
            'mision' 						=> 'Misión',
            'descripcion_proceso' 			=> 'Descripción general del Proceso',
            'hallazgos' 					=> 'Hallazgos metodológicos del proceso',
            'avance_sede_sensibilizacion' 	=> 'Porcentaje de Avance por Sede',
        ];
    }
}
