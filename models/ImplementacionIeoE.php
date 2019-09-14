<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.implementacion_ieo".
 *
 * @property int $id
 * @property int $institucion_id
 * @property int $sede_id
 * @property string $zona_educativa
 * @property string $comuna
 * @property string $barrio
 * @property string $profesional_cargo
 * @property string $horario_trabajo
 * @property int $estado
 */
class ImplementacionIeoE extends \yii\db\ActiveRecord
{

    public $producto_acuerdo;
    public $resultado_actividad;
    public $acta;
    public $listado;
    public $fotografias;
    public $avance_formula;
    public $avance_ruta_gestion;

    public $producto_informe_acompañamiento;
    public $producto_trazabilidad;
    public $producto_formnulacion_sistemactizacion;
    public $producto_ruta_gestion;
    public $producto_presentacion_resultados;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.implementacion_ieo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            //[['id'], 'required'],
            [['institucion_id', 'sede_id', 'estado'], 'default', 'value' => null],
            [['institucion_id', 'sede_id', 'estado'], 'integer'],
            [['zona_educativa', 'comuna', 'barrio', 'profesional_cargo', 'horario_trabajo'], 'string'],
            //[['id'], 'unique'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['institucion_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['institucion_id' => 'id']],
            [['sede_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['sede_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'institucion_id' => 'Institucion ID',
            'sede_id' => 'Sede ID',
            'zona_educativa' => 'Zona Educativa',
            'comuna' => 'Comuna',
            'barrio' => 'Barrio',
            'profesional_cargo' => 'Profesional Cargo',
            'horario_trabajo' => 'Horario Trabajo',
            'estado' => 'Estado',
        ];
    }
}
