<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.datos_basicos".
 *
 * @property int $id
 * @property string $profesional_campo
 * @property int $id_institucion
 * @property int $id_sede
 * @property string $fecha_diligenciamiento
 * @property int $estado
 * @property int $id_tipo_informe
 */
class EcDatosBasicos extends \yii\db\ActiveRecord
{
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
            [['id_institucion', 'id_sede', 'estado', 'id_tipo_informe'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado', 'id_tipo_informe'], 'integer'],

            [['id_institucion', 'id_sede', 'estado', 'id_tipo_informe', 'profesional_campo', 'fecha_diligenciamiento'], 'required'],
            [['fecha_diligenciamiento'], 'safe'],
            [['id_tipo_informe'], 'exist', 'skipOnError' => true, 'targetClass' => TipoInforme::className(), 'targetAttribute' => ['id_tipo_informe' => 'id']],
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
            'id' 					=> 'ID',
            'profesional_campo' 	=> 'Profesional campo',
            'id_institucion' 		=> 'Institución',
            'id_sede' 				=> 'Sede',
            'fecha_diligenciamiento'=> 'Fecha de diligenciamiento',
            'estado' 				=> 'Estado',
            'id_tipo_informe' 		=> 'Id Tipo Informe',
        ];
    }
}
