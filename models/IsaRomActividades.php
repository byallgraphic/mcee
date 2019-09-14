<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "isa.rom_actividades".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_rom_procesos
 * @property string $estado
 */
class IsaRomActividades extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'isa.rom_actividades';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_rom_procesos'], 'required'],
            [['descripcion'], 'string'],
            [['id_rom_procesos', 'estado'], 'default', 'value' => null],
            [['id_rom_procesos', 'estado'], 'integer'],
            [['id_rom_procesos'], 'exist', 'skipOnError' => true, 'targetClass' => IsaRomProcesos::className(), 'targetAttribute' => ['id_rom_procesos' => 'id']],
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
            'id_rom_procesos' => 'Id Rom Procesos',
            'estado' => 'Estado',
        ];
    }
}
