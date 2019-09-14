<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rom.evidencias_rom".
 *
 * @property int $id
 * @property int $id_actividad_rom
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
 * @property int $estado
 */
class RomEvidenciasRom extends \yii\db\ActiveRecord
{
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
            [['id_actividad_rom', 'cantidad', 'estado'], 'default', 'value' => null],
            [['id_actividad_rom', 'cantidad', 'estado'], 'integer'],
            [['actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'vidoes', 'otros_productos', 'archivos_enviados_entregados'], 'string'],
            [['fecha_entrega_envio'], 'safe'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_actividad_rom'], 'exist', 'skipOnError' => true, 'targetClass' => RomActividadesRom::className(), 'targetAttribute' => ['id_actividad_rom' => 'id']],
			[['id_actividad_rom','actas','reportes','listados','plan_trabajo','formato_seguimiento','formato_evaluacion','vidoes','otros_productos','cantidad','archivos_enviados_entregados','fecha_entrega_envio','estado','fotografias'], 'required'],
	   ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividad_rom' => 'Id Actividad Rom',
            'actas' => 'Actas',
            'reportes' => 'Reportes',
            'listados' => 'Listados',
            'plan_trabajo' => 'Plan Trabajo',
            'formato_seguimiento' => 'Formato Seguimiento',
            'formato_evaluacion' => 'Formato Evaluación',
            'fotografias' => 'Fotografías',
            'vidoes' => 'Vidoes',
            'otros_productos' => 'Otros Productos',
            'cantidad' => 'Cantidad',
            'archivos_enviados_entregados' => 'Archivos enviados o entregados a:',
            'fecha_entrega_envio' => 'Fecha Entrega Envío',
            'estado' => 'Estado',
        ];
    }
}
