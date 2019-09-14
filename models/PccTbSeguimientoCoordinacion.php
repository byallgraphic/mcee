<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_SeguimientoCoordinacion".
 *
 * @property int $ID_accion
 * @property string $ID_asesor
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Asesor
 * @property string $Fecha
 * @property string $Hora_inicio
 * @property string $Hora_final
 * @property string $Lugar
 * @property string $Numero_asistentes
 * @property string $Objetivo_reunion
 * @property string $Tipo_reunion
 */
class PccTbSeguimientoCoordinacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_SeguimientoCoordinacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ID_accion'], 'default', 'value' => null],
            [['ID_accion'], 'integer'],
            [['Fecha'], 'safe'],
            [['Objetivo_reunion'], 'string'],
            [['ID_asesor', 'Numero_asistentes'], 'string', 'max' => 320],
            [['Nombre', 'Apellido', 'Asesor', 'Hora_inicio', 'Hora_final', 'Lugar', 'Tipo_reunion'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID_accion' => 'Id Accion',
            'ID_asesor' => 'Id Asesor',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Asesor' => 'Asesor',
            'Fecha' => 'Fecha',
            'Hora_inicio' => 'Hora Inicio',
            'Hora_final' => 'Hora Final',
            'Lugar' => 'Lugar',
            'Numero_asistentes' => 'Numero Asistentes',
            'Objetivo_reunion' => 'Objetivo Reunion',
            'Tipo_reunion' => 'Tipo Reunion',
        ];
    }
}
