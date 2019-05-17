<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_isa.actividades_is_isa".
 *
 * @property int $id
 * @property int $id_informe_semanal_isa
 * @property string $duracion
 * @property string $docente
 * @property string $equipos
 * @property string $logros
 * @property string $variaciones_devilidades
 * @property string $variaciones_fortalezas
 * @property string $retos
 * @property string $articulacion
 * @property string $alrmas
 * @property int $estado
 * @property int $id_actividad
 * @property int $id_componente
 */
class IsIsaActividadesIsIsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.actividades_is_isa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_informe_semanal_isa', 'estado', 'id_actividad', 'id_componente'], 'default', 'value' => null],
            [['id_informe_semanal_isa', 'estado', 'id_actividad', 'id_componente'], 'integer'],
            [['duracion', 'docente', 'equipos', 'logros', 'variaciones_devilidades', 'variaciones_fortalezas', 'retos', 'articulacion', 'alrmas'], 'string'],
            [['id_informe_semanal_isa'], 'exist', 'skipOnError' => true, 'targetClass' => IsIsaInformeSemanalIsa::className(), 'targetAttribute' => ['id_informe_semanal_isa' => 'id']],
            [['id_componente'], 'exist', 'skipOnError' => true, 'targetClass' => IsaComponentes::className(), 'targetAttribute' => ['id_componente' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_informe_semanal_isa' => 'Informe Semanal Isa',
            'duracion' => 'Duración',
            'docente' => 'Coordinador técnico pedagógico',
            'equipos' => 'Equipos',
            'logros' => 'Logros',
            'variaciones_devilidades' => 'Variaciones Debilidades',
            'variaciones_fortalezas' => 'Variaciones Fortalezas',
            'retos' => 'Retos',
            'articulacion' => 'Articulación',
            'alrmas' => 'Alrmas',
            'estado' => 'Estado',
            'id_actividad' => 'Id Actividad',
            'id_componente' => 'Id Componente',
        ];
    }
}
