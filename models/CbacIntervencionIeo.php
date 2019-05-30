<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.intervencion_ieo".
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
 * @property string $id_pmo_actividades
 * @property string $id_equipo_campos
 * @property string $productos
 * @property string $estado
 */
class CbacIntervencionIeo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.intervencion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['perfiles', 'docente_orientador', 'fases', 'nombre_actividad', 'actividad_desarrollar', 'lugares_recorrer', 'tematicas_abordadas', 'objetivos_especificos', 'tiempo_previsto', 'productos'], 'string'],
            [['num_encuentro', 'id_pmo_actividades', 'id_equipo_campos', 'estado'], 'default', 'value' => null],
            [['num_encuentro', 'id_pmo_actividades', 'id_equipo_campos', 'estado'], 'integer'],
            [['id_equipo_campos'], 'exist', 'skipOnError' => true, 'targetClass' => CbacEquiposCampo::className(), 'targetAttribute' => ['id_equipo_campos' => 'id']],
            [['id_equipo_campos'], 'exist', 'skipOnError' => true, 'targetClass' => CbacEquiposCampo::className(), 'targetAttribute' => ['id_equipo_campos' => 'id']],
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
            'tiempo_previsto' => 'Tiempo Previsto',
            'id_pmo_actividades' => 'Id Pmo Actividades',
            'id_equipo_campos' => 'Id Equipo Campos',
            'productos' => 'Productos',
            'estado' => 'Estado',
        ];
    }
}
