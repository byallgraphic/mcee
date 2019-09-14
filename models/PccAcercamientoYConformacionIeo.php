<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Acercamiento_y_conformacion_ieo".
 *
 * @property string $ID_accion
 * @property string $Tipo_reunion
 * @property string $ID_tutor_gestor
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Institucion_educativa
 * @property string $Asesor
 * @property string $Fecha
 * @property string $Hora_inicio
 * @property string $Hora_final
 * @property string $Lugar
 * @property string $Numero_asistentes
 * @property string $Objetivo_reunion
 * @property string $Acuerdos_compromiso
 */
class PccAcercamientoYConformacionIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Acercamiento_y_conformacion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha'], 'safe'],
            [['Objetivo_reunion'], 'string'],
            [['ID_accion'], 'string', 'max' => 10],
            [['Tipo_reunion', 'Nombre', 'Apellido', 'Institucion_educativa', 'Asesor', 'Hora_inicio', 'Hora_final', 'Lugar', 'Acuerdos_compromiso'], 'string', 'max' => 255],
            [['ID_tutor_gestor', 'Numero_asistentes'], 'string', 'max' => 320],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_accion' => 'Id Accion',
            'Tipo_reunion' => 'Tipo Reunion',
            'ID_tutor_gestor' => 'Id Tutor Gestor',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Institucion_educativa' => 'Institucion Educativa',
            'Asesor' => 'Asesor',
            'Fecha' => 'Fecha',
            'Hora_inicio' => 'Hora Inicio',
            'Hora_final' => 'Hora Final',
            'Lugar' => 'Lugar',
            'Numero_asistentes' => 'Numero Asistentes',
            'Objetivo_reunion' => 'Objetivo Reunion',
            'Acuerdos_compromiso' => 'Acuerdos Compromiso',
        ];
    }
}
