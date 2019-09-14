<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.personas_comunidad".
 *
 * @property string $id
 * @property string $mision
 * @property string $descripcion
 * @property string $hallazgos
 * @property string $id_consolidado_misional
 * @property string $id_actividades_consolidado
 * @property int $estado
 */
class CbacPersonasComunidad extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.personas_comunidad';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mision', 'descripcion', 'hallazgos'], 'string'],
            [['id_consolidado_misional', 'id_actividades_consolidado', 'estado'], 'default', 'value' => null],
            [['id_consolidado_misional', 'id_actividades_consolidado', 'estado'], 'integer'],
            [['id_actividades_consolidado'], 'exist', 'skipOnError' => true, 'targetClass' => CbacActividadesConsolidadoMisional::className(), 'targetAttribute' => ['id_actividades_consolidado' => 'id']],
            [['id_consolidado_misional'], 'exist', 'skipOnError' => true, 'targetClass' => CbacConsolidadoMisional::className(), 'targetAttribute' => ['id_consolidado_misional' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
       return [
            'id' => 'ID',
            'mision' => 'Misión',
            'descripcion' => 'Descripción',
            'hallazgos' => 'Hallazgos',
            'id_consolidado_misional' => 'Id Consolidado Misional',
            'id_actividades_consolidado' => 'Id Actividades Consolidado',
            'estado' => 'Estado',
        ];

    }
}
