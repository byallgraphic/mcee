<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.enc_artistica_misional".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $estado
 * @property string $periodo
 * @property string $fecha
 */
class IsaEncArtisticaMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.enc_artistica_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'estado','periodo','fecha'], 'required'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['periodo'], 'string'],
            [['fecha'], 'safe'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_institucion' 	=> 'Institución',
            'id_sede' 			=> 'Sede',
            'estado' 			=> 'Estado',
            'periodo' 			=> 'Período',
            'fecha' 			=> 'Fecha',
        ];
    }
}
