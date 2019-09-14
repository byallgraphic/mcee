<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.ciclos".
 *
 * @property string $id
 * @property string $fecha
 * @property string $descripcion
 * @property string $fecha_inicio
 * @property string $fecha_finalizacion
 * @property string $fecha_cierre
 * @property string $fecha_maxima_acceso
 * @property string $id_creador
 * @property string $estado
 */
class GcCiclos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.ciclos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha', 'fecha_inicio', 'fecha_finalizacion', 'fecha_cierre', 'fecha_maxima_acceso'], 'safe'],
            [['descripcion'], 'string'],
            [['fecha','fecha_inicio','fecha_finalizacion','fecha_cierre','fecha_maxima_acceso','id_creador', 'estado','descripcion'], 'required'],
            [['id_creador', 'estado'], 'default', 'value' => null],
            [['id_creador', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_creador'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_creador' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 					=> 'ID',
            'fecha' 				=> 'Fecha',
            'descripcion' 			=> 'Descripción',
            'fecha_inicio' 			=> 'Fecha de inicio',
            'fecha_finalizacion'	=> 'Fecha de finalización',
            'fecha_cierre' 			=> 'Fecha de cierre',
            'fecha_maxima_acceso' 	=> 'Fecha máxima de acceso',
            'id_creador' 			=> 'Creador',
            'estado' 				=> 'Estado',
        ];
    }
}
