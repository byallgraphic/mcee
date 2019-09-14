<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "actividades_ieo".
 *
 * @property int $id
 * @property string $nombre
 * @property int $plan_accion_id
 * @property string $estado
 *
 * @property PlanAccion $planAccion
 * @property TiposCantidadPoblacion[] $tiposCantidadPoblacions
 */
class ActividadesIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.actividades_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre'], 'string'],
            [['plan_accion_id', 'estado'], 'default', 'value' => null],
            [['plan_accion_id', 'estado'], 'integer'],
            [['plan_accion_id'], 'exist', 'skipOnError' => true, 'targetClass' => PlanAccion::className(), 'targetAttribute' => ['plan_accion_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'plan_accion_id' => 'Plan Accion ID',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlanAccion()
    {
        return $this->hasOne(PlanAccion::className(), ['id' => 'plan_accion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTiposCantidadPoblacions()
    {
        return $this->hasMany(TiposCantidadPoblacion::className(), ['actividad_id' => 'id']);
    }
}
