<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.avance_misional_ss".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $fecha_inicio
 * @property string $fecha_fin
 * @property string $responsable_sem
 * @property string $operador
 * @property string $acciones_realizadas
 * @property string $gestion_institucional_avances
 * @property string $gestion_institucional_dificultades
 * @property string $proyectos_servicio_social_avances
 * @property string $proyectos_servicio_social_difcultades
 * @property string $competencias_habilidades_avances
 * @property string $competencias_habilidades_dificultades
 * @property string $fuente_informacion
 * @property string $avances_acompanamiento
 * @property string $dificultades_acompanamiento
 * @property string $alarmas_importantes
 * @property string $estado
 */
class EcAvanceMisionalSs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.avance_misional_ss';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'fecha_inicio', 'fecha_fin', 'responsable_sem', 'operador', 'acciones_realizadas', 'gestion_institucional_avances', 'gestion_institucional_dificultades', 'proyectos_servicio_social_avances', 'proyectos_servicio_social_difcultades', 'competencias_habilidades_avances', 'competencias_habilidades_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes', 'estado'], 'required'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha_inicio', 'fecha_fin'], 'safe'],
            [['responsable_sem', 'operador', 'acciones_realizadas', 'gestion_institucional_avances', 'gestion_institucional_dificultades', 'proyectos_servicio_social_avances', 'proyectos_servicio_social_difcultades', 'competencias_habilidades_avances', 'competencias_habilidades_dificultades', 'fuente_informacion', 'avances_acompanamiento', 'dificultades_acompanamiento', 'alarmas_importantes'], 'string'],
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
            'gestion_institucional_avances' => 'Avances',
            'gestion_institucional_dificultades' => 'Dificultades',
            'proyectos_servicio_social_avances' => 'Avances',
            'proyectos_servicio_social_difcultades' => 'Difcultades',
            'competencias_habilidades_avances' => 'Avances',
            'competencias_habilidades_dificultades' => 'Dificultades',
            'fuente_informacion' => 'Fuente de información para este análisis',
            'avances_acompanamiento' => 'Avances Mas Importantes del Acompañamiento',
            'dificultades_acompanamiento' => 'Dificultades Mas Importantes del Acompañamiento',
            'alarmas_importantes' => 'Alarmas Importantes',
            'estado' => 'Estado',
        ];
    }
}
