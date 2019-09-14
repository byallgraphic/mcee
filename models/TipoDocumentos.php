<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tipo_documentos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 *
 * @property DocumentosCurriculumIeo[] $documentosCurriculumIeos
 * @property DocumentosPresupuesto[] $documentosPresupuestos
 * @property Estados $estado0
 */
class TipoDocumentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipo_documentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'estado'], 'required'],
            [['estado'], 'default', 'value' => null],
            [['estado'], 'integer'],
            [['descripcion'], 'string', 'max' => 100],
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
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentosCurriculumIeos()
    {
        return $this->hasMany(DocumentosCurriculumIeo::className(), ['id_tipo_documento' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocumentosPresupuestos()
    {
        return $this->hasMany(DocumentosPresupuesto::className(), ['id_tipo_documento' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Estados::className(), ['id' => 'estado']);
    }
}
