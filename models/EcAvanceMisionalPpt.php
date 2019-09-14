<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.avance_misional_ppt".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $responsable_sem
 * @property string $operador
 * @property string $acciones_realizadas
 * @property string $procesos_gestion_avances
 * @property string $procesos_gestion_dificultades
 * @property string $estrategias_tranversalizacion_avances
 * @property string $estrategias_tranversalizacion_difcultades
 * @property string $orientacion_conceptuales_avances
 * @property string $orientacion_conceptuales_dificultades
 * @property string $fuente_informacion
 * @property string $avances_acompanamiento
 * @property string $dificultades_acompanamiento
 * @property string $alarmas_importantes
 */
class EcAvanceMisionalPpt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.avance_misional_ppt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'fecha_inicio', 'fecha_fin', 'responsable_sem', 'operador', 'acciones_realizadas', 'procesos_gestion_avances', 'procesos_gestion_dificultades', 'estrategias_tranversalizacion_avances', 'estrategias_tranversalizacion_difcultades', 'orientacion_conceptuales_avances', 'orientacion_conceptuales_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'required'],
            [['id_institucion', 'id_sede'], 'default', 'value' => null],
            [['id_institucion', 'id_sede','estado'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['responsable_sem', 'operador', 'acciones_realizadas', 'procesos_gestion_avances', 'procesos_gestion_dificultades', 'estrategias_tranversalizacion_avances', 'estrategias_tranversalizacion_difcultades', 'orientacion_conceptuales_avances', 'orientacion_conceptuales_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'string'],
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
            'id_institucion' => 'Institucion',
            'id_sede' => 'Sede',
            'fecha_inicio' => 'Fecha Inicio',
            'fecha_fin' => 'Fecha Fin',
            'responsable_sem' => 'Responsable Sem',
            'operador' => 'Operador',
            'acciones_realizadas' => 'Acciones Realizadas',
            'procesos_gestion_avances' => 'Avances',
            'procesos_gestion_dificultades' => 'Dificultades',
            'estrategias_tranversalizacion_avances' => 'Avances',
            'estrategias_tranversalizacion_difcultades' => 'Difcultades',
            'orientacion_conceptuales_avances' => 'Avances',
            'orientacion_conceptuales_dificultades' => 'Dificultades',
            'fuente_informacion' => 'Fuente de información para este análisis',
            'avances_acompanamiento' => 'Avances Mas Importantes del Acompañamiento',
            'dificultades_acompanamiento' => 'Dificultades Mas Importantes del Acompañamiento',
            'alarmas_importantes' => 'Alarmas Importantes',
            'estado' => 'Estado',
        ];
    }
}
