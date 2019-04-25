<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.intervencion_ieo".
 *
 * @property string $id
 * @property string $perfiles
 * @property string $docente_orientador
 * @property string $fases
 * @property int $num_encuentro
 * @property string $nombre_actividad
 * @property string $actividad_desarrollar
 * @property string $lugares_recorrer
 * @property string $tematicas_abordadas
 * @property string $objetivos_especificos
 * @property string $tiempo_previsto
 * @property string $id_actividades_isa
 * @property string $id_equipo_campos
 * @property string $estado
 */
class IsaIntervencionIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.intervencion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perfiles', 'docente_orientador', 'fases', 'nombre_actividad', 'actividad_desarrollar', 'lugares_recorrer', 'tematicas_abordadas', 'objetivos_especificos', 'tiempo_previsto','productos'], 'string'],
            [['num_encuentro', 'id_actividades_isa', 'id_equipo_campos', 'estado'], 'default', 'value' => null],
            [['num_encuentro', 'id_actividades_isa', 'id_equipo_campos', 'estado'], 'integer'],
            [['id_actividades_isa'], 'exist', 'skipOnError' => true, 'targetClass' => IsaActividadesIsa::className(), 'targetAttribute' => ['id_actividades_isa' => 'id']],
            [['id_equipo_campos'], 'exist', 'skipOnError' => true, 'targetClass' => IsaEquiposCampo::className(), 'targetAttribute' => ['id_equipo_campos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'perfiles' => 'Perfiles',
            'docente_orientador' => 'Docente Orientador',
            'fases' => 'Fases',
            'num_encuentro' => 'Num Encuentro',
            'nombre_actividad' => 'Nombre Actividad',
            'actividad_desarrollar' => 'Actividad Desarrollar',
            'lugares_recorrer' => 'Lugares Recorrer',
            'tematicas_abordadas' => 'Tematicas Abordadas',
            'objetivos_especificos' => 'Objetivos Especificos',
            'tiempo_previsto' => 'Tiempo Previsto (en minutos)',
            'id_actividades_isa' => 'Id Actividades Isa',
            'id_equipo_campos' => 'Id Equipo Campos',
            'estado' => 'Estado',
            'productos' => 'Productos',
        ];
    }
}
