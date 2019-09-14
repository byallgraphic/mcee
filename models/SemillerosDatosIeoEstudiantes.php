<?php
/**********
Versión: 001
Fecha: 2018-08-16
Desarrollador: Edwin Molina Grisales
Descripción: MODELO SemillerosDatosIeoEstudiantes
---------------------------------------
**********/

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.semilleros_datos_ieo_estudiantes".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $docente_aliado
 * @property string $estado
 * @property string $id_sede
 * @property string $profecional_a
 */
class SemillerosDatosIeoEstudiantes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.semilleros_datos_ieo_estudiantes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'docente_aliado', 'estado', 'profecional_a'], 'required'],
            [['id_institucion', 'estado', 'id_sede'], 'default', 'value' => null],
            [['id_institucion', 'estado', 'id_sede'], 'integer'],
            // [['profecional_a'], 'string'],
			['profecional_a', 'each', 'rule' => ['integer']],
            // [['docente_aliado'], 'string', 'max' => 200],
			['docente_aliado', 'each', 'rule' => ['integer']],
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
            'id' 				=> 'ID',
            'id_institucion' 	=> 'Institucion',
            'docente_aliado' 	=> 'Docente Aliado',
            'estado' 			=> 'Estado',
            'id_sede' 			=> 'Sede',
            'profecional_a' 	=> 'Profesional A',
            'estudiantes_id' 	=> 'Estudiantes',
        ];
    }
}
