<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.proceso_seguimiento".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_proyecto
 * @property string $estado
 * @property string $porcentaje_avance
 */
class IsaProcesoSeguimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.proceso_seguimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'porcentaje_avance'], 'string'],
            [['id_proyecto', 'estado'], 'default', 'value' => null],
            [['id_proyecto', 'estado'], 'integer'],
            [['id_proyecto'], 'exist', 'skipOnError' => true, 'targetClass' => IsaSeguimientoProyectos::className(), 'targetAttribute' => ['id_proyecto' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descripcion' => 'Descripcion',
            'id_proyecto' => 'Id Proyecto',
            'estado' => 'Estado',
            'porcentaje_avance' => 'Porcentaje Avance',
        ];
    }
}
