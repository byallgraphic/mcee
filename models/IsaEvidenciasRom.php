<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.evidencias_rom".
 *
 * @property int $id
 * @property string $id_rom_actividad
 * @property string $actas
 * @property string $reportes
 * @property string $listados
 * @property string $plan_trabajo
 * @property string $formato_seguimiento
 * @property string $formato_evaluacion
 * @property string $fotografias
 * @property string $vidoes
 * @property string $otros_productos
 * @property int $cantidad
 * @property string $archivos_enviados_entregados
 * @property string $fecha_entrega_envio
 * @property string $estado
 * @property string $id_reporte_operativo_misional
 */
class IsaEvidenciasRom extends \yii\db\ActiveRecord
{
	
	
	public $archivo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.evidencias_rom';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id_rom_actividad', 'actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos', 'cantidad', 'archivos_enviados_entregados', 'fecha_entrega_envio', 'estado', 'id_reporte_operativo_misional'], 'required'],
            [['id_rom_actividad', 'cantidad', 'estado', 'id_reporte_operativo_misional'], 'required'],
            [['id_rom_actividad', 'cantidad', 'estado', 'id_reporte_operativo_misional'], 'default', 'value' => null],
            [['id_rom_actividad', 'cantidad', 'estado', 'id_reporte_operativo_misional'], 'integer'],
            [['actas','reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos', 'archivos_enviados_entregados'], 'string'],
            [['fecha_entrega_envio'], 'safe'],
			[['archivo'], 'file', 'maxSize' => null, 'maxFiles' => null ],
            [['id_reporte_operativo_misional'], 'exist', 'skipOnError' => true, 'targetClass' => IsaReporteOperativoMisional::className(), 'targetAttribute' => ['id_reporte_operativo_misional' => 'id']],
            [['id_rom_actividad'], 'exist', 'skipOnError' => true, 'targetClass' => IsaRomActividades::className(), 'targetAttribute' => ['id_rom_actividad' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_rom_actividad' => 'Id Rom Actividad',
            'actas' => 'Actas',
            'reportes' => 'Reportes',
            'listados' => 'Listados',
            'plan_trabajo' => 'Plan Trabajo',
            'formato_seguimiento' => 'Formato Seguimiento',
            'formato_evaluacion' => 'Formato Evaluacion',
            'fotografias' => 'Fotografias',
            'vidoes' => 'Vidoes',
            'otros_productos' => 'Otros Productos',
            'cantidad' => 'Cantidad',
            'archivos_enviados_entregados' => 'Archivos enviados o entregados a:',
            'fecha_entrega_envio' => 'Fecha Entrega Envio',
            'estado' => 'Estado',
            'id_reporte_operativo_misional' => 'Id Reporte Operativo Misional',
            'archivo' => 'archivo',
        ];
    }
}
