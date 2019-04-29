<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%ge.reporte_actividades}}".
 *
 * @property int $id
 * @property int $id_seguimiento_operador
 * @property string $objetivo
 * @property string $actividad
 * @property string $descripcion
 * @property string $poblacion_beneficiaria
 * @property string $num_participantes
 * @property string $duracion
 * @property string $logros
 * @property string $dificultades
 * @property string $quienes
 *
 */
class GeReporteActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%ge.reporte_actividades}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'default', 'value' => null],
            [['id', 'id_seguimiento_operador'], 'integer'],
            [['objetivo', 'actividad', 'descripcion', 'poblacion_beneficiatia', 'num_participantes', 'duracion', 'logros', 'dificultades', 'quienes'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'objetivo' => 'Objetivo al que reporta',
            'actividad' => 'Actividad que reporta',
            'descripcion' => 'Descripción de la Actividad',
            'poblacion_beneficiatia' => 'Población Beneficiaria',
            'num_participantes' => 'Número de participantes',
            'duracion' => 'Duración de la actividad',
            'logros' => 'Logros alcanzados',
            'dificultades' => 'Dificultades presentadas',
        ];
    }
}
