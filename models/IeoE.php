<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.ieo".
 *
 * @property int $id
 * @property int $institucion_id
 * @property int $sede_id
 * @property int $estado
 * @property string $persona_acargo
 * @property string $codigo_dane
 * @property string $comuna
 * @property string $barrio
 * @property int $id_tipo_informe
 * @property int $zonas_educativas_id
 */
class IeoE extends \yii\db\ActiveRecord
{

    public $file_socializacion_ruta;
    public $file_soporte_necesidad;
    public $file_informe_caracterizacion;
    public $file_matriz_caracterizacion;
    public $file_revision_pei;
    public $file_revision_autoevaluacion;
    public $file_revision_pmi;
    public $file_resultados_caracterizacion;
    public $file_horario_trabajo;
    public $file_producto_ruta;
    public $file_resultados_actividad_ruta;
    public $file_acta_ruta;
    public $file_listado_ruta;
    public $file_fotografias_ruta;
    
    public $file_producto_imforme_ruta;
    public $file_producto_plan_accion;
    public $file_producto_presentacion;

    public $observaciones;
    public $tipo_actividad;

    public $zona_educativa;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['institucion_id', 'sede_id', 'estado', 'id_tipo_informe', 'zonas_educativas_id'], 'default', 'value' => null],
            [['institucion_id', 'sede_id', 'estado', 'id_tipo_informe', 'zonas_educativas_id'], 'integer'],
            /*[['persona_acargo', 'codigo_dane', 'zonas_educativas_id', 'comuna', 'barrio', 'file_socializacion_ruta', 'file_soporte_necesidad', 'file_soporte_necesidad', 
                'file_informe_caracterizacion', 'file_matriz_caracterizacion', 'file_revision_pei', 'file_revision_autoevaluacion', 'file_revision_pmi', 'file_resultados_caracterizacion', 'file_horario_trabajo',
            'file_producto_ruta', 'file_resultados_actividad_ruta', 'file_acta_ruta', 'file_listado_ruta', 'file_fotografias_ruta', 'file_producto_imforme_ruta', 'file_plan_accion'], 'required'],*/
            [['persona_acargo', 'codigo_dane', 'comuna', 'barrio'], 'string'],
            [['id_tipo_informe'], 'exist', 'skipOnError' => true, 'targetClass' => TipoInforme::className(), 'targetAttribute' => ['id_tipo_informe' => 'id']],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_id' => 'id']],
            [['zonas_educativas_id'], 'exist', 'skipOnError' => true, 'targetClass' => ZonasEducativas::className(), 'targetAttribute' => ['zonas_educativas_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'institucion_id' => 'Institucion ID',
            'sede_id' => 'Sede ID',
            'estado' => 'Estado',
            'persona_acargo' => 'Persona Acargo',
            'codigo_dane' => 'Codigo Dane',
            'comuna' => 'Comuna',
            'barrio' => 'Barrio',
            'id_tipo_informe' => 'Id Tipo Informe',
            'zonas_educativas_id' => 'Zonas Educativas ID',
        ];
    }
}
