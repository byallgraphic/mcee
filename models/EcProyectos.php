<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.proyectos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_informe_planeacion_ieo
 * @property string $horario
 * @property bool $estado
 */
class EcProyectos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.proyectos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'horario'], 'string'],
            [['id_informe_planeacion_ieo'], 'default', 'value' => null],
            [['id_informe_planeacion_ieo'], 'integer'],
            [['estado'], 'boolean'],
            [['id_informe_planeacion_ieo'], 'exist', 'skipOnError' => true, 'targetClass' => EcInformePlaneacionIeo::className(), 'targetAttribute' => ['id_informe_planeacion_ieo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'id_informe_planeacion_ieo' => 'Id Informe Planeacion Ieo',
            'horario' => 'Horario',
            'estado' => 'Estado',
        ];
    }
}
