<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.avance_misional_eje_ppt".
 *
 * @property string $id
 * @property string $resposable_sem
 * @property string $operador
 * @property string $acciones_realizadas
 * @property string $proceso_gestion_avances
 * @property string $proceso_gestion_dificultades
 * @property string $estrategias_avances
 * @property string $estrategias_dificultades
 * @property string $orientaciones_avances
 * @property string $orientaciones_dificultades
 * @property string $guia_avances
 * @property string $guia_dificultades
 * @property string $iniciativas_avances
 * @property string $iniciativas_dificultades
 * @property string $red_municipal_avances
 * @property string $red_municipal_dificultades
 * @property string $proyectos_avances
 * @property string $proyectos_dificultades
 * @property string $dispositivo_avances
 * @property string $dispositivo_dificultades
 * @property string $fuente_informacion
 * @property string $avances_importantes
 * @property string $dificultades_importantes
 * @property string $alarmas_importantes
 * @property string $estado
 */
class EcAvanceMisionalEjePpt extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.avance_misional_eje_ppt';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['resposable_sem', 'operador', 'acciones_realizadas'], 'required'],
            [['resposable_sem', 'operador', 'acciones_realizadas', 'proceso_gestion_avances', 'proceso_gestion_dificultades', 'estrategias_avances', 'estrategias_dificultades', 'orientaciones_avances', 'orientaciones_dificultades', 'guia_avances', 'guia_dificultades', 'iniciativas_avances', 'iniciativas_dificultades', 'red_municipal_avances', 'red_municipal_dificultades', 'proyectos_avances', 'proyectos_dificultades', 'dispositivo_avances', 'dispositivo_dificultades', 'fuente_informacion', 'avances_importantes', 'dificultades_importantes', 'alarmas_importantes', 'estado'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'resposable_sem' => 'Resposable Sem',
            'operador' => 'Operador',
            'acciones_realizadas' => 'Acciones Realizadas',
            'proceso_gestion_avances' => 'Proceso Gestion Avances',
            'proceso_gestion_dificultades' => 'Proceso Gestion Dificultades',
            'estrategias_avances' => 'Estrategias Avances',
            'estrategias_dificultades' => 'Estrategias Dificultades',
            'orientaciones_avances' => 'Orientaciones Avances',
            'orientaciones_dificultades' => 'Orientaciones Dificultades',
            'guia_avances' => 'Guia Avances',
            'guia_dificultades' => 'Guia Dificultades',
            'iniciativas_avances' => 'Iniciativas Avances',
            'iniciativas_dificultades' => 'Iniciativas Dificultades',
            'red_municipal_avances' => 'Red Municipal Avances',
            'red_municipal_dificultades' => 'Red Municipal Dificultades',
            'proyectos_avances' => 'Proyectos Avances',
            'proyectos_dificultades' => 'Proyectos Dificultades',
            'dispositivo_avances' => 'Dispositivo Avances',
            'dispositivo_dificultades' => 'Dispositivo Dificultades',
            'fuente_informacion' => 'Fuente Informacion',
            'avances_importantes' => 'Avances Importantes',
            'dificultades_importantes' => 'Dificultades Importantes',
            'alarmas_importantes' => 'Alarmas Importantes',
            'estado' => 'Estado',
        ];
    }
}
