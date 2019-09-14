<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%paz_cultura}}".
 *
 * @property string $id
 * @property string $ruta
 * @property string $tipo_perfil
 * @property string $estado
 * @property string $descripcion
 *
 * @property Estados $estado0
 * @property Personas $persona
 * @property TipoPerfil $tipoPerfil
 */
class PazCultura extends \yii\db\ActiveRecord
{
    var $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%paz_cultura}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ruta', 'descripcion', 'tipo_perfil', 'estado'], 'required'],
            [['tipo_perfil', 'estado'], 'default', 'value' => null],
            [['tipo_perfil', 'estado'], 'integer'],
            [['ruta'], 'string', 'max' => 200],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['tipo_perfil'], 'exist', 'skipOnError' => true, 'targetClass' => TipoPerfil::className(), 'targetAttribute' => ['tipo_perfil' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ruta' => 'Ruta',
            'descripcion' => 'Descripcion',
            'tipo_perfil' => 'Tipo Perfil',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Estados::className(), ['id' => 'estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPersona()
    {
        return $this->hasOne(Personas::className(), ['id' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipoPerfil()
    {
        return $this->hasOne(TipoPerfil::className(), ['id' => 'tipo_perfil']);
    }
}
