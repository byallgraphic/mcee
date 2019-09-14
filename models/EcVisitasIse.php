<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.visitas_ise".
 *
 * @property int $id
 * @property int $informe_semanal_ejecucion_id
 * @property int $cantidad_visitas_realizadas
 * @property int $canceladas
 * @property int $visitas_fallidas
 * @property string $observaciones_evidencias
 * @property string $alarmas
 * @property string $logros
 * @property string $dificultades
 * @property int $id_proyecto
 * @property int $estado
 * @property int $id_sede
 */
class EcVisitasIse extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.visitas_ise';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['informe_semanal_ejecucion_id', 'cantidad_visitas_realizadas', 'canceladas', 'visitas_fallidas', 'id_proyecto', 'estado', 'id_sede'], 'default', 'value' => null],
            [['informe_semanal_ejecucion_id', 'cantidad_visitas_realizadas', 'canceladas', 'visitas_fallidas', 'id_proyecto', 'estado', 'id_sede'], 'integer'],
            [['cantidad_visitas_realizadas', 'canceladas', 'visitas_fallidas', 'observaciones_evidencias', 'alarmas', 'logros', 'dificultades'], 'required'],
            [['observaciones_evidencias', 'alarmas', 'logros', 'dificultades'], 'string'],
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
            'cantidad_visitas_realizadas' => 'Cantidad de visitas relizadas',
            'canceladas' => 'Canceladas',
            'visitas_fallidas' => 'Visitas fallidas',
            'observaciones_evidencias' => 'Observaciones sobre las evidencias',
            'alarmas' => 'Alarmas',
            'logros' => 'Logros',
            'dificultades' => 'Dificultades',
            'id_proyecto' => 'Id Proyecto',
            'estado' => 'Estado',
            'id_sede' => 'Id Sede',
        ];
    }
}
