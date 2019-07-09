<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ge.seguimiento_operador_frente".
 *
 * @property string $id
 * @property string $id_tipo_seguimiento
 * @property string $email
 * @property string $id_persona_diligencia
 * @property string $id_gestor_a_evaluar
 * @property string $mes_reporte
 * @property string $fecha_corte
 * @property bool $cumple_cronograma
 * @property string $descripcion_cronograma
 * @property string $compromisos_establecidos
 * @property int $cuantas_reuniones
 * @property string $aportes_reuniones
 * @property string $logros
 * @property string $dificultades
 * @property string $estado
 * @property GeTipoSeguimiento $tipo_seguimiento
 * @property int $id_admin
 */
class GeSeguimientoOperadorFrente extends \yii\db\ActiveRecord
{
	public $documentFile;
	
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ge.seguimiento_operador_frente';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // [['id_tipo_seguimiento', 'id_persona_diligencia', 'id_gestor_a_evaluar', 'mes_reporte', 'fecha_corte', 'cumple_cronograma', 'descripcion_cronograma', 'compromisos_establecidos', 'cuantas_reuniones', 'aportes_reuniones', 'logros', 'dificultades', 'estado'], 'required'],
            [[
				'id_tipo_seguimiento',
				'email',
				'id_persona_diligencia',
				'id_gestor_a_evaluar',
				'mes_reporte',
				'fecha_corte',
				'cumple_cronograma',
				'descripcion_cronograma',
				'compromisos_establecidos',
				'cuantas_reuniones',
				'aportes_reuniones',
				'logros',
				'dificultades',
				'estado'
			], 'required'],
            [['id_tipo_seguimiento', 'id_persona_diligencia', 'id_gestor_a_evaluar', 'compromisos_establecidos', 'cuantas_reuniones', 'estado'], 'default', 'value' => null],
            [['id_tipo_seguimiento', 'id_persona_diligencia', 'id_gestor_a_evaluar', 'compromisos_establecidos', 'cuantas_reuniones', 'estado'], 'integer'],
            [['fecha_corte'], 'safe'],
            [['cumple_cronograma'], 'boolean'],
            [['descripcion_cronograma'], 'string'],
            [['email', 'mes_reporte'], 'string', 'max' => 200],
            [['email'], 'email'],
            [['aportes_reuniones', 'logros', 'dificultades'], 'string', 'max' => 700],
            [['id_tipo_seguimiento'], 'exist', 'skipOnError' => true, 'targetClass' => GeTipoSeguimiento::className(), 'targetAttribute' => ['id_tipo_seguimiento' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_persona_diligencia'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_persona_diligencia' => 'id']],
            [['id_gestor_a_evaluar'], 'exist', 'skipOnError' => true, 'targetClass' => Personas::className(), 'targetAttribute' => ['id_gestor_a_evaluar' => 'id']],
            [['compromisos_establecidos'], 'exist', 'skipOnError' => true, 'targetClass' => Parametro::className(), 'targetAttribute' => ['compromisos_establecidos' => 'id']],
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
            'email' 					=> 'Dirección de correo electrónico',
            'id_persona_diligencia' 	=> 'Nombre de quien diligencia',
            'id_gestor_a_evaluar' 		=> 'Gestor o Gestora a quien se evalúa',
            'mes_reporte' 				=> 'Mes de reporte',
            'fecha_corte' 				=> 'Fecha de corte',
            'cumple_cronograma' 		=> 'Se cumplió con el cronograma establecido?',
            'descripcion_cronograma' 	=> 'Justifique su respuesta',
            'compromisos_establecidos' 	=> 'Se cumplió con los compromisos establecidos en cuanto a documento solicitados en el Drive en las fechas indicadas',
            'cuantas_reuniones' 		=> 'A cuantás reuniones de equipo asistió?',
            'aportes_reuniones' 		=> 'Realizó aportes en las reuniones para el mejoramiento del proceso de gestión? De ser afirmativa su respuesta indique cuales',
            'logros' 					=> 'Logros alcanzados',
            'dificultades' 				=> 'Dificultades en la gestión',
            'estado' 					=> 'Estado',
            'documentFile'				=> 'Agregar Archivo',
            'ruta_archivo'				=> 'Ruta del archivo',
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
