<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividad_is_cac".
 *
 * @property int $id
 * @property int $id_actividades_is_cac
 * @property string $nombre
 * @property string $sesiones_realizadas
 * @property int $porcentaje
 * @property string $sesiones_aplazadas
 * @property string $sesiones_canceladas
 * @property int $estado
 */
class CbacActividadIsCac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividad_is_cac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividades_is_cac', 'porcentaje', 'estado'], 'default', 'value' => null],
            [['id_actividades_is_cac', 'porcentaje', 'estado'], 'integer'],
            [['nombre', 'sesiones_realizadas', 'sesiones_aplazadas', 'sesiones_canceladas'], 'string'],
            [['sesiones_realizadas', 'porcentaje', 'porcentaje', 'sesiones_aplazadas','sesiones_canceladas'],'required'],
            [['id_actividades_is_cac'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesIsCac::className(), 'targetAttribute' => ['id_actividades_is_cac' => 'id']],
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
            'id_actividades_is_cac' => 'Id Actividades Is Cac',
            'nombre' => 'Nombre',
            'sesiones_realizadas' => 'Sesiones realizadas  (Sumatoria de actividades realizadas por semana)',
            'porcentaje' => 'Porcentaje Indique en la casilla el valor de porcentaje por actividad',
            'sesiones_aplazadas' => 'Sesiones aplazadas (Sumatoria de actividades aplazadas por semana)',
            'sesiones_canceladas' => 'Sesiones canceladas (Sumatoria de actividades canceladas por semana)',
            'estado' => 'Estado',
        ];
    }
}
