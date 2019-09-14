<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.docentes_x_bitacora".
 *
 * @property string $id
 * @property string $docente
 * @property string $estado
 * @property string $id_bitacora
 */
class GcDocentesXBitacora extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.docentes_x_bitacora';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['docente', 'estado', 'id_bitacora'], 'required'],
            [['docente', 'estado', 'id_bitacora'], 'default', 'value' => null],
            [['docente', 'estado', 'id_bitacora'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'docente' => 'Docentes',
            'estado' => 'Estado',
            'id_bitacora' => 'Id Bitacora',
        ];
    }
}
