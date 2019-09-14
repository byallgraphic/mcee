<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.actividades_isa".
 *
 * @property int $id
 * @property string $id_iniciacion_sencibilizacion_artistica
 * @property string $id_procesos_generales
 * @property string $fecha_prevista_desde
 * @property string $fecha_prevista_hasta
 * @property int $num_equipo_campo
 * @property string $docente_orientador
 * @property string $nombre_actividad
 * @property string $contenido_si_no
 * @property string $contenido_nombre
 * @property string $contenido_fecha
 * @property string $contenido_justificacion
 * @property string $articulacion
 * @property int $cantidad_participantes
 * @property string $requerimientos_tecnicos
 * @property string $requerimientos_logisticos
 * @property string $destinatarios
 * @property string $fecha_entrega_envio
 * @property string $observaciones_generales
 * @property string $nombre_diligencia
 * @property string $rol
 * @property string $fecha
 * @property string $estado
 */
class IsaActividadesIsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.actividades_isa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_iniciacion_sencibilizacion_artistica', 'id_procesos_generales', 'num_equipo_campo',  'cantidad_participantes', 'estado'], 'default', 'value' => ''],
            [['id_iniciacion_sencibilizacion_artistica', 'id_procesos_generales', 'num_equipo_campo',  'cantidad_participantes', 'estado', 'contenido_si_no','numero_semana'], 'integer'],
            [['fecha_prevista_desde', 'fecha_prevista_hasta', 'contenido_fecha', 'fecha'], 'safe'],
            [['docente_orientador', 'nombre_actividad','contenido_nombre', 'contenido_justificacion', 'articulacion', 'requerimientos_tecnicos', 'requerimientos_logisticos', 'destinatarios', 'fecha_entrega_envio', 'observaciones_generales', 'nombre_diligencia', 'rol'], 'string'],
            [['id_iniciacion_sencibilizacion_artistica'], 'exist', 'skipOnError' => true, 'targetClass' => IsaIniciacionSencibilizacionArtistica::className(), 'targetAttribute' => ['id_iniciacion_sencibilizacion_artistica' => 'id']],
            [['id_procesos_generales'], 'exist', 'skipOnError' => true, 'targetClass' => IsaProcesosGenerales::className(), 'targetAttribute' => ['id_procesos_generales' => 'id']],
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
            'id_iniciacion_sencibilizacion_artistica' => 'Id Iniciacion Sencibilizacion Artistica',
            'id_procesos_generales' => 'Id Procesos Generales',
            'fecha_prevista_desde' => 'Fecha',
            'fecha_prevista_hasta' => 'Fecha Prevista Hasta',
            'num_equipo_campo' => 'Núm. Equipo Campo',
            'docente_orientador' => 'Coordinador técnico pedagógico',
            'nombre_actividad' => 'Nombre Actividad',
            'contenido_si_no' => 'Contenido Si No',
            'contenido_nombre' => 'Contenido Nombre',
            'contenido_fecha' => 'Contenido Fecha',
            'contenido_justificacion' => 'Contenido Justificación',
            'articulacion' => 'Articulación',
            'cantidad_participantes' => 'Cantidad Participantes',
            'requerimientos_tecnicos' => 'Requerimientos Técnicos',
            'requerimientos_logisticos' => 'Requerimientos Logísticos',
            'destinatarios' => 'Destinatarios',
            'fecha_entrega_envio' => 'Fecha Entrega Envío',
            'observaciones_generales' => 'Observaciones Generales',
            'nombre_diligencia' => 'Nombre Diligencia',
            'rol' => 'Rol',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
        ];
    }

}
