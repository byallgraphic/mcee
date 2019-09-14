<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cbac.actividad_misional".
 *
 * @property int $id
 * @property int $id_imp_misional
 * @property string $estado
 * @property string $logros
 * @property string $fortalezas
 * @property string $debilidades
 * @property string $retos
 * @property string $alarmas
 */
class CbacActividadMisional extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cbac.actividad_misional';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_imp_misional'], 'default', 'value' => null],
            [['id_imp_misional'], 'integer'],
            [['estado', 'logros', 'fortalezas', 'debilidades', 'retos', 'alarmas'], 'string'],
            [['estado', 'logros', 'fortalezas', 'debilidades', 'retos', 'alarmas'], 'required'],
            [['id_imp_misional'], 'exist', 'skipOnError' => true, 'targetClass' => CbacImpMisional::className(), 'targetAttribute' => ['id_imp_misional' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_imp_misional' => 'Id Imp Misional',
            'estado' => 'Estado Actual',
            'logros' => 'Logros: Avances en desarrollar herramientas en docentes y directivos docentes que implementen componentes artísticos y culturales para el fortalecimiento de competencias básicas de los estudiantes de grados sexto a once de las Instituciones Educativas Oficiales.',
            'fortalezas' => 'Fortalezas',
            'debilidades' => 'Debilidades',
            'retos' => 'Retos',
            'alarmas' => 'Alarmas',
        ];
    }
}
