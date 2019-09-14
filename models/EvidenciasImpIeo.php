<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.evidencias_imp_ieo".
 *
 * @property int $id
 * @property int $implementacion_ieo_id
 * @property string $producto_acuerdo
 * @property string $resultado_actividad
 * @property string $acta
 * @property string $listado
 * @property string $fotografias
 * @property string $avance_formula
 * @property string $avance_ruta_gestion
 */
class EvidenciasImpIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.evidencias_imp_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['implementacion_ieo_id'], 'default', 'value' => null],
            [['implementacion_ieo_id'], 'integer'],
            [['producto_acuerdo', 'resultado_actividad', 'acta', 'listado', 'fotografias', 'avance_formula', 'avance_ruta_gestion'], 'string'],
            [['implementacion_ieo_id'], 'exist', 'skipOnError' => true, 'targetClass' => ImplementacionIeo::className(), 'targetAttribute' => ['implementacion_ieo_id' => 'id']],
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
            'producto_acuerdo' => 'Producto Acuerdo',
            'resultado_actividad' => 'Resultado Actividad',
            'acta' => 'Acta',
            'listado' => 'Listado',
            'fotografias' => 'Fotografias',
            'avance_formula' => 'Avance Formula',
            'avance_ruta_gestion' => 'Avance Ruta Gestion',
        ];
    }
}
