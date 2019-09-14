<?php

/**********
Versión: 001
Fecha: 2018-10-01
Desarrollador: Edwin MG
Descripción: Modelo Documentos Gestion Comunitaria
---------------------------------------
*/

namespace app\models;

use Yii;

/**
 * This is the model class for table "documentos_gestion_comunitaria".
 *
 * @property string $id
 * @property string $ruta
 * @property string $id_tipo_documento
 * @property string $id_instituciones
 * @property string $estado
 *
 * @property Estados $estado0
 * @property Instituciones $instituciones
 * @property TiposDocumentos $tipoDocumento
 */
class DocumentosGestionComunitaria extends \yii\db\ActiveRecord
{
	public $file;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documentos_gestion_comunitaria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['file'], 'file', 'maxSize' => 1024*1024*2 ],
            [['ruta'], 'string'],
            [['descripcion'], 'string'],
            [['id_tipo_documento', 'id_instituciones', 'estado'], 'default', 'value' => null],
            [['id_tipo_documento', 'id_instituciones', 'estado'], 'integer'],
            [['id_tipo_documento'], 'required'],
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
            'id' 				=> 'ID',
            'ruta' 				=> 'Ruta',
            'id_tipo_documento' => 'Tipo de Documento',
            'id_instituciones' 	=> 'Institución',
            'estado' 			=> 'Estado',
            'descripcion' 		=> 'Descripción',
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
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'id_tipo_documento']);
    }
}
