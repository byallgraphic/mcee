<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_evaluacion".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_tipos_documentos
 * @property string $ruta
 * @property string $estado
 *
 * @property TiposDocumentos $tiposDocumentos
 */
class PlanEvaluacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_evaluacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'ruta'], 'string'],
            [['ruta'], 'required'],
            [['id_tipos_documentos', 'estado'], 'default', 'value' => null],
            [['id_tipos_documentos', 'estado'], 'integer'],
            [['id_tipos_documentos'], 'exist', 'skipOnError' => true, 'targetClass' => TiposDocumentos::className(), 'targetAttribute' => ['id_tipos_documentos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripción',
            'id_tipos_documentos' => 'Tipos Documentos',
            'ruta' => 'Ruta',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposDocumentos()
    {
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'id_tipos_documentos']);
    }
}
