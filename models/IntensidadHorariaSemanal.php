<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "intensidad_horaria_semanal".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_tipos_documentos
 * @property string $ruta
 * @property string $estado
 *
 * @property Estados $estado0
 * @property TiposDocumentos $tiposDocumentos
 */
class IntensidadHorariaSemanal extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'intensidad_horaria_semanal';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'ruta'], 'string'],
            [['id_tipos_documentos', 'estado'], 'default', 'value' => null],
            [['id_tipos_documentos', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
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
            'ruta' => 'Archivo',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Estados::className(), ['id' => 'estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposDocumentos()
    {
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'id_tipos_documentos']);
    }
}
