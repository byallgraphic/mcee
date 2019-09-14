<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_isa.actividad_is_isa".
 *
 * @property int $id
 * @property int $id_actividades_is_isa
 * @property string $nombre
 * @property string $sesiones_realizadas
 * @property int $porcentaje
 * @property string $sesiones_aplazadas
 * @property string $sesiones_canceladas
 * @property int $estado
 */
class IsIsaActividadIsIsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.actividad_is_isa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividades_is_isa', 'porcentaje', 'estado'], 'default', 'value' => null],
            [['id_actividades_is_isa', 'porcentaje', 'estado'], 'integer'],
            [['nombre', 'sesiones_realizadas', 'sesiones_aplazadas', 'sesiones_canceladas'], 'string'],
            [['id_actividades_is_isa'], 'exist', 'skipOnError' => true, 'targetClass' => IsIsaActividadesIsIsa::className(), 'targetAttribute' => ['id_actividades_is_isa' => 'id']],
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
            'id_actividades_is_isa' => 'Id Actividades Is Isa',
            'nombre' => 'Nombre',
            'sesiones_realizadas' => 'Sesiones realizadas  (Sumatoria de actividades realizadas por semana)',
            'porcentaje' => 'Porcentaje Indique en la casilla el valor de porcentaje por actividad',
            'sesiones_aplazadas' => 'Sesiones aplazadas (Sumatoria de actividades aplazadas por semana)',
            'sesiones_canceladas' => 'Sesiones canceladas (Sumatoria de actividades canceladas por semana)',
            'estado' => 'Estado',
        ];
    }
}
