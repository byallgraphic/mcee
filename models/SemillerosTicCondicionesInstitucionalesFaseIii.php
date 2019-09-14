<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.condiciones_institucionales_fase_iii".
 *
 * @property string $id
 * @property string $id_fase
 * @property string $estado
 * @property string $parte_ieo
 * @property string $parte_univalle
 * @property string $parte_sem
 * @property string $otro
 */
class SemillerosTicCondicionesInstitucionalesFaseIii extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.condiciones_institucionales_fase_iii';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_fase', 'estado','id_ciclo'], 'required'],
            [['id_fase', 'estado','id_ciclo'], 'default', 'value' => null],
            [['id_fase', 'estado','id_ciclo','total_aplicaciones_usadas'], 'integer'],
            [['parte_ieo', 'parte_univalle', 'parte_sem', 'otro'], 'string'],
            [['parte_ieo', 'parte_univalle', 'parte_sem', 'otro'], 'required'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_fase'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicFases::className(), 'targetAttribute' => ['id_fase' => 'id']],
            [['id_ciclo'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicCiclos::className(), 'targetAttribute' => ['id_ciclo' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_fase' => 'Id Fase',
            'estado' => 'Estado',
            'parte_ieo' => 'Parte Ieo',
            'parte_univalle' => 'Parte Univalle',
            'parte_sem' => 'Parte Sem',
            'otro' => 'Otro',
            'id_ciclo' => 'Ciclo',
            'total_aplicaciones_usadas' => 'Total aplicaciones usadas',
        ];
    }
}
