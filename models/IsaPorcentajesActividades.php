<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.porcentajes_actividades".
 *
 * @property string $id
 * @property string $total_sesiones
 * @property string $avance_sede
 * @property string $avance_ieo
 * @property string $seguimiento_actividades
 * @property string $evaluacion_actividades
 * @property string $id_seguimiento_proceso
 * @property string $estado
 * @property string $id_rom_actividades
 */
class IsaPorcentajesActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.porcentajes_actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total_sesiones', 'avance_sede', 'avance_ieo', 'seguimiento_actividades', 'evaluacion_actividades', 'id_seguimiento_proceso', 'estado', 'id_rom_actividades'], 'required'],
            [['total_sesiones', 'avance_sede', 'avance_ieo', 'seguimiento_actividades', 'evaluacion_actividades'], 'string'],
            [['id_seguimiento_proceso', 'estado', 'id_rom_actividades'], 'default', 'value' => null],
            [['id_seguimiento_proceso', 'estado', 'id_rom_actividades'], 'integer'],
            [['id_rom_actividades'], 'exist', 'skipOnError' => true, 'targetClass' => IsaRomActividades::className(), 'targetAttribute' => ['id_rom_actividades' => 'id']],
            [['id_seguimiento_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => IsaSeguimientoProceso::className(), 'targetAttribute' => ['id_seguimiento_proceso' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'total_sesiones' => 'Total Sesiones Realizadas',
            'avance_sede' => 'Avance Sede',
            'avance_ieo' => 'Avance Ieo',
            'seguimiento_actividades' => 'Seguimiento Actividades',
            'evaluacion_actividades' => 'Evaluacion Actividades',
            'id_seguimiento_proceso' => 'Id Seguimiento Proceso',
            'estado' => 'Estado',
            'id_rom_actividades' => 'Id Rom Actividades',
        ];
    }
}
