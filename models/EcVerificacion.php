<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.verificacion".
 *
 * @property string $id
 * @property string $id_planeacion
 * @property string $tipo_verificacion
 * @property string $ruta_archivo
 * @property string $estado
 */
class EcVerificacion extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.verificacion';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_planeacion', 'tipo_verificacion', 'estado'], 'required'],
            [['ruta_archivo'], 'required', 'on' => ['nuevoRegistro'] ],
            [['id_planeacion', 'tipo_verificacion', 'estado'], 'default', 'value' => null],
            [['id_planeacion', 'tipo_verificacion', 'estado'], 'integer'],
            [['ruta_archivo'], 'string'],
            [['id_planeacion'], 'exist', 'skipOnError' => true, 'targetClass' => EcPlaneacion::className(), 'targetAttribute' => ['id_planeacion' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['tipo_verificacion'], 'exist', 'skipOnError' => true, 'targetClass' => Parametro::className(), 'targetAttribute' => ['tipo_verificacion' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_planeacion' => 'Id Planeacion',
            'tipo_verificacion' => 'Tipo de verificación',
            'ruta_archivo' => 'Ruta del archivo',
            'estado' => 'Estado',
        ];
    }
}
