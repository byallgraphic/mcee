<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.encabezado_iniciacion_artistica_consolidado".
 *
 * @property string $id
 * @property string $id_institucion
 * @property string $id_sede
 * @property string $fecha
 * @property string $periodo
 * @property string $estado
 */
class CbacEncabezadoIniciacionArtisticaConsolidado extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.encabezado_iniciacion_artistica_consolidado';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_institucion', 'id_sede', 'estado','fecha','periodo'], 'required'],
            [['id_institucion', 'id_sede', 'estado'], 'default', 'value' => null],
            [['id_institucion', 'id_sede', 'estado'], 'integer'],
            [['fecha'], 'safe'],
            [['periodo'], 'string'],
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
            'id' 			=> 'ID',
            'id_institucion'=> 'INSTITUCIÓN',
            'id_sede' 		=> 'SEDE',
            'fecha' 		=> 'Fecha',
            'periodo' 		=> 'PERÍODO',
            'estado' 		=> 'Estado',
        ];
    }
}
