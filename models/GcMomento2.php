<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "gc.momento2".
 *
 * @property string $id
 * @property string $id_semana
 * @property bool $realizo_visita
 * @property int $estudiantes
 * @property int $docentes
 * @property int $directivos
 * @property int $otro
 * @property string $justificacion_no_visita
 * @property string $estado
 * @property string $descripcion_visita
 */
class GcMomento2 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gc.momento2';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_semana', 'estudiantes', 'docentes', 'directivos', 'otro', 'estado', 'descripcion_visita'], 'required'],
            [['id_semana', 'estudiantes', 'docentes', 'directivos', 'otro', 'estado','descripcion_visita'], 'default', 'value' => null],
            [['id_semana', 'estudiantes', 'docentes', 'directivos', 'otro', 'estado'], 'integer'],
            [['realizo_visita'], 'boolean'],
            [['justificacion_no_visita','descripcion_visita'], 'string'],
            [['id_semana'], 'exist', 'skipOnError' => true, 'targetClass' => GcSemanas::className(), 'targetAttribute' => ['id_semana' => 'id']],
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
            'id_semana' => 'Id Semana',
            'realizo_visita' => 'Realizó visita de acompañamiento.',
            'estudiantes' => 'Estudiantes',
            'docentes' => 'Docentes',
            'directivos' => 'Directivos',
            'otro' => 'Otro',
            'justificacion_no_visita' => 'Justificacion No Visita',
            'estado' => 'Estado',
            'descripcion_visita' => 'Descripción visita',
        ];
    }
}
