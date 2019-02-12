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
 * @property string $fehca_inicio
 * @property string $fecha_fin
 */
class InformeSemanalEjecucionIse extends \yii\db\ActiveRecord
{
    public $nombre_institucion;

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
            [['institucion_id', 'sede_id', 'proyecto_id', 'estado', 'id_tipo_informe'], 'default', 'value' => null],
            [['institucion_id', 'sede_id', 'proyecto_id', 'estado', 'id_tipo_informe'], 'integer'],
            [['fehca_inicio', 'fecha_fin'], 'safe'],
            [['fehca_inicio', 'fecha_fin'], 'required'],
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
            'institucion_id' => 'Institucion ID',
            'nombre_institucion' => 'Institución',
            'sede_id' => 'Sede ID',
            'proyecto_id' => 'Proyecto ID',
            'estado' => 'Estado',
            'id_tipo_informe' => 'Id Tipo Informe',
            'fehca_inicio' => 'Fehca inicio',
            'fecha_fin' => 'Fecha fin',
        ];
    }
}
