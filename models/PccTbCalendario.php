<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_Calendario".
 *
 * @property string $Id
 * @property string $Fecha_captura
 * @property string $Nmero_de_identificacin_del_Tutor
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Institucin_Educativa
 * @property string $Sede
 * @property string $Fecha_de_programacin
 * @property string $Hora_inicio
 * @property string $Hora_final
 * @property string $Actividad
 * @property string $Cantidad_de_refrigerios_requerid
 * @property string $Seguimiento_pedagogico
 * @property string $Estado_del_evento
 * @property string $Fecha_reprogramacion
 * @property string $Motivo_reprogramacion
 * @property string $Perfi
 * @property string $Lugar_reunion_as
 * @property string $Requiere_refrigerios
 * @property string $Taller
 * @property string $Laboratorio
 */
class PccTbCalendario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_Calendario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_captura', 'Fecha_de_programacin', 'Fecha_reprogramacion'], 'safe'],
            [['Actividad', 'Motivo_reprogramacion'], 'string'],
            [['Id'], 'string', 'max' => 10],
            [['Nmero_de_identificacin_del_Tutor', 'Cantidad_de_refrigerios_requerid'], 'string', 'max' => 320],
            [['Nombre', 'Apellido', 'Institucin_Educativa', 'Sede', 'Hora_inicio', 'Hora_final', 'Seguimiento_pedagogico', 'Estado_del_evento', 'Perfi', 'Lugar_reunion_as', 'Requiere_refrigerios', 'Taller', 'Laboratorio'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Fecha_captura' => 'Fecha Captura',
            'Nmero_de_identificacin_del_Tutor' => 'Nmero De Identificacin Del  Tutor',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Institucin_Educativa' => 'Institucin  Educativa',
            'Sede' => 'Sede',
            'Fecha_de_programacin' => 'Fecha De Programacin',
            'Hora_inicio' => 'Hora Inicio',
            'Hora_final' => 'Hora Final',
            'Actividad' => 'Actividad',
            'Cantidad_de_refrigerios_requerid' => 'Cantidad De Refrigerios Requerid',
            'Seguimiento_pedagogico' => 'Seguimiento Pedagogico',
            'Estado_del_evento' => 'Estado Del Evento',
            'Fecha_reprogramacion' => 'Fecha Reprogramacion',
            'Motivo_reprogramacion' => 'Motivo Reprogramacion',
            'Perfi' => 'Perfi',
            'Lugar_reunion_as' => 'Lugar Reunion As',
            'Requiere_refrigerios' => 'Requiere Refrigerios',
            'Taller' => 'Taller',
            'Laboratorio' => 'Laboratorio',
        ];
    }
}
