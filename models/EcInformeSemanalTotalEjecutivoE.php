<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_semanal_total_ejecutivo".
 *
 * @property int $id
 * @property int $institucion_id
 * @property int $cantidad_ieo
 * @property int $cantidad_sedes
 * @property int $porcentaje_ieo
 * @property int $porcentaje_sedes
 * @property int $porcentaje_actividad_uno
 * @property int $porcentaje_actividad_dos
 * @property int $porcentaje_actividad_tres
 * @property int $poblacion_beneficiada_directa
 * @property int $poblacion_beneficiada_indirecta
 * @property string $alarmas_generales
 * @property int $secuencia
 */
class EcInformeSemanalTotalEjecutivoE extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_semanal_total_ejecutivo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institucion_id', 'cantidad_ieo', 'cantidad_sedes', 'porcentaje_ieo', 'porcentaje_sedes', 'porcentaje_actividad_uno', 'porcentaje_actividad_dos', 'porcentaje_actividad_tres', 'poblacion_beneficiada_directa', 'poblacion_beneficiada_indirecta', 'secuencia'], 'default', 'value' => null],
            [['institucion_id', 'cantidad_ieo', 'cantidad_sedes', 'porcentaje_ieo', 'porcentaje_sedes', 'porcentaje_actividad_uno', 'porcentaje_actividad_dos', 'porcentaje_actividad_tres', 'poblacion_beneficiada_directa', 'poblacion_beneficiada_indirecta', 'secuencia'], 'integer'],
            [['alarmas_generales'], 'string'],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institucion_id' => '',
            'cantidad_ieo' => '',
            'cantidad_sedes' => '',
            'porcentaje_ieo' => '',
            'porcentaje_sedes' => '',
            'porcentaje_actividad_uno' => '',
            'porcentaje_actividad_dos' => '',
            'porcentaje_actividad_tres' => '',
            'poblacion_beneficiada_directa' => '',
            'poblacion_beneficiada_indirecta' => '',
            'alarmas_generales' => '',
            'secuencia' => '',
        ];
    }
}
