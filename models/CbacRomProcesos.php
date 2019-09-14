<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.rom_procesos".
 *
 * @property string $id
 * @property string $descripcion
 * @property string $id_rom_proyectos
 * @property string $estado
 */
class CbacRomProcesos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.rom_procesos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['descripcion', 'id_rom_proyectos'], 'required'],
            [['descripcion'], 'string'],
            [['id_rom_proyectos', 'estado'], 'default', 'value' => null],
            [['id_rom_proyectos', 'estado'], 'integer'],
            [['id_rom_proyectos'], 'exist', 'skipOnError' => true, 'targetClass' => CbacRomProyectos::className(), 'targetAttribute' => ['id_rom_proyectos' => 'id']],
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
            'id_rom_proyectos' => 'Id Rom Proyectos',
            'estado' => 'Estado',
        ];
    }
}
