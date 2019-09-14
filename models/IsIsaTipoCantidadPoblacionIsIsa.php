<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "is_isa.tipo_cantidad_poblacion_is_isa".
 *
 * @property int $id
 * @property int $id_actividades_is_isa
 * @property string $vecinos
 * @property string $lider_comunitario
 * @property string $empresarios_comerciantes
 * @property string $representantes
 * @property string $miembros_asociados
 * @property string $otros_actores
 * @property int $total
 * @property int $estado
 */
class IsIsaTipoCantidadPoblacionIsIsa extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.tipo_cantidad_poblacion_is_isa';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_actividades_is_isa', 'total', 'estado'], 'default', 'value' => null],
            [['id_actividades_is_isa', 'total', 'estado'], 'integer'],
            [['vecinos', 'lider_comunitario', 'empresarios_comerciantes', 'representantes', 'miembros_asociados', 'otros_actores'], 'string'],
            [['id_actividades_is_isa'], 'exist', 'skipOnError' => true, 'targetClass' => IsIsaActividadesIsIsa::className(), 'targetAttribute' => ['id_actividades_is_isa' => 'id']],
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
            'id_actividades_is_isa' => 'Id Actividades Is Isa',
            'vecinos' => 'Vecinos',
            'lider_comunitario' => 'Lider Comunitario',
            'empresarios_comerciantes' => 'Empresarios Comerciantes',
            'representantes' => 'Representantes',
            'miembros_asociados' => 'Miembros Asociados',
            'otros_actores' => 'Otros Actores',
            'total' => 'Total',
            'estado' => 'Estado',
        ];
    }
}
