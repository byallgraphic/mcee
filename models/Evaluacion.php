<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "evaluacion".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $ruta
 * @property string $estado
 * @property string $id_tipos_documentos
 *
 * @property TiposDocumentos $tiposDocumentos
 */
class Evaluacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'evaluacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_tipos_documentos'], 'required'],
            [['descripcion', 'ruta',], 'string'],
            [['id_tipos_documentos'], 'default', 'value' => null],
            [['id_tipos_documentos','estado'], 'integer'],
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
            'ruta' => 'Archivo',
            'estado' => 'Estado',
            'id_tipos_documentos' => 'Tipo Documento',
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
