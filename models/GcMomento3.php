<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.momento3".
 *
 * @property string $id
 * @property string $id_semana
 * @property string $id_proposito_momento1
 * @property string $nivel_avance
 * @property string $justificacion_avance
 * @property string $observaciones_prof
 * @property string $estado
 */
class GcMomento3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.momento3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_semana', 'id_proposito_momento1', 'justificacion_avance', 'observaciones_prof'], 'required'],
            [['id_semana', 'id_proposito_momento1', 'nivel_avance', 'estado'], 'default', 'value' => null],
            [['id_semana', 'id_proposito_momento1', 'nivel_avance', 'estado'], 'integer'],
            [['justificacion_avance', 'observaciones_prof'], 'string', 'max' => 1000],
            [['id_proposito_momento1'], 'exist', 'skipOnError' => true, 'targetClass' => GcPropositosMomento1::className(), 'targetAttribute' => ['id_proposito_momento1' => 'id']],
            [['id_semana'], 'exist', 'skipOnError' => true, 'targetClass' => GcSemanas::className(), 'targetAttribute' => ['id_semana' => 'id']],
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
            'id_semana' => 'Id Semana',
            'id_proposito_momento1' => 'Id Proposito Momento1',
            'nivel_avance' => 'Nivel Avance',
            'justificacion_avance' => 'Justificacion Avance',
            'observaciones_prof' => 'Observaciones Prof',
            'estado' => 'Estado',
        ];
    }
}
