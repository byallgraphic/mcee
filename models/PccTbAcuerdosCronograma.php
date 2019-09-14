<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_AcuerdosCronograma".
 *
 * @property string $Id
 * @property string $FechaReg
 * @property string $Id_formador
 * @property string $Nombre
 * @property string $Apellido
 * @property string $IEO
 * @property string $ParticipantesAcuerdos
 * @property string $GrupoTrabajo
 * @property string $SedeEjecucion1
 * @property string $SedeEjecucion2
 * @property string $SedeEjecucion3
 * @property string $LugarSesiones
 * @property string $Horario
 * @property string $AcuerdoDefiEstud
 * @property string $MaestroLider
 * @property string $Convocatoria
 * @property string $Taller1
 * @property string $Taller2
 * @property string $Taller3
 * @property string $Taller4
 * @property string $Taller5
 * @property string $Taller6
 * @property string $Taller7
 * @property string $Taller8
 * @property string $Taller9
 * @property string $Taller10
 * @property string $Lab1
 * @property string $Lab2
 * @property string $Lab3
 * @property string $Lab4
 */
class PccTbAcuerdosCronograma extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_AcuerdosCronograma';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['FechaReg', 'Convocatoria', 'Taller1', 'Taller2', 'Taller3', 'Taller4', 'Taller5', 'Taller6', 'Taller7', 'Taller8', 'Taller9', 'Taller10', 'Lab1', 'Lab2', 'Lab3', 'Lab4'], 'safe'],
            [['Id'], 'string', 'max' => 10],
            [['Id_formador', 'GrupoTrabajo'], 'string', 'max' => 320],
            [['Nombre', 'Apellido', 'IEO', 'ParticipantesAcuerdos', 'SedeEjecucion1', 'SedeEjecucion2', 'SedeEjecucion3', 'LugarSesiones', 'Horario', 'AcuerdoDefiEstud', 'MaestroLider'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'FechaReg' => 'Fecha Reg',
            'Id_formador' => 'Id Formador',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'IEO' => 'Ieo',
            'ParticipantesAcuerdos' => 'Participantes Acuerdos',
            'GrupoTrabajo' => 'Grupo Trabajo',
            'SedeEjecucion1' => 'Sede Ejecucion1',
            'SedeEjecucion2' => 'Sede Ejecucion2',
            'SedeEjecucion3' => 'Sede Ejecucion3',
            'LugarSesiones' => 'Lugar Sesiones',
            'Horario' => 'Horario',
            'AcuerdoDefiEstud' => 'Acuerdo Defi Estud',
            'MaestroLider' => 'Maestro Lider',
            'Convocatoria' => 'Convocatoria',
            'Taller1' => 'Taller1',
            'Taller2' => 'Taller2',
            'Taller3' => 'Taller3',
            'Taller4' => 'Taller4',
            'Taller5' => 'Taller5',
            'Taller6' => 'Taller6',
            'Taller7' => 'Taller7',
            'Taller8' => 'Taller8',
            'Taller9' => 'Taller9',
            'Taller10' => 'Taller10',
            'Lab1' => 'Lab1',
            'Lab2' => 'Lab2',
            'Lab3' => 'Lab3',
            'Lab4' => 'Lab4',
        ];
    }
}
