<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plan_de_area".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $ruta
 * @property string $estado
 * @property string $id_tipos_documentos
 *
 * @property TiposDocumentos $tiposDocumentos
 */
class PlanDeArea extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'plan_de_area';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'ruta'], 'string'],
            [['estado', 'id_tipos_documentos'], 'default', 'value' => null],
            [['estado', 'id_tipos_documentos'], 'integer'],
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
