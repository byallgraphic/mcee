<?php

/**********
Versión: 001
Fecha: 2018-10-03
Desarrollador: Edwin MG
Descripción: Modelo Documentos Aliados
---------------------------------------
*/

namespace app\models;

use Yii;

/**
 * This is the model class for table "documentos_aliados".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $estado
 * @property string $id_institucion
 * @property string $ruta
 * @property string $nombre
 * @property string $tipo_documento
 *
 * @property Estados $estado0
 * @property Instituciones $institucion
 * @property TiposDocumentos $nombre0
 */
class DocumentosAliados extends \yii\db\ActiveRecord
{
	public $file;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'documentos_aliados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
			[['file'], 'file', 'maxSize' => 1024*1024*2 ],
            [['descripcion', 'ruta', 'tipo_documento'], 'string'],
            [['estado', 'id_institucion', 'nombre'], 'default', 'value' => null],
            [['estado', 'id_institucion', 'nombre'], 'integer'],
            [['id_institucion', 'nombre','tipo_documento'], 'required'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['nombre'], 'exist', 'skipOnError' => true, 'targetClass' => TiposDocumentos::className(), 'targetAttribute' => ['nombre' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 			=> 'ID',
            'descripcion' 	=> 'Descripción',
            'estado' 		=> 'Estado',
            'id_institucion'=> 'Institución',
            'ruta' 			=> 'Ruta',
            'nombre' 		=> 'Nombre',
            'tipo_documento'=> 'Tipo de Documento',
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
    public function getInstitucion()
    {
        return $this->hasOne(Instituciones::className(), ['id' => 'id_institucion']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNombre0()
    {
        return $this->hasOne(TiposDocumentos::className(), ['id' => 'nombre']);
    }
}
