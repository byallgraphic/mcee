<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.TB_Asistencia".
 *
 * @property string $Id
 * @property string $Fecha_accion
 * @property string $ID_formador
 * @property string $IE
 * @property string $Sesion
 * @property string $ID_estudiante
 * @property string $Nombres
 * @property string $Apellido
 * @property string $Asistencia
 * @property string $validacion
 */
class PccTBAsistencia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.TB_Asistencia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_accion'], 'safe'],
            [['Id'], 'string', 'max' => 10],
            [['ID_formador', 'IE', 'Sesion', 'ID_estudiante', 'Nombres', 'Apellido', 'Asistencia', 'validacion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Fecha_accion' => 'Fecha Accion',
            'ID_formador' => 'Id Formador',
            'IE' => 'Ie',
            'Sesion' => 'Sesion',
            'ID_estudiante' => 'Id Estudiante',
            'Nombres' => 'Nombres',
            'Apellido' => 'Apellido',
            'Asistencia' => 'Asistencia',
            'validacion' => 'Validacion',
        ];
    }
}
