<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.datos_basicos".
 *
 * @property string $id
 * @property string $profesional_campo
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $fecha_diligenciamiento
 * @property string $estado
 */
class EcDatosBasicosE extends \yii\db\ActiveRecord
{   
    public $ruta_archivo;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.datos_basicos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['profesional_campo', 'id_institucion', 'id_sede', 'fecha_diligenciamiento', 'estado'], 'required'],
            [['profesional_campo'], 'string'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha_diligenciamiento'], 'safe'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 						=> 'ID',
            'profesional_campo' 		=> 'Nombre Profesional de Campo',
            'id_institucion' 			=> 'Nombre de IEO',
            'id_sede' 					=> 'Nombre de SEDE',
            'fecha_diligenciamiento' 	=> 'Fecha Diligenciamiento',
            'estado' 					=> 'Estado',
        ];
    }
}
