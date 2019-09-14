<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.imp_ops".
 *
 * @property int $id
 * @property int $id_actividad_ops
 * @property string $semana_1
 * @property string $semana_2
 * @property string $semana_3
 * @property string $semana_4
 * @property string $resumen
 */
class CbacImpOps extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.imp_ops';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividad_ops'], 'default', 'value' => null],
            [['id_actividad_ops'], 'integer'],
            [['semana_1', 'semana_2', 'semana_3', 'semana_4', 'resumen'], 'string'],
            [['id_actividad_ops'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadOps::className(), 'targetAttribute' => ['id_actividad_ops' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_actividad_ops' => 'Id Actividad Ops',
            'semana_1' => 'Semana 1',
            'semana_2' => 'Semana 2',
            'semana_3' => 'Semana 3',
            'semana_4' => 'Semana 4',
            'resumen' => 'Resumen de Logros ',
        ];
    }
}
