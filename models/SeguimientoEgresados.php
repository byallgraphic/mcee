<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguimiento_egresados".
 *
 * @property int $id
 * @property string $estrategia_seguimiento
 * @property int $cantidad_promociones
 * @property int $cantidad_alumnos_egresados
 * @property int $cantidad_egresados_estudiso
 *
 * @property TipoParametro $cantidadEgresadosEstudiso
 */
class SeguimientoEgresados extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seguimiento_egresados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['estrategia_seguimiento'], 'string'],
            [['cantidad_promociones', 'cantidad_alumnos_egresados', 'cantidad_egresados_estudiso'], 'default', 'value' => null],
            [['cantidad_promociones', 'cantidad_alumnos_egresados', 'cantidad_egresados_estudiso'], 'integer'],
            [['cantidad_egresados_estudiso'], 'exist', 'skipOnError' => true, 'targetClass' => TipoParametro::className(), 'targetAttribute' => ['cantidad_egresados_estudiso' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estrategia_seguimiento' => 'Estrategia Seguimiento',
            'cantidad_promociones' => 'Cantidad Promociones',
            'cantidad_alumnos_egresados' => 'Cantidad Alumnos Egresados',
            'cantidad_egresados_estudiso' => 'Cantidad Egresados Estudiso',
            'id_instituciones' => 'Institución',
            'id_tipo_documento' => 'Tipo Documento',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCantidadEgresadosEstudiso()
    {
        return $this->hasOne(TipoParametro::className(), ['id' => 'cantidad_egresados_estudiso']);
    }
}
