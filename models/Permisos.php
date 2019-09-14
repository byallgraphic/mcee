<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "permisos".
 *
 * @property string $id
 * @property string $id_modulos
 * @property string $id_perfiles
 * @property int $eliminar
 * @property int $editar
 * @property int $listar 0: No tiene permiso; 1: solo a sí mismo; 2: a sí mismo y a perfiles inferiores; 3: a todos los usuarios
 * @property int $agregar
 * @property string $estado
 *
 * @property Estados $estado0
 * @property Modulos $modulos
 * @property Perfiles $perfiles
 */
class Permisos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'permisos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_modulos', 'id_perfiles', 'eliminar', 'editar', 'listar', 'agregar', 'estado'], 'default', 'value' => null],
            [['id_modulos', 'id_perfiles', 'eliminar', 'editar', 'listar', 'agregar', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_modulos'], 'exist', 'skipOnError' => true, 'targetClass' => Modulos::className(), 'targetAttribute' => ['id_modulos' => 'id']],
            [['id_perfiles'], 'exist', 'skipOnError' => true, 'targetClass' => Perfiles::className(), 'targetAttribute' => ['id_perfiles' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_modulos' => 'Módulos',
            'id_perfiles' => 'Perfiles',
            'eliminar' => 'Eliminar',
            'editar' => 'Editar',
            'listar' => 'Listar',
            'agregar' => 'Agregar',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstado0()
    {
        return $this->hasOne(Estados::className(), ['id' => 'estado']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModulos()
    {
        return $this->hasOne(Modulos::className(), ['id' => 'id_modulos']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerfiles()
    {
        return $this->hasOne(Perfiles::className(), ['id' => 'id_perfiles']);
    }
}
