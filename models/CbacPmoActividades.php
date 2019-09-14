<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.pmo_actividades".
 *
 * @property int $id
 * @property int $id_pmo
 * @property int $id_componentes
 * @property int $id_actividad
 * @property string $desde
 * @property string $hasta
 * @property int $num_equipos
 * @property string $perfiles
 * @property string $docentes
 * @property string $fases
 * @property int $num_encuentro
 * @property string $nombre_actividad
 * @property string $actividades_desarrolladas
 * @property string $tematicas
 * @property string $objetivos_especificos
 * @property string $tiempo_previsto
 * @property string $productos
 * @property string $contenido_si_no
 * @property string $contenido_nombre
 * @property string $contenido_fecha
 
 * @property string $contenido_justificacion
 * @property string $acticulacion
 * @property int $cantidad_participantes
 * @property string $requerimientos_tecnicos
 * @property string $requerimientos_logoisticos
 * @property string $destinatarios
 * @property string $fehca_entrega
 * @property string $observaciones_generales
 * @property string $nombre_dilegencia
 * @property string $rol
 * @property string $fehca
 * @property string $lugares_visitados
 * @property string $penalistas_invitados
 * @property string $programacion
 * @property string $tematicas_abordadas
 * @property string $resultado_producto_esperado
 */
class CbacPmoActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.pmo_actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_pmo', 'id_componentes', 'id_actividad', 'num_equipos', 'num_encuentro', 'cantidad_participantes'], 'default', 'value' => null],
            [['id_pmo', 'id_componentes', 'id_actividad', 'num_equipos', 'num_encuentro', 'cantidad_participantes'], 'integer'],
            [['desde', 'hasta', 'contenido_fecha', 'fehca_entrega', 'fehca'], 'safe'],
            [['perfiles', 'docentes', 'fases', 'nombre_actividad', 'actividades_desarrolladas', 'tematicas', 'objetivos_especificos', 'tiempo_previsto', 'productos', 'contenido_si_no', 'contenido_nombre', 'contenido_justificacion', 'acticulacion', 'requerimientos_tecnicos', 'requerimientos_logoisticos', 'destinatarios', 'observaciones_generales', 'nombre_dilegencia', 'rol', 'lugares_visitados', 'penalistas_invitados', 'programacion', 'tematicas_abordadas', 'resultado_producto_esperado'], 'string'],
            [['id_pmo'], 'exist', 'skipOnError' => true, 'targetClass' => CbacPlanMisionalOperativo::className(), 'targetAttribute' => ['id_pmo' => 'id']],
            [['id_componentes'], 'exist', 'skipOnError' => true, 'targetClass' => IsaComponentes::className(), 'targetAttribute' => ['id_componentes' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pmo' => 'Id Pmo',
            'id_componentes' => 'Id Componentes',
            'id_actividad' => 'Id Actividad',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'num_equipos' => 'Num Equipos campo',
            'perfiles' => 'Perfiles',
            'docentes' => 'Coordinador técnico pedagógico',
            'fases' => 'Ciclos ',
            'num_encuentro' => 'No. de Encuentro',
            'nombre_actividad' => 'Nombre actividad',
            'actividades_desarrolladas' => 'Actividades a desarrollar',
            'tematicas' => 'Temáticas abordadas',
            'objetivos_especificos' => 'Objetivos específicos',
            'tiempo_previsto' => 'Tiempo previsto',
            'productos' => 'Productos',
            'contenido_si_no' => 'Contenido Si No',
            'contenido_nombre' => 'Contenido Nombre',
            'contenido_fecha' => 'Contenido Fecha',
            'contenido_vigencia' => 'Contenido Vigencia', //pendiente borrar este campo
            'contenido_justificacion' => 'Contenido Justificación',
            'acticulacion' => 'Articulación',
            'cantidad_participantes' => 'Cantidad participantes',
            'requerimientos_tecnicos' => 'Requerimientos  técnicos',
            'requerimientos_logoisticos' => 'Requerimientos  logísticos',
            'destinatarios' => 'Destinatarios',
            'fehca_entrega' => 'Fecha entrega envio',
            'observaciones_generales' => 'Observaciones generales',
            'nombre_dilegencia' => 'Nombre diligencia',
            'rol' => 'Rol',
            'fehca' => 'Fecha',
            
            'lugares_visitados' => 'Lugares recorrer',
            'penalistas_invitados' => 'Panelistas invitados',
            'programacion' => 'Programación',
            
            'tematicas_abordadas' => 'Tematicas abordadas',
            'resultado_producto_esperado' => 'Resultado Producto Esperado',
        ];
    }
}
