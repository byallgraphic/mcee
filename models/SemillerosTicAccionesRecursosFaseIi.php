<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "semilleros_tic.acciones_recursos_fase_ii".
 *
 * @property string $id
 * @property string $tipo_accion
 * @property string $descripcion_accion
 * @property string $responsable_accion
 * @property string $tiempo_desarrollo
 * @property string $tic
 * @property string $tipo_recurso_tic
 * @property string $digitales
 * @property string $escolares
 * @property string $tipo_recurso_no_tic
 * @property string $tiempo_uso_recurso
 * @property string $tipo_recurso_digitales
 * @property string $id_datos_sesion
 * @property string $estado
 */
class SemillerosTicAccionesRecursosFaseIi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'semilleros_tic.acciones_recursos_fase_ii';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tipo_accion', 'descripcion_accion', 'responsable_accion', 'tiempo_desarrollo', 'tic', 'tipo_recurso_tic', 'digitales', 'escolares', 'tipo_recurso_no_tic', 'tiempo_uso_recurso', 'tipo_recurso_digitales'], 'string'],
            [['id_datos_sesion', 'estado'], 'default', 'value' => null],
            [['id_datos_sesion', 'estado','id_ciclo'], 'integer'],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['estado'], 'exist', 'skipOnError' => true, 'targetClass' => Estados::className(), 'targetAttribute' => ['estado' => 'id']],
            [['id_datos_sesion'], 'exist', 'skipOnError' => true, 'targetClass' => SemillerosTicDatosSesiones::className(), 'targetAttribute' => ['id_datos_sesion' => 'id']],
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
            'tipo_accion' => 'Tipo Accion',
            'descripcion_accion' => 'Descripcion Accion',
            'responsable_accion' => 'Responsable Accion',
            'tiempo_desarrollo' => 'Tiempo Desarrollo',
            'tic' => 'Tic',
            'tipo_recurso_tic' => 'Tipo Recurso Tic',
            'digitales' => 'Digitales',
            'escolares' => 'Escolares',
            'tipo_recurso_no_tic' => 'Tipo Recurso No Tic',
            'tiempo_uso_recurso' => 'Tiempo Uso Recurso',
            'tipo_recurso_digitales' => 'Tipo Recurso Digitales',
            'id_datos_sesion' => 'Id Datos Sesion',
            'estado' => 'Estado',
            'id_ciclo' => 'Ciclo',
        ];
    }
}
