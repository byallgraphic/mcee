<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.semanas".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $fecha_inicio
 * @property string $fecha_finalizacion
 * @property string $fecha_cierre
 * @property string $estado
 * @property string $id_ciclo
 *
 * @property GcBitacora $bitacora
 */
class GcSemanas extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.semanas';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion'], 'string'],
            [['fecha_inicio', 'fecha_finalizacion', 'fecha_cierre'], 'safe'],
            [['estado', 'id_ciclo'], 'required'],
            [['estado', 'id_ciclo'], 'default', 'value' => null],
            [['estado', 'id_ciclo'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 				=> 'ID',
            'descripcion' 		=> 'Descripción de la semana',
            'fecha_inicio' 		=> 'Fecha de inicio',
            'fecha_finalizacion'=> 'Fecha de finalización',
            'fecha_cierre' 		=> 'Fecha de cierre del momento',
            'estado' 			=> 'Estado',
            'id_ciclo' 			=> 'Ciclo',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBitacora()
    {
        return $this->hasOne(GcBitacora::className(), ['id' => 'id_bitacora']);
    }
}
