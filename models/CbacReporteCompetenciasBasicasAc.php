<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.reporte_competencias_basicas_ac".
 *
 * @property int $id
 * @property int $id_institucion
 * @property int $id_sedes
 * @property int $estado
 */
class CbacReporteCompetenciasBasicasAc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.reporte_competencias_basicas_ac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sedes', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sedes', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sedes'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sedes' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_institucion' => 'Institución',
            'id_institucion' => 'Institución',
            'id_sedes' => 'Sede',
            'estado' => 'Estado',
        ];
    }
}
