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
 * @property int $id_tipo_informe
 */
class EcInformeSemanalTotalEjecutivo extends \yii\db\ActiveRecord
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
            [['institucion_id', 'cantidad_ieo', 'cantidad_sedes', 'porcentaje_ieo', 'porcentaje_sedes', 'porcentaje_actividad_uno', 'porcentaje_actividad_dos', 'porcentaje_actividad_tres', 'poblacion_beneficiada_directa', 'poblacion_beneficiada_indirecta', 'secuencia', 'id_tipo_informe'], 'default', 'value' => null],
            [['institucion_id', 'cantidad_ieo', 'cantidad_sedes', 'poblacion_beneficiada_directa', 'poblacion_beneficiada_indirecta', 'secuencia', 'id_tipo_informe'], 'integer'],
            [['id_tipo_informe'], 'exist', 'skipOnError' => true, 'targetClass' => TipoInforme::className(), 'targetAttribute' => ['id_tipo_informe' => 'id']],
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
            'institucion_id' => 'Institucion ID',
            'cantidad_ieo' => 'Cantidad Ieo',
            'cantidad_sedes' => 'Cantidad Sedes',
            'porcentaje_ieo' => 'Porcentaje Ieo',
            'porcentaje_sedes' => 'Porcentaje Sedes',
            'porcentaje_actividad_uno' => 'Porcentaje Actividad Uno',
            'porcentaje_actividad_dos' => 'Porcentaje Actividad Dos',
            'porcentaje_actividad_tres' => 'Porcentaje Actividad Tres',
            'poblacion_beneficiada_directa' => 'Poblacion Beneficiada Directa',
            'poblacion_beneficiada_indirecta' => 'Poblacion Beneficiada Indirecta',
            'alarmas_generales' => 'Alarmas Generales',
            'secuencia' => 'Secuencia',
            'id_tipo_informe' => 'Id Tipo Informe',
        ];
    }
}
