<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documentos_curriculum_ieo".
 *
 * @property string $id
 * @property string $ruta
 * @property string $id_tipo_documento
 * @property string $id_instituciones
 * @property string $estado
 *
 * @property Estados $estado0
 * @property Instituciones $instituciones
 * @property TipoDocumentos $tipoDocumento
 */
class DocumentosCurriculumIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documentos_curriculum_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruta', 'id_tipo_documento', 'id_instituciones', 'estado'], 'required'],
            [['id_tipo_documento', 'id_instituciones', 'estado'], 'default', 'value' => null],
            [['id_tipo_documento', 'id_instituciones', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_instituciones'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_instituciones' => 'id']],
            [['id_tipo_documento'], 'exist', 'skipOnError' => true, 'targetClass' => TiposDocumentos::className(), 'targetAttribute' => ['id_tipo_documento' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ruta' => 'Ruta',
            'id_tipo_documento' => 'Tipo Documento',
            'id_instituciones' => 'Instituciones',
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
    public function getInstituciones()
    {
        return $this->hasOne(Instituciones::className(), ['id' => 'id_instituciones']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDocumento()
    {
        return $this->hasOne(TipoDocumentos::className(), ['id' => 'id_tipo_documento']);
    }
}
