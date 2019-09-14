<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Zona_IE_Sedes".
 *
 * @property string $Zona
 * @property string $Institucion_educativa
 * @property string $Sede
 * @property string $Direccion_IE
 * @property string $Barrio_IE
 * @property string $Comuna
 * @property string $Corregimiento
 * @property string $Sector_vereda
 * @property string $Num_id_territorio
 * @property string $Estrato
 * @property string $Gestor_institucional_asignado
 * @property string $Coordinador_SPCC
 * @property string $Distribucion_zonal_COMCE
 */
class PccZonaIESedes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Zona_IE_Sedes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Zona', 'Institucion_educativa', 'Sede', 'Direccion_IE', 'Barrio_IE', 'Comuna', 'Corregimiento', 'Sector_vereda', 'Estrato', 'Gestor_institucional_asignado', 'Coordinador_SPCC', 'Distribucion_zonal_COMCE'], 'string', 'max' => 255],
            [['Num_id_territorio'], 'string', 'max' => 320],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Zona' => 'Zona',
            'Institucion_educativa' => 'Institucion Educativa',
            'Sede' => 'Sede',
            'Direccion_IE' => 'Direccion  Ie',
            'Barrio_IE' => 'Barrio  Ie',
            'Comuna' => 'Comuna',
            'Corregimiento' => 'Corregimiento',
            'Sector_vereda' => 'Sector Vereda',
            'Num_id_territorio' => 'Num Id Territorio',
            'Estrato' => 'Estrato',
            'Gestor_institucional_asignado' => 'Gestor Institucional Asignado',
            'Coordinador_SPCC' => 'Coordinador  Spcc',
            'Distribucion_zonal_COMCE' => 'Distribucion Zonal  Comce',
        ];
    }
}
