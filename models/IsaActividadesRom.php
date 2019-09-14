<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.actividades_rom".
 *
 * @property int $id
 * @property string $fecha_desde
 * @property string $fecha_hasta
 * @property string $estado_actividad
 * @property string $id_rom_actividad
 * @property string $estado
 * @property string $id_reporte_operativo_misional
 */
class IsaActividadesRom extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.actividades_rom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['fecha_desde', 'fecha_hasta', 'estado_actividad', 'estado', 'id_reporte_operativo_misional','sesion_actividad','id_rom_actividad','nro_semana'], 'required'],
            [['estado', 'id_reporte_operativo_misional','id_rom_actividad','nro_semana'], 'required'],
            [['fecha_desde', 'fecha_hasta'], 'string'],
            [['estado_actividad'], 'string'],
            [['estado', 'id_reporte_operativo_misional','id_rom_actividad'], 'default', 'value' => null],
            [['estado', 'id_reporte_operativo_misional','sesion_actividad','id_rom_actividad','nro_semana'], 'integer'],
            [['id_reporte_operativo_misional'], 'exist', 'skipOnError' => true, 'targetClass' => IsaReporteOperativoMisional::className(), 'targetAttribute' => ['id_reporte_operativo_misional' => 'id']],
            [['id_rom_actividad'], 'exist', 'skipOnError' => true, 'targetClass' => IsaRomActividades::className(), 'targetAttribute' => ['id_rom_actividad' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Parametro::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_desde' => 'Fecha Desde',
            'fecha_hasta' => 'Fecha Hasta',
            'estado_actividad' => 'Estado Actividad',
            'id_rom_actividad' => 'Id Rom Actividad',
            'estado' => 'Estado',
            'id_reporte_operativo_misional' => 'Id Reporte Operativo Misional',
            'sesion_actividad' => 'Nombre o título de la actividad o encuentro',
            'nro_semana' => 'Número de semana',
        ];
    }
}
