<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.bitacora".
 *
 * @property string $id
 * @property string $id_ciclo
 * @property string $id_jefe
 * @property string $id_sede
 * @property string $observaciones
 * @property string $estado
 * @property string $jornada
 *
 * @property GcCiclos $ciclo
 * @property Personas $jefe
 * @property Sedes $sede
 * @property GcSemanas[] $semanas
 */
class GcBitacora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.bitacora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_ciclo', 'estado'], 'required'],
            [['id_ciclo', 'id_jefe', 'id_sede', 'estado', 'jornada'], 'default', 'value' => null],
            [['id_ciclo', 'id_jefe', 'id_sede', 'estado', 'jornada'], 'integer'],
            [['observaciones'], 'string'],
            [['id_ciclo'], 'exist', 'skipOnError' => true, 'targetClass' => GcCiclos::className(), 'targetAttribute' => ['id_ciclo' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['jornada'], 'exist', 'skipOnError' => true, 'targetClass' => Parametro::className(), 'targetAttribute' => ['jornada' => 'id']],
            [['id_jefe'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_jefe' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_ciclo' => 'Ciclo',
            'id_jefe' => 'Jefe',
            'id_sede' => 'Sede',
            'observaciones' => 'Observaciones',
            'estado' => 'Estado',
            'jornada' => 'Jornada',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCiclo()
    {
        return $this->hasOne(GcCiclos::className(), ['id' => 'id_ciclo']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getJefe()
    {
        return $this->hasOne(Personas::className(), ['id' => 'id_jefe']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSede()
    {
        return $this->hasOne(Sedes::className(), ['id' => 'id_sede']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSemanas()
    {
        return $this->hasMany(GcSemanas::className(), ['id_bitacora' => 'id']);
    }
}
