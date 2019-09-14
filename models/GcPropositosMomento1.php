<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.propositos_momento1".
 *
 * @property string $id
 * @property string $id_proposito
 * @property string $id_momento1
 */
class GcPropositosMomento1 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.propositos_momento1';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_proposito', 'id_momento1'], 'required'],
            [['id_proposito', 'id_momento1'], 'default', 'value' => null],
            [['id_proposito', 'id_momento1'], 'integer'],
            [['id_momento1'], 'exist', 'skipOnError' => true, 'targetClass' => GcMomento1::className(), 'targetAttribute' => ['id_momento1' => 'id']],
            [['id_proposito'], 'exist', 'skipOnError' => true, 'targetClass' => GcPropositos::className(), 'targetAttribute' => ['id_proposito' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_proposito' => 'Id Proposito',
            'id_momento1' => 'Id Momento1',
        ];
    }
}
