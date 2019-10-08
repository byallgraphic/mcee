<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_avance_ejecucion_misional".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_eje
 * @property string $id_coordinador
 * @property string $id_secretaria
 * @property string $descripcion
 * @property string $presentacion
 * @property string $productos
 * @property string $presentacion_retos
 * @property string $alarmas
 * @property string $consolidad_avance
 * @property string $fecha_creacion
 * @property string $estado
 * @property string $id_coor_proyecto_uni
 * @property string $id_coor_proyecto_sec
 */
class EcInformeAvanceEjecucionMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_avance_ejecucion_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_eje', 'id_coordinador', 'id_secretaria', 'descripcion', 'presentacion', 'productos', 'presentacion_retos', 'alarmas', 'consolidad_avance', 'estado', 'id_coor_proyecto_uni', 'id_coor_proyecto_sec'], 'required'],
            [['id_institucion', 'id_eje', 'id_coordinador', 'id_secretaria', 'estado', 'id_coor_proyecto_uni', 'id_coor_proyecto_sec'], 'default', 'value' => null],
            [['id_institucion', 'id_eje', 'estado','id_tipo_informe'], 'integer'],
            [['descripcion', 'presentacion', 'productos', 'presentacion_retos', 'alarmas', 'consolidad_avance'], 'string'],
            [['fecha_creacion'], 'safe'],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            
            // [['id_coordinador'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_coordinador' => 'id']],
            // [['id_secretaria'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_secretaria' => 'id']],
            // [['id_coor_proyecto_uni'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_coor_proyecto_uni' => 'id']],
            // [['id_coor_proyecto_sec'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_coor_proyecto_sec' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_institucion' => 'Institución',
            'id_eje' => 'Ejes',
            'id_coordinador' => 'Coordinador',
            'id_secretaria' => 'Secretaría',
            'descripcion' => 'Descripción general del proceso llevado a cabo para avanzar en esa transformación',
            'presentacion' => 'Presentación de logros (avances).',
            'productos' => 'Productos que evidencian el avance',
            'presentacion_retos' => 'Presentación de Retos',
            'alarmas' => '2. Enlistar alarmas evidenciadas en el desarrollo de las actividades en las IEO',
            'consolidad_avance' => '3. Consolidado de avance de ejecución',
            'fecha_creacion' => 'Fecha Creación',
            'estado' => 'Estado',
            'id_coor_proyecto_uni' => 'Coordinador',
            'id_coor_proyecto_sec' => 'Secretaría',
            'id_tipo_informe' => 'id_tipo_informe',
        ];
    }
}
