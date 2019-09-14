<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.evidencias_momento2".
 *
 * @property string $id
 * @property string $url
 * @property string $id_momento2
 * @property string $estado
 * @property string $id_planeacion_por_dia
 */
class GcEvidenciasMomento2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.evidencias_momento2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'id_momento2', 'estado'], 'required'],
            [['id_momento2', 'estado', 'id_planeacion_por_dia'], 'default', 'value' => null],
            [['id_momento2', 'estado', 'id_planeacion_por_dia'], 'integer'],
            [['url'], 'string', 'max' => 400],
            [['id_momento2'], 'exist', 'skipOnError' => true, 'targetClass' => GcMomento2::className(), 'targetAttribute' => ['id_momento2' => 'id']],
            [['id_planeacion_por_dia'], 'exist', 'skipOnError' => true, 'targetClass' => GcPlaneacionPorDia::className(), 'targetAttribute' => ['id_planeacion_por_dia' => 'id']],
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
            'url' => 'Url',
            'id_momento2' => 'Id Momento2',
            'estado' => 'Estado',
            'id_planeacion_por_dia' => 'Id Planeacion Por Dia',
        ];
    }
}
