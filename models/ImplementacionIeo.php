<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.implementacion_ieo".
 *
 * @property int $id
 * @property int $institucion_id
 * @property int $sede_id
 * @property int $zona_educativa
 * @property string $comuna
 * @property string $barrio
 * @property string $profesional_cargo
 * @property string $horario_trabajo
 * @property int $estado
 * @property int $id_tipo_informe
 */
class ImplementacionIeo extends \yii\db\ActiveRecord
{
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.implementacion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institucion_id', 'sede_id', 'zona_educativa', 'estado', 'id_tipo_informe'], 'default', 'value' => null],
            [['institucion_id', 'sede_id', 'zona_educativa', 'estado', 'id_tipo_informe'], 'integer'],
            [['comuna', 'barrio', 'profesional_cargo', 'horario_trabajo'], 'string'],
            [['comuna', 'profesional_cargo', 'horario_trabajo', 'zona_educativa'], 'required'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_id' => 'id']],
            [['zona_educativa'], 'exist', 'skipOnError' => true, 'targetClass' => ZonasEducativas::className(), 'targetAttribute' => ['zona_educativa' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institucion_id' => 'Institución',
            'sede_id' => 'Sede',
            'zona_educativa' => 'Zona Educativa',
            'comuna' => 'Comuna',
            'barrio' => 'Barrio',
            'profesional_cargo' => 'Profesional Encargado',
            'horario_trabajo' => 'Horario fijo de trabajo con los actores de la IEO',
            'estado' => 'Estado',
            'id_tipo_informe' => 'Id Tipo Informe',
        ];
    }
}
