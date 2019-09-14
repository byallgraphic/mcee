<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.producto_implementacion_ieo".
 *
 * @property int $id
 * @property int $implementacion_ieo_id
 * @property string $informe_acompanamiento
 * @property string $trazabilidad_plan_accion
 * @property string $formulacion
 * @property string $ruta_gestion
 * @property string $resultados_procesos
 * @property int $estado
 */
class ProductoImplementacionIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.producto_implementacion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['implementacion_ieo_id', 'estado'], 'default', 'value' => null],
            [['implementacion_ieo_id', 'estado'], 'integer'],
            [['informe_acompanamiento', 'trazabilidad_plan_accion', 'formulacion', 'ruta_gestion', 'resultados_procesos'], 'string'],
            [['implementacion_ieo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImplementacionIeo::className(), 'targetAttribute' => ['implementacion_ieo_id' => 'id']],
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
            'implementacion_ieo_id' => 'Implementacion Ieo ID',
            'informe_acompanamiento' => 'Informe Acompanamiento',
            'trazabilidad_plan_accion' => 'Trazabilidad Plan Accion',
            'formulacion' => 'Formulacion',
            'ruta_gestion' => 'Ruta Gestion',
            'resultados_procesos' => 'Resultados Procesos',
            'estado' => 'Estado',
        ];
    }
}
