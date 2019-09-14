<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Barrios_comunas".
 *
 * @property string $Ciudad
 * @property string $Zona
 * @property string $Barrio
 * @property string $Comuna
 * @property string $Corregimiento
 * @property string $Sector_vereda
 * @property string $Num_id_territorio
 * @property string $Estrato
 * @property string $Distribucion_zonal_COMCE
 */
class PccBarriosComunas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Barrios_comunas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Ciudad', 'Zona', 'Barrio', 'Comuna', 'Corregimiento', 'Sector_vereda', 'Estrato', 'Distribucion_zonal_COMCE'], 'string', 'max' => 255],
            [['Num_id_territorio'], 'string', 'max' => 320],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Ciudad' => 'Ciudad',
            'Zona' => 'Zona',
            'Barrio' => 'Barrio',
            'Comuna' => 'Comuna',
            'Corregimiento' => 'Corregimiento',
            'Sector_vereda' => 'Sector Vereda',
            'Num_id_territorio' => 'Num Id Territorio',
            'Estrato' => 'Estrato',
            'Distribucion_zonal_COMCE' => 'Distribucion Zonal  Comce',
        ];
    }
}
