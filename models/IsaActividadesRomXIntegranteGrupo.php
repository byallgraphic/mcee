<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.actividades_rom_x_integrante_grupo".
 *
 * @property int $id
 * @property string $duracion_sesion
 * @property string $logros
 * @property string $fortalezas
 * @property string $debilidades
 * @property string $alternativas
 * @property string $retos
 * @property string $articulacion
 * @property string $evaluacion
 * @property string $observaciones_generales
 * @property string $alarmas
 * @property string $justificacion_activiad_no_realizada
 * @property string $fecha_reprogramacion
 * @property string $diligencia
 * @property string $rol
 * @property string $fecha_diligencia
 * @property string $id_rom_actividad
 * @property string $estado
 * @property string $id_reporte_operativo_misional
 */
class IsaActividadesRomXIntegranteGrupo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.actividades_rom_x_integrante_grupo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['duracion_sesion', 'logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'articulacion', 'evaluacion', 'observaciones_generales', 'alarmas', 'justificacion_activiad_no_realizada', 'fecha_reprogramacion', 'diligencia', 'rol', 'fecha_diligencia', 'id_rom_actividad', 'estado', 'id_reporte_operativo_misional'], 'required'],
            [['duracion_sesion', 'logros', 'fortalezas', 'debilidades', 'alternativas', 'retos', 'articulacion', 'evaluacion', 'observaciones_generales', 'alarmas', 'justificacion_activiad_no_realizada', 'diligencia', 'rol', 'fecha_diligencia'], 'string'],
            [['fecha_reprogramacion'], 'safe'],
            [['id_rom_actividad', 'estado', 'id_reporte_operativo_misional'], 'default', 'value' => null],
            [['id_rom_actividad', 'estado', 'id_reporte_operativo_misional'], 'integer'],
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
            'duracion_sesion' => 'Duracion Sesion',
            'logros' => 'Logros',
            'fortalezas' => 'Fortalezas',
            'debilidades' => 'Debilidades',
            'alternativas' => 'Alternativas',
            'retos' => 'Retos',
            'articulacion' => 'Articulacion',
            'evaluacion' => 'Evaluacion',
            'observaciones_generales' => 'Observaciones Generales',
            'alarmas' => 'Alarmas',
            'justificacion_activiad_no_realizada' => 'Justificacion Activiad No Realizada',
            'fecha_reprogramacion' => 'Fecha Reprogramacion',
            'diligencia' => 'Diligencia',
            'rol' => 'Rol',
            'fecha_diligencia' => 'Fecha Diligencia',
            'id_rom_actividad' => 'Id Rom Actividad',
            'estado' => 'Estado',
            'id_reporte_operativo_misional' => 'Id Reporte Operativo Misional',
        ];
    }
}
