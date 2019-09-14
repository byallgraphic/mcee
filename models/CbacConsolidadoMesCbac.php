<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.consolidado_mes_cbac".
 *
 * @property int $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $desde
 * @property string $hasta
 * @property string $estado
 */
class CbacConsolidadoMesCbac extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.consolidado_mes_cbac';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['desde', 'hasta'], 'safe'],
            [['id_institucion','id_sede', 'desde', 'hasta'],'required'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_institucion'], 'exist', 'skipOnError' => true, 'targetClass' => Instituciones::className(), 'targetAttribute' => ['id_institucion' => 'id']],
            [['id_sede'], 'exist', 'skipOnError' => true, 'targetClass' => Sedes::className(), 'targetAttribute' => ['id_sede' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'nombre_institucion' => 'Nombre Institución',
            'id' => 'ID',
            'id_institucion' => 'Institucion',
            'id_sede' => 'Sede',
            'desde' => 'Desde',
            'hasta' => 'Hasta',
            'estado' => 'Estado',
        ];
    }
}
