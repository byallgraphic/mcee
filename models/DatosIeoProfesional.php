<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.datos_ieo_profesional".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_profesional_a
 * @property string $estado
 */
class DatosIeoProfesional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.datos_ieo_profesional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_profesional_a', 'estado'], 'required'],
            [['id_institucion', 'id_profesional_a', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'estado','id_sede'], 'integer'],
			[['id_profesional_a'], 'string', 'max' => 200],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
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
            'id_institucion' => 'Institución',
            'id_profesional_a' => 'Profesional A',
            'estado' => 'Estado',
            'id_sede' => 'Sede',
        ];
    }
}
