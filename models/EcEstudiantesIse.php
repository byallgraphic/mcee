<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.estudiantes_ise".
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
 * @property int $total
 * @property int $id_proyecto
 * @property int $estado
 * @property int $id_tipo_cantidad_poblacion
 * @property int $id_sede
 */
class EcEstudiantesIse extends \yii\db\ActiveRecord
{
    public $total;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.estudiantes_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11', 'total', 'id_proyecto', 'estado', 'id_tipo_cantidad_poblacion', 'id_sede'], 'default', 'value' => null],
            [['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11', 'total', 'id_proyecto', 'estado', 'id_tipo_cantidad_poblacion', 'id_sede'], 'integer'],
            [['grado_0', 'grado_1', 'grado_2', 'grado_3', 'grado_4', 'grado_5', 'grado_6', 'grado_7', 'grado_8', 'grado_9', 'grado_10', 'grado_11', 'total'], 'required'],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => EcProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['id_tipo_cantidad_poblacion'], 'exist', 'skipOnError' => true, 'targetClass' => EcTipoCantidadPoblacionIse::className(), 'targetAttribute' => ['id_tipo_cantidad_poblacion' => 'id']],
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
            'id_proyecto' => 'Id Proyecto',
            'estado' => 'Estado',
            'id_tipo_cantidad_poblacion' => 'Id Tipo Cantidad Poblacion',
            'id_sede' => 'Id Sede',
        ];
    }
}
