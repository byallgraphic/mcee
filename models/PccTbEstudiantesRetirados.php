<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pcc.Tb_EstudiantesRetirados".
 *
 * @property string $id_accion
 * @property string $ID_numero
 * @property string $Nombre
 * @property string $Apellido
 * @property string $Fecha_retiro
 * @property string $Motivo_retiro
 * @property string $Institucion_educativa
 */
class PccTbEstudiantesRetirados extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pcc.Tb_EstudiantesRetirados';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Fecha_retiro'], 'safe'],
            [['Motivo_retiro'], 'string'],
            [['id_accion'], 'string', 'max' => 10],
            [['ID_numero'], 'string', 'max' => 30],
            [['Nombre', 'Apellido', 'Institucion_educativa'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_accion' => 'Id Accion',
            'ID_numero' => 'Id Numero',
            'Nombre' => 'Nombre',
            'Apellido' => 'Apellido',
            'Fecha_retiro' => 'Fecha Retiro',
            'Motivo_retiro' => 'Motivo Retiro',
            'Institucion_educativa' => 'Institucion Educativa',
        ];
    }
}
