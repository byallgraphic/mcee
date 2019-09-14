<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.orientacion_proceso_seguimiento".
 *
 * @property int $id
 * @property string $seguimieno
 * @property string $desde
 * @property string $hasta
 * @property int $id_institcion
 * @property int $id_sede
 * @property int $estado
 */
class CbacOrientacionProcesoSeguimiento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.orientacion_proceso_seguimiento';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seguimieno'], 'string'],
            [['desde', 'hasta'], 'safe'],
            [['id_institcion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institcion', 'id_sede', 'estado'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institcion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institcion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombre_institucion' => "Institución",
            'id' => 'ID',
            'seguimieno' => 'Seguimieno',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'id_institcion' => 'Institución',
            'id_sede' => 'Sede',
            'estado' => 'Estado',
        ];
    }
}
