<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_planeacion_proyectos".
 *
 * @property string $id
 * @property string $id_informe_planeacion
 * @property string $id_proyecto
 * @property string $horario_de_trabajo_docentes
 * @property string $estado
 */
class EcInformePlaneacionProyectos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_planeacion_proyectos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_informe_planeacion', 'id_proyecto', 'horario_de_trabajo_docentes', 'estado'], 'required'],
            [['id', 'id_informe_planeacion', 'id_proyecto', 'estado'], 'default', 'value' => null],
            [['id', 'id_informe_planeacion', 'id_proyecto', 'estado'], 'integer'],
            [['horario_de_trabajo_docentes'], 'string', 'max' => 400],
            [['id'], 'unique'],
            [['id_informe_planeacion'], 'exist', 'skipOnError' => true, 'targetClass' => EcInformePlaneacionIeo::className(), 'targetAttribute' => ['id_informe_planeacion' => 'id']],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => EcProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
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
            'id_informe_planeacion' => 'Id Informe Planeacion',
            'id_proyecto' => 'Id Proyecto',
            'horario_de_trabajo_docentes' => 'Horario De Trabajo Docentes',
            'estado' => 'Estado',
        ];
    }
}
