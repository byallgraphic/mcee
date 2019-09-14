<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.productos_imp_ieo".
 *
 * @property int $id
 * @property int $implementacion_ieo_id
 * @property string $informe_acompañamiento
 * @property string $trazabilidad
 * @property string $formnulacion_sistemactizacion
 * @property string $ruta_gestion
 * @property string $presentacion_resultados
 */
class ProductosImpIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.productos_imp_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['implementacion_ieo_id'], 'default', 'value' => null],
            [['implementacion_ieo_id'], 'integer'],
            [['informe_acompañamiento', 'trazabilidad', 'formnulacion_sistemactizacion', 'ruta_gestion', 'presentacion_resultados'], 'string'],
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
            'informe_acompañamiento' => 'Informe Acompañamiento',
            'trazabilidad' => 'Trazabilidad',
            'formnulacion_sistemactizacion' => 'Formnulacion Sistemactizacion',
            'ruta_gestion' => 'Ruta Gestion',
            'presentacion_resultados' => 'Presentacion Resultados',
        ];
    }
}
