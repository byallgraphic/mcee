<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cobertura".
 *
 * @property int $id
 * @property int $tema_id
 * @property int $institucion_id
 * @property int $cantidad_niños_institucion
 * @property int $cantidad_niñas_institucion
 * @property int $sede_id
 * @property int $cantidad_niños_sede
 * @property int $cantidad_niñas_sede
 * @property string $observaciones
 *
 * @property Instituciones $institucion
 * @property Sedes $sede
 * @property TemaCobertura $tema
 */
class Cobertura extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cobertura';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tema_id', 'institucion_id', 'cantidad_niños_institucion', 'cantidad_niñas_institucion', 'sede_id', 'cantidad_niños_sede', 'cantidad_niñas_sede'], 'default', 'value' => null],
            [['tema_id', 'institucion_id', 'cantidad_niños_institucion', 'cantidad_niñas_institucion', 'sede_id', 'cantidad_niños_sede', 'cantidad_niñas_sede'], 'integer'],
            [['observaciones'], 'string'],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_id' => 'id']],
            [['tema_id'], 'exist', 'skipOnError' => true, 'targetClass' => TemaCobertura::className(), 'targetAttribute' => ['tema_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tema_id' => 'Tema ID',
            'institucion_id' => 'Institucion ID',
            'cantidad_niños_institucion' => '',
            'cantidad_niñas_institucion' => '',
            'sede_id' => 'Sede ID',
            'cantidad_niños_sede' => '',
            'cantidad_niñas_sede' => '',
            'observaciones' => 'Observaciones',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInstitucion()
    {
        return $this->hasOne(Instituciones::className(), ['id' => 'institucion_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSede()
    {
        return $this->hasOne(Sedes::className(), ['id' => 'sede_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTema()
    {
        return $this->hasOne(TemaCobertura::className(), ['id' => 'tema_id']);
    }
}
