<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.semilleros_datos_ieo".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $personal_a
 * @property string $docente_aliado
 * @property string $estado
 * @property string $sede
 */
class SemillerosDatosIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.semilleros_datos_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'personal_a', 'docente_aliado', 'estado', 'sede'], 'required'],
            [['id_institucion', 'estado', 'sede'], 'default', 'value' => null],
            [['id_institucion', 'estado', 'sede'], 'integer'],
            // [['personal_a', 'docente_aliado'], 'string'],
			['personal_a', 'each', 'rule' => ['integer']],
			['docente_aliado', 'each', 'rule' => ['integer']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
			'id' 				=> 'ID',
            'id_institucion' 	=> 'Institución educativa',
            'sede' 				=> 'Sede',
            'personal_a' 		=> 'Personal A.',
            'docente_aliado' 	=> 'Docente aliado',
            'estado' 			=> 'Estado',
        ];
		
    }
}
