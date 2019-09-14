<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_Convocatoria".
 *
 * @property string $id
 * @property string $fecha_accion
 * @property string $Id_formador
 * @property string $Nombre_formador
 * @property string $Apellido_formador
 * @property string $IE
 * @property string $Sede
 * @property string $Fecha_conv
 * @property string $Hora_inicio
 * @property string $Hora_final
 * @property string $Desarrollo_conv
 * @property string $Estudiantes_inscritos
 * @property string $Registro_fotografico
 */
class PccTbConvocatoria extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_Convocatoria';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fecha_accion', 'Fecha_conv'], 'safe'],
            [['Desarrollo_conv', 'Registro_fotografico'], 'string'],
            [['id'], 'string', 'max' => 10],
            [['Id_formador', 'Estudiantes_inscritos'], 'string', 'max' => 320],
            [['Nombre_formador', 'Apellido_formador', 'IE', 'Sede', 'Hora_inicio', 'Hora_final'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fecha_accion' => 'Fecha Accion',
            'Id_formador' => 'Id Formador',
            'Nombre_formador' => 'Nombre Formador',
            'Apellido_formador' => 'Apellido Formador',
            'IE' => 'Ie',
            'Sede' => 'Sede',
            'Fecha_conv' => 'Fecha Conv',
            'Hora_inicio' => 'Hora Inicio',
            'Hora_final' => 'Hora Final',
            'Desarrollo_conv' => 'Desarrollo Conv',
            'Estudiantes_inscritos' => 'Estudiantes Inscritos',
            'Registro_fotografico' => 'Registro Fotografico',
        ];
    }
}
