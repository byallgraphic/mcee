<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.avance_misional_af".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $responsable_sem
 * @property string $operador
 * @property string $acciones_realizadas
 * @property string $acompanamiento_pedagogico_avances
 * @property string $acompanamiento_pedagogico_dificultades
 * @property string $comunicacion_pedagogica_avances
 * @property string $comunicacion_pedagogica_difcultades
 * @property string $organismos_mecanismos_avances
 * @property string $organismos_mecanismos_dificultades
 * @property string $fuente_informacion
 * @property string $avances_acompanamiento
 * @property string $dificultades_acompanamiento
 * @property string $alarmas_importantes
 * @property string $estado
 */
class EcAvanceMisionalAf extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.avance_misional_af';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'fecha_inicio', 'fecha_fin', 'responsable_sem', 'operador', 'acciones_realizadas', 'acompanamiento_pedagogico_avances', 'acompanamiento_pedagogico_dificultades', 'comunicacion_pedagogica_avances', 'comunicacion_pedagogica_difcultades', 'organismos_mecanismos_avances', 'organismos_mecanismos_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes', 'estado'], 'required'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['responsable_sem', 'operador', 'acciones_realizadas', 'acompanamiento_pedagogico_avances', 'acompanamiento_pedagogico_dificultades', 'comunicacion_pedagogica_avances', 'comunicacion_pedagogica_difcultades', 'organismos_mecanismos_avances', 'organismos_mecanismos_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'string'],
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
            'id_institucion' => 'Id Institucion',
            'id_sede' => 'Id Sede',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'responsable_sem' => 'Responsable Sem',
            'operador' => 'Operador',
            'acciones_realizadas' => 'Acciones Realizadas',
            'acompanamiento_pedagogico_avances' => 'Acompanamiento Pedagogico Avances',
            'acompanamiento_pedagogico_dificultades' => 'Acompanamiento Pedagogico Dificultades',
            'comunicacion_pedagogica_avances' => 'Comunicacion Pedagogica Avances',
            'comunicacion_pedagogica_difcultades' => 'Comunicacion Pedagogica Difcultades',
            'organismos_mecanismos_avances' => 'Organismos Mecanismos Avances',
            'organismos_mecanismos_dificultades' => 'Organismos Mecanismos Dificultades',
            'fuente_informacion' => 'Fuente Informacion',
            'avances_acompanamiento' => 'Avances Acompanamiento',
            'dificultades_acompanamiento' => 'Dificultades Acompanamiento',
            'alarmas_importantes' => 'Alarmas Importantes',
            'estado' => 'Estado',
        ];
    }
}
