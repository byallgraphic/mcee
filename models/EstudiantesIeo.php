<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.estudiantes_ieo".
 *
 * @property int $id
 * @property int $id_tipo_cantidad_p
 * @property string $grado_0
 * @property string $grado_1
 * @property string $grado_2
 * @property string $grado_3
 * @property string $grado_4
 * @property string $grado_5
 * @property string $grado_6
 * @property string $grado_7
 * @property string $grado_8
 * @property string $grado_9
 * @property string $grado_10
 * @property string $grado_11
 * @property int $total
 */
class EstudiantesIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.estudiantes_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['total'], 'default', 'value' => null],
            [['total','id_ieo','id_actividad'], 'integer'],
            [['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11'], 'string'],
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
            'total' => 'Total',
            'id_ieo' => 'id_ieo',
            'id_actividad' => 'id_actividad',
        ];
    }
}
