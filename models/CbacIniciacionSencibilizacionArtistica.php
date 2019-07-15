<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.iniciacion_sencibilizacion_artistica".
 *
 * @property int $id
 * @property int $id_institucion
 * @property int $id_sede
 * @property string $caracterizacion_si_no
 * @property string $caracterizacion_nombre
 * @property string $caracterizacion_fecha
 * @property string $caracterizacion_justificacion
 * @property int $estado
 */
class CbacIniciacionSencibilizacionArtistica extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.iniciacion_sencibilizacion_artistica';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['caracterizacion_si_no', 'caracterizacion_nombre', 'caracterizacion_justificacion'], 'string'],
            [['caracterizacion_fecha'], 'safe'],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
            //[['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_institucion' => 'Nombre Institución',
            'id_institucion' => 'Institución',
            'id_sede' => 'Sede',
            'caracterizacion_si_no' => 'Caracterización Si No',
            'caracterizacion_nombre' => 'Caracterización Nombre',
            'caracterizacion_fecha' => 'Caracterización Fecha',
            'caracterizacion_justificacion' => 'Caracterización Justificación',
            'estado' => 'Estado',
        ];
    }
}
