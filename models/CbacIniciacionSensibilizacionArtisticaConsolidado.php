<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.iniciacion_sensibilizacion_artistica_consolidado".
 *
 * @property string $id
 * @property string $fecha
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $estado
 * @property int $total_sesiones_realizadas
 * @property int $avance_por_mes
 * @property int $total_sesiones_aplazadas
 * @property int $total_sesiones_canceladas
 * @property int $vecinos
 * @property int $lideres_comunitarios
 * @property int $empresarios_comerciantes_microempresas
 * @property int $representantes_organizaciones_locales
 * @property int $asociaciones_grupos_comunitarios
 * @property int $otros_actores
 * @property int $actas
 * @property int $reportes
 * @property int $listados
 * @property int $plan_trabajo
 * @property int $formato_seguimiento
 * @property int $formato_evaluacion
 * @property int $fotografias
 * @property int $videos
 * @property int $otros_productos
 * @property string $id_actividad
 */
class CbacIniciacionSensibilizacionArtisticaConsolidado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.iniciacion_sensibilizacion_artistica_consolidado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estado', 'id_actividad','total_sesiones_realizadas','avance_por_mes','total_sesiones_aplazadas','total_sesiones_canceladas','vecinos','lideres_comunitarios','empresarios_comerciantes_microempresas','representantes_organizaciones_locales','asociaciones_grupos_comunitarios','otros_actores','actas','reportes','listados','plan_trabajo','formato_seguimiento','formato_evaluacion','fotografias','videos','otros_productos'], 'required'],
            [[ 'estado', 'total_sesiones_realizadas', 'avance_por_mes', 'total_sesiones_aplazadas', 'total_sesiones_canceladas', 'vecinos', 'lideres_comunitarios', 'empresarios_comerciantes_microempresas', 'representantes_organizaciones_locales', 'asociaciones_grupos_comunitarios', 'otros_actores', 'actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'videos', 'otros_productos', 'id_actividad'], 'default', 'value' => 0],
            [[ 'estado', 'total_sesiones_realizadas', 'avance_por_mes', 'total_sesiones_aplazadas', 'total_sesiones_canceladas', 'vecinos', 'lideres_comunitarios', 'empresarios_comerciantes_microempresas', 'representantes_organizaciones_locales', 'asociaciones_grupos_comunitarios', 'otros_actores', 'actas', 'reportes', 'listados', 'plan_trabajo', 'formato_seguimiento', 'formato_evaluacion', 'fotografias', 'videos', 'otros_productos', 'id_actividad'], 'integer'],
            [['id_actividad'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesArtisticas::className(), 'targetAttribute' => ['id_actividad' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_encabezado_iniciacion_artistica_consolidado'], 'exist', 'skipOnError' => true, 'targetClass' => CbacEncabezadoIniciacionArtisticaConsolidado::className(), 'targetAttribute' => ['id_encabezado_iniciacion_artistica_consolidado' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 											=> 'ID',
            'estado' 										=> 'Estado',
            'total_sesiones_realizadas' 					=> 'Total sesiones realizadas en el mes',
            'avance_por_mes' 								=> '% Avance por sede',
            'total_sesiones_aplazadas' 						=> 'Total sesiones aplazadas en el mes',
            'total_sesiones_canceladas' 					=> 'Total sesiones canceladas en el mes',
            'vecinos' 										=> 'Vecinos',
            'lideres_comunitarios' 							=> 'Líderes comunitarios',
            'empresarios_comerciantes_microempresas'		=> 'Empresarios, comerciantes y microempresarios',
            'representantes_organizaciones_locales' 		=> 'Representantes de Organizaciones locales',
            'asociaciones_grupos_comunitarios' 				=> 'Miembros de asociaciones y grupos comunitarios',
            'otros_actores' 								=> 'Otros Actores',
            'actas' 										=> 'ACTAS (cantidad)',
            'reportes' 										=> 'REPORTES (cantidad)',
            'listados' 										=> 'LISTADOS (cantidad)',
            'plan_trabajo' 									=> 'PLAN DE TRABAJO (cantidad)',
            'formato_seguimiento' 							=> 'FORMATO SEGUIMIENTO (cantidad)',
            'formato_evaluacion' 							=> 'FORMATO EVALUACIÓN (cantidad)',
            'fotografias' 									=> 'FOTOGRAFÍAS (cantidad)',
            'videos' 										=> 'VIDEOS (cantidad)',
            'otros_productos' 								=> 'OTROS PRODUCTOS (cantidad)',
            'id_actividad' 									=> 'Actividad',
            'id_encabezado_iniciacion_artistica_consolidado'=> 'Encabezado',
        ];
    }
}
