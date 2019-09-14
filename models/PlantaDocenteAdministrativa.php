<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "planta_docente_administrativa".
 *
 * @property int $id
 * @property string $descripcion
 * @property int $tipo_documento_id
 * @property string $ruta
 * @property int $estado
 *
 * @property Estados $estado0
 * @property TiposDocumentos $tipoDocumento
 */
class PlantaDocenteAdministrativa extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'planta_docente_administrativa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'ruta'], 'string'],
            [['tipo_documento_id', 'estado'], 'default', 'value' => null],
            [['tipo_documento_id', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['tipo_documento_id'], 'exist', 'skipOnError' => true, 'targetClass' => TiposDocumentos::className(), 'targetAttribute' => ['tipo_documento_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'tipo_documento_id' => 'Tipo Documento',
            'ruta' => 'Ruta',
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
    public function getTipoDocumento()
    {
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'tipo_documento_id']);
    }
}
