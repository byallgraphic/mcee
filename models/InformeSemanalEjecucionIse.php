<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_semanal_ejecucion_ise".
 *
 * @property int $id
 * @property int $institucion_id
 * @property int $sede_id
 * @property int $proyecto_id
 * @property int $estado
 * @property int $id_tipo_informe
 * @property string $fecha_fin
 * @property string $fecha_inicio
 * @property int $id_comuna
 * @property int $id_barrio
 */
class InformeSemanalEjecucionIse extends \yii\db\ActiveRecord
{
    public $nombre_institucion;
    public $id_sede;
    public $id_ieo;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_semanal_ejecucion_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institucion_id', 'sede_id', 'proyecto_id', 'estado', 'id_tipo_informe', 'id_comuna', 'id_barrio'], 'default', 'value' => null],
            [['institucion_id', 'sede_id', 'proyecto_id', 'estado', 'id_tipo_informe', 'id_comuna'], 'integer'],
            [['fecha_fin', 'fecha_inicio'], 'safe'],
            [['fecha_fin', 'fecha_inicio', 'id_comuna'], 'required'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
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
            'nombre_institucion' => 'Institución',
            'sede_id' => 'Sede',
            'proyecto_id' => 'Proyecto',
            'estado' => 'Estado',
            'id_tipo_informe' => 'Id Tipo Informe',
            'fecha_fin' => 'Fecha fin',
            'fecha_inicio' => 'Fecha inicio',
            'id_comuna' => 'Comuna',
            'id_barrio' => 'Barrio',
            'id_sede' => 'Sede'
        ];
    }
}
