<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ec.reportes".
 *
 * @property int $id
 * @property int $id_planeacion
 * @property string $fecha_diligenciamiento
 * @property string $ejecutado
 * @property string $no_ejecutado
 * @property string $variaciones
 * @property string $observaciones
 * @property int $estado
 */
class EcReportes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ec.reportes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_planeacion', 'estado'], 'required'],
            [['id_planeacion', 'estado'], 'default', 'value' => null],
            [['id_planeacion', 'estado'], 'integer'],
            [['fecha_diligenciamiento'], 'safe'],
            [['ejecutado', 'no_ejecutado', 'variaciones', 'observaciones'], 'string'],
            [['id_planeacion'], 'exist', 'skipOnError' => true, 'targetClass' => EcPlaneacion::className(), 'targetAttribute' => ['id_planeacion' => 'id']],
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
            'id_planeacion' => 'Id Planeacion',
            'fecha_diligenciamiento' => 'Fecha diligenciamiento',
            'ejecutado' => 'Ejecutado',
            'no_ejecutado' => 'No Ejecutado',
            'variaciones' => 'Variaciones',
            'observaciones' => 'Observaciones',
            'estado' => 'Estado',
        ];
    }
}
