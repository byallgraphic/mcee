<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.indicadores_x_det_artistica_misional".
 *
 * @property string $id
 * @property string $id_det_artisctica_misional
 * @property string $estado
 * @property string $id_indicador
 * @property int $valor_indicador
 */
class IsaIndicadoresXDetArtisticaMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.indicadores_x_det_artistica_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_det_artisctica_misional', 'estado', 'id_indicador','valor_indicador'], 'required'],
            [['id_det_artisctica_misional', 'estado', 'id_indicador', 'valor_indicador'], 'default', 'value' => null],
            [['id_det_artisctica_misional', 'estado', 'id_indicador', 'valor_indicador'], 'integer'],
            [['id_det_artisctica_misional'], 'exist', 'skipOnError' => true, 'targetClass' => IsaDetArtisticaMisional::className(), 'targetAttribute' => ['id_det_artisctica_misional' => 'id']],
            [['id_indicador'], 'exist', 'skipOnError' => true, 'targetClass' => IsaIndicadores::className(), 'targetAttribute' => ['id_indicador' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 						 => 'ID',
            'id_det_artisctica_misional' => 'Id Det Artisctica Misional',
            'estado' 					 => 'Estado',
            'id_indicador' 				 => 'Id Indicador',
            'valor_indicador' 			 => 'Valor Indicador',
        ];
    }
}
