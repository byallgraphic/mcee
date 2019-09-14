<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividades_consolidado_misional".
 *
 * @property string $id
 * @property string $id_rom_procesos
 * @property string $descripcion
 * @property int $estado
 */
class CbacActividadesConsolidadoMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividades_consolidado_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_rom_procesos', 'estado'], 'default', 'value' => null],
            [['id_rom_procesos', 'estado'], 'integer'],
            [['descripcion'], 'string'],
            [['id_rom_procesos'], 'exist', 'skipOnError' => true, 'targetClass' => CbacRomProcesos::className(), 'targetAttribute' => ['id_rom_procesos' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_rom_procesos' => 'Id Rom Procesos',
            'descripcion' => 'Descripcion',
            'estado' => 'Estado',
        ];
    }
}
