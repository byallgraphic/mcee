<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ge.seguimiento_operador".
 *
 * @property string $id
 * @property string $id_tipo_seguimiento
 * @property string $email
 * @property string $cual_operador
 * @property string $proyecto_reportar
 * @property string $id_ie
 * @property string $mes_reporte
 * @property string $semana_reporte
 * @property string $id_persona_responsable
 * @property string $descripcion_actividad
 * @property string $poblacion_beneficiaria
 * @property string $quienes
 * @property int $numero_participantes
 * @property string $duracion_actividad
 * @property string $logros_alcanzados
 * @property string $dificultadades
 * @property string $avances_cumplimiento_cuantitativos
 * @property string $avances_cumplimiento_cualitativos
 * @property string $dificultades
 * @property string $propuesta_dificultades
 * @property string $estado
 * @property string $id_operador
 */
class GeSeguimientoOperador extends \yii\db\ActiveRecord
{
	public $documentFile;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ge.seguimiento_operador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id_tipo_seguimiento', 'id_ie', 'id_persona_responsable', 'estado', 'id_operador','id_indicador'], 'required'],
            [[
				'id_tipo_seguimiento',
				'email',
				'id_operador',
				'cual_operador',
				'proyecto_reportar',
				'id_ie',
				'mes_reporte',
				'semana_reporte',
				'id_persona_responsable',
				'descripcion_actividad', 
				'poblacion_beneficiaria',
				'quienes',
				'numero_participantes',
				'duracion_actividad', 
				'logros_alcanzados',
				'dificultadades',		
				'avances_cumplimiento_cuantitativos',
				'avances_cumplimiento_cualitativos',
				'dificultades',
				'propuesta_dificultades',
				'estado',
				'id_indicador',
				'id_objetivo',
				'id_actividad',
				'documentFile',
			], 'required' ],
            [['id_tipo_seguimiento', 'id_ie', 'id_persona_responsable', 'numero_participantes', 'estado', 'id_operador'], 'default', 'value' => null],
            [['id_tipo_seguimiento', 'id_ie', 'id_persona_responsable', 'numero_participantes', 'estado', 'id_operador','id_indicador','id_objetivo','id_actividad'], 'integer'],
            [['email', 'cual_operador', 'proyecto_reportar', 'mes_reporte', 'semana_reporte', 'descripcion_actividad', 'poblacion_beneficiaria', 'quienes', 'duracion_actividad', 'logros_alcanzados', 'dificultadades', 'avances_cumplimiento_cuantitativos', 'avances_cumplimiento_cualitativos', 'dificultades', 'propuesta_dificultades'], 'string'],
            [['id_tipo_seguimiento'], 'exist', 'skipOnError' => true, 'targetClass' => GeTipoSeguimiento::className(), 'targetAttribute' => ['id_tipo_seguimiento' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_ie'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_ie' => 'id']],
            [['id_operador'], 'exist', 'skipOnError' => true, 'targetClass' => Parametro::className(), 'targetAttribute' => ['id_operador' => 'id']],
            [['id_persona_responsable'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_persona_responsable' => 'id']],
            [['id_indicador'], 'exist', 'skipOnError' => true, 'targetClass' => GeIndicadores::className(), 'targetAttribute' => ['id_indicador' => 'id']],
            [['email'], 'email' ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' 								=> 'ID',
            'id_tipo_seguimiento' 				=> 'Id Tipo Seguimiento',
            'email' 							=> 'Dirección de correo electrónico',
            'id_operador' 						=> '1. Nombre del operador',
            'cual_operador' 					=> 'Cuál?',
            'proyecto_reportar' 				=> '2. Proyecto a reportar',
            'id_ie' 							=> '3. IEO reportada',
            'mes_reporte' 						=> '4. Mes reporte',
            'semana_reporte' 					=> '5. Semana a reportar',
            'id_persona_responsable'			=> '6. Profesional responsable',
            'descripcion_actividad' 			=> 'Descripción de la Actividad',
            'poblacion_beneficiaria'			=> 'Poblacion Beneficiaria',
            'quienes' 							=> 'Quienes?',
            'numero_participantes' 				=> 'Número de participantes',
            'duracion_actividad' 				=> 'Duración de la actividad',
            'logros_alcanzados' 				=> 'Logros alcanzados',
            'dificultadades' 					=> 'Dificultades presentadas',
            'avances_cumplimiento_cuantitativos'=> '8. Describa los avances para el cumplimiento del indicador seleccionado en terminos cuantitativos',
            'avances_cumplimiento_cualitativos' => '9. Describa los avances para el cumplimiento del inidcador seleccionado en terminos cualitativos Avances Cumplimiento Cualitativos',
            'dificultades' 						=> '10. Mencione las dificultades para el cumplimiento de los indicadores si las hay',
            'propuesta_dificultades' 			=> '11. Qué propuesta(s) plantea para superar esas dificultades presentadas',
            'estado' 							=> 'Estado',
            'id_indicador'						=> '7. A qué indicador del proyecto le apuntó la actividad?',
            'id_objetivo'						=> 'Objetivo al que reporta',
            'id_actividad'						=> 'Actividad que reporta',
            'ruta_archivo'						=> 'Ruta del archivo',
            'documentFile'						=> 'Agregar Archivo',
        ];
    }
}
