<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ge.seguimiento_gestion".
 *
 * @property string $id
 * @property string $id_tipo_seguimiento
 * @property string $id_ie
 * @property string $id_cargo
 * @property string $id_nombre
 * @property string $fecha
 * @property string $id_persona_gestor
 * @property int $numero_visitas
 * @property string $socializo_plan
 * @property string $plan_trabajo_socializo
 * @property string $descripcion_plan_trabajo
 * @property string $cronocrama_propuesto
 * @property string $descripcion_cronograma
 * @property string $avances_proyectos
 * @property string $dificultades
 * @property string $mejoras
 * @property string $observaciones
 * @property string $calificacion_nivel
 * @property string $descripcion_calificacion
 * @property string $estado
 * @property int $id_admin
 *
 * @property GeTipoSeguimiento $tipo_seguimiento
 */
class GeSeguimientoGestion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ge.seguimiento_gestion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id_tipo_seguimiento', 'id_ie', 'id_cargo', 'id_nombre', 'id_persona_gestor', 'estado'], 'required'],
            [[
					'id_tipo_seguimiento',
					'id_ie',
					'id_cargo',
					'id_nombre',
					'fecha',
					'id_persona_gestor',
					'numero_visitas',
					'socializo_plan',
					'plan_trabajo_socializo',
					'descripcion_plan_trabajo',
					'cronocrama_propuesto',
					'descripcion_cronograma',
					'avances_proyectos',
					'dificultades',
					'mejoras',
					'observaciones',
					'calificacion_nivel',
					'descripcion_calificacion',
					'estado',
                    'id_admin'
				], 'required'],
            [['id_tipo_seguimiento', 'id_ie', 'id_cargo', 'id_nombre', 'id_persona_gestor', 'numero_visitas', 'estado'], 'default', 'value' => null],
            [['id_tipo_seguimiento', 'id_ie', 'id_cargo', 'id_nombre', 'id_persona_gestor', 'numero_visitas', 'estado'], 'integer'],
            [['fecha'], 'safe'],
            [['socializo_plan', 'plan_trabajo_socializo', 'descripcion_plan_trabajo', 'cronocrama_propuesto', 'descripcion_cronograma', 'avances_proyectos', 'dificultades', 'mejoras', 'observaciones', 'calificacion_nivel', 'descripcion_calificacion'], 'string'],
            [['id_tipo_seguimiento'], 'exist', 'skipOnError' => true, 'targetClass' => GeTipoSeguimiento::className(), 'targetAttribute' => ['id_tipo_seguimiento' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_ie'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_ie' => 'id']],
            [['id_nombre'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_nombre' => 'id']],
            [['id_persona_gestor'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_persona_gestor' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 						=> 'ID',
            'id_tipo_seguimiento' 		=> 'Id Tipo Seguimiento',
            'id_ie' 					=> 'Nombre de la Institución Educativa a la que pertenece',
            'id_cargo' 					=> 'Cargo que desempeña en la IEO',
            'id_nombre' 				=> 'Nombre',
            'fecha' 					=> 'Fecha de reporte',
            'id_persona_gestor' 		=> 'Gestor o Gestora acompañante',
            'numero_visitas' 			=> 'Numero de visitas de acompañamiento realizadas por el gestor o gestora a la IEO durante el mes',
            'socializo_plan' 			=> 'El gestor o gestora socializó su plan de trabajo mensual con la IEO?',
            'plan_trabajo_socializo' 	=> 'Considera que el plan de trabajo socializado por el gestor o gestora es acorde con las necesidades de la IEO?',
            'descripcion_plan_trabajo' 	=> 'Explique su respuesta',
            'cronocrama_propuesto' 		=> 'De acuerdo con el cronograma propuesto por el gestor o la gestora, se están cumpliendo las actividades proyectadas?',
            'descripcion_cronograma' 	=> 'Explique su respuesta',
            'avances_proyectos' 		=> 'Señale que avances se tuvo desde los proyectos de MCEE en el actual período',
            'dificultades' 				=> 'Qué dificultades se presentaron para el desarrollo de los proyectos durante el período?',
            'mejoras' 					=> 'Qué mejoras sugiere a la intervención de Mi Comunidad es Escuela?',
            'observaciones' 			=> 'Tiene observaciones sobre el proyecto en general?',
            'calificacion_nivel' 		=> 'Cómo califica el nivel de satisfacción con la estrategia MCEE en su institución?',
            'descripcion_calificacion' 	=> 'Amplie su respuesta',
            'estado' 					=> 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTipo_seguimiento()
    {
        return $this->hasOne(GeTipoSeguimiento::className(), ['id' => 'id_tipo_seguimiento']);
    }
}
