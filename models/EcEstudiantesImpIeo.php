<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.estudiantes_imp_ieo".
 *
 * @property int $id
 * @property int $grado_0
 * @property int $grado_1
 * @property int $grado_2
 * @property int $grado_3
 * @property int $grado_4
 * @property int $grado_5
 * @property int $grado_6
 * @property int $grado_7
 * @property int $grado_8
 * @property int $grado_9
 * @property int $grado_10
 * @property int $grado_11
 * @property int $cantidad_poblacion_imp_ieo_id
 */
class EcEstudiantesImpIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.estudiantes_imp_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11', 'cantidad_poblacion_imp_ieo_id'], 'default', 'value' => null],
            [['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11', 'cantidad_poblacion_imp_ieo_id'], 'integer'],
            [['cantidad_poblacion_imp_ieo_id'], 'exist', 'skipOnError' => true, 'targetClass' => EcCantidadPoblacionImpIeo::className(), 'targetAttribute' => ['cantidad_poblacion_imp_ieo_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'grado_0' => 'Grado 0',
            'grado_1' => 'Grado 1',
            'grado_2' => 'Grado 2',
            'grado_3' => 'Grado 3',
            'grado_4' => 'Grado 4',
            'grado_5' => 'Grado 5',
            'grado_6' => 'Grado 6',
            'grado_7' => 'Grado 7',
            'grado_8' => 'Grado 8',
            'grado_9' => 'Grado 9',
            'grado_10' => 'Grado 10',
            'grado_11' => 'Grado 11',
            'cantidad_poblacion_imp_ieo_id' => 'Cantidad Poblacion Imp Ieo ID',
        ];
    }
}
