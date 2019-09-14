<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "documentos_actividades_vinculacion".
 *
 * @property int $id
 * @property string $ruta
 * @property string $descripcion
 * @property int $id_tipo_documento
 * @property int $id_estado
 *
 * @property Estados $estado
 * @property TiposDocumentos $tipoDocumento
 */
class DocumentosActividadesVinculacion extends \yii\db\ActiveRecord
{
    
    public $file;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documentos_actividades_vinculacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruta', 'descripcion'], 'string'],
            [['id_tipo_documento', 'id_estado'], 'default', 'value' => null],
            [['id_tipo_documento', 'id_estado'], 'integer'],
            [['id_estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['id_estado' => 'id']],
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
            'descripcion' => 'Descripcion',
            'id_tipo_documento' => 'Tipo Documento',
            'id_estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado()
    {
        return $this->hasOne(Estados::className(), ['id' => 'id_estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoDocumento()
    {
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'id_tipo_documento']);
    }
}
