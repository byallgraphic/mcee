<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.momento4".
 *
 * @property string $id
 * @property string $id_bitacora
 * @property string $url
 * @property string $estado
 */
class GcMomento4 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.momento4';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_bitacora', 'url', 'estado'], 'required'],
            [['id_bitacora', 'estado'], 'default', 'value' => null],
            [['id_bitacora', 'estado'], 'integer'],
            [['url'], 'string', 'max' => 100],
            [['id_bitacora'], 'exist', 'skipOnError' => true, 'targetClass' => GcBitacora::className(), 'targetAttribute' => ['id_bitacora' => 'id']],
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
            'id_bitacora' => 'Id Bitacora',
            'url' => 'Url',
            'estado' => 'Estado',
        ];
    }
}
