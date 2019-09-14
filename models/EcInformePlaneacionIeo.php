<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_planeacion_ieo".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $codigo_dane
 * @property string $zona_educativa
 * @property string $id_comuna
 * @property string $id_barrio
 * @property string $fase
 * @property string $fecha_reporte
 */
class EcInformePlaneacionIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_planeacion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'codigo_dane'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'codigo_dane'], 'integer'],
            [['id_institucion', 'fase','zona_educativa','fecha_reporte','comuna'], 'required'],
            [['zona_educativa', 'fase','barrio'], 'string'],
            [['fecha_reporte'], 'safe'],
            [['id_sede','id_tipo_informe'], 'required'],
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
            'id' => 'ID',
            'id_institucion' => 'Institución',
            'id_sede' => 'Sede',
            'id_tipo_informe' => 'Tipo Informe',
            'codigo_dane' => 'Código Dane',
            'zona_educativa' => 'Zona Educativa',
            'fase' => 'Fase',
            'fecha_reporte' => 'Fecha Reporte',
            'comuna' => 'comuna',
            'barrio' => 'barrio',
        ];
    }
}
