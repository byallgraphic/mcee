<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.avance_misional_proyecto".
 *
 * @property string $id
 * @property string $equipo_sem
 * @property string $operado
 * @property string $acciones_realizadas
 * @property string $actores_lideres
 * @property string $proceso_gestion
 * @property string $iniciativas_pedagogicas
 * @property string $estudiantes
 * @property string $fuente_informacion
 * @property string $avances_importante
 * @property string $dificultades_importantes
 * @property string $alarmas_importantes
 * @property string $estado
 */
class EcAvanceMisionalProyecto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.avance_misional_proyecto';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['equipo_sem', 'operado', 'acciones_realizadas', 'actores_lideres', 'proceso_gestion', 'iniciativas_pedagogicas', 'estudiantes', 'fuente_informacion', 'avances_importante', 'dificultades_importantes', 'alarmas_importantes','visiones'], 'string'],
            [['estado'], 'default', 'value' => null],
            [['estado'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'equipo_sem' => 'Equipo Sem',
            'operado' => 'Operado',
            'acciones_realizadas' => 'Acciones Realizadas',
            'actores_lideres' => 'Actores Lideres',
            'proceso_gestion' => 'Proceso Gestion',
            'iniciativas_pedagogicas' => 'Iniciativas Pedagogicas',
            'estudiantes' => 'Estudiantes',
            'fuente_informacion' => 'Fuente Informacion',
            'avances_importante' => 'Avances Importante',
            'dificultades_importantes' => 'Dificultades Importantes',
            'alarmas_importantes' => 'Alarmas Importantes',
            'estado' => 'Estado',
            'visiones' => 'Estado',
        ];
    }
}
