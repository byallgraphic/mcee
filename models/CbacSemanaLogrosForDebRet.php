<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.semana_logros_for_deb_ret".
 *
 * @property string $id
 * @property string $semana1
 * @property string $semana2
 * @property string $semana3
 * @property string $semana4
 * @property string $id_for_deb_ret
 * @property string $estado
 * @property string $id_seguimiento_proceso
 */
class CbacSemanaLogrosForDebRet extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.semana_logros_for_deb_ret';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['semana1', 'semana2', 'semana3', 'semana4', 'id_for_deb_ret', 'estado'], 'required'],
            [['semana1', 'semana2', 'semana3', 'semana4'], 'string'],
            [['id_for_deb_ret', 'estado', 'id_seguimiento_proceso'], 'default', 'value' => null],
            [['id_for_deb_ret', 'estado', 'id_seguimiento_proceso'], 'integer'],
            [['id_for_deb_ret'], 'exist', 'skipOnError' => true, 'targetClass' => CbacForDebRet::className(), 'targetAttribute' => ['id_for_deb_ret' => 'id']],
            [['id_seguimiento_proceso'], 'exist', 'skipOnError' => true, 'targetClass' => CbacSeguimientoProceso::className(), 'targetAttribute' => ['id_seguimiento_proceso' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'semana1' => 'Semana1',
            'semana2' => 'Semana2',
            'semana3' => 'Semana3',
            'semana4' => 'Semana4',
            'id_for_deb_ret' => 'Id For Deb Ret',
            'estado' => 'Estado',
            'id_seguimiento_proceso' => 'Id Seguimiento Proceso',
        ];
    }
}
