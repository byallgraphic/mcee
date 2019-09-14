<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.informe_ejecutivo_estado".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_eje
 * @property string $id_persona
 * @property string $id_coordinador
 * @property string $id_secretaria
 * @property string $mision
 * @property string $descripcion
 * @property string $avance_producto
 * @property string $hallazgos
 * @property string $logros
 * @property string $fecha_creacion
 * @property string $estado
 */
class EcInformeEjecutivoEstado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.informe_ejecutivo_estado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_eje', 'id_persona', 'id_coordinador', 'id_secretaria', 'mision', 'descripcion', 'avance_producto', 'hallazgos', 'logros', 'estado'], 'required'],
            [['id_institucion', 'id_eje', 'id_persona', 'id_coordinador', 'id_secretaria', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_eje', 'id_persona', 'id_coordinador', 'id_secretaria', 'estado','id_tipo_informe'], 'integer'],
            [['mision', 'descripcion', 'avance_producto', 'hallazgos', 'logros'], 'string'],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_persona'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonas::className(), 'targetAttribute' => ['id_persona' => 'id']],
            [['id_coordinador'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_coordinador' => 'id']],
            [['id_secretaria'], 'exist', 'skipOnError' => true, 'targetClass' => PerfilesXPersonasInstitucion::className(), 'targetAttribute' => ['id_secretaria' => 'id']],
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
            'id_persona' => 'Nombre',
            'id_coordinador' => 'Coordinador',
            'id_secretaria' => 'Secretaría',
            'mision' => 'Misión',
            'descripcion' => 'Descripción',
            'avance_producto' => 'Avance Producto',
            'hallazgos' => 'Hallazgos',
            'logros' => 'Logros',
            'fecha_creacion' => 'Fecha Creación',
            'estado' => 'Estado',
            'idTipoInforme' => 'idTipoInforme',

        ];
    }
}
