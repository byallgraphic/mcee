<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.actividades_ise".
 *
 * @property int $id
 * @property int $informe_semanal_ejecucion_id
 * @property string $nombre
 * @property int $estado
 * @property string $actividad_1
 * @property int $actividad_1_porcentaje
 * @property string $actividad_2
 * @property int $actividad_2_porcentaje
 * @property string $actividad_3
 * @property int $actividad_3_porcentaje
 * @property int $avance_sede
 * @property int $avance_ieo
 * @property int $id_proyecto
 * @property int $id_sede
 */
class EcActividadesIse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.actividades_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['informe_semanal_ejecucion_id', 'estado', 'actividad_1_porcentaje', 'actividad_2_porcentaje', 'actividad_3_porcentaje', 'avance_sede', 'avance_ieo', 'id_proyecto', 'id_sede'], 'default', 'value' => null],
            //[['informe_semanal_ejecucion_id', 'estado', 'actividad_1_porcentaje', 'actividad_2_porcentaje', 'actividad_3_porcentaje', 'avance_sede', 'avance_ieo', 'id_proyecto', 'id_sede'], 'integer'],
            [['nombre', 'actividad_1', 'actividad_2', 'actividad_3'], 'string'],
            [['actividad_1', 'actividad_2', 'actividad_3', 'actividad_1_porcentaje', 'actividad_2_porcentaje', 'actividad_3_porcentaje', 'avance_sede', 'avance_ieo'], 'required'],
            [['informe_semanal_ejecucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => InformeSemanalEjecucionIse::className(), 'targetAttribute' => ['informe_semanal_ejecucion_id' => 'id']],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => EcProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'informe_semanal_ejecucion_id' => 'Informe Semanal Ejecucion ID',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
            'actividad_1' => 'Actividad 1',
            'actividad_1_porcentaje' => 'Actividad 1 %',
            'actividad_2' => 'Actividad 2',
            'actividad_2_porcentaje' => 'Actividad 2 %',
            'actividad_3' => 'Actividad 3',
            'actividad_3_porcentaje' => 'Actividad 3 %',
            'avance_sede' => 'Avance Sede %',
            'avance_ieo' => 'Avance Ieo %',
            'id_proyecto' => 'Id Proyecto',
            'id_sede' => 'Id Sede',
        ];
    }
}
