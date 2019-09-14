<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.det_misional_artistica_x_actividad".
 *
 * @property string $id
 * @property string $estado
 * @property string $id_actividad
 * @property string $id_det_artistica_misional
 * @property string $estado_actual
 * @property string $logros
 * @property string $fortalezas
 * @property string $debilidades
 * @property string $retos
 * @property string $alarmas
 */
class IsaDetMisionalArtisticaXActividad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.det_misional_artistica_x_actividad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'id_actividad', 'id_det_artistica_misional','estado_actual','logros','fortalezas','debilidades','retos','alarmas'], 'required'],
            [['estado', 'id_actividad', 'id_det_artistica_misional'], 'default', 'value' => null],
            [['estado', 'id_actividad', 'id_det_artistica_misional'], 'integer'],
            [['estado_actual', 'logros', 'fortalezas', 'debilidades', 'retos', 'alarmas'], 'string'],
            [['id_actividad'], 'exist', 'skipOnError' => true, 'targetClass' => IsaActividadesArtisticas::className(), 'targetAttribute' => ['id_actividad' => 'id']],
            [['id_det_artistica_misional'], 'exist', 'skipOnError' => true, 'targetClass' => IsaDetArtisticaMisional::className(), 'targetAttribute' => ['id_det_artistica_misional' => 'id']],
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
            'estado' => 'Estado',
            'id_actividad' => 'Id Actividad',
            'id_det_artistica_misional' => 'Id Det Artistica Misional',
            'estado_actual' => 'Estado Actual',
            'logros' => 'Logros',
            'fortalezas' => 'Fortalezas',
            'debilidades' => 'Debilidades',
            'retos' => 'Retos',
            'alarmas' => 'Alarmas',
        ];
    }
}
