<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.plan_misional_operativo".
 *
 * @property int $id
 * @property int $id_institucion
 * @property int $id_sede
 * @property string $caracterizacion_diagnostico
 * @property string $fecha_caracterizacion_
 * @property string $nombre_caracterizacion
 * @property string $caracterizacion_no_justificacion
 * @property int $estado
 */
class CbacPlanMisionalOperativo extends \yii\db\ActiveRecord
{
    public $institucion_nombre;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.plan_misional_operativo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['caracterizacion_diagnostico', 'nombre_caracterizacion', 'caracterizacion_no_justificacion'], 'string'],
            [['fecha_caracterizacion_'], 'safe'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombre_institucion' => 'Institución',
            'id' => 'ID',
            'id_institucion' => 'Institución',
            'id_sede' => 'Sede',
            'caracterizacion_diagnostico' => 'Caracterización',
            'fecha_caracterizacion_' => 'Fecha del documento',
            'nombre_caracterizacion' => 'Nombre del documento',
            'caracterizacion_no_justificacion' => 'Justificación',
            'estado' => 'Estado',
        ];
    }
}
